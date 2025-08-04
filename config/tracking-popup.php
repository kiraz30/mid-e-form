
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Workflow Activity</title>
        <link href="css/styles.css" rel="stylesheet" />
		<link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="../../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
		<link href="../../css/sb-admin-2.css" rel="stylesheet">
		<link href="../../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
		<link href="../../vendor/datatables/css/dataTables.bootstrap4.min.css" rel="stylesheet">
		<script src="../../font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
    </head>
	<main> 
    <div class="container-fluid"> 
		<?php 
		if($_GET["pg"]=="prod-arm"){
			$flow="Additional Resource Master";
		}
		?>
    	<div class="card mb-4">
			<div class="card-header">Workflow <?php echo @$flow ?></div>
				<div class="card-body"> 
					<div class="table-responsive">
					<?php if(!empty($_GET["id"])){  ?>
					<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example" >
					<thead>
						<tr>
						<th width="1%">No</th>
						<th width="20%">Divisi</th>  
						<th width="12%">Send / Approve By</th> 
						<th width="18%">Send Approve Date</th> 
						<th width="10%">Status</th> 
						<th width="40%">Remark</th>
						</tr>
					</thead>
					<?php
					include "connect.php";
					$exe = mysqli_query($con,"SELECT a.IDNo, a.No_Req,a.TRACKING_CODE,b.DESCR, a.Remark,a.CreatedBy,
						c.NIP,c.Name,d.DivisionName,e.PositionName,
						a.CreatedDate
						FROM tb_req_tracking a INNER JOIN param_tracking b ON a.TRACKING_CODE=b.CODE
						INNER JOIN tb_user c ON a.CreatedBy=c.UserDomain
						INNER JOIN tb_division d ON c.KDDivision=d.KDDivision
						INNER JOIN tb_position e ON c.KDPosition=e.KDPosition
					WHERE a.No_Req='".$_GET["id"]."' Order by a.IDNo ASC ");
					$no = 1;
					if (mysqli_num_rows($exe) !=0 ) {
					while(@$row =mysqli_fetch_array($exe)){
					?>
					<tr> 
						
						<td><?php echo $no;?></td>
						<td><?php echo $row['DivisionName'];?></td>
						<td><?php echo $row['Name'];?></td>
						<td><?php echo date("d-m-Y H:i:s", strtotime($row['CreatedDate']));?></td>
						<td><?php echo $row['DESCR'];?></td>
						<td><?php echo $row['Remark'];?></td>
					</tr>
					<?php $no++;}} else {  ?>
					<tr> 
						<td colspan="6">No data available in table</td>
					</tr> 
					<?php } }?>
					
					
					
					
					
					</tbody>
					</table>
				</div>
        	</div>
    	</div>
	</div>
    </main> 
    <!-- jQuery -->
    <script src="../../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="../../vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="../../vendor/datatables-responsive/dataTables.responsive.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../../js/sb-admin-2.js"></script>

    </script>
    </body>
</html>
