<?php

include('../lib/functions.php');
include('../lib/common.class.php');
include("adminyz.php"); //包含验证文件
include_once("../config.php"); //包含文件

$uid = isset($_REQUEST['uid']) ? intval($_REQUEST['uid']) : 1;
@$sid=$_REQUEST['sid'];
switch ($sid)
	{
	case '1':/*-----------系统设置---------*/
	{

	$config = file_get_contents("../config.php");
$config = preg_replace("/'title'=>'(.*?)',/", "'title'=>'{$_POST['title']}',", $config);
$config =preg_replace("/'keyword'=>'(.*?)',/", "'keyword'=>'{$_POST['keywords']}',", $config);
$config =preg_replace("/'description'=>'(.*?)',/", "'description'=>'{$_POST['description']}',", $config);
$config =preg_replace("/'copyright'=>'(.*?)',/", "'copyright'=>'{$_POST['copyright']}',", $config);
		
			
			if(!common::saveFile("../config.php", $config))
			{
				common::alert("写入config.php失败！");
			}
			
$url = "?uid=1"; 
echo "<script language='javascript' type='text/javascript'>"; 
echo "window.location.href='$url'"; 
echo "</script>"; 

			
	}
	
	
	case '2':/*-----------密码修改---------*/
	{

	
$userpws=authcode($CONF['admin']['adpws'],'DECODE','$password_key','0');

if( empty($_POST['newpw'])|| empty($_POST['newpw1']))
			{
				common::alert("对不起，新密码不能为空！");
			}

if($_POST['oldpw']!=$userpws){
	alert_back('旧密码错误！');
}
			
			if($_POST['newpw']!=$_POST['newpw1']){
	alert_back('两次密码输入不相符！');
}
if($_POST['oldpw']==$userpws&&$_POST['newpw']==$_POST['newpw1'])
{
$newpw=authcode($_POST['newpw'],'','$password_key','0');
	$config = file_get_contents("../config.php");
			
$config = preg_replace("/'adpws'	=>	'(.*?)',/", "'adpws'	=>	'{$newpw}',", $config);
			if(!common::saveFile("../config.php", $config))
			{
				common::alert("写入config.php失败！");
			}
}
		
$url = "?uid=2"; 
echo "<script language='javascript' type='text/javascript'>"; 
echo "window.location.href='$url'"; 
echo "</script>";		
	}
	
	
}



mysql_query("SET NAMES '{$CONF['db']['charset']}'");



$pagesize=4;//设定每一页显示的记录数
$sql="select count(*) from jf_content";//取得记录总数
$conn=mysql_query($sql) or die(mysql_error());

$result=mysql_fetch_array($conn);
$numrows=$result[0];

$pages=intval($numrows/$pagesize);//计算总页数
if ($numrows%$pagesize) $pages++;//判断页数设置



if(isset($_GET['page'])){$page=intval($_GET['page']);
}else {$page=1;}

if (isset($_POST['ys'])){
if ($_POST['ys']>$pages)
$page=$pages;
else
$page=$_POST['ys'];}

//计算记录偏移量
$offset=$pagesize*($page-1);


//读取指定记录数
$res=mysql_query("select * from jf_content order by jf_id desc limit $offset,$pagesize");


while($rs=mysql_fetch_array($res)){ 
$result_array[]=$rs;

  }
if(!isset($result_array)){$nodata="无数据";}


 $first=1;
$prev=$page-1;
$next=$page+1;
$last=$pages;


  



  $tpl->assign(array(
"title" => $CONF['web']['title'], 
"ROOT_ADMIN_PATH" => $ROOT_ADMIN_PATH,
"copyright"=>$CONF['web']['copyright'],
"keywords"=>$CONF['web']['keyword'],
"description"=>$CONF['web']['description'],
"ROOT_PATH"=>$ROOT_PATH,

"admin"=>$CONF['admin']['adname'],
"uid"=>$uid,
"page"=>$page,
"pages"=>$pages,
"first"=>$first,
"prev"=>$prev,
"last"=>$last,
"next"=>$next,
"numrows"=>$numrows,
"result_array"=>@$result_array,
"nodata"=>@$nodata

));

$tpl->display('admin.html');

?>