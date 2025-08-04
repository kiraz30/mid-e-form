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
      <h3 class="mt-4"><?php if ($button=="ps-add" || $button=="ps-revise") 
		{echo "New Request Packaging Spesification";} else  {echo "Edit Request Packaging Spesification";} ?> </h3>
	    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="../dist/index.php?button=dashboard">Dashboard</a></li>
		<li class="breadcrumb-item"><a href="../dist/index.php?button=ps">Packaging Spesification</a></li>
		<li class="breadcrumb-item"><a href="../dist/index.php?button=ps-edit&id=<?php echo $_GET['id']; ?>">New Request Packaging Spesification</a></li>
        <li class="breadcrumb-item active"><?php if ($button=="ps-add" || $button=="add-revise-ps") 
		{echo "New Request Packaging Spesification";} else  {echo "Edit Request Packaging Spesification";} ?> </li>
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
			
		$query="SELECT a.Request_No,a.Index_Document,a.Last_Request_No,a.Status_Last_Document,
		a.ARM_Code,a.MPR_Code,b.Project_Name,a.Finish_Good_Code,a.Finish_Good_Name,
		a.Netto,a.Isi,a.DZ_CT,a.Market,a.Barcode,a.CreatedBy,DATE(a.CreatedDate) as CreatedDate,
		a.Status_Spec,a.Remark FROM  tb_packdev_spec a 
		LEFT JOIN tb_packdev_add_resource b ON a.ARM_Code=b.Request_No
		WHERE a.Request_No = '".@$_GET['id']."' ";
      	$exe =mysqli_query($con,$query);
        $tampildata=mysqli_fetch_array($exe);
		$rev=@$tampildata['Index_Document']+1;

	 	//________________________________________________________________________________Status ARM disabled

		if (@$tampildata['Status_Spec']<>"Draft" & @$tampildata['Status_Spec']<>"Revise" 
		& @$tampildata['Status_Spec']<>""  )
		  {$disabled="disabled";} else{$disabled="";}

		//________________________________________________________________________________WORKFLOWARM
		$exeReq = mysqli_query($con,"Select NameApproval,OnBehalf,Remark_WorkFlow FROM tb_workflowNPRF 
		WHERE Request_No = '".@$_GET['id']."' And Index_No='1' limit 1");
		$tampildataReq=mysqli_fetch_array($exeReq);
		//________________________________________________________________________________
		//________________________________________________________________________________WORKFLOWREVISE
		$exeRevise = mysqli_query($con,"SELECT Step_Revise,Index_No,Revise FROM tb_workflownprf  WHERE Request_No = '".@$_GET['id']."'
		and Revise = '$username' and StatusWorkFlow IS NOT null GROUP BY Step_Revise,Revise LIMIT 1");
		$tampildataRevise=mysqli_fetch_array($exeRevise);
		$NextRevise=@$tampildataRevise['Index_No']+1;
        
	  	?>
	<form name="ps" id="ps" action="" method="post"  enctype="multipart/form-data"  >
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
		$InputARMCode 			= @$_POST['InputARMCode'];
		$inputProjectName		= @$_POST['inputProjectName'];
		$inputRemark			= @$_POST['inputRemark'];
		$inputWorkflowRemark	= @$_POST['inputWorkflowRemark'];
		
		if ($Save=="Revise"){
			//Simpan Status Revise NPRF
			mysqli_query($con,"UPDATE tb_packdev_spec Set Status_Spec='Revise' WHERE Request_No='$inputAutoRequestNo'");
			mysqli_query($con,"UPDATE From tb_workflownprf Set Status_Approval ='0'WHERE Request_No='$inputAutoRequestNo'");
			//_________________________________________________________________________________________
			$message = "Data successfully Revise";
			echo "<script type='text/javascript'>alert('$message');</script>";
			echo"<script>  window.location='../dist/index.php?button=ps&id=$inputAutoRequestNo'; </script>";
			 
		}
		elseif($Save=="Cancel"){ 
			include "faw-save-edit.php";
			mysqli_query($con,"UPDATE tb_packdev_spec SET Status_Spec='Cancel' WHERE Request_No='$inputAutoRequestNo'");
			mysqli_query($con,"UPDATE tb_inbox SET Request_Status='Cancel' WHERE Request_No='$inputAutoRequestNo'");
			
			$message = "Data successfully Cancel Request";
			echo "<script type='text/javascript'>alert('$message');</script>";
			echo"<script>  window.location='../dist/index.php?button=ps'; </script>";
			}
		elseif($Send=="Send"){ 
			mysqli_query($con,"UPDATE tb_packdev_spec SET Remark='$inputRemark', Status_Spec='Sent',
			UpdatedBy='$username',UpdatedDate='$createddate',UpdatedHostName='$ip : $hostname' 
			WHERE Request_No='$inputAutoRequestNo'");
			//DeleteWorkFlow ARM yang nilainya NULL
			mysqli_query($con,"DELETE From tb_workflownprf WHERE Request_No='$inputAutoRequestNo' And StatusWorkFlow Is Null");
			mysqli_query($con,"UPDATE tb_workflownprf Set Status_Approval ='0' WHERE Request_No='$inputAutoRequestNo'");
			include "ps-save-workflow.php";			
			//Update WorkFlow ARM Sent Approval
			mysqli_query($con,"UPDATE tb_workflowNPRF SET StatusWorkFlow='S',ReadWorkFlow='1',Remark_WorkFlow='$inputWorkflowRemark',
			Approve='$username',ApproveDate='$createddate',Status_Approval='1' WHERE Request_No='$inputAutoRequestNo' And Index_No='1' 
			And ReadWorkFlow='0'");
			
			//Send Email Notification for Approval 2-------------------------------------------------
			$exeNext = mysqli_query($con,"Select NameApproval,OnBehalf,WorkFlowMenu FROM tb_workflowNPRF 
			WHERE Request_No='$inputAutoRequestNo' And Index_No='2' ");
        	$tampildataNext=mysqli_fetch_array($exeNext);
			$app1=@$tampildataNext['NameApproval'];
			$app2=@$tampildataNext['OnBehalf'];
			$remark=$inputWorkflowRemark;
			$id=$inputAutoRequestNo;
			$page="ps-app";
			$WorkFlowMenu="PS";
			$Confirm=="Approve";
			require ("../config/emailapp.php");
			//Simpan Inbox
			$exeCariInbox = mysqli_query($con,"Select Request_No  FROM tb_inbox 
			WHERE Request_No='$inputAutoRequestNo' ");
			if (mysqli_num_rows($exeCariInbox) !=0 ) {
				mysqli_query($con,"UPDATE tb_inbox Set 
				Thema_Name='".$tampildata['Project_Name']." ".$tampildata['Finish_Good_Code']." ".$tampildata['Finish_Good_Name']."',
				Request_Type='',Request_Status='W',ReadInbox='0',UpdatedBy='$username',
				NameApproval='".$tampildataNext['NameApproval']."',OnBehalf='".$tampildataNext['OnBehalf']."',
				Remark='$inputWorkflowRemark',UpdatedDate='$createddate',UpdatedHostName='$ip : $hostname'  
				WHERE Request_No='$tempFormatNoRequest'");
			}else{
				mysqli_query($con,"Insert INTO tb_inbox (Request_No,Request_Date,Thema_Name,
				Request_Type,Request_Status,NameApproval,OnBehalf,ReadInbox,Remark,WorkFlowMenu) 
				values ('$inputAutoRequestNo','$createddate',
				'".$tampildata['Project_Name'] ." ".$tampildata['Finish_Good_Code']." ".$tampildata['Finish_Good_Name']."',
				'','W','".@$tampildataNext['NameApproval']."',
				'".@$tampildataNext['OnBehalf']."','0','".@$tampildata['Remark']."','PS')");
			}

			//_________________________________________________________________________________________
			$message = "Data successfully Sent  to Approval";
			echo "<script type='text/javascript'>alert('$message');</script>";
			echo"<script>  window.location='../dist/index.php?button=ps'; </script>"; 
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
			  value="<?php  echo @$tampildata['Request_No']; ?>" />
              </span> </td>
            </tr>
            <tr>
              <td width="20%"><span class="form-group">Last Request No </span></td>
              <td colspan="2"><span class="form-group">
                <input class="form-control py-4"  name="inputLastRequestNo" id="inputLastRequestNo"  maxlength="50" type="text"  
			  placeholder="Auto Request No"  readonly="readonly" 
			  value="<?php if (@$tampildata['Status_Spec']=="Complete" & $button=="ps-revise") 
			  {echo @$tampildata['Request_No'];} else {echo @$tampildata['Last_Request_No'];}?>" />
              </span> </td>
            </tr>
			<tr>
              <td><span class="form-group">Add Resource Master Request No </span></td>
              <td width="30%"><div class="form-group d-flex align-items-center justify-content-between mt-0 mb-1">
			  <input name="tempFinish_Good_Code" id="tempFinish_Good_Code" type="hidden" 
			  value="<?php echo $tampildata['Finish_Good_Code']; ?>"> 	
			  <input type="text" class="form-control"  name="InputARMCode" id="InputARMCode" 
				placeholder="Add Resource Master Request No"  
				value="<?php if ($_POST) { echo $InputARMCode; } else {echo @$tampildata['ARM_Code'];} ?>" 
				onChange="setFocus(),get_PackagingPSDetail()" onFocus="setFocus(),get_PackagingPSDetail()" readonly="readonly">
				 
			  </td>
	 
            </tr>
            <tr>
              <td><span class="form-group">Master Product Request No </span></td>
              <td width="30%"><div class="form-group d-flex align-items-center justify-content-between mt-0 mb-1">
			  	<input type="text" class="form-control"  name="InputMPRCode" id="InputMPRCode" 
				placeholder="Master Product Request No"  
				value="<?php if ($_POST) { echo $InputMPRCode; } else {echo @$tampildata['MPR_Code'];} ?>" 
				onChange="setFocus(),get_PackagingARMDetail()" 
				onFocus="setFocus(),get_PackagingARMDetail()" readonly="readonly">
				
				</div>
			  </td>
			  </td>
			  <td width="30%">
			  </td>
            </tr>
			<tr>
              <td width="20%"><span class="form-group">Project Name </span></td>
              <td colspan="2"><span class="form-group">
                <input class="form-control py-4"  name="inputProjectName" id="inputProjectName" 
				maxlength="150" type="text" placeholder="Input Project Name"  readonly="readonly" 
			  	value="<?php if ($_POST) { echo $inputProjectName; } else {echo @$tampildata['Project_Name'];} ?>" />
              </span> </td>
            </tr>
			<tr>
              <td colspan="3"> 
			  <table name="Packaging-spec" id="Packaging-spec"  width="100%" border="1" class="table table-striped table-bordered table-hover" >
				</table>
			  </td>
            </tr>
			<tr>
              <td>Remark </td>
              <td colspan="2"><div class="form-group"> <textarea cols="4" id="inputRemark" name="inputRemark"  
			  class="form-control py-4" placeholder="Enter Remark" <?php echo $disabled; ?> 
			  maxlength="20000"><?php if ($_POST) { echo $inputRemark; } else {echo @$tampildata['Remark'];} ?></textarea></div>
			  </td>
            </tr>
 			<tr>
              <td>Workflow Remark *</td>
              <td colspan="2"><div class="form-group"> <textarea cols="4" id="inputWorkflowRemark"  name="inputWorkflowRemark"  
			  class="form-control py-4" placeholder="Workflow Remark" 
				<?php echo $disabled; ?>><?php echo @$tampildataReq['Remark_WorkFlow']; ?></textarea></div>			  </td>
            </tr>
			<tr>
              <td colspan="3"> </td>
            </tr>
	
          </table>
		  <button type="submit" name="Send" value="Send" onClick="return checkSendApproval(ps)" 
		  class="btn btn-primary" 
		  <?php if (@$tampildata['Status_Spec']!="Complete" || (@$tampildata['Status_Spec']=="Complete"  & $button=="ps-revise") )  
		  {echo $disabled;} else {echo "disabled='disabled'";} ?>>Sent To Approval</button>
		  
		  
		  <?php if (@$tampildata['Status_Spec']=="Complete" & $button!="ps-revise")  {?>
		  <button type="submit" name="Save" value="Revise" onClick="return checkRevise()" 
		  class="btn btn-primary">Revise</button>
	      <?php ;} ?>
		  <?php if (@$tampildata['Status_Spec']=="Complete" & $button!="ps-revise" || @$tampildata['Status_Spec']=="Revise" & $button!="add-revise-faw")  {?>
		  <button type="submit" name="Save" value="Cancel" onClick="return checkCancel(ps)" 
		  class="btn btn-primary">Cancel Request</button>
	      <?php ;} ?>

		  <a class="btn btn-primary" href="../dist/index.php?button=ps" title="Back Format No Request">Back</a> 
		</form>
		</div>
      </div>
	 </div>
    </main> 
 

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
				<button type="button" style="padding:2px 4px 2px 2px"  
					class="btn btn-outline btn-default" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"><b>Packaging Spesification <?php echo @$_GET['id']; ?></b></h4>
			</div>
			<div class="modal-body">
				<div class="modal-data"></div>
				   <Label>Informasi :
					   Harap di isi yang ada tanda [*]
				   </Label>
			</div>
			   
			<div class="modal-footer">
				<button type="button" class="btn btn-default" 
				data-dismiss="modal" id="myClose" >Close</button>
			</div>
		</div>
	</div>
</div>

 

<!-- Ini merupakan script yang terpenting -->

<script language="JavaScript" type="text/javascript">

function checkSendApproval(form){
	var rowPSdetail = document.getElementById('ps-detail').rows.length; 
if (form.inputAutoRequestNo.value == ""){
	alert("Request No Can not be empty *");
	form.inputAutoRequestNo.focus();
	return (false);  		}
/*else if(form.inputProjectName.value==""){
	alert("Product Name Can not be empty!");
	form.inputProjectName.focus();
	return (false);  		}*/
else if(rowPSdetail <="3"	) {
	alert('Additional Resource Master masih kosong');
	return (false);  		}
else if (form.inputWorkflowRemark.value == ""){
	alert("Work flow Remark Can not be empty *");
	form.inputWorkflowRemark.focus();
	return (false);  		}
	return confirm('Are you sure you want to Send Approval ?');
}
 
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

<script>
$(document).ready(function(){
	$('#add').on('show.bs.modal', function (e) {
		//var AutoRequestNo = $(e.relatedTarget).data('id');
		//var getDetail ='';
		   	
		var getDetail ='';
		var getDetail = $(e.relatedTarget).data('id');
		var AutoRequestNo = $('#inputAutoRequestNo').val();
		var ARMRequestNo = $('#InputARMCode').val();
  		var MPRRequestNo = $('#InputMPRCode').val();
		var tempFinish_Good_Code= $('#tempFinish_Good_Code').val(); 
		var f = '<?php echo @$divisioncode; ?>'
		/* fungsi AJAX untuk melakukan fetch data */
		$.ajax({
			type :'post',
			url: "packaging-ps/ps-detail-form-edit.php",
		 	data: { getDetail: getDetail, AutoRequestNo: AutoRequestNo,data6: f,ARMRequestNo: ARMRequestNo,MPRRequestNo: MPRRequestNo,tempFinish_Good_Code: tempFinish_Good_Code},
				success : function(data){	
				$('.modal-data').html(data);
				/* menampilkan data dalam bentuk dokumen HTML */
			}
		   });
		});
	$('#InputARMCode').click(function(){
	get_PackagingPSDetail();
	});
});

 function get_PackagingPSDetail(){
  var d = $('#tempFinish_Good_Code').val();
  var a = $('#InputARMCode').val();
  var b = $('#InputMPRCode').val();
  var c = $('#inputAutoRequestNo').val();

  $.ajax({
   type: 'POST',
   url: "packaging-ps/ps-detail.php",
   
   data: { data1: a, data2: b, data3: c, data4: d},
   success: function(info) {
	$("#Packaging-spec").html(info);  
	}
  });
  return false;
 }
</script>




 

