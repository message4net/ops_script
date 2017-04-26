$.extend({
	login:function(){
		$(document).ready(function(){
			tmpurl=$('#form_login').attr('action');
//			alert(tmpurl);
			tmpdata='1';
			$('button').click(function(){
//				alert(tmpurl);
				$.ajx(tmpurl,tmpdata);
			});
		});
	}
});