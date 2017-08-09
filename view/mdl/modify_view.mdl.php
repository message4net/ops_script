<?php session_start();
require_once dirname(dirname(__FILE__)).'/cfg/base.cfg.php';
require_once BASE_DIR.INC_DIR.INC_DB;
require_once BASE_DIR.INC_DIR.FNC_TIP;

if($_SESSION[menu_sub_id]==''){
	$returnarr[content][tips_nav]='不可直接调用，请通过正规方式访问';
	require_once BASE_DIR.MDL_DIR.MDL_RETURN;
	exit;
}

$db_modify_view=new DBSql();

$tablenamesql='select * from menu where id='.$_SESSION[menu_sub_id];
$tableheadsql='select * from wordbook where type=1 and menu_sub_id='.$_SESSION[menu_sub_id].' order by seq';
$table1msql='select * from wordbook where type=6 and menu_sub_id='.$_SESSION[menu_sub_id].' order by seq';
$tableheadresult=$db_modify_view->select($tableheadsql);
$tablenameresult=$db_modify_view->select($tablenamesql);
$table1mresult=$db_modify_view->select($table1msql);

$tablebodysql_query='';
$addhtml='<table>';
foreach ($tableheadresult as $val) {
	if ($val[colnameid]=='id'){
		continue;
	}else{
		$tablebodysql_query.=$val[colnameid].',';
		$addhtml.='<tr><td>'.$val[name].':</td><td><input id="'.$val[colnameid].'" type="text" /></td></tr>';
	}
}

foreach ($table1mresult as $val) {
	$addhtml.='<tr>';
	$tmpresult=$db_modify_view->select($val[sqlstr_head]);
	$addhtml.='<td>'.$val[name].':</td><td>';
	foreach ($tmpresult as $val1){
		$addhtml.='<input id="'.$val1[id].'" type="checkbox" />'.$val1[name].'<br />';
	}
	$addhtml.='</td></tr>';
}

$addhtml.='<tr><td colspan="2"><button id="m_v_s_add">保存</button></td></tr></table>';

$returnarr[content][content]=$addhtml;

$tips_navhtml=genTips($tablenameresult,$tablenameresult[0][name].'->新增','');
$returnarr[content][tips_nav]=$tips_navhtml;

unset($tips_navhtml,$db_modify_view,$tableheadsql,$tableheadresult,$tablebodysql_query,$addhtml,$val,$tablenamesql,$addhtml,$tmpresult);
require_once BASE_DIR.MDL_DIR.MDL_RETURN;
?>