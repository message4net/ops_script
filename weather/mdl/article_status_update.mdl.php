<?php session_start();
require_once str_replace('\\','/',dirname(dirname(__FILE__))).'/cfg/base.cfg.php';
require_once BASE_DIR.INC_DIR.INC_DB;
require_once BASE_DIR.INC_DIR.INC_FUNC;

require_once BASE_DIR.INC_DIR.INC_LOG;

$log_article_status_save=new LogHandle();
$db_stat_u=new DBSql();

switch ($_POST[func]){
	case updt:
		$sql_stat='update article set status='.$_POST[statid].' where id='.$_POST[recid];
		//$returnarr[0][0]=$sql_stat.'#za#REC_STAT_SAVE';
		$db_stat_u->update($sql_stat);
		$returnarr[content][tips]='<div style="float:left">新闻状态更新成功!</div>';
		require_once BASE_DIR.MDL_DIR.MDL_RETURN;
		break;
		;;
	case del:
		$sql_del='delete from article where id='.$_POST[recid];
		$db_stat_u->delete($sql_del);
		//$returnarr[0][0]=$sql_del.'#za#REC_STAT_SAVE';
		$returnarr[content][tips]='<div style="float:left">新闻删除成功!</div>';
		require_once BASE_DIR.MDL_DIR.MDL_RETURN;
		break;
		;;
	default:
		$returnarr[content][tips]='<div style="float:left">参数有误!请确认</div>';
}

//$returnarr[0][0]=$sql_stat.'#za#REC_STAT_SAVE';
require_once BASE_DIR.MDL_DIR.MDL_RETURN;
?>