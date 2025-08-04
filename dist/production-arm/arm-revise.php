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
      <h3 class="mt-4"><?php if ($button=="arm-add" || $button=="add-revise-arm") 
		{echo "New Request Additional Resource Master";} else  {echo "Edit Request Additional Resource Master";} ?> </h3>
	    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="../dist/index.php?button=dashboard">Dashboard</a></li>
		<li class="breadcrumb-item"><a href="../dist/index.php?button=arm">Additional Resource Master</a></li>
        <li class="breadcrumb-item active"><?php if ($button=="arm-add" || $button=="add-revise-arm") 
		{echo "New Request Additional Resource Master";} else  {echo "Edit Request Additional Resource Master";} ?> </li>
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
		a.MPR_Code,a.Project_Name,a.Subject,a.`Type`,a.Segment_Price,a.Segment_Data_Informasi,
		a.Segment_Ukuran,a.Segment_Others,a.Segment_Over_Receipt,a.Content,a.Remark,
		a.LAST_TRACK,a.CreatedBy,date(a.CreatedDate) as Created_Date 
		from tb_prod_add_resource a  
		WHERE a.Request_No = '".@$_GET['id']."' ";
		if ($button=="arm-add") {$query.=" And a.Status_Last_Document='1'";}
		else {$query =$query; }
      	$exe =mysqli_query($con,$query);
        $tampildata=mysqli_fetch_array($exe);
		$rev=@$tampildata['Index_Document']+1;

		
		//________________________________________________________________________________Status ARM disabled

		if (@$tampildata['LAST_TRACK']<>"1" & @$tampildata['LAST_TRACK']<>"" & 
			$button<>"add-revise-prod-arm" & $button<>"revise-prod-arm")
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
		$InputMPRCode			= @$_POST['InputMPRCode'];
		$inputProjectName		= @$_POST['inputProjectName'];
		$InputSubject		 	= @$_POST['InputSubject'];
		$InputType			 	= @$_POST['InputType'];
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
			$Tanya = mysqli_query($con,"SELECT Request_No FROM tb_prod_add_resource WHERE Request_No = '$inputAutoRequestNo' ");
			if (mysqli_num_rows($Tanya) !=0 ) {  
				echo "<div class='form-group has-error'>
				<label class='control-label' for='inputError'>Error Save : Request No already exists in the database *</label></div>";}
			else{
				//membuat Query untuk menyimpan data
				include "arm-autonumber.php";
				if ($button=="prod-arm-add") {
					include "arm-save-new.php";
				}else {
					include "arm-save-new-revisi.php";
					//include "arm-save-file-new-revisi.php"; 
				}
				include "arm-save-workflow.php";
	
				$message = "Data successfully Save to Draft";
				echo "<script type='text/javascript'>alert('$message');</script>";
				echo"<script>  window.location='../dist/index.php?button=prod-arm'; </script>";
				}
			}
		elseif($Save=="Update"){ 
			//membuat Query untuk update data
			include "arm-edit.php";	
			$message = "Data successfully Update to Draft";	
			echo "<script type='text/javascript'>alert('$message');</script>";
			echo"<script>  window.location='../dist/index.php?button=prod-arm'; </script>";
		}
		elseif ($Save=="Revise"){
			//Simpan Status Revise NPRF
			mysqli_query($con,"UPDATE tb_prod_add_resource Set LAST_TRACK='3' WHERE Request_No='$inputAutoRequestNo'");
			mysqli_query($con,"UPDATE From tb_workflownprf Set Status_Approval ='0'WHERE Request_No='$inputAutoRequestNo'");
			//_________________________________________________________________________________________
			$message = "Data successfully Revise";
			echo "<script type='text/javascript'>alert('$message');</script>";
			echo"<script>  window.location='../dist/index.php?button=revise-prod-arm&id=$inputAutoRequestNo'; </script>";
			 
		}
		elseif($Save=="Cancel"){ 
			include "arm-edit.php";
			mysqli_query($con,"UPDATE tb_prod_add_resource SET LAST_TRACK='5' WHERE Request_No='$inputAutoRequestNo'");
			mysqli_query($con,"UPDATE tb_inbox SET Request_Status='Cancel' WHERE Request_No='$inputAutoRequestNo'");
			
			$message = "Data successfully Cancel Request";
			echo "<script type='text/javascript'>alert('$message');</script>";
			echo"<script>  window.location='../dist/index.php?button=prod-arm'; </script>";
			}
		elseif($Send=="NextandSave"){ 
			include "arm-autonumber.php";
			$Tanya = mysqli_query($con,"SELECT Request_No FROM tb_prod_add_resource WHERE Request_No = '$inputAutoRequestNo' ");
			if (mysqli_num_rows($Tanya) !=0 ) {
				//Update Next
				include "arm-edit.php";
			}
			else{
				//membuat Query untuk menyimpan data
				if ($button=="arm-revise"){
					include "arm-save-new-revisi.php";
					include "arm-save-file-new-revisi.php";}
				else{
					include "arm-autonumber.php";
					include "arm-save-new.php";
					include "arm-save-workflow.php";
				}
				
				
			}
			//_________________________________________________________________________________________
			echo"<script>  window.location='../dist/index.php?button=prod-arm-detail-add&id=$inputAutoRequestNo'; </script>";
		}
		elseif($Send=="Next"){ 
			//_________________________________________________________________________________________
			echo"<script>  window.location='../dist/index.php?button=prod-arm-detail-add&id=$inputAutoRequestNo'; </script>";
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
			  value="<?php if ($button=="arm-add") {echo $NomorReq;} elseif ($button=="add-revise-arm") 
			  {echo substr($tampildata['Request_No'],0,17)."-R".$rev;} else {echo @$tampildata['Request_No'];} ?>" />
              </span> </td>
            </tr>
            <tr>
              <td width="20%"><span class="form-group">Last Request No  </span></td>
              <td colspan="2"><span class="form-group">
                <input class="form-control py-4"  name="inputLastRequestNo" id="inputLastRequestNo"  maxlength="50" type="text"  
			  placeholder="Auto Request No"  readonly="readonly" 
			  value="<?php if (@$tampildata['LAST_TRACK']=="7" & $button=="add-revise-prod-arm") 
			  {echo @$tampildata['Request_No'];} else {echo @$tampildata['Last_Request_No'];}?>" />
              </span> </td>
            </tr>
            <tr>
              <td><span class="form-group">Master Product Request No *</span></td>
              <td width="30%"><div class="form-group d-flex align-items-center justify-content-between mt-0 mb-1">
			  	<input type="text" class="form-control"  name="InputMPRCode" id="InputMPRCode" 
				placeholder="Master Product Request No"  
				value="<?php if ($_POST) { echo $InputMPRCode; } else {echo @$tampildata['MPR_Code'];} ?>" 
				onChange="setFocus(),get_detaildata()" onFocus="setFocus(),get_detaildata()" readonly="readonly">
				&nbsp;<button type="button" style="padding:2px 4px 4px 4px" 
			   class="btn btn-primary" title="Search Project Name"  
					name="btnsearch" 
					onClick="popupwindow('packaging-arm/project-name-popup.php?id=mpr','Search Project Name','600','900');" <?php echo $disabled; ?>>
					<span class="glyphicon glyphicon-search" ></span> </button>
				</div>
			  </td>
			  </td>
			  <td width="30%">
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
              <td>
			  <select class="form-control" id="InputType" name="InputType" <?php echo $disabled; ?>>
					<option value="-" >Select Type</option>
					<option value="FhinishGoods" <?php if (@$tampildata['Type']=='FhinishGoods') {echo "Selected"; }?> >FhinishGoods</option>
					<option value="WorkProcess" <?php if (@$tampildata['Type']=='WorkProcess') {echo "Selected"; }?> >WorkProcess</option>
					<option value="Materials" ><?php if (@$tampildata['Type']=='Materials') {echo "Selected"; }?> Materials</option>
					<option value="Fu Fee" <?php if (@$tampildata['Type']=='Fu Fee') {echo "Selected"; }?> >Fu Fee</option>
					<option value="Vendor" <?php if (@$tampildata['Type']=='Vendor') {echo "Selected"; }?> >Vendor</option>
					<option value="Customer" <?php if (@$tampildata['Type']=='Customer') {echo "Selected"; }?> >Customer</option>
			  </select>
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
			  maxlength="100"><?php if ($_POST) { echo $inputRemark; } else {echo @$tampildata['Remark'];} ?></textarea></div>
			  </td>
            </tr>
			<tr>
              <td colspan="3"> </td>
            </tr>
	
          </table>
		  <?php if (@$tampildata['LAST_TRACK']=="" || @$tampildata['LAST_TRACK']=="1" 
		  || @$tampildata['LAST_TRACK']=="3" || $button=="add-revise-prod-arm"){ ?>
			<button type="submit" name="Send" value="NextandSave" onClick="return checkSendApproval(arm)" 
			class="btn btn-primary">Save  and Continue 
			<span   class="glyphicon glyphicon-menu-right" title="Save and Continue "></span></button>
		  <?php } else { ?>
			<button type="submit" name="Send" value="Next"
		  	class="btn btn-primary">Continue 
		  	<span   class="glyphicon glyphicon-menu-right" title="Save and Continue "></span></button>
		  <?php } ?>
		  <?php if (@$tampildata['LAST_TRACK']<>"5")  {?>
		  <button type="submit" name="Save" value="<?php if ($button=="prod-arm-add" || $button=="prod-arm-revise") 
		  {echo"Save";} else {echo"Update";}  ?>"
		  <?php if ($button=="prod-arm-add" || $button=="prod-arm-revise") 
		   {echo 'onclick="return checkDraft(arm)"';} else {echo 'onclick="return checkEdit(arm)"';} ?>  
		  class="btn btn-primary"
		  <?php if (@$tampildata['LAST_TRACK']!="7" || (@$tampildata['LAST_TRACK']=="7"  & $button=="add-revise-prod-arm") )  
		  {echo $disabled;} else {echo "disabled='disabled'";} ?>>Draft</button>
		  <?php ;} ?>
		  
		  <?php if (@$tampildata['LAST_TRACK']=="7" & $button!="add-revise-prod-arm")  {?>
		  <button type="submit" name="Save" value="Revise" onClick="return checkRevise()" 
		  class="btn btn-primary">Revise</button>
	      <?php ;} ?>
		  <?php if (@$tampildata['LAST_TRACK']=="7" & $button!="add-revise-prod-arm" || @$tampildata['LAST_TRACK']=="3" & $button!="add-revise-prod-arm")  {?>
		  <button type="submit" name="Save" value="Cancel" onClick="return checkCancel(arm)" 
		  class="btn btn-primary">Cancel Request</button>
	      <?php ;} ?>

		  <a class="btn btn-primary" href="../dist/index.php?button=prod-arm" title="Back Format No Request">Back</a> 
		</form>
		</div>
      </div>
	 </div>
    </main> 
  

	<script language="JavaScript" type="text/javascript">
	function checkSendApproval(form){
 		
	if (form.inputAutoRequestNo.value == ""){
    	alert("Request No Can not be empty *");
    	form.inputAutoRequestNo.focus();
    	return (false);  		}
	else if (form.InputMPRCode.value == ""){
    	alert("Master Product Request No Can not be empty *");
    	form.InputMPRCode.focus();
    	return (false);  		}
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
	else if (form.inputRemark.value == ""){
    	alert("Remark Can not be empty *");
    	form.inputRemark.focus();
    	return (false);  		}
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
	else if (form.InputMPRCode.value == ""){
    	alert("Master Product Request No Can not be empty *");
    	form.InputMPRCode.focus();
    	return (false);  		}
		return confirm('Are you sure you want to Draft this data?');
	}
	function checkEdit(form){
		return confirm('Are you sure you want to Update this data?');
	}
	</script>
 	</body>
</html>

<!--script>
$(document).ready(function(){
 $('#next').click(function(){
	get_ArmDetail();
 });
});
 function get_ArmDetail(){
  var a = $('#inputAutoRequestNo').val();
  var c = $('#InputType').val();
  var d = $('#inputRemark').val();

  $.ajax({
   type: 'POST',
   url: "packaging-arm/arm-detail-add.php",
   
   data: { data1: a, data2: b, data3: c},
   success: function(info) {
	$("#arm-detail").html(info);  
	}
  });
  return false;
 }
</script>
<script>
$(document).ready(function(){
 $('#back').click(function(){
	get_ArmDetail();
 });
});
 function get_ArmDetail(){
  var a = $('#inputAutoRequestNo').val();

  $.ajax({
   type: 'POST',
   url: "packaging-arm/arm-add.php",
   
   data: { data1: a},
   success: function(info) {
	$("#arm-detail").html(info);  
	}
  });
  return false;
 }
</script-->
 