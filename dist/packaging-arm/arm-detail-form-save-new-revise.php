<?php 
 //Simpan USER Privilage
$cari =mysqli_query($con,"Select Request_No,FinishGoodCode,FinishGoodName,Material_Name,
	MCJ_Code,Order_UM,Minimum_Order_Qty,Miltiple_Order_Qty,
	Currency,Std_UP,Vendor_Code,Vendor_Name,
	PO_Lead_Time,Safety_Stock_Ratio,Cate_of_Day,Buyer_Planner,
	Resource_Code,Packaging_Material_Name,SAP_Code,Remark FROM tb_packdev_add_resource_detail Where Request_No ='$inputLastRequestNo'");
	while($caridata =mysqli_fetch_array(@$cari)){
 	mysqli_query($con,"Insert INTO tb_packdev_add_resource_detail
	(Request_No,FinishGoodCode,FinishGoodName,Material_Name,
	MCJ_Code,Order_UM,Minimum_Order_Qty,Miltiple_Order_Qty,
	Currency,Std_UP,Vendor_Code,Vendor_Name,
	PO_Lead_Time,Safety_Stock_Ratio,Cate_of_Day,Buyer_Planner,
	Resource_Code,Packaging_Material_Name,SAP_Code,Remark) 
	values ('$inputAutoRequestNo','$caridata[FinishGoodCode]','$caridata[FinishGoodName]',
	'$caridata[Material_Name]',
	'$caridata[MCJ_Code]','$caridata[Order_UM]','$caridata[Minimum_Order_Qty]','$caridata[Miltiple_Order_Qty]',
	'$caridata[Currency]','$caridata[Std_UP]','$caridata[Vendor_Code]','$caridata[Vendor_Name]',
	'$caridata[PO_Lead_Time]','$caridata[Safety_Stock_Ratio]','$caridata[Cate_of_Day]','$caridata[Buyer_Planner]',
	'$caridata[Resource_Code]','$caridata[Packaging_Material_Name]','$caridata[SAP_Code]','$caridata[Remark]')");
}
?>
