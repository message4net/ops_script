<?php session_start();
require_once dirname(dirname(__FILE__)).'/cfg/base.cfg.php';
require_once BASE_DIR.INC_DIR.INC_DB;

if($_SESSION[menu_sub_id]==''){
	$returnarr[0][tips_nav]='不可直接调用，请通过正规方式访问';
	require_once BASE_DIR.MDL_DIR.MDL_RETURN;
	exit;
}

if($_POST[fnc]==''){
	$returnarr[0][tips_nav]='不可直接调用，请通过正规方式访问';
	require_once BASE_DIR.MDL_DIR.MDL_RETURN;
	exit;
}

$db_modify=new DBSql();
switch ($_POST[fnc].$_SESSION[menu_sub_id]) {
	case m_v_s_add4:
		$tmpsql='select count(*) ct from role where name=\''.$_POST[name].'\';';
		$tmpresult=$db_modify->select($tmpsql);
		if($tmpresult[0][ct]==0){
			$tmpstrarr=explode(',',$_POST[tmpstr]);
			$tmpname=$_POST[name];
			$tmpsql1='insert into role (name) values (\''.$tmpname.'\';';
			$tmpsql2='';
			foreach ($tmpstrarr as $val1){
				$tmpsql2.='insert into menu_role select \''.$val1.'\',id from role where name=\''.$tmpname.'\';';
			}
			$db_modify->insert($tmpsql1);
			$db_modify->insert($tmpsql2);
			
		}else{
			$returnarr[0]=array('权限名称重复，请重新输入');
			$returnarr[fcs]=array('name');
			require_once BASE_DIR.MDL_DIR.MDL_RETURN;
			exit;
		}
		break;
	;;
	default:
		$returnarr[0]=array('参数有误，请确认');
		require_once BASE_DIR.MDL_DIR.MDL_RETURN;
		exit;
}

unset($tmpstrarr,$tmpname,$tmpresult,$tmpsql,$val,$tmpsql1,$tmpsql2,$val1);

require_once BASE_DIR.MDL_DIR.MDL_RETURN;
?>