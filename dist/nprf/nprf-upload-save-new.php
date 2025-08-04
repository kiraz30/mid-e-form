<?php 
mysqli_query($con,"Insert INTO tb_nprf (ID_No,Index_Document,Request_No,Thema_Number,Thema_Name,Type_Request,
Remark,Status_NPRF,NPRF_Type,CreatedBy,CreatedDate,CreatedHostName) values ('$noUrut','0','$NomorReq','$inputThemaNumber',
'$inputThemaName','$SelectTypeRequest',
'$inputRemark','Draft','1','$username','$createddate','$ip : $hostname')");
 

if (!empty($namaFileMcj)) { //7.
	move_uploaded_file($file_tmpFileMcj, $uploadDirFileMcj.$yymmddhMs.$namaFileMcj);
	updatefile("tb_nprf","Mcj",$yymmddhMs.$namaFileMcj,"Request_No",$NomorReq);
}

			
?>
