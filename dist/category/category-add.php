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
      <h1 class="mt-4"><?php if ($button=="add-category") {echo "Add Category";} else  {echo "Edit Category";} ?></h1>
	    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="../dist/index.php?button=dashboard">Dashboard</a></li>
		<li class="breadcrumb-item"><a href="../dist/index.php?button=category">Category</a></li>
        <li class="breadcrumb-item active"><?php if ($button=="add-category") {echo "Add Category";} else  {echo "Edit Category";} ?> </li>
      </ol>
 	<div class="card mb-4">
	    <div class="card-header"> </div>

        <div class="card-body"> 
			
        <?php
      	$exe =mysqli_query($con,"SELECT No_ID,Bisnis,KDCategory,NamaCategory,Keterangan,Status FROM tb_category
		 where KDCategory = '".@$_GET['id']."'");
        $tampildata=mysqli_fetch_array($exe)
	  	?>
        <form action="" method="post" name="frm-Type">
          <?php 
		//Begin CRUD----------------------------------------------------------------------
		if($_POST){
		$ip=$_SERVER['REMOTE_ADDR'];
		$hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);
		date_default_timezone_set("Asia/Jakarta");
		$createddate=date("Y-m-d H:i:s");
    	$tempCategoryCode  	= $_POST['tempCategoryCode'];
		$inputBisnis		= @$_POST['inputBisnis']; 
		$inputCategoryCode	= @$_POST['inputCategoryCode']; 
		$inputNamaCategory 	= @$_POST['inputNamaCategory']; 
		$inputDescrioption 	= @$_POST['inputDescrioption'];
		$SelectStatus		= $_POST['SelectStatus'];
		if($inputNamaCategory==""){  
			echo "<div class='form-group has-error'>
			<label class='control-label' for='inputError'>Category Can not be empty *</label></div>"; }
		elseif($button=="add-category"){ 
			$Tanya = mysqli_query($con,"SELECT KDCategory,NamaCategory FROM tb_category 
			WHERE KDCategory ='$inputCategoryCode' And NamaCategory='$inputNamaCategory' ");
			if (mysqli_num_rows($Tanya) !=0 ) {  
				echo "<div class='form-group has-error'>
				<label class='control-label' for='inputError'>Error Save : Category already exists in the database *</label></div>";}
			else{
				//membuat Query untuk menyimpan data
				mysqli_query($con,"Insert INTO tb_category (KDCategory,NamaCategory,Keterangan,Status,CreatedBy,CreatedDate,CreatedHostName) values 
				('$inputCategoryCode','$inputNamaCategory','$inputDescrioption',
				'$SelectStatus','$username','$createddate','$ip : $hostname')");
					
				echo "<div class='alert alert-success alert-diszmissable'> 
				<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
				Data successfully save to database. <a href='../dist/index.php?button=category' class='alert-link'>Category</a>. </div>";
				$inputNamaCategory 	=""; 
				$inputDescrioption 	="";
				$SelectStatus		="";
				}
			}
		elseif($button=="edit-type"){ 
			//membuat Query untuk update data
			mysqli_query($con,"update tb_category set NamaCategory='$inputNamaCategory',Keterangan='$inputDescrioption',
			Status='$SelectStatus',UpdatedBy='$username',UpdatedDate='$createddate',UpdatedHostName='$ip : $hostname'
			WHERE KDCategory='$tempCategoryCode'");
			
			$message = "Data successfully Update to database";
			echo "<script type='text/javascript'>alert('$message');</script>";
			echo"<script>  window.location='../dist/index.php?button=category'; </script>";
			}
		}
		//End CRUD----------------------------------------------------------------------
		?>
		
		<div class="form-row"> 
				  
			<div class="col-md-3"> 
			<div class="form-group"> 
			 <label class="small mb-1" for="inputFirstNama">Bisnis</label>
               <select class="form-control" id="InputBisnis" name="InputBisnis" >
					<option value="-" >Select Bisnis</option>
					<?php
			  			$exe = mysqli_query($con," SELECT KDBisnis,NamaBisnis from tb_bisnis Where Status='1' " );
						while(@$row =mysqli_fetch_array($exe)){
							if($tampildata['Bisnis'] == $row['KDBisnis']){
								$cek = 'Selected';
							}elseif($inputBisnis == $row['KDBisnis']){
								$cek = 'Selected';
							}else{
								$cek = '';
							}
							echo"<option value='".$row['NamaBisnis']."' $cek>".$row['NamaBisnis']."</option>";
						}
					?>
			  </select>
            </div>
			</div>
			<div class="col-md-4">
            <div class="form-group"> 
              <label class="small mb-1" for="inputFirstNama">Category Code</label>
              <input name="tempCategoryCode" type="hidden" value="<?php echo $tampildata['No_ID']; ?>">
              <input class="form-control py-4" name="inputCategoryCode"  maxlength="20" type="text" 
			  placeholder="Enter Category Code" value="<?php if($_POST) {echo $inputCategoryCode;} else { echo $tampildata['KDCategory'];} ?>" />
            </div>
          </div>
		  
          <div class="col-md-7"> 
            <div class="form-group"> 
              <label class="small mb-1" for="inputLastNama">Category Name</label>
			  <input name="tempCategoryCode" type="hidden" value="<?php echo $tampildata['KDCategory']; ?>">
              <input type="text" class="form-control py-4" id="inputNamaCategory" name="inputNamaCategory" maxlength="50" 
			placeholder="Enter Type Name" value="<?php if($_POST) {echo $inputNamaCategory;} else {echo $tampildata['NamaCategory'];} ?>" />
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
		<a class="btn btn-primary" href="../dist/index.php?button=category">Back</a> 
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
