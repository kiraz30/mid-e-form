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
		<script type="text/javascript" src="../ckeditor/ckeditor.js"></script>

    </head>
	<main> 
    <div class="container-fluid"> 
      <h3 class="mt-4"><?php if ($button=="add-market-situation") {echo "Add Templet";} else  {echo "Edit Templet";} ?></h3>
	    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="../dist/index.php?button=dashboard">Dashboard</a></li>
		<li class="breadcrumb-item"><a href="../dist/index.php?button=market-situation">Templet</a></li>
        <li class="breadcrumb-item active"><?php if ($button=="add-market-situation") {echo "Add Templet";} else  {echo "Edit Templet";} ?> </li>
      </ol>
 	<div class="card mb-4">
	    <div class="card-header"> </div>

        <div class="card-body"> 
			
        <?php
      	$exe =mysqli_query($con,"SELECT ID_No,Module,Judul_Templete,Isi_Templete,Keterangan,Status FROM tb_Templete where ID_No = '".@$_GET['id']."' ");
        $tampildata=mysqli_fetch_array($exe)
	  	?>
        <form action="" method="post" name="frm-Position">
          <?php 
		//Begin CRUD----------------------------------------------------------------------
		if($_POST){
		$ip=$_SERVER['REMOTE_ADDR'];
		$hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);
		date_default_timezone_set("Asia/Jakarta");
		$createddate=date("Y-m-d H:i:s");
    	$tempMarketSituation  	= $_POST['tempMarketSituation'];
		$inputModul			  	= @$_POST['inputModul'];
		$inputJudul_Templete  	= @$_POST['inputJudul_Templete'];
		$inputIsi_Templete 		= @$_POST['inputIsi_Templete']; 
		$inputDescrioption 		= @$_POST['inputDescrioption'];
		$SelectStatus			= @$_POST['SelectStatus'];
		
		if($inputIsi_Templete==""){  
			echo "<div class='form-group has-error'>
			<label class='control-label' for='inputError'>Market Situation Can not be empty *</label></div>"; }
		elseif($button=="add-templete"){ 
			$Tanya = mysqli_query($con,"SELECT KDPosition,PositionName FROM tb_marketsituation 
			WHERE KDPosition = '$inputPositionCode' OR PositionName='$inputPositionCode' ");
			if (mysqli_num_rows($Tanya) !=0 ) {  
				echo "<div class='form-group has-error'>
				<label class='control-label' for='inputError'>Error Save : Dosage already exists in the database *</label></div>";}
			else{
				//membuat Query untuk update data
				mysqli_query($con,"update tb_marketsituation set Status='0' ");
				//membuat Query untuk menyimpan data
				mysqli_query($con,"Insert INTO tb_marketsituation (MarketSituation,Keterangan,Status) values 
				('$inputIsi_Templete','$inputDescrioption','$SelectStatus')");
					
				echo "<div class='alert alert-success alert-diszmissable'> 
				<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
				Data successfully save to database. <a href='../dist/index.php?button=templete' class='alert-link'>Templete</a>. </div>";
				$inputIsi_Templete 	="";
				$inputPositionName 		=""; 
				$inputDescrioption 		="";
				$SelectStatus			="";
				}
			}
		elseif($button=="edit-templete"){ 
			//membuat Query untuk update data
			mysqli_query($con,"update tb_templete set Isi_Templete='$inputIsi_Templete',Keterangan='$inputDescrioption',
			Status='$SelectStatus' WHERE ID_No='$tempMarketSituation'");
			
			$message = "Data successfully Update to database";
			echo "<script type='text/javascript'>alert('$message');</script>";
			echo"<script>  window.location='../dist/index.php?button=templete'; </script>";
			}
		}
		//End CRUD----------------------------------------------------------------------
		?>
		
		<div class="form-row"> 
			<div class="col-md-2"> 
				<div class="form-group"> 
				<label class="small mb-1" for="inputFirstName">Module</label>
					<input name="tempMarketSituation" type="hidden" value="<?php echo $tampildata['ID_No']; ?>">	
					<input class="form-control py-4" name="inputModul" type="text" 
					value="<?php if($_POST) {echo $inputModul;} else {echo @$tampildata['Module'];} ?>" disabled="disabled">
				</div>
			</div>
			<div class="col-md-10"> 
				<div class="form-group"> 
					<label class="small mb-1" for="inputFirstName">Judul Template</label>
					<input class="form-control py-4" name="inputJudul_Templete" type="text" 
					value="<?php if($_POST) {echo $inputJudul_Templete;} else {echo @$tampildata['Judul_Templete'];} ?>" disabled="disabled">
				</div>
			</div>
		</div>
         <div class="form-group"> 
           <label class="small mb-1" for="inputFirstName">Isi Template</label>
              <input name="tempMarketSituation" type="hidden" value="<?php echo $tampildata['ID_No']; ?>">
              <textarea  rows="9" name="inputIsi_Templete" id="inputIsi_Templete" class="form-control ckeditor"
			placeholder="Market Condition : "><?php if($_POST) {echo $inputIsi_Templete;} else {echo @$tampildata['Isi_Templete'];} ?></textarea>
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
		<a class="btn btn-primary" href="../dist/index.php?button=templete">Back</a> 
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
<script>
 CKEDITOR.replace( 'inputIsi_Templete', {
  height: 300,
  filebrowserUploadUrl: "../ckeditor/upload.php"
 });
</script>
