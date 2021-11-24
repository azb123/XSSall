<?php
/*
 * 随意留言板安装程序
 */
 header("Content-Type: text/html;charset=utf-8");
 $files="../config.php";

 if(!is_writable($files)){				//判断文件是否可写
 	$s = "<font color=red>不可写，无法进行安装，请确保根目录config.php文件可写</font>";
 }else{
 	$s = "<font color=green>可写，可执行安装！</font>";
 }

 if(isset($_POST['install'])){		//把信息导入config配置文件
 	$config_str="<?php";
 	$config_str.="\n";
 	$config_str.="\$host='".$_POST[host]."';";
  	$config_str.="\n";
 	$config_str.="\$login='".$_POST[login]."';";
 	$config_str.="\n";
 	$config_str.="\$password='".$_POST[password]."';";
 	$config_str.="\n";
 	$config_str.="\$database='".$_POST[database]."';";
  	$config_str.="\n";
 	$config_str.="\$prefix='".$_POST[prefix]."';";
 	$config_str.="\n";
 	$config_str.="?>";

 	$ff=fopen($files,"w+");
 	fwrite($ff,$config_str);

include("../config.php");			//导入配置文件
if(!@$link=mysql_connect($host,$login,$password)){		//检查链接情况
	$s2 =  "数据库链接失败!请检查链接参数!";
}else{
	mysql_query("create database $database");	//创建数据库
	mysql_query("set names 'utf8'");
	mysql_select_db($database);				//链接数据库
$mysql_db_tag=$_POST[prefix];
$sql_query[]="CREATE TABLE `".$mysql_db_tag."adminuser` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) DEFAULT NULL COMMENT '帐号',
  `password` varchar(32) DEFAULT NULL COMMENT '密码',
  `admin` varchar(5) DEFAULT 'user' COMMENT '管理级别',
  `gid` int(8) DEFAULT '0' COMMENT '绑定留言本ID',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;";
$sql_query[]="insert  into `".$mysql_db_tag."adminuser`(`id`,`username`,`password`,`admin`,`gid`) values (1,'admin','7fef6171469e80d32c0559f88b377245','admin',0);";

$sql_query[]="CREATE TABLE `".$mysql_db_tag."guestbook` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `gName` varchar(100) NOT NULL COMMENT '名称',
  `gLogo` varchar(100) DEFAULT 'tpl/guestbook/default/images/logo.jpg',
  `gIntroduction` text COMMENT '介绍',
  `gBanner` varchar(100) DEFAULT 'tpl/images/notlogo.jpg' COMMENT 'banner',
  `gTpl` varchar(30) DEFAULT 'default' COMMENT '模版',
  `gPag` int(5) DEFAULT '8' COMMENT '每页留言数',
  `gKeywords` varchar(160) DEFAULT NULL COMMENT '关键字',
  `gDescription` varchar(500) DEFAULT NULL COMMENT '简介',
  `gCheck` varchar(3) DEFAULT 'no' COMMENT '是否需要审核',
  `gDisplay` varchar(3) DEFAULT 'yes' COMMENT '是否显示留言列表',
  `gFilter` varchar(3) DEFAULT 'no' COMMENT '是否安全过滤留言',
  `gTongji` varchar(300) DEFAULT NULL COMMENT '统计代码',
  `gBeian` varchar(30) DEFAULT NULL COMMENT '备案',
  `gPowerby` varchar(100) DEFAULT NULL COMMENT '版权',
  `gNav` varchar(500) DEFAULT NULL COMMENT '自定义导航',
  `gHead` varchar(6) DEFAULT 'qqshow' COMMENT '调用头像类型',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;";

$sql_query[]="insert  into `".$mysql_db_tag."guestbook`(`id`,`gName`,`gLogo`,`gIntroduction`,`gBanner`,`gTpl`,`gPag`,`gKeywords`,`gDescription`,`gCheck`,`gDisplay`,`gFilter`,`gTongji`,`gBeian`,`gPowerby`,`gNav`,`gHead`) values (1,'PHP开源多功能留言板-随意留言板官方站','tpl/guestbook/default/images/logo.jpg','<p>\r\n	<span style=\"color:#E53333;\"><strong>很早之前做了一半，</strong></span><span style=\"color:#E53333;\"><strong>我也是拿留言板开始练手的。最近清理电脑翻出来的，花了点时间继续做完了，也是第一个发布的程序。</strong></span> \r\n</p>\r\n<p>\r\n	<strong>特点：</strong> \r\n</p>\r\n<p>\r\n	1、SpeedPHP框架驱动，高效轻快。\r\n</p>\r\n<p>\r\n	2、可创建多个留言板；每个留言板都能设置不同的模板；<span>每个留言板都能设置单独管理员；</span> \r\n</p>\r\n<p>\r\n	3、模板、程序分离，尽量标签化，可快速自制模板（懂一点前台技术就能自己做模板）。内置两套模板一个默认模板一个响应式模板（后期有时间会发布新模板）\r\n</p>\r\n<p>\r\n	4、每个留言板都能调用。支持IFRAME调用和JS调用。\r\n</p>\r\n<p>\r\n	<span>5、每个留言板支持自定义导航、自定义LOGO图片、Banner图片、SEO优化</span> \r\n</p>\r\n<p>\r\n	6、更多特色自行挖掘\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	<strong><span style=\"font-family:\'Microsoft YaHei\';font-size:14px;\">如果有需求的话会一直更新下去，将留言板做到极致！</span></strong> \r\n</p>\r\n<p>\r\n	<strong><span style=\"font-family:\'Microsoft YaHei\';font-size:14px;\">有问题可直接在下面留言 或 QQ：1030040075（工作时间不回）</span></strong> \r\n</p>\r\n','tpl/guestbook/default/images/gBanner.jpg','default',8,'PHP留言板,多功能留言板,可调用的留言板,留言板程序','PHP多功能开源留言板，随意留言板，将留言板做到极致！','no','yes','yes','站站统计','鄂ICP备15001104号-1','Copyright © 2015 syguestbook.logphp.com 随意留言板','响应式演示|/index.php?c=guestbook&a=index&id=2\r\n留言板2演示|/index.php?c=guestbook&a=index&id=3','qqhead'),(2,'响应式演示','tpl/images/notlogo.jpg','很简单的响应式演示','tpl/images/notlogo.jpg','simple',8,'','','yes','yes','yes','','','','','qqhead'),(3,'留言板2演示','','可创建多个留言板','','default',8,'','','yes','yes','yes','站长统计','鄂ICP备15001104号-1','Copyright © 2015 sy.logphp.com 随意留言板','','qqshow');";

$sql_query[]="CREATE TABLE `".$mysql_db_tag."message` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `gid` int(8) DEFAULT NULL COMMENT '留言本ID',
  `name` varchar(30) DEFAULT NULL COMMENT '姓名',
  `qq` varchar(15) DEFAULT NULL COMMENT 'QQ',
  `message` text COMMENT '留言内容',
  `reply` text COMMENT '回复',
  `replyAdmin` varchar(30) DEFAULT NULL COMMENT '回复管理员',
  `addtime` varchar(13) DEFAULT NULL COMMENT '留言时间',
  `ip` varchar(15) DEFAULT NULL COMMENT 'IP',
  `address` varchar(50) DEFAULT NULL COMMENT '解析的地址',
  `good` int(8) DEFAULT '0' COMMENT '赞',
  `status` varchar(3) DEFAULT 'yes' COMMENT '审核状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;";

$sql_query[]="insert  into `".$mysql_db_tag."message`(`id`,`gid`,`name`,`qq`,`message`,`reply`,`replyAdmin`,`addtime`,`ip`,`address`,`good`,`status`) values (1,1,'随意留言板','1030040075','第一条留言！',NULL,NULL,'1447433541','183.92.138.25','湖北孝感',0,'yes'),(2,1,'熊妹子','1030040075','第二条留言！',NULL,NULL,'1447433576','183.92.138.25','湖北孝感',0,'yes'),(3,2,'随意留言板','1030040075','请用手机浏览','','admin','1447433817','183.92.138.25','湖北孝感',0,'yes');";

$sql_query[]="CREATE TABLE `".$mysql_db_tag."voteip` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `mid` int(8) NOT NULL COMMENT '留言ID',
  `ip` varchar(15) NOT NULL COMMENT '赞一下IP',
  `addtime` varchar(13) NOT NULL COMMENT '赞一下时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;";

 foreach($sql_query as $val){
 	mysql_query($val);
 }
 echo"<script>alert('安装成功!默认管理员帐号：admin 密码：admin888');document.location.href='../index.php?c=adminlogin';</script>";
 rename("install.php","install.lock");
}
  }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>随意留言板安装程序</title>
