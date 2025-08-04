<?php 
updatefile("tb_nprf","Status_Last_Document","0","Request_No",$tampildata['Request_No']);
mysqli_query($con,"Insert INTO tb_nprf (
ID_No,Index_Document,Request_No,Last_Request_No,Status_Last_Document,Thema_Name,Type_Request,
Remark,Status_NPRF,NPRF_Type,CreatedBy,CreatedDate,CreatedHostName) 
values ('".$tampildata['ID_No']."','$rev','$inputAutoRequestNo','$inputLastRequestNo','1','$inputThemaName',
'$SelectTypeRequest','$inputRemark','Draft','1','$username','$createddate','$ip : $hostname')");


if(trim($namaFileMcj)!=''){
	move_uploaded_file($file_tmpFileMcj, $uploadDirFileMcj.$yymmddhMs.$namaFileMcj);
	updatefile("tb_nprf","Mcj",$yymmddhMs.$namaFileMcj,"Request_No",$inputAutoRequestNo);
}else {
	$new_name = date("YmdHis").substr($tempfilelama,14,100);
	copy($uploadDirFileMcj.$tempfilelama,$uploadDirFileMcj.$new_name);
	updatefile("tb_nprf","Mcj",$new_name,"Request_No",$inputAutoRequestNo);
}

/*if(trim($namaFileMcj)!=''){
	if(move_uploaded_file($file_tmpFileMcj, $uploadDirFileMcj.$yymmddhMs.$namaFileMcj)){ //proses upload
        updatefile("tb_nprf","Mcj",$yymmddhMs.$namaFileMcj,"Request_No",$inputAutoRequestNo);
	}else {
        $new_name 	= date("YmdHis").substr($$ImagelamaFileMcj,14,100);
		copy($uploadDirFileMcj.$ImagelamaFileMcj,$uploadDirFileMcj.$ImagelamaFileMcj);
        updatefile("tb_nprf","Mcj",$new_name,"Request_No",$inputAutoRequestNo);
	}
}*/

 

?>
