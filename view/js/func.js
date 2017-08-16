$.extend({
	firstinit:function(){
		$(document).ready(function(){
//			var datajson={'paras':[{'eid':'form_login','txt':'button','url':$('#form_login').attr('action'),'data':'\'username=\'+$(\'#username\').val()+\'&userpassword=\'+$(\'#userpassword\').val()'},{'eid':'menu_nav','txt':'a','url':'mdl/menu_sub.mdl.php','data':'\'id=\'+$(this).attr(\'id\')'},{'eid':'info','txt':'a','url':'mdl/logout.mdl.php','data':''},{'eid':'menu_sub','txt':'a','url':'mdl/main.mdl.php','data':'\'id=\'+$(this).attr(\'id\')'},{'eid':'page_bar','txt':'a','url':'mdl/main.mdl.php','data':'\'page=\'+$(this).attr(\'id\')'},{'eid':'page_bar','txt':'button','url':'mdl/main.mdl.php','data':'\'page=\'+$(\'#pageinput\').val()'},{'eid':'menu_func','txt':'#func_add','url':'mdl/modify_view.mdl.php','data':''}]};
			var datajson={'paras':[{'eid':'menu_nav','txt':'a','url':'mdl/menu_sub.mdl.php','data':'\'id=\'+$(this).attr(\'id\')'},{'eid':'info','txt':'a','url':'mdl/logout.mdl.php','data':''},{'eid':'menu_sub','txt':'a','url':'mdl/main.mdl.php','data':'\'id=\'+$(this).attr(\'id\')'},{'eid':'page_bar','txt':'a','url':'mdl/main.mdl.php','data':'\'page=\'+$(this).attr(\'id\')'},{'eid':'page_bar','txt':'button','url':'mdl/main.mdl.php','data':'\'page=\'+$(\'#pageinput\').val()'},{'eid':'menu_func','txt':'#func_add','url':'mdl/modify_view.mdl.php','data':''}]};
			tmpurl='mdl/menu.mdl.php';
			tmpdata='';
			$.ajx(tmpurl,tmpdata);
			$.main(datajson.paras);
			$('#content').on('click','input[name="contentall"]',function(){
					if($('input[name="contentall"]').prop('checked')){
						$('input[name="contentlist"]').each(function(){
							$(this).prop('checked',true);
						})
					}else{
						$('input[name="contentlist"]').each(function(){
							$(this).prop('checked',false);
						})
					}
			});

$('#form_login').on('click','button',function(){
	alert('username='+$('#username').val()+'&userpassword='+$('#userpassword').val());
//	$.ajx($('#form_login').attr('action'),'username='+$('#username').val()+'&userpassword='+$('#userpassword').val());
	$.ajx('mdl/login1.mdl.php','username='+$('#username').val()+'&userpassword='+$('#userpassword').val());
});
			
			
////$('#content').on('click','[id^="func_mod_"]');
////,{'eid':'content','txt':'a','url':'mdl/modify.mdl.php','data':'\'id=\'+$(this).closest(\'td\').attr(\'mid\')+\'&recid=\'+$(this).closest(\'td\').attr(\'rid\')'}
			$('#content').on('click','button#m_v_s_add',function(){
				if($('#name').val()==''){
					alert('名称不能为空');
					$('#name').focus();
				}else{
					tmpname=$('#name').val();
					tmpfnc=$(this).attr('id');
					if($(':checkbox').is(':checked')){
						tmpstrchecked='';
						$(':checkbox:checked').each(function(){
							tmpstrchecked+=$(this).attr('id')+',';
						});
						tmpstrchecked=tmpstrchecked.substring(0,tmpstrchecked.length-1);
						$.ajx('mdl/modify.mdl.php','fnc='+tmpfnc+'&name='+tmpname+'&tmpstr='+tmpstrchecked);
					}else{
						alert('复选框至少要选择其中1项');
					}
				}
//				'mdl/modify.mdl.php'
			})
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
		//alert(eid+'###'+ectxt+'###'+url+'###'+tmpdata);
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
									$.each(htmlContent,function(htmlIDsub,htmlContentsub){
										if($('#'+htmlIDsub).length==0){
											//$('#'+htmlID).remove('#'+htmlIDsub);
											$('#'+htmlID).append('<div id="'+htmlIDsub+'" style="z-index:10001;width:800px;height:600px;margin-top:-30px;opacity:1;"></div>');
										}
										$('#'+htmlIDsub).empty();
										$('#'+htmlIDsub).append(htmlContentsub+'aaaaaaaaaa<br/>aaaaaa<br/>aaaaaaa<br/>aaaaa<br/>aaaaaaaaaaaaaaaaaaa');
									})
								})
							break;
							case('rmv'):
								$.each(htmlArr,function(htmlID,htmlContent){
									$.each(htmlContent,function(htmlIDsub,htmlContentsub){
//										$('#'+htmlID).remove('#'+htmlContent);
										$('#'+htmlContent).remove();
										//alert(htmlID+htmlContent);
									})
								})
							break;
							case('fcs'):
								$.each(htmlArr,function(htmlID,htmlContent){
										$('#'+htmlContent).focus();
								})
							break;
							default:
								alert(data);
								alert(htmlArr);
							break;
						}
					});
				}
			});
		});
    }
});