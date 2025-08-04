<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>FAW - E-Form</title>
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
      <h3 class="mt-4">Final Art Work (FAW)</h3>
	    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="../dist/index.php?button=dashboard">Dashboard</a></li>
        <li class="breadcrumb-item active">Final Art Work (FAW)</li>
      </ol>
      <div class="card mb-4">
   		<div class="card-header"><a class="btn btn-primary" href="../dist/index.php?button=add-faw">New Request FAW</a></div>
        <div class="card-body"> 
          <div class="table-responsive"> 
		  <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
              <thead>
                <tr bgcolor="#999999">
				  <th width="1%">No</th> 
				  <th width="15%">Request No</th> 
				  <th width="8%">Request Date</th>
                  <th width="15%"> CFM Request No</th>
				  <th width="8%">No Urut Product</th>
				  <th>Product Name</th>
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
                  <th>Master Product Request No</th>
				  <th>No Urut Product</th>
				  <th>Product Name</th>
				  <th>Created By</th>
				  <th>Status</th>
                  <th>Action</th>
                </tr>
              </tfoot>
              <tbody>
          <?php
		  $query="SELECT a.ID_No,a.Index_Document,a.Request_No,a.Last_Request_No,a.Status_Last_Document,
		  a.CFM_Code,b.FNIM_Code, c.Request_No AS MPR_Code,b.ID_No_FNIMDetail, f.Code_Product,d.Product_Name,
		d.Status_Product,c.Type_Request,g.Country,a.Remark,a.Status_FAW,
		a.CreatedBy,date(a.CreatedDate) as Created_Date FROM 				
		tb_faw a INNER JOIN tb_cfm b ON a.CFM_Code =b.Request_No
		INNER JOIN tb_fnim c ON b.FNIM_Code =c.Request_No
		INNER JOIN tb_fnim_detail d ON b.ID_No_FNIMDetail =d.ID_No
		LEFT JOIN tb_mpr e ON c.Request_No=e.FNIM_Code
		LEFT JOIN tb_mpr_detail f ON e.Request_No=f.Request_No AND f.ID_NoFNIMDetail= d.ID_No
		LEFT JOIN tb_fnim_country g ON b.ID_No_FNIM_Country=g.ID_No ";
		  	if ($level=="ADMINISTRATOR"){
				$query=$query;}
			else{
				$query=$query." Where a.CreatedBy ='$username' ";}
			$exe = mysqli_query($con,$query." GROUP BY a.Request_No Order By a.CreatedDate DESC" );
			$no = 1;
			while(@$row =mysqli_fetch_array($exe)){
			?>
			  <tr> 
				<td><?php echo $no;?></td>
				<td><?php echo $row['Request_No'];?></td>
				<td><?php echo $row['Created_Date'];?> </td>
				<td><?php echo $row['CFM_Code'];?></td>
				<td><?php echo $row['Code_Product'];?></td>
				<td><?php echo $row['Product_Name'];?></td>
				<td><?php echo $row['CreatedBy'];?></td>

				<td><?php echo $row['Status_FAW'];?></td>

				<td align="center"><button style="padding:0px 0px 0px 0px">
		 
		 <?php if ($row['Status_FAW']=="Revise"){
				echo '<a href="../dist/index.php?button=revise-faw&id='.$row['Request_No'].'">';
				}else{
				echo '<a href="../dist/index.php?button=edit-faw&id='.$row['Request_No'].'">';
				}?>
				<span class="fa fa-edit" title="Edit FAW"></span></a></button>	
				<button style="padding:0px 0px 0px 0px">
				<a href="#">
				<span onClick="popupwindow('../dist/page.php?form=workflow&id=<?php echo $row['Request_No'];?>&pg=faw','FAW','400','1000');" 
				class="fa fa-user" title="Preview Work Flow" ></span></a></button>					
				<button style="padding:0px 0px 0px 0px">
				<a href="#">
				<span onClick="popupwindow('../dist/page.php?form=privew-faw&id=<?php echo $row['Request_No'];?>','FAW','700','1000');"
				class="fa fa-file" title="Preview Report"></span> </a> </button>
				
				<?php if ($row['Status_FAW']=="Complete" & $row['Status_Last_Document']=="1"){ ?>
				 	<button style="padding:0px 0px 0px 0px">
					<a href="../dist/index.php?button=add-revise-faw&id=<?php echo $row['Request_No'];?>">
					<span class="glyphicon glyphicon-duplicate" title="Revise FAW"></span></a></button>	
				 
				<?php }?>
				 <button style="padding:0px 0px 0px 0px"  onClick="return checkDelete();">
				 <a href="../config/delete-exe.php?pg=del-faw&id=<?php echo $row['Request_No'];?>">
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
