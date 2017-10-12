<?php 
//$tablenamesql='select tablename from menu where id='.$_POST[id];
//$tableheadsql='select * from wordbook where menu_sub_id='.$_POST[id].' order by seq';
//$tablenameresult=$db_main->select($tablenamesql);
//$tableheadresult=$db_main->select($tableheadsql);
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
?>