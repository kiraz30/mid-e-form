<?php 
include "../../config/conn.php";
include "../../config/connect.php";
$tempID_No					= @$_POST['tempID_No'];
$tempAutoRequestNo			= @$_POST['tempAutoRequestNo'];
$inputFinishGoodCode  		= @$_POST['inputFinishGoodCode'];
$inputFinishGoodName		= @$_POST['inputFinishGoodName'];
$inputMaterialCode			= @$_POST['inputMaterialCode'];
$inputMaterialName	  		= @$_POST['inputMaterialName'];
$inputMaterialNameRequest	= @$_POST['inputMaterialNameRequest'];
$inputRemark				= @$_POST['inputRemark']; 
if ($tempID_No=="") {
	mysqli_query($con,"Insert INTO tb_packdev_add_resource_f2_detail
	(Request_No,FinishGoodCode,FinishGoodName,Material_Code,Material_Name,
	Material_Name_Request,Remark) 
	values ('$tempAutoRequestNo','$inputFinishGoodCode','$inputFinishGoodName',
	'$inputMaterialCode','$inputMaterialName','$inputMaterialNameRequest','$inputRemark')");
}else{
	mysqli_query($con,"UPDATE tb_packdev_add_resource_f2_detail
	SET FinishGoodCode='$inputFinishGoodCode',
	FinishGoodName='$inputFinishGoodName',
	Material_Code='$inputMaterialCode',	
	Material_Name='$inputMaterialName',
	Material_Name_Request='$inputMaterialNameRequest',
	Remark='$inputRemark'	WHERE	ID_No='$tempID_No'") ;
}	
?>
