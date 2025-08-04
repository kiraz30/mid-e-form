<?php
	updatefile("tb_packdev_add_resource","Status_Last_Document","0","Request_No",$tampildata['Request_No']);
	mysqli_query($con,"Insert INTO tb_packdev_add_resource (ID_No,Index_Document,Request_No,Last_Request_No,Status_Last_Document,
	MPR_Code,Project_Name,Type,Segment,Content,Remark,Status_add_resource,CreatedBy,CreatedDate,CreatedHostName) 
	values ('".$tampildata['ID_No']."','$rev','$inputAutoRequestNo','$inputLastRequestNo','1',
	'$InputMPRCode','$inputProjectName','$InputSubject','$InputType','$inputSegmentation',
	'$inputContent','$inputRemark','Draft','$username','$createddate','$ip : $hostname')");

?>
