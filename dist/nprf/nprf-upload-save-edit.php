<?php 
	mysqli_query($con,"UPDATE tb_nprf SET Thema_Number='$inputThemaNumber',
	Thema_Name='$inputThemaName',Type_Request='$SelectTypeRequest',
	Remark='$inputRemark',UpdatedBy='$username',UpdatedDate='$createddate',
	UpdatedHostName='$ip : $hostname' WHERE Request_No='$tempFormatNoRequest'");

	if (!empty($namaFileMcj)) { //5.
		if (!empty($tampildata['Mcj'])){
			unlink($uploadDirFileCompetitor.@$tampildata['Mcj']);
		}
		move_uploaded_file($file_tmpFileMcj, $uploadDirFileMcj.$yymmddhMs.$namaFileMcj);
		updatefile("tb_nprf","Mcj",$yymmddhMs.$namaFileMcj,"Request_No",$tempFormatNoRequest);
	}

 
?>
