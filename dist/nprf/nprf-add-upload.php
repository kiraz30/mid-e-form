	<?php $Send		= @$_POST['Send']; ?>
	<?php $Save		= @$_POST['Save']; ?>

<script language="JavaScript">
	function setFocus(){
 	document.nprf.SelectTypeRequest.focus();
 	}

	function DisplayShowHideExport()
	{
		if (document.nprf.SelectTypeRequest.value == "Export")
			{document.getElementById("country").style.visibility = 'visible';}
		else
			{document.getElementById("country").style.visibility = 'hidden';} 
	}
</script>
<script type="text/javascript">
		function addRowCountry(tableID) {
			var table = document.getElementById(tableID);

			var rowCount = table.rows.length;
			var row = table.insertRow(rowCount);

			var cell1 = row.insertCell(0);
			var element1 = document.createElement("input");
			element1.type ="checkbox";
			element1.name="chk[]";
			element1.id="chk[]";
			cell1.appendChild(element1);
			var cell2 = row.insertCell(1);
			var array = [<?php
			$div = mysqli_query($con,"SELECT Country FROM tb_trading_partner Where Status<>0 ");
			while($b = mysqli_fetch_array($div)){
			echo  "\"$b[Country]\",";}	?>];
		
			var selectCountry = document.createElement('select');
			selectCountry.setAttribute('class',"form-control");
			selectCountry.setAttribute('title',"Select Country");
			selectCountry.setAttribute('name',"selectCountry[]");
			selectCountry.setAttribute('id',"selectCountry[]");
			cell2.appendChild(selectCountry);
			
			for (var i = 0; i < array.length; i++) {
				var option = document.createElement("option");
				option.value = array[i];
				option.text = array[i];
				selectCountry.appendChild(option);
			}
			
		}

		function deleteRowCountry(tableID) {
			try {
			var table = document.getElementById(tableID);
			var rowCount = table.rows.length;

			for(var i=0; i<rowCount; i++) {
				var row = table.rows[i];
				var chk = row.cells[0].childNodes[0];
				if(null != chk && true == chk.checked) {
					table.deleteRow(i);
					rowCount--;
					i--;
				}
			}
			}catch(e) {
				alert(e);
			}
		}


</script>

