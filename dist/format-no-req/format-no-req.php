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
      <h3 class="mt-4">Format Request No</h3>
	    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="../index.php?button=dashboard">Dashboard</a></li>
        <li class="breadcrumb-item active">Format Request No </li>
      </ol>
      <div class="card mb-4">
   		<div class="card-header"><a class="btn btn-primary" href="../dist/index.php?button=add-format-no-req">Add Format Request No</a>  </div>
        <div class="card-body"> 
           <div class="table-responsive"> 
		  <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
              <thead>
                <tr>
				  <th width="1%">No</th>
				  <th>Format Request No</th> 
                  <th>Worflow Menu</th>
				  <th>Years</th>
				  <th>Months</th>
				  <th>No</th>
				  <th>Descripton</th>
                  <th width="2%">Action</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
				  <th>No</th> 
				  <th>Format Request No </th> 
                  <th>Worflow Menu</th>
				  <th>Years</th>
				  <th>Months</th>
				  <th>No</th>
				  <th>Descripton</th>
                  <th width="2%">Action</th>
                </tr>
              </tfoot>
              <tbody>
			<?php
				$exe = mysqli_query($con,"SELECT ID_No,WorkFlowMenu,Request_No,Keterangan FROM tb_format_req_no  Order By  ID_No ASC ");
				$no = 1;
				while(@$row =mysqli_fetch_array($exe)){
				?>
				<tr> 
					<td><?php echo $no;?></td>
					<td><?php echo $row['Request_No'];?>-YY-MM-NNNN</td>
					<td><?php echo $row['WorkFlowMenu'];?></td>
					<td><?php echo date("y");?></td>
					<td><?php echo date("m");?></td>
					<td>0001</td>
					<td><?php echo $row['Keterangan'];?></td>
					<td align="center">
					<a href="../dist/index.php?button=edit-format-no-req&id=<?php echo $row['ID_No'];?>"><span class="glyphicon glyphicon-pencil" title="Edit User Setting"></span></a> 
					| <a onClick="return checkDelete()" href="../config/delete-exe.php?pg=del-format-no-req&&id=<?php echo $row['ID_No'];?>"><span class="glyphicon glyphicon-remove" title="Delete Format Request No"></span></a></td>
				 </tr>
				 <?php $no++;} ?>

              </tbody>
            </table>
		</div>
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
	function checkDelete(){
		return confirm('Are you sure you want to delete this data?');
	}
	</script>
    </body>
	
    </body>
</html>
