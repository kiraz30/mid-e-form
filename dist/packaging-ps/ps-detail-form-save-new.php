 <?php
session_start();
$username				=$_SESSION["usernameeform"];
include "../../config/conn.php";
include "../../config/connect.php";

$ip						=$_SERVER['REMOTE_ADDR'];
$hostname 				= gethostbyaddr($_SERVER['REMOTE_ADDR']);
date_default_timezone_set("Asia/Jakarta");
$createddate			=date("Y-m-d H:i:s");
$tempID_No				= @$_POST['tempID_No'];
$tempID_NoARM			= @$_POST['tempID_NoARM'];
$tempAutoRequestNo		= @$_POST['tempAutoRequestNo'];
$inputPM  				= @$_POST['inputPM'];
$inputPMName			= @$_POST['inputPMName'];
$inputSAPCode			= @$_POST['inputSAPCode'];
$Finish_Good_Code 		= @$_POST['Finish_Good_Code'];
$inputBatchSizeLower	= @$_POST['inputBatchSizeLower'];
$inputBatchSizeUpper	= @$_POST['inputBatchSizeUpper'];
$inputWeigh				= @$_POST['inputWeigh'];
$selecSatuanWeight		= @$_POST['selecSatuanWeight'];
$inputUkuran  			= @$_POST['inputUkuran'];
$inputBahan				= @$_POST['inputBahan'];
$inputCetak				= @$_POST['inputCetak'];
$inputVendorCode		= @$_POST['inputVendorCode'];
$inputVendorName		= @$_POST['inputVendorName'];
$selectStatus			= @$_POST['selectStatus'];
if ($tempID_No=="") {
	$i=0;
	$SaveData=mysqli_query($con,"INSERT INTO tb_packdev_spec_detail
	(Request_No,Packaging_Material,Packaging_Material_Name,SAP_Code,Batch_Size_Lower,
	Batch_Size_Upper,Satuan_Weight,`Weight`,Ukuran,Bahan,
	Cetak,Vendor_Code,Vendor_Name,`Status`,
	UpdatedBy,UpdatedDate,UpdatedHostName)
	values ('$tempAutoRequestNo','$inputPM','$inputPMName','$inputSAPCode','$inputBatchSizeLower',
	'$inputBatchSizeUpper','$selecSatuanWeight','$inputWeigh','$inputUkuran','$inputBahan',
	'$inputCetak','$inputVendorCode','$inputVendorName','$selectStatus',
	'$username','$createddate','$ip : $hostname')");
	if ($saveData){
		$message = "Data successfully Save to Draft";
		echo "<script type='text/javascript'>alert('$message');</script>";
	}else{
		$message = "Error Save Data successfully to Draft";
		echo "<script type='text/javascript'>alert('$message');</script>";
	}
}else{
	mysqli_query($con,"UPDATE tb_packdev_spec_detail
	SET Packaging_Material='$inputPM',
	Packaging_Material_Name='$inputPMName',
	SAP_Code='$inputSAPCode',
	Batch_Size_Lower='$inputBatchSizeLower',
	Batch_Size_Upper='$inputBatchSizeUpper',
	`Weight`='$inputWeigh',
	Satuan_Weight='$selecSatuanWeight',
	Ukuran='$inputUkuran',
	Bahan='$inputBahan',
	Cetak='$inputCetak',
	Vendor_Code='$inputVendorCode',
	Vendor_Name='$inputVendorName',
	`Status`='$selectStatus',
	UpdatedBy='$username',
	UpdatedDate='$createddate',
	UpdatedHostName='$ip : $hostname' WHERE ID_No='$tempID_No'") ;
 $message = "Data successfully Update to Draft";
 echo "<script type='text/javascript'>alert('$message');</script>";
}
 
	

?>
