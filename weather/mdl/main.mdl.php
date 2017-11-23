<?php session_start();


require_once dirname(dirname(__FILE__)).'/cfg/base.cfg.php';
require_once BASE_DIR.INC_DIR.INC_DB;
require_once BASE_DIR.INC_DIR.INC_VIEW;
require_once BASE_DIR.INC_DIR.INC_FUNC;

require_once BASE_DIR.INC_DIR.INC_LOG;

$log_main=new LogHandle();


$navmenusubid='-1';
$funccategoryid=1;
$navtailname='';
$namestrtips='';

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

//$view=new ViewMain($_SESSION[menu_sub_id],$_SESSION[loginroleid],$_SESSION[page],$_SESSION[searchword],$_SESSION[searchcol]);
//$_SESSION[loginuserid]
$view=new ViewMain($_SESSION[menu_sub_id],$_SESSION[loginroleid],$_SESSION[loginuserid],$_SESSION[page],$_SESSION[searchword],$_SESSION[searchcol]);
$funcnav=new FuncNavGen($_SESSION[menu_sub_id]);

switch ($_POST[func]) {
	case menu:
		$returnarr[content][tips_nav]=$funcnav->gen_navpos_html($navmenusubid,$navtailname,$namestrtips);
		$returnarr[content][menu_func]=$funcnav->gen_func_html($funccategoryid);
		$returnarr[content][page_bar]=$view->gen_pagebar_html();
		$returnarr[content][content]=$view->gen_view_content_html();
		break;
	;
	case reset:
		$returnarr[content][menu_func]=$funcnav->gen_func_html($funccategoryid);
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
		$returnarr[content][tips_nav]=$funcnav->gen_navpos_html($navmenusubid,$navtailname,$namestrtips);
		$returnarr[content][menu_func]=$funcnav->gen_func_html($funccategoryid);
		$returnarr[content][page_bar]=$view->gen_pagebar_html();
		$returnarr[content][content]=$view->gen_view_content_html();
	break;
}



//$returnarr[0][0]=$_POST[func];
//echo json_encode($returnarr);
//unset($returnarr);
//exit;



require_once BASE_DIR.MDL_DIR.MDL_RETURN;
?>