<link href="../tpl/admin/css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../tpl/admin/css/jquery.min.js"></script>
<link href="../tpl/admin/css/Bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../tpl/admin/css/Bootstrap/js/bootstrap.min.js"></script>
<style>
.wrapper{border:#CCC 1px solid; width:600px; margin:20px auto; padding:20px 30px; background-color:#FFF;border-radius:5px;}
</style>
</head>

<body style="background-color:#F5F5F5">
<form action="" method="post" >
<div class="wrapper">
<h3>随意留言板安装程序</h3>
<hr />
<h5>配置文件：<?=$s?></h5>
<hr />
<div class="form-group">
  <label for="exampleInputEmail1">主机地址：</label>
  <input type="text" class="form-control" id="host" name="host" value="localhost">
</div>

<div class="form-group">
  <label for="exampleInputEmail1">用户名：</label>
  <input type="text" class="form-control" id="login" name="login" value="root">
</div>

<div class="form-group">
  <label for="exampleInputEmail1">密码：</label>
  <input type="text" class="form-control" id="password" name="password" value="">
</div>

<div class="form-group">
  <label for="exampleInputEmail1">数据库名：</label>
  <input type="text" class="form-control" id="database" name="database" value="syguestbook">
</div>

<div class="form-group">
  <label for="exampleInputEmail1">数据库前缀：</label>
  <input type="text" class="form-control" id="prefix" name="prefix" value="sy_">
</div>

<hr />

<input type="submit" value="确认安装" class="btn btn-primary btn-block" name="install"/>

</div>
</form>
</body>
</html>