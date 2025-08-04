<?php 
	mysqli_query($con,"UPDATE tb_faw SET 
	CFM_Code='$InputCFMCode',Remark='$inputRemark',
	Memberikan_FA='$InputFA',PM_Diterima_MID='$InputPMMID',
	UpdatedBy='$username',UpdatedDate='$createddate',
	UpdatedHostName='$ip : $hostname' WHERE Request_No='$tempFormatNoRequest'");
?>