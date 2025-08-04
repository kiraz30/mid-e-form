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
      <h3 class="mt-4"> Next New Request Additional Resource Master Factory 2 </h3>
	    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="../dist/index.php?button=dashboard">Dashboard</a></li>
		<li class="breadcrumb-item"><a href="../dist/index.php?button=arm-f2">Additional Resource Master Factory 2</a></li>
		<li class="breadcrumb-item"><a href="../dist/index.php?button=arm-edit&id=<?php echo $_GET['id']; ?>">New Request Additional Resource Master</a></li>
        <li class="breadcrumb-item active">Next New Request Additional Resource Master Factory 2</li>
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
		a.MPR_Code,a.Project_Name,a.Subject,a.`Type`,a.Content,a.Remark,
		a.Remark,a.Status_add_resource,a.CreatedBy,date(a.CreatedDate) as Created_Date 
		from tb_packdev_add_resource_f2 a  LEFT JOIN tb_mpr b ON a.MPR_Code=b.Request_No
		WHERE a.Request_No = '".@$_GET['id']."' ";
		if ($button=="arm-f2-add") {$query.=" And a.Status_Last_Document='1'";}
		else {$query =$query; }
      	$exe =mysqli_query($con,$query);
        $tampildata=mysqli_fetch_array($exe);
		$rev=@$tampildata['Index_Document']+1;

	 	//________________________________________________________________________________Status ARM disabled

		if (@$tampildata['Status_add_resource']<>"Draft" & @$tampildata['Status_add_resource']<>"Revise" 
		& @$tampildata['Status_add_resource']<>""  )
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
			//Simpan Status Revise NPRF
			mysqli_query($con,"UPDATE tb_packdev_add_resource_f2 Set Status_add_resource='Revise' WHERE Request_No='$inputAutoRequestNo'");
			mysqli_query($con,"UPDATE From tb_workflownprf Set Status_Approval ='0'WHERE Request_No='$inputAutoRequestNo'");
			//_________________________________________________________________________________________
			$message = "Data successfully Revise";
			echo "<script type='text/javascript'>alert('$message');</script>";
			echo"<script>  window.location='../dist/index.php?button=revise-arm-f2&id=$inputAutoRequestNo'; </script>";
			 
		}
		elseif($Save=="Cancel"){ 
			include "faw-save-edit.php";
			mysqli_query($con,"UPDATE tb_packdev_add_resource_f2 SET Status_add_resource='Cancel' WHERE Request_No='$inputAutoRequestNo'");
			mysqli_query($con,"UPDATE tb_inbox SET Request_Status='Cancel' WHERE Request_No='$inputAutoRequestNo'");
			
			$message = "Data successfully Cancel Request";
			echo "<script type='text/javascript'>alert('$message');</script>";
			echo"<script>  window.location='../dist/index.php?button=arm-f2'; </script>";
			}
		elseif($Send=="Send"){ 
			mysqli_query($con,"UPDATE tb_packdev_add_resource_f2 SET Status_add_resource='Sent',
			UpdatedBy='$username',UpdatedDate='$createddate',UpdatedHostName='$ip : $hostname' 
			WHERE Request_No='$inputAutoRequestNo'");
			//DeleteWorkFlow ARM yang nilainya NULL
			mysqli_query($con,"DELETE From tb_workflownprf WHERE Request_No='$inputAutoRequestNo' And StatusWorkFlow Is Null");
 
			//Update WorkFlow ARM Status Approval berubah jadi 0
			mysqli_query($con,"UPDATE tb_workflowNPRF SET  Status_Approval='0' WHERE Request_No='$inputAutoRequestNo'  ");
			
			include "arm-save-workflow.php";			
			//Update WorkFlow ARM Sent Approval
			mysqli_query($con,"UPDATE tb_workflowNPRF SET StatusWorkFlow='S',ReadWorkFlow='1',Remark_WorkFlow='$inputWorkflowRemark',
			Approve='$username',ApproveDate='$createddate',Status_Approval='1' WHERE Request_No='$inputAutoRequestNo' And Index_No='1'
			And ReadWorkFlow='0'");
			
			//Send Email Notification for Approval 2-------------------------------------------------
			$exeNext = mysqli_query($con,"Select NameApproval,OnBehalf,WorkFlowMenu FROM tb_workflowNPRF 
			WHERE Request_No='$inputAutoRequestNo' And Index_No='2' And StatusWorkFlow is null limit 1");
        	$tampildataNext=mysqli_fetch_array($exeNext);
			$app1=@$tampildataNext['NameApproval'];
			$app2=@$tampildataNext['OnBehalf'];
			$remark=$inputWorkflowRemark;
			$id=$inputAutoRequestNo;
			$page="arm-f2-app";
			$WorkFlowMenu="ARM-F2";
			$Confirm=="Approve";
			require ("../config/emailapp.php");
			//Simpan Inbox
			$exeCariInbox = mysqli_query($con,"Select Request_No  FROM tb_inbox 
			WHERE Request_No='$inputAutoRequestNo' ");
			if (mysqli_num_rows($exeCariInbox) !=0 ) {
				mysqli_query($con,"UPDATE tb_inbox Set Thema_Name='".$tampildata['Project_Name']."',
				Request_Type='".$tampildata['Type']."',Request_Status='W',ReadInbox='0',UpdatedBy='$username',
				NameApproval='".$tampildataNext['NameApproval']."',OnBehalf='".$tampildataNext['OnBehalf']."',
				Remark='$inputWorkflowRemark',UpdatedDate='$createddate',UpdatedHostName='$ip : $hostname'  
				WHERE Request_No='$tempFormatNoRequest'");
			}else{
				mysqli_query($con,"Insert INTO tb_inbox (Request_No,Request_Date,Thema_Name,
				Request_Type,Request_Status,NameApproval,OnBehalf,ReadInbox,Remark,WorkFlowMenu) 
				values ('$inputAutoRequestNo','$createddate','".$tampildata['Project_Name']."',
				'".$tampildata['Type']."','W','".$tampildataNext['NameApproval']."',
				'".$tampildataNext['OnBehalf']."','0','".$tampildata['Remark']."','ARM-F2')");
			}

			//_________________________________________________________________________________________
			$message = "Data successfully Sent  to Approval";
			echo "<script type='text/javascript'>alert('$message');</script>";
			echo"<script>  window.location='../dist/index.php?button=arm-f2'; </script>"; 
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
			  value="<?php if ($button=="arm-f2-add") {echo $NomorReq;} elseif ($button=="arm-f2-add") 
			  {echo substr($tampildata['Request_No'],0,17)."-R".$rev;} else {echo @$tampildata['Request_No'];} ?>" />
              </span> </td>
            </tr>
            <tr>
              <td width="20%"><span class="form-group">Last Request No *</span></td>
              <td colspan="2"><span class="form-group">
                <input class="form-control py-4"  name="inputLastRequestNo" id="inputLastRequestNo"  maxlength="50" type="text"  
			  placeholder="Auto Request No"  readonly="readonly" 
			  value="<?php if (@$tampildata['Status_add_resource']=="Complete" & $button=="arm-f2-revise") 
			  {echo @$tampildata['Request_No'];} else {echo @$tampildata['Last_Request_No'];}?>" />
              </span> </td>
            </tr>
 
            <tr>
              <td><span class="form-group">Master Product Request No *</span></td>
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
              <td width="20%"><span class="form-group">Project Name</span></td>
              <td colspan="2"><span class="form-group">
                <input class="form-control py-4"  name="inputProjectName" id="inputProjectName" 
				maxlength="150" type="text" placeholder="Input Project Name"  readonly="readonly" 
			  	value="<?php if ($_POST) { echo $inputProjectName; } else {echo @$tampildata['Project_Name'];} ?>" />
              </span> </td>
            </tr>
			<tr>
              <td colspan="3"> 
			  <table name="Packaging-Detail" id="Packaging-Detail"  width="100%" border="1" class="table table-striped table-bordered table-hover" >
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
		  <?php if (@$tampildata['Status_add_resource']!="Complete" || (@$tampildata['Status_add_resource']=="Complete"  & $button=="arm-f2-revise") )  
		  {echo $disabled;} else {echo "disabled='disabled'";} ?>>Sent To Approval</button>
		  
		  
		  <?php if (@$tampildata['Status_add_resource']=="Complete" & $button!="arm-f2-revise")  {?>
		  <button type="submit" name="Save" value="Revise" onClick="return checkRevise()" 
		  class="btn btn-primary">Revise</button>
	      <?php ;} ?>
		  <?php if (@$tampildata['Status_add_resource']=="Complete" & $button!="arm-f2-revise" || @$tampildata['Status_add_resource']=="Revise" & $button!="add-revise-arm-f2")  {?>
		  <button type="submit" name="Save" value="Cancel" onClick="return checkCancel(faw)" 
		  class="btn btn-primary">Cancel Request</button>
	      <?php ;} ?>

		  <a class="btn btn-primary" href="../dist/index.php?button=arm-f2" title="Back Format No Request">Back</a> 
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
			   url: "packaging-arm-f2/arm-detail-form-edit.php",
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
			   url: "packaging-arm-f2/arm-detail-form.php",
			   
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
 $('#InputMPRCode').click(function(){
  get_PackagingARMDetail();
 });
});
 function get_PackagingARMDetail(){
  var a = $('#InputMPRCode').val();
  var b = $('#inputAutoRequestNo').val();

  $.ajax({
   type: 'POST',
   url: "packaging-arm-f2/arm-detail.php",
   
   data: { data1: a, data2: b},
   success: function(info) {
	$("#Packaging-Detail").html(info);  
	}
  });
  return false;
 }
</script>





 

