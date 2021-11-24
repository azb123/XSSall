<?php
 include('../lib/functions.php');

if(@$_GET["action"]==1)
{

 @set_time_limit(1000);
 
 $lockfile = "install.lock";
 $host="localhost";
 $user="root";
 $password="";
 $database="";
 $admin_name="";
 $admin_password="";
 $sysname="军锋真人CS野战在线预订系统";
 $copyright="www.jf-cs.com";
 $keyword="军锋真人CS野战|真人CS";
 $description="军锋真人CS野战";
 $author="www.jf-cs.com";
 $tmlap="";
 $jf_pass="no";

 
 if($_POST["host"]!=""){
  $host=$_POST["host"];
 }
 if($_POST["user"]!=""){
  $user=$_POST["user"];
 }
 if($_POST["password"]!=""){
  $password=$_POST["password"];
 }
 if($_POST["database"]!=""){
  $database=$_POST["database"];
 }

 if($_POST["admin_name"]!=""){
  $admin_name=$_POST["admin_name"];
 }
 if($_POST["admin_password"]!=""){
  $admin_password=$_POST["admin_password"];
 }
 if($_POST["sysname"]!=""){
  $sysname=$_POST["sysname"];
 }
 if($_POST["copyright"]!=""){
  $copyright=$_POST["copyright"];
 }
 if($_POST["keyword"]!=""){
  $keyword=$_POST["keyword"];
 }
if($_POST["description"]!=""){
  $description=$_POST["description"];
 }
 if($_POST["author"]!=""){
  $author=$_POST["author"];
 }
 if($_POST["tmlap"]!=""){
  $tmlap=$_POST["tmlap"]*24*60*60;
 }
 
 if(file_exists($lockfile)){
  exit("已经安装过了，如果要重新安装请先删除install/install.lock");
 }


 $conn=mysql_connect($host,$user,$password);
 if($conn){
  $sql_drop_database="DROP DATABASE IF EXISTS `".$database."`";
  $sql_create_database="CREATE DATABASE `".$database."`";
  $sql_create_table_jf_content="CREATE TABLE `jf_content` (
  `jf_id` int(11) NOT NULL auto_increment COMMENT 'id',
  `jf_area` varchar(20) NOT NULL COMMENT '场地',
  `jf_child` int(4) NOT NULL COMMENT '是否带小孩',
  `jf_pay` int(4) NOT NULL COMMENT '是否已支付',
  `jf_renshu` int(4) NOT NULL COMMENT '到场人数',
  `jf_comedate` date NOT NULL COMMENT '到场日期',
  `jf_user` varchar(10) NOT NULL COMMENT '联系人',
  `jf_pnum` varchar(14) NOT NULL COMMENT '联系电话',
  `jf_qq` varchar(14) NOT NULL COMMENT '联系QQ',
  `jf_note` text NOT NULL COMMENT '具体要求',
  `jf_ip` varchar(20) NOT NULL COMMENT 'ip地址',
  `jf_intime` int(10) unsigned NOT NULL COMMENT '提交时间',
  `jf_pass` varchar(4) NOT NULL COMMENT '是否审核通过',
  PRIMARY KEY  (`jf_id`)
  ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";
  
  $sql_insert_jf_content="INSERT INTO `jf_content` (`jf_id`, `jf_area`, `jf_child`, `jf_pay`, `jf_renshu`, `jf_comedate`, `jf_user`, `jf_pnum`, `jf_qq`, `jf_note`, `jf_ip`, `jf_intime`,`jf_pass`) VALUES
(1, '琅岐度假村', 0, 0, 234, '2011-10-11', '234', '234', '234', '', '127.0.0.1', 1317566924,'no')";
  
 

  if(mysql_query($sql_drop_database,$conn)){
   
   if(mysql_query($sql_create_database,$conn)){
    mysql_select_db($database,$conn);
	mysql_query("set names utf8;");
    if(mysql_query($sql_create_table_jf_content,$conn)){
	mysql_query($sql_insert_jf_content,$conn);
     $config_file="../config.php";
     $config_strings="<?php\n";
     $config_strings.="\$host=\"".$host."\";\n";
     $config_strings.="\$user=\"".$user."\";\n";
     $config_strings.="\$password=\"".$password."\";\n";
     $config_strings.="\$database=\"".$database."\";\n";
     $config_strings.="\$admin_name=\"".$admin_name."\";\n";
     $config_strings.="\$admin_password=\"".$admin_password."\";\n";
	 $config_strings.="\$sysname=\"".$sysname."\";\n";
	 $config_strings.="\$copyright=\"".$copyright."\";\n";
	 	 $config_strings.="\$keyword=\"".$keyword."\";\n";
		 	 $config_strings.="\$description=\"".$description."\";\n";
			 $config_strings.="\$author=\"".$author."\";\n";
			 $config_strings.="\$tmlap=\"".$tmlap."\";\n";			 
     $config_strings.="\$conn=mysql_connect(\$host,\$user,\$password);\n";
     $config_strings.="mysql_select_db(\$database,\$conn);\n";
     $config_strings.="?>";
     if($fp=fopen($config_file,"wb")){
      if(fwrite($fp,$config_strings)){
       if($fp2 = fopen($lockfile, 'w'))
       {
        fwrite($fp2,'null');
        fclose($fp2);
       }
       echo "安装成功！配置文件为：config.php，您可以手工修改该文件";
       echo "\n<a href='../admin.php'>进入系统管理后台</a>";
      }else{
       exit("文件写入失败");
      }
      fclose($fp);
     }
     
    }else{
     exit("不能执行CREATE TABLE语句：".$sql_create_table_jf_content);
    }
   }else{
    exit("不能执行CREATE DATABASE语句：".$sql_create_database);
   }
   
   
  }else{
   exit("不能执行DROP DATABASE语句：".$sql_drop_database);
  }
 }else{
  exit("连接数据库失败，请检查MySQL主机名、用户名和密码");
 }

}
?>