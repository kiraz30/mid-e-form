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
      <h3 class="mt-4">Request Packaging Spesification</h3>
	    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="../dist/index.php?button=dashboard">Dashboard</a></li>
		<li class="breadcrumb-item"><a href="../dist/index.php?button=<?php echo $_GET['menu']; ?>"> 
		<?php if($_GET['menu']=="status-req") {echo "Status Request" ;} else {echo "Completed Request"; }  ?>  </a></li>
		<li class="breadcrumb-item active">Request Packaging Spesification</li>
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
		a.ARM_Code,a.MPR_Code,b.Project_Name,a.Finish_Good_Code,a.Finish_Good_Name,a.Netto,a.Isi,a.DZ_CT,
		a.Market,a.Barcode,a.CreatedBy,DATE(a.CreatedDate) as CreatedDate,a.Status_Spec,a.Remark
		FROM  tb_packdev_spec a LEFT JOIN tb_packdev_add_resource b ON a.ARM_Code=b.Request_No
		WHERE a.Request_No = '".@$_GET['id']."' ";
		if ($button=="ps-add") {$query.=" And a.Status_Last_Document='1'";}
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
			  value="<?php if ($button=="ps-add") {echo $NomorReq;} elseif ($button=="ps-add") 
			  {echo substr($tampildata['Request_No'],0,17)."-R".$rev;} else {echo @$tampildata['Request_No'];} ?>" />
              </span> </td>
            </tr>
            <tr>
              <td width="20%"><span class="form-group">Last Request No *</span></td>
              <td colspan="2"><span class="form-group">
                <input class="form-control py-4"  name="inputLastRequestNo" id="inputLastRequestNo"  maxlength="50" type="text"  
			  placeholder="Auto Request No"  readonly="readonly" 
			  value="<?php if (@$tampildata['Status_add_resource']=="Complete" & $button=="ps-revise") 
			  {echo @$tampildata['Request_No'];} else {echo @$tampildata['Last_Request_No'];}?>" />
              </span> </td>
            </tr>
 
			<tr>
              <td><span class="form-group">Add Resource Master Request No *</span></td>
              <td width="30%"><div class="form-group d-flex align-items-center justify-content-between mt-0 mb-1">
			  	<input type="text" class="form-control"  name="InputARMCode" id="InputARMCode" 
				placeholder="Resource Master Request No"  
				onChange="setFocus(),get_detaildata()" onFocus="setFocus(),get_detaildata()"
				value="<?php if ($_POST) { echo $InputARMCode; } else {echo @$tampildata['ARM_Code'];} ?>" readonly="readonly">
		 
			  </td>
			  <td width="30%">
			  </td>
            </tr>
            <tr>
              <td><span class="form-group">Master Product Request No *</span></td>
              <td width="30%"><div class="form-group d-flex align-items-center justify-content-between mt-0 mb-1">
			  	<input type="text" class="form-control"  name="InputMPRCode" id="InputMPRCode" 
				placeholder="Master Product Request No"  
				value="<?php if ($_POST) { echo $InputMPRCode; } else {echo @$tampildata['MPR_Code'];} ?>" readonly="readonly">
 			  </td>
			  </td>
			  <td width="30%">
			  </td>
            </tr>

			<tr>
              <td width="20%"><span class="form-group">Finish Good Code *</span></td>
              <td><span class="form-group">
			  <input class="form-control py-4" name="inputFinishGoodCode" id="inputFinishGoodCode"  
				maxlength="50" type="text" placeholder="Input Finish Good Code"  
				value="<?php if ($_POST) { echo $inputFinishGoodCode; } else {echo @$tampildata['Finish_Good_Code'];} ?>" 
				readonly="readonly" />
              </span> </td>
            </tr>
			<tr>
 			<tr>
              <td width="20%"><span class="form-group">Finish Good Name *</span></td>
              <td colspan="2"><span class="form-group">
			  <input class="form-control py-4" name="inputFinishGoodName" id="inputFinishGoodName" 
				maxlength="150" type="text" placeholder="Input Finish Good Name"   
				value="<?php if ($_POST) { echo $inputFinishGoodName; } else {echo @$tampildata['Finish_Good_Name'];} ?>" 
				readonly="readonly"/>
              </span> </td>
            </tr>
			<tr>
              <td width="20%"><span class="form-group">Netto *</span></td>
              <td ><span class="form-group">
			  <input class="form-control py-4" name="inputNetto" id="inputNetto" 
				maxlength="150" type="text" placeholder="Input Netto"   
				value="<?php if ($_POST) { echo $inputNetto; } else {echo @$tampildata['Netto'];} ?>" 
				readonly="readonly" />
              </span> </td>
            </tr> 
			<tr>
              <td width="20%"><span class="form-group">Isi *</span></td>
              <td ><span class="form-group">
			  <input class="form-control py-4" name="inputIsi" id="inputIsi" 
				maxlength="150" type="text" placeholder="Input Isi"   
				value="<?php if ($_POST) { echo $inputIsi; } else {echo @$tampildata['Isi'];} ?>"
				readonly="readonly"/>
              </span> </td>
            </tr>
			<tr>
              <td width="20%"><span class="form-group">Dz/CT *</span></td>
              <td ><span class="form-group">
			  <input class="form-control py-4" name="inputDZCT" id="inputDZCT" 
				maxlength="150" type="text" placeholder="Input Dz/CT"   
				value="<?php if ($_POST) { echo $inputDZCT; } else {echo @$tampildata['DZ_CT'];} ?>"
				readonly="readonly" />
              </span> </td>
            </tr>
			<tr>
              <td width="20%"><span class="form-group">Market *</span></td>
              <td ><span class="form-group">
			  <input class="form-control py-4" name="inputMarket" id="inputMarket" 
				maxlength="150" type="text" placeholder="Input Market"   
				value="<?php if ($_POST) { echo $inputMarket; } else {echo @$tampildata['Market'];} ?>" 
				readonly="readonly"  />
              </span> </td>
            </tr>
			<tr>
              <td width="20%"><span class="form-group">Barcode *</span></td>
              <td ><span class="form-group">
			  <input class="form-control py-4" name="inputBarcode" id="inputBarcode" 
				maxlength="150" type="text" placeholder="Input Barcode"   
				value="<?php if ($_POST) { echo $inputBarcode; } else {echo @$tampildata['Barcode'];} ?>"
				readonly="readonly"   />
              </span> </td>
            </tr>			
			<tr>
              <td colspan="3"> 
			  	<table width="100%" class="table table-striped table-bordered table-hover" 
				id="ps-detail" name="ps-detail">
				<thead>
					<tr bgcolor="#999999">
					<th width="1%">No <!--?php echo $reqno ; ?--></th> 
					<th width="10%">Packaging Material</th> 
					<th width="20%">Packaging Material Name</th> 
					<th width="20%">Status  </th> 
					<th width="5%">Action</th>
					</tr>
              	</thead>
              	<tfoot>
					<tr>
					<th>No</th> 
					<th>Packaging Material</th> 
					<th>Packaging Material Name  </th> 
					<th>Status </th> 
					<th>Action</th>
					</tr>
              	</tfoot>
              	<tbody>
				<?php
			 		$query="SELECT b.ID_No,b.Packaging_Material,b.Packaging_Material_Name,
					 d.Vendor_Code,d.Vendor_Name,b.Status
					 FROM tb_packdev_spec a INNER JOIN tb_packdev_spec_detail b ON a.Request_No =b.Request_No
					 LEFT JOIN tb_packdev_add_resource c ON a.ARM_Code=c.Request_No AND a.MPR_Code=c.MPR_Code
					 LEFT JOIN tb_packdev_add_resource_detail d ON b.ID_No_Resource_Detail=d.ID_No
					 Where a.Request_No ='".@$tampildata['Request_No']."' ";
					$exe = mysqli_query($con,$query);
					$no = 1;
					while(@$rowPS =mysqli_fetch_array($exe)){
					?>

 
				<tr> 
					<td><?php echo $no;?></td>
					<td><input type="hidden" name="tempID_No[]" id="tempID_No[]" 
						value="<?php echo $rowPS['ID_No']; ?>">
						<?php echo $rowPS['Packaging_Material'];?> </td>
					<td><?php echo $rowPS['Packaging_Material_Name'];?> </td>
					<td><?php echo $rowPS['Status'];?> </td>
					<td align="center">
						
					<button type="button" style="padding:2px 4px 2px 2px"  
					class="btn btn-outline btn-default" data-toggle='modal' data-target='#add' 
					data-id="<?php echo $rowPS['ID_No'];?>">
					<span class="glyphicon glyphicon-search edit_data" title="Edit / View Detail "></span></button>	
					</td>
 
					
				</tr>
			  	<?php $no++;} ?>
              	</tbody>
            	</table>
			  </td>
            </tr>
			<tr>
              <td>Remark </td>
              <td colspan="2"><div class="form-group"> <textarea cols="4" id="inputRemark" name="inputRemark"  
			  class="form-control py-4" placeholder="Enter Remark" readonly="readonly"  
			  maxlength="100"><?php if ($_POST) { echo $inputRemark; } else {echo @$tampildata['Remark'];} ?></textarea></div>
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
				   <button type="button" 
					class="close" data-dismiss="modal">&times;</button>
				   <h4 class="modal-title"> <b>Packaging Spesification <?php echo @$_GET['id']; ?></b></h4>
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
			   url: "packaging-ps/ps-detail-form-app.php",
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





 

