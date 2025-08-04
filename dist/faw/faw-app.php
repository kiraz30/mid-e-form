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
<script type="text/javascript">
	function popupwindow(url, title, h, w) {
	var left = (screen.width/2)-(w/2);
	var top = (screen.height/2)-(h/2);
	return window.open(url, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
		  return false;
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
	<body onload='setFocus();' > 
	<main> 
    <div class="container-fluid"> 
      <h3 class="mt-4">New Request FAW</h3>
	    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="../dist/index.php?button=dashboard">Dashboard</a></li>
		<li class="breadcrumb-item"><a href="../dist/index.php?button=inbox">Inbox</a></li>
        <li class="breadcrumb-item active">New Request FAW</li>
      </ol>
 	<div class="card mb-4">
	    <div class="card-header"> </div>

        <div class="card-body"> 
			
        <?php
		include "faw-autonumber.php";
		$query="SELECT a.ID_No,a.Index_Document,a.Request_No,a.Last_Request_No,a.Status_Last_Document,
		a.CFM_Code,b.FNIM_Code, c.Request_No AS MPR_Code,b.ID_No_FNIMDetail, f.Code_Product,d.Product_Name,
		d.Status_Product,c.Type_Request,g.Country,a.Remark,a.Status_FAW,a.Matarial_Name,a.Supplier_Name,
		a.Memberikan_FA,a.PM_Diterima_MID,a.CreatedBy,date(a.CreatedDate) as Created_Date FROM 				
		tb_faw a INNER JOIN tb_cfm b ON a.CFM_Code =b.Request_No
		INNER JOIN tb_fnim c ON b.FNIM_Code =c.Request_No
		INNER JOIN tb_fnim_detail d ON b.ID_No_FNIMDetail =d.ID_No
		LEFT JOIN tb_mpr e ON c.Request_No=e.FNIM_Code
		LEFT JOIN tb_mpr_detail f ON e.Request_No=f.Request_No AND f.ID_NoFNIMDetail= d.ID_No
		LEFT JOIN tb_fnim_country g ON b.ID_No_FNIM_Country=g.ID_No WHERE a.Request_No = '".@$_GET['id']."' ";
		$exe =mysqli_query($con,$query);
        $tampildata=mysqli_fetch_array($exe);		
		$isinetto="";
		$exeNetto = mysqli_query($con,"SELECT  Request_No,  ID_No, Isi_Net, Netto,  Index_No 
		FROM tb_fnim_detail_netto   WHERE Request_No = '".@$tampildata['FNIM_Code']."' And
		tb_fnim_detail_netto='".@$tampildata['ID_No_FNIMDetail']."'  Order By ID_No Asc");
		while(@$rowFNIMDetailNetto =mysqli_fetch_array($exeNetto)){ 
			$isinetto=$isinetto.@$rowFNIMDetailNetto['Isi_Net']." ".@$rowFNIMDetailNetto['Netto'].", ";
		} 
 		//echo substr($isinetto,0,-2); 
		//________________________________________________________________________________UPDATE READ INBOX
		mysqli_query($con,"UPDATE tb_inbox SET ReadInbox='1' Where (NameApproval= '$username' Or OnBehalf='$username') 
		And Request_No='".@$_GET['id']."' And ReadInbox='0'");
		//________________________________________________________________________________UPDATE READ INBOX
		$exeWFP = mysqli_query($con,"SELECT WorkFlowMenu,Index_No,LevelProcess,NameApproval,OnBehalf,StatusWorkFlow FROM tb_workflownprf 
		WHERE (NameApproval='$username' or OnBehalf ='$username') And Request_No = '".@$_GET['id']."' AND StatusWorkFlow IS null");
        $tampildataWFR=mysqli_fetch_array($exeWFP);
		$Curent_Index= substr(@$tampildataWFR['LevelProcess'],5,100) ;
		$NextStep_Index= @$tampildataWFR['Index_No']+1;
		//________________________________________________________________________________WORK FLOW Back PROCESS
		$exeWFBP = mysqli_query($con,"SELECT WorkFlowMenu,Index_No,NameApproval,OnBehalf,StatusWorkFlow FROM tb_workflownprf 
		WHERE (NameApproval='$username' or OnBehalf ='$username') And Request_No = '".@$_GET['id']."' AND StatusWorkFlow IS null");
        $tampildataWFBR=mysqli_fetch_array($exeWFBP);
		$BackStep_Index= @$tampildataWFBR['Index_No']-1;
		//________________________________________________________________________________
        
	  	?>
	<form name="faw"  id="faw" action="" method="post"  enctype="multipart/form-data"  >
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
		$inputProductName		= @$_POST['inputProductName'];
		$inputRemarkApp			= @$_POST['inputRemarkApp'];
					
		if($Send=="Send"){ 
			if ($Confirm=="Approve"){
				//Simpan WorkFlow NPRF
				mysqli_query($con,"UPDATE tb_workflownprf SET StatusWorkFlow='C',ReadWorkFlow='1',Remark_WorkFlow='$inputRemarkApp',
				Approve='$username',ApproveDate='$createddate',Status_Approval='1' WHERE Request_No='$tempFormatNoRequest' 
				And Index_No='".@$tampildataWFR['Index_No']."' AND StatusWorkFlow IS null Order By ID_No Desc limit 1");
				
				//Send Email Notification for Approval 2-------------------------------------------------
				$exeNext = mysqli_query($con,"Select NameApproval,OnBehalf FROM tb_workflownprf 
				WHERE Request_No='$tempFormatNoRequest' And Index_No='$NextStep_Index' And StatusWorkFlow is null limit 1");
				$tampildataNext=mysqli_fetch_array($exeNext);
				$app1=@$tampildataNext['NameApproval'];
				$app2=@$tampildataNext['OnBehalf'];
				$remark=$inputRemarkApp;
				$id=$tempFormatNoRequest;
				$page="faw-app";
				$WorkFlowMenu="FAW";
				if (mysqli_num_rows($exeNext) !=0 ) { 
					if ($tampildataNext['OnBehalf']<>"-" || $tampildataNext['OnBehalf']==""){
						$StatusFAW= "Waitting Approval By " .$tampildataNext['NameApproval']." Or ".$tampildataNext['OnBehalf'];}
					else {
						$StatusFAW= "Waitting Approval By " .$tampildataNext['NameApproval'];}
					$StatusInbox="W";
					$Confirm=="Approve";
					$Status_Last_Document="0";
					require ("../config/emailapp.php");
					//Simpan Inbox
					mysqli_query($con,"UPDATE tb_inbox Set Request_Status='$StatusInbox',ReadInbox='0',UpdatedBy='$username',
					NameApproval='".$tampildataNext['NameApproval']."',OnBehalf='".$tampildataNext['OnBehalf']."',
					Remark='$inputRemarkApp',UpdatedDate='$createddate',UpdatedHostName='$ip : $hostname'  
					WHERE Request_No='$tempFormatNoRequest'");
				}
				else {
					$StatusFAW="Complete";
					$StatusInbox="C";
					$Confirm=="Approve";
					$Status_Last_Document="1";
					require ("../config/emailcomplite.php");

					mysqli_query($con,"UPDATE tb_inbox Set Request_Status='$StatusInbox',ReadInbox='0',UpdatedBy='$username',
					UpdatedDate='$createddate',UpdatedHostName='$ip : $hostname'  WHERE Request_No='$tempFormatNoRequest'");
				}
				
				//UPDATE STATUS FAW
				mysqli_query($con,"UPDATE tb_faw Set Status_FAW='$StatusFAW',Status_Last_Document='$Status_Last_Document'
				WHERE Request_No='$tempFormatNoRequest'");
				include "faw-save-file-coment.php";
				include "faw-save-checklist-app.php";
				//---------------------------------------------------------------------------------------
				$message = "Data successfully Sent to Approval";
				echo "<script type='text/javascript'>alert('$message');</script>";
				echo"<script>  window.location='../dist/index.php?button=inbox'; </script>";
				}
			if ($Confirm=="Revise"){
				//Simpan WorkFlow FAW
				//include "nprf-save-workflow.php";	
				mysqli_query($con,"UPDATE tb_workflownprf SET StatusWorkFlow='R',ReadWorkFlow='1',Remark_WorkFlow='$inputRemarkApp', 
				Approve='$username',ApproveDate='$createddate' WHERE Request_No='$tempFormatNoRequest' 
				And Index_No='".$tampildataWFR['Index_No']."'");
				mysqli_query($con,"Update From tb_workflownprf Set Status_Approval ='0'
				WHERE Request_No='$tempFormatNoRequest'");
				
				//Send Email Notification for Revise ___________________________________________________
				
				//________________________________________________________________________________________
				
				$exeBack = mysqli_query($con,"Select Revise FROM tb_workflownprf 
				WHERE Request_No='$tempFormatNoRequest' And Index_No='$BackStep_Index'");
				$tampildataBack=mysqli_fetch_array($exeBack);
				
				$apprevise=@$tampildataBack['Revise'];
				$remark=$inputRemarkApp;
				$id=$tempFormatNoRequest;
				$page="revise-faw";
				$WorkFlowMenu="FAW";
				if (mysqli_num_rows($exeBack) !=0 ) { 
					$StatusFAW= "Revise";
					$StatusInbox="R";
					require ("../config/emailrevise.php");
				}
				else {
					$StatusFAW="Complete";
					$StatusInbox="C";
				}
				//Simpan Inbox
				mysqli_query($con,"UPDATE tb_inbox Set Request_Status='$StatusInbox',ReadInbox='0',UpdatedBy='$username',
				NameApproval='".$tampildataBack['Revise']."',OnBehalf='',
				Remark='$inputRemarkApp',UpdatedDate='$createddate',UpdatedHostName='$ip : $hostname' 
				 WHERE Request_No='$tempFormatNoRequest'");
				 //UPDATE STATUS FAW
				mysqli_query($con,"UPDATE tb_faw Set Status_FAW='$StatusFAW' WHERE Request_No='$tempFormatNoRequest'");
				include "faw-save-file-coment.php";
				include "faw-save-checklist-app.php";
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
              <td width="20%"><span class="form-group">Request No</span></td>
              <td colspan="2"><span class="form-group">
				<input name="tempFormatNoRequest" type="hidden" value="<?php echo $tampildata['Request_No']; ?>">
                <input class="form-control py-4"  name="inputAutoRequestNo" id="inputAutoRequestNo"  maxlength="50" type="text"  
			  placeholder="Auto Request No" readonly="readonly" value="<?php if ($button=="add-cfm") {echo $NomorReq;} else {echo $tampildata['Request_No'];} ?>" />
              </span> </td>
            </tr>
			 <tr>
              <td><span class="form-group">Final Art Work Request No *</span></td>
              <td colspan="2"><span class="form-group d-flex align-items-center justify-content-between mt-0 mb-1">
                <input type="text" class="form-control" name="InputCFMCode" id="InputCFMCode" 
				placeholder="Final Art Work Request No"  
				value="<?php if ($_POST) { echo $InputCFMCode; } else {echo @$tampildata['CFM_Code'];} ?>" 
				disabled="disabled" >
              </span></td>
            </tr>
            <tr>
              <td>FNIM Request No  *</td>
              <td colspan="3"><span class="form-group">
			   <input class="form-control py-4" name="InputMPRCode" id="InputMPRCode" 
				type="hidden"    
				value="<?php if ($_POST) { echo $InputMPRCode; } else {echo @$tampildata['MPR_Code'];} ?>" >
				
                <input class="form-control py-4" name="InputFNIMCode" id="InputFNIMCode" 
				maxlength="50" type="text" placeholder="Enter FNIM Request No"  
				value="<?php if ($_POST) { echo $InputFNIMCode; } else {echo @$tampildata['FNIM_Code'];} ?>"
				onChange="setFocus(),get_FileMPR()" onFocus="setFocus(),get_FileMPR()" readonly="readonly">
              </span>
			  </td>
            </tr>
            <tr>
              <td>Product Code *</td>
              <td colspan="2"><input class="form-control py-4"  name="inputProductCode" id="inputProductCode"  maxlength="50" type="text"  
			  	placeholder="Enter Product Code" disabled="disabled" 
			  	value="<?php  if (@$tampildata['Code_Product']=='') {echo "XXXXXX";} else {echo @$tampildata['Code_Product'];}?>" /></td>
		    </tr>
			<tr>
			  <td>Product Name *</td>
              <td colspan="2"><span class="form-group">
                <input class="form-control py-4" name="inputProductName" id="inputProductName" 
				maxlength="50" type="text" placeholder="Enter Product Name"  
				value="<?php if ($_POST) { echo $inputProductName; } else {echo @$tampildata['Product_Name'];} ?>"
				disabled="disabled" >
              </span></td>
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
				value="<?php if ($_POST) { echo $InputMaterialName; } else {echo @$tampildata['Matarial_Name'];} ?>"
				disabled="disabled">
			   </td>
            </tr>
			<tr>
              <td>Supplier Name *</td>
              <td>
				<input class="form-control py-4" name="InputSupplierName" id="InputSupplierName" 
				maxlength="50" type="text" placeholder="Enter Supplier Name"  
				value="<?php if ($_POST) { echo $InputSupplierName; } else {echo @$tampildata['Supplier_Name'];} ?>"
				disabled="disabled">
			   </td>
            </tr>
			<tr>
              <td>Memberikan FA (setelah selesai step 2) kepada supplier</td>
              <td>
				<input class="form-control py-4" name="InputFA" id="InputFA" disabled="disabled"
				type="date" placeholder="Enter Memberikan FA (setelah selesai step 2) kepada supplier"  
				value="<?php if ($_POST) { echo $InputFA; } else {echo @$tampildata['Memberikan_FA'];} ?>">
			   </td>
            </tr>
			<tr>
              <td>Packaging Material diterima MID</td>
              <td>
				<input class="form-control py-4" name="InputPMMID" id="InputPMMID" disabled="disabled"
				 type="date" placeholder="Packaging Material diterima MID"  
				value="<?php if ($_POST) { echo $InputPMMID; } else {echo @$tampildata['Memberikan_FA'];} ?>">
			   </td>
            </tr>
			<tr>
              <td colspan="3">
			 	<table name="AttachMPR" id="AttachMPR"  width="100%" border="1" class="table table-striped table-bordered table-hover" >
				<tr>
					<th colspan="3" align="left"><strong>Lampiran</strong></th>
				</tr>
				<tr valign="bottom" align="center" bgcolor="#999999" >
					<th width="1%">No</th>
					<th width="35%">File</th>
					<th>Name</th>
				</tr>
				<?php 
				$exe = mysqli_query($con,"SELECT ID_No,File,Name,Index_No 
				FROM tb_fnim_file Where Request_No = '".@$tampildata['MPR_Code']."' ");
				$no = 1;
				if (mysqli_num_rows($exe) !=0 ) {
				while(@$RowMPRFile =mysqli_fetch_array($exe)){
				?>
				<tr id="<?php echo $RowMPRFile['ID_No']; ?>">
					<td style="padding:15px 10px 5px 5px;"><?php echo $no;?></td>
					<td style="padding:10px 5px 5px 5px;"><?php if (!empty($RowMPRFile['File'])){?>
						<img height="20" width="20" src=../img/pdf.png  title="Open File <?php echo $RowMPRFile['File'];?>"
						onClick="popupwindow('../config/open-pdf.php?pdfname=<?php echo $RowMPRFile['File'];?>&page=filempr','Preview Pdf','700','1000');">
			  	<?php }  ?>				
				</td>
				<td><input type="text" name="InputNameFile[]" id="InputNameFile[]" class="form-control"
				value="<?php echo $RowMPRFile['Name'];?>"  readonly="readonly">
				</td>
			</tr>
			  <?php $no++;}} else {echo  '<tr>
			  <td colspan="7" align="center">Tidak ada data yang ditampilkan</td>
			  </tr>';} ?>
				
			</table>			  
			</td>
			</tr>
			<tr>
              <td colspan="3">
			  <table name="Attach" id="Attach"  width="100%" border="1" class="table table-striped table-bordered table-hover" >
			   
				  <tr>
					<td colspan="10" align="left"><strong>Attachment File FAW</strong></td>
				  </tr>
				  <tr valign="bottom" align="center" bgcolor="#999999" >
					<th width="3%"></th>
					<th width="10%">Gambar CFM</th>
					<th width="15%">Kemasan</th>
					<th width="15%">Posisi</th>
					<th width="10%">Gambar FAW</th>
					<th>Komentar</th>
					<th width="1%">History</th>
				  </tr>
					 <?php
					$exe = mysqli_query($con,"SELECT a.ID_No,a.ID_No_CFM_File,b.`File` AS FileCFM ,a.`File`,
					a.Kemasan,a.Posisi,a.Index_No FROM tb_faw_file a INNER JOIN tb_cfm_file b ON a.ID_No_CFM_File =b.ID_No 
					Where a.Request_No  = '".$tampildata['Request_No']."'   ");
					$no = 1;
					if (mysqli_num_rows($exe) !=0 ) {
					while(@$rowFAWFile =mysqli_fetch_array($exe)){
					?>
				  <tr>
					<td><?php echo $no;?></td>
					<td>
					<input type="hidden" name="tempfileid[]" id="tempfileid[]" value="<?php echo $rowFAWFile['ID_No'];?>">
					<?php if (!empty($rowFAWFile['FileCFM'])){?>
					<img src="../img/Attachment_Image/<?php echo $rowFAWFile['FileCFM'];?>"
					   class="img-fluid" width="100" onClick="popupwindow('../config/popup-img.php?id=<?php echo $rowFAWFile['ID_No_CFM_File'];?>&name=<?php echo $rowFAWFile['FileCFM'];?>&pg=filecfm','Preview Pdf','700','1000');">
					<?php  }  ?>				</td>
					<td><?php echo $rowFAWFile['Kemasan'];?></td>
					<td><?php echo $rowFAWFile['Posisi'];?></td>
					<td>
					<?php if (!empty($rowFAWFile['File'])){?>
					<img src="../img/Attachment_Image/<?php echo $rowFAWFile['File'];?>"
					   class="img-fluid" width="100" onClick="popupwindow('../config/popup-img.php?id=<?php echo $rowFAWFile['ID_No'];?>&name=<?php echo $rowFAWFile['File'];?>&pg=filefaw','Preview Pdf','700','1000');">
					<?php  }  ?>				</td>
					<td><textarea cols="4" id="inputComment[]" name="inputComment[]"  
			  class="form-control py-4" placeholder="Enter Komentar"
			  maxlength="500" required><?php if ($_POST) { echo $inputComment; } ?></textarea></td>
			  		<td align="justify"> 
						<button  type="button"  class="btn btn-primary"
				 onClick="popupwindow('../dist/page.php?form=faw-comment&id=<?php echo $rowFAWFile['ID_No'];?>&name=<?php echo $rowFAWFile['File'];?>&pg=faw-comment','Preview Comment','700','1000');">History</button>	</td>
				  </tr>
				  <?php $no++;}}else {echo "<tr><td colspan='6' align='center'>Tidak Ada data yang ditampilkan</td></tr>";} ?>
				  </table>			  
			   </td>
			</tr>
			<tr>
			<td colspan="3">
			<table name="cfmfile" id="cfmfile" class="table table-striped table-bordered table-sm" >
				<tr>
					<td colspan="7" align="left"><strong>CHECK antara "ARTWORK" dengan "MANUSCKRIPT"</strong></td>
			  	</tr>
				<tr>
					<td colspan="7" align="left">  <?php 
					$exe = mysqli_query($con,"SELECT a.Checklist_Code,a.Question FROM tb_faw_master_check a ");
					while(@$rowFAWMasterCheck =mysqli_fetch_array($exe)){
					echo $rowFAWMasterCheck['Checklist_Code'].". ". $rowFAWMasterCheck['Question']."<br>" ;}
					 ?>
					</td>
				</tr>
				<tr>
					<td colspan="7" align="left"><strong>Checklist Workflow</strong></td>
			  	</tr>
				<tr valign="bottom" align="center" bgcolor="#999999" >
					<th width="5%">Check Point</th>
					<th width="10%">Requestor <br><?php if (@$tampildata['Status_FAW']=="Revise") {
					echo ShowDivisiFAWRevise('DivisionName',@$tampildata['Request_No'],'FAW','Step 1');}
					else {ShowDivisiFAWApprove('DivisionName',@$tampildata['Request_No'],'FAW','Step 1');}?></th>
					<th width="10%"><?php if (@$tampildata['Status_FAW']=="Revise") {
					echo ShowDivisiFAWApprove('DivisionName',@$tampildata['Request_No'],'FAW','Step 2');}
					else {ShowDivisiFAWApprove('DivisionName',@$tampildata['Request_No'],'FAW','Step 2');}?></th>
					<th width="10%"><?php if (@$tampildata['Status_FAW']=="Revise") {
					echo ShowDivisiFAWApprove('DivisionName',@$tampildata['Request_No'],'FAW','Step 3');}
					else {ShowDivisiFAWApprove('DivisionName',@$tampildata['Request_No'],'FAW','Step 3');}?></th>
					<th width="10%"><?php if (@$tampildata['Status_FAW']=="Revise") {
					echo ShowDivisiFAWApprove('DivisionName',@$tampildata['Request_No'],'FAW','Step 4');}
					else {ShowDivisiFAWApprove('DivisionName',@$tampildata['Request_No'],'FAW','Step 4');}?></th>
					<th width="10%"><?php if (@$tampildata['Status_FAW']=="Revise") {
					echo ShowDivisiFAWApprove('DivisionName',@$tampildata['Request_No'],'FAW','Step 5');}
					else {ShowDivisiFAWApprove('DivisionName',@$tampildata['Request_No'],'FAW','Step 5');}?></th>
					<th width="10%"><?php if (@$tampildata['Status_FAW']=="Revise") {
					echo ShowDivisiFAWApprove('DivisionName',@$tampildata['Request_No'],'FAW','Step 6');}
					else {ShowDivisiFAWApprove('DivisionName',@$tampildata['Request_No'],'FAW','Step 6');}?></th>
				</tr>
				<?php 
				$exe = mysqli_query($con,"Select Checklist_Code, Question  FROM tb_faw_master_check  ");
			if (mysqli_num_rows($exe) !=0 ) {
				$no = 1;
				while(@$rowFAWCheck =mysqli_fetch_array($exe)){
		?>
			  <tr >
					<td>
					<?php echo $rowFAWCheck['Checklist_Code']; ?>
					</td>	
 					<td align="center">
					<?php 
					
					ShowDataChecklistAppFAW("Result",@$rowFAWCheck['Checklist_Code'],@$_GET['id'],1);
					
					/*$exe1 = mysqli_query($con,"SELECT Result FROM tb_faw_check_app 
					Where Checklist_Code='".$rowFAWCheck['Checklist_Code']."' And Request_No = '".@$_GET['id']."' 
					And Workflow_Index_No=1  ");
					if (mysqli_num_rows($exe1) !=0 ) {
						while(@$rowFAWCheck1 =mysqli_fetch_array($exe1)){
							if (@$rowFAWCheck1['Result']=='1') {echo "Yes"; } else {echo"-";}
						}
					} else {echo"-";}*/
					 ?>
					</td>
					<td  align="center">
					<?php 
					ShowDataChecklistAppFAW('Result',@$rowFAWCheck['Checklist_Code'],@$_GET['id'],2)

					 ?>
					</td>
					<td  align="center">
					<?php 
					ShowDataChecklistAppFAW('Result',@$rowFAWCheck['Checklist_Code'],@$_GET['id'],3)
					
					 ?>
					</td>
					<td align="center">
					<?php 
					ShowDataChecklistAppFAW('Result',@$rowFAWCheck['Checklist_Code'],@$_GET['id'],4)
					
					 ?>
					</td>
					<td align="center">
					<?php 
					ShowDataChecklistAppFAW('Result',@$rowFAWCheck['Checklist_Code'],@$_GET['id'],5)
					
					 ?>
					</td>
					<td align="center">
					<?php 
					ShowDataChecklistAppFAW('Result',@$rowFAWCheck['Checklist_Code'],@$_GET['id'],6)
					
					 ?>
					</td>
				</tr>  <?php $no++;}}?>
				
				
				<tr valign="bottom" align="center" bgcolor="#999999" >
					<th width="5%">Check Point <span class="glyphicon glyphicon-info-sign" 
					title="Check Point"></span></th>
					<th width="50%" colspan="5" >Description</th>
					<th width="5%">Yes / No <?php echo $Curent_Index; ?></th>
				</tr>
			  <?php 
				$Tanya = mysqli_query($con,"SELECT Request_No FROM tb_faw_check_app 
				Where Request_No = '".@$_GET['id']."' AND Workflow_Index_No='".$Curent_Index."'  ");
				if (mysqli_num_rows($Tanya) ==0 ) {
					$exe = mysqli_query($con,"SELECT a.Checklist_Code,a.Question,b.Result,b.Workflow_Index_No 
					FROM tb_faw_master_check a INNER JOIN  tb_faw_master_check_app b ON 
					a.Checklist_Code=b.Checklist_Code AND b.Workflow_Index_No='".$Curent_Index."'  ");
					$no = 1;
					while(@$rowFAWMasterCheck =mysqli_fetch_array($exe)){
				?>
			<tr id="<?php echo $rowFAWMasterCheck['ID_No']; ?>">
				<td><input type="hidden" name="tempFAWCheck[]" id="tempFAWCheck[]" 
				value="<?php echo $rowFAWMasterCheck['Checklist_Code']; ?>">
				<input type="hidden" name="tempFAWMasterCheck[]" id="tempFAWMasterCheck[]" 
				value="<?php echo $rowFAWMasterCheck['ID_No']; ?>">
				<?php echo $rowFAWMasterCheck['Checklist_Code']; ?>
				</td>	
			<td colspan="5">
				<?php echo $rowFAWMasterCheck['Question']; ?>
			</td>
			<td>
				<select class="form-control" name="InputResult[]" <?php echo $disabled; ?> >
					<option value="1" <?php if (@$rowFAWMasterCheck['Result']=='1') {echo "Selected"; }?>>Yes </option>
					<option value="0" <?php if (@$rowFAWMasterCheck['Result']=='0') {echo "Selected";} ?>>No</option>
				 </select>
			</td>
			</tr>
			<?php $no++;}} else { 
					$exe = mysqli_query($con,"SELECT a.Checklist_Code,a.Question,b.Result,b.Workflow_Index_No 
					FROM tb_faw_master_check a INNER JOIN  tb_faw_master_check_app b ON 
					a.Checklist_Code=b.Checklist_Code AND b.Workflow_Index_No='".$Curent_Index."'  ");
					$no = 1;
					while(@$rowFAWMasterCheck =mysqli_fetch_array($exe)){
				?>
			<tr id="<?php echo $rowFAWMasterCheck['ID_No']; ?>">
				<td><input type="hidden" name="tempFAWCheck[]" id="tempFAWCheck[]" 
				value="<?php echo $rowFAWMasterCheck['Checklist_Code']; ?>">
				<input type="hidden" name="tempFAWMasterCheck[]" id="tempFAWMasterCheck[]" 
				value="<?php echo $rowFAWMasterCheck['ID_No']; ?>">
				<?php echo $rowFAWMasterCheck['Checklist_Code']; ?>
				</td>	
			<td colspan="5">
				<?php echo $rowFAWMasterCheck['Question']; ?>
			</td>
			<td>
				<select class="form-control" name="InputResult[]" <?php echo $disabled; ?> >
					<option value="1" <?php if (@$rowFAWMasterCheck['Result']=='1') {echo "Selected"; }?>>Yes </option>
					<option value="0" <?php if (@$rowFAWMasterCheck['Result']=='0') {echo "Selected";} ?>>No</option>
				 </select>
			</td>
			</tr>
			<?php $no++;}} ?>
			</table>
		
			</td>
            <tr>
              <td>Remark *</td>
              <td colspan="2"><div class="form-group"> <textarea cols="4" id="inputRemark" name="inputRemark"  
			  class="form-control py-4" placeholder="Enter Remark" disabled="disabled" 
			  maxlength="100"><?php if ($_POST) { echo $inputRemark; } else {echo $tampildata['Remark'];} ?></textarea></div>			  			  </td>
			</tr>
			<tr>
              <td>Confirm</td>
              <td width="50%"><div class="form-group"> <input type="radio" id="Confirm" name="Confirm" value="Approve"> Approve </div></td>
			  <td width="20%"><div class="form-group"><input type="radio" id="Confirm" name="Confirm" value="Revise"> Revise</div></td>
            </tr>
            <tr>
              <td>Remark Approval *</td>
              <td colspan="2"><div class="form-group"> <textarea cols="4" id="inputRemarkApp"  name="inputRemarkApp"  class="form-control py-4" 
			placeholder="Enter Remark" ><?php if ($_POST) { echo $inputRemarkApp; }  ?></textarea></div>			  </td>
            </tr>
          </table>
		  
		  <button type="submit" name="Send" value="Send"  onClick="return checkSendApproval(faw)" 
		  class="btn btn-primary" <?php if (@$tampildataWFR['StatusWorkFlow']=="C" || @$tampildataWFR['StatusWorkFlow']=="R") {echo'disabled="disabled"';} ?>>Send</button>
		<button  type="button"  class="btn btn-primary"
		onClick="popupwindow('../config/export-faw.php?form=privew-faw&page=privew-faw&id=<?php echo $tampildata['Request_No'];?>','faw','600','1000');">Preview Document</button>				
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
	  if (form.Confirm.value == ""){
    	alert("Confirm No Can not be empty *");
      	return (false);  		}
	else if (form.inputRemarkApp.value == ""){
    	alert("Remark No Can not be empty *");
    	form.inputRemarkApp.focus();
    	return (false);  		}
		return confirm('Are you sure you want to Send Approval?');
	}

	</script>
	</body>
</html>
<?php ;}?>