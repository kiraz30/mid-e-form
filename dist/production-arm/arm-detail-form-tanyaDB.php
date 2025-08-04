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
$selectCurency			= @$_POST['selectCurency'];
$inputStdUP				= @$_POST['inputStdUP'];
$inputRemark			= @$_POST['inputRemark']; 
if ($tempID_No=="") {
	$Tanya =mysqli_query($con,"select * from tb_prod_add_resource_detail
	WHERE	FinishGoodCode='$inputFinishGoodCode'") ;
	if (mysqli_num_rows($Tanya) !=0 ) {  }
	
}
 
	

?>
