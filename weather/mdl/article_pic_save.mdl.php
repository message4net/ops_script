<?php session_start();
require_once str_replace('\\','/',dirname(dirname(__FILE__))).'/cfg/base.cfg.php';
require_once BASE_DIR.INC_DIR.INC_DB;
require_once BASE_DIR.INC_DIR.INC_FUNC;

require_once BASE_DIR.INC_DIR.INC_LOG;

$log_modify_view=new LogHandle();

/*
ob_start();
var_dump($_SESSION);
$a=ob_get_clean();

$returnarr[0][0]=$a;
*/

$pic_total_size=0;
foreach ($_FILES[pic][size] as $val){
		$pic_total_size+=$val;
}
if ($pic_total_size>60000000 || $pic_total_size===0){
//if ($pic_total_size>5 || $pic_total_size===0){
	$returnarr[content][tips]='<div style="float:left">上传失败！有图片,且总大小不得超过5M，请确认</div>';
	require_once BASE_DIR.MDL_DIR.MDL_RETURN;
}
foreach ($_FILES[pic][type] as $val){
	if ($val!='image/jpeg'){
		$returnarr[content][tips]='<div style="float:left">上传失败！仅允许上传jpeg格式图片，请确认</div>';
		require_once BASE_DIR.MDL_DIR.MDL_RETURN;
	}
}
foreach ($_FILES[pic][error] as $key=>$val){
	if ($val>0){
		$returnarr[content][tips]='<div style="float:left">上传失败！'.$_FILES[pic][name][$key].'异常，请确认</div>';
		require_once BASE_DIR.MDL_DIR.MDL_RETURN;
	}
}

$tmstmp=time();
$db_pic_save=new DBSql();
//$count=0;
$pic_str='';
$returnarr[content][page_bar]='';
//$returnarr[apd][content][pic_show]='<div class=".clear"></div><div>';
$returnarr[apd][content][pic_show]='<div>';
//$z='';

foreach ($_FILES[pic][tmp_name] as $key=>$val){

	$pic_name=$_SESSION[loginuserid].'_'.$tmstmp.'_'.$key.'_'.session_id().'.'.PIC_POSTFIX;
	rename($val, BASE_DIR.PIC_DIR.$pic_name);
	$sql_pic_save='insert into pic_art (name) values (\''.$pic_name.'\')';
//$returnarr[$count][0]=$sql_pic_save;
	$db_pic_save->insert($sql_pic_save);
	$pic_str.=$pic_name.',';
	//$returnarr[content][page_bar].='<img src="'.PIC_DIR.$pic_name.'" height="200" width="200"/><br/>';
	$returnarr[apd][content][pic_show].='<img src="'.BASE_URL.PIC_DIR.$pic_name.'" height="200" width="200"/>';
//$count++;
}
$returnarr[apd][content][pic_show].='</div>';

$pic_str=substr($pic_str,0,strlen($pic_str)-1);
if ($pic_str!=''){
	$returnarr[apd][content][pic_show].='<br/><div id="pic_str" style="display:none">'.$pic_str.'</div>';
}



//$returnarr[1][0]=$z;

require_once BASE_DIR.MDL_DIR.MDL_RETURN;
?>
