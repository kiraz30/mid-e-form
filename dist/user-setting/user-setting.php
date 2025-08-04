<!DOCTYPE html>
<html lang="en">

<script type="text/javascript">
function popitup(url) {
newwindow=window.open(url,'TEST','height=200,width=150' );
if (window.focus) {newwindow.focus()}
return false;
}

function popupwindow(url, title, h, w) {
  var left = (screen.width/2)-(w/2);
  var top = (screen.height/2)-(h/2);
  return window.open(url, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
  return false;
} 
</script>

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
	<main> 
    <div class="container-fluid"> 
      <h3 class="mt-4">User Setting</h3>
      <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="../dist/index.php?button=dashboard">Dashboard</a></li>
        <li class="breadcrumb-item active">User Setting</li>
      </ol>
      <div class="card mb-4"> 
   		<div class="card-header"><a class="btn btn-primary" href="../dist/index.php?button=add-user-setting">Add User Setting</a>  
		</div>
	
        <div class="card-body" > 
           <div class="table-responsive"> 
		  <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
              <thead>
                <tr>
				  <th width="1%">No</th>
				  <th>User Domain</th> 
                  <th>Name</th>
                  <th>Division</th>
				  <th>Position</th>
				  <th>Email</th>
				  <th>Level</th>
				  <th>Sign Picture</th>
				  <th>Status</th>
                  <th width="1%">Action</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
				  <th>No</th>
				  <th>User Domain</th>  
                  <th>Name</th>
                  <th>Division</th>
				  <th>Position</th>
				  <th>Email</th>
				  <th>Level</th>
				  <th>Sign Picture</th>
				  <th>Status</th>
                  <th width="1%">Action</th>
                </tr>
              </tfoot>
              <tbody>

				<?php
				/*$caripenghuni =mysqli_query($con,"Select UserDomain FROM tb_user  ");
				while($caridatapenghuni =mysqli_fetch_array(@$caripenghuni)){
					$cari =mysqli_query($con,"Select Module,TitleName,Status FROM tb_privilage Where Module= 'cfm'");
					while($caridata =mysqli_fetch_array(@$cari)){
						mysqli_query($con,"Insert INTO tb_user_privilage (UserDomain,Module,Status) 
						values ('$caridatapenghuni[UserDomain]','$caridata[Module]','$caridata[Status]')");
					}
				}*/
				
				
				$exe = mysqli_query($con,"SELECT a.UserDomain,a.Name,a.Email,b.DivisionName,c.PositionName,a.StatusUser,a.SignIN,a.`Level` FROM tb_user a Inner Join tb_Division b 
				ON a.KDDivision=b.KDDivision Inner Join tb_Position c On a.KDPosition=c.KDPosition Order By  a.UserDomain ASC ");
				$no = 1;
				while(@$row =mysqli_fetch_array($exe)){
				?>
				<tr> 
					<td><?php echo $no;?></td>
					<td><?php echo $row['UserDomain'];?></td>
					<td><?php echo $row['Name'];?></td>
					<td><?php echo $row['DivisionName'];?></td>
					<td><?php echo $row['PositionName'];?></td>
					<td><?php echo $row['Email'];?></td>
					<td><?php echo $row['Level'];?></td>
					<td align="center"><img height="20" width="20" title= 	"Signature" onClick="popupwindow('user-setting/user-setting-popup.php?id=<?php echo $row['UserDomain'];?>&pg=user-setting','TEST','200','150')"
					src="<?php if (empty($row['SignIN'])){ echo"Sign/empty.png";} else { echo "Sign/".$row['SignIN'];} ?>"></td>
					<td> <?php if (@$row['StatusUser']=='1') {echo "Active";} else {echo "Non Active";}?> </td>
					<td align="center">
					<a href="../dist/index.php?button=edit-user-setting&id=<?php echo $row['UserDomain'];?>">
					<span class="fa fa-edit" title="Edit User Setting"></span></a> 
					<a href="../dist/index.php?button=user-setting-privilage&id=<?php echo $row['UserDomain'];?>">
					<span class="glyphicon glyphicon-list" title="Setting Privilage Menu E-Form"></span></a>  
					<a onClick="return checkDelete()" href="../config/delete-exe.php?pg=del-user-setting&id=<?php echo $row['UserDomain'];?>">
					<i class="fas fa-trash-alt ic-w mr-1" title="Delete User Setting"></i></a></td>
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
		return confirm('Are you sure you want to delete this data?');
	}
	</script>
    </body>
</html>
