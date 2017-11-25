<?php 
session_start();
require_once str_replace('\\','/',dirname(dirname(__FILE__))).'/cfg/base.cfg.php';
require_once BASE_DIR.INC_DIR.INC_DB;
require_once BASE_DIR.INC_DIR.INC_FUNC;

require_once BASE_DIR.INC_DIR.INC_LOG;

$log_article_index=new LogHandle();
$db_article_index=new DBSql();

//初始化功能
$returnarr[content][menu_func]='<div style="float:left"><a id="artl_add" href="javascript:void(0)">新增</a>&nbsp;|&nbsp;</div><div style="float:right;padding-right:200px"><select id="search_bar"><option value="name">标题</option><option value="author">作者</option><option value="user_id">上传者</option></select><input id="search_word" type="text"><button id="word_search" name="art">搜索</button><button id="word_reset" name="art">重置</button></div>';
$returnarr[content][tips_nav]='<div style="float:left"><b>当前位置:<i>文档管理-&gt;文章管理</i></b></div>';
$returnarr[content][content]='<table id="content_table" name="8"><tbody><tr><th>序号</th><th>标题</th><th>作者</th><th>日期</th><th>状态</th><th>上传者</th></tr>';

//确认SESSION参数
if ($_POST[func]=='reset'){
	$_SESSION[searchword]='';
}
if ($_POST[id]!='') {
	if ($_POST[id]<>$_SESSION[menu_sub_id]){
		$_SESSION[searchword]='';
	}
	$_SESSION[menu_sub_id]=$_POST[id];
}
if ($_POST[page]!='') {
	$_SESSION[page]=$_POST[page];
}
$z='';
if ($_POST[searchword]!='') {
	$_SESSION[searchword]=$_POST[searchword];
	$_SESSION[searchcol]=$_POST[searchcol];
	if ($_SESSION[searchcol]=='user_id'){
		$sql_search_user_arr='select id from user where name like \'%'.$_SESSION[searchword].'%\'';
		$result_search_user_arr=$db_article_index->select($sql_search_user_arr);
		if ($result_search_user_arr){
//foreach ($result_search_user_arr as $val)
//$z.='T';
			$sql_search_user_str='';
			foreach ($result_search_user_arr as $val){
				$sql_search_user_str.=$val[id].',';
				//$z.=$val[id].',';
			}
			$sql_search_user_str=substr($sql_search_user_str,0,strlen($sql_search_user_str)-1);
			if ($sql_search_user_str==''){
				$sql_search_user_str='-1';
			}
		}else{
$z.='F';
		}
		$sql_part_search=' '.$_SESSION[searchcol].' in ('.$sql_search_user_str.') ';
	}else{
		$sql_part_search=' '.$_SESSION[searchcol].' like \'%'.$_SESSION[searchword].'%\' ';
	}
}
if ($_SESSION[searchword]!=''){
	if ($_SESSION[searchcol]=='user_id'){
		$sql_search_user_arr='select id from user where name like \'%'.$_SESSION[searchword].'%\'';
		$result_search_user_arr=$db_article_index->select($sql_search_user_arr);
		if ($result_search_user_arr){
			//foreach ($result_search_user_arr as $val)
				//$z.='T';
			$sql_search_user_str='';
			foreach ($result_search_user_arr as $val){
				$sql_search_user_str.=$val[id].',';
				//$z.=$val[id].',';
			}
			$sql_search_user_str=substr($sql_search_user_str,0,strlen($sql_search_user_str)-1);
			if ($sql_search_user_str==''){
				$sql_search_user_str='-1';
			}
		}else{
			$z.='F';
		}
		$sql_part_search=' '.$_SESSION[searchcol].' in ('.$sql_search_user_str.') ';
	}else{
		$sql_part_search=' '.$_SESSION[searchcol].' like \'%'.$_SESSION[searchword].'%\' ';
	}
}
if ($_POST[func]=='reset'){
	$_SESSION[searchword]='';
	$_SESSION[page]='';
}

//拼接记录数、记录详细语句并查询结果集
if ($_SESSION[loginroleid]==1){
	$sql_count='select count(*) ct from article where 2>1 ';
	$sql_rec='select id,name,author,date(addtime) addtime,status,user_id from article where 2>1 ';
}else{
	$sql_count='select count(*) ct from article where creator='.$_SESSION[user_id].' ';
	$sql_rec='select id,name,author,date(addtime) addtime,status,user_id from article where 2>1 and user_id='.$_SESSION[loginuserid].' ';
}
if ($sql_part_search!=''){
	$sql_count.='and'.$sql_part_search;
	$sql_rec.='and'.$sql_part_search;
}
$result_count_article=$db_article_index->select($sql_count);
$result_count_article[0][ct]==0?$rec_pagenum_total=1:$rec_pagenum_total=ceil($result_count_article[0][ct]/PERPAGENO);

//确认当前页数
if(is_numeric($_SESSION[page])){
	if($_SESSION[page]==0){
		$_SESSION[page]=1;
	}else{
		if ($_SESSION[page]>$rec_pagenum_total) {
			$_SESSION[page]=$rec_pagenum_total;
		}
	}
}else{
	$_SESSION[page]=1;
}

//拼接page html
$pagebar_html='<div style="margin-top:5px"><b>当前页数/总页数:'.$_SESSION[page].'/'.$rec_pagenum_total.'</b>&nbsp;&nbsp;';
if($_SESSION[page]==1){
	if($_SESSION[page]<>$rec_pagenum_total)
		$pagebar_html.='首页&nbsp;&nbsp;上一页&nbsp;&nbsp;<a name="art" href="javascript:void(0);" id="'.($_SESSION[page]+1).'">下一页</a>&nbsp;&nbsp;<a name="art" href="javascript:void(0);" id="'.$rec_pagenum_total.'">尾页</a>&nbsp;&nbsp;';
}else{
	if($_SESSION[page]<>$rec_pagenum_total) $pagebar_html.='<a name="art" href="javascript:void(0);" id="1">首页</a>&nbsp;&nbsp;<a name="art" href="javascript:void(0);" id="'.($_SESSION[page]-1).'">上一页</a>&nbsp;&nbsp;<a name="art" href="javascript:void(0);" id="'.($_SESSION[page]+1).'">下一页</a>&nbsp;&nbsp;<a name="art" href="javascript:void(0);" id="'.$rec_pagenum_total.'">尾页</a>&nbsp;&nbsp;';
	else $pagebar_html.='<a name="art" href="javascript:void(0);" id="1">首页</a>&nbsp;&nbsp;<a name="art" href="javascript:void(0);" id="'.($_SESSION[page]-1).'">上一页</a>&nbsp;&nbsp;下一页&nbsp;&nbsp;尾页&nbsp;&nbsp;';
}
$pagebar_html.='跳转至<input id="pageinput" type="text" style="width:25px;"/>页';
$pagebar_html.='<button id="pagebutton" name="art" type="button"><span style="width:50px;font-size:9px">点击跳转</span></button></div>';

//确认记录显示起始数
$rec_start=($_SESSION[page]-1)*PERPAGENO;
$sql_rec.='order by id desc limit '.$rec_start.', '.PERPAGENO.' ';
$result_rec_article=$db_article_index->select($sql_rec);

//拼接1s条件
//$z='';
if ($result_rec_article){
	$sql_part_user_str='';
	$sql_part_status_str='';
	foreach ($result_rec_article as $val){
		$sql_part_user_str.=$val[user_id].',';
		$sql_part_status_str.=$val[status].',';
		//$z.=$val[status].'@';
	}
	$sql_part_user_str=substr($sql_part_user_str,0,strlen($sql_part_user_str)-1);
	$sql_part_status_str=substr($sql_part_status_str,0,strlen($sql_part_status_str)-1);
}

//生成1s结果集
if ($sql_part_user_str==''){
	$sql_user_arr='select id,name from user where 2>1 group by id ';
}else{
	$sql_user_arr='select id,name from user where 2>1 and id in ('.$sql_part_user_str.') group by id ';
}
if ($sql_part_status_str==''){
	$sql_status_arr='select status_id,name from status_article where 2>1 group by id ';
}else{
	$sql_status_arr='select status_id,name from status_article where 2>1 and status_id in ('.$sql_part_status_str.') group by status_id ';
}
$result_user_arr=$db_article_index->select($sql_user_arr);
$result_status_arr=$db_article_index->select($sql_status_arr);
if ($result_user_arr){
	foreach ($result_user_arr as $val){
		$arr_user[$val[id]]=$val[name];
	}
}
if ($result_status_arr){
	foreach ($result_status_arr as $val){
		$arr_status[$val[status_id]]=$val[name];
	}
}

if ($result_rec_article){
	$count=1;
	$rec_html='';
	foreach ($result_rec_article as $val){
		$rec_html.='<tr><td>'.$count.'</td>';
		$rec_html.='<td><a id="artid'.$val[id].'" style="text-decoration:underline;color:yellow">'.$val[name].'</a></td><td>'.$val[author].'</td><td>'.$val[addtime].'</td>';
		$rec_html.='<td>'.$arr_status[$val[status]].'</td><td>'.$arr_user[$val[user_id]].'</td>';
		$rec_html.='</tr>';
		$count++;
	}
}

$returnarr[content][tips]='';
$returnarr[content][content].=$rec_html.'</tbody></table>';
$returnarr[content][page_bar]=$pagebar_html;

//$returnarr[0][0]=$sql_status_arr.'#sql_stat#';
//$returnarr[0][0]=$_POST[func]."#f";//"#U_ID_STR";

require_once BASE_DIR.MDL_DIR.MDL_RETURN;
?>