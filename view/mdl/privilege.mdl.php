<?php session_start();
//require_once dirname(dirname(__FILE__)).'/cfg/base.cfg.php';
//require_once BASE_DIR.INC_DIR.INC_DB;
//$db_main=new DBSql();
$returnarr=array(
	'apd'=>array(
			'content'=>array(
					'pri_view','<input type="checkbox" value="a"/>a<input type="checkbox" value="b"/>b<input type="checkbox" value="c"/>c<input id="pri_sbmt" type="submit"/>'
					)
			)
);
echo json_encode($returnarr);
unset($returnarr);?>