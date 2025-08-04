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
		<li class="breadcrumb-item"><a href="../dist/index.php?button=<?php echo $_GET['menu']; ?>"> 
		<?php if($_GET['menu']=="status-req") {echo "Status Request" ;} else {echo "Completed Request"; }  ?>  </a></li>
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
					
		$query="SELECT a.ID_No,a.Index_Document,a.Request_No,a.Last_Request_No,a.Status_Last_Document,
		a.MPR_Code,a.Project_Name,a.Subject,a.`Type`,a.Segment_Price,a.Segment_Data_Informasi,
		a.Segment_Ukuran,a.Segment_Others,a.Segment_Over_Receipt,a.Content,a.Remark,
		a.Remark,a.Status_add_resource,a.CreatedBy,date(a.CreatedDate) as Created_Date 
		from tb_prod_add_resource a  LEFT JOIN tb_mpr b ON a.MPR_Code=b.Request_No
		WHERE a.Request_No = '".@$_GET['id']."' ";
		if ($button=="arm-add") {$query.=" And a.Status_Last_Document='1'";}
		else {$query =$query; }
      	$exe =mysqli_query($con,$query);
        $tampildata=mysqli_fetch_array($exe);

		//_________________________________________________________________________________
        
	  	?>
	<form name="faw" id="faw" action="" method="post"  enctype="multipart/form-data"  >

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
			  <select class="form-control" id="InputSubject" name="InputSubject" disabled="disabled">
					<option value="-" >Select Subject</option>
					<option value="Additional" <?php if (@$tampildata['Subject']=='Additional') {echo "Selected"; }?>>Additional</option>
            		<option value="Change" <?php if (@$tampildata['Subject']=='Change') {echo "Selected";} ?>>Change</option>

			  </select>
			  </td>
            </tr>
			<tr>
              <td>Type *</td>
              <td>
			  <select class="form-control" id="InputType" name="InputType" disabled="disabled">
					<option value="-" >Select Type</option>
					<option value="Finish Goods" <?php if (@$tampildata['Type']=='Finish Goods') {echo "Selected"; }?> >FhinishGoods</option>
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
              <td>
			  <table cellpadding="0" cellspacing="0" border="0"width="100%"  >
					<tr>
						<td style="text-align:left; width:120px; height:20px;">
							<label><input type="checkbox" name="ChkSegment1" id="ChkSegment1"  
							<?php if ($tampildata['Segment_Price']=="1") { echo 'checked="checked"';} ?> 
							disabled="disabled"> Price</label></td>
						<td style="text-align:left; width:120px; height:20px;">
							<label><input type="checkbox" name="ChkSegment2" id="ChkSegment2"  
							<?php if ($tampildata['Segment_Data_Informasi']=="1") { echo 'checked="checked"';} ?> 
							disabled="disabled"> Data Informasi</label></td>
						<td style="text-align:left; width:120px; height:20px;">
							<label><input type="checkbox" name="ChkSegment3" id="ChkSegment3"  
							<?php if ($tampildata['Segment_Ukuran']=="1") { echo 'checked="checked"';} ?> 
							disabled="disabled"> Ukuran</label></td>
						<td style="text-align:left; width:120px; height:20px;">
							<label><input type="checkbox" name="ChkSegment4" id="ChkSegment4"  
							<?php if ($tampildata['Segment_Others']=="1") { echo 'checked="checked"';} ?> 
							disabled="disabled"> Others</label></td>
						<td style="text-align:left; width:150px; height:20px;">
							<label><input type="checkbox" name="ChkSegment5" id="ChkSegment5"  
							<?php if ($tampildata['Segment_Over_Receipt']=="1") { echo 'checked="checked"';} ?> 
							disabled="disabled"> 10% Over Receipt</label></td>
					</tr>
				</table>
			  </td>
            </tr>
			<tr>
              <td>Content *</td>
              <td colspan="2"><div class="form-group"> <textarea cols="4" id="InputContent" name="InputContent"  
			  class="form-control py-4" placeholder="Enter Content" disabled="disabled" 
			  maxlength="100"><?php if ($_POST) { echo $InputContent; } else {echo @$tampildata['Content'];} ?></textarea></div>
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
					<th width="20%">Material Name  </th> 
					<th width="5%">Action <span class="fa fa-exclamation-circle" title="Action untuk melengakapi Additional Resource Master Detail "></span> </th>
					</tr>
              	</thead>
              	<tfoot>
					<tr>
					<th>No</th> 
					<th>Finish Good Code</th> 
					<th>Finish Good Code Name  </th> 
					<th>Material Name  </th> 
					<th>Action </th>
					</tr>
              	</tfoot>
              	<tbody>
				<?php
				$query="SELECT ID_No,Request_No,FinishGoodCode,FinishGoodName,Material_Name
				FROM tb_prod_add_resource_detail
				Where Request_No ='".@$tampildata['Request_No']."' ";
				$exe = mysqli_query($con,$query);
				$no = 1;
				while(@$row =mysqli_fetch_array($exe)){
				?>
				<tr> 
					<td><?php echo $no;?></td>
					<td><?php echo $row['FinishGoodCode'];?> </td>
					<td><?php echo $row['FinishGoodName'];?> </td>
					<td><?php echo $row['Material_Name'];?> </td>
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
		 
	
          </table>
		  <a class="btn btn-primary" href="../dist/index.php?button=<?php echo $_GET['menu']; ?>" 
		  title="Back Request Status">Back</a> 
		</form>
		</div>
      </div>
	 </div>
    </main> 
 
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
				   <h4 class="modal-title"> <b>Resource master <?php echo @$_GET['id']; ?></b></h4>
			   </div>
			   <div class="modal-body">
				   <div class="modal-data"></div>
				    
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
		   /* fungsi AJAX untuk melakukan fetch data */
		   $.ajax({
			   type :'post',
			   url: "packaging-arm/arm-detail-form-app.php",
			   /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
			   data: { getDetail: getDetail, AutoRequestNo: AutoRequestNo },
			   /* memanggil fungsi getDetail dan mengirimkannya */
			   success : function(data){	
			   $('.modal-data').html(data);
			   /* menampilkan data dalam bentuk dokumen HTML */
			   }
		   });
		});
   });
 </script>





 

