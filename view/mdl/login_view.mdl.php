<div id="main_login">
	<form id="form_login" action="<?php echo MDL_DIR.MDL_LOGIN_VRF?>" method="post">
		<table id="table_login">
			<tr><th colspan="2" style="color:black;font-size:15px;text-align:left">请输入用户名、密码后,</th></tr>
			<tr><th colspan="2" style="color:black;font-size:15px;text-align:right">点击按钮登录进入系统</th></tr>
			<tr><td>用户名</td><td><input id="username" type="text" value=""/></td></tr>
			<tr><td>密码</td><td><input id="password" type="password" value=""/></td></tr>
			<tr><td colspan="2" style="text-align:center"><button id="button_login" type="button">登录</button></td></tr>
		</table>
	</form>
</div>
<script type="text/javascript" src="<?php echo JS_DIR.JS_LOGIN?>"></script>
<script type="text/javascript">
$.login();
</script>