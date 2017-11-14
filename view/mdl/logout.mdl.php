<?php session_start();
require_once dirname(dirname(__FILE__)).'/cfg/base.cfg.php';

require_once BASE_DIR.INC_DIR.INC_LOG;

$log_logout=new LogHandle();


$_SESSION=array();
session_destroy();
$returnarr = array (
		'hide' => array (
				'main_left',
				'main_right' 
		),
		'show' => array (
				'main_login' 
		) 
);
echo json_encode($returnarr);
unset($returnarr);
?>