<?php 
include "../../config/conn.php";
include "../../config/connect.php";
$tempID_No				= @$_POST['tempID_No'];
$tempAutoRequestNo		= @$_POST['tempAutoRequestNo'];
$inputFinishGoodCode  	= @$_POST['inputFinishGoodCode'];
$inputFinishGoodName	= @$_POST['inputFinishGoodName'];
$inputMaterialName	  	= @$_POST['inputMaterialName'];
$inputVendorCode	  	= @$_POST['inputVendorCode'];
$inputVendorName		= @$_POST['inputVendorName'];
$inputPOLeadTime		= @$_POST['inputPOLeadTime'];
$inputMCJ			  	= @$_POST['inputMCJ'];
$inputSafetyStokRatio	= @$_POST['inputSafetyStokRatio'];
$selectOrderUM  		= @$_POST['selectOrderUM'];
$inputCutofDay			= @$_POST['inputCutofDay'];
$inputMinimumOrderQty	= @$_POST['inputMinimumOrderQty'];
$inputBuyerPlanner		= @$_POST['inputBuyerPlanner'];
$inputMultipleOrderQty	= @$_POST['inputMultipleOrderQty'];
$inputResourceCode		= @$_POST['inputResourceCode'];
$inputSAPCode			= @$_POST['inputSAPCode'];
$inputPMName			= @$_POST['inputPMName'];
$selectCurency			= @$_POST['selectCurency'];
$inputStdUP				= @$_POST['inputStdUP'];
$inputCountryOrigin		= @$_POST['inputCountryOrigin'];
$inputVNRecommendation	= @$_POST['inputVNRecommendation'];
$inputRemark			= @$_POST['inputRemark']; 
if ($tempID_No=="") {
	mysqli_query($con,"Insert INTO tb_packdev_add_resource_detail
	(Request_No,FinishGoodCode,FinishGoodName,Material_Name,
	MCJ_Code,Order_UM,Minimum_Order_Qty,Miltiple_Order_Qty,
	Currency,Std_UP,CountryOrigin,Vendor_Name_Recommendation,
	Vendor_Code,Vendor_Name,
	PO_Lead_Time,Safety_Stock_Ratio,Cate_of_Day,Buyer_Planner,
	Resource_Code,SAP_Code,Packaging_Material_Name,Remark) 
	values ('$tempAutoRequestNo','$inputFinishGoodCode','$inputFinishGoodName','$inputMaterialName',
	'$inputMCJ','$selectOrderUM','$inputMinimumOrderQty','$inputMultipleOrderQty',
	'$selectCurency','$inputStdUP','$inputCountryOrigin','$inputVNRecommendation','$inputVendorCode','$inputVendorName',
	'$inputPOLeadTime','$inputSafetyStokRatio','$inputCutofDay','$inputBuyerPlanner',
	'$inputResourceCode','$inputSAPCode','$inputPMName','$inputRemark')");
}
else{
	mysqli_query($con,"UPDATE tb_packdev_add_resource_detail
	SET FinishGoodCode='$inputFinishGoodCode',
	FinishGoodName='$inputFinishGoodName',
	Material_Name='$inputMaterialName',
	MCJ_Code='$inputMCJ',
	Order_UM='$selectOrderUM',
	Minimum_Order_Qty='$inputMinimumOrderQty',
	Miltiple_Order_Qty='$inputMultipleOrderQty',
	Currency='$selectCurency',
	Std_UP='$inputStdUP',
	CountryOrigin='$inputCountryOrigin',
	Vendor_Name_Recommendation='$inputVNRecommendation',
	Vendor_Code='$inputVendorCode',
	Vendor_Name='$inputVendorName',
	PO_Lead_Time='$inputPOLeadTime',
	Safety_Stock_Ratio='$inputSafetyStokRatio',
	Cate_of_Day='$inputCutofDay',
	Buyer_Planner='$inputBuyerPlanner',
	Resource_Code='$inputResourceCode',
	SAP_Code='$inputSAPCode',
	Packaging_Material_Name='$inputPMName',	
	Remark='$inputRemark'
	WHERE	ID_No='$tempID_No'") ;
 
}
 
	

?>
