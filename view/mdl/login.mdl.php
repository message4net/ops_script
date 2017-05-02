<?php session_start();
require_once dirname(dirname(__FILE__)).'/cfg/base.cfg.php';
require_once BASE_DIR.INC_DIR.INC_DB;
$db_login=new DBSql();
$tmpusername=$_POST[username];
$tmpuserpassword=$_POST[userpassword];
//$tmpusername='fanyd';
//$tmpuserpassword='fanyd12';
$tmploginsql='select * from user where name=\''.$tmpusername.'\' and password=\''.$tmpuserpassword.'\';';
$result_login=$db_login->select($tmploginsql);
if (!empty($result_login)) {
	$_SESSION[loginname]=$result_login[0][name];
	$_SESSION[loginpasswd]=$result_login[0][password];
	$_SESSION[loginduration]=time()+86400;
	$_SESSION[loginflag]=1;
	require_once BASE_DIR.MDL_DIR.MDL_MENU;
}else{
	$returnarr=array(
			'content'=>array(
					'tips_login'=>'<span style="float:left;font-size:12px;color:green"><b><i>用户名或密码有误，请重新输入</b></i></span>'
			)
	);
	echo json_encode($returnarr);
}
?>