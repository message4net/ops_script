$.extend({
	firstinit:function(){
		$(document).ready(function(){
			var datajson={'paras':[{'eid':'form_login','txt':'button','url':$('#form_login').attr('action'),'data':'\'username=\'+$(\'#username\').val()+\'&userpassword=\'+$(\'#userpassword\').val()'},{'eid':'menu_nav','txt':'a','url':'mdl/menu_sub.mdl.php','data':'\'id=\'+$(this).attr(\'id\')'},{'eid':'info','txt':'a','url':'mdl/logout.mdl.php','data':''},{'eid':'menu_sub','txt':'a','url':'mdl/main.mdl.php','data':'\'id=\'+$(this).attr(\'id\')'},{'eid':'page_bar','txt':'a','url':'mdl/main.mdl.php','data':'\'page=\'+$(this).attr(\'id\')'},{'eid':'page_bar','txt':'button','url':'mdl/main.ctr.php','data':'\'page=\'+$(\'#pageinput\').val()'}]};
//			var datajson={'paras':[{'eid':'form_login','txt':'button','url':$('#form_login').attr('action'),'data':'\'username=\'+$(\'#username\').val()+\'&userpassword=\'+$(\'#userpassword\').val()'},{'eid':'menu_nav','txt':'a','url':'mdl/menu_sub.mdl.php','data':'\'id=\'+$(this).attr(\'id\')'},{'eid':'info','txt':'a','url':'mdl/logout.mdl.php','data':''},{'eid':'menu_sub','txt':'a','url':'mdl/main.mdl.php','data':'\'id=\'+$(this).attr(\'id\')'},{'eid':'page_bar','txt':'a','url':'mdl/main.mdl.php','data':'\'page=\'+$(this).attr(\'id\')'},{'eid':'page_bar','txt':'button','url':'mdl/main.mdl.php','data':'\'page=\'+$(\'#pageinput\').val()'},{'eid':'menu_func','txt':'#func_add','url':'mdl/modify_view.mdl.php','data':''}]};
////			var datajson={'paras':[{'eid':'menu_nav','txt':'a','url':'mdl/menu_sub.mdl.php','data':'\'id=\'+$(this).attr(\'id\')'},{'eid':'info','txt':'a','url':'mdl/logout.mdl.php','data':''},{'eid':'menu_sub','txt':'a','url':'mdl/main.mdl.php','data':'\'id=\'+$(this).attr(\'id\')'},{'eid':'page_bar','txt':'a','url':'mdl/main.mdl.php','data':'\'page=\'+$(this).attr(\'id\')'},{'eid':'page_bar','txt':'button','url':'mdl/main.mdl.php','data':'\'page=\'+$(\'#pageinput\').val()'},{'eid':'menu_func','txt':'#func_add','url':'mdl/modify_view.mdl.php','data':''}]};
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

			$('#menu_func').on('click','#func_add',function(){
				$.ajx('mdl/modify_view.mdl.php','');
			})			
						
			$('#content').on('click','[id^=func_mod_]',function(){
				tmpid=$(this).attr('id').substring(9);
				tmpfnc=$(this).attr('id').substring(0,9);
				$.ajx('mdl/modify_view.mdl.php','fnc='+tmpfnc+'&recid='+tmpid);
			});
			
			$('#content').on('click','[id^=func_del_]',function(){
				tmpid=$(this).attr('id').substring(9);
				tmpfnc=$(this).attr('id').substring(0,8);
				$.ajx('mdl/modify.mdl.php','fnc='+tmpfnc+'&recid='+tmpid);
			});

$('#menu_func').on('click','#func_delall',function(){
	if($(':checkbox').is(':checked')){
		tmpstrchecked='';
		$('[name=contentlist]:checkbox:checked').each(function(){
			tmpstrchecked+=$(this).attr('id')+',';
		});
		tmpstrchecked=tmpstrchecked.substring(0,tmpstrchecked.length-1);
	}else{
		alert('请选择需要删除的权限后，再点击批删除');
	}
	tmpfnc=$(this).attr('id');
	tmpdata='fnc='+tmpfnc+'&tmpstr='+tmpstrchecked;
	$.ajx('mdl/modify.mdl.php',tmpdata);
})			
			
			$('#content').on('click','[id^=m_v_s_]',function(){
				if($('#name').val()==''){
					alert('名称不能为空');
					$('#name').focus();
				}else{
					tmpname=$('#name').val();
					tmpfnc=$(this).attr('id').substring(0,9);
					tmpjsfnc=$(this).attr('id').substring(6,9);
					tmprecid=$(this).attr('id').substring(10);
					if($(':checkbox').is(':checked')){
						tmpstrchecked='';
						$(':checkbox:checked').each(function(){
							tmpstrchecked+=$(this).attr('id')+',';
						});
						tmpstrchecked=tmpstrchecked.substring(0,tmpstrchecked.length-1);
					}else{
						tmpstrchecked='ZZZ';
					}
					if(tmpjsfnc=="mod"){
						tmpdata='fnc='+tmpfnc+'&name='+tmpname+'&tmpstr='+tmpstrchecked+'&recid='+tmprecid;
					}else{
						tmpdata='fnc='+tmpfnc+'&name='+tmpname+'&tmpstr='+tmpstrchecked;
					}
					$.ajx('mdl/modify.mdl.php',tmpdata);
				}
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