<?php
//$navmenuID=3;
//require_once '../config.inc.php';
//require_once '../'.IncludePath.DBInc;
//$dbint=new DBSql();
//$dataTmpC=$dbint->select("select * from navmenu where id=".$navmenuID);
//$posTips=genTips($dataTmpC,$dataTmpC[0][name]);
//echo $posTips;
//测试分割线
require_once dirname(dirname(__FILE__)).'/cfg/base.cfg.php';
require_once BASE_DIR.INC_DIR.INC_DB;
function genTips($menuArr,$tailName,$strTips){
	if($menuArr[0][parent_id]!=0){
		$dbinttmp=new DBSql();
		$dataTmpR=$dbinttmp->select("select * from menu where id=".$menuArr[0][relation_id]);
		$tmpstrTips=$dataTmpR[0][name].'->'.$strTips;
		return genTips($dataTmpR,$tailName,$tmpstrTips);
		
	}else{
		$strTips='<b><i>当前位置:'.$strTips.$tailName.'</i></b>';
		return $strTips;
	}
}
?>
