<?php 
include("../config.php"); //包含文件
if (!session_id()) session_start(); //要验证SESSION，看是不是管理员
if(@$_SESSION["admin"]!=$CONF['admin']['adname']){

	echo "<script>location.href='../';</script>";
	

    exit;
}
?>