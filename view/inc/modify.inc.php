<?php
/** private
功能:记录增删改类
**/
class ModSet extends DBSql{

/**
 *功能:默认打印访问的 ip、方法、接口、参数
 */
	public function __construct(){
		parent::__construct();
	}

/**
 * 功能:删除权限role，并将user对应的该role_id改为默认role_id
 * 参数:$role_del 删除的权限role_id
 * 		$role_change creator有$role_del变更为$role_change 及拥有者的权限role_id
 */
	public function del_role($role_del,$role_change){
		$sql_del_role='delete from role where id='.$role_del.';';
		$sql_del_role_menu='delete from role_menu where role_id='.$role_del.';';
		$sql_del_role_func='delete from role_func where role_id='.$role_del.';';
		$sql_change_user_role='update user set role_id=2 where role_id='.$role_del.';';
		$sql_creatorson='select * from role where creator='.$role_del.';';
		
		parent::delete($sql_del_role_menu);
		parent::delete($sql_del_role);
		parent::delete($sql_del_role_func);
		parent::update($sql_change_user_role);
		
		$str_log_arr[0]=$this->change_owner_creatorson($role_del,$role_change);
		$str_log_arr[1]='权限删除成功';
		
		return $str_log_arr;
	}
	
/**
 * 功能:删除权限role时,更改子role,user的归属creator
 * 参数:$creator_role_del 删除的权限role_id
 * 		$creator_role_change 变更为拥有者的权限role_id
 */
	public function change_owner_creatorson($role_del,$role_change){
		$sql_creatorson='select * from role where creator='.$role_del.';';
		$result_creatorson=parent::select($sql_creatorson);
		if ($result_creatorson){
			foreach ($result_creatorson as $val){
				$str_creatorson.=$val[id].',';
			}
			$str_creatorson=substr($str_creatorson, 0,strlen($str_creatorson)-1);
			$sql_creatorson_role_change='update role set creator='.$role_change.' where creator in ('.$str_creatorson.');';
			$sql_creatorson_user_change='update user set creator='.$role_change.' where creator in ('.$str_creatorson.');';
			parent::$db_modify->update($sql_creatorson_role_change);
			parent::$db_modify->update($sql_creatorson_user_change);
			return 'DEL4 CHANGE str_creatorson '.$str_creatorson;
		}else{
			return 'DEL4 CHANGE no str_creatorson';
		}
	}
	
/**
 * 功能:通过遍历函数获得子creator字符串，并结合参数拼装所有创建者字符串
 * 参数:$creator_str 初始创建者字符串, "creator,"的循环并取出末尾最后1个","
 */
	public function gen_creatorsonstrall($creator_str){
		$creatorson_str=$this->traversalcreatorson($creator_str,$creator_str_tmp='');
		if ($creatorson_str!=''){
			$creatorall_str.=$creatorson_str.$creator_str;
		}else{
			$creatorall_str=$creator_str;
		}
		return $creatorall_str;
	}

/**
 * 功能:遍历获得所有子creator，并拼接为字符串
 * 参数:$creator_str 初始创建者字符串, "creator,"的循环并取出末尾最后1个","
 * 	    $roles_str_tmp 每次查询后拼接好的当前所有子creator字符串
 */
	public function traversalcreatorson($creator_str,$creator_str_tmp=''){
		if ($creator_str!=''){
			$sql_creator_str='select * from role where creator in ('.$creator_str.');';
			$result_creator_str=parent::select($sql_creator_str);
			if ($result_creator_str){
				foreach ($result_creator_str as $val){
					$sql_creator_str_tmp.=$val[id].',';
				}
				$sql_creator_str_tmp=substr($sql_creator_str_tmp,0,strlen($sql_creator_str_tmp)-1);
				$creator_str_tmp.=$sql_creator_str_tmp.',';
			}
			return $this->traversalcreatorson($sql_creator_str_tmp,$creator_str_tmp);
		}else{
			return 	$creator_str_tmp;
		}
	}

}
?>
