<?php 
$Send		= @$_POST['Send'];
$Save		= @$_POST['Save']; 
?>
 
 

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
<script language="JavaScript">
	function setFocus(){
		document.mpr.InputMPRCode.focus();
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
	function angka(e) {
  		if (!/^[0-9-,-.]+$/.test(e.value)) {
    		e.value = e.value.substring(0,e.value.length-100);
  		}
	}

</script>

<?php include "spec-product-javascrift.php"; ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Static Navigation - SB Admin</title>
		<link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	
		<!-- MetisMenu CSS -->
		<link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
	
		<!-- Custom CSS -->
		<link href="../css/sb-admin-2.css" rel="stylesheet">
	
		<!-- Custom Fonts -->
		<link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    </head>
	</head>
	<body> 
	<main> 
    <div class="container-fluid"> 
      <h3 class="mt-4">Request Specification Product</h3>
	    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="../dist/index.php?button=dashboard">Dashboard</a></li>
		<li class="breadcrumb-item"><a href="../dist/index.php?button=inbox">Inbox</a></li>
        <li class="breadcrumb-item active">Request Specification Product </li>
		
      </ol>
 	<div class="card mb-4">
	    <div class="card-header"> </div>
    <div class="card-body"> 
			
        <?php
		include "spec-product-autonumber.php";
 		$exe =mysqli_query($con,"SELECT a.ID_No,a.Index_Document,a.Request_No,a.Last_Request_No,a.Status_Last_Document,
		a.MPR_Code,a.Brand,a.Bisnis,a.PIC_Prodev,a.Category,a.Code_Product,a.BARCODE,a.Product_Name,a.Isi_Net,a.Netto,
		a.ProjectStatus1,a.ProjectStatus2,a.ProjectStatus3,a.ProjectStatus4,
		a.Description AS Description_SP,a.ProjectStatus,a.Notifikasi_BPOM,a.Halal_Number,a.Product_Image,
		a.SizeOfProduct,a.SizeOfProduct_P,a.SizeOfProduct_L,a.SizeOfProduct_T,a.SizeOfProduct_Satuan,
		a.InnerPack_P,a.InnerPack_L,a.InnerPack_T,a.InnerPack_Satuan,
		a.SizeOfCartton_IS_P,a.SizeOfCartton_IS_L,a.SizeOfCartton_IS_T,a.SizeOfCartton_IS_Satuan,
		a.SizeOfCartton_OS_P,a.SizeOfCartton_OS_L,a.SizeOfCartton_OS_T,a.SizeOfCartton_OS_Satuan,
		a.DznCtn,a.DznCtn_Keterangan,a.WeighOfContenCtn,a.WeighOfContenCtn_Satuan,Status_Spec,Remark
		FROM tb_spec_product a where a.Request_No = '".@$_GET['id']."'");
        $tampildata=mysqli_fetch_array(@$exe);
			//________________________________________________________________________________UPDATE READ INBOX
		mysqli_query($con,"UPDATE tb_inbox SET ReadInbox='1' Where (NameApproval= '$username' Or OnBehalf='$username') 
		And Request_No='".@$_GET['id']."' And ReadInbox='0'");

 

	//________________________________________________________________________________NEXT APPROVE
	$exeWFP = mysqli_query($con,"SELECT WorkFlowMenu,Index_No,NameApproval,OnBehalf,StatusWorkFlow FROM tb_workflownprf 
	WHERE (NameApproval='$username' or OnBehalf ='$username') And Request_No = '".@$_GET['id']."' AND StatusWorkFlow IS null");
	$tampildataWFR=mysqli_fetch_array($exeWFP);
	$NextStep_Index= $tampildataWFR['Index_No']+1;
	//________________________________________________________________________________WORK FLOW Back PROCESS
	$exeWFBP = mysqli_query($con,"SELECT WorkFlowMenu,Index_No,NameApproval,OnBehalf,StatusWorkFlow FROM tb_workflownprf 
	WHERE (NameApproval='$username' or OnBehalf ='$username') And Request_No = '".@$_GET['id']."' AND StatusWorkFlow IS null");
	$tampildataWFBR=mysqli_fetch_array($exeWFBP);
	$BackStep_Index= $tampildataWFBR['Index_No']-1;
	
	//________________________________________________________________________________StatusMPR disabled
	$exeWFMPR = mysqli_query($con,"SELECT LevelProcess,Step_Revise,WorkFlowMenu,Index_No,NameApproval,OnBehalf,
	StatusWorkFlow,Approve_No FROM tb_workflownprf WHERE (NameApproval='$username' or OnBehalf ='$username')  And 
	Request_No = '".@$_GET['id']."' AND StatusWorkFlow IS NULL LIMIT 1");
	$tampildataWFMPR=mysqli_fetch_array($exeWFMPR);
	
	//________________________________________________________________________________
	if (@$tampildataWFMPR['Approve_No']==1 && @$tampildataWFMPR['Step_Revise']==1) {$readonlyMSSupport='';} else  {$readonlyMSSupport='disabled ="disabled"';} //PRODEV 			
	if (@$tampildataWFMPR['Approve_No']==1 && @$tampildataWFMPR['Step_Revise']==2) {$readonlyPRODEV='';} else  {$readonlyPRODEV='disabled ="disabled"';} //PRODEV 
	if (@$tampildataWFMPR['Approve_No']==1 && @$tampildataWFMPR['Step_Revise']==3) {$readonlyPCD='';} else  {$readonlyPCD='disabled ="disabled"';} //Packaging 
	if (@$tampildataWFMPR['Approve_No']==1 && @$tampildataWFMPR['Step_Revise']==4) {$readonlyReg='';} else  {$readonlyReg='disabled ="disabled"';} //Registrasi
	if (@$tampildataWFMPR['Approve_No']==1 && @$tampildataWFMPR['Step_Revise']==5) {$readonlyQC='';} else  {$readonlyQC='disabled ="disabled"';} //QC
	if (@$tampildataWFMPR['Approve_No']==1 && @$tampildataWFMPR['Step_Revise']==6) {$readonlyLMF='';} else  {$readonlyLMF='disabled ="disabled"';} //Advertising
		 					
	?>
	<form name="spec" action="" method="post"  enctype="multipart/form-data"  >
    <?php 
	//Begin CRUD-----spec-product----------------------------------------------------------------
	$datenow						= date("Y-m-d");

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
		$inputCategory					= @$_POST['inputCategory'];
		$inputProductCode				= @$_POST['inputProductCode'];
		$inputBarcode		 			= @$_POST['inputBarcode'];
		$inputProductName				= @$_POST['inputProductName'];
		
		$Selectbulan					= @$_POST['Selectbulan'];
		$SelectTahun					= @$_POST['SelectTahun'];
		$inputProjectStatus				= @$_POST['inputProjectStatus'];
		if (!@$_POST['ChkProjectStatus1']){$valProjectStatus1=0;} else {$valProjectStatus1=1;}
		if (!@$_POST['ChkProjectStatus2']){$valProjectStatus2=0;} else {$valProjectStatus2=1;}
		if (!@$_POST['ChkProjectStatus3']){$valProjectStatus3=0;} else {$valProjectStatus3=1;}
		if (!@$_POST['ChkProjectStatus4']){$valProjectStatus4=0;} else {$valProjectStatus4=1;}
		$inputProductShortDescription	= @$_POST['inputProductShortDescription'];
		$inputIsiNetto					= @$_POST['inputIsiNetto'];
		$inpuNet						= @$_POST['inpuNet'];

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
		if($Send=="Send"){ 
			if ($Confirm=="Approve"){
				include "spec-product-save-app.php";
				//Simpan WorkFlow MPR
				mysqli_query($con,"UPDATE tb_workflownprf SET StatusWorkFlow='C',ReadWorkFlow='1',Remark_WorkFlow='$inputWorkflowRemark',
				Approve='$username',ApproveDate='$createddate',Status_Approval='1' WHERE Request_No='$tempFormatNoRequest' 
				And Index_No='".$tampildataWFR['Index_No']."' AND StatusWorkFlow IS null Order By ID_No Desc limit 1" );

				//Send Email Notification for Approval 2-------------------------------------------------
				$exeNext = mysqli_query($con,"Select NameApproval,OnBehalf FROM tb_workflownprf 
				WHERE Request_No='$tempFormatNoRequest' And Index_No='$NextStep_Index' And StatusWorkFlow is null limit 1");
				$tampildataNext=mysqli_fetch_array($exeNext);
				$app1=@$tampildataNext['NameApproval'];
				$app2=@$tampildataNext['OnBehalf'];
				$remark=$inputWorkflowRemark;
				$id=$tempFormatNoRequest;
				$page="ps-app";
				$WorkFlowMenu="PS";
				if (mysqli_num_rows($exeNext) !=0 ) { 
					if ($app2<>"-" || $app2==""){
						$StatusPS= "Waitting Approval By " .$app1.$app2;
					} else {
						$StatusPS= "Waitting Approval By " .$app1;
					}
					$StatusInbox="W";
					$Status_Last_Document="0";
					$Confirm=="Approve";
					require ("../config/emailapp.php");
				} else {
					$StatusInbox="C";
					$Status_Last_Document="1";
					$Confirm=="Approve";
					$StatusPS="Complete";
					require ("../config/emailcomplite.php");
				}
				//Simpan Inbox
				mysqli_query($con,"UPDATE tb_inbox Set Request_Status='$StatusInbox',ReadInbox='0',UpdatedBy='$username',
				NameApproval='".@$tampildataNext['NameApproval']."',OnBehalf='".@$tampildataNext['OnBehalf']."',
				UpdatedDate='$createddate',UpdatedHostName='$ip : $hostname'  WHERE Request_No='$tempFormatNoRequest'");
				
				//UPDATE STATUS tb_spec_product
				mysqli_query($con,"UPDATE tb_spec_product Set Status_Spec='$StatusPS',
				Status_Last_Document='$Status_Last_Document'  WHERE Request_No='$tempFormatNoRequest'");
				
				//---------------------------------------------------------------------------------------
				$message = "Data successfully Sent to Approval";
				echo "<script type='text/javascript'>alert('$message');</script>";
				echo"<script>  window.location='../dist/index.php?button=inbox'; </script>";
			}
			if ($Confirm=="Revise"){
				include "spec-product-save-app.php";
				//Simpan WorkFlow SP
				mysqli_query($con,"UPDATE tb_workflownprf SET StatusWorkFlow='R',ReadWorkFlow='1',Remark_WorkFlow='$inputWorkflowRemark', 
				Approve='$username',ApproveDate='$createddate' WHERE Request_No='$tempFormatNoRequest' 
				And Index_No='".$tampildataWFR['Index_No']."'");
				
				//Send Email Notification for Revise ___________________________________________________
				
				$exeBack = mysqli_query($con,"Select Revise FROM tb_workflownprf 
				WHERE Request_No='$tempFormatNoRequest' And Index_No='$BackStep_Index'");
				$tampildataBack=mysqli_fetch_array($exeBack);
				
				$apprevise=$tampildataBack['Revise'];
				$remark=$inputWorkflowRemark;
				$id=$tempFormatNoRequest;
				$page="revise-ps";
				$WorkFlowMenu="PS";
				if (mysqli_num_rows($exeBack) !=0 ) { 
					$StatusPS= "Revise";
					$StatusInbox="R";
					require ("../config/emailrevise.php");
				} else {
					$StatusPS="Complete";
					$StatusInbox="C";
				}
				//Simpan Inbox
				mysqli_query($con,"UPDATE tb_inbox Set Request_Status='$StatusInbox',ReadInbox='0',UpdatedBy='$username',
				NameApproval='".$tampildataBack['Revise']."',OnBehalf='',
				UpdatedDate='$createddate',UpdatedHostName='$ip : $hostname' 
				WHERE Request_No='$tempFormatNoRequest'");
				 //UPDATE STATUS tb_spec_product
				mysqli_query($con,"UPDATE tb_spec_product Set Status_Spec='$StatusPS' WHERE Request_No='$tempFormatNoRequest'");
				
			 	//_________________________________________________________________________________________

				$message = "Data successfully Sent  to Approval";
				echo "<script type='text/javascript'>alert('$message');</script>";
				echo"<script>  window.location='../dist/index.php?button=inbox'; </script>";
				}
			}	
		}	
		//End CRUD----------------------------------------------------------------------
		$exe =mysqli_query($con,"SELECT * FROM tb_inbox where Request_No = '".@$_GET['id']."'
		And (NameApproval= '$username' Or OnBehalf='$username') And Request_Status ='W'");
		if (mysqli_num_rows($exe) ==0 ) { 
			echo"<h3>Tidak ada request yang harus di approve</h3><br><br>";
			echo'<a class="btn btn-primary" href="../dist/index.php?button=inbox" title="Back Inbox">Back</a>';}
		else {
			
	?>
        <table width="100%" border="0" class="table table-striped" id="dataTables-example" >
		<tr>
			<td width="12%" rowspan="11" valign="center" ><span class="form-group"><strong>I. Marketing Support</strong></span></td>
			<td width="20%"><span class="form-group">Request No * </span></td>
            <td colspan="2"><span class="form-group">
				<input name="tempFormatNoRequest" id="tempFormatNoRequest" type="hidden" value="<?php echo $tampildata['Request_No']; ?>">
                <input class="form-control py-4"  name="inputAutoRequestNo" id="inputAutoRequestNo"  
				maxlength="50" type="text" placeholder="Auto Request No" readonly="readonly" 
			  value="<?php  echo @$tampildata['Request_No'];?>" />
              </span> </td>
            </tr>
            <tr>
              <td width="20%"><span class="form-group">Last Request No  </span></td>
              <td colspan="2"><span class="form-group">
                <input class="form-control py-4"  name="inputLastRequestNo" id="inputLastRequestNo"  maxlength="50" type="text"  
			  placeholder="Auto Request No"  readonly="readonly" value="<?php echo @$tampildata['Last_Request_No'];?>" />
              </span> </td>
            </tr>



			<tr>
				<td width="20%"><span class="form-group">Master Product Request No</span></td>
				<td colspan="3"><span class="form-group"> 
					<input name="tempMPRDetail" type="hidden" value="<?php echo @$tampildata['ID_NoMPRDetail']; ?>">
					<input name="tempMPRFNIM" type="hidden" value="<?php echo @$tampildata['FNIM_Code']; ?>">
					<input name="tempFNIMDetail" type="hidden" value="<?php echo @$tampildata['ID_NoFNIMDetail']; ?>">
					<input class="form-control py-4"  name="InputMPRCode" id="InputMPRCode"  maxlength="50" type="text"  
					placeholder="Master Product Request No" readonly="readonly" value="<?php echo @$tampildata['MPR_Code']; ?>" />
					 
					</span>
				
				</td>
            </tr>
			<tr>	 
				<td><span class="form-group">Brand</span></td>
				<td colspan="3">
					<span class="form-group"> 
					<select class="form-control" id="inputBrand" name="inputBrand"  <?php echo $readonlyMSSupport; ?> >
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
			  </select>	</span>
				</td>
            </tr>
			<tr>	 
				<td><span class="form-group">Product Code</span></td>
				<td colspan="3">
					<span class="form-group"> 
						<input class="form-control py-0"  name="inputProductCode" id="inputProductCode"
						<?php echo $readonlyMSSupport; ?>
						maxlength="50" type="text" value="<?php  if ($_POST) { echo $inputProductCode; } else { echo @$tampildata['Code_Product'];} ?>" />
					</span>
				</td>
            </tr>
			<tr>
				<td><span class="form-group">Product Barcode</span></td>
				<td colspan="3">
					<span class="form-group"> 
						<input class="form-control py-4"  name="inputBarcode" id="inputBarcode"
						<?php echo $readonlyMSSupport; ?>
						maxlength="50" type="text" value="<?php if ($_POST) { echo $inputBarcode; } else {echo @$tampildata['BARCODE'];} ?>" />
					</span>
				</td>
            </tr>
			 
			<tr>
				<td><span class="form-group">Product Name </span></td>
				<td colspan="3">
					<span class="form-group"> 
						<input class="form-control py-4"  name="inputProductName" id="inputProductName" disabled ="disabled"    
						maxlength="50" type="text"  value="<?php echo @$tampildata['Product_Name']; ?>" />
					</span>
				</td>
            </tr>
			<tr>
				<td><span class="form-group">Netto </span></td>
				<td>
					<div class="form-group d-flex align-items-center justify-content-between mt-0 mb-0">
						<input class="form-control py-4"  name="inputIsiNetto" id="inputIsiNetto"  
						onKeyUp="return angka(this);" disabled ="disabled"
						maxlength="50" type="text" value="<?php echo @$tampildata['Isi_Net']; ?>"  />
						<select class="form-control col-md-2"  id="inpuNet" 
						name="inpuNet" disabled ="disabled" >
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
				<td><span class="form-group">CATEGORY 7 [BISNIS]</span></td>
				<td colspan="3"><span class="form-group"> 
				<select class="form-control" id="inputBisnis" name="inputBisnis" <?php echo $readonlyMSSupport; ?>>
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
				<td><span class="form-group">PIC Prodev</span></td>
				<td colspan="3"><span class="form-group"> 
					<select class="form-control" id="inputPICProdev" name="inputPICProdev" <?php echo $readonlyMSSupport; ?> >
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
				<td><span class="form-group">CATEGORY 9 [CATEGORY]</span></td>
				<td colspan="3"><span class="form-group"> 
				<select class="form-control" id="inputCategory" name="inputCategory" <?php echo $readonlyMSSupport; ?>>
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
			  <td colspan="5">&nbsp;</td>
			</tr>
			<tr>
				<td rowspan="3" ><span class="form-group"><strong>II. Product Development</strong></span></td>
				<td rowspan="2"><span class="form-group">Project Status *</span></td>
				<td colspan="3">
					<span class="form-group"> 
					<table cellpadding="0" cellspacing="0" border="0"width="100%"  >
					<tr>
						<td style="text-align:left; width:120px; height:20px;">
							<label><input type="checkbox" name="ChkProjectStatus1" id="ChkProjectStatus1"  <?php echo $readonlyPRODEV; ?> 
							<?php if (@$tampildata['ProjectStatus1']=="1") { echo 'checked="checked"';} ?>> New</label></td>
						<td style="text-align:left; width:120px; height:20px;">
							<label><input type="checkbox" name="ChkProjectStatus2" id="ChkProjectStatus2"   <?php echo $readonlyPRODEV; ?> 
							<?php if (@$tampildata['ProjectStatus2']=="1") { echo 'checked="checked"';} ?> > Renewal</label></td>
						<td style="text-align:left; width:120px; height:20px;">
							<label><input type="checkbox" name="ChkProjectStatus3" id="ChkProjectStatus3"  <?php echo $readonlyPRODEV; ?> 
							<?php if (@$tampildata['ProjectStatus3']=="1") { echo 'checked="checked"';} ?>  > Refine</label></td>
						<td style="text-align:left; width:120px; height:20px;">
							<label><input type="checkbox" name="ChkProjectStatus4" id="ChkProjectStatus4"  <?php echo $readonlyPRODEV; ?>  
							<?php if (@$tampildata['ProjectStatus4']=="1") { echo 'checked="checked"';} ?> > Others</label></td>
					</tr>
					</table>					
					</span>
				</td>
			</tr>
			<tr>
				<td colspan="4">
					<textarea cols="4" id="inputProjectStatus" name="inputProjectStatus"  
					class="form-control py-4" placeholder="Others Project Status" <?php echo $readonlyPRODEV; ?> 
			  		maxlength="100"><?php if ($_POST) { echo $inputProjectStatus; } else {echo @$tampildata['ProjectStatus'];} ?></textarea>
			  	</td>
			</tr>
					
				
            
			<tr>
				<td><span class="form-group">Product Short Description *</span></td>
				<td colspan="3"><span class="form-group"> <textarea cols="4" id="inputProductShortDescription" 
					name="inputProductShortDescription"  class="form-control py-4"  
					placeholder="Enter Product Short Description" <?php echo $readonlyPRODEV; ?> 
					maxlength="200"><?php if ($_POST) { echo $inputProductShortDescription; } else {echo @$tampildata['Description_SP'];} ?></textarea>
				</div></td>
            </tr>
			<tr>
			  <td colspan="5">&nbsp;</td>
			</tr>
			<tr>
				<td width="1%"><span class="form-group"><strong>III. Packaging Development</strong></span></td>
				<td><span class="form-group">Size of Product *</span></td>
				<td colspan="3">
					<span class="form-row"> 
						<span class="col-md-8"> 
							<span class="form-group">
								<div class="form-group d-flex align-items-center justify-content-between mt-0 mb-0">
									<select class="form-control" id="selectSizeofProduct" name="selectSizeofProduct"
									<?php echo $readonlyPCD; ?> onChange="DisplayShowHide()" 
										onFocus=" DisplayShowHide()" >
										<option value="" <?php if (@$tampildata['SizeOfProduct']=='')  {echo "Selected"; }?> ></option>
										<option value="Ø"<?php if (@$tampildata['SizeOfProduct']=='Ø') {echo "Selected"; }?> >Ø</option>
									</select> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
									<input class="form-control py-4"  name="inputSizeofProduct_P" id="inputSizeofProduct_P"  
									maxlength="50" type="text" <?php echo $readonlyPCD;?>  onKeyUp="return angka(this);"
									placeholder="Enter P" value="<?php echo @$tampildata['SizeOfProduct_P']; ?>"   />
									 &nbsp;&nbsp;X&nbsp;&nbsp;  
									<input class="form-control py-4"  name="inputSizeofProduct_L" id="inputSizeofProduct_L"  
									maxlength="50" type="text" <?php echo $readonlyPCD; ?> onKeyUp="return angka(this);"
									placeholder="Enter L" value="<?php echo @$tampildata['SizeOfProduct_L']; ?>"   />
									&nbsp;&nbsp;X&nbsp;&nbsp; 
									<input class="form-control py-4"  name="inputSizeofProduct_T" id="inputSizeofProduct_T"  
									maxlength="50" type="text"   <?php echo $readonlyPCD; ?> onKeyUp="return angka(this);"
									placeholder="Enter T" value="<?php echo @$tampildata['SizeOfProduct_T']; ?>"   />
								</div>
							</span>
						</span>	
						<span class="col-md-2"> 
							<span class="form-group"> 
								<select class="form-control" id="inputSizeOfProduct_Satuan"  
								name="inputSizeOfProduct_Satuan" <?php echo $readonlyPCD; ?> >
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
				<td width="15%"><span class="form-group">Inner Pack *</span></td>
				<td colspan="3">
					<span class="form-row"> 
						<span class="col-md-6"> 
							<span class="form-group">
								<div class="form-group d-flex align-items-center justify-content-between mt-0 mb-0">
									<input class="form-control py-4"  name="inputInnerPack_P" id="inputInnerPack_P"  
									maxlength="50" type="text"  <?php echo $readonlyPCD; ?>  onKeyUp="return angka(this);"
									placeholder="Enter P" value="<?php echo @$tampildata['InnerPack_P']; ?>"   />
									 &nbsp;&nbsp;X&nbsp;&nbsp;  
									<input class="form-control py-4"  name="inputInnerPack_L" id="inputInnerPack_L"  
									maxlength="50" type="text"   <?php echo $readonlyPCD; ?> onKeyUp="return angka(this);"
									placeholder="Enter L" value="<?php echo @$tampildata['InnerPack_L']; ?>"  />
									&nbsp;&nbsp;X&nbsp;&nbsp; 
									<input class="form-control py-4"  name="inputInnerPack_T" id="inputInnerPack_T"  
									maxlength="50" type="text"   <?php echo $readonlyPCD; ?> onKeyUp="return angka(this);"
									placeholder="Enter T" value="<?php echo @$tampildata['InnerPack_T']; ?>"  />
								</div>
							</span>
						</span>	
						<span class="col-md-2"> 
							<span class="form-group"> 
								<select class="form-control" id="inputInnerPack_Satuan"  
								name="inputInnerPack_Satuan"  <?php echo $readonlyPCD; ?>>
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
				<td width="15%"><span class="form-group">Inner Size *</span></td>
				<td colspan="3">
					<span class="form-row"> 
						<span class="col-md-6"> 
							<span class="form-group">
								<div class="form-group d-flex align-items-center justify-content-between mt-0 mb-0">
									<input class="form-control py-4"  name="inputSizeOfCartton_IS_P" id="inputSizeOfCartton_IS_P"  
									maxlength="50" type="text"   <?php echo $readonlyPCD; ?> onKeyUp="return angka(this);"
									placeholder="Enter P" value="<?php echo @$tampildata['SizeOfCartton_IS_P']; ?>"  />
									 &nbsp;&nbsp;X&nbsp;&nbsp;  
									<input class="form-control py-4"  name="inputSizeOfCartton_IS_L" id="inputSizeOfCartton_IS_L"  
									maxlength="50" type="text"   <?php echo $readonlyPCD; ?> onKeyUp="return angka(this);"
									placeholder="Enter L" value="<?php echo @$tampildata['SizeOfCartton_IS_L']; ?>"  />
									&nbsp;&nbsp;X&nbsp;&nbsp; 
									<input class="form-control py-4"  name="inputSizeOfCartton_IS_T" id="inputSizeOfCartton_IS_T"  
									maxlength="50" type="text"   <?php echo $readonlyPCD; ?> onKeyUp="return angka(this);"
									placeholder="Enter T" value="<?php echo @$tampildata['SizeOfCartton_IS_T']; ?>"  />
								</div>
							</span>
						</span>	
						<span class="col-md-2"> 
							<span class="form-group"> 
								<select class="form-control" id="inputSizeOfCartton_IS_Satuan"  
								name="inputSizeOfCartton_IS_Satuan"  <?php echo $readonlyPCD; ?>>
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
				<td width="15%"><span class="form-group">Outer Size * </span></td>
				<td colspan="3">
					<span class="form-row"> 
						<span class="col-md-6"> 
							<span class="form-group">
								<div class="form-group d-flex align-items-center justify-content-between mt-0 mb-0">
									<input class="form-control py-4"  name="inputSizeOfCartton_OS_P" id="inputSizeOfCartton_OS_P"  
									maxlength="50" type="text"  <?php echo $readonlyPCD; ?>  onKeyUp="return angka(this);"
									placeholder="Enter P" value="<?php echo @$tampildata['SizeOfCartton_OS_P']; ?>" />
									 &nbsp;&nbsp;X&nbsp;&nbsp;  
									<input class="form-control py-4"  name="inputSizeOfCartton_OS_L" id="inputSizeOfCartton_OS_L"  
									maxlength="50" type="text"   <?php echo $readonlyPCD; ?> onKeyUp="return angka(this);"
									placeholder="Enter L" value="<?php echo @$tampildata['SizeOfCartton_OS_L']; ?>" />
									&nbsp;&nbsp;X&nbsp;&nbsp; 
									<input class="form-control py-4"  name="inputSizeOfCartton_OS_T" id="inputSizeOfCartton_OS_T"  
									maxlength="50" type="text"   <?php echo $readonlyPCD; ?> onKeyUp="return angka(this);"
									placeholder="Enter T" value="<?php echo @$tampildata['SizeOfCartton_OS_T']; ?>" />
								</div>
							</span>
						</span>	
						<span class="col-md-2"> 
							<span class="form-group"> 
								<select class="form-control" id="inputSizeOfCartton_OS_Satuan" 
								name="inputSizeOfCartton_OS_Satuan"  <?php echo $readonlyPCD; ?> >
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
				<td><span class="form-group">Dzn / Ctn *</span></td>
				<td colspan="3">
					<span class="form-row"> 
						<span class="col-md-2"> 
							<span class="form-group">
								<div class="form-group d-flex align-items-center justify-content-between mt-0 mb-0">
									<input class="form-control py-4"  name="inpuDsn_Ctn" id="inpuDsn_Ctn"  
									maxlength="50" type="text"   <?php echo $readonlyPCD; ?> 
									placeholder="Dzn" value="<?php echo @$tampildata['DznCtn']; ?>" />
								</div>
							</span>
						</span>
						&nbsp;&nbsp;Keterangan&nbsp;&nbsp;  
						<span class="col-md-8"> 
							<span class="form-group"> 
								<input class="form-control py-4"  name="inpuDsnCtn_Keterangan" id="inpuDsnCtn_Keterangan"  
									maxlength="50" type="text"  <?php echo $readonlyPCD; ?> 
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
					maxlength="50" type="text"  <?php echo $readonlyReg; ?> 
					placeholder="Notification BPOM" value="<?php echo @$tampildata['Notifikasi_BPOM']; ?>" />
					</span>
				</td>
            </tr>
			<tr>
				<td><span class="form-group">Halal Number</span></td>
				<td colspan="3"><span class="form-group">
					<input class="form-control py-4"  name="inputHalalNumber" id="inputHalalNumber"  
					maxlength="50" type="text"  <?php echo $readonlyReg; ?> 
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
				maxlength="50" type="text"  <?php echo $readonlyQC; ?>  
				placeholder="Enter Weight of Content / Carton" value="<?php echo @$tampildata['WeighOfContenCtn']; ?>" />

				<select class="form-control col-md-2" id="inputWeightofContent_Satuan" 
				name="inputWeightofContent_Satuan"  <?php echo $readonlyQC; ?> >
					<option value="gr" <?php if (@$tampildata['WeighOfContenCtn_Satuan']=='gr') {echo "Selected"; }?>>gr</option>
				</select> 
				</div>
				</td>
				<td>  ( gr )</td>
            </tr>
			 <tr>
			  <td colspan="5">&nbsp;</td>
			</tr>
			<tr>
				<td><span class="form-group"><strong>VI. Advertising</strong></span></td>
				<td><span class="form-group">Product Image (Max 3MB)</span></td>
				<td colspan="3"> <input  type="file" id="Inputfile" name="Inputfile" 
				accept="image/*"  <?php echo $readonlyLMF; ?> onChange="return validasiFileImage()"  > 
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
			  class="form-control py-4" placeholder="Enter Remark" <?php echo $readonlyMSSupport; ?>
			  maxlength="100"><?php if ($_POST) { echo $inputRemark; } else {echo @$tampildata['Remark'];} ?></textarea></div></td>
            </tr>
			<tr>
              <td colspan="2">Confirm *</td>
              <td><div class="form-group"> <input type="radio" id="Confirm" name="Confirm" value="Approve"> Approve </div></td>
			  <td><div class="form-group"><input type="radio" id="Confirm" name="Confirm" value="Revise"> Revise</div></td>
            </tr>
			<tr>
              <td colspan="2" >Workflow Remark *</td>
              <td colspan="5"><div class="form-group"> <textarea cols="4" id="inputWorkflowRemark"  name="inputWorkflowRemark"  
			  class="form-control py-4" placeholder="Workflow Remark" ></textarea></div>			  </td>
            </tr>
			<tr>
			  <td colspan="5">&nbsp;</td>
			</tr>
          </table>
		  <button type="submit" name="Send" value="Send" 
		  onclick="return checkSendApproval(spec)" class="btn btn-primary">Send Approval</button>

		  <a class="btn btn-primary" href="../dist/index.php?button=inbox" title="Back Inbox">Back</a> 
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
      	return (false);  		}
	<?php if (@$tampildataWFMPR['Approve_No']==1 && @$tampildataWFMPR['Step_Revise']==2) {?>//PRODEV
	else if (form.ChkProjectStatus1.checked==false && form.ChkProjectStatus2.checked==false  &&  form.ChkProjectStatus3.checked==false && form.ChkProjectStatus4.checked==false ){
    	alert("Project Status Can not be empty *");
    	return (false);  		}
	else if (form.inputProductShortDescription.value == ""){
    	alert("Product Short Description Can not be empty *");
    	form.inputProductShortDescription.focus();
    	return (false);  		}		

	<?php } if (@$tampildataWFMPR['Approve_No']==1 && @$tampildataWFMPR['Step_Revise']==3) {?>
		else if (form.selectSizeofProduct.value == "" && form.inputSizeofProduct_P.value == "" ){
	 		alert("Size of Product P Can not be empty *");
    		form.inputSizeofProduct_P.focus();
    		return (false);  		}
		else if (form.inputSizeofProduct_L.value == "" ){
	 		alert("Size of Product L Can not be empty *");
    		form.inputSizeofProduct_L.focus();
    		return (false);  		}
		else if (form.inputSizeofProduct_T.value == "" ){
	 		alert("Size of Product T Can not be empty *");
    		form.inputSizeofProduct_T.focus();
    		return (false);  		}	

		else if (form.inputInnerPack_P.value == "" ){
	 		alert("Inner Pack P Can not be empty *");
    		form.inputInnerPack_P.focus();
    		return (false);  		}
		else if (form.inputInnerPack_L.value == "" ){
	 		alert("Inner Pack L Can not be empty *");
    		form.inputInnerPack_L.focus();
    		return (false);  		}
		else if (form.inputInnerPack_T.value == "" ){
	 		alert("Inner Pack T Can not be empty *");
    		form.inputInnerPack_T.focus();
    		return (false);  		}		

		else if (form.inputSizeOfCartton_IS_P.value == "" ){
	 		alert("Size of Carton Inner Pack P Can not be empty *");
    		form.inputSizeOfCartton_IS_P.focus();
    		return (false);  		}
		else if (form.inputSizeOfCartton_IS_L.value == "" ){
	 		alert("Size of Carton Inner Pack L Can not be empty *");
    		form.inputSizeOfCartton_IS_L.focus();
    		return (false);  		}
		else if (form.inputSizeOfCartton_IS_T.value == "" ){
	 		alert("Size of Carton Inner Pack T Can not be empty *");
    		form.inputSizeOfCartton_IS_T.focus();
    		return (false);  		}	

		else if (form.inputSizeOfCartton_OS_P.value == "" ){
	 		alert("Size of Carton Outer Size P Can not be empty *");
    		form.inputSizeOfCartton_OS_P.focus();
    		return (false);  		}
		else if (form.inputSizeOfCartton_OS_L.value == "" ){
	 		alert("Size of Carton Outer Size L Can not be empty *");
    		form.inputSizeOfCartton_OS_L.focus();
    		return (false);  		}
		else if (form.inputSizeOfCartton_OS_T.value == "" ){
	 		alert("Size of Carton Outer Size T Can not be empty *");
    		form.inputSizeOfCartton_OS_T.focus();
    		return (false);  		}

		else if (form.inpuDsn_Ctn.value == "" ){
	 		alert("Dzn / Ctn Can not be empty *");
    		form.inpuDsn_Ctn.focus();
    		return (false);  		}		
	<?php } if (@$tampildataWFMPR['Approve_No']==1 && @$tampildataWFMPR['Step_Revise']==4) {?>//REGISTRASI
		else if (form.inputNotificationBPOM.value == "" ){
	 		alert("BPOM Notification Can not be empty *");
    		form.inputNotificationBPOM.focus();
    		return (false);  		}
		else if (form.inputHalalNumber.value == "" ){
	 		alert("Halal Number Can not be empty *");
    		form.inputHalalNumber.focus();
    		return (false);  		}
	<?php } if (@$tampildataWFMPR['Approve_No']==1 && @$tampildataWFMPR['Step_Revise']==5) {?>// QC
		else if (form.inputWeightofContent.value == "" ){
	 		alert("Weight of Content / Carton Can not be empty *");
    		form.inputWeightofContent.focus();
    		return (false);  		}
	<?php } if (@$tampildataWFMPR['Approve_No']==1 && @$tampildataWFMPR['Step_Revise']==6) {?>// Advertising
		else if (form.Inputfile.value == "" ){
	 		alert("Product Image Can not be empty *");
    		form.Inputfile.focus();
    		return (false);  		}			
	<?php }	?>

	else if (form.Confirm.value == ""){
    	alert("Confirm No Can not be empty *");
      	return (false);  		}
	else if (form.inputWorkflowRemark.value == ""){
    	alert("Remark Workflow Can not be empty *");
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
 
 
 
	 

	</body>
</html>
<?php ;}?>