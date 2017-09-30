<?php session_start();

require_once dirname(__FILE__).'/cfg/base.cfg.php';
require_once BASE_DIR.INC_DIR.INC_DB;
require_once BASE_DIR.INC_DIR.INC_VIEW;

$tmpid=4;

$view_tmp=new View($tmpid,1);

echo "###post###<br/>";
$a=$view_tmp->gen_rec_pagenum_post();
var_dump($a);
echo "<br/>###<br/>";

echo "###total###<br/>";
$a=$view_tmp->gen_rec_pagenum_total();
var_dump($a);
echo "<br/>###<br/>";

echo "###init###<br/>";
$a=$view_tmp->init_recarr(4,2);
var_dump($a);
echo "<br/>###<br/>";

echo "###bar###<br/>";
$a=$view_tmp->gen_pagebar_html();
var_dump($a);
echo "<br/>###<br/>";

echo "###nav###<br/>";
$a=$view_tmp->gen_navpos_html(-1,'修改','');
var_dump($a);
echo "<br/>###<br/>";

echo "###func###<br/>";
$a=$view_tmp->gen_func_html();
var_dump($a);
echo "<br/>###<br/>";

echo "###content###<br/>";
$a=$view_tmp->gen_view_content_html();
var_dump($a);
echo "<br/>###<br/>";

//var_dump($_SESSION);
//$a=array(array(1,1),array(1,2),array(1,4),array(1,5));
//$b=array(array(1,1),array(1,3),array(1,7),array(1,5));
//$c=array_diff($a,$b);
//$a=array(1,2,3,4);
//$b=array(1,3,5,7);
//$a=array();
//$b=array();
//$c=array_diff($a,$b);
//$a[0][0]=1;
//$c=$a;
//$b[0][1]=2;
//$c=$b;
//var_dump($c);
//$d=$c==''?'Yes,NULL':'No,not NULL';
//var_dump($d);
//$x='';
//$y=explode(',',$x);
//var_dump(count($y));

//class a {
//	private $arr=array();
//	public function __construct(){
//		
//	}
//	public function b() {
//		return $this->arr[a]=1;
//	}
//	public function c() {
//		return $this->arr[b]=2;
//	}
//}
//
//$a=new a();



?>