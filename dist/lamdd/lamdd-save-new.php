<?php 
if ($button=="add-lamdd")
{
	mysqli_query($con,"Insert INTO tb_lamdd(ID_No,Index_Document,Request_No,FNIM_Code,
	ID_No_FNIMDetail,ID_No_FNIM_Country,Status_LAMDD,Remark,CreatedBy,CreatedDate,CreatedHostName) 
	values ('$noUrut','0','$NomorReq','$InputFNIMCode','$inputID_No_FNIM_Detail',
	'$inputID_No_FNIM_Country','Draft','$inputRemark','$username','$createddate','$ip : $hostname')");
}
else
{
updatefile("tb_lamdd","Status_Last_Document","0","Request_No",$tampildata['Request_No']);
mysqli_query($con,"Insert INTO tb_lamdd(ID_No,Index_Document,Request_No,Last_Request_No,Status_Last_Document,
FNIM_Code,ID_No_FNIMDetail,ID_No_FNIM_Country,Status_LAMDD,Remark,CreatedBy,CreatedDate,CreatedHostName) 
values ('".$tampildata['ID_No']."','$rev','$inputAutoRequestNo','$inputLastRequestNo','1',
'$InputFNIMCode','$inputID_No_FNIM_Detail','$inputID_No_FNIM_Country','Draft',
'$inputRemark','$username','$createddate','$ip : $hostname')");}

	

?>
