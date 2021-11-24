<?
 session_start();
 $_SESSION['fsess']=($_SESSION['fsess'])?$_SESSION['fsess']:time();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>防止表单重复提交</title>
<SCRIPT language=Javascript type=text/javascript>
<!--
//*****Javascript防重复提交************
var frm_submit=false;   //纪录提交状态
function check_form(fobj) {
 var error = 0;
    var error_message = "";
 if (fobj.formtext.value=="")
 {
  error_message = error_message + "formtext 不能为空.\n";
  error = 1;
 }
 
 if (frm_submit==true) {
  error_message = error_message + "这个表单已经提交.\n请耐心等待服务器处理你的请求.\n\n";
  error=1;
 }
 
 if (error == 1) {
   alert(error_message);
   return false;
 } else {
   frm_submit=true;  //改变提交状态
   return true;
 }
}
-->
</script>
</head>
<body>
Javascript和服务器端 双重防止表单重复提交演示
<br/>
<br/>
现在时间：<? echo date("Y-m-d H:i:s"); ?>
<br/>
<br/>
<?
if($_POST["faction"]=="submit"||$_GET["faction"]=="submit"){
 //提交处理
 
 //*****服务器端防重复提交*******************
 //如果POST传来的表单生成时间与SESSION保存的表单生成时间
 //相同；为正常提交
 //不相同；为重复提交
 if($_SESSION["fsess"]==$_POST["fpsess"]){
  $_SESSION["fsess"]=time();
  echo  "提交内容：<br/>\n";
  echo  $_POST["fpsess"]."<br/>\n";;
  echo  $_POST["formtext"];
  echo "</body></html>";
  exit;
 } else {
  echo  "重复提交，退出！！！！<br/>\n";
  echo "</body></html>";
  exit;
 }
} 
//$_SESSION["fsess"]=time();
?>
<form name="f_info" action="" method="post"  onSubmit="return check_form(this);">
<input name="fpsess" type="hidden" value="<? echo $_SESSION["fsess"]; ?>" />
<!-- 保存表单生成时间 -->
<input name="faction" type="hidden" value="submit" />
<input name="formtext" id="formtext" type="text" value="" />
<input type="submit" value="提交" />
<input  type="reset" value="重置" />
</form>
</body>
</html>