<script type="text/javascript">
		function addRow(tableID) {
			var table = document.getElementById(tableID);

			var rowCount = table.rows.length
			
			var addtblnetto ="nprfnetto"+rowCount;
			var row = table.insertRow(rowCount);
	
			var cell1 = row.insertCell(0);
			var element1 = document.createElement("input");
			element1.type ="checkbox";
			element1.name="chkdetail[]";
			element1.id="chkdetail[]";
			cell1.appendChild(element1);
			var tempItemDetail = document.createElement("input");
			tempItemDetail.type ="hidden";
			tempItemDetail.name="tempItemDetail[]";
			tempItemDetail.id="tempItemDetail[]";
			tempItemDetail.value=rowCount;
			cell1.appendChild(tempItemDetail);
			
			var cell2 = row.insertCell(1);
			var MCJItemNo = document.createElement('input');
			MCJItemNo.setAttribute('class',"form-control");
			MCJItemNo.setAttribute('style',"padding:2px 2px 2px 2px");
			MCJItemNo.setAttribute('title',"Input MCJ Item No");
			MCJItemNo.setAttribute('name',"InputMCJItemNo[]");
			MCJItemNo.setAttribute('id',"InputMCJItemNo[]");
			MCJItemNo.setAttribute('required',"required[]");
			cell2.appendChild(MCJItemNo);
			
			var cell3 = row.insertCell(2);	
			var finalproductname = document.createElement('textarea');
			finalproductname.setAttribute('class',"form-control");
			finalproductname.setAttribute('style',"padding:2px 2px 2px 2px");
			finalproductname.setAttribute('title',"Input Final Product Name");
			finalproductname.setAttribute('name',"InputNewProduct[]");
			finalproductname.setAttribute('id',"InputNewProduct[]");
			finalproductname.setAttribute('onkeyup',"this.value = this.value.toUpperCase()");
			finalproductname.setAttribute('required',"required[]");
			cell3.appendChild(finalproductname);
			
			var cell4 = row.insertCell(3);
			var array = ["New","Renewal"];
			var InputStatusProduct = document.createElement('select');
			InputStatusProduct.setAttribute('class',"form-control");
			InputStatusProduct.setAttribute('title',"Select Product");
			InputStatusProduct.setAttribute('name',"InputStatusProduct[]");
			InputStatusProduct.setAttribute('id',"InputStatusProduct[]");
			cell4.appendChild(InputStatusProduct);
			
			
			for (var i = 0; i < array.length; i++) {
				var option = document.createElement("option");
				option.value = array[i];
				option.text = array[i];
				InputStatusProduct.appendChild(option);
			}
			
			var cell5 = row.insertCell(4);
			var table = document.createElement('table');
			table.className=addtblnetto; //nprfnetto4
			table.id=addtblnetto; //nprfnetto4
			table.width="100%";
			table.class="table table-striped table-bordered table-hover";
        	table.innerHTML ="<tr><td colspan='3' style='padding:2px 2px 2px 2px'><button type='button' style='padding:0px 0px 0px 0px' class='btn btn-primary' name='btnCreateNetto' onClick=addRowNetto('"+addtblnetto.toString()+"','"+rowCount.toString()+"')><span class='fa fa-plus' title='Add Netto' ></span> </button> <button type='button' style='padding:0px 0px 0px 0px' class='btn btn-primary' id='btnDeleteNetto' name='btnDeleteNetto' onClick=deleteRowNetto('"+addtblnetto.toString()+"','"+rowCount.toString()+"')><span class='glyphicon glyphicon-trash' title='Delete Netto' ></span></button></td></tr>";
        	cell5.appendChild(table);
		
			var cell6 = row.insertCell(5);
			var array = [<?php
			$div = mysqli_query($con,"SELECT NamaCurrency FROM tb_currency WHERE Status='1' Group By NamaCurrency  ");
			while($b = mysqli_fetch_array($div)){
			echo  "\"$b[NamaCurrency]\",";}	?>];
		
			var selectMataUang = document.createElement('select');
			selectMataUang.setAttribute('class',"form-control");
			selectMataUang.setAttribute('style',"padding:2px 2px 2px 2px;text-align: right;");
			selectMataUang.setAttribute('title',"Select Mata Uang");
			selectMataUang.setAttribute('name',"selectMataUang[]");
			selectMataUang.setAttribute('id',"selectMataUang[]");
			cell6.appendChild(selectMataUang);
			
			var option = document.createElement("option");
				option.value = '';
				option.text = 'Currency';
				selectMataUang.appendChild(option);
				
			for (var i = 0; i < array.length; i++) {
				var option = document.createElement("option");
				option.value = array[i];
				option.text = array[i];
				selectMataUang.appendChild(option);
			}
			var price = document.createElement('input');
			price.setAttribute('class',"form-control");
			price.setAttribute('style',"padding:2px 2px 2px 2px;text-align: right;");
			price.setAttribute('title',"Input Price Exemple 1.000,25");
			price.setAttribute('name',"InputPrice[]");
			price.setAttribute('id',"InputPrice[]");
			price.setAttribute('onkeyup',"return angka(this);");

			cell6.appendChild(price);

			var cell7 = row.insertCell(6);
			var array = [<?php
			$div = mysqli_query($con,"SELECT NamaCurrency FROM tb_currency WHERE Status='1' Group By NamaCurrency  ");
			while($b = mysqli_fetch_array($div)){
			echo  "\"$b[NamaCurrency]\",";}	?>];
		
			var selectMataUangHPJ = document.createElement('select');
			selectMataUangHPJ.setAttribute('class',"form-control");
			selectMataUangHPJ.setAttribute('style',"padding:2px 2px 2px 2px;text-align: right;");
			selectMataUangHPJ.setAttribute('title',"Select Mata Uang HPJ");
			selectMataUangHPJ.setAttribute('name',"selectMataUangHPJ[]");
			selectMataUangHPJ.setAttribute('id',"selectMataUangHPJ[]");
			cell7.appendChild(selectMataUangHPJ);
			
			var option = document.createElement("option");
				option.value = '';
				option.text = 'Currency';
				selectMataUangHPJ.appendChild(option);
				
			for (var i = 0; i < array.length; i++) {
				var option = document.createElement("option");
				option.value = array[i];
				option.text = array[i];
				selectMataUangHPJ.appendChild(option);
			}

			var InputHPJ = document.createElement('input');
			InputHPJ.setAttribute('class',"form-control");
			InputHPJ.setAttribute('style',"padding:2px 2px 2px 2px;text-align: right;");
			InputHPJ.setAttribute('title',"Input HPJ Exemple 1.000,25");
			InputHPJ.setAttribute('name',"InputHPJ[]");
			InputHPJ.setAttribute('id',"InputHPJ[]");
			InputHPJ.setAttribute('onkeyup',"return angka(this);");

			cell7.appendChild(InputHPJ);	
			
			var cell8 = row.insertCell(7);
			var array = [<?php
			$div = mysqli_query($con,"SELECT NamaCurrency FROM tb_currency WHERE Status='1' Group By NamaCurrency  ");
			while($b = mysqli_fetch_array($div)){
			echo  "\"$b[NamaCurrency]\",";}	?>];
		
			var selectMataUangC_FPrice = document.createElement('select');
			selectMataUangC_FPrice.setAttribute('class',"form-control");
			selectMataUangC_FPrice.setAttribute('style',"padding:2px 2px 2px 2px;text-align: right;");
			selectMataUangC_FPrice.setAttribute('title',"Select Mata Uang HPJ");
			selectMataUangC_FPrice.setAttribute('name',"selectMataUangC_FPrice[]");
			selectMataUangC_FPrice.setAttribute('id',"selectMataUangC_FPrice[]");
			cell8.appendChild(selectMataUangC_FPrice);
			
			var option = document.createElement("option");
				option.value = '';
				option.text = 'Currency';
				selectMataUangC_FPrice.appendChild(option);
				
			for (var i = 0; i < array.length; i++) {
				var option = document.createElement("option");
				option.value = array[i];
				option.text = array[i];
				selectMataUangC_FPrice.appendChild(option);
			}
			var C_FPrice = document.createElement('input');
			C_FPrice.setAttribute('class',"form-control");
			C_FPrice.setAttribute('style',"padding:2px 2px 2px 2px;text-align: right;");
			C_FPrice.setAttribute('title',"Input C&F Price (EXPORT) 1.000,25");
			C_FPrice.setAttribute('name',"InputC_FPrice[]");
			C_FPrice.setAttribute('id',"InputC_FPrice[]");
			C_FPrice.setAttribute('onkeyup',"return angka(this);");
			cell8.appendChild(C_FPrice);	
			
			var cell9 = row.insertCell(8);
			var array = [<?php
			$div = mysqli_query($con,"SELECT NamaCurrency FROM tb_currency WHERE Status='1' Group By NamaCurrency  ");
			while($b = mysqli_fetch_array($div)){
			echo  "\"$b[NamaCurrency]\",";}	?>];
		
			var selectMataUangTargetCOGS = document.createElement('select');
			selectMataUangTargetCOGS.setAttribute('class',"form-control");
			selectMataUangTargetCOGS.setAttribute('style',"padding:2px 2px 2px 2px;text-align: right;");
			selectMataUangTargetCOGS.setAttribute('title',"Select Mata Uang");
			selectMataUangTargetCOGS.setAttribute('name',"selectMataUangTargetCOGS[]");
			selectMataUangTargetCOGS.setAttribute('id',"selectMataUangTargetCOGS[]");
			cell9.appendChild(selectMataUangTargetCOGS);
			
			var option = document.createElement("option");
				option.value = '';
				option.text = 'Currency';
				selectMataUangTargetCOGS.appendChild(option);
			
			for (var i = 0; i < array.length; i++) {
				var option = document.createElement("option");
				option.value = array[i];
				option.text = array[i];
				selectMataUangTargetCOGS.appendChild(option);
			}
			
			var formulasamplecode = document.createElement('input');
			formulasamplecode.setAttribute('class',"form-control");
			formulasamplecode.setAttribute('style',"padding:2px 2px 2px 2px;text-align: right;");
			formulasamplecode.setAttribute('title',"Input COG PRICE Exemple 1.000,25");
			formulasamplecode.setAttribute('name',"InputTargetCOGS[]");
			formulasamplecode.setAttribute('id',"InputTargetCOGS[]");
			formulasamplecode.setAttribute('onkeyup',"return angka(this);");
			cell9.appendChild(formulasamplecode);	
			
		
			var cell10 = row.insertCell(9);
			var PackageOnStone = document.createElement('input');
			PackageOnStone.setAttribute('class',"form-control");
			PackageOnStone.setAttribute('style',"padding:2px 2px 2px 2px;text-align: right;");
			PackageOnStone.setAttribute('title',"Input COGS Exemple 1.000,25");
			PackageOnStone.setAttribute('name',"InputCOGS[]");
			PackageOnStone.setAttribute('id',"InputCOGS[]");
			PackageOnStone.setAttribute('onkeyup',"return angka(this);");
			cell10.appendChild(PackageOnStone);
			
			
			 
			
			var cell11 = row.insertCell(10);
			var array = ['Dzn','Pcs'];
		
			var InputSales3Mth = document.createElement('select');
			InputSales3Mth.setAttribute('class',"form-control");
			 
			InputSales3Mth.setAttribute('title',"Select Initial Introduction");
			InputSales3Mth.setAttribute('name',"InputSales3Mth[]");
			InputSales3Mth.setAttribute('id',"InputSales3Mth[]");
			cell11.appendChild(InputSales3Mth);
			
			
			for (var i = 0; i < array.length; i++) {
				var option = document.createElement("option");
				option.value = array[i];
				option.text = array[i];
				InputSales3Mth.appendChild(option);
			}
			var InputIntroduction = document.createElement('input');
			InputIntroduction.setAttribute('class',"form-control");
			InputIntroduction.setAttribute('style',"padding:2px 2px 2px 2px;text-align: right;");
			InputIntroduction.setAttribute('title',"Input Initial Introduction Exemple 1.000,25");
			InputIntroduction.setAttribute('name',"InputIntroduction[]");
			InputIntroduction.setAttribute('id',"InputIntroduction[]");
			InputIntroduction.setAttribute('onkeyup',"return angka(this);");
			cell11.appendChild(InputIntroduction);		
			
			var cell12 = row.insertCell(11);
			var array = ['Dzn','Pcs'];
		
			var selectSatuanSales1Yr = document.createElement('select');
			selectSatuanSales1Yr.setAttribute('class',"form-control");
			selectSatuanSales1Yr.setAttribute('title',"Select Satuan");
			selectSatuanSales1Yr.setAttribute('name',"selectSatuanSales1Yr[]");
			selectSatuanSales1Yr.setAttribute('id',"selectSatuanSales1Yr[]");
			cell12.appendChild(selectSatuanSales1Yr);
			
			
			for (var i = 0; i < array.length; i++) {
				var option = document.createElement("option");
				option.value = array[i];
				option.text = array[i];
				selectSatuanSales1Yr.appendChild(option);
			}
			
			var InputSales1Yr = document.createElement('input');
			InputSales1Yr.setAttribute('class',"form-control");
			InputSales1Yr.setAttribute('style',"padding:2px 2px 2px 2px;text-align: right;");
			InputSales1Yr.setAttribute('title',"Input Sales 1Yr Exemple 1.000,25");
			InputSales1Yr.setAttribute('name',"InputSales1Yr[]");
			InputSales1Yr.setAttribute('id',"InputSales1Yr[]");
			InputSales1Yr.setAttribute('onkeyup',"return angka(this);");
			cell12.appendChild(InputSales1Yr);		

		}

		function deleteRow(tableID) {
			try {
			var table = document.getElementById(tableID);
			var rowCount = table.rows.length;

			for(var i=0; i<rowCount; i++) {
				var row = table.rows[i];
				var chk = row.cells[0].childNodes[0];
				if(null != chk && true == chk.checked) {
					table.deleteRow(i);
					rowCount--;
					i--;
				}
			}
			}catch(e) {
				alert(e);
			}
		}
