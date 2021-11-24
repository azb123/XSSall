<?php
/***********************************************
 * 文件: /controller/guestbook.php
 * 说明: 前台留言板
 * 作者: huhuachuan
 * 更新: 2015年11月1日
 ***********************************************/

/**
 * 后台
 */
class guestbook extends spController
{
	function __construct() { //全局
        parent::__construct();
		$jumpGb = spClass("lib_guestbook")->find(NULL,"id ASC","id");
		$this->JumpId = $jumpGb['id'];
	}
	/////////////////////////////////////////////////////////////////////////////////////////
	
	/**
	 * 留言板
	 */
	function index()
	{
		$id = $this->spArgs("id",$this->JumpId);
		$this->g = $g = spClass("lib_guestbook")->find(array("id"=>$id));
		if($g)
		{
			$this->template = 'tpl/guestbook/'.$g['gTpl'];
			$this->ip = getIP();
			$lib_message = spClass("lib_message");
			$this->message = $lib_message->spPager($this->spArgs("page",1),$g['gPag'])->findAll(array('gid'=>$id,'status'=>'yes'),"id DESC,good DESC");
			$pager=$lib_message->spPager()->getPager();
			$this->pager=$pager;
			$this->c=$this->spArgs("c");
			$this->a=$this->spArgs("a"); 
			$this->display("guestbook/".$g['gTpl']."/index.html");
		}
		else
		{
			$this->error("抱歉，没有这个留言板！", (spUrl('guestbook')));
		}
		
	}
	
	/**
	 * 添加留言
	 */
	function megAddPost()
	{
		$gid = $this->spArgs("gid");
		$ip = getIP();
		$g = spClass("lib_guestbook")->find(array("id"=>$gid),NULL,"gFilter,gCheck");
		if($g['gCheck'] == 'yes')
		{
			$megTitle = '留言提交成功！我们会尽快审核……';
			$status = 'no';
		}
		elseif($g['gCheck'] == 'no')
		{
			$megTitle = '留言提交成功！';
			$status = 'yes';
		}
		
		if($this->spArgs("submit"))
		{
			$vcode = spClass('spVerifyCode');
			if($vcode->verify($this->spArgs('verifycode'))) {
			  $postData = array(
							'gid'=>$gid,
							'name'=>strip_tags($this->spArgs("name")),
							'qq'=>strip_tags($this->spArgs("qq")),
							'message'=>$this->spArgs("message"),
							'addtime'=>time(),
							'ip'=>$ip,
							'status'=>$status
							);
							//dump($postData);
				setcookie("valueName", $postData['name'], time()+3600*24);
				setcookie("valueQq", $postData['qq'], time()+3600*24);
			  if($g['gFilter'] == 'yes')
			  {
				  if(isValidData($this->spArgs("message")))
				  {
					  spClass("lib_message")->create($postData);
					  $this->success($megTitle,($_SERVER['HTTP_REFERER']));
				  }
				  else
				  {
					  $this->error("内容不合法，可能原因：广告信息、内容过简单，请重新输入！", ($_SERVER['HTTP_REFERER'].'#MegAddForm'),5);
				  }
			  }
			  elseif($g['gFilter'] == 'no')
			  {
				  spClass("lib_message")->create($postData);
				  $this->success($megTitle,($_SERVER['HTTP_REFERER']));
			  }
			  else
			  {
				  $this->error("参数错误！", ($_SERVER['HTTP_REFERER'].'#MegAddForm'));
			  }
			}
			else
			{
				$this->error("验证码错误，请重新填写！", ($_SERVER['HTTP_REFERER'].'#MegAddForm'));
			}
		}
	}
	
	/**
	 * Ajax赞一下
	 */
	function AjaxGood()
	{
		$mid = $this->spArgs("mid");
		$ip = getIP();
		$lib_voteip = spClass("lib_voteip");
		if($lib_voteip->find(array("mid"=>$mid,"ip"=>$ip)))
		{
			echo '抱歉，您已经支持过TA了！';
		}
		else
		{
			spClass('lib_message')->incrField(array('id'=>$mid), 'good');
			$lib_voteip->create(array('mid'=>$mid,'ip'=>$ip,'addtime'=>time()));
			echo '谢谢您的支持！';
		}
	}
	
	/**
	 * JS调用专版
	 */
	function jsMessage()
	{
		$id = $this->spArgs("gid",$this->JumpId);
		$lib_guestbook = spClass("lib_guestbook");
		$this->g = spClass("lib_guestbook")->find(array("id"=>$id));
		$this->url = APP_URL;
		$this->template = 'tpl/jsMessage';
		
		$lib_message = spClass("lib_message");
        $this->message = $lib_message->spPager($this->spArgs("page",1),20)->findAll(array('gid'=>$id,'status'=>'yes'),"addtime DESC");
        $pager=$lib_message->spPager()->getPager();
        //dump($pager);
        $this->pager=$pager;
        $this->c=$this->spArgs("c");
        $this->a=$this->spArgs("a"); 
		if($this->g)
		{
			$this->display("jsMessage/index.html");
		}
		else
		{
			$this->display("jsMessage/notId.html");
		}
		
	}
	
	
	
}