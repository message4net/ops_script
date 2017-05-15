$.extend({
	firstinit:function(){
		$(document).ready(function(){
			var datajson={'paras':[{'eid':'form_login','txt':'button','url':$('#form_login').attr('action'),'data':'\'username=\'+$(\'#username\').val()+\'&userpassword=\'+$(\'#userpassword\').val()'},{'eid':'menu_nav','txt':'a','url':'mdl/menu_sub.mdl.php','data':'\'id=\'+$(this).attr(\'id\')'},{'eid':'info','txt':'a','url':'mdl/logout.mdl.php','data':''},{'eid':'menu_sub','txt':'a','url':'mdl/main.mdl.php','data':'\'id=\'+$(this).attr(\'id\')'}]};
			var tmpstr='';
			tmpurl='mdl/menu.mdl.php';
			tmpdata='';
			$.ajx(tmpurl,tmpdata);
			$.main(datajson.paras);
		});
	}
});

$.extend({
	main:function(arr){
		for(var i=0;i<arr.length;i++){
			tmpeid=arr[i].eid;
			tmpectxt=arr[i].txt;
			tmpurl=arr[i].url;
			tmpdata=arr[i].data;
			$.click(tmpeid,tmpectxt,tmpurl,tmpdata);
		}
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