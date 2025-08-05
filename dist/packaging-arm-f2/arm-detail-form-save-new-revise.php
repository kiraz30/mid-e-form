<?php 
 //Simpan USER Privilage
$cari =mysqli_query($con,"Select Request_No,FinishGoodCode,FinishGoodName,Material_Name,Remark FROM tb_packdev_add_resource_f2_detail Where Request_No ='$inputLastRequestNo'");
	while($caridata =mysqli_fetch_array(@$cari)){
 	mysqli_query($con,"Insert INTO tb_packdev_add_resource_f2_detail
	(Request_No,FinishGoodCode,FinishGoodName,Material_Name,Remark) 
	values ('$inputAutoRequestNo','$caridata[FinishGoodCode]','$caridata[FinishGoodName]',
	'$caridata[Material_Name]',
	'$caridata[Remark]')");
}
?>


