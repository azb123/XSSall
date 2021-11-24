<?php /* Smarty version Smarty-3.1.7, created on 2012-02-18 23:56:38
         compiled from "D:\wamp\www\jfdd/templates\admin.html" */ ?>
<?php /*%%SmartyHeaderCode:91284f3f20b0ca90d6-03187503%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '453052df02e6583c28b9b7410694623874d7db32' => 
    array (
      0 => 'D:\\wamp\\www\\jfdd/templates\\admin.html',
      1 => 1329580579,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '91284f3f20b0ca90d6-03187503',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4f3f20b115fbb',
  'variables' => 
  array (
    'title' => 0,
    'admin' => 0,
    'uid' => 0,
    'keywords' => 0,
    'description' => 0,
    'copyright' => 0,
    'result_array' => 0,
    'v' => 0,
    'nodata' => 0,
    'pages' => 0,
    'page' => 0,
    'numrows' => 0,
    'first' => 0,
    'prev' => 0,
    'next' => 0,
    'last' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4f3f20b115fbb')) {function content_4f3f20b115fbb($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'D:\\wamp\\www\\jfdd\\class\\plugins\\modifier.date_format.php';
?>


 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
 - 管理后台</title>
	
		
		<link rel="stylesheet"
			href="../images/css/mains.css" type="text/css"></link>
		
	

	</head>
	<body class="mainPage">
		
<script type="text/javascript">
				/*注销系统*/
        function logOut(){
				if(window.confirm("您确定要退出管理平台吗?")==true)
				{
					parent.location.href='login_out.php';
				}
		}
		
		
</script>

	<div class="hd">
		<div class="hdbox wm">
			<div class="logo">
				<img src="../images/logo.png" alt="<?php echo $_smarty_tpl->tpl_vars['title']->value;?>
" border="0"></img>
			</div>
			<div class="tp"></div>
			<div class="tmu">
				欢迎您,<?php echo $_smarty_tpl->tpl_vars['admin']->value;?>

				[<a href="javascript:logOut();" title="安全退出">退出系统</a>] |
				[<a href="javascript:refresh();" title="更新缓存">更新缓存</a>] 
				 |
				<a href="">反馈</a>
				<a href="" target="_blank">帮助</a>
			</div>
		</div>
	</div>

		<div id="container" class="container">
			<div class="contentV1">
				<div class="sidebar">
					<div class="cBlock">
						<div class="cTitle">
							功能面板
						</div>
						<div class="cMain">
							<ul>
								<li>
								
									<a href="?uid=1" title="系统设置"
										class="cPic4">系统设置</a>
								</li>
								<li>
									<a href="?uid=2" title="管理员修改密码" class="cPic5">管理员修改密码</a>
								</li>
								<li  class="isHot">
									<a href="?uid=3"
										title="订单查询" class="cPic1">订单查询</a>
								</li>
								<li >
									<a href="?uid=4" title="会员查询"
										class="cPic3">会员查询</a>
								</li>
								<li  >
									<a href="?uid=5" title="高级管理"
										class="cPic2">高级管理</a>
								</li> 
								<li class="last"></li>
						
							</ul>
						</div>
					</div>
				</div>
				
				<?php if ($_smarty_tpl->tpl_vars['uid']->value==1){?>
				<div class="wrapper">
					<div class="wBlock">
						<div class="wTitleV1">
							系统设置
						</div>
						<div class="wMain">
							<div class="pProcess">
							
							<fieldset>
							  <label >
							<form action='?sid=1' method="post">
 <div>
   <label for="">网站名称：<input type="text" class="text_m" name="title" value="<?php echo $_smarty_tpl->tpl_vars['title']->value;?>
">*</label>
   

</div>
 <div>
   <label for="">网站关键字：<input type="text" class="text_m" name="keywords" value="<?php echo $_smarty_tpl->tpl_vars['keywords']->value;?>
">*</label>

</div>
 <div>
   <label for="">网站描述：<input type="text" class="text_m" name="description" value="<?php echo $_smarty_tpl->tpl_vars['description']->value;?>
">*</label>

</div>
 <div>
   <label for="">网站版权：<input type="text" class="text_m" name="copyright" value="<?php echo $_smarty_tpl->tpl_vars['copyright']->value;?>
">*</label>

</div>
 
 <div>
   <label for=""><input type="submit" name="submit" value="保存"></label>

</div>

		</form>
		
		  </label >
						</fieldset>	
								<div class="clear"></div>
							</div>
						</div>
					</div>
				</div>
				<?php }?>
				
				
				<?php if ($_smarty_tpl->tpl_vars['uid']->value==2){?>
				<div class="wrapper">
					<div class="wBlock">
						<div class="wTitleV1">
							管理员修改密码
						</div>
						<div class="wMain">
							<div class="pProcess">
							
							<fieldset>
							  <label >
							<form action='?sid=2' method="post">
 <div>
   <label for="">旧密码：<input type="password"  name="oldpw" value="">*</label>
   

</div>
 <div>
   <label for="">新密码：<input type="password"  name="newpw" value="">*</label>

</div>
 <div>
   <label for="">重复密码：<input type="password"  name="newpw1" value="">*</label>

</div>

 
 <div>
   <label for=""><input type="submit" name="submit" value="保存"></label>

</div>

		</form>
		
		  </label >
						</fieldset>	
								<div class="clear"></div>
							</div>
						</div>
					</div>
				</div>
				<?php }?>
				
				
				
				<?php if ($_smarty_tpl->tpl_vars['uid']->value==3){?>
				<div class="wrapper">
					<div class="wBlock">
						<div class="wTitleV1">
							订单查询
						</div>
						<div class="wMain">
							
							<center>
<script type="text/javascript">
function refresh(){
    window.location.href=window.location.href;
}

</script>
<script type="text/javascript">
				/*注销系统*/
        function logOut(){
				if(window.confirm("您确定要退出管理平台吗?")==true)
				{
					parent.location.href='login_out.php';
				}
		}
		
		
</script>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">  

  <tr>  
    <th  align="center">ID</th>  
    <th align="center">野战活动场地选择</th>  
	<th align="center">是否带有小孩</th>
	<th align="center">是否已经在线支付</th>
<th align="center">参加活动人数</th>
<th align="center">到场日期</th>
<th align="center">联系人</th>
<th align="center">联系电话</th>	
<th align="center">联系QQ</th>	
<th align="center">具体要求</th>
<th align="center">IP地址</th>
<th align="center">提交日期</th>		
<th align="center">操作</th>
<th align="center">审核</th>
	
  </tr>  

<?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['result_array']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
?>


	<tr class="<?php if ($_smarty_tpl->tpl_vars['v']->value['jf_id']%2==0){?>odd<?php }else{ ?>abc<?php }?>">



	  <td ><font color=orange><?php echo $_smarty_tpl->tpl_vars['v']->value['jf_id'];?>
</font></td>
	 <td ><?php echo $_smarty_tpl->tpl_vars['v']->value['jf_area'];?>
</td>
	  <td ><?php if ($_smarty_tpl->tpl_vars['v']->value['jf_child']==0){?>没带小孩<?php }elseif($_smarty_tpl->tpl_vars['v']->value['jf_child']!=0){?><font color=red>带小孩了</font><?php }?></td>
	  
	  <td >
	  <?php if ($_smarty_tpl->tpl_vars['v']->value['jf_pay']==1){?>已支付<?php }else{ ?><font color=red>未支付</font><?php }?>
	 </td>
	 <td ><?php echo $_smarty_tpl->tpl_vars['v']->value['jf_renshu'];?>
</td>
	 <td ><?php echo $_smarty_tpl->tpl_vars['v']->value['jf_comedate'];?>
</td>
	 <td ><?php echo $_smarty_tpl->tpl_vars['v']->value['jf_user'];?>
</td>
	 <td ><?php echo $_smarty_tpl->tpl_vars['v']->value['jf_pnum'];?>
</td>
	 <td ><?php echo $_smarty_tpl->tpl_vars['v']->value['jf_qq'];?>
</td>
	 <td ><?php echo $_smarty_tpl->tpl_vars['v']->value['jf_note'];?>
</td>
	 <td ><?php echo $_smarty_tpl->tpl_vars['v']->value['jf_ip'];?>
</td>
	<td ><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['v']->value['jf_intime'],"%H:%M,%m-%e-%Y");?>

