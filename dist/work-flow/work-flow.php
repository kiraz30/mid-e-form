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
      <h3 class="mt-4">Workflow</h3>
      <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="../dist/index.php?button=dashboard">Dashboard</a></li>
        <li class="breadcrumb-item active">Workflow</li>
      </ol>
      <div class="card mb-4"> 
   		<div class="card-header"><a class="btn btn-primary" href="../dist/index.php?button=add-work-flow">Add Workflow</a>  </div>
        <div class="card-body"> 
           <div class="table-responsive"> 
		        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
              <thead>
                <tr>
                  <th width="1%">No</th>
                  <th width="4%">Requestor</th> 
                  <th>Name</th>
                  <th width="15%">Division</th> 
                  <th width="4%">Wf Menu</th>
                  <th width="12%">Wf Internal</th>
                  <th width="12%">Wf Process</th>
                  <th>Keterangan</th>
                  <th width="4%">Status</th>
                  <th width="1%">Action</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>No</th>
                  <th>Requestor</th>
                  <th>Name</th> 
                  <th>Division</th>
                  <th>Wf Menu</th>
                  <th>Wf Internal</th>
                  <th>Wf Process</th>
                  <th>Keterangan</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </tfoot>
              <tbody>

				<?php
				$exe = mysqli_query($con,"SELECT a.ID_No,a.UserDomain,b.Name,a.WorkFlowMenu,a.Keterangan,a.Status,c.DivisionName FROM tb_workflow a 
				Inner JOIN tb_user b ON a.UserDomain=b.UserDomain  Inner Join tb_division c ON b.KDDivision=c.KDDivision 
				order BY  a.UserDomain Asc ");
				$no = 1;
				while(@$row =mysqli_fetch_array($exe)){
				?>
				<tr> 
					<td><?php echo $no;?></td>
					<td><?php echo $row['UserDomain'];?></td>
					<td><?php echo $row['Name'];?></td>
					<td><?php echo $row['DivisionName'];?></td>
					<td><?php echo $row['WorkFlowMenu'];?></td>
					<td><?php $exewp = mysqli_query($con,"SELECT ID_No,NameApproval FROM tb_workflowapproval Where UserDomain = '".$row['UserDomain']."' 
						And WorkFlowMenu = '".$row['WorkFlowMenu']."' And LevelApproval<>'Requestor' ");
						while(@$rowWFA =mysqli_fetch_array($exewp))
						{ echo "<span class='fa fa-arrow-circle-right'></span> ". $rowWFA['NameApproval']. "<br>";} ?></td>
					<td><?php $exewp = mysqli_query($con,"SELECT WorkFlowProcess,OnBehalfProcess FROM tb_workflowprocess Where UserDomain = '".$row['UserDomain']."' 
						And WorkFlowMenu = '".$row['WorkFlowMenu']."' And LevelProcess<>'Requestor' ");
						while(@$rowWFA =mysqli_fetch_array($exewp)){ echo "<span class='fa fa-arrow-circle-right'></span> ". 
						$rowWFA['WorkFlowProcess']. " <br>".
            $rowWFA['OnBehalfProcess']. " <br>";} ?></td>
					<td><?php echo $row['Keterangan'];?></td>
					<td><?php if ($row['Status']==1) {echo "Active";} else {echo "Non Active";}?></td>
					
              <td align="center"> 
			  <a href="../dist/index.php?button=edit-work-flow&id=<?php echo $row['ID_No'];?>">
			  	<span class="fa fa-edit" title="Edit Work Flow"></span></a> 
              <a href="../dist/index.php?button=work-flow-process&id=<?php echo $row['ID_No'];?>">
				<span class="glyphicon glyphicon-list" title="Setting Work Flow Process"></span> </a>
              <a onClick="return checkDelete()" href="../config/delete-exe.php?pg=del-work-flow&id=<?php echo $row['UserDomain'];?>&workflowmenu=<?php echo $row['WorkFlowMenu'];?>">
			 <i class="fas fa-trash-alt ic-w mr-1" title="Delete Work Flow"></i></a> 
              </td>
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
