	<?php $Send		= @$_POST['Send']; ?>
	<?php $Save		= @$_POST['Save']; ?>
<script language="JavaScript">
	
	/* Removes the clear button from date inputs */
input[type="date"]::-webkit-clear-button {
    display: none;
}

	/* Removes the spin button */
	input[type="date"]::-webkit-inner-spin-button { 
		display: none;
	}
	
	/* Always display the drop down caret */
	input[type="date"]::-webkit-calendar-picker-indicator {
		color: #2c3e50;
	}
	
	/* A few custom styles for date inputs */
	input[type="date"] {
		appearance: none;
		-webkit-appearance: none;
		color: #95a5a6;
		font-family: "Helvetica", arial, sans-serif;
		font-size: 18px;
		border:1px solid #ecf0f1;
		background:#ecf0f1;
		padding:5px;
		display: inline-block !important;
		visibility: visible !important;
	}
	
	input[type="date"], focus {
		color: #95a5a6;
		box-shadow: none;
		-webkit-box-shadow: none;
		-moz-box-shadow: none;
	}
</script>
<script language="JavaScript">
	function setFocus(){
	document.mpr.SelectTypeRequest.focus();
	document.mpr.selectReq.focus();
	}
	function DisplayShowHideExport()
	  {
	  if (document.mpr.SelectTypeRequest.value == "Export")
	  {document.getElementById("selectCountry").style.visibility = 'visible';}
	
	  else
	  {document.getElementById("selectCountry").style.visibility = 'hidden';} 
	  }
</script>

<script type="text/javascript">
	function angka(evt){
		var charCode = (evt.which) ? evt.which : event.keyCode
		if ((charCode < 48 || charCode > 57)&&charCode>188)  {
			return false;
		}
		return true;
	}
</script>

