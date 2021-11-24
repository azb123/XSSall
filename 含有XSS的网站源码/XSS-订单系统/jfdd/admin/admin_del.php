<?php
//删除处理页面
//admin_del.php
include("adminyz.php"); //包含验证文件
include_once("../config.php"); //包含文件
include('../lib/functions.php');

$id = $_GET["id"];
if($id==""){alert_back('错误！');}


$sql= "delete from jf_content where jf_id='$id'";
mysql_query($sql) or die(mysql_error());
echo("<script type='text/javascript'> alert('删除成功！');location.href='admin.php?uid=3';</script>");
mysql_close();


?>