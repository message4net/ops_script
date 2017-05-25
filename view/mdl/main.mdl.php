<?php session_start();
require_once dirname(dirname(__FILE__)).'/cfg/base.cfg.php';
require_once BASE_DIR.INC_DIR.INC_DB;
$_SESSION[menu_sub_id]=$_POST[id];
$_POST[page]==''?$pagenum=1:$pagenum=$_POST[page];
$recordstartnum=(($pagenum-1)*PERPAGENO);
$db_main=new DBSql();

$tablenamesql='select tablename from menu where id='.$_SESSION[menu_sub_id];
$tableheadsql='select * from wordbook where menu_sub_id='.$_SESSION[menu_sub_id].' order by seq';
$tablenameresult=$db_main->select($tablenamesql);
$tableheadresult=$db_main->select($tableheadsql);
$recordcountsql='select count(*) ct from '.$tablenameresult[0][tablename].';';
$recordcountresult=$db_main->select($recordcountsql);
if($recordstartnum>=$recordcountresult[0][ct]) $recordstartnum=$recordcountresult[0][ct]-$recordcountresult[0][ct]%PERPAGENO;
$recordcountresult[0][ct]==0?$totalpagenum=1:$totalpagenum=ceil($recordcountresult[0][ct]/PERPAGENO);



require_once BASE_DIR.MDL_DIR.MDL_CONTENT;
require_once BASE_DIR.MDL_DIR.MDL_PAGE;
$returnarr[content][menu_func]='<div style="float:left"><a href="javascript:void(0)">新增</a>|<a href="javascript:void(0)">批删除</a></div><div style="float:right;padding-right:200px"><input type="text"/><button>搜索</button></div>';
require_once BASE_DIR.MDL_DIR.MDL_RETURN;
?>