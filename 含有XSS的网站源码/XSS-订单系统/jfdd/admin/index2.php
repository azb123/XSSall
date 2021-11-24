<?php
include '../xingTemplate/xingTemplate.php';
include('../lib/functions.php');
include("adminyz.php"); //包含验证文件
include("../config.php"); //包含文件




$xingTemplate->display('index','admin');
?>



<?php


mysql_query("SET NAMES '{$CONF['db']['charset']}'");



$pagesize=20;//设定每一页显示的记录数
$sql="select count(*) from jf_content";//取得记录总数
$conn=mysql_query($sql) or die(mysql_error());

$result=mysql_fetch_array($conn);
$numrows=$result[0];
if($numrows==0){
echo ("<script type='text/javascript'> alert('无数据！');location.href='../index.php';;</script>");
mysql_close();
exit;
}

$pages=intval($numrows/$pagesize);
if ($numrows%$pagesize) $pages++;//计算总页数
if (!isset($page))
$page=1;//判断页数设置与否，如无则定义为首页
//判断转到页数
if (isset($ys)){
if ($ys>$pages)
$page=$pages;
else
$page=$ys;}
//计算记录偏移量
$offset=$pagesize*($page-1);

$res=mysql_query("select * from jf_content order by jf_id desc limit $offset,$pagesize");

 
 $rs=mysql_fetch_array($res)
 
?>
<body>
<center>
<script type="text/javascript">
function refresh(){
    window.location.href=window.location.href;
}

</script>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">  
<tr  >
    

      <td><button onclick="window.location.href('login_out.php')" >退出系统</button></td>
	  <td><button onclick="refresh()">更新缓存</button>

</td>
<td></td>
    </tr>
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
  <?php 
$i=$numrows+1;
 while($rs=mysql_fetch_array($res)){ $i--;?>

	<tr class="<?php if($i%2==0) {echo "odd";}else echo "even";?>" >

	  <td ><?php echo "<font color=orange>".$i."</font>";?></td>
	  <td ><?php echo $rs["jf_area"]?></td>
	  <td ><?php if($rs["jf_child"]==0) {echo "没带小孩";}else echo "<font color=red>"."带小孩了"."</font>";?></td>
	  <td ><?php if($rs["jf_pay"]==1) {echo "已支付";}else echo "<font color=red>"."未支付"."</font>";?></td>
	  <td ><?php echo $rs["jf_renshu"]?></td>
	  <td ><?php echo $rs["jf_comedate"]?></td>
	  <td ><?php echo $rs["jf_user"]?></td>
	  <td ><?php echo $rs["jf_pnum"]?></td>
	  <td ><?php echo $rs["jf_qq"]?></td>
	  <td ><?php echo $rs["jf_note"]?></td>
	  <td ><?php echo $rs["jf_ip"]?></td>
	  <td ><?php  echo date('m-d G:i:s', $rs["jf_intime"]);  ?></td>

	  
	
	 

	  <td><a href="admin_del.php?id=<?php echo $rs["jf_id"]?>">删除</a></td>
		<td><a href="admin_pass.php?id=<?php echo $rs["jf_id"]?>&pass=<?php echo $rs["jf_pass"]?>"><?php if ($rs["jf_pass"]=="no")echo "<font color=red>"."未审核"."</font>";else echo "<font color=yellow>"."已审核"."</font>";?></a></td>
	
	  </tr>
  <?php }?>
  
</table>  
  <?php
 //显示总页数
echo "<div align='center'>共有".$pages."页(".$page."/".$pages.")<br>";
//显示分页数
for ($i=1;$i<$page;$i++)
echo "<a href='index.php?page=".$i."'>第".$i ."页</a> ";
echo "第".$page."页 ";
for ($i=$page+1;$i<=$pages;$i++)
echo "<a href='index.php?page=".$i."'>第".$i ."页</a> ";

echo "<br>";
//显示转到页数
echo "<form action='index.php' method='post'> ";
//计算首页、上一页、下一页、尾页的页数值
$first=1;
$prev=$page-1;
$next=$page+1;
$last=$pages;
if ($page>1)
{
echo "<a href='index.php?page=".$first."'>首页</a> ";
echo "<a href='index.php?page=".$prev."'>上一页</a> ";
}
if ($page<$pages)
{
echo "<a href='index.php?page=".$next."'>下一页</a> ";
echo "<a href='index.php?page=".$last."'>尾页</a> ";
}
echo "转到<input type=text name='ys' size='2' value=".$page.">页";
echo "<input type=submit name='submit' value='go'>";
echo "</form>";
echo "共&nbsp;$numrows &nbsp条信息";
echo "</div>";

	  mysql_close();
	  exit;
	  ?>
	  
	  
	  
</center>

</body>
</html>
