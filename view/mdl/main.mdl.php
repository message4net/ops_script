<?php session_start();
require_once dirname(dirname(__FILE__)).'/cfg/base.cfg.php';
require_once BASE_DIR.INC_DIR.INC_DB;
if ($_POST[id]!='') {
	$_SESSION[menu_sub_id]=$_POST[id];
}
$_POST[page]==''?$_SESSION[page]=1:$_SESSION[page]=$_POST[page];
$recordstartnum=(($_SESSION[page]-1)*PERPAGENO);
$db_main=new DBSql();

$tablenamesql='select tablename from menu where id='.$_SESSION[menu_sub_id];
$tableheadsql='select * from wordbook where menu_sub_id='.$_SESSION[menu_sub_id].' order by seq';
$tablenameresult=$db_main->select($tablenamesql);
$tableheadresult=$db_main->select($tableheadsql);
$recordcountsql='select count(*) ct from '.$tablenameresult[0][tablename].';';
$recordcountresult=$db_main->select($recordcountsql);
if($recordstartnum>=$recordcountresult[0][ct]) $recordstartnum=$recordcountresult[0][ct]-$recordcountresult[0][ct]%PERPAGENO;
$recordcountresult[0][ct]==0?$totalpagenum=1:$totalpagenum=ceil($recordcountresult[0][ct]/PERPAGENO);

$returnarr[cc][cc]=$recordstartnum;
//echo json_encode($returnarr);
//unset($returnarr);


$returnarr[content][menu_func]='<div style="float:left"><a href="javascript:void(0)">新增</a>|<a href="javascript:void(0)">批删除</a></div><div style="float:right;padding-right:200px"><input type="text"/><button>搜索</button></div>';

//require_once BASE_DIR.MDL_DIR.MDL_CONTENT;

$tablebodysql_query='';
$tableheadhtml='<table id="content_table" name="'.$_SESSION[menu_sub_id].'">';
foreach ($tableheadresult as $val) {
	$tablebodysql_query.=$val[colnameid].',';
	if ($val[colnameid]=='id'){
		$tableheadhtml.='<th><input type="checkbox" id="0" name="contentall"/></th><th>序号</th><th style="text-align:center">操作</th>';
	}else{
		$tableheadhtml.='<th>'.$val[name].'</th>';
	}
}
$tablebodysql_query=substr($tablebodysql_query,0,strlen($tablebodysql_query)-1).' ';
$tableheadhtml.='</tr>';
$tablebodysql='select '.$tablebodysql_query.' from '.$tablenameresult[0][tablename].' limit '.$recordstartnum.','.PERPAGENO.';';
$tablebodyresult=$db_main->select($tablebodysql);
$tablebodyhtml='';
$count=1;
foreach ($tablebodyresult as $key=>$val) {
	$tablebodyhtml.='<tr>';
	foreach ($val as $key1=>$val1){
		if ($key1=='id') {
			$tmprowid=$val1;
			$tablebodyhtml.='<td><input type="checkbox" id="'.$val1.'" name="contentlist"/></td><td>'.$count.'</td><td id="content_func" mid="'.$_POST[id].'" rid="'.$val1.'"><a href="javascript:void(0);">编辑</a>|<a href="javascript:void(0);" mid=".$_POST[id]." rid="'.$val1.'" onclick="if(confirm(\'确实要删除此条记录吗？\')) return true;else return false;">删除</a></td>';
		}else{
			$tablebodyhtml.='<td>'.$val1.'</td>';
		}
	}
	$tablebodyhtml.='</tr>';
	$count++;
}
$tablebodyhtml.='</tr></table>';
$returnhtml=$tableheadhtml.$tablebodyhtml;
$returnarr[content][content]=$returnhtml;


//require_once BASE_DIR.MDL_DIR.MDL_PAGE;

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



require_once BASE_DIR.MDL_DIR.MDL_RETURN;
?>