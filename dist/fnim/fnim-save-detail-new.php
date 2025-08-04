<?php
//FNIM COUNTRY
mysqli_query($con,"Delete From tb_fnim_country WHERE Request_No = '$inputAutoRequestNo'");
if (is_array(@$_POST['selectCountry'])){
	for($b=0;$b<count(@$_POST['selectCountry']);$b++){
		if($_POST['selectCountry'][$b]<>"-")	{
			$selectCountry				=$_POST['selectCountry'][$b];			
			mysqli_query($con,"Insert INTO tb_fnim_country (Request_No,Country,Index_No,CreatedBy,CreatedDate,CreatedHostName) 
			values ('$inputAutoRequestNo','$selectCountry','$b+1','$username','$createddate','$ip : $hostname')");
		}
	}
}
//FNIM DETAIL
mysqli_query($con,"Delete From tb_fnim_detail_package_on_store 		WHERE Request_No = '$inputAutoRequestNo'");
mysqli_query($con,"Delete From tb_fnim_detail_fragrance_code 		WHERE Request_No = '$inputAutoRequestNo'");
mysqli_query($con,"Delete From tb_fnim_detail_formula_sample_code 	WHERE Request_No = '$inputAutoRequestNo'");
mysqli_query($con,"Delete From tb_fnim_detail_formula 				WHERE Request_No = '$inputAutoRequestNo'");
mysqli_query($con,"Delete From tb_fnim_detail_netto 				WHERE Request_No = '$inputAutoRequestNo'");
mysqli_query($con,"Delete From tb_fnim_detail 						WHERE Request_No = '$inputAutoRequestNo'");
if (is_array(@$_POST['tempItemDetail'])){
	for($i=0;$i<count(@$_POST['tempItemDetail']);$i++){
		if($_POST['tempItemDetail'][$i]<>"")	{
			$tempItemDetail				=$_POST['tempItemDetail'][$i];
			$finalproductname			=$_POST['finalproductname'][$i];
			$InputStatusProduct			=$_POST['InputStatusProduct'][$i];
			$selectMataUang				=@$_POST['selectMataUang'][$i];
			$InputPrice					=str_replace(",", ".",str_replace(".", "",@$_POST['InputPrice'][$i]));

			$InputMCJItemNo				=@$_POST['InputMCJItemNo'][$i];
			$InputNote					=@$_POST['InputNote'][$i];		
			mysqli_query($con,"Insert INTO tb_fnim_detail (ID_No,Request_No,Product_Name,Status_Product,
			NamaCurrency,Assumed_Consumer_Price,MCJ_Item_No,Note,Index_No,CreatedBy,CreatedDate,CreatedHostName) 
			values ('$tempItemDetail','$inputAutoRequestNo','$finalproductname','$InputStatusProduct',
			'$selectMataUang','$InputPrice','$InputMCJItemNo','$InputNote','$i+1','$username','$createddate','$ip : $hostname')");

			//Insert Detail Netto
			if (is_array(@$_POST['tempNetto'.$tempItemDetail])){
				for($j=0;$j<count(@$_POST['tempNetto'.$tempItemDetail]);$j++){
					$tempNetto						=@$_POST['tempNetto'.$tempItemDetail][$j];
					$InputNettoDetail				=@$_POST['InputNettoDetail'.$tempItemDetail][$j];
					$SelectNettoDetail				=@$_POST['SelectNettoDetail'.$tempItemDetail][$j];
					mysqli_query($con,"Insert INTO tb_fnim_detail_netto 
					(Request_No,ID_No_FnimDetail,Isi_Net,Netto,Index_No,CreatedBy,CreatedDate,CreatedHostName) 
					values ('$inputAutoRequestNo','$tempItemDetail','$InputNettoDetail','$SelectNettoDetail',
					'$j+1','$username','$createddate','$ip : $hostname')");				
				}
			}
			//Insert Detail Formula
			if (is_array(@$_POST['tempFormula'.$tempItemDetail])){
				for($k=0;$k<count(@$_POST['tempFormula'.$tempItemDetail]);$k++){
					$tempFormula					=@$_POST['tempFormula'.$tempItemDetail][$k];
					$InputFormula					=@$_POST['InputFormula'.$tempItemDetail][$k];
					mysqli_query($con,"Insert INTO tb_fnim_detail_formula 
					(Request_No,ID_No_FnimDetail,Formula,Index_No,CreatedBy,CreatedDate,CreatedHostName) 
					values ('$inputAutoRequestNo','$tempItemDetail','$InputFormula',
					'$k+1','$username','$createddate','$ip : $hostname')");				
				}
			}
			//Insert Detail Formula Sample Code
			if (is_array(@$_POST['tempFormulaSampleCode'.$tempItemDetail])){
				for($l=0;$l<count(@$_POST['tempFormulaSampleCode'.$tempItemDetail]);$l++){
					$tempFormulaSampleCode			=@$_POST['tempFormulaSampleCode'.$tempItemDetail][$l];
					$InputFormulaSampleCode			=@$_POST['InputFormulaSampleCode'.$tempItemDetail][$l];
					mysqli_query($con,"Insert INTO tb_fnim_detail_formula_sample_code 
					(Request_No,ID_No_FnimDetail,Formula_Sample_Code,Index_No,CreatedBy,CreatedDate,CreatedHostName) 
					values ('$inputAutoRequestNo','$tempItemDetail','$InputFormulaSampleCode',
					'$l+1','$username','$createddate','$ip : $hostname')");				
				}
			}
			//Insert Detail Fragrance Code
			if (is_array(@$_POST['tempFragranceCode'.$tempItemDetail])){
				for($m=0;$m<count(@$_POST['tempFragranceCode'.$tempItemDetail]);$m++){
					$tempFragranceCode				=@$_POST['tempFragranceCode'.$tempItemDetail][$m];
					$InputFragranceCode				=@$_POST['InputFragranceCode'.$tempItemDetail][$m];
					mysqli_query($con,"Insert INTO tb_fnim_detail_fragrance_code 
					(Request_No,ID_No_FnimDetail,Fragrance_Code,Index_No,CreatedBy,CreatedDate,CreatedHostName) 
					values ('$inputAutoRequestNo','$tempItemDetail','$InputFragranceCode',
					'$m+1','$username','$createddate','$ip : $hostname')");				
				}
			}	
			//Insert Detail Package On Store
			if (is_array(@$_POST['tempPackageOnStore'.$tempItemDetail])){
				for($n=0;$n<count(@$_POST['tempPackageOnStore'.$tempItemDetail]);$n++){
					$tempPackageOnStore				=@$_POST['tempPackageOnStore'.$tempItemDetail][$n];
					$InputPackageOnStore			=@$_POST['InputPackageOnStore'.$tempItemDetail][$n];
					mysqli_query($con,"Insert INTO tb_fnim_detail_package_on_store 
					(Request_No,ID_No_FnimDetail,Package_On_Store,Index_No,CreatedBy,CreatedDate,CreatedHostName) 
					values ('$inputAutoRequestNo','$tempItemDetail','$InputPackageOnStore',
					'$n+1','$username','$createddate','$ip : $hostname')");				
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