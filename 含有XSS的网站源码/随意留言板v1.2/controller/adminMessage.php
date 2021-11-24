<?php
/***********************************************
 * SpeedPHP入口文件
 * 文件: /controller/adminMessage.php
 * 说明: 后台处理文件
 * 作者: huhuachuan
 * 更新: 2015年11月1日
 ***********************************************/

/**
 * 后台
 */
class adminMessage extends spController
{
	function __construct() { //全局
        parent::__construct();
			if(!$_SESSION["admin"]){$this->error("无权限访问，请先登录！", (spUrl("adminlogin")));}//访问权限判断信
	}
	/////////////////////////////////////////////////////////////////////////////////////////
	
	/**
	 * 留言本列表
	 */
	function ListMessage()
	{
		$this->title="留言列表";
		$gid = $this->spArgs('gid');
		$this->g = spClass("lib_guestbook")->find(array("id"=>$gid));
		$userGid = $_SESSION['admin']['gid'];
		$admin = $_SESSION['admin']['admin'];
		if($userGid == $gid || $admin == 'admin')
		{
			$lib_message = spClass("lib_message");
			$this->lists = $lib_message->spPager($this->spArgs("page",1),10)->findAll(array('gid'=>$gid),"addtime DESC");
			$pager=$lib_message->spPager()->getPager();
			//dump($pager);
			$this->pager=$pager;
			$this->c=$this->spArgs("c");
			$this->a=$this->spArgs("a"); 
			$this->display("admin/message/ListMessage.html");
		}
		else
		{
			$this->error("无权限，请返回！", (spUrl('adminGuestbook','ListGuestbook')));
		}
         
	}
	
	/**
	 * 管理员回复
	 */
	function reply()
	{
		$this->g = spClass("lib_guestbook")->find(array("id"=>$this->spArgs("gid")));
		$this->m = spClass("lib_message")->find(array("id"=>$this->spArgs("mid")));
		$this->display("admin/message/reply.html");
	}
	
	//管理员Ajax回复提交
	function AjaxReplyPost()
	{
		$id = $this->spArgs("mid");
		$replyAdmin = $_SESSION["admin"]['username'];
		$reply = $this->spArgs("reply");
		$status = $this->spArgs("status");
		if($this->spArgs("mid"))
		{
			$row = array(
						 'replyAdmin'=>$replyAdmin,
						 'reply'=>$reply,
						 'status'=>$status
						 );
			spClass("lib_message")->update(array("id"=>$id),$row);
            echo $reply;
        }
		else
		{
			echo 'no';
		}
	}
	
	/**
	 * 删除留言板
	 */
	function del(){
        $mold = $this->spArgs("mold");
		$v = $this->spArgs("v");
        spClass("lib_message")->delete(array($mold=>$v));
		$this->success("删除成功", ($_SERVER['HTTP_REFERER']));
	}
	
	
}