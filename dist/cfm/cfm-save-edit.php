<?php 
	mysqli_query($con,"UPDATE tb_cfm SET 
	FNIM_Code='$InputFNIMCode',ID_No_FNIMDetail='$inputID_No_FNIM_Detail',
	ID_No_FNIM_Country='$inputID_No_FNIM_Country',Remark='$inputRemark',
	UpdatedBy='$username',UpdatedDate='$createddate',
	UpdatedHostName='$ip : $hostname' WHERE Request_No='$tempFormatNoRequest'");

?> 