<?php session_start();
require_once dirname(dirname(__FILE__)).'/cfg/base.cfg.php';
require_once BASE_DIR.INC_DIR.INC_DB;

if($_SESSION[menu_sub_id]==''){
	$returnarr[content][tips_nav]='不可直接调用，请通过正规方式访问';
	require_once BASE_DIR.MDL_DIR.MDL_RETURN;
	exit;
}

$db_modify=new DBSql();
switch ($_SESSION[menu_sub_id]) {
	case 4:
		$tmpstr=explode(',',$_POST[tmpstr]);
		$returnarr[0]=array($_POST[tmpstr]);
		$returnarr[1]=array($_POST[name]);
		break;
	;;
	default:
		$returnarr[0]=array('参数有误，请确认');
}

unset($tmpstr);

require_once BASE_DIR.MDL_DIR.MDL_RETURN;
?>