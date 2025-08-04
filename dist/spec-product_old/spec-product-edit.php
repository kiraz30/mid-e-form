 
<?php 
if ($level=='ADMINISTRATOR') {	
	if(trim($namaFile)!=''){
		$new_name = date('YmdHis'). '.' . end($xFile); //rename file
		if (!empty($tampildata['Product_Image'])){
			unlink($uploadDirFileSpec_Product.@$tampildata['Product_Image']);
		}
		if(move_uploaded_file($file_tmpFile,$uploadDirFileSpec_Product.$new_name)){ //proses upload
			$EditSpecAdminFile=mysqli_query($con,"UPDATE  tb_spec_product set 
			Launching='".$SelectTahun."-".$Selectbulan."-01"."',
			Description='$inputProductShortDescription',Notifikasi_BPOM='$inputNotificationBPOM',
			Product_Image='$new_name',
			SizeOfProduct='$selectSizeofProduct',SizeOfProduct_P='$inputSizeofProduct_P',
			SizeOfProduct_L='$inputSizeofProduct_L',SizeOfProduct_T='$inputSizeofProduct_T',
			SizeOfProduct_Satuan='$inputSizeOfProduct_Satuan',
			InnerPack_P='$inputInnerPack_P',InnerPack_L='$inputInnerPack_L',InnerPack_T='$inputInnerPack_T',
			InnerPack_Satuan='$inputInnerPack_Satuan',
			SizeOfCartton_OS_P='$inputSizeOfCartton_OS_P',SizeOfCartton_OS_L='$inputSizeOfCartton_OS_L',
			SizeOfCartton_OS_T='$inputSizeOfCartton_OS_T',SizeOfCartton_OS_Satuan='$inputSizeOfCartton_OS_Satuan',
			SizeOfCartton_IS_P='$inputSizeOfCartton_IS_P',SizeOfCartton_IS_L='$inputSizeOfCartton_IS_L',
			SizeOfCartton_IS_T='$inputSizeOfCartton_IS_T',SizeOfCartton_IS_Satuan='$inputSizeOfCartton_IS_Satuan',		
			DznCtn='$inpuDsn_Ctn',DznCtn_Keterangan='$inpuDsnCtn_Keterangan',WeighOfContenCtn='$inputWeightofContent',
			UpdatedBy='$username',UpdatedDate='$createddate',UpdatedHostName='$ip : $hostname'
			Where MPR_Code='$tempMPR' And ID_NoMPRDetail='$tempMPRDetail' And FNIM_Code='$tempMPRFNIM' And
			ID_NoFNIMDetail='$tempFNIMDetail'");
			if ($EditSpecAdminFile){
				$message = "Data successfully Update to Spec Product";
				echo "<script type='text/javascript'>alert('$message');</script>";
			}else {
				$message = "Error 1 Update to Spec Product";
				echo "<script type='text/javascript'>alert('$message');</script>";
			}
		}
	}else {
		$EditSpecAdminFile=mysqli_query($con,"UPDATE tb_spec_product set 
		Launching='".$SelectTahun."-".$Selectbulan."-01"."',
		Description='$inputProductShortDescription',Notifikasi_BPOM='$inputNotificationBPOM',
		SizeOfProduct='$selectSizeofProduct',SizeOfProduct_P='$inputSizeofProduct_P',
		SizeOfProduct_L='$inputSizeofProduct_L',SizeOfProduct_T='$inputSizeofProduct_T',
		SizeOfProduct_Satuan='$inputSizeOfProduct_Satuan',
		InnerPack_P='$inputInnerPack_P',InnerPack_L='$inputInnerPack_L',InnerPack_T='$inputInnerPack_T',
		InnerPack_Satuan='$inputInnerPack_Satuan',
		SizeOfCartton_OS_P='$inputSizeOfCartton_OS_P',SizeOfCartton_OS_L='$inputSizeOfCartton_OS_L',
		SizeOfCartton_OS_T='$inputSizeOfCartton_OS_T',SizeOfCartton_OS_Satuan='$inputSizeOfCartton_OS_Satuan',
		SizeOfCartton_IS_P='$inputSizeOfCartton_IS_P',SizeOfCartton_IS_L='$inputSizeOfCartton_IS_L',
		SizeOfCartton_IS_T='$inputSizeOfCartton_IS_T',SizeOfCartton_IS_Satuan='$inputSizeOfCartton_IS_Satuan',			
		DznCtn='$inpuDsn_Ctn',DznCtn_Keterangan='$inpuDsnCtn_Keterangan',WeighOfContenCtn='$inputWeightofContent',
		UpdatedBy='$username',UpdatedDate='$createddate',UpdatedHostName='$ip : $hostname'
		Where MPR_Code='$tempMPR' And ID_NoMPRDetail='$tempMPRDetail' And FNIM_Code='$tempMPRFNIM' And
		ID_NoFNIMDetail='$tempFNIMDetail' ");
		if ($EditSpecAdminFile){
			$message = "Data successfully Update wqwqwto Spec Product";
			echo "<script type='text/javascript'>alert('$message');</script>";
		}else {
			$message = "Error 2 Update to Spec Product";
			echo "<script type='text/javascript'>alert('$message');</script>";
		}
	}
}else if ($level=='USER') {	
	if ($divisioncode=='21MS3')  { //Marketing Support 
		$EditSpecProdev=mysqli_query($con,"UPDATE  tb_spec_product set
		Launching='".$SelectTahun."-".$Selectbulan."-01"."',
		Description='$inputProductShortDescription',
		UpdatedBy='$username',UpdatedDate='$createddate',UpdatedHostName='$ip : $hostname'
		Where MPR_Code='$tempMPR' And ID_NoMPRDetail='$tempMPRDetail' And FNIM_Code='$tempMPRFNIM' And
		ID_NoFNIMDetail='$tempFNIMDetail'");
		if ($EditSpecProdev){
			$message = "Data successfully Update to Spec Product";
			echo "<script type='text/javascript'>alert('$message');</script>";
		}else {
			$message = "Error Update to Spec Product";
			echo "<script type='text/javascript'>alert('$message');</script>";
		}
	}else if ($divisioncode=='PCD1100' || $divisioncode=='PCD2100') { //Packaging
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
		Where MPR_Code='$tempMPR' And ID_NoMPRDetail='$tempMPRDetail' And FNIM_Code='$tempMPRFNIM' And
		ID_NoFNIMDetail='$tempFNIMDetail'");
		if ($EditPackaging){
			$message = "Data successfully Update to Spec Product";
			//echo "<script type='text/javascript'>alert('$message');</script>";
		}else {
			$message = "Error Update to Spec Product";
			echo "<script type='text/javascript'>alert('$message');</script>";
		}
	}else if ($divisioncode=='21FMR2') { //Registrasi
		$EditRegistrasi=mysqli_query($con,"UPDATE  tb_spec_product set  
		Notifikasi_BPOM='$inputNotificationBPOM',
		UpdatedBy='$username',UpdatedDate='$createddate',UpdatedHostName='$ip : $hostname'
		Where MPR_Code='$tempMPR' And ID_NoMPRDetail='$tempMPRDetail' And FNIM_Code='$tempMPRFNIM' And
		ID_NoFNIMDetail='$tempFNIMDetail'");
		if ($EditRegistrasi){
			$message = "Data successfully Update to Spec Product";
			echo "<script type='text/javascript'>alert('$message');</script>";
		}else {
			$message = "Error Update to Spec Product";
			echo "<script type='text/javascript'>alert('$message');</script>";
		}
	}else if ($divisioncode=='21LCM3' || $divisioncode=='21FC3' || $divisioncode=='21MC4') { //Promotion Male, Female, Lady's
		if(trim($namaFile)!=''){
			$new_name = date('YmdHis'). '.' . end($xFile); //rename file
			if (!empty($tampildata['Product_Image'])){
				unlink($uploadDirFileSpec_Product.@$tampildata['Product_Image']);
			}			
			if(move_uploaded_file($file_tmpFile,$uploadDirFileSpec_Product.$new_name)){ //proses upload
				$SimpanSpecAdminFile=mysqli_query($con,"UPDATE  tb_spec_product set 
				Product_Image='$new_name',UpdatedBy='$username',UpdatedDate='$createddate',UpdatedHostName='$ip : $hostname'
				Where MPR_Code='$tempMPR' And ID_NoMPRDetail='$tempMPRDetail' And FNIM_Code='$tempMPRFNIM' And
				ID_NoFNIMDetail='$tempFNIMDetail'");
				if ($SimpanSpecAdminFile){
					$message = "Data successfully Update to Spec Product";
					echo "<script type='text/javascript'>alert('$message');</script>";
				}else {
					$message = "Error Update to Spec Product";
					echo "<script type='text/javascript'>alert('$message');</script>";
				}
			}
		}
	}else if ($divisioncode=='QC1100')  { //QC 
		$SimpanQC=mysqli_query($con,"UPDATE  tb_spec_product set 
		WeighOfContenCtn='$inputWeightofContent',UpdatedBy='$username',UpdatedDate='$createddate',UpdatedHostName='$ip : $hostname'
		Where MPR_Code='$tempMPR' And ID_NoMPRDetail='$tempMPRDetail' And FNIM_Code='$tempMPRFNIM' And
		ID_NoFNIMDetail='$tempFNIMDetail'");
		if ($SimpanQC){
			$message = "Data successfully Update to Spec Product";
			echo "<script type='text/javascript'>alert('$message');</script>";
		}else {
			$message = "Error Update to Spec Product";
			echo "<script type='text/javascript'>alert('$message');</script>";
		}
	}
}
	
?>
