<?php
require_once BASE_DIR.MDL_DIR.MDL_HEAD;

require_once BASE_DIR.INC_DIR.INC_LOG;

$log_web=new LogHandle();
//$loginfo='IP:'.$_SERVER[REMOTE_ADDR].'METHOD:'.$_SERVER[REQUEST_METHOD].'PAGE:'.$_SERVER[REQUEST_URI].'PARAS:'.$_SERVER[QUERY_STRING];
//$log->logprint(FLAG_LOG_INFO, LEVEL_LOG_INFO, $loginfo);

?>
<div id="main_left">
	<div id="logo"><?php echo NAME_SYS;?></div>
	<div id="menu_sub"></div>
</div>
<div id="main_right">
	<div id="info" style="display: none">hi,<span id="span_info"></span><a id='logout' href="javascript:void(0);"><span style="font-size:14px;color:yellow"><i>注销</i></span></a></div>
	<div id="menu_nav"></div>
	<div id="menu_func"></div>
	<div id="tips_nav"></div>
	<div id="tips"></div>
	<div id="content"></div>
	<div id="page_bar"></div>
</div>
<div id="main_login">
	<form id="form_login" action="<?php echo MDL_DIR.MDL_LOGIN?>" method="post">
		<table id="table_login">
			<tr>
				<th colspan="2" style="color: black; font-size: 15px; text-align: left">请输入用户名、密码后,</th>
			</tr>
			<tr>
				<th colspan="2" style="color: black; font-size: 15px; text-align: right">点击按钮登录进入系统</th>
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
				<td colspan="2" style="text-align: center"><button id="button_login" type="button">登录</button></td>
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