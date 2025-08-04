
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
		<!-- Bootstrap Core CSS -->
		<link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	
		<!-- MetisMenu CSS -->
		<link href="../../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
	
		<!-- Custom CSS -->
		<link href="../../css/sb-admin-2.css" rel="stylesheet">
	
		<!-- Custom Fonts -->
		<link href="../../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
		
		<link href="../../vendor/datatables/css/dataTables.bootstrap4.min.css" rel="stylesheet">
        <!--script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script-->
		<script src="../../font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
		
    </head>

	<main> 
    <div class="container-fluid"> 
	<?php 
	if($_GET["pg"]=="nprf"){
	  	$flow="New Product Request Form (NPRF)";
	}elseif($_GET["pg"]=="fnim"){
	  	$flow="Final Name Internal Memo (FNIM)";
	}elseif($_GET["pg"]=="mpr"){
	  	$flow="Master Product Request (MPR)";
	}elseif($_GET["pg"]=="cfm"){
	  	$flow="New Request (CFM)";
	}elseif($_GET["pg"]=="faw"){
	  	$flow="Final Art Work (FAW)";
	}elseif($_GET["pg"]=="arm"){
	  	$flow="Additional Resource Master";
	}elseif($_GET["pg"]=="arm-f2"){
		$flow="Additional Resource Master Factory 2";
	}elseif($_GET["pg"]=="ps"){
		$flow="Packaging Spesification";
	}elseif($_GET["pg"]=="sp"){
		$flow="Spesification Products ";
	}
	?>
      <h3 class="mt-4">Workflow <?php echo @$flow ?></h3>

      <div class="card mb-4">
   	<div class="card-header">   </div>
         <div class="card-body"> 
          <div class="table-responsive">
<?php
 	 if(!empty($_GET["id"]))
	 {  ?>
		  <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example" >
              <thead>
                <tr>
				  <th width="1%">No</th>
				  <th width="20%">Divisi</th>  
				  <th width="15%">Workflow</th> 
				  <th width="15%">On Behalf </th>
				  <th width="12%">Approve By</th> 
				  <th width="18%">Approve Date</th> 
				  <th width="10%">Status</th> 
                  <th width="40%">Remark</th>
                </tr>
              </thead>
          <?php
		  include "connect.php";
			$exe = mysqli_query($con,"SELECT LevelProcess,NameApproval,OnBehalf,Approve,ApproveDate,Index_No,StatusWorkFlow,Remark_WorkFlow FROM tb_workflownprf 
			WHERE Request_No='".$_GET["id"]."' Order by ID_No ASC ");
			$no = 1;
			if (mysqli_num_rows($exe) !=0 ) {
			while(@$row =mysqli_fetch_array($exe)){
			?>
			  <tr> 
			    
				<td><?php echo $no;?></td>
				<td><?php caridata1('tb_user a Inner Join tb_division b ON a.KDDivision=b.KDDivision','a.UserDomain','DivisionName',$row['NameApproval']) ;?></td>
				<td><?php caridata1('tb_user','UserDomain','Name',$row['NameApproval']) ;?></td>
				<td><?php caridata1('tb_user','UserDomain','Name',$row['OnBehalf']) ;?></td>
				<td><?php caridata1('tb_user','UserDomain','Name',$row['Approve']) ;?></td>
				<td><?php echo $row['ApproveDate'];?></td>
				<td><?php if ($row['StatusWorkFlow']=="S") { echo "Requestor";} elseif ($row['StatusWorkFlow']=="C") { echo "Complete";} elseif ($row['StatusWorkFlow']=="R") { echo "Revise";}?></td>
				<td><?php echo $row['Remark_WorkFlow'];?></td>
			  </tr>
			  <?php $no++;}} else {  ?>
			  <tr> 
				<td colspan="8">No data available in table</td>
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
