 <?php
 include('../lib/functions.php');
 $jfdd_verMsg = ' V1.0 UTF8';
 $jfdd_lang = 'utf-8';

define('JFDD_ROOT',ereg_replace("\\/","\\",$_SERVER['DOCUMENT_ROOT']));
define('JFDD_INSTALL',dirname(dirname(__FILE__)));
 $lockfile = dirname(__FILE__)."/install.lock";
  header ( "content-Type: text/html; charset=$jfdd_lang" );
 if(file_exists($lockfile)){
  exit("已经安装过了，如果要重新安装请先删除install/install.lock");
 }
 @$step=$_GET[step];
 if(empty($step))
{
	$step = 1;
}
/*------------------------
使用协议书
------------------------*/
if($step==1)
{
	include('./templates/step-1.html');
	exit();
}
/*------------------------
环境测试
------------------------*/
else if($step==2)
{
	 $phpv = phpversion();
	 $sp_os = @getenv('OS');
	 $sp_gd = gdversion();
	 $sp_server = $_SERVER['SERVER_SOFTWARE'];
	 $sp_host = (empty($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_HOST'] : $_SERVER['REMOTE_ADDR']);
	 $sp_name = $_SERVER['SERVER_NAME'];
	 

   $sp_safe_mode = (ini_get('safe_mode') ? '<font color=red>[×]On</font>' : '<font color=green>[√]Off</font>');
   $sp_gd = ($sp_gd>0 ? '<font color=green>[√]On</font>' : '<font color=red>[×]Off</font>');
   $sp_mysql = (function_exists('mysql_connect') ? '<font color=green>[√]On</font>' : '<font color=red>[×]Off</font>');

   if($sp_mysql=='<font color=red>[×]Off</font>')
   {
   		$sp_mysql_err = true;
   }
   else
   {
   		$sp_mysql_err = false;
   }

   $sp_testdirs = array(
        '/',
       
        '/install',
        
        '/admin',
        '/config.php'
   );
	 include('./templates/step-2.html');
	 exit();
}
else if($step==3)
{
if(@$_GET["action"]!=1)
{
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link type="text/css" href="../images/css/jfstyle.css" rel="stylesheet" />
<title>军锋真人CS野战在线预订系统安装</title>
 <div id="formwrapper">
<form method="post" action="index2.php?action=1">
<fieldset>
 <legend><span class="style1">军锋真人CS野战在线预订系统安装</span>！</legend>
   <br/> <div>现在时间：<? echo date("Y-m-d H:i:s"); ?><br/>  
</div><br/> 

 <div>
   <label for="">MySQL主机名：</label>
   <input type="text" class="text_m" name="host" value="localhost">*
   <br/>  
</div>
 <div>
   <label for="">MySQL用户名：</label>
   <input type="text" class="text_m" name="user" value="root">*
   <br/>  
</div>
 <div>
   <label for="">MySQL密码：</label>
   <input type="password" class="text_m" name="password" value="">*
   <br/>  
</div>
 <div>
   <label for="">数据库名称：</label>
   <input type="text" class="text_m" name="database" value="">*
   <br/>  
</div>
 <div>
   <label for="">管理员账号：</label>
   <input type="text" class="text_m" name="admin_name" value="">*
   <br/>  
</div>
 <div>
   <label for="">管理员密码：</label>
   <input type="text" class="text_m" name="admin_password" value="">*
   <br/>  
</div>
 <div>
   <label for="">网站名称：</label>
   <input type="text" class="text_m" name="sysname" value="军锋真人CS野战在线预订系统">*
   <br/>  
</div>
 <div>
   <label for="">网站copyright：</label>
   <input type="text" class="text_m" name="copyright" value="www.jf-cs.com">*
   <br/>  
</div>
 <div>
   <label for="">网站关键字：</label>
   <input type="text" class="text_m" name="keywords" value="军锋真人CS野战|真人CS">*
   <br/>  
</div>
 <div>
   <label for="">网站描述：</label>
   <input type="text" class="text_m" name="description" value="军锋真人CS野战">*
   <br/>  
</div>
 <div>
   <label for="">网站作者：</label>
   <input type="text" class="text_m" name="author" value="www.jf-cs.com">*
   <br/>  
</div>
<div>
   <label for="">多少时间内禁止同一IP提交：</label>
   <input type="text" class="text_m" name="tmlap" value="24">*(小时)
   <br/>  
</div>
 <div class="enter">
 <input type="button" class="buttom" value="后退" onclick="window.location.href='index.php?step=2';" />
   <input name="Submit"  type="submit" class="buttom" value="确定安装" />
   <input name="Submit" type="button" class="buttom" value="关闭页面" onclick="window.close()" />
</div>

</fieldset>
</form>
 </div>
<?php
 }

}
