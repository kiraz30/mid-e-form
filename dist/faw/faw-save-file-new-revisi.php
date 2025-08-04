<?php
$Attachment_Image			= "../img/Attachment_Image/";
					
if (is_array(@$_FILES['inputFile'])){		
	for($i=0;$i<count(@$_FILES['inputFile']);$i++){
		$name 			= @$_FILES['inputFile']['name'][$i];
		$tmp  			= @$_FILES['inputFile']['tmp_name'][$i];
		$tempfilelama	= @$_POST['tempfilelama'][$i];
		$index			= $i+1;
		$tempItemDetail	= @$_POST['tempItemDetail'][$i];
		$tempCFMDetail	= @$_POST['tempCFMDetail'][$i];
		$InputKemasan	= @$_POST['InputKemasan'][$i];
		$InputPosisi	= @$_POST['InputPosisi'][$i];
		if(trim($name)!=''){
			if (!empty($tempfilelama)){
				unlink($Attachment_Image.@$tempfilelama);
			}
			$new_name = date('YmdHis')."_".$index.$name; //rename file
			if(move_uploaded_file($tmp,$Attachment_Image.$new_name)){ //proses upload
				mysqli_query($con,"Insert INTO tb_faw_file (Request_No,ID_No_CFM_File,File,Kemasan,Posisi,
				Index_No,CreatedBy,CreatedDate,CreatedHostName) 
				values ('$inputAutoRequestNo','$tempCFMDetail','".$new_name."','$InputKemasan','$InputPosisi',
				'".$index."','$username','$createddate','$ip : $hostname')");
				echo 'Berhasil mengupload file '.$new_name.' ke Folder upload<br/>'; //pesan berhasil
			}
		}
	}
}

if (is_array(@$_POST['tempItemDetail'])){
	for($i=0;$i<count(@$_POST['tempItemDetail']);$i++){
		$name 			= @$_FILES['inputFile']['name'][$i];
		$tmp  			= @$_FILES['inputFile']['tmp_name'][$i];
		$tempfilelama	= @$_POST['tempfilelama'][$i];
		$index			= $i+1;
		$tempItemDetail	= @$_POST['tempItemDetail'][$i];
		$tempCFMDetail	= @$_POST['tempCFMDetail'][$i];
		$InputKemasan	= @$_POST['InputKemasan'][$i];
		$InputPosisi	= @$_POST['InputPosisi'][$i];	
		$new_name = date("YmdHis").substr($tempfilelama,14,100);
		copy($Attachment_Image.$tempfilelama,$Attachment_Image.$new_name);
		
		
		mysqli_query($con,"Insert INTO tb_faw_file (Request_No,ID_No_CFM_File,File,Kemasan,Posisi,
		Index_No,CreatedBy,CreatedDate,CreatedHostName) 
		values ('$inputAutoRequestNo','$tempCFMDetail','".$new_name."','$InputKemasan','$InputPosisi',
		'".$index."','$username','$createddate','$ip : $hostname')");
		echo 'Berhasil mengupload file '.$new_name.' ke Folder upload<br/>'; //pesan berhasil
					
	}
}

mysqli_query($con,"Delete From tb_faw_check_app WHERE Request_No = '$inputAutoRequestNo' And Workflow_Index_No=1");
if (is_array(@$_POST['tempFAWCheck'])){
	for($j=0;$j<count(@$_POST['tempFAWCheck']);$j++){
		$tempFAWCheck				=@$_POST['tempFAWCheck'][$j];
		$index						= $j+1;
		$InputResult				=@$_POST['InputResult'][$j];
			
		mysqli_query($con,"Insert INTO tb_faw_check_app (Request_No,Checklist_Code,Result,Workflow_Index_No,Index_No) 
		values ('$inputAutoRequestNo','$tempFAWCheck','$InputResult','1','".$index."')");
		echo 'Berhasil list faw '.$InputResult.' LIST<br/>'; //pesan berhasil
	}
}

 
?>