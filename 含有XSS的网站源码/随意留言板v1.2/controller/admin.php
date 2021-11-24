<?php
/***********************************************
 * SpeedPHP入口文件
 * 文件: /controller/admin.php
 * 说明: 后台处理文件
 * 作者: huhuachuan
 * 更新: 2015年06月06日
 ***********************************************/

/**
 * 后台
 */
class admin extends spController
{
	function __construct() { //全局
        parent::__construct();
			if(!$_SESSION["admin"]){$this->error("警告：无权限访问，请先登录！", (spUrl("adminlogin")));}//访问权限判断信
	}
	/////////////////////////////////////////////////////////////////////////////////////////
	
	
	function index()
	{
		$this->url = spUrl("admin","menu");
		$this->display("admin/index/index.html");
	}
	
	function menu()
	{	
		$this->fenlei=$this->spArgs("fenlei");
		$this->display("admin/index/menu.html");
	}
	
	function top()
	{
		$this->display("admin/index/top.html");
	}
	
	function content()
	{
		//探针信息发送到后台首页
		$CookieYes = isset($_COOKIE)?'<font color="green">√</font>' : '<font color="red">×</font>';
		$wuliurl = $_SERVER['DOCUMENT_ROOT']?str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']):str_replace('\\','/',dirname(__FILE__));
		$this->fuwuqi = array(
			"phpv"=>PHP_VERSION,
			"yxfs"=>strtoupper(php_sapi_name()),
			"memory_limit"=>$this->show("memory_limit"),
			"max_execution_time"=>$this->show("max_execution_time"),
			"curl_init"=>$this->isfun("curl_init"),
			"session_start"=>$this->isfun("session_start"),
			"CookieYes"=>$CookieYes,
			"ftp_login"=>$this->isfun("ftp_login"),
			"upload_max_filesize"=>$this->show("upload_max_filesize"),
			"url"=>$_SERVER['SERVER_NAME'],
			"wuliurl"=>$wuliurl
		);
		//励志短语接口
		//$this->contents = $this->PhraseApi();
		$this->display("admin/index/content.html");
	}
	
	/**
	 * 检测PHP设置参数
	 */
	function show($varName)
	{
		switch($result = get_cfg_var($varName))
		{
			case 0:
				return '<font color="red">×</font>';
			break;
			case 1:
				return '<font color="green">√</font>';
			break;
			default:
				return $result;
			break;
		}
	}
	
	/**
	 * 检测函数支持
	 */
	function isfun($funName = '')
	{
		if (!$funName || trim($funName) == '' || preg_match('~[^a-z0-9\_]+~i', $funName, $tmp)) return '错误';
		return (false !== function_exists($funName)) ? '<font color="green">√</font>' : '<font color="red">×</font>';
	}
	
	/**
	 * 经典语录API
	 */
	function PhraseApi()
	{
		$api = base64_decode('aHR0cDovL2FwaS5sb2dwaHAuY29tL2luZGV4LnBocD9jPVBocmFzZUFwaSZhPXBocGFwaSZ0eXBlaWQ9MQ==');
		if(file_get_contents($api))
		{
			return file_get_contents($api);
		}
		else
		{
			return '接口错误，未获取到数据！';
		}
	}
	
}