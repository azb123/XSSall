<?php
/***********************************************
 * SpeedPHP入口文件
 * 文件: /controller/adminGuestbook.php
 * 说明: 后台处理文件
 * 作者: huhuachuan
 * 更新: 2015年11月1日
 ***********************************************/

/**
 * 后台
 */
class adminGuestbook extends spController
{
	function __construct() { //全局
        parent::__construct();
			if(!$_SESSION["admin"]){$this->error("无权限访问，请先登录！", (spUrl("adminlogin")));}//访问权限判断
	}
	/////////////////////////////////////////////////////////////////////////////////////////
	
	/**
	 * 留言本列表
	 */
	function ListGuestbook()
	{
		$this->title="留言板列表";
		$userGid = $_SESSION['admin']['gid'];
		$admin = $_SESSION['admin']['admin'];
		if($admin == 'admin'){
			$condition = NULL;
		}
		else{
			$condition = array('id'=>$userGid);
		}
        $lib_guestbook = spClass("lib_guestbook");
        $this->lists = $lib_guestbook->spPager($this->spArgs("page",1),20)->findAll($condition);
        $pager=$lib_guestbook->spPager()->getPager();
        //dump($pager);
        $this->pager=$pager;
        $this->c=$this->spArgs("c");
        $this->a=$this->spArgs("a"); 
        $this->display("admin/guestbook/ListGuestbook.html"); 
	}
	
	/**
	 * 添加留言板
	 */
	function add()
	{
		if($_SESSION["admin"]['admin'] != 'admin'){$this->error("无权限访问！", (spUrl("adminGuestbook","ListGuestbook")));}//访问权限判断
		if($this->spArgs("submit"))
		{
			$postData = $this->spArgs();
			spClass("lib_guestbook")->create($postData);
            $this->success("成功添加留言板！",(spUrl("adminGuestbook","ListGuestbook")));
        }
		//获取留言板模板目录
		$this->dirUrl = APP_PATH.'/tpl/guestbook/';
		$this->tplList = glob($this->dirUrl.'*',GLOB_ONLYDIR );
		$this->display("admin/guestbook/add.html");
	}
	
	/**
	 * 编辑留言板
	 */
	function update()
	{
		$userGid = $_SESSION['admin']['gid'];
		$admin = $_SESSION['admin']['admin'];
		$gid = $this->spArgs("id");
		if($admin == 'admin' || $gid == $userGid){
			$conditions = array("id"=>$gid );
			$lib_guestbook = spClass("lib_guestbook");
			$this->guestbook = $lib_guestbook->find($conditions);
			if($this->spArgs("submit"))
			{
				$lib_guestbook->update($conditions,$this->spArgs());
				$this->success("编辑成功！",(spUrl("adminGuestbook","ListGuestbook")));
			}
			//获取留言板模板目录
			$this->dirUrl = APP_PATH.'/tpl/guestbook/';
			$this->tplList = glob($this->dirUrl.'*',GLOB_ONLYDIR );
			$this->display("admin/guestbook/update.html");
		}
		else
		{
			$this->error("无权限访问！", (spUrl("adminGuestbook","ListGuestbook")));
		}
		
	}
	
	/**
	 * 删除留言板
	 */
	function del(){
        if($_SESSION['admin']['admin'] == 'admin')
		{
			$id = $this->spArgs("id");
			spClass("lib_guestbook")->delete(array("id"=>$id));
			$this->success("删除成功", ($_SERVER['HTTP_REFERER']));
		}
		else
		{
			$this->error("无权限操作！", (spUrl("adminGuestbook","ListGuestbook")));
		}
	}
	
	
}