<?php
/***********************************************
 *		SpeedPHP常用函数扩展类
 * 文件: /Extensions/spFun.php
 * 说明: 常用函数扩展类
 * 作者: Myxf
 * 更新: 2015年5月14日
 ***********************************************/

/**
 * 常用函数扩展类
 */
class spFun {
    /**
	 * 获取随机数
	 */
	function getRandom($min, $max)
	{
     	srand((double)microtime() * 1000000);
     	$randval = rand($min, $max);
     	return $randval;
    }

    /**
	 * 获取服务器当前日期时间
	 */
	function getDateTime()
	{
		date_default_timezone_set("Asia/Chongqing");
		return date("Y-m-d H:i:s");
	}

	/**
	 * 获取服务器当前日期
	 */
	function getDater()
	{
		date_default_timezone_set("Asia/Chongqing");
		return date("Y-m-d");
	}

	/**
 	 * 获取服务器当前时间
 	 */
	function getTime()
	{
     	date_default_timezone_set("Asia/Chongqing");
     	$timeval["h"] = date("h"); //小时
     	$timeval["i"] = date("i"); //分钟
     	$timeval["s"] = date("s"); //秒
     	return $timeval;
    }

	/**
 	 * 获取倒计时剩余时间
 	 * 参数 t 秒钟偏移量 默认为0
 	 */
	function getcT($t = 0)
	{
     	$time =getTime();
     	$s = (3 - $time["i"] % 3) * 60 - $time["s"] + $t;
     	return $s;
    }
	/**
	 * 验证邮箱地址格式
	 */
	function isEmail($email)
	{
		if (preg_match("/[a-zA-Z0-9]+@[a-zA-Z0-9]+\.[a-z]{2,4}/",$email,$mail))
		{
    		return true;
		}
		else
		{
    		return false;
		}
	}

	/**
	 * 验证用户名是否以字母开头
	 */
	function isUserNum($user)
	{
		if (preg_match("/^[a-zA-Z]{1}([a-zA-Z0-9]|[._]){3,19}$/",$user,$username))
		{
    		return true;
		}
		else
		{
    		return false;
		}
	}

	/**
	 * 验证密码只能为数字和字母的组合
	 */
	function isPsd($psd)
	{
		if (preg_match("/^(\w){4,20}$/",$psd,$password))
		{
    		return true;
		}
		else
		{
    		return false;
		}
	}
	/**
	 * 转跳到url
	 */
	function url($url)
	{
		$code="<script language='javascript'>window.location='".$url."';</script>";
		return $code;
	}
	
    function toUrl($url="index.php",$info = "页面转向中...",$second=2){ 
		print "<html><head><title>页面转向中....</title>"; 
		print "<meta http-equiv='refresh' content='$second;url=$url'>"; 
		print '<style type="text/css">'; 
		print 'td { font-family: "Verdana", "Arial";font-size: 12px}'; 
		print 'A {COLOR: #000000; TEXT-DECORATION: none}'; 
		print '</style>'; 
		print '</head><body>'; 
		print '<table width="100%" border="0" align="center">'; 
		print " <tr>"; 
		print " <td height='200'> </td>"; 
		print " </tr>"; 
		print " <tr>"; 
		print " <td align='center'>"; 
		print '<table width="60%" border="0" cellpadding="8" bgcolor="#AA9FFF">'; //PHP开源代码 
		print " <tr>"; 
		print ' <td height="30" align="center">提示信息</td>'; 
		print " </tr>"; 
		print " <tr>"; 
		print "<td align='center'>$info</td>"; 
		print " </tr>"; 
		print " <tr>"; 
		print ' <td align="center">'; 
		print " 如果你的浏览器不支持自动跳转,请<a href='$url'>点击这里</a></td>"; 
		print " </tr>"; 
		print " </tr>"; 
		print " </table></td>"; 
		print " </tr>"; 
		print " <tr>"; 
		print ' <td height="200"> </td>'; 
		print " </tr>"; 
		print "</table>"; 
		print "</body></html>"; 
		exit; 
    }
	/**
	 * 弹出js提示框
	 */
	function msg($content)
	{
		$code="<script language='javascript'>alert('".$content."');</script>";
		return $code;
	}

	/**
	 * 返回上一页
	 */
	function back()
	{
			$code="<a href='javascript:window.history.go(-1);'>返回</a>";
			return $code;
	}

	/**
	 * 获取用户真实IP
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
	 * 处理提交数据中的HTML代码
	 */
	function clearHTML($val)
	{
		return ltrim(chop(htmlspecialchars($val)));
	}
	/**
	 * 获取字符长度
	 */
	function getStrLen($str)
	{
		return mb_strlen($str,"UTF8");
	}

	/**
	 * 创建多级目录
	 */
	function createDir($dir)
	{
		if(!is_dir($dir))
		{
			if(!createDir(dirname($dir)))
			{
				return false;
			}
			if(!mkdir($dir,0777))
			{
				return false;
			}
		}
		return true;
	}

	/**
	 * 字符串截取
	 */
	function strSub($string, $sublen, $start)
	{
		$pa = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/";
		preg_match_all($pa, $string, $t_string);

		if(count($t_string[0]) - $start > $sublen) return join('', array_slice($t_string[0], $start, $sublen));
		return join('', array_slice($t_string[0], $start, $sublen));
	}

	/**
	 * 首尾截取字符串
	 */
	function strCut($string,$strstart,$strend)
    {
        $v_a=explode($strstart, $string);
        $v_a=explode($strend, $v_a[1]);
        return $v_a[0];
    }

	/**
	 * 字符串分割
	 * $str2: 分割标识符
	 */
    function strExplode($str1,$str2)
	{
		$array=explode($str2,$str1);
		return $array;
	}

	/**
	 * 数组
	 * $str_2：连接标识符
	 */
    function strImplode($str_1,$str_2)
	{
		$string=implode($str_2,$str_1);
		return $string;
	}

	/**
	 * 检查发帖间隔
	 */
	function cTtime($iTime=intervalTime)
	{
		if(isset($_SESSION['post_time']))
		{
			if (time()-$_SESSION['post_time']>60*$iTime)
			{
				return true;
			}
			else
			{
				return false;
			}
	    }
		else
		{
			return true;
		}
	}

	/**
	 * 字符串替换
	 */
	function strReplace($str)
	{
		$str=str_replace("<","&lt;",$str);
		$str=str_replace(">","&gt;",$str);
		$str=str_replace("object","",$str);
		$str=str_replace("script","",$str);

		return $str;
	}

	/**
	 * 清空字符串中的HTML标签
	 */
	function clearLabel($html)
	{
		$search = array ("'<script[^>]*?>.*?</script>'si", "'<[/!]*?[^<>]*?>'si", "'([rn])[s]+'", "'&(quot|#34);'i", "'&(amp|#38);'i", "'&(lt|#60);'i", "'&(gt|#62);'i", "'&(nbsp|#160);'i", "'&(iexcl|#161);'i", "'&(cent|#162);'i", "'&(pound|#163);'i", "'&(copy|#169);'i", "'&#(d+);'e");
     	$replace = array ("", "", "\1", "\"", "&", "<", ">", " ", chr(161), chr(162), chr(163), chr(169), "chr(\1)");

     	return preg_replace($search, $replace, $html);
	}

	/**
	 * 取整数
	 * (4舍5入)
	 */
	function getInt($num)
	{

		if(ceil($num)==$num)
		{
			return $num;
		}
		else
		{
			$num=explode(".",$num);
			if(strSub($num[1],1,0)>=5)
			{
				$num[0]+=1;
			}
			return  $num[0];
		}
	}
	
	/**
	 * 取整数
	 */
	function getInt0($num)
	{
		if(ceil($num)==$num)
		{
			return $num;
		}
		else
		{
			$num=explode(".",$num);
			return $num[0];
		}
	}
	
	/**
	 * 取小数
	 */
	function getDec($num)
	{
		if(ceil($num)==$num)
		{
			return "0.0";
		}
		else
		{
			$num=explode(".",$num);
			return "0.".(double)$num[1];
		}
		
	}

	//检查目录或文件是否存在
    function isExists($filename1='')
    {
			if(file_exists($filename1))
			{
				return true;
			}
			else	return false;
	}
    
    // 一次只能创建一级目录,成功返回1
	function createDir0($dirname,$mode=0777)
	{
			if(is_null($dirname) || $dirname=="")	return false;
			if(!is_dir($dirname))
			{
				return mkdir($dirname,$mode);
			}
	}
	
	//删除目录包括有文件	
	function delDir($dirname)
	{
			if(isExists($dirname) and is_dir($dirname))
			{
				if(!$dirhandle=opendir($dirname)) return false;
				while(($file=readdir($dirhandle))!==false)
				{
					if($file=="." or $file=="..")	continue;
					$file=$dirname.DIRECTORY_SEPARATOR.$file;  //表示$file是$dir的子目录
					if(is_dir($file))
					{
						delDir($file);
					}
					else
					{
						unlink($file);
					}
				}
				closedir($dirhandle);
				return rmdir($dirname);
			}
			else	return false;
	}	

	//复制目录,包括文件	
    function copyDir($dirfrom,$dirto)
	{
			if(!is_dir($dirfrom))	return false;
			if(!is_dir($dirto))		mkdir($dirto);
			$dirhandle=opendir($dirfrom);
			if($dirhandle)
			{
				while(false!==($file=readdir($dirhandle)))
				{
					if($file=="." or $file=="..")	continue;
					$filefrom=$dirfrom.DIRECTORY_SEPARATOR.$file;  //表示$file是$dir的子目录
					$fileto=$dirto.DIRECTORY_SEPARATOR.$file;
					if(is_dir($filefrom))
					{
						copyDir($filefrom,$fileto);
					}
					else
					{	if(!file_exists($fileto))
						copy($filefrom,$fileto);
					}
				}
			}
			closedir($dirhandle);
	}
    
    //获取目录大小
	function getDirSize($dirname)
	{
			if(!file_exists($dirname) or !is_dir($dirname))	 return false;
			if(!$handle=opendir($dirname)) 	return false;
			$size=0;
			while(false!==($file=readdir($handle)))
			{
				if($file=="." or $file=="..")	continue;
				$file=$dirname."/".$file;
				if(is_dir($file))
				{
					$size+=getDirSize($file);
				}
				else
				{
					$size+=filesize($file);
				}

			}
			closedir($handle);
			return $size;
	}
    
    // 单位自动转换函数
	function getKB($size)
	{
			$kb=1024;
			$mb=$kb*1024;
			$gb=$mb*1024;
			$tb=$gb*1024;
			if($size<$kb)	return $size."B";
			if($size>=$kb and $size<$mb)	return round($size/$kb,2)."KB";
			if($size>=$mb and $size<$gb)	return round($size/$mb,2)."MB";
			if($size>=$gb and $size<$tb)	return round($size/$gb,2)."GB";
			if($size>=$tb)	return round($size/$tb,2)."TB";
	}

	//复制文件
	function copyFile($srcfile,$newfile)
	{
			if(is_file($srcfile))
			{
				if(!file_exists($newfile))
				return copy($srcfile,$newfile);
			}
			else	return false;
	}

	//删除文件
    function delFile($filename)
   	{
   	 		if(isExists($filename) and is_file($filename))
   	 		{
   	 			return unlink($filename);
   	 		}
   	 		else	return false;
   	}

   	//将字符串写入文件
    function writeStr($filename,$str)
   	{
   	 		if(function_exists(file_put_contents))
   	 		{
   	 			file_put_contents($filename,$str);
   	 		}
   	 		else
   	 		{
   	 			$fp=fopen($filename,"wb");
   	 			fwrite($fp,$str);
   	 			fclose($fp);
   	 		}
   	} 	

    //将整个文件内容读出到一个字符串中
    function readStr($filename)	
   	{
   	 		if(function_exists(file_get_contents))
   	 		{
   	 			return file_get_contents($filename);
   	 		}
   	 		else
   	 		{
   	 			$fp=fopen($filename,"rb");
   	 			$str=fread($fp,filesize($filename));
   	 			fclose($fp);
   	 			return $str;
   	 		}
   	}  	 
    
    //将文件内容读出到一个数组中
    function readArray($filename)
   	{
   	 		$file=file($filename);
   	 		$arr=array();
   	 		foreach($file as $value)
   	 		{
   	 			$arr[]=trim($value);
   	 		}
   	 		return $arr;
   	} 	
    
    //获得当前文件地址
    function getFileSite()
    {
        if(!empty($_server["REQUEST_URI"])){ 
                $scriptName = $_SERVER["REQUEST_URI"]; 
                $nowurl = $scriptName; 
        }else{ 
                $scriptName = $_SERVER["PHP_SELF"]; 


                if(empty($_SERVER["QUERY_STRING"])) $nowurl = $scriptName; 
                else $nowurl = $scriptName."?".$_SERVER["QUERY_STRING"]; 
        } 
        return $nowurl; 
    }   	 	

}  	 	
?>