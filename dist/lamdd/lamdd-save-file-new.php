<?php
if (is_array(@$_FILES['inputFile'])){
	for($i=0;$i<count(@$_FILES['inputFile']);$i++){
		$name 			= @$_FILES['inputFile']['name'][$i];
		$tmp  			= @$_FILES['inputFile']['tmp_name'][$i];
		$index			= $i+1;
		$temp			= @$_POST['tempfileid'][$i];
		$InputKemasan	= @$_POST['InputKemasan'][$i];
		$InputPosisi	= @$_POST['InputPosisi'][$i];
		$inputKeterangan = @$_POST['inputKeterangan'][$i];
		$exe=mysqli_query($con,"SELECT ID_No,Request_No,File,Kemasan,Posisi,Keterangan FROM tb_lamdd_file where ID_No = '".$temp."' ");
		$tampildatafile=mysqli_fetch_array($exe);
		if (mysqli_num_rows($exe) !=0 ) {
			if(trim($name)!=''){
				if (!empty($tampildatafile['File'])){
					unlink($Attachment_Image.@$tampildatafile['File']);
				}
				$new_name = date('YmdHis').$name; //rename file
				if(move_uploaded_file($tmp,$Attachment_Image.$new_name)){ //proses upload
					updatefile("tb_lamdd_file","File",$new_name,"ID_No",$temp);
				}
			}else {
				mysqli_query($con,"UPDATE tb_lamdd_file SET Kemasan='$InputKemasan',
				Posisi='$InputPosisi',Keterangan='$inputKeterangan',
				CreatedBy='$username',CreatedDate='$createddate',CreatedHostName ='$ip : $hostname'
				WHERE ID_No='$temp' ");
				echo 'Berhasil Update Data'; //pesan berhasil
			}
		}
		else {
			if(trim($name)!=''){
				$new_name = date('YmdHis').$name; //rename file
				if(move_uploaded_file($tmp,$Attachment_Image.$new_name)){ //proses upload
					mysqli_query($con,"Insert INTO tb_lamdd_file (Request_No,File,Kemasan,Posisi,
					Keterangan,Index_No,CreatedBy,CreatedDate,CreatedHostName) 
					values ('$inputAutoRequestNo','".$new_name."','$InputKemasan','$InputPosisi',
					'$inputKeterangan','".$index."','$username','$createddate','$ip : $hostname')");
					echo 'Berhasil mengupload file '.$new_name.' ke Folder Uplaod Gambar<br/>'; //pesan berhasil
				}
			}
		}
	}
}	
	
?>