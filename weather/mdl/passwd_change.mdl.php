<?php session_start();
require_once str_replace('\\','/',dirname(dirname(__FILE__))).'/cfg/base.cfg.php';
require_once BASE_DIR.INC_DIR.INC_DB;
require_once BASE_DIR.INC_DIR.INC_FUNC;

require_once BASE_DIR.INC_DIR.INC_LOG;

$log_passwd_view=new LogHandle();
$db_passwd_view=new DBSql();

$returnarr[content][menu_func]='';
$returnarr[content][page_bar]='';
$returnarr[content][tips_nav]='<div style="float:left"><b>当前位置:<i>个人管理-&gt;修改密码</i></b></div>';

if ($_POST[np]!=$_POST[rp] || $_POST[np]==''){
	$returnarr[content][tips]='<div style="float:left">密码不能为空，或2次新密码输入不一致，请确认</div>';
	require_once BASE_DIR.MDL_DIR.MDL_RETURN;
}

$sql_vrf='select count(*) ct from user where password=\''.$_POST[op].'\' and id='.$_SESSION[loginuserid];
$result_vrf=$db_passwd_view->select($sql_vrf);

if ($result_vrf[0][ct]==0){
	$returnarr[content][tips]='<div style="float:left">原密码输入错误，请确认</div>';
	require_once BASE_DIR.MDL_DIR.MDL_RETURN;
}else{
	$sql_updt='update user set password=\''.$_POST[np].'\' where id='.$_SESSION[loginuserid];
	$returnarr[content][tips]='<div style="float:left">密码更新成功!</div>';
	$db_passwd_view->update($sql_updt);
}

//$returnarr[0][0]=$sql_updt.'##PASS_CG';

require_once BASE_DIR.MDL_DIR.MDL_RETURN;
?>
