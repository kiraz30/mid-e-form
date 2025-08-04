<?php
			
if (is_array(@$_FILES['inputFile'])){
	for($i=0;$i<count(@$_FILES['inputFile']);$i++){
		$name 			= @$_FILES['inputFile']['name'][$i];
		$tmp  			= @$_FILES['inputFile']['tmp_name'][$i];
		$index			= $i+1;
		$tempItemDetail	= @$_POST['tempItemDetail'][$i];
		$tempCFMDetail	= @$_POST['tempCFMDetail'][$i];
		$InputKemasan	= @$_POST['InputKemasan'][$i];
		$InputPosisi	= @$_POST['InputPosisi'][$i];
		$exe=mysqli_query($con,"SELECT ID_No,ID_No_CFM_File,Request_No,File,Kemasan,Posisi 
		FROM tb_faw_file where ID_No = '".$tempItemDetail."' ");
        $tampilfawfile=mysqli_fetch_array($exe);
		if (mysqli_num_rows($exe) ==0 ) {
			if(trim($name)!=''){
 				$new_name = date('YmdHis').$name; //rename file
				if(move_uploaded_file($tmp,$Attachment_Image.$new_name)){ //proses upload
					mysqli_query($con,"Insert INTO tb_faw_file (Request_No,ID_No_CFM_File,File,Kemasan,Posisi,
					Index_No,CreatedBy,CreatedDate,CreatedHostName) 
					values ('$inputAutoRequestNo','$tempCFMDetail','".$new_name."','$InputKemasan','$InputPosisi',
					'".$index."','$username','$createddate','$ip : $hostname')");
					echo 'Berhasil mengupload file '.$new_name.' ke Folder upload<br/>'; //pesan berhasil
				}
			}
		}
		else {
			if (!empty($name)) {
				if (!empty($tampilfawfile['File'])){
					unlink($Attachment_Image.@$tampilfawfile['File']);
				}
				$new_name = date('YmdHis').$name; //rename file
				move_uploaded_file($tmp, $Attachment_Image.$new_name);
				updatefile("tb_faw_file","File",$new_name,"ID_No",$tempItemDetail);
			}
		}
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