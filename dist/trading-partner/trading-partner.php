<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>E-Form -Trading Partner</title>
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
	 <h3>Trading Partner</h3>
	    <ol class="breadcrumb mb-0">
			<li class="breadcrumb-item"><a href="../dist/index.php?button=dashboard">Dashboard</a></li>
			<li class="breadcrumb-item active"><b>Trading Partner</b></li>
        </ol>
      <div class="card mb-4">
   		<div class="card-header">
				<a class="btn btn-primary" href="../dist/index.php?button=add-trading-partner">Add Trading Partner </a>
		</div>

        <div class="card-body"> 
           <div class="table-responsive"> 
		  <table width="100%" class="table  table-striped  table-bordered table-hover" id="dataTables-example">
              <thead>
                <tr>
				  <th width="1%">No</th>
				  <th width="8%">Customer Code </th>
				  <th width="15%">Marketing Company </th>
				  <th width="10%">FOB, C&amp;F, CIF</th>
				  <th>Country</th>
				  <th width="7%">Currency</th>
				  <th width="1%">Suffic</th>
				  <th width="1%">Item Code </th>
				  <th>Description</th>
				  <th width="8%">Status</th>
                  <th width="1%">Actian</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
				  <th>No</th> 
			  	  <th>Customer Code</th>
			  	  <th>Marketing Company</th>
			  	  <th>FOB, C&F, CIF</th>
			  	  <th>Country</th>
			  	  <th>Currency</th>
			  	  <th>Suffic</th>
			  	  <th>Item Code</th>
				  <th>Description</th>
				  <th>Status</th>
                  <th>Actian</th>
                </tr>
              </tfoot>
              <tbody>
          <?php
			$exe = mysqli_query($con,"SELECT a.CustomerCode,a.Marketing_Company,a.FOB_CF_CIF,b.NamaCurrency,a.Country,a.Suffic,a.Item_Code, a.Keterangan,a.Status FROM tb_trading_partner a Inner Join tb_currency b On a.KDCurrency=b.KDCurrency Order By  a.CustomerCode Asc ");
			$no = 1;
			while(@$row =mysqli_fetch_array($exe)){
			?>
			  <tr> 
				<td><?php echo $no;?></td>
				<td><?php echo $row['CustomerCode'];?></td>
				<td><?php echo $row['Marketing_Company'];?></td>
				<td><?php echo $row['FOB_CF_CIF'];?></td>
				<td><?php echo $row['Country'];?></td>
				<td><?php echo $row['NamaCurrency'];?></td>
				<td><?php echo $row['Suffic'];?></td>
				<td><?php echo $row['Item_Code'];?></td>
				<td><?php echo $row['Keterangan'];?></td>
				<td><?php if($row['Status']==1)  {echo "Active";} else {echo "Non Active";}?></td>
				<td align="center"><a href="../dist/index.php?button=edit-trading-partner&id=<?php echo $row['CustomerCode'];?>"><span class="glyphicon glyphicon-pencil" title="Edit Trading Partner"></span></a> 
				  | <a onClick="return checkDelete()" href="../config/delete-exe.php?pg=del-trading-partner&&id=<?php echo $row['CustomerCode'];?>"><span class="glyphicon glyphicon-remove" title="Delete Trading Partner"></span></a></td>
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
</html>
