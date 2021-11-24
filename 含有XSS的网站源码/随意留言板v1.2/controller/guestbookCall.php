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
class guestbookCall extends spController
{
	function __construct() { //全局
        parent::__construct();
		if(!$_SESSION["admin"]){$this->error("无权限访问，请先登录！", (spUrl("adminlogin")));}
	}
	/////////////////////////////////////////////////////////////////////////////////////////
	
	/**
	 * 留言板调用
	 */
	function ListGuestbookCall()
	{
		$this->title="留言调用";
		$gid = $this->spArgs("gid");
		$userGid = $_SESSION['admin']['gid'];
		$admin = $_SESSION['admin']['admin'];
		if($admin == 'admin')
		{
			$condition = NULL;
		}
		else{
			$condition = array('id'=>$userGid);
		}
        $lib_guestbook = spClass("lib_guestbook");
        $this->lists = $lib_guestbook->findAll($condition);
		
		if($gid)
		{
			$this->url = APP_URL;
			$this->guestbook = $lib_guestbook->find(array('id'=>$gid));
		}
		
 
        $this->display("admin/guestbookCall/ListGuestbookCall.html"); 
	}
	
	
	
}