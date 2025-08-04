<?php 
//Simpan WorkFlow FAW
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
	
	$cari =mysqli_query($con,"SELECT a.UserDomain, d.KDDivision, a.WorkFlowProcess,a.WorkFlowMenu,a.LevelProcess,b.NameApproval,b.OnBehalf, 
	a.Revise, b.Index_No,a.Index_No+1 AS Index_Process FROM tb_workflowprocess a  INNER JOIN tb_workflowapproval b 
	ON  a.WorkFlowProcess =b.UserDomain AND a.WorkFlowMenu=b.WorkFlowMenu AND a.WorkFlowMenu='SP' 
	INNER JOIN tb_user c ON a.UserDomain=c.UserDomain
	INNER JOIN tb_division d ON c.KDDivision=d.KDDivision
	Where a.UserDomain='$inputPICProdev' ORDER BY a.ID_No ,b.Index_No");
	$indexno=$indexwf;
	while($caridata =mysqli_fetch_array(@$cari)){
		mysqli_query($con,"Insert INTO tb_workflownprf (Request_No,WorkFlowMenu,LevelProcess,NameApproval,OnBehalf,Revise,Approve_No,Step_Revise,Index_No,CreatedBy,CreatedDate,CreatedHostName) 
		values ('$inputAutoRequestNo','$caridata[WorkFlowMenu]','Step $caridata[Index_No]','$caridata[NameApproval]',
		'$caridata[OnBehalf]','$caridata[Revise]','$caridata[Index_No]','$caridata[Index_Process]','$indexno','$username','$createddate','$ip : $hostname')");
		$indexno++;	
	}

		//$caridata[Revise]
/*if ($inputBisnis=="GM"){//GENERAL MALE
	$cari =mysqli_query($con,"SELECT a.UserDomain, d.KDDivision, a.WorkFlowProcess,a.WorkFlowMenu,a.LevelProcess,b.NameApproval,b.OnBehalf, 
	a.Revise, b.Index_No,a.Index_No+1 AS Index_Process FROM tb_workflowprocess a  INNER JOIN tb_workflowapproval b 
	ON  a.WorkFlowProcess =b.UserDomain AND a.WorkFlowMenu=b.WorkFlowMenu AND a.WorkFlowMenu='SP' 
	INNER JOIN tb_user c ON a.UserDomain=c.UserDomain
	INNER JOIN tb_division d ON c.KDDivision=d.KDDivision
	Where d.KDDivision='20GPRDV1301' ORDER BY a.ID_No ,b.Index_No");
	$indexno=$indexwf;
	while($caridata =mysqli_fetch_array(@$cari)){
		mysqli_query($con,"Insert INTO tb_workflownprf (Request_No,WorkFlowMenu,LevelProcess,NameApproval,OnBehalf,Revise,Approve_No,Step_Revise,Index_No,CreatedBy,CreatedDate,CreatedHostName) 
		values ('$inputAutoRequestNo','$caridata[WorkFlowMenu]','Step $caridata[Index_No]','$caridata[NameApproval]',
		'$caridata[OnBehalf]','$username','$caridata[Index_No]','$caridata[Index_Process]','$indexno','$username','$createddate','$ip : $hostname')");
		$indexno++;	
	}
}elseif ($inputBisnis=="GF"){//GENERALFEMALE
	$cari =mysqli_query($con,"SELECT a.UserDomain, d.KDDivision, a.WorkFlowProcess,a.WorkFlowMenu,a.LevelProcess,b.NameApproval,b.OnBehalf, 
	a.Revise, b.Index_No,a.Index_No+1 AS Index_Process FROM tb_workflowprocess a  INNER JOIN tb_workflowapproval b 
	ON  a.WorkFlowProcess =b.UserDomain AND a.WorkFlowMenu=b.WorkFlowMenu AND a.WorkFlowMenu='SP' 
	INNER JOIN tb_user c ON a.UserDomain=c.UserDomain
	INNER JOIN tb_division d ON c.KDDivision=d.KDDivision
	Where d.KDDivision='2018GPRDV5' ORDER BY a.ID_No ,b.Index_No");
	$indexno=$indexwf;
	while($caridata =mysqli_fetch_array(@$cari)){
		mysqli_query($con,"Insert INTO tb_workflownprf (Request_No,WorkFlowMenu,LevelProcess,NameApproval,OnBehalf,Revise,Approve_No,Step_Revise,Index_No,CreatedBy,CreatedDate,CreatedHostName) 
		values ('$inputAutoRequestNo','$caridata[WorkFlowMenu]','Step $caridata[Index_No]','$caridata[NameApproval]',
		'$caridata[OnBehalf]','$username','$caridata[Index_No]','$caridata[Index_Process]','$indexno','$username','$createddate','$ip : $hostname')");
		$indexno++;	
	}
}elseif ($inputBisnis=="LC"){//Ladys
	$cari =mysqli_query($con,"SELECT a.UserDomain, d.KDDivision, a.WorkFlowProcess,a.WorkFlowMenu,a.LevelProcess,b.NameApproval,b.OnBehalf, 
	a.Revise, b.Index_No,a.Index_No+1 AS Index_Process FROM tb_workflowprocess a  INNER JOIN tb_workflowapproval b 
	ON  a.WorkFlowProcess =b.UserDomain AND a.WorkFlowMenu=b.WorkFlowMenu AND a.WorkFlowMenu='SP' 
	INNER JOIN tb_user c ON a.UserDomain=c.UserDomain
	INNER JOIN tb_division d ON c.KDDivision=d.KDDivision
	Where d.KDDivision='20LCPRDV001' ORDER BY a.ID_No ,b.Index_No");
	$indexno=$indexwf;
	while($caridata =mysqli_fetch_array(@$cari)){
		mysqli_query($con,"Insert INTO tb_workflownprf (Request_No,WorkFlowMenu,LevelProcess,NameApproval,OnBehalf,Revise,Approve_No,Step_Revise,Index_No,CreatedBy,CreatedDate,CreatedHostName) 
		values ('$inputAutoRequestNo','$caridata[WorkFlowMenu]','Step $caridata[Index_No]','$caridata[NameApproval]',
		'$caridata[OnBehalf]','$username','$caridata[Index_No]','$caridata[Index_Process]','$indexno','$username','$createddate','$ip : $hostname')");
		$indexno++;	
	}
}*/

?>