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
	$_SESSION[searchcol]=$_POST[searchcol];
}
if ($_POST[func]=='reset'){
	$_SESSION[searchword]='';
	$_SESSION[page]='';
}

$view=new ViewMain($_SESSION[menu_sub_id],$_SESSION[page],$_SESSION[searchword],$_SESSION[searchcol]);

switch ($_POST[func]) {
	case menu:
		$returnarr[content][tips_nav]=$view->gen_navpos_html();
		$returnarr[content][menu_func]=$view->gen_func_html();
		$returnarr[content][page_bar]=$view->gen_pagebar_html();
		$returnarr[content][content]=$view->gen_view_content_html();
		break;
	;
	case reset:
		$returnarr[content][menu_func]=$view->gen_func_html();
		$returnarr[content][page_bar]=$view->gen_pagebar_html();
		$returnarr[content][content]=$view->gen_view_content_html();
		break;
	;
	case page:
	case search:
		$returnarr[content][page_bar]=$view->gen_pagebar_html();
		$returnarr[content][content]=$view->gen_view_content_html();
		break;
	;
	default:
		$returnarr[content][tips_nav]=$view->gen_navpos_html();
		$returnarr[content][menu_func]=$view->gen_func_html();
		$returnarr[content][page_bar]=$view->gen_pagebar_html();
		$returnarr[content][content]=$view->gen_view_content_html();
	break;
}

require_once BASE_DIR.MDL_DIR.MDL_RETURN;
?>