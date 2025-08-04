<?php 
	session_start();
	$username				=$_SESSION["usernameeform"];
	$name					=$_SESSION["nameusereform"];
	$level					=$_SESSION['leveleform'];
	$hostname				=$_SESSION['hostnameeform'];
	$divisioncode			=$_SESSION['divisioncodeeform'];
	$division				=$_SESSION['divisioneform'];
	include "../../config/conn.php";
	include "../../config/connect.php";

	$ip					=$_SERVER['REMOTE_ADDR'];
	$hostname 			= gethostbyaddr($_SERVER['REMOTE_ADDR']);
	date_default_timezone_set("Asia/Jakarta");
	$createddate			=date("Y-m-d H:i:s");
	if (@$_GET['type'] =="work-process"){
		$tempID_No					= @$_POST['tempID_No'];
		$tempAutoRequestNo			= @$_POST['tempAutoRequestNo'];
		$inputFinishGoodCode  		= @$_POST['inputFinishGoodCode'];
		$inputFinishGoodName		= @$_POST['inputFinishGoodName'];
		$inputResourceCode			= @$_POST['inputResourceCode'];
		$inputPMName	  			= @$_POST['inputPMName'];
		$inputMaterialNameRequest	= @$_POST['inputMaterialNameRequest'];
		$inputRemark				= @$_POST['inputRemark']; 
		if ($tempID_No=="") {
			mysqli_query($con,"Insert INTO tb_prod_add_resource_detail_w_p
			(Request_No,FinishGoodCode,FinishGoodName,Material_Code,Material_Name,
			Material_Name_Request,Remark) 
			values ('$tempAutoRequestNo','$inputFinishGoodCode','$inputFinishGoodName',
			'$inputResourceCode','$inputPMName','$inputMaterialNameRequest','$inputRemark')");
		}else{
			mysqli_query($con,"UPDATE tb_prod_add_resource_detail_w_p
			SET FinishGoodCode='$inputFinishGoodCode',
			FinishGoodName='$inputFinishGoodName',
			Material_Code='$inputResourceCode',	
			Material_Name='$inputPMName',
			Material_Name_Request='$inputMaterialNameRequest',
			Remark='$inputRemark'	WHERE ID_No='$tempID_No'") ;
		}	
	} else if (@$_GET['type'] =="cust-vend"){
		$tempID_No				= @$_POST['tempID_No'];
		$tempAutoRequestNo		= @$_POST['tempAutoRequestNo'];
		$inputVendorCustomer  	= @$_POST['inputVendorCustomer'];
		$inputNamaVendorCustomer= @$_POST['inputNamaVendorCustomer'];
		$inputNPWP	  			= @$_POST['inputNPWP'];
		$inputAlamat			= @$_POST['inputAlamat'];
		$inputNoTelp			= @$_POST['inputNoTelp'];
		$inputNoFax				= @$_POST['inputNoFax'];
		$inputPIC				= @$_POST['inputPIC'];
		$inputEmail		  		= @$_POST['inputEmail'];
		$inputTermOfPayment		= @$_POST['inputTermOfPayment'];
		$inputNamaBank			= @$_POST['inputNamaBank'];
		$inputRekBank			= @$_POST['inputRekBank'];
		$inputDivisi			= @$_POST['inputDivisi'];
		$inputDescr				= @$_POST['inputDescr'];
		$inputRemark			= @$_POST['inputRemark'];
		if ($tempID_No=="") {
			mysqli_query($con,"Insert INTO tb_prod_add_resource_detail_c_v
			(Request_No,Code,Name,NPWP,Alamat,No_Telp,No_Fax,PIC,
			Email,Term_Of_Payment,Nama_Bank,Rek_Bank,
			Divisi_Department,DESCR,Remark,
			UpdatedBy,UpdatedDate,UpdatedHostName) 
			values ('$tempAutoRequestNo','$inputVendorCustomer','$inputNamaVendorCustomer','$inputNPWP',
			'$inputAlamat','$inputNoTelp','$inputNoFax','$inputPIC',
			'$inputEmail','$inputTermOfPayment','$inputNamaBank','$inputRekBank','$inputDivisi',
			'$inputDescr','$inputRemark','$username','$createddate','$ip : $hostname' )");
		}
		else{
			mysqli_query($con,"UPDATE tb_prod_add_resource_detail_c_v
			SET Code='$inputVendorCustomer',
			Name='$inputNamaVendorCustomer',
			NPWP='$inputNPWP',
			Alamat='$inputAlamat',
			No_Telp='$inputNoTelp',
			No_Fax='$inputNoFax',
			PIC='$inputPIC',
			Email='$inputEmail'
			WHERE ID_No='$tempID_No'") ;
		
		}
	} else{
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
			mysqli_query($con,"Insert INTO tb_prod_add_resource_detail
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
			mysqli_query($con,"UPDATE tb_prod_add_resource_detail
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
	}
?>
