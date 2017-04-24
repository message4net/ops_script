$.extend({
        view:function(){
		$(document).ready(function(){
			$('#container').on('click','a,button',function(){
				ltype=$(this).closest('#typeflag').attr('ltype');
				switch(ltype){
					case("modshow"):
						var tmplid=$('#hidecontent').attr('lid')
						var tmpfid=$(this).attr('lid');
						var tmpurl='model/modify_show,php';
						if(!isNaN(tmpfid)){
							var tmpcid=$(this).attr('cid');
						}
						break;
					case("moddeal"):
						break;
					case("dbstruct"):
						var tmplid=$(this).attr('lid');
						if(tmplid==''||isNaN(tmplid)){
							var tmplid=$('#hidecontent').attr('lid')
							var tmpflag=$(this).attr('id');
							var tmpfocusflag=0;
							var tmpurl='model/page.php';
							if(tmpflag=='pagebutton'){
								var tmppgno=$('input#pageinput').val();
								var tmpfocusflag=1;
								if(tmppgno==''||isNaN(tmppgno)){
									$('input#pageinput').focus();
									alert('请输入阿拉伯数字的有效跳转页数')
									return;
								}
							}else{
								var tmppgno=$(this).attr('pgno');
							}
						}else{
							var tmppgno=1;
							var tmpurl='f_m_c.php';
						}
						if(!isNaN(tmplid)){
							$('#hidecontent').attr('lid',tmplid);
						}
						if(!isNaN(tmppgno)){
							$('#hidecontent').attr('pgno',tmppgno);
						}
						var tmpdata="lid="+tmplid+"&pgno="+tmppgno;
						$.ajx(tmpurl,tmpdata);
//						$.ajax({
//							type: "POST",
//							url: tmpurl,
////							data: {lid:tmplid,pgno:tmppgno},
//							data: tmpdata,
//							success: function(msg){
//								var data=eval('('+msg+')');
//								$.each(data,function(htmlID,htmlContent){
//									$('#'+htmlID).html(htmlContent);
////									$('#'+htmlID).empty();
////									$('#'+htmlID).append(htmlContent);
//								});
//							}
//						});
						if(tmpfocusflag==1){
							window.setTimeout("$('input#pageinput').focus();",50);
						}
						break;
					case("logout"):
						location.href='model/logout.php';
						break;
				}
			});
		});
        }
});
$.extend({
        ajx:function(url,data){
		$(document).ready(function(){
//			alert('ab');
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
//$.extend({
//        view1:function(){
//		$(document).ready(function(){
////			$("#navbar li,#main li").click(function(){
////			$("li").click(function(){
//			$('#main_lft').on('click','li',function(){
//				$.ajax({
//					type: "POST",
//					url: "f_m_c.php",
////					url: "f.php",
//					data: {id:$(this).attr('id'),pgno:$('#hidecontent').attr('pgno')},
//					success: function(msg){
//						var data=eval('('+msg+')');
//						$.each(data,function(htmlID,htmlContent){
//							$('#'+htmlID).html(htmlContent);
//						});
//					}
//					
//				});
//			});
//		});
//        }
//});
