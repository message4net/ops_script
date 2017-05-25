<?php session_start();
require_once dirname(dirname(__FILE__)).'/cfg/base.cfg.php';
require_once BASE_DIR.INC_DIR.INC_DB;
$db_main=new DBSql();
$returnarr=array(
	$_POST[recid]
);
require_once BASE_DIR.MDL_DIR.MDL_RETURN;
?>