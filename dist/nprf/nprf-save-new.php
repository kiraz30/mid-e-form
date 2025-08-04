<?php 
mysqli_query($con,"Insert INTO tb_nprf (ID_No,Index_Document,Request_No,Thema_Number,Thema_Name,Type_Request,SentTo,Purpose_1,Purpose_2,Purpose_3,
Purpose_4,Purpose_5,Priority_Point_EmphasisOnPrice,Priority_Point_HighQuality,Priority_Point_Other,Priority_Point_OtherEtc,
Launching_Date,Objective_Aim,Goal_Indicator,Market_Situasion,T_Consumer_M,T_Consumer_F,T_Age_GroupStart,T_Age_GroupEnd,
T_Sosial_Economic_Class,Proposed_Concept,Request_for_Content,Request_for_Design,Distribution,TargetWants,
Advertising_1,Advertising_2,Advertising_3,Advertising_4,Advertising_5,Advertising_Other,
MCS_Chk,MCS,MKC_Chk,MKC,MCTL_Chk,MCTL,MTC_Chk,MTC,MMSB_Chk,MMSB,MVC_Chk,MVC,SMC_Chk,SMC,MPC_Chk,MPC,
Others,Remark,Status_NPRF,CreatedBy,CreatedDate,CreatedHostName) values ('$noUrut','0','$NomorReq','$inputThemaNumber','$inputThemaName','$SelectTypeRequest','$SelectSentTo','$valPurpose1',
'$valPurpose2','$valPurpose3','$valPurpose4','$valPurpose5','$valPrioritypoint1','$valPrioritypoint2','$valPrioritypoint3','$InputOther',
'".$SelectTahun."-".$Selectbulan."-01"."',
'".str_replace("'","`",$inputObjectiveAim)."',
'".str_replace("'","`",$inputGoalIndicator)."',
'".str_replace("'","`",$inputMarketSituation)."',
'$valConsumer1','$valConsumer2','$InputAgeGroupStart',
'$InputAgeGroupEnd','$InputSocialEconomic',
'".str_replace("'","`",$inputProposedconcept)."',
'".str_replace("'","`",$inputRequest_for_Content)."',
'".str_replace("'","`",$inputRequest_for_Design)."',
'$InputDistribution','$InputTargetWants',
'$valAdvertising1','$valAdvertising2','$valAdvertising3','$valAdvertising4','$valAdvertising5','$AdvertisingOther',
'$valMCS','$InputMCS','$valMKC','$InputMKC','$valMCTL','$InputMCTL','$valMTC','$InputMTC','$valMMSB','$InputMMSB',
'$valMVC','$InputMVC','$valSMC','$InputSMC','$valMPC','$InputMPC',
'$InputOthers','$inputRemark','Draft','$username','$createddate','$ip : $hostname')");
 
updatefile("tb_marketsituation","MarketSituation",str_replace("'","`",$inputMarketSituation),"Status","1");

/*if (!empty($namaFileProposedconcept)) { //1.
	move_uploaded_file($file_tmpFileProposedconcept, $uploadDirFileProposedconcept.date("YmdHis").$namaFileProposedconcept);
	updatefile("tb_nprf","Proposed_Concept",date("YmdHis").$namaFileProposedconcept,"Request_No",$NomorReq);
}
if (!empty($namaFileRequestforcontent)) { //2.
	move_uploaded_file($file_tmpFileRequestforcontent, $uploadDirFileRequestforcontent.date("YmdHis").$namaFileRequestforcontent);
	updatefile("tb_nprf","Request_for_Content",date("YmdHis").$namaFileRequestforcontent,"Request_No",$NomorReq);
}
if (!empty($namaFileRequestfordesign)) { //3.
	move_uploaded_file($file_tmpFileRequestfordesign, $uploadDirFileRequestfordesign.date("YmdHis").$namaFileRequestfordesign);
	updatefile("tb_nprf","Request_for_Design",date("YmdHis").$namaFileRequestfordesign,"Request_No",$NomorReq);
}
if (!empty($namaFileItemdetail)) { //4.
	move_uploaded_file($file_tmpFileItemdetail, $uploadDirFileItemdetail.date("YmdHis").$namaFileItemdetail);
	updatefile("tb_nprf","Item_Detail",date("YmdHis").$namaFileItemdetail,"Request_No",$NomorReq);
	
}*/
if (!empty($namaFileCompetitor)) { //5.
	move_uploaded_file($file_tmpFileCompetitor, $uploadDirFileCompetitor.$yymmddhMs.$namaFileCompetitor);
	updatefile("tb_nprf","Competitor",$yymmddhMs.$namaFileCompetitor,"Request_No",$NomorReq);
}

if (!empty($namaFileOutlineofschedule)) { //6.
	move_uploaded_file($file_tmpFileOutlineofschedule, $uploadDirFileOutlineofSchedule.$yymmddhMs.$namaFileOutlineofschedule);
	updatefile("tb_nprf","Outline_of_Schedule",$yymmddhMs.$namaFileOutlineofschedule,"Request_No",$NomorReq);
}
 
if (!empty($namaFileMcj)) { //7.
	move_uploaded_file($file_tmpFileMcj, $uploadDirFileMcj.$yymmddhMs.$namaFileMcj);
	updatefile("tb_nprf","Mcj",$yymmddhMs.$namaFileMcj,"Request_No",$NomorReq);
}

if (!empty($namaFileMaster_Schedule)) { //7.
	move_uploaded_file($file_tmpFileMaster_Schedule, $uploadDirFileMaster_Schedule.$yymmddhMs.$namaFileMaster_Schedule);
	updatefile("tb_nprf","Master_Schedule",$yymmddhMs.$namaFileMaster_Schedule,"Request_No",$NomorReq);
}
				
?>