<script type="text/javascript">
		function addRowfile(tableID) {
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
			var filepdf = document.createElement('input');
			filepdf.setAttribute('class',"form-control");
			filepdf.setAttribute('style',"padding:2px 2px 2px 2px");
			filepdf.setAttribute('title',"Input Attachment");
			filepdf.setAttribute('type',"file");
			filepdf.setAttribute('accept',"application/pdf"); 
			filepdf.setAttribute('name',"InputFile[]");
			filepdf.setAttribute('id',"InputFile[]");
			cell2.appendChild(filepdf);
			
			var cell3 = row.insertCell(2);
		
			var InputName = document.createElement('input');
			InputName.setAttribute('class',"form-control");
			InputName.setAttribute('style',"padding:2px 2px 2px 2px");
			InputName.setAttribute('type',"text");
			InputName.setAttribute('title',"Note");
			InputName.setAttribute('name',"InputNameFile[]");
			InputName.setAttribute('id',"InputNameFile[]");
			cell3.appendChild(InputName);	
		}

		function deleteRowfile(tableID) {
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
	function popupwindow(url, title, h, w) {
	var left = (screen.width/2)-(w/2);
	var top = (screen.height/2)-(h/2);
	return window.open(url, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
		  return false;
		} 
		
	function changeparent(){
	window.opener.location.reload();
    window.close();
	}
</script>

<?php include "mpr-javascrift.php"; ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Static Navigation - SB Admin</title>
        <link href="../css/styles.css" rel="stylesheet" />
		<!-- Bootstrap Core CSS -->
		<link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	
		<!-- MetisMenu CSS -->
		<link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
	
	
	
 
	<!-- CSS untuk bootstrap -->
	<link rel="stylesheet" href="../../vendor/bootstrap/css/bootstrap.css" type="text/css">
	<!-- CSS untuk bootstrap datetimepicker -->
	<link rel="stylesheet" href="../../vendor/bootstrap/css/bootstrap-select.min.css" type="text/css">  
	
	<script src="../../vendor/jquery/jquery-latest.js" type="text/javascript"></script>
	</head>
	<body onload='setFocus();' > 
	<main> 
    <div class="container-fluid"> 
      <h3 class="mt-4"><?php if ($button=="add-mpr") {echo "New Master Product Request (MPR)";}
	   else  {echo "Edit Master Product Request (MPR)";} ?> </h3>
	    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="../dist/index.php?button=dashboard">Dashboard</a></li>
		<li class="breadcrumb-item"><a href="../dist/index.php?button=mpr">Master Product Request (MPR)</a></li>
        <li class="breadcrumb-item active"><?php if ($button=="add-mpr") {echo "New Master Product Request (MPR)";} 
		else  {echo "Edit Master Product Request (MPR)";} ?> </li>
      </ol>
 	<div class="card mb-4">
	    <div class="card-header"> </div>

        <div class="card-body"> 
			
        <?php
		include "../config/connect_sql.php";
		include "mpr-autonumber.php";
      	$exe =mysqli_query($con,"SELECT ID_No,Request_No,Project_Name,Type_Request,Country,FNIM_Code,Type,Brand,Bisnis,Category,
		Series,Segmentation,CustomerCode,Royalty,KeteranganProduct,NoBarcodeExisting,CustomerCodeFormula,RoyaltyFormula,
		NamaProductSingkat,KelompokStok,Flex,SAP,Status_MPR,Remark,RemarkafterComplete FROM tb_mpr where Request_No = '".@$_GET['id']."' ");
        $tampildata=mysqli_fetch_array(@$exe);
		$statusReqMPR=@$tampildata['Status_MPR'];
		//________________________________________________________________________________StatusMPR disabled
		if (@$tampildata['Status_MPR']<>"Draft" && @$tampildata['Status_MPR']<>"" && @$tampildata['Status_MPR']=="Complete") {$disabled="disabled";} else{$disabled="";}

		//________________________________________________________________________________WORKFLOW MPR
		$exeReq = mysqli_query($con,"Select NameApproval,OnBehalf,Remark_WorkFlow,Index_No FROM tb_workflowNPRF 
		WHERE Request_No = '".@$_GET['id']."' And Index_No='1' limit 1");
		$tampildataReq=mysqli_fetch_array($exeReq);
		//________________________________________________________________________________
        
	  	?>
	<form name="mpr" id="mpr" action="" method="post"  enctype="multipart/form-data"  >
    <?php 
	//Begin CRUD----------------------------------------------------------------------
	$datenow						= date("Y-m-d");
	$file	 						= "../file/";

	if($_POST){
		$ip=$_SERVER['REMOTE_ADDR'];
		$hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);
		date_default_timezone_set("Asia/Jakarta");
		$createddate=date("Y-m-d H:i:s");
    	$tempFormatNoRequest  	= $_POST['tempFormatNoRequest'];
		$inputAutoRequestNo		= $_POST['inputAutoRequestNo'];
		$inputProjectName 	 	= @$_POST['inputProjectName']; 
		$SelectTypeRequest	 	= @$_POST['SelectTypeRequest'];
		$selectCountry			= @$_POST['selectCountry'];
		$selectReq			 	= @$_POST['selectReq'];
		$InputType				= @$_POST['InputType'];
		$InputBrand				= @$_POST['InputBrand'];
		$InputBisnis		 	= @$_POST['InputBisnis'];
		$InputCategory		 	= @$_POST['InputCategory'];
		$InputSeries			= @$_POST['InputSeries']; 
		$InputSegmentation		= @$_POST['InputSegmentation'];
		$selectCustomerCode	 	= @$_POST['selectCustomerCode'];
		$InputRoyalty		 	= @$_POST['InputRoyalty'];
		$InputKeteranganProduct	= @$_POST['InputKeteranganProduct'];
		$InputBarcodeExisting	= @$_POST['InputBarcodeExisting'];
		$selectCustomerCodeFormula= @$_POST['selectCustomerCodeFormula'];
		$InputRoyaltyFormula 	= @$_POST['InputRoyaltyFormula'];
		$inputNamaProductSingkat= @$_POST['inputNamaProductSingkat'];
		$inputKelompokStok	 	= @$_POST['inputKelompokStok'];
		$inputRemark			= @$_POST['inputRemark'];
		$inputWorkflowRemark	= @$_POST['inputWorkflowRemark'];
		$inputRemarkafterComplete= @$_POST['inputRemarkafterComplete'];
		if (!@$_POST['Flex']){$valFlex=0;} else {$valFlex=1;}
		if (!@$_POST['SAP']){$valSAP=0;} else {$valSAP=1;}
		if($Save=="Save"){
			include "MPR-autonumber.php";
			$Tanya = mysqli_query($con,"SELECT Request_No FROM tb_mpr WHERE Request_No = '$inputAutoRequestNo' ");
			if (mysqli_num_rows($Tanya) !=0 ) {  
				echo "<div class='form-group has-error'>
				<label class='control-label' for='inputError'>Error Save : Request No already exists in the database *</label></div>";}
			else{
				//membuat Query untuk menyimpan data
				include "mpr-autonumber.php";
				include "mpr-save-new.php";
				include "mpr-save-detail-new.php";
				include "mpr-save-workflow.php";

				$exeReq = mysqli_query($con,"UPDATE tb_workflowNPRF SET Remark_WorkFlow ='$inputWorkflowRemark' 
				WHERE Request_No ='$inputAutoRequestNo' And Index_No='1' limit 1");
	
				$message = "Data successfully Save to Draft";
				echo "<script type='text/javascript'>alert('$message');</script>";
				echo"<script>  window.location='../dist/index.php?button=mpr'; </script>";
				}
			}
		elseif($Save=="Update"){ 
			//membuat Query untuk update data
			include "mpr-save-edit.php";		
			include "MPR-save-detail-new.php";
			$exeReq = mysqli_query($con,"UPDATE tb_workflowNPRF SET Remark_WorkFlow ='$inputWorkflowRemark' 
			WHERE Request_No = '".@$_GET['id']."' And Index_No='1' limit 1");
			
			$message = "Data successfully Update to database";
			echo "<script type='text/javascript'>alert('$message');</script>";
			echo"<script>  window.location='../dist/index.php?button=mpr'; </script>";
		}
		elseif($Save=="Cancel"){ 
			include "MPR-save-edit.php";
			$exe=mysqli_query($con,"SELECT ID_No,ID_NoFNIMDetail FROM tb_mpr_detail	Request_No='$inputAutoRequestNo'");
			while(@$rowFNIM=mysqli_fetch_array($exe)){	
				mysqli_query($con,"UPDATE tb_fnim_detail SET ApplyMPR='0' WHERE ID_No='".$rowFNIM['ID_NoFNIMDetail']."' ");
			}
			mysqli_query($con,"UPDATE tb_mpr SET Status_MPR='Cancel' WHERE Request_No='$inputAutoRequestNo'");
			mysqli_query($con,"UPDATE tb_inbox SET Request_Status='Cancel' WHERE Request_No='$inputAutoRequestNo'");
			
			$message = "Data successfully Cancel Request";
			echo "<script type='text/javascript'>alert('$message');</script>";
			echo"<script>  window.location='../dist/index.php?button=mpr'; </script>";
			}
		elseif($Send=="Send"){ 
			include "MPR-autonumber.php";
			$Tanya = mysqli_query($con,"SELECT Request_No FROM tb_mpr WHERE Request_No = '$inputAutoRequestNo' ");
			if (mysqli_num_rows($Tanya) !=0 ) {
				//Update Sent MPR
				include "MPR-save-edit.php";
				include "MPR-save-detail-new.php";
				mysqli_query($con,"UPDATE tb_mpr SET Status_MPR='Sent',
				UpdatedBy='$username',UpdatedDate='$createddate',UpdatedHostName='$ip : $hostname' 
				WHERE Request_No='$inputAutoRequestNo'");
			}
			else{
				//membuat Query untuk menyimpan data
				include "MPR-autonumber.php";
				include "MPR-save-new.php";
				include "MPR-save-detail-new.php";
				mysqli_query($con,"UPDATE tb_mpr SET Status_MPR='Sent' WHERE Request_No='$inputAutoRequestNo'");
				include "MPR-save-workflow.php";
				
			}
			
			//Update WorkFlow MPR
			mysqli_query($con,"UPDATE tb_workflowNPRF SET StatusWorkFlow='S',ReadWorkFlow='1',Remark_WorkFlow='$inputWorkflowRemark',
			Approve='$username',ApproveDate='$createddate' WHERE Request_No='$inputAutoRequestNo' And Index_No='1'");
			
			//Send Email Notification for Approval 2-------------------------------------------------
			$exeNext = mysqli_query($con,"Select NameApproval,OnBehalf,WorkFlowMenu FROM tb_workflowNPRF 
			WHERE Request_No='$inputAutoRequestNo' And Index_No='2' ");
        	$tampildataNext=mysqli_fetch_array($exeNext);
			$app1=@$tampildataNext['NameApproval'];
			$app2=@$tampildataNext['OnBehalf'];
			$remark=$inputWorkflowRemark;
			$id=$inputAutoRequestNo;
			$page="mpr-app";
			$WorkFlowMenu="MPR";
			$Confirm=="Approve";
			require ("../config/emailapp.php");
			//Simpan Inbox
			mysqli_query($con,"Insert INTO tb_inbox (Request_No,Request_Date,Thema_Name,Request_Type,Request_Status,
			NameApproval,OnBehalf,ReadInbox,Remark,WorkFlowMenu) values ('$inputAutoRequestNo','$createddate','$inputProjectName','$SelectTypeRequest',
			'W','".$tampildataNext['NameApproval']."','".$tampildataNext['OnBehalf']."','0','$inputRemark','MPR')");
			
			//_________________________________________________________________________________________
			$message = "Data successfully Sent  to Approval";
			echo "<script type='text/javascript'>alert('$message');</script>";
			echo"<script>  window.location='../dist/index.php?button=mpr'; </script>";
		}
	}
		//End CRUD----------------------------------------------------------------------
		?>
          <table width="100%" border="0" class="table table-striped" id="dataTables-example" >
            <tr>
              <td width="1%"><span class="form-group">I.</span></td>
              <td width="15%"><span class="form-group"> Request No</span></td>
              <td colspan="3"><span class="form-group">
				<input name="tempFormatNoRequest" type="hidden" value="<?php echo @$tampildata['Request_No']; ?>">
                <input class="form-control py-4"  name="inputAutoRequestNo" id="inputAutoRequestNo"  maxlength="50" type="text"  
			  placeholder="Auto Request No" readonly="readonly" value="<?php if ($button=="add-mpr") {echo $NomorReq;} else {echo $tampildata['Request_No'];} ?>" />
              </span> </td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td><span class="form-group">Thema Name *</span></td>
              <td width="25%"><div class="form-group d-flex align-items-center justify-content-between mt-0 mb-1">
                <input class="form-control"  id="inputProjectName" name="inputProjectName" 
			  maxlength="50" type="text" placeholder="Enter Project Name" readonly="readonly"
			  value="<?php if ($_POST) { echo $inputProjectName; } else {echo @$tampildata['Project_Name'];} ?>" 
			   <?php echo $disabled; ?>/>
                &nbsp;<button type="button" style="padding:2px 4px 4px 4px" 
			   class="btn btn-primary" title="Search Project Name"  
					name="btnsearch" 
					onClick="popupwindow('mpr/project-name-popup.php?id=mpr','Search Project Name','600','700');" <?php echo $disabled; ?>>
					<span class="glyphicon glyphicon-search" ></span> </button>
				</div>			  </td>
			  <td width="15%">&nbsp;</td>
			  <td width="30%">
            	<input type="text" class="form-control" name="selectReq" id="selectReq" 
				placeholder="FNIM Code"  onChange="setFocus(),get_detaildata(),DisplayShowHideExport()" 
				onFocus="setFocus(),get_detaildata(),DisplayShowHideExport()"   
				value="<?php if ($_POST) { echo @$selectReq; } else {echo @$tampildata['FNIM_Code'];} ?>"
				readonly="readonly" >			  </td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td><span class="form-group">Category 2 [Type] * </span></td>
              <td>
			  <!--input class="form-control"  id="InputType" name="InputType" 
			  maxlength="50" type="text" placeholder="Enter Type"
			  value="<?php if ($_POST) { echo $InputType; } else {echo $tampildata['Type'];} ?>" 
			   <?php echo $disabled; ?>--> 
			  <select class="form-control" id="InputType" name="InputType" <?php echo $disabled; ?>>
					<option value="-" >Select Type</option>
					<?php
			  			$exe = mysqli_query($con,"SELECT NamaType from tb_type Where Status ='1'" );
						while(@$row =mysqli_fetch_array($exe)){
							if($tampildata['Type'] == $row['NamaType']){
								$cek = 'Selected';
							}elseif($InputType == $row['NamaType']){
								$cek = 'Selected';
							}else{
								$cek = '';
							}
							echo"<option value='".$row['NamaType']."' $cek>".$row['NamaType']."</option>";
						}
					?>
			  </select>
			  </td>
	          <td><span class="form-group">Category 4 [Market] *</span></td>
	          <td><div class="form-group d-flex align-items-center justify-content-between mt-0 mb-0">
			  <select class="form-control" id="SelectTypeRequest" name="SelectTypeRequest" 
			  onfocus="DisplayShowHideExport()" onChange="DisplayShowHideExport(),setFocus()" <?php echo $disabled; ?>>
			  	<option value="-">Select Market </option>
				<option value="Domestic" <?php if ($_POST) {echo $SelectTypeRequest;} elseif (@$tampildata['Type_Request']=='Domestic') 
				{echo "Selected"; }?>>Domestic</option>
				<option value="Export" <?php if (@$tampildata['Type_Request']=='Export') {echo "Selected";} ?>>Export</option>
				</select>
				<select class="form-control" id="selectCountry" name="selectCountry" style="visibility: hidden;" <?php echo $disabled; ?>>
					<option value="-" >Select Country</option>
						<?php
							$div = mysqli_query($con,"SELECT CustomerCode,Country FROM tb_trading_partner Where Status<>0 ");
							while($b = mysqli_fetch_array($div)){
								if($tampildata['Country'] == $b['CustomerCode']){
									$cek = 'Selected';
								}elseif($selectCountry == $b['CustomerCode']){
									$cek = 'Selected';
								}else{
									$cek = '';
								}
								echo"<option value='".$b['CustomerCode']."' $cek>".$b['Country']."</option>";
							}
						?>
				</select>		  
				</div>				
			  </td>
			</tr>
            <tr>
              <td>&nbsp;</td>
              <td><span class="form-group">Category 6 [Brand] *</span></td>
              <td>
			  	<select class="form-control" id="InputBrand" name="InputBrand" <?php echo $disabled; ?>>
					<option value="-" >Select Brand</option>
					<?php
			  			$exe = mysqli_query($con," SELECT NamaBrand from tb_brand Where Status='1'
						Group By NamaBrand " );
						while(@$row =mysqli_fetch_array($exe)){
							if($tampildata['Brand'] == $row['NamaBrand']){
								$cek = 'Selected';
							}elseif($InputBrand == $row['NamaBrand']){
								$cek = 'Selected';
							}else{
								$cek = '';
							}
							echo"<option value='".$row['NamaBrand']."' $cek>".$row['NamaBrand']."</option>";
						}
					?>
			  </select>	
			  </td>
	          <td width="10%"><span class="form-group">Category 7 [Bisnis]
              *</span></td>
	          <td>			  
			   <select class="form-control" id="InputBisnis" name="InputBisnis" <?php echo $disabled; ?>>
					<option value="-" >Select Bisnis</option>
					<?php
			  			$exe = mysqli_query($con,"SELECT KDBisnis,NamaBisnis from tb_bisnis Where Status='1' " );
						while(@$row =mysqli_fetch_array($exe)){
							if($tampildata['Bisnis'] == $row['KDBisnis']){
								$cek = 'Selected';
							}elseif($InputBisnis == $row['KDBisnis']){
								$cek = 'Selected';
							}else{
								$cek = '';
							}
							echo"<option value='".$row['KDBisnis']."' $cek>".$row['NamaBisnis']."</option>";
						}
					?>
			  </select>
			   </td>
			</tr>
            <tr>
              <td>&nbsp;</td>
              <td>
			  <span class="form-group">Category 8 [Category] *</span></td>
              <td>
			  
			  
			  <select class="form-control" id="InputCategory" name="InputCategory" <?php echo $disabled; ?>>
					<option value="-" >Select Category</option>
					<?php
			  			$exe = mysqli_query($con," SELECT NamaCategory from tb_category Where Status='1'
						Group By NamaCategory " );
						while(@$row =mysqli_fetch_array($exe)){
							if($tampildata['Category'] == $row['NamaCategory']){
								$cek = 'Selected';
							}elseif($InputCategory == $row['NamaCategory']){
								$cek = 'Selected';
							}else{
								$cek = '';
							}
							echo"<option value='".$row['NamaCategory']."' $cek>".$row['NamaCategory']."</option>";
						}
					?>
			  </select>	
			  </td>

	          <td width="10%"><span class="form-group">Category 9 [Series] *</span></td>
	          <td>
				<select class="form-control" id="InputSeries" name="InputSeries" <?php echo $disabled; ?>>
					<option value="-" >Select Series</option>
					<?php
			  			$exe = mysqli_query($con," SELECT NamaSeries from tb_series Where Status='1'
						Group By NamaSeries " );
						while(@$row =mysqli_fetch_array($exe)){
							if($tampildata['Series'] == $row['NamaSeries']){
								$cek = 'Selected';
							}elseif($InputSeries == $row['NamaSeries']){
								$cek = 'Selected';
							}else{
								$cek = '';
							}
							echo"<option value='".$row['NamaSeries']."' $cek>".$row['NamaSeries']."</option>";
						}
					?>
				</select>	
			  </td>
			</tr>
			<tr>
              <td>&nbsp;</td>
              <td><span class="form-group">Category 10 [Segmentation] *</span></td>
              <td>
			  <select class="form-control" id="InputSegmentation" name="InputSegmentation" <?php echo $disabled; ?>>
					<option value="-" >Select Segmentation</option>
					<?php
			  			$exe = mysqli_query($con," SELECT NamaSegmentation from tb_segmentation Where Status='1'
						Group By NamaSegmentation " );
						while(@$row =mysqli_fetch_array($exe)){
							if($tampildata['Brand'] == $row['NamaSegmentation']){
								$cek = 'Selected';
							}elseif($InputBrand == $row['NamaSegmentation']){
								$cek = 'Selected';
							}else{
								$cek = '';
							}
							echo"<option value='".$row['NamaSegmentation']."' $cek>".$row['NamaSegmentation']."</option>";
						}
					?>
			  </select></td>
              <td width="10%">&nbsp;</td>
	          <td>&nbsp;</td>
			</tr>
            <tr>
              <td>&nbsp;</td>
              <td><span class="form-group">Royalty Merk</span></td>
              <td colspan="2"><select class="form-control" id="selectCustomerCode" name="selectCustomerCode" <?php echo $disabled; ?>>
						<option value="-" >Select Royalty Merk</option>
						<?php
								include("../config/connect_sql.php");
								$query = "select Description from fdTradingPartne where TPType like 'ROYALTY%'";
								$exe = sqlsrv_query($myConnFlex,$query. " Order By Description Asc " );
								while(@$b = sqlsrv_fetch_array($exe)){
									if(@$tampildata['CustomerCode'] == $b['Description']){
										$cek = 'Selected';
									}elseif(@$selectCustomerCode == $b['Description']){
										$cek = 'Selected';
									}else{
										$cek = '';
									}
									echo"<option value='".$b['Description']."' $cek>".$b['Description']."</option>";
								}
							?>
					  </select> 
	 
	          <td>
				<div class="form-group d-flex align-items-center justify-content-between mt-0 mb-1">
            	<input type="text" class="form-control" name="InputRoyalty" id="InputRoyalty" 
				placeholder="Enter %" maxlength="3" style="text-align:right;"  title="Input Example : 2.5"
				onKeyPress="return angka(event)"  <?php echo $disabled; ?>
				value="<?php if ($_POST) { echo $InputRoyalty; } else {echo @$tampildata['Royalty'];} ?>" > &nbsp;%				</div>			  </td>
			</tr>
            <tr>
			  <td>&nbsp;</td>
              <td>Keterangan Product</td>
              <td colspan="3"><span class="form-group"> 
				<textarea rows="2" class="form-control py-2"  id="InputKeteranganProduct" name="InputKeteranganProduct" maxlength="100"
				placeholder="Enter Keterangan Product" <?php echo $disabled; ?>><?php if ($_POST) { echo $InputKeteranganProduct; } 
				else{echo @$tampildata['KeteranganProduct'];} ?></textarea>
        		</span>			   </td>
            </tr>
            <tr>
			<td width="1%">II.</td>
              <td colspan="4">
			  	<table name="mprdetail" id="mprdetail"  width="100%" border="1" class="table table-striped table-bordered table-hover" >
				</table>
			  </td>
            </tr>
		    <tr>
              <td>III.</td>
              <td><span class="form-group">Royalty Formula</span></td>
              <td colspan="2"><select class="form-control" id="selectCustomerCodeFormula" 
			  name="selectCustomerCodeFormula" disabled>
						<option value="-" >Select Royalty Formula</option>
						<?php
								include "../config/connect_sql.php";
								
								 
								
								$query = "select Description from fdTradingPartne where TPType like 'ROYALTY%'";
								$exe = sqlsrv_query($myConnFlex,$query. " Order By Description Asc " );
								while($b = sqlsrv_fetch_array($exe)){
									if(@$tampildata['CustomerCodeFormula'] == $b['Description']){
										$cek = 'Selected';
									}elseif(@$selectCustomerCode == $b['Description']){
										$cek = 'Selected';
									}else{
										$cek = '';
									}
									echo"<option value='".$b['Description']."' $cek>".$b['Description']."</option>";
								}
							?>
					  </select> 
	          <td>
				<div class="form-group d-flex align-items-center justify-content-between mt-0 mb-1">
            	<input type="text" class="form-control" name="InputRoyaltyFormula" id="InputRoyaltyFormula" 
				placeholder="Enter %" maxlength="3" style="text-align:right;"
				onKeyPress="return angka(event)" readonly="readonly"  title="Input Example : 2.5"
				value="<?php if ($_POST) { echo $InputRoyaltyFormula; } else {echo @$tampildata['RoyaltyFormula'];} ?>"> &nbsp;%				</div>			  </td>
			</tr>
			<td width="1%">IV.</td>
              <td colspan="4">
			  	<table name="mprdetailprod" id="mprdetailprod" width="100%" border="1" 
				class="table table-striped table-bordered table-hover">
				</table>			  
			  </td>
            </tr>
            <tr>
			  <td></td>
              <td>Input Product Flex & SAP</td>
              <td colspan="3">
			  <label><input type="checkbox" name="Flex"  disabled
			  <?php if (@$tampildata['Flex']==1) { echo 'checked="checked"';} ?>>
				1) Flexprocess</label> <br> 
                <label><input type="checkbox" name="SAP" disabled
				<?php if (@$tampildata['SAP']==1) { echo 'checked="checked"';} ?>>
				2) SAP</label></td>
            </tr>
			<tr>
			  <td colspan="5">&nbsp;</td>
			</tr>
			<tr>
              <td colspan="5">
			  <table name="Attach" id="Attach"  width="100%" border="1" class="table table-striped table-bordered table-hover" >
			   
				  <tr>
					<td colspan="10" align="left"><strong>Attachment File (.pdf)</strong>					
					<button type="button" style="padding:0px 0px 0px 0px" class="btn btn-primary" title="Add Attachment File"  
					name="btnCreateMPR" onClick="addRowfile('Attach')" <?php echo $disabled; ?> ><span class="fa fa-plus" title="Preview Work Flow" ></span> </button>
					<button type="button" style="padding:0px 0px 0px 0px" class="btn btn-primary" title="Delete Attachment File"  
					id="btnDeletefileMPR" name="btnDeletefileMPR"  <?php echo $disabled; ?> >
					<span class="glyphicon glyphicon-trash" title="Preview Work Flow" ></span></button>
					</td>
				  </tr>
				  <tr valign="bottom" align="center" bgcolor="#999999" >
					<th width="1%"></th>
					<th width="10%">File</th>
					<th width="20%">Name</th>
				  </tr>
			 
			 	  <?php if ($button=="add-mpr") { ?> 
				  <tr>
					<td><input type="checkbox" name="chkdetail[]" id="chkdetail[]"></td>
					<td><input type="file" name="InputFile[]" id="InputFile[]" class="form-control"
						style="padding:2px 2px 2px 2px" OnChange="return validasiFile()" accept="application/pdf"></td>
					<td><input type="text" name="InputNameFile[]" id="InputNameFile[]" class="form-control"
						style="padding:2px 2px 2px 2px" ></td>
				  </tr>
					 <?php
					 } else {
					$exe = mysqli_query($con,"SELECT ID_No,File,Name,Index_No 
					FROM tb_fnim_file Where Request_No = '".$tampildata['Request_No']."'   ");
					$no = 1;
					while(@$rowFNIMFile =mysqli_fetch_array($exe)){
					?>
				  <tr id="<?php echo $rowFNIMFile['ID_No'];?>">
					<td><input type="checkbox" name="chkdetail[]" id="chkdetail[]" value="<?php echo $rowFNIMFile['ID_No'];?>">
					<input type="hidden" name="tempfileid[]" id="tempfileid[]" value="<?php echo $rowFNIMFile['ID_No'];?>">
					<input type="hidden" name="tempfilelama[]" id="tempfilelama[]" value="<?php echo $rowFNIMFile['File'];?>"></td>
					<td>
					<?php if (!empty($rowFNIMFile['File'])){?>
			  		<img height="20" width="20" src=../img/pdf.png  title="Open File <?php echo $rowFNIMFile['File'];?>"
					onClick="popupwindow('../config/open-pdf.php?pdfname=<?php echo $rowFNIMFile['File'];?>&page=filempr','Preview Pdf','700','1000');">
			  	<?php }  ?>
				</td>
				<td>
					<input type="hidden" name="tempfilename[]" id="tempfilename[]" value="<?php echo $rowFNIMFile['Name'];?>">
					<input type="text" name="InputNameFile[]" id="InputNameFile[]" class="form-control"
						style="padding:2px 2px 2px 2px" value="<?php echo $rowFNIMFile['Name'];?>" readonly="readonly" ></td>
				  </tr>
				  <?php $no++;}} ?>
				  </table>
			  </td>
			</tr>
            <tr>
              <td colspan="2">Remark *</td>
              <td colspan="3"><div class="form-group"> <textarea cols="4" id="inputRemark" name="inputRemark"  
			  class="form-control py-4" placeholder="Enter Remark" <?php echo $disabled; ?> 
			  maxlength="100"><?php if ($_POST) { echo $inputRemark; } else {echo @$tampildata['Remark'];} ?></textarea></div></td>
            </tr>
			<?php if (@$tampildata['Status_MPR']<>"Complete") {?>	
			<tr>
			  <td colspan="2">Workflow Remark *</td>
              <td colspan="3"><div class="form-group"> <textarea cols="4" id="inputWorkflowRemark"  name="inputWorkflowRemark"  
			  class="form-control py-4" placeholder="Enter Workflow Remark" maxlength="100"
				<?php echo $disabled; ?>><?php if ($_POST) { echo $inputWorkflowRemark; } else {echo @$tampildataReq['Remark_WorkFlow'];} ?></textarea></div>			  </td>
            </tr>
			<?php ;}?>
			<tr>
              <td colspan="5"></td>
            </tr>
			 <?php if (@$tampildata['Status_MPR']=="Complete") {?>		
			<tr>
			  <td colspan="2">Remark after Complete *</td>
              <td colspan="4"><div class="form-group"> <textarea cols="4" id="inputRemarkafterComplete"  name="inputRemarkafterComplete"  
			  class="form-control py-4" placeholder="Enter Remark after Complete" maxlength="100"
				<?php echo $disabled; ?>><?php if ($_POST) { echo $inputRemarkafterComplete; } else {echo @$tampildata['RemarkafterComplete'];} ?></textarea></div>			  </td>
            </tr>
			<?php ;}?>
          </table>
		  <button type="submit" name="Send" value="Send"  onClick="return checkSendApproval(mpr)" 
		  class="btn btn-primary" 
		  <?php if (@$tampildata['Status_MPR']<>"Complete")  {echo $disabled;} else {echo "disabled='disabled'";} ?>>Send Approval</button>
		  <?php if (@$tampildata['Status_MPR']<>"Cancel")  {?>
		  <button type="submit" name="Save" value="<?php if ($button=="add-mpr") {echo"Save";} else {echo"Update";}  ?>"
		  <?php if ($button=="add-mpr") {echo 'onclick="return checkDraft(mpr)"';} else  {echo 'onclick="return checkEdit(mpr)"';} ?>  
		  class="btn btn-primary"><?php if (@$tampildata['Status_MPR']<>"Complete")  {echo "Draft";} else {echo "Update";} ?> </button>
		  <?php ;} ?>
		  <?php if (@$tampildata['Status_MPR']=="Complete"||@$tampildata['Status_MPR']=="Revise")  {?>
		  <button type="submit" name="Save" value="Cancel" onClick="return checkCancel(mpr)" 
		  class="btn btn-primary">Cancel Request</button>
	      <?php ;} ?>
		  <a class="btn btn-primary" href="../dist/index.php?button=mpr" title="Back Format No Request">Back</a> 
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

    <!-- Custom Theme JavaScript -->
    <script src="../js/sb-admin-2.js"></script>
	
	    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#mprdetail').DataTable({
            responsive: true
        });
    });
    </script>

	<script language="JavaScript" type="text/javascript">
	function checkSendApproval(form){
	
	if (form.inputAutoRequestNo.value == ""){
    	alert("Request No Can not be empty *");
    	form.inputAutoRequestNo.focus();
    	return (false);  		}
	else if (form.inputProjectName.value == ""){
    	alert("Thema Name Can not be empty *");
    	form.inputProjectName.focus();
    	return (false);  		}
	else if (form.selectReq.value == ""){
    	alert("FNIM Code Can not be empty *");
    	form.selectReq.focus();
    	return (false);  		}
	else if (form.InputType.value == ""){
    	alert("Type Can not be empty *");
    	form.InputType.focus();
    	return (false);  		}
	else if (form.SelectTypeRequest.value == "-" || form.SelectTypeRequest.value == ""){
    	alert("Market Can not be empty *");
    	form.SelectTypeRequest.focus();
    	return (false);  		}
	else if (form.InputBrand.value == ""){
    	alert("Brand Can not be empty *");
    	form.InputBrand.focus();
    	return (false);  		}
	else if (form.InputBisnis.value == ""){
    	alert("Bisnis Can not be empty *");
    	form.InputBisnis.focus();
    	return (false);  		}
	else if (form.InputSeries.value == ""){
    	alert("Series Can not be empty *");
    	form.InputSeries.focus();
    	return (false);  		}
	else if (form.InputCategory.value == ""){
    	alert("Category Can not be empty *");
    	form.InputCategory.focus();
    	return (false);  		}
	else if (form.InputSegmentation.value == ""){
    	alert("Segmentation Can not be empty *");
    	form.InputSegmentation.focus();
    	return (false);  		}
	else if (form.inputRemark.value == ""){
    	alert("Remark Can not be empty *");
    	form.inputRemark.focus();
    	return (false);  		}
	else if (form.inputWorkflowRemark.value == ""){
    	alert("Work flow Remark Can not be empty *");
    	form.inputWorkflowRemark.focus();
    	return (false);  		}
		return confirm('Are you sure you want to Send Approval?');
	}
	
	</script>
		<!-- js untuk jquery -->
	<script src="../../js/jquery-1.11.2.min.js"></script>
	<!-- js untuk bootstrap -->
	<script src="../../js/bootstrap.js"></script>
	<!-- js untuk bootstrap datetimepicker -->
	<script src="../../js/bootstrap-select.min.js"></script>

<script>
function deleteRow() {
			try {
			var table = document.getElementById('fnimdetail');
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
		
		
		
$('#btnDeleteMPR').click( function() {  
  var tableID = "rowTable";
  var table = document.getElementById(tableID);
  var rowCount = table.rows.length;
  console.log(rowCount);
  if(rowCount != 1) {   
   rowCount = rowCount - 1;
   table.deleteRow(rowCount);
  }   
}); 
</script>




<script>
$(document).ready(function(){
 $('#selectReq').change(function(){
  get_detaildata();
 });
});
 function get_detaildata(){
  var a = $('#selectReq').val();
  var b = $('#inputAutoRequestNo').val();
  var c = $('#SelectTypeRequest').val();


  $.ajax({
   type: 'POST',
   url: "mpr/loadfnim.php",
   
   data: { data1: a, data2: b, data3: c},
   
   success: function(info) {
	$("#mprdetail").html(info);  }
  });
    $.ajax({
   type: 'POST',
   url: "mpr/loadfnimprod.php",
   
   data: { data1: a, data2: b, data3: c},
   success: function(info) {
	$("#mprdetailprod").html(info);  }
  });
  return false;
 }
</script>
 
	<?php if (@$tampildata['Status_MPR']=="Complete"){ ?>
	<script language="JavaScript" type="text/javascript">
	function checkEdit(form){
	if (form.inputRemarkafterComplete.value == ""){
    	alert("Remark after Complete No Can not be empty *");
    	form.inputRemarkafterComplete.focus();
    	return (false);  		}
		return confirm('Are you sure you want to Update Draft this data?');
	}
	function checkCancel(form){
		return confirm('Are you sure you want to Cancel Request this data?');
	}
	</script>

	<?php ;} else {?>
	<script language="JavaScript" type="text/javascript">
	function checkDraft(form){
		return confirm('Are you sure you want to Draft this data?');
	}
	function checkEdit(form){
		return confirm('Are you sure you want to Update this data?');
	}

	</script>
	<?php ;}?>
	</body>
</html>

<script>
function deleteRowFile() {
			try {
			var table = document.getElementById('Attach');
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

 <script>

        $("#InputBisnis").change(function(){
            // variabel dari nilai combo box kendaraan
            var id_Bisnis = $("#InputBisnis").val();

            // Menggunakan ajax untuk mengirim dan dan menerima data dari server
            $.ajax({
                type: "POST",
                dataType: "html",
                url: "mpr/ambil-data.php",
                data: "Bisnis="+id_Bisnis,
                success: function(data){
                   $("#InputCategory").html(data);
                }
            });
        });
</script>
<script>
$(document).ready(function(){
 //Delete Technical Document_______________________________________________________
 $('#btnDeletefileMPR').click(function(){
  
  if(confirm("Are you sure you want to delete this?"))
  {
   var DelFile = [];
   
   $(':checkbox:checked').each(function(i){
    DelFile[i] = $(this).val();
   });
   if(DelFile.length === 0) //tell you if the array is empty
   {
    alert("Please Select atleast one checkbox");
   }
   else
   {
    $.ajax({
     url:'../config/delete.php',
     method:'POST',
     data:{DelFile:DelFile},
     success:function()
     {
      for(var i=0; i<DelFile.length; i++)
      {
       $('tr#'+DelFile[i]+'').css('background-color', '#ccc');
       $('tr#'+DelFile[i]+'').fadeOut('slow');
	   deleteRowFile();
      }
     }
    });
   }
  }
  else
  {
   return false;
  }
 });
 //___________________________________________________________

});
</script>
