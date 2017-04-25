<?php
class genIndex{
	public function __construct(){
		$this->genhtml($_SESSION[loginflag]);
	}

	public function genhtml($loginflag){
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<base href="<?php echo BASE_URL; ?>">
		<title>运维系统</title>
		<link href="<?php echo CSS_DIR.CSS_FILE?>" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="<?php echo JS_DIR.JS_JQ?>"></script>
		<script type="text/javascript" src="<?php echo JS_DIR.JS_CLCK?>"></script>
	</head>
	<body>
		<div id="main">
<?php if($loginflag==1){ ?>
			<div id="main_left">
				<div id="logo">ops_sys</div>
				<div id="menu_sub"></div>
			</div>
			<div id="main_right">
				<div id="info">hi,world</div>
				<div id="menu_nav"></div>
				<div id="menu_func"></div>
				<div id="content"></div>
			</div>
<?php }else{?>
			<div id="main_login">
				<form action="login.php" method='post'><table>
				</table></form>
			</div>
<?php }?>
		</div>
	</body>
</html>
<?php
	}
}
?>
