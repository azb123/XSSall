<?php
/***********************************************
 * 文件: /controller/adminUser.php
 * 说明: 管理员管理
 * 作者: huhuachuan
 * 更新: 2015年11月1日
 ***********************************************/

/**
 * 后台
 */
class Administrator extends spController
{
	function __construct() { //全局
        parent::__construct();
		if(!$_SESSION["admin"]){$this->error("无权限访问，请先登录！", (spUrl("adminlogin")));}
	}
	/////////////////////////////////////////////////////////////////////////////////////////
	
	/**
	 * 管理员列表
	 */
	function ListAdmin(){
		if(!$_SESSION["admin"]["admin"] == 'admin'){$this->error("无权限访问，请先登录！", (spUrl("adminlogin")));}
		$this->title="管理员列表";
        $lib_adminuser = spClass("lib_adminuser");
        $this->results = $lib_adminuser->spPager($this->spArgs("page",1),15)->findAll();
        $pager=$lib_adminuser->spPager()->getPager();
        $this->pager=$pager;
        $this->c=$this->spArgs("c");
        $this->a=$this->spArgs("a"); 
        $this->display("admin/adminuser/ListAdmin.html"); 
	}
	
	/**
	 * 添加管理员
	 */
	function add(){	
		if(!$_SESSION["admin"]["admin"] == 'admin'){$this->error("无权限访问，请先登录！", ($_SERVER['HTTP_REFERER']));}
		$this->title="添加管理员";
        $lib_adminuser = spClass("lib_adminuser");
		if ($this->spArgs("username")){
			$condition = array("username"=>$this->spArgs("username"));
			$result = $lib_adminuser->find($condition);
			if($result)
			{
				$this->error("用户名已被占用，请重新填写！", ($_SERVER['HTTP_REFERER']));
			}
			else
			{
				$newrow = array( // 这里制作新增记录的值
								'username' => $this->spArgs("username"),
								'password' => md5($this->spArgs("password")),
								'admin' => $this->spArgs("admin"),
								'gid' => $this->spArgs("gid",$_SESSION["admin"]["gid"])
								);
				$lib_adminuser->create($newrow);
				$this->success("添加管理员成功！", (spUrl("Administrator","ListAdmin")));
			}
		}
        $this->gList = spClass("lib_guestbook")->findAll(NULL,NULL,"id,gName");
		$this->display("admin/adminuser/add.html");
	}
	
	/**
	 * 编辑管理员
	 */
	function update(){
		$this->title="编辑管理员";
        $id = $this->spArgs("id");
		if($_SESSION["admin"]["gid"] == $id || $_SESSION["admin"]["admin"] == 'admin')
		{
			$lib_adminuser=spClass("lib_adminuser");
			$conditions=array("id"=>$id);
			$this->admins=$lib_adminuser->find($conditions);
			
			if ($this->spArgs("submit")){
				if($this->spArgs("pass_new")){
					$pass = md5($this->spArgs("pass_new"));
					}else{
						$pass = $this->spArgs("pass_old");
						}
				$newrow = array( // 这里是要修改的字段
						'username' => $this->spArgs("username"),
						'password' => $pass,
						'admin' => $this->spArgs("admin"),
						'gid' => $this->spArgs("gid",$_SESSION["admin"]["gid"])
						
						);
				$lib_adminuser->update($conditions,$newrow);
				//dump($newrow);
				$this->success("修改成功！", (spUrl("Administrator","update",array("id"=>$id))));
			}
			$this->gList = spClass("lib_guestbook")->findAll(NULL,NULL,"id,gName");
			$this->display("admin/adminuser/update.html");
		}
		else
		{
			$this->error("无权限访问，请先登录！", ($_SERVER['HTTP_REFERER']));
		}
		
	}
	
	/**
	 * 删除管理员
	 */
	function del(){
		if(!$_SESSION["admin"]["admin"] == 'admin'){$this->error("无权限访问，请先登录！", (spUrl("adminlogin")));}
        $lib_adminuser=spClass("lib_adminuser");
        $id=$this->spArgs("id");
        $conditions = array("id"=>$id); // 构造条件
        $lib_adminuser->delete($conditions);
		$this->success("删除成功", ($_SERVER['HTTP_REFERER']));
	}
	
}