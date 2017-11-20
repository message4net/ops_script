<?php session_start();
require_once str_replace('\\','/',dirname(dirname(__FILE__))).'/cfg/base.cfg.php';
require_once BASE_DIR.INC_DIR.INC_DB;
require_once BASE_DIR.INC_DIR.INC_FUNC;

require_once BASE_DIR.INC_DIR.INC_LOG;

$log_modify_view=new LogHandle();

if($_SESSION[menu_sub_id]==''){
	$returnarr[content][tips_nav]='不可直接调用，请通过正规方式访问';
	require_once BASE_DIR.MDL_DIR.MDL_RETURN;
	exit;
}

$db_modify_view=new FuncNavGen($_SESSION[menu_sub_id]);
$navmenusubid='-1';
$funccategoryid=2;

$tablenamesql='select * from menu where id='.$_SESSION[menu_sub_id];
$tableheadsql='select * from wordbook where type=1 and menu_sub_id='.$_SESSION[menu_sub_id].' order by seq';
$table1msql='select * from wordbook where type=6 and menu_sub_id='.$_SESSION[menu_sub_id].' order by seq';
$table1ssql='select * from wordbook where type=8 and menu_sub_id='.$_SESSION[menu_sub_id].' order by seq';
$tableheadresult=$db_modify_view->select($tableheadsql);
$tablenameresult=$db_modify_view->select($tablenamesql);
$table1mresult=$db_modify_view->select($table1msql);
$table1sresult=$db_modify_view->select($table1ssql);
if ($table1sresult){
	foreach ($table1sresult as $val){
		$count=0;
		$result_arr_1s=$db_modify_view->select($val[sqlstr_head]);
		if($result_arr_1s){
			foreach ($result_arr_1s  as $val1){
				$arr_1s[$val[id]][$val1[id]]=$val1[name];
			}
		}	
	}
}

if($_POST[recid]!=''){
	switch ($_SESSION[menu_sub_id]) {
		case 4:
			$reccontentsql='select * from '.$tablenameresult[0][tablename].' where id='.$_POST[recid];
			$rec1msql='select * from role_menu where role_id='.$_POST[recid];
			$reccontentresult=$db_modify_view->select($reccontentsql);
			$rec1mresult=$db_modify_view->select($rec1msql);
			$tmpcount=0;
			foreach ($rec1mresult as $val){
				$rec1marr[$tmpcount]=$val[menu_sub_id];
				$tmpcount++;
			}
			break;
			;;
		case 5:
			$reccontentsql='select * from '.$tablenameresult[0][tablename].' where id='.$_POST[recid];
			$rec1msql='select * from role_menu where role_id='.$_POST[recid];
			$reccontentresult=$db_modify_view->select($reccontentsql);
			$rec1mresult=$db_modify_view->select($rec1msql);
			$tmpcount=0;
			foreach ($rec1mresult as $val){
				$rec1marr[$tmpcount]=$val[menu_sub_id];
				$tmpcount++;
			}
			break;
			;;
		default:
			$returnarr[content][tips]='修改记录唯一id或菜单有误，请确认:post_id:'.$_POST[recid];
			require_once BASE_DIR.MDL_DIR.MDL_RETURN;
			exit;
	}
}

$tablebodysql_query='';
$addhtml='<table>';
foreach ($tableheadresult as $val) {
	if ($val[colnameid]=='id'){
		continue;
	}else{
		$tablebodysql_query.=$val[colnameid].',';
		$addhtml.='<tr><td>'.$val[name].':</td><td><input id="'.$val[colnameid].'" type="text" value="'.$reccontentresult[0][$val[colnameid]].'"/></td></tr>';
	}
}

foreach ($table1sresult as $val){
	$addhtml.='<tr><td>'.$val[name].'</td><td>';
	if($arr_1s[$val[id]]){
		foreach ($arr_1s[$val[id]] as $key1=>$val1){
			$addhtml.='<input name="arr1s" type="radio" value="'.$key1.'" />'.$val1;
		}
	}
	$addhtml.='</td></tr>';
}

foreach ($table1mresult as $val) {
	$addhtml.='<tr>';
	$tmpresult=$db_modify_view->select($val[sqlstr_head]);
	$addhtml.='<td>'.$val[name].':</td><td>';
	foreach ($tmpresult as $val1){
		if($val1[id]==7){
			$addhtml.='<input id="'.$val1[id].'" type="checkbox" disabled="disabled" checked="checked"/>'.$val1[name].'<br />';
		}else{
			if($rec1marr){
				if(in_array($val1[id], $rec1marr)){
					$addhtml.='<input id="'.$val1[id].'" type="checkbox" checked="checked"/>'.$val1[name].'<br />';
				}else{
					$addhtml.='<input id="'.$val1[id].'" type="checkbox" />'.$val1[name].'<br />';
				}
			}else {
				$addhtml.='<input id="'.$val1[id].'" type="checkbox" />'.$val1[name].'<br />';
			}
		}
	}
	$addhtml.='</td></tr>';
}

if($_POST[recid]==''){
	$navtailname='新增';
//	$tips_navhtml=genTips($tablenameresult,$tablenameresult[0][name].'->新增','');
	$addhtml.='<tr><td colspan="2"><button id="m_v_s_add">保存</button></td></tr></table>';
}else{
	$navtailname='修改';
//	$tips_navhtml=genTips($tablenameresult,$tablenameresult[0][name].'->修改','');
	$addhtml.='<tr><td colspan="2"><button id="m_v_s_mod_'.$_POST[recid].'">保存</button></td></tr></table>';
}

$tips_navhtml=$db_modify_view->gen_navpos_html($navmenusubid,$navtailname,'');

$returnarr[content][menu_func]=$db_modify_view->gen_func_html($funccategoryid);
$returnarr[content][content]=$addhtml;
$returnarr[content][tips_nav]=$tips_navhtml;
$returnarr[content][tips]='';
$returnarr[content][page_bar]='';

unset($tips_navhtml,$db_modify_view,$tableheadsql,$tableheadresult,$tablebodysql_query,$addhtml,$val,$tablenamesql,$addhtml,$tmpresult,$rec1marr,$reccontentsql,$rec1msql,$reccontentresult,$rec1mresult,$tmpcount);
require_once BASE_DIR.MDL_DIR.MDL_RETURN;
?>