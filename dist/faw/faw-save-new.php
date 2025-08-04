<?php 
if ($button=="add-faw")
{
	mysqli_query($con,"Insert INTO tb_faw(ID_No,Index_Document,Request_No,CFM_Code,Matarial_Name,Supplier_Name,
	Memberikan_FA,PM_Diterima_MID,Status_FAW,Remark,CreatedBy,CreatedDate,CreatedHostName) 
	values ('$noUrut','0','$NomorReq','$InputCFMCode','$InputMaterialName','$InputSupplierName',
	'$InputFA','$InputPMMID','Draft',
	'$inputRemark','$username','$createddate','$ip : $hostname')");
}

else
{
	updatefile("tb_faw","Status_Last_Document","0","Request_No",$tampildata['Request_No']);
	mysqli_query($con,"Insert INTO tb_faw (ID_No,Index_Document,Request_No,Last_Request_No,Status_Last_Document,
	CFM_Code,Matarial_Name,Supplier_Name,Memberikan_FA,PM_Diterima_MID,Status_FAW,Remark,CreatedBy,CreatedDate,CreatedHostName) 
	values ('".$tampildata['ID_No']."','$rev','$inputAutoRequestNo','$inputLastRequestNo','1',
	'$InputCFMCode','$InputMaterialName','$InputSupplierName','$InputFA','$InputPMMID','Draft',
	'$inputRemark','$username','$createddate','$ip : $hostname')");
}

	

?>
