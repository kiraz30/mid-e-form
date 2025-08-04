 
<?php 
	mysqli_query($con,"UPDATE tb_spec_product set  
	Brand='$inputBrand',
	Bisnis='$inputBisnis',
	PIC_Prodev='$inputPICProdev',
	Category='$inputCategory',
	Code_Product='$inputProductCode',
	BARCODE='$inputBarcode',
	Product_Name='$inputProductName',Isi_Net='$inputIsiNetto',Netto='$inpuNet',
	UpdatedBy='$username',UpdatedDate='$createddate',UpdatedHostName='$ip : $hostname' 
	WHERE Request_No='$inputAutoRequestNo'");

?>
