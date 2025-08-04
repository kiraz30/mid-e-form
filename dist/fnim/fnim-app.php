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
	onload=enable_text(false);
	document.fnim.SelectTypeRequest.focus();
	}
  function enable_text(status)
	{
	status=!status;    
		document.fnim.SelectTypeRequest.focus();
	} 
  function DisplayShowHideExport()
  {
  if (document.fnim.SelectTypeRequest.value == "Export")
  {document.getElementById("country").style.visibility = 'visible';}

  else
  {document.getElementById("country").style.visibility = 'hidden';} 
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
      <h3 class="mt-4">New Request FNIM</h3>
	    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="../dist/index.php?button=dashboard">Dashboard</a></li>
		<li class="breadcrumb-item"><a href="../dist/index.php?button=inbox">inbox</a></li>
        <li class="breadcrumb-item active">New Request FNIM</li>
      </ol>
 	<div class="card mb-4">
	    <div class="card-header"> </div>

        <div class="card-body"> 
			
        <?php
		include "fnim-autonumber.php";
		 
      	$exe =mysqli_query($con,"SELECT ID_No,Request_No,MCJ_Proudct,Project_Name,NPRF_Code,Type_Request,Type_Request_Detail, 
		DATE_FORMAT(Launching_Date, '%m') Bulan,DATE_FORMAT(Launching_Date, '%Y') Tahun,
		For_Notif,Note,Status_FNIM,Thema_Number,Remark,Mcj,RemarkafterComplete 
		FROM tb_fnim where Request_No = '".@$_GET['id']."' ");
        $tampildata=mysqli_fetch_array($exe);
		//________________________________________________________________________________UPDATE READ INBOX
		mysqli_query($con,"UPDATE tb_inbox SET ReadInbox='1' Where (NameApproval= '$username' Or OnBehalf='$username') 
		And Request_No='".@$_GET['id']."' And ReadInbox='0'");
		//________________________________________________________________________________UPDATE READ INBOX
		$exeWFP = mysqli_query($con,"SELECT WorkFlowMenu,Index_No,NameApproval,OnBehalf,StatusWorkFlow FROM tb_workflownprf 
		WHERE (NameApproval='$username' or OnBehalf ='$username') And Request_No = '".@$_GET['id']."' AND StatusWorkFlow IS null");
        $tampildataWFR=mysqli_fetch_array($exeWFP);
		$NextStep_Index= $tampildataWFR['Index_No']+1;
		//________________________________________________________________________________WORK FLOW Back PROCESS
		$exeWFBP = mysqli_query($con,"SELECT WorkFlowMenu,Index_No,NameApproval,OnBehalf,StatusWorkFlow FROM tb_workflownprf 
		WHERE (NameApproval='$username' or OnBehalf ='$username') And Request_No = '".@$_GET['id']."' AND StatusWorkFlow IS null");
        $tampildataWFBR=mysqli_fetch_array($exeWFBP);
		$BackStep_Index= $tampildataWFBR['Index_No']-1;
		//________________________________________________________________________________
        
	  	?>
	<form name="fnim"  id="fnim" action="" method="post"  enctype="multipart/form-data"  >
    <?php 
	//Begin CRUD----------------------------------------------------------------------
	if($_POST){
	$file	 						= "../file/";
	$uploadDirFileMcj	 			= "../img/Mcj/";
		$ip=$_SERVER['REMOTE_ADDR'];
		$hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);
		date_default_timezone_set("Asia/Jakarta");
		$createddate=date("Y-m-d H:i:s");
    	$tempFormatNoRequest  	= $_POST['tempFormatNoRequest'];
		$inputAutoRequestNo		= $_POST['inputAutoRequestNo'];
		$MCJProd				= @$_POST['MCJProd'];
		$inputProjectName 	 	= @$_POST['inputProjectName']; 
		$SelectTypeRequest	 	= @$_POST['SelectTypeRequest'];
		$txtExport			 	= @$_POST['txtExport'];
		$inputNotification		= @$_POST['inputNotification'];
		$inputNote				= @$_POST['inputNote'];
		$Selectbulan			= @$_POST['Selectbulan'];
		$SelectTahun			= @$_POST['SelectTahun'];
		$inputRemark			= @$_POST['inputRemark'];
		$inputRemarkApp			= @$_POST['inputRemarkApp'];
		
		$namaFileMcj  					= @$_FILES['FileMcj']['name'];
		$xFileMcj						= explode('.', $namaFileMcj);
		$ekstensiFileMcj    			= strtolower(end($xFileMcj));
		$ukuranFileMcj					= @$_FILES['FileMcj']['size'];
		$file_tmpFileMcj	 			= @$_FILES['FileMcj']['tmp_name'];			
		$ImagelamaFileMcj				= @$tampildata['Mcj'];
					
		if($Send=="Send"){ 
			if ($Confirm=="Approve"){
				//Simpan WorkFlow NPRF
				mysqli_query($con,"UPDATE tb_workflownprf SET StatusWorkFlow='C',ReadWorkFlow='1',Remark_WorkFlow='$inputRemarkApp',
				Approve='$username',ApproveDate='$createddate',Status_Approval='1' WHERE Request_No='$tempFormatNoRequest' 
				And Index_No='".$tampildataWFR['Index_No']."' AND StatusWorkFlow IS null Order By ID_No Desc limit 1");
				
				//Send Email Notification for Approval 2-------------------------------------------------
				$exeNext = mysqli_query($con,"Select NameApproval,OnBehalf FROM tb_workflownprf 
				WHERE Request_No='$tempFormatNoRequest' And Index_No='$NextStep_Index' And StatusWorkFlow is null limit 1");
				$tampildataNext=mysqli_fetch_array($exeNext);
				$app1=$tampildataNext['NameApproval'];
				$app2=$tampildataNext['OnBehalf'];
				$remark=$inputRemarkApp;
				$id=$tempFormatNoRequest;
				$page="fnim-app";
				$WorkFlowMenu="FNIM";
				if (mysqli_num_rows($exeNext) !=0 ) { 
					if ($tampildataNext['OnBehalf']<>"-" || $tampildataNext['OnBehalf']==""){
						$StatusFNIM= "Waitting Approval By " .$tampildataNext['NameApproval']." Or ".$tampildataNext['OnBehalf'];}
					else {
						$StatusFNIM= "Waitting Approval By " .$tampildataNext['NameApproval'];}
					$StatusInbox="W";
					$Confirm=="Approve";
					require ("../config/emailapp.php");
					//Simpan Inbox
					mysqli_query($con,"UPDATE tb_inbox Set Request_Status='$StatusInbox',ReadInbox='0',UpdatedBy='$username',
					NameApproval='".$tampildataNext['NameApproval']."',OnBehalf='".$tampildataNext['OnBehalf']."',
					Remark='$inputRemarkApp',UpdatedDate='$createddate',UpdatedHostName='$ip : $hostname'  
					WHERE Request_No='$tempFormatNoRequest'");
				}
				else {
					$StatusFNIM="Complete By MID";
					$StatusInbox="CMID";
					$Confirm=="Approve";
					require ("../config/emailappcompleteMID.php");
					//Send Email Notification for Requestor-------------------------------------------------
					$exeRequestor= mysqli_query($con,"Select NameApproval FROM tb_workflownprf 
					WHERE Request_No='$tempFormatNoRequest' And Index_No='1'  limit 1");
					$tampildataRequestor=mysqli_fetch_array($exeRequestor);
					$apprequestor=$tampildataRequestor['NameApproval'];
					//Simpan Inbox
					mysqli_query($con,"UPDATE tb_inbox Set Request_Status='$StatusInbox',ReadInbox='0',UpdatedBy='$username',
					NameApproval='".$apprequestor."',
					UpdatedDate='$createddate',UpdatedHostName='$ip : $hostname'  WHERE Request_No='$tempFormatNoRequest'");

				}

				
				//UPDATE STATUS FNIM
				mysqli_query($con,"UPDATE tb_fnim Set Status_FNIM='$StatusFNIM' WHERE Request_No='$tempFormatNoRequest'");
				
				//---------------------------------------------------------------------------------------
				$message = "Data successfully Sent to Approval";
				echo "<script type='text/javascript'>alert('$message');</script>";
				echo"<script>  window.location='../dist/index.php?button=inbox'; </script>";
				}
			if ($Confirm=="Revise"){
				//Simpan WorkFlow FNIM
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
				
				$apprevise=$tampildataBack['Revise'];
				$remark=$inputRemarkApp;
				$id=$tempFormatNoRequest;
				$page="revise-fnim";
				$WorkFlowMenu="FNIM";
				if (mysqli_num_rows($exeBack) !=0 ) { 
					$StatusFNIM= "Revise";
					$StatusInbox="R";
					require ("../config/emailrevise.php");
				}
				else {
					$StatusFNIM="Complete";
					$StatusInbox="C";
				}
				//Simpan Inbox
				mysqli_query($con,"UPDATE tb_inbox Set Request_Status='$StatusInbox',ReadInbox='0',UpdatedBy='$username',
				NameApproval='".$tampildataBack['Revise']."',OnBehalf='',
				Remark='$inputRemarkApp',UpdatedDate='$createddate',UpdatedHostName='$ip : $hostname' 
				 WHERE Request_No='$tempFormatNoRequest'");
				 //UPDATE STATUS NPRF
				mysqli_query($con,"UPDATE tb_fnim Set Status_FNIM='$StatusFNIM' WHERE Request_No='$tempFormatNoRequest'");
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
			  placeholder="Auto Request No" readonly="readonly" value="<?php if ($button=="add-fnim") {echo $NomorReq;} else {echo $tampildata['Request_No'];} ?>" />
              </span> </td>
            </tr>
            <tr>
              <td>MCJ Product Development *</td>
              <td colspan="2"><span class="form-group">
                <div class="form-group"> <input type="radio" id="MCJProd" name="MCJProd" 
				value="0"  <?php if (@$tampildata['MCJ_Proudct']=='0') {echo 'checked="checked"';} ?> disabled="disabled"> Prodev 1  
			  	<input type="radio" id="MCJProd" name="MCJProd" 
				value="1" <?php if (@$tampildata['MCJ_Proudct']=='1') {echo 'checked="checked"';}?>  disabled="disabled"> Prodev 2</div>
              </span></td>
            </tr>
            <tr>
              <td><span class="form-group">Project Name *</span></td>
              <td width="50%"><span class="form-group">
                <input class="form-control py-4" name="inputProjectName"  maxlength="50" type="text" placeholder="Enter Project Name"
			   value="<?php if ($_POST) { echo $inputProjectName; } else {echo $tampildata['Project_Name'];} ?>" 
			   disabled="disabled"/>
              </span>
			  </td>
			  <td>
            	<input type="text" class="form-control" name="InputNprfCode" id="InputNprfCode" placeholder="NPRF Code" 
				disabled="disabled" value="<?php if ($_POST) { echo $InputNprfCode; } else {echo $tampildata['NPRF_Code'];} ?>">
			  </td>
            </tr>
			<tr>
              <td>Request Type *</td>
              <td width="20%"><select class="form-control" id="SelectTypeRequest" name="SelectTypeRequest" disabled="disabled">
			  <option value="-">Select Request Type </option>
				<option value="Domestic" <?php if ($_POST) {echo $SelectTypeRequest;} elseif (@$tampildata['Type_Request']=='Domestic') 
				{echo "Selected"; }?>>Domestic</option>
				<option value="Export" <?php if (@$tampildata['Type_Request']=='Export') {echo "Selected";} ?>>Export</option>
				</select> 
				<table name="country" id="country" width="100%" border="0">
				<?php
					$exe = mysqli_query($con,"SELECT ID_No,Country,Index_No 
					FROM tb_fnim_country Where Request_No = '".$tampildata['Request_No']."'   ");
					$no = 1;
					while(@$rowFNIMCountry =mysqli_fetch_array($exe)){
					?>
				  <tr>
					<td height="27" colspan="2"><?php echo $no; ?> <?php echo $rowFNIMCountry['Country']; ?></td>
				  </tr>
				  <?php $no++;} ?>
				  </table>
              </td>
			  <td width="20%">
			  </td>
            </tr>
            <tr>
              <td colspan="3">
			  <table name="fnimdetail" id="fnimdetail"  width="100%" border="1" 
			  class="table table-striped table-bordered table-hover" >
			   
				  <tr>
					<td colspan="10" align="left"><strong>FNIM Detail</strong></td>
				  </tr>
				  <tr valign="bottom" align="center" bgcolor="#999999">
					<th width="1%"></th>
					<th width="20%">Final Product Name</th>
					<th width="5%">Netto</th>
					<th width="7%">Assumed Consumer Price</th>
					<th width="5%">Formula</th>
					<th width="10%">Formula Sample Code</th>
					<th width="10%">Fragrance Code</th>
					<th width="10%">Package On Store</th>
					<th width="10%">MCJ Item No</th>
					<th width="20%">Note</th>
				  </tr>
				 <?php
					$exe = mysqli_query($con,"SELECT ID_No,Product_Name,NamaCurrency,Assumed_Consumer_Price,Formula,
					Formula_Sample_Code,Fragrance_Code,Package_On_Stone,MCJ_Item_No,Note,Index_No 
					FROM tb_fnim_detail Where Request_No = '".$tampildata['Request_No']."'   ");
					$no = 1;
					while(@$rowFNIMDetail =mysqli_fetch_array($exe)){
					?>
				  <tr>
					<td><?php echo $no; ?></td>
					<td><?php echo $rowFNIMDetail['Product_Name']; ?></td>
					<td><?php 
					$isinetto="";
					$exeNetto = mysqli_query($con,"SELECT ID_No,Isi_Net,Netto,Index_No 
					FROM tb_fnim_detail_netto Where Request_No = '".$tampildata['Request_No']."' And
					ID_No_FnimDetail='".$rowFNIMDetail['ID_No']."'  Order By ID_No Asc");
					while(@$rowFNIMDetailNetto =mysqli_fetch_array($exeNetto)){ 
						$isinetto=$isinetto.$rowFNIMDetailNetto['Isi_Net']." ".$rowFNIMDetailNetto['Netto'].", ";
					} 
					echo substr($isinetto,0,-2);  ?>
					</td>
					<td align="right"><?php echo $rowFNIMDetail['NamaCurrency'].$rowFNIMDetail['Assumed_Consumer_Price']; ?></td>
					<td style="padding:0px 0px 0px 0px">
					<table width="100%" >
					<?php
					$exeFormula = mysqli_query($con,"SELECT Formula FROM tb_fnim_detail_formula 
					Where Request_No = '".$tampildata['Request_No']."' And ID_No_FnimDetail='".$rowFNIMDetail['ID_No']."'  ");
					while(@$rowFNIMDetailFormula =mysqli_fetch_array($exeFormula)){
					?>
				  	<tr><td><?php echo $rowFNIMDetailFormula['Formula']; ?></td></tr>
				  	<?php } ?>
				  	</table>
					</td>
					<td style="padding:0px 0px 0px 0px">
					<table width="100%"  >
					<?php
					$exeFormulaSampleCode = mysqli_query($con,"SELECT Formula_Sample_Code FROM tb_fnim_detail_Formula_Sample_Code
					Where Request_No = '".$tampildata['Request_No']."' And ID_No_FnimDetail='".$rowFNIMDetail['ID_No']."'  ");
					while(@$rowFNIMDetailFormulaSampleCode =mysqli_fetch_array($exeFormulaSampleCode)){
					?>
				  	<tr><td><?php echo $rowFNIMDetailFormulaSampleCode['Formula_Sample_Code']; ?></td></tr>
				  	<?php } ?>
				  	</table>
					</td>
					<td style="padding:0px 0px 0px 0px">
					<table width="100%" >
					<?php
					$exeFragranceCode = mysqli_query($con,"SELECT Fragrance_Code FROM tb_fnim_detail_Fragrance_Code
					Where Request_No = '".$tampildata['Request_No']."' And ID_No_FnimDetail='".$rowFNIMDetail['ID_No']."'  ");
					while(@$rowFNIMDetailFragranceCode =mysqli_fetch_array($exeFragranceCode)){
					?>
				  	<tr><td><?php echo $rowFNIMDetailFragranceCode['Fragrance_Code']; ?></td></tr>
				  	<?php } ?>
				  	</table>
					</td>
					<td style="padding:0px 0px 0px 0px">
					<table width="100%" >
					<?php
					$exePackageOnStore = mysqli_query($con,"SELECT Package_On_Store FROM tb_fnim_detail_package_on_store
					Where Request_No = '".$tampildata['Request_No']."' And ID_No_FnimDetail='".$rowFNIMDetail['ID_No']."'  ");
					while(@$rowFNIMDetailPackageOnStore =mysqli_fetch_array($exePackageOnStore)){
					?>
				  	<tr><td><?php echo $rowFNIMDetailPackageOnStore['Package_On_Store']; ?></td></tr>
				  	<?php } ?>
				  	</table>
					</td>
					<td><?php echo $rowFNIMDetail['MCJ_Item_No']; ?></td>
					<td><?php echo $rowFNIMDetail['Note']; ?></td>
				  </tr>
				  <?php $no++;} ?>
				  </table>
			  </td>
            </tr>
			<tr>
              <td>Thema Number</td>
              <td colspan="3"><span class="form-group">
                <input class="form-control py-4" name="inputThemaNumber" id="inputThemaNumber"
				maxlength="50" type="text" placeholder="Enter Thema Number"  
				value="<?php if ($_POST) { echo $inputThemaNumber; } else {echo $tampildata['Thema_Number'];} ?>"
				 disabled="disabled"/>
              </span>
			  </td>
            </tr>
            <tr>
              <td>Launching Date *</td>
              <td>
				<div class="form-group d-flex align-items-center justify-content-between mt-0 mb-2">
				<select name="Selectbulan" id="Selectbulan" class="form-control" disabled="disabled">
				<?php
					$div = mysqli_query($con,"SELECT Bulan,Ket FROM tb_bulan");
					while($b = mysqli_fetch_array($div)){
						if(@$tampildata['Bulan'] == $b['Bulan']){
							$cek = 'Selected';	}
						elseif($Selectbulan == $b['Bulan']){
							$cek = 'Selected';	}
						else{
							$cek = '';	}
					echo"<option value='".$b['Bulan']."' $cek>".$b['Ket']."</option> ";}
				?></select>				
				<select name="SelectTahun" id="SelectTahun" title="Tahun" class="form-control" disabled="disabled">
					<option value="">Tahun</option>
					<?php 
					$mulai= date('Y');
					for($i = $mulai;$i<$mulai + 5;$i++){?>
					<option value="<?php echo $i; ?>" <?php if (@$tampildata['Tahun']==$i) 
					{echo "Selected";} ?>><?php echo $i; ?></option><?php }	?>
				</select></div> </td>
            </tr>
            <!--tr>
              <td height="84">For Notification</td>
              <td colspan="2"><span class="form-group"> 
				<textarea rows="3" class="form-control py-4" name="inputNotification" maxlength="100"
				placeholder="Enter For Notification" disabled="disabled"><?php if ($_POST) { echo $inputNotification; } 
				else{echo $tampildata['For_Notif'];} ?></textarea>
        		</span>
			   </td>
            </tr-->
            <tr>
              <td height="84">Note</td>
              <td colspan="2"><span class="form-group"> 
				<textarea rows="3" class="form-control py-4"  name="inputNote" maxlength="100"
				placeholder="Enter Note" disabled="disabled"><?php if ($_POST) { echo $inputNote; } 
				else{echo $tampildata['Note'];} ?></textarea>
        		</span>
			   </td>
            </tr>
	<tr>
              <td colspan="3">
			  <table name="Attach" id="Attach"  width="100%" border="1" class="table table-striped table-bordered table-hover" >
			   
				  <tr>
					<td colspan="10" align="left"><strong>Attachment File (.pdf)</strong></td>
				  </tr>
				  <tr valign="bottom" align="center" bgcolor="#999999" >
					<th width="1%">No</th>
					<th width="10%">File</th>
					<th width="20%">Name</th>
				  </tr>
					 <?php
					$exe = mysqli_query($con,"SELECT ID_No,File,Name,Index_No 
					FROM tb_fnim_file Where Request_No = '".$tampildata['Request_No']."'   ");
					$no = 1;
					if (mysqli_num_rows($exe) !=0 ) {
					while(@$rowFNIMFile =mysqli_fetch_array($exe)){
					?>
				  <tr>
					<td><?php echo $no;?></td>
					<td>
					<?php if (!empty($rowFNIMFile['File'])){?>
			  	<img height="20" width="20" src=../img/pdf.png  title="Open File <?php echo $rowFNIMFile['File'];?>"
				onClick="popupwindow('../config/open-pdf.php?kd=<?php echo $rowFNIMFile['ID_No'];?>&page=filefnim','Preview Pdf','700','1000');">
			  	<?php echo $rowFNIMFile['File']; }  ?>
				</td>
					<td><?php echo $rowFNIMFile['Name'];?></td>
				  </tr>
				  <?php $no++;}}else {echo "<tr><td colspan='3' align='center'>Tidak Ada data yang ditampilkan</td></tr>";} ?>
				  </table>
			  </td>
			</tr>
            <tr>
              <td>Remark *</td>
              <td colspan="2"><div class="form-group"> <textarea cols="4" id="inputRemark" name="inputRemark"  
			  class="form-control py-4" placeholder="Enter Remark" disabled="disabled" 
			  maxlength="100"><?php if ($_POST) { echo $inputRemark; } else {echo $tampildata['Remark'];} ?></textarea></div>
			  </td>
			</tr>
			<tr>
              <td>Confirm</td>
              <td><div class="form-group"> <input type="radio" id="Confirm" name="Confirm" value="Approve"> Approve </div></td>
			  <td><div class="form-group"><input type="radio" id="Confirm" name="Confirm" value="Revise"> Revise</div></td>
            </tr>
            <tr>
              <td>Remark Approval *</td>
              <td colspan="2"><div class="form-group"> <textarea cols="4" id="inputRemarkApp"  name="inputRemarkApp"  class="form-control py-4" 
			placeholder="Enter Remark" ><?php if ($_POST) { echo $inputRemarkApp; }  ?></textarea></div>
			  </td>
            </tr>
          </table>
		  
		  <button type="submit" name="Send" value="Send"  onClick="return checkSendApproval(fnim)" 
		  class="btn btn-primary" <?php if ($tampildataWFR['StatusWorkFlow']=="C" || $tampildataWFR['StatusWorkFlow']=="R") {echo'disabled="disabled"';} ?>>Send</button>
		<button  type="button"  class="btn btn-primary"
		onClick="popupwindow('../config/export-fnim.php?form=privew-fnim&page=privew-fnim&id=<?php echo $tampildata['Request_No'];?>','fnim','600','1000');">Preview Document</button>				
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
        $('#fnimdetail').DataTable({
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