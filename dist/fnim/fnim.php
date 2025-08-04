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
      <h3 class="mt-4">Final Name Internal Memo (FNIM)</h3>
	    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="../dist/index.php?button=dashboard">Dashboard</a></li>
        <li class="breadcrumb-item active">Final Name Internal Memo (FNIM)</li>
      </ol>
      <div class="card mb-4">
   		<div class="card-header"><a class="btn btn-primary" href="../dist/index.php?button=add-fnim">New Request FNIM</a></div>
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
				  <th  width="1%">MCJ</th>
				  <th height="10">Status</th>
                  <th width="11%">Action</th>
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
				  <th>MCJ File</th>
				  <th>Status</th>
                  <th>Action</th>
                </tr>
              </tfoot>
              <tbody>
          <?php
		  $uploadDirFileMcj	 			= "../img/Mcj/";
		  	if ($level=="ADMINISTRATOR"){
				$query="SELECT ID_No,Request_No,Last_Request_No,Status_Last_Document,Project_Name,Type_Request,
				CreatedBy,date(CreatedDate) as Created_Date,Mcj,Status_FNIM FROM tb_fnim Order By CreatedDate DESC";}
			else{
				$query="SELECT ID_No,Request_No,Last_Request_No,Status_Last_Document,Project_Name,Type_Request,
				CreatedBy,date(CreatedDate) as Created_Date,Mcj,Status_FNIM FROM tb_fnim  Where CreatedBy ='$username' Order By CreatedDate DESC";}
			$exe = mysqli_query($con,$query);
			$no = 1;
			while(@$row =mysqli_fetch_array($exe)){
				if (@$row['Status_FNIM']<>"Draft")
		  			{$disabled="disabled";} else {$disabled="";}
			?>
			  <tr> 
				<td><?php echo $no;?></td>
				<td><?php echo $row['Request_No'];?></td>
				<td><?php echo $row['Created_Date'];?> </td>
				<td><?php echo $row['Project_Name'];?></td>
				<td><?php echo $row['Type_Request'];?></td>
				<td><?php echo $row['CreatedBy'];?></td>
				<td align="center"><?php if (!empty($row['Mcj'])){?>
			  	<img height="20" width="20" src=../img/pdf.png  title="<?php echo $row['Mcj'];?>"
				onClick="popupwindow('../config/open-pdf.php?folder=<?php echo $uploadDirFileMcj; ?>&pdfname=mcj&kd=<?php echo $row['Request_No']; ?>&page=fnim','Preview Pdf','700','1000');">
			  	<?php }  ?></td>
				<td><?php echo $row['Status_FNIM'];?></td>

				<td align="center" ><button style="padding:2px 4px 2px 2px" class="btn btn-outline btn-default">
		 
		 <?php if ($row['Status_FNIM']=="Revise"){
				echo '<a href="../dist/index.php?button=revise-fnim&id='.$row['Request_No'].'">';
				}else{
				echo '<a href="../dist/index.php?button=edit-fnim&id='.$row['Request_No'].'">';
				}?>
				<span class="fa fa-edit" title="Edit FNIM"></span></a></button>	
				<button style="padding:2px 4px 2px 2px" class="btn btn-outline btn-default">
				<a href="#">
				<span onClick="popupwindow('../dist/page.php?form=workflow&id=<?php echo $row['Request_No'];?>&pg=fnim','FNIM','400','1000');" 
				class="fa fa-user" title="Preview Work Flow" ></span></a></button>					
				<button style="padding:2px 4px 2px 2px" class="btn btn-outline btn-default">
				<a href="#">
				<span onClick="popupwindow('../dist/page.php?form=privew-fnim&id=<?php echo $row['Request_No'];?>','TEST','700','1000');"
				class="fa fa-file" title="Preview Report"></span> </a> </button>
				
				<?php if ($row['Status_FNIM']=="Complete By MCJ" & $row['Status_Last_Document']=="1"){ ?>
				 	<button style="padding:2px 4px 2px 2px" class="btn btn-outline btn-default">
					<a href="../dist/index.php?button=add-revise-fnim&id=<?php echo $row['Request_No'];?>">
					<span class="glyphicon glyphicon-duplicate" title="Revise FNIM"></span></a></button>	
				 
				<?php }?>
				<a href="../config/delete-exe.php?pg=del-fnim&id=<?php echo $row['Request_No'];?>">
				 <button style="padding:2px 4px 2px 2px;margin:1px 1px 1px 1px;" class="btn btn-danger glyphicon glyphicon-trash"  
				 onClick="return checkDelete();" <?php echo $disabled; ?> >
				</button></a>

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
		return confirm('Are you sure you want to delete this Request?');
	}
	</script>
    </body>
</html>
