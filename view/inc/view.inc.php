<?php 
require_once dirname(dirname(__FILE__)).'/cfg/base.cfg.php';
require_once BASE_DIR.INC_DIR.INC_DB;

class View extends DBSql {
/**
	 *功能:构造函数，使用父类__construct，连接数据库
	 */
	public function __construct(){
		parent::__construct();
	}

/**
 *初始化数据 
 */
	public function initdbdata($menu_sub_id){
		$rec_tablename_sql='select * from menu where id='.$menu_sub_id;
		$rec_tablename_result=parent::select($rec_tablename_sql);
		$rec_tablename=$rec_tablename_result[0][tablename];
	}
}
?>