<?php
/***********************************************
 * SpeedPHP网络请求类扩展类
 * 文件: /Extensions/spHttp.php
 * 说明: 网络请求类扩展类
 * 作者: Myxf
 * 更新: 2015年5月14日
 ***********************************************/

/**
 * 网络请求类扩展类
 */
class spHttp {

	/**
 	 * post方法
 	 * @access public
 	 * @param string $url 请求地址
 	 * @param string $data 提交数据
 	 * @param string $cookies 附加cookie
 	 */
	function vpost($url,$data,$cookies = ""){
        $urldecode = base64_decode($url);
		$curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $urldecode);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 1);
        curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curl, CURLOPT_AUTOREFERER, 1);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($curl, CURLOPT_COOKIEFILE, $cookies);
        $tmpInfo = curl_exec($curl);
        if (curl_errno($curl)) {
           return 'Error';
        }
        curl_close($curl);
        return $tmpInfo;
    }

    /**
 	 * get方法
 	 * @access public
 	 * @param string $url 请求地址
 	 * @param string $cookies 附加cookie
 	 */
	function vget($url,$cookies = ""){
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 1);
        curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curl, CURLOPT_AUTOREFERER, 1);
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($curl, CURLOPT_COOKIEFILE, $cookies);
        $tmpInfo = curl_exec($curl);
        if (curl_errno($curl)) {
           return 'Error';
        }
        curl_close($curl);
        return $tmpInfo;
    }


}

/* End of this file */