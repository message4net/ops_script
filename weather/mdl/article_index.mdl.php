<?php 
session_start();
require_once str_replace('\\','/',dirname(dirname(__FILE__))).'/cfg/base.cfg.php';
require_once BASE_DIR.INC_DIR.INC_DB;
require_once BASE_DIR.INC_DIR.INC_FUNC;

require_once BASE_DIR.INC_DIR.INC_LOG;

$log_modify_view=new LogHandle();

$db_article_index=new DBSql();

//初始化功能
$returnarr[content][menu_func]='<div style="float:left"><a id="artl_add" href="javascript:void(0)">新增</a>&nbsp;|&nbsp;</div><div style="float:right;padding-right:200px"><select id="search_bar"><option value="name">标题</option><option value="author">作者</option><option value="user_id">上传者</option></select><input id="search_word" type="text"><button id="word_search">搜索</button><button id="word_reset">重置</button></div>';
$returnarr[content][tips_nav]='<div style="float:left"><b>当前位置:<i>文档管理-&gt;文章管理</i></b></div>';
$returnarr[content][content]='<table id="content_table" name="8"><tbody><tr><th>序号</th><th>标题</th><th>作者</th><th>日期</th><th>状态</th><th>上传者</th></tr>';

if ($_POST[id]!='') {
	$_SESSION[menu_sub_id]=$_POST[id];
}
if ($_POST[page]!='') {
	$_SESSION[page]=$_POST[page];
}
if ($_POST[searchword]!='') {
	$_SESSION[searchword]=$_POST[searchword];
	$_SESSION[searchcol]=$_POST[searchcol];
}
if ($_POST[func]=='reset'){
	$_SESSION[searchword]='';
	$_SESSION[page]='';
}

//拼接page html
/*
$pagebar_html='<div style="margin-top:5px"><b>当前页数/总页数:'.$this->rec_init_arr[rec_pagenum_post].'/'.$this->rec_init_arr[rec_pagenum_total].'</b>&nbsp;&nbsp;';
if($this->rec_init_arr[rec_pagenum_post]==1){
	if($this->rec_init_arr[rec_pagenum_post]<>$this->rec_init_arr[rec_pagenum_total])
		$pagebar_html.='首页&nbsp;&nbsp;上一页&nbsp;&nbsp;<a href="javascript:void(0);" id="'.($this->rec_init_arr[rec_pagenum_post]+1).'">下一页</a>&nbsp;&nbsp;<a href="javascript:void(0);" id="'.$this->rec_init_arr[rec_pagenum_total].'">尾页</a>&nbsp;&nbsp;';
}else{
	if($this->rec_init_arr[rec_pagenum_post]<>$this->rec_init_arr[rec_pagenum_total]) $pagebar_html.='<a href="javascript:void(0);" id="1">首页</a>&nbsp;&nbsp;<a href="javascript:void(0);" id="'.($this->rec_init_arr[rec_pagenum_post]-1).'">上一页</a>&nbsp;&nbsp;<a href="javascript:void(0);" id="'.($this->rec_init_arr[rec_pagenum_post]+1).'">下一页</a>&nbsp;&nbsp;<a href="javascript:void(0);" id="'.$this->rec_init_arr[rec_pagenum_total].'">尾页</a>&nbsp;&nbsp;';
	else $pagebar_html.='<a href="javascript:void(0);" id="1">首页</a>&nbsp;&nbsp;<a href="javascript:void(0);" id="'.($this->rec_init_arr[rec_pagenum_post]-1).'">上一页</a>&nbsp;&nbsp;下一页&nbsp;&nbsp;尾页&nbsp;&nbsp;';
}
$pagebar_html.='跳转至<input id="pageinput" type="text" style="width:25px;"/>页';
$pagebar_html.='<button id="pagebutton" type="button"><span style="width:50px;font-size:9px">点击跳转</span></button></div>';

return $pagebar_html;
/*

$returnarr[content][content].='</tbody></table>';

$sql_article_count='select count(*) from article;';

$returnarr[0][0]='aaaaa';
require_once BASE_DIR.MDL_DIR.MDL_RETURN;
/*
 * <div id="main_right">
	<div id="info" style="">hi,<span id="span_info">admin</span><a id="logout" href="javascript:void(0);"><span style="font-size:14px;color:yellow"><i>注销</i></span></a></div>
	<div id="menu_nav"><div id="div_menu"><ul><li><a id="1" href="javascript:void(0);">系统管理</a></li><li><a id="6" href="javascript:void(0);">个人管理</a></li><li><a id="2" href="javascript:void(0);">文档管理</a></li></ul></div></div>
	<div id="menu_func"><div style="float:left"><a id="artl_add" href="javascript:void(0)">新增</a>&nbsp;|&nbsp;</div><div style="float:right;padding-right:200px"><select id="search_bar"><option value="name">标题</option><option value="author">作者</option><option value="user_id">上传者</option></select><input id="search_word" type="text"><button id="word_search">搜索</button><button id="word_reset">重置</button></div></div>
	<div id="tips_nav"><div style="float:left"><b>当前位置:<i>文档管理-&gt;文章管理</i></b></div></div>
	<div id="tips"></div>
	<div id="content"><table id="content_table" name="8"><tbody><tr><th><input id="0" name="contentall" type="checkbox"></th><th>序号</th><th style="text-align:center">操作</th><th>标题</th><th>作者</th><th>日期</th><th>状态</th><th>上传者</th></tr></tbody></table></div>
	<div id="page_bar"><div style="margin-top:5px"><b>当前页数/总页数:1/1</b>&nbsp;&nbsp;跳转至<input id="pageinput" style="width:25px;" type="text">页<button id="pagebutton" type="button"><span style="width:50px;font-size:9px">点击跳转</span></button></div></div>
</div>
 */
?>