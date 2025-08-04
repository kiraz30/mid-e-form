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
      <h3 class="mt-4"><?php if ($button=="add-format-no-req") {echo "Add Format Request No";} else  {echo "Edit Format Request No";} ?></h3>
	    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="../dist/index.php?button=dashboard">Dashboard</a></li>
		<li class="breadcrumb-item"><a href="../dist/index.php?button=format-no-req">Format Request No</a></li>
        <li class="breadcrumb-item active"><?php if ($button=="add-format-no-req") {echo "Add Format Request No ";} else  {echo "Edit Format Request No";} ?> </li>
      </ol>
 	<div class="card mb-4">
	    <div class="card-header"> </div>

        <div class="card-body"> 
			
        <?php
      	$exe =mysqli_query($con,"SELECT ID_No,WorkFlowMenu,Request_No,Keterangan FROM tb_format_req_no where ID_No = '".@$_GET['id']."' ");
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
    	$tempFormatNoRequest  	= @$_POST['tempFormatNoRequest'];
		$inputFormatNoRequest 	= @$_POST['inputFormatNoRequest']; 
		$SelectWorkFlowMenu 	= @$_POST['SelectWorkFlowMenu'];
		$inputDescrioption 		= @$_POST['inputDescrioption'];
		if($inputFormatNoRequest==""){  
			echo "<div class='form-group has-error'>
			<label class='control-label' for='inputError'>Request No Can not be empty *</label></div>"; }
		
		elseif($button=="add-format-no-req"){ 
			$Tanya = mysqli_query($con,"SELECT Request_No FROM tb_format_req_no 
								WHERE Request_No = '$inputFormatNoRequest' OR WorkFlowMenu = '$SelectWorkFlowMenu' ");
			if (mysqli_num_rows($Tanya) !=0 ) {  
				echo "<div class='form-group has-error'>
				<label class='control-label' for='inputError'>Error Save : Request No Or Work Flow Menu already exists in the database *</label></div>";}
			else{
				//membuat Query untuk menyimpan data
				mysqli_query($con,"Insert INTO tb_format_req_no (WorkFlowMenu,Request_No,Keterangan,CreatedBy,CreatedDate,CreatedHostName) values 
				('$SelectWorkFlowMenu','$inputFormatNoRequest','$inputDescrioption','$username','$createddate','$ip : $hostname')");
					
				echo "<div class='alert alert-success alert-diszmissable'> 
				<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
				Data successfully save to database. <a href='../dist/index.php?button=format-no-req' class='alert-link'>Format Request No</a>. </div>";
				$tempFormatNoRequest 	= "";
				$inputFormatNoRequest 	= "";  
				$inputDescrioption 		="";
				}
			}
		elseif($button=="edit-format-no-req"){ 
			//membuat Query untuk update data
			mysqli_query($con,"update tb_format_req_no set Request_No='$inputFormatNoRequest',
			Keterangan='$inputDescrioption',UpdatedBy='$username',UpdatedDate='$createddate',UpdatedHostName='$ip : $hostname' 
			WHERE ID_No='$tempFormatNoRequest'");
			
			$message = "Data successfully Update to database";
			echo "<script type='text/javascript'>alert('$message');</script>";
			echo"<script>  window.location='../dist/index.php?button=format-no-req'; </script>";
			}
		}
		//End CRUD----------------------------------------------------------------------
		?>
		
		<div class="form-row"> 
			
          <div class="col-md-3"> 
            <div class="form-group"> 
              <label class="small mb-1" for="inputFirstName">Request No</label>
              <input name="tempFormatNoRequest" type="hidden" value="<?php echo $tampildata['ID_No']; ?>">
              <input class="form-control py-20" name="inputFormatNoRequest"  maxlength="4" type="text" 
			  placeholder="Enter Request No" value="<?php if ($_POST) { echo $inputFormatNoRequest; } else {echo @$tampildata['Request_No'];} ?>" />
            </div>
          </div>
					  
			
          <div class="col-md-6"> 
            <div class="form-group"> 
              <label class="small mb-1" for="inputWorkFlowMenu">Work Flow Menu</label>
				<select class="form-control" id="SelectWorkFlowMenu" name="SelectWorkFlowMenu" onChange="selectedvalue()" <?php if ($button=="edit-format-no-req") {echo "disabled";} ?> >
					<option value="-" >Select Work Flow Menu</option>
					<?php
						$div = mysqli_query($con,"SELECT WorkFlowMenu FROM tb_workflowmenu ");
						while($b = mysqli_fetch_array($div)){
							if(@$tampildata['WorkFlowMenu'] == $b['WorkFlowMenu']){
								$cek = 'Selected';
							}elseif($SelectWorkFlowMenu == $b['WorkFlowMenu']){
								$cek = 'Selected';
							}else{
								$cek = '';
							}
							echo"<option value='".$b['WorkFlowMenu']."' $cek>".$b['WorkFlowMenu']."</option>";
						}
					?>
				  </select>
            </div>
          </div>
       	</div>
		<div class="form-group"> 
            <label class="small mb-1" for="inputEmailAddress">Descrioption</label>
			
        <textarea cols="4"  name="inputDescrioption" maxlength="100" class="form-control py-4" 
		placeholder="Enter Descrioption"><?php if ($_POST) { echo $inputFormatNoRequest; } else {echo @$tampildata['Keterangan'];} ?></textarea>

        </div>
		<button type="submit" 
		<?php if ($button=="add-format-no-req") {echo 'onclick="return checkSave()"';} else  {echo 'onclick="return checkEdit()"';} ?>  
		class="btn btn-primary" >Save</button>		
		<a class="btn btn-primary" href="../dist/index.php?button=format-no-req" title="Back Format No Request">Back</a> 
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
	
	<script language="JavaScript" type="text/javascript">
	function checkEdit(){
		return confirm('Are you sure you want to Edit this data?');
	}
	function checkSave(){
		return confirm('Are you sure you want to Save this data?');
	}
	</script>
    <!-- Page-Level Demo Scripts - Tables - Use for reference -->

    </body>
</html>