</script>
<script type="text/javascript">
		function addRowNetto(tableID,IDNo) {
			var table = document.getElementById(tableID);

			var rowCount = table.rows.length;
			var row = table.insertRow(rowCount);

			var cell1 = row.insertCell(0);
			var checkbox = document.createElement("input");
			checkbox.type ="checkbox";
			checkbox.name="chkNetto"+IDNo.toString()+"[]";
			checkbox.id="chkNetto"+IDNo.toString()+"[]";
			cell1.appendChild(checkbox);
			var cell2 = row.insertCell(1);
			var tempNetto = document.createElement("input");
			tempNetto.type ="hidden";
			tempNetto.name="tempNetto"+IDNo.toString()+"[]";
			tempNetto.id="tempNetto"+IDNo.toString()+"[]";
			cell2.appendChild(tempNetto);
			
			var InputIsiNetto = document.createElement('input');
			InputIsiNetto.setAttribute('class',"form-control");
			InputIsiNetto.setAttribute('style',"padding:2px 2px 2px 2px;text-align:right;width:35px");
			InputIsiNetto.setAttribute('title',"Input Isi Netto");
			InputIsiNetto.setAttribute('name',"InputNettoDetail"+IDNo.toString()+"[]");
			InputIsiNetto.setAttribute('id',"InputNettoDetail"+IDNo.toString()+"[]");
			cell2.appendChild(InputIsiNetto);
			
			var array = [<?php
			$div = mysqli_query($con,"SELECT Netto FROM tb_netto Group By Netto ");
			while($b = mysqli_fetch_array($div)){
			echo  "\"$b[Netto]\",";}	?>];
			
			var cell3 = row.insertCell(2);
			var selectNetto = document.createElement('select');
			selectNetto.setAttribute('class',"form-control");
			selectNetto.setAttribute('style',"padding:2px 2px 2px 2px;");
			selectNetto.setAttribute('title',"Select Netto");
			selectNetto.setAttribute('name',"SelectNettoDetail"+IDNo.toString()+"[]");
			selectNetto.setAttribute('id',"SelectNettoDetail"+IDNo.toString()+"[]");
			cell3.appendChild(selectNetto);
			
			
			for (var i = 0; i < array.length; i++) {
				var option = document.createElement("option");
				option.value = array[i];
				option.text = array[i];
				selectNetto.appendChild(option);
			}
		}


		function deleteRowNetto(tableID) {
			try {
			var table = document.getElementById(tableID);
			var rowCount = table.rows.length;

			for(var i=0; i<rowCount; i++) {
				var row = table.rows[i];
				var chk = row.cells[0].childNodes[0];
				if(null != chk && true == chk.checked) {
					table.deleteRow(i);
					rowCount--;
					i--;
				}
			}
			}catch(e) {
				alert(e);
			}
		}

</script>

 
 
<script type="text/javascript">
	function hanyaAngka(evt){
		var charCode = (evt.which) ? evt.which : event.keyCode
		if ((charCode < 48 || charCode > 57)&&charCode>32){
			return false;
		}
		return true;
	}
	
function angka(e) {
  if (!/^[0-9-,-.]+$/.test(e.value)) {
    e.value = e.value.substring(0,e.value.length-100);
  }
}

 

</script>



