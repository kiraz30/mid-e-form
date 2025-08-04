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
        <link href="../vendor/datatables/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="../font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
		
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
      <h3 class="mt-4">Additional Resource Master Factory 2</h3>
	    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="../dist/index.php?button=dashboard">Dashboard</a></li>
        <li class="breadcrumb-item active">Additional Resource Master Factory 2</li>
      </ol>
      <div class="card mb-4">
   		<div class="card-header"><a class="btn btn-primary" href="../dist/index.php?button=arm-f2-add">New Additional Resource Master Factory 2</a></div>
        <div class="card-body"> 
          <div class="table-responsive"> 
		  <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
              <thead>
                <tr bgcolor="#999999">
				  <th width="1%">No</th> 
				  <th width="15%">Request No</th> 
				  <th width="15%">Master Product Request No  </th> 
				  <th width="20%">Product Name  </th> 
				  <th width="8%">Request Date</th>
				  <th width="10%">Created By</th>
				  <th height="10">Remark</th>
				  <th height="10">Status</th>
                  <th width="10%">Action</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
				  <th>No</th> 
				  <th>Request No</th>
				  <th>Master Product Request No  </th> 
				  <th>Product Name  </th> 
				  <th>Request Date</th>
				  <th>Created By</th>
				  <th>Remark</th>
				  <th>Status</th>
                  <th>Action</th>
                </tr>
              </tfoot>
              <tbody>
          <?php
		  	if ($level=="ADMINISTRATOR"){
				$query="SELECT ID_No,Request_No,MPR_Code,Last_Request_No,Status_Last_Document,Project_Name,CreatedBy,date(CreatedDate) as CreatedDate,
				Status_add_resource,Remark FROM tb_packdev_add_resource_f2 Order By CreatedDate Desc";}
			else{
				$query="SELECT ID_No,Request_No,MPR_Code,Last_Request_No,Status_Last_Document,Project_Name,CreatedBy,date(CreatedDate) as CreatedDate,
				Status_add_resource,Remark FROM tb_packdev_add_resource_f2  
				Where CreatedBy ='$username' OR Status_add_resource='Complete' Order By CreatedDate Desc";}
			$exe = mysqli_query($con,$query);
			$no = 1;
			while(@$row =mysqli_fetch_array($exe)){
				if (@$row['Status_add_resource']<>"Draft")
		  		{$disabled="disabled";		
				} else{$disabled="";}
			?>
			  <tr> 
				<td><?php echo $no;?></td>
				<td><?php echo $row['Request_No'];?></td>
				<td><?php echo $row['MPR_Code'];?> </td>
				<td><?php echo $row['Project_Name'];?> </td>
				<td><?php echo $row['CreatedDate'];?> </td>
				<td><?php echo $row['CreatedBy'];?></td>
				<td><?php echo $row['Remark'];?></td>
				<td><?php echo $row['Status_add_resource'];?></td>

				<td align="center">

				<button style="padding:2px 4px 2px 2px;margin:1px 1px 1px 1px;" class="btn btn-outline btn-default">
		 
				<?php if ($row['Status_add_resource']=="Revise"){
				echo '<a href="../dist/index.php?button=revise-arm-f2&id='.$row['Request_No'].'">';
				}else{
				echo '<a href="../dist/index.php?button=arm-f2-edit&id='.$row['Request_No'].'">';
				}?>
				<span class="fa fa-edit" title="Edit ARM"></span></a></button>	
								
				<button style="padding:2px 4px 2px 2px;margin:1px 1px 1px 1px;" class="btn btn-outline btn-default">
				<a href="#"><span onClick="popupwindow('../dist/page.php?form=workflow&id=<?php echo $row['Request_No'];?>&pg=arm-f2','arm-f2','400','1000');" 
				class="fa fa-user" title="Preview Work Flow" ></span></a></button>	
				
				<button style="padding:2px 4px 2px 2px;margin:1px 1px 1px 1px;" class="btn btn-outline btn-default">
				<a href="#"><span onClick="popupwindow('../dist/page.php?form=privew-arm-f2&id=<?php echo $row['Request_No'];?>','Preview Report','1000','1000',left= '1000',top= '1000',screenX= '1000',screenY= '1000');"
				class="fa fa-file" title="Preview Report"></span> </a>  </button>
				<?php if ($row['Status_add_resource']=="Complete"){ ?>
				<button style="padding:2px 4px 2px 2px ;margin:1px 1px 1px 1px;" class="btn btn-outline btn-default">
					<a href="../dist/index.php?button=add-copy-arm-f2&id=<?php echo $row['Request_No'];?>">
					<span class="glyphicon glyphicon-copyright-mark" title="Copy ARM"></span></a></button>	
				<?php }?>

				<?php if ($row['Status_add_resource']=="Complete" & $row['Status_Last_Document']=="1"){ ?>
				 	<button style="padding:2px 4px 2px 2px;margin:1px 1px 1px 1px;" class="btn btn-outline btn-default">
					<a href="../dist/index.php?button=add-revise-arm-f2&id=<?php echo $row['Request_No'];?>">
					<span class="fa fa-paste" title="Revise ARM"></span></a></button>	
				 
				<?php } if ($row['Status_add_resource']=="Draft" ){ ?>
				 <a href="../config/delete-exe.php?pg=del-arm&id=<?php echo $row['Request_No'];?>">
				 <button style="padding:2px 4px 2px 2px;margin:1px 1px 1px 1px;" class="btn btn-danger glyphicon glyphicon-trash"  onClick="return checkDelete();" <?php echo $disabled; ?> >
				</button></a>
				<?php }?>
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
     

	</script>
		<script src="../vendor/jquery/jquery.min.js"></script>
	<!-- Bootstrap Core JavaScript -->
	<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
	<!-- Metis Menu Plugin JavaScript -->
	<script src="../vendor/metisMenu/metisMenu.min.js"></script>
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


 
 