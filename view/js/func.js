$.extend({
	login:function(){
		$(document).ready(function(){
			$('#table_login').on('click','button',function(){
				tmpurl=$('#form_login').attr('action');
				tmpdata='username='+$('#username').val()+'&userpassword='+$('#userpassword').val();
				$.ajx(tmpurl,tmpdata);
			});
		});
	}
});

$.extend({
	logout:function(){
		$(document).ready(function(){
			$('#info').on('click','a',function(){
				tmpurl='mdl/logout.mdl.php';
				tmpdata='';
				$.ajx(tmpurl,tmpdata);
			});
		});
	}
});

$.extend({
	menuload:function(){
		$(document).ready(function(){
			var tmpurl='mdl/menu.mdl.php';
			var tmpdata='';
			$.ajx(tmpurl,tmpdata);
		});
	}
});

$.extend({
    ajx:function(url,data){
		$(document).ready(function(){
			$.ajax({
				type: "POST",
				url: url,
				data: data,
				success: function(msg){
					var data=eval('('+msg+')');
					$.each(data,function(htmlFlag,htmlArr){
						switch(htmlFlag){
							case('hide'):
									$.each(htmlArr,function(htmlID,htmlContent){
										$('#'+htmlContent).hide();
									})
							break;
							case('show'):
								$.each(htmlArr,function(htmlID,htmlContent){
									$('#'+htmlContent).show();
								})
							break;
							case('content'):
								$.each(htmlArr,function(htmlID,htmlContent){
									$('#'+htmlID).html(htmlContent);
								})
							break;
							default:
								alert(data);
							break;
						}
					});
				}
				
			});
		});
    }
});