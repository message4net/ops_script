<?php session_start();
//require_once dirname(dirname(__FILE__)).'/cfg/base.cfg.php';
//require_once BASE_DIR.INC_DIR.INC_DB;
//$db_main=new DBSql();
$returnarr=array(
	'rmv'=>array(
			'content'=>array('pri_view')
	)
);
echo json_encode($returnarr);
unset($returnarr);?>