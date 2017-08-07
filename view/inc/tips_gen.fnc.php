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
//$menuArr[0][name]=array('abc');
//$menuArr[0][parent_id]=1;
//$tailName='bcd';

//$db_main=new DBSql();
//$tablenamesql='select * from menu where id=4';
//$tablenameresult=$db_main->select($tablenamesql);

function genTips($menuArr,$tailName,$strTips){
	if($menuArr[0][parent_id]!=0){
		$dbinttmp=new DBSql();
		$dataTmpR=$dbinttmp->select("select * from menu where id=".$menuArr[0][parent_id]);
		$tmpstrTips=$dataTmpR[0][name].'->'.$strTips;
		return genTips($dataTmpR,$tailName,$tmpstrTips);
		
	}else{
		$strTips='<div style="float:left"><b>当前位置:<i>'.$strTips.$tailName.'</i></b></div>';
		return $strTips;
	}
}
//$a=genTips($tablenameresult,$tablenameresult[0][name],'');
//echo $a;
?>
