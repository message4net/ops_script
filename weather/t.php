<?php 
$returnarr[content][content]=<<< _EOF
<div id="content"><table>
	<tr><td>标题</td><td colspan="2"><input id="name" type="text"/></td></tr>
	<tr><td>作者</td><td colspan="2"><input id="author" type="text"/></td></tr>
	<tr><td>传图</td><td><input name="pic[]" type="file" multiple/></td><td><button id="uppic" name="pics[]">点击上传</button></td></tr>
	<tr><td>内容</td><td colspan="2"><textarea id="atr_txt" style="width:500px;height:200px;"></textarea></td></tr>
	<tr><td colspan="3"><button id="artl_upl">保存</button></td></tr>
</table></div>
_EOF;
echo $returnarr[content][content];
if($_FILES){
	var_dump($_FILES);
}
?>