$.extend({
	firstinit:function(){
		$(document).ready(function(){
			var z=[['a','b','c'],['1','2','3']];
			var tmpstr='';
			for(var i=0;i<z.length;i++){
				for(var j=0;j<z[i].length;j++){
					tmpstr=tmpstr+z[i][j];}
				};
			alert(tmpstr);
			tmpurl='mdl/menu.mdl.php';
			tmpdata='';
			$.ajx(tmpurl,tmpdata);
			tmpeid='form_login';
			tmpectxt='button';
			tmpurl=$('#'+tmpeid).attr('action');
			tmpdata='\'username=\'+$(\'#username\').val()+\'&userpassword=\'+$(\'#userpassword\').val()';
			$.click(tmpeid,tmpectxt,tmpurl,tmpdata);
			tmpeid='menu_nav';
			tmpectxt='a';
			tmpurl='mdl/menu_sub.mdl.php';
			tmpdata='\'id=\'+$(this).attr(\'id\')';
			$.click(tmpeid,tmpectxt,tmpurl,tmpdata);
			tmpeid='info';
			tmpectxt='a';
			tmpurl='mdl/logout.mdl.php';
			tmpdata='';
			$.click(tmpeid,tmpectxt,tmpurl,tmpdata);
			tmpeid='menu_sub';
			tmpectxt='a';
			tmpurl='mdl/main.mdl.php';
			tmpdata='\'id=\'+$(this).attr(\'id\')';
			$.click(tmpeid,tmpectxt,tmpurl,tmpdata);
		});
	}
});

$.extend({
	click:function(eid,ectxt,url,data){
		$('#'+eid).on('click',ectxt,function(){
			tmpdata=eval(data);
//alert(data);
			$.ajx(url,tmpdata);
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