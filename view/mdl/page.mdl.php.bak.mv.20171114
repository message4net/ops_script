<?php session_start();

require_once dirname(dirname(__FILE__)).'/cfg/base.cfg.php';
require_once BASE_DIR.INC_DIR.INC_DB;
require_once BASE_DIR.INC_DIR.INC_VIEW;
if ($_POST[id]!='') {
	$_SESSION[menu_sub_id]=$_POST[id];
}
if ($_POST[page]!='') {
	$_SESSION[page]=$_POST[page];
}
if ($_POST[searchword]!='') {
	$_SESSION[searchword]=$_POST[searchword];
}

$view=new ViewMain($_SESSION[menu_sub_id],$_SESSION[page],$_SESSION[searchword]);

$returnarr[0][0]=$_SESSION[searchword];
$returnarr[content][content]=$view->gen_view_content_html();
$returnarr[content][page_bar]=$view->gen_pagebar_html();

require_once BASE_DIR.MDL_DIR.MDL_RETURN;
?>