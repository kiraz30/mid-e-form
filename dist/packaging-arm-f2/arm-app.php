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
		a.Remark,a.Status_add_resource,a.CreatedBy,date(a.CreatedDate) as Created_Date 
		from tb_packdev_add_resource_f2 a  LEFT JOIN tb_mpr b ON a.MPR_Code=b.Request_No
		WHERE a.Request_No = '".@$_GET['id']."' ";
		if ($button=="arm-add") {$query.=" And a.Status_Last_Document='1'";}
		else {$query =$query; }
      	$exe =mysqli_query($con,$query);
        $tampildata=mysqli_fetch_array($exe);
		//________________________________________________________________________________UPDATE READ INBOX
		mysqli_query($con,"UPDATE tb_inbox SET ReadInbox='1' Where (NameApproval= '$username' Or OnBehalf='$username') 
		And Request_No='".@$_GET['id']."' And ReadInbox='0'");
		//________________________________________________________________________________WORK FLOW Next PROCESS
      	$exeWFP = mysqli_query($con,"SELECT WorkFlowMenu,Index_No,NameApproval,OnBehalf,StatusWorkFlow FROM tb_workflownprf 
		WHERE (NameApproval='$username' or OnBehalf ='$username') And Request_No = '".@$_GET['id']."' AND StatusWorkFlow IS null");
        $tampildataWFR=mysqli_fetch_array($exeWFP);
		$NextStep_Index= @$tampildataWFR['Index_No']+1;
		//________________________________________________________________________________WORK FLOW Back PROCESS
		$exeWFBP = mysqli_query($con,"SELECT WorkFlowMenu,Index_No,NameApproval,OnBehalf,StatusWorkFlow FROM tb_workflownprf 
		WHERE (NameApproval='$username' or OnBehalf ='$username') And Request_No = '".@$_GET['id']."' ");
        $tampildataWFBR=mysqli_fetch_array($exeWFBP);
		$BackStep_Index= @$tampildataWFBR['Index_No']-1;
		//________________________________________________________________________________StatusMPR disabled
		$exeWFMPR = mysqli_query($con,"SELECT LevelProcess,Step_Revise,WorkFlowMenu,Index_No,NameApproval,OnBehalf,
		StatusWorkFlow,Approve_No FROM tb_workflownprf WHERE (NameApproval='$username' or OnBehalf ='$username')  And 
		Request_No = '".@$_GET['id']."' AND StatusWorkFlow IS NULL LIMIT 1");
        $tampildataWFMPR=mysqli_fetch_array($exeWFMPR);

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
	
				//Send Email Notification for Approval 2-------------------------------------------------
				$exeNext = mysqli_query($con,"Select NameApproval,OnBehalf FROM tb_workflownprf 
				WHERE Request_No='$tempFormatNoRequest' And Index_No='$NextStep_Index' And StatusWorkFlow is null limit 1");
				$tampildataNext=mysqli_fetch_array($exeNext);
				$app1=@$tampildataNext['NameApproval'];
				$app2=@$tampildataNext['OnBehalf'];
				$remark=$inputRemarkApp;
				$id=$tempFormatNoRequest;
				$page="armj-app";
				$WorkFlowMenu="ARMJ";

				if (mysqli_num_rows($exeNext) !=0 ) { 
					if ($app2<>"-" || $app2==""){
						$StatusARM= "Waitting Approval By " .$app1. " / ".$app2;}
					else {
						$StatusARM= "Waitting Approval By " .$app1;}
					$StatusInbox="W";
					$Status_Last_Document="0";
					$Confirm=="Approve";
					require ("../config/emailapp.php");
					
					//Simpan Inbox
					mysqli_query($con,"UPDATE tb_inbox Set Request_Status='$StatusInbox',ReadInbox='0',UpdatedBy='$username',
					NameApproval='".$tampildataNext['NameApproval']."',OnBehalf='".$tampildataNext['OnBehalf']."',
					UpdatedDate='$createddate',UpdatedHostName='$ip : $hostname'  WHERE Request_No='$tempFormatNoRequest'");
				}
				else {
					$StatusARM="Complete";
					$StatusInbox="C";
					$Status_Last_Document="1";
					$Confirm=="Approve";
					require ("../config/emailcomplite.php");
					mysqli_query($con,"UPDATE tb_inbox Set Request_Status='$StatusInbox',ReadInbox='0',UpdatedBy='$username',
					NameApproval='',OnBehalf='',
					UpdatedDate='$createddate',UpdatedHostName='$ip : $hostname'  WHERE Request_No='$tempFormatNoRequest'");

				}
				//Simpan WorkFlow NPRF
				mysqli_query($con,"UPDATE tb_workflownprf SET StatusWorkFlow='C',ReadWorkFlow='1',Remark_WorkFlow='$inputRemarkApp',
				Approve='$username',ApproveDate='$createddate',Status_Approval='1' WHERE Request_No='$tempFormatNoRequest' 
				And Index_No='".@$tampildataWFR['Index_No']."' AND StatusWorkFlow IS null Order By ID_No Desc limit 1" );
				
				
				//UPDATE STATUS NPRF
				mysqli_query($con,"UPDATE tb_packdev_add_resource_f2 Set Status_add_resource='$StatusARM',
				Status_Last_Document='$Status_Last_Document' WHERE Request_No='$tempFormatNoRequest'");
				
				//---------------------------------------------------------------------------------------
				$message = "Data successfully Sent to Approval";
				echo "<script type='text/javascript'>alert('$message');</script>";
				echo"<script>  window.location='../dist/index.php?button=inbox'; </script>";
				
			}
			if ($Confirm=="Revise"){
	
					//Simpan WorkFlow ARM
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
					$page="revise-arm";
					$WorkFlowMenu="ARM";
					if (mysqli_num_rows($exeBack) !=0 ) { 
						$StatusARM= "Revise";
						$StatusInbox="R";
						require ("../config/emailrevise.php");
					}
					else {
						$StatusARM="Complete";
						$StatusInbox="C";
					}
					//Simpan Inbox
					mysqli_query($con,"UPDATE tb_inbox Set Request_Status='$StatusInbox',ReadInbox='0',UpdatedBy='$username',
					NameApproval='".$tampildataBack['Revise']."',OnBehalf='',
					UpdatedDate='$createddate',UpdatedHostName='$ip : $hostname' 
					WHERE Request_No='$tempFormatNoRequest'");
					 //UPDATE STATUS ARM
					mysqli_query($con,"UPDATE tb_packdev_add_resource_f2 
					Set Status_add_resource='$StatusARM' WHERE Request_No='$tempFormatNoRequest'");					//_________________________________________________________________________________________
	
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
					FROM tb_packdev_add_resource_doc_lampiran Where Request_No = '".@$tampildata['Request_No']."'   ");
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
							<label><input type="checkbox" name="ChkType1" id="ChkType1" disabled="disabled"
							<?php if (@$tampildata['Type_Finish_Goods']=="1") { echo 'checked="checked"';} ?>> Finish Goods</label></td>
						<td style="text-align:left; width:120px; height:20px;">
							<label><input type="checkbox" name="ChkType2" id="ChkType2" disabled="disabled"
							<?php if (@$tampildata['Type_Materials']=="1") { echo 'checked="checked"';} ?> > Materials</label></td>
						<td style="text-align:left; width:120px; height:20px;">
							<label><input type="checkbox" name="ChkType3" id="ChkType3" disabled="disabled"
							<?php if (@$tampildata['Type_WorkProcess']=="1") { echo 'checked="checked"';} ?>  > WorkProcess</label></td>
						<td style="text-align:left; width:120px; height:20px;">
							<label><input type="checkbox" name="ChkType4" id="ChkType4" disabled="disabled"
							<?php if (@$tampildata['Type_Fu_Fee']=="1") { echo 'checked="checked"';} ?> > Fu Fee</label></td>
						<td style="text-align:left; width:150px; height:20px;">
							<label><input type="checkbox" name="ChkType5" id="ChkType5" disabled="disabled"
							<?php if (@$tampildata['Type_Vendor']=="1") { echo 'checked="checked"';} ?> > Vendor</label></td>
						<td style="text-align:left; width:150px; height:20px;">
							<label><input type="checkbox" name="ChkType6" id="ChkType6" disabled="disabled"
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
							disabled="disabled"> Price</label></td>
						<td style="text-align:left; width:120px; height:20px;">
							<label><input type="checkbox" name="ChkSegment2" id="ChkSegment2"  
							<?php if (@$tampildata['Segment_Data_Informasi']=="1") { echo 'checked="checked"';} ?> 
							disabled="disabled"> Data Informasi</label></td>
						<td style="text-align:left; width:120px; height:20px;">
							<label><input type="checkbox" name="ChkSegment3" id="ChkSegment3"  
							<?php if (@$tampildata['Segment_Ukuran']=="1") { echo 'checked="checked"';} ?> 
							disabled="disabled"> Ukuran</label></td>
						<td style="text-align:left; width:120px; height:20px;">
							<label><input type="checkbox" name="ChkSegment4" id="ChkSegment4"  
							<?php if (@$tampildata['Segment_Others']=="1") { echo 'checked="checked"';} ?> 
							disabled="disabled"> Others</label></td>
						<td style="text-align:left; width:150px; height:20px;">
							<label><input type="checkbox" name="ChkSegment5" id="ChkSegment5"  
							<?php if (@$tampildata['Segment_Over_Receipt']=="1") { echo 'checked="checked"';} ?> 
							disabled="disabled"> 10% Over Receipt</label></td>
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
              <td colspan="3"> 
			  	<table width="100%" class="table table-striped table-bordered table-hover" 
				id="arm-detail" name="arm-detail">
              	<thead>
					<tr bgcolor="#999999">
					<th width="1%">No</th> 
					<th width="10%">Finish Good Code</th> 
					<th width="20%">Finish Good Code Name  </th> 
					<th width="10%">Material Code  </th>  
					<th width="15%">Material Name  </th> 
					<th width="15%">Material Request  </th>
					<th width="5%">Action <span class="fa fa-exclamation-circle" title="Action untuk melengakapi Additional Resource Master Detail "></span> </th>
					</tr>
              	</thead>
              	<tfoot>
					<tr>
					<th>No</th> 
					<th>Finish Good Code</th> 
					<th>Finish Good Name  </th> 
					<th>Material Code  </th> 
					<th>Material Name  </th> 
					<th>Material Request  </th>
					<th>Action</th>
					</tr>
              	</tfoot>
              	<tbody>
				<?php
				$query="SELECT ID_No,Request_No,FinishGoodCode,FinishGoodName,Material_Code,Material_Name,
				Material_Name_Request FROM tb_packdev_add_resource_f2_detail
				Where Request_No ='".@$tampildata['Request_No']."' ";
				$exe = mysqli_query($con,$query);
				$no = 1;
				while(@$row =mysqli_fetch_array($exe)){
				?>
				<tr> 
					<td><?php echo $no;?></td>
					<td><?php echo $row['FinishGoodCode'];?> </td>
					<td><?php echo $row['FinishGoodName'];?> </td>
					<td><?php echo $row['Material_Code'];?> </td>
					<td><?php echo $row['Material_Name'];?> </td>
					<td><?php echo $row['Material_Name_Request'];?> </td>
					<td align="center"><button type="button" style="padding:2px 4px 2px 2px"  
					class="btn btn-primary" data-toggle='modal' data-target='#add' 
					data-id="<?php echo $row['ID_No'];?>">
					<span class="glyphicon glyphicon-zoom-in edit_data" title="Edit / View Additional Resource Master Detail "></span></button>	
					</td>
			  	</tr>
			  	<?php $no++;} ?>
              	</tbody>
            	</table>
			  </td>
            </tr>
			<tr>
              <td>Confirm *</td>
              <td width="50%"><div class="form-group"> <input type="radio" id="Confirm" name="Confirm" value="Approve"> Approve </div></td>
			  <td width="20%"><div class="form-group"><input type="radio" id="Confirm" name="Confirm" value="Revise"> Revise</div></td>
            </tr>
            <tr>
              <td>Remark Approval *</td>
              <td colspan="2"><div class="form-group"> <textarea cols="4" id="inputRemarkApp"  name="inputRemarkApp"  class="form-control py-4" 
			placeholder="Enter Remark" ><?php if ($_POST) { echo $inputRemarkApp; }  ?></textarea></div>			  </td>
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

	
 
</script>

	</script>
		<script src="../vendor/jquery/jquery.min.js"></script>
	<!-- Bootstrap Core JavaScript -->
	<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
	<!-- Metis Menu Plugin JavaScript -->
	<script src="../vendor/metisMenu/metisMenu.min.js"></script>

 	<script language="JavaScript" type="text/javascript">

 
	</script>
 


 	</body>
</html>
<?php ;}?>

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

<script type="text/javascript">
   $(document).ready(function(){
	   $('#add').on('show.bs.modal', function (e) {
		   //var AutoRequestNo = $(e.relatedTarget).data('id');
		   //var getDetail ='';
		   var getDetail ='';
		   var getDetail = $(e.relatedTarget).data('id');
		   var AutoRequestNo = $('#inputAutoRequestNo').val();
		   var c = '<?php echo @$tampildataWFMPR['Approve_No']; ?>'
  		   var d = '<?php echo @$tampildataWFMPR['LevelProcess']; ?>'
		   var e = '<?php echo @$tampildataWFMPR['Index_No']; ?>'
		   var f = '<?php echo @$divisioncode; ?>'
		   /* fungsi AJAX untuk melakukan fetch data */
		   
		   $.ajax({
			   type :'post',
			   url: "packaging-arm-f2/arm-detail-form-app.php",
			   /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
			   data: { getDetail: getDetail, AutoRequestNo: AutoRequestNo, 
			   data3: c , data4: d ,data5: e ,data6: f },
			   /* memanggil fungsi getDetail dan mengirimkannya */
			   success : function(data){	
			   $('.modal-data').html(data);
			   /* menampilkan data dalam bentuk dokumen HTML */
			   }
		   });
		});
   });
 </script>





 

