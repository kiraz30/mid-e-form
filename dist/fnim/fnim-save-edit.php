<?php 
	mysqli_query($con,"UPDATE tb_fnim SET 
	MCJ_Proudct='$MCJProd',Project_Name='$inputProjectName',NPRF_Code='$InputNprfCode',
	Type_Request='$SelectTypeRequest',
	Type_Request_Detail='$txtExport',Launching_Date='".$SelectTahun."-".$Selectbulan."-01"."',
	For_Notif='$inputNotification',Note='$inputNote',
	Remark='$inputRemark',Thema_Number='$inputThemaNumber',Status_fnim='".$tampildata['Status_FNIM']."',
	RemarkafterComplete='$inputRemarkafterComplete',
	UpdatedBy='$username',UpdatedDate='$createddate',UpdatedHostName='$ip : $hostname' WHERE Request_No='$tempFormatNoRequest'");
	

	if (!empty($namaFileMcj)) {
		if (!empty($tampildata['Mcj'])){
			unlink($uploadDirFileMcj.@$tampildata['Mcj']);
		}
		move_uploaded_file($file_tmpFileMcj, $uploadDirFileMcj.$yymmddhMs.$namaFileMcj);
		updatefile("tb_fnim","Mcj",$yymmddhMs.$namaFileMcj,"Request_No",$tempFormatNoRequest);
	}
?>