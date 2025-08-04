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
      <h3 class="mt-4">Master Product Request (MPR)</h3>
	    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="../dist/index.php?button=dashboard">Dashboard</a></li>
        <li class="breadcrumb-item active">Master Product Request (MPR)</li>
      </ol>
      <div class="card mb-4">
   		<div class="card-header"><a class="btn btn-primary" href="../dist/index.php?button=add-mpr">New Master Product Request (MPR)</a></div>
        <div class="card-body"> 
          <div class="table-responsive"> 
		  <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
              <thead>
                <tr bgcolor="#999999">
				  <th width="1%">No</th> 
				  <th width="15%">Request No</th> 
				  <th width="8%">Request Date</th>
                  <th>Project Name</th>
				  <th width="8%">Type Request</th>
				  <th width="10%">Created By</th>
				  <th height="10">Status</th>
                  <th width="10%">Action</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
				  <th>No</th> 
				  <th>Request No</th>
				  <th>Request Date</th> 
                  <th>Project Name</th>
				  <th>Type Request</th>
				  <th>Created By</th>
				  <th>Status</th>
                  <th>Action</th>
                </tr>
              </tfoot>
              <tbody>
          <?php
		  	if ($level=="ADMINISTRATOR"){
				$query="SELECT ID_No,Request_No,Project_Name,Type_Request,
				CreatedBy,date(CreatedDate) as CreatedDate,Status_MPR FROM tb_MPR Order By CreatedDate Desc";}
			else{
				$query="SELECT ID_No,Request_No,Project_Name,Type_Request,
				CreatedBy,date(CreatedDate) as CreatedDate,Status_MPR FROM tb_mpr  Where CreatedBy ='$username' 
				Order By CreatedDate Desc";}
			$exe = mysqli_query($con,$query);
			$no = 1;
			while(@$row =mysqli_fetch_array($exe)){
			?>
			  <tr> 
				<td><?php echo $no;?></td>
				<td><?php echo $row['Request_No'];?></td>
				<td><?php echo $row['CreatedDate'];?> </td>
				<td><?php echo $row['Project_Name'];?></td>
				<td><?php echo $row['Type_Request'];?></td>
				<td><?php echo $row['CreatedBy'];?></td>
				<td><?php echo $row['Status_MPR'];?></td>

				<td align="center"><button style="padding:0px 0px 0px 0px">
		 
		 <?php if ($row['Status_MPR']=="Revise"){
				echo '<a href="../dist/index.php?button=revise-mpr&id='.$row['Request_No'].'">';
				}else{
				echo '<a href="../dist/index.php?button=edit-mpr&id='.$row['Request_No'].'">';
				}?>
				<span class="fa fa-edit" title="Edit MPR"></span></a></button>	
								
				<button style="padding:0px 0px 0px 0px">
				<a href="#"><span onClick="popupwindow('../dist/page.php?form=workflow&id=<?php echo $row['Request_No'];?>&pg=mpr','mpr','400','1000');" 
				class="fa fa-user" title="Preview Work Flow" ></span></a></button>	
				
				<button style="padding:0px 0px 0px 0px">
				<a href="#"><span onClick="popupwindow('../dist/page.php?form=privew-mpr&id=<?php echo $row['Request_No'];?>','Preview Report','1000','1000',left= '1000',top= '1000',screenX= '1000',screenY= '1000');"
				class="fa fa-file" title="Preview Report"></span> </a>  </button>
				
				
				
				 <button style="padding:0px 0px 0px 0px"  onClick="return checkDelete();">
				 <a href="../config/delete-exe.php?pg=del-mpr&id=<?php echo $row['Request_No'];?>">
				 <span   class="glyphicon glyphicon-trash" title="Delete Request"></span></a></button> </td>
				 
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
		return confirm('Are you sure you want to delete this Request?');
	}
	</script>
    </body>
</html>
