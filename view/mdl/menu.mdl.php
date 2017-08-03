<?php session_start();
if ($_SESSION [loginflag] == 1 && $_SESSION[loginduration]>time()) {
	require_once dirname(dirname(__FILE__)).'/cfg/base.cfg.php';
	require_once BASE_DIR.INC_DIR.INC_DB;
	$db_menu=new DBSql();
	$tmpmenusql='select id,name from menu m,(SELECT distinct(parent_id) parent_id FROM menu m,menu_role mr WHERE m.id=mr.menu_id and mr.role_id='.$_SESSION[loginid].') mp where mp.parent_id=m.id;';
	$result_menu=$db_menu->select($tmpmenusql);
	$returnhtml='<div id="div_menu"><ul>';
	foreach ($result_menu as $val) {
		$returnhtml.='<li><a id="'.$val[id].'" href="javascript:void(0);">'.$val[name].'</a></li>';
	}
	$returnhtml.='</ul></div>';
	$returnarr = array(
			'show' => array(
					'main_left',
					'main_right',
					'info'
			),
			'hide' => array(	
					'main_login'
			),
			'content'=>array(
					'span_info'=>$_SESSION[loginname],
					'menu_nav'=>$returnhtml
			)
	);
	unset($db_menu);
	unset($tmpmenusql);
	unset($returnhtml);
	unset($result_menu);
	unset($val);
} else {
	$returnarr = array(
			'hide' => array(
					'main_left',
					'main_right' 
			),
			'show' => array(
					'main_login' 
			) 
	);
	if ($_SESSION[loginduration]<=time() && !is_null($_SESSION[loginduration])){
		$returnarr[content]=array(
				'tips_login'=>'<span style="float:left;font-size:12px;color:green"><b><i>登录超时，请重新登录</b></i></span>'
		);
	}
	$_SESSION=array();
	session_destroy();
}
require_once BASE_DIR.MDL_DIR.MDL_RETURN;
?>