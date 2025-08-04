<?php 
	mysqli_query($con,"UPDATE tb_packdev_spec SET 
	ARM_Code='$InputARMCode',ARM_Code='$InputARMCode',Finish_Good_Code='$inputFinishGoodCode',
	Finish_Good_Name='$inputFinishGoodName',Keterangan_Produk='$inputKeteranganProduk',Warna_Jenis='$inputWarnaJenis',
	Netto='$inputNetto',Isi='$inputIsi',DZ_CT='$inputDZCT',
	Market='$inputMarket',Barcode='$inputBarcode',UpdatedBy='$username',UpdatedDate='$createddate',
	UpdatedHostName='$ip : $hostname' WHERE Request_No='$tempFormatNoRequest'");
	//Simpan Detail
	/*mysqli_query($con,"DELETE FROM tb_packdev_spec_detail WHERE Finish_Good_Code !='$inputFinishGoodCode'
	And Request_No = '$inputAutoRequestNo'");*/
	
 
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


?>
  