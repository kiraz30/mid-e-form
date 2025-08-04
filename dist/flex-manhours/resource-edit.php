<?php $submit		= @$_POST['submit'];

//include "../config/connect_sql.php";
 
$showprivilage=mysqli_query($con,"SELECT * from Tb_user_privilage where UserDomain = '$username' 
And Module='resource' And Status='1' ");
if (mysqli_num_rows($showprivilage) ==0 ) {
	include "401.html";	}
else{

?>

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
      <h3 class="mt-4"><?php if ($button=="edit-resource") {echo "Edit Master Item";} ?></h3>
	    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="../dist/index.php?button=dashboard">Dashboard</a></li>
		<li class="breadcrumb-item"><a href="../dist/index.php?button=resource">Master Item</a></li>
        <li class="breadcrumb-item active"><?php if ($button=="edit-resource")  {echo "Edit Master Item";} ?> [ <?php echo "Server : ".$serverFlex." Database : ".$databaseFlex; ?> ] </li>
      </ol>
 	<div class="card mb-4">
	    <div class="card-header"> </div>

        <div class="card-body"> 
			
        <?php
		$exe = odbc_exec($myConn,"SELECT Item_Code,Item_Name,DZ_per_CT,Netto,UOM,Barcode,
		Discontinue,DiscontinueDate,LaunchingDate from Master_Item Where Discontinue=0 And Item_Code = '".@$_GET['id']."'");
        $tampildata=odbc_fetch_array($exe);
		
		$exeFlex = odbc_exec($myConnFlex,"SELECT TOP 1 a.aoldate, a.ParentObjectId, b.ResourceUK,a.aotDisctn from AOSTOCKSTATUS a 
		INNER JOIN fdBasResc b ON a.ParentObjectID=b.ObjectID Where b.ResourceUK = '".@$_GET['id']."'");
        $tampildataFlex=odbc_fetch_array($exeFlex);
		

	  	?>
        <form action="" method="post" name="frm-division">
          <?php 
		//Begin CRUD----------------------------------------------------------------------
		if($_POST){
		$ip=$_SERVER['REMOTE_ADDR'];
		$hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);
		date_default_timezone_set("Asia/Jakarta");
		$createddate=date("Y-m-d H:i:s");
    	$tempItem_Code  	= $_POST['tempItem_Code'];
		$inputCode  		= $_POST['inputCode'];
		$inputLaunchingDate	= $_POST['inputLaunchingDate'];
		if($inputCode==""){  
			echo "<div class='form-group has-error'>
			<label class='control-label' for='inputError'>Code Can not be empty *</label></div>"; }
		elseif($button=="edit-resource"){ 
			//membuat Query untuk update data
			if (!@$_POST['ChkKoreksiLaunchingDate']){$valKoreksiLaunchingDate=0;} else {$valKoreksiLaunchingDate=1;}
			if ($valKoreksiLaunchingDate==1) {
				$Tanya = mysqli_query($con,"SELECT * FROM tb_master_item_flexprocess WHERE Item_Code = '".@$_GET['id']."'");
				if (mysqli_num_rows($Tanya) ==0 ) {
					mysqli_query($con,"Insert INTO tb_master_item_flexprocess(ParentObjectID,Item_Code,Item_Name,DZ_per_CT,
					Netto,UOM,Barcode,DiscontinueDate,LaunchingDate,Created_By,Created_Date,Created_HostName) 
					values ('".$tampildataFlex['ParentObjectId']."','".$tampildataFlex['ResourceUK']."',
					'".$tampildata['Item_Name']."','".$tampildata['DZ_per_CT']."','".$tampildata['Netto']."','".$tampildata['UOM']."',
					'".$tampildata['Barcode']."','".$tampildataFlex['aotDisctn']."',
					'".$inputLaunchingDate."','$username','$createddate','$ip : $hostname')");
				}else {
					mysqli_query($con,"update tb_master_item_flexprocess set 
					LaunchingDate='$inputLaunchingDate' WHERE Item_Code='".@$_GET['id']."'");
				}
			}
			
			odbc_exec($myConn,"update Master_Item set LaunchingDate='$inputLaunchingDate' WHERE Item_Code='".@$_GET['id']."'");
			odbc_exec($myConnFlex,"update AOSTOCKSTATUS set aoldate='$inputLaunchingDate' 
			WHERE ParentObjectId='".$tampildataFlex['ParentObjectId']."'");
			
			
			LogInfo($createddate,"Save : Form Edit Master Item Product Code [".$_GET['id']."]
			Old Launching Date [".$tampildataFlex['aoldate']."] New Launching Date [".$inputLaunchingDate."]",$username,$hostname);
			$message = "Data successfully Update to database";
			echo "<script type='text/javascript'>alert('$message');</script>";
			echo"<script>  window.location='../dist/index.php?button=resource'; </script>";
			}
		}
		//End CRUD----------------------------------------------------------------------
		?>
		
		<table width="100%"  class="table table-striped  table-hover" id="dataTables-example">
		  <tr>
			<td width="20%"><span class="form-group">Product Code</span> </td>
			<td width="30%"><span class="form-group">
				<input name="tempItem_Code" type="hidden" value="<?php echo $tampildata['Item_Code']; ?>">
				<input class="form-control py-4" name="inputCode"  maxlength="20" type="text" 
				placeholder="Enter Code" value="<?php echo $tampildata['Item_Code']; ?>" readonly="readonly" /></span>
			</td>
			<td width="30%"></td>
			<td width="20%"></td>
		  </tr>
		  <tr>
			<td width="20%"><span class="form-group">Item Name</span> </td>
			<td colspan="2"><span class="form-group">
				<input class="form-control py-1" name="inputCode"  maxlength="20" type="text" 
				placeholder="Enter Code" value="<?php echo $tampildata['Item_Name']; ?>" readonly="readonly"/></span>
			</td>
			<td width="20%"></td>
		  </tr>
		  <tr>
			<td width="20%"><span class="form-group">DZ per CT</span> </td>
			<td align="right"><span class="form-group">
				<input class="form-control py-1" name="inputDZ_per_CT" id="inputDZ_per_CT"  maxlength="20" type="text" 
				placeholder="Enter Code" value="<?php echo $tampildata['DZ_per_CT']; ?>" readonly="readonly"/></span>
			</td>
			<td width="30%"></td>
			<td width="20%"></td>
		  </tr>
		  <tr>
			<td width="20%"><span class="form-group">Netto</span> </td>
			<td align="right"><span class="form-group">
				<input class="form-control py-1" name="inputNetto" id="inputNetto"  maxlength="20" type="text" 
				placeholder="Enter Code" value="<?php echo $tampildata['Netto']; ?>" readonly="readonly"/></span>
			</td>
			<td width="30%"></td>
			<td width="20%"></td>
		  </tr>
			<tr>
			<td width="20%"><span class="form-group">UOM</span> </td>
			<td align="right"><span class="form-group">
				<input class="form-control py-1" name="inputUOM" id="inputUOM"  maxlength="20" type="text" 
				placeholder="Enter Code" value="<?php echo $tampildata['UOM']; ?>" readonly="readonly"/></span>
			</td>
			<td width="30%"></td>
			<td width="20%"></td>
		  </tr>
		  </tr>
		  <tr>
			<td width="20%"><span class="form-group">Barcode</span> </td>
			<td align="right"><span class="form-group">
				<input class="form-control py-1" name="inputBarcode" id="inputBarcode"  maxlength="20" type="text" 
				placeholder="Enter Code" value="<?php echo $tampildata['Barcode']; ?>" readonly="readonly"/></span>
			</td>
			<td width="30%"></td>
			<td width="20%"></td>
		  </tr>
		  <tr>
			<td width="20%"><span class="form-group">Original Launching Date</span> </td>
			<td align="right"><span class="form-group">
				<input class="form-control py-1" name="inputOriginalLaunchingDate" id="inputOriginalLaunchingDate"  maxlength="20" type="text" 
				value="<?php echo caridata1("tb_master_item_flexprocess","Item_Code","DATE_FORMAT(LaunchingDate,'%d/%m/%Y')",$tampildata['Item_Code'])?>" title="Date Format DD/MM/YYYY" data-date-format="DD MMMM YYYY" 
				disabled="disabled" /> 
				</span>
			</td>
			<td width="30%"></td>
			<td width="20%"></td>
		  </tr>
		  <tr>
			<td width="20%"><span class="form-group">Display K2 Sales Order</span> </td>
			<td align="right"><span class="form-group">
				<input class="form-control py-1" name="inputLaunchingDate" id="inputLaunchingDate"  maxlength="20" type="date" 
				value="<?php echo $tampildata['LaunchingDate']; ?>" title="Date Format DD/MM/YYYY" data-date-format="DD MMMM YYYY"  /> 
				</span>
			</td>
			<td width="30%"><input class="form-check-label" name="ChkKoreksiLaunchingDate" id="ChkKoreksiLaunchingDate" type="checkbox" 
				value="<?php echo $tampildata['LaunchingDate']; ?>" title="Checked for Original Launching Date Corection" 
				<?php $Tanya = mysqli_query($con,"SELECT * FROM tb_master_item_flexprocess WHERE Item_Code = '".@$_GET['id']."'");
				if (mysqli_num_rows($Tanya) <>0 ) { 
					echo ''; 
				} else { 
					echo 'checked="checked" disabled="disabled"';} ?>/> Original Launching Date Corection </td>
			<td width="20%"></td>
		  </tr>
		</table>
		<button type="submit" class="btn btn-primary" onClick="return checkSave()" >Save</button>		
		<a class="btn btn-primary" href="../dist/index.php?button=resource&SearchCode" title="Back to Resource Menu">Back</a> 
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
	<script>
    	document.getElementById("inputDZ_per_CT").style.textAlign = "right";
		document.getElementById("inputBarcode").style.textAlign = "right";

	</script>
    </body>
</html>
<?php ;}?>