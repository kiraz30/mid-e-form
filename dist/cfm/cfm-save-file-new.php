<?php
if (is_array(@$_FILES['inputFile'])){
	for($i=0;$i<count(@$_FILES['inputFile']);$i++){
		$name 			= @$_FILES['inputFile']['name'][$i];
		$tmp  			= @$_FILES['inputFile']['tmp_name'][$i];
		$index			= $i+1;
		$temp			= @$_POST['tempfileid'][$i];
		$InputKemasan	= @$_POST['InputKemasan'][$i];
		$InputPosisi	= @$_POST['InputPosisi'][$i];
		$exe=mysqli_query($con,"SELECT ID_No,Request_No,File,Kemasan,Posisi FROM tb_cfm_file where ID_No = '".$temp."' ");
		$tampildatafile=mysqli_fetch_array($exe);
		if (mysqli_num_rows($exe) !=0 ) {
			if(trim($name)!=''){
				if (!empty($tampildatafile['File'])){
					unlink($Attachment_Image.@$tampildatafile['File']);
				}
				$new_name = date('YmdHis').$name; //rename file
				if(move_uploaded_file($tmp,$Attachment_Image.$new_name)){ //proses upload
					updatefile("tb_cfm_file","File",$new_name,"ID_No",$temp);
				}
			}
		}
		else {
			if(trim($name)!=''){
				$new_name = date('YmdHis').$name; //rename file
				if(move_uploaded_file($tmp,$Attachment_Image.$new_name)){ //proses upload
					mysqli_query($con,"Insert INTO tb_cfm_file (Request_No,File,Kemasan,Posisi,
					Index_No,CreatedBy,CreatedDate,CreatedHostName) 
					values ('$inputAutoRequestNo','".$new_name."','$InputKemasan','$InputPosisi',
					'".$index."','$username','$createddate','$ip : $hostname')");
					echo 'Berhasil mengupload file '.$new_name.' ke Folder Uplaod Gambar<br/>'; //pesan berhasil
				}
			}
		}
	}
}	
	
?>