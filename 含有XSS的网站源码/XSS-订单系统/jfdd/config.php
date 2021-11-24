<?php
date_default_timezone_set('PRC');
$CONF['db'] = array(
	'host'	=>	'localhost',
	'user'	=>	'root',
	'psw'	=>	'123456',
	'name'	=>	'jf123',
	'prefix'	=>	'jf_',
	'charset'	=>	'utf8',
);

$CONF['admin'] = array(
	'adname'	=>	'admin',
	'adpws'	=>	'b76d7pKfcHNPmgerwK2am3JS8L2QKeEn6oflELVOpFtcFsE',
'password_key'	=>	'9ffb71239d1dd045fcea9587761710cb',
);
$CONF['web']=array(
'title'=>'军锋真人CS野战123',
'keyword'=>'军锋真人CS野战123',
'description'=>'军锋真人CS野战123',
	'copyright'=>'军锋真人CS野战123',
	'tmlap'	=>	'43',
	'verMsg'=>'V1.0',
	'lockfile'=>'install.lock',
);



/**
* 获取当前文件同指定网站相对根目录的目录层数 $ROOT_PATH 
* $ROOT_PATH 变量值末尾包含了路径的"/"符号，在引用时不要再加"/"
* example: $ROOT_PATH."images/logo.gif"
*/
$_self_path = ($_SERVER['PHP_SELF']) == "" ? $_SERVER['REQUEST_URI'] : ($_SERVER['PHP_SELF']) ;
$_path_array = explode("/",$_self_path);
$_path_count = count($_path_array);
$ROOT_PATH = "";
for ($i=0;$i<$_path_count-3;$i++) 
{
$ROOT_PATH = '../'.$ROOT_PATH;
}
$ROOT_ADMIN_PATH=$ROOT_PATH.'admin/';

define('JFDD_INSTALL',dirname(__FILE__));

define('JFDD_ROOT',preg_replace("/\\//","\\",$_SERVER['DOCUMENT_ROOT']));

include "class/Smarty.class.php";

$tpl = new Smarty();
$tpl->template_dir = JFDD_INSTALL . "/templates/";
$tpl->compile_dir = JFDD_INSTALL . "/templates_c/";
$tpl->config_dir = JFDD_INSTALL . "/configs/";
$tpl->cache_dir = JFDD_INSTALL . "/cache/";
$tpl->left_delimiter = '{';
$tpl->right_delimiter = '}';

$smarty->caching=true; //开启缓存，为false的时候缓存无效 
$smarty->cache_lifetime=6; //缓存时间，单位是秒 






$db = @mysql_connect($CONF['db']['host'], $CONF['db']['user'], $CONF['db']['psw']) ;
mysql_select_db($CONF['db']['name']);


?>