<?php
define("SP_PATH",dirname(__FILE__)."/SpeedPHP");
define("APP_PATH",dirname(__FILE__));
define("APP_URL",'http://'.$_SERVER['HTTP_HOST'].substr($_SERVER['PHP_SELF'],0,strrpos($_SERVER['PHP_SELF'],'/')+1));
//判断是否安装
if(file_exists(APP_PATH."/install/") && !file_exists(APP_PATH."/install/install.lock")){
	header('Location:install/install.php');
	exit(); 
}
require(APP_PATH."/config.php");
$spConfig = array(
	'mode' => 'release', // 部署模式
	'default_controller' => 'guestbook',
	"db" => array(
		'host' => $host,
		'login' => $login,
		'password' => $password,
		'database' => $database,
		'prefix' => $prefix,
	),
	
	'view' => array(
		'enabled' => TRUE, // 开启视图
		'config' =>array(
			'template_dir' => APP_PATH.'/tpl', // 模板目录
			'compile_dir' => APP_PATH.'/tmp', // 编译目录
			'cache_dir' => APP_PATH.'/tmp', // 缓存目录
			'left_delimiter' => '<{',  // smarty左限定符
			'right_delimiter' => '}>', // smarty右限定符
		),),
	
	'html' => array(  // HTML生成配置
		'enabled' => TRUE, // 开启HTML生成功能
		'safe_check_file_exists' => TRUE, // 获取URL时，检查物理HTML文件是否存在，如文件不存在，则返回安全的动态地址
		'file_root_name' => 'html', // 静态文件生成的根目录名称，设置为空则是直接在入口文件的同级目录生成
	),

	
	'ext' => array(
		'spIpArea'=>array(
				'charset' => 'utf-8',//返回的信息编码
				'ipdata' => 'QQWry',//选择的IP信息库 目前只支持2个库 mini、QQWry
				'ipdata_path' => ''//IP库文件默认目录：/include
				),
		
		'spVerifyCode' => array( //验证码扩展
				'width' => 80, //验证码宽度
				'height' => 25, //验证码高度
				'length' => 4, //验证码字符长度
				'bgcolor' => '#FFFFFF', //背景色
				'noisenum' => 50, //图像噪点数量
				'fontsize' => 20, //字体大小
				'fontfile' => 'Alte.ttf', //字体文件
				'format' => 'jpg', //验证码输出图片格式
			),
		
		),
		
);
require(SP_PATH."/SpeedPHP.php");
//全局变量
define('WEBNAME','随意留言板');
define('VERSIONNUMBER','1.2');

// 这里是入口文件全局位置
import(APP_PATH.'/include/functions.php');

spRun();