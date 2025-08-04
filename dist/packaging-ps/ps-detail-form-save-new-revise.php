<?php 
 //Simpan USER Privilage
$cari =mysqli_query($con,"Select Request_No,ID_No_Resource_Detail,Packaging_Material,Packaging_Material_Name,
	Finish_Good_Code,Batch_Size_Lower,Batch_Size_Upper,Weight,
	Satuan_Weight,Ukuran,Bahan,Cetak,Vendor_Code,Vendor_Name,
	Status,Index_No,UpdatedBy,UpdatedDate,UpdatedHostName
	FROM tb_packdev_spec_detail Where Request_No ='$inputLastRequestNo'");
	while($caridata =mysqli_fetch_array(@$cari)){
		mysqli_query($con,"Insert INTO tb_packdev_spec_detail
		(Request_No,Finish_Good_Code,ID_No_Resource_Detail,
		Packaging_Material,Packaging_Material_Name,Batch_Size_Lower,Batch_Size_Upper,Weight,
		Satuan_Weight,Ukuran,Bahan,Cetak,Vendor_Code,Vendor_Name,
		Status,Index_No,UpdatedBy,UpdatedDate,UpdatedHostName)
		values ('$inputAutoRequestNo','$caridata[Finish_Good_Code]','$caridata[ID_No_Resource_Detail]',
		'$caridata[Packaging_Material]','$caridata[Packaging_Material_Name]',
		'$caridata[Batch_Size_Lower]','$caridata[Batch_Size_Upper]','$caridata[Weight]',
		'$caridata[Satuan_Weight]','$caridata[Ukuran]','$caridata[Bahan]','$caridata[Cetak]',
		'$caridata[Vendor_Code]','$caridata[Vendor_Name]','$caridata[Status]','$caridata[Index_No]','$username','$createddate','$ip : $hostname')");
}

?>
