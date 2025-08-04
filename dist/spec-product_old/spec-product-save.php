<?php 
if ($level=='ADMINISTRATOR') {
	if(trim($namaFile)!=''){
		$new_name = date('YmdHis'). '.' . end($xFile); //rename file
		if(move_uploaded_file($file_tmpFile,$uploadDirFileSpec_Product.$new_name)){ //proses upload
			$SimpanSpecAdminFile=mysqli_query($con,"Insert INTO tb_spec_product(MPR_Code,ID_NoMPRDetail,FNIM_Code,ID_NoFNIMDetail,
			Launching,Description,Notifikasi_BPOM,Product_Image,
			SizeOfProduct,SizeOfProduct_P,SizeOfProduct_L,SizeOfProduct_T,SizeOfProduct_Satuan,
			InnerPack_P,InnerPack_L,InnerPack_T,InnerPack_Satuan,
			SizeOfCartton_IS_P,SizeOfCartton_IS_L,SizeOfCartton_IS_T,SizeOfCartton_IS_Satuan,
			SizeOfCartton_OS_P,SizeOfCartton_OS_L,SizeOfCartton_OS_T,SizeOfCartton_OS_Satuan,
			DznCtn,DznCtn_Keterangan,WeighOfContenCtn,CreatedBy,CreatedDate,CreatedHostName) 
			values('$tempMPR','$tempMPRDetail','$tempMPRFNIM','$tempFNIMDetail',
			'".$SelectTahun."-".$Selectbulan."-01"."','$inputProductShortDescription','$inputNotificationBPOM','$new_name',
			'$selectSizeofProduct','$inputSizeofProduct_P','$inputSizeofProduct_L','$inputSizeofProduct_T','$inputSizeOfProduct_Satuan',
			'$inputInnerPack_P','$inputInnerPack_L','$inputInnerPack_T','$inputInnerPack_Satuan',
			'$inputSizeOfCartton_IS_P','$inputSizeOfCartton_IS_L','$inputSizeOfCartton_IS_T','$inputSizeOfCartton_IS_Satuan',
			'$inputSizeOfCartton_OS_P','$inputSizeOfCartton_OS_L','$inputSizeOfCartton_OS_T','$inputSizeOfCartton_OS_Satuan',
			'$inpuDsn_Ctn','$inpuDsnCtn_Keterangan','$inputWeightofContent','$username','$createddate','$ip : $hostname')");
			if ($SimpanSpecAdminFile){
				$message = "Data successfully Save to Spec Product";
				echo "<script type='text/javascript'>alert('$message');</script>";
			}else {
				$message = "Error Save to Spec Product";
				echo "<script type='text/javascript'>alert('$message');</script>";
			}
		}
	}else {
		$SimpanSpecAdminFile=mysqli_query($con,"Insert INTO tb_spec_product(MPR_Code,ID_NoMPRDetail,FNIM_Code,ID_NoFNIMDetail,
		Launching,Description,Notifikasi_BPOM,
		SizeOfProduct,SizeOfProduct_P,SizeOfProduct_L,SizeOfProduct_T,SizeOfProduct_Satuan,
		InnerPack_P,InnerPack_L,InnerPack_T,InnerPack_Satuan,
		SizeOfCartton_IS_P,SizeOfCartton_IS_L,SizeOfCartton_IS_T,SizeOfCartton_IS_Satuan,
		SizeOfCartton_OS_P,SizeOfCartton_OS_L,SizeOfCartton_OS_T,SizeOfCartton_OS_Satuan,
		DznCtn,DznCtn_Keterangan,WeighOfContenCtn,CreatedBy,CreatedDate,CreatedHostName) 
		values('$tempMPR','$tempMPRDetail','$tempMPRFNIM','$tempFNIMDetail',
		'".$SelectTahun."-".$Selectbulan."-01"."','$inputProductShortDescription','$inputNotificationBPOM',
		'$selectSizeofProduct','$inputSizeofProduct_P','$inputSizeofProduct_L','$inputSizeofProduct_T','$SizeOfProduct_Satuan',
		'$inputInnerPack_P','$inputInnerPack_L','$inputInnerPack_T','$inputInnerPack_Satuan',
		'$inputSizeOfCartton_IS_P','$inputSizeOfCartton_IS_L','$inputSizeOfCartton_IS_T','$inputSizeOfCartton_IS_Satuan',
		'$inputSizeOfCartton_OS_P','$inputSizeOfCartton_OS_L','$inputSizeOfCartton_OS_T','$inputSizeOfCartton_OS_Satuan',
		'$inpuDsn_Ctn','$inpuDsnCtn_Keterangan','$inputWeightofContent','$username','$createddate','$ip : $hostname')");
		if ($SimpanSpecAdminFile){
			$message = "Data successfully Save to Spec Product";
			echo "<script type='text/javascript'>alert('$message');</script>";
		}else {
			$message = "Error Save to Spec Product";
			echo "<script type='text/javascript'>alert('$message');</script>";
		}
	}
}else if ($level=='USER') {	
	if ($divisioncode=='21MS3')  { //Marketing Support 
		$SimpanSpecProdev=mysqli_query($con,"Insert INTO tb_spec_product(MPR_Code,ID_NoMPRDetail,FNIM_Code,
		ID_NoFNIMDetail,Launching,Description,CreatedBy,CreatedDate,CreatedHostName) 
		values('$tempMPR','$tempMPRDetail','$tempMPRFNIM','$tempFNIMDetail',
		'".$SelectTahun."-".$Selectbulan."-01"."','$inputProductShortDescription',
		'$username','$createddate','$ip : $hostname')");
		if ($SimpanSpecProdev){
			$message = "Data successfully Save to Spec Product";
			echo "<script type='text/javascript'>alert('$message');</script>";
		}else {
			$message = "Error Save to Spec Product";
			echo "<script type='text/javascript'>alert('$message');</script>";
		}
	}else if ($divisioncode=='PCD1100' || $divisioncode=='PCD2100') { //Packaging
		$SimpanPackaging=mysqli_query($con,"Insert INTO tb_spec_product(MPR_Code,ID_NoMPRDetail,FNIM_Code,
		ID_NoFNIMDetail,SizeOfProduct,SizeOfProduct_P,SizeOfProduct_L,SizeOfProduct_T,SizeOfProduct_Satuan,
		InnerPack_P,InnerPack_L,InnerPack_T,InnerPack_Satuan,
		SizeOfCartton_IS_P,SizeOfCartton_IS_L,SizeOfCartton_IS_T,SizeOfCartton_IS_Satuan,
		SizeOfCartton_OS_P,SizeOfCartton_OS_L,SizeOfCartton_OS_T,SizeOfCartton_OS_Satuan,
		DznCtn,DznCtn_Keterangan,CreatedBy,CreatedDate,CreatedHostName) 
		values('$tempMPR','$tempMPRDetail','$tempMPRFNIM','$tempFNIMDetail','$selectSizeofProduct','$inputSizeofProduct_P','$inputSizeofProduct_L','$inputSizeofProduct_T','$inputSizeOfProduct_Satuan',
		'$inputInnerPack_P','$inputInnerPack_L','$inputInnerPack_T','$inputInnerPack_Satuan',
		'$inputSizeOfCartton_IS_P','$inputSizeOfCartton_IS_L','$inputSizeOfCartton_IS_T','$inputSizeOfCartton_IS_Satuan',
		'$inputSizeOfCartton_OS_P','$inputSizeOfCartton_OS_L','$inputSizeOfCartton_OS_T','$inputSizeOfCartton_OS_Satuan',
		'$inpuDsn_Ctn','$inpuDsnCtn_Keterangan','$username','$createddate','$ip : $hostname')");
		if ($SimpanPackaging){
			$message = "Data successfully Save to Spec Product";
			echo "<script type='text/javascript'>alert('$message');</script>";
		}else {
			$message = "Error Save to Spec Product";
			echo "<script type='text/javascript'>alert('$message');</script>";
		}
	}else if ($divisioncode=='21FMR2') { //Registrasi
		$SimpanSpecAdminFile=mysqli_query($con,"Insert INTO tb_spec_product(MPR_Code,ID_NoMPRDetail,FNIM_Code,
		ID_NoFNIMDetail,Notifikasi_BPOM,CreatedBy,CreatedDate,CreatedHostName) 
		values('$tempMPR','$tempMPRDetail','$tempMPRFNIM','$tempFNIMDetail',
		'$inputNotificationBPOM','$username','$createddate','$ip : $hostname')");
		if ($SimpanSpecAdminFile){
			$message = "Data successfully Save to Spec Product";
			echo "<script type='text/javascript'>alert('$message');</script>";
		}else {
			$message = "Error Save to Spec Product";
			echo "<script type='text/javascript'>alert('$message');</script>";
		}
	}else if ($divisioncode=='21LCM3' || $divisioncode=='21FC3' || $divisioncode=='21MC4') { //Promotion Male, Female, Lady's
		if(trim($namaFile)!=''){
			$new_name = date('YmdHis'). '.' . end($xFile); //rename file
			if(move_uploaded_file($file_tmpFile,$uploadDirFileSpec_Product.$new_name)){ //proses upload
				$SimpanSpecAdminFile=mysqli_query($con,"Insert INTO tb_spec_product(MPR_Code,ID_NoMPRDetail,FNIM_Code,
				ID_NoFNIMDetail,Product_Image,CreatedBy,CreatedDate,CreatedHostName) 
				values('$tempMPR','$tempMPRDetail','$tempMPRFNIM','$tempFNIMDetail',
				'$new_name','$username','$createddate','$ip : $hostname')");
				if ($SimpanSpecAdminFile){
					$message = "Data successfully Save to Spec Product";
					echo "<script type='text/javascript'>alert('$message');</script>";
				}else {
					$message = "Error Save to Spec Product";
					echo "<script type='text/javascript'>alert('$message');</script>";
				}
			}
		}else {
			$SimpanSpecAdminFile=mysqli_query($con,"Insert INTO tb_spec_product(MPR_Code,ID_NoMPRDetail,FNIM_Code,
			ID_NoFNIMDetail,CreatedBy,CreatedDate,CreatedHostName) 
			values('$tempMPR','$tempMPRDetail','$tempMPRFNIM','$tempFNIMDetail',
			'$username','$createddate','$ip : $hostname')");
			if ($SimpanSpecAdminFile){
				$message = "Data successfully Save to Spec Product";
				echo "<script type='text/javascript'>alert('$message');</script>";
			}else {
				$message = "Error Save to Spec Product";
				echo "<script type='text/javascript'>alert('$message');</script>";
			}
		}
	}else if ($divisioncode=='QC1100')  { //QC 
		$SimpanQC=mysqli_query($con,"Insert INTO tb_spec_product(MPR_Code,ID_NoMPRDetail,FNIM_Code,
		ID_NoFNIMDetail,WeighOfContenCtn,CreatedBy,CreatedDate,CreatedHostName) 
		values('$tempMPR','$tempMPRDetail','$tempMPRFNIM','$tempFNIMDetail','$inputWeightofContent',
		'$username','$createddate','$ip : $hostname')");
		if ($SimpanQC){
			$message = "Data successfully Save to Spec Product";
			echo "<script type='text/javascript'>alert('$message');</script>";
		}else {
			$message = "Error Save to Spec Product";
			echo "<script type='text/javascript'>alert('$message');</script>";
		}
	}
}
	
?>
