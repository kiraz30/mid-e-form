<?php 
include "../../config/conn.php";
include "../../config/connect.php";
$tempID_No				= @$_POST['tempID_No'];
$getDetail				= @$_POST['getDetail'];
$tempAutoRequestNo		= @$_POST['tempAutoRequestNo'];
$inputRemarkApp		  	= @$_POST['inputRemarkApp'];
$WorkFlowMenu			= @$_POST['WorkFlowMenu'];
$LevelProcess		  	= @$_POST['LevelProcess'];
$username			  	= @$_POST['username'];
$Index_No			  	= @$_POST['Index_No']; 
 
$ip						= $_SERVER['REMOTE_ADDR'];
$hostname 				= gethostbyaddr($_SERVER['REMOTE_ADDR']);
date_default_timezone_set("Asia/Jakarta");
$createddate			= date("Y-m-d H:i:s");
/*if ($tempID_No=="") {*/
	mysqli_query($con,"Insert INTO tb_comment_approve
	(Request_No,WorkFlowMenu,LevelProcess,NameApproval,
	Index_No,Fild_Remark,Remark,CreatedBy,CreatedDate,CreatedHostName) 
	values ('$tempAutoRequestNo','$WorkFlowMenu','$LevelProcess','$username',
	'$Index_No','$getDetail','$inputRemarkApp','$username','$createddate','$ip : $hostname')");
/*}
else{
	mysqli_query($con,"UPDATE tb_comment_approve
	SET Request_No='$tempAutoRequestNo',
	WorkFlowMenu='$WorkFlowMenu',
	LevelProcess='$LevelProcess',
	NameApproval='$username',
	Index_No='$Index_No',
	Fild_Remark='$getDetail',
	Remark='$inputRemarkApp',
	CreatedBy='$username',
	CreatedDate='$createddate',
	CreatedHostName='$ip : $hostname'
	WHERE ID_No='$tempID_No'") ;
 
}*/
 
	

?>
