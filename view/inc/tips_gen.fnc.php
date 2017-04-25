<?php
//$navmenuID=3;
//require_once '../config.inc.php';
//require_once '../'.IncludePath.DBInc;
//$dbint=new DBSql();
//$dataTmpC=$dbint->select("select * from navmenu where id=".$navmenuID);
//$posTips=genTips($dataTmpC,$dataTmpC[0][name]);
//echo $posTips;
//测试分割线
require_once '/usr/local/http/opsmanage1/config.inc.php';
require_once IncludePath.DBInc;
function genTips($menuArr,$tailName,$strTips){
	if($menuArr[0][relation_id]!=0){
		$dbinttmp=new DBSql();
		$dataTmpR=$dbinttmp->select("select * from navmenu where id=".$menuArr[0][relation_id]);
		$tmpstrTips=$dataTmpR[0][name].'->'.$strTips;
		return genTips($dataTmpR,$tailName,$tmpstrTips);
		
	}else{
		$strTips='<b><i>当前位置:'.$strTips.$tailName.'</i></b>';
		return $strTips;
	}
}
?>
