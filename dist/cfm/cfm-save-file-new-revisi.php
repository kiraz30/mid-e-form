<?php
$Attachment_Image			= "../img/Attachment_Image/";
					

if (is_array(@$_POST['tempfileid'])){
	for($i=0;$i<count(@$_POST['tempfileid']);$i++){
		$name 						= @$_FILES['inputFile']['name'][$i];
		$tmp  						= @$_FILES['inputFile']['tmp_name'][$i];
		$temp						= @$_POST['tempfileid'][$i];
		$tempfilelama				= @$_POST['tempfilelama'][$i];
		$index						= $i+1;
		$InputKemasan				= @$_POST['InputKemasan'][$i];
		$InputPosisi				= @$_POST['InputPosisi'][$i];	
		$new_name 					= date("YmdHis").substr($tempfilelama,14,100);
		if(trim($name)!=''){
			$new_name = date('YmdHis').$name; //rename file
			if(move_uploaded_file($tmp,$Attachment_Image.$new_name)){ //proses upload
				mysqli_query($con,"Insert INTO tb_cfm_file (Request_No,File,Kemasan,Posisi,
				Index_No,CreatedBy,CreatedDate,CreatedHostName) 
				values ('$inputAutoRequestNo','".$new_name."','$InputKemasan','$InputPosisi',
				'".$index."','$username','$createddate','$ip : $hostname')");
				echo 'Berhasil mengupload file '.$new_name.' ke Folder upload<br/>'; //pesan berhasil
			}
		}else {
			copy($Attachment_Image.$tempfilelama,$Attachment_Image.$new_name);
			mysqli_query($con,"Insert INTO tb_cfm_file (Request_No,File,Kemasan,Posisi,
			Index_No,CreatedBy,CreatedDate,CreatedHostName) 
			values ('$inputAutoRequestNo','".$new_name."','$InputKemasan','$InputPosisi',
			'".$index."','$username','$createddate','$ip : $hostname')");
			echo 'Berhasil mengupload file '.$InputKemasan.' ke Folder upload<br/>'; //pesan berhasil
		}
	}
}
 

 
?>