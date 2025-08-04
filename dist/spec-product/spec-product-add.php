<?php 
$Send		= @$_POST['Send'];
$Save		= @$_POST['Save']; 
?>
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
		document.spec.inputBrand.focus();
	}
	function DisplayShowHide(){
		if (document.spec.selectSizeofProduct.value == "Ø"){
			document.spec.inputSizeofProduct_P.disabled = true ;
			document.spec.inputSizeofProduct_P.value =="" ;
			document.spec.inputSizeofProduct_L.placeholder="Enter D" ;
			document.spec.inputSizeofProduct_L.focus() ;
			
		}else{
			document.spec.inputSizeofProduct_P.disabled = false;
			document.spec.inputSizeofProduct_P.value =="" ;
			document.spec.inputSizeofProduct_L.placeholder="Enter L" ;
			document.spec.inputSizeofProduct_P.focus() ;
			
			
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

<!--?php include "mpr-javascrift.php"; ?-->

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
      <h3 class="mt-4"><?php if ($button=="add-spec-product") 
		{echo "New Request Specification Product";} else  {echo "Edit Request Specification Product ";} ?></h3>
	    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="../dist/index.php?button=dashboard">Dashboard</a></li>
		<li class="breadcrumb-item"><a href="../dist/index.php?button=spec-product">Specification Product</a></li>
        <li class="breadcrumb-item active"><?php if ($button=="add-spec-product" ) 
		{echo "New Request Specification Product";} else  {echo "Edit Request Specification Product ";} ?> </li>
		
      </ol>
 	<div class="card mb-4">
	    <div class="card-header"> </div>
    <div class="card-body"> 
			
        <?php
		include "../config/connect_sql.php";
      	$query ="SELECT a.ID_No,a.Index_Document,a.Request_No,a.Last_Request_No,a.Status_Last_Document,
		a.MPR_Code, DATE_FORMAT(a.Launching, '%Y') Tahun,
		a.Brand,a.Bisnis,a.PIC_Prodev,a.Category,a.Code_Product,a.BARCODE,a.Product_Name,a.Isi_Net,a.Netto,
		a.ProjectStatus1,a.ProjectStatus2,a.ProjectStatus3,a.ProjectStatus4,
		a.Description AS Description_SP,a.ProjectStatus,a.Notifikasi_BPOM,a.Product_Image,
		a.SizeOfProduct,a.SizeOfProduct_P,a.SizeOfProduct_L,a.SizeOfProduct_T,a.SizeOfProduct_Satuan,
		a.InnerPack_P,a.InnerPack_L,a.InnerPack_T,a.InnerPack_Satuan,
		a.SizeOfCartton_IS_P,a.SizeOfCartton_IS_L,a.SizeOfCartton_IS_T,a.SizeOfCartton_IS_Satuan,
		a.SizeOfCartton_OS_P,a.SizeOfCartton_OS_L,a.SizeOfCartton_OS_T,a.SizeOfCartton_OS_Satuan,
		a.DznCtn,a.DznCtn_Keterangan,a.WeighOfContenCtn,a.WeighOfContenCtn_Satuan,Status_Spec,Remark
		FROM tb_spec_product a 
		where a.Request_No = '".@$_GET['id']."' ";
		if ($button=="add-spec-product") {$query.=" And a.Status_Last_Document='1'";}
		else {$query =$query; }
      	$exe =mysqli_query($con,$query);
        $tampildata=mysqli_fetch_array($exe);
		$rev=@$tampildata['Index_Document']+1;

		//________________________________________________________________________________Status ARM disabled
		if (@$tampildata['Status_Spec']<>"Draft" & @$tampildata['Status_Spec']<>"" & 
			$button<>"add-revise-spec-product" & $button<>"revise-sp")
		  {$disabled="disabled";} else{$disabled="";}

		//________________________________________________________________________________WORKFLOWFNIM
		$exeReq = mysqli_query($con,"Select NameApproval,OnBehalf,Remark_WorkFlow FROM tb_workflowNPRF 
		WHERE Request_No = '".@$_GET['id']."' And Index_No='1' limit 1");
		$tampildataReq=mysqli_fetch_array($exeReq);
		//________________________________________________________________________________
	?>
	<form name="spec" id="spec" action="" method="post"  enctype="multipart/form-data"  >
    <?php 
	//Begin CRUD----------------------------------------------------------------------
	$datenow						= date("Y-m-d");
	include "spec-product-autonumber.php";
	$uploadDirFileSpec_Product		= "../img/Spec_Product/";

	if($_POST){
		$ip								=$_SERVER['REMOTE_ADDR'];
		$hostname 						= gethostbyaddr($_SERVER['REMOTE_ADDR']);
		date_default_timezone_set("Asia/Jakarta");
		$createddate					=date("Y-m-d H:i:s");
		$tempFormatNoRequest  			= @$_POST['tempFormatNoRequest'];
		$inputAutoRequestNo				= @$_POST['inputAutoRequestNo'];
		$inputLastRequestNo				= @$_POST['inputLastRequestNo'];
    	$InputMPRCode					= @$_POST['InputMPRCode'];
		$tempMPRDetail	 	 			= @$_POST['tempMPRDetail']; 
		$tempMPRFNIM		 			= @$_POST['tempMPRFNIM'];
		$tempFNIMDetail					= @$_POST['tempFNIMDetail'];
		$inputBrand			 			= @$_POST['inputBrand'];
		$inputBisnis					= @$_POST['inputBisnis'];
		$inputPICProdev					= @$_POST['inputPICProdev'];
		$inputCategory					= @$_POST['inputCategory'];
		$inputProductCode				= @$_POST['inputProductCode'];
		$inputBarcode		 			= @$_POST['inputBarcode'];
		$inputProductName				= @$_POST['inputProductName'];
		$inputIsiNetto					= @$_POST['inputIsiNetto'];
		$inpuNet						= @$_POST['inpuNet'];
		$Selectbulan					= @$_POST['Selectbulan'];
		$SelectTahun					= @$_POST['SelectTahun'];
		$inputProjectStatus				= @$_POST['inputProjectStatus'];
		$inputProductShortDescription	= @$_POST['inputProductShortDescription'];
		
		$namaFile	  					= @$_FILES['Inputfile']['name'];
		$xFile							= explode('.', $namaFile);
		$ekstensiFile    				= strtolower(end($xFile));
		$ukuranFile						= @$_FILES['Inputfile']['size'];
		$file_tmpFile		 			= @$_FILES['Inputfile']['tmp_name'];			
	

		$inputNotificationBPOM			= @$_POST['inputNotificationBPOM'];
		$inputHalalNumber				= @$_POST['inputHalalNumber'];
		
		$selectSizeofProduct		 	= @$_POST['selectSizeofProduct'];
		$inputSizeofProduct_P		 	= @$_POST['inputSizeofProduct_P'];
		$inputSizeofProduct_L		 	= @$_POST['inputSizeofProduct_L'];
		$inputSizeofProduct_T		 	= @$_POST['inputSizeofProduct_T'];
		$inputSizeOfProduct_Satuan		= @$_POST['inputSizeOfProduct_Satuan'];
		
		$inputInnerPack_P				= @$_POST['inputInnerPack_P'];
		$inputInnerPack_L				= @$_POST['inputInnerPack_L'];
		$inputInnerPack_T				= @$_POST['inputInnerPack_T'];
		$inputInnerPack_Satuan			= @$_POST['inputInnerPack_Satuan'];
		
		$inputSizeOfCartton_IS_P		= @$_POST['inputSizeOfCartton_IS_P'];
		$inputSizeOfCartton_IS_L		= @$_POST['inputSizeOfCartton_IS_L'];
		$inputSizeOfCartton_IS_T		= @$_POST['inputSizeOfCartton_IS_T'];
		$inputSizeOfCartton_IS_Satuan	= @$_POST['inputSizeOfCartton_IS_Satuan'];
		
		$inputSizeOfCartton_OS_P		= @$_POST['inputSizeOfCartton_OS_P'];
		$inputSizeOfCartton_OS_L		= @$_POST['inputSizeOfCartton_OS_L'];
		$inputSizeOfCartton_OS_T		= @$_POST['inputSizeOfCartton_OS_T'];
		$inputSizeOfCartton_OS_Satuan	= @$_POST['inputSizeOfCartton_OS_Satuan'];
		
		$inpuDsn_Ctn				 	= @$_POST['inpuDsn_Ctn'];
		$inpuDsnCtn_Keterangan			= @$_POST['inpuDsnCtn_Keterangan'];
		$inputWeightofContent		 	= @$_POST['inputWeightofContent'];
		$inputWeightofContent_Satuan	= @$_POST['inputWeightofContent_Satuan'];
		$inputRemark					= @$_POST['inputRemark'];
		$inputWorkflowRemark			= @$_POST['inputWorkflowRemark'];
		$SelectWorkflowRevise			= @$_POST['SelectWorkflowRevise'];

		if($Save=="Save"){
			include "spec-product-autonumber.php";
			$TanyaReqWokflow = mysqli_query($con,"SELECT * FROM tb_workflowapproval 
			WHERE UserDomain= '$username' And WorkFlowMenu= 'SP' And LevelApproval ='Requestor'");
			if (mysqli_num_rows($TanyaReqWokflow) ==0 ) {  
				echo "<div class='form-group has-error'>
				<label class='control-label' for='inputError'>Error Save : Contact Administrator, because not wokflow Process *</label></div>";}
			else {
				$Tanya = mysqli_query($con,"SELECT Request_No FROM tb_spec_product WHERE Request_No = '$inputAutoRequestNo' ");
				if (mysqli_num_rows($Tanya) !=0 ) {  
					echo "<div class='form-group has-error'>
					<label class='control-label' for='inputError'>Error Save : Request No already exists in the database *</label></div>";}
				else{
					//membuat Query untuk menyimpan data
					include "spec-product-autonumber.php";
				 	include "spec-product-save.php";
				 	$message = "Data successfully Save To Spec Product";
					echo "<script type='text/javascript'>alert('$message');</script>";
					//echo"<script>  window.location='../dist/index.php?button=spec-product'; </script>";
					 
 				}
			}
		}elseif($Save=="Update"){ 
			//membuat Query untuk update data
			include "spec-product-edit.php";
			 
			$message = "Data successfully Update Spec Product";
			echo "<script type='text/javascript'>alert('$message');</script>";
			echo"<script>  window.location='../dist/index.php?button=spec-product'; </script>";
		}elseif($Save=="Cancel"){ 
			mysqli_query($con,"UPDATE tb_spec_product SET Status_Spec='Cancel' WHERE Request_No='$inputAutoRequestNo'");
			mysqli_query($con,"UPDATE tb_inbox SET Request_Status='Cancel' WHERE Request_No='$inputAutoRequestNo'");
			
			$message = "Data successfully Cancel Request";
			echo "<script type='text/javascript'>alert('$message');</script>";
			echo"<script>  window.location='../dist/index.php?button=spec-product'; </script>";
				
		}elseif($Send=="Send"){ 
			include "spec-product-autonumber.php";
			$TanyaReqWokflow = mysqli_query($con,"SELECT * FROM tb_workflowapproval 
			WHERE UserDomain= '$username' And WorkFlowMenu= 'SP' And LevelApproval ='Requestor'");
			if (mysqli_num_rows($TanyaReqWokflow) ==0 ) {  
				echo "<div class='form-group has-error'>
				<label class='control-label' for='inputError'>Error Save : Contact Administrator, because not wokflow Process *</label></div>";
			}else {
				$Tanya = mysqli_query($con,"SELECT Request_No FROM tb_spec_product WHERE Request_No = '$inputAutoRequestNo' ");
				if (mysqli_num_rows($Tanya) !=0 ) {  
					include "spec-product-edit.php";
				}else{
					//membuat Query untuk menyimpan data
					include "spec-product-autonumber.php";
	 				include "spec-product-save.php";
 				}
				mysqli_query($con,"UPDATE tb_spec_product SET Status_Spec='Sent',
				UpdatedBy='$username',UpdatedDate='$createddate',UpdatedHostName='$ip : $hostname' 
				WHERE Request_No='$inputAutoRequestNo'");

				//DeleteWorkFlow SPEC yang nilainya NULL
				mysqli_query($con,"DELETE From tb_workflownprf WHERE Request_No='$inputAutoRequestNo' And StatusWorkFlow Is Null");
				include "spec-product-save-workflow.php";			
				//Update WorkFlow SPEC Sent Approval
				mysqli_query($con,"UPDATE tb_workflowNPRF SET StatusWorkFlow='S',ReadWorkFlow='1',Remark_WorkFlow='$inputWorkflowRemark',
				Approve='$username',ApproveDate='$createddate',Status_Approval='1' WHERE Request_No='$inputAutoRequestNo' And Index_No='1'
				And ReadWorkFlow='0'");
				//Send Email Notification for Approval 2-------------------------------------------------
				$exeNext = mysqli_query($con,"Select NameApproval,OnBehalf,WorkFlowMenu FROM tb_workflowNPRF 
				WHERE Request_No='$inputAutoRequestNo' And Index_No='2' And StatusWorkFlow is null limit 1");
	
				$tampildataNext=mysqli_fetch_array($exeNext);
				$app1=$tampildataNext['NameApproval'];
				$app2=$tampildataNext['OnBehalf'];
				$remark=$inputWorkflowRemark;
				$id=$inputAutoRequestNo;
				$WorkFlowMenu="SP";

				$Confirm=="Approve";
				require ("../config/emailapp.php");

				$exeCaraBisnis = mysqli_query($con,"Select NamaBisnis FROM tb_bisnis 
				WHERE KDBisnis='$inputBisnis' ");
				$tampildataBisnis=mysqli_fetch_array($exeCaraBisnis);
				//Simpan Inbox
				$exeCariInbox = mysqli_query($con,"Select Request_No  FROM tb_inbox 
				WHERE Request_No='$inputAutoRequestNo' ");
				if (mysqli_num_rows($exeCariInbox) !=0 ) {
					mysqli_query($con,"UPDATE tb_inbox Set Thema_Name='".$tampildata['Brand']." ".$tampildata['Code_Product']."',
					Request_Type='".$tampildataBisnis['NamaBisnis']."',Request_Status='W',ReadInbox='0',UpdatedBy='$username',
					NameApproval='".$tampildataNext['NameApproval']."',OnBehalf='".$tampildataNext['OnBehalf']."',
					Remark='$inputWorkflowRemark',CreatedBy='$username',UpdatedDate='$createddate',UpdatedHostName='$ip : $hostname'  
					WHERE Request_No='$inputAutoRequestNo'");
				}else{
					mysqli_query($con,"Insert INTO tb_inbox (Request_No,Request_Date,Thema_Name,
					Request_Type,Request_Status,NameApproval,OnBehalf,ReadInbox,Remark,WorkFlowMenu,
					CreatedBy,CreatedDate,CreatedHostName) 
					values ('$inputAutoRequestNo','$createddate','".$inputBrand." ".$inputProductCode."',
					'".$tampildataBisnis['NamaBisnis']."','W','".$tampildataNext['NameApproval']."',
					'".$tampildataNext['OnBehalf']."','0','".$inputWorkflowRemark."','SP',
					'$username','$createddate','$ip : $hostname'	)");
				}

				//_________________________________________________________________________________________
				$message = "Data successfully Sent  to Approval";
				echo "<script type='text/javascript'>alert('$message');</script>";
				echo"<script>  window.location='../dist/index.php?button=spec-product'; </script>";
			}
		}

	}
		//End CRUD----------------------------------------------------------------------
	?>
        <table width="100%" border="0" class="table table-striped" id="dataTables-example" >
		<tr>
			<td width="12%" rowspan="11" valign="center" ><span class="form-group"><strong>I. Marketing Support</strong></span></td>
			<td width="20%"><span class="form-group">Request No *</span></td>
            <td colspan="2"><span class="form-group">
				<input name="tempFormatNoRequest" id="tempFormatNoRequest" type="hidden" value="<?php echo $tampildata['Request_No']; ?>">
                <input class="form-control py-4"  name="inputAutoRequestNo" id="inputAutoRequestNo"  
				maxlength="50" type="text" placeholder="Auto Request No" readonly="readonly" 
			  value="<?php if ($button=="add-spec-product") {echo $NomorReq;} elseif ($button=="add-revise-spec-product") 
			  {echo substr($tampildata['Request_No'],0,17)."-R".$rev;} else {echo @$tampildata['Request_No'];} ?>" />
              </span> </td>
            </tr>
            <tr>
              <td width="20%"><span class="form-group">Last Request No  </span></td>
              <td colspan="2"><span class="form-group">
                <input class="form-control py-4"  name="inputLastRequestNo" id="inputLastRequestNo"  maxlength="50" type="text"  
			  placeholder="Auto Request No"  readonly="readonly" 
			  value="<?php if (@$tampildata['Status_Spec']=="Complete" & $button=="add-revise-spec-product") 
			  {echo @$tampildata['Request_No'];} else {echo @$tampildata['Last_Request_No'];}?>" />
              </span> </td>
            </tr>
			<tr>
				<td width="20%"><span class="form-group">Master Product Request No</span></td>
				<td colspan="3"><div class="form-group d-flex align-items-center justify-content-between mt-0 mb-1">
					<input name="tempMPRDetail" type="hidden" value="<?php echo @$tampildata['ID_NoMPRDetail']; ?>">
					<input name="tempMPRFNIM" type="hidden" value="<?php echo @$tampildata['FNIM_Code']; ?>">
					<input name="tempFNIMDetail" type="hidden" value="<?php echo @$tampildata['ID_NoFNIMDetail']; ?>">
					<input name="InputMPRCode"  type="test"   id="InputMPRCode"   maxlength="50"  class="form-control py-4" 
					placeholder="Master Product Request No" readonly="readonly" value="<?php echo @$tampildata['MPR_Code']; ?>" />
					&nbsp;<button type="button" style="padding:2px 4px 4px 4px" 
			   		class="btn btn-primary" title="Search Project Name"  
					name="btnsearch" disabled="disabled"
					onClick="popupwindow('packaging-arm/project-name-popup.php?id=mpr','Search Project Name','600','900');" <?php echo $disabled; ?>>
					<span class="glyphicon glyphicon-search" ></span> </button>
					</div>
				
				</td>
            </tr>
			<tr>	 
				<td><span class="form-group">Brand *</span></td>
				<td colspan="3">
					<span class="form-group"> 
					<select class="form-control" id="inputBrand" name="inputBrand" <?php echo $disabled; ?>>
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
			</span>
			</td>
            </tr>
			<tr>	 
				<td><span class="form-group">Product Code * </span></td>
				<td colspan="3">
					<span class="form-group"> 
						<input class="form-control py-0"  name="inputProductCode" id="inputProductCode" <?php echo $disabled; ?>  
						maxlength="50" type="text" value="<?php  if ($_POST) { echo $inputProductCode; } else { echo @$tampildata['Code_Product'];} ?>" />
					</span>
				</td>
            </tr>
			<tr>
				<td><span class="form-group">Product Barcode *</span></td>
				<td colspan="3">
					<span class="form-group"> 
						<input class="form-control py-4"  name="inputBarcode" id="inputBarcode" <?php echo $disabled; ?>
						maxlength="50" type="text" value="<?php if ($_POST) { echo $inputBarcode; } else {echo @$tampildata['BARCODE'];} ?>" />
					</span>
				</td>
            </tr>
			 
			<tr>
				<td><span class="form-group">Product Name</span></td>
				<td colspan="3">
					<span class="form-group"> 
						<input class="form-control py-4"  name="inputProductName" id="inputProductName"   
						maxlength="50" type="text"  value="<?php echo @$tampildata['Product_Name']; ?>" <?php echo $disabled; ?> />
					</span>
				</td>
            </tr>
			<tr>
				<td><span class="form-group">Netto</span></td>
				<td>
					<div class="form-group d-flex align-items-center justify-content-between mt-0 mb-0">
						<input class="form-control py-4"  name="inputIsiNetto" id="inputIsiNetto" 
						maxlength="50" type="text" value="<?php echo @$tampildata['Isi_Net']; ?>" <?php echo $disabled; ?>/>
						<select class="form-control col-md-2"  id="inpuNet" <?php echo $disabled; ?>
						name="inpuNet"  >
							<option value="gr" <?php if (@$tampildata['Netto']=='gr') {echo "Selected"; }?>>gr</option>
							<option value="Kg" <?php if (@$tampildata['Netto']=='Kg') {echo "Selected"; }?>>Kg</option>
							<option value="ml" <?php if (@$tampildata['Netto']=='ml') {echo "Selected"; }?>>ml</option>
							<option value="Liter" <?php if (@$tampildata['Netto']=='Liter') {echo "Selected"; }?>>Liter</option>
						</select> 
					</div>
				</td>
				<td>  ( gr / Kg / ml / Liter )</td>
            </tr>			
			<tr>
				<td><span class="form-group">CATEGORY 7 [BISNIS] *</span></td>
				<td colspan="3"><span class="form-group"> 
				<select class="form-control" id="inputBisnis" name="inputBisnis" <?php echo $disabled; ?>>
					<option value="-" >Select Bisnis</option>
					<?php
			  			$exe = mysqli_query($con,"SELECT KDBisnis,NamaBisnis from tb_bisnis Where Status='1' " );
						while(@$row =mysqli_fetch_array($exe)){
							if(@$tampildata['Bisnis'] == $row['KDBisnis']){
								$cek = 'Selected';
							}elseif($inputBisnis == $row['KDBisnis']){
								$cek = 'Selected';
							}else{
								$cek = '';
							}
							echo"<option value='".$row['KDBisnis']."' $cek>".$row['NamaBisnis']."</option>";
						}
					?>
			  	</select>
				</span>
			</td>
            </tr>
			<tr>
				<td><span class="form-group">PIC Prodev *</span></td>
				<td colspan="3"><span class="form-group"> 
					<select class="form-control" id="inputPICProdev" name="inputPICProdev" <?php echo $disabled; ?>>
						<option value="-" >Select PIC Prodev</option>
						<?php
							$exe = mysqli_query($con,"SELECT a.UserDomain,b.Name,c.KDDivision,c.DivisionName FROM tb_workflowapproval a
							INNER JOIN tb_user b ON a.UserDomain=b.UserDomain
							INNER JOIN tb_division c ON b.KDDivision=c.KDDivision
							WHERE WorkFlowMenu='SP' AND LevelApproval='Requestor' 
							And a.UserDomain='$tampildata[PIC_Prodev]' " );
							while(@$row =mysqli_fetch_array($exe)){
								echo"<option value='".$row['UserDomain']."' Selected>".$row['Name']."</option>";
							}
						?>
					</select>
					</span>
				</td>
            </tr>
			<tr>
				<td><span class="form-group">CATEGORY 9 [CATEGORY] *</span></td>
				<td colspan="3"><span class="form-group"> 
				<select class="form-control" id="inputCategory" name="inputCategory" <?php echo $disabled; ?>>
					<option value="-" >Select Category</option>
					<?php
			  			$exe = mysqli_query($con," SELECT NamaCategory from tb_category Where Status='1'
						Group By NamaCategory " );
						while(@$row =mysqli_fetch_array($exe)){
							if($tampildata['Category'] == $row['NamaCategory']){
								$cek = 'Selected';
							}elseif($inputCategory == $row['NamaCategory']){
								$cek = 'Selected';
							}else{
								$cek = '';
							}
							echo"<option value='".$row['NamaCategory']."' $cek>".$row['NamaCategory']."</option>";
						}
					?>
			  </select>	
				</span>
			</td>
            </tr>
			<tr>
			<td width="1%"><span class="form-group"></span></td>
			<td><span class="form-group">Launching Years</span></td>
			<td width="">					
				<select name="SelectTahun" id="SelectTahun" title="Tahun Launching" <?php echo $disabled; ?>
				class="form-control">
					<option value="">Launching Years</option>
					<?php 
					$mulai= date('Y');
					for($i = $mulai;$i<$mulai + 5;$i++){?>
					<option value="<?php echo $i; ?>" <?php if (@$tampildata['Tahun']==$i) 
					{echo "Selected";} ?>><?php echo $i; ?></option><?php }	?>
				</select>
		 
		</td>
		<td> Example 2020</td>
	</tr>
			<tr>
			  <td colspan="5">&nbsp;</td>
			</tr>
			<tr>
				<td rowspan="3" ><span class="form-group"><strong>II. Product Development</strong></span></td>
				<td rowspan="2"><span class="form-group">Project Status</span></td>
				<td colspan="3">
					<span class="form-group"> 
					<table cellpadding="0" cellspacing="0" border="0"width="100%"  >
					<tr>
						<td style="text-align:left; width:120px; height:20px;">
							<label><input type="checkbox" name="ChkProjectStatus1" id="ChkProjectStatus1" disabled ="disabled"
							<?php if (@$tampildata['ProjectStatus1']=="1") { echo 'checked="checked"';} ?>> New</label></td>
						<td style="text-align:left; width:120px; height:20px;">
							<label><input type="checkbox" name="ChkProjectStatus2" id="ChkProjectStatus2" disabled ="disabled"
							<?php if (@$tampildata['ProjectStatus2']=="1") { echo 'checked="checked"';} ?> > Renewal</label></td>
						<td style="text-align:left; width:120px; height:20px;">
							<label><input type="checkbox" name="ChkProjectStatus3" id="ChkProjectStatus3" disabled ="disabled"
							<?php if (@$tampildata['ProjectStatus3']=="1") { echo 'checked="checked"';} ?>  > Refine</label></td>
						<td style="text-align:left; width:120px; height:20px;">
							<label><input type="checkbox" name="ChkProjectStatus4" id="ChkProjectStatus4" disabled ="disabled"
							<?php if (@$tampildata['ProjectStatus4']=="1") { echo 'checked="checked"';} ?> > Others</label></td>
					</tr>
					</table>					
					</span>
				</td>
			</tr>
			<tr>
				<td colspan="4">
					<textarea cols="4" id="inputProjectStatus" name="inputProjectStatus"  
			  		class="form-control py-4" placeholder="Enter Remark" disabled ="disabled"
			  		maxlength="100"><?php if ($_POST) { echo $inputProjectStatus; } else {echo @$tampildata['ProjectStatus'];} ?></textarea>
				</td>
			</tr>
					
            
			<tr>
				<td><span class="form-group">Product Short Description</span></td>
				<td colspan="3"><span class="form-group"> <textarea cols="4" id="inputProductShortDescription" 
					name="inputProductShortDescription"  class="form-control py-4" disabled ="disabled"
					placeholder="Enter Product Short Description"  
					maxlength="200"><?php if ($_POST) { echo $inputProductShortDescription; } else {echo @$tampildata['Description_SP'];} ?></textarea>
				</div></td>
            </tr>
			<tr>
			  <td colspan="5">&nbsp;</td>
			</tr>
			<tr>
				<td width="1%"><span class="form-group"><strong>III. Packaging Development</strong></span></td>
				<td><span class="form-group">Size of Product</span></td>
				<td colspan="3">
					<span class="form-row"> 
						<span class="col-md-8"> 
							<span class="form-group">
								<div class="form-group d-flex align-items-center justify-content-between mt-0 mb-0">
									<select class="form-control" id="selectSizeofProduct" name="selectSizeofProduct"
									 onChange="DisplayShowHide()" disabled ="disabled"
										onFocus=" DisplayShowHide()" >
										<option value="" <?php if (@$tampildata['SizeOfProduct']=='')  {echo "Selected"; }?> ></option>
										<option value="Ø"<?php if (@$tampildata['SizeOfProduct']=='Ø') {echo "Selected"; }?> >Ø</option>
									</select> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
									<input class="form-control py-4"  name="inputSizeofProduct_P" id="inputSizeofProduct_P"  
									maxlength="50" type="text" <   onKeyUp="return angka(this);"
									placeholder="Enter P" value="<?php echo @$tampildata['SizeOfProduct_P']; ?>" disabled ="disabled" />
									 &nbsp;&nbsp;X&nbsp;&nbsp;  
									<input class="form-control py-4"  name="inputSizeofProduct_L" id="inputSizeofProduct_L"  
									maxlength="50" type="text"   onKeyUp="return angka(this);"
									placeholder="Enter L" value="<?php echo @$tampildata['SizeOfProduct_L']; ?>" disabled ="disabled" />
									&nbsp;&nbsp;X&nbsp;&nbsp; 
									<input class="form-control py-4"  name="inputSizeofProduct_T" id="inputSizeofProduct_T"  
									maxlength="50" type="text"     onKeyUp="return angka(this);"
									placeholder="Enter T" value="<?php echo @$tampildata['SizeOfProduct_T']; ?>" disabled ="disabled" />
								</div>
							</span>
						</span>	
						<span class="col-md-2"> 
							<span class="form-group"> 
								<select class="form-control" id="inputSizeOfProduct_Satuan"  disabled ="disabled" 
								name="inputSizeOfProduct_Satuan"   >
									<option value="mm" <?php if (@$tampildata['SizeOfProduct_Satuan']=='mm') {echo "Selected"; }?>>mm</option>
									<option value="cm" <?php if (@$tampildata['SizeOfProduct_Satuan']=='cm') {echo "Selected"; }?>>cm</option>
								</select> 			  		 
							</span>				  
						</span>
					</span>		
			  </td>
            </tr>
			<tr>
				<td width="1%"><span class="form-group"></span></td>
				<td width="15%"><span class="form-group">Inner Pack</span></td>
				<td colspan="3">
					<span class="form-row"> 
						<span class="col-md-6"> 
							<span class="form-group">
								<div class="form-group d-flex align-items-center justify-content-between mt-0 mb-0">
									<input class="form-control py-4"  name="inputInnerPack_P" id="inputInnerPack_P"  
									maxlength="50" type="text"     onKeyUp="return angka(this);"
									placeholder="Enter P" value="<?php echo @$tampildata['InnerPack_P']; ?>" disabled ="disabled" />
									 &nbsp;&nbsp;X&nbsp;&nbsp;  
									<input class="form-control py-4"  name="inputInnerPack_L" id="inputInnerPack_L"  
									maxlength="50" type="text"   onKeyUp="return angka(this);"
									placeholder="Enter L" value="<?php echo @$tampildata['InnerPack_L']; ?>" disabled ="disabled" />
									&nbsp;&nbsp;X&nbsp;&nbsp; 
									<input class="form-control py-4"  name="inputInnerPack_T" id="inputInnerPack_T"  
									maxlength="50" type="text"    onKeyUp="return angka(this);"
									placeholder="Enter T" value="<?php echo @$tampildata['InnerPack_T']; ?>" disabled ="disabled"/>
								</div>
							</span>
						</span>	
						<span class="col-md-2"> 
							<span class="form-group"> 
								<select class="form-control" id="inputInnerPack_Satuan" disabled ="disabled"
								name="inputInnerPack_Satuan"  >
									<option value="mm" <?php if (@$tampildata['InnerPack_Satuan']=='mm') {echo "Selected"; }?>>mm</option>
									<option value="cm" <?php if (@$tampildata['InnerPack_Satuan']=='cm') {echo "Selected"; }?>>cm</option>
								</select> 			  		 
							</span>				  
						</span>
					</span>		
			  </td>
            </tr>
			
			<td width="1%"></td>
              <td colspan="4">
			  	Size of Carton			  
			  </td>
            </tr>
            <tr>
				<td width="1%"><span class="form-group"></span></td>
				<td width="15%"><span class="form-group">Inner Size</span></td>
				<td colspan="3">
					<span class="form-row"> 
						<span class="col-md-6"> 
							<span class="form-group">
								<div class="form-group d-flex align-items-center justify-content-between mt-0 mb-0">
									<input class="form-control py-4"  name="inputSizeOfCartton_IS_P" id="inputSizeOfCartton_IS_P"  
									maxlength="50" type="text"    onKeyUp="return angka(this);"
									placeholder="Enter P" value="<?php echo @$tampildata['SizeOfCartton_IS_P']; ?>" disabled ="disabled" />
									 &nbsp;&nbsp;X&nbsp;&nbsp;  
									<input class="form-control py-4"  name="inputSizeOfCartton_IS_L" id="inputSizeOfCartton_IS_L"  
									maxlength="50" type="text"    onKeyUp="return angka(this);"
									placeholder="Enter L" value="<?php echo @$tampildata['SizeOfCartton_IS_L']; ?>" disabled ="disabled" />
									&nbsp;&nbsp;X&nbsp;&nbsp; 
									<input class="form-control py-4"  name="inputSizeOfCartton_IS_T" id="inputSizeOfCartton_IS_T"  
									maxlength="50" type="text"    onKeyUp="return angka(this);"
									placeholder="Enter T" value="<?php echo @$tampildata['SizeOfCartton_IS_T']; ?>" disabled ="disabled" />
								</div>
							</span>
						</span>	
						<span class="col-md-2"> 
							<span class="form-group"> 
								<select class="form-control" id="inputSizeOfCartton_IS_Satuan" disabled ="disabled"
								name="inputSizeOfCartton_IS_Satuan"   >
									<option value="mm" <?php if (@$tampildata['SizeOfCartton_IS_Satuan']=='mm') {echo "Selected"; }?>>mm</option>
									<option value="cm" <?php if (@$tampildata['SizeOfCartton_IS_Satuan']=='cm') {echo "Selected"; }?>>cm</option>
								</select> 			  		 
							</span>				  
						</span>
					</span>		
			  </td>
            </tr>
			<tr>
				<td width="1%"><span class="form-group"></span></td>
				<td width="15%"><span class="form-group">Outer Size</span></td>
				<td colspan="3">
					<span class="form-row"> 
						<span class="col-md-6"> 
							<span class="form-group">
								<div class="form-group d-flex align-items-center justify-content-between mt-0 mb-0">
									<input class="form-control py-4"  name="inputSizeOfCartton_OS_P" id="inputSizeOfCartton_OS_P"  
									maxlength="50" type="text"  onKeyUp="return angka(this);"
									placeholder="Enter P" value="<?php echo @$tampildata['SizeOfCartton_OS_P']; ?>" disabled ="disabled" />
									 &nbsp;&nbsp;X&nbsp;&nbsp;  
									<input class="form-control py-4"  name="inputSizeOfCartton_OS_L" id="inputSizeOfCartton_OS_L"  
									maxlength="50" type="text"    onKeyUp="return angka(this);"
									placeholder="Enter L" value="<?php echo @$tampildata['SizeOfCartton_OS_L']; ?>" disabled ="disabled" />
									&nbsp;&nbsp;X&nbsp;&nbsp; 
									<input class="form-control py-4"  name="inputSizeOfCartton_OS_T" id="inputSizeOfCartton_OS_T"  
									maxlength="50" type="text"    onKeyUp="return angka(this);"
									placeholder="Enter T" value="<?php echo @$tampildata['SizeOfCartton_OS_T']; ?>" disabled ="disabled"/>
								</div>
							</span>
						</span>	
						<span class="col-md-2"> 
							<span class="form-group"> 
								<select class="form-control" id="inputSizeOfCartton_OS_Satuan" disabled ="disabled"
								name="inputSizeOfCartton_OS_Satuan"  >
									<option value="mm" <?php if (@$tampildata['SizeOfCartton_OS_Satuan']=='mm') {echo "Selected"; }?>>mm</option>
									<option value="cm" <?php if (@$tampildata['SizeOfCartton_OS_Satuan']=='cm') {echo "Selected"; }?>>cm</option>
								</select> 			  		 
							</span>				  
						</span>
					</span>		
			  </td>
            </tr>
			<tr>
				<td width="1%"><span class="form-group"></span></td>
				<td><span class="form-group">Dzn / Ctn</span></td>
				<td colspan="3">
					<span class="form-row"> 
						<span class="col-md-2"> 
							<span class="form-group">
								<div class="form-group d-flex align-items-center justify-content-between mt-0 mb-0">
									<input class="form-control py-4"  name="inpuDsn_Ctn" id="inpuDsn_Ctn"  
									maxlength="50" type="text"    disabled ="disabled"
									placeholder="Dzn" value="<?php echo @$tampildata['DznCtn']; ?>" />
								</div>
							</span>
						</span>
						&nbsp;&nbsp;Keterangan&nbsp;&nbsp;  
						<span class="col-md-8"> 
							<span class="form-group"> 
								<input class="form-control py-4"  name="inpuDsnCtn_Keterangan" id="inpuDsnCtn_Keterangan"  
									maxlength="50" type="text"    disabled ="disabled"
									placeholder="Keterangan (6 inner box x 3 pcs)" value="<?php echo @$tampildata['DznCtn_Keterangan']; ?>" /> 			  		 
							</span>				  
						</span>
					</span>
				</td>
            </tr>
			
			<tr>
			  <td colspan="5">&nbsp;</td>
			</tr>
			<tr>
				<td rowspan="2" ><span class="form-group"><strong>IV. Registration</strong></span></td>
				<td><span class="form-group">BPOM Notification</span></td>
				<td colspan="3"><span class="form-group">
					<input class="form-control py-4"  name="inputNotificationBPOM" id="inputNotificationBPOM"  
					maxlength="50" type="text"  disabled ="disabled"
					placeholder="Notification BPOM" value="<?php echo @$tampildata['Notifikasi_BPOM']; ?>" />
					</span>
				</td>
            </tr>
			<tr>
				<td><span class="form-group">Halal Number</span></td>
				<td colspan="3"><span class="form-group">
					<input class="form-control py-4"  name="inputHalalNumber" id="inputHalalNumber"  
					maxlength="50" type="text"   disabled ="disabled"
					placeholder="Halal Number" value="<?php echo @$tampildata['Halal_Number']; ?>" />
					</span>
				</td>
            </tr>
			<tr>
			  <td colspan="5">&nbsp;</td>
			</tr>
			<tr>
			  <td width="1%"><span class="form-group"><strong>V. QC</strong></span></td>
              <td>Weight of Content / Carton </td>
              <td colspan="2"><div class="form-group d-flex align-items-center justify-content-between mt-0 mb-0">
				<input class="form-control py-4"  name="inputWeightofContent" id="inputWeightofContent"  
				maxlength="50" type="text"   disabled ="disabled"
				placeholder="Enter Weight of Content / Carton" value="<?php echo @$tampildata['WeighOfContenCtn']; ?>" />
				<select class="form-control col-md-2" id="inputWeightofContent_Satuan" 
				name="inputWeightofContent_Satuan"   disabled ="disabled" >
					<option value="gr" <?php if (@$tampildata['WeighOfContenCtn_Satuan']=='gr') {echo "Selected"; }?>>gr</option>
				</select> 
				</div>
				</td>
				<td>  ( gr )</td>
			</div></td>
            </tr>
			 <tr>
			  <td colspan="5">&nbsp;</td>
			</tr>
			<tr>
				<td><span class="form-group"><strong>VI. Advertising</strong></span></td>
				<td><span class="form-group">Product Image</span></td>
				<td colspan="3"> 
				<?php if (!empty($tampildata['Product_Image'])){?>
			<img height="80" width="100" src="../img/<?php echo $uploadDirFileSpec_Product."/".$tampildata['Product_Image'];?>"
			title="Open File <?php echo $tampildata['Product_Image'];?>"
			onClick="popupwindow('../config/popup-img.php?id=<?php echo $tampildata['ID_No'];?>&name=<?php echo $tampildata['Product_Image'];?>&pg=fileSpecProduct','Preview Image','700','1000');"> <?php echo $tampildata['Product_Image'];} ?>
				</td>
            </tr>
			<tr>
			  <td colspan="5">&nbsp;</td>
			</tr>
			<tr>
              <td colspan="2">Remark</td>
              <td colspan="3"><div class="form-group"> <textarea cols="4" id="inputRemark" name="inputRemark"  
			  class="form-control py-4" placeholder="Enter Remark" <?php echo $disabled; ?> 
			  maxlength="100"><?php if ($_POST) { echo $inputRemark; } else {echo @$tampildata['Remark'];} ?></textarea></div></td>
            </tr>
			<tr>
              <td colspan="2" >Workflow Remark *</td>
              <td colspan="5"><div class="form-group"> <textarea cols="4" id="inputWorkflowRemark"  name="inputWorkflowRemark"  
			  class="form-control py-4" placeholder="Workflow Remark" 
				<?php echo $disabled; ?>><?php echo @$tampildataReq['Remark_WorkFlow']; ?></textarea></div>			  </td>
            </tr>
			<tr>
			  <td colspan="5">&nbsp;</td>
			</tr>
          </table>
		  <button type="submit" name="Send" value="Send" 
		  onclick="return checkSendApproval(spec)" class="btn btn-primary" 
		  <?php if (@$tampildata['Status_Spec']=="" || @$tampildata['Status_Spec']=="Draft" 
		  || @$tampildata['Status_Spec']=="Revise" ) 
		  {echo $disabled;} else {echo "disabled='disabled'";} ?>>Send Approval</button>
 		<?php if (@$tampildata['Status_Spec']<>"Cancel")  {?>
		  <button type="submit" name="Save" value="<?php if ($button=="add-spec-product" || $button=="add-revise-spec-product") {echo"Save";} else {echo"Update";}  ?>"
		  onclick="return checkDraft()" class="btn btn-primary" 
		  <?php if (@$tampildata['Status_Spec']=="Complete" || @$tampildata['Status_Spec']<>"Draft")  {echo $disabled;} ?>>Draft </button>
		  <?php ;} ?>
		  <?php if (@$tampildata['Status_Spec']=="Complete" &&  $button!="add-revise-spec-product")  {?>
		  <button type="button"  class='btn btn-primary' data-toggle='modal' data-target='#show' data-id="<?php echo @$tampildata['Request_No']; ?>">
		  Revise</button>

	      <?php ;} ?>
		  <?php if (@$tampildata['Status_Spec']=="Complete"|| @$tampildata['Status_Spec']=="Revise")  {?>
		  <button type="submit" name="Save" value="Cancel" onClick="return checkCancel()" 
		  class="btn btn-primary">Cancel Request</button>
	      <?php ;} ?>

		  

		  <a class="btn btn-primary" href="../dist/index.php?button=spec-product" title="Back Format No Request">Back</a> 
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
	 
	function checkSendApproval(form){
	if (form.inputAutoRequestNo.value == ""){
    	alert("Request No Can not be empty *");
    	form.inputAutoRequestNo.focus();
    	return (false);  		}
	else if (form.inputBrand.value == "-"){
    	alert("Brand Can not be empty *");
    	form.inputBrand.focus();
    	return (false);  		}
	else if (form.inputProductCode.value == ""){
    	alert("Product Code Can not be empty *");
    	form.inputProductCode.focus();
    	return (false);  		}
	else if (form.inputBarcode.value == ""){
    	alert("Barcode Can not be empty *");
    	form.inputBarcode.focus();
    	return (false);  		}
	else if (form.inputProductName.value == ""){
    	alert("Product Name Can not be empty *");
    	form.inputProductName.focus();
    	return (false);  		}	
	else if (form.inputIsiNetto.value == ""){
    	alert("Netto Can not be empty *");
    	form.inputIsiNetto.focus();
    	return (false);  		}
	else if (form.inputBisnis.value == "-"){
    	alert("Bisnis Can not be empty *");
    	form.inputBisnis.focus();
    	return (false);  		}
	else if (form.inputPICProdev.value == "-" || form.inputPICProdev.value == ""){
    	alert("PIC Prodev Can not be empty *");
    	form.inputPICProdev.focus();
    	return (false);  		}
	else if (form.inputCategory.value == "-"){
    	alert("Category Can not be empty *");
    	form.inputCategory.focus();
    	return (false);  		}
	else if (form.inputWorkflowRemark.value == ""){
    	alert("Work flow Remark Can not be empty *");
    	form.inputWorkflowRemark.focus();
    	return (false);  		}
		return confirm('Are you sure you want to Send Approval?');
	}

	 function checkDraft(){
		return confirm('Are you sure you want to Save Draft this data?');
	}	
	function checkCancel(){
		return confirm('Are you sure you want to Cancel Request this data?');
	}
	function checkRevise(form){
		return confirm('Are you sure you want to Revise Request this data?');
	}
	</script>
	

		<!-- js untuk jquery -->
	<script src="../../js/jquery-1.11.2.min.js"></script>
	<!-- js untuk bootstrap -->
	<script src="../../js/bootstrap.js"></script>
	<!-- js untuk bootstrap datetimepicker -->
	<script src="../../js/bootstrap-select.min.js"></script>

 
 
	 

	</body>
</html>

<!-- Modal start here -->
<div class="modal fade" id="show" role="dialog">
		<div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><b>Revise Specification Product</b></h4>
                </div>
                <div class="modal-body">
                    <div class="modal-data"></div>
                </div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
            </div>
      </div>
	  
</div>


<!-- Ini merupakan script yang terpenting -->
<script type="text/javascript">
    $(document).ready(function(){
        $('#show').on('show.bs.modal', function (e) {
            var getDetail = $(e.relatedTarget).data('id');
			 
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url: "spec-product/spec-product-revise.php",
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getDetail='+ getDetail,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

<script type="text/javascript">
$(document).ready(function(){
	$("#inputBisnis").change(function(){
      	var inputBisnis = $("#inputBisnis").val();
		var inputPICProdev = $("#inputPICProdev").val();
        $.ajax({
          	type: 'POST',
			  url: "spec-product/spec-product-load-pic.php",
            data: {inputPICProdev: inputPICProdev,inputBisnis:inputBisnis},
            cache: false,
            success: function(msg){
                $("#inputPICProdev").html(msg);
            }
        });
    });
});
</script>