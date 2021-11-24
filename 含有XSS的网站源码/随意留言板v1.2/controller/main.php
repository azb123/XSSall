<?php
/***********************************************
 *		SpeedPHP入口文件
 * 文件: /controller/main.php
 * 说明: SpeedPHP入口文件
 * 作者: huhuachuan
 * 更新: 2015年10月29日
 ***********************************************/

/**
 * SpeedPHP入口文件
 */
class main extends spController
{
	/**
	 * 首页
	 */
	function index(){
		echo "HuHuaChuan's Api! ";
	}
	
	/**
	 * 验证码
	 */
	function verifyCode(){
        $vcode = spClass('spVerifyCode');
        $vcode->display();
    }
	
	/**
	 * Js调用留言板
	 */
	function jsMessage(){
        $gid = $this->spArgs("gid");
		$gurl = APP_URL."/index.php?c=guestbook&a=jsMessage&gid=$gid";
		$jsStr = @file_get_contents($gurl);
		$jsStr = str_replace('"', '\"', $jsStr);
		$jsArr = array();
		$jsArr = split("\r|\n", $jsStr);
		$jsContent = '';
		foreach($jsArr AS $val) {
			if($val) {
				$jsContent .= "document.writeln(\"".$val."\");\n";
			}
		}
		echo $jsContent;
		
		
    }
	
	/**
	 * 安全退出
	 */
	function logout(){
		unset($_SESSION['admin']);
        session_destroy();
		$this->success("已安全退出！", (spUrl("guestbook","index")));
	}
	
	
}