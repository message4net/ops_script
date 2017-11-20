<?php 

class ViewMain extends DBSql {
private $rec_init_arr=array();
/**
	 *功能:构造函数，使用父类__construct，连接数据库
	 */
	public function __construct($menu_sub_id,$login_role_id,$login_user_id,$rec_pagenum_post_tmp=1,$rec_word_search='',$rec_col_search=''){
//public function __construct($menu_sub_id,$login_role_id,$rec_pagenum_post_tmp=1,$rec_word_search='',$rec_col_search=''){
		parent::__construct();
		$this->menu_sub_id=$menu_sub_id;
		$this->login_role_id=$login_role_id;
		$this->login_user_id=$login_user_id;
		$this->pagenum_per=PERPAGENO;
		$this->rec_pagenum_post_tmp=$rec_pagenum_post_tmp;
		if ($rec_word_search!=''){
			$this->rec_word_search=$rec_col_search.' like \'%'.$rec_word_search.'%\' ';
		}
		$this->rec_init_arr=$this->init_recarr();
	}
/**
 * 功能:生成当前pagenum
 */
	public function gen_rec_pagenum_post(){
		if(is_numeric($this->rec_pagenum_post_tmp)){
			if($this->rec_pagenum_post_tmp==0){
				$this->rec_pagenum_post_tmp=1;
			}else{
				if ($this->rec_pagenum_post_tmp>$this->rec_init_arr[rec_pagenum_total]) {
					$this->rec_pagenum_post_tmp=$this->rec_init_arr[rec_pagenum_total];
				}
			}
		}else{
			$this->rec_pagenum_post_tmp=1;
		}

		$rec_pagenum_post=$this->rec_pagenum_post_tmp;

		return $rec_pagenum_post;
		
	}
/**
 * 生成$this->rec_init_arr[rec_pagenum_total]
 */	
	public function gen_rec_pagenum_total(){
		if($this->rec_word_search==''){
			//如果非user ,role 表，可能需要使用注释的语句
			//$rec_count_sql='select count(*) ct from '.$this->rec_init_arr[rec_tablename].';';
			$rec_count_sql='select count(*) ct from '.$this->rec_init_arr[rec_tablename].' where creator='.$this->login_role_id.';';
		}else{
			//$rec_count_sql='select count(*) ct from '.$this->rec_init_arr[rec_tablename].' where '.$this->rec_word_search.';';
			 $rec_count_sql='select count(*) ct from '.$this->rec_init_arr[rec_tablename].' where '.$this->rec_word_search.' and creator='.$this->login_role_id.';';
		}
		
		$rec_count_result=parent::select($rec_count_sql);
		$rec_count_result[0][ct]==0?$rec_pagenum_total=1:$rec_pagenum_total=ceil($rec_count_result[0][ct]/$this->pagenum_per);
		$rec[count]=$rec_count_result[0][ct];
		$rec[pagenum_total]=$rec_pagenum_total;
		
		//$rec[sql_tmp]=$rec_count_sql;

		return $rec;
	}
	
/**
 *初始化数据 
 */
	public function init_recarr(){
		$rec_tablename_sql='select * from menu where id='.$this->menu_sub_id;
		$rec_tablename_result=parent::select($rec_tablename_sql);
		$this->rec_init_arr[rec_tablename]=$rec_tablename_result[0][tablename];
		$this->rec_init_arr[menusub_parent_id]=$rec_tablename_result[0][parent_id];
		$rec=$this->gen_rec_pagenum_total();
		$this->rec_init_arr[rec_pagenum_total]=$rec[pagenum_total];
		$this->rec_init_arr[rec_count]=$rec[count];
		$this->rec_init_arr[rec_pagenum_post]=$this->gen_rec_pagenum_post($this->rec_pagenum_post_tmp);
		$this->rec_init_arr[rec_num_start]=(($this->rec_init_arr[rec_pagenum_post]-1)*$this->pagenum_per);
		if($this->rec_init_arr[rec_num_start]>=$this->rec_init_arr[rec_count]) $this->rec_init_arr[rec_num_start]=$this->rec_init_arr[rec_count]-$this->rec_init_arr[rec_count]%$this->pagenum_per;

		//$this->rec_init_arr[sql_tmp]=$rec[sql_tmp];
		
		return $this->rec_init_arr;
	}

/**
	 *生成page_bar div 内的 html 内容
	 */
	public function gen_pagebar_html(){

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
	}

	public function gen_view_content_html(){
		$sql_head_user='select * from user_col where user_id='.$this->login_user_id;
		$result_head_user=parent::select($sql_head_user);
		if($result_head_user){
			$rec_head_sql='select * from wordbook wb, role_func rf, user_col uc where role_id='.$this->login_role_id.' and uc.user_id='.$this->login_user_id.' and uc.menu_sub_id=wb.menu_sub_id and uc.wordbook_id=wb.id and wb.menu_sub_id=rf.menu_sub_id and wb.id=rf.wordbook_id and type=1 and wb.menu_sub_id='.$this->menu_sub_id.' order by seq';
		}else{
			$rec_head_sql='select * from wordbook wb, role_func rf where role_id='.$this->login_role_id.' and wb.id=rf.wordbook_id and type=1 and wb.menu_sub_id='.$this->menu_sub_id.' order by seq';
		}
		$rec_head_result=parent::select($rec_head_sql);
		
		if ($rec_head_result){
			$func_content_sql='select * from wordbook wb, role_func rf where rf.role_id='.$this->login_role_id.' and wb.id=rf.wordbook_id and type=5 and wb.menu_sub_id='.$this->menu_sub_id.' order by seq';
			$func_content_result=parent::select($func_content_sql);

			if($result_head_user){
//				$rec_body_1m_sql='select * from wordbook where type=2 and menu_sub_id='.$this->menu_sub_id.' order by seq';
//				$rec_body_1s_sql='select * from wordbook where type=7 and menu_sub_id='.$this->menu_sub_id.' order by seq';
				$rec_body_1m_sql='select * from wordbook wb, role_func rf, user_col uc where rf.role_id='.$this->login_role_id.' and uc.user_id='.$this->login_user_id.' and uc.menu_sub_id=wb.menu_sub_id and uc.wordbook_id=wb.id and wb.menu_sub_id=rf.menu_sub_id and wb.id=rf.wordbook_id and type=2 and wb.menu_sub_id='.$this->menu_sub_id.' order by seq';
				$rec_body_1s_sql='select * from wordbook wb, role_func rf, user_col uc where rf.role_id='.$this->login_role_id.' and uc.user_id='.$this->login_user_id.' and uc.menu_sub_id=wb.menu_sub_id and uc.wordbook_id=wb.id and wb.menu_sub_id=rf.menu_sub_id and wb.id=rf.wordbook_id and type=7 and wb.menu_sub_id='.$this->menu_sub_id.' order by seq';
			}else{
				$rec_body_1m_sql='select * from wordbook wb, role_func rf where rf.role_id='.$this->login_role_id.' and wb.id=rf.wordbook_id and type=2 and wb.menu_sub_id='.$this->menu_sub_id.' order by seq';
				$rec_body_1s_sql='select * from wordbook wb, role_func rf where rf.role_id='.$this->login_role_id.' and wb.id=rf.wordbook_id and type=7 and wb.menu_sub_id='.$this->menu_sub_id.' order by seq';
			}
			$rec_body_1m_result=parent::select($rec_body_1m_sql);
			$rec_body_1s_result=parent::select($rec_body_1s_sql);
			
			$rec_body_column_sql_part='';
			$rec_head_html='<table id="content_table" name="'.$this->menu_sub_id.'">';
			foreach ($rec_head_result as $val) {
				$rec_body_column_sql_part.=$val[colnameid].',';
				if ($val[colnameid]=='id'){
					$rec_head_html.='<th><input type="checkbox" id="0" name="contentall"/></th><th>序号</th><th style="text-align:center">操作</th>';
				}else{
					$rec_head_html.='<th>'.$val[name].'</th>';
					if($rec_body_1s_result){
						foreach ($rec_body_1s_result as $vala){
							$rec_head_html.='<th>'.$vala[name].'</th>';
						}
					}
					if ($rec_body_1m_result) {
						foreach ($rec_body_1m_result as $val1){
							$rec_head_html.='<th>'.$val1[name].'</th>';
						}
					}
				}
			}
			$rec_body_column_sql_part=substr($rec_body_column_sql_part,0,strlen($rec_body_column_sql_part)-1).' ';
			$rec_head_html.='</tr>';
			if($this->rec_word_search==''){
				//$rec_body_column_sql='select '.$rec_body_column_sql_part.' from '.$this->rec_init_arr[rec_tablename].' order by id desc limit '.$this->rec_init_arr[rec_num_start].','.$this->pagenum_per.';';
				$rec_body_column_sql='select '.$rec_body_column_sql_part.' from '.$this->rec_init_arr[rec_tablename].' where creator='.$this->login_user_id.' order by id desc limit '.$this->rec_init_arr[rec_num_start].','.$this->pagenum_per.';';
			}else{
				//$rec_body_column_sql='select '.$rec_body_column_sql_part.' from '.$this->rec_init_arr[rec_tablename].' where '.$this->rec_word_search.' order by id desc limit '.$this->rec_init_arr[rec_num_start].','.$this->pagenum_per.';';
				$rec_body_column_sql='select '.$rec_body_column_sql_part.' from '.$this->rec_init_arr[rec_tablename].' where '.$this->rec_word_search.' and creator='.$this->login_user_id.' order by id desc limit '.$this->rec_init_arr[rec_num_start].','.$this->pagenum_per.';';
			}
			$rec_body_column_result=parent::select($rec_body_column_sql);
			//确认1m,1s对应的范围
			$rec_body_1m_colname_sql='';
			foreach ($rec_body_column_result as $val){
				$rec_body_1m_colname_sql.=$val[id].',';
			}
			$rec_body_1m_colname_sql=substr($rec_body_1m_colname_sql,0,strlen($rec_body_1m_colname_sql)-1);
			foreach ($rec_body_1m_result as $val){
				if ($val[sqlstr_body]=='') {
					$rec_body_1m_str_sql=$val[sqlstr_head].$rec_body_1m_colname_sql.$val[sqlstr_foot];
				}else{
					$rec_body_1m_str_sql=$val[sqlstr_head].$rec_body_1m_colname_sql.$val[sqlstr_body].$rec_body_1m_colname_sql.$val[sqlstr_foot];
				}
				$rec_body_1m_str_result=parent::select($rec_body_1m_str_sql);
				foreach ($rec_body_1m_str_result as $val1) {
					$rec_body_1m_str_arr[$val[seq]][$val1[mainid]][$val1[subid]]=$val1[name];
				}
			}
			foreach ($rec_body_1s_result as $val){
				if ($val[sqlstr_body]=='') {
					$rec_body_1m_str_sql=$val[sqlstr_head].$rec_body_1m_colname_sql.$val[sqlstr_foot];
				}else{
					$rec_body_1m_str_sql=$val[sqlstr_head].$rec_body_1m_colname_sql.$val[sqlstr_body].$rec_body_1m_colname_sql.$val[sqlstr_foot];
				}
				$rec_body_1s_str_result=parent::select($rec_body_1m_str_sql);
				foreach ($rec_body_1s_str_result as $val1) {
					$rec_body_1s_str_arr[$val[seq]][$val1[mainid]]=$val1[name];
				}
			}
	
			$rec_body_html='';
			$count=1;
			foreach ($rec_body_column_result as $key=>$val) {
				$rec_body_html.='<tr>';
				$rec_body_1m_html='';
				foreach ($val as $key1=>$val1){
					if ($key1=='id') {
						$rec_body_html.='<td><input type="checkbox" id="'.$val1.'" name="contentlist"/></td><td>'.$count.'</td><td id="content_func" mid="'.$_POST[id].'" rid="'.$val1.'">';
						foreach ($func_content_result as $val2){
							if ($val2[flag]==1) {
								$rec_body_html.='<a id="'.$val2[colnameid].$val1.'" href="javascript:void(0);" onclick="if(confirm(\'确实要删除此条记录吗？\')) return true;else return false;">'.$val2[name].'</a>|';
							}else{
								$rec_body_html.='<a id="'.$val2[colnameid].$val1.'" href="javascript:void(0);">'.$val2[name].'</a>|';
							}
						}
						$rec_body_html.='</td>';
					}else{
						$rec_body_html.='<td>'.$val1.'</td>';
					}
					//当key为id时，根据id的具体值确定1m,1s对应的显示文本
					if ($key1=='id') {
						$rec_body_1s_html='';
						foreach ($rec_body_1s_str_arr as $valb){
							$rec_body_1s_html.='<td style="font-size:10px;word-break:break-all">'.$valb[$val1].'</td>';
						}
						$rec_body_1m_html_str='';
						foreach ($rec_body_1m_str_arr as $valb){
							if ($valb[$val1]) {
								foreach ($valb[$val1] as $val2){
									$rec_body_1m_html_str.='@'.$val2;
								}
							}else{
								$rec_body_1m_html_str.='';
							}
							$rec_body_1m_html.='<td style="font-size:10px;word-break:break-all">'.$rec_body_1m_html_str.'</td>';
						}
					}
				}
				$rec_body_html.=$rec_body_1s_html.$rec_body_1m_html.'</tr>';
				$count++;
			}
			$rec_body_html.='</tr></table>';
			$rec_html=$rec_head_html.$rec_body_html;
		}else{
			$rec_html='<div style="float:left">制作中，请联系管理员</div>';
		}

		return $rec_html;
		//return $rec_head_sql;
	}

}
?>