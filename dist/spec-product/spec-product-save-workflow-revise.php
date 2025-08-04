<?php 
session_start();
$username				=$_SESSION["usernameeform"];
include "../../config/conn.php";
$inputAutoRequestNo		= @$_POST['inputAutoRequestNo'];
$inputWorkflowRemark	= @$_POST['inputWorkflowRemark'];
$SelectWorkflowRevise	= @$_POST['SelectWorkflowRevise'];
$ip						=$_SERVER['REMOTE_ADDR'];
$hostname 				= gethostbyaddr($_SERVER['REMOTE_ADDR']);
date_default_timezone_set("Asia/Jakarta");
$createddate			=date("Y-m-d H:i:s");
//Simpan WorkFlow SPEC PRODUCT REQUESR_________________________________________
$cari =mysqli_query($con,"SELECT a.WorkFlowProcess,a.WorkFlowMenu,a.LevelProcess,b.NameApproval,b.OnBehalf, 
a.Revise, b.Index_No,a.Index_No AS Index_Process FROM tb_workflowprocess a  INNER JOIN tb_workflowapproval b 
ON  a.WorkFlowProcess =b.UserDomain AND a.WorkFlowMenu=b.WorkFlowMenu AND a.WorkFlowMenu='SP' AND a.UserDomain='$username' ORDER BY a.ID_No ,b.Index_No");
$indexwf=1;
while($caridata =mysqli_fetch_array(@$cari)){
	mysqli_query($con,"Insert INTO tb_workflownprf (Request_No,WorkFlowMenu,LevelProcess,NameApproval,OnBehalf,Revise,Approve_No,Step_Revise,Index_No,CreatedBy,CreatedDate,CreatedHostName) 
	values ('$inputAutoRequestNo','$caridata[WorkFlowMenu]','Step $caridata[Index_No]','$caridata[NameApproval]',
	'$caridata[OnBehalf]','$caridata[Revise]','$caridata[Index_No]','$caridata[Index_Process]','$indexwf','$username','$createddate','$ip : $hostname')");
	$indexwf++;	
}

//Simpan WorkFlow SPEC PRODUCT DIVISI__________________________________________
$cari =mysqli_query($con,"SELECT Request_No,WorkFlowMenu,LevelProcess,NameApproval,OnBehalf,Revise,Approve_No,Step_Revise 
FROM  tb_workflownprf Where Request_No ='$inputAutoRequestNo' And Step_Revise ='$SelectWorkflowRevise' GROUP BY Step_Revise,Approve_No");
$indexno=$indexwf;
while($caridata =mysqli_fetch_array(@$cari)){
	mysqli_query($con,"Insert INTO tb_workflownprf (Request_No,WorkFlowMenu,LevelProcess,NameApproval,OnBehalf,Revise,Approve_No,Step_Revise,Index_No,CreatedBy,CreatedDate,CreatedHostName) 
	values ('$inputAutoRequestNo','$caridata[WorkFlowMenu]','$caridata[LevelProcess]','$caridata[NameApproval]',
	'$caridata[OnBehalf]','$caridata[Revise]','$caridata[Approve_No]','$caridata[Step_Revise]','$indexno','$username','$createddate','$ip : $hostname')");
	$indexno++;	
}

//Update WorkFlow SPEC Sent Approval___________________________________________
mysqli_query($con,"UPDATE tb_workflowNPRF SET StatusWorkFlow='R',ReadWorkFlow='1',Remark_WorkFlow='$inputWorkflowRemark',
Approve='$username',ApproveDate='$createddate',Status_Approval='1' WHERE Request_No='$inputAutoRequestNo' And Index_No='1'
And ReadWorkFlow='0'");
//Send Email Notification for Approval 2_______________________________________
$exeNext = mysqli_query($con,"Select NameApproval,OnBehalf,WorkFlowMenu FROM tb_workflowNPRF 
WHERE Request_No='$inputAutoRequestNo' And Index_No='2' And StatusWorkFlow is null limit 1");

$tampildataNext=mysqli_fetch_array($exeNext);
$app1=$tampildataNext['NameApproval'];
$app2=$tampildataNext['OnBehalf'];
$remark=$inputWorkflowRemark;
$id=$inputAutoRequestNo;
$WorkFlowMenu="SP";
if ($app2<>"-" || $app2==""){
	$StatusPS= "Waitting Approval By " .$app1.$app2;
} else {
	$StatusPS= "Waitting Approval By " .$app1;
}
$Confirm=="Approve";
require ("../../config/emailapp.php");
			
//Simpan Inbox
mysqli_query($con,"UPDATE tb_inbox Set Request_Status='W',ReadInbox='0',UpdatedBy='$username',
NameApproval='".$tampildataNext['NameApproval']."',OnBehalf='".$tampildataNext['OnBehalf']."',
Remark='$inputWorkflowRemark',CreatedBy='$username',UpdatedDate='$createddate',UpdatedHostName='$ip : $hostname'  
WHERE Request_No='$inputAutoRequestNo'");
//UPDATE STATUS tb_spec_product__________________________________________________
mysqli_query($con,"UPDATE tb_spec_product Set Status_Spec='$StatusPS',
Status_Last_Document='0' WHERE Request_No='$inputAutoRequestNo'");	
//_______________________________________________________________________________


?>