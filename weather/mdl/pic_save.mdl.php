<?php session_start();
require_once str_replace('\\','/',dirname(dirname(__FILE__))).'/cfg/base.cfg.php';
require_once BASE_DIR.INC_DIR.INC_DB;
require_once BASE_DIR.INC_DIR.INC_FUNC;

require_once BASE_DIR.INC_DIR.INC_LOG;

$log_modify_view=new LogHandle();

//$log_modify_view->logprint('1',LEVEL_LOG_ERR, '#POST##'.PIC_DIR.$_POST[name].'###name');
//$log_modify_view->logprint('1',LEVEL_LOG_ERR, '#RQST##'.$_REQUEST[name].'###name');
//$log_modify_view->logprint('1',LEVEL_LOG_ERR, '#GET##'.PIC_DIR.$_GET[name].'###name');


$file=BASE_DIR.PIC_DIR.$_REQUEST[name];

/*
$returnarr[0][0]=filesize($file).'##e';
require_once BASE_DIR.MDL_DIR.MDL_RETURN;
*/



$h = fopen($file, 'r');
header("Content-Type:application/octet-stream");
header("Content-disposition:attachment;filename=".$file.";");
//header("Accept-ranges:bytes");
header("Accept-Length:".filesize($file));

echo fread($h, filesize($file));
fclose($h);
exit


//readfile($file);

?>