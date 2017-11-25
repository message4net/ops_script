<?php session_start();
require_once str_replace('\\','/',dirname(dirname(__FILE__))).'/cfg/base.cfg.php';
require_once BASE_DIR.INC_DIR.INC_DB;
require_once BASE_DIR.INC_DIR.INC_FUNC;

require_once BASE_DIR.INC_DIR.INC_LOG;

$log_modify_view=new LogHandle();
$db_output=new DBSql();

$sql_out='select a.name,author,date(addtime) dt,c.name status,b.name user from article a, user b,status_article c where a.status=c.status_id and a.user_id=b.id';
$resulte_out=$db_output->select($sql_out);
$zname='output.txt';
$yname='output.xls';
//$log_modify_view->logprint('1',LEVEL_LOG_ERR, '#POST##'.PIC_DIR.$_POST[name].'###name');
//$log_modify_view->logprint('1',LEVEL_LOG_ERR, '#RQST##'.$_REQUEST[name].'###name');
//$log_modify_view->logprint('1',LEVEL_LOG_ERR, '#GET##'.PIC_DIR.$_GET[name].'###name');
$f_o=fopen(BASE_DIR.PIC_DIR.$zname, 'wb');

$f_h=<<<_EOF
标题\t作者\t日期\t状态\t用户\t\n
_EOF;

//$a="a你b";
//$b=utf8_encode($a);
//$f_h=$a;
fwrite($f_o,$f_h);
//fclose($f_o);
//$f_o=fopen(BASE_DIR.PIC_DIR.$zname, 'ab');
//fwrite($f_o,'aaaaa');

if($resulte_out){
	foreach ($resulte_out as $val){
		$t=$val[name]."\t".$val[author]."\t".$val[dt]."\t".$val[status]."\t".$val[user]."\t\n";
		fwrite($f_o,$t);
	}
}

fclose($f_o);

$file1=BASE_DIR.PIC_DIR.$zname;
$c_b=file_get_contents($file1);
$c_a=iconv('utf-8', 'gb2312', $c_b);
file_put_contents($file1, $c_a);

rename($file1,BASE_DIR.PIC_DIR.$yname);
$file=BASE_DIR.PIC_DIR.$yname;

/*
 $returnarr[0][0]=filesize($file).'##e';
 require_once BASE_DIR.MDL_DIR.MDL_RETURN;
*/



//$h = fopen($file, 'r');
//header("Content-type: application/vnd.ms-excel");
header("Content-Type:application/octet-stream");
header("Content-disposition:attachment;filename=".$file.";");
header("Accept-Length:".filesize($file));

ob_clean();
flush();
readfile($file);
//echo fread($h, filesize($file));

//fclose($h);
//exit


//readfile($file);

?>