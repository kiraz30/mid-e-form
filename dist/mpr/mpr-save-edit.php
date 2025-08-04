<?php 
if (@$button=="edit-mpr" && @$tampildataReq['Index_No']==1) {
	mysqli_query($con,"UPDATE tb_mpr SET Project_Name='$inputProjectName',FNIM_Code='$selectReq',
	Type_Request='$SelectTypeRequest',Country='$selectCountry',Type='$InputType',Brand='$InputBrand',Bisnis='$InputBisnis',
	Category='$InputCategory',Series='$InputSeries',Segmentation='$InputSegmentation',CustomerCode='$selectCustomerCode',
	Royalty='$InputRoyalty',KeteranganProduct='$InputKeteranganProduct',Remark='$inputRemark',Status_MPR='".$tampildata['Status_MPR']."',
	RemarkafterComplete='$inputRemarkafterComplete',UpdatedBy='$username',UpdatedDate='$createddate',
	UpdatedHostName='$ip : $hostname' WHERE Request_No='$tempFormatNoRequest'");
}
if (@$button=="revise-mpr" && @$tampildataRevise['Index_No']==1) {
	mysqli_query($con,"UPDATE tb_mpr SET Project_Name='$inputProjectName',FNIM_Code='$selectReq',
	Type_Request='$SelectTypeRequest',Country='$selectCountry',Type='$InputType',Brand='$InputBrand',Bisnis='$InputBisnis',
	Category='$InputCategory',Series='$InputSeries',Segmentation='$InputSegmentation',CustomerCode='$selectCustomerCode',
	Royalty='$InputRoyalty',Remark='$inputRemark',Status_MPR='".$tampildata['Status_MPR']."',
	RemarkafterComplete='$inputRemarkafterComplete',UpdatedBy='$username',UpdatedDate='$createddate',
	UpdatedHostName='$ip : $hostname' WHERE Request_No='$tempFormatNoRequest'");
}
if (@$button=="mpr-app" && @$tampildataWFMPR['Approve_No']==1 && @$tampildataWFMPR['Step_Revise']==4) { //SESSION DEV FORMULA
	mysqli_query($con,"UPDATE tb_mpr SET CustomerCodeFormula='$selectCustomerCodeFormula',
	RoyaltyFormula='$InputRoyaltyFormula',UpdatedBy='$username',UpdatedDate='$createddate',
	UpdatedHostName='$ip : $hostname' WHERE Request_No='$tempFormatNoRequest'");
}

if (@$button=="mpr-app" && @$tampildataWFMPR['Approve_No']==1 && @$tampildataWFMPR['Step_Revise']==6) { //SESSION DEV FORMULA
	mysqli_query($con,"UPDATE tb_mpr SET Flex='$valFlex',
	SAP='$valSAP',UpdatedBy='$username',UpdatedDate='$createddate',
	UpdatedHostName='$ip : $hostname' WHERE Request_No='$tempFormatNoRequest'");
}
?>