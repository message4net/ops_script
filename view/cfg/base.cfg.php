<?php
//请自建self.cfg.php 定义BASE_URL,DB_*
//define(BASE_URL,'http://127.0.0.1/http/ops_script/view/');
//define(DB_NAME,zops_manager);
//define(DB_HOST,'127.0.0.1:3311');
//define(DB_USER,'opsuser');
//define(DB_PASSWD,'opsuser');
//定义根路径
	$basedir=str_replace('\\','/',dirname(dirname(__FILE__))).'/';
	define(BASE_DIR,$basedir);
	unset($basedir);
//定义常数参数
	define(CFG_DIR,'cfg/');
	define(CFG_SLF,'self.cfg.php');
	define(INC_DIR,'inc/');
	define(INC_DB,'db.inc.php');
	define(INC_VIEW,'view.inc.php');
	define(INC_FUNC,'func.inc.php');
	define(FNC_TIP,'tips_gen.fnc.php');
	define(CSS_DIR,'css/');
	define(CSS_FILE,'default.css');
	//set_view.mdl.php modify_view.mdl.php 使用
	define(CSS_ID_TABLE_CONTENT, 'content_view');
	define(CSS_ID_TD_STR_A,'str_a');
	define(CSS_ID_TD_STR_B,'str_b');
	
	define(JS_DIR,'js/');
	define(JS_JQ,'jquery-1.11.3.min.js');
	define(JS_FUNC,'func.js');
	//define(JS_LOGIN,'login.js');
	define(MDL_DIR,'mdl/');
	//index.php 引用
	define(MDL_WEB,'web.mdl.php');
	//web.mdl.php 引用
	define(MDL_LOGIN,'login.mdl.php');
	//define(MDL_LOGOUT,'loginout.mdl.php');
	//login.mdl.php 引用
	define(MDL_MENU,'menu.mdl.php');
	//define(MDL_CONTENT,'content.mdl.php');
	//define(MDL_PAGE,'page.mdl.php');
	//modify.mdl.php引用
	define(MDL_MAIN,'main.mdl.php');
	define(MDL_RETURN,'return.mdl.php');
	//web.mdl.php 引用
	define(MDL_HEAD,'head.mdl.php');
	//web.mdl.php 引用
	define(MDL_FOOT,'foot.mdl.php');
	//
	define(PERPAGENO,'5');
//加载变量配置
	require_once BASE_DIR.CFG_DIR.CFG_SLF;
?>
