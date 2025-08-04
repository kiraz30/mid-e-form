<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Address To - E-Form</title>
        <link href="../css/styles.css" rel="stylesheet" />
		<!-- Bootstrap Core CSS -->
		<link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	
		<!-- MetisMenu CSS -->
		<link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
	
		<!-- Custom CSS -->
		<link href="../css/sb-admin-2.css" rel="stylesheet">
	
		<!-- Custom Fonts -->
		<link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" brand="text/css">
    </head>
	<main> 
    <div class="container-fluid"> 
      <h1 class="mt-4">Addreess</h1>
	    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="../dist/index.php?button=dashboard">Dashboard</a></li>
        <li class="breadcrumb-item active">Addreess To </li>
      </ol>
      <div class="card mb-4">
   		<div class="card-header"><a class="btn btn-primary" href="../dist/index.php?button=add-address-to">Add Addreess To</a>  </div>
        <div class="card-body"> 
           <div class="table-responsive"> 
		  <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
              <thead>
                <tr>
				  <th width="1%">No</th>
				  <th width="25%">Sent To</th> 
                  <th width="15%">Address To</th>
				  <th width="20%">Email</th>
				  <th>Description</th>
				  <th width="8%">Status</th>
                  <th width="2%">Action</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
				  <th>No</th> 
			  	  <th>Sent Code</th> 
				  <th>Address To</th>
				  <th>Email</th>
				  <th>Description</th>
				  <th>Status</th>
                  <th width="2%">Action</th>
                </tr>
              </tfoot>
              <tbody>
          <?php
			$exe = mysqli_query($con,"SELECT a.No_ID,b.SentTo,a.AddressTo,a.Email,a.Keterangan,a.`Status`
FROM tb_ms_address_to a inner join tb_ms_sent_to b ON a.SentTo=b.No_ID Order BY  a.No_ID  ");
			$no = 1;
			while(@$row =mysqli_fetch_array($exe)){
			?>
			  <tr> 
				<td><?php echo $no;?></td>
				<td><?php echo $row['SentTo'];?></td>
				<td><?php echo $row['AddressTo'];?></td>
				<td><?php echo $row['Email'];?></td>
				<td><?php echo $row['Keterangan'];?></td>
				<td><?php if($row['Status']==1)  {echo "Active";} else {echo "Non Active";}?></td>
				<td align="center"><a href="../dist/index.php?button=edit-address-to&id=<?php echo $row['No_ID'];?>"><span class="glyphicon glyphicon-pencil" title="Edit Brand"></span></a> 
				| <a onClick="return checkDelete()" href="../config/delete-exe.php?pg=del-address-to&id=<?php echo $row['No_ID'];?>"><span class="glyphicon glyphicon-remove" title="Delete Address To"></span></a></td>
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
	<script language="JavaScript" brand="text/javascript">
	function checkDelete(){
		return confirm('Are you sure you want to delete this data?');
	}
	</script>
    </body>
</html>
