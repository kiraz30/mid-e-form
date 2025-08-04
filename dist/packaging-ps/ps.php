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
      <h3 class="mt-4">Packaging Spesification</h3>
	    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="../dist/index.php?button=dashboard">Dashboard</a></li>
        <li class="breadcrumb-item active">Packaging Spesification</li>
      </ol>
      <div class="card mb-4">
	  <div class="card-header"><a class="btn btn-primary" href="../dist/index.php?button=ps-add"> Add Packaging Spesification</a></div>
        <div class="card-body"> 
          <div class="table-responsive"> 
		  <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
              <thead>
                <tr bgcolor="#999999">
				  <th width="1%">No</th> 
				  <th width="15%">Request No</th> 
				  <th width="15%">Add Master Request No  </th>  
				  <th width="15%">Master Product Request No  </th> 
				  <th width="10%">Finish Good Code</th> 
				  <th width="20%">Finish Good Name  </th> 
				  <th width="8%">Created Date</th>
				  <th width="10%">Created By</th>
				  <th height="10">Status</th>
                  <th width="10%">Action</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
				  <th>No</th> 
				  <th>Request No</th>
				  <th>Add Master Request No  </th>  
				  <th>Master Product Request No  </th>  
				  <th>Finish Good Code</th> 
				  <th>Finish Good Name  </th> 
				  <th>Created Date</th>
				  <th>Created By</th>
				  <th>Status</th>
                  <th>Action</th>
                </tr>
              </tfoot>
              <tbody>
          <?php
		  	if ($level=="ADMINISTRATOR"){
				$query="SELECT a.Request_No,a.Index_Document,a.Last_Request_No,a.Status_Last_Document,
				a.ARM_Code,a.MPR_Code,a.Finish_Good_Code,a.Finish_Good_Name,
				a.CreatedBy,DATE(a.CreatedDate) as CreatedDate,a.Status_Spec
				 FROM  tb_packdev_spec a 
				 LEFT JOIN tb_packdev_add_resource b ON a.ARM_Code=b.Request_No
				 Order By a.CreatedDate Desc";}
			else{
				$query="SELECT a.Request_No,a.Index_Document,a.Last_Request_No,a.Status_Last_Document,
				a.ARM_Code,a.MPR_Code,a.Finish_Good_Code,a.Finish_Good_Name,
				a.CreatedBy,DATE(a.CreatedDate) as CreatedDate,a.Status_Spec
				 FROM  tb_packdev_spec a 
				 LEFT JOIN tb_packdev_add_resource b ON a.ARM_Code=b.Request_No
					Where a.CreatedBy ='$username' OR Status_Spec='Complete' Order By a.CreatedDate Desc";
			}
			$exe = mysqli_query($con,$query);
			$no = 1;
			while(@$row =mysqli_fetch_array($exe)){
				if (@$row['Status_Spec']<>"Draft" && @$row['Status_Spec']<>"Cancel")
		  			{$disabled="disabled";} else {$disabled="";}
			?>
			  <tr> 
				<td><?php echo $no;?></td>
				<td><?php echo $row['Request_No'];?></td>
				<td><?php echo $row['ARM_Code'];?> </td>
				<td><?php echo $row['MPR_Code'];?> </td>
				<td><?php echo $row['Finish_Good_Code'];?></td>
				<td><?php echo $row['Finish_Good_Name'];?> </td>
				<td><?php echo $row['CreatedDate'];?> </td>
				<td><?php echo $row['CreatedBy'];?></td>
				<td><?php echo $row['Status_Spec'];?></td>
				<td align="center">

				<button style="padding:2px 4px 2px 2px;margin:1px 1px 1px 1px;" class="btn btn-outline btn-default">
		 
				<?php if ($row['Status_Spec']=="Revise"){
				echo '<a href="../dist/index.php?button=revise-ps&id='.$row['Request_No'].'">';
				}else{
				echo '<a href="../dist/index.php?button=ps-edit&id='.$row['Request_No'].'">';
				}?>
				<span class="fa fa-edit" title="Edit Packaging Spesification"></span></a></button>	
								 
				<button style="padding:2px 4px 2px 2px;margin:1px 1px 1px 1px;" class="btn btn-outline btn-default">
				<a href="#"><span onClick="popupwindow('../dist/page.php?form=workflow&id=<?php echo $row['Request_No'];?>&pg=ps','arm','400','1000');" 
				class="fa fa-user" title="Preview Work Flow" ></span></a></button>	
				<?php if ($row['Status_Spec']!="Revise"){ ?>
				<button style="padding:2px 4px 2px 2px;margin:1px 1px 1px 1px;" class="btn btn-outline btn-default">
				<a href="#"><span onClick="popupwindow('../dist/page.php?form=privew-ps&id=<?php echo $row['Request_No'];?>','Preview Report','1000','1000',left= '1000',top= '1000',screenX= '1000',screenY= '1000');"
				class="fa fa-print" title="Preview Report"></span> </a>  </button>
				<?php }?>
				<?php if ($row['Status_Spec']=="Complete"){ ?>
				<button style="padding:2px 4px 2px 2px ;margin:1px 1px 1px 1px;" class="btn btn-outline btn-default">
					<a href="../dist/index.php?button=add-copy-ps&id=<?php echo $row['Request_No'];?>">
					<span class="glyphicon glyphicon-copyright-mark" title="Copy Packaging Spesification"></span></a></button>	
				<?php }?>
				<?php if ($row['Status_Spec']=="Complete" & $row['Status_Last_Document']=="1"){ ?>
					<button style="padding:2px 4px 2px 2px ;margin:1px 1px 1px 1px;" class="btn btn-outline btn-default">
					<a href="../dist/index.php?button=add-revise-ps&id=<?php echo $row['Request_No'];?>">
					<span class="glyphicon glyphicon-duplicate" title="Revise Packaging Spesification"></span></a></button>	
				<?php }?>
		
				 <a href="../config/delete-exe.php?pg=del-ps&id=<?php echo $row['Request_No'];?>">
				 <button  type="button"  style="padding:2px 4px 2px 2px;margin:1px 1px 1px 1px;" 
				 class="btn btn-danger glyphicon glyphicon-trash" onClick="return checkDelete();" 
				 <?php echo $disabled; ?>></button>				
				</a> 
				
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

 
 