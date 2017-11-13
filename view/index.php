<?php session_start();

//加载常量配置
require_once str_replace('\\','/',dirname(__FILE__)).'/cfg/base.cfg.php';

require_once BASE_DIR.INC_DIR.INC_LOG;

$log_index=new LogHandle();

//$loginfo='IP:'.$_SERVER[REMOTE_ADDR].'METHOD:'.$_SERVER[REQUEST_METHOD].'PAGE:'.$_SERVER[REQUEST_URI].'PARAS:'.$_SERVER[QUERY_STRING];
//$log->logprint(FLAG_LOG_INFO, LEVEL_LOG_INFO, $loginfo);

//加载页面
require_once BASE_DIR.MDL_DIR.MDL_WEB;
?>
