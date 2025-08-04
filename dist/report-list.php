<?php 
$showprivilage=mysqli_query($con,"SELECT * from Tb_user_privilage where UserDomain = '$username' 
And Module='report-list' And Status='1' ");
if (mysqli_num_rows($showprivilage) ==0 ) {
		ob_start();
		include "401.html";
		ob_end_flush();
	}
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
        <link href="css/styles.css" rel="stylesheet" />
		<!-- Bootstrap Core CSS -->
		<link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	
		<!-- MetisMenu CSS -->
		<link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
	
		<!-- Custom CSS -->
		<link href="../css/sb-admin-2.css" rel="stylesheet">
	
		<!-- Custom Fonts -->
		<link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    </head>
<script type="text/javascript">
		function popupwindow(url, title, h, w) {
		  var left = (screen.width/2)-(w/2);
		  var top = (screen.height/2)-(h/2);
		  return window.open(url, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
		  return false;
		} 
</script>
	<main> 
    <div class="container-fluid"> 
      <h3 class="mt-4">Report List <?php echo ShowData1("tb_workflowmenu","Keterangan","WorkFlowMenu",$_GET['workflow']); ?></h3>
	    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="index.php?button=dashboard">Dashboard</a></li>
        <li class="breadcrumb-item active">Report List /  <?php echo ShowData1("tb_workflowmenu","Keterangan","WorkFlowMenu",$_GET['workflow']); ?></li>
      </ol>
      <div class="card mb-4">
   	<div class="card-header">   </div>
         <div class="card-body"> 
          <div class="table-responsive"> 
		  
		  <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example" >
              <thead>
                <tr>
				  <th width="1%">No</th>
				  <th>Request No</th> 
				  <th>Thema Name</th> 
				  <th>Request Date</th>
                  <th>Request Type</th>
				  <th>Remark</th>
				  <th>Module</th>
				  <th>Divison</th>
                  <th width="2%">Action</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
				  <th width="1%">No</th> 
				  <th>Request No</th> 
				  <th>Thema Name</th>
				  <th>Request Date</th> 
                  <th>Request Type</th>
				  <th>Status</th>
				  <th>Module</th>
				  <th>Divison</th>
                  <th width="2%">Action</th>
                </tr>
              </tfoot>
              <tbody>
          <?php
 			$query="SELECT a.ID_No,a.Request_No,a.Request_Date,a.Thema_Name,a.Request_Type,a.Request_Status,a.WorkFlowMenu,d.DivisionName FROM tb_inbox a 
			INNER JOIN tb_workflownprf b ON a.Request_No=b.Request_No  
			INNER JOIN tb_user c ON  b.CreatedBy=c.UserDomain
			INNER JOIN tb_division d ON  c.KDDivision=d.KDDivision
			Where a.Request_Status='C' And a.WorkFlowMenu='".$_GET['workflow']."'";
			$exe = mysqli_query($con,$query ." GROUP BY a.ID_No,a.Request_No,a.Request_Date,a.Thema_Name,a.Request_Type,a.Request_Status,a.WorkFlowMenu Order By  ID_No Desc ");
			$no = 1;
			while(@$row =mysqli_fetch_array($exe)){
			?>
			  <tr> 
			   
				<td><?php echo $no;?></td>
				<td><?php echo $row['Request_No'];?></td>
				<td><?php echo $row['Thema_Name'];?></td>
				<td><?php echo $row['Request_Date'];?></td>
				<td><?php echo $row['Request_Type'];?></td>
				<td><?php if($row['WorkFlowMenu']=="NPRF")  { echo
				caridata1("tb_nprf","Request_No","Remark",$row['Request_No']);}?></td>
				<td><?php echo $row['WorkFlowMenu'];?></td>
				<td><?php echo $row['DivisionName'];?></td>
				<td align="center">
				 
				<?php if($row['WorkFlowMenu']=="NPRF")  { ?>
				<a href="../config/export-nprf.php?button=report&form=<?php echo strtolower($row['WorkFlowMenu']);?>&id=<?php echo $row['Request_No'];?>" target="_blank"> <?php } 
				else if($row['WorkFlowMenu']=="FNIM")  { ?>
				<a href="../config/export-fnim.php?button=report&form=<?php echo strtolower($row['WorkFlowMenu']);?>&id=<?php echo $row['Request_No'];?>" target="_blank">  <?php ;} 
				else if($row['WorkFlowMenu']=="MPR")  { ?>
				<a href="../config/export-mpr.php?button=report&form=<?php echo strtolower($row['WorkFlowMenu']);?>&id=<?php echo $row['Request_No'];?>" target="_blank">  <?php ;} 
				else if($row['WorkFlowMenu']=="CFM")  { ?>
				<a href="../config/export-cfm.php?button=report&form=<?php echo strtolower($row['WorkFlowMenu']);?>&id=<?php echo $row['Request_No'];?>" target="_blank">  <?php ;} ?>
				
				<span class="fa fa-file" title="Print and Preview Report <?php echo $row['WorkFlowMenu'];?>"></span></a>
				 
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
    </body>
</html>
<?php };?>