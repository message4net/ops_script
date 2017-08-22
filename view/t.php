<?php session_start();
var_dump($_SESSION);
//$a=array(array(1,1),array(1,2),array(1,4),array(1,5));
//$b=array(array(1,1),array(1,3),array(1,7),array(1,5));
//$c=array_diff($a,$b);
$a=array(1,2,3,4);
$b=array(1,3,5,7);

$c=array_diff($b,$a);
var_dump($c);
?>