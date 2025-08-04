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
      <h3 class="mt-4"><?php if ($button=="add-work-flow-menu") {echo "Add Work Flow Menu";} else  {echo "Edit Work Flow Menu";} ?></h3>
	    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="../dist/index.php?button=dashboard">Dashboard</a></li>
		<li class="breadcrumb-item"><a href="../dist/index.php?button=cowork-flow-menu">Work Flow Menu</a></li>
        <li class="breadcrumb-item active"><?php if ($button=="add-work-flow-menu") {echo "Add Work Flow Menu";} else  {echo "Edit Work Flow Menu";} ?> </li>
      </ol>
 	<div class="card mb-4">
	    <div class="card-header"> </div>

        <div class="card-body"> 
			
        <?php
      	$exe =mysqli_query($con,"SELECT ID_No,WorkFlowMenu,Keterangan FROM tb_workflowmenu where WorkFlowMenu = '".@$_GET['id']."' ");
        $tampildata=mysqli_fetch_array($exe)
	  	?>
        <form action="" method="post" name="frm-Country">
          <?php 
		//Begin CRUD----------------------------------------------------------------------
		if($_POST){
		$ip=$_SERVER['REMOTE_ADDR'];
		$hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);
		date_default_timezone_set("Asia/Jakarta");
		$createddate=date("Y-m-d H:i:s");
		$tempID_No			= $_POST['tempID_No'];
		$inputWorkFlowMenu 	= @$_POST['inputWorkFlowMenu']; 
		$inputDescrioption 	= @$_POST['inputDescrioption'];
		if($inputWorkFlowMenu==""){  
			echo "<div class='form-group has-error'>
			<label class='control-label' for='inputError'>Work Flow Menu Can not be empty *</label></div>"; }
		elseif($button=="add-work-flow-menu"){ 
			$Tanya = mysqli_query($con,"SELECT WorkFlowMenu FROM tb_workflowmenu 
			WHERE WorkFlowMenu='$inputWorkFlowMenu' ");
			if (mysqli_num_rows($Tanya) !=0 ) {  
				echo "<div class='form-group has-error'>
				<label class='control-label' for='inputError'>Error Save : work flow menu already exists in the database *</label></div>";}
			else{
				//membuat Query untuk menyimpan data
				mysqli_query($con,"Insert INTO tb_workflowmenu (WorkFlowMenu,Keterangan,CreatedBy,CreatedDate,CreatedHostName) values 
				('$inputWorkFlowMenu','$inputDescrioption','$username','$createddate','$ip : $hostname')");
					
				echo "<div class='alert alert-success alert-diszmissable'> 
				<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
				Data successfully save to database. <a href='../dist/index.php?button=work-flow-menu' class='alert-link'>Work Flow Menu</a>. </div>";
				$inputWorkFlowMenu =""; 
				$inputDescrioption ="";
				}
			}
		elseif($button=="edit-work-flow-menu"){ 
			//membuat Query untuk update data
			mysqli_query($con,"update tb_workflowmenu set WorkFlowMenu='$inputWorkFlowMenu',Keterangan='$inputDescrioption',
			UpdatedBy='$username',UpdatedDate='$createddate',UpdatedHostName='$ip : $hostname' WHERE ID_No='$tempID_No'");
			
			$message = "Data successfully Update to database";
			echo "<script type='text/javascript'>alert('$message');</script>";
			echo"<script>  window.location='../dist/index.php?button=work-flow-menu'; </script>";
			}
		}
		//End CRUD----------------------------------------------------------------------
		?>
		
		<div class="form-row"> 
			
          <div class="col-md-3"> 
            <div class="form-group"> 
              <label class="small mb-1" for="inputFirstName">Work Flow Menu</label>
              <input name="tempID_No" type="hidden" value="<?php echo $tampildata['ID_No']; ?>">
              <input type="text" class="form-control py-4"  name="inputWorkFlowMenu" maxlength="50" 
			placeholder="Enter Work Flow Menu" value="<?php echo @$tampildata['WorkFlowMenu']; ?>" />
            </div>
          </div>
					  
			
          <div class="col-md-6"> </div>
       	</div>
		<div class="form-group"> 
            <label class="small mb-1" for="inputEmailAddress">Descrioption</label>
			
        <textarea cols="4"  name="inputDescrioption" maxlength="100" class="form-control py-4" 
		placeholder="Enter Descrioption"><?php echo @$tampildata['Keterangan']; ?></textarea>

        </div>
		<button type="submit" class="btn btn-primary"><?php if ($button=="add-work-flow-menu") {echo "Save";} else  {echo "Edit";} ?></button>		
		<a class="btn btn-primary" href="../dist/index.php?button=work-flow-menu">Back</a> 
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
    </body>
</html>
