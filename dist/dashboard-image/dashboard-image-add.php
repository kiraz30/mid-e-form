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
      <h3 class="mt-4"><?php if ($button=="add-dashboard-image") {echo "Add Dashboard Image";} else  {echo "Edit Dashboard Image";} ?></h3>
	    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="../dist/index.php?button=dashboard">Dashboard</a></li>
		<li class="breadcrumb-item"><a href="../dist/index.php?button=dashboard-image">Dashboard Image</a></li>
        <li class="breadcrumb-item active"><?php if ($button=="add-dashboard-image") {echo "Add Dashboard Image";} else  {echo "Edit Dashboard Image";} ?> </li>
      </ol>
 	<div class="card mb-4">
	    <div class="card-header"> </div>

        <div class="card-body"> 
			
        <?php
      	$exe =mysqli_query($con,"SELECT KDDashboardImage,Image,Status FROM tb_dashboard_image Where  KDDashboardImage = '".@$_GET['id']."' ");
        $tampildata=mysqli_fetch_array($exe)
	  	?>
		<form method="post" action="" enctype="multipart/form-data">
          <?php 
		//Begin CRUD----------------------------------------------------------------------
		if($_POST){
			$ip=$_SERVER['REMOTE_ADDR'];
			$hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);
			date_default_timezone_set("Asia/Jakarta");
			$createddate=date("Y-m-d H:i:s");
			$SelectStatus		= $_POST['SelectStatus'];
	
		
			$uploadDir 			= "../img/";
			$ekstensi_diperbolehkan	= array('png','jpg','JPEG');
			$nama 				= $_FILES['inputImage']['name'];
			$x 					= explode('.', $nama);
			$ekstensi 			= strtolower(end($x));
			$ukuran				= $_FILES['inputImage']['size'];
			$file_tmp 			= $_FILES['inputImage']['tmp_name'];			
			$fotolama 			= @$tampildata['Image'];	
		
		if($button=="add-dashboard-image"){ 
			//membuat Query untuk menyimpan data
			if (!empty($_FILES['inputImage']['name'])) { 
				if($_FILES['inputImage']['size'] > 3000000){ //3MB	
					echo "<div class='form-group has-error'>
						<label class='control-label' for='inputError'>Sorry, your file is too large.</label></div>"; }
				elseif(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
					move_uploaded_file($file_tmp, $uploadDir.date("YmdHis").$nama);
					
					mysqli_query($con,"update tb_dashboard_image set Status='0'");
					mysqli_query($con,"Insert INTO tb_dashboard_image (Image,Status,
					CreatedBy,CreatedDate,CreatedHostName) values ('".date("YmdHis").$nama."','$SelectStatus','$username','$createddate','$ip : $hostname')");
						
					echo "<div class='alert alert-success alert-diszmissable'> 
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
					Data successfully save to database. <a href='../dist/index.php?button=dashboard-image' class='alert-link'>Division</a>. </div>";
					$inputImage ="";
					$SelectStatus =""; 
					}
				}
			else {
				echo "<div class='form-group has-error'>
					<label class='control-label' for='inputError'>Sorry, Not found Image</label></div>"; }
		}
	
		elseif($button=="edit-dashboard-image"){ 
			//membuat Query untuk update data
			//membuat Query untuk update data
			if (!empty($_FILES['inputImage']['name'])) {
				if($_FILES['inputImage']['size'] > 3000000){	
					echo "<div class='form-group has-error'>
					<label class='control-label' for='inputError'>Sorry, your file is too large.</label></div>"; }
				elseif(in_array($ekstensi, $ekstensi_diperbolehkan) === true){ 
					unlink($uploadDir.$fotolama);
					move_uploaded_file($file_tmp, $uploadDir.date("YmdHis").$nama);
					mysqli_query($con,"update tb_dashboard_image set Status='0'");
					mysqli_query($con,"update tb_dashboard_image set Image='".date("YmdHis").$nama."',
					Status='$SelectStatus',UpdatedBy='$username',UpdatedDate='$createddate',
					UpdatedHostName='$ip : $hostname' WHERE KDDashboardImage='".$_GET['id']."'");
				}
			}
			else{
				mysqli_query($con,"update tb_dashboard_image set Status='0'");
				mysqli_query($con,"update tb_dashboard_image set Status='$SelectStatus',
				UpdatedBy='$username',UpdatedDate='$createddate',
				UpdatedHostName='$ip : $hostname' WHERE KDDashboardImage='".$_GET['id']."'");
			}
			
			$message = "Data successfully Update to database";
			echo "<script type='text/javascript'>alert('$message');</script>";
			echo"<script>  window.location='../dist/index.php?button=dashboard-image'; </script>";
			}	}
		//End CRUD----------------------------------------------------------------------
		?>
		
		<div class="form-row"> 
			
          <div class="col-md-9"> 
            <div class="form-group"> 
            <label class="small mb-1" for="inputFirstName">Dashboard Image (.JPG,.PNG,.JPEG)</label>
              <input type="file" name="inputImage" id="inputImage"> <br>
			  <img height="100" width="150" title= 	"Image" 
			  src="<?php if (!empty($tampildata['Image'])) { echo "../img/".$tampildata['Image'];} ?>">
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
		<a class="btn btn-primary" href="../dist/index.php?button=dashboard-image">Back</a> 
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
