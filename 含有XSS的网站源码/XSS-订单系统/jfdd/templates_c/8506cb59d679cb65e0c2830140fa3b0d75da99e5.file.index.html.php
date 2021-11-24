<?php /* Smarty version Smarty-3.1.7, created on 2012-02-18 11:54:18
         compiled from "D:\wamp\www\jfdd/templates\index.html" */ ?>
<?php /*%%SmartyHeaderCode:285544f3f20eac2d6a0-39004545%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8506cb59d679cb65e0c2830140fa3b0d75da99e5' => 
    array (
      0 => 'D:\\wamp\\www\\jfdd/templates\\index.html',
      1 => 1329275922,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '285544f3f20eac2d6a0-39004545',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'copyright' => 0,
    'keywords' => 0,
    'description' => 0,
    'title' => 0,
    'ip' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4f3f20eadc027',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4f3f20eadc027')) {function content_4f3f20eadc027($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'D:\\wamp\\www\\jfdd\\class\\plugins\\modifier.date_format.php';
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>


<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="copyright" content="<?php echo $_smarty_tpl->tpl_vars['copyright']->value;?>
"> 
<meta type="keywords" content="<?php echo $_smarty_tpl->tpl_vars['keywords']->value;?>
">
<meta type="description" content"<?php echo $_smarty_tpl->tpl_vars['description']->value;?>
">

<link type="text/css" href="images/css/jfstyle.css" rel="stylesheet" />
<script type="text/javascript" src="images/js/jfdd.js"></script>
<script src="images/js/jquery.js"></script>
<script src="images/js/jquery.validator.js"></script>
<script src="images/js/jquery.corners.min.js"></script>

<title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>


  

</head>
<body>

<div id="formwrapper">

 <h3><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</h3>
  <form name="form1" action="index_cl.php" method="post" id="form1">
<fieldset>
 <legend><span class="style1">军锋基地欢迎您的到来</span>！</legend>
  <br/> <div>现在时间：<?php echo smarty_modifier_date_format(time(),"%Y-%m-%d %H:%M:%S");?>
<br>提交成功后，联系在线客服<a href="http://wpa.qq.com/msgrd?V=1&Uin=712689915">点此打开qq对话</a><br/>  
</div><br/> 
  <div>
   <label for="area">野战活动场地选择</label>
  <select name="area" id="area">
                <option value="琅岐度假村">琅岐度假村</option>
                <option value="其他">其他</option>
              </select>*
   <br/>  
</div>

<div>
   <label for="child">是否带有小孩</label>
   <input name="child" type="radio" value="0" checked>
        否
          　
          <input type="radio" name="child" value="1">　
        是 *<br />  
</div> 

<div>
   <label for="pay">是否已经在线支付</label>
   <input name="pay" type="radio" value="0" checked>
        否
          　
          <input type="radio" name="pay" value="1">　
        是 *
<a href="http://item.taobao.com/item.htm?id=10617759290
">点此在线支付</a>	<br />	
</div> 
 <div>
   <label for="renshu">参加活动人数</label>
   <input type="text" class="text_m" name="renshu" id="renshu" require="true" datatype="require" msg="<font color='red'>此项不能为空</font>" \>*
   <br/>  
   
</div>

<div>
   <label for="comedate">到场日期</label>
<input onfocus="setday(this)" name="comedate" class="text_m" id="comedate" require="true" datatype="require" msg="<font color='red'>此项不能为空</font>" \> * <br/>  
</div>

   <div>
   <label for="user">联系人</label>
   <input type="text" class="text_m" name="user" id="user" require="true" datatype="require" msg="<font color='red'>此项不能为空</font>" \>*
   <br/>  
   
</div>

   <div>
   <label for="pnum">联系电话</label>
   <input type="text" class="text_m" name="pnum" id="pnum" require="true" datatype="require" msg="<font color='red'>此项不能为空</font>" \>*
   <br/>  
   
</div>
   <div>
   <label for="qq">联系QQ</label>
   <input type="text" class="text_m" name="qq" id="qq" require="true" datatype="require" msg="<font color='red'>此项不能为空</font>" \>*
   <br/>  
   
</div>
<div>
   <label for="note">具体要求</label>
<textarea name="note" class="area_m" ></textarea> <br/>  
</div>
  <div>
   <label for="yanzheng">验证码</label>
<input type="text" class="text_s" name="yanzheng" id="yanzheng" require="true" datatype="require" msg="<font color='red'>验证码不能为空</font>" \> <img src="lib/yanzheng.php" alt="看不清楚?请点击刷新" onclick="this.src=this.src+'?'+Math.random();" style="CURSOR:hand;">  *<br/>  
</div>
	
	
   <div class="enter">
  
   <input name="ip" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['ip']->value;?>
" />
   <input name="tm" type="hidden" value="<?php echo time();?>
" />
   <input name="pass" type="hidden" value="no" />
   <input name="Submit"  type="submit" class="buttom" value="提交" />
   <input name="Submit" type="reset" class="buttom" value="重置" />
</div>
  

</fieldset>
  </form>
   
</div>
  <script>
$('#form1').checkForm();
</script>
</body>

</html>
<?php }} ?>