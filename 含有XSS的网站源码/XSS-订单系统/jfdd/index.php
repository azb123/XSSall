<?php
include_once("config.php"); //包含文件
include('lib/functions.php');


  $tpl->assign(array(
"title" => $CONF['web']['title'], 
"ROOT_ADMIN_PATH" => $ROOT_ADMIN_PATH,
"copyright"=>$CONF['web']['copyright'],
"keywords"=>$CONF['web']['keyword'],
"description"=>$CONF['web']['description'],
"ip"=>GetIP(),




));

$tpl->display('index.html');
?>



