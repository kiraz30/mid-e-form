<?php 
include "../config/connect_sql.php";
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
	
	<style> 
input[type=text] {
  width: 20%;
  height: 30px;
  padding: 10px 10px;
  margin: 2px 2px 2px 2px;
  box-sizing: border-box;
  border: 1px solid #555;
  outline: none;
}

input[type=text]:focus {
  background-color: lightblue;
}
</style>

	<main> 
    <div class="container-fluid"> 
      <h3 class="mt-4">View Original Master Item </h3>
	    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="../dist/index.php?button=dashboard">Dashboard</a></li>
        <li class="breadcrumb-item active">Master Item [ <?php echo "Server : ".$serverFlex." Database : ".$databaseFlex; ?> ]</li>
      </ol>
      <div class="card mb-4">
	  <form action=""  method="post"  >
   		<div class="card-header">
		Filter : 
		<input  name="SearchCode" id="SearchCode"  maxlength="50" type="text"  
			  placeholder="Enter Code" value="<?php echo $SearchCode ?>"  /> 
			  <input  name="SearchName" id="SearchName"  maxlength="50" type="text"  
			  placeholder="Enter Nama" value="<?php echo $SearchName ?>"  />
			  <button type="submit" name="Refresh" value="Refresh" class="btn btn-primary">Search Filter</button>
			    <a href="../config/export-excel.php?pg=Master-Item-Ori&SearchCode=<?php echo $SearchCode;?>&SearchName=<?php echo $SearchName;?>">
			  <button type="button" name="Export" value="Export" class="btn btn-primary"><i class="fa fa-file-excel"></i> Export</button> </a> </div>
        <div class="card-body"> 
           <div class="table-responsive"> 
		  <table width="100%" class="table table-striped table-bordered table-hover"  >
              <thead>
                <tr>
				  <th width="1%">No</th>
				  <th>Kode</th> 
                  <th>Nama</th>
				  <th>DZ per CT</th>
				  <th>Netto</th>
				  <th>UOM</th>
				  <th>Barcode</th>
				  <th width="10%">Launching Date Original </th> 
                </tr>
              </thead>
 
              <tbody>
 <?php
			$query = "SELECT Item_Code,Item_Name,Netto,UOM,DZ_per_CT,Barcode,DiscontinueDate,LaunchingDate from tb_master_item_flexprocess ";
			if ($SearchCode<>""){
				if (@$querytemp<>""){
					$querytemp= $querytemp. " And Item_Code like '%$SearchCode%'";}
				else{
					$querytemp= " WHERE Item_Code like '%$SearchCode%'";
				}
			}
			if ($SearchName<>""){
				if (@$querytemp<>""){
					$querytemp= $querytemp. " And Item_Name like '%$SearchName%'";}
				else{
					$querytemp= " WHERE Item_Name like '%$SearchName%'";
				}
			}
			$exe = mysqli_query($con,$query. @$querytemp. " Order By Item_Code Asc");
		
			$no = 1;
			while(@$row =mysqli_fetch_array($exe)){
			?>
			  <tr> 
				<td><?php echo $no;?></td>
				<td><?php echo $row['Item_Code'];?></td>
				<td><?php echo $row['Item_Name'];?></td>
				<td><?php echo $row['DZ_per_CT'];?></td>
				<td><?php echo $row['Netto'];?></td>
				<td><?php echo $row['UOM'];?></td>
				<td><?php echo $row['Barcode'];?></td>
				<td><?php echo $row['LaunchingDate'];?></td>
			  </tr>
			  <?php $no++;} ?>

              </tbody>
            </table>
		</div>
        </div>
      </div>
	  </form>
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
	function checkDelete(){
		return confirm('Are you sure you want to delete this data?');
	}
	</script>
    </body>
</html>
<?php };?>