</td>

<script type="text/javascript">
  function del(){
				if(window.confirm("您确定要删除吗?")==true)
				{
					parent.location.href='admin_del.php?id=<?php echo $_smarty_tpl->tpl_vars['v']->value['jf_id'];?>
';
				}
		}
		</script>

	<td><a href="javascript:del();">删除</a></td>
	
	<td><a href="admin_pass.php?id=<?php echo $_smarty_tpl->tpl_vars['v']->value['jf_id'];?>
&pass=<?php echo $_smarty_tpl->tpl_vars['v']->value['jf_pass'];?>
"><?php if ($_smarty_tpl->tpl_vars['v']->value['jf_pass']=="no"){?><font color=red>未审核</font><?php }else{ ?><font color=yellow>已审核</font><?php }?></a></td>
	
	
	  </tr>

  <?php } ?>
  <tr><?php echo $_smarty_tpl->tpl_vars['nodata']->value;?>
</tr>
</table>  
  
  
 

<div align='center'>共有<?php echo $_smarty_tpl->tpl_vars['pages']->value;?>
页(<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['pages']->value;?>
)共&nbsp;<?php echo $_smarty_tpl->tpl_vars['numrows']->value;?>
 &nbsp条信息<br>

<?php if ($_smarty_tpl->tpl_vars['page']->value>1){?><a href='admin.php?uid=3&page=<?php echo $_smarty_tpl->tpl_vars['first']->value;?>
'>首页</a>
  <a href='admin.php?uid=3&page=<?php echo $_smarty_tpl->tpl_vars['prev']->value;?>
'>上一页</a><?php }?>
  <?php if ($_smarty_tpl->tpl_vars['page']->value<$_smarty_tpl->tpl_vars['pages']->value){?><a href='admin.php?uid=3&page=<?php echo $_smarty_tpl->tpl_vars['next']->value;?>
'>下一页</a>
  <a href='admin.php?uid=3&page=<?php echo $_smarty_tpl->tpl_vars['last']->value;?>
'>尾页</a><?php }?>
	  
	  <form action='admin.php?uid=3' method='post'>
	  转到<input type=text name='ys' size='2' value="<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
">页
	  <input type=submit name='submit' value='go'>
	  </form>
	  
</center>
							
						</div>
					</div>
				</div>
				<?php }?>
				
				
				
				<div class="clear"></div>
			</div>
		</div>
		


	
	 
	</head>
	<body>
		<div class="ft wm">
			<div class="ftline"></div>
			<?php echo $_smarty_tpl->tpl_vars['title']->value;?>

		</div>
	</body>
	</body>
</html>
<?php }} ?>