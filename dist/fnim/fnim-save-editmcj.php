<?php 
	mysqli_query($con,"UPDATE tb_fnim SET Status_fnim='Complete By MCJ',RemarkafterComplete='$inputRemarkafterComplete',
	Status_Last_Document='1',
	UpdatedBy='$username',UpdatedDate='$createddate',UpdatedHostName='$ip : $hostname' WHERE Request_No='$tempFormatNoRequest'");
	//Simpan Inbox
	mysqli_query($con,"UPDATE tb_inbox Set Request_Status='C',ReadInbox='1',UpdatedBy='$username',
	NameApproval='',UpdatedDate='$createddate',UpdatedHostName='$ip : $hostname'  WHERE Request_No='$tempFormatNoRequest'");

	if (!empty($namaFileMcj)) {
		if (!empty($tampildata['Mcj'])){
			unlink($uploadDirFileMcj.@$tampildata['Mcj']);
		}
		move_uploaded_file($file_tmpFileMcj, $uploadDirFileMcj.$yymmddhMs.$namaFileMcj);
		updatefile("tb_fnim","Mcj",$yymmddhMs.$namaFileMcj,"Request_No",$tempFormatNoRequest);
	}
?>