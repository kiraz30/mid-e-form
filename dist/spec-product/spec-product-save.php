<?php 
if ($button=="add-spec-product")
{
	mysqli_query($con,"Insert INTO tb_spec_product(ID_No,Index_Document,
	Request_No,Brand,Bisnis,PIC_Prodev,Category,Code_Product,BARCODE,Product_Name,Isi_Net,
	Netto,MPR_Code,ID_NoMPRDetail,FNIM_Code,ID_NoFNIMDetail,
	Launching,Status_Spec,Remark,CreatedBy,CreatedDate,CreatedHostName) 
	values('$noUrut','0','$inputAutoRequestNo','$inputBrand','$inputBisnis','$inputPICProdev','$inputCategory',
	'$inputProductCode','$inputBarcode','$inputProductName','$inputIsiNetto','$inpuNet',
	'$InputMPRCode','$tempMPRDetail','$tempMPRFNIM','$tempFNIMDetail',
	'$SelectTahun-01-01','Draft','$inputRemark','$username','$createddate','$ip : $hostname')");
	
}else{
	updatefile("tb_spec_product","Status_Last_Document","0","Request_No",$tampildata['Request_No']);
	mysqli_query($con,"Insert INTO tb_spec_product (ID_No,Index_Document,Request_No,Last_Request_No,Status_Last_Document,
	Brand,Bisnis,PIC_Prodev,Category,Code_Product,BARCODE,Product_Name,Isi_Net,Netto,
	MPR_Code,ID_NoMPRDetail,FNIM_Code,ID_NoFNIMDetail,
	Launching,Status_Spec,Remark,CreatedBy,CreatedDate,CreatedHostName) 
	values ('".$tampildata['ID_No']."','$rev','$inputAutoRequestNo','$inputLastRequestNo','1',
	'$inputBrand','$inputBisnis','$inputPICProdev','$inputCategory',
	'$inputProductCode','$inputBarcode','$inputProductName','$inputIsiNetto','$inpuNet',
	'$InputMPRCode','$tempMPRDetail','$tempMPRFNIM','$tempFNIMDetail',
	'$SelectTahun-01-01','Draft','$inputRemark','$username','$createddate','$ip : $hostname')");
}
?>
