<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<base href="http://127.0.0.1/http/ops_script/view/"></base>
		<title>测试系统页面</title>
		<link href="css/default.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
		<script type="text/javascript" src="js/func.js"></script>
	</head>
	<body>
		<div id="main">
			<div id="main_login">
				<form id="form_login" action="mdl/login_vrf.mdl.php" method="post">
					<table id="table_login">
				<tr><th colspan="2" style="color:black;font-size:15px;text-align:left">请输入用户名、密码后,</th></tr>
				<tr><th colspan="2" style="color:black;font-size:15px;text-align:right">点击按钮登录进入系统</th></tr>
				<tr><td>用户名</td><td><input id="username" type="text" value=""/></td></tr>
				<tr><td>密码</td><td><input id="userpassword" type="password" value=""/></td></tr>
				<tr><td colspan="2" style="text-align:center"><button id="button_login" type="button">登录</button></td></tr>
					</table>
				</form>
			</div>
		</div>
		<script type="text/javascript" src="js/login.js"></script>			
		<script type="text/javascript">
			$.login();
		</script>
</body>
</html>