<?php session_start();
require_once str_replace('\\','/',dirname(dirname(__FILE__))).'/cfg/base.cfg.php';
require_once BASE_DIR.INC_DIR.INC_DB;
require_once BASE_DIR.INC_DIR.INC_FUNC;

require_once BASE_DIR.INC_DIR.INC_LOG;

$log_passwd_view=new LogHandle();
$returnarr[content][menu_func]='';
$returnarr[content][page_bar]='';
$returnarr[content][tips_nav]='<div style="float:left"><b>当前位置:<i>个人管理-&gt;修改密码</i></b></div>';


//$returnarr[0][0]='PASSWD_VIEW';

$returnarr[content][content]=<<<_EOF
	<table><tr><td>原密码:</td><td><input id="op" type="text"/></td><tr>
		<tr><td>新密码:</td><td><input id="np" type="text"/></td><tr>
		<tr><td>确认密码:</td><td><input id="rp" type="text"/></td><tr>
		<tr><td colspan="2"><button id="passwd_change">提交</button></td></tr>
	</table>
_EOF;

require_once BASE_DIR.MDL_DIR.MDL_RETURN;
?>