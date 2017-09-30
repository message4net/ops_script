<?php session_start();

require_once dirname(dirname(__FILE__)).'/cfg/base.cfg.php';
require_once BASE_DIR.INC_DIR.INC_DB;
require_once BASE_DIR.INC_DIR.INC_VIEW;
if ($_POST[id]!='') {
	$_SESSION[menu_sub_id]=$_POST[id];
}

$view=new ViewMain($_SESSION[menu_sub_id],$_POST[page]);
//$returnarr[0][0]='qqq';
//$returnarr[0][0]=BASE_DIR.INC_DIR.INC_VIEW;
//echo json_encode($returnarr);
//unset($returnarr);

$returnarr[content][menu_func]=$view->gen_func_html();
$returnarr[content][content]=$view->gen_view_content_html();
$returnarr[content][page_bar]=$view->gen_pagebar_html();
$returnarr[content][tips_nav]=$view->gen_navpos_html();


require_once BASE_DIR.MDL_DIR.MDL_RETURN;
?>