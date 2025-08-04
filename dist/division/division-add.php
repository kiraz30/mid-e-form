<?php $submit		= @$_POST['submit']; ?>

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
      <h3 class="mt-4"><?php if ($button=="add-division") {echo "Add Division";} else  {echo "Edit Division";} ?></h3>
	    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="../dist/index.php?button=dashboard">Dashboard</a></li>
		<li class="breadcrumb-item"><a href="../dist/index.php?button=division">Division</a></li>
        <li class="breadcrumb-item active"><?php if ($button=="add-division") {echo "Add Division";} else  {echo "Edit Division";} ?> </li>
      </ol>
 	<div class="card mb-4">
	    <div class="card-header"> </div>

        <div class="card-body"> 
			
        <?php
      	$exe =mysqli_query($con,"SELECT KDDivision,DivisionName,Keterangan FROM tb_division where KDDivision = '".@$_GET['id']."' ");
        $tampildata=mysqli_fetch_array($exe)
	  	?>
        <form action="" method="post" name="frm-division">
          <?php 
		//Begin CRUD----------------------------------------------------------------------
		if($_POST){
		$ip=$_SERVER['REMOTE_ADDR'];
		$hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);
		date_default_timezone_set("Asia/Jakarta");
		$createddate=date("Y-m-d H:i:s");
    	$tempDivisionCode  	= $_POST['tempDivisionCode'];
		$inputDivisionCode 	= $_POST['inputDivisionCode']; 
		$inputDivisionName 	= $_POST['inputDivisionName']; 
		$inputDescrioption 	= $_POST['inputDescrioption'];
		$SelectStatus		= $_POST['SelectStatus'];
		if($inputDivisionCode==""){  
			echo "<div class='form-group has-error'>
			<label class='control-label' for='inputError'>Division Code Can not be empty *</label></div>"; }
		elseif($inputDivisionName==""){  
			echo "<div class='form-group has-error'>
			<label class='control-label' for='inputError'>Division Name Can not be empty *</label></div>"; }
		elseif($button=="add-division"){ 
			$Tanya = mysqli_query($con,"SELECT KDDivision,DivisionName FROM tb_division 
			WHERE KDDivision = '$inputDivisionCode' OR DivisionName='$inputDivisionName' ");
			if (mysqli_num_rows($Tanya) !=0 ) {  
				echo "<div class='form-group has-error'>
				<label class='control-label' for='inputError'>Error Save : Dosage already exists in the database *</label></div>";}
			else{
				//membuat Query untuk menyimpan data
				mysqli_query($con,"Insert INTO tb_division (KDDivision,DivisionName,Keterangan,Status,CreatedBy,CreatedDate,CreatedHostName) values 
				('$inputDivisionCode','$inputDivisionName','$inputDescrioption','$SelectStatus','$username','$createddate','$ip : $hostname')");
					
				echo "<div class='alert alert-success alert-diszmissable'> 
				<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
				Data successfully save to database. <a href='../dist/index.php?button=division' class='alert-link'>Division</a>. </div>";
				$inputDivisionCode ="";
				$inputDivisionName =""; 
				$inputDescrioption ="";
				}
			}
		elseif($button=="edit-division"){ 
			//membuat Query untuk update data
			mysqli_query($con,"update tb_division set DivisionName='$inputDivisionName',Keterangan='$inputDescrioption',
			Status='$SelectStatus',UpdatedBy='$username',UpdatedDate='$createddate',UpdatedHostName='$ip : $hostname' WHERE KDDivision='$tempDivisionCode'");
			
			$message = "Data successfully Update to database";
			echo "<script type='text/javascript'>alert('$message');</script>";
			echo"<script>  window.location='../dist/index.php?button=division'; </script>";
			}
		}
		//End CRUD----------------------------------------------------------------------
		?>
		
		<div class="form-row"> 
			
          <div class="col-md-3"> 
            <div class="form-group"> 
              <label class="small mb-1" for="inputFirstName">Division Code</label>
              <input name="tempDivisionCode" type="hidden" value="<?php echo @$tampildata['KDDivision']; ?>">
              <input class="form-control py-4" name="inputDivisionCode"  maxlength="20" type="text" 
			  placeholder="Enter Division Code" value="<?php echo @$tampildata['KDDivision']; ?>" />
            </div>
          </div>
					  
			
          <div class="col-md-6"> 
            <div class="form-group"> 
              <label class="small mb-1" for="inputLastName">Division Name</label>
              <input type="text" class="form-control py-4"  name="inputDivisionName" maxlength="50" 
			placeholder="Enter Division Name" value="<?php echo @$tampildata['DivisionName']; ?>" />
            </div>
          </div>
       	</div>
		<div class="form-row"> 
			
          <div class="col-md-9"> 
            <div class="form-group"> 
            <label class="small mb-1" for="inputEmailAddress">Descrioption</label>
			<textarea cols="4"  name="inputDescrioption" maxlength="100" class="form-control py-4" 
			placeholder="Enter Descrioption"><?php if($_POST) {echo $inputDescrioption;} else {echo @$tampildata['Keterangan'];} ?></textarea>
            </div>
          </div>
					  
			
          <div class="col-md-2"> 
            <div class="form-group"> 
			 <label class="small mb-1" for="inputFirstName">Status</label>
              <select class="form-control" name="SelectStatus" >
              	<option value="1" <?php if (@$tampildata['Status']=='1') {echo "Selected"; }?>>Active </option>
            	<option value="0" <?php if (@$tampildata['Status']=='0') {echo "Selected";} ?>>Non Active</option>
              </select>
            </div>
          </div>
       	</div>

		<button type="submit" class="btn btn-primary" onClick="return checkSave()" >Save</button>		
		<a class="btn btn-primary" href="../dist/index.php?button=division">Back</a> 
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
