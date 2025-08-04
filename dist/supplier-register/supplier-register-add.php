<?php $submit		= @$_POST['submit']; ?>
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
		<!-- Bootstrap Core CSS -->
		<link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	
		<!-- MetisMenu CSS -->
		<link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
	
		<!-- Custom CSS -->
		<link href="../css/sb-admin-2.css" rel="stylesheet">
	
		<!-- Custom Fonts -->
		<link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    </head>
	<main> 
    <div class="container-fluid"> 
      <h3 class="mt-4"><?php if ($button=="add-supplier-register") {echo "Add Supplier Register";} else  {echo "Edit Supplier Register";} ?></h3>
	    <ol class="breadcrumb mb-2">
        <li class="breadcrumb-item"><a href="../dist/index.php?button=dashboard">Dashboard</a></li>
		<li class="breadcrumb-item"><a href="../dist/index.php?button=supplier-register">Supplier Register</a></li>
        <li class="breadcrumb-item active"><?php if ($button=="add-supplier-register") {echo "Add Supplier Register";} else  {echo "Edit Supplier Register";} ?> </li>
      </ol>
 	<div class="card mb-4">
	    <div class="card-header"> </div>

        <div class="card-body"> 
			
        <?php
      	$exe =mysqli_query($con,"SELECT ID_No,KDSupplier,Name,Address,Country,Keterangan,Status FROM tb_supplier where ID_No = '".@$_GET['id']."' ");
        $tampildata=mysqli_fetch_array($exe)
	  	?>
        <form action="" method="post" name="frm-Country">
          <?php 
		//Begin CRUD----------------------------------------------------------------------
		if($_POST){
		$ip=$_SERVER['REMOTE_ADDR'];
		$hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);
		date_default_timezone_set("Asia/Jakarta");
		$createddate			=date("Y-m-d H:i:s");
		$tempSupplierCode	  	= $_POST['tempSupplierCode'];
    	$inputSupplierCode  	= $_POST['inputSupplierCode'];
		$inputName 				= $_POST['inputName'];
		$inputDescrioption	 	= $_POST['inputDescrioption'];
		$SelectStatus 			= $_POST['SelectStatus'];

		if($inputSupplierCode==""){  
			echo "<div class='form-group has-error'>
			<label class='control-label' for='inputError'>Supplier Code Can not be empty *</label></div>"; }
		elseif($inputName==""){  
			echo "<div class='form-group has-error'>
			<label class='control-label' for='inputError'>Name Supplier Can not be empty *</label></div>"; }
		elseif($button=="add-supplier-register"){ 
			$Tanya = mysqli_query($con,"SELECT KDSupplier FROM tb_supplier 
			WHERE KDSupplier = '$inputSupplierCode' ");
			if (mysqli_num_rows($Tanya) !=0 ) {  
				echo "<div class='form-group has-error'>
				<label class='control-label' for='inputError'>Error Save : Dosage already exists in the database *</label></div>";}
			else{
				//membuat Query untuk menyimpan data
				mysqli_query($con,"Insert INTO tb_supplier (KDSupplier,Name,Keterangan,
				Status,CreatedBy,CreatedDate,CreatedHostName) values('$inputSupplierCode','$inputName',
				'$inputDescrioption','$SelectStatus','$username','$createddate','$ip : $hostname')");
					
				echo "<div class='alert alert-success alert-diszmissable'> 
				<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
				Data successfully save to database. <a href='../dist/index.php?button=supplier-register' class='alert-link'>Supplier Register</a>. </div>";
				$inputSupplierCode  	= "";
				$inputName 				= "";
				$inputDescrioption	 	= "";
				$SelectStatus 			= "";
				}
			}
		elseif($button=="edit-supplier-register"){ 
			//membuat Query untuk update data
			mysqli_query($con,"update tb_supplier set Name='$inputName',Keterangan='$inputDescrioption',Status='$SelectStatus',
			UpdatedBy='$username',UpdatedDate='$createddate',UpdatedHostName='$ip : $hostname' 
			WHERE ID_No='$tempSupplierCode'");
			
			$message = "Data successfully Update to database";
			echo "<script type='text/javascript'>alert('$message');</script>";
			echo"<script>  window.location='../dist/index.php?button=supplier-register'; </script>";
			}
		}
		//End CRUD----------------------------------------------------------------------
		?>
		
		<div class="form-row"> 
			
          <div class="col-md-4"> 
            <div class="form-group">
			
              <label class="small mb-1" for="inputFirstName">Supplier Code *</label>
			  <div class="form-group d-flex align-items-center justify-content-between mt-0 mb-1"> 
              <input name="tempSupplierCode" type="hidden" value="<?php echo $tampildata['ID_No']; ?>">
              <input class="form-control py-4" name="inputSupplierCode"  id="inputSupplierCode" maxlength="20" type="text" 
			  placeholder="Enter Supplier Code" value="<?php if ($_POST) { echo $inputSupplierCode;} else 
			  {echo $tampildata['KDSupplier'];} ?>" readonly="readonly"/>&nbsp;	<button type="button" style="padding:2px 4px 4px 4px" 
			   class="btn btn-primary" title="Search Project Name"  
					name="btnsearch" 
					onClick="popupwindow('supplier-register/popup.php?id=supp','Search Supplier','600','700');"  >
					<span class="glyphicon glyphicon-search" ></span> </button>
			  </div>	 
            </div>
          </div>
  	
          <div class="col-md-8"> 
            <div class="form-group"> 
              <label class="small mb-1" for="inputLastName">Name *</label>
              <input type="text" class="form-control py-4"  name="inputName" id="inputName" maxlength="100" 
			placeholder="Enter Name" value="<?php if ($_POST) { echo $inputName;} else {echo $tampildata['Name'];} ?>" />
            </div>
          </div>
       	</div>
		<div class="form-row"> 
			
          <div class="col-md-9"> 
            <div class="form-group"> 
            <label class="small mb-1" for="inputEmailAddress">Descrioption</label>
			<textarea cols="4"  name="inputDescrioption" maxlength="100" class="form-control py-4" 
			placeholder="Enter Descrioption"><?php if($_POST) {echo $inputDescrioption;} else {echo $tampildata['Keterangan'];} ?></textarea>
            </div>
          </div>
					  
			
          <div class="col-md-3"> 
            <div class="form-group"> 
			 <label class="small mb-1" for="inputFirstName">Status</label>
              <select class="form-control" name="SelectStatus" >
              	<option value="1" <?php if (@$tampildata['Status']=='1') {echo "Selected"; }?>>Active </option>
            	<option value="0" <?php if (@$tampildata['Status']=='0') {echo "Selected";} ?>>Non Active</option>
              </select>
            </div>
          </div>
       	</div>

		<button type="submit" class="btn btn-primary" onClick="return checkSave()">Save</button>		
		<a class="btn btn-primary" href="../dist/index.php?button=supplier-register">Back</a> 
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

    <!-- Custom Theme JavaScript -->
    <script src="../js/sb-admin-2.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
    </script>
	<script language="JavaScript" type="text/javascript">
		function checkSave(){
			return confirm('Are you sure you want to save this data?');
		}
	</script>
    </body>
</html>
