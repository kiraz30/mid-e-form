<?php
//FNIM COUNTRY
mysqli_query($con,"Delete From tb_nprf_country WHERE Request_No = '$inputAutoRequestNo'");
if (is_array(@$_POST['selectCountry'])){
	for($b=0;$b<count(@$_POST['selectCountry']);$b++){
		if($_POST['selectCountry'][$b]<>"-")	{
			$selectCountry				=$_POST['selectCountry'][$b];			
			mysqli_query($con,"Insert INTO tb_nprf_country (Request_No,Country,Index_No,CreatedBy,CreatedDate,CreatedHostName) 
			values ('$inputAutoRequestNo','$selectCountry','$b+1','$username','$createddate','$ip : $hostname')");
		}
	}
}
//FNIM COUNTRY
 
//NPRF DETAIL
mysqli_query($con,"Delete From tb_nprf_item_detail_netto WHERE Request_No = '$inputAutoRequestNo'");
mysqli_query($con,"Delete From tb_nprf_item_detail WHERE Request_No = '$inputAutoRequestNo'");
if (is_array(@$_POST['InputNewProduct'])){
	for($i=0;$i<count(@$_POST['InputNewProduct']);$i++){
		if($_POST['InputNewProduct'][$i]<>"")	{
			$tempItemDetail				=@$_POST['tempItemDetail'][$i];
			$InputMCJItemNo				=@$_POST['InputMCJItemNo'][$i];
			$InputNewProduct			=@$_POST['InputNewProduct'][$i];
			$InputStatusProduct			=@$_POST['InputStatusProduct'][$i];
			$InputNet					=@$_POST['InputNet'][$i];
			$SelectNetto				=@$_POST['SelectNetto'][$i];	
			$selectMataUang				=@$_POST['selectMataUang'][$i];
			$selectMataUang				=@$_POST['selectMataUang'][$i];
			$selectMataUangHPJ			=@$_POST['selectMataUangHPJ'][$i];
			$selectMataUangC_FPrice		=@$_POST['selectMataUangC_FPrice'][$i];
			$selectMataUangTargetCOGS	=@$_POST['selectMataUangTargetCOGS'][$i];
			$InputPrice					=str_replace(",", ".",str_replace(".", "",@$_POST['InputPrice'][$i]));
			$InputHPJ					=str_replace(",", ".",str_replace(".", "",@$_POST['InputHPJ'][$i]));
			$InputC_FPrice				=str_replace(",", ".",str_replace(".", "",@$_POST['InputC_FPrice'][$i]));
			$InputTargetCOGS			=str_replace(",", ".",str_replace(".", "",@$_POST['InputTargetCOGS'][$i]));
			$InputCOGS					=str_replace(",", ".",str_replace(".", "",@$_POST['InputCOGS'][$i]));
			$InputSales3Mth				=@$_POST['InputSales3Mth'][$i]; 
			$InputIntroduction			=str_replace(",", ".",str_replace(".", "",@$_POST['InputIntroduction'][$i]));
			$selectSatuanSales1Yr		=@$_POST['selectSatuanSales1Yr'][$i]; 
			$InputSales1Yr				=str_replace(",", ".",str_replace(".", "",@$_POST['InputSales1Yr'][$i]));
			mysqli_query($con,"Insert INTO tb_nprf_item_detail (Request_No,New_Product,Status_Product,Isi_Net,Netto,
			NamaCurrency,Price,NamaCurrencyHPJ,HPJ,NamaCurrencyC_FPrice,C_FPrice,
			NamaCurrencyTargetCOGS,Target_COGS,COGS,Sales_3Mth,Introduction,Satuan_Sales1Yr,Sales_1yr,
			Index_No,CreatedBy,CreatedDate,CreatedHostName) 
			values ('$inputAutoRequestNo','$InputNewProduct','$InputStatusProduct','$InputNet','$SelectNetto',
			'$selectMataUang','$InputPrice','$selectMataUangHPJ','$InputHPJ','$selectMataUangC_FPrice','$InputC_FPrice',
			'$selectMataUangTargetCOGS','$InputCOGS','$InputSales3Mth','$InputIntroduction','$selectSatuanSales1Yr','$InputSales1Yr','$i+1','$username','$createddate','$ip : $hostname')");
			$ID_No_Item_Detail=mysqli_insert_id($con);
			if (is_array(@$_POST['tempNetto'.$tempItemDetail])){
				for($j=0;$j<count(@$_POST['tempNetto'.$tempItemDetail]);$j++){
					$tempNetto						=@$_POST['tempNetto'.$tempItemDetail][$j];
					$InputNettoDetail				=@$_POST['InputNettoDetail'.$tempItemDetail][$j];
					$SelectNettoDetail				=@$_POST['SelectNettoDetail'.$tempItemDetail][$j];
					mysqli_query($con,"Insert INTO tb_nprf_item_detail_netto 
					(Request_No,ID_No_ItemDetail,Isi_Net,Netto,Index_No,CreatedBy,CreatedDate,CreatedHostName) 
					values ('$inputAutoRequestNo','$ID_No_Item_Detail','$InputNettoDetail','$SelectNettoDetail',
					'$j+1','$username','$createddate','$ip : $hostname')");
				}
			}
		}
	}
}

mysqli_query($con,"Delete From tb_nprf_Competitor WHERE Request_No = '$inputAutoRequestNo'");
if (is_array(@$_POST['InputNewProductCompetitor'])){
	for($i=0;$i<count(@$_POST['InputNewProductCompetitor']);$i++){
		if($_POST['InputNewProductCompetitor'][$i]<>"")	{
			$InputNewProductCompetitor	=@$_POST['InputNewProductCompetitor'][$i];
			$InputNetCompetitor			=@$_POST['InputNetCompetitor'][$i];
			$SelectNettoCompetitor		=@$_POST['SelectNettoCompetitor'][$i];	
			$selectMataUangCompetitor	=@$_POST['selectMataUangCompetitor'][$i];
			$InputPriceCompetitor		=str_replace(",", ".",str_replace(".", "",@$_POST['InputPriceCompetitor'][$i]));
			$InputReasonCompetitor		=@$_POST['InputReasonCompetitor'][$i];
			mysqli_query($con,"Insert INTO tb_nprf_Competitor (Request_No,New_Product,Isi_Net,Netto,NamaCurrency,Price,
			Reason,Index_No,CreatedBy,CreatedDate,CreatedHostName) 
			values ('$inputAutoRequestNo','$InputNewProductCompetitor','$InputNetCompetitor','$SelectNettoCompetitor',
			'$selectMataUangCompetitor','$InputPriceCompetitor','$InputReasonCompetitor',
			'$i+1','$username','$createddate','$ip : $hostname')");
		}
	}
}	

mysqli_query($con,"Delete From tb_nprf_outlineofschedule WHERE Request_No = '$inputAutoRequestNo'");
if (is_array(@$_POST['InputOutlineofSchedule'])){
	for($i=0;$i<count(@$_POST['InputOutlineofSchedule']);$i++){
		if($_POST['InputOutlineofSchedule'][$i]<>"")	{
			$InputOutlineofSchedule		=$_POST['InputOutlineofSchedule'][$i];
			$SelectbulanSchedule		=@$_POST['SelectbulanSchedule'][$i];
			$SelectTahunSchedule		=@$_POST['SelectTahunSchedule'][$i];	
			mysqli_query($con,"Insert INTO tb_nprf_outlineofschedule (Request_No,Keterangan,Bulan,Tahun,
			Index_No,CreatedBy,CreatedDate,CreatedHostName) 
			values ('$inputAutoRequestNo','$InputOutlineofSchedule','$SelectbulanSchedule','$SelectTahunSchedule',
			'$i+1','$username','$createddate','$ip : $hostname')");
		}
	}
}		
?>