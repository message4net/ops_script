$.extend({
	login:function(){
		$(document).ready(function(){
			$('submit_login').on('click','button',function(){
				$.ajax(tmpurl,tmpdata);
			});
		});
	}
});
$.extend({
    ajax:function(url,data){
	$(document).ready(function(){
//		alert('ab');
		$.ajax({
			type: "POST",
			url: url,
			data: data,
			success: function(msg){
				var data=eval('('+msg+')');
				$.each(data,function(htmlID,htmlContent){
					$('#'+htmlID).html(htmlContent);
				});
			}
			
		});
	});
    }
});