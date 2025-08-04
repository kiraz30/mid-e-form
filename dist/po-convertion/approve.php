<?php
include "../config/connect_sql.php";

$createddate			=date("Y-m-d H:i:s");
if(isset($_POST["AppPO"])){
	foreach($_POST["AppPO"] as $id) {
		$exe = mysqli_query($con,"SELECT * FROM tb_supplier Where Status=1");
		while(@$row=mysqli_fetch_array($exe)){
			odbc_exec($myConnPO,"UPDATE POHeader SET TransactionStatus='Approved',
			UpdatedAt='$createddate',UpdatedBy='$username' WHERE No='".$id."' And SupplierCode <> '".$row['KDSupplier']."'");
			
			odbc_exec($myConnMIIBPM,"UPDATE General_Workflow_History SET Outcome='1'
			WHERE Process_ID = '46' AND  Outcome ='18' And Transaction_ID IN(SELECT RowNo FROM [POOnline].dbo.POHeader
			WHERE WorkflowStatus = 'COMPLETED' AND No='".$id."' And SupplierCode <> '".$row['KDSupplier']."')");
		}
	}
}
 if(@$button=="po-approve"){
	$exe = mysqli_query($con,"SELECT * FROM tb_supplier Where Status=1");
	while(@$row=mysqli_fetch_array($exe)){
		odbc_exec($myConnPO,"UPDATE POHeader SET TransactionStatus='Approved',
		UpdatedAt='$createddate',UpdatedBy='$username' WHERE No='".$_GET['id']."' And SupplierCode <> '".$row['KDSupplier']."'");
		odbc_exec($myConnMIIBPM,"UPDATE General_Workflow_History SET Outcome='1'
		WHERE Process_ID = '46' AND  Outcome ='18' 
		And Transaction_ID IN(SELECT RowNo FROM [POOnline].dbo.POHeader
		WHERE WorkflowStatus = 'COMPLETED' AND No='".$_GET['id']."' And SupplierCode <> '".$row['KDSupplier']."')");
	}
	$message = "PO Succuess is Approved";
	echo "<script type='text/javascript'>alert('$message');</script>";
	echo"<script>  window.location='../dist/index.php?button=po-convertion'; </script>";
}
?>