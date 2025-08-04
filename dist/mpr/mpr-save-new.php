<?php 
mysqli_query($con,"Insert INTO tb_mpr (ID_No,Request_No,Project_Name,Type_Request,Country,FNIM_Code,Type,Brand,Bisnis,
Series,Category,Segmentation,CustomerCode,Royalty,KeteranganProduct,Status_MPR,
Remark,CreatedBy,CreatedDate,CreatedHostName) 
values('$noUrut','$NomorReq','$inputProjectName','$SelectTypeRequest','$selectCountry','$selectReq','$InputType','$InputBrand','$InputBisnis',
'$InputSeries','$InputCategory','$InputSegmentation','$selectCustomerCode','$InputRoyalty','$InputKeteranganProduct','Draft',
'$inputRemark','$username','$createddate','$ip : $hostname')");
?>
