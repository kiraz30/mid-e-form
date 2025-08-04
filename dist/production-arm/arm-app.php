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
      <h3 class="mt-4">Request Additional Resource Master Detail</h3>
	    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="../dist/index.php?button=dashboard">Dashboard</a></li>
		<li class="breadcrumb-item"><a href="../dist/index.php?button=inbox">Inbox</a></li>
		<li class="breadcrumb-item active">Request Additional Resource Master</li>
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
		a.MPR_Code,a.Project_Name,a.Subject,a.Type_Finish_Goods,a.Type_Materials,a.Type_WorkProcess,
		a.Type_Fu_Fee,a.Type_Vendor,a.Type_Customer,a.Segment_Price,a.Segment_Data_Informasi,
		a.Segment_Ukuran,a.Segment_Others,a.Segment_Over_Receipt,a.Content,a.Remark,
		a.Remark,a.LAST_TRACK,a.CreatedBy,date(a.CreatedDate) as Created_Date 
		from tb_prod_add_resource a  WHERE a.Request_No = '".@$_GET['id']."' ";
		if ($button=="prod-arm-add") {$query.=" And a.Status_Last_Document='1'";}
		else {$query =$query; }
      	$exe =mysqli_query($con,$query);
        $tampildata=mysqli_fetch_array($exe);
		//_________________________________________________________________________________
	  	?>
	<form name="faw" id="faw" action="" method="post"  enctype="multipart/form-data"  >
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
		$inputRemarkApp			= @$_POST['inputRemarkApp'];
		
		if($Send=="Send"){ 
			if ($Confirm=="Approve"){
				//Cari Tracking------------------------------------------------
				$exeNext = mysqli_query($con,"SELECT d.NEXT_CODE
				FROM  tb_user a INNER JOIN param_tracking_access b ON a.KDPosition=b.ROLE_APPLICATION_CODE
				INNER JOIN tb_prod_add_resource c ON b.TRACKING_CODE=c.LAST_TRACK
				INNER JOIN param_next_tracking d ON c.LAST_TRACK=d.CODE
				WHERE c.Request_No='".@$tampildata['Request_No']."' And a.KDDivision='$divisioncode' 
				AND d.NEXT_CODE NOT IN('3')");		
				$tampildataNext=mysqli_fetch_array($exeNext);

				//Update Trackings------------------------------------------------
				mysqli_query($con,"UPDATE tb_prod_add_resource SET LAST_TRACK='".@$tampildataNext['NEXT_CODE']."' WHERE Request_No='".@$tampildata['Request_No']."'");
				SaveTracking(@$tampildata['Request_No'],@$tampildataNext['NEXT_CODE'],$inputRemarkApp,$username,$createddate,$hostname);

				//Send Email Notification for Approval------------------------------------------------
				$exeNextEmail = mysqli_query($con,"SELECT a.KDDivision,a.KDPosition
				FROM  tb_user a INNER JOIN param_tracking_access b ON a.KDPosition=b.ROLE_APPLICATION_CODE
				WHERE  b.TRACKING_CODE='".@$tampildataNext['NEXT_CODE']."'");
				$tampildataNextEmail=mysqli_fetch_array($exeNextEmail);
				$appdivisi=@$tampildataNextEmail['KDDivision'];
				$appposisi=@$tampildataNextEmail['KDPosition'];
				$remark=$inputRemarkApp;
				$id=@$tampildata['Request_No'];
				$id=@$tampildata['Request_No'];
				$page="prod-arm-app";
				$WorkFlowMenu="ARM-F1";
				$Confirm="Approve";
				if (mysqli_num_rows($exeNextEmail) !=0 ) { 
					require ("../config/emailnewapp.php");
					$Status_Last_Document="0";
				}else {
					$Status_Last_Document="1";
					require ("../config/emailnewcomplite.php");
				}
				mysqli_query($con,"UPDATE tb_prod_add_resource Set  Status_Last_Document='$Status_Last_Document' 
				WHERE Request_No='".@$tampildata['Request_No']."'");
				
				//---------------------------------------------------------------------------------------
				$message = "Data successfully Sent to Approval";
				echo "<script type='text/javascript'>alert('$message');</script>";
				echo"<script>  window.location='../dist/index.php?button=inbox'; </script>";
				
			}else if ($Confirm=="Revise"){
				UpdateStatusTracking($inputAutoRequestNo,'0');
				mysqli_query($con,"UPDATE tb_prod_add_resource SET LAST_TRACK='3' WHERE Request_No='".@$tampildata['Request_No']."'");
				SaveTracking(@$tampildata['Request_No'],'3',$inputRemarkApp,$username,$createddate,$hostname);

				//Send Email Notification for Approval------------------------------------------------
				$exeNextEmail = mysqli_query($con,"SELECT a.KDDivision,a.KDPosition
				FROM  tb_user a INNER JOIN param_tracking_access b ON a.KDPosition=b.ROLE_APPLICATION_CODE
				WHERE  b.TRACKING_CODE='3'");
				$tampildataNextEmail=mysqli_fetch_array($exeNextEmail);
				$appdivisi=@$tampildataNextEmail['KDDivision'];
				$appposisi=@$tampildataNextEmail['KDPosition'];
				$remark=$inputRemarkApp;
				$id=@$tampildata['Request_No'];
				$page="revise-prod-arm-app";
				$WorkFlowMenu="ARM-F1";
				$Confirm="Revise";

				if (mysqli_num_rows($exeNextEmail) !=0 ) { 
					require ("../config/emailnewapp.php");
					$Status_Last_Document="0";
				}
					  
				$message = "Data successfully Sent  to Revise Request";
				echo "<script type='text/javascript'>alert('$message');</script>";
				echo"<script>  window.location='../dist/index.php?button=inbox'; </script>";
			}
		}	
	}
			//End CRUD----------------------------------------------------------------------
	$exe =mysqli_query($con,"
	SELECT a.ID_No,a.Request_No,a.CreatedDate Request_Date, a.Project_Name Thema_Name, 
	a.Subject Request_Type,a.LAST_TRACK Request_Status,a.Remark,
	e.PositionName NameApproval,e.PositionName OnBehalf,  a.ReadInbox, 'prod-arm' WorkFlowMenu  FROM tb_prod_add_resource a
	INNER JOIN param_tracking b ON a.LAST_TRACK=b.CODE AND b.KODE_JENIS_PROSES=1
	INNER JOIN tb_user c ON a.CreatedBy=c.UserDomain 
	INNER JOIN param_tracking_access d ON a.LAST_TRACK=d.TRACKING_CODE
	INNER JOIN tb_position e ON d.ROLE_APPLICATION_CODE= e.KDPosition
	WHERE e.KDPosition='$position'");
	if (mysqli_num_rows($exe) ==0 ) { 
		echo"<h3>Tidak ada request yang harus di approve</h3><br><br>";
		echo'<a class="btn btn-primary" href="../dist/index.php?button=inbox" title="Back Inbox">Back</a>';}
	else {
	?>
          <table width="100%" border="0" class="table table-striped" id="dataTables-example" >
            <tr>
              <td width="20%"><span class="form-group">Request No *</span></td>
              <td colspan="2"><span class="form-group">
				<input name="tempFormatNoRequest" type="hidden" value="<?php echo $tampildata['Request_No']; ?>">
                <input class="form-control py-4"  name="inputAutoRequestNo" id="inputAutoRequestNo"  
				maxlength="50" type="text" placeholder="Auto Request No" readonly="readonly" 
			  value="<?php if ($button=="prod-arm-add") {echo $NomorReq;} elseif ($button=="prod-arm-add") 
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
              <td><span class="form-group">Master Product Request No *</span></td>
              <td width="30%"><div class="form-group d-flex align-items-center justify-content-between mt-0 mb-1">
			  	<input type="text" class="form-control"  name="InputMPRCode" id="InputMPRCode" 
				placeholder="Master Product Request No"  
				value="<?php if ($_POST) { echo $InputMPRCode; } else {echo @$tampildata['MPR_Code'];} ?>" readonly="readonly">
				
				</div>
			  </td>
			  </td>
			  <td width="30%">
			  </td>
            </tr>
			<tr>
              <td>Document Lampiran</td>
              <td colspan="2">
			  <table name="DocLampiran" id="DocLampiran"  width="100%" border="0">
 
				  <?php
					$exe = mysqli_query($con,"SELECT No_ID,DocLampiran,FileLampiran,Index_No 
					FROM tb_prod_add_resource_doc_lampiran Where Request_No = '".@$tampildata['Request_No']."'   ");
					$no = 1;
					while(@$rowDocLampiran =mysqli_fetch_array($exe)){
					?>
					<tr>
					<td> 
						<input class="form-control py-4"  name="InputDocLampiran[]" id="InputDocLampiran[]" 
						maxlength="150" type="text" placeholder="Input Document Lampiran"  readonly="readonly" 
						value="<?php echo @$rowDocLampiran['DocLampiran']; ?>" />
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
			  <select class="form-control" id="InputSubject" name="InputSubject" disabled="disabled">
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
							<label><input type="checkbox" name="ChkType1" id="ChkType1" value="<?php echo @$tampildata['Type_Finish_Goods']?>" onclick="return false;"
							<?php if (@$tampildata['Type_Finish_Goods']=="1") { echo 'checked="checked"';} ?>> Finish Goods</label></td>
						<td style="text-align:left; width:120px; height:20px;">
							<label><input type="checkbox" name="ChkType2" id="ChkType2" value="<?php echo @$tampildata['Type_Materials']?>" onclick="return false;"
							<?php if (@$tampildata['Type_Materials']=="1") { echo 'checked="checked"';} ?> > Materials</label></td>
						<td style="text-align:left; width:120px; height:20px;">
							<label><input type="checkbox" name="ChkType3" id="ChkType3" value="<?php echo @$tampildata['Type_WorkProcess']?>" onclick="return false;"
							<?php if (@$tampildata['Type_WorkProcess']=="1") { echo 'checked="checked"';} ?>  > WorkProcess</label></td>
						<td style="text-align:left; width:120px; height:20px;">
							<label><input type="checkbox" name="ChkType4" id="ChkType4" value="<?php echo @$tampildata['Type_Fu_Fee']?>" onclick="return false;"
							<?php if (@$tampildata['Type_Fu_Fee']=="1") { echo 'checked="checked"';} ?> > Fu Fee</label></td>
						<td style="text-align:left; width:150px; height:20px;">
							<label><input type="checkbox" name="ChkType5" id="ChkType5" value="<?php echo @$tampildata['Type_Vendor']?>" onclick="return false;"
							value="<?php echo @$tampildata['Type_Vendor']; ?>"
							<?php if (@$tampildata['Type_Vendor']=="1") { echo 'checked="checked"';} ?> > Vendor</label></td>
						<td style="text-align:left; width:150px; height:20px;">
							<label><input type="checkbox" name="ChkType6" id="ChkType6" value="<?php echo @$tampildata['Type_Customer']?>" onclick="return false;"
							<?php echo @$tampildata['Type_Customer']; ?>
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
							<label><input type="checkbox" name="ChkSegment1" id="ChkSegment1"  
							<?php if (@$tampildata['Segment_Price']=="1") { echo 'checked="checked"';} ?> 
							onclick="return false;"> Price</label></td>
						<td style="text-align:left; width:120px; height:20px;">
							<label><input type="checkbox" name="ChkSegment2" id="ChkSegment2"  
							<?php if (@$tampildata['Segment_Data_Informasi']=="1") { echo 'checked="checked"';} ?> 
							onclick="return false;"> Data Informasi</label></td>
						<td style="text-align:left; width:120px; height:20px;">
							<label><input type="checkbox" name="ChkSegment3" id="ChkSegment3"  
							<?php if (@$tampildata['Segment_Ukuran']=="1") { echo 'checked="checked"';} ?> 
							onclick="return false;"> Ukuran</label></td>
						<td style="text-align:left; width:120px; height:20px;">
							<label><input type="checkbox" name="ChkSegment4" id="ChkSegment4"  
							<?php if (@$tampildata['Segment_Others']=="1") { echo 'checked="checked"';} ?> 
							onclick="return false;"> Others</label></td>
						<td style="text-align:left; width:150px; height:20px;">
							<label><input type="checkbox" name="ChkSegment5" id="ChkSegment5"  
							<?php if (@$tampildata['Segment_Over_Receipt']=="1") { echo 'checked="checked"';} ?> 
							onclick="return false;"> 10% Over Receipt</label></td>
					</tr>
				</table>
			  </td>
            </tr>
			<tr>
              <td>Content *</td>
              <td colspan="2"><div class="form-group"> <textarea cols="4" id="InputContent" name="InputContent"  
			  class="form-control py-4" placeholder="Enter Content" disabled="disabled" 
			  maxlength="100"><?php if ($_POST) { echo @$InputContent; } else {echo @$tampildata['Content'];} ?></textarea></div>
			  </td>
            </tr>
			<tr>
			<td colspan="3"><div id="myTable"> </div></td> 
			<tr>
              <td>Confirm *</td>
              <td width="50%"><div class="form-group"> <input type="radio" id="Confirm" name="Confirm" value="Approve"> Approve </div></td>
			  <td width="20%"><div class="form-group"><input type="radio" id="Confirm" name="Confirm" value="Revise"> Revise</div></td>
            </tr>
            <tr>
              <td>Remark Approval *</td>
              <td colspan="2"><div class="form-group"><textarea cols="4" id="inputRemarkApp"  name="inputRemarkApp"  class="form-control py-4" 
				placeholder="Enter Remark" ><?php if ($_POST) { echo $inputRemarkApp; }  ?></textarea></div></td>
            </tr>
			<tr>
              <td colspan="3"> </td>
            </tr>
	
          </table>
		  <button type="submit" name="Send" value="Send" onClick="return checkSendApproval(faw)" 
		  class="btn btn-primary" <?php if (@$tampildataWFR['StatusWorkFlow']=="C" || @$tampildataWFR['StatusWorkFlow']=="R") {echo'disabled="disabled"';} ?>>Send</button>
		  <a class="btn btn-primary" href="../dist/index.php?button=inbox" title="Back Format No Request">Back</a> 
		</form>
		</div>
      </div>
	 </div>
    </main> 
 
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

/*	function checkSendApprovalPurchase(form){
		<?php 
		$Tanya = mysqli_query($con,"SELECT Request_No FROM tb_prod_add_resource_detail
		WHERE Request_No = '".@$tampildata['Request_No']."' And (Vendor_Code='-' or Vendor_Code='') ");
		if (mysqli_num_rows($Tanya) !=0 ) {  ?>
			alert("Vendor Code No Can not be empty *");
			return (false);	
		<?php } else{ ?>
		if (form.Confirm.value == ""){
			alert("Confirm No Can not be empty *");
			return (false);  		}
		else if (form.inputRemarkApp.value == ""){
			alert("Remark No Can not be empty *");
			form.inputRemarkApp.focus();
			return (false);  		}<?php } ?>
		return confirm('Are you sure you want to Send Approval?');
		
	}*/
	
 $(document).ready(function(){
 $('#Send1').click(function(){
  get_productionARMDetail();
 });
});
 function get_productionARMDetail(){
  var b = $('#inputAutoRequestNo').val();

  $.ajax({
   type: 'POST',
   url: "production-arm/arm-detail.php",
   
   data: {data2: b},
   success: function(info) {
	$("#production-Detail").html(info);  
	}
  });
  return false;
 }
</script>

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
<?php ;}?>

<!-- Modal start here -->
<div class="modal fade" id="addVC" role="dialog">
   	<div class="modal-dialog modal-lg">
	   	<div class="modal-content">
		   	<div class="modal-header">
			   <button type="button" class="close" data-dismiss="modal">&times;</button>
			   <h4 class="modal-title"> <b>Approve addition/changes resource master <?php echo @$_GET['id']; ?></b></h4>
			</div>
			<div class="modal-body">
				<div class="modal-data-vc"></div>
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
<div class="modal fade" id="addWorkProcess" role="dialog">
   	<div class="modal-dialog modal-lg">
	   	<div class="modal-content">
		   	<div class="modal-header">
			   <button type="button" class="close" data-dismiss="modal">&times;</button>
			   <h4 class="modal-title"> <b>Approve addition/changes resource master <?php echo @$_GET['id']; ?></b></h4>
			</div>
			<div class="modal-body">
				<div class="modal-data-wp"></div>
				<Label>Informasi :
					Harap di isi yang ada tanda [*]
				</Label>
			</div>
			<div class="modal-footer">
			   <button type="button" class="btn btn-default" 
			   data-dismiss="modal" id="myCloseWP" >Close</button>
		   </div>
	   	</div>
 	</div>
</div>

<!-- Modal start here -->
<div class="modal fade" id="add" role="dialog">
   	<div class="modal-dialog modal-lg">
	   	<div class="modal-content">
		   	<div class="modal-header">
			   <button type="button" class="close" data-dismiss="modal">&times;</button>
			   <h4 class="modal-title"> <b>Approve addition/changes resource master <?php echo @$_GET['id']; ?></b></h4>
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

<!--SEARCH MS-Menu-->
<script type="text/javascript">
  $(document).ready(function(){
    tampil_data_arm(); 
  });
</script>
<script type="text/javascript">
	function tampil_data_arm(){
		var Finish_Goods      		   = $('#ChkType1').val();
      	var Materials	    		   = $('#ChkType2').val();
      	var WorkProcess      		   = $('#ChkType3').val();
		var Fu_Fee		    		   = $('#ChkType4').val();
      	var Type_Vendor      		   = $('#ChkType5').val()
      	var Type_Customer    		   = $('#ChkType6').val();
      	var Request_No                 = $('#inputAutoRequestNo').val();
 
      $.ajax({
        type  : 'POST',
		url: "production-arm/arm-app-load-detail.php",
        data: {Finish_Goods:Finish_Goods,Materials:Materials,WorkProcess:WorkProcess,
			Fu_Fee:Fu_Fee,Type_Vendor:Type_Vendor,Type_Customer:Type_Customer, 
			Request_No: Request_No},
        success: function(info) {
          $("#myTable").html(info);  
        }
      
      });
    }
</script>
<script type="text/javascript">
   $(document).ready(function(){
	   $('#addWorkProcess').on('show.bs.modal', function (e) {
		   var getDetail ='';
		   var getDetail = $(e.relatedTarget).data('id');
		   var AutoRequestNo = $('#inputAutoRequestNo').val();
		   $.ajax({
			   type :'post',
			   url: "production-arm/arm-detail-form-type-work-process-app.php",
			   data: { getDetail: getDetail, AutoRequestNo: AutoRequestNo },
			   success : function(data){	
			   $('.modal-data-wp').html(data);
			   }
		   });
		});
   });
</script>
<script type="text/javascript">
   $(document).ready(function(){
	   $('#addVC').on('show.bs.modal', function (e) {
		   var getDetail ='';
		   var getDetail = $(e.relatedTarget).data('id');
		   var getTypeVendor = $(e.relatedTarget).data('typevendor');
		   var getTypeCustomers = $(e.relatedTarget).data('typecustomers');
		   var getTSubject = $(e.relatedTarget).data('subject');
		   
		   var AutoRequestNo = $('#inputAutoRequestNo').val();
		   $.ajax({
			   type :'post',
			   url: "production-arm/arm-detail-form-type-cust-vend-app.php",
			   data: { getDetail: getDetail, AutoRequestNo: AutoRequestNo, 
				getTypeVendor:getTypeVendor,getTypeCustomers:getTypeCustomers,getTSubject:getTSubject},
			   success : function(data){	
			   $('.modal-data-vc').html(data);
			   }
		   });
		});
   });
</script>

<script type="text/javascript">
   $(document).ready(function(){
	   $('#add').on('show.bs.modal', function (e) {
		   var getDetail ='';
		   var getDetail = $(e.relatedTarget).data('id');
		   var AutoRequestNo = $('#inputAutoRequestNo').val();
		   var c = '<?php echo @$tampildataWFMPR['Approve_No']; ?>'
  		   var d = '<?php echo @$tampildataWFMPR['LevelProcess']; ?>'
		   var e = '<?php echo @$tampildataWFMPR['Index_No']; ?>'
		   var f = '<?php echo @$divisioncode; ?>'
		   $.ajax({
			   type :'post',
			   url: "production-arm/arm-detail-form-app.php",
			   data: { getDetail: getDetail, AutoRequestNo: AutoRequestNo, 
			   data3: c , data4: d ,data5: e ,data6: f },
			   success : function(data){	
			   $('.modal-data').html(data);
			   }
		   });
		});
   });
</script>





 

