<?php session_start();
require_once 'cfg/base.cfg.php';
require_once BASE_DIR.INC_DIR.INC_DB;
require_once BASE_DIR.INC_DIR.INC_FUNC;

$db_output=new DBSql();

$sql_out='select a.name,author,date(addtime) dt,c.name status,b.name user from article a, user b,status_article c where a.status=c.status_id and a.user_id=b.id';
$resulte_out=$db_output->select($sql_out);
echo 'C<br/>';
var_dump($resulte_out);
echo '<br/>';
var_dump($sql_out);

?>