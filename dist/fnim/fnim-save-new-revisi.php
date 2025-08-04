<?php

updatefile("tb_fnim","Status_Last_Document","0","Request_No",$tampildata['Request_No']);
mysqli_query($con,"Insert INTO tb_fnim(ID_No,Index_Document,Request_No,Last_Request_No,Status_Last_Document,MCJ_Proudct,Project_Name,
NPRF_Code,Type_Request,Type_Request_Detail,Launching_Date,For_Notif,Note,Remark,Thema_Number,Status_FNIM,
CreatedBy,CreatedDate,CreatedHostName) 
values ('".$tampildata['ID_No']."','$rev','$inputAutoRequestNo','$inputLastRequestNo','1',
'$MCJProd','$inputProjectName','$InputNprfCode','$SelectTypeRequest','$txtExport',
'".$SelectTahun."-".$Selectbulan."-01"."','$inputNotification','$inputNote','$inputRemark',
'$inputThemaNumber','Draft','$username','$createddate','$ip : $hostname')");
?>
