<?php session_start();
require_once str_replace('\\','/',dirname(dirname(__FILE__))).'/cfg/base.cfg.php';
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
	case m_v_s_set4:
		$returnarr[0][0]='恭喜，正在调试权限set功能';
		$tmpstrarr=explode(',',$_POST[tmpstr]);
		if($_POST[recid]==1){
			$tmptips='默认权限无法修改，请联系管理员';
			break;
		}else{
			$tmprecid=$_POST[recid];
		}
//		$tmpname=$_POST[name];
		$tmptips='';
//		$tmpsql='select count(*) ct from role where name=\''.$tmpname.'\' and id='.$tmprecid.';';
		$tmpsql1='select wordbook_id menu_sub_id from role_func where role_id='.$tmprecid.' and menu_sub_id='.$_SESSION[menu_sub_id].';';
		$tmproleoriginmenuresult=$db_modify->select($tmpsql1);
		$count=0;
		if($tmproleoriginmenuresult[0]!=''){
			foreach ($tmproleoriginmenuresult as $val){
				$tmproleoriginmenuarr[$count]=$val[menu_sub_id];
				$count++;
			}
		}else{
			$tmproleoriginmenuarr=array();
		}
//		$tmpresult=$db_modify->select($tmpsql);
		$tmpinsertarr=array_diff($tmpstrarr,$tmproleoriginmenuarr);
		$tmpdelarr=array_diff($tmproleoriginmenuarr,$tmpstrarr);
//		if($tmpresult[0][ct]==0){
//			$tmpupdatesql='update role set name=\''.$tmpname.'\' where id='.$tmprecid.';';
//			$tmptips.='权限名称更新成功,';
//			$db_modify->update($tmpupdatesql);
//		}else{
//			$tmptips.='权限名称不需改变,';
//		}
		if(count($tmpinsertarr)<>0){
			$tmpinssql='';
			foreach($tmpinsertarr as $val) {
				$tmpinssql.='('.$tmprecid.','.$_SESSION[menu_sub_id].','.$val.'),';
			}
			$tmpinssql=substr($tmpinssql,0,strlen($tmpinssql)-1).';';
			$tmpinssql1='insert into role_func values '.substr($tmpinssql,0,strlen($tmpinssql)-1).';';
			$db_modify->insert($tmpinssql1);
			$tmptips.='功能明细设置成功,';
		}else{
			$tmptips.='功能明细无需设置,';
		}
		if(count($tmpdelarr)<>0){
			$tmpdelsql='';
			foreach ($tmpdelarr as $val) {
				$tmpdelsql.=$val.',';
			}
			$tmpdelsql1='delete from role_func where role_id='.$tmprecid.' and menu_sub_id in ('.substr($tmpdelsql,0,strlen($tmpdelsql)-1).');';
			$db_modify->delete($tmpdelsql1);
			$tmptips.='功能明细删除成功,';
		}else{
			$tmptips.='功能明细无需删除,';
		}
		$returnarr[content][tips]='<div style="float:left">'.substr($tmptips,0,strlen($tmptips)-1).'</div>';
		break;
	;;
	case m_v_s_add4:
		$tmpsql='select count(*) ct from role where name=\''.$_POST[name].'\';';
		$tmpresult=$db_modify->select($tmpsql);
		if($tmpresult[0][ct]==0){
			$tmpname=$_POST[name];
			$tmpsql1='insert into role (name) values (\''.$tmpname.'\');';
			$db_modify->insert($tmpsql1);
			if($_POST[tmpstr]!='ZZZ'){
				$tmpsql2='';
				$tmpstrarr=explode(',',$_POST[tmpstr]);
				foreach ($tmpstrarr as $val1){
//					$tmpsql2='insert into menu_role select id,\''.$val1.'\' from role where name=\''.$tmpname.'\';';
					$tmpsql2='insert into role_menu select id,\''.$val1.'\' from role where name=\''.$tmpname.'\';';
					$db_modify->insert($tmpsql2);
				}
			}
			$tmptips='已成功创建角色';
		}else{
			$tmptips='权限名称重复，请重新输入';
			$returnarr[fcs]=array('name');
		}
		break;
	;;
	case m_v_s_mod4:
		if($_POST[tmpstr]=='ZZZ'){
			$tmpstrarr=array();
		}else{
			$tmpstrarr=explode(',',$_POST[tmpstr]);
		}
		if($_POST[recid]==1){
			$tmptips='默认权限无法修改，请联系管理员';
			break;
		}else{
			$tmprecid=$_POST[recid];
		}
		$tmpname=$_POST[name];
		$tmptips='';
		$tmpsql='select count(*) ct from role where name=\''.$tmpname.'\' and id='.$tmprecid.';';
		//$tmpsql1='select menu_id from menu_role where role_id='.$tmprecid.';';
		$tmpsql1='select menu_sub_id from role_menu where role_id='.$tmprecid.';';
		$tmproleoriginmenuresult=$db_modify->select($tmpsql1);
		$count=0;
		if($tmproleoriginmenuresult[0]!=''){
			foreach ($tmproleoriginmenuresult as $val){
				$tmproleoriginmenuarr[$count]=$val[menu_sub_id];
				$count++;
			}
		}else{
			$tmproleoriginmenuarr=array();
		}
		$tmpresult=$db_modify->select($tmpsql);
		$tmpinsertarr=array_diff($tmpstrarr,$tmproleoriginmenuarr);
		$tmpdelarr=array_diff($tmproleoriginmenuarr,$tmpstrarr);
		if($tmpresult[0][ct]==0){
			$tmpupdatesql='update role set name=\''.$tmpname.'\' where id='.$tmprecid.';';
			$tmptips.='权限名称更新成功,';
			$db_modify->update($tmpupdatesql);
		}else{
			$tmptips.='权限名称不需改变,';
		}
		if(count($tmpinsertarr)<>0){
			$tmpinssql='';
			foreach($tmpinsertarr as $val) {
				$tmpinssql.='('.$tmprecid.','.$val.'),';
				//$tmpinssql.='('.$tmprecid.','.$val.'),';
			}
			$tmpinssql=substr($tmpinssql,0,strlen($tmpinssql)-1).';';
			//$tmpinssql1='insert into menu_role values '.substr($tmpinssql,0,strlen($tmpinssql)-1).';';
			$tmpinssql1='insert into role_menu values '.substr($tmpinssql,0,strlen($tmpinssql)-1).';';
			$db_modify->insert($tmpinssql1);
			$tmptips.='权限明细新增成功,';
		}else{
			$tmptips.='权限明细无需新增,';
		}
		if(count($tmpdelarr)<>0){
			$tmpdelsql='';
			foreach ($tmpdelarr as $val) {
				$tmpdelsql.=$val.',';
			}
			//$tmpdelsql1='delete from menu_role where role_id='.$tmprecid.' and menu_id in ('.substr($tmpdelsql,0,strlen($tmpdelsql)-1).');';
			$tmpdelsql1='delete from role_menu where role_id='.$tmprecid.' and menu_sub_id in ('.substr($tmpdelsql,0,strlen($tmpdelsql)-1).');';
			$db_modify->delete($tmpdelsql1);
			$tmptips.='权限明细删除成功,';
		}else{
			$tmptips.='权限明细无需删除,';
		}
		$returnarr[content][tips]='<div style="float:left">'.substr($tmptips,0,strlen($tmptips)-1).'</div>';
		break;
	;;
	case func_del4:
		if($_POST[recid]==1){
			$returnarr[content][tips]='默认权限无法修改，请联系管理员';
			break;
		}
		$tmpsql='delete from role where id='.$_POST[recid].';';
		//$tmpsql1='delete from menu_role where role_id='.$_POST[recid].';';
		$tmpsql1='delete from role_menu where role_id='.$_POST[recid].';';
		$tmptips='权限删除成功';
		$db_modify->delete($tmpsql1);
		$db_modify->delete($tmpsql);
		break;
	;;
	case func_delall4:
		$tmpstrarr=explode(',',$_POST[tmpstr]);
		$returnarr[0][0]=$tmpstrarr;
		if(in_array('1',$tmpstrarr)){
			$tmptips='默认权限无法修改，请重新选择删除内容';
			break;
		}else{
			if($_POST[tmpstr]!=''){
				foreach ($tmpstrarr as $val){
					//$tmpsql='delete from menu_role where role_id='.$val.';';
					$tmpsql='delete from role_menu where role_id='.$val.';';
					$db_modify->delete($tmpsql);
					$tmpsql1='delete from role where id='.$val.';';
					$db_modify->delete($tmpsql1);
					$tmptips='删除成功';
				}
			}else{
				$tmptips='无需删除';
			}
		}
		break;
	;;
	default:
		$tmptips='<div style="float:left">参数有误，请确认</div>';
}

$returnarr[content][tips]='<div style="float:left">'.$tmptips.'</div>';
unset($tmprecid,$tmproleoriginmenuresult,$tmproleoriginmenuarr,$tmpinsertarr,$tmpstrarr,$tmpname,$tmpresult,$tmpsql,$val,$tmpsql1,$tmpsql2,$val1,$db_modify,$tmptips,$tmpdelarr,$tmpinssql,$tmpinssql1);

require_once BASE_DIR.MDL_DIR.MDL_MAIN;
require_once BASE_DIR.MDL_DIR.MDL_RETURN;
?>