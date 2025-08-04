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
      <h3 class="mt-4">Status Request</h3>
	    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="index.php?button=dashboard">Dashboard</a></li>
        <li class="breadcrumb-item active">Status Request</li>
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
				  <th width="2%">Module</th>
				  <th>Activity</th>
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
				  <th>Remark</th>
				  <th>Module</th>
				  <th>Activity</th
                  ><th>Action</th>
                </tr>
              </tfoot>
              <tbody>
          <?php
		 if ($level=="ADMINISTRATOR"){
			$query="SELECT a.ID_No,a.Request_No,a.Request_Date,a.Thema_Name,a.Request_Type,a.Request_Status,a.WorkFlowMenu FROM tb_inbox a 
			INNER JOIN tb_workflownprf b ON a.Request_No=b.Request_No Where a.Request_Status In ('CMID','R','W') ";
		}else{
			$query="SELECT a.ID_No,a.Request_No,a.Request_Date,a.Thema_Name,a.Request_Type,a.Request_Status,a.WorkFlowMenu FROM tb_inbox a 
			INNER JOIN tb_workflownprf b ON a.Request_No=b.Request_No Where	 a.Request_Status In ('CMID','R','W') And (b.NameApproval= '$username' Or b.OnBehalf='$username') ";}
		$exe = mysqli_query($con,$query ." GROUP BY a.Request_No,a.Request_Date,a.Thema_Name,a.Request_Type,a.Request_Status,a.WorkFlowMenu Order By  a.CreatedDate,a.UpdatedDate desc ");
			$no = 1;
			while(@$row =mysqli_fetch_array($exe)){
			?>
			  <tr> 
			   
				<td><?php echo $no;?></td>
				<td><?php echo $row['Request_No'];?></td>
				<td><?php echo $row['Thema_Name'];?></td>
				<td><?php echo $row['Request_Date'];?></td>
				<td><?php echo $row['Request_Type'];?></td>
				<td><?php 
					if($row['WorkFlowMenu']=="NPRF")  {
						caridata1("tb_nprf","Request_No","Remark",$row['Request_No']);}
					elseif($row['WorkFlowMenu']=="FNIM")  {
						caridata1("tb_fnim","Request_No","Remark",$row['Request_No']);}
					elseif($row['WorkFlowMenu']=="MPR")  {
						caridata1("tb_mpr","Request_No","Remark",$row['Request_No']);}
					elseif($row['WorkFlowMenu']=="CFM")  {
						caridata1("tb_cfm","Request_No","Remark",$row['Request_No']);}
					elseif($row['WorkFlowMenu']=="FAW")  {
						caridata1("tb_faw","Request_No","Remark",$row['Request_No']);}
					elseif($row['WorkFlowMenu']=="ARM")  {
						caridata1("tb_packdev_add_resource","Request_No","Remark",$row['Request_No']);}
					elseif($row['WorkFlowMenu']=="PS")  {
						caridata1("tb_packdev_spec","Request_No","Remark",$row['Request_No']);}
					?>
				</td>
				<td><?php echo $row['WorkFlowMenu'];?></td>
				<td>			
					<button style="padding:2px 4px 2px 2px" class="btn btn-outline btn-default">
					<span onClick="popupwindow('page.php?form=workflow&id=<?php echo $row['Request_No'];?>&pg=<?php echo strtolower($row['WorkFlowMenu']);?>','<?php $row['WorkFlowMenu'];?>','400','1000');" 
				class="fa fa-user" title="Preview Workflow" >Process</span></button>	
				<?php 
				if($row['WorkFlowMenu']=="NPRF")  {
				 	caridata1("tb_nprf","Request_No","Status_NPRF",$row['Request_No']);}
				elseif($row['WorkFlowMenu']=="FNIM")  {
				 	caridata1("tb_fnim","Request_No","Status_FNIM",$row['Request_No']);}
				elseif($row['WorkFlowMenu']=="MPR")  {
				 	caridata1("tb_mpr","Request_No","Status_MPR",$row['Request_No']);}
				elseif($row['WorkFlowMenu']=="CFM")  {
				 	caridata1("tb_cfm","Request_No","Status_CFM",$row['Request_No']);}
				elseif($row['WorkFlowMenu']=="FAW")  {
				 	caridata1("tb_faw","Request_No","Status_FAW",$row['Request_No']);}
				elseif($row['WorkFlowMenu']=="ARM")  {
					caridata1("tb_packdev_add_resource","Request_No","Status_add_resource",$row['Request_No']);}
				elseif($row['WorkFlowMenu']=="PS")  {
					caridata1("tb_packdev_spec","Request_No","Status_Spec",$row['Request_No']);}
				?>
				</td>
				<td align="center">
				<a href="../dist/index.php?menu=status-req&button=<?php echo strtolower($row['WorkFlowMenu']);?>-status-req&id=<?php echo $row['Request_No'];?>"
				style="padding:2px 4px 2px 2px"  class="btn btn-outline btn-default">
				<span class="glyphicon glyphicon-search" title="Preview Request Status"></span></a>
				
				<?php if($row['WorkFlowMenu']=="NPRF")  { ?>
				<a href="../config/export-nprf.php?button=report&form=<?php echo strtolower($row['WorkFlowMenu']);?>&id=<?php echo $row['Request_No'];?>" target="_blank" style="padding:2px 4px 2px 2px"  class="btn btn-outline btn-default"> <?php } else if($row['WorkFlowMenu']=="FNIM")  { ?>
				<a href="../config/export-fnim.php?button=report&form=<?php echo strtolower($row['WorkFlowMenu']);?>&id=<?php echo $row['Request_No'];?>" target="_blank" style="padding:2px 4px 2px 2px"  class="btn btn-outline btn-default">  <?php ;} else if($row['WorkFlowMenu']=="MPR")  { ?>
				<a href="../config/export-mpr.php?button=report&form=<?php echo strtolower($row['WorkFlowMenu']);?>&id=<?php echo $row['Request_No'];?>" target="_blank" style="padding:2px 4px 2px 2px"  class="btn btn-outline btn-default">  <?php ;} else if($row['WorkFlowMenu']=="CFM")  { ?>
				<a href="../config/export-cfm.php?button=report&form=<?php echo strtolower($row['WorkFlowMenu']);?>&id=<?php echo $row['Request_No'];?>" target="_blank" style="padding:2px 4px 2px 2px"  class="btn btn-outline btn-default">   <?php ;} else if($row['WorkFlowMenu']=="FAW")  { ?>
				<a href="../config/export-faw.php?button=report&form=<?php echo strtolower($row['WorkFlowMenu']);?>&id=<?php echo $row['Request_No'];?>" target="_blank" style="padding:2px 4px 2px 2px"  class="btn btn-outline btn-default">  <?php ;} else if($row['WorkFlowMenu']=="ARM")  { ?>
				<a href="../config/export-arm.php?button=report&form=<?php echo strtolower($row['WorkFlowMenu']);?>&id=<?php echo $row['Request_No'];?>" target="_blank" style="padding:2px 4px 2px 2px"  class="btn btn-outline btn-default">  <?php ;} else if($row['WorkFlowMenu']=="PS")  { ?>
				<a href="../config/export-ps.php?button=report&form=<?php echo strtolower($row['WorkFlowMenu']);?>&id=<?php echo $row['Request_No'];?>" target="_blank" style="padding:2px 4px 2px 2px"  class="btn btn-outline btn-default">  <?php ;} ?>  
				<span class="fa fa-file" title="Print and Preview Report <?php echo $row['WorkFlowMenu'];?>"></span></a> </td>
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