<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Static Navigation - E-Form</title>
        <link href="../css/styles.css" rel="stylesheet" />
		<!-- Bootstrap Core CSS -->
		<link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<script type="text/javascript" src="../ckeditor/ckeditor.js"></script>

	
		<!-- MetisMenu CSS -->
		<link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
	
		<!-- Custom CSS -->
		<link href="../css/sb-admin-2.css" rel="stylesheet">
	
		<!-- Custom Fonts -->
		<link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    </head>
	<script type="text/javascript">
		function popupwindow(url, title, h, w) {
		  var left = (screen.width/2)-(w/2);
		  var top = (screen.height/2)-(h/2);
		  return window.open(url, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, 	copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
		  return false;
		} 
	</script>
	<body onload='setFocus();' > 
	<main> 
    <div class="container-fluid"> 
      <h3 class="mt-4"><?php if ($button=="add-nprf-upload" || $button=="add-revise-nprf") 
	  	{echo "New Upload NPRF (Demestic / Export)";} else  {echo "Edit Upload NPRF (Demestic / Export)";} ?> </h3>
	    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="../dist/index.php?button=dashboard">Dashboard</a></li>
		<li class="breadcrumb-item"><a href="../dist/index.php?button=nprf">New Upload NPRF</a></li>
        <li class="breadcrumb-item active"><?php if ($button=="add-nprf-upload" || $button=="add-revise-nprf") 
		{echo "New Upload NPRF (Demestic / Export)";} else  {echo "Edit Upload NPRF (Demestic / Export)";} ?> </li>
      </ol>
 	<div class="card mb-4">
	    <div class="card-header"> </div>

        <div class="card-body"> 
			
        <?php
		include "nprf-autonumber.php";
		$query ="SELECT ID_No,Index_Document,Request_No,Last_Request_No,Thema_Number,Thema_Name,Type_Request,
	 	Status_NPRF,Remark,Mcj,RemarkafterComplete FROM tb_nprf where Request_No = '".@$_GET['id']."' " ; 	
		if ($button=="add-revise-nprf-upload") {$query.=" And Status_Last_Document='1'";}
		else {$query =$query; }
      	$exe =mysqli_query($con,$query);
        $tampildata=mysqli_fetch_array($exe);
		$Request_No=@$tampildata['Request_No']."-R";
		$rev=@$tampildata['Index_Document']+1;
				//________________________________________________________________________________UPDATE READ INBOX
		mysqli_query($con,"UPDATE tb_inbox SET ReadInbox='1' Where (NameApproval= '$username' Or OnBehalf='$username') 
		And Request_No='".@$_GET['id']."' And ReadInbox='0'");
		
		//________________________________________________________________________________StatusNPRF disabled	 
		if (@$tampildata['Status_NPRF']<>"Draft" & @$tampildata['Status_NPRF']<>"" & $button<>"add-revise-nprf-upload")
		  {$disabled="disabled";} else{$disabled="";}
		if (@$tampildata['Status_NPRF'] <> "Complete By MID" 
			|| $button=="add-revise-nprf" & @$tampildata['Status_NPRF'] <> "Complete By MCJ"  )
		  {$disabledmid="disabled";} else{$disabledmid="";}

		  //________________________________________________________________________________WORKFLOWNPRF
		$exeReq = mysqli_query($con,"Select NameApproval,OnBehalf,Remark_WorkFlow FROM tb_workflownprf 
		WHERE Request_No = '".@$_GET['id']."' And Index_No='1' Order By ID_No Desc  limit 1 ");
		$tampildataReq=mysqli_fetch_array($exeReq);
		//________________________________________________________________________________
        
	  	?>
	<form name="nprf" action="" method="post"  enctype="multipart/form-data"  >
    <?php 
	//Begin CRUD----------------------------------------------------------------------
	$datenow=date("Y-m-d");
	$uploadDirFileMcj	 			= "../img/Mcj/";
	
	if($_POST){
		$ip=$_SERVER['REMOTE_ADDR'];
		$hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);
		date_default_timezone_set("Asia/Jakarta");
		$createddate=date("Y-m-d H:i:s");
		$yymmddhMs=date("YmdHis");
    	$tempFormatNoRequest  	= $_POST['tempFormatNoRequest'];
		$inputAutoRequestNo		= $_POST['inputAutoRequestNo'];
		$inputLastRequestNo		= @$_POST['inputLastRequestNo'];
		$inputThemaNumber	 	= @$_POST['inputThemaNumber']; 
		$inputThemaName 	 	= @$_POST['inputThemaName']; 
		$SelectTypeRequest	 	= @$_POST['SelectTypeRequest'];
		$tempfilelama			= @$_POST['tempfilelama'];
		$inputRemark			= @$_POST['inputRemark'];
 
		$namaFileMcj  			= @$_FILES['FileMcj']['name'];
		$xFileMcj				= explode('.', $namaFileMcj);
		$ekstensiFileMcj    	= strtolower(end($xFileMcj));
		$ukuranFileMcj			= @$_FILES['FileMcj']['size'];
		$file_tmpFileMcj	 	= @$_FILES['FileMcj']['tmp_name'];			
		$ImagelamaFileMcj		= @$tampildata['Mcj'];
	
 		
		if($Save=="Save"){
			include "nprf-autonumber.php";
			$Tanya = mysqli_query($con,"SELECT Request_No FROM tb_nprf WHERE Request_No = '$inputAutoRequestNo' ");
			if (mysqli_num_rows($Tanya) !=0 ) {  
				echo "<div class='form-group has-error'>
				<label class='control-label' for='inputError'>Error Save : Request No already exists in the database *</label></div>";}
			else{
				//membuat Query untuk menyimpan data
				if ($button=="add-nprf-upload"){
					include "nprf-autonumber.php";
					include "nprf-upload-save-new.php";
					include "nprf-save-item-detail.php";
				}else{
					include "nprf-upload-save-new-revisi.php";
					include "nprf-upload-save-item-detail-revisi.php";
				}
				include "nprf-save-workflow.php";
				$exeReq = mysqli_query($con,"UPDATE tb_workflownprf SET Remark_WorkFlow ='$inputRemark' 
				WHERE Request_No ='$inputAutoRequestNo' And Index_No='1' Order By ID_No Desc limit 1");
	
				$message = "Data successfully Save to Draft";
				echo "<script type='text/javascript'>alert('$message');</script>";
				echo"<script>  window.location='../dist/index.php?button=nprf'; </script>";
			}

		}elseif($Save=="Update"){ 
			include "nprf-upload-save-edit.php";
			include "nprf-save-item-detail.php";
			$exeReq = mysqli_query($con,"UPDATE tb_workflowNPRF SET Remark_WorkFlow ='$inputRemark' 
			WHERE Request_No = '".@$_GET['id']."' And Index_No='1' Order By ID_No Desc limit 1");
			$message = "Data successfully Update to database";
			echo "<script type='text/javascript'>alert('$message');</script>";
			echo"<script>  window.location='../dist/index.php?button=nprf'; </script>";

		}elseif($Save=="Cancel"){ 
			include "nprf-upload-save-edit.php";
			mysqli_query($con,"UPDATE tb_nprf SET Status_NPRF='Cancel' WHERE Request_No='$inputAutoRequestNo'");
			mysqli_query($con,"UPDATE tb_inbox SET Request_Status='Cancel' WHERE Request_No='$inputAutoRequestNo'");
				
			$message = "Data successfully Cancel Request";
			echo "<script type='text/javascript'>alert('$message');</script>";
			echo"<script>  window.location='../dist/index.php?button=nprf'; </script>";

			}elseif ($Save=="Revise"){
			//Simpan Status Revise NPRF
			mysqli_query($con,"UPDATE tb_nprf Set Status_NPRF='Revise' WHERE Request_No='$tempFormatNoRequest'");
			//_________________________________________________________________________________________
			$message = "Data successfully Revise";
			echo "<script type='text/javascript'>alert('$message');</script>";
			echo"<script>  window.location='../dist/index.php?button=revise-nprf&id=$tempFormatNoRequest'; </script>";
			 
		}elseif($Send=="Send"){ 
			include "nprf-autonumber.php";
			$Tanya = mysqli_query($con,"SELECT Request_No FROM tb_nprf WHERE Request_No = '$inputAutoRequestNo' ");
			if (mysqli_num_rows($Tanya) !=0 ) {
				//Update Sent NPRF
				include "nprf-upload-save-edit.php";
				include "nprf-save-item-detail.php";
 
				mysqli_query($con,"UPDATE tb_nprf SET Thema_Number='$inputThemaNumber',Status_NPRF='Complete By MCJ',
				UpdatedBy='$username',UpdatedDate='$createddate',UpdatedHostName='$ip : $hostname' 
				WHERE Request_No='$inputAutoRequestNo'");
			}
			else{
				//membuat Query untuk menyimpan data
				if ($button=="add-revise-nprf-upload"){
					include "nprf-upload-save-new-revisi.php";
					include "nprf-upload-save-item-detail-revisi.php";
					}
				else{
					include "nprf-autonumber.php";
					include "nprf-upload-save-new.php";
					include "nprf-save-item-detail.php";}
				mysqli_query($con,"UPDATE tb_nprf SET Status_Last_Document='1',Status_NPRF='Complete By MCJ'
				WHERE Request_No='$inputAutoRequestNo'");
				include "nprf-save-workflow.php";
			}
			
			//Update WorkFlow NPRF
			mysqli_query($con,"UPDATE tb_workflownprf SET StatusWorkFlow='C',ReadWorkFlow='1',Remark_WorkFlow='$inputRemark',
			Approve='$username',ApproveDate='$createddate',Status_Approval='1' WHERE Request_No='$inputAutoRequestNo' ");
			mysqli_query($con,"UPDATE tb_workflownprf SET StatusWorkFlow='S',ReadWorkFlow='1',Remark_WorkFlow='$inputRemark',
			Approve='$username',ApproveDate='$createddate',Status_Approval='1' WHERE Request_No='$inputAutoRequestNo' And Index_No='1'");
			 
			//_________________________________________________________________________________________
			$message = "Data successfully Sent  to Approval";
			echo "<script type='text/javascript'>alert('$message');</script>";
			echo"<script>  window.location='../dist/index.php?button=nprf'; </script>"; 
		}
	}
		//End CRUD----------------------------------------------------------------------
		?>
          <table width="100%" border="0" class="table table-striped" id="dataTables-example" >
            <tr>
              <td width="25%"><span class="form-group">Request No</span></td>
              <td colspan="2"><span class="form-group">
				<input name="tempFormatNoRequest" type="hidden" value="<?php echo $tampildata['Request_No']; ?>">
                <input class="form-control py-4"  name="inputAutoRequestNo" id="inputAutoRequestNo"  maxlength="50" type="text"  
			  placeholder="Auto Request No" readonly="readonly"
			  value="<?php if ($button=="add-nprf-upload") {echo $NomorReq;} elseif ($button=="add-revise-nprf-upload") 
			  {echo substr($tampildata['Request_No'],0,17)."-R".$rev;} else {echo $tampildata['Request_No'];} ?>" />
              </span> </td>
            </tr>
			<tr>
              <td width="25%"><span class="form-group">Last Request No</span></td>
              <td colspan="2"><span class="form-group">
                <input class="form-control py-4"  name="inputLastRequestNo" id="inputLastRequestNo"  maxlength="50" type="text"  
			  placeholder="Last Request No" readonly="readonly" 
			  value="<?php if (@$tampildata['Status_NPRF']=="Complete By MCJ" & $button=="add-revise-nprf-upload") 
			  {echo $tampildata['Request_No'];} else {echo @$tampildata['Last_Request_No'];}?>"/>
              </span> </td>
            </tr>
			<tr>
              <td>Thema Number</td>
              <td colspan="2"><span class="form-group">
                <input class="form-control py-4" name="inputThemaNumber"  maxlength="100" type="text" placeholder="Enter Thema Number"  
				value="<?php if ($_POST) { echo $inputThemaNumber; } else {echo @$tampildata['Thema_Number'];} ?>"
				<?php echo $disabled; ?> />
              </span></td>
            </tr>
            <tr>
              <td><span class="form-group">Thema Name *</span></td>
              <td colspan="2"><span class="form-group">
                <input class="form-control py-4" name="inputThemaName"  maxlength="200" type="text" placeholder="Enter Thema Name"
			   value="<?php if ($_POST) { echo $inputThemaName; } else {echo @$tampildata['Thema_Name'];} ?>" 
			   <?php echo $disabled; ?>/>
              </span></td>
            </tr>
            <tr>
              <td>Request Type *</td>
              <td colspan="2"><select class="form-control" id="SelectTypeRequest" name="SelectTypeRequest"
			  onfocus="DisplayShowHideExport()" onChange="DisplayShowHideExport()" <?php echo $disabled; ?>>
			  <option value="-">Select Request Type </option>
				<option value="Domestic" <?php if ($_POST) {echo $SelectTypeRequest;} elseif (@$tampildata['Type_Request']=='Domestic') {echo "Selected"; }?>>Domestic</option>
            	<option value="Export" <?php if (@$tampildata['Type_Request']=='Export') {echo "Selected";} ?>>Export</option>
              </select>
			  <table name="country" id="country" style="visibility: hidden;" width="100%" border="0">
				  <tr>
					<td colspan="2">Export To 				
					<button type="button" style="padding:0px 0px 0px 0px" class="btn btn-primary" title="Add Country"  
					name="btnCreate" onClick="addRowCountry('country')" <?php echo $disabled; ?>><span class="fa fa-plus" ></span> </button>
					<button type="button" style="padding:0px 0px 0px 0px" class="btn btn-primary" title="Delete Country "  
					id="btnDelete" name="btnDelete" onClick="deleteRowCountry('country')" <?php echo $disabled; ?>><span class="glyphicon glyphicon-trash" ></span></button></td>
				  </tr>
				  <?php
					$exe = mysqli_query($con,"SELECT ID_No,Country,Index_No 
					FROM tb_nprf_country Where Request_No = '".@$tampildata['Request_No']."'   ");
					$no = 1;
					while(@$rowNPRFCountry =mysqli_fetch_array($exe)){
					?>
					<tr>
					<td><input type="checkbox" name="chkdetail[]" id="chkdetail[]" <?php echo $disabled; ?>></td>
					<td><select class="form-control" id="selectCountry[]" name="selectCountry[]" <?php echo $disabled; ?> >
						<option value="-" >Select Country</option>
						<?php
							$div = mysqli_query($con,"SELECT Country FROM tb_trading_partner Where Status<>0 ");
							while($b = mysqli_fetch_array($div)){
								if($rowNPRFCountry['Country'] == $b['Country']){
									$cek = 'Selected';
								}elseif($selectCountry == $b['Country']){
									$cek = 'Selected';
								}else{
									$cek = '';
								}
								echo"<option value='".$b['Country']."' $cek>".$b['Country']."</option>";
							}
						?>
					  </select>
					</td>
					</tr>
					<?php $no++;} ?>
				  </table>
			  </td>
            </tr>

            <tr>
              <td colspan="3" style="padding:2px 2px 2px 2px"><table name="nprfitemdetail" id="nprfitemdetail"  width="100%" border="1" class="table table-striped table-bordered table-hover" >
			   
				  <tr>
					<td colspan="12" align="left">Proposed item(s)
<button type="button" style="padding:0px 0px 0px 0px" class="btn btn-primary" title="Add Item Detail"  
					name="btnCreateFNIM" onClick="addRow('nprfitemdetail')" <?php echo $disabled; ?>>
					<span class="fa fa-plus" title="Add Item Detail" ></span> </button>
					<button type="button" style="padding:0px 0px 0px 0px" class="btn btn-primary" title="Delete Item Detail "  
					id="btnDeleteItemDetail" name="btnDeleteItemDetail" onClick="deleteRow('nprfitemdetail')" <?php echo $disabled; ?>>
					<span class="glyphicon glyphicon-trash" title="Delete Item Detail" ></span></button>					</td>
				  </tr>
				  <tr valign="bottom" align="center" bgcolor="#999999">
					<th width="1%"></th>
					<th width="10%">Item No. (Product Development Department)</th>
					<th width="20%">*Item name (tentative name)</th>
					<th width="7%">Status</th>
					<th width="12%">*Volume</th>
					<th width="10%">Suggested Retail Price(HET)</th>
					<th width="5%">HPJ (Domestic)</th>
					<th width="5%">Requested C&F/CIF/FOB/ Price (EXPORT)</th>
					<th width="8%">COG PRICE</th>
					<th width="5%">COGS(%)</th>
					<th width="8%">Initial Introduction</th>
					<th width="8%">Annual Sales</th>
				  </tr>
				  <?php
					$exe = mysqli_query($con,"SELECT ID_No,MCJ_Item_No,New_Product,Status_Product,NamaCurrency,
					Price,NamaCurrencyHPJ,HPJ,NamaCurrencyC_FPrice,
					Price,HPJ,C_FPrice,NamaCurrencyTargetCOGS,Target_COGS,COGS,Sales_3Mth,Introduction,Satuan_Sales1Yr,Sales_1yr,Index_No 
					FROM tb_nprf_Item_detail Where Request_No = '".@$tampildata['Request_No']."'   ");
					$no = 1;
					while(@$rowNPRFDetail =mysqli_fetch_array($exe)){
					?>
				  <tr>
					<td><input type="checkbox" name="chkdetail[]" id="chkdetail[]">
					<input type="hidden" name="tempItemDetail[]" id="tempItemDetail[]"
					value="<?php echo $rowNPRFDetail['ID_No']; ?>" ></td>
					<td style="padding:8px 2px 2px 2px"><input type="text" name="InputMCJItemNo[]" id="InputMCJItemNo[]" class="form-control"
						style="padding:2px 2px 2px 2px" value="<?php echo $rowNPRFDetail['MCJ_Item_No']; ?>" 
						<?php echo $disabled; ?>></td>
					<td style="padding:8px 2px 2px 2px">
					<textarea cols="4" id="InputNewProduct[]"  name="InputNewProduct[]"  
			 		class="form-control py-4" placeholder="Enter Product Competitor" 
					<?php echo $disabled; ?>><?php echo $rowNPRFDetail['New_Product']; ?></textarea></td>
					<td style="padding:8px 2px 2px 2px">
						<select style="padding:2px 2px 2px 2px"
						class="form-control"  id="InputStatusProduct[]" name="InputStatusProduct[]"
						 required <?php echo $disabled; ?>>
						<option value="New" <?php if (@$rowNPRFDetail['Status_Product']=='New') {echo "Selected"; }?>>New </option>
            			<option value="Renewal" <?php if (@$rowNPRFDetail['Status_Product']=='Renewal') {echo "Selected";} ?>>Renewal</option>
              			</select>					</td>
					<td style="padding:8px 2px 2px 2px">
					 <table name="<?php echo "nprfnetto".$rowNPRFDetail['ID_No']; ?>" 
					 id="<?php echo "nprfnetto".$rowNPRFDetail['ID_No']; ?>"  
					 width="100%" border="1" class="table table-striped table-bordered table-hover">
				  	 <tr>
						<td colspan="3" align="left" style="padding:2px 2px 2px 2px">
							<button type="button" style="padding:0px 0px 0px 0px" class="btn btn-primary"    
							name="btnCreateNetto"
							onClick="addRowNetto('<?php echo "nprfnetto".$rowNPRFDetail['ID_No']; ?>','<?php echo $rowNPRFDetail['ID_No']; ?>')" 
							<?php echo $disabled; ?>>
							<span class="fa fa-plus" title="Add Netto" ></span> </button>
							<button type="button" style="padding:0px 0px 0px 0px" class="btn btn-primary"   
							id="btnDeleteNetto" name="btnDeleteNetto" 
							onClick="deleteRowNetto('<?php echo "nprfnetto".$rowNPRFDetail['ID_No']; ?>')" <?php echo $disabled; ?>>
							<span class="glyphicon glyphicon-trash" title="Delete Netto" ></span></button>						</td>
				  	</tr>
					<?php
					$exenetto = mysqli_query($con,"SELECT ID_No,ID_No_ItemDetail,Isi_Net,Netto,Index_No 
					FROM tb_nprf_item_detail_netto Where Request_No = '".$tampildata['Request_No']."' And
					ID_No_ItemDetail='".$rowNPRFDetail['ID_No']."'  ");
					while(@$rowNPRFDetailNetto =mysqli_fetch_array($exenetto)){
					?>
				  	<tr>
						<td width="1%" style="padding:7px 2px 2px 2px"><input type="checkbox" 
							name="chkNetto<?php echo $rowNPRFDetailNetto['ID_No_ItemDetail']; ?>[]" 
							id="chkNetto<?php echo $rowNPRFDetailNetto['ID_No_ItemDetail']; ?>[]">
							<input type="hidden" name="tempNetto<?php echo $rowNPRFDetailNetto['ID_No_ItemDetail']; ?>[]" 
							id="tempNetto<?php echo $rowNPRFDetailNetto['ID_No_ItemDetail']; ?>[]"
							value="<?php echo $rowNPRFDetailNetto['ID_No_ItemDetail']; ?>" >						</td>
						<td width="50%" style="padding:4px 2px 2px 2px">
							<input type="text" name="InputNettoDetail<?php echo $rowNPRFDetailNetto['ID_No_ItemDetail']; ?>[]" 
							id="InputNettoDetail<?php echo $rowNPRFDetailNetto['ID_No_ItemDetail']; ?>[]" class="form-control"
							style="padding:2px 2px 2px 2px;text-align:right;" value="<?php echo $rowNPRFDetailNetto['Isi_Net']; ?>" 
							onkeyup="return angka(this);" <?php echo $disabled; ?> required>						</td>
						<td width="41%" style="padding:4px 2px 2px 2px">
						<select style="padding:2px 2px 2px 2px" 
						name="SelectNettoDetail<?php echo $rowNPRFDetailNetto['ID_No_ItemDetail']; ?>[]" 
						id="SelectNettoDetail<?php echo $rowNPRFDetailNetto['ID_No_ItemDetail']; ?>[]" <?php echo $disabled; ?> class="form-control">
						 <?php
							$div = mysqli_query($con,"SELECT Netto FROM tb_netto");
							while($b = mysqli_fetch_array($div)){
								if(@$rowNPRFDetailNetto['Netto'] == $b['Netto']){
									$cek = 'Selected';	}
								else{
									$cek = '';	}
							echo"<option value='".$b['Netto']."' $cek>".$b['Netto']."</option> ";}?>
						  </select>						</td>
				  	</tr>
				  	<?php $no++;} ?>
				  	</table>					</td>
					<td style="padding:8px 2px 2px 2px">
						<select style="padding:2px 2px 2px 2px" name="selectMataUang[]" 
						id="selectMataUang[]" <?php echo $disabled; ?> class="form-control">
						<option value="">Currency</option>
						 <?php
							$div = mysqli_query($con,"SELECT NamaCurrency FROM tb_currency  Where Status='1'");
							while($b = mysqli_fetch_array($div)){
								if(@$rowNPRFDetail['NamaCurrency'] == $b['NamaCurrency']){
									$cek = 'Selected';	}
								elseif($Selectbulan == $b['NamaCurrency']){
									$cek = 'Selected';	}
								else{
									$cek = '';	}
							echo"<option value='".$b['NamaCurrency']."' $cek>".$b['NamaCurrency']."</option> ";}
						?>
						</select>
						<input type="text" name="InputPrice[]" id="InputPrice[]" class="form-control"
						style="padding:2px 2px 2px 2px;text-align:right;" onKeyUp="return angka(this);"
						
						title="Enter Price Exemple 1.000,25"
						
						value="<?php if ($rowNPRFDetail['Price']==0) {echo "";} else { echo number_format(@$rowNPRFDetail['Price'], 2, ",", ".");} ?>"  
						<?php echo $disabled; ?>></td>
					<td style="padding:8px 2px 2px 2px">
						<select style="padding:2px 2px 2px 2px" name="selectMataUangC_FPrice[]" 
						id="selectMataUangC_FPrice[]" <?php echo $disabled; ?> class="form-control">
						<option value="">Currency</option>
						 <?php
							$div = mysqli_query($con,"SELECT NamaCurrency FROM tb_currency  Where Status='1'");
							while($b = mysqli_fetch_array($div)){
								if(@$rowNPRFDetail['NamaCurrencyC_FPrice'] == $b['NamaCurrency']){
									$cek = 'Selected';	}
								elseif($Selectbulan == $b['NamaCurrency']){
									$cek = 'Selected';	}
								else{
									$cek = '';	}
							echo"<option value='".$b['NamaCurrency']."' $cek>".$b['NamaCurrency']."</option> ";}
						?>
						</select>
						<input type="text" name="InputHPJ[]" id="InputHPJ[]" class="form-control"
						style="padding:2px 2px 2px 2px;text-align:right;" onKeyUp="return angka(this);" 
						title="Enter HPJ Exemple 1.000,25"
						value="<?php if ($rowNPRFDetail['HPJ']==0) {echo "";} else { echo number_format(@$rowNPRFDetail['HPJ'], 2, ",", ".");} ?>"  
						<?php echo $disabled; ?>></td>
					<td style="padding:8px 2px 2px 2px">
						<select style="padding:2px 2px 2px 2px" name="selectMataUangTargetCOGS[]" 
							id="selectMataUangTargetCOGS[]" <?php echo $disabled; ?> class="form-control">
							<option value="">Currency</option>
							 <?php
							$div = mysqli_query($con,"SELECT NamaCurrency FROM tb_currency  Where Status='1'" );
							while($b = mysqli_fetch_array($div)){
								if(@$rowNPRFDetail['NamaCurrencyTargetCOGS'] == $b['NamaCurrency']){
									$cek = 'Selected';	}
								elseif($Selectbulan == $b['NamaCurrency']){
									$cek = 'Selected';	}
								else{
									$cek = '';	}
							echo"<option value='".$b['NamaCurrency']."' $cek>".$b['NamaCurrency']."</option> ";}
						?>
						</select>
						<input type="text" name="InputC_FPrice[]" id="InputC_FPrice[]" class="form-control"
						style="padding:2px 2px 2px 2px;text-align:right;" onKeyUp="return angka(this);" 
						title="Enter Requested C&F/CIF/FOB/ Price 1.000,25"
						value="<?php if ($rowNPRFDetail['C_FPrice']==0) {echo "";} else { echo number_format(@$rowNPRFDetail['C_FPrice'], 2, ",", ".");} ?>"  
						<?php echo $disabled; ?>></td>
					<td style="padding:8px 2px 2px 2px;">
						<select style="padding:2px 2px 2px 2px" name="selectMataUangTargetCOGS[]" 
							id="selectMataUangTargetCOGS[]" <?php echo $disabled; ?> class="form-control">
							<option value="">Currency</option>
							 <?php
							$div = mysqli_query($con,"SELECT NamaCurrency FROM tb_currency  Where Status='1'" );
							while($b = mysqli_fetch_array($div)){
								if(@$rowNPRFDetail['NamaCurrencyTargetCOGS'] == $b['NamaCurrency']){
									$cek = 'Selected';	}
								elseif($Selectbulan == $b['NamaCurrency']){
									$cek = 'Selected';	}
								else{
									$cek = '';	}
							echo"<option value='".$b['NamaCurrency']."' $cek>".$b['NamaCurrency']."</option> ";}
						?>
						</select>
						<input type="text" name="InputTargetCOGS[]" id="InputTargetCOGS[]" class="form-control"
						style="padding:2px 2px 2px 2px;text-align:right;" onKeyUp="return angka(this);" 
						title="Enter Target COGS Exemple 1.000,25"
						value="<?php if ($rowNPRFDetail['Target_COGS']==0) {echo "";} else { echo number_format(@$rowNPRFDetail['Target_COGS'], 2, ",", ".");} ?>"
						<?php echo $disabled; ?>></td>
					<td style="padding:8px 2px 2px 2px;">
						<input type="text" name="InputCOGS[]" id="InputCOGS[]" class="form-control"
						style="padding:2px 2px 2px 2px;text-align:right;" onKeyUp="return angka(this);"
						title="Enter COGS Exemple 1.000,25"
						value="<?php if ($rowNPRFDetail['COGS']==0) {echo "";} else { echo number_format(@$rowNPRFDetail['COGS'], 2, ",", ".");} ?>"
						<?php echo $disabled; ?>></td>
					<td style="padding:8px 2px 2px 2px;">				
						<select style="padding:2px 2px 2px 2px" class="form-control" id="InputSales3Mth[]" name="InputSales3Mth[]" required <?php echo $disabled; ?>>
							<option value="Dzn" <?php if (@$rowNPRFDetail['Sales_3Mth']=='Dzn') {echo "Selected"; }?>>Dzn</option>
							<option value="Pcs" <?php if (@$rowNPRFDetail['Sales_3Mth']=='Pcs') {echo "Selected";} ?>>Pcs </option>
 						</select>
						<input type="text" name="InputIntroduction[]" id="InputIntroduction[]" class="form-control"
						style="padding:2px 2px 2px 2px;text-align:right;" onKeyUp="return angka(this);"
						title="Enter InputIntroduction Exemple 1.000,25"
						value="<?php if ($rowNPRFDetail['Introduction']==0) {echo "";} else { echo number_format(@$rowNPRFDetail['Introduction'], 2, ",", ".");} ?>"
						<?php echo $disabled; ?>>
					</td>
					<td style="padding:8px 2px 2px 2px;">
						<select style="padding:2px 2px 2px 2px" class="form-control" id="selectSatuanSales1Yr[]" name="selectSatuanSales1Yr[]" required <?php echo $disabled; ?>>
							<option value="Dzn" <?php if (@$rowNPRFDetail['Satuan_Sales1Yr']=='Dzn') {echo "Selected"; }?>>Dzn</option>
							<option value="Pcs" <?php if (@$rowNPRFDetail['Satuan_Sales1Yr']=='Pcs') {echo "Selected";} ?>>Pcs </option>
 						</select>
						<input type="text" name="InputSales1Yr[]" id="InputSales1Yr[]" class="form-control"
						style="padding:2px 2px 2px 2px;text-align:right;"onkeyup="return angka(this);"
						title="Enter Sales (1 Yrs)(pcs) Exemple 1.000,25"
						value="<?php if ($rowNPRFDetail['Sales_1yr']==0) {echo "";} else { echo number_format(@$rowNPRFDetail['Sales_1yr'], 2, ",", ".");} ?>"
						<?php echo $disabled; ?>>
					</td>
				  </tr>
				  <?php $no++;} ?>
				  </table>			  </td>
            </tr>
 
            <tr>
              <td>Remark *</td>
              <td colspan="2"><div class="form-group"> <textarea cols="4" id="inputRemark" name="inputRemark"  class="form-control py-4" 
				placeholder="Enter Remark" <?php echo $disabled; ?>><?php if ($_POST) { echo $inputRemark; } else {echo @$tampildata['Remark'];} ?></textarea></div>			  </td>
            </tr>
 
			<tr>
              <td colspan="3"></td>
            </tr>
			 			<tr>
              <td>NPRF File *</td>
              <td width="40" ><input class="form" id="FileMcj" name="FileMcj"  type="file" accept="application/pdf"
			   <?php if(@$tampildata['Status_NPRF']<> "Complete By MCJ")  {echo $disabled;} ?>/>
			   <input type="hidden" name="tempfilelama" id="tempfilelama" value="<?php echo @$tampildata['Mcj'];?>"></td>
			   
			   <td><div id="PdfFileMcj"></div>
			 
			  <?php if (!empty(@$tampildata['Mcj'])){?>
			  	<img height="20" width="20" src=../img/pdf.png  title="Preview Pdf <?php echo $tampildata['Mcj'];?>"
				onClick="popupwindow('../config/open-pdf.php?folder=<?php echo $uploadDirFileMcj; ?>&pdfname=mcj&kd=<?php echo $tampildata['Request_No']; ?>&page=nprf','Preview Pdf','700','1000');">
			  <?php }  ?>			  </td>
            </tr>
 
			</fieldset>
          </table>
		  <button type="submit" name="Send" value="Send"  onClick="return checkSendApproval(nprf)" 
		  class="btn btn-primary" 
		  <?php if (@$tampildata['Status_NPRF']<>"Complete By MCJ" || $button=="add-revise-nprf-upload")  
		  {echo $disabled;} else {echo "disabled='disabled'";} ?>>Complete</button>
		  <?php if (@$tampildata['Status_NPRF']<>"Cancel")  {?>
		  <button type="submit" name="Save" 
		  value="<?php if ($button=="add-nprf-upload" || $button=="add-revise-nprf-upload") {echo"Save";} else {echo"Update";}  ?>"
		  onClick="return checkDraft()" class="btn btn-primary" 
		  <?php if (@$tampildata['Status_NPRF']=="Complete By MCJ")  {echo $disabled;} ?>>Draft  </button>
		  <?php ;} ?>
		  <?php if (@$tampildata['Status_NPRF']=="Complete By MCJ" 
		  & $button!="add-revise-nprf-upload" & @$tampildata['Status_Last_Document']=="1")  {?>
		  <button type="submit" name="Save" value="Cancel" onClick="return checkCancel()" 
		  class="btn btn-primary">Cancel Request</button>
	      <?php ;} ?>
	
		   
		  <a class="btn btn-primary" href="../dist/index.php?button=nprf" title="Back Format No Request">Back</a> 
	  </form>
	  </div>
      </div>
	 </div>
    </main> 
    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="../vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="../vendor/datatables-responsive/dataTables.responsive.js"></script>

 	
<script language="JavaScript" type="text/javascript">

function checkDraft(){
	return confirm('Are you sure you want to Save Draft this data?');
}	

	function checkSendApproval(form){
	var rowProposedItem = document.getElementById('nprfitemdetail').rows.length; 

	if (form.inputAutoRequestNo.value == ""){
    	alert("Request No masih kosong!");
    	form.inputAutoRequestNo.focus();
    	return (false);  		}
	else if (form.inputThemaNumber.value == ""){
    	alert("Thema Number masih kosong!" );
    	form.inputThemaNumber.focus();
    	return (false);  		}
	else if (form.inputThemaName.value == ""){
    	alert("Thema Name masih kosong!" );
    	form.inputThemaName.focus();
    	return (false);  		}
	else if (form.SelectTypeRequest.value == "-"){
    	alert("Request Type masih kosong!");
    	form.SelectTypeRequest.focus();
    	return (false);  		}		
	else if(rowProposedItem <=2  ) {
		alert('Proposed Item Item masih kosong');
		return (false);  		}			
	else if (form.inputRemark.value == ""){
		alert("Remark masih kosong!");
		form.inputRemark.focus();
		return (false);  		}
	 
	<?php if (empty(@$tampildata['Mcj'])){?>
	else if (form.FileMcj.value == ""){
		alert("File masih kosong!");
		form.FileMcj.focus();
		return (false);  		}
	<?php } ?>	
		return confirm('Are you sure you want to Send Approval?');
	}
	


	function checCancel(form){
		return confirm('Are you sure you want to Cancel Request this data?');
	}

	</script>
	 
 
	</body>
</html>
 

