<?php session_start();
require_once dirname(dirname(__FILE__)).'/cfg/base.cfg.php';
require_once BASE_DIR.INC_DIR.INC_DB;
$db_menu_sub=new DBSql();
$tmpsql='select id,name from menu where parent_id='.$_POST[id];
$result_menu_sub=$db_menu_sub->select($tmpsql);
$returnhtml='<div id="div_menu_sub"><ul>';
foreach ($result_menu_sub as $val) {
	$returnhtml.='<li><a id="'.$val[id].'" href="javascript:void(0);">'.$val[name].'</a></li>';
}
$returnhtml.='</ul></div>';
$returnarr=array(
		'content'=>array(
				'menu_sub'=>$returnhtml
		)
);
unset($db_menu_sub);
unset($returnhtml);
unset($tmpsql);
unset($val);
require_once BASE_DIR.MDL_DIR.MDL_RETURN;
?>