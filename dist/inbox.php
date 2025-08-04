<?php 
$showprivilage=mysqli_query($con,"SELECT * from Tb_user_privilage where UserDomain = '$username' 
And Module='inbox' And Status='1' ");
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
      <h3 class="mt-4">Inbox</h3>
	    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="index.php?button=dashboard">Dashboard</a></li>
        <li class="breadcrumb-item active">Inbox</li>
      </ol>
      <div class="card mb-4">
   		<div class="card-header">   </div>
        <div class="card-body"> 
           <div class="table-responsive"> 
		  <table width="100%" class="table table-striped table-bordered table-hover" 
		  id="dataTables-example" >
              <thead>
                <tr>
				  <th width="1%">No<?php echo $position ?></th>
				  <th>Request No</th> 
				  <th>Thema Name</th> 
				  <th>Request Date</th>
                  <th>Request Type</th>
				  <th>Remark</th>
				  <th>Activity</th>
                  <th width="2%">Action</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
				  <th width="1%">No </th> 
				  <th>Request No</th> 
				  <th>Thema Name</th>
				  <th>Request Date</th> 
                  <th>Request Type</th>
				  <th>Remark</th>
				  <th>Activity</th>
                  <th width="2%">Action</th>
                </tr>
              </tfoot>
              <tbody>
          <?php
		  	$query ="SELECT ID_No,Request_No,Request_Date,Thema_Name,Request_Type,Request_Status,Remark,
			NameApproval,OnBehalf,ReadInbox,WorkFlowMenu FROM tb_inbox Where 
			Request_Status !='C'  And (NameApproval= '$username' Or OnBehalf='$username')
			UNION ALL
			SELECT a.ID_No,a.Request_No,a.CreatedDate Request_Date, a.Project_Name Thema_Name, 
			a.Subject Request_Type,a.LAST_TRACK Request_Status,a.Remark,
			e.PositionName NameApproval,e.PositionName OnBehalf,  a.ReadInbox, 'prod-arm' WorkFlowMenu  FROM tb_prod_add_resource a
			INNER JOIN param_tracking b ON a.LAST_TRACK=b.CODE AND b.KODE_JENIS_PROSES=1
			INNER JOIN tb_user c ON a.CreatedBy=c.UserDomain 
			INNER JOIN param_tracking_access d ON a.LAST_TRACK=d.TRACKING_CODE
			INNER JOIN tb_position e ON d.ROLE_APPLICATION_CODE= e.KDPosition
			WHERE e.KDPosition='$position' And  a.LAST_TRACK !=8 ";

			$exe = mysqli_query($con,$query." Order By Request_Date DESC");
			$no = 1;
			while(@$row =mysqli_fetch_array($exe)){
			?>
			  <tr> 
			   
				<td><?php if ($row['ReadInbox']==0) {echo "<b>";} echo $no;?></td>
				<td><?php if ($row['ReadInbox']==0) {echo "<b>";} echo $row['Request_No'];?></td>
				<td><?php if ($row['ReadInbox']==0) {echo "<b>";} echo $row['Thema_Name'];?></td>
				<td><?php if ($row['ReadInbox']==0) {echo "<b>";} echo $row['Request_Date'];?></td>
				<td><?php if ($row['ReadInbox']==0) {echo "<b>";} echo $row['Request_Type'];?></td>
				<td><?php if ($row['ReadInbox']==0) {echo "<b>";} echo $row['Remark'];?></td>
				<td>
				<?php if ($row['WorkFlowMenu']!="prod-arm") { ?> 
					<button style="padding:2px 4px 2px 2px;margin:1px 1px 1px 1px;" class="btn btn-outline btn-default">
					<a href="#"><span onClick="popupwindow('page.php?form=workflow&id=<?php echo $row['Request_No'];?>&pg=<?php echo strtolower($row['WorkFlowMenu']);?>','<?php $row['WorkFlowMenu'];?>','1000','1000',left= '1000',top= '1000',screenX= '1000',screenY= '1000');"
					class="fa fa-user" title="Preview Workflow" ></span></a></button>
				<?php }else{  ?>
				<button style="padding:2px 4px 2px 2px;margin:1px 1px 1px 1px;" class="btn btn-outline btn-default">
				<a href="#"><span onClick="popupwindow('../dist/page.php?form=tracking&id=<?php echo $row['Request_No'];?>&pg=<?php echo strtolower($row['WorkFlowMenu']);?>','<?php echo strtolower($row['WorkFlowMenu']);?>','400','1000');" 
				class="fa fa-user" title="Preview Work Flow" ></span></a></button>	
				<?php }  ?>
				
				<button style="padding:2px 4px 2px 2px;margin:1px 1px 1px 1px;" class="btn btn-outline btn-default">
				<a href="#"><span onClick="popupwindow('../dist/page.php?form=privew-<?php echo strtolower($row['WorkFlowMenu']);?>&id=<?php echo $row['Request_No'];?>','Preview Report','1000','1000',left= '1000',top= '1000',screenX= '1000',screenY= '1000');"
				class="fa fa-print" title="Preview Report"></span> </a>  </button>


				<?php if ($row['ReadInbox']==0) {echo "<b>";} 
				if ($row['Request_Status'] =="R"){$Status="Revise";} else  {$Status="Approval";}
				echo "Waitting ".$Status." By ".$row['NameApproval'];?> 
				<?php 
				if ($row['Request_Status']=="CMID"){ echo "Complete By MID";} 
				if($row['OnBehalf']!="" && $row['OnBehalf']!="-") {echo $row['OnBehalf'];} ?></td> 
				<td align="center">
				 
				<button style="padding:2px 4px 2px 2px" class="btn btn-outline btn-default">
				 <?php if ($row['Request_Status']=="R"){ ?>
						<a href="../dist/index.php?button=revise-<?php echo strtolower($row['WorkFlowMenu']);?>&id=<?php echo $row['Request_No'];?>">
				<?php }elseif ($row['Request_Status']=="CMID"){ ?>
						<a href="../dist/index.php?button=edit-<?php echo strtolower($row['WorkFlowMenu']);?>&id=<?php echo $row['Request_No'];?>">
				 <?php		}else{  ?>
						<a href="../dist/index.php?button=<?php echo strtolower($row['WorkFlowMenu']);?>-app&id=<?php echo $row['Request_No'];?>">
				 <?php	}  ?>
						<span class="glyphicon glyphicon-search" title="Preview Approval"></span></a> 
				 </button> 
				 <?php if ($row['Request_Status']<>"CMID"){ ?>
				 <button style="padding:2px 4px 2px 2px" class="btn btn-outline btn-default">
						
						<a onClick="return checkRevise()" href="../config/revise.php?pg=<?php echo strtolower($row['WorkFlowMenu']);?>&id=<?php echo $row['Request_No'];?>">
						<span class="glyphicon glyphicon-minus-sign" title="Revision"></span></a>
					
				  </button>
				  <?php	}  ?></td>
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
	<script>

	function checkRevise(){
		return confirm('Are you sure you want to Revise?');
	}
	 </script>

    </body>
</html>
<?php };?>