$.extend({
	firstinit:function(){
		$(document).ready(function(){
			var datajson={'paras':[{'eid':'form_login','txt':'button','url':$('#form_login').attr('action'),'data':'\'username=\'+$(\'#username\').val()+\'&userpassword=\'+$(\'#userpassword\').val()'},{'eid':'menu_nav','txt':'a','url':'mdl/menu_sub.mdl.php','data':'\'id=\'+$(this).attr(\'id\')'},{'eid':'info','txt':'a','url':'mdl/logout.mdl.php','data':''},{'eid':'menu_sub','txt':'a','url':'mdl/main.mdl.php','data':'\'id=\'+$(this).attr(\'id\')'},{'eid':'content','txt':'a','url':'mdl/modify.mdl.php','data':'\'id=\'+$(this).closest(\'table\').attr(\'mid\')+\'&recid=\'+$(this).closest(\'table\').attr(\'rid\')'}]};
			tmpurl='mdl/menu.mdl.php';
			tmpdata='';
			$.ajx(tmpurl,tmpdata);
			$.main(datajson.paras);
			//tmpeid='content_table';
			//tmpeid='table_func';
			//tmpectxt='a';
			//tmpurl='mdl/modify.mdl.php';
			//tmpdata='';
			//$.click(tmpeid,tmpectxt,tmpurl,tmpdata);
			//$('#content').on('click','a',function(){
			//	alert($(this).attr('rid'));
			//});
			$('#content').on('click','button',function(){
				$.ajx('mdl/privilege.mdl.php','aaa')
			});
			$('#content').on('click','input#pri_sbmt',function(){
				$.ajx('mdl/privilege_do.mdl.php','aaa')
			});
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
//		alert(tmpdata);
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
							case('apd'):
								$.each(htmlArr,function(htmlID,htmlContent){
									$.each(htmlContent,function(){
										$('#'+htmlID).remove('#'+htmlContent[0]);
										$('#'+htmlID).append('<div id="'+htmlContent[0]+'"></div>');
										$('#'+htmlContent[0]).empty();
										$('#'+htmlContent[0]).append(htmlContent[1]);
									})
								})
							break;
							case('rmv'):
								$.each(htmlArr,function(htmlID,htmlContent){
									$.each(htmlContent,function(){
//										$('#'+htmlID).remove('#'+htmlContent);
										$('#'+htmlContent).remove();
										//alert(htmlID+htmlContent);
									})
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