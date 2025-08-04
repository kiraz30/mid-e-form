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
			var Temp = document.createElement("input");
			Temp.type ="hidden";
			Temp.name="TempFile[]";
			Temp.id="TempFile[]";
			cell1.appendChild(Temp);
			
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
			InputName.setAttribute('type',"text");
			InputName.setAttribute('title',"File Name");
			InputName.setAttribute('name',"InputNameFile[]");
			InputName.setAttribute('placeholder',"Enter File Name");
			InputName.setAttribute('id',"InputNameFile[]");
			cell3.appendChild(InputName);	
		}

		function deleteRowfile(tableID) {
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
      <h3 class="mt-4">New Master Product Request (MPR)</h3>
	    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="../dist/index.php?button=dashboard">Dashboard</a></li>
		<li class="breadcrumb-item"><a href="../dist/index.php?button=inbox">Inbox</a></li>
        <li class="breadcrumb-item active">New Master Product Request (MPR)</li>
      </ol>
 	<div class="card mb-4">
	    <div class="card-header"> </div>

        <div class="card-body"> 
			
        <?php
		include "mpr-autonumber.php";
      	$exe =mysqli_query($con,"SELECT ID_No,Request_No,Project_Name,Type_Request,Country,FNIM_Code,Type,Brand,Bisnis,Category,
		Series,Segmentation,CustomerCode,Royalty,KeteranganProduct,NoBarcodeExisting,CustomerCodeFormula,RoyaltyFormula,
		NamaProductSingkat,KelompokStok,Flex,SAP,Status_MPR,Remark,RemarkafterComplete,CreatedBy FROM tb_mpr where Request_No = '".@$_GET['id']."' ");
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
	
	  	?>
	<form name="mpr" id="mpr" action="" method="post"  enctype="multipart/form-data"  >
    <?php 
	//Begin CRUD----------------------------------------------------------------------
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
		$inputRemarkApp			= @$_POST['inputRemarkApp'];
		if (!@$_POST['Flex']){$valFlex=0;} else {$valFlex=1;}
		if (!@$_POST['SAP']){$valSAP=0;} else {$valSAP=1;}
		
		if($Send=="Send"){ 
		if ($Confirm=="Approve"){
			include "mpr-save-edit.php";
			include "mpr-save-detail-new.php";
			//Simpan WorkFlow MPR
			mysqli_query($con,"UPDATE tb_workflownprf SET StatusWorkFlow='C',ReadWorkFlow='1',Remark_WorkFlow='$inputRemarkApp',
			Approve='$username',ApproveDate='$createddate' WHERE Request_No='$tempFormatNoRequest' 
			And Index_No='".$tampildataWFR['Index_No']."' AND StatusWorkFlow IS null");
			
			//Send Email Notification for Approval 2-------------------------------------------------
			$exeNext = mysqli_query($con,"Select NameApproval,OnBehalf FROM tb_workflownprf 
			WHERE Request_No='$tempFormatNoRequest' And Index_No='$NextStep_Index' And StatusWorkFlow is null limit 1");
			$tampildataNext=mysqli_fetch_array($exeNext);
			$app1=$tampildataNext['NameApproval'];
			$app2=$tampildataNext['OnBehalf'];
			$remark=$inputRemarkApp;
			$id=$tempFormatNoRequest;
			$page="mpr-app";
			$WorkFlowMenu="MPR";
			if (mysqli_num_rows($exeNext) !=0 ) { 
				if ($tampildataNext['OnBehalf']<>"-" || $tampildataNext['OnBehalf']==""){
					$StatusMPR= "Waitting Approval By " .$tampildataNext['NameApproval'].$tampildataNext['OnBehalf'];}
				else {
					$StatusMPR= "Waitting Approval By " .$tampildataNext['NameApproval'];
				}
				$StatusInbox="W";
				$Confirm=="Approve";
				require ("../config/emailapp.php");
			} else {
				$StatusInbox="C";
				$Confirm=="Approve";
				$StatusMPR="Complete";
				require ("../config/emailcomplite.php");
			}
			//Simpan Inbox
			mysqli_query($con,"UPDATE tb_inbox Set Request_Status='$StatusInbox',ReadInbox='0',UpdatedBy='$username',
			NameApproval='".$tampildataNext['NameApproval']."',OnBehalf='".$tampildataNext['OnBehalf']."',
			UpdatedDate='$createddate',UpdatedHostName='$ip : $hostname'  WHERE Request_No='$tempFormatNoRequest'");
				
			//UPDATE STATUS MPR
			mysqli_query($con,"UPDATE tb_mpr Set Status_MPR='$StatusMPR' WHERE Request_No='$tempFormatNoRequest'");
				
			//---------------------------------------------------------------------------------------
			$message = "Data successfully Sent to Approval";
			echo "<script type='text/javascript'>alert('$message');</script>";
			echo"<script>  window.location='../dist/index.php?button=inbox'; </script>";
		}
		if ($Confirm=="Revise"){
			include "mpr-save-edit.php";
			include "mpr-save-detail-new.php";

				//Simpan WorkFlow MPR
				mysqli_query($con,"UPDATE tb_workflownprf SET StatusWorkFlow='R',ReadWorkFlow='1',Remark_WorkFlow='$inputRemarkApp', 
				Approve='$username',ApproveDate='$createddate' WHERE Request_No='$tempFormatNoRequest' 
				And Index_No='".$tampildataWFR['Index_No']."'");
				
				//Send Email Notification for Revise ___________________________________________________
				
				//________________________________________________________________________________________
				
				$exeBack = mysqli_query($con,"Select Revise FROM tb_workflownprf 
				WHERE Request_No='$tempFormatNoRequest' And Index_No='$BackStep_Index'");
				$tampildataBack=mysqli_fetch_array($exeBack);
				
				$apprevise=$tampildataBack['Revise'];
				$remark=$inputRemarkApp;
				$id=$tempFormatNoRequest;
				$page="revise-mpr";
				$WorkFlowMenu="MPR";
				if (mysqli_num_rows($exeBack) !=0 ) { 
					$StatusMPR= "Revise";
					$StatusInbox="R";
					require ("../config/emailrevise.php");
				}
				else {
					$StatusMPR="Complete";
					$StatusInbox="C";
				}
				//Simpan Inbox
				mysqli_query($con,"UPDATE tb_inbox Set Request_Status='$StatusInbox',ReadInbox='0',UpdatedBy='$username',
				NameApproval='".$tampildataBack['Revise']."',OnBehalf='',
				UpdatedDate='$createddate',UpdatedHostName='$ip : $hostname' 
				WHERE Request_No='$tempFormatNoRequest'");
				 //UPDATE STATUS NPRF
				mysqli_query($con,"UPDATE tb_mpr Set Status_MPR='$StatusMPR' WHERE Request_No='$tempFormatNoRequest'");
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
              <td width="1%"><span class="form-group">I.</span></td>
              <td width="15%"><span class="form-group"> Request No</span></td>
              <td colspan="3"><span class="form-group">
				<input name="tempFormatNoRequest" type="hidden" value="<?php echo $tampildata['Request_No']; ?>">
                <input class="form-control py-4"  name="inputAutoRequestNo" id="inputAutoRequestNo"  maxlength="50" type="text"  
			  placeholder="Auto Request No" readonly="readonly" value="<?php if ($button=="add-mpr") {echo $NomorReq;} else {echo $tampildata['Request_No'];} ?>" />
              </span> </td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td><span class="form-group">Thema Name *</span></td>
              <td width="25%"><div class="form-group d-flex align-items-center justify-content-between mt-0 mb-1">
                <input class="form-control"  id="inputProjectName" name="inputProjectName" 
			  maxlength="50" type="text" placeholder="Enter Project Name"
			  value="<?php if ($_POST) { echo $inputProjectName; } else {echo $tampildata['Project_Name'];} ?>" 
			   <?php MPRDisable($tampildataWFMPR['Approve_No'],$tampildataWFMPR['LevelProcess'],'Requestor'); ?>/>
                &nbsp;<button type="button" style="padding:2px 4px 4px 4px" 
			   class="btn btn-primary" title="Search Project Name"  
					name="btnsearch" 
					onClick="popupwindow('mpr/project-name-popup.php?id=mpr','Search Project Name','600','700');" 
					<?php MPRDisable($tampildataWFMPR['Approve_No'],$tampildataWFMPR['LevelProcess'],'Requestor'); ?>/>
					<span class="glyphicon glyphicon-search" ></span> </button>
				</div>			  </td>
			  <td width="15%">&nbsp;</td>
			  <td width="30%"><input type="text" class="form-control" name="selectReq" id="selectReq" 
				  placeholder="FNIM Code"  onChange="get_detaildata()" onFocus="get_detaildata()"  
				  value="<?php if ($_POST) { echo $selectReq; } else {echo $tampildata['FNIM_Code'];} ?>"
				  readonly="readonly" >		      </td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td><span class="form-group">Category 2 [Type] * </span></td>
              <td><input class="form-control"  id="InputType" name="InputType" 
				  maxlength="50" type="text" placeholder="Enter Type"
				  value="<?php if ($_POST) { echo $InputType; } else {echo $tampildata['Type'];} ?>" 
				  <?php MPRDisable($tampildataWFMPR['Approve_No'],$tampildataWFMPR['LevelProcess'],'Requestor'); ?>/>			  </td>
	          <td><span class="form-group">Category 4 [Market] *</span></td>
	          <td><div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
			  <input type="text" class="form-control" name="SelectTypeRequest" id="SelectTypeRequest" 
				onfocus="DisplayShowHideExport()" onChange="DisplayShowHideExport()"
				  value="<?php if ($_POST) { echo $SelectTypeRequest; } else {echo $tampildata['Type_Request'];} ?>"
				  readonly="readonly" >		      
				<select class="form-control" id="selectCountry" name="selectCountry" style="visibility: hidden;" disabled="disabled">
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
				</div></td>
			</tr>
            <tr>
              <td>&nbsp;</td>
              <td><span class="form-group">Category 6 [Brand] *</span></td>
              <td><input class="form-control"  id="InputBrand" name="InputBrand" 
			  	maxlength="50" type="text" placeholder="Enter Brand"
			 	value="<?php if ($_POST) { echo $InputBrand; } else {echo $tampildata['Brand'];} ?>" 
			   <?php MPRDisable($tampildataWFMPR['Approve_No'],$tampildataWFMPR['LevelProcess'],'Requestor'); ?>/> </td>
	          <td width="10%"><span class="form-group">Category 7 [Bisnis]
              *</span>			  </td>
	          <td><input type="text" class="form-control" name="InputBisnis" id="InputBisnis" 
				placeholder="Enter Bisnis" 
				value="<?php if ($_POST) { echo $InputBisnis; } else {echo $tampildata['Bisnis'];} ?>" 
			   <?php MPRDisable($tampildataWFMPR['Approve_No'],$tampildataWFMPR['LevelProcess'],'Requestor'); ?>>			   </td>
			</tr>
            <tr>
              <td>&nbsp;</td>
              <td><span class="form-group">Category 8 [Category] *</span></td>
              <td><input class="form-control"  id="InputCategory" name="InputCategory" 
			  	maxlength="50" type="text" placeholder="Enter Category"
			  	value="<?php if ($_POST) { echo $InputCategory; } else {echo $tampildata['Category'];} ?>" 
			   <?php MPRDisable($tampildataWFMPR['Approve_No'],$tampildataWFMPR['LevelProcess'],'Requestor'); ?>>			  </td>
	          <td width="10%"><span class="form-group">Category 9 [Series] *</span></td>
	          <td>
            	<input type="text" class="form-control" name="InputSeries" id="InputSeries" 
				placeholder="Enter Series"
				value="<?php if ($_POST) { echo $InputSeries; } else {echo $tampildata['Series'];} ?>" 
			   <?php MPRDisable($tampildataWFMPR['Approve_No'],$tampildataWFMPR['LevelProcess'],'Requestor'); ?>>			   </td>
			</tr>
			<tr>
              <td>&nbsp;</td>
              <td><span class="form-group">Category 10 [Segmentation] *</span></td>
              <td><input type="text" class="form-control" name="InputSegmentation" id="InputSegmentation" 
				placeholder="Enter Segmentation"
				value="<?php if ($_POST) { echo $InputSegmentation; } else {echo $tampildata['Segmentation'];} ?>" 
			   <?php MPRDisable($tampildataWFMPR['Approve_No'],$tampildataWFMPR['LevelProcess'],'Requestor'); ?>>			   </td>
              
              <td width="10%">&nbsp;</td>
	          <td>&nbsp;</td>
			</tr>
            <tr>
              <td>&nbsp;</td>
              <td><span class="form-group">Royalty Merk</span></td>
              <td colspan="2"><select class="form-control" id="selectCustomerCode" name="selectCustomerCode" 
			 <?php MPRDisable($tampildataWFMPR['Approve_No'],$tampildataWFMPR['LevelProcess'],'Requestor'); ?>>
				<option value="-" >Select Royalty Merk</option>
				<?php
					include "../config/connect_sql.php";
					$query = "select Description from fdTradingPartne where TPType like 'ROYALTY%'";
					$exe = odbc_exec($myConnFlex,$query. " Order By Description Asc " );
					while($b = odbc_fetch_array($exe)){
						if($tampildata['CustomerCode'] == $b['Description']){
							$cek = 'Selected';
						}elseif($selectCustomerCode == $b['Description']){
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
				placeholder="Enter %" maxlength="3" style="text-align:right;"
				onKeyPress="return angka(event)" title="Input Example : 2.5"
				value="<?php if ($_POST) { echo $InputRoyalty; } else {echo $tampildata['Royalty'];} ?>"
				<?php MPRDisable($tampildataWFMPR['Approve_No'],$tampildataWFMPR['LevelProcess'],'Requestor'); ?>> &nbsp;%</div>			  </td>
			</tr>
            <tr>
			  <td>&nbsp;</td>
              <td>Keterangan Product</td>
              <td colspan="3"><span class="form-group"> 
				<textarea rows="2" class="form-control py-2"  id="InputKeteranganProduct" name="InputKeteranganProduct" maxlength="100"
				placeholder="Enter Keterangan Product"
				<?php MPRDisable($tampildataWFMPR['Approve_No'],$tampildataWFMPR['LevelProcess'],'Requestor'); ?>
				><?php if ($_POST) { echo $InputKeteranganProduct; } 
				else{echo $tampildata['KeteranganProduct'];} ?></textarea></span>				</td>
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
              <td colspan="2"><select class="form-control" id="selectCustomerCodeFormula" name="selectCustomerCodeFormula" 
			  		<?php MPRDisable($tampildataWFMPR['Approve_No'],$tampildataWFMPR['LevelProcess'],'Step 4'); ?>>

						<option value="-" >Select Royalty Formula</option>
						<?php
								include "../config/connect_sql.php";
								$query = "select Description from fdTradingPartne where TPType like 'ROYALTY%'";
								$exe = odbc_exec($myConnFlex,$query. " Order By Description Asc " );
								while($b = odbc_fetch_array($exe)){
									if($tampildata['CustomerCodeFormula'] == $b['Description']){
										$cek = 'Selected';
									}elseif($selectCustomerCode == $b['Description']){
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
				onKeyPress="return angka(event)"  title="Input Example : 2.5"
				<?php MPRDisable($tampildataWFMPR['Approve_No'],$tampildataWFMPR['LevelProcess'],'Step 4'); ?>
				value="<?php if ($_POST) { echo $InputRoyaltyFormula; } else {echo $tampildata['RoyaltyFormula'];} ?>"> &nbsp;%				</div>			  </td>
			</tr>
            <tr>
			  <td>IV.</td>
              <td colspan="4">
			  	<table name="mprdetailprod" id="mprdetailprod" width="100%" border="1" 
					class="table table-striped table-bordered table-hover" >
				</table>
			  </td>
            </tr>
            <tr>
			  <td></td>
              <td>Input Product Flex & SAP</td>
              <td colspan="3">
			  <label><input type="checkbox" name="Flex" id="Flex"  
			  <?php MPRDisable($tampildataWFMPR['Approve_No'],$tampildataWFMPR['LevelProcess'],'Step 6'); ?>
			  <?php if ($tampildata['Flex']==1) { echo 'checked="checked"';} 
			  if ($tampildataWFMPR['Approve_No']=="1" & $tampildataWFMPR['LevelProcess']=="Step 6"){ echo" required";}?>>
				1) Flexprocess</label> <br> 
                <label><input type="checkbox" name="SAP" id="SAP" 
				<?php MPRDisable($tampildataWFMPR['Approve_No'],$tampildataWFMPR['LevelProcess'],'Step 6'); ?>
				<?php if ($tampildata['SAP']==1) { echo 'checked="checked"';} 
				if ($tampildataWFMPR['Approve_No']=="1" & $tampildataWFMPR['LevelProcess']=="Step 6"){ echo" required";}?>>
				2) SAP</label></td>
            </tr>
			<tr>
			<td>&nbsp;</td>
              <td colspan="4">
			  <table name="Attach" id="Attach"  width="100%" border="1" class="table table-striped table-bordered table-hover" >
			   
				  <tr>
					<td colspan="10" align="left"><strong>Attachment File (.pdf)</strong></td>
				  </tr>
				  <tr valign="bottom" align="center" bgcolor="#999999" >
					<th width="1%">No</th>
					<th width="35%">File</th>
					<th>Name</th>
				  </tr>
			 
			 	  <?php 
					$exe = mysqli_query($con,"SELECT ID_No,File,Name,Index_No 
					FROM tb_fnim_file Where Request_No = '".$tampildata['Request_No']."'   ");
					$no = 1;
					while(@$rowmprFile =mysqli_fetch_array($exe)){
					?>
				  <tr id="<?php echo $rowMPRDetail['ID_No']; ?>">
					<td style="padding:15px 10px 5px 5px;"><?php echo $no;?></td>
					<td style="padding:10px 5px 5px 5px;">
					<?php if (!empty($rowmprFile['File'])){?>
			  	<img height="20" width="20" src=../img/pdf.png  title="Open File <?php echo $rowmprFile['File'];?>"
				onClick="popupwindow('../config/open-pdf.php?pdfname=<?php echo $rowmprFile['File'];?>&page=filempr','Preview Pdf','700','1000');">
			  	<?php }  ?>				</td>
					<td><input type="text" name="InputNameFile[]" id="InputNameFile[]" class="form-control"
						 value="<?php echo $rowmprFile['Name'];?>"  readonly="readonly"></td>
				  </tr>
				  <?php $no++;} ?>
				  </table>			  </td>
			</tr>
			 <tr>
              <td>&nbsp;</td>
              <td>Remark *</td>
              <td colspan="3"><div class="form-group"> <textarea cols="4" id="inputRemark" name="inputRemark"  
			  class="form-control py-4" placeholder="Enter Remark" maxlength="100" readonly="readonly"><?php if ($_POST) { echo $inputRemark; } else {echo $tampildata['Remark'];} ?></textarea></div></td>
            </tr>
			<tr>
              <td>&nbsp;</td>
			  <td>Confirm</td>
              <td><div class="form-group"> <input type="radio" id="Confirm" name="Confirm" value="Approve"> Approve </div></td>
			  <td colspan="2"><div class="form-group"><input type="radio" id="Confirm" name="Confirm" value="Revise"> Revise</div></td>
            </tr>
            </tr>
			<?php if ($tampildata['Status_MPR']<>"Complete") {?>	
			<tr>
			  <td>&nbsp;</td>
              <td>Remark Approval *</td>
              <td colspan="3"><div class="form-group"><div class="form-group"> <textarea cols="4" id="inputRemarkApp"  name="inputRemarkApp"  
			  class="form-control py-4" 
			placeholder="Enter Remark" ><?php if ($_POST) { echo $inputRemarkApp; }  ?></textarea></div></td>
            </tr>
			<?php ;}?>
			<tr>
              <td colspan="5"></td>
            </tr>
		    </fieldset>
          </table>
			<button type="submit" name="Send" value="Send"  onClick="return checkSendApproval(mpr)" 
					  class="btn btn-primary" <?php if ($tampildataWFR['StatusWorkFlow']=="C" || $tampildataWFR['StatusWorkFlow']=="R") {echo'disabled="disabled"';} ?>>Send</button>

		  <a class="btn btn-primary" href="../dist/index.php?button=inbox" title="Back Format No Request">Back</a> 
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
	  if (form.Confirm.value == ""){
    	alert("Confirm No Can not be empty *");
      	return (false);  		}
	<?php if ($tampildataWFMPR['Approve_No']=="1" &&  $tampildataWFMPR['LevelProcess']=="Step 6"){ ?>
	else if(form.Flex.checked==false && form.SAP.checked==false) {
		alert('please checked SAP and Flex');
    	return (false);  		}
	<?php } ?>
	else if (form.inputRemarkApp.value == ""){
    	alert("Remark No Can not be empty *");
    	form.inputRemarkApp.focus();
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
$(document).ready(function(){
 $('#selectReq').change(function(){
  get_detaildata();
 });
});
 function get_detaildata(){
  var a = $('#selectReq').val();
  var b = $('#inputAutoRequestNo').val();
  var c = <?php echo @$tampildataWFMPR['Approve_No']; ?>;
  var d = <?php echo @$tampildataWFMPR['Step_Revise']; ?>;
  $.ajax({					
   type: 'POST',
   url: "mpr/mpr-load-detail.php",
   data: { data1: a, data2: b, data3: c , data4: d },
   success: function(info) {
    $("#mprdetail").html(info);   }
  });
   $.ajax({
   type: 'POST',
   url: "mpr/mpr-load-detail-prod.php",
   data: { data1: a, data2: b, data3: c , data4: d },
   success: function(info) {
    $("#mprdetailprod").html(info);   }
  });
  return false;
 }
</script>


	</body>
</html>
<?php ;}?>