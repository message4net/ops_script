<?php session_start();
require_once BASE_DIR.INC_DIR.INC_DB;

//echo $_POST[username];
if (empty($_POST[username])) {
	$returnarr=array(
			'hide'=>array(
					'main_login'=>'test'
			)
	);
}else{
	$returnarr=array(
			'content'=>array(
					'tips_login'=>'用户名或密码有误，请重新输入'
			)
	);
}
echo json_encode($returnarr);
?>