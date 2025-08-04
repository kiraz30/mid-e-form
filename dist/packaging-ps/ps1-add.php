	<?php $Send		= @$_POST['Send']; ?>
	<?php $Save		= @$_POST['Save']; ?>
<script language="JavaScript">
	function setFocus(){
		document.ps.InputARMCode.focus();	
		
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
      <h3 class="mt-4"><?php if ($button=="ps-add" || $button=="ps-revise-ps") 
		{echo "New Request Packaging Spesification";} else  {echo "Edit Request Packaging Spesification";} ?></h3>
	    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="../dist/index.php?button=dashboard">Dashboard</a></li>
		<li class="breadcrumb-item"><a href="../dist/index.php?button=ps">Packaging Spesification</a></li>
        <li class="breadcrumb-item active"><?php if ($button=="ps-add" || $button=="ps-revise-ps") 
		{echo "New Request Packaging Spesification";} else  {echo "Edit Request Packaging Spesification";} ?> </li>
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
		$query="SELECT a.Request_No,a.Index_Document,a.Last_Request_No,a.Status_Last_Document,
		a.ARM_Code,a.MPR_Code,b.Project_Name,a.Finish_Good_Code,a.Finish_Good_Name,a.Netto,a.Isi,a.DZ_CT,
		a.Market,a.Barcode,a.CreatedBy,DATE(a.CreatedDate) as CreatedDate,a.Status_Spec,a.Remark
		FROM  tb_packdev_spec a INNER JOIN tb_packdev_add_resource b ON a.ARM_Code=b.Request_No
		WHERE a.Request_No = '".@$_GET['id']."' ";
	    $exe =mysqli_query($con,$query);
        $tampildata=mysqli_fetch_array($exe);
		$rev=@$tampildata['Index_Document']+1;

		
		//________________________________________________________________________________Status ps disabled

		if (@$tampildata['Status_Spec']<>"Draft" & @$tampildata['Status_Spec']<>"" & 
			$button<>"add-revise-ps" & $button<>"revise-ps")
		  {$disabled="disabled";} else{$disabled="";}
	

		  
		//________________________________________________________________________________WORKFLOWFNIM
		$exeReq = mysqli_query($con,"Select NameApproval,OnBehalf,Remark_WorkFlow FROM tb_workflowNPRF 
		WHERE Request_No = '".@$_GET['id']."' And Index_No='1' limit 1");
		$tampildataReq=mysqli_fetch_array($exeReq);
		//________________________________________________________________________________
        
	  	?>
	<form name="ps" id="ps" action="" method="post"  enctype="multipart/form-data"  >
    <?php 
	//Begin CRUD----------------------------------------------------------------------
	$datenow					= date("Y-m-d");
	include "ps-autonumber.php";
	if($_POST){
		$ip						=$_SERVER['REMOTE_ADDR'];
		$hostname 				= gethostbyaddr($_SERVER['REMOTE_ADDR']);
		date_default_timezone_set("Asia/Jakarta");
		$createddate			=date("Y-m-d H:i:s");
		$yymmddhMs				=date("YmdHis");

    	$tempFormatNoRequest  	= $_POST['tempFormatNoRequest'];
		$inputAutoRequestNo		= $_POST['inputAutoRequestNo'];
		$inputLastRequestNo		= @$_POST['inputLastRequestNo'];
		$InputARMCode			= @$_POST['InputARMCode'];
		$InputMPRCode			= @$_POST['InputMPRCode'];
		$inputProjectName		= @$_POST['inputProjectName'];
		$inputFinishGoodCode 	= @$_POST['inputFinishGoodCode'];
		$inputFinishGoodName 	= @$_POST['inputFinishGoodName'];
		$inputNetto			 	= @$_POST['inputNetto'];
		$inputIsi			 	= @$_POST['inputIsi'];
		$inputDZCT			 	= @$_POST['inputDZCT'];
		$inputMarket		 	= @$_POST['inputMarket'];
		$inputBarcode			= @$_POST['inputBarcode'];
 
		
		if($Save=="Save"){
			include "ps-autonumber.php";
			$Tanya = mysqli_query($con,"SELECT Request_No FROM tb_packdev_spec WHERE Request_No = '$inputAutoRequestNo' ");
			if (mysqli_num_rows($Tanya) !=0 ) {  
				echo "<div class='form-group has-error'>
				<label class='control-label' for='inputError'>Error Save : Request No already exists in the database *</label></div>";}
			else{
				//membuat Query untuk menyimpan data
				include "ps-autonumber.php";
				if ($button=="ps-add") {
					include "ps-save-new.php";
				}else {
					include "ps-save-new.php";
					include "ps-detail-form-save-new-revise.php";
				}
				include "ps-save-workflow.php";
	
				$message = "Data successfully Save to Draft";
				echo "<script type='text/javascript'>alert('$message');</script>";
				//echo"<script>  window.location='../dist/index.php?button=ps'; </script>";
			}

		}elseif($Save=="Update"){ 
			//membuat Query untuk update data
			include "ps-edit.php";	
			$message = "Data successfully Update to Draft";	
			echo "<script type='text/javascript'>alert('$message');</script>";
			echo"<script>  window.location='../dist/index.php?button=ps'; </script>";
		
		}elseif ($Save=="Revise"){
			//Simpan Status Revise NPRF
			mysqli_query($con,"UPDATE tb_packdev_spec Set Status_Spec='Revise' WHERE Request_No='$inputAutoRequestNo'");
			mysqli_query($con,"UPDATE From tb_workflownprf Set Status_Approval ='0'WHERE Request_No='$inputAutoRequestNo'");
			//_________________________________________________________________________________________
			$message = "Data successfully Revise";
			echo "<script type='text/javascript'>alert('$message');</script>";
			echo"<script>  window.location='../dist/index.php?button=revise-ps&id=$inputAutoRequestNo'; </script>";
			 
		}elseif($Save=="Cancel"){ 
			include "ps-edit.php";
			mysqli_query($con,"UPDATE tb_packdev_spec SET Status_Spec='Cancel' WHERE Request_No='$inputAutoRequestNo'");
			mysqli_query($con,"UPDATE tb_inbox SET Request_Status='Cancel' WHERE Request_No='$inputAutoRequestNo'");
			
			$message = "Data successfully Cancel Request";
			echo "<script type='text/javascript'>alert('$message');</script>";
			echo"<script>  window.location='../dist/index.php?button=ps'; </script>";
		
		}elseif($Send=="NextandSave"){ 
			include "ps-autonumber.php";
				$Tanya = mysqli_query($con,"SELECT Request_No FROM tb_packdev_spec WHERE Request_No = '$inputAutoRequestNo' ");
				if (mysqli_num_rows($Tanya) !=0 ) {
					//Update Next
					include "ps-edit.php";
				}
				else{
					//membuat Query untuk menyimpan data
					if ($button=="add-revise-ps"){
						include "ps-save-new.php";
						include "ps-detail-form-save-new-revise.php";
						include "ps-save-workflow.php";}
					else{
						include "ps-autonumber.php";
						include "ps-save-new.php";
						include "ps-save-workflow.php";
					}
					
					
				}
				//_________________________________________________________________________________________
				//echo"<script>  window.location='../dist/index.php?button=ps-detail-add&id=$inputAutoRequestNo'; </script>";
			}
			elseif($Send=="Next"){ 
				//_________________________________________________________________________________________
				echo"<script>  window.location='../dist/index.php?button=ps-detail-add&id=$inputAutoRequestNo'; </script>";
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
			  value="<?php if ($button=="ps-add") {echo $NomorReq;} elseif ($button=="add-revise-ps") 
			  {echo substr($tampildata['Request_No'],0,17)."-R".$rev;} else {echo @$tampildata['Request_No'];} ?>" />
              </span> </td>
            </tr>
            <tr>
              <td width="20%"><span class="form-group">Last Request No  </span></td>
              <td colspan="2"><span class="form-group">
                <input class="form-control py-4"  name="inputLastRequestNo" id="inputLastRequestNo"  maxlength="50" type="text"  
			  placeholder="Auto Request No"  readonly="readonly" 
			  value="<?php if (@$tampildata['Status_Spec']=="Complete" & $button=="add-revise-ps") 
			  {echo @$tampildata['Request_No'];} else {echo @$tampildata['Last_Request_No'];}?>" />
              </span> </td>
            </tr>
			<tr>
              <td><span class="form-group">Add Resource Master Request No *</span></td>
              <td width="30%"><div class="form-group d-flex align-items-center justify-content-between mt-0 mb-1">
			  	<input type="text" class="form-control"  name="InputARMCode" id="InputARMCode" 
				placeholder="Resource Master Request No"  
				value="<?php if ($_POST) { echo $InputARMCode; } else {echo @$tampildata['ARM_Code'];} ?>" readonly="readonly">
				&nbsp;<button type="button" style="padding:2px 4px 4px 4px" 
			   class="btn btn-primary" title="Search Project Name"  
					name="btnsearch" 
					onClick="popupwindow('packaging-ps/project-name-popup.php?id=ps','Search Project Name','600','900');" <?php echo $disabled; ?>>
					<span class="glyphicon glyphicon-search" ></span> </button>
				</div>
			  </td>
			  <td width="30%">
			  </td>
            </tr>
            <tr>
              <td><span class="form-group">Master Product Request No *</span></td>
              <td width="30%"><div class="form-group d-flex align-items-center justify-content-between mt-0 mb-1">
			  	<input type="text" class="form-control"  name="InputMPRCode" id="InputMPRCode" 
				placeholder="Master Product Request No"  
				value="<?php if ($_POST) { echo $InputMPRCode; } else {echo @$tampildata['MPR_Code'];} ?>" 
				readonly="readonly">
				</div>
			  </td>
			  <td width="30%">
			  </td>
            </tr>
			<tr>
              <td width="20%"><span class="form-group">Project Name *</span></td>
              <td colspan="2"><span class="form-group">
                <input class="form-control py-4" name="inputProjectName" id="inputProjectName" 
				maxlength="150" type="text" placeholder="Input Project Name" 
			  	value="<?php if ($_POST) { echo $inputProjectName; } else {echo @$tampildata['Project_Name'];} ?>" readonly="readonly"  />
              </span> </td>
            </tr>
			<tr>
              <td width="20%"><span class="form-group">Finish Good Code *</span></td>
              <td><span class="form-group">
			  <input class="form-control py-4" name="inputFinishGoodCode" id="inputFinishGoodCode"  
				maxlength="50" type="text" placeholder="Input Finish Good Code"  
				value="<?php if ($_POST) { echo $inputFinishGoodCode; } else {echo @$tampildata['Finish_Good_Code'];} ?>" 
				<?php echo $disabled; ?> />
              </span> </td>
            </tr>
			<tr>
              <td width="20%"><span class="form-group">Finish Good Name *</span></td>
              <td colspan="2"><span class="form-group">
			  <input class="form-control py-4" name="inputFinishGoodName" id="inputFinishGoodName" 
				maxlength="150" type="text" placeholder="Input Finish Good Name"   
				value="<?php if ($_POST) { echo $inputFinishGoodName; } else {echo @$tampildata['Finish_Good_Name'];} ?>" 
				<?php echo $disabled; ?> />
              </span> </td>
            </tr>
			<tr>
              <td width="20%"><span class="form-group">Netto *</span></td>
              <td ><span class="form-group">
			  <input class="form-control py-4" name="inputNetto" id="inputNetto" 
				maxlength="150" type="text" placeholder="Input Netto"   
				value="<?php if ($_POST) { echo $inputNetto; } else {echo @$tampildata['Netto'];} ?>" 
				<?php echo $disabled; ?> />
              </span> </td>
            </tr>
			<tr>
              <td width="20%"><span class="form-group">Isi *</span></td>
              <td ><span class="form-group">
			  <input class="form-control py-4" name="inputIsi" id="inputIsi" 
				maxlength="150" type="text" placeholder="Input Isi"   
				value="<?php if ($_POST) { echo $inputIsi; } else {echo @$tampildata['Isi'];} ?>"
				<?php echo $disabled; ?> />
              </span> </td>
            </tr>
			<tr>
              <td width="20%"><span class="form-group">Dz/CT *</span></td>
              <td ><span class="form-group">
			  <input class="form-control py-4" name="inputDZCT" id="inputDZCT" 
				maxlength="150" type="text" placeholder="Input Dz/CT"   
				value="<?php if ($_POST) { echo $inputDZCT; } else {echo @$tampildata['DZ_CT'];} ?>"
				<?php echo $disabled; ?> />
              </span> </td>
            </tr>
			<tr>
              <td width="20%"><span class="form-group">Market *</span></td>
              <td ><span class="form-group">
			  <input class="form-control py-4" name="inputMarket" id="inputMarket" 
				maxlength="150" type="text" placeholder="Input Market"   
				value="<?php if ($_POST) { echo $inputMarket; } else {echo @$tampildata['Market'];} ?>" 
				<?php echo $disabled; ?> />
              </span> </td>
            </tr>
			<tr>
              <td width="20%"><span class="form-group">Barcode *</span></td>
              <td ><span class="form-group">
			  <input class="form-control py-4" name="inputBarcode" id="inputBarcode" 
				maxlength="150" type="text" placeholder="Input Barcode"   
				value="<?php if ($_POST) { echo $inputBarcode; } else {echo @$tampildata['Barcode'];} ?>"
				<?php echo $disabled; ?>  />
              </span> </td>
            </tr>
			<tr>
              <td colspan="3"> 
			  <table name="Packaging-spec" id="Packaging-spec"  width="100%" border="1" class="table table-striped table-bordered table-hover" >
				</table>
			  </td>
            </tr>
			
	
          </table>
	
 
		  <?php if (@$tampildata['Status_Spec']=="" || @$tampildata['Status_Spec']=="Draft" 
		  || @$tampildata['Status_Spec']=="Revise" || $button=="add-revise-ps"){ ?>
			<button type="submit" name="Send" value="NextandSave" onClick="return checkSendApproval(ps)" 
			class="btn btn-primary">Save  and Continue 
			<span   class="glyphicon glyphicon-menu-right" title="Save and Continue "></span></button>
		  <?php } else { ?>
			<button type="submit" name="Send" value="Next"
		  	class="btn btn-primary">Continue 
		  	<span   class="glyphicon glyphicon-menu-right" title="Save and Continue "></span></button>
		  <?php } ?>
		  
		  <?php if (@$tampildata['Status_Spec']<>"Cancel")  {?>
		  <button type="submit" name="Save" 
		  value="<?php if ($button=="ps-add" || $button=="ps-revise"|| $button=="add-revise-ps") 
		  {echo"Save";} else {echo"Update";}  ?>"
		  <?php if ($button=="ps-add" || $button=="ps-revise" || $button=="add-revise-ps") 
		   {echo 'onclick="return checkDraft(ps)"';} else {echo 'onclick="return checkEdit(ps)"';} ?>  
		  class="btn btn-primary"
		  <?php if (@$tampildata['Status_Spec']!="Complete" || (@$tampildata['Status_Spec']=="Complete"  & $button=="add-revise-ps") )  
		  {echo $disabled;} else {echo "disabled='disabled'";} ?>>Draft</button>
		  <?php ;} ?>
		  
		  <?php if (@$tampildata['Status_Spec']=="Complete" & $button!="add-revise-ps")  {?>
		  <button type="submit" name="Save" value="Revise" onClick="return checkRevise()" 
		  class="btn btn-primary">Revise</button>
	      <?php ;} ?>
		  <?php if (@$tampildata['Status_Spec']=="Complete" & $button!="add-revise-ps" || @$tampildata['Status_Spec']=="Revise" & $button!="add-revise-ps")  {?>
		  <button type="submit" name="Save" value="Cancel" onClick="return checkCancel(ps)" 
		  class="btn btn-primary">Cancel Request</button>
	      <?php ;} ?>

		  <a class="btn btn-primary" href="../dist/index.php?button=ps" title="Back Format No Request">Back</a> 
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

		return confirm('Are you sure you want to Next Page?');
	}
	
</script>

	<script src="../vendor/jquery/jquery.min.js"></script>
 
	<!-- Metis Menu Plugin JavaScript -->
	<script src="../vendor/metisMenu/metisMenu.min.js"></script>
 

</body>
</html>
 

<script language="JavaScript" type="text/javascript">

function checkCancel(form){
	return confirm('Are you sure you want to Cancel Request this data?');
}
function checkRevise(form){
	return confirm('Are you sure you want to Revise Request this data?');
}
 
function checkDraft(form){
	if (form.$inputAutoRequestNo.value == ""){
    	alert("Request No Can not be empty *");
    	form.$inputAutoRequestNo.focus();
    	return (false);  		}
	else if (form.InputARMCode.value == ""){
    	alert("Add Resource Master Request No Can not be empty *");
    	form.InputARMCode.focus();
    	return (false);  		}
	else if (form.$InputMPRCode.value == ""){
    	alert("Master Product Request No Can not be empty *");
    	form.$InputMPRCode.focus();
    	return (false);  		}
		return confirm('Are you sure you want to Draft this data?');
}
function checkEdit(form){
	return confirm('Are you sure you want to Update this data?');
}
</script>
  
 

 