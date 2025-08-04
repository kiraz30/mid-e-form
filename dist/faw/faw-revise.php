	<?php $Send		= @$_POST['Send']; ?>
	<?php $Save		= @$_POST['Save']; ?>
<?php include "faw-javascrift.php"; ?>

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
		document.faw.InputCFMCode.focus();	
		document.faw.InputFNIMCode.focus();
	}
function setFocusChecklist(){
		document.faw.inputAutoRequestNo.focus();
		document.faw.inputLastRequestNo.focus();
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
	
		<!-- Custom CSS -->
		<link href="../css/sb-admin-2.css" rel="stylesheet">
	
		<!-- Custom Fonts -->
		<link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    </head>
	<body onload='setFocus(),setFocusChecklist();' > 
	<main> 
    <div class="container-fluid"> 
      <h3 class="mt-4"><?php if ($button=="add-faw" || $button=="add-revise-faw")
	  {echo "New Request FAW";} else  {echo "Edit Request FAW";} ?> </h3>
	    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="../dist/index.php?button=dashboard">Dashboard</a></li>
		<li class="breadcrumb-item"><a href="../dist/index.php?button=faw">Final Art Work (FAW)</a></li>
        <li class="breadcrumb-item active"><?php if ($button=="add-faw" || $button=="add-revise-faw")
	  {echo "New Request FAW";} else  {echo "Edit Request FAW";} ?> </li>
      </ol>
 	<div class="card mb-4">
	    <div class="card-header"> </div>

        <div class="card-body"> 
			
        <?php
		include "faw-autonumber.php";
      	$exe =mysqli_query($con,"SELECT a.ID_No,a.Index_Document,a.Request_No,a.Last_Request_No,a.Status_Last_Document,
		a.CFM_Code,b.FNIM_Code, e.Request_No AS MPR_Code,b.ID_No_FNIMDetail, f.Code_Product,d.Product_Name,
		d.Status_Product,c.Type_Request,g.Country,a.Remark,a.Status_FAW,a.Matarial_Name,a.Supplier_Name,
		a.CreatedBy,date(a.CreatedDate) as Created_Date FROM 					
		tb_faw a INNER JOIN tb_cfm b ON a.CFM_Code =b.Request_No
		INNER JOIN tb_fnim c ON b.FNIM_Code =c.Request_No
		INNER JOIN tb_fnim_detail d ON b.ID_No_FNIMDetail =d.ID_No
		LEFT JOIN tb_mpr e ON c.Request_No=e.FNIM_Code
		LEFT JOIN tb_mpr_detail f ON e.Request_No=f.Request_No AND f.ID_NoFNIMDetail= d.ID_No
		LEFT JOIN tb_fnim_country g ON b.ID_No_FNIM_Country=g.ID_No
		WHERE a.Request_No = '".@$_GET['id']."'	And a.Status_FAW='Revise' ");
        $tampildata=mysqli_fetch_array($exe);
		$isinetto="";
		$exeNetto = mysqli_query($con,"SELECT  Request_No,  ID_No, Isi_Net, Netto,  Index_No 
		FROM tb_fnim_detail_netto   WHERE Request_No = '".@$tampildata['FNIM_Code']."' And
		ID_No_FnimDetail='".@$tampildata['ID_No_FNIMDetail']."'  Order By ID_No Asc");
		while(@$rowFNIMDetailNetto =mysqli_fetch_array($exeNetto)){ 
			$isinetto=$isinetto.@$rowFNIMDetailNetto['Isi_Net']." ".@$rowFNIMDetailNetto['Netto'].", ";
		} 
		//echo substr($isinetto,0,-2); 
		
		
		mysqli_query($con,"UPDATE tb_inbox SET ReadInbox='1' Where (NameApproval= '$username' Or OnBehalf='$username') 
		And Request_No='".@$_GET['id']."' And ReadInbox='0'");
		//________________________________________________________________________________StatusFNIM disabled
		if (@$tampildata['Status_FAW']<>"Draft" && @$tampildata['Status_FAW']<>"" && @$tampildata['Status_FAW']<>"Revise") {$disabled="disabled";} else{$disabled="";}

		//________________________________________________________________________________WORKFLOWNPRF
		$exeRevise = mysqli_query($con,"SELECT Step_Revise,Index_No,Revise FROM tb_workflownprf  WHERE Request_No = '".@$_GET['id']."'
		and Revise = '$username' and StatusWorkFlow IS NOT null GROUP BY Step_Revise,Revise LIMIT 1");
		$tampildataRevise=mysqli_fetch_array($exeRevise);
		$NextRevise=$tampildataRevise['Index_No']+1;
		//________________________________________________________________________________
        
	  	?>
	<form name="faw" action="" method="post"  enctype="multipart/form-data"  >
    <?php 
	//Begin CRUD----------------------------------------------------------------------
	
	$Attachment_Image			= "../img/Attachment_Image/";
	if($_POST){
			$ip						=$_SERVER['REMOTE_ADDR'];
		$hostname 				= gethostbyaddr($_SERVER['REMOTE_ADDR']);
		date_default_timezone_set("Asia/Jakarta");
		$createddate			=date("Y-m-d H:i:s");
		$yymmddhMs				=date("YmdHis");
		
    	$tempFormatNoRequest  	= $_POST['tempFormatNoRequest'];
		$inputAutoRequestNo		= $_POST['inputAutoRequestNo'];
		$inputLastRequestNo		= @$_POST['inputLastRequestNo'];
		$InputCFMCode			= @$_POST['InputCFMCode'];
		$InputMaterialName		= @$_POST['InputMaterialName'];
		$InputSupplierName		= @$_POST['InputSupplierName'];
		$inputProductCode 	 	= @$_POST['inputProductCode']; 
		$inputProductName	 	= @$_POST['inputProductName'];
		$inputNetto			 	= @$_POST['inputNetto'];
		$inputRequestType		= @$_POST['inputRequestType'];
		$inputCountry			= @$_POST['inputCountry'];
		$InputStatus			= @$_POST['InputStatus'];
		$inputRemark			= @$_POST['inputRemark'];
		$inputWorkflowRemark	= @$_POST['inputWorkflowRemark'];
		$InputFA 				= @$_POST['InputFA'];
		$InputPMMID				= @$_POST['InputPMMID'];
					
		if($Save=="Update"){ 
			//membuat Query untuk update data
			include "faw-save-edit.php";		
			include "faw-save-file-new.php";
			
			$message = "Data successfully Update to database";
			echo "<script type='text/javascript'>alert('$message');</script>";
			echo"<script>  window.location='../dist/index.php?button=faw'; </script>";
		}
		elseif($Save=="Cancel"){ 
			include "faw-save-edit.php";
			mysqli_query($con,"UPDATE tb_faw SET Status_FAW='Cancel' WHERE Request_No='$inputAutoRequestNo'");
			mysqli_query($con,"UPDATE tb_inbox SET Request_Status='Cancel' WHERE Request_No='$inputAutoRequestNo'");
			
			$message = "Data successfully Cancel Request";
			echo "<script type='text/javascript'>alert('$message');</script>";
			echo"<script>  window.location='../dist/index.php?button=faw'; </script>";
			}
		elseif($Send=="Send"){ 
			include "faw-autonumber.php";
			$Tanya = mysqli_query($con,"SELECT Request_No FROM tb_faw WHERE Request_No = '$inputAutoRequestNo' ");
			if (mysqli_num_rows($Tanya) !=0 ) {
				//Update Sent FAW
				include "faw-save-edit.php";		
				include "faw-save-file-new.php";
				mysqli_query($con,"UPDATE tb_faw SET Status_FAW='Sent',
				UpdatedBy='$username',UpdatedDate='$createddate',UpdatedHostName='$ip : $hostname' 
				WHERE Request_No='$inputAutoRequestNo'");
			}
			//Delete Checklist FAW
			mysqli_query($con,"DELETE From tb_faw_check_app WHERE Request_No='$inputAutoRequestNo' And Workflow_Index_No !=1");
			//DeleteWorkFlow FAW
			mysqli_query($con,"DELETE From tb_workflownprf WHERE Request_No='$inputAutoRequestNo' And StatusWorkFlow Is Null");
			//Simpan WorkFlow FAW
			$cari =mysqli_query($con,"SELECT a.WorkFlowProcess,a.WorkFlowMenu,a.LevelProcess,b.NameApproval,b.OnBehalf, 
			a.Revise, b.Index_No,a.Index_No AS Index_Process FROM tb_workflowprocess a  INNER JOIN tb_workflowapproval b 
			ON  a.WorkFlowProcess =b.UserDomain AND a.WorkFlowMenu=b.WorkFlowMenu AND a.WorkFlowMenu='FAW' 
			AND a.UserDomain='$tampildata[CreatedBy]' AND a.Index_No >='$tampildataRevise[Step_Revise]' ORDER BY a.ID_No ,b.Index_No");
			$indexno=1;
			
			
			while($caridata =mysqli_fetch_array(@$cari)){
				mysqli_query($con,"Insert INTO tb_workflownprf (Request_No,WorkFlowMenu,LevelProcess,NameApproval,OnBehalf,Revise,Step_Revise,Index_No,CreatedBy,CreatedDate,CreatedHostName) 
				values ('$inputAutoRequestNo','$caridata[WorkFlowMenu]','Step $caridata[Index_No]','$caridata[NameApproval]',
				'$caridata[OnBehalf]','$caridata[Revise]','$caridata[Index_Process]','$indexno','$username','$createddate','$ip : $hostname')");
				$indexno++;	
			}
			
			
			//Update WorkFlow NPRF
			mysqli_query($con,"UPDATE tb_workflownprf SET StatusWorkFlow='S',ReadWorkFlow='1',Remark_WorkFlow='$inputWorkflowRemark',
			Approve='$username',ApproveDate='$createddate',Status_Approval='1' WHERE Request_No='$inputAutoRequestNo' And Index_No='$tampildataRevise[Index_No]'");
			
			//Send Email Notification for Approval 2-------------------------------------------------
			$exeNext = mysqli_query($con,"Select NameApproval,OnBehalf FROM tb_workflownprf 
			WHERE Request_No='$inputAutoRequestNo' And Index_No='$NextRevise' ");
        	$tampildataNext=mysqli_fetch_array($exeNext);
			$app1=$tampildataNext['NameApproval'];
			$app2=$tampildataNext['OnBehalf'];
			$remark=$inputWorkflowRemark;
			$id=$inputAutoRequestNo;
			$page="faw-app";
			$WorkFlowMenu="FAW";
			$Confirm=="Approve";
			require ("../config/emailapp.php");
			if (mysqli_num_rows($exeNext) !=0 ) { 
					if ($tampildataNext['OnBehalf']<>"-" || $tampildataNext['OnBehalf']==""){
						$StatusFAW= "Waitting Approval By " .$tampildataNext['NameApproval']." Or ".$tampildataNext['OnBehalf'];}
					else {
						$StatusFAW= "Waitting Approval By " .$tampildataNext['NameApproval'];}
						$StatusInbox="W";
				}
				else {
					$StatusFAW="Complete";
					$StatusInbox="C";
				}
			//Simpan Inbox
			mysqli_query($con,"UPDATE tb_inbox Set Thema_Name='$inputProductName',Request_Type='$inputRequestType',
			Request_Status='$StatusInbox',ReadInbox='0',UpdatedBy='$username',
			NameApproval='".$tampildataNext['NameApproval']."',OnBehalf='".$tampildataNext['OnBehalf']."',
			Remark='$inputRemark',UpdatedDate='$createddate',UpdatedHostName='$ip : $hostname'  
			WHERE Request_No='$tempFormatNoRequest'");
			//---------------------------------------------------------------------------------------
			
			//UPDATE STATUS NPRF
			mysqli_query($con,"UPDATE tb_faw Set Status_FAW='$StatusFAW' WHERE Request_No='$tempFormatNoRequest'");
			
			$message = "Data successfully Sent  to Approval";
			echo "<script type='text/javascript'>alert('$message');</script>";
			echo"<script>  window.location='../dist/index.php?button=faw'; </script>";
		}
	}
		//End CRUD----------------------------------------------------------------------
		
		$exe =mysqli_query($con,"SELECT * FROM tb_faw where Request_No = '".@$_GET['id']."'
		And Status_FAW='Revise'");
		if (mysqli_num_rows($exe) ==0 ) { 
		echo"<h3>Tidak ada request yang harus di Revise</h3><br><br>";
		echo'<a class="btn btn-primary" href="../dist/index.php?button=faw" title="Back faw">Back</a>';}
	
		else {
		
		?>
		
          <table width="100%" border="0" class="table table-striped" id="dataTables-example" >
            <tr>
              <td width="20%"><span class="form-group">Request No *</span></td>
              <td colspan="2"><span class="form-group">
				<input name="tempFormatNoRequest" type="hidden" value="<?php echo $tampildata['Request_No']; ?>">
                <input class="form-control py-4"  name="inputAutoRequestNo" id="inputAutoRequestNo"  
				maxlength="50" type="text" placeholder="Auto Request No" 
				onChange="setFocusChecklist(),get_ChecklistFAW()" onFocus="setFocusChecklist(),get_ChecklistFAW()" readonly="readonly" 
			  value="<?php if ($button=="add-faw") {echo $NomorReq;} elseif ($button=="add-revise-faw") 
			  {echo substr($tampildata['Request_No'],0,17)."-R".$rev;} else {echo @$tampildata['Request_No'];} ?>" />
              </span> </td>
            </tr>
            <tr>
              <td width="20%"><span class="form-group">Last Request No *</span></td>
              <td colspan="2"><span class="form-group">
                <input class="form-control py-4"  name="inputLastRequestNo" id="inputLastRequestNo"  maxlength="50" type="text"  
			  placeholder="Auto Request No" onChange="setFocusChecklist(),get_ChecklistFAW()" onFocus="setFocusChecklist(),get_ChecklistFAW()"  readonly="readonly" 
			  value="<?php if (@$tampildata['Status_FAW']=="Complete" & $button=="add-revise-faw") 
			  {echo @$tampildata['Request_No'];} else {echo @$tampildata['Last_Request_No'];}?>" />
              </span> </td>
            </tr>
 
            <tr>
              <td><span class="form-group">Final Art Work Request No *</span></td>
              <td width="50%"><div class="form-group d-flex align-items-center justify-content-between mt-0 mb-1">
			  	<input type="text" class="form-control"  name="InputCFMCode" id="InputCFMCode" 
				placeholder="Final Art Work Request No"  
				value="<?php if ($_POST) { echo $InputCFMCode; } else {echo @$tampildata['CFM_Code'];} ?>" 
				onChange="setFocus(),get_detaildata()" onFocus="setFocus(),get_detaildata()" readonly="readonly">
				&nbsp;<button type="button" style="padding:2px 4px 4px 4px" 
			   class="btn btn-primary" title="Search Project Name"  
					name="btnsearch" 
					onClick="popupwindow('faw/project-name-popup.php?id=faw','Search Project Name','600','900');" <?php echo $disabled; ?>>
					<span class="glyphicon glyphicon-search" ></span> </button>
				</div>
			  </td>
	 
            </tr>


			<tr>
              <td>FNIM Request No *</td>
              <td colspan="3"><span class="form-group">
                <input class="form-control py-4" name="InputFNIMCode" id="InputFNIMCode" 
				maxlength="50" type="text" placeholder="Enter FNIM Request No"  
				value="<?php if ($_POST) { echo $InputFNIMCode; } else {echo @$tampildata['FNIM_Code'];} ?>"
				onChange="setFocus(),get_FileMPR()" onFocus="setFocus(),get_FileMPR()" readonly="readonly">
              </span>
			  </td>
            </tr>
            <tr>
              <td>Product Code *</td>
              <td width="20%">
			    <input class="form-control py-4"  name="inputProductCode" id="inputProductCode"  maxlength="50" type="text"  
			  	placeholder="Enter Product Code" disabled="disabled" 
			  	value="<?php  if (@$tampildata['Code_Product']=='') {echo "XXXXXX";} else {echo @$tampildata['Code_Product'];}?>" />
              </td>
			  <td width="20%">
			  </td>
			  
 
			<tr>
              <td>Product Name *</td>
              <td colspan="3"><span class="form-group">
                <input class="form-control py-4" name="inputProductName" id="inputProductName" 
				maxlength="50" type="text" placeholder="Enter Product Name"  
				value="<?php if ($_POST) { echo $inputProductName; } else {echo @$tampildata['Product_Name'];} ?>"
				readonly="readonly" >
              </span>
			  </td>
            </tr>

            <tr>
              <td>Netto *</td>
              <td>
				<input class="form-control py-4" name="inputNetto" id="inputNetto" 
				maxlength="50" type="text" placeholder="Enter Netto"  
				value="<?php if ($_POST) { echo $inputNetto; } else {echo substr($isinetto,0,-2);} ?>"
				disabled="disabled" > </td>
            </tr>
 
            <tr>
              <td>Request Type * - Country</td>
              <td colspan="3"> <div class="form-group d-flex align-items-center justify-content-between mt-0 mb-1">
			  <input class="form-control py-4" name="inputRequestType" id="inputRequestType" 
				maxlength="50" type="text" placeholder="Enter Request Type"  
				value="<?php if ($_POST) { echo $inputRequestType; } else {echo @$tampildata['Type_Request'];} ?>"
				readonly="readonly" > - 
				<input class="form-control py-4" name="inputCountry" id="inputCountry" 
				maxlength="50" type="text" placeholder="Enter Country"  
				value="<?php if ($_POST) { echo $inputCountry; } else {echo @$tampildata['Country'];} ?>"
				readonly="readonly" ></div>
			   </td>
            </tr>
            <tr>
              <td>Status *</td>
              <td>
				<input class="form-control py-4" name="InputStatus" id="InputStatus" 
				maxlength="50" type="text" placeholder="Enter Status"  
				value="<?php if ($_POST) { echo $InputStatus; } else {echo @$tampildata['Status_Product'];} ?>"
				disabled="disabled" >
			   </td>
            </tr>
			<tr>
              <td>Material Name *</td>
              <td>
				<input class="form-control py-4" name="InputMaterialName" id="InputMaterialName" 
				maxlength="50" type="text" placeholder="Enter Material Name"  
				value="<?php if ($_POST) { echo $InputMaterialName; } else {echo @$tampildata['Matarial_Name'];} ?>">
			   </td>
            </tr>
			<tr>
              <td>Supplier Name *</td>
              <td>
				<input class="form-control py-4" name="InputSupplierName" id="InputSupplierName" 
				maxlength="50" type="text" placeholder="Enter Supplier Name"  
				value="<?php if ($_POST) { echo $InputSupplierName; } else {echo @$tampildata['Supplier_Name'];} ?>">
			   </td>
            </tr>
			
			<tr>
              <td>Memberikan FA (setelah selesai step 2) kepada supplier</td>
              <td>
				<input class="form-control py-4" name="InputFA" id="InputFA" <?php echo $disabled; ?>
				type="date" placeholder="Enter Memberikan FA (setelah selesai step 2) kepada supplier"  
				value="<?php if ($_POST) { echo $InputFA; } else {echo @$tampildata['Memberikan_FA'];} ?>">
			   </td>
            </tr>
			<tr>
              <td>Packaging Material diterima MID</td>
              <td>
				<input class="form-control py-4" name="InputPMMID" id="InputPMMID" <?php echo $disabled; ?>
				 type="date" placeholder="Packaging Material diterima MID"  
				value="<?php if ($_POST) { echo $InputPMMID; } else {echo @$tampildata['Memberikan_FA'];} ?>">
			   </td>
            </tr>
			
			<tr>
              <td colspan="3">
			 <table name="AttachMPR" id="AttachMPR"  width="100%" border="1" class="table table-striped table-bordered table-hover" >
		
				  </table>			  
			  </td>
			</tr>


			<tr>
              <td colspan="3">
			  <table name="Attach" id="Attach"  width="100%" border="1" class="table table-striped table-bordered table-hover" ></table>
			  </td>
            </tr>
			
			<tr>
              <td colspan="3">
			  <table name="Checklist-FAW" id="Checklist-FAW"  width="100%" border="1" class="table table-striped table-bordered table-hover" ></table>
			  </td>
            </tr>
            <tr>
              <td>Remark *</td>
              <td colspan="2"><div class="form-group"> <textarea cols="4" id="inputRemark" name="inputRemark"  
			  class="form-control py-4" placeholder="Enter Remark" <?php echo $disabled; ?> 
			  maxlength="100"><?php if ($_POST) { echo $inputRemark; } else {echo @$tampildata['Remark'];} ?></textarea></div>
			  </td>
            </tr>
			<?php if (@$tampildata['Status_FAW']<>"Complete") {?>	
			<tr>
              <td>Workflow Remark *</td>
              <td colspan="2"><div class="form-group"> <textarea cols="4" id="inputWorkflowRemark"  name="inputWorkflowRemark"  
			  class="form-control py-4" placeholder="Enter Workflow Remark" maxlength="100"
				<?php echo $disabled; ?>><?php if ($_POST) { echo $inputWorkflowRemark; } 
				else {echo @$tampildataReq['Remark_WorkFlow'];} ?></textarea></div>
			  </td>
            </tr>
			<?php ;}?>
			<tr>
              <td colspan="3"> </td>
            </tr>
	
          </table>
		   <button type="submit" name="Send" value="Send" onClick="return checkSendApproval(faw)" 
		  	class="btn btn-primary" <?php echo $disabled; ?>>Send Approval </button>
		<button type="submit" name="Save" value="Update" onClick="return checkEdit(faw)"  
		class="btn btn-primary">Save</button>
		 <?php if (@$tampildata['Status_FAW']=="Complete" & $button!="add-revise-cfm" || @$tampildata['Status_FAW']=="Revise" & $button!="add-revise-cfm")  {?>
		  <button type="submit" name="Save" value="Cancel" onClick="return checkCancel(faw)" 
		  class="btn btn-primary">Cancel Request</button>
	      <?php ;} ?>
		  <a class="btn btn-primary" href="../dist/index.php?button=faw" title="Back Format No Request">Back</a> 
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
        $('#cfmdetail').DataTable({
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
	else if (form.InputCFMCode.value == ""){
    	alert("Final Art Work Request No Can not be empty *");
    	form.InputCFMCode.focus();
    	return (false);  		}
	else if(form.inputProductCode.value==""){
		alert("Product Code Can not be empty!");
		form.inputProductCode.focus();
    	return (false);  		}
	else if(form.inputProductName.value==""){
		alert("Product Name Can not be empty!");
		form.inputProductName.focus();
    	return (false);  		}
	else if(form.InputStatus.value==""){
		alert("Status Can not be empty!");
		form.InputStatus.focus();
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

	</body>
</html>

<script language="JavaScript" type="text/javascript">
	function checkDraft(form){
	if (form.inputAutoRequestNo.value == ""){
    	alert("Request No Can not be empty *");
    	return (false);  		}
	else if (form.InputFNIMCode.value == ""){
    	alert("Master Product Request No Can not be empty *");
    	form.InputFNIMCode.focus();
    	return (false);  		}
	else if(form.inputProductCode.value==""){
		alert("Product Code Can not be empty!");
		form.inputProductCode.focus();
    	return (false);  		}

		return confirm('Are you sure you want to Draft this data?');
	}
	function checkEdit(form){
		return confirm('Are you sure you want to Update this data?');
	}
	
	
	function checkCancel(form){
		return confirm('Are you sure you want to Cancel Request this data?');
	}
</script>
 

<?php if ($button=="add-revise-faw"){ ?>
<script>
$(document).ready(function(){
 $('#InputCFMCode').click(function(){
  get_detaildata();
 });
});
 function get_detaildata(){
  var a = $('#InputCFMCode').val();
  var b = $('#inputLastRequestNo').val();

  $.ajax({
   type: 'POST',
   url: "faw/faw-load-attchment.php",
   
   data: { data1: a, data2: b},
   success: function(info) {
	$("#Attach").html(info);  
	}
  });
  return false;
 }
</script>
<?php ;} else {?>
<script>
$(document).ready(function(){
 $('#InputCFMCode').click(function(){
  get_detaildata();
 });
});
 function get_detaildata(){
  var a = $('#InputCFMCode').val();
  var b = $('#inputAutoRequestNo').val();

  $.ajax({
   type: 'POST',
   url: "faw/faw-load-attchment.php",
   
   data: { data1: a, data2: b},
   success: function(info) {
	$("#Attach").html(info);  
	}
  });
  return false;
 }
</script>
<?php ;} ?>
<script>
$(document).ready(function(){
 $('#InputFNIMCode').click(function(){
  get_FileMPR();
 });
});
 function get_FileMPR(){
  var a = $('#InputFNIMCode').val();

  $.ajax({
   type: 'POST',
   url: "faw/faw-load-mpr-attchment.php",
   
   data: { data1: a},
   success: function(info) {
	$("#AttachMPR").html(info);  
	}
  });
  return false;
 }
</script>

<?php if ($button=="add-revise-faw"){ ?>
<script>
$(document).ready(function(){
 $('#inputLastRequestNo').click(function(){
  get_ChecklistFAW();
 });
});
 function get_ChecklistFAW(){
  var a = $('#inputLastRequestNo').val();
  var b = 'add-revise-faw';  
  $.ajax({
   type: 'POST',
   url: "faw/faw-load-checklist.php",
   
   data: { data1: a, data2: b},

   success: function(info) {
	$("#Checklist-FAW").html(info);  
	}
  });
  return false;
 }
</script>

<?php ;} else {?>
<script>
$(document).ready(function(){
 $('#inputAutoRequestNo').click(function(){
  get_ChecklistFAW();
 });
});
 function get_ChecklistFAW(){
  var a = $('#inputAutoRequestNo').val();
  var b = <?php @$button; ?> 
  $.ajax({
   type: 'POST',
   url: "faw/faw-load-checklist.php",
   
   data: { data1: a, data2: b},
   success: function(info) {
	$("#Checklist-FAW").html(info);  
	}
  });
  return false;
 }
</script>
<?php ;} ?>


<?php ;}?>