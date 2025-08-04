 
<?php 
	$uploadDirFileSpec_Product		= "../img/Spec_Product/";
	$yymmddhMs						=date("YmdHis");


	if (@$button=="sp-app" && @$tampildataWFMPR['Approve_No']==1 && @$tampildataWFMPR['Step_Revise']==1) { //SESSION Marketing Support
		$EditSpecProdev=mysqli_query($con,"UPDATE  tb_spec_product set
		Code_Product='$inputProductCode',BARCODE='$inputBarcode',
		Product_Name='$inputProductName',Isi_Net='$inputIsiNetto',Netto='$inpuNet',
		Brand='$inputBrand',Bisnis='$inputBisnis',Category='$inputCategory',
		MPR_Code='$InputMPRCode',ID_NoMPRDetail='$tempMPRDetail',
		FNIM_Code='$tempMPRFNIM',ID_NoFNIMDetail='$tempFNIMDetail',
		Launching='$SelectTahun-01-01',Remark='$inputRemark',
		UpdatedBy='$username',UpdatedDate='$createddate',UpdatedHostName='$ip : $hostname'
		WHERE Request_No='$tempFormatNoRequest'");
		if ($EditSpecProdev){
			$message = "Data successfully Update to Spec Product";
			echo "<script type='text/javascript'>alert('$message');</script>";
		}else {
			$message = "Error Update to Spec Product";
			echo "<script type='text/javascript'>alert('$message');</script>";
		}
	}else if (@$button=="sp-app" && @$tampildataWFMPR['Approve_No']==1 && @$tampildataWFMPR['Step_Revise']==2) { //SESSION DEV FORMULA
		$EditSpecProdev=mysqli_query($con,"UPDATE  tb_spec_product set
		ProjectStatus1='$valProjectStatus1',ProjectStatus2='$valProjectStatus2',
		ProjectStatus3='$valProjectStatus3',ProjectStatus4='$valProjectStatus4',
		ProjectStatus='$inputProjectStatus',
		`Description`='$inputProductShortDescription',
		UpdatedBy='$username',UpdatedDate='$createddate',UpdatedHostName='$ip : $hostname'
		WHERE Request_No='$tempFormatNoRequest'");
		if ($EditSpecProdev){
			$message = "Data successfully Update to Spec Product";
			echo "<script type='text/javascript'>alert('$message');</script>";
		}else {
			$message = "Error Update to Spec Product";
			echo "<script type='text/javascript'>alert('$message');</script>";
		}
	}else if (@$button=="sp-app" && @$tampildataWFMPR['Approve_No']==1 && @$tampildataWFMPR['Step_Revise']==3) {  //Packaging 3
		$EditPackaging=mysqli_query($con,"UPDATE  tb_spec_product set 
		SizeOfProduct='$selectSizeofProduct',SizeOfProduct_P='$inputSizeofProduct_P',
		SizeOfProduct_L='$inputSizeofProduct_L',SizeOfProduct_T='$inputSizeofProduct_T',
		SizeOfProduct_Satuan='$inputSizeOfProduct_Satuan',
		InnerPack_P='$inputInnerPack_P',InnerPack_L='$inputInnerPack_L',InnerPack_T='$inputInnerPack_T',
		InnerPack_Satuan='$inputInnerPack_Satuan',
		SizeOfCartton_OS_P='$inputSizeOfCartton_OS_P',SizeOfCartton_OS_L='$inputSizeOfCartton_OS_L',
		SizeOfCartton_OS_T='$inputSizeOfCartton_OS_T',SizeOfCartton_OS_Satuan='$inputSizeOfCartton_OS_Satuan',
		SizeOfCartton_IS_P='$inputSizeOfCartton_IS_P',SizeOfCartton_IS_L='$inputSizeOfCartton_IS_L',
		SizeOfCartton_IS_T='$inputSizeOfCartton_IS_T',SizeOfCartton_IS_Satuan='$inputSizeOfCartton_IS_Satuan',				
		DznCtn='$inpuDsn_Ctn',DznCtn_Keterangan='$inpuDsnCtn_Keterangan', 
		UpdatedBy='$username',UpdatedDate='$createddate',UpdatedHostName='$ip : $hostname'
		WHERE Request_No='$tempFormatNoRequest'");
		if ($EditPackaging){
			$message = "Data successfully Update to Spec Product";
			echo "<script type='text/javascript'>alert('$message');</script>";
		}else {
			$message = "Error Update to Spec Product";
			echo "<script type='text/javascript'>alert('$message');</script>";
		}
	}else if (@$button=="sp-app" && @$tampildataWFMPR['Approve_No']==1 && @$tampildataWFMPR['Step_Revise']==4) {  //Registrasi 4
		$EditRegistrasi=mysqli_query($con,"UPDATE  tb_spec_product set  
		Notifikasi_BPOM='$inputNotificationBPOM',
		Halal_Number='$inputHalalNumber',
		UpdatedBy='$username',UpdatedDate='$createddate',UpdatedHostName='$ip : $hostname'
		WHERE Request_No='$tempFormatNoRequest'");
		if ($EditRegistrasi){
			$message = "Data successfully Update to Spec Product";
			echo "<script type='text/javascript'>alert('$message');</script>";
		}else {
			$message = "Error Update to Spec Product";
			echo "<script type='text/javascript'>alert('$message');</script>";
		}
	}else if (@$button=="sp-app" && @$tampildataWFMPR['Approve_No']==1 && @$tampildataWFMPR['Step_Revise']==5) {  //QC 5
		$SimpanQC=mysqli_query($con,"UPDATE  tb_spec_product set 
		WeighOfContenCtn='$inputWeightofContent',WeighOfContenCtn_Satuan='$inputWeightofContent_Satuan',
		UpdatedBy='$username',UpdatedDate='$createddate',UpdatedHostName='$ip : $hostname'
		WHERE Request_No='$tempFormatNoRequest'");
		if ($SimpanQC){
			$message = "Data successfully Update to Spec Product";
			echo "<script type='text/javascript'>alert('$message');</script>";
		}else {
			$message = "Error Update to Spec Product";
			echo "<script type='text/javascript'>alert('$message');</script>";
		}
	}else if (@$button=="sp-app" && @$tampildataWFMPR['Approve_No']==1 && @$tampildataWFMPR['Step_Revise']==6) {  //Advertising
		if (!empty($namaFile)) { //5.
			if (!empty($tampildata['Product_Image'])){
				unlink($uploadDirFileSpec_Product.@$tampildata['Product_Image']);
			}
			move_uploaded_file($file_tmpFile, $uploadDirFileSpec_Product.$yymmddhMs);
			updatefile("tb_spec_product","Product_Image",$yymmddhMs,"Request_No",$tempFormatNoRequest);
		} 
 	}

	 
	
?>
