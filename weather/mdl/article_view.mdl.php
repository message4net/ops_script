<?php session_start();
require_once str_replace('\\','/',dirname(dirname(__FILE__))).'/cfg/base.cfg.php';
require_once BASE_DIR.INC_DIR.INC_DB;
require_once BASE_DIR.INC_DIR.INC_FUNC;

require_once BASE_DIR.INC_DIR.INC_LOG;

$log_article_view=new LogHandle();
$db_article_view=new DBSql();

$sql_rec='select * from article where id='.$_POST[recid];
$sql_pic='select * from pic_art where art_id='.$_POST[recid];
$sql_stat='select * from status_article';
$result_rec=$db_article_view->select($sql_rec);
$result_pic=$db_article_view->select($sql_pic);
$result_stat=$db_article_view->select($sql_stat);
foreach ($result_stat as $val){
	$arr_stat[$val[status_id]]=$val[name];
}
$html_pic='';
if ($result_pic){
	foreach ($result_pic as $val){
		//$html_pic.='<tr><td colspan="2"><img src="'.PIC_DIR.$val[name].'" width="400" height="200"/></td></tr><tr><td colspan="2"><button id="artl_pic_save" name="'.$val[name].'">下载图片</button></td></tr>';
		$html_pic.='<tr><td colspan="2"><img src="'.PIC_DIR.$val[name].'" width="400" height="200"/></td></tr><tr><td colspan="2"><a href="'.MDL_DIR.MDL_PIC_SAVE.'?name='.$val[name].'">下载图片</button></td></tr>';
	}
}

$returnarr[content][content]='<table>';
$func_status_html="";
if ($_SESSION[loginroleid]==1){
	$sql_status_op_arr='select * from status_article where status_id<2 order by status_id ';
	$result_status_op_arr=$db_article_view->select($sql_status_op_arr);
	$func_status_html.='<tr><td colspan="2">当前状态:'.$arr_stat[$result_rec[0][status]].'___<select id="artl_stat">';
	foreach ($result_status_op_arr as $val){
		if ($result_rec[0][status]==$val[status_id]){
			$func_status_html.='<option value="'.$val[status_id].'" selected="selected">'.$val[name].'</option>';
		}else{
			$func_status_html.='<option value="'.$val[status_id].'">'.$val[name].'</option>';
		}
	}
	$func_status_html.='</select><button id="artl_save_stat" name="'.$_POST[recid].'">保存</button>___<button id="artl_del" name="'.$result_rec[0][id].'">删除</button></td></tr>';
}else{
	if ($result_rec[0][status]>0){
		$sql_status_op_arr='select * from status_article where status_id>0 ';
		$sql_status_op_arr='select * from status_article where status_id>0 order by status_id ';
		$func_status_html.='<tr><td colspan="2"><select id="artl_stat">';
		$result_status_op_arr=$db_article_view->select($sql_status_op_arr);
		foreach ($result_status_op_arr as $val){
//			$func_status_html.='<option value="'.$val[status_id].'">'.$val[name].'</option>';
			if ($result_rec[0][status]==$val[status_id]){
				$func_status_html.='<option value="'.$val[status_id].'" selected="selected">'.$val[name].'</option>';
			}else{
				$func_status_html.='<option value="'.$val[status_id].'">'.$val[name].'</option>';
			}
		}
		$func_status_html.='</select><button id="artl_save_stat" name="'.$result_rec[0][id].'">保存</button></td></tr>';
	}
}
$returnarr[content][content].=$func_status_html.'<tr><td colspan="2">'.$result_rec[0][name].'</td></tr>';
$returnarr[content][content].='<tr><td>作者:'.$result_rec[0][author].'</td><td>日期:'.substr($result_rec[0][addtime],0,10).'</td></tr>';
$returnarr[content][content].='<tr><td colspan="2">'.$result_rec[0][content].'</td></tr>';
$returnarr[content][content].=$html_pic;
//$returnarr[content][content].=$func_status_html;


$returnarr[content][content].='</table>';
$returnarr[content][page_bar]='';
$returnarr[content][menu_func]='';
$returnarr[content][tips_nav]='<div style="float:left"><b>当前位置:<i>文档管理-&gt;文章管理-&gt;审阅</i></b></div>';
//$returnarr[0][0]=$sql_rec.'#zdVIEW_ART';

require_once BASE_DIR.MDL_DIR.MDL_RETURN;
/*
 $returnarr[content][content]=<<< _EOF
 <div id="content"><table>
 <tr><td>标题</td><td colspan="2"><input id="name" type="text"/></td></tr>
 <tr><td>作者</td><td colspan="2"><input id="author" type="text"/></td></tr>
 <tr><td>传图</td><td><form id="fmpic"><input name="pic[]" type="file" multiple/></td><td><button id="uppic" >点击上传</button></form></td></tr>
 <tr><td>内容</td><td colspan="2"><textarea id="art_txt" style="width:500px;height:200px;"></textarea></td></tr>
 <tr><td colspan="3"><button id="artl_sav">保存新闻</button></td></tr>
 </table></div>
 _EOF;
 */

//测试代码
//$returnarr[0][0]='1';
//
//echo json_encode($returnarr);
//unset($returnarr);
//exit;
?>