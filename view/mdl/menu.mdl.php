<?php session_start();
require_once dirname(dirname(__FILE__)).'/cfg/base.cfg.php';
require_once BASE_DIR.INC_DIR.INC_DB;

if ($_SESSION [loginflag] == 1 && $_SESSION[loginduration]>time()) {
	$returnarr = array (
			'show' => array (
					'main_left',
					'main_right'
			),
			'hide' => array (
					'main_login'
			),
			'content'=>array(
					'span_info'=>$_SESSION[loginname]
			)
	);
} else {
	$returnarr = array (
			'hide' => array (
					'main_left',
					'main_right' 
			),
			'show' => array (
					'main_login' 
			) 
	);
	if ($_SESSION[loginduration]<=time() && !is_null($_SESSION[loginduration])){
		$returnarr[content]=array(
				'tips_login'=>'<span style="float:left;font-size:12px;color:green"><b><i>登录超时，请重新登录</b></i></span>'
		);
	}
	$_SESSION=array();
	session_destroy();
	echo json_encode ($returnarr);
}
?>