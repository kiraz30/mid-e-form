<?php 
updatefile("tb_nprf","Status_Last_Document","0","Request_No",$tampildata['Request_No']);
mysqli_query($con,"Insert INTO tb_nprf (
ID_No,Index_Document,Request_No,Last_Request_No,Status_Last_Document,Thema_Name,Type_Request,Purpose_1,Purpose_2,Purpose_3,
Purpose_4,Purpose_5,Priority_Point_EmphasisOnPrice,Priority_Point_HighQuality,Priority_Point_Other,Priority_Point_OtherEtc,
Launching_Date,Objective_Aim,Goal_Indicator,Market_Situasion,T_Consumer_M,T_Consumer_F,T_Age_GroupStart,T_Age_GroupEnd,
T_Sosial_Economic_Class,Proposed_Concept,Request_for_Content,Request_for_Design,Distribution,TargetWants,
Advertising_1,Advertising_2,Advertising_3,Advertising_4,Advertising_5,Advertising_Other,
MCS_Chk,MCS,MKC_Chk,MKC,MCTL_Chk,MCTL,MTC_Chk,MTC,MMSB_Chk,MMSB,MVC_Chk,MVC,SMC_Chk,SMC,MPC_Chk,MPC,
Others,Remark,Status_NPRF,CreatedBy,CreatedDate,CreatedHostName) 
values ('".$tampildata['ID_No']."','$rev','$inputAutoRequestNo','$inputLastRequestNo','1','$inputThemaName',
'$SelectTypeRequest','$valPurpose1','$valPurpose2','$valPurpose3','$valPurpose4','$valPurpose5','$valPrioritypoint1',
'$valPrioritypoint2','$valPrioritypoint3','$InputOther',
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


?>
