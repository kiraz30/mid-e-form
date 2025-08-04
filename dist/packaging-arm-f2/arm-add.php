	<?php $Send		= @$_POST['Send']; ?>
	<?php $Save		= @$_POST['Save']; ?>
<script language="JavaScript">
	function setFocus(){
		document.arm.InputMPRCode.focus();	
	}
function setFocusChecklist(){
		document.arm.inputAutoRequestNo.focus();
		document.arm.inputLastRequestNo.focus();
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
<script type="text/javascript">
	function addRowDocLampiran(tableID) {
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
		var MCJItemNo = document.createElement('input');
		MCJItemNo.setAttribute('class',"form-control");
		MCJItemNo.setAttribute('style',"padding:2px 2px 2px 2px");
		MCJItemNo.setAttribute('title',"Input Nama Document Lampiran");
		MCJItemNo.setAttribute('name',"InputDocLampiran[]");
		MCJItemNo.setAttribute('id',"InputDocLampiran[]");
		cell2.appendChild(MCJItemNo);
		var cell2 = row.insertCell(2);
		var filelampiran = document.createElement('input');
		filelampiran.setAttribute('type',"file");
		filelampiran.setAttribute('class',"form-control");
		filelampiran.setAttribute('title',"Input File Document Lampiran");
		filelampiran.setAttribute('name',"InputFileDocLampiran[]");
		filelampiran.setAttribute('id',"InputFileDocLampiran[]");
		cell2.appendChild(filelampiran);
		
	}

	function deleteRowDocLampiran(tableID) {
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
        <link href="../vendor/datatables/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="../font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
		
        <!-- Bootstrap Core CSS -->
        <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
              <!-- MetisMenu CSS -->
        <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
              <!-- Custom CSS -->
        <link href="../css/sb-admin-2.css" rel="stylesheet">
              <!-- Custom Fonts -->
        <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">  
	
	 
	</head>
	<body onload='setFocus()' > 
	<main> 
    <div class="container-fluid"> 
      <h3 class="mt-4"><?php if ($button=="arm-f2-add" || $button=="add-revise-arm-f2" || $button<>"add-copy-arm-f2") 
		{echo "New Request Additional Resource Master Factory 2";}
		 else  {echo "Edit Request Additional Resource Master Factory 2";} ?> </h3>
	    <ol class="breadcrumb mb-4">
			<li class="breadcrumb-item"><a href="../dist/index.php?button=dashboard">Dashboard</a></li>
			<li class="breadcrumb-item"><a href="../dist/index.php?button=arm-f2">Additional Resource Master Factory 2</a></li>
			<li class="breadcrumb-item active"><?php if ($button=="arm-f2-add" || $button=="add-revise-arm-f2" || $button<>"add-copy-arm-f2") 
			{echo "New Request Additional Resource Master Factory 2";}
			else  {echo "Edit Request Additional Resource Master Factory 2";} ?>  </li>
      	</ol>
 	<div class="card mb-4">
	    <div class="card-header"><label>50 % </label>
		<div class="progress">
			<div class="progress-bar" role="progressbar" style="width: 50%" 
			aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
		</div>
	 
		</div>

        <div class="card-body"> 
			
        <?php
		include "arm-autonumber.php";
			
		$query="SELECT a.ID_No,a.Index_Document,a.Request_No,a.Last_Request_No,a.Status_Last_Document,
		a.MPR_Code,a.Project_Name,a.Subject,a.Type_Finish_Goods,a.Type_Materials,a.Type_WorkProcess,
		a.Type_Fu_Fee,a.Type_Vendor,a.Type_Customer,a.Segment_Price,a.Segment_Data_Informasi,
		a.Segment_Ukuran,a.Segment_Others,a.Segment_Over_Receipt,a.Content,a.Remark,
		a.Status_add_resource,a.CreatedBy,date(a.CreatedDate) as Created_Date 
		from tb_packdev_add_resource_f2 a  LEFT JOIN tb_mpr b ON a.MPR_Code=b.Request_No
		WHERE a.Request_No = '".@$_GET['id']."' ";
		if ($button=="arm-f2-add") {$query.=" And a.Status_Last_Document='1'";}
		else {$query =$query; }
      	$exe =mysqli_query($con,$query);
        $tampildata=mysqli_fetch_array($exe);
		$rev=@$tampildata['Index_Document']+1;

		
		//________________________________________________________________________________Status ARM disabled

		if (@$tampildata['Status_add_resource']<>"Draft" & @$tampildata['Status_add_resource']<>"" & 
			$button<>"add-revise-arm-f2" & $button<>"revise-arm-f2" & $button<>"add-copy-arm-f2")
		  {$disabled="disabled";} else{$disabled="";}
	  
		//________________________________________________________________________________WORKFLOWFNIM
		$exeReq = mysqli_query($con,"Select NameApproval,OnBehalf,Remark_WorkFlow FROM tb_workflowNPRF 
		WHERE Request_No = '".@$_GET['id']."' And Index_No='1' limit 1");
		$tampildataReq=mysqli_fetch_array($exeReq);
		//________________________________________________________________________________
        
	  	?>
	<form name="arm" id="arm" action="" method="post"  enctype="multipart/form-data"  >
    <?php 
	//Begin CRUD----------------------------------------------------------------------
	$datenow					= date("Y-m-d");
	$file	 						= "../file/";
	if($_POST){
		$ip						=$_SERVER['REMOTE_ADDR'];
		$hostname 				= gethostbyaddr($_SERVER['REMOTE_ADDR']);
		date_default_timezone_set("Asia/Jakarta");
		$createddate			=date("Y-m-d H:i:s");
		$yymmddhMs				=date("YmdHis");

    	$tempFormatNoRequest  	= $_POST['tempFormatNoRequest'];
		$inputAutoRequestNo		= $_POST['inputAutoRequestNo'];
		$inputLastRequestNo		= @$_POST['inputLastRequestNo'];
		$InputMPRCode			= @$_POST['InputMPRCode'];
		$inputProjectName		= @$_POST['inputProjectName'];
		$InputSubject		 	= @$_POST['InputSubject'];
		$InputType			 	= @$_POST['InputType'];
		if (!@$_POST['ChkType1']){$valType1=0;} else {$valType1=1;}
		if (!@$_POST['ChkType2']){$valType2=0;} else {$valType2=1;}
		if (!@$_POST['ChkType3']){$valType3=0;} else {$valType3=1;}
		if (!@$_POST['ChkType4']){$valType4=0;} else {$valType4=1;}
		if (!@$_POST['ChkType5']){$valType5=0;} else {$valType5=1;}
		if (!@$_POST['ChkType6']){$valType6=0;} else {$valType6=1;}

		if (!@$_POST['ChkSegment1']){$valSegment1=0;} else {$valSegment1=1;}
		if (!@$_POST['ChkSegment2']){$valSegment2=0;} else {$valSegment2=1;}
		if (!@$_POST['ChkSegment3']){$valSegment3=0;} else {$valSegment3=1;}
		if (!@$_POST['ChkSegment4']){$valSegment4=0;} else {$valSegment4=1;}
		if (!@$_POST['ChkSegment5']){$valSegment5=0;} else {$valSegment5=1;}
		$InputContent			= @$_POST['InputContent'];
		$InputStatus			= @$_POST['InputStatus'];
		$inputRemark			= @$_POST['inputRemark'];
		
		if($Save=="Save"){
			include "arm-autonumber.php";
			$TanyaReqWokflow = mysqli_query($con,"SELECT * FROM tb_workflowapproval 
			WHERE UserDomain= '$username' And WorkFlowMenu= 'ARM-F2' And LevelApproval ='Requestor'");
			if (mysqli_num_rows($TanyaReqWokflow) ==0 ) {  
				echo "<div class='form-group has-error'>
				<label class='control-label' for='inputError'>Error Save : Contact Administrator, because not wokflow Process *</label></div>";}
			else {
				$Tanya = mysqli_query($con,"SELECT Request_No FROM tb_packdev_add_resource_f2 WHERE Request_No = '$inputAutoRequestNo' ");
				if (mysqli_num_rows($Tanya) !=0 ) {  
					echo "<div class='form-group has-error'>
					<label class='control-label' for='inputError'>Error Save : Request No already exists in the database *</label></div>";}
				else{
					//membuat Query untuk menyimpan data
					include "arm-autonumber.php";
					if ($button=="arm-f2-add") {
						include "arm-save-new.php";
					}else {
						include "arm-save-new.php";
						include "arm-detail-form-save-new-revise.php";
						}
					include "arm-save-workflow.php";
		
					$message = "Data successfully Save to Draft";
					echo "<script type='text/javascript'>alert('$message');</script>";
					echo"<script>  window.location='../dist/index.php?button=arm-f2'; </script>";
					}
				}
			}
		elseif($Save=="Update"){ 
			//membuat Query untuk update data
			include "arm-edit.php";	
			$message = "Data successfully Update to Draft";	
			echo "<script type='text/javascript'>alert('$message');</script>";
			echo"<script>  window.location='../dist/index.php?button=arm-f2'; </script>";
		}
		elseif ($Save=="Revise"){
			//Simpan Status Revise NPRF
			mysqli_query($con,"UPDATE tb_packdev_add_resource_f2 Set Status_add_resource='Revise' WHERE Request_No='$inputAutoRequestNo'");
			mysqli_query($con,"UPDATE From tb_workflownprf Set Status_Approval ='0'WHERE Request_No='$inputAutoRequestNo'");
			//_________________________________________________________________________________________
			$message = "Data successfully Revise";
			echo "<script type='text/javascript'>alert('$message');</script>";
			echo"<script>  window.location='../dist/index.php?button=revise-arm-f2&id=$inputAutoRequestNo'; </script>";
			 
		}
		elseif($Save=="Cancel"){ 
			include "arm-edit.php";
			mysqli_query($con,"UPDATE tb_packdev_add_resource_f2 SET Status_add_resource='Cancel' WHERE Request_No='$inputAutoRequestNo'");
			mysqli_query($con,"UPDATE tb_inbox SET Request_Status='Cancel' WHERE Request_No='$inputAutoRequestNo'");
			
			$message = "Data successfully Cancel Request";
			echo "<script type='text/javascript'>alert('$message');</script>";
			echo"<script>  window.location='../dist/index.php?button=arm-f2'; </script>";
			}
		elseif($Send=="NextandSave"){ 
			include "arm-autonumber.php";
			$Tanya = mysqli_query($con,"SELECT Request_No FROM tb_packdev_add_resource_f2 WHERE Request_No = '$inputAutoRequestNo' ");
			if (mysqli_num_rows($Tanya) !=0 ) {
				//Update Next
				include "arm-edit.php";
			}
			else{
				//membuat Query untuk menyimpan data
				if ($button=="add-revise-arm-f2" || $button<>"add-copy-arm-f2"){
					include "arm-save-new.php";
					include "arm-detail-form-save-new-revise.php";
					include "arm-save-workflow.php";}
				else{
					include "arm-autonumber.php";
					include "arm-save-new.php";
					include "arm-save-workflow.php";
				}
				
				
			}
			//_________________________________________________________________________________________
			echo"<script>  window.location='../dist/index.php?button=arm-f2-detail-add&id=$inputAutoRequestNo'; </script>";
		}
		elseif($Send=="Next"){ 
			//_________________________________________________________________________________________
			echo"<script>  window.location='../dist/index.php?button=arm-f2-detail-add&id=$inputAutoRequestNo'; </script>";
		}
	}
		//End CRUD----------------------------------------------------------------------
		?>
          <table width="100%" border="0" class="table table-striped" id="dataTables-example" >
            <tr>
              <td width="20%"><span class="form-group">Request No *</span></td>
              <td colspan="2"><span class="form-group">
				<input name="tempFormatNoRequest" type="hidden" value="<?php echo $tampildata['Request_No']; ?>">
                <input class="form-control py-4"  name="inputAutoRequestNo" id="inputAutoRequestNo"  
				maxlength="50" type="text" placeholder="Auto Request No" readonly="readonly" 
			  value="<?php if ($button=="arm-f2-add" || $button<>"add-copy-arm-f2") {echo $NomorReq;} elseif ($button=="add-revise-arm-f2") 
			  {echo substr($tampildata['Request_No'],0,17)."-R".$rev;} else {echo @$tampildata['Request_No'];} ?>" />
              </span> </td>
            </tr>
            <tr>
              <td width="20%"><span class="form-group">Last Request No  </span></td>
              <td colspan="2"><span class="form-group">
                <input class="form-control py-4"  name="inputLastRequestNo" id="inputLastRequestNo"  maxlength="50" type="text"  
			  placeholder="Auto Request No"  readonly="readonly" 
			  value="<?php if (@$tampildata['Status_add_resource']=="Complete" & $button=="add-revise-arm-f2" ) 
			  {echo @$tampildata['Request_No'];} else if ($button=="add-copy-arm-f2")
			  {echo "";} else   {echo @$tampildata['Last_Request_No'];}?>" />
              </span> </td>
            </tr>
            <tr>
              <td><span class="form-group">Master Product Request No </span></td>
              <td width="30%"><div class="form-group d-flex align-items-center justify-content-between mt-0 mb-1">
			  	<input type="text" class="form-control"  name="InputMPRCode" id="InputMPRCode" 
				placeholder="Master Product Request No"  
				value="<?php if ($_POST) { echo $InputMPRCode; } else {echo @$tampildata['MPR_Code'];} ?>" 
				onChange="setFocus(),get_detaildata()" onFocus="setFocus(),get_detaildata()"  <?php echo $disabled; ?>>
				&nbsp;<button type="button" style="padding:2px 4px 4px 4px" 
			   class="btn btn-primary" title="Search Project Name"  
					name="btnsearch" disabled="disabled"
					onClick="popupwindow('packaging-arm/project-name-popup.php?id=mpr','Search Project Name','600','900');" <?php echo $disabled; ?>>
					<span class="glyphicon glyphicon-search" ></span> </button>
				</div>
			  </td>
			  </td>
			  <td width="30%">
			  </td>
            </tr>
			<tr>
              <td>Document Lampiran</td>
              <td colspan="2">
			  	<div class="form-group d-flex align-items-center justify-content-between mt-0 mb-0">
				  	Jika ada lampirakan silahkan klik button [+]
					<span>
				  	<button type="button" style="padding:2px 4px 4px 4px"  class="btn btn-primary" title="Add Country"  
					name="btnCreate" onClick="addRowDocLampiran('DocLampiran')" <?php echo $disabled; ?>><span class="fa fa-plus" ></span> </button>
					<button type="button" style="padding:2px 4px 4px 4px"  class="btn btn-primary" title="Delete Document Lampiran "  
					id="btnDeleteArm" name="btnDeleteArm" <?php echo $disabled; ?>><span class="glyphicon glyphicon-trash" ></span></button>
					</span>
				</div>
			  	<table name="DocLampiran" id="DocLampiran"  width="100%" border="0">
 
				  <?php
					$exe = mysqli_query($con,"SELECT No_ID,DocLampiran,FileLampiran,Index_No 
					FROM tb_packdev_add_resource_doc_lampiran Where Request_No = '".@$tampildata['Request_No']."'   ");
					$no = 1;
					while(@$rowDocLampiran =mysqli_fetch_array($exe)){
					?>
					<tr>
					<td><input type="checkbox" name="chk[]" id="chk[]" value="<?php echo @$rowDocLampiran['No_ID']; ?>"
					<?php echo $disabled; ?>></td>
					<td> 
						<input type="hidden" name="tempfileid[]" id="tempfileid[]" value="<?php echo $rowDocLampiran['No_ID'];?>">
						<input class="form-control py-4"  name="InputDocLampiran[]" id="InputDocLampiran[]" 
						maxlength="1200" type="text" placeholder="Input Nama Document Lampiran"  
						value="<?php echo $rowDocLampiran['DocLampiran'];?>" <?php echo $disabled; ?>  />
					
					</td>
					<td> 
						<?php if (!empty($rowDocLampiran['FileLampiran'])){?>
						<img height="20" width="20" src=../img/pdf.png  title="Open File <?php echo $rowDocLampiran['FileLampiran'];?>"
						onClick="popupwindow('../config/open-pdf.php?kd=<?php echo $rowDocLampiran['No_ID'];?>&page=filearm','Preview Pdf','700','1000');">
						<?php echo $rowDocLampiran['FileLampiran']; }  ?>
					</td>
					</tr>
					<?php $no++;} ?>
				</table>
			  </td>
            </tr>
			<tr>
              <td width="20%"><span class="form-group">Project Name *</span></td>
              <td colspan="2"><span class="form-group">
                <input class="form-control py-4"  name="inputProjectName" id="inputProjectName" 
				maxlength="150" type="text" placeholder="Input Project Name"  <?php echo $disabled; ?>
			  	value="<?php if ($_POST) { echo $inputProjectName; } else {echo @$tampildata['Project_Name'];} ?>" />
              </span> </td>
            </tr>
			<tr>
              <td>Subject *</td>
              <td>
			  <select class="form-control" id="InputSubject" name="InputSubject" <?php echo $disabled; ?>>
					<option value="-" >Select Subject</option>
					<option value="Additional" <?php if (@$tampildata['Subject']=='Additional') {echo "Selected"; }?>>Additional</option>
            		<option value="Change" <?php if (@$tampildata['Subject']=='Change') {echo "Selected";} ?>>Change</option>

			  </select>
			  </td>
            </tr>
			<tr>
              <td>Type *</td>
			  <td colspan="2">
				<table cellpadding="0" cellspacing="0" border="0"width="100%"  >
					<tr>
						<td style="text-align:left; width:120px; height:20px;">
							<label><input type="checkbox" name="ChkType1" id="ChkType1" <?php echo $disabled; ?>
							<?php if (@$tampildata['Type_Finish_Goods']=="1") { echo 'checked="checked"';} ?>> Finish Goods</label></td>
						<td style="text-align:left; width:120px; height:20px;">
							<label><input type="checkbox" name="ChkType2" id="ChkType2" <?php echo $disabled; ?>
							<?php if (@$tampildata['Type_Materials']=="1") { echo 'checked="checked"';} ?> > Materials</label></td>
						<td style="text-align:left; width:120px; height:20px;">
							<label><input type="checkbox" name="ChkType3" id="ChkType3" <?php echo $disabled; ?>
							<?php if (@$tampildata['Type_WorkProcess']=="1") { echo 'checked="checked"';} ?>  > WorkProcess</label></td>
						<td style="text-align:left; width:120px; height:20px;">
							<label><input type="checkbox" name="ChkType4" id="ChkType4" <?php echo $disabled; ?>
							<?php if (@$tampildata['Type_Fu_Fee']=="1") { echo 'checked="checked"';} ?> > Fu Fee</label></td>
						<td style="text-align:left; width:150px; height:20px;">
							<label><input type="checkbox" name="ChkType5" id="ChkType5" <?php echo $disabled; ?>
							<?php if (@$tampildata['Type_Vendor']=="1") { echo 'checked="checked"';} ?> > Vendor</label></td>
						<td style="text-align:left; width:150px; height:20px;">
							<label><input type="checkbox" name="ChkType6" id="ChkType6" <?php echo $disabled; ?>
							<?php if (@$tampildata['Type_Customer']=="1") { echo 'checked="checked"';} ?> > Customer</label></td>
					</tr>
				</table>
			  </td>

        
            </tr>
			<tr>
              <td>Segmentation</td>
              <td colspan="2">
				<table cellpadding="0" cellspacing="0" border="0"width="100%"  >
					<tr>
						<td style="text-align:left; width:120px; height:20px;">
							<label><input type="checkbox" name="ChkSegment1" id="ChkSegment1" <?php echo $disabled; ?>
							<?php if (@$tampildata['Segment_Price']=="1") { echo 'checked="checked"';} ?>> Price</label></td>
						<td style="text-align:left; width:120px; height:20px;">
							<label><input type="checkbox" name="ChkSegment2" id="ChkSegment2" <?php echo $disabled; ?>
							<?php if (@$tampildata['Segment_Data_Informasi']=="1") { echo 'checked="checked"';} ?> > Data Informasi</label></td>
						<td style="text-align:left; width:120px; height:20px;">
							<label><input type="checkbox" name="ChkSegment3" id="ChkSegment3" <?php echo $disabled; ?>
							<?php if (@$tampildata['Segment_Ukuran']=="1") { echo 'checked="checked"';} ?>  > Ukuran</label></td>
						<td style="text-align:left; width:120px; height:20px;">
							<label><input type="checkbox" name="ChkSegment4" id="ChkSegment4" <?php echo $disabled; ?>
							<?php if (@$tampildata['Segment_Others']=="1") { echo 'checked="checked"';} ?> > Others</label></td>
						<td style="text-align:left; width:150px; height:20px;">
							<label><input type="checkbox" name="ChkSegment5" id="ChkSegment5" <?php echo $disabled; ?>
							<?php if (@$tampildata['Segment_Over_Receipt']=="1") { echo 'checked="checked"';} ?> > 10% Over Receipt</label></td>
					</tr>
				</table>
			  </td>
            </tr>
			<tr>
              <td>Content *</td>
              <td colspan="2"><div class="form-group"> <textarea cols="4" id="InputContent" name="InputContent"  
			  class="form-control py-4" placeholder="Enter Content" <?php echo $disabled; ?> 
			  maxlength="100"><?php if ($_POST) { echo $InputContent; } else {echo @$tampildata['Content'];} ?></textarea></div>
			  </td>
            </tr>
            <tr>
              <td>Remark *</td>
              <td colspan="2"><div class="form-group"> <textarea cols="4" id="inputRemark" name="inputRemark"  
			  class="form-control py-4" placeholder="Enter Remark" <?php echo $disabled; ?> 
			  maxlength="2000"><?php if ($_POST) { echo $inputRemark; } else {echo @$tampildata['Remark'];} ?></textarea></div>
			  </td>
            </tr>
			<tr>
              <td colspan="3"> </td>
            </tr>
	
          </table>
		  <?php if (@$tampildata['Status_add_resource']=="" || @$tampildata['Status_add_resource']=="Draft" 
		  || @$tampildata['Status_add_resource']=="Revise" || $button=="add-revise-arm-f2" || $button=="add-copy-arm-f2"){ ?>
			<button type="submit" name="Send" value="NextandSave" onClick="return checkSendApproval(arm)" 
			class="btn btn-primary">Save  and Continue 
			<span   class="glyphicon glyphicon-menu-right" title="Save and Continue "></span></button>
		  <?php } else { ?>
			<button type="submit" name="Send" value="Next"
		  	class="btn btn-primary">Continue 
		  	<span   class="glyphicon glyphicon-menu-right" title="Save and Continue "></span></button>
		  <?php } ?>
		  <?php if (@$tampildata['Status_add_resource']<>"Cancel")  {?>
		  <button type="submit" name="Save" 
		  value="<?php if ($button=="arm-f2-add" || $button=="arm-revise"|| $button=="add-revise-arm-f2" || $button=="add-copy-arm-f2") 
		  {echo"Save";} else {echo"Update";}  ?>"
		  <?php if ($button=="arm-f2-add" || $button=="arm-revise" || $button=="add-revise-arm-f2") 
		   {echo 'onclick="return checkDraft(arm)"';} else {echo 'onclick="return checkEdit(arm)"';} ?>  
		  class="btn btn-primary"
		  <?php if (@$tampildata['Status_add_resource']!="Complete" || 
		  (@$tampildata['Status_add_resource']=="Complete"  & $button=="add-revise-arm-f2") || 
		  (@$tampildata['Status_add_resource']=="Complete"  & $button=="add-copy-arm-f2"))  
		  {echo $disabled;} else {echo "disabled='disabled'";} ?>>Draft</button>
		  <?php ;} ?>
		  
		  <?php if (@$tampildata['Status_add_resource']=="Complete" & $button!="add-revise-arm-f2")  {?>
		  <button type="submit" name="Save" value="Revise" onClick="return checkRevise()" 
		  class="btn btn-primary">Revise</button>
	      <?php ;} ?>
		  <?php if (@$tampildata['Status_add_resource']=="Complete" & $button!="add-revise-arm-f2" || @$tampildata['Status_add_resource']=="Revise" & $button!="add-revise-arm-f2")  {?>
		  <button type="submit" name="Save" value="Cancel" onClick="return checkCancel(arm)" 
		  class="btn btn-primary">Cancel Request</button>
	      <?php ;} ?>

		  <a class="btn btn-primary" href="../dist/index.php?button=arm-f2" title="Back Format No Request">Back</a> 
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


<script>
$(document).ready(function(){
 $('#btnDeleteArm').click(function(){
  
  if(confirm("Are you sure you want to delete this?"))
  {
   var DelArm = [];
   
   $(':checkbox:checked').each(function(i){
    DelArm[i] = $(this).val();
   });
   if(DelArm.length === 0) //tell you if the array is empty
   {
    alert("Please Select atleast one checkbox");
   }
   else
   {
    $.ajax({
     url:'../config/delete.php',
     method:'POST',
     data:{DelArm:DelArm},
     success:function()
     {
      for(var i=0; i<DelArm.length; i++)
      {
       $('tr#'+DelArm[i]+'').css('background-color', '#ccc');
       $('tr#'+DelArm[i]+'').fadeOut('slow');
	   deleteRowDocLampiran('DocLampiran');
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

	<script language="JavaScript" type="text/javascript">
	function checkSendApproval(form){
 		
	if (form.inputAutoRequestNo.value == ""){
    	alert("Request No Can not be empty *");
    	form.inputAutoRequestNo.focus();
    	return (false);  		}
	/*else if (form.InputMPRCode.value == ""){
    	alert("Master Product Request No Can not be empty *");
    	form.InputMPRCode.focus();
    	return (false);  		}*/
	else if(form.inputProjectName.value==""){
		alert("Project Name Can not be empty!");
		form.inputProjectName.focus();
    	return (false);  		}
	else if(form.InputSubject.value=="-"){
		alert("Subject Can not be empty!");
		form.InputSubject.focus();
    	return (false);  		}
	else if(form.InputType.value=="-"){
		alert("Type Can not be empty!");
		form.InputType.focus();
    	return (false);  		}
	else if(form.inputSegmentation.value=="-"){
		alert("Segmentation Can not be empty!");
		form.inputSegmentation.focus();
    	return (false);  		}
	else if (form.InputContent.value == ""){
    	alert("Content Can not be empty *");
    	form.InputContent.focus();
    	return (false);  		}
	/*else if (form.inputRemark.value == ""){
    	alert("Remark Can not be empty *");
    	form.inputRemark.focus();
    	return (false);  		}*/
		return confirm('Are you sure you want to Next Page?');
	}
	
	</script>
	<script src="../vendor/jquery/jquery.min.js"></script>
	<!-- Bootstrap Core JavaScript -->
	<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
	<!-- Metis Menu Plugin JavaScript -->
	<script src="../vendor/metisMenu/metisMenu.min.js"></script>

  
	</script>
 	<script language="JavaScript" type="text/javascript">

	function checkCancel(form){
		return confirm('Are you sure you want to Cancel Request this data?');
	}
	function checkRevise(form){
		return confirm('Are you sure you want to Revise Request this data?');
	}
	</script>

 	<script language="JavaScript" type="text/javascript">
	function checkDraft(form){
	if (form.inputAutoRequestNo.value == ""){
    	alert("Request No Can not be empty *");
    	return (false);  		}
	else if(form.inputProjectName.value==""){
		alert("Project Name Can not be empty!");
		form.inputProjectName.focus();
    	return (false);  		}
		return confirm('Are you sure you want to Draft this data?');
	}
	function checkEdit(form){
		return confirm('Are you sure you want to Update this data?');
	}
	</script>
 	</body>
</html>

 