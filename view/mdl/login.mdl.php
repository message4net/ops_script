<?php session_start();

require_once str_replace('\\','/',dirname(dirname(__FILE__))).'/cfg/base.cfg.php';
require_once BASE_DIR.INC_DIR.INC_DB;
$db_login=new DBSql();
$tmpusername=$_POST[username];
$tmpuserpassword=$_POST[userpassword];
////$tmpusername='fanyd';
////$tmpuserpassword='fanyd12';
$tmploginsql='select role_id,name,password from user where name=\''.$tmpusername.'\' and password=\''.$tmpuserpassword.'\';';
$result_login=$db_login->select($tmploginsql);


//$returnarr[0]=array($result_login[0][name]);
//echo json_encode($returnarr);

if (!empty($result_login)) {
	$_SESSION[loginid]=$result_login[0][role_id];
	$_SESSION[loginname]=$result_login[0][name];
	$_SESSION[loginpasswd]=$result_login[0][password];
	$_SESSION[loginduration]=time()+86400;
	$_SESSION[loginflag]=1;
	require_once BASE_DIR.MDL_DIR.MDL_MENU;
	exit;
}else{
	$returnarr=array(
			'content'=>array(
					'tips_login'=>'<span style="float:left;font-size:12px;color:green"><b><i>用户名或密码有误，请重新输入</b></i></span>'
			),
	);
}

unset($db_login,$tmploginsql,$tmpusername,$tmpuserpassword,$result_login);

require_once BASE_DIR.MDL_DIR.MDL_RETURN;
?>