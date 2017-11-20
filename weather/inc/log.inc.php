<?php
/** private
功能:数据库的基础操作类
**/
class LogHandle{

/**
 *功能:默认打印访问的 ip、方法、接口、参数
 */
	public function __construct(){
		$loginfo='IP:"'.$_SERVER[REMOTE_ADDR].'"METHOD:"'.$_SERVER[REQUEST_METHOD].'"PAGE:"'.$_SERVER[REQUEST_URI].'"PARAS:"'.$_SERVER[QUERY_STRING]."\"\r\n";
		$this->logprint(FLAG_LOG_INFO, LEVEL_LOG_INFO, $loginfo);
	}
	
/**
 * 功能:打印日志
 * 参数:$flag_log 1为打印 其他为不打印,
 * 		$log_level 分为INFO,WARN,ERR 3个等级
 * 		$info_log 打印内容
 */
	public function logprint($flag_log,$log_level,$info_log){
		if ($flag_log==1){
			$logfile=fopen(LOG_FILE_PATH_NAME,'a');
			$loginfo='['.date('Y-m-d H:i:s').'] '.$log_level.$info_log."\r\n";
			fwrite($logfile,$loginfo);
			fclose($logfile);
		}
	}

}
?>
