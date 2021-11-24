<?php /* Smarty version Smarty-3.1.7, created on 2012-02-18 23:56:53
         compiled from "D:\wamp\www\jfdd/templates\login.html" */ ?>
<?php /*%%SmartyHeaderCode:212574f3fca45d923e4-26223539%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5f24ea82d09e65161f54f6a48065e872e179af76' => 
    array (
      0 => 'D:\\wamp\\www\\jfdd/templates\\login.html',
      1 => 1329226806,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '212574f3fca45d923e4-26223539',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'title' => 0,
    'ROOT_ADMIN_PATH' => 0,
    'copyright' => 0,
    'keywords' => 0,
    'description' => 0,
    'time_now' => 0,
    'ROOT_PATH' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4f3fca45e9dfc',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4f3fca45e9dfc')) {function content_4f3fca45e9dfc($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>

<link href="<?php echo $_smarty_tpl->tpl_vars['ROOT_ADMIN_PATH']->value;?>
images/css/css.css" type="text/css" rel="stylesheet" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="copyright" content="<?php echo $_smarty_tpl->tpl_vars['copyright']->value;?>
"> 
<meta type="keywords" content="<?php echo $_smarty_tpl->tpl_vars['keywords']->value;?>
">
<meta type="description" content"<?php echo $_smarty_tpl->tpl_vars['description']->value;?>
">
		<link type="text/css" href="images/css/jfstyle.css" rel="stylesheet" />
	</head>
	
	<BODY>
<div id="formwrapper">

 <h3><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
-管理员登陆界面</h3>
  <form name="form1" action="<?php echo $_smarty_tpl->tpl_vars['ROOT_ADMIN_PATH']->value;?>
login.php" method="post" id="form1">
<fieldset>
 <legend><span class="style1">军锋基地欢迎您的到来</span>！</legend>
  <br/> <div>现在时间：<?php echo $_smarty_tpl->tpl_vars['time_now']->value;?>
<br/>  
</div><br/> 



 <div>
   <label >管理员用户名：</label>
   <input type="text" class="text_m" name="admin_name"  \>
   <br/>  
   
</div>
 <div>
   <label >管理员密码：</label>
   <input type="password" class="text_m" name="admin_password"  \>
   <br/>  
   
</div>


  <div>
   <label for="yanzheng">验证码</label>
<input type="text" class="text_s" name="yanzheng" \> <img src="<?php echo $_smarty_tpl->tpl_vars['ROOT_PATH']->value;?>
lib/yanzheng.php" alt="看不清楚?请点击刷新" onclick="this.src=this.src+'?'+Math.random();" style="CURSOR:hand;">  *<br/>  
</div>
	
	
   <div class="enter">
   <input name="Submit"  type="submit" class="buttom" value="提交" />
   <input name="Submit" type="reset" class="buttom" value="重置" />
</div>
  

</fieldset>
  </form>
   
</div>




</BODY>
</html><?php }} ?>