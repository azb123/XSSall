<?php
class lib_adminuser extends spModel
{
  var $pk = "id"; // 数据表的主键
  var $table = "adminuser"; // 数据表的名称
  
 	 /**
	 * 这里我们建立一个成员函数来进行用户登录验证
	 *
	 * @param uname    用户名
	 * @param upass    密码，请注意，本例中使用了加密输入框，所以这里的$upass是经过MD5加密的字符串。
	 */
	public function adminlogin($username, $password){ 
		$conditions = array(
			'username' => $username,
			'password' => $password, // 请注意，本例中使用了加密输入框，所以这里的$upass是经过MD5加密的字符串。
		);
		
		if( $result = $this->find($conditions) ){ 
			$_SESSION["admin"] = $result; // 在SESSION中记录当前管理员的信息
			return true;
		}else{
			// 找不到匹配记录，用户名或密码错误，返回false
			return false;
		}
	}		
		
}