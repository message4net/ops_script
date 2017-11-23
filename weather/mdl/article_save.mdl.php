<?php session_start();
require_once str_replace('\\','/',dirname(dirname(__FILE__))).'/cfg/base.cfg.php';
require_once BASE_DIR.INC_DIR.INC_DB;
require_once BASE_DIR.INC_DIR.INC_FUNC;

require_once BASE_DIR.INC_DIR.INC_LOG;

$log_modify_view=new LogHandle();
/*
 ob_start();
 var_dump($_POST);
 $a=ob_get_clean();

 $returnarr[0][0]=$a;
*/



if($_POST[name]=='' || strlen($_POST[name]>150)){
	$returnarr[content][tips]='<div style="float:left">新闻保存失败！标题必填且少于50字，请确认</div>';
	$returnarr[0][0]=$_POST[name].'###7';
	require_once BASE_DIR.MDL_DIR.MDL_RETURN;
	$returnarr[0][0]=$_POST[name].'###4';
}
if($_POST[author]==''){
	$returnarr[content][tips]='<div style="float:left">新闻保存失败！作者必填，请确认</div>';
	$returnarr[0][0]=$_POST[name].'###8';
	require_once BASE_DIR.MDL_DIR.MDL_RETURN;
	$returnarr[0][0]=$_POST[name].'###5';
}
if($_POST[arttxt]=='' || strlen($_POST[arttxt]>15000)){
	$returnarr[content][tips]='<div style="float:left">新闻保存失败！内容必填且少于5000字，请确认</div>';
	$returnarr[0][0]=$_POST[name].'###6';
	require_once BASE_DIR.MDL_DIR.MDL_RETURN;
}
if ($_POST[picstr]!=''){
	$picarr=explode(',',$_POST[picstr]);
}


$db_article_save=new DBSql();

$arttxt=str_replace("/'/","''",$_POST[arttxt]);
$title=str_replace("/'/","''",$_POST[name]);

$addtime=date("Y-m-d H:i:s");
$sql_article_ins='insert into article (name,author,addtime,user_id,content) values (\''.$title.'\',\''.$_POST[author].'\',\''.$addtime.'\','.$_SESSION[loginuserid].',\''.$arttxt.'\');';
$db_article_save->insert($sql_article_ins);

 $returnarr[0][0]='';
if ($picarr){
	$sql_article_qr='select id from article where name=\''.$title.'\' and author=\''.$_POST[author].'\' and user_id='.$_SESSION[loginuserid].' and addtime=\''.$addtime.'\';';
	$result_article_id=$db_article_save->select($sql_article_qr);
	//$returnarr[0][0]=$sql_article_qr;
	if ($result_article_id){
		foreach ($picarr as $val){
			$sql_article_up='update pic_art set art_id='.$result_article_id[0][id].' where name=\''.$val.'\';';
			//$db_article_save->update($sql_article_up);
			$returnarr[0][0].=$sql_article_up;
			
			//$returnarr[0][0].=$val.'###';
		}

	}
}




require_once BASE_DIR.MDL_DIR.MDL_RETURN;
?>