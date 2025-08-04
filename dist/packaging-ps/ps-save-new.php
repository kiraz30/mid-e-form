<?php 
if ($button=="ps-add")
{
	mysqli_query($con,"Insert INTO tb_packdev_spec(ID_No,Index_Document,Request_No,ARM_Code,
	MPR_Code,Finish_Good_Code,Finish_Good_Name,Keterangan_Produk,Warna_Jenis,Netto,Isi,DZ_CT,Market,Barcode,Status_Spec,
	CreatedBy,CreatedDate,CreatedHostName) 
	values ('$noUrut','0','$NomorReq','$InputARMCode','$InputMPRCode','$inputFinishGoodCode',
	'$inputFinishGoodName','$inputKeteranganProduk','$inputWarnaJenis','$inputNetto','$inputIsi','$inputDZCT','$inputMarket',
	'$inputBarcode','Draft','$username','$createddate','$ip : $hostname')");
	//Simpan Detail
	$cari =mysqli_query($con,"SELECT ID_No,Request_No,FinishGoodCode,Resource_Code,Packaging_Material_Name,SAP_Code,Vendor_Code,Vendor_Name FROM v_arm_f1_f2_detail Where FinishGoodCode='$inputFinishGoodCode'
	And Request_No='$InputARMCode' ");
	while($caridata =mysqli_fetch_array(@$cari)){
		$Tanya = mysqli_query($con,"SELECT ID_No FROM tb_packdev_spec_detail WHERE Request_No = '$inputAutoRequestNo' 
		And ID_No_Resource_Detail ='$caridata[ID_No]'");
		if (mysqli_num_rows($Tanya) ==0 ) {  
			mysqli_query($con,"Insert INTO tb_packdev_spec_detail (Request_No,Finish_Good_Code,ID_No_Resource_Detail,Packaging_Material,Packaging_Material_Name,SAP_Code,Vendor_Code,Vendor_Name) 
			values ('$inputAutoRequestNo','$inputFinishGoodCode','$caridata[ID_No]','$caridata[Resource_Code]','$caridata[Packaging_Material_Name]','$caridata[SAP_Code]','$caridata[Vendor_Code]','$caridata[Vendor_Name]')");
		}	
	}

}

else
{
	updatefile("tb_packdev_spec","Status_Last_Document","0","Request_No",$tampildata['Request_No']);
	mysqli_query($con,"Insert INTO tb_packdev_spec (ID_No,Index_Document,Request_No,Last_Request_No,Status_Last_Document,
	ARM_Code,MPR_Code,Finish_Good_Code,Finish_Good_Name,Keterangan_Produk,Warna_Jenis,Netto,Isi,DZ_CT,Market,Barcode,Status_Spec,
	CreatedBy,CreatedDate,CreatedHostName) 
	values ('".$tampildata['ID_No']."','$rev','$NomorReq','$inputLastRequestNo','1',
	'$InputARMCode','$InputMPRCode','$inputFinishGoodCode','$inputFinishGoodName',
	'$inputKeteranganProduk','$inputWarnaJenis','$inputNetto','$inputIsi','$inputDZCT','$inputMarket',
	'$inputBarcode','Draft','$username','$createddate','$ip : $hostname')");
	/*Simpan Detail
	$cari =mysqli_query($con,"SELECT ID_No,Resource_Code,Packaging_Material_Name,Vendor_Code,Vendor_Name FROM tb_packdev_add_resource_detail Where FinishGoodCode='$inputFinishGoodCode'
	And Request_No='$InputARMCode' ");
	while($caridata =mysqli_fetch_array(@$cari)){
		$Tanya = mysqli_query($con,"SELECT ID_No FROM tb_packdev_spec_detail WHERE Request_No = '$inputAutoRequestNo' 
		And ID_No_Resource_Detail ='$caridata[ID_No]'");
		if (mysqli_num_rows($Tanya) ==0 ) {  
			mysqli_query($con,"Insert INTO tb_packdev_spec_detail (Request_No,Finish_Good_Code,ID_No_Resource_Detail,Packaging_Material,Packaging_Material_Name,Vendor_Code,Vendor_Name) 
			values ('$inputAutoRequestNo','$inputFinishGoodCode','$caridata[ID_No]','$caridata[Resource_Code]','$caridata[Packaging_Material_Name]','$caridata[Vendor_Code]','$caridata[Vendor_Name]')");
		}	
	}*/

}

	

?>
