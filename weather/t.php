<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<base href="http://www.liujin.com/http/ops_script/view/"></base>
<title>运维系统</title>
<link href="css/default.css" rel="stylesheet"
	type="text/css" />
<script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
<!--  
<script type="text/javascript" src="js/test.js"></script>
-->
</head>
<body>
	<div id="main">
<a id="x">aaaaaa</a>

</div>
<script type="text/javascript">
$(document).ready(function(){
	alert('aaaaaaa');
	var a='{"aa":[{"a":"1"},{"b":"2"}],"ab":[{"A":"Aa"},{"B":"Bb"}]}';
	var b=eval('('+a+')');
	alert(b.aa);
//	$('#main').on('click','a',function(){
//		alert('bbbbbb');
//			$.ajax({
//				type: "POST",
//				dataType:"json",
//				url: "test.php",
//				data: 'cccccc',
//				success: function(msg){
//					//var data=eval('('+msg+')');
//					//$.each()
//					alert('dddddddddd');
//				}
//			});
//	});
});
</script>
</body>
</html>