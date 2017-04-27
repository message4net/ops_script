$.extend({
    ajx:function(url,data){
	$(document).ready(function(){
		$.ajax({
			type: "POST",
			url: url,
			data: data,
			success: function(msg){
//				alert(msg);
				var data=eval('('+msg+')');
				$.each(data,function(htmlFlag,htmlArr){
					switch(htmlFlag){
						case('hide'):
							$.each(htmlArr,function(htmlID,htmlContent){
								$('#'+htmlID).hide();
							})
						break;
						case('content'):
							$.each(htmlArr,function(htmlID,htmlContent){
								$('#'+htmlID).html(htmlContent);
							})
						break;
					}
				});
			}
			
		});
	});
    }
});