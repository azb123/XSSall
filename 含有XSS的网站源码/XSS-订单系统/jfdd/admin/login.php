<?php




include("../config.php"); //包含文件
include('../lib/functions.php');
header ( "content-Type: text/html; charset=utf-8" );



$tpl->assign(array(
"title" => $CONF['web']['title'], 
"ROOT_ADMIN_PATH" => $ROOT_ADMIN_PATH,
"copyright"=>$CONF['web']['copyright'],
"keywords"=>$CONF['web']['keyword'],
"description"=>$CONF['web']['description'],
"time_now"=>date("Y-m-d H:i:s"),
"ROOT_PATH"=>$ROOT_PATH,

));


$tpl->display('login.html');

// 输出模板



// 登陆参数判断
if(@$_POST["admin_name"]){
// 判断session是否已存在
if (!session_id()) session_start();
$yanzheng=@$_POST["yanzheng"];



if($yanzheng != $_SESSION["Checknum"])
  alert_back('验证码不正确！');
  if(empty($_POST["admin_name"])){
	alert_back('用户名不能为空！');
}
if(empty($_POST["admin_password"])){
	alert_back('密码不能为空！');
}
$userpws=authcode($CONF['admin']['adpws'],'DECODE','$password_key','0');

if($_POST["admin_name"]==$CONF['admin']['adname'] and $_POST["admin_password"]==$userpws){
	if (!session_id()) session_start();

	$_SESSION["admin"]="{$CONF['admin']['adname']}";
	echo "<script>location.href='admin.php';</script>";
}
else{
alert_back('用户名或密码不正确！');
}




}
?>