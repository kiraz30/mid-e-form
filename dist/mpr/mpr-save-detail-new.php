<?php

//MPR DETAIL
if (is_array(@$_POST['tempID_No'])){
	for($i=0;$i<count(@$_POST['tempID_No']);$i++){
		if($_POST['tempID_No'][$i]<>"")	{
			$tempID_No					=$_POST['tempID_No'][$i];
			$Isi						=@$_POST['Isi'][$i];
			$Price						=@$_POST['Price'][$i];
			$UOM1						=@$_POST['UOM1'][$i];
			$DZ_CT						=@$_POST['DZ_CT'][$i];
			$CT_CT						=@$_POST['CT_CT'][$i];
			$UOM						=@$_POST['UOM'][$i];
			$Barcode_Existing			=@$_POST['Barcode_Existing'][$i];
			$Code_Product				=@$_POST['Code_Product'][$i];
			$BARCODE					=@$_POST['BARCODE'][$i];
			$exe=mysqli_query($con,"Select * From tb_mpr_detail WHERE Request_No = '$inputAutoRequestNo'
			And ID_No='$tempID_No' ");
			if (mysqli_num_rows($exe) !=0 ) {
				if (@$button=="edit-mpr" && @$tampildataReq['Index_No']==1) {
					mysqli_query($con,"Update tb_mpr_detail Set Price='$Price',Isi='$Isi',UOM1='$UOM1',
					DZ_CT='$DZ_CT',CT_CT='$CT_CT',UOM='$UOM',Barcode_Existing='$Barcode_Existing',
					Code_Product='$Code_Product',BARCODE='$BARCODE'	Where ID_No ='".$tempID_No."' ");
					$message = "0";
					/*echo "<script type='text/javascript'>alert('$message');</script>";*/
				}elseif (@$button=="mpr-app" && @$tampildataWFMPR['Approve_No']==1 && @$tampildataWFMPR['Step_Revise']==3) { 
					mysqli_query($con,"Update tb_mpr_detail Set Code_Product='$Code_Product',BARCODE='$BARCODE'	Where ID_No ='".$tempID_No."' ");
					$message = "1";
					/*echo "<script type='text/javascript'>alert('$message');</script>";*/

				}
			}else {
				mysqli_query($con,"UPDATE tb_fnim_detail SET ApplyMPR='0' WHERE Request_No='".$inputAutoRequestNo."' ");
				mysqli_query($con,"UPDATE tb_fnim_detail SET ApplyMPR='1' WHERE ID_No='".$tempID_No."' ");
				mysqli_query($con,"Insert INTO tb_mpr_detail (Request_No,ID_NoFNIMDetail,Price,Isi,UOM1,
				DZ_CT,CT_CT,UOM,Barcode_Existing,Code_Product,BARCODE,Index_No,CreatedBy,CreatedDate,CreatedHostName) 
				values ('$inputAutoRequestNo','$tempID_No','$Price','$Isi','$UOM1',
				'$DZ_CT','$CT_CT','$UOM','$Barcode_Existing','$Code_Product','$BARCODE',
				'$i+1','$username','$createddate','$ip : $hostname')");
				$message = "2";
					/*echo "<script type='text/javascript'>alert('$message');</script>";*/
			}
		}
	}
}

//MPR DETAIL PRODUKSI
if (is_array(@$_POST['tempID_NoProd'])){
	for($i=0;$i<count(@$_POST['tempID_NoProd']);$i++){
		if($_POST['tempID_NoProd'][$i]<>"")	{
			$tempID_NoProd				=$_POST['tempID_NoProd'][$i];
			$Nama_Produk_Singkat		=@$_POST['Nama_Produk_Singkat'][$i];
			$Kelompok_Stok				=@$_POST['Kelompok_Stok'][$i];
			$exe=mysqli_query($con,"Select * From tb_mpr_detail WHERE Request_No = '$inputAutoRequestNo'
			And ID_No='$tempID_NoProd' ");
			if (mysqli_num_rows($exe) !=0 ) {
				if (@$button=="mpr-app" && @$tampildataWFMPR['Approve_No']==1 && @$tampildataWFMPR['Step_Revise']==5) { 
					mysqli_query($con,"Update tb_mpr_detail Set Nama_Produk_Singkat='$Nama_Produk_Singkat',
					Kelompok_Stok='$Kelompok_Stok' Where ID_No ='".$tempID_NoProd."' ");
					$message = "0";
					/*echo "<script type='text/javascript'>alert('$message');</script>";*/
				}
			}
		}
	}
}

if (is_array(@$_FILES['InputFile'])){
	for($i=0;$i<count(@$_FILES['InputFile']);$i++){
		$name 		= @$_FILES['InputFile']['name'][$i];
		$tmp  		= @$_FILES['InputFile']['tmp_name'][$i];
		$index		= $i+1;
		$temp		= @$_POST['tempfileid'][$i];
		$InputName	= @$_POST['InputNameFile'][$i];
		$exe=mysqli_query($con,"SELECT ID_No,Request_No,File,Name FROM tb_fnim_file where ID_No = '".$temp."' ");
			if(trim($name)!=''){
				$new_name = date('YmdHis').$name; //rename file
				if(move_uploaded_file($tmp,$file.$new_name)){ //proses upload
					mysqli_query($con,"Insert INTO tb_fnim_file (Request_No,File,Name,Index_No,CreatedBy,CreatedDate,CreatedHostName) 
					values ('$inputAutoRequestNo','".$new_name."','$InputName',
					'".$index."','$username','$createddate','$ip : $hostname')");
					echo 'Berhasil mengupload file '.$new_name.' ke Folder upload<br/>'; //pesan berhasil
				}
			}
	}
}	
	
	
?>