<?php 
if ($button=="prod-arm-add")
{
	//DOCUMENT LAMPIRAN
	if (is_array(@$_POST['InputDocLampiran'])){
		for($i=0;$i<count(@$_FILES['InputFileDocLampiran']);$i++){
			$name 		= @$_FILES['InputFileDocLampiran']['name'][$i];
			$tmp  		= @$_FILES['InputFileDocLampiran']['tmp_name'][$i];
			$fileTypePdf= @$_FILES['InputFileDocLampiran']['type'][$i];
			$index		= $i+1;
			$temp		= @$_POST['tempfileid'][$i];
			$InputName	= @$_POST['InputDocLampiran'][$i];
			$exe=mysqli_query($con,"SELECT No_ID,Request_No,DocLampiran,FileLampiran 
			FROM tb_prod_add_resource_doc_lampiran where No_ID = '".$temp."' ");
				if(trim($name)!=''){
					$new_name = date('YmdHis').$name; //rename file.$name
					if(move_uploaded_file($tmp,$file.$new_name)){ //proses upload
						mysqli_query($con,"Insert INTO tb_prod_add_resource_doc_lampiran (Request_No,DocLampiran,FileLampiran,Index_No,CreatedBy,CreatedDate,CreatedHostName) 
						values ('$inputAutoRequestNo','$InputName','$new_name',
						'".$index."','$username','$createddate','$ip : $hostname')");
						echo 'Berhasil mengupload file '.$new_name.' ke Folder upload<br/>'; //pesan berhasil
					}
				}
		}
	}


	mysqli_query($con,"Insert INTO tb_prod_add_resource(ID_No,Index_Document,Request_No,
	Project_Name,Subject,Type_Finish_Goods,Type_Materials,Type_WorkProcess,Type_Fu_Fee,Type_Vendor,
	Type_Customer,Segment_Price,Segment_Data_Informasi,
	Segment_Ukuran,Segment_Others,Segment_Over_Receipt,Content,Remark,LAST_TRACK,
	CreatedBy,CreatedDate,CreatedHostName) 
	values ('$noUrut','0','$NomorReq','$inputProjectName',
	'$InputSubject','$valType1','$valType2','$valType3','$valType4','$valType5','$valType6',
	'$valSegment1','$valSegment2','$valSegment3','$valSegment4','$valSegment5',
	'$InputContent','$inputRemark','1','$username','$createddate','$ip : $hostname')");
}

else
{
	//DOCUMENT LAMPIRAN
	if (is_array(@$_POST['InputDocLampiran'])){
		for($i=0;$i<count(@$_FILES['InputFileDocLampiran']);$i++){
			$name 		= @$_FILES['InputFileDocLampiran']['name'][$i];
			$tmp  		= @$_FILES['InputFileDocLampiran']['tmp_name'][$i];
			$fileTypePdf= @$_FILES['InputFileDocLampiran']['type'][$i];
			$index		= $i+1;
			$temp		= @$_POST['tempfileid'][$i];
			$InputName	= @$_POST['InputDocLampiran'][$i];
			$exe=mysqli_query($con,"SELECT No_ID,Request_No,DocLampiran,FileLampiran 
			FROM tb_prod_add_resource_doc_lampiran where No_ID = '".$temp."' ");
				if(trim($name)!=''){
					$new_name = date('YmdHis').$name; //rename file.$name
					if(move_uploaded_file($tmp,$file.$new_name)){ //proses upload
						mysqli_query($con,"Insert INTO tb_prod_add_resource_doc_lampiran (Request_No,DocLampiran,FileLampiran,Index_No,CreatedBy,CreatedDate,CreatedHostName) 
						values ('$inputAutoRequestNo','$InputName','$new_name',
						'".$index."','$username','$createddate','$ip : $hostname')");
						echo 'Berhasil mengupload file '.$new_name.' ke Folder upload<br/>'; //pesan berhasil
					}
				/*}else {
					mysqli_query($con,"Insert INTO tb_prod_add_resource_doc_lampiran (Request_No,DocLampiran,Index_No,CreatedBy,CreatedDate,CreatedHostName) 
					values ('$inputAutoRequestNo','$InputName',
					'".$index."','$username','$createddate','$ip : $hostname')");*/
				}
		}
	}	

 
	updatefile("tb_prod_add_resource","Status_Last_Document","0","Request_No",$tampildata['Request_No']);
	mysqli_query($con,"Insert INTO tb_prod_add_resource (ID_No,Index_Document,Request_No,Last_Request_No,Status_Last_Document,
	Project_Name,Subject,Type_Finish_Goods,Type_Materials,Type_WorkProcess,Type_Fu_Fee,Type_Vendor,
	Type_Customer,Segment_Price,Segment_Data_Informasi,
	Segment_Ukuran,Segment_Others,Segment_Over_Receipt,Content,Remark,LAST_TRACK,
	CreatedBy,CreatedDate,CreatedHostName) 
	values ('".$tampildata['ID_No']."','$rev','$inputAutoRequestNo','$inputLastRequestNo','1',
	'$inputProjectName','$InputSubject',
	'$valType1','$valType2','$valType3','$valType4','$valType5','$valType6',
	'$valSegment1','$valSegment2','$valSegment3','$valSegment4','$valSegment5',
	'$InputContent','$inputRemark','1','$username','$createddate','$ip : $hostname')");
}

	

?>
