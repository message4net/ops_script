<?php
if ($_SESSION[page]=='') {
	session_start();
	$_SESSION[page]=1;
}
if ($_POST[page]!='') {
	$_SESSION[page]=$_POST[page];
}
$pageinfobar='<div style="margin-top:5px"><b>当前页数/总页数:'.$_SESSION[page].'/'.$totalpagenum.'</b>&nbsp;&nbsp;';
if($_SESSION[page]==1){
	if($_SESSION[page]<>$totalpagenum)
		$pageinfobar.='首页&nbsp;&nbsp;上一页&nbsp;&nbsp;<a href="javascript:void(0);" id="'.($_SESSION[page]+1).'">下一页</a>&nbsp;&nbsp;<a href="javascript:void(0);" id="'.$totalpagenum.'">尾页</a>&nbsp;&nbsp;';
}else{
	if($_SESSION[page]<>$totalpagenum) $pageinfobar.='<a href="javascript:void(0);" id="1">首页</a>&nbsp;&nbsp;<a href="javascript:void(0);" id="'.($_SESSION[page]-1).'">上一页</a>&nbsp;&nbsp;<a href="javascript:void(0);" id="'.($_SESSION[page]+1).'">下一页</a>&nbsp;&nbsp;<a href="javascript:void(0);" id="'.$totalpagenum.'">尾页</a>&nbsp;&nbsp;';
	else $pageinfobar.='<a href="javascript:void(0);" id="1">首页</a>&nbsp;&nbsp;<a href="javascript:void(0);" id="'.($pageno-1).'">上一页</a>&nbsp;&nbsp;下一页&nbsp;&nbsp;尾页&nbsp;&nbsp;';
}
$pageinfobar.='跳转至<input id="pageinput" type="text" style="width:25px;"/>页';
$pageinfobar.='<button id="pagebutton" type="button"><span style="width:50px;font-size:9px">点击跳转</span></button></div>';
$returnarr[content][page_bar]=$pageinfobar;
?>