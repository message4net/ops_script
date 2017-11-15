<?php
class dfnvar {
/**
	*功能:构造数组变量
	*参数:1、数据库查询结果;2、参数数组名称
	*返回:数组
	*/
	public function StrctVar($result,$colname){
		if(count($result)==1) $arr=$result[0][$colname];
		else {
			$count=0;
			foreach($result as $val){
				$arr[]=$result[$count][$colname];
				$count++;
			}
		}
		return $arr;
	}
/**
	*功能:构造映射数组变量
	*参数:1、数据库查询结果;2、数组索引字段名称;3、数组值字段名称
	*返回:数组
	*/
	public function StrctRflctVar($data,$colname,$colname1){
		if(count($data)==1) $arr[$colname]=$data[0][$colname1];
		else {
			$count=0;
			foreach($data as $val){
				$arr[$data[$count][$colname]]=$data[$count][$colname1];
				$count++;
			}
		}
		return $arr;
	}
/**
	*功能:构造映射数组
	*参数:1、数据库查询结果;2、数组索引字段名称;3、数组值字段名称
	*返回:数组
	*/
	public function StrctRflctArr($data,$colname){
		if(count($data)==1) $arr[$colname]=$data[0];
		else {
			$count=0;
			foreach($data as $val){
				$arr[$data[$count][$colname]]=$data[$count];
				$count++;
			}
		}
		return $arr;
	}
/**
	*功能:构造菜单类表格头
	*参数:1、表格菜单提示;2、表格菜单表头数组;3、表格菜单数组(链接，说明)
	*返回:html表格代码
	*/
//	public function StrctTblMnStrt($tableheadarray,$tiparray,$tablecontentarray,$tablefunctionarray,$pagenum){
	public function StrctTblMnStrt($tableheadarray,$tiparray,$tablecontentarray,$pagenum){
//		($pagenum=='') ? $tmpSfxUrl='&pgnm=1' : $tmpSfxUrl='&pgnm='.$pagenum;
		$num=count($tableheadarray)-1;
//	        echo "<div class='content'>".$tips."</div><div class='cntnt'><table><tr>";
		$htmlStr="";
	        $htmlStr.="<table><tr>";
		foreach($tableheadarray as $key=>$val){
				$htmlStr.="<th>".$val."</th>";
		}
		$htmlStr.="</tr>";
//		foreach($tiparray as $val)
//			$htmlStr.="<tr><td>-</td><td><a href='".$val[0]."'>".$val[1]."</a></td><td colspan='".$num."'>-</td></tr>";
			$htmlStr.="<tr><td>-</td><td><a href='javascript:void(0);' id='typeflag' ltype='modshow' lid='".$tiparray[1][id]."'>".$tiparray[1][name]."</a></td><td colspan='".$num."'>-</td></tr>";
		$count=1;
		foreach($tablecontentarray as $val){
			$htmlStr.="<tr><td>".$count."</td><td><table>";
			$htmlStr.="<td><a href='javascript:void(0);' id='typeflag' ltype='modshow' lid='".$tiparray[2][id]."' cid='".$val[id]."'>".$tiparray[2][name]."</a></td>";
			$htmlStr.="<td><a href='javascript:void(0);' id='typeflag' ltype='moddeal' lid='".$tiparray[3][id]."' cid='".$val[id]."' onclick=\"if(confirm('确实要删除此条记录吗？')) return true;else return false; \">".$tiparray[3][name]."</a></td>";
//			foreach($tablefunctionarray as $key2=>$val2){
//				if($key2==4){
//					$htmlStr.="<td><a href=".$val2[0]."&cid=".$val[id].$tmpSfxUrl." onclick=\"if(confirm('确实要删除此条记录吗？')) return true;else return false; \">".$val2[1]."</a></td>";
//				}else{
//					$htmlStr.="<td><a href=".$val2[0]."&cid=".$val[id].$tmpSfxUrl.">".$val2[1]."</a></td>";
//				}
//			}
			$htmlStr.="</table></td>";
			foreach($tableheadarray as $key3=>$val3){
				if($key3=='Order'||$key3=='OpInit'){
					continue;
				}else{
					$htmlStr.="<td>".$val[$key3]."</td>";
				}
			}
			$count++;
			$htmlStr.="</tr>";
		}
//		echo $htmlStr;
		unset($tableheadarray);
		unset($tablecontentarray);
		unset($tiparray);
		return $htmlStr;
	}
/**
	*功能:构造创建类表格头
	*参数:1、表格提示;2、表格表头数组;3、表格链接;
	*返回:html表格代码
	*/
	public function StrctTblCrtStrt($tips,$link,$htmlarray){
		if(!empty($htmlarray)){
		        echo "<div class='content_tmp_fix'>".$tips."</div><div ".$htmlarray[0][0]."='".$htmlarray[0][1]."'>";
		}else{
			echo "<div>";
		}
        	echo "<table><form action='".$link."' method='post'>";
		unset($htmlarray);
	}
/**
	*功能:构造表格体
	*参数:1、表格提示;2、表格表头数组;3、表格链接;
	*返回:html表格代码
	*/
	public function StrctIpt($tablearray){
		foreach($tablearray as $val)
			echo "<tr><td>".$val[0]."</td><td><input name='".$val[1]."' type='".$val[2]."' value='".$val[3]."'/></td><td>$val[4]</td></tr>";
		unset($tablearray);
	}
/**
	*功能:构造html单选代码
	*参数:1、表格提示;2、表格表头数组;3、表格链接;4、表格链接说明
	*返回:html表格代码
	*/
	public function StrctOptn($data,$tablearray,$flag,$flagarray){
		echo "<tr><td>".$tablearray[0]."</td><td><select name='".$tablearray[1]."'>";
		foreach($data as $val){
	                if($val[$flagarray[0]]==$flag)
	                        echo "<option value='".$val[$flagarray[0]]."' selected='selected'>".$val[$flagarray[1]]."</option>";
	                else
	                        echo "<option value='".$val[$flagarray[0]]."'>".$val[$flagarray[1]]."</option>";
		}
	        echo "</select></td></tr>";	
		unset($tablearray);
		unset($flagarray);
	}
/**
	*功能:构造html文本编辑器代码
	*参数:1、表格表头数组;
	*返回:html表格代码
	*/
	public function StrctEdtr($tablearray){
		echo "<tr><td>".$tablearray[0]."</td><td><textarea name='".$tablearray[1]."'>".$tablearray[2]."</textarea>";
		echo "                        <script type='text/javascript'>CKEDITOR.replace('".$tablearray[1]."',";
	        echo "{";
		echo "filebrowserBrowseUrl :  '".DftPth."ckfinder/ckfinder.html',";
		echo "filebrowserImageBrowseUrl :  '".DftPth."ckfinder/ckfinder.html?Type=Images',";
		echo "filebrowserFlashBrowseUrl :  '".DftPth."ckfinder/ckfinder.html?Type=Flash',";
		echo "filebrowserUploadUrl :  '".DftPth."ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',";
	        echo "filebrowserImageUploadUrl  :  '".DftPth."ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',";
		echo "filebrowserFlashUploadUrl  :  '".DftPth."ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'";
		echo "}";
		echo ");</script></td></tr>";
		unset($tablearray);
	}
/**
	*功能:构造html多选代码
	*参数:1、表格提示;2、表格表头数组;3、表格链接;4、表格链接说明
	*返回:html表格代码
	*/
	public function StrctChkbx($tips,$tablearray,$cntnr,$verifyarray){
		echo "<tr><td>".$tips."</td><td></td></tr>";
		foreach($tablearray as $key=>$val)
			if(in_array($key,$verifyarray) || $key==$verifyarray)
				echo "<tr><td></td><td><input name='".$cntnr."' type='checkbox' value='".$key."' checked='checked' />".$val['name']."</td></tr>";
			else
				echo "<tr><td></td><td><input name='".$cntnr."' type='checkbox' value='".$key."' />".$val['name']."</td></tr>";
		unset($tablearray);
		unset($verifyarray);
	}
/**
	*功能:构造表格菜单尾
	*参数:无
	*返回:html表格代码
	*/
	public function StrctTblEnd($type,$tips){
		switch ($type) {
		case "Mn":
			$htmlStr="</table>";
			return $htmlStr;
//			echo "</table>";
			break;
		case "Crt":
			$htmlStr="<tr><td colspan='2' align='center'><input name='sbmt' type='submit' value='".$tips."'/></td></tr></form></table>";
//			echo "<tr><td colspan='2' align='center'><input name='sbmt' type='submit' value='".$tips."'/></td></tr>";
////			echo "</form></table></div>";
//			echo "</form></table>";
			return $htmlStr;
			break;
		default:
		        return "类型未知，请联系管理员";
		        break;
		}
	}
/**
        *功能:分页显示记录
        *参数:1、目标页数;2、总页数;3、每页总页数
        *返回:含有目标页内容、分页导航条的数组
        */
        public function DsplByPg($currentpagenum,$recordnum,$perpagenum){
                if($perpagenum=='') $perpagenum=5;
                if($recordnum==0) 
			$totalpagenum=1;
                else 
			$totalpagenum=ceil($recordnum/$perpagenum);
                if($totalpagenum<$currentpagenum) $pageno=$totalpagenum;
                else $pageno=$currentpagenum;
                $pageinfobar="<div id='typeflag' class='pagebar' ltype='dbstruct' style='margin-top:5px'><b>当前页数/总页数:".$pageno."/".$totalpagenum."</b>&nbsp;&nbsp;";
                if($pageno==1){
                        if($pageno<>$totalpagenum)
                                $pageinfobar.="首页&nbsp;&nbsp;上一页&nbsp;&nbsp;<a href='javascript:void(0);' ltype='dbstruct' pgno='".($pageno+1)."'>下一页</a>&nbsp;&nbsp;<a href='javascript:void(0);' pgno='".$totalpagenum."'>尾页</a>&nbsp;&nbsp;";
                }else{
                        if($pageno<>$totalpagenum) $pageinfobar.="<a href='javascript:void(0);' pgno='1'>首页</a>&nbsp;&nbsp;<a href='javascript:void(0);' pgno='".($pageno-1)."'>上一页</a>&nbsp;&nbsp;<a href='javascript:void(0);' pgno='".($pageno+1)."'>下一页</a>&nbsp;&nbsp;<a href='javascript:void(0);' pgno='".$totalpagenum."'>尾页</a>&nbsp;&nbsp;";
                        else $pageinfobar.="<a href='javascript:void(0);' pgno='1'>首页</a>&nbsp;&nbsp;<a href='javascript:void(0);' pgno='".($pageno-1)."'>上一页</a>&nbsp;&nbsp;下一页&nbsp;&nbsp;尾页&nbsp;&nbsp;";
                }
                $pageinfobar.="跳转至<input id='pageinput' type='text' style='width:25px;'/>页";
		$pageinfobar.="<button id='pagebutton' type='button'><span style='width:50px;font-size:9px'>点击跳转</span></button></div>";
                return $pageinfobar;
        }
}
?>
