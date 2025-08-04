<?php
//delete.php
$file				= "../file/";
$Attachment_Image	= "../img/Attachment_Image/";

include "connect.php";
if(isset($_POST["DelMPR"])){
	$exe=mysqli_query($con,"SELECT ID_No,ID_NoFNIMDetail FROM tb_mpr_detail 
	WHERE ID_No = '".$_POST["DelMPR"]."' ");
	while(@$rowMPR=mysqli_fetch_array($exe)){	
		mysqli_query($con,"UPDATE tb_fnim_detail SET ApplyMPR='0' WHERE ID_No='".$rowMPR['ID_NoFNIMDetail']."' ");
		mysqli_query($con,"DELETE FROM tb_mpr_detail WHERE ID_No = '".$_POST["DelMPR"]."'");
		$message = "1";
		echo "<script type='text/javascript'>alert('$message');</script>";
	}
}
if(isset($_POST["DelFNIM"])){
	foreach($_POST["DelFNIM"] as $id) {
		$exe=mysqli_query($con,"SELECT ID_No FROM tb_fnim_detail 
		where ID_No = '".$id."' ");
		while(@$rowFile=mysqli_fetch_array($exe)){	
			mysqli_query($con,"Delete From tb_fnim_detail_package_on_store 		WHERE ID_No_FnimDetail = '".$id."'");
			mysqli_query($con,"Delete From tb_fnim_detail_fragrance_code 		WHERE ID_No_FnimDetail = '".$id."'");
			mysqli_query($con,"Delete From tb_fnim_detail_formula_sample_code 	WHERE ID_No_FnimDetail = '".$id."'");
			mysqli_query($con,"Delete From tb_fnim_detail_formula 				WHERE ID_No_FnimDetail = '".$id."'");
			mysqli_query($con,"Delete From tb_fnim_detail_netto 				WHERE ID_No_FnimDetail = '".$id."'");
			mysqli_query($con,"Delete From tb_fnim_detail 						ID_No = '".$id."'");
		}
	}
}
elseif(isset($_POST["DelFile"])){
	foreach($_POST["DelFile"] as $id) {
		$exe=mysqli_query($con,"SELECT ID_No,Request_No,File FROM tb_fnim_file 
		where ID_No = '".$id."' ");
		while(@$rowFile=mysqli_fetch_array($exe)){	
			unlink($file.@$rowFile['File']);
			mysqli_query($con,"Delete From tb_fnim_file WHERE ID_No = '".$rowFile['ID_No']."' ");
		}
	}
}
elseif(isset($_POST["DelFileCFM"])){
	foreach($_POST["DelFileCFM"] as $id) {
		$exe=mysqli_query($con,"SELECT ID_No,Request_No,File FROM tb_cfm_file where ID_No = '".$id."' ");
		while(@$rowFile=mysqli_fetch_array($exe)){	
			unlink($Attachment_Image.@$rowFile['File']);
			mysqli_query($con,"Delete From tb_cfm_file WHERE ID_No = '".$rowFile['ID_No']."' ");
		}
	}
}
elseif(isset($_POST["AppPO"])){
	foreach($_POST["AppPO"] as $id) {
		$exe = mysqli_query($con,"SELECT * FROM tb_supplier Where Status=1");
		while(@$row=mysqli_fetch_array($exe)){
			odbc_exec($myConnPO,"UPDATE POHeader SET TransactionStatus='Approved',
			UpdatedAt='$createddate',UpdatedBy='$username' WHERE No='".$id."' And SupplierCode <> '".$row['KDSupplier']."'");
		}
	}
}
elseif(isset($_POST["DelArm"])){
	foreach($_POST["DelArm"] as $id) {
		$exe=mysqli_query($con,"SELECT No_ID,Request_No,FileLampiran FROM tb_packdev_add_resource_doc_lampiran 
		where No_ID = '".$id."' ");
		while(@$rowFile=mysqli_fetch_array($exe)){	
			unlink($file.@$rowFile['FileLampiran']);
			mysqli_query($con,"Delete From tb_packdev_add_resource_doc_lampiran WHERE No_ID = '".$rowFile['No_ID']."' ");
		}
	}
}
?>