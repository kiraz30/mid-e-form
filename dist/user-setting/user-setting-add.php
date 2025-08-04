<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Static Navigation - SB Admin</title>
        <!--link href="../../css/styles.css" rel="stylesheet" /-->
		<!-- Bootstrap Core CSS -->
		<link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	
		<!-- MetisMenu CSS -->
		<link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
	
		<!-- Custom CSS -->
		<!--link href="../css/sb-admin-2.css" rel="stylesheet"-->
	
		<!-- Custom Fonts -->
		<link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    </head>
	<main> 
    <div class="container-fluid"> 
      <h3 class="mt-4"><?php if ($button=="add-user-setting") {echo "Add User Setting";} else  {echo "Edit User Setting";} ?> </h3>
	    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="../dist/index.php?button=dashboard">Dashboard</a></li>
		<li class="breadcrumb-item"><a href="../dist/index.php?button=user-setting">User Setting</a></li>
        <li class="breadcrumb-item active"><?php if ($button=="add-user-setting") {echo "Add User Setting";} else  {echo "Edit User Setting";} ?> </li>
      </ol>
 	<div class="card mb-4">
	    <div class="card-header"> </div>
        <div class="card-body">
        <?php
      	$exe =mysqli_query($con,"SELECT UserDomain,Name,Email,KDDivision,KDPosition,StatusUser,SignIN,`Level` FROM tb_user where UserDomain = '".@$_GET['id']."' ");
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
    	$tempUserDomain  	= $_POST['tempUserDomain'];
		$inputUserDomain 	= $_POST['inputUserDomain']; 
		$inputName 			= $_POST['inputName']; 
		$InputDivision 		= $_POST['InputDivision'];
		$InputPosition 		= $_POST['InputPosition'];
		$inputEmail 		= $_POST['inputEmail'];
		$StatusUser 		= $_POST['StatusUser'];
		$SelectLevel 		= $_POST['SelectLevel'];

		$uploadDir 			= "Sign/";
		$ekstensi_diperbolehkan	= array('png','jpg','JPEG');
		$nama 				= $_FILES['inputSign']['name'];
		$x 					= explode('.', $nama);
		$ekstensi 			= strtolower(end($x));
		$ukuran				= $_FILES['inputSign']['size'];
		$file_tmp 			= $_FILES['inputSign']['tmp_name'];			
		$fotolama 			= @$tampildata['SignIN'];	
	
		if($inputUserDomain==""){  
			echo "<div class='form-group has-error'>
			<label class='control-label' for='inputError'> User Domain Can not be empty *</label></div>"; }
		elseif($inputName==""){  
			echo "<div class='form-group has-error'>
			<label class='control-label' for='inputError'>Name Can not be empty *</label></div>"; }
		elseif($InputDivision=="" || $InputDivision=="-"){  
			echo "<div class='form-group has-error'>
			<label class='control-label' for='inputError'>Division Can not be empty *</label></div>"; }
		elseif($InputPosition=="" || $InputPosition=="-"){  
			echo "<div class='form-group has-error'>
			<label class='control-label' for='inputError'>Position Can not be empty *</label></div>"; }
		elseif($inputEmail=="" || $inputEmail=="-"){  
			echo "<div class='form-group has-error'>
			<label class='control-label' for='inputError'>Email Can not be empty *</label></div>"; }
			
		/* Check file size
		elseif (!empty($_FILES['inputSign']['name'])) { 
			
		}
		*/
		elseif($button=="add-user-setting"){ 
			$Tanya = mysqli_query($con,"SELECT UserDomain FROM tb_user WHERE UserDomain = '$inputUserDomain'  ");
			if (mysqli_num_rows($Tanya) !=0 ) {
			  
			//Simpan Akses Penghuni
			/*
			$caripenghuni =mysqli_query($con,"Select UserDomain FROM tb_user  ");
			while($caridatapenghuni =mysqli_fetch_array(@$caripenghuni)){
				$cari =mysqli_query($con,"Select Module,TitleName,Status FROM tb_privilage Where Module= 'cfm'");
				while($caridata =mysqli_fetch_array(@$cari)){
					mysqli_query($con,"Insert INTO tb_user_privilage (UserDomain,Module,Status) 
					values ('$caridatapenghuni[UserDomain]','$caridata[Module]','$caridata[Status]')");
				}
			}
			*/
				echo "<div class='form-group has-error'>
				<label class='control-label' for='inputError'>Error Save : User Domain already exists in the database *</label></div>";}
			else{
				//membuat Query untuk menyimpan data
				if (!empty($_FILES['inputSign']['name'])) { 
					if($_FILES['inputSign']['size'] > 1000000){	
						echo "<div class='form-group has-error'>
						<label class='control-label' for='inputError'>Sorry, your file is too large.</label></div>"; }
					elseif(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
						move_uploaded_file($file_tmp, $uploadDir.date("YmdHis").$nama);
						mysqli_query($con,"Insert INTO tb_user (UserDomain,Name,Email,KDDivision,KDPosition,SignIN,StatusUser,
						Level,CreatedBy,CreatedDate,CreatedHostName) 
						values ('$inputUserDomain','$inputName','$inputEmail','$InputDivision',
						'$InputPosition','".date("YmdHis").$nama."','$StatusUser','$SelectLevel','$username','$createddate','$ip : $hostname')");
						
						//Simpan USER Privilage
						$cari =mysqli_query($con,"Select Module,TitleName,Status FROM tb_privilage");
						while($caridata =mysqli_fetch_array(@$cari)){
							mysqli_query($con,"Insert INTO tb_user_privilage (UserDomain,Module,Status) 
							values ('$inputUserDomain','$caridata[Module]','$caridata[Status]')");
						}
						echo "<div class='alert alert-success alert-diszmissable'> 
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
						Data successfully save to database. <a href='../dist/index.php?button=user-setting' class='alert-link'>User Setting</a>. </div>";}
					else{
						echo "<div class='form-group has-error'>
						<label class='control-label' for='inputError'>Error Save : File type not jpg or png *</label></div>";
					}
				}else{
					mysqli_query($con,"Insert INTO tb_user (UserDomain,Name,Email,KDDivision,KDPosition,StatusUser,
					Level,CreatedBy,CreatedDate,CreatedHostName) values ('$inputUserDomain','$inputName','$inputEmail','$InputDivision',
					'$InputPosition','$StatusUser','$SelectLevel','$username','$createddate','$ip : $hostname')");
						
					//Simpan USER Privilage
					$cari =mysqli_query($con,"Select Module,TitleName,Status FROM tb_privilage");
					while($caridata =mysqli_fetch_array(@$cari)){
						mysqli_query($con,"Insert INTO tb_user_privilage (UserDomain,Module,Status) values ('$inputUserDomain','$caridata[Module]','$caridata[Status]')");
					}
					echo "<div class='alert alert-success alert-diszmissable'> 
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
					Data successfully save to database. <a href='../dist/index.php?button=user-setting' class='alert-link'>User Setting</a>. </div>";
					$inputUserDomain 	= $_POST['inputUserDomain']; 
					$inputName 			= ""; 
					$InputDivision 		= "";
					$InputPosition 		= "";
					$inputEmail 		= "";
				}
			}
		}
		elseif($button=="edit-user-setting"){ 
			//membuat Query untuk update data
			if (!empty($_FILES['inputSign']['name'])) {
				if($_FILES['inputSign']['size'] > 1000000){	
					echo "<div class='form-group has-error'>
					<label class='control-label' for='inputError'>Sorry, your file is too large.</label></div>"; }
				elseif(in_array($ekstensi, $ekstensi_diperbolehkan) === true){ 
					unlink($uploadDir.$fotolama);
					move_uploaded_file($file_tmp, $uploadDir.date("YmdHis").$nama);
					mysqli_query($con,"update tb_user set UserDomain='$inputUserDomain',Name='$inputName',Email='$inputEmail',KDDivision='$InputDivision',
					KDPosition='$InputPosition',SignIN='".date("YmdHis").$nama."',StatusUser='$StatusUser',Level='$SelectLevel',UpdatedBy='$username',UpdatedDate='$createddate',
					UpdatedHostName='$ip : $hostname' WHERE UserDomain='$tempUserDomain'");
				}
			}
			else{
				mysqli_query($con,"update tb_user set UserDomain='$inputUserDomain',Name='$inputName',Email='$inputEmail',KDDivision='$InputDivision',
				KDPosition='$InputPosition',StatusUser='$StatusUser',Level='$SelectLevel',
				UpdatedBy='$username',UpdatedDate='$createddate',
				UpdatedHostName='$ip : $hostname' WHERE UserDomain='$tempUserDomain'");
			}
			$message = "Data successfully Update to database";
			echo "<script type='text/javascript'>alert('$message');</script>";
			echo"<script>  window.location='../dist/index.php?button=user-setting'; </script>";
			
			}
		}
		//End CRUD----------------------------------------------------------------------
		?>
 
        <div class="form-row"> 
			
          <div class="col-md-3"> 
            <div class="form-group"> 
              <label class="small mb-1" for="inputFirstName">User Domain *</label>
              <input name="tempUserDomain" type="hidden" value="<?php echo $tampildata['UserDomain']; ?>">
              <input class="form-control py-4" name="inputUserDomain" type="text" 
				placeholder="Enter User Domain" value="<?php if($_POST){ echo $inputUserDomain;}else{echo @$tampildata['UserDomain'];} ?>" />
            </div>
          </div>
			
          <div class="col-md-3"> </div>
			
          <div class="col-md-6"> 
            <div class="form-group"> 
              <label class="small mb-1" for="inputLastName">Name *</label>
              <input class="form-control py-4" name="inputName" type="text" 
				placeholder="Enter Name" value="<?php if($_POST){ echo $inputName;}else{echo @$tampildata['Name'];} ?>" />
            </div>
          </div>
        </div>

        <div class="form-row"> 
			
          <div class="col-md-4"> 
            <div class="form-group"> 
              <label class="small mb-1" for="inputLastName">Division *</label>
              <select class="form-control" name="InputDivision" >
                <option value="-" >Select Division</option>
                <?php
					$div = mysqli_query($con,"SELECT KDDivision,DivisionName FROM tb_Division  Where Status=1  ");
					while($b = mysqli_fetch_array($div)){
						if($tampildata['KDDivision'] == $b['KDDivision']){
							$cek = 'Selected';
						}elseif($InputDivision == $b['KDDivision']){
							$cek = 'Selected';
						}else{
							$cek = '';
						}
						echo"<option value='".$b['KDDivision']."' $cek>".$b['DivisionName']."</option>";
					}
				?>
              </select>
            </div>
          </div>
			
			
          <div class="col-md-2"> </div>
					  
			
          <div class="col-md-4"> 
            <div class="form-group"> 
              <label class="small mb-1" for="inputLastName">Position *</label>
              <select class="form-control" name="InputPosition">
                <option value="-" >Select Position</option>
                <?php
					$div = mysqli_query($con,"SELECT KDPosition,PositionName FROM tb_Position Where Status=1 ");
					while($b = mysqli_fetch_array($div)){
						if($tampildata['KDPosition'] == $b['KDPosition']){
							$cek = 'Selected';
						}elseif($InputPosition == $b['KDPosition']){
							$cek = 'Selected';
						}else{
							$cek = '';
						}
						echo"<option value='".$b['KDPosition']."' $cek>".$b['PositionName']."</option>";
					}
				?>
              </select>
            </div>
          </div>
        </div>

        <div class="form-row"> 
 
			
          <div class="col-md-4"> 
            <div class="form-group"> 
              <label class="small mb-1" for="inputFirstName">Email *</label>
              <input class="form-control py-4" name="inputEmail" type="email" aria-describedby="emailHelp" 
				placeholder="Enter Email :example@mandom.co.id" value="<?php if($_POST){ echo $inputEmail;}else{ echo @$tampildata['Email'];} ?>" />
            </div>
          </div>
		  <div class="col-md-2"> </div>
		  <div class="col-md-6"> 
            <div class="form-group"> 
              <label class="small mb-1" for="inputFirstName">Sign Picture (.JPG,.PNG,.JPEG)</label>
              <input type="file" name="inputSign" id="inputSign">
            </div>
          </div>
        </div>

        <div class="form-row"> 
 
			
          <div class="col-md-2"> 
            <div class="form-group"> 
              <label class="small mb-1" for="inputFirstName">Status *</label>
              <select class="form-control" name="StatusUser" >
				<option value="1" <?php if (@$tampildata['StatusUser']=='1') {echo "Selected"; }?>>Active </option>
            	<option value="0" <?php if (@$tampildata['StatusUser']=='0') {echo "Selected";} ?>>Non Active</option>
              </select>
            </div>
          </div>
		  <div class="col-md-2"> <label class="small mb-1" for="inputFirstName">Level</label>
              <select class="form-control" name="SelectLevel" >
				<option value="ADMINISTRATOR" <?php if (@$tampildata['Level']=='ADMINISTRATOR') {echo "Selected"; }?>>ADMINISTRATOR</option>
            	<option value="USER" <?php if (@$tampildata['Level']=='USER') {echo "Selected";} ?>>USER</option>
              </select>
		  </div>
		  <div class="col-md-2"> </div>
		  <div class="col-md-2"> 
            <div class="form-group"> <img height="100" width="90" title="Signature"
			src="<?php if (empty($tampildata['SignIN'])){ echo"Sign/signature.png";} else { echo "Sign/".$tampildata['SignIN'];} ?>">
            </div>
          </div>
        </div>
		<button type="submit" class="btn btn-primary">Save</button>		
			<a class="btn btn-primary" href="../dist/index.php?button=user-setting">Back</a> 
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

    </body>
</html>
