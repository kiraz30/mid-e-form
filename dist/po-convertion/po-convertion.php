<?php 
$showprivilage=mysqli_query($con,"SELECT * from Tb_user_privilage where UserDomain = '$username' 
And Module='po-convertion' And Status='1' ");
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
	
	<style> 
input[type=text] {
  width: 20%;
  height: 30px;
  padding: 10px 10px;
  margin: 2px 2px 2px 2px;
  box-sizing: border-box;
  border: 1px solid #555;
  outline: none;
}

input[type=text]:focus {
  background-color: lightblue;
}
</style>

	<main> 
    <div class="container-fluid"> 
      <h3 class="mt-4">PO Convertion Status</h3>
	    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="../dist/index.php?button=dashboard">Dashboard</a></li>
        <li class="breadcrumb-item active">PO Convertion Status</li>
      </ol>
      <div class="card mb-4">
	  <form action=""  method="post"  >
	  <?php
	  include "../config/connect_sql.php";

        if (isset($_POST['ApprovePO'])) {
		if (is_array(@$_POST['chk'])){
			for($i=0;$i<count(@$_POST['chk']);$i++){
				if($_POST['chk'][$i]<>"")	{
					$chk				=$_POST['chk'][$i];
					$createddate		=date("Y-m-d H:i:s");
					$exe = mysqli_query($con,"SELECT * FROM tb_supplier Where Status=1");
					while(@$row=mysqli_fetch_array($exe)){
						odbc_exec($myConnPO,"UPDATE POHeader SET TransactionStatus='Approved',SupplierConfirmationDate='$createddate',
						UpdatedAt='$createddate',UpdatedBy='$username' WHERE No='".$chk."' And SupplierCode <> '".$row['KDSupplier']."'");
						
						odbc_exec($myConnMIIBPM,"UPDATE General_Workflow_History SET Outcome='1'
						WHERE Process_ID = '46' AND  Outcome ='18' And Transaction_ID IN(SELECT RowNo FROM [POOnline].dbo.POHeader 
						WHERE WorkflowStatus = 'COMPLETED' AND No='".$chk."' And SupplierCode <> '".$row['KDSupplier']."')");
						  
					}
				}
			}
			$message = "PO Succuess is Approved";
			echo "<script type='text/javascript'>alert('$message');</script>";
			echo"<script>  window.location='../dist/index.php?button=po-convertion'; </script>";
		}
		else{
			$message = "Please Select atleast one checkbox";
			echo "<script type='text/javascript'>alert('$message');</script>";
			echo"<script>  window.location='../dist/index.php?button=po-convertion'; </script>";}
		}
       ?>
	
	
   		<div class="card-header">Filter : 
		<input  name="SearchCode" id="SearchCode"  maxlength="50" type="text"  
			  placeholder="Enter PO Number" value="<?php echo $SearchCode ?>"  /> 
			  <input  name="SearchName" id="SearchName"  maxlength="50" type="text"  
			  placeholder="Enter Supplier Code" value="<?php echo $SearchName ?>"  />
			  <button type="submit" name="Refresh" value="Refresh" class="btn btn-primary">Search Filter</button>   
			  </div>
        <div class="card-body"> 
           <div class="table-responsive"> 
			<table name="po-void" id="po-void"  width="100%" class="table  table-striped  table-bordered table-hover" >
              <thead>
                <tr>
				  <th width="1%"><script> function toggle(pilih) { 
			checkboxes = document.getElementsByName('chk[]'); 
			for(var i=0, n=checkboxes.length;i<n;i++) { checkboxes[i].checked = pilih.checked; 
			} } </script> <input type="checkbox" onClick="toggle(this)" title="Select All" /></th>
				  <th>PO Number</th> 
                  <th>Rev</th>
				  <th>PO Date</th>
				  <th>Status</th>
				  <th>Curr</th>
				  <th>Total DPP</th>
				  <th>Supplier Code</th> 
				  <th>Supplier</th> 
				  <th>Created Date</th> 
                  <th width="1%">Action</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
				  <th><button name="ApprovePO" id="ApprovePO" type="submit" value="Approve"
				  onClick=" return ck()" style='padding:1px 1px 1px 1px;' class="btn btn-primary"> 
				  <span class="glyphicon glyphicon-check" title="Update PO Status"></span></button>
				   </th>
				  <th>PO Number</th> 
                  <th>Rev</th>
				  <th>PO Date</th>
				  <th>Status</th>
				  <th>Curr</th>
				  <th>Total DPP</th>
				  <th>Supplier Code</th> 
				  <th>Supplier</th> 
				  <th>Created Date</th> 
                  <th>Action</th>
                </tr>
              </tfoot>
              <tbody>
 <?php
			include "../config/connect_sql.php";
			 $exe = mysqli_query($con,"SELECT * FROM tb_supplier Where Status=1");
			while(@$row=mysqli_fetch_array($exe)){
			/*$query = "SELECT Id,No,Type,VersionNo,TransactionDate,WorkflowStatus,TransactionStatus,
			Currency,SupplierCode,SupplierName,TotalDPP,CreatedAt from POHeader Where TransactionStatus='Void'
			And SupplierCode <> '".$row['KDSupplier']."' ";  */
			
		  $query = "SELECT [Id]
		  ,[RefId]
          ,[Folio]
		  ,[RowNo]
		  ,[No]
		  ,[VersionNo]
		  ,[TransactionDate]
		  ,[SupplierCode]
		  ,[SupplierName]
		  ,[Currency]
		  ,[TotalDPP]
		  ,[WorkflowStatus] + COALESCE(' - ' + a.Action_Name, '') AS [WorkflowStatus]
		  ,format(CreatedAt,  'dd/MM/yyyy hh:mm:ss') CreatedAt 
	  FROM [POOnline].[dbo].[POHeader] poh
	  LEFT JOIN (
		SELECT Transaction_ID, a.Action_Name 
		  FROM [MII.BPM].dbo.General_Workflow_History h
		  LEFT JOIN [MII.BPM].dbo.Template_Master_Action a ON a.ID = h.Outcome
		  WHERE h.ID IN(
			SELECT MAX(ID) FROM [MII.BPM].dbo.General_Workflow_History WHERE Process_ID = 46 GROUP BY Transaction_ID)
			AND h.Transaction_ID IN (SELECT RowNo FROM POHeader WHERE WorkflowStatus = 'COMPLETED') 
		) a ON a.Transaction_ID = poh.RowNo Where poh.SupplierCode <> '".$row['KDSupplier']."' And a.Action_Name='Void'";
		
	 
			

			if ($SearchCode<>""){
				$query= $query. " And No like '%$SearchCode%'";}
			if ($SearchName<>""){
				$query= $query. " And SupplierCode like '%$SearchName%'";}
			$exe = odbc_exec($myConnPO,$query. " Order By poh.No Asc " );
		}
			$no = 1;
			while(@$row =odbc_fetch_array($exe)){
			?>
			  <tr id="<?php echo $row['No']; ?>"> 
				<td><input type="checkbox" name="chk[]" id="chk[]" value="<?php echo $row['No']; ?>"></td>
				<td><?php echo $row['No'];?></td>
				<td><?php echo $row['VersionNo'];?></td>
				<td><?php echo $row['TransactionDate'];?></td>
				<td><?php echo $row['WorkflowStatus'];?></td>
				<td><?php echo $row['Currency'];?></td>
				<td align="right"><?php echo number_format($row['TotalDPP'],2);?></td>
				<td><?php echo $row['SupplierCode'];?></td>
				<td><?php echo $row['SupplierName'];?></td>
				<td><?php echo $row['CreatedAt'] ;?></td>
				<td align="center"><a href="../dist/index.php?button=po-approve&id=<?php echo $row['No'];?>" 
				onClick=" return checkApprove()">
					<span class="glyphicon glyphicon-check" title="Approve PO No <?php echo $row['No'];?>"> </span>
					
					</a> 
				 </td>
			  </tr>
			  <?php $no++;} ?>

              </tbody>
            </table>
		</div>
        </div>
      </div>
	  </form>
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
        $('#po-void').DataTable({
            responsive: true
        });
    });
    </script>

	<script language="JavaScript" type="text/javascript">
	function checkApprove(){
		return confirm('Are you sure you want to Approve this data PO?');
	}
 
	</script>
 
	
	
	
	
    </body>
</html>
<?php };?>

<script>
$(document).ready(function(){
 
 $('#ApprovePO').click(function(){
  
  if(confirm("Are you sure you want to Approve this data PO?"))
  {
   var AppPO = [];
   
   $(':checkbox:checked').each(function(i){
    AppPO[i] = $(this).val();
   });
   
   if(AppPO.length === 0) //tell you if the array is empty
   {
    alert("Chekcbox data terlebih dahulu");
	   return false;

   }
   else
   {
    $.ajax({
     url:'po-convertion/po-convertion.php',
     method:'POST',
     data:{AppPO:AppPO},
     success:function()
     {
      for(var i=0; i<AppPO.length; i++)
      {
       $('tr#'+AppPO[i]+'').css('background-color', '#ccc');
       $('tr#'+AppPO[i]+'').fadeOut('slow');
	   location.reload();
      }
     }
    });
   }
  }
  else
  {
   return false;
  }
 });
 
});
</script>

