<?php require_once BASE_DIR.MDL_DIR.MDL_HEAD;
if ($_SESSION[loginflag]==1) {
	require_once BASE_DIR.MDL_DIR.MDL_MAIN_VIEW;
}else{
	require_once BASE_DIR.MDL_DIR.MDL_LOGIN_VIEW;
}
require_once BASE_DIR.MDL_DIR.MDL_FOOT;
?>