<?php 
	mysqli_query($con,"UPDATE tb_nprf SET Thema_Number='$inputThemaNumber',RemarkafterComplete='$inputRemarkafterComplete',
	Status_NPRF='Complete By MCJ',Status_Last_Document='1',
	UpdatedBy='$username',UpdatedDate='$createddate',UpdatedHostName='$ip : $hostname' WHERE Request_No='$tempFormatNoRequest'");
	//Simpan Inbox
	mysqli_query($con,"UPDATE tb_inbox Set Request_Status='C',ReadInbox='1',UpdatedBy='$username',
	NameApproval='',UpdatedDate='$createddate',UpdatedHostName='$ip : $hostname'  WHERE Request_No='$tempFormatNoRequest'");
	$uploadDirFileMcj	 			= "../img/Mcj/";
	$uploadDirFileMaster_Schedule	= "../img/Master_Schedule/";
	
	if (!empty($namaFileMcj)) { //1.
		if (!empty($tampildata['Mcj'])){
			unlink($uploadDirFileMcj.@$tampildata['Mcj']);
		}
		move_uploaded_file($file_tmpFileMcj, $uploadDirFileMcj.$yymmddhMs.$namaFileMcj);
		updatefile("tb_nprf","Mcj",$yymmddhMs.$namaFileMcj,"Request_No",$tempFormatNoRequest);
	}
	if (!empty($namaFileMaster_Schedule)) { //8.
		if (!empty($tampildata['Master_Schedule'])){
			unlink($uploadDirFileMaster_Schedule.@$tampildata['Master_Schedule']);
		}
		move_uploaded_file($file_tmpFileMaster_Schedule, $uploadDirFileMaster_Schedule.$yymmddhMs.$namaFileMaster_Schedule);
		updatefile("tb_nprf","Master_Schedule",$yymmddhMs.$namaFileMaster_Schedule,"Request_No",$tempFormatNoRequest);
	}
?>
