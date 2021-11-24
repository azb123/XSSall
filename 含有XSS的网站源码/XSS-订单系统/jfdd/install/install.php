<?php
include('../lib/functions.php');
$step = isset($_REQUEST['step']) ? intval($_REQUEST['step']) : 0;
include("../config.php");
include('../lib/common.class.php');


 if(file_exists($CONF['web']['lockfile'])){
  exit("已经安装过了，如果要重新安装请先删除install/install.lock");
 }
?>
<html>
<head>
<title>军锋真人CS野战在线预订系统安装程序<?php echo $CONF['web']['verMsg']; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style>
.body {
font-family: Arial,  Helvetica, sans-serif;
font-size:12px;
color:#666666;
background:#fff;
text-align:center;

}

.a {
color:#1E7ACE;
text-decoration:none;  
}
a:hover  {
color:#000;
text-decoration:underline;
}


* {
margin:0;
padding:0;
}

.h3 {
font-size:14px;
font-weight:bold;
}
input, select,textarea {
padding:1px;
margin:2px;
font-size:11px;
}
#formwrapper {
width:800px;
margin:15px  auto;
padding:20px;
text-align:left;
border:1px #1E7ACE solid;
}


.fieldset {
padding:10px;
margin-top:5px;
border:1px solid #1E7ACE;
background:#fff;
}


.fieldset legend  {
color:#1E7ACE;
font-weight:bold;
padding:3px  20px 3px 20px;
border:1px solid #1E7ACE;  
background:#fff;
}


.fieldset label {
float:left;
width:750px;
text-align:left;
padding:4px;
margin:1px;
}


.fieldset div {
clear:left;
margin-bottom:2px;
}
#head{

	width:800px;
	height:80px;
	line-height:80px;
	color:black;
	font-size:24px;
}

#nav {width:815px;}
#nav ul{list-style:none}
#nav li{width:20%;float:left;line-height:30px;background-color:#0065B5;color:#fff}
#nav .select{background-color:#A0B9CD;}


</style>
</head>
<body>
<div id="head"> 军锋真人CS野战在线预订系统安装程序<?php echo $CONF['web']['verMsg']; ?></div>
<div id="nav">
	<ul>
		<li <?php if($step == 0){ echo "class='select'";}?>>第一步</li>
		<li <?php if($step == 1){ echo "class='select'";}?>>第二步</li>
		<li <?php if($step == 2||$step==5){ echo "class='select'";}?>>第三步</li>
		<li <?php if($step == 3){ echo "class='select'";}?>>第四步</li>
		<li <?php if($step == 4){ echo "class='select'";}?>>完成安装</li>
	
	</ul>
</div>





<div >
<?php 

switch ($step)
	{
	case '0':/*------------------------
使用协议书
------------------------*/
	{
	include('./templates/step-1.html');
	exit();
	}
	
	case '1':/*------------------------
环境检查
------------------------*/
	{
	include('./templates/step-2.html');
	exit();
	}
	case '2':/*------------------------
配置数据库
------------------------*/
	{
	include('./templates/step-3.html');
	exit();
	}
	
	case '3':/*------------------------
设置管理员
------------------------*/
	{
	include('./templates/step-4.html');
	exit();
	}
	case '4':/*------------------------
完成安装
------------------------*/
	{
	if(empty($_POST['username']) || empty($_POST['userpws'])|| empty($_POST['userkey']))
			{
				common::alert("对不起，用户名、密码、密码密钥不能为空！");
			}
			$password_key=md5($_POST['userkey'].$_POST['userpws']);
			
			$userpws=authcode($_POST['userpws'],'','$password_key','0');
	$config = file_get_contents("../config.php");
			$config = preg_replace("/'adname'	=>	'(.*?)',/", "'adname'	=>	'{$_POST['username']}',", $config);
			$config = preg_replace("/'adpws'	=>	'(.*?)',/", "'adpws'	=>	'{$userpws}',", $config);
			$config = preg_replace("/'password_key'	=>	'(.*?)',/", "'password_key'	=>	'{$password_key}',", $config);
			if(!common::saveFile("../config.php", $config))
			{
				common::alert("写入config.php失败！");
			}
			
			 
	elseif($fp2 = fopen($CONF['web']['lockfile'], 'w')){
        fwrite($fp2,'null');
        fclose($fp2);
       }
	echo '<div id="formwrapper"><fieldset>';
			echo " <legend><span >恭喜，安装成功！</legend></span >";
			
			
				
					echo "   <label ><font color=black>为了安全起见，建议您手动改变后台管理目录名称！</font>   </label >";
				
		echo "
			
			<div class=\"btn-box\"><input type='button' name='b1' value='进入后台控制面板' onclick=\"window.location='../admin/login.php'\"></div>";
			
		
		
			echo "</fieldset></div>";
			break;
	}
case '5':/*------------------------
导入数据库
------------------------*/
	{
	//测试数据库链接
			$db = @mysql_connect($_POST['host'], $_POST['user'], $_POST['password']) or die(common::alert("对不起，无法链接数据库"));
			$sql_drop_database="DROP DATABASE IF EXISTS `".$_POST['database']."`";
			mysql_query($sql_drop_database,$db);
			if(!mysql_select_db($_POST['database'],$db))
			{
				@mysql_query("CREATE DATABASE `{$_POST['database']
				}` DEFAULT CHARACTER SET {$_POST['charset']}") or die(common::alert("对不起，{$_POST['database']}不存在"));
				mysql_select_db($_POST['database']);
			}
		
			mysql_query("SET NAMES '{$_POST['charset']}'");
			
//写入配置文件
			$config = file_get_contents("../config.php");
			$config = preg_replace("/'host'	=>	'(.*?)',/", "'host'	=>	'{$_POST['host']}',", $config);
			$config = preg_replace("/'user'	=>	'(.*?)',/", "'user'	=>	'{$_POST['user']}',", $config);
			$config = preg_replace("/'psw'	=>	'(.*?)',/", "'psw'	=>	'{$_POST['password']}',", $config);
			$config = preg_replace("/'name'	=>	'(.*?)',/", "'name'	=>	'{$_POST['database']}',", $config);
			$config = preg_replace("/'prefix'	=>	'(.*?)',/", "'prefix'	=>	'{$_POST['prefix']}',", $config);
			$config = preg_replace("/'charset'	=>	'(.*?)',/", "'charset'	=>	'{$_POST['charset']}',", $config);
			if(!common::saveFile("../config.php", $config))
			{
				common::alert("写入config.php失败！");
			}
			$sql = file_get_contents("./install.sql");
			$sql = str_replace("##prefix##", $_POST['prefix'], $sql);
			$sql = str_replace("##charset##", $_POST['charset'], $sql);
			$sql = str_replace(array("\r","\n\n",";\n"),array('',"\n",";<junfeng>\n"),trim($sql," \n"));
			$sql_array = explode("\n", $sql);
						function createSql($sql)
{
	$new_sql = array();
	$i = 0;
	foreach($sql as $v)
	{
		@$new_sql[$i] .= $v;
		if (substr($v,-11)==';<junfeng>') {
			$new_sql[$i] = str_replace(';<junfeng>', '', $new_sql[$i]);
			$i++;
		}		
	}
	return $new_sql;
}
			$sql_new = createSql($sql_array);

			
			echo '<div id="formwrapper"><fieldset>';
			echo " <legend><span >导入数据库 </legend></span >";
			$must = 1;
			foreach($sql_new as $v)
			{
				if(mysql_query($v))
				{
					echo "   <label ><font color=black>数据库语句".common::substring($v, 40)."...执行成功</font>   </label >";
				}
				else
				{
					echo "   <label ><font color='red'>数据库语句{$v}执行失败</font>   </label >";
					$must = 0;
				}
			}
			echo "
			
			<div class=\"btn-box\"><input type='button' name='b1' value='下一步：设置管理员' onclick=\"window.location='install.php?step=3'\"";
			if($must == 0){ echo " disabled"; }
			echo "></div>";
			echo "</fieldset></div>";
			break;

	
	}
	
	
	
	
	}

?>
</div>
