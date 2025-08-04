<?php 
	mysqli_query($con,"UPDATE tb_packdev_add_resource SET 
	MPR_Code='$InputMPRCode',Project_Name='$inputProjectName',Subject='$InputSubject',
	Type_Finish_Goods='$valType1',Type_Materials='$valType2',Type_WorkProcess='$valType3',
	Type_Fu_Fee='$valType4',Type_Vendor='$valType5',Type_Customer='$valType6',
	Segment_Price='$valSegment1',Segment_Data_Informasi='$valSegment2',
	Segment_Ukuran='$valSegment3',Segment_Others='$valSegment4',Segment_Over_Receipt='$valSegment5',
	Content='$InputContent',Remark='$inputRemark',UpdatedBy='$username',UpdatedDate='$createddate',
	UpdatedHostName='$ip : $hostname' WHERE Request_No='$tempFormatNoRequest'");

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
			FROM tb_packdev_add_resource_doc_lampiran where No_ID = '".$temp."' ");
			if (mysqli_num_rows($exe) ==0 ) {  
				if(trim($name)!=''){
					$new_name = date('YmdHis').$name; //rename file.$name
					if(move_uploaded_file($tmp,$file.$new_name)){ //proses upload
						mysqli_query($con,"Insert INTO tb_packdev_add_resource_doc_lampiran (Request_No,DocLampiran,FileLampiran,Index_No,CreatedBy,CreatedDate,CreatedHostName) 
						values ('$inputAutoRequestNo','$InputName','$new_name',
						'".$index."','$username','$createddate','$ip : $hostname')");
						echo 'Berhasil mengupload file '.$new_name.' ke Folder upload<br/>'; //pesan berhasil
					}
				}
			}else {
					mysqli_query($con,"UPDATE  tb_packdev_add_resource_doc_lampiran SET DocLampiran='$InputName' 
					where No_ID = '$temp' ");
			}
		}
	}
 