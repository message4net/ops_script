<?php session_start();
require_once dirname(dirname(__FILE__)).'/cfg/base.cfg.php';
require_once BASE_DIR.INC_DIR.INC_DB;
$db_main=new DBSql();
$tablenamesql='select tablename from menu where id='.$_POST[id];
$tableheadsql='select * from wordbook where menu_sub_id='.$_POST[id].' order by seq';
$tablenameresult=$db_main->select($tablenamesql);
$tableheadresult=$db_main->select($tableheadsql);
$tablebodysql_query='';
$tableheadhtml='<table id="content_table">';
foreach ($tableheadresult as $val) {
	$tablebodysql_query.=$val[colnameid].',';
	if ($val[colnameid]=='id'){
		$tableheadhtml.='<tr><th>序号</th><th style="text-align:center">操作</th>';
	}else{
		$tableheadhtml.='<th>'.$val[name].'</th>';
	}
}
$tablebodysql_query=substr($tablebodysql_query,0,strlen($tablebodysql_query)-1).' ';
$tableheadhtml.='</tr>';
$tablebodysql='select '.$tablebodysql_query.' from '.$tablenameresult[0][tablename].';';
$tablebodyresult=$db_main->select($tablebodysql);
$tablebodyhtml='<tr>';
$count=1;
foreach ($tablebodyresult as $key=>$val) {
	foreach ($val as $key1=>$val1){
		if ($key1=='id') {
			$tmprowid=$val1;
			$tablebodyhtml.='<td>'.$count.'</td><td><table id="content_func"><td><a href="javascript:void(0);">编辑</a></td><td><a href="javascript:void(0);" onclick="if(confirm(\'确实要删除此条记录吗？\')) return true;else return false;">删除</a></td></table></td>';
		}else{			
			$tablebodyhtml.='<td>'.$val1.'</td>';
		}
		$count++;
	}
}
$tablebodyhtml.='</tr></table>';
$returnhtml=$tableheadhtml.$tablebodyhtml;
$returnarr=array(
		'content'=>array(
				'content'=>$returnhtml
		)
);
echo json_encode($returnarr);
unset($returnarr);
?>