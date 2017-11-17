<?php session_start();
require_once str_replace('\\','/',dirname(dirname(__FILE__))).'/cfg/base.cfg.php';

if($_SESSION[menu_sub_id]==''){
	$returnarr[content][tips_nav]='不可直接调用，请通过正规方式访问';
	require_once BASE_DIR.MDL_DIR.MDL_RETURN;
	exit;
}

require_once BASE_DIR.INC_DIR.INC_DB;
require_once BASE_DIR.INC_DIR.INC_FUNC;
require_once BASE_DIR.INC_DIR.INC_LOG;

$log_view_son=new LogHandle();
$func_view_son=new FuncNavGen($_SESSION[menu_sub_id]);

$navtailname='批换权';
$navmenusubid='-1';
$funccategoryid=3;
$tablename='role';
$html_col_total=2;

$sql_role_arr='select * from role where creator='.$_SESSION[loginroleid];
$result_role_arr=$func_view_son->select($sql_role_arr);
if($result_role_arr){
	$count=1;
	foreach ($result_role_arr as $val){
		$html_checkbox_role.='<input id="'.$val[id].'" name="name" type="checkbox"/>'.$val[name];
		if($count%10==0){
			$html_checkbox_role.='<br/>';
		}
		$count++;
	}
	$html_checkbox_role='<tr><td>权限名称</td><td id="'.CSS_ID_TD_STR_C.'" name="nameall">'.$html_checkbox_role.'</td></tr>';
}

$sql_menu_sub_arr='select m.* from menu m, role_menu rm where m.id=rm.menu_sub_id and rm.role_id='.$_SESSION[loginroleid].';';
$result_menu_sub_arr=$func_view_son->select($sql_menu_sub_arr);
if($result_menu_sub_arr){
	foreach ($result_menu_sub_arr as $val){
		$html_menu_sub.='<tr><td>'.$val[name].'</td><td id="'.CSS_ID_TD_STR_A.'" name="'.$val[id].'">';//<input id="'.$val[id].'" name="name'.$val[id].'" type="checkbox"/>';
		$sql_func_arr='select wb.* from wordbook wb,role_func rf where wb.menu_sub_id='.$val[id].' and rf.wordbook_id=wb.id and rf.menu_sub_id=wb.menu_sub_id and rf.role_id='.$_SESSION[loginroleid].';';
		$result_func_arr=$func_view_son->select($sql_func_arr);
		$html_func='';
		if ($result_func_arr){
			foreach ($result_func_arr as $val1){
				$html_func.='<input id="'.$val1[id].'" name="mod'.$val1[id].'" type="checkbox"/>'.$val1[name];
			}
		}
		$html_menu_sub.=$html_func.'</td></tr>';
	}
}



$tips_navhtml=$func_view_son->gen_navpos_html($navmenusubid,$navtailname,'');

$html_return_content='<table><tr><td>操作</td><td><input type="radio" name="f" value="a">添加<input type="radio" name="f"  value="d">去除</td></tr>'.$html_checkbox_role.$html_menu_sub.'<tr><td colspan="'.$html_col_total.'"><button id="func_setall">批处理</button></td></tr></table>';

$returnarr[content][menu_func]=$func_view_son->gen_func_html($funccategoryid);

$returnarr[content][content]=$html_return_content;
$returnarr[content][tips_nav]=$tips_navhtml;
$returnarr[content][tips]='';
$returnarr[content][page_bar]='';

unset($result_func_arr,$sql_func_arr,$val1,$html_menu_sub,$html_checkbox_role,$log_view_son,$func_view_son,$navtailname,$navmenusubid,$funccategoryid,$tablename,$sql_role_arr,$result_role_arr,$val);
require_once BASE_DIR.MDL_DIR.MDL_RETURN;

?>