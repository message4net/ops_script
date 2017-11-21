<?php session_start();

/////###########
require_once str_replace('\\','/',dirname(dirname(__FILE__))).'/cfg/base.cfg.php';
require_once BASE_DIR.INC_DIR.INC_DB;

require_once BASE_DIR.INC_DIR.INC_LOG;
require_once BASE_DIR.INC_DIR.INC_MOD;

$log_modify=new LogHandle();
$self_modify=new ModSet();

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
		if($_POST[tmpstr]==''){
			$tmpstrarr=array();
		}else{
			$tmpstrarr=explode(',',$_POST[tmpstr]);
		}
		if($_POST[recid]==1 && FLAG_ADMIN==0){
			$tmptips='默认权限无法修改，请联系管理员';
			break;
		}else{
			$tmprecid=$_POST[recid];
		}
		$tmptips='';
		$tmpsql1='select wordbook_id menu_func_id from role_func where role_id='.$tmprecid.' and menu_sub_id='.$_POST[name].';';
		$tmproleoriginmenuresult=$db_modify->select($tmpsql1);
		$count=0;
		if($tmproleoriginmenuresult[0]!=''){
			foreach ($tmproleoriginmenuresult as $val){
				$tmproleoriginmenuarr[$count]=$val[menu_func_id];
				$count++;
			}
		}else{
			$tmproleoriginmenuarr=array();
		}
		$tmpinsertarr=array_diff($tmpstrarr,$tmproleoriginmenuarr);
		$tmpdelarr=array_diff($tmproleoriginmenuarr,$tmpstrarr);
		if(count($tmpinsertarr)<>0){
			$tmpinssql='';
			foreach($tmpinsertarr as $val) {
				$tmpinssql.='('.$tmprecid.','.$_POST[name].','.$val.'),';
			}
			$tmpinssql=substr($tmpinssql,0,strlen($tmpinssql)-1);
			$tmpinssql1='insert into role_func values '.$tmpinssql.';';
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
			$tmpdelsql1='delete from role_func where role_id='.$tmprecid.' and menu_sub_id='.$_POST[name].' and wordbook_id in ('.substr($tmpdelsql,0,strlen($tmpdelsql)-1).');';
			$db_modify->delete($tmpdelsql1);
			$tmptips.='功能明细删除成功,';
		}else{
			$tmptips.='功能明细无需删除,';
		}
		$returnarr[content][tips]='<div style="float:left">'.substr($tmptips,0,strlen($tmptips)-1).'</div>';
		break;
	;;
	case m_v_s_add4:
		$tmpsql='select count(*) ct from role where name=\''.$_POST[name].'\' and creator='.$_SESSION[loginroleid].';';
		$tmpresult=$db_modify->select($tmpsql);
		if($tmpresult[0][ct]==0){
			$tmpname=$_POST[name];
			$tmpsql1='insert into role (name,creator) values (\''.$tmpname.'\','.$_SESSION[loginroleid].');';
			$db_modify->insert($tmpsql1);
			if($_POST[tmpstr]!='ZZZ'){
				$tmpsql2='';
				$tmpstrarr=explode(',',$_POST[tmpstr]);
				foreach ($tmpstrarr as $val1){
					$tmpsql2='insert into role_menu select id,\''.$val1.'\' from role where name=\''.$tmpname.'\' and creator='.$_SESSION[loginroleid].';';
					$db_modify->insert($tmpsql2);
					//$returnarr[0][0].=$val1.',';
				}
				$tmpsql4='insert into role_func select a.id, b.menu_sub_id,b.id from role a, wordbook b,role_menu c where a.id=c.role_id and d.id=c.menu_sub_id and d.id=b.menu_sub_id and a.name=\''.$tmpname.'\' and b.flag_set=1 and d.flag_set=1 and type in (1,2,3,4,5,7) and creator='.$_SESSION[loginroleid].';';
				$db_modify->insert($tmpsql4);
			}
			$tmptips='已成功创建角色';
		}else{
			$tmptips='权限名称重复，请重新输入';
			$returnarr[fcs]=array('name');
		}
		break;
	;;
	case m_v_s_add5:
		$tmpsql='select count(*) ct from user where name=\''.$_POST[name].'\' and creator='.$_SESSION[loginroleid].';';
		$tmpresult=$db_modify->select($tmpsql);
		if($tmpresult[0][ct]==0){
			$tmpname=$_POST[name];
			$tmpsql1='insert into user (name,creator,password,role_id) values (\''.$tmpname.'\','.$_SESSION[loginroleid].',\''.$_POST[pwd].'\','.$_POST[pri].');';
			$db_modify->insert($tmpsql1);
			$tmptips='已成功创建用户';
			//$returnarr[0][0]=$tmpsql1;
		}else{
			$tmptips='用户名称重复，请重新输入';
			$returnarr[fcs]=array('name');
		}
		break;
		;;
	case m_v_s_mod5:
		if (FLAG_ADMIN==0 && $_POST[recid]==1){
			$tmptips='默认权限无法修改，请联系管理员';
			break;
		}else{
			$tmprecid=$_POST[recid];
		}
		$pwd=$_POST[pwd];
		$tmpname=$_POST[name];
		$tmpsql='select count(*) ct from user where name=\''.$_POST[name].'\' and creator='.$_SESSION[loginroleid].' and id='.$tmprecid.';';
		$tmpresult=$db_modify->select($tmpsql);
		if($tmpresult[0][ct]==0){
			$tmptips='已成功修改用户名称等信息';
		}else{
			$tmptips='已修改用户信息';
		}
		$tmpsql1='update user set username=\''.$tmpname.'\',password=\''.$pwd.'\',role_id='.$_POST[pri].' where id='.$tmprecid.';';
		//$db_modify->insert($tmpsql1);
		//$returnarr[0][0]=$tmpsql1;
		$returnarr[0][0]='#name:#'.$tmpname.'#pwd:#'.$pwd.'#pri:#'.$_POST[pri];
		break;
		;;
	case m_v_s_mod4:
		if($_POST[tmpstr]=='ZZZ'){
			$tmpstrarr=array();
		}else{
			$tmpstrarr=explode(',',$_POST[tmpstr]);
		}
		if (FLAG_ADMIN==0 && $_POST[recid]==1){
				$tmptips='默认权限无法修改，请联系管理员';
		}else{
				$tmprecid=$_POST[recid];
		}
		$tmpname=$_POST[name];
		$tmptips='';
		$tmpsql='select count(*) ct from role where name=\''.$tmpname.'\' and id='.$tmprecid.';';
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
				$tmpfuncsql='select id from wordbook where flag_set=1 and menu_sub_id='.$val.';';
				$tmpfuncresult=$db_modify->select($tmpfuncsql);
				if($tmpfuncresult){
					foreach ($tmpfuncresult as $vala)
						$tmpinssqlfunc='('.$tmprecid.','.$val.','.$vala[id].'),';
				}
			}
			$tmpinssql=substr($tmpinssql,0,strlen($tmpinssql)-1).';';
			$tmpinssql1='insert into role_menu values '.$tmpinssql.';';
			$db_modify->insert($tmpinssql1);
			if ($tmpinssqlfunc){
				$tmpinssqlfunc=substr($tmpinssqlfunc,0,strlen($tmpinssqlfunc)-1).';';
				$tmpinssqlfunc1='insert into role_menu values '.$tmpinssqlfunc.';';
				$db_modify->insert($tmpinssqlfunc1);
			}
			$tmptips.='权限明细新增成功,';
		}else{
			$tmptips.='权限明细无需新增,';
		}
		if(count($tmpdelarr)<>0){
			$tmpdelsql='';
			foreach ($tmpdelarr as $val) {
				$tmpdelsql.=$val.',';
			}
			$creatorall_str=$self_modify->gen_creatorsonstrall($tmprecid);
			$log_modify->logprint(FLAG_LOG_INFO, LEVEL_LOG_WARN, 'MOD4 DEL creatorall_str '.$creatorall_str);
			$tmpdelsql1='delete from role_menu where role_id in ('.$creatorall_str.') and menu_sub_id in ('.substr($tmpdelsql,0,strlen($tmpdelsql)-1).');';
			$tmpdelsqlfunc1='delete from role_func where role_id in ('.$creatorall_str.') and menu_sub_id in ('.substr($tmpdelsql,0,strlen($tmpdelsql)-1).');';
			$db_modify->delete($tmpdelsql1);
			$db_modify->delete($tmpdelsqlfunc1);
			$tmptips.='权限明细删除成功,';
		}else{
			$tmptips.='权限明细无需删除,';
		}
		$returnarr[content][tips]='<div style="float:left">'.substr($tmptips,0,strlen($tmptips)-1).'</div>';
		break;
	;;
	case func_del4:
		if(FLAG_ADMIN==0){
			if($_POST[recid]==1){
				$returnarr[content][tips]='默认权限无法修改，请联系管理员';
				break;
			}
		}
		$str_log_arr=$self_modify->del_role($_POST[recid],$_SESSION[loginroleid]);
		$log_modify->logprint(FLAG_LOG_INFO, LEVEL_LOG_WARN, $str_log_arr[0]);
		$tmptips=$str_log_arr[1];
		break;
	;;
	case func_del5:
		if(FLAG_ADMIN==0){
			if($_POST[recid]==1){
				$returnarr[content][tips]='默认权限无法修改，请联系管理员';
				break;
			}
		}
		$sql_del_user='delete from user where id='.$_POST[recid];
		$log_modify->logprint(FLAG_LOG_INFO, LEVEL_LOG_WARN, 'DEL SINGLE USERID '.$_POST[recid]);
		$db_modify->delete($sql_del_user);
		$tmptips='删除账号成功';
		break;
		;;
	case func_delall4:
		$tmpstrarr=explode(',',$_POST[tmpstr]);
		if(in_array('1',$tmpstrarr)){
			$tmptips='默认权限无法修改，请重新选择删除内容';
			break;
		}else{
			if($_POST[tmpstr]!=''){
				foreach ($tmpstrarr as $val){
					$str_log_arr=$self_modify->del_role($val,$_SESSION[loginroleid]);
					$log_modify->logprint(FLAG_LOG_INFO, LEVEL_LOG_WARN, $str_log_arr[0]);
					$tmptips=$str_log_arr[1];
				}
			}else{
				$tmptips='无需删除';
			}
		}
		break;
	;;
	case func_delall5:
		$tmpstrarr=explode(',',$_POST[tmpstr]);
		if(in_array('1',$tmpstrarr)){
			$tmptips='默认权限无法修改，请重新选择删除内容';
			break;
		}else{
			if($_POST[tmpstr]!=''){
				foreach ($tmpstrarr as $val){
					$sql_del_user='delete from user where user_id in ('.$_POST[tmpstr].');';
					$log_modify->logprint(FLAG_LOG_INFO, LEVEL_LOG_WARN, 'DELALL USERSTR '.$_POST[tmpstr]);
					//$db_modify->delete($sql_del_user);
					$returnarr[0][0]=$sql_del_user;
					$tmptips='成功删除用户';
				}
			}else{
				$tmptips='无需删除';
			}
		}
		break;
		;;
	default:
		$tmptips='<div style="float:left">参数有误，请确认</div>';
		//$z='';
		//foreach ($_POST as $k=>$v){
		//	$z.=$k.'#K#'.$v.'#V#';
		//}
		//$tmptips=$z;
		$tmptips=$_POST[fnc].'#F#'.$_SESSION[menu_sub_id].'#id#';
}

$returnarr[content][tips]='<div style="float:left">'.$tmptips.'</div>';
unset($tmprecid,$tmproleoriginmenuresult,$tmproleoriginmenuarr,$tmpinsertarr,$tmpstrarr,$tmpname,$tmpresult,$tmpsql,$val,$tmpsql1,$tmpsql2,$val1,$db_modify,$tmptips,$tmpdelarr,$tmpinssql,$tmpinssql1);

if (strpos($_POST[fnc],'del')!==false){
	require_once BASE_DIR.MDL_DIR.MDL_MAIN;
}else{
	require_once BASE_DIR.MDL_DIR.MDL_RETURN;
}
?>