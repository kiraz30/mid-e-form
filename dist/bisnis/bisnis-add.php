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
      <h1 class="mt-4"><?php if ($button=="add-bisnis") {echo "Add Bisnis";} else  {echo "Edit Bisnis";} ?></h1>
	    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="../dist/index.php?button=dashboard">Dashboard</a></li>
		<li class="breadcrumb-item"><a href="../dist/index.php?button=bisnis">Bisnis</a></li>
        <li class="breadcrumb-item active"><?php if ($button=="add-bisnis") {echo "Add Bisnis";} else  {echo "Edit Bisnis";} ?> </li>
      </ol>
 	<div class="card mb-4">
	    <div class="card-header"> </div>

        <div class="card-body"> 
			
        <?php
      	$exe =mysqli_query($con,"SELECT KDBisnis,NamaBisnis,Keterangan,Status FROM tb_bisnis
		 where KDBisnis = '".@$_GET['id']."'");
        $tampildata=mysqli_fetch_array($exe)
	  	?>
        <form action="" method="post" name="frm-Bisnis">
          <?php 
		//Begin CRUD----------------------------------------------------------------------
		if($_POST){
		$ip=$_SERVER['REMOTE_ADDR'];
		$hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);
		date_default_timezone_set("Asia/Jakarta");
		$createddate=date("Y-m-d H:i:s");
    	$tempBisnisCode  	= $_POST['tempBisnisCode'];
		$inputBisnisCode 	= $_POST['inputBisnisCode']; 
		$inputNamaBisnis 	= @$_POST['inputNamaBisnis']; 
		$inputDescrioption 	= @$_POST['inputDescrioption'];
		$SelectStatus		= $_POST['SelectStatus'];
		if($inputBisnisCode==""){  
			echo "<div class='form-group has-error'>
			<label class='control-label' for='inputError'>Bisnis Code Can not be empty *</label></div>"; }
		elseif($inputNamaBisnis==""){  
			echo "<div class='form-group has-error'>
			<label class='control-label' for='inputError'>Bisnis Nama Can not be empty *</label></div>"; }
		elseif($button=="add-bisnis"){ 
			$Tanya = mysqli_query($con,"SELECT KDBisnis,NamaBisnis FROM tb_bisnis 
			WHERE KDBisnis = '$inputBisnisCode' OR NamaBisnis='$inputNamaBisnis' ");
			if (mysqli_num_rows($Tanya) !=0 ) {  
				echo "<div class='form-group has-error'>
				<label class='control-label' for='inputError'>Error Save : Bisnis already exists in the database *</label></div>";}
			else{
				//membuat Query untuk menyimpan data
				mysqli_query($con,"Insert INTO tb_bisnis (KDBisnis,NamaBisnis,Keterangan,Status,CreatedBy,CreatedDate,CreatedHostName) values 
				('$inputBisnisCode','$inputNamaBisnis','$inputDescrioption','$SelectStatus','$username','$createddate','$ip : $hostname')");
					
				echo "<div class='alert alert-success alert-diszmissable'> 
				<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
				Data successfully save to database. <a href='../dist/index.php?button=bisnis' class='alert-link'>Bisnis</a>. </div>";
				$inputBisnisCode 	="";
				$inputNamaBisnis 	=""; 
				$inputDescrioption 	="";
				$SelectStatus		="";
				}
			}
		elseif($button=="edit-bisnis"){ 
			//membuat Query untuk update data
			mysqli_query($con,"update tb_bisnis set NamaBisnis='$inputNamaBisnis',Keterangan='$inputDescrioption',
			Status='$SelectStatus',UpdatedBy='$username',UpdatedDate='$createddate',UpdatedHostName='$ip : $hostname' WHERE KDBisnis='$tempBisnisCode'");
			
			$message = "Data successfully Update to database";
			echo "<script type='text/javascript'>alert('$message');</script>";
			echo"<script>  window.location='../dist/index.php?button=bisnis'; </script>";
			}
		}
		//End CRUD----------------------------------------------------------------------
		?>
		
		<div class="form-row"> 
			
          <div class="col-md-3"> 
            <div class="form-group"> 
              <label class="small mb-1" for="inputFirstNama">Bisnis Code</label>
              <input name="tempBisnisCode" type="hidden" value="<?php echo $tampildata['KDBisnis']; ?>">
              <input class="form-control py-4" name="inputBisnisCode"  maxlength="20" type="text" 
			  placeholder="Enter Bisnis Code" value="<?php if($_POST) {echo $inputBisnisCode;} else { echo $tampildata['KDBisnis'];} ?>" />
            </div>
          </div>
					  
			
          <div class="col-md-6"> 
            <div class="form-group"> 
              <label class="small mb-1" for="inputLastNama">Bisnis Name</label>
              <input type="text" class="form-control py-4" name="inputNamaBisnis" maxlength="50" 
			placeholder="Enter Bisnis Nama" value="<?php if($_POST) {echo $inputNamaBisnis;} else {echo $tampildata['NamaBisnis'];} ?>" />
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
					  
			
          <div class="col-md-2"> 
            <div class="form-group"> 
			 <label class="small mb-1" for="inputFirstNama">Status</label>
              <select class="form-control" name="SelectStatus" >
              	<option value="1" <?php if (@$tampildata['Status']=='1') {echo "Selected"; }?>>Active </option>
            	<option value="0" <?php if (@$tampildata['Status']=='0') {echo "Selected";} ?>>Non Active</option>
              </select>
            </div>
          </div>
       	</div>
		<button type="submit" class="btn btn-primary" onClick="return checkSave()" >Save</button>		
		<a class="btn btn-primary" href="../dist/index.php?button=bisnis">Back</a> 
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
