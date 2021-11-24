<?php
//审核页面
//admin_pass.php
include("adminyz.php"); //包含验证文件
include_once("../config.php"); //包含文件
include('../lib/functions.php');
$id=$_GET["id"];  //ID 
$pass=$_GET["pass"]; //PASS

if($pass==""||$id==""){alert_back('错误！');}
if($pass=="no"){
$sql= "update  jf_content set jf_pass='yes' where jf_id='$id'";
mysql_query($sql);
echo "<script>location.href='admin.php?uid=3';</script>";
mysql_close();
exit;
}
if($pass=="yes"){
$sql= "update  jf_content set jf_pass='no' where jf_id='$id'";
mysql_query($sql);
echo "<script>location.href='admin.php?uid=3';</script>";
mysql_close();
exit;
}
?>