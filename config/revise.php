
<?php  
session_start(); //kuncinya ada disini, tulis diawal script sebelum menulis yang lain
$username				=$_SESSION["usernameeform"];
$hostname				=$_SESSION['hostnameeform'];

if($_SESSION["usernameeform"]=="" ) //untuk mencegah apabila halaman diakses tanpa login (session kosong), maka otomatis di redirect ke form 
{
	ob_start();
	header("location:../dist/login.php");
	ob_end_flush();
}
include "../config/connect.php";

date_default_timezone_set("Asia/Jakarta");
$createddate=date("Y-m-d H:i:s");
$pg			=@$_GET["pg"];
$id			=@$_GET["id"];

//________________________________________________________________________________WORK FLOW Back PROCESS
$exeWFBP = mysqli_query($con,"SELECT WorkFlowMenu,Index_No,NameApproval,OnBehalf,StatusWorkFlow FROM tb_workflownprf 
WHERE (NameApproval='$username' or OnBehalf ='$username') And Request_No = '".@$_GET['id']."' AND StatusWorkFlow IS null");
$tampildataWFBR=mysqli_fetch_array($exeWFBP);
$BackStep_Index= $tampildataWFBR['Index_No']-1;
	
mysqli_query($con,"UPDATE tb_workflownprf SET StatusWorkFlow='R',ReadWorkFlow='1',Remark_WorkFlow='Revise', 
Approve='$username',ApproveDate='$createddate' WHERE Request_No='$id'
And Index_No='".$tampildataWFBR['Index_No']."'");
				
//Send Email Notification for Revise ___________________________________________________
	
$exeBack = mysqli_query($con,"Select Revise FROM tb_workflownprf 
WHERE Request_No='".@$_GET['id']."' And Index_No='$BackStep_Index'");
$tampildataBack=mysqli_fetch_array($exeBack);
				
$apprevise=$tampildataBack['Revise'];
$remark="Revise";
$id=$_GET['id'] ;
if ($pg=="nprf"){	
	$page="nprf-revise";
	$WorkFlowMenu="NPRF";
	//UPDATE STATUS NPRF
	mysqli_query($con,"UPDATE tb_nprf Set Status_NPRF='Revise' WHERE Request_No='".@$_GET['id']."'");
}
elseif ($pg=="fnim"){	
	$page="fnim-revise";
	$WorkFlowMenu="FNIM";
	//UPDATE STATUS FNIM
	mysqli_query($con,"UPDATE tb_fnim Set Status_FNIM='Revise' WHERE Request_No='".@$_GET['id']."'");
}
elseif ($pg=="mpr"){	
	$page="mpr-revise";
	$WorkFlowMenu="MPR";
	//UPDATE STATUS MPR
	mysqli_query($con,"UPDATE tb_mpr Set Status_MPR='Revise' WHERE Request_No='".@$_GET['id']."'");
}	
elseif ($pg=="cfm"){	
	$page="mpr-revise";
	$WorkFlowMenu="MPR";
	//UPDATE STATUS FNIM
	mysqli_query($con,"UPDATE tb_cfm Set Status_CFM='Revise' WHERE Request_No='".@$_GET['id']."'");
}
elseif ($pg=="faw"){	
	$page="mpr-revise";
	$WorkFlowMenu="FAW";
	//UPDATE STATUS FAW
	mysqli_query($con,"UPDATE tb_faw Set Status_FAW='Revise' WHERE Request_No='".@$_GET['id']."'");
}
elseif ($pg=="arm"){	
	$page="arm-revise";
	$WorkFlowMenu="ARM";
	//UPDATE STATUS FNIM
	mysqli_query($con,"UPDATE tb_packdev_add_resource Set Status_add_resource='Revise' WHERE Request_No='".@$_GET['id']."'");
}
elseif ($pg=="arm-f2"){	
	$page="arm-revise";
	$WorkFlowMenu="ARM";
	//UPDATE STATUS FNIM
	mysqli_query($con,"UPDATE tb_packdev_add_resource_f2 Set Status_add_resource='Revise' WHERE Request_No='".@$_GET['id']."'");
}
elseif ($pg=="sp"){	
	$page="spec-product-revise";
	$WorkFlowMenu="PS";
	//UPDATE STATUS PS
	mysqli_query($con,"UPDATE tb_spec_product Set Status_Spec='Revise' WHERE Request_No='".@$_GET['id']."'");
}
elseif ($pg=="ps"){	
	$page="ps-revise";
	$WorkFlowMenu="PS";
	//UPDATE STATUS PS
	mysqli_query($con,"UPDATE tb_packdev_spec Set Status_Spec='Revise' WHERE Request_No='".@$_GET['id']."'");
}
if (mysqli_num_rows($exeBack) !=0 ) { 
	$StatusInbox="R";
	require ("../config/emailrevise.php");
}else {
	$StatusInbox="C";
}
//Simpan Inbox
	mysqli_query($con,"UPDATE tb_inbox Set Request_Status='$StatusInbox',ReadInbox='0',UpdatedBy='$username',
	NameApproval='".$tampildataBack['Revise']."',OnBehalf='',
	Remark='Auto Revise',UpdatedDate='$createddate',UpdatedHostName='$hostname' 
	WHERE Request_No='".@$_GET['id']."'");
	
	$message = "Data successfully Revise to Requestor";
	echo "<script type='text/javascript'>alert('$message');</script>";
	echo"<script>  window.location='../dist/index.php?button=inbox'; </script>";
	//_________________________________________________________________________________________




?>