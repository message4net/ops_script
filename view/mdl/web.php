<?php 
if ($_SESSION[loginflag]==1) {
	require_once MDL_MAIN;
}else{
	require_once MDL_LOGIN;
}
?>