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
		$classreturnarr[rec_tablename]=$rec_tablename_result[0][tablename];
		$rec_head_sql='select * from wordbook where type=1 and menu_sub_id='.$menu_sub_id.' order by seq';
		$rec_head_result='select * from wordbook where type=1 and menu_sub_id='.$menu_sub_id.' order by seq';
		$classreturnarr[rec_head_result]=$rec_head_result;
		unset($rec_tablename_sql,$rec_tablename_result,$rec_tablename,$rec_head_sql,$rec_head_result);
		return $classreturnarr;
		
		$rec_body_1m_sql='select * from wordbook where type=2 and menu_sub_id='.$_SESSION[menu_sub_id].' order by seq';
		$func_content_sql='select * from wordbook where type=5 and menu_sub_id='.$_SESSION[menu_sub_id].' order by seq';
		$func_content_result=$db_main->select($func_content_sql);
		
		$rec_body_1m_result=$db_main->select($rec_body_1m_sql);
		

		
	}
/**
	 *生成page_bar div 内的 html 内容
	 */
	public function gen_pagebar_html($rec_tablename,$pagenum_post_tmp,$pagenum_session_tmp,$pagenum_per){
		$rec_count_sql='select count(*) ct from '.$rec_tablename.';';
		$rec_count_result=parent::select($rec_count_sql);
		$rec_count_result[0][ct]==0?$rec_pagenum_total=1:$rec_pagenum_total=ceil($rec_count_result[0][ct]/$pagenum_per);
		if($pagenum_post_tmp==0){
			if($pagenum_session_tmp==0){
				$pagenum_session_tmp=1;
			}
		}else{
			if ($pagenum_post_tmp>$rec_pagenum_total) {
				$pagenum_post_tmp=$rec_pagenum_total;
			}
			$pagenum_session_tmp=$pagenum_post_tmp;
		}
		
		$rec_pagenum_start=(($pagenum_session_tmp-1)*$pagenum_per);

		if($rec_pagenum_start>=$rec_count_result[0][ct]) $rec_pagenum_start=$rec_count_result[0][ct]-$rec_count_result[0][ct]%$pagenum_per;

		$pagebar_html='<div style="margin-top:5px"><b>当前页数/总页数:'.$pagenum_session_tmp.'/'.$rec_pagenum_total.'</b>&nbsp;&nbsp;';
		if($pagenum_session_tmp==1){
			if($pagenum_session_tmp<>$rec_pagenum_total)
				$pagebar_html.='首页&nbsp;&nbsp;上一页&nbsp;&nbsp;<a href="javascript:void(0);" id="'.($pagenum_session_tmp+1).'">下一页</a>&nbsp;&nbsp;<a href="javascript:void(0);" id="'.$rec_pagenum_total.'">尾页</a>&nbsp;&nbsp;';
		}else{
			if($pagenum_session_tmp<>$rec_pagenum_total) $pagebar_html.='<a href="javascript:void(0);" id="1">首页</a>&nbsp;&nbsp;<a href="javascript:void(0);" id="'.($pagenum_session_tmp-1).'">上一页</a>&nbsp;&nbsp;<a href="javascript:void(0);" id="'.($pagenum_session_tmp+1).'">下一页</a>&nbsp;&nbsp;<a href="javascript:void(0);" id="'.$rec_pagenum_total.'">尾页</a>&nbsp;&nbsp;';
			else $pagebar_html.='<a href="javascript:void(0);" id="1">首页</a>&nbsp;&nbsp;<a href="javascript:void(0);" id="'.($pagenum_session_tmp-1).'">上一页</a>&nbsp;&nbsp;下一页&nbsp;&nbsp;尾页&nbsp;&nbsp;';
		}
		$pagebar_html.='跳转至<input id="pageinput" type="text" style="width:25px;"/>页';
		$pagebar_html.='<button id="pagebutton" type="button"><span style="width:50px;font-size:9px">点击跳转</span></button></div>';
		return $pagebar_html;
//		$classreturnarr[content][page_bar]=$pagebar_html;
		
//		$tips_navhtml=genTips($tablenameresult,$tablenameresult[0][name],'');
//		$returnarr[content][tips_nav]=$tips_navhtml;
	}

	public function gen_navpos_html($menusub_parent_id,$tailname,$strtips){
		if($menusub_parent_id!=0){
			$navpos_result_tmp=parent::select("select * from menu where id=".$menusub_parent_id);
			$strtips_tmp=$navpos_result_tmp[0][name].'->'.$strtips;
			return $this->gen_navpos_html($navpos_result_tmp[0][parent_id],$tailname,$strtips_tmp);
		
		}else{
			$strtips='<div style="float:left"><b>当前位置:<i>'.$strtips.$tailname.'</i></b></div>';
			return $strtips;
		}
//		$tips_navhtml=genTips($tablenameresult,$tablenameresult[0][name],'');
//		$returnarr[content][tips_nav]=$tips_navhtml;
	}
	
	public function gen_func_html(){
		$func_html='';
		$func_left_sql='select * from wordbook where type=3 and menu_sub_id='.$_SESSION[menu_sub_id].' order by seq';
		$func_right_sql='select * from wordbook where type=4 and menu_sub_id='.$_SESSION[menu_sub_id].' order by seq';
		$func_left_result=parent::select($func_left_sql);
		$func_right_result=parent::select($func_right_sql);
		if ($func_left_result) {
			$func_html.='<div style="float:left">';
			foreach ($func_left_result as $val){
				$func_html.='<a id="'.$val[colnameid].'" href="javascript:void(0)">'.$val[name].'</a>&nbsp|&nbsp';
			}
			$func_html.='</div>';
		}
		if ($func_right_result) {
			$func_html.='<div style="float:right;padding-right:200px"><select id="search_bar">';
			foreach ($func_right_result as $val){
				$func_html.='<option id="$val[colnameid]">'.$val[name].'</option>';
			}
			$func_html.='</select><input type="text"/><button>搜索</button></div>';
		}
		if ($func_html!='') {
			return $func_html;
			//$returnarr[content][menu_func]=$func_html;
		}
		
	}
	
	public function tmp(){

	
	
	$rec_body_column_sql_part='';
	$rec_head_html='<table id="content_table" name="'.$menu_sub_id.'">';
	foreach ($dataarr[rec_head_result] as $val) {
		$rec_body_column_sql_part.=$val[colnameid].',';
		if ($val[colnameid]=='id'){
			$rec_head_html.='<th><input type="checkbox" id="0" name="contentall"/></th><th>序号</th><th style="text-align:center">操作</th>';
		}else{
			$rec_head_html.='<th>'.$val[name].'</th>';
			if ($rec_body_1m_result) {
				foreach ($rec_body_1m_result as $val1){
					$rec_head_html.='<th>'.$val1[name].'</th>';
				}
			}
		}
	}


	$rec_body_column_sql_part=substr($rec_body_column_sql_part,0,strlen($rec_body_column_sql_part)-1).' ';
	$rec_head_html.='</tr>';
	$rec_body_column_sql='select '.$rec_body_column_sql_part.' from '.$classreturnarr[rec_tablename].' order by id desc limit '.$rec_pagenum_start.','.$pagenum_per.';';
	$tablebodyresult=$db_main->select($rec_body_column_sql);
	$sql_statment2='';
	foreach ($tablebodyresult as $val){
		$sql_statment2.=$val[id].',';
	}
	$sql_statment2=substr($sql_statment2,0,strlen($sql_statment2)-1);
	foreach ($rec_body_1m_result as $val){
		if ($val[sqlstr_body]=='') {
			$sql_tmp_content_statment2=$val[sqlstr_head].$sql_statment2.$val[sqlstr_foot];
		}else{
			$sql_tmp_content_statment2=$val[sqlstr_head].$sql_statment2.$val[sqlstr_body].$sql_statment2.$val[sqlstr_foot];
		}
		$result_statment2=$db_main->select($sql_tmp_content_statment2);
		foreach ($result_statment2 as $val1) {
			$content_statment2[$val1[mainid]][$val1[subid]]=$val1[name];
		}
	}
	

	$tablebodyhtml='';
	$count=1;
	foreach ($tablebodyresult as $key=>$val) {
		$tablebodyhtml.='<tr>';
		$tablebodyhtml_foot='';
		foreach ($val as $key1=>$val1){
			if ($key1=='id') {
				$tmpid=$val1;
				$tablebodyhtml.='<td><input type="checkbox" id="'.$val1.'" name="contentlist"/></td><td>'.$count.'</td><td id="content_func" mid="'.$_POST[id].'" rid="'.$val1.'">';
				foreach ($func_content_result as $val2){
					if ($val2[flag]==1) {
						$tablebodyhtml.='<a id="'.$val2[colnameid].$val1.'" href="javascript:void(0);" onclick="if(confirm(\'确实要删除此条记录吗？\')) return true;else return false;">'.$val2[name].'</a>|';
					}else{
						$tablebodyhtml.='<a id="'.$val2[colnameid].$val1.'" href="javascript:void(0);">'.$val2[name].'</a>|';
					}
				}
				$tablebodyhtml.='</td>';
			}else{
				$tablebodyhtml.='<td>'.$val1.'</td>';
			}
			if ($key1=='id') {
				$content2='';
				if ($content_statment2[$val1]) {
					foreach ($content_statment2[$val1] as $val2){
						$content2.='@'.$val2;
					}
				}else{
					$content2.='';
				}
				$tablebodyhtml_foot.='<td style="font-size:10px;word-break:break-all">'.$content2.'</td>';
			}
		}
		$tablebodyhtml.=$tablebodyhtml_foot.'</tr>';
		$count++;
	}
	$tablebodyhtml.='</tr></table>';
	$returnhtml=$rec_head_html.$tablebodyhtml;
	$returnarr[content][content]=$returnhtml;
	$returnarr[content][tips]='';
	


	unset($tips_navhtml,$func_content_sql,$func_content_result,$func_html,$rec_pagenum_start,$tablebodysql,$tablebodysql_query,$pagebar_html,$rec_pagenum_total,$returnhtml,$tableheadhtml,$tablebodyhtml,$tablebodyhtml_foot,$count,$content2,$tablenameresult,$tableheadresult,$rec_count_sql,$rec_count_result,$db_main,$tablenamesql,$tableheadsql,$rec_body_1m_sql,$func_right_sql,$func_left_sql,$func_left_result,$func_right_result,$rec_body_1m_result,$tablenameresult,$tableheadresult,$rec_count_sql,$sql_tmp_content_statment2,$val2,$key1,$val1,$val,$key,$tablebodyresult);
	}
}
?>