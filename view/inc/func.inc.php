<?php 

class FuncNavGen extends DBSql {

/**
	 *功能:构造函数，使用父类__construct，连接数据库
	 */
	public function __construct($menu_sub_id){
		parent::__construct();
		$this->menu_sub_id=$menu_sub_id;
	}

/**
 *功能:生成htmlid="tips_nav"中 对应导航位置的 html
 */
	public function gen_navpos_html($menusub_parent_id=-1,$tailname='',$strtips=''){
		if($menusub_parent_id==-1) $menusub_parent_id=$this->menu_sub_id;
		if($menusub_parent_id!=0){
			$navpos_result_tmp=parent::select("select * from menu where id=".$menusub_parent_id);
			if($strtips==''){
				$strtips_tmp.=$navpos_result_tmp[0][name];
			}else{
				$strtips_tmp.=$navpos_result_tmp[0][name].'->'.$strtips;
			}
			return $this->gen_navpos_html($navpos_result_tmp[0][parent_id],$tailname,$strtips_tmp);
		}else{
			if($tailname==''){
				$strtips='<div style="float:left"><b>当前位置:<i>'.$strtips.'</i></b></div>';
			}else{
				$strtips='<div style="float:left"><b>当前位置:<i>'.$strtips.'->'.$tailname.'</i></b></div>';
			}
			return $strtips;
		}
	}

/**
 *功能:生成htmlid="menu_func"中 对应功能的 html
	 *categoryid=1 main.mdl.php使用                 
	 *categoryid=2 modify_view.mdl.php使用   
	 *categoryid=3 set_view.mdl.php使用         
 */
	public function gen_func_html($category_id){
		$func_html='';
		switch ($category_id){
			case 1:
				$func_left_sql='select * from wordbook where type=3 and menu_sub_id='.$this->menu_sub_id.' order by seq';
				$func_right_sql='select * from wordbook where type=4 and menu_sub_id='.$this->menu_sub_id.' order by seq';
				break;
			case 3:
				$func_left_sql='select * from wordbook where type=3 and menu_sub_id='.$this->menu_sub_id.' order by seq';
				break;
			
		}
		$func_left_result=parent::select($func_left_sql);
		$func_right_result=parent::select($func_right_sql);
		if ($func_left_sql) {
			$func_html.='<div style="float:left">';
			foreach ($func_left_result as $val){
				$func_html.='<a id="'.$val[colnameid].'" href="javascript:void(0)">'.$val[name].'</a>&nbsp|&nbsp';
			}
			$func_html.='</div>';
		}
		if ($func_right_sql) {
			$func_html.='<div style="float:right;padding-right:200px"><select id="search_bar">';
			foreach ($func_right_result as $val){
				$func_html.='<option value="'.$val[colnameid].'">'.$val[name].'</option>';
			}
			$func_html.='</select><input id="search_word" type="text"/><button id="word_search">搜索</button><button id="word_reset">重置</button></div>';
		}
		if ($func_html!='') {
			return $func_html;
		}
	}

}
?>