	<?php $Send		= @$_POST['Send']; ?>
	<?php $Save		= @$_POST['Save']; ?>
<script language="JavaScript">
	function setFocus(){
		document.faw.InputMPRCode.focus();	
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
	
 <!-- Bootstrap Core CSS -->
 <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<!-- MetisMenu CSS -->
<link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

<!-- DataTables CSS -->
<link href="../vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

<!-- DataTables Responsive CSS -->
<link href="../vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

<!-- Custom CSS -->
<link href="../dist/css/sb-admin-2.css" rel="stylesheet">

<!-- Custom Fonts -->
<link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
		 
	 
	</head>
	<body onload='setFocus()' > 
	<main> 
    <div class="container-fluid"> 
      <h3 class="mt-4"><?php if ($button=="arm-add" || $button=="arm-revise") 
		{echo "New Request Additional Resource Master";} else  {echo "Edit Request Additional Resource Master";} ?> </h3>
	    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="../dist/index.php?button=dashboard">Dashboard</a></li>
		<li class="breadcrumb-item"><a href="../dist/index.php?button=arm">Additional Resource Master</a></li>
		<li class="breadcrumb-item"><a href="../dist/index.php?button=arm-edit&id=<?php echo $_GET['id']; ?>">New Request Additional Resource Master</a></li>
        <li class="breadcrumb-item active"><?php if ($button=="arm-add" || $button=="add-revise-arm") 
		{echo "New Request Additional Resource Master";} else  {echo "Edit Request Additional Resource Master";} ?> </li>
      </ol>
 	<div class="card mb-4">

	    <div class="card-header">
		
		<label>100 % This text indicates success. </label>
		<div class="progress">
			<div class="progress-bar" role="progressbar" style="width: 100%" 
			aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
		</div>
		</div>

        <div class="card-body"> 
			
        <?php
		include "arm-autonumber.php";
			
		$query="SELECT a.ID_No,a.Index_Document,a.Request_No,a.Last_Request_No,a.Status_Last_Document,
		a.MPR_Code,a.Project_Name,a.Subject,a.`Type`,a.Content,a.Remark,a.Type_Materials,a.Type_Fu_Fee,
		a.Remark,a.LAST_TRACK,a.CreatedBy,date(a.CreatedDate) as Created_Date 
		from tb_prod_add_resource a WHERE a.Request_No = '".@$_GET['id']."' ";
		if ($button=="prod-arm-add") {$query.=" And a.Status_Last_Document='1'";}
		else {$query =$query; }
      	$exe =mysqli_query($con,$query);
        $tampildata=mysqli_fetch_array($exe);
		$rev=@$tampildata['Index_Document']+1;

	 	//________________________________________________________________________________Status ARM disabled

		if (@$tampildata['LAST_TRACK']<>"1" & @$tampildata['LAST_TRACK']<>"3" 
		& @$tampildata['LAST_TRACK']<>""  )
		  {$disabled="disabled";} else{$disabled="";} 

 
 
        
	  	?>
	<form name="faw" id="faw" action="" method="post"  enctype="multipart/form-data"  >
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
		$inputWorkflowRemark	= @$_POST['inputWorkflowRemark'];
		
		if ($Save=="Revise"){
			//Simpan Status Revise
			mysqli_query($con,"UPDATE tb_prod_add_resource Set LAST_TRACK='3' WHERE Request_No='$inputAutoRequestNo'");
			SaveTracking($inputAutoRequestNo,'3',$inputWorkflowRemark,$username,$createddate,$hostname);
			UpdateStatusTracking($inputAutoRequestNo,'0');

			//_________________________________________________________________________________________
			$message = "Data successfully Revise";
			echo "<script type='text/javascript'>alert('$message');</script>";
			echo"<script>  window.location='../dist/index.php?button=revise-prod-arm&id=$inputAutoRequestNo'; </script>";
			 
		}elseif($Save=="Cancel"){ 
			mysqli_query($con,"UPDATE tb_prod_add_resource SET LAST_TRACK='5' WHERE Request_No='$inputAutoRequestNo'");
			SaveTracking($inputAutoRequestNo,'5',$inputWorkflowRemark,$username,$createddate,$hostname);
			UpdateStatusTracking($inputAutoRequestNo,'0');

			$message = "Data successfully Cancel Request";
			echo "<script type='text/javascript'>alert('$message');</script>";
			echo"<script>  window.location='../dist/index.php?button=prod-arm'; </script>";
		}elseif($Send=="Send"){ 
		 
			mysqli_query($con,"UPDATE tb_prod_add_resource SET LAST_TRACK='2',
			UpdatedBy='$username',UpdatedDate='$createddate',UpdatedHostName='$ip : $hostname' 
			WHERE Request_No='$inputAutoRequestNo'");
			SaveTracking($inputAutoRequestNo,'2',$inputWorkflowRemark,$username,$createddate,$hostname);

			//Send Email Notification for Approval------------------------------------------------
			$exeNext = mysqli_query($con,"SELECT a.KDDivision,a.KDPosition
			FROM  tb_user a INNER JOIN param_tracking_access b ON a.KDPosition=b.ROLE_APPLICATION_CODE
			INNER JOIN tb_prod_add_resource c ON b.TRACKING_CODE=c.LAST_TRACK
			WHERE c.Request_No='$inputAutoRequestNo' And a.KDDivision='$divisioncode' 
			AND b.TRACKING_CODE='2' GROUP BY  a.KDDivision,a.KDPosition");
			while(@$tampildataNext =mysqli_fetch_array($exeNext)){

			$appdivisi= @$tampildataNext['KDDivision'];
			$appposisi= @$tampildataNext['KDPosition'];
				 

			}
			$remark=$inputWorkflowRemark;
			$id=$inputAutoRequestNo;
			$page="prod-arm-app";
			$WorkFlowMenu="ARM-F1";
			$Confirm=="Approve";
			require ("../config/emailnewapp.php");
			 
			//_________________________________________________________________________________________
			$message = "Data successfully Sent  to Approval";
			echo "<script type='text/javascript'>alert('$message');</script>";
			echo"<script>  window.location='../dist/index.php?button=arm'; </script>"; 
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
			  value="<?php if ($button=="arm-add") {echo $NomorReq;} elseif ($button=="arm-add") 
			  {echo substr($tampildata['Request_No'],0,17)."-R".$rev;} else {echo @$tampildata['Request_No'];} ?>" />
              </span> </td>
            </tr>
            <tr>
              <td width="20%"><span class="form-group">Last Request No *</span></td>
              <td colspan="2"><span class="form-group">
                <input class="form-control py-4"  name="inputLastRequestNo" id="inputLastRequestNo"  maxlength="50" type="text"  
			  placeholder="Auto Request No"  readonly="readonly" 
			  value="<?php if (@$tampildata['Status_add_resource']=="Complete" & $button=="arm-revise") 
			  {echo @$tampildata['Request_No'];} else {echo @$tampildata['Last_Request_No'];}?>" />
              </span> </td>
            </tr>
			<tr>
              <td width="20%"><span class="form-group">Project Name</span></td>
              <td colspan="2"><span class="form-group">
                <input class="form-control py-4"  name="inputProjectName" id="inputProjectName" 
				maxlength="150" type="text" placeholder="Input Project Name"  readonly="readonly" 
			  	value="<?php if ($_POST) { echo $inputProjectName; } else {echo @$tampildata['Project_Name'];} ?>" />
              </span> </td>
            </tr>
			<tr>
              <td>Subject *</td>
              <td>
			  	<select class="form-control" id="InputSubject" name="InputSubject" disabled>
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
							<label><input type="checkbox" name="ChkType2" id="ChkType2" onclick="return false;"
							<?php if (@$tampildata['Type_Materials']=="1") { echo 'checked="checked"';} ?>> Materials</label></td>
						<td style="text-align:left; width:120px; height:20px;">
							<label><input type="checkbox" name="ChkType4" id="ChkType4" onclick="return false;"
							<?php if (@$tampildata['Type_Fu_Fee']=="1") { echo 'checked="checked"';} ?> > Fu Fee</label></td>
					</tr>
				</table>
			  </td>
			</tr>

			<tr>
              <td colspan="3"> 
			  <table name="Production-Detail" id="Production-Detail"  width="100%" border="1" class="table table-striped table-bordered table-hover" >
				</table>
			  </td>
            </tr>
			<tr>
              <td>Workflow Remark *</td>
              <td colspan="2"><div class="form-group"> <textarea cols="4" id="inputWorkflowRemark"  name="inputWorkflowRemark"  
			  class="form-control py-4" placeholder="Workflow Remark" maxlength="100"
				<?php echo $disabled; ?>><?php echo @$tampildataReq['Remark_WorkFlow']; ?></textarea></div>			  </td>
            </tr>
			<tr>
              <td colspan="3"> </td>
            </tr>
	
          </table>
		  <button type="submit" name="Send" value="Send" onClick="return checkSendApproval(faw)" 
		  class="btn btn-primary" 
		  <?php if (@$tampildata['Status_add_resource']!="Complete" || (@$tampildata['Status_add_resource']=="Complete"  & $button=="arm-revise") )  
		  {echo $disabled;} else {echo "disabled='disabled'";} ?>>Sent To Approval</button>
		  
		  
		  <?php if (@$tampildata['Status_add_resource']=="Complete" & $button!="arm-revise")  {?>
		  <button type="submit" name="Save" value="Revise" onClick="return checkRevise()" 
		  class="btn btn-primary">Revise</button>
	      <?php ;} ?>
		  <?php if (@$tampildata['Status_add_resource']=="Complete" & $button!="arm-revise" || @$tampildata['Status_add_resource']=="Revise" & $button!="add-revise-faw")  {?>
		  <button type="submit" name="Save" value="Cancel" onClick="return checkCancel(faw)" 
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
		var rowArmdetail = document.getElementById('arm-detail').rows.length; 
	if (form.inputAutoRequestNo.value == ""){
    	alert("Request No Can not be empty *");
    	form.inputAutoRequestNo.focus();
    	return (false);  		}
	else if(form.inputProjectName.value==""){
		alert("Product Name Can not be empty!");
		form.inputProductName.focus();
    	return (false);  		}
	else if(rowArmdetail <="3"	) {
		alert('Additional Resource Master masih kosong');
			return (false);  		}
	else if (form.inputWorkflowRemark.value == ""){
    	alert("Work flow Remark Can not be empty *");
    	form.inputWorkflowRemark.focus();
    	return (false);  		}
		return confirm('Are you sure you want to Send Approval?');
	}
	
	</script>
		<script src="../vendor/jquery/jquery.min.js"></script>
	<!-- Bootstrap Core JavaScript -->
	<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
	<!-- Metis Menu Plugin JavaScript -->
	<script src="../vendor/metisMenu/metisMenu.min.js"></script>

 	<script language="JavaScript" type="text/javascript">

	function checkCancel(form){
		return confirm('Are you sure you want to Cancel Request this data?');
	}
	function checkAddDetail(form){
		return confirm('Are you sure you want to Save Data?');
	}
	function checkDeleteDetail(form){
		return confirm('Are you sure you want to Delete Data?');
	}
	</script>
 


 	</body>
</html>

<!-- Modal start here -->
<div class="modal fade" id="add" role="dialog">
	   <div class="modal-dialog modal-lg">
		   <div class="modal-content">
			   <div class="modal-header">
				   <button type="button" class="close" data-dismiss="modal">&times;</button>
				   <h4 class="modal-title"><b>Add addition/changes resource master <?php echo @$_GET['id']; ?></b></h4>
			   </div>
			   <div class="modal-body">
				   <div class="modal-data"></div>
				   <Label>Informasi :
					   Harap di isi yang ada tanda [ * ]
				   </Label>
			   </div>
			   
			   <div class="modal-footer">
				   <button type="button" class="btn btn-default" 
				   data-dismiss="modal" id="myClose" >Close</button>
			   </div>
		   </div>
	 </div>
	 
</div>

<!-- Modal start here -->
<div class="modal fade" id="show" role="dialog">
	   <div class="modal-dialog modal-lg">
		   <div class="modal-content">
			   <div class="modal-header">
				   <button type="button" class="close" data-dismiss="modal">&times;</button>
				   <h4 class="modal-title"><b>Edit addition/changes resource master <?php echo @$_GET['id']; ?></b></h4>
			   </div>
			   <div class="modal-body">
				   <div class="modal-data">Test</div>
				   <Label>Informasi :
					   Harap di isi yang ada tanda [*]
				   </Label>
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
	   $('#add').on('show.bs.modal', function (e) {
		   //var AutoRequestNo = $(e.relatedTarget).data('id');
		   //var getDetail ='';
		   	
			var getDetail ='';
		   var getDetail = $(e.relatedTarget).data('id');
		   var AutoRequestNo = $('#inputAutoRequestNo').val();
		   var f = '<?php echo @$divisioncode; ?>'
		   /* fungsi AJAX untuk melakukan fetch data */
		   $.ajax({
			   type :'post',
			   url: "Production-arm/arm-detail-form-edit.php",
			   /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
			   data: { getDetail: getDetail, AutoRequestNo: AutoRequestNo,data6: f},
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
	   $('#show').on('show.bs.modal', function (e) {
		   var getDetail ='';
		   var getDetail = $(e.relatedTarget).data('id');
		   var AutoRequestNo = $('#inputAutoRequestNo').val();
 			
		   /* fungsi AJAX untuk melakukan fetch data */
		   $.ajax({
			   type :'post',
			   url: "Production-arm/arm-detail-form.php",
			   
			   /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
			   data: { getDetail: getDetail, AutoRequestNo: AutoRequestNo},
			   /* memanggil fungsi getDetail dan mengirimkannya */
			   success : function(data){	
			   $('.modal-data').html(data);
			  			   /* menampilkan data dalam bentuk dokumen HTML */
			   }
		   });
		});
   });
 </script>



<script>
$(document).ready(function(){
  get_ProductionARMDetail();
});
 function get_ProductionARMDetail(){
  var a = $('#InputMPRCode').val();
  var b = $('#inputAutoRequestNo').val();

  $.ajax({
   type: 'POST',
   url: "Production-arm/arm-detail.php",
   
   data: { data1: a, data2: b},
   success: function(info) {
	$("#Production-Detail").html(info);  
	}
  });
  return false;
 }
</script>





 

