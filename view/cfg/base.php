<?php
//定义根路径
	$basedir=str_replace('\\','/',dirname(dirname(__FILE__))).'/';
	define(BASE_DIR,$basedir);
	unset($basedir);
	define(BASE_URL,'http://127.0.0.1/http/ops_script/view/');
//定义常数参数
	define(CONF_DIR,'cfg/');
	define(INC_DIR,'inc/');
	define(CSS_DIR,'css/');
	define(INC_IDX,'idx.inc.php');
//加载页面
	require_once(BASE_DIR.INC_DIR.INC_IDX);
echo '1';
?>
