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
      <h3 class="mt-4"><?php if ($button=="add-trading-partner") {echo "Add Trading Partner";} else  {echo "Edit Trading Partner";} ?></h3>
	    <ol class="breadcrumb mb-2">
        <li class="breadcrumb-item"><a href="../dist/index.php?button=dashboard">Dashboard</a></li>
		<li class="breadcrumb-item"><a href="../dist/index.php?button=trading-partner">Trading Partner</a></li>
        <li class="breadcrumb-item active"><?php if ($button=="add-trading-partner") {echo "Add Trading Partner";} else  {echo "Edit Trading Partner";} ?> </li>
      </ol>
 	<div class="card mb-4">
	    <div class="card-header"> </div>

        <div class="card-body"> 
			
        <?php
      	$exe =mysqli_query($con,"SELECT CustomerCode,Marketing_Company,KDCurrency,FOB_CF_CIF,Country,Suffic,Item_Code,Keterangan,Status FROM tb_trading_partner where CustomerCode = '".@$_GET['id']."' ");
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
		$tempCustomerCode	  	= $_POST['tempCustomerCode'];
    	$inputCustomerCode  	= $_POST['inputCustomerCode'];
		$inputMarketingCompany 	= $_POST['inputMarketingCompany'];
		$inputFOB_CF_CIF 		= $_POST['inputFOB_CF_CIF'];
		$inputCountry	 		= $_POST['inputCountry'];
		$inputSuffic	 		= $_POST['inputSuffic'];
		$inputItem_Code	 		= $_POST['inputItem_Code'];
		$inputCurrency			= $_POST['inputCurrency'];
		$inputDescrioption	 	= $_POST['inputDescrioption'];
		$SelectStatus 			= $_POST['SelectStatus'];

		if($inputCustomerCode==""){  
			echo "<div class='form-group has-error'>
			<label class='control-label' for='inputError'>Customer Code Can not be empty *</label></div>"; }
		elseif($inputMarketingCompany==""){  
			echo "<div class='form-group has-error'>
			<label class='control-label' for='inputError'>Marketing Company Can not be empty *</label></div>"; }
		elseif($inputFOB_CF_CIF==""){  
			echo "<div class='form-group has-error'>
			<label class='control-label' for='inputError'>FOB, C&F, CIF Can not be empty *</label></div>"; }
		elseif($inputCountry==""){  
			echo "<div class='form-group has-error'>
			<label class='control-label' for='inputError'>Country Can not be empty *</label></div>"; }
		elseif($inputCurrency==""){  
			echo "<div class='form-group has-error'>
			<label class='control-label' for='inputError'>Currency Can not be empty *</label></div>"; }
		elseif($inputSuffic==""){  
			echo "<div class='form-group has-error'>
			<label class='control-label' for='inputError'>Suffic Can not be empty *</label></div>"; }
		elseif($inputItem_Code==""){  
			echo "<div class='form-group has-error'>
			<label class='control-label' for='inputError'>Item Code Can not be empty *</label></div>"; }

		elseif($button=="add-trading-partner"){ 
			$Tanya = mysqli_query($con,"SELECT CustomerCode,CustomerCode FROM tb_trading_partner 
			WHERE CustomerCode = '$inputCustomerCode' ");
			if (mysqli_num_rows($Tanya) !=0 ) {  
				echo "<div class='form-group has-error'>
				<label class='control-label' for='inputError'>Error Save : Dosage already exists in the database *</label></div>";}
			else{
				//membuat Query untuk menyimpan data
				mysqli_query($con,"Insert INTO tb_trading_partner (CustomerCode,Marketing_Company,FOB_CF_CIF,KDCurrency,Country,Suffic,Item_Code,Keterangan,
				Status,CreatedBy,CreatedDate,CreatedHostName) values('$inputCustomerCode','$inputMarketingCompany','$inputFOB_CF_CIF','$inputCurrency','$inputCountry',
				'$inputSuffic','$inputItem_Code','$inputDescrioption','$SelectStatus','$username','$createddate','$ip : $hostname')");
					
				echo "<div class='alert alert-success alert-diszmissable'> 
				<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
				Data successfully save to database. <a href='../dist/index.php?button=trading-partner' class='alert-link'>Trading Partner</a>. </div>";
				$inputCustomerCode  	="";
				$inputMarketingCompany 	= "";
				$inputFOB_CF_CIF 		= "";
				$inputCountry	 		= "";
				$inputSuffic	 		= "";
				$inputItem_Code	 		= "";
				$inputCurrency 			= "-";
				$inputDescrioption	 	= "";
				$SelectStatus 			= "";
				}
			}
		elseif($button=="edit-trading-partner"){ 
			//membuat Query untuk update data
			mysqli_query($con,"update tb_trading_partner set CustomerCode='$inputCustomerCode',Marketing_Company='$inputMarketingCompany',FOB_CF_CIF='$inputFOB_CF_CIF',
			KDCurrency='$inputCurrency',FOB_CF_CIF='$inputFOB_CF_CIF',Country='$inputCountry',Suffic='$inputSuffic',Item_Code='$inputItem_Code',
			Keterangan='$inputDescrioption',Status='$SelectStatus',UpdatedBy='$username',UpdatedDate='$createddate',UpdatedHostName='$ip : $hostname' 
			WHERE CustomerCode='$tempCustomerCode'");
			
			$message = "Data successfully Update to database";
			echo "<script type='text/javascript'>alert('$message');</script>";
			echo"<script>  window.location='../dist/index.php?button=trading-partner'; </script>";
			}
		}
		//End CRUD----------------------------------------------------------------------
		?>
		
		<div class="form-row"> 
			
          <div class="col-md-3"> 
            <div class="form-group"> 
              <label class="small mb-1" for="inputFirstName">Customer Code *</label>
              <input name="tempCustomerCode" type="hidden" value="<?php echo $tampildata['CustomerCode']; ?>">
              <input class="form-control py-4" name="inputCustomerCode"  maxlength="20" type="text" 
			  placeholder="Enter Customer Code" value="<?php if ($_POST) { echo $inputCustomerCode;} else {echo $tampildata['CustomerCode'];} ?>" />
            </div>
          </div>
					  
			
          <div class="col-md-8"> 
            <div class="form-group"> 
              <label class="small mb-1" for="inputLastName">Marketing Company *</label>
              <input type="text" class="form-control py-4"  name="inputMarketingCompany" maxlength="50" 
			placeholder="Enter Marketing Company" value="<?php if ($_POST) { echo $inputMarketingCompany;} else {echo $tampildata['Marketing_Company'];} ?>" />
            </div>
          </div>
       	</div>
		
		<div class="form-row"> 
			
			  
          <div class="col-md-3"> 
            <div class="form-group"> 
              <label class="small mb-1" for="inputEmailAddress">FOB, C&F, CIF *</label>
			  <select class="form-control" name="inputFOB_CF_CIF" >
				<option value="FOB" <?php if (@$tampildata['FOB_CF_CIF']=='1') {echo "Selected"; }?>>FOB </option>
            	<option value="C&F" <?php if (@$tampildata['FOB_CF_CIF']=='C&F') {echo "Selected";} ?>>C&F </option>
				<option value="CIF" <?php if (@$tampildata['FOB_CF_CIF']=='CIF') {echo "Selected";} ?>>CIF</option>
              </select>
            </div>
          </div>
		  
		  
			 <div class="col-md-6"> 
			  <div class="form-group"> 
				 <label class="small mb-1" for="inputFirstName">Country *</label>
				 <input type="text" class="form-control py-4"  name="inputCountry" maxlength="50" 
				placeholder="Enter Country" value="<?php if ($_POST){ echo $inputFOB_CF_CIF;} else {echo $tampildata['Country'];} ?>" />
			  </div>
			</div>
			<div class="col-md-2"> 
            <div class="form-group"> 
              <label class="small mb-1" for="inputFirstName">Currency *</label>
			   <select class="form-control" name="inputCurrency" >
                <option value="-" >Select Currency</option>
                <?php
					$div = mysqli_query($con,"SELECT KDCurrency,NamaCurrency FROM tb_currency  Where Status=1  ");
					while($b = mysqli_fetch_array($div)){
						if($tampildata['KDCurrency'] == $b['KDCurrency']){
							$cek = 'Selected';
						}elseif($inputCurrency == $b['KDCurrency']){
							$cek = 'Selected';
						}else{
							$cek = '';
						}
						echo"<option value='".$b['KDCurrency']."' $cek>".$b['NamaCurrency']."</option>";					}
				?>
              </select>
            </div>
          </div>
       	</div>
		<div class="form-row"> 
          <div class="col-md-3"> 
            <div class="form-group"> 
              <label class="small mb-1" for="inputEmailAddress">Suffic *</label>
              <input type="text" class="form-control py-4"  name="inputSuffic" maxlength="5" 
			placeholder="Enter Suffic" value="<?php if ($_POST){ echo $inputSuffic;} else {echo $tampildata['Suffic'];} ?>" />
            </div>
          </div>
          <div class="col-md-3"> 
            <div class="form-group"> 
              <label class="small mb-1" for="inputFirstName">Item Code *</label>
              <input type="text" class="form-control py-4"  name="inputItem_Code" maxlength="5" 
			placeholder="Enter Item Code" value="<?php if ($_POST){ echo $inputSuffic;} else {echo $tampildata['Item_Code'];} ?>" />
            </div>
          </div>
		  			

       	</div>
		<div class="form-row"> 
			
          <div class="col-md-7"> 
            <div class="form-group"> 
            <label class="small mb-1" for="inputEmailAddress">Descrioption</label>
			<textarea cols="4"  name="inputDescrioption" maxlength="100" class="form-control py-4" 
			placeholder="Enter Descrioption"><?php if($_POST) {echo $inputDescrioption;} else {echo $tampildata['Keterangan'];} ?></textarea>
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

		<button type="submit" class="btn btn-primary" onClick="return checkSave()">Save</button>		
		<a class="btn btn-primary" href="../dist/index.php?button=trading-partner">Back</a> 
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
