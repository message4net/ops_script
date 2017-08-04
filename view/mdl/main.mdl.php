<?php session_start();
require_once dirname(dirname(__FILE__)).'/cfg/base.cfg.php';
require_once BASE_DIR.INC_DIR.INC_DB;
require_once BASE_DIR.INC_DIR.FNC_TIP;
if ($_POST[id]!='') {
	$_SESSION[menu_sub_id]=$_POST[id];
}
$db_main=new DBSql();

$tablenamesql='select * from menu where id='.$_SESSION[menu_sub_id];
$tableheadsql='select * from wordbook where type=1 and menu_sub_id='.$_SESSION[menu_sub_id].' order by seq';
$table1msql='select * from wordbook where type=2 and menu_sub_id='.$_SESSION[menu_sub_id].' order by seq';
$tablefunclsql='select * from wordbook where type=3 and menu_sub_id='.$_SESSION[menu_sub_id].' order by seq';
$tablefuncrsql='select * from wordbook where type=4 and menu_sub_id='.$_SESSION[menu_sub_id].' order by seq';
$sql_content_func='select * from wordbook where type=5 and menu_sub_id='.$_SESSION[menu_sub_id].' order by seq';
$result_content_func=$db_main->select($sql_content_func);
$tablefunclresult=$db_main->select($tablefunclsql);
$tablefuncrresult=$db_main->select($tablefuncrsql);
$table1mresult=$db_main->select($table1msql);
$tablenameresult=$db_main->select($tablenamesql);
$tableheadresult=$db_main->select($tableheadsql);
$recordcountsql='select count(*) ct from '.$tablenameresult[0][tablename].';';
$recordcountresult=$db_main->select($recordcountsql);
if($recordstartnum>=$recordcountresult[0][ct]) $recordstartnum=$recordcountresult[0][ct]-$recordcountresult[0][ct]%PERPAGENO;
$recordcountresult[0][ct]==0?$totalpagenum=1:$totalpagenum=ceil($recordcountresult[0][ct]/PERPAGENO);


if($_POST[page]==''){
	if($_SESSION[page]==''){
		$_SESSION[page]=1;
	}
}else{
	if ($_POST[page]>$totalpagenum) {
		$_POST[page]=$totalpagenum;
	}
	$_SESSION[page]=$_POST[page];
}
$recordstartnum=(($_SESSION[page]-1)*PERPAGENO);

$funchtml='';
if ($tablefunclresult) {
	$funchtml.='<div style="float:left">';
	foreach ($tablefunclresult as $val){
		$funchtml.='<a id="'.$val[colnameid].'" href="javascript:void(0)">'.$val[name].'</a>&nbsp|&nbsp';
	}
	$funchtml.='</div>';
}
if ($tablefuncrresult) {
	$funchtml.='<div style="float:right;padding-right:200px">';
	foreach ($tablefuncrresult as $val){
		$funchtml.='<input type="text"/><button>'.$val[name].'</button>';
	}
	$funchtml.='</div>';
}
if ($funchtml!='') {
	$returnarr[content][menu_func]=$funchtml;
}

$tablebodysql_query='';
$tableheadhtml='<table id="content_table" name="'.$_SESSION[menu_sub_id].'">';
foreach ($tableheadresult as $val) {
	$tablebodysql_query.=$val[colnameid].',';
	if ($val[colnameid]=='id'){
		$tableheadhtml.='<th><input type="checkbox" id="0" name="contentall"/></th><th>序号</th><th style="text-align:center">操作</th>';
	}else{
		$tableheadhtml.='<th>'.$val[name].'</th>';
		if ($table1mresult) {
			foreach ($table1mresult as $val1){
				$tableheadhtml.='<th>'.$val1[name].'</th>';
			}
		}
	}
}

$tablebodysql_query=substr($tablebodysql_query,0,strlen($tablebodysql_query)-1).' ';
$tableheadhtml.='</tr>';
$tablebodysql='select '.$tablebodysql_query.' from '.$tablenameresult[0][tablename].' limit '.$recordstartnum.','.PERPAGENO.';';
$tablebodyresult=$db_main->select($tablebodysql);
$sql_statment2='';
foreach ($tablebodyresult as $val){
	$sql_statment2.=$val[id].',';
}
$sql_statment2=substr($sql_statment2,0,strlen($sql_statment2)-1);
foreach ($table1mresult as $val){
	if ($val[sqlstr_body]=='') {
		$sql_tmp_content_statment2=$val[sqlstr_head].$sql_statment2.$val[sqlstr_foot];
	}else{
		$sql_tmp_content_statment2=$val[sqlstr_head].$sql_statment2.$val[sqlstr_body].$sql_statment2.$val[sqlstr_foot];
	}
	$result_statment2=$db_main->select($sql_tmp_content_statment2);
	foreach ($result_statment2 as $val1) {
		$content_statment2[$val1[mainid]][$val1[subid]]=$val1[name];
	}
}

$tablebodyhtml='';
$count=1;
foreach ($tablebodyresult as $key=>$val) {
	$tablebodyhtml.='<tr>';
	$tablebodyhtml_foot='';
	foreach ($val as $key1=>$val1){
		if ($key1=='id') {
			$tmpid=$val1;
			$tablebodyhtml.='<td><input type="checkbox" id="'.$val1.'" name="contentlist"/></td><td>'.$count.'</td><td id="content_func" mid="'.$_POST[id].'" rid="'.$val1.'">';
			foreach ($result_content_func as $val2){
				if ($val2[flag]==1) {
					$tablebodyhtml.='<a id="'.$val2[colnameid].$val1.'" href="javascript:void(0);" onclick="if(confirm(\'确实要删除此条记录吗？\')) return true;else return false;">'.$val2[name].'</a>|';
				}else{
					$tablebodyhtml.='<a id="'.$val2[colnameid].$val1.'" href="javascript:void(0);">'.$val2[name].'</a>|';
				}
			}		
			$tablebodyhtml.='</td>';
		}else{
			$tablebodyhtml.='<td>'.$val1.'</td>';
		}
		if ($key1=='id') {
			$content2='';
			if ($content_statment2[$val1]) {
				foreach ($content_statment2[$val1] as $val2){
					$content2.=$val2.',';
				}
			}else{
				$content2.='';
			}
			$tablebodyhtml_foot.='<td style="font-size:10px;word-break:break-all">'.$content2.'</td>';
		}
	}
	$tablebodyhtml.=$tablebodyhtml_foot.'</tr>';
	$count++;
}
$tablebodyhtml.='</tr></table>';
$returnhtml=$tableheadhtml.$tablebodyhtml;
$returnarr[content][content]=$returnhtml;

$pageinfobar='<div style="margin-top:5px"><b>当前页数/总页数:'.$_SESSION[page].'/'.$totalpagenum.'</b>&nbsp;&nbsp;';
if($_SESSION[page]==1){
	if($_SESSION[page]<>$totalpagenum)
		$pageinfobar.='首页&nbsp;&nbsp;上一页&nbsp;&nbsp;<a href="javascript:void(0);" id="'.($_SESSION[page]+1).'">下一页</a>&nbsp;&nbsp;<a href="javascript:void(0);" id="'.$totalpagenum.'">尾页</a>&nbsp;&nbsp;';
}else{
	if($_SESSION[page]<>$totalpagenum) $pageinfobar.='<a href="javascript:void(0);" id="1">首页</a>&nbsp;&nbsp;<a href="javascript:void(0);" id="'.($_SESSION[page]-1).'">上一页</a>&nbsp;&nbsp;<a href="javascript:void(0);" id="'.($_SESSION[page]+1).'">下一页</a>&nbsp;&nbsp;<a href="javascript:void(0);" id="'.$totalpagenum.'">尾页</a>&nbsp;&nbsp;';
	else $pageinfobar.='<a href="javascript:void(0);" id="1">首页</a>&nbsp;&nbsp;<a href="javascript:void(0);" id="'.($_SESSION[page]-1).'">上一页</a>&nbsp;&nbsp;下一页&nbsp;&nbsp;尾页&nbsp;&nbsp;';
}
$pageinfobar.='跳转至<input id="pageinput" type="text" style="width:25px;"/>页';
$pageinfobar.='<button id="pagebutton" type="button"><span style="width:50px;font-size:9px">点击跳转</span></button></div>';
$returnarr[content][page_bar]=$pageinfobar;

$tips_navhtml=genTips($tablenameresult,$tablenameresult[0][name],'');
$returnarr[content][tips_nav]=$tips_navhtml;
//$returnarr[0]=array($tips_navhtml);


unset($sql_content_func,$result_content_func,$funchtml,$recordstartnum,$tablebodysql,$tablebodysql_query,$pageinfobar,$totalpagenum,$returnhtml,$tableheadhtml,$tablebodyhtml,$tablebodyhtml_foot,$count,$content2,$tablenameresult,$tableheadresult,$recordcountsql,$recordcountresult,$db_main,$tablenamesql,$tableheadsql,$table1msql,$tablefuncrsql,$tablefunclsql,$tablefunclresult,$tablefuncrresult,$table1mresult,$tablenameresult,$tableheadresult,$recordcountsql,$sql_tmp_content_statment2,$val2,$key1,$val1,$val,$key,$tablebodyresult);

require_once BASE_DIR.MDL_DIR.MDL_RETURN;
?>