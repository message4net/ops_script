<?php session_start();
require_once str_replace('\\','/',dirname(dirname(__FILE__))).'/cfg/base.cfg.php';
require_once BASE_DIR.INC_DIR.INC_DB;
require_once BASE_DIR.INC_DIR.INC_FUNC;

require_once BASE_DIR.INC_DIR.INC_LOG;

$log_modify_view=new LogHandle();


$returnarr[content][content]=<<< _EOF
<div id="content"><table>
	<tr><td>标题</td><td colspan="2"><input id="name" type="text"/></td></tr>
	<tr><td>作者</td><td colspan="2"><input id="author" type="text"/></td></tr>
	<tr><td>传图</td><td><form id="fmpic"><input name="pic[]" type="file" multiple/></td><td><button id="uppic" >点击上传</button></form></td></tr>
	<tr><td>内容</td><td colspan="2"><textarea id="art_txt" style="width:500px;height:200px;"></textarea></td></tr>
	<tr><td colspan="3"><button id="artl_sav">保存新闻</button></td></tr>
</table></div>
_EOF;


//测试代码
//$returnarr[0][0]='1';
//
//echo json_encode($returnarr);
//unset($returnarr);
//exit;

$returnarr[content][page_bar]='';

require_once BASE_DIR.MDL_DIR.MDL_RETURN;
?>