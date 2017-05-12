<?php
require_once BASE_DIR.MDL_DIR.MDL_HEAD;
?>
<div id="main_left">
	<div id="logo">ops_sys</div>
	<div id="menu_sub"></div>
</div>
<div id="main_right">
	<div id="info">hi,<span id="span_info"></span><a id='logout' href="javascript:void(0);"><span style="font-size:14px"><i>注销</i></span></a></div>
	<div id="menu_nav"></div>
	<div id="tips_nav"></div>
	<div id="menu_func"></div>
	<div id="content"></div>
</div>
<div id="main_login">
	<form id="form_login" action="<?php echo MDL_DIR.MDL_LOGIN?>"
		method="post">
		<table id="table_login">
			<tr>
				<th colspan="2"
					style="color: black; font-size: 15px; text-align: left">请输入用户名、密码后,</th>
			</tr>
			<tr>
				<th colspan="2"
					style="color: black; font-size: 15px; text-align: right">点击按钮登录进入系统</th>
			</tr>
			<tr>
				<td>用户名</td>
				<td><input id="username" type="text" value="" /></td>
			</tr>
			<tr>
				<td>密码</td>
				<td><input id="userpassword" type="password" value="" /></td>
			</tr>
			<tr>
				<td colspan="2" style="text-align: center"><button id="button_login"
						type="button">登录</button></td>
			</tr>
		</table>
	</form>
	<div id='tips_login'></div>
</div>
<script type="text/javascript">
$.firstinit();
</script>
<?php 
require_once BASE_DIR.MDL_DIR.MDL_FOOT;
?>