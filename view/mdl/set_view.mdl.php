<?php session_start();
require_once str_replace('\\','/',dirname(dirname(__FILE__))).'/cfg/base.cfg.php';
require_once BASE_DIR.INC_DIR.INC_DB;
//require_once BASE_DIR.INC_DIR.FNC_TIP;
require_once BASE_DIR.INC_DIR.INC_FUNC;

if($_SESSION[menu_sub_id]==''){
	$returnarr[content][tips_nav]='不可直接调用，请通过正规方式访问';
	require_once BASE_DIR.MDL_DIR.MDL_RETURN;
	exit;
}

$db_set_view=new FuncNavGen($_SESSION[menu_sub_id]);
$navtailname='设置';
$navmenusubid='-1';
$funccategoryid=3;
$tablenamesql='select * from menu where id='.$_SESSION[menu_sub_id];
$tablenameresult=$db_set_view->select($tablenamesql);

if($_POST[recid]!=''){
	switch ($_SESSION[menu_sub_id]) {
		case 4:
			$sql_pri_name='select * from '.$tablenameresult[0][tablename].' where id='.$_POST[recid];
			$sql_pri_dtl_rel='select * from role_menu where role_id='.$_POST[recid];
			$result_pri_name=$db_set_view->select($sql_pri_name);
			$result_pri_dtl_rel=$db_set_view->select($sql_pri_dtl_rel);
			$html_return_content.='<table id="'.CSS_ID_TABLE_CONTENT.'"><tr><td colspan="2">权限名称</td><td>'.$result_pri_name[0][name].'</td></tr>';
			foreach ($result_pri_dtl_rel as $val){
				$sql_pri_view='select * from wordbook where type in (1,2) and menu_sub_id='.$val[menu_sub_id].' order by type,seq';
				$sql_pri_mod='select * from wordbook where type in (3,5) and menu_sub_id='.$val[menu_sub_id].' order by type,seq';
				$sql_pri_dtl_name='select * from menu where id='.$val[menu_sub_id].';';
				$result_pri_view=$db_set_view->select($sql_pri_view);
				$result_pri_mod=$db_set_view->select($sql_pri_mod);
				$result_pri_dtl_name=$db_set_view->select($sql_pri_dtl_name);
				$html_return_content.='<tr><td rowspan="2">'.$result_pri_dtl_name[0][name].'</td><td><input type="checkbox" name="modall" id="'.$result_pri_dtl_name[0][id].'">操作</td><td id="'.CSS_ID_TD_STR_A.'" name="'.$result_pri_dtl_name[0][id].'">';
				foreach ($result_pri_mod as $val1){
					if($val1[flag_set]==0){
						$html_return_content.='<input id="'.$val1[id].'" name="mod'.$result_pri_dtl_name[0][id].'" type="checkbox">'.$val1[name];
					}else{
						$html_return_content.='<input id="'.$val1[id].'" name="mod'.$result_pri_dtl_name[0][id].'" type="checkbox" disabled="disabled" checked="checked">'.$val1[name];
					}
				}
				$html_return_content.='</td></tr><tr><td><input type="checkbox" name="viewall" id="'.$result_pri_dtl_name[0][id].'">浏览</td><td id="'.CSS_ID_TD_STR_B.'">';
				foreach ($result_pri_view as $val2){
					if($val2[flag_set]==0){
						$html_return_content.='<input id="'.$val2[id].'" name="view'.$result_pri_dtl_name[0][id].'" type="checkbox">'.$val2[name];
					}else{
						$html_return_content.='<input id="'.$val2[id].'" name="view'.$result_pri_dtl_name[0][id].'" type="checkbox" disabled="disabled" checked="checked">'.$val2[name];
					}
				}
				$html_return_content.='</td></tr>';
			}
			break;
			;;
		default:
			$returnarr[content][tips]='修改记录唯一id或菜单有误，请确认:post_id:'.$_POST[recid];
			require_once BASE_DIR.MDL_DIR.MDL_RETURN;
			exit;
	}
}

$tips_navhtml=$db_set_view->gen_navpos_html($navmenusubid,$navtailname,'');
//$tips_navhtml=genTips($tablenameresult,$tablenameresult[0][name].'->设置','');
$html_return_content.='<tr><td colspan="3"><button id="m_v_s_set_'.$_POST[recid].'">保存</button></td></tr></table>';

$returnarr[content][menu_func]=$db_set_view->gen_func_html($funccategoryid);

$returnarr[content][content]=$html_return_content;
$returnarr[content][tips_nav]=$tips_navhtml;
$returnarr[content][tips]='';
$returnarr[content][page_bar]='';

unset($tablenamesql,$html_return_content,$tips_navhtml,$result_pri_dtl_name,$sql_pri_dtl_name,$sql_pri_mod,$sql_pri_name,$sql_pri_view,$result_pri_mod,$result_pri_name,$result_pri_view);
unset($tips_navhtml,$db_set_view,$tableheadsql,$tableheadresult,$tablebodysql_query,$addhtml,$val,$tablenamesql,$addhtml,$tmpresult,$rec1marr,$reccontentsql,$rec1msql,$reccontentresult,$rec1mresult,$tmpcount);
require_once BASE_DIR.MDL_DIR.MDL_RETURN;
?>