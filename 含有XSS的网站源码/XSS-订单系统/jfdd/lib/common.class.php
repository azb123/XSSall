<?php
class common
{
	function getPageLinks($config)
	{
		$nav = array();

		$st = isset($config['ST_NAME']) ? $config['ST_NAME'] : 'page' ;
		$page_num = ceil($config['TOTAL_POSS'] / $config['PER_PAGE']);
		$page_num--;
		if($config['CUR_ST'] == 0){
			$nav['first_page'] = "<li class='info'>首页</li>";
			$nav['prev_page'] = "<li class='info'>上一页</li>";
		}else{
			$nav['first_page'] = "<li class='info pointer' onclick=\"gotopage('0');\">首页</li>";
			$nav['prev_page'] = "<li class='info pointer' onclick=\"gotopage('".($config['CUR_ST']-1)."');\">上一页</li>";
		}

		if($config['CUR_ST'] >= $page_num){
			$nav['last_page'] = "<li class='info'>尾页</li>";
			$nav['next_page'] = "<li class='info'>下一页</li>";
		}else{
			$nav['last_page'] = "<li class='info pointer' title='{$page_num}' onclick=\"gotopage('{$page_num}');\">尾页</li>";
			$nav['next_page'] = "<li class='info pointer' onclick=\"gotopage('".($config['CUR_ST']+1)."');\">下一页</li>";
		}
		
		$nav['cur_st'] = "<li class='current'>".($config['CUR_ST']+1)."</li>";
		$nav['front'] = $nav['back'] = "";
		for($i = 1; $i < 5; $i++)
		{
			if($config['CUR_ST'] - $i >= 0)
			{
				$nav['front'] = "<li class='uncurrent' onclick=\"gotopage('".($config['CUR_ST'] - $i)."');\">".($config['CUR_ST'] - $i + 1)."</li>" . $nav['front'];
			}
			if($config['CUR_ST'] + $i <= $page_num)
			{
				$nav['back'] = $nav['back'] . "<li class='uncurrent' onclick=\"gotopage('".($config['CUR_ST'] + $i)."');\">".($config['CUR_ST'] + $i + 1)."</li>";
			}
		}
		return "<ul>{$nav['first_page']}{$nav['prev_page']}{$nav['front']}{$nav['cur_st']}{$nav['back']}{$nav['next_page']}{$nav['last_page']}</ul>";
	}
	
	/**
	 * 根据配置生成分页链接代码
	 *
	 * @param array $config array('TOTAL_POSS'	=> 记录总数,
	 *							  'PER_PAGE'	=> 每页多少条,
	 *							  'CUR_ST'		=> 当前页,
	 * 							  'ST_NAME'		=> 当前页变量名
	 *							  'BASE_URL'	=> 页面地址
	 *							}
	 * @return string 分页显示分页链接代码
	 */
	function getHtmlPageLinks($config)
	{
		$nav = array();
		$index = isset($config['INDEX']) ? $config['INDEX'] : 'index';
		$st = isset($config['ST_NAME']) ? $config['ST_NAME'] : 'st' ;
		$page_num = ceil($config['TOTAL_POSS'] / $config['PER_PAGE']);
		$page_num--;
		/**
		 * 链接部分
		 */
		if($config['CUR_ST'] == 0){
			$nav['first_page'] = "<a href='#'>首页</a>";
			$nav['prev_page'] = "<a href='#'>上一页</a>";
		}else{
			$nav['first_page'] = "<a href='{$index}.html'>首页</a>";
			if($config['CUR_ST'] - 1 == 0)
			{
				$nav['prev_page'] = "<a href='{$index}.html'>上一页</a>";
			}
			else 
			{
				$nav['prev_page'] = "<a href='{$config['BASE_URL']}_".($config['CUR_ST']-1).".html'>上一页</a>";
			}
		}

		if($config['CUR_ST'] >= $page_num){
			$nav['last_page'] = "<a href='#'>末页</a>";
			$nav['next_page'] = "<a href='#'>下一页</a>";
		}else{
			$nav['last_page'] = "<a href='{$config['BASE_URL']}_{$page_num}.html'>末页</a>";
			$nav['next_page'] = "<a href='{$config['BASE_URL']}_".($config['CUR_ST']+1).".html'>下一页</a>";
		}
		/**
		 * 跳转部分
		 */
		$nav['jump_page'] = "<select onchange=\"javascript:window.location='' + this.options[this.selectedIndex].value + '.html'\">\n";
		for($i=0; $i<=$page_num; $i++){
			if($i == 0)
				$nav['jump_page'] .= "	<option value='{$index}'";
			else
				$nav['jump_page'] .= "	<option value='list_{$i}'";
			if($i == $config['CUR_ST']){
				$nav['jump_page'] .= " selected";
			}
			$nav['jump_page'] .= ">跳转至 ".($i+1)." 页</option>\n";
		}
		$nav['jump_page'] .= "</select>";
		return "{$nav['first_page']} {$nav['prev_page']} {$nav['next_page']} {$nav['last_page']} {$nav['jump_page']}";
	}
	
