<?php
/**
 * 将时间格式转换函数注册到模板中使用
 * @param format        时间格式
 * @param timestamp     时间戳
 * 
*/
function dateTime($params){
	$format = $params["format"];
	$timestamp = $params["timestamp"];
	return date($format, $timestamp);
}
spAddViewFunction('tpl_dateTime','dateTime');

/**
 * base64_encode加密
 * @param body        时间格式
 * 
*/
function encode($params){
	$body = $params["body"];
	return base64_encode($body);
}
spAddViewFunction('tpl_encode','encode');

/**
 * 获取客户端IP
 *
 */
function getIP()
{
if (isset($_SERVER["HTTP_X_FORWARDED_FOR"]))
{
	if ($_SERVER["HTTP_CLIENT_IP"])
	{
		 $proxy = $_SERVER["HTTP_CLIENT_IP"];
	}
	else
	{
		 $proxy = $_SERVER["REMOTE_ADDR"];
	}
   $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
}
else
{
   if (isset($_SERVER["HTTP_CLIENT_IP"]))
   {
		 $ip = $_SERVER["HTTP_CLIENT_IP"];
	}
	else
	{
		 $ip = $_SERVER["REMOTE_ADDR"];
	}
}
return $ip;
}

/**
 * 根据留言ID获取管理员列表
 * @param gid        留言本ID
*/
function adminuserList($params){
	$gid = $params["gid"];
	$admins = spClass("lib_adminuser")->findAll(array('gid'=>$gid),NULL,"username");
	if($admins)
	{
		foreach ($admins as $value)
		{
			$data[] = $value['username'];
		}  
		return implode("，",$data);
	}
	else
	{
		return '无';
	}
}
spAddViewFunction('tpl_adminuserList','adminuserList');

/**
 * 根据留言板ID获取留言板名称
 * @param gid        留言本ID
*/
function GidToGname($params){
	$gid = $params["gid"];
	$admin = $params["admin"];
	$g = spClass("lib_guestbook")->find(array('id'=>$gid),NULL,"gName");
	if($g && $admin != 'admin')
	{
		
		return $g['gName'];
	}
	elseif($admin == 'admin')
	{
		return '[全部]';
	}
	else
	{
		return '---';
	}
}
spAddViewFunction('tpl_GidToGname','GidToGname');

/**
 * 垃圾信息过滤
 */
function isValidData($s){
	if(preg_match("/([\x{4e00}-\x{9fa5}].+)\\1{4,}/u",$s))
	{
		return false;//同字重复５次以上
	}
	elseif(preg_match("/^[0-9a-zA-Z]*$/",$s))
	{
		return false;//全数字，全英文或全数字英文混合的
	}
	elseif(preg_match("/<a([^>]*)>([^<]*)</a>/",$s))
	{
		return false;//有超链接
	}
	elseif(strlen($s)<15)
	{
		return false;//输入字符长度过短
	}
	elseif(stripos($s,'<script')!== false)
	{
		return false;//有js代码
	}
	elseif(stripos($s,"http://")!== false)
	{
		return false;//有js代码
	}
	return true;
}

/**
 * 根据IP获取地理位置
 * @param ip        IP地址
*/
function replaceIp($params){
	$ip = $params["ip"];
	$apiUrl = "http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=json&ip=$ip";
	$data = json_decode(spClass('spHttp')->vget($apiUrl),TRUE);
	if($data != '-2')
	{
		return $data['province'].$data['city'];
	}
	else
	{
		return '无效IP';
	}
}
spAddViewFunction('tpl_replaceIp','replaceIp');

/**
 * 隐藏IP最后一位
 * @param ip        IP地址
*/
function hideIp($params){
	$ip = $params["ip"];
	$reg = '/((?:\d+\.){2})\d+/';
	return preg_replace($reg, "\\1*", $ip);
}
spAddViewFunction('tpl_hideIp','hideIp');

/**
 * 增加Meg转换地理位置
 * @param ip        IP地址
*/
function AssMegReplaceIp($ip){
	$apiUrl = "http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=json&ip=$ip";
	$data = json_decode(spClass('spHttp')->vget($apiUrl),TRUE);
	if($data != '-2')
	{
		return $data['province'].$data['city'];
	}
	else
	{
		return '无法解析的IP';
	}
}

/**
 * 统计留言数和待审核数量
 * @param gid     留言ID
 */
function MegSum($params){
	$gid = $params["gid"];
	$lib_message = spClass("lib_message");
	$megSumAll = $lib_message->findCount(array("gid"=>$gid)); 
	$megSumNo = $lib_message->findCount(array("gid"=>$gid,'status'=>'no'));
	return "共有留言 ".$megSumAll." 条 - 待审 ".$megSumNo." 条";
}
spAddViewFunction('tpl_MegSum','MegSum');

/**
 * 留言板自定义导航
 * @param data     导航数据
 */
function NavList($params) 
{ 
	$data = $params['data'];
	if($data)
	{
	  if (stristr($_SERVER['HTTP_USER_AGENT'], 'Win'))
	  {
		  $crlf = "\r\n";
	  }
	  elseif (stristr($_SERVER['HTTP_USER_AGENT'], 'Mac'))
	  {
		  $crlf = "\r"; // for very old MAC OS
	  }
	  else
	  {
		  $crlf = "\n";
	  }
	  $ary = explode($crlf, $data);
	  
	  foreach ($ary as $value)
	  {
		  $v = explode('|',$value);
		  echo "<a href=\"".$v['1']."\" target=\"_blank\">".$v['0']."</a>";
	  }
	}
}
spAddViewFunction('tpl_NavList','NavList');

/**
 * 远程采集图片
 * @param url        远程图片
 * @param folder     要保存的路径
 * @param pic_name   要保存的文件名
 */
function get_file($url,$folder,$pic_name){  
  set_time_limit(60); //限制最大的执行时间
  $destination_folder=$folder?$folder.'/':''; //文件下载保存目录
  $newfname=$destination_folder.$pic_name;//文件PATH
  $file=fopen($url,'rb');
   
  if($file){          
	  $newf=fopen($newfname,'wb');
	  if($newf){              
		  while(!feof($file)){                    
			  fwrite($newf,fread($file,1024*8),1024*8);
		  }
	  }
	  if($file){              
		  fclose($file);
	  }
	  if($newf){              
		  fclose($newf);
	  }
  }       
}

/**
 * 智能显示头像
 * @param qq        留言者QQ
 * @param mold      头像类型
 */
function HeadImg($params){  
	$qq = $params['qq'];
	$mold = $params['mold'];
	if($mold == 'qqshow')
	{
		return 'http://qqshow-user.tencent.com/'.$qq.'/10/100/';
	}
	elseif($mold == 'qqhead')
	{
		return 'http://q1.qlogo.cn/g?b=qq&nk='.$qq.'&s=100&t='.time();
	}
}
spAddViewFunction('tpl_HeadImg','HeadImg');


/**
 * 传入日期格式或时间戳格式时间，返回与当前时间的差距，如1分钟前，2小时前，5月前，3年前等
 * @param string or int $date 分两种日期格式"2013-12-11 14:16:12"或时间戳格式"1386743303"
 * @param int $type
 * @return string
 */
function formatTime($params) { 
    $date = $params['date'];
	$type = $params['type'];//$type = 1为时间戳格式，$type = 2为date时间格式
	date_default_timezone_set('PRC'); //设置成中国的时区
    switch ($type) {
        case 1:
            //$date时间戳格式
            $second = time() - $date;
            $minute = floor($second / 60) ? floor($second / 60) : 1; //得到分钟数
            if ($minute >= 60 && $minute < (60 * 24)) { //分钟大于等于60分钟且小于一天的分钟数，即按小时显示
                $hour = floor($minute / 60); //得到小时数
            } elseif ($minute >= (60 * 24) && $minute < (60 * 24 * 30)) { //如果分钟数大于等于一天的分钟数，且小于一月的分钟数，则按天显示
                $day = floor($minute / ( 60 * 24)); //得到天数
            } elseif ($minute >= (60 * 24 * 30) && $minute < (60 * 24 * 365)) { //如果分钟数大于等于一月且小于一年的分钟数，则按月显示
                $month = floor($minute / (60 * 24 * 30)); //得到月数
            } elseif ($minute >= (60 * 24 * 365)) { //如果分钟数大于等于一年的分钟数，则按年显示
                $year = floor($minute / (60 * 24 * 365)); //得到年数
            }
            break;
        case 2:
            //$date为字符串格式 2013-06-06 19:16:12
            $date = strtotime($date);
            $second = time() - $date;
            $minute = floor($second / 60) ? floor($second / 60) : 1; //得到分钟数
            if ($minute >= 60 && $minute < (60 * 24)) { //分钟大于等于60分钟且小于一天的分钟数，即按小时显示
                $hour = floor($minute / 60); //得到小时数
            } elseif ($minute >= (60 * 24) && $minute < (60 * 24 * 30)) { //如果分钟数大于等于一天的分钟数，且小于一月的分钟数，则按天显示
                $day = floor($minute / ( 60 * 24)); //得到天数
            } elseif ($minute >= (60 * 24 * 30) && $minute < (60 * 24 * 365)) { //如果分钟数大于等于一月且小于一年的分钟数，则按月显示
                $month = floor($minute / (60 * 24 * 30)); //得到月数
            } elseif ($minute >= (60 * 24 * 365)) { //如果分钟数大于等于一年的分钟数，则按年显示
                $year = floor($minute / (60 * 24 * 365)); //得到年数
            }
            break;
        default:
            break;
    }
    if (isset($year)){
        return $year . '年前';
    } elseif (isset($month)){
        return $month . '月前';
    } elseif (isset($day)){
        return $day . '天前';
    } elseif (isset($hour)){
        return $hour . '小时前 <span class="Megnew"></span>';
    } elseif (isset($minute)){
        return $minute . '分钟前 <span class="Megnew"></span>';
    }
}

spAddViewFunction('tpl_formatTime','formatTime');