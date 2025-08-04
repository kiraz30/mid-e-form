<?php 
	mysqli_query($con,"UPDATE tb_nprf SET Thema_Number='$inputThemaNumber',Thema_Name='$inputThemaName',Type_Request='$SelectTypeRequest',SentTo='$SelectSentTo',
	Purpose_1='$valPurpose1',Purpose_2='$valPurpose2',Purpose_3='$valPurpose3',Purpose_4='$valPurpose4',Purpose_5='$valPurpose5',
	Priority_Point_EmphasisOnPrice='$valPrioritypoint1',Priority_Point_HighQuality='$valPrioritypoint2',
	Priority_Point_Other='$valPrioritypoint3',Priority_Point_OtherEtc='$InputOther',
	Launching_Date='".$SelectTahun."-".$Selectbulan."-01"."',
	Objective_Aim='".str_replace("'","`",$inputObjectiveAim)."',
	Goal_Indicator='".str_replace("'","`",$inputGoalIndicator)."',
	Market_Situasion='".str_replace("'","`",$inputMarketSituation)."',
	T_Age_GroupStart='$InputAgeGroupStart',T_Age_GroupEnd='$InputAgeGroupEnd',
	T_Sosial_Economic_Class='$InputSocialEconomic',Remark='$inputRemark',
	Status_NPRF='".$tampildata['Status_NPRF']."',
	Proposed_Concept='".str_replace("'","`",$inputProposedconcept)."',
	Request_for_Content='".str_replace("'","`",$inputRequest_for_Content)."',
	Request_for_Design='".str_replace("'","`",$inputRequest_for_Design)."',
	T_Consumer_M='$valConsumer1',T_Consumer_F='$valConsumer2',
	Distribution='$InputDistribution',
	TargetWants='$InputTargetWants',
	Advertising_1='$valAdvertising1',Advertising_2='$valAdvertising2',Advertising_3='$valAdvertising3',
	Advertising_4='$valAdvertising4',Advertising_5='$valAdvertising5',Advertising_Other='$AdvertisingOther',
	MCS_Chk='$valMCS',MKC_Chk='$valMKC',MCTL_Chk='$valMCTL',MTC_Chk='$valMTC',MMSB_Chk='$valMMSB',MVC_Chk='$valMVC',SMC_Chk='$valSMC',MPC_Chk='$valMPC',
	
	MCS='$InputMCS',MKC='$InputMKC',MCTL='$InputMCTL',MTC='$InputMTC',MMSB='$InputMMSB',MVC='$InputMVC',SMC='$InputSMC',MPC='$InputMPC',
	Others='$InputOthers',RemarkafterComplete='$inputRemarkafterComplete',
	UpdatedBy='$username',UpdatedDate='$createddate',UpdatedHostName='$ip : $hostname' WHERE Request_No='$tempFormatNoRequest'");
	

	if (!empty($namaFileCompetitor)) { //5.
		if (!empty($tampildata['Competitor'])){
			unlink($uploadDirFileCompetitor.@$tampildata['Competitor']);
		}
		move_uploaded_file($file_tmpFileCompetitor, $uploadDirFileCompetitor.$yymmddhMs.$namaFileCompetitor);
		updatefile("tb_nprf","Competitor",$yymmddhMs.$namaFileCompetitor,"Request_No",$tempFormatNoRequest);
	}
	if (!empty($namaFileOutlineofschedule)) { //6.
		if (!empty($tampildata['Outline_of_Schedule'])){
			unlink($uploadDirFileOutlineofSchedule.@$tampildata['Outline_of_Schedule']);
		}
		move_uploaded_file($file_tmpFileOutlineofschedule, $uploadDirFileOutlineofSchedule.$yymmddhMs.$namaFileOutlineofschedule);
		updatefile("tb_nprf","Outline_of_Schedule",$yymmddhMs.$namaFileOutlineofschedule,"Request_No",$tempFormatNoRequest);
	}
/*	if (!empty($namaFileMcj)) { //7.
		if (!empty($tampildata['Mcj'])){
			unlink($uploadDirFileMcj.@$tampildata['Mcj']);
		}
		move_uploaded_file($file_tmpFileMcj, $uploadDirFileMcj.date("YmdHis").$namaFileMcj);
		updatefile("tb_nprf","Mcj",date("YmdHis").$namaFileMcj,"Request_No",$tempFormatNoRequest);
	}
	
	if (!empty($namaFileMaster_Schedule)) { //8.
		if (!empty($tampildata['Master_Schedule'])){
			unlink($uploadDirFileMaster_Schedule.@$tampildata['Master_Schedule']);
		}
		move_uploaded_file($file_tmpFileMaster_Schedule, $uploadDirFileMaster_Schedule.date("YmdHis").$namaFileMaster_Schedule);
		updatefile("tb_nprf","Master_Schedule",date("YmdHis").$namaFileMaster_Schedule,"Request_No",$tempFormatNoRequest);
	}*/
?>
