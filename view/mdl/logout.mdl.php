<?php session_start();
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