	function getPageLinks2($config)
	{
		$nav = array();

		$st = isset($config['ST_NAME']) ? $config['ST_NAME'] : 'st' ;
		$page_num = ceil($config['TOTAL_POSS'] / $config['PER_PAGE']);
		$page_num--;
		/**
		 * 链接部分
		 */
		if($config['CUR_ST'] == 0){
			$nav['first_page'] = "<li class='info'>首页</li>";
			$nav['prev_page'] = "<li class='info'>上一页</li>";
		}else{
			$nav['first_page'] = "<li class='info pointer' onclick='window.location=\"{$config['BASE_URL']}&amp;{$st}=0\"'>首页</li>";
			$nav['prev_page'] = "<li class='info pointer' onclick='window.location=\"{$config['BASE_URL']}&amp;{$st}=".($config['CUR_ST']-1)."\"'>上一页</li>";
		}

		if($config['CUR_ST'] >= $page_num){
			$nav['last_page'] = "<li class='info'>末页</li>";
			$nav['next_page'] = "<li class='info'>下一页</li>";
		}else{
			$nav['last_page'] = "<li class='info pointer' onclick='window.location=\"{$config['BASE_URL']}&amp;{$st}={$page_num}\"'>末页</li>";
			$nav['next_page'] = "<li class='info pointer' onclick='window.location=\"{$config['BASE_URL']}&amp;{$st}=".($config['CUR_ST']+1)."\"'>下一页</li>";
		}
		/**
		 * 跳转部分
		 */
		$nav['jump_page'] = "<li><select onchange=\"javascript:window.location='{$config['BASE_URL']}&amp;{$st}=' + this.options[this.selectedIndex].value\">\n";
		for($i=0; $i<=$page_num; $i++){
			$nav['jump_page'] .= "	<option value={$i}";
			if($i == $config['CUR_ST']){
				$nav['jump_page'] .= " selected";
			}
			$nav['jump_page'] .= ">跳转至 ".($i+1)." 页</option>\n";
		}
		$nav['jump_page'] .= "</select></li>";
		return "<ul>{$nav['first_page']} {$nav['prev_page']} {$nav['next_page']} {$nav['last_page']} {$nav['jump_page']}</ul>";
	}

	function alert($msg='', $url = null)
	{
		$js_code = "<script language='javascript'>";
		if($msg)
		{
			$js_code.="alert(\"$msg\");";
		}
		$js_code .= is_null($url)
					?"history.go(-1);</script>"
					:"window.location='{$url}';</script>";
		exit($js_code);
	}
	
	function metaGo($url, $delay = 0)
	{
		exit("<meta HTTP-EQUIV=REFRESH CONTENT=\"{$delay};URL={$url}\">");
	}

	function hardFlush($string) {
    	echo '                                                  ';
    	echo '                                                  ';
    	echo '                                                  ';
    	echo '                                                  ';
		echo '                                                  ';
		echo $string;
    	flush();
    	ob_clean();
	}

	function saveFile($filepath, $str, $string_mode="w")
	{
		$fp = fopen($filepath, $string_mode);
		if($fp == false)
			return false;
		flock($fp, LOCK_EX);
		fwrite($fp,$str);
		flock($fp, LOCK_UN);
		fclose($fp);
		chmod ($filepath, 0755);
		return is_file($filepath);
	}	

	function getContent($url, $max = 3){
		$mi = 0;
		do{
			$tmp_content = @file_get_contents($url);
			$mi++;
			if(strlen($tmp_content) > 0 || $mi > $max){
				$t = false;
			}else{
				$t = true;
			}
		}while($t);
		if(strlen($tmp_content)>0){
			return $tmp_content;
		}else{
			return false;
		}
	}

	function getArrayKey($array)
	{
		$array2 = array();
		foreach($array as $key => $v)
		{
			array_push($array2, $key);
		}
		return $array2;
	}
	
	function getIp() {
		$ip = false;
		if (!empty($_SERVER["HTTP_CLIENT_IP"])) {
			$ip = $_SERVER["HTTP_CLIENT_IP"];
		}
		if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$ips = explode (", ", $_SERVER['HTTP_X_FORWARDED_FOR']);
			if ($ip) {
				array_unshift($ips, $ip);
				$ip = false;
			}
			for ($i = 0; $i < count($ips); $i++) {
				if (!eregi ("^(10|172\.16|192\.168)\.", $ips[$i])) {
					$ip = $ips[$i];
					break;
				}
			}
		}
		return ($ip ? $ip : $_SERVER['REMOTE_ADDR']);
	}

	function substring($string, $length, $etc = null)
	{
		if ($length == 0)
        return '';

		if (strlen($string) > $length) {
			$tmpstr = "";
			$strlen = $length;
			for($i = 0; $i < $strlen; $i++) {
				if(ord(substr($string, $i, 1)) > 0xa0) {
					$tmpstr .= substr($string, $i, 2);
					$i++;
				} else{
					$tmpstr .= substr($string, $i, 1);
				}
			}
			return $tmpstr.$etc;
		} else {
			return $string;
		}
	}

	function getSortSelect($name, $sort_array, $select_id = 0, $action=null)
	{
		$string = "<select name='{$name}' {$action}>\n";
		$string .= "<option value='0'>无上级分类</option>\n";
		foreach($sort_array as $v)
		{
			$string .= "<option value='{$v['sort_id']}'";
			if($v['sort_id'] == $select_id)
			{
				$string .= " selected";
			}
			$string .= ">";
			if($v['layer'] > 0)
			{
				$string .= str_repeat("&nbsp;",$v['layer'])."├";
			}
			$string .= "{$v['name']}</option>\n";
		}
		$string .= "</select>";
		return $string;
	}
	
	function mkdir($dirname)
	{
		$dir_array = explode("/", $dirname);
		$tmp_dir = BASE_PATH . "/";
		for($i=0; $i<count($dir_array); $i++)
		{
			$tmp_dir .= $dir_array[$i] . "/";
			if(!is_dir($tmp_dir))
			{
				if(!mkdir($tmp_dir, 0777))
				{
					return false;
				}
			}
		}
		return true;
	}

	function getFilename($file)
	{
		$arr = pathinfo($file);
		return $arr['basename'];
	}

	function getDirname($file)
	{
		$arr = parse_url($file);
		if(isset($arr['host']))
		{
			return $arr['host'];
		}
		else
		{
			return false;
		}
	}

	function cleanValue($val)
	{
		$val = str_replace('"', "&#34;", $val);
		$val = str_replace("'", "&#39;", $val);
		return $val;
	}

	function returnValue($val)
	{
		$val = str_replace("&#34;", '"', $val);
		$val = str_replace("&#39;", "'", $val);
		return $val;
	}

	function createDir($data)
	{
		$path = BASE_PATH ."/";
		$dir = "{$data}/".date("Y")."/";
		if(!is_dir($path . $dir))
		{
			if(!mkdir($path . $dir, 0777))
			{
				return false;
			}
		}
		$dir .= date("m")."/";
		if(!is_dir($path . $dir))
		{
			if(!mkdir($path . $dir, 0777))
			{
				return false;
			}
		}
		return $dir;
	}

	function getExtension($path)
	{
		$array = pathinfo($path);
		return strtolower($array['extension']);
	}
	
}
?>