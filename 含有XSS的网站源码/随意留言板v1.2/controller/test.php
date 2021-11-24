<?php
/***********************************************
 *		SpeedPHP功能演示类
 * 文件: /controller/test.php
 * 说明: SpeedPHP功能演示类
 * 作者: Myxf
 * 更新: 2015年5月14日
 ***********************************************/

/**
 * SpeedPHP功能演示类
 */
class test extends spController
{
	function index(){
		echo "hello world!";
	}

    //文件上传类演示
	function upload(){
        $upload = spClass('spUploadFile');
		echo $upload->upload_file($_FILES['inputname'],"jpg|png|gif");
	}

    //邮件发送类演示
	function email() {
        $mail = spClass('spEmail');
        $mailsubject = "SpeedPHP邮件扩展";//邮件主题
        $mailbody = "<h1> SpeedPHP邮件扩展 </h1>";//邮件内容
        $mailtype = "HTML";//邮件格式（HTML/TXT）,TXT为文本邮件
        $mail->sendmail('myxfonline@qq.com', $mailsubject, $mailbody, $mailtype);
    }
    
    //验证码类
    function vcode(){
    	$vcode = spClass('spVerifyCode');
    	echo $vcode->verify($this->spArgs('txtcheck'));
    }
    function _vcode() {
        $vcode = spClass('spVerifyCode');
        $vcode->display();
    }

    //常用函数扩展类演示
    function fun(){
    	$fun = spClass('spFun');
    	echo $fun->getRandom(1000,9999);
        echo $fun->strCut("1111@2222*3333","@","*");
    }

    //数据库操作类
    function data(){
    	$config = spClass("lib_config");
    	$mconfig = $config->findsql("Select * from abc where 1==1");
        //分页显示
        $this->lists = $config->spPager($this->spArgs('page', 1), 15)->findSql("Select * from abc where 1=1");	
	    $this->pager = $config->spPager()->getPager();
	    //smarty显示
	    /**
        {if $lists}
        {foreach from=$lists item=one}
        {/foreach}
        {else}
        {/if}
        {if $pager}
		<a href="{spUrl c=madmins a=user q=$mkey page=1}">首页</a>
		{if $pager.current_page != $pager.first_page}<a href="{spUrl c=madmins a=user q=$mkey page=$pager.prev_page}">{/if}上一页</a>
		{if $pager.current_page != $pager.last_page}<a href="{spUrl c=madmins a=user q=$mkey page=$pager.next_page}">{/if}下一页</a>
		<a href="{spUrl c=madmins a=user q=$mkey page=$pager.last_page}">尾页</a>
		当前第{$pager.current_page}页
		共{$pager.last_page}页
		{$pager.total_count}条数据
		{/if}
	    **/
    }
    
    //定义url
    function url(){
        echo spUrl("main","show");
        //smarty中 {spUrl c=main a=show}
        echo spUrl("guestbook","page", array("gid"=>"3", "myname"=>"jake"));
        //smarty中 {spUrl c=guestbook a=page gid=3 myname="jake"}
    }

    //模板缓存演示
    function cache(){
        //显示页面
        //$this->display("index.html");
        //开启缓存时显示页面
        //$smarty->display('index.html',$cacheurl); 
        //模板内调用资源目录
        //{$smarty.const.MYTM_PATH}
        //局部不缓存
        //<{nocache}><{$smarty.now|date_format}><{/nocache}>
        //清理缓存
        //$smarty->clearCache("index.html",$cacheurl);
        //不缓存变量
        //$smarty->assign("data",$data);
        $smarty = $this->getView();
        $cacheurl=md5($_SERVER['REQUEST_URI']);
        //如果不存在缓存则读取数据库
        if(!$smarty->isCached('index.html',$cacheurl)){
            echo "no cache";
        }
        $smarty->display('index.html',$cacheurl); 
        
    }
    
    //二维码生成类
    function qrcode(){
        ob_start();
        ob_clean();
        spClass('QRcode')->img("http://www.speedphp.com"); // 手机扫描后会得到网址
        //spClass('QRcode')->img("http://www.speedphp.com", "文件路径.png"); // 会生成PNG图片文件
    }

    //xml解析类
    function xml(){
        $x=spClass('spXml');
        $x->name = "my";
        $x->age='11';
        echo $x->xml();
    }

    //zip操作类
    function zip(){
        $zip = spClass('spZip');
    }

    //http请求类
    function http(){
        $http = spClass('spHttp');
        //get方法
        echo $http->vget("http://www.baidu.com/");
        //post方法
        echo $http->vpost("https://www.baidu.com/s","wd=324");
    }


	
}