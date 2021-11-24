<?php 


header ( "content-Type: text/html; charset=utf-8" );

include("config.php"); //包含文件
include('lib/functions.php');
$yanzheng=@$_POST["yanzheng"];
Session_start();

if($yanzheng != $_SESSION["Checknum"])
  alert_back('很抱歉，预约提交失败：验证码不正确！');

$area=@$_POST["area"];
$child=$_POST["child"];
$pay=$_POST["pay"];
$renshu=$_POST["renshu"];
$comedate=$_POST["comedate"];
$user=$_POST["user"];
$pnum=$_POST["pnum"];
$qq=$_POST["qq"];
$note=$_POST["note"];
$ip=@$_POST["ip"];
$tm=@$_POST["tm"];
$pass=$_POST["pass"];



mysql_query("SET NAMES '{$CONF['db']['charset']}'");

$query = "select jf_intime from jf_content where jf_ip='$ip' order by jf_intime desc limit 1";  


$conn=mysql_query($query) or die(mysql_error());
 if($rs=mysql_fetch_array($conn))
		{
		$cha=$tm-$rs["jf_intime"];
		if ($cha<$CONF['web']['tmlap'])
		{alert_back('很抱歉，不要重复提交，谢谢！');}
else
{
$sql="insert into jf_content(jf_area,jf_child,jf_pay,jf_renshu,jf_comedate,jf_user,jf_pnum,jf_qq,jf_note,jf_ip,jf_intime,jf_pass) values('$area','$child','$pay','$renshu','$comedate','$user','$pnum','$qq','$note','$ip','$tm','$pass') ";

mysql_query($sql) or die(mysql_error());
echo ("<script type='text/javascript'> alert('提交成功，我们将尽快为您安排场地');location.href='index.php';</script>");
mysql_close();
exit;

}
	}else{$sql="insert into jf_content(jf_area,jf_child,jf_pay,jf_renshu,jf_comedate,jf_user,jf_pnum,jf_qq,jf_note,jf_ip,jf_intime,jf_pass) values('$area','$child','$pay','$renshu','$comedate','$user','$pnum','$qq','$note','$ip','$tm','$pass') ";

mysql_query($sql) or die(mysql_error());
echo ("<script type='text/javascript'> alert('提交成功，我们将尽快为您安排场地');location.href='index.php';</script>");
mysql_close();
exit;}

?>