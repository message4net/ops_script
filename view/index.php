<?php session_start();

//加载常量配置
require_once str_replace('\\','/',dirname(__FILE__)).'/cfg/base.cfg.php';

//加载页面
require_once BASE_DIR.MDL_DIR.MDL_WEB;

?>
