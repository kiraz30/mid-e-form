<?php 
//Simpan WorkFlow FAW
$cari =mysqli_query($con,"SELECT a.WorkFlowProcess,a.WorkFlowMenu,a.LevelProcess,b.NameApproval,b.OnBehalf, 
a.Revise, b.Index_No,a.Index_No AS Index_Process FROM tb_workflowprocess a  INNER JOIN tb_workflowapproval b 
ON  a.WorkFlowProcess =b.UserDomain AND a.WorkFlowMenu=b.WorkFlowMenu AND a.WorkFlowMenu='FAW' AND a.UserDomain='$username' ORDER BY a.ID_No ,b.Index_No");
$indexno=1;
while($caridata =mysqli_fetch_array(@$cari)){
	mysqli_query($con,"Insert INTO tb_workflownprf (Request_No,WorkFlowMenu,LevelProcess,NameApproval,OnBehalf,Revise,Step_Revise,Index_No,CreatedBy,CreatedDate,CreatedHostName) 
	values ('$inputAutoRequestNo','$caridata[WorkFlowMenu]','Step $caridata[Index_No]','$caridata[NameApproval]',
	'$caridata[OnBehalf]','$caridata[Revise]','$caridata[Index_Process]','$indexno','$username','$createddate','$ip : $hostname')");
	$indexno++;	
}
?>