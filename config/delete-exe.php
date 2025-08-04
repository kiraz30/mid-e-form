<?php
include "connect.php";
$pg=$_GET['pg'];
$id=$_GET['id'];
$workflowmenu=@$_GET['workflowmenu'];
/*DELETE USER SETTING */
if($pg=="del-user-setting"){
	$Tanya = mysqli_query($con,"SELECT * FROM tb_workflow WHERE UserDomain = '$id' ");
	if (mysqli_num_rows($Tanya) !=0 ) {  
		$message = "Error Delete User Setting : Domain is Join to Work Flow";
		echo "<script type='text/javascript'>alert('$message');</script>";
		echo"<script>  window.location='../dist/index.php?button=user-setting'; </script>";}
	else {
		$exe =mysqli_query($con,"SELECT SignIN FROM tb_user where UserDomain = '$id' ");
        $tampildata=mysqli_fetch_array($exe);
		$fotolama= @$tampildata['SignIN'];
		if (!empty($fotolama)) {
			unlink("../dist/Sign/".$fotolama);
		}
		mysqli_query($con,"DELETE FROM tb_user_privilage where UserDomain='$id'");		
		mysqli_query($con,"DELETE FROM tb_user where UserDomain='$id'");
			$message = "Data successfully Delete to database";
			echo "<script type='text/javascript'>alert('$message');</script>";
			echo"<script>  window.location='../dist/index.php?button=user-setting'; </script>";
	}
}
/*DELETE WORK FLOW */
if($pg=="del-work-flow"){
	$Tanyawapp = mysqli_query($con,"SELECT * FROM tb_workflowapproval WHERE NameApproval = '$id' And 
	WorkFlowMenu ='$workflowmenu' And LevelApproval<>'Requestor'");
	if (mysqli_num_rows(@$Tanyawapp) !=0 ) {  
		$message = "Error Delete User Setting : Domain is Join to Work Flow Approval";
		echo "<script type='text/javascript'>alert('$message');</script>";
		echo"<script>  window.location='../dist/index.php?button=work-flow'; </script>";}
	else {	
		mysqli_query($con,"DELETE FROM tb_workflowapproval where UserDomain='$id' And WorkFlowMenu ='$workflowmenu'");
		mysqli_query($con,"DELETE FROM tb_workflow where UserDomain='$id' And WorkFlowMenu ='$workflowmenu'");
			$message = "Data successfully Delete to database";
			echo "<script type='text/javascript'>alert('$message');</script>";
			echo"<script>  window.location='../dist/index.php?button=work-flow'; </script>";
	}
}
/*DELETE TRADING PARTNER */
elseif ($pg=="del-trading-partner"){
	mysqli_query($con,"DELETE FROM tb_trading_partner where CustomerCode='$id'");
	$message = "Data successfully Delete to database";
	echo "<script type='text/javascript'>alert('$message');</script>";
	echo"<script>  window.location='../dist/index.php?button=trading-partner'; </script>";
}
/*DELETE CURRENCY*/
elseif ($pg=="del-currency"){
	mysqli_query($con,"DELETE FROM tb_Currency where KDCurrency='$id'");
	$message = "Data successfully Delete to database";
	echo "<script type='text/javascript'>alert('$message');</script>";
	echo"<script>  window.location='../dist/index.php?button=currency'; </script>";
}
/*DELETE DIVISION*/
elseif ($pg=="del-division"){
	$Tanya = mysqli_query($con,"SELECT * FROM tb_user WHERE KDDivision = '$id' ");
	if (mysqli_num_rows($Tanya) !=0 ) {  
		$message = "Error Delete Division : Division is Join to User Setting";
		echo "<script type='text/javascript'>alert('$message');</script>";
		echo"<script>  window.location='../dist/index.php?button=division'; </script>";}
	else {
		mysqli_query($con,"DELETE FROM tb_division where KDDivision='$id'");
		$message = "Data successfully Delete to database";
		echo "<script type='text/javascript'>alert('$message');</script>";
		echo"<script>  window.location='../dist/index.php?button=division'; </script>";
	}
}
/*DELETE POSITION*/
elseif ($pg=="del-position"){
	$Tanya = mysqli_query($con,"SELECT * FROM tb_user WHERE KDPosition = '$id' ");
	if (mysqli_num_rows($Tanya) !=0 ) {  
		$message = "Error Delete Position : Position is Join to User Setting";
		echo "<script type='text/javascript'>alert('$message');</script>";
		echo"<script>  window.location='../dist/index.php?button=position'; </script>";}
	else {
		mysqli_query($con,"DELETE FROM tb_position where KDPosition='$id'");
		$message = "Data successfully Delete to database";
		echo "<script type='text/javascript'>alert('$message');</script>";
		echo"<script>  window.location='../dist/index.php?button=position'; </script>";
	}
}
/*DELETE FORMAT REQUEST NO*/
elseif ($pg=="del-format-no-req"){
	mysqli_query($con,"DELETE FROM tb_format_req_no WHERE ID_No = '$id' ");
	$message = "Data successfully Delete to database";
	echo "<script type='text/javascript'>alert('$message');</script>";
	echo"<script>  window.location='../dist/index.php?button=format-no-req'; </script>";
}

/*DELETE Templet Market Situation*/
elseif ($pg=="del-market-situation"){
	mysqli_query($con,"DELETE FROM tb_marketsituation WHERE ID_No = '$id' ");
	$message = "Data successfully Delete to database";
	echo "<script type='text/javascript'>alert('$message');</script>";
	echo"<script>  window.location='../dist/index.php?button=market-situation'; </script>";
}
elseif ($pg=="del-address-to"){
	mysqli_query($con,"DELETE FROM tb_ms_address_to WHERE No_ID = '$id' ");
	$message = "Data successfully Delete to database";
	echo "<script type='text/javascript'>alert('$message');</script>";
	echo"<script>  window.location='../dist/index.php?button=address-to'; </script>";
}
elseif ($pg=="del-sent-to"){
	$Tanya = mysqli_query($con,"SELECT * FROM tb_ms_sent_to WHERE No_ID = '$id' ");
	if (mysqli_num_rows($Tanya) !=0 ) {  
		$message = "Error Delete Sent To : Sent To join Address To";
		echo "<script type='text/javascript'>alert('$message');</script>";
		echo"<script>  window.location='../dist/index.php?button=sent-to'; </script>";}
	else {
		mysqli_query($con,"DELETE FROM tb_ms_sent_to WHERE No_ID = '$id' ");
		$message = "Data successfully Delete to database";
		echo "<script type='text/javascript'>alert('$message');</script>";
		echo"<script>  window.location='../dist/index.php?button=sent-to'; </script>";
	}
}
elseif($pg=="del-dashboard-image"){
	$exe =mysqli_query($con,"SELECT Image FROM tb_dashboard_image WHERE dashboard-image='$id' ");
        $tampildata=mysqli_fetch_array($exe);
		$fotolama= @$tampildata['Image'];
		if (!empty($fotolama)) {
			unlink("../img/".$fotolama);
		}
	mysqli_query($con,"Delete From tb_dashboard_image WHERE dashboard-image='$id'");
	//Menghapus data ke database
	echo"<script>  window.location='../dist/index.php?button=dashboard-image'; </script>";
}
/*DELETE NPRF*/
elseif ($pg=="del-nprf"){
	$uploadDirFileMcj	 			= "../img/Mcj/";
	$uploadDirFileMaster_Schedule	= "../img/Master_Schedule/";
	$Tanya = mysqli_query($con,"SELECT * FROM tb_nprf WHERE  Request_No = '$id' and Status_NPRF<>'Draft'  ");
	if (mysqli_num_rows($Tanya) !=0 ) {  
		$message = "Error Delete NPRF : Request not delete";
		echo "<script type='text/javascript'>alert('$message');</script>";
		echo"<script>  window.location='../dist/index.php?button=nprf'; </script>";}
	else {
		$exe =mysqli_query($con,"SELECT Index_Document,Last_Request_No,
		Proposed_Concept,Request_for_Content,Request_for_Design,Competitor,Distribution,Others,
		Outline_of_Schedule FROM tb_nprf where Request_No = '$id' ");
        $tampildata=mysqli_fetch_array($exe);
		
		mysqli_query($con,"UPDATE tb_nprf Set Status_Last_Document='1' where Request_No ='".$tampildata['Last_Request_No']."' ");		
		
		$uploadDirFileProposedconcept	= "../ckeditor/upload/";

		/*if (!empty($tampildata['Proposed_Concept'])){
		unlink($uploadDirFileProposedconcept.@$tampildata['Proposed_Concept']);}
		if (!empty($tampildata['Request_for_Content'])){
		unlink($uploadDirFileRequestforcontent.@$tampildata['Request_for_Content']);}
		if (!empty($tampildata['Request_for_Design'])){
		unlink($uploadDirFileRequestfordesign.@$tampildata['Request_for_Design']);}
		if (!empty($tampildata['Item_Detail'])){
		unlink($uploadDirFileItemdetail.@$tampildata['Item_Detail']);}
		if (!empty($tampildata['Competitor'])){
		unlink($uploadDirFileCompetitor.@$tampildata['Competitor']);}*/
		if (!empty($tampildata['Mcj'])){
		unlink($uploadDirFileMcj.@$tampildata['Mcj']);}
		if (!empty($tampildata['Outline_of_Schedule'])){
		unlink($uploadDirFileOutlineofSchedule.@$tampildata['Outline_of_Schedule']);}
		
		mysqli_query($con,"DELETE FROM tb_nprf_item_detail_netto WHERE Request_No = '$id' ");
		mysqli_query($con,"DELETE FROM tb_nprf_competitor WHERE Request_No = '$id' ");
		mysqli_query($con,"DELETE FROM tb_nprf_item_detail WHERE Request_No = '$id' ");
		mysqli_query($con,"DELETE FROM tb_nprf_outlineofschedule WHERE Request_No = '$id' ");
		mysqli_query($con,"DELETE FROM tb_comment_approve WHERE Request_No='$id'");

		mysqli_query($con,"DELETE FROM tb_inbox WHERE Request_No = '$id' ");
		mysqli_query($con,"DELETE FROM tb_workflownprf WHERE Request_No = '$id' ");
		mysqli_query($con,"DELETE FROM tb_nprf WHERE Request_No = '$id' ");
		$message = "Data successfully Delete to database";
		echo "<script type='text/javascript'>alert('$message');</script>";
		echo"<script>  window.location='../dist/index.php?button=nprf'; </script>";
	}
}

/*DELETE CFM*/
elseif ($pg=="del-fnim"){
	$file	 						= "../file/";
	$uploadDirFileMcj	 			= "../img/Mcj/";
	$Tanya = mysqli_query($con,"SELECT * FROM tb_cfm WHERE  Request_No = '$id' and Status_CFM<>'Draft'  ");
	if (mysqli_num_rows($Tanya) !=0 ) {  
		$message = "Error Delete CFM : Request not delete";
		echo "<script type='text/javascript'>alert('$message');</script>";
		echo"<script>  window.location='../dist/index.php?button=fnim'; </script>";}
	else {
		$exe =mysqli_query($con,"SELECT Request_No,Last_Request_No,Mcj FROM tb_cfm where Request_No = '$id' ");
        $tampildata=mysqli_fetch_array($exe);
		
		mysqli_query($con,"UPDATE tb_cfm Set Status_Last_Document='1' where Request_No ='".$tampildata['Last_Request_No']."' ");
		
		if (!empty($tampildata['Mcj'])){
		unlink($uploadDirFileMcj.@$tampildata['Mcj']);}
		
		$exe=mysqli_query($con,"SELECT ID_No,Request_No,File FROM tb_cfm_file 
		where Request_No = '$id' ");
		while(@$rowFile=mysqli_fetch_array($exe)){	
			unlink($file.@$rowFile['File']);
			mysqli_query($con,"Delete From tb_cfm_file WHERE ID_No = '".$rowFile['ID_No']."' ");
		}
		mysqli_query($con,"DELETE FROM tb_inbox WHERE Request_No = '$id' ");
		mysqli_query($con,"DELETE FROM tb_workflownprf WHERE Request_No = '$id' ");
		mysqli_query($con,"DELETE FROM tb_cfm_file WHERE Request_No = '$id' ");
		mysqli_query($con,"DELETE FROM tb_cfm_country WHERE Request_No = '$id' ");
		mysqli_query($con,"DELETE FROM tb_cfm_detail WHERE Request_No = '$id' ");
		mysqli_query($con,"DELETE FROM tb_cfm WHERE Request_No = '$id' ");
		
		$message = "Data successfully Delete to database";
		echo "<script type='text/javascript'>alert('$message');</script>";
		echo"<script>  window.location='../dist/index.php?button=fnim'; </script>";
	}
}
/*DELETE MPR*/
elseif ($pg=="del-mpr"){
	$file	= "../file/";
	$Tanya = mysqli_query($con,"SELECT * FROM tb_mpr WHERE  Request_No = '$id' and Status_MPR<>'Draft'  ");
	if (mysqli_num_rows($Tanya) !=0 ) {  
		$message = "Error Delete CFM : Request not delete";
		echo "<script type='text/javascript'>alert('$message');</script>";
		echo"<script>  window.location='../dist/index.php?button=mpr'; </script>";}
	else {
		
		$exe=mysqli_query($con,"SELECT ID_No,Request_No,File FROM tb_cfm_file 
		where Request_No = '$id' ");
		while(@$rowFile=mysqli_fetch_array($exe)){	
			unlink($file.@$rowFile['File']);
			mysqli_query($con,"Delete From tb_cfm_file WHERE ID_No = '".$rowFile['ID_No']."' ");
		}
		
		$exe=mysqli_query($con,"SELECT ID_No,ID_NoCFMDetail FROM tb_mpr_detail 
		where Request_No = '".$id."' ");
		while(@$rowMPRDetail=mysqli_fetch_array($exe)){	
			mysqli_query($con,"UPDATE tb_cfm_detail SET ApplyMPR='0' WHERE ID_No='".$rowMPRDetail['ID_NoCFMDetail']."' ");
		}
		
		
		mysqli_query($con,"DELETE FROM tb_inbox WHERE Request_No = '$id' ");
		mysqli_query($con,"DELETE FROM tb_workflownprf WHERE Request_No = '$id' ");
		mysqli_query($con,"DELETE FROM tb_cfm_file WHERE Request_No = '$id' ");
		
		mysqli_query($con,"DELETE FROM tb_mpr_detail WHERE Request_No = '$id' ");
		mysqli_query($con,"DELETE FROM tb_mpr WHERE Request_No = '$id' ");
		
		$message = "Data successfully Delete to database";
		echo "<script type='text/javascript'>alert('$message');</script>";
		echo"<script>  window.location='../dist/index.php?button=mpr'; </script>";
	}
}
/*DELETE CFM*/
elseif ($pg=="del-cfm"){
	$Attachment_Image				= "../img/Attachment_Image/";

	$Tanya = mysqli_query($con,"SELECT * FROM tb_cfm WHERE  Request_No = '$id' and Status_CFM<>'Draft'  ");
	if (mysqli_num_rows($Tanya) !=0 ) {  
		$message = "Error Delete CFM : Request not delete";
		echo "<script type='text/javascript'>alert('$message');</script>";
		echo"<script>  window.location='../dist/index.php?button=cfm'; </script>";}
	else {
		$exe =mysqli_query($con,"SELECT Request_No,Last_Request_No FROM tb_cfm where Request_No = '$id' ");
        $tampildata=mysqli_fetch_array($exe);
		
		mysqli_query($con,"UPDATE tb_cfm Set Status_Last_Document='1' where Request_No ='".$tampildata['Last_Request_No']."' ");
				
		$exe=mysqli_query($con,"SELECT ID_No,Request_No,File FROM tb_cfm_file 
		where Request_No = '$id' ");
		while(@$rowFile=mysqli_fetch_array($exe)){	
			unlink($Attachment_Image.@$rowFile['File']);
			mysqli_query($con,"Delete From tb_cfm_file WHERE ID_No = '".$rowFile['ID_No']."' ");
		}
		mysqli_query($con,"DELETE FROM tb_inbox WHERE Request_No = '$id' ");
		mysqli_query($con,"DELETE FROM tb_workflownprf WHERE Request_No = '$id' ");
		mysqli_query($con,"DELETE FROM tb_cfm WHERE Request_No = '$id' ");
		
		$message = "Data successfully Delete to database";
		echo "<script type='text/javascript'>alert('$message');</script>";
		echo"<script>  window.location='../dist/index.php?button=cfm'; </script>";
	}
}
/*DELETE FAW*/
elseif ($pg=="del-faw"){
	$Attachment_Image				= "../img/Attachment_Image/";

	$Tanya = mysqli_query($con,"SELECT * FROM tb_faw WHERE  Request_No = '$id' and Status_FAW<>'Draft'  ");
	if (mysqli_num_rows($Tanya) !=0 ) {  
		$message = "Error Delete FAW : Request not delete";
		echo "<script type='text/javascript'>alert('$message');</script>";
		echo"<script>  window.location='../dist/index.php?button=faw'; </script>";}
	else {
		$exe =mysqli_query($con,"SELECT Request_No,Last_Request_No FROM tb_faw where Request_No = '$id' ");
        $tampildata=mysqli_fetch_array($exe);
		
		mysqli_query($con,"UPDATE tb_faw Set Status_Last_Document='1' where Request_No ='".$tampildata['Last_Request_No']."' ");
				
		$exe=mysqli_query($con,"SELECT ID_No,Request_No,File FROM tb_faw_file where Request_No = '$id' ");
		while(@$rowFile=mysqli_fetch_array($exe)){	
			unlink($Attachment_Image.@$rowFile['File']);
			mysqli_query($con,"Delete From tb_faw_file WHERE ID_No = '".$rowFile['ID_No']."' ");
		}
		mysqli_query($con,"DELETE FROM tb_inbox WHERE Request_No = '$id' ");
		mysqli_query($con,"DELETE FROM tb_workflownprf WHERE Request_No = '$id' ");
		mysqli_query($con,"DELETE FROM tb_faw_check_app WHERE Request_No = '$id' ");
		mysqli_query($con,"DELETE FROM tb_faw WHERE Request_No = '$id' ");
		
		$message = "Data successfully Delete to database";
		echo "<script type='text/javascript'>alert('$message');</script>";
		echo"<script>  window.location='../dist/index.php?button=faw'; </script>";
	}
}
/*DELETE Lampiran DD*/
elseif ($pg=="del-lamdd"){
	$Attachment_Image				= "../img/Attachment_Image/";

	$Tanya = mysqli_query($con,"SELECT * FROM tb_lamdd WHERE  Request_No = '$id' and Status_LAMDD<>'Draft'  ");
	if (mysqli_num_rows($Tanya) !=0 ) {  
		$message = "Error Delete Lampiran DD : Request not delete";
		echo "<script type='text/javascript'>alert('$message');</script>";
		echo"<script>  window.location='../dist/index.php?button=lamdd'; </script>";}
	else {
		$exe =mysqli_query($con,"SELECT Request_No,Last_Request_No FROM tb_lamdd where Request_No = '$id' ");
        $tampildata=mysqli_fetch_array($exe);
		
		mysqli_query($con,"UPDATE tb_lamdd Set Status_Last_Document='1' where Request_No ='".$tampildata['Last_Request_No']."' ");
				
		$exe=mysqli_query($con,"SELECT ID_No,Request_No,File FROM tb_lamdd_file where Request_No = '$id' ");
		while(@$rowFile=mysqli_fetch_array($exe)){	
			unlink($Attachment_Image.@$rowFile['File']);
			mysqli_query($con,"Delete From tb_lamdd_file WHERE ID_No = '".$rowFile['ID_No']."' ");
		}
		mysqli_query($con,"DELETE FROM tb_lamdd WHERE Request_No = '$id' ");
		
		$message = "Data successfully Delete to database";
		echo "<script type='text/javascript'>alert('$message');</script>";
		echo"<script>  window.location='../dist/index.php?button=lamdd'; </script>";
	}
}
/*DELETE SPEC PRODUCT*/
elseif ($pg=="del-spec-product"){
	$Attachment_Image				= "../img/Spec_Product/";

	$Tanya = mysqli_query($con,"SELECT * FROM tb_spec_product WHERE  Request_No = '$id' and Status_Spec<>'Draft'  ");
	if (mysqli_num_rows($Tanya) !=0 ) {  
		$message = "Error Delete Specification Products : Request not delete";
		echo "<script type='text/javascript'>alert('$message');</script>";
		echo"<script>  window.location='../dist/index.php?button=spec-product'; </script>";}
	else {
		$exe =mysqli_query($con,"SELECT Request_No,Last_Request_No FROM tb_spec_product where Request_No = '$id' ");
        $tampildata=mysqli_fetch_array($exe);
		mysqli_query($con,"UPDATE tb_spec_product Set Status_Last_Document='1' where Request_No ='".$tampildata['Last_Request_No']."' ");
		mysqli_query($con,"DELETE FROM tb_inbox WHERE Request_No = '$id' ");
		mysqli_query($con,"DELETE FROM tb_workflownprf WHERE Request_No = '$id' ");
		mysqli_query($con,"DELETE FROM tb_spec_product WHERE Request_No = '$id' ");
		
		$message = "Data successfully Delete to database";
		echo "<script type='text/javascript'>alert('$message');</script>";
		echo"<script>  window.location='../dist/index.php?button=spec-product'; </script>";
	}
}
/*DELETE Addition Resource Master*/
elseif ($pg=="del-arm"){
	$file	 						= "../file/";
	$Tanya = mysqli_query($con,"SELECT * FROM tb_packdev_add_resource WHERE  Request_No = '$id' and Status_add_resource<>'Draft'  ");
	if (mysqli_num_rows($Tanya) !=0 ) {  
		$message = "Error Delete Addition Resource Master : Request not delete";
		echo "<script type='text/javascript'>alert('$message');</script>";
		echo"<script>  window.location='../dist/index.php?button=arm'; </script>";}
	else {
		$exe =mysqli_query($con,"SELECT Request_No,Last_Request_No FROM tb_packdev_add_resource where Request_No = '$id' ");
        $tampildata=mysqli_fetch_array($exe);
		
		mysqli_query($con,"UPDATE tb_packdev_add_resource Set Status_Last_Document='1' where Request_No ='".$tampildata['Last_Request_No']."' ");
		mysqli_query($con,"DELETE FROM tb_inbox WHERE Request_No = '$id' ");
		mysqli_query($con,"DELETE FROM tb_workflownprf WHERE Request_No = '$id' ");

		$exe=mysqli_query($con,"SELECT No_ID,Request_No,FileLampiran FROM tb_packdev_add_resource_doc_lampiran 
		where Request_No = '$id' ");
		while(@$rowFile=mysqli_fetch_array($exe)){
			if (@$rowFile['FileLampiran']!="") {	
				unlink($file.@$rowFile['FileLampiran']);
			}
			mysqli_query($con,"Delete From tb_packdev_add_resource_doc_lampiran WHERE No_ID = '".$rowFile['No_ID']."' ");
		}

		mysqli_query($con,"DELETE FROM tb_packdev_add_resource_detail WHERE Request_No = '$id' ");
		mysqli_query($con,"DELETE FROM tb_packdev_add_resource WHERE Request_No = '$id' ");
		
		$message = "Data successfully Delete to database";
		echo "<script type='text/javascript'>alert('$message');</script>";
		echo"<script>  window.location='../dist/index.php?button=arm'; </script>";
	}
}
elseif ($pg=="del-arm-f2"){

	$Tanya = mysqli_query($con,"SELECT * FROM tb_packdev_add_resource_f2 WHERE  Request_No = '$id' and Status_add_resource<>'Draft'  ");
	if (mysqli_num_rows($Tanya) !=0 ) {  
		$message = "Error Delete Addition Resource Master Factory 2 : Request not delete";
		echo "<script type='text/javascript'>alert('$message');</script>";
		echo"<script>  window.location='../dist/index.php?button=arm-f2'; </script>";}
	else {
		$exe =mysqli_query($con,"SELECT Request_No,Last_Request_No FROM tb_packdev_add_resource_f2 where Request_No = '$id' ");
        $tampildata=mysqli_fetch_array($exe);
		
		mysqli_query($con,"UPDATE tb_packdev_add_resource_f2 Set Status_Last_Document='1' where Request_No ='".$tampildata['Last_Request_No']."' ");
		mysqli_query($con,"DELETE FROM tb_inbox WHERE Request_No = '$id' ");
		mysqli_query($con,"DELETE FROM tb_workflownprf WHERE Request_No = '$id' ");
		mysqli_query($con,"DELETE From tb_packdev_add_resource_doc_lampiran WHERE Request_No = '$id'");
		mysqli_query($con,"DELETE FROM tb_packdev_add_resource_f2_detail WHERE Request_No = '$id' ");
		mysqli_query($con,"DELETE FROM tb_packdev_add_resource_f2 WHERE Request_No = '$id' ");
		
		$message = "Data successfully Delete to database";
		echo "<script type='text/javascript'>alert('$message');</script>";
		echo"<script>  window.location='../dist/index.php?button=arm-f2'; </script>";
	}
}
elseif ($pg=="del-ps"){

	$Tanya = mysqli_query($con,"SELECT * FROM tb_packdev_spec WHERE  Request_No = '$id' and Status_Spec<>'Draft'  ");
	if (mysqli_num_rows($Tanya) !=0 ) {  
		$message = "Error Delete Packaging Spesification : Request not delete";
		echo "<script type='text/javascript'>alert('$message');</script>";
		echo"<script>  window.location='../dist/index.php?button=ps'; </script>";}
	else {
		$exe =mysqli_query($con,"SELECT Request_No,Last_Request_No FROM tb_packdev_spec where Request_No = '$id' ");
        $tampildata=mysqli_fetch_array($exe);
		
		mysqli_query($con,"UPDATE tb_packdev_spec Set Status_Last_Document='1' where Request_No ='".$tampildata['Last_Request_No']."' ");
				
		mysqli_query($con,"DELETE FROM tb_inbox WHERE Request_No = '$id' ");
		mysqli_query($con,"DELETE FROM tb_workflownprf WHERE Request_No = '$id' ");
		mysqli_query($con,"DELETE FROM tb_packdev_spec_detail WHERE Request_No = '$id' ");
		mysqli_query($con,"DELETE FROM tb_packdev_spec WHERE Request_No = '$id' ");
		
		$message = "Data successfully Delete to database";
		echo "<script type='text/javascript'>alert('$message');</script>";
		echo"<script>  window.location='../dist/index.php?button=ps'; </script>";
	}
}

/*DELETE Addition Resource Production*/
elseif ($pg=="del-prod-arm"){
	$file	 						= "../file/";
	$Tanya = mysqli_query($con,"SELECT * FROM tb_prod_add_resource WHERE  Request_No = '$id' and LAST_TRACK<>'1'  ");
	if (mysqli_num_rows($Tanya) !=0 ) {  
		$message = "Error Delete Addition Resource Master : Request not delete";
		echo "<script type='text/javascript'>alert('$message');</script>";
		echo"<script>  window.location='../dist/index.php?button=prod-arm'; </script>";}
	else {
		$exe =mysqli_query($con,"SELECT Request_No,Last_Request_No FROM tb_prod_add_resource where Request_No = '$id' ");
        $tampildata=mysqli_fetch_array($exe);

		mysqli_query($con,"UPDATE tb_prod_add_resource Set Status_Last_Document='1' where Request_No ='".$tampildata['Last_Request_No']."' ");
		$exe=mysqli_query($con,"SELECT No_ID,Request_No,FileLampiran FROM tb_prod_add_resource_doc_lampiran 
		where Request_No = '$id' ");
		while(@$rowFile=mysqli_fetch_array($exe)){
			if (@$rowFile['FileLampiran']!="") {	
				unlink($file.@$rowFile['FileLampiran']);
			}
			mysqli_query($con,"Delete From tb_prod_add_resource_doc_lampiran WHERE No_ID = '".$rowFile['No_ID']."' ");
		}
		mysqli_query($con,"DELETE FROM tb_req_tracking WHERE No_Req = '$id' ");
		mysqli_query($con,"DELETE FROM tb_prod_add_resource_detail_c_v WHERE Request_No = '$id' ");
		mysqli_query($con,"DELETE FROM tb_prod_add_resource_detail WHERE Request_No = '$id' ");
		mysqli_query($con,"DELETE FROM tb_prod_add_resource WHERE Request_No = '$id' ");
		
		$message = "Data successfully Delete to database";
		echo "<script type='text/javascript'>alert('$message');</script>";
		echo"<script>  window.location='../dist/index.php?button=prod-arm'; </script>";
	}
}

/*DELETE ARM */
elseif ($pg=="del-arm-detail"){
	
	mysqli_query($con,"DELETE FROM tb_packdev_add_resource_detail WHERE ID_No ='$id' ");
	$message = "Data successfully Delete to database";
	echo "<script type='text/javascript'>alert('$message');</script>";
}
/*DELETE ARM */
elseif ($pg=="del-arm2-detail"){
	mysqli_query($con,"DELETE FROM tb_packdev_add_resource_f2_detail WHERE ID_No ='$id' ");
	$message = "Data successfully Delete to database";
	echo "<script type='text/javascript'>alert('$message');</script>";
}

/*DELETE ARM PRODUCTION DETAIL */
elseif ($pg=="del-prod-arm-detail"){
	mysqli_query($con,"DELETE FROM ttb_prod_add_resource_detail WHERE ID_No ='$id' ");
	$message = "Data successfully Delete to database";
	echo "<script type='text/javascript'>alert('$message');</script>";
/*DELETE ARM PRODUCTION DETAIL */
}elseif ($pg=="del-prod-arm-detail_c_v"){
	mysqli_query($con,"DELETE FROM tb_prod_add_resource_detail_c_v WHERE ID_No ='$id' ");
	$message = "Data successfully Delete to database";
	echo "<script type='text/javascript'>alert('$message');</script>";

/*DELETE ARM PRODUCTION DETAIL */
}elseif ($pg=="del-prod-arm-detail_w_p"){
	mysqli_query($con,"DELETE FROM tb_prod_add_resource_detail_w_p WHERE ID_No ='$id' ");
	$message = "Data successfully Delete to database";
	echo "<script type='text/javascript'>alert('$message');</script>";
}
/*DELETE SP */
elseif ($pg=="del-ps-detail"){
	mysqli_query($con,"DELETE FROM tb_packdev_spec_detail WHERE ID_No ='$id' ");
	$message = "Data successfully Delete to database";
	echo "<script type='text/javascript'>alert('$message');</script>";
}
/*DELETE SUPPLIER REGISTER */
elseif ($pg=="del-supplier-register"){
	mysqli_query($con,"DELETE FROM tb_supplier where ID_No='$id'");
	$message = "Data successfully Delete to database";
	echo "<script type='text/javascript'>alert('$message');</script>";
	echo"<script>  window.location='../dist/index.php?button=supplier-register'; </script>";
}


else
{
$message = "Tidak ada function yang di pilih";
	echo "<script type='text/javascript'>alert('$message');</script>";
echo"<script>  window.location='../dist/index.php?button=dashboard'; </script>";
}
?> 