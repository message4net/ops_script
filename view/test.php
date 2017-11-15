<?php
$a=1;
echo json_encode($_POST);
foreach ($_POST as $key=>$val){
	$z.='###'.$key.'---->'.$val;
}
$file=fopen('z.log','a');
fwrite($file, $z);
fclose($file);

?>