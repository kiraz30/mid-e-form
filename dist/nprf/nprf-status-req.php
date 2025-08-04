		<?php $Send		= @$_POST['Send']; ?>
	<?php $Save		= @$_POST['Save']; ?>
 
	<script language="JavaScript">
	function setFocus(){
	onload=enable_text(false);
	document.nprf.SelectTypeRequest.focus();
	document.nprf.Prioritypoint3.focus();
	document.nprf.InputOther.focus(); 
	document.nprf.ChkMCS.focus();
	document.nprf.ChkMTC.focus();
	document.nprf.ChkMCTL.focus();
	document.nprf.ChkMKC.focus();
	document.nprf.ChkMMSB.focus();
	document.nprf.ChkMVC.focus();
	document.nprf.ChkSMC.focus();
	document.nprf.ChkMPC.focus();

	}
	function setFocusAdvertising(){
	onload=enable_textAdvertising(false);
 	document.nprf.Advertising5.focus();
	document.nprf.AdvertisingOther.focus(); 
	
	}
	function setFocusSentTo(){
	document.nprf.SelectSentTo.click(); 
	}
	
	function enable_text(status)
	{
	status=!status;    
		document.nprf.Purpose1.focus();
		document.nprf.Purpose2.focus();
		document.nprf.Purpose3.focus();
		document.nprf.Purpose4.focus();
		document.nprf.Purpose5.focus();
		document.nprf.Prioritypoint1.focus();
		document.nprf.Prioritypoint2.focus();
		document.nprf.Prioritypoint3.focus();
		document.nprf.InputOther.disabled = status;
		document.nprf.InputOther.value= "";
		document.nprf.InputOther.focus();
	}
	
	</script>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Static Navigation - SB Admin</title>
        <link href="../css/styles.css" rel="stylesheet" />
		<!-- Bootstrap Core CSS -->
		<link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	
		<!-- MetisMenu CSS -->
		<link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
	
		<!-- Custom CSS -->
		<link href="../css/sb-admin-2.css" rel="stylesheet">
		<script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
	
		<!-- Custom Fonts -->
		<link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
		<script type="text/javascript">
		function popupwindow(url, title, h, w) {
		  var left = (screen.width/2)-(w/2);
		  var top = (screen.height/2)-(h/2);
		  return window.open(url, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, 	copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
		  return false;
		} 
	</script>
    </head>
	<body onload='setFocus();setFocusSentTo();setFocusAdvertising();' > 
	<main> 
    <div class="container-fluid"> 
      <h3 class="mt-4">Status Request NPRF </h3>
	    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="../dist/index.php?button=dashboard">Dashboard</a></li>
		<li class="breadcrumb-item"><a href="../dist/index.php?button=<?php echo $_GET['menu']; ?>">
		<?php if($_GET['menu']=="status-req") {echo "Status Request" ;} else {echo "Completed Request"; }  ?>  </a></li>
        <li class="breadcrumb-item active">New Request NPRF </li>
      </ol>
 	<div class="card mb-4">
	    <div class="card-header"> </div>

        <div class="card-body"> 
			
        <?php
		include "nprf-autonumber.php";
      	$exe =mysqli_query($con,"SELECT ID_No,Index_Document,Request_No,Last_Request_No,Thema_Number,Thema_Name,Type_Request,SentTo,
		Purpose_1,Purpose_2,Purpose_3,Purpose_4,Purpose_5,Priority_Point_EmphasisOnPrice,Priority_Point_HighQuality,
		Priority_Point_Other,Priority_Point_OtherEtc,Launching_Date,DATE_FORMAT(Launching_Date, '%m') Bulan,
		DATE_FORMAT(Launching_Date, '%Y') Tahun,Objective_Aim,Goal_Indicator,Market_Situasion,T_Consumer_M,T_Consumer_F,T_Age_GroupStart,
		T_Age_GroupEnd,T_Sosial_Economic_Class,Status_NPRF,Proposed_Concept,Request_for_Content,Request_for_Design,
		Competitor,Distribution,TargetWants,Advertising_1,Advertising_2,Advertising_3,Advertising_4,Advertising_5,Advertising_Other,
		MCS_Chk,MCS,MKC_Chk,MKC,MCTL_Chk,MCTL,MTC_Chk,MTC,MMSB_Chk,MMSB,MVC_Chk,MVC,SMC_Chk,SMC,MPC_Chk,MPC,
		Others,Outline_of_Schedule,Remark,Mcj,Master_Schedule,RemarkafterComplete 
		FROM tb_nprf where Request_No = '".@$_GET['id']."' ");
        $tampildata=mysqli_fetch_array($exe);
		//________________________________________________________________________________UPDATE READ INBOX
		mysqli_query($con,"UPDATE tb_inbox SET ReadInbox='1' Where (NameApproval= '$username' Or OnBehalf='$username') 
		And Request_No='".@$_GET['id']."' And ReadInbox='0'");
		//________________________________________________________________________________WORK FLOW PROCESS
      	$exeWFP = mysqli_query($con,"SELECT WorkFlowMenu,Index_No,NameApproval,OnBehalf,StatusWorkFlow FROM tb_workflownprf 
		WHERE (NameApproval='$username' or OnBehalf ='$username') And Request_No = '".@$_GET['id']."' ");
        $tampildataWFR=mysqli_fetch_array($exeWFP);
		$NextStep_Index= @$tampildataWFR['Index_No']+1;
		$BackStep_Index= @$tampildataWFR['Index_No']-1;
	  	?>
	<form name="nprf" action="" method="post"  >
    <?php 
	//Begin CRUD----------------------------------------------------------------------
	$uploadDirFileProposedconcept	= "../img/Proposed_concept/";
	$uploadDirFileRequestforcontent = "../img/Request_for_content/";
	$uploadDirFileRequestfordesign 	= "../img/Request_for_design/";
	$uploadDirFileItemdetail 		= "../img/Item_detail/";
	$uploadDirFileCompetitor	 	= "../img/Competitor/";
	$uploadDirFileMcj	 			= "../img/Mcj/";
	$uploadDirFileOutlineofSchedule	= "../img/Outline_of_Schedule/";
	$uploadDirFileMaster_Schedule	= "../img/Master_Schedule/";
	if($_POST){
		$ip=$_SERVER['REMOTE_ADDR'];
		$hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);
		date_default_timezone_set("Asia/Jakarta");
		$createddate=date("Y-m-d H:i:s");
    	$tempFormatNoRequest  	= $_POST['tempFormatNoRequest'];
		$inputAutoRequestNo		= $_POST['inputAutoRequestNo'];
		$inputThemaNumber	 	= @$_POST['inputThemaNumber']; 
		$inputThemaName 	 	= @$_POST['inputThemaName']; 
		$SelectTypeRequest	 	= @$_POST['SelectTypeRequest'];
		if (!@$_POST['Purpose1']<>1){$valPurpose1=0;} else {$valPurpose1=1;}
		if (!@$_POST['Purpose2']){$valPurpose2=0;} else {$valPurpose2=1;}
		if (!@$_POST['Purpose3']){$valPurpose3=0;} else {$valPurpose3=1;}
		if (!@$_POST['Purpose4']){$valPurpose4=0;} else {$valPurpose4=1;}
		if (!@$_POST['Purpose5']){$valPurpose5=0;} else {$valPurpose5=1;}
		
		if (!@$_POST['Prioritypoint1']<>1){$valPrioritypoint1=0;} else {$valPrioritypoint1=1;}
		if (!@$_POST['Prioritypoint2']){$valPrioritypoint2=0;} else {$valPrioritypoint2=1;}
		if (!@$_POST['Prioritypoint3']){$valPrioritypoint3=0;} else {$valPrioritypoint3=1;}
		$InputMCS						= @$_POST['InputMCS'];
		$InputMKC						= @$_POST['InputMKC'];
		$InputMCTL						= @$_POST['InputMCTL'];
		$InputMTC						= @$_POST['InputMTC'];
		$InputMMSB						= @$_POST['InputMMSB'];
		$InputMVC						= @$_POST['InputMVC'];
		$InputSMC						= @$_POST['InputSMC'];
		$InputMPC						= @$_POST['InputMPC'];
		$InputOther				= @$_POST['InputOther'];
		$InputLaunchingDate 	= @$_POST['InputLaunchingDate'];
		$inputMarketSituation	= @$_POST['inputMarketSituation'];
		$InputAgeGroup	 		= @$_POST['InputAgeGroup'];
		$InputSocialEconomic	= @$_POST['InputSocialEconomic'];
		$InputOthers			= @$_POST['InputOthers'];

		$inputRemark			= @$_POST['inputRemark'];
		
		}
		//End CRUD----------------------------------------------------------------------
		?>
          <table width="100%" class="table table-striped" id="dataTables-example" border="0" >
            <tr>
              <td><span class="form-group">Request No</span></td>
              <td colspan="2"><span class="form-group">
				<input name="tempFormatNoRequest" type="hidden" value="<?php echo $tampildata['Request_No']; ?>">
                <input class="form-control py-4"  name="inputAutoRequestNo" id="inputAutoRequestNo"  maxlength="50" type="text"  
			  placeholder="Auto Request No" readonly="readonly" 
			  value="<?php if ($button=="add-nprf") {echo $NomorReq;} else {echo @$tampildata['Request_No'];} ?>" />
              </span></td>
            </tr>
            <tr>
              <td>Thema Number</td>
              <td colspan="2"><span class="form-group">
                <input class="form-control py-4" name="inputThemaNumber"  maxlength="50" type="text" placeholder="Enter Thema Number"  
				value="<?php if ($_POST) { echo $inputThemaNumber; } else {echo @$tampildata['Thema_Number'];} ?>" disabled="disabled" />
              </span></td>
            </tr>
            <tr>
              <td><span class="form-group">Thema Name *</span></td>
              <td colspan="2"><span class="form-group">
                <input class="form-control py-4" name="inputThemaName"  maxlength="50" type="text" placeholder="Enter Thema Name"
			   value="<?php if ($_POST) { echo $inputThemaName; } else {echo @$tampildata['Thema_Name'];} ?>" disabled="disabled" />
              </span></td>
            </tr>
            <tr>
              <td>Request Type *</td>
              <td colspan="2"><select class="form-control" name="SelectTypeRequest" disabled="disabled" >
			  <option value="-">Select Request Type </option>
				<option value="Domestic" <?php if ($_POST) {echo $SelectTypeRequest;} elseif (@$tampildata['Type_Request']=='Domestic') {echo "Selected"; }?>>Domestic</option>
            	<option value="Export" <?php if (@$tampildata['Type_Request']=='Export') {echo "Selected";} ?>>Export</option>
              </select>
			  <table name="country" id="country" width="100%" border="0">
				<?php
					$exe = mysqli_query($con,"SELECT ID_No,Country,Index_No 
					FROM tb_nprf_country Where Request_No = '".$tampildata['Request_No']."'   ");
					$no = 1;
					while(@$rowNPRFCountry =mysqli_fetch_array($exe)){
					?>
				  <tr>
					<td height="27" colspan="2"><?php echo $no; ?> <?php echo $rowNPRFCountry['Country']; ?></td>
				  </tr>
				  <?php $no++;} ?>
				  </table>
				  
			  </td>
            </tr>
			<tr>
              <td>Sent To *</td>
              <td colspan="2"><select class="form-control" id="SelectSentTo" name="SelectSentTo" disabled="disabled"
			  onChange="setFocusSentTo(),get_detaildata()" onFocus="setFocusSentTo(),get_detaildata()">
			  <option value="">Select Sent To </option>
				<?php
					$div = mysqli_query($con,"SELECT No_ID,SentTo FROM tb_ms_sent_to  Where Status=1  ");
					while($b = mysqli_fetch_array($div)){
						if($tampildata['SentTo'] == $b['No_ID']){
							$cek = 'Selected';
						}elseif($inputSentTo == $b['No_ID']){
							$cek = 'Selected';
						}else{
							$cek = '';
						}
						echo"<option value='".$b['No_ID']."' $cek>".$b['SentTo']."</option>";
					}
				?>
              </select> 
			  <table name="nprfaddressto" id="nprfaddressto" class="table table-striped table-bordered table-sm" ></table>			  </td>
            </tr>
            <tr>
              <td height="80" rowspan="2">Purpose *</td>
              <td rowspan="2">
                <label><input type="checkbox" name="Purpose1" <?php if (@$tampildata['Purpose_1']==1) { echo 'checked="checked"';} ?> disabled="disabled">
				1) Creation of new market by new proposal</label> <br>
                <label><input type="checkbox" name="Purpose2" <?php if (@$tampildata['Purpose_2']==1) { echo 'checked="checked"';} ?> disabled="disabled">
				2) Category entry into growing market or giant market</label><br> 
              	<label><input type="checkbox" name="Purpose3" <?php if (@$tampildata['Purpose_3']==1) { echo 'checked="checked"';} ?> disabled="disabled">
				3) Line extension for the existing product group</label> <br>
			  	<label><input type="checkbox" name="Purpose4" <?php if (@$tampildata['Purpose_4']==1) { echo 'checked="checked"';} ?> disabled="disabled">
				4) Cost reduction of the existing products (production site transfer)</label><br>
			 	<label> <input type="checkbox" name="Purpose5" <?php if (@$tampildata['Purpose_5']==1) { echo 'checked="checked"';} ?> disabled="disabled">
				5) Renewal of existing Products to improve quality</label> <br></td>
              <td width="257" class="alert-light"><div align="center" class="alert-primary">Priority point *</div></td>
            </tr>
            <tr>
              <td height="70">
			  	<label><input type="checkbox" name="Prioritypoint1" <?php if (@$tampildata['Priority_Point_EmphasisOnPrice']==1) { echo 'checked="checked"';} ?> disabled="disabled">
				1) Emphasis on price </label> <br>
			  	<label> <input type="checkbox" name="Prioritypoint2" <?php if (@$tampildata['Priority_Point_HighQuality']==1) { echo 'checked="checked"';} ?> disabled="disabled">
				2) High quality </label> <br>
			  	<label> <input type="checkbox" name="Prioritypoint3" id="Prioritypoint3"  <?php if (@$tampildata['Priority_Point_Other']==1) { echo 'checked="checked" ';} ?> 
				onClick="enable_text(this.checked)" onFocus="enable_text(this.checked)" disabled="disabled">
				3) Other </label> 
				<input name="InputOther"  id="InputOther" size="30" maxlength="50" type="text" placeholder="Enter Other" 
				value="<?php if ($_POST) { echo $InputOther; } else {echo @$tampildata['Priority_Point_OtherEtc'];} ?>" / disabled="disabled"></td>
            </tr>
            
            <tr>
              <td>Launching Date / Shipment Date (for Export Product) *</td>
			    <td width="">
				<div class="form-group d-flex align-items-center justify-content-between mt-0 mb-2">
				<select name="Selectbulan" id="Selectbulan" class="form-control" disabled="disabled">
				<?php
					$div = mysqli_query($con,"SELECT Bulan,Ket FROM tb_bulan");
					while($b = mysqli_fetch_array($div)){
						if(@$tampildata['Bulan'] == $b['Bulan']){
							$cek = 'Selected';	}
						elseif($Selectbulan == $b['Bulan']){
							$cek = 'Selected';	}
						else{
							$cek = '';	}
					echo"<option value='".$b['Bulan']."' $cek>".$b['Ket']."</option> ";}
				?></select>				
				<select name="SelectTahun" id="SelectTahun" title="Tahun" class="form-control" disabled="disabled">
					<option value="">Tahun</option>
					<?php 
					$mulai= date('Y');
					for($i = $mulai;$i<$mulai + 5;$i++){?>
					<option value="<?php echo $i; ?>" <?php if (@$tampildata['Tahun']==$i) 
					{echo "Selected";} ?>><?php echo $i; ?></option><?php }	?>
				</select></div> </td>
				<td>Example : Januari 2020</td>
            </tr>
			<tr>
              <td>Objective / Aim *</td>
              <td colspan="2"><textarea  id="inputObjectiveAim"  name="inputObjectiveAim"  class="ckeditor" 
				placeholder="Enter Objective / Aim" disabled="disabled" ><?php if ($_POST) { echo $inputObjectiveAim; } else {echo @$tampildata['RemarkafterComplete'];} ?></textarea></td>
            </tr>
			<tr>
              <td>Goal indicator / When & How to measure *</td>
              <td colspan="2"><textarea  id="inputGoalIndicator"  name="inputGoalIndicator"  class="ckeditor" 
				placeholder="Enter Goal indicator / When & How to measure" 
				disabled="disabled" ><?php if ($_POST) { echo $inputGoalIndicator; } else {echo @$tampildata['RemarkafterComplete'];} ?></textarea></td>
            </tr>
            <tr>
              <td height="84">Market situation /  Background of request</td>
              <td colspan="2"><span class="form-group"> 
        		<textarea  name="inputMarketSituation" class="ckeditor" placeholder="Enter Market Situasion" 
				disabled="disabled"><?php if ($_POST) { echo $inputMarketSituation; } else {echo @$tampildata['Market_Situasion'];} ?></textarea>
        		</span>
			</td>
            </tr>
            <tr>
              <td rowspan="3"  height="50">Target</td>
              <td colspan="2"> 
				<span class="form-row"> 
				  <span class="col-md-3"> 
					<span class="form-group"> 
					  <label class="small mb-1" for="inputFirstName">Consumer </label><br>
						<label><input type="checkbox" name="Consumer1"  <?php if (@$tampildata['T_Consumer_M']==1) { echo 'checked="checked"';} ?> disabled="disabled"></label>
						 Male</label><br>
						<label><input type="checkbox" name="Consumer2"  <?php if (@$tampildata['T_Consumer_F']==1) { echo 'checked="checked"';} ?> disabled="disabled"></label>
						 Female</label>
					</span>
				  </span>
				  <span class="col-md-3"> 
					<span class="form-group"> 
					  <label class="small mb-1" for="inputFirstName">Age Group</label>  
					  <div class="form-group d-flex align-items-center justify-content-between mt-0 mb-2">
					  <select style="padding:2px 2px 2px 2px" class="form-control" 
					  name="InputAgeGroupStart" id="InputAgeGroupStart" disabled="disabled">
						<option value="">Start</option>
						<?php
							for ($i=0; $i<=99 ; $i++) {?>
						<option value="<?php echo $i; ?>" <?php if (@$tampildata['T_Age_GroupStart']==$i) {echo "Selected";} ?>><?php echo $i; ?></option>

						<?php }	?>
					  </select>
					  <select style="padding:2px 2px 2px 2px" class="form-control" 
					  name="InputAgeGroupEnd" id="InputAgeGroupEnd" disabled="disabled">
						<option value="">End</option>
						<?php
							for ($i=0; $i<=99 ; $i++) {?>
						<option value="<?php echo $i; ?>" <?php if (@$tampildata['T_Age_GroupEnd']==$i) {echo "Selected";} ?>><?php echo $i; ?></option>
						<?php }	?>
					  </select>
					  </div>
					</span>
				  </span>
				  <span class="col-md-3"> 
					<span class="form-group"> 
					  <label class="small mb-1" for="inputFirstName">Social Economic </label>  
					  <input class="form-control py-4" name="InputSocialEconomic"  maxlength="50" type="text" 
			  			placeholder="Enter Age Group" title="10-20" 
						value="<?php if ($_POST) { echo $InputSocialEconomic; } else {echo @$tampildata['T_Sosial_Economic_Class'];} ?>" disabled="disabled"/>
					</span>
				  </span>
				</span>				
				</td>
				<tr>
				<td colspan="2"><label class="small mb-1" for="inputFirstName">Distribution </label>  
        			<textarea cols="2" class="form-control py-2" id="InputDistribution" name="InputDistribution" 
					placeholder="Enter Distribution" disabled="disabled"
					><?php if ($_POST) { echo $InputDistribution; } else {echo @$tampildata['Distribution'];} ?></textarea>
				</td>
				</tr>
				<tr>
              	<td colspan="2"><table name="nprfCompetitor" id="nprfCompetitor"  width="100%" border="1" class="table table-striped table-bordered table-hover" >
				  <tr>
					<td colspan="11" align="left">Competitor</td>
				  </tr>
				  <tr valign="bottom" align="center" bgcolor="#999999">
					<th width="1%">No</th>
					<th width="20%">New Product</th>
					<th width="5%">Netto</th>
					<th width="5%">Retail Price</th>
					<th width="20%">Reason (s) Why a competitive product sells well</th>
				  </tr>
					 <?php
					$exe = mysqli_query($con,"SELECT ID_No,New_Product,Isi_Net,Netto,NamaCurrency,Price,Reason,Index_No 
					FROM tb_nprf_competitor Where Request_No = '".@$tampildata['Request_No']."'   ");
					$no = 1;
					if (mysqli_num_rows($exe) !=0 ) { 
					while(@$rowNPRFCompetitor =mysqli_fetch_array($exe)){
					?>
				  <tr>
					<td><?php echo $no; ?></td>
					<td><?php echo $rowNPRFCompetitor['New_Product']; ?></td>
					<td><?php echo @$rowNPRFCompetitor['Isi_Net']." ".@$rowNPRFDetail['Netto']; ?></td>
					<td><?php echo @$rowNPRFCompetitor['NamaCurrency']." ".number_format(@$rowNPRFCompetitor['Price'], 2, ",", "."); ?></td>
					<td><?php echo @$rowNPRFCompetitor['Reason']; ?></td>
				  </tr>
				  <?php $no++;}} else { echo "<td colspan='5' align='center'>Tidak ada data</td>";}?>
				  </table></td>
            </tr>
            <tr>
              <td>Proposed concept</td>
              <td colspan="2">
			   <span class="form-group"> 
				<textarea class="ckeditor" id="inputProposedconcept" name="inputProposedconcept" 
				disabled="disabled"><?php if ($_POST) { echo $inputProposedconcept; } elseif (!empty($tampildata['Proposed_Concept'])) 
				{ echo $tampildata['Proposed_Concept'];}  ?></textarea>
        	   </span>		
			  </td>
            </tr>
            <tr>
              <td>Request for content, production base, etc</td>
              <td colspan="2">
			  <span class="form-group"> 
				<textarea class="ckeditor" id="inputRequest_for_Content" name="inputRequest_for_Content"  
				disabled="disabled"><?php if ($_POST) { echo $inputRequest_for_Content; } elseif (!empty($tampildata['Request_for_Content'])) 
				{ echo $tampildata['Request_for_Content'];}  ?></textarea>
        	   </span></td>
            </tr>
            <tr>
              <td>Request for design, container, etc.</td>
              <td colspan="2">
			  <span class="form-group"> 
				<textarea class="ckeditor" id="inputRequest_for_Design" name="inputRequest_for_Design"  
				disabled="disabled"><?php if ($_POST) { echo $inputRequest_for_Content; } elseif (!empty($tampildata['Request_for_Design'])) 
				{ echo $tampildata['Request_for_Design'];}  ?></textarea>
        	   </span>
			  </td>
            </tr>
            <tr>
              <td colspan="3"><table name="nprfitemdetail" id="nprfitemdetail"  width="100%" border="1" class="table table-striped table-bordered table-hover" >
			   
				  <tr>
					<td colspan="11" align="left">Proposed item(s)</td>
				  </tr>
				  <tr valign="bottom" align="center" bgcolor="#999999">
					<th width="1%">No</th>
					<th width="10%">Item No. (Product Development Department)</th>
					<th width="20%">Item name (tentative name)</th>
					<th width="10%">Volume</th>
					<th width="7%">Suggested Retail Price(HET)</th>
					<th width="5%">HPJ (Domestic)</th>
					<th width="5%">Requested C&F/CIF/FOB/ Price (EXPORT)</th>
					<th width="10%">COG PRICE</th>
					<th width="10%">COGS(%)</th>
					<th width="10%">Initial Introduction</th>
					<th width="10%">Annual Sales</th>
				  </tr>
					 <?php
					$exe = mysqli_query($con,"SELECT ID_No,MCJ_Item_No,New_Product,Status_Product,NamaCurrency,
					Price,HPJ,C_FPrice,NamaCurrencyTargetCOGS,Target_COGS,COGS,Sales_3Mth,Introduction,Satuan_Sales1Yr,Sales_1yr,Index_No 
					FROM tb_nprf_Item_detail Where Request_No = '".@$tampildata['Request_No']."'   ");
					$no = 1;
					if (mysqli_num_rows($exe) !=0 ) { 
					while(@$rowNPRFDetail =mysqli_fetch_array($exe)){
					?>
				  <tr>
					<td><?php echo $no; ?></td>
					<td><?php echo $rowNPRFDetail['MCJ_Item_No']; ?></td>
					<td><?php echo $rowNPRFDetail['New_Product']; ?></td>
					<td><?php $isinetto="";
					$exeNetto = mysqli_query($con,"SELECT ID_No,Isi_Net,Netto,Index_No 
					FROM tb_nprf_item_detail_netto Where ID_No_ItemDetail = '".$rowNPRFDetail['ID_No']."' Order By ID_No Asc");
					while(@$rowNPRFDetailNetto =mysqli_fetch_array($exeNetto)){ 
						$isinetto=$isinetto.$rowNPRFDetailNetto['Isi_Net']." ".$rowNPRFDetailNetto['Netto'].", ";
					} 
					echo substr($isinetto,0,-2);  ?></td>
					<td align="right"><?php echo $rowNPRFDetail['NamaCurrency']; ?> <?php if ($rowNPRFDetail['Price']==0) {echo "";} else { echo number_format(@$rowNPRFDetail['Price'], 2, ",", ".");} ?></td>
					<td align="right"><?php if ($rowNPRFDetail['HPJ']==0) {echo "";} else { echo number_format(@$rowNPRFDetail['HPJ'], 2, ",", ".");} ?>					</td>
					<td align="right"><?php if ($rowNPRFDetail['C_FPrice']==0) {echo "";} else { echo number_format(@$rowNPRFDetail['C_FPrice'], 2, ",", ".");} ?> </td>
					<td align="right"><?php echo $rowNPRFDetail['NamaCurrencyTargetCOGS']; ?>  <?php if ($rowNPRFDetail['Target_COGS']==0) {echo "";} else { echo number_format(@$rowNPRFDetail['Target_COGS'], 2, ",", ".");} ?></td>
					<td align="right"><?php if ($rowNPRFDetail['COGS']==0) {echo "";} else { echo number_format(@$rowNPRFDetail['COGS'], 2, ",", ".");} ?></td>
					<td align="right"><?php echo @$rowNPRFDetail['Sales_3Mth']; ?> 
						<?php if ($rowNPRFDetail['Introduction']==0) {echo "";} else { echo number_format(@$rowNPRFDetail['Introduction'], 2, ",", ".");} ?> </td>
					<td><?php echo @$rowNPRFDetail['Satuan_Sales1Yr']; ?> 
						<?php if ($rowNPRFDetail['Sales_1yr']==0) {echo "";} else { echo number_format(@$rowNPRFDetail['Sales_1yr'], 2, ",", ".");} ?></td>
				  </tr>
				  <?php $no++;}} else { echo "<td colspan='10' align='center'>Tidak ada data</td>";}?>
				  </table></td>
            </tr>
			<tr>
              <td>Distribution</td>
              <td colspan="2"><span class="form-group"> 
        <textarea cols="2" class="form-control py-2" id="InputDistribution" name="InputDistribution" 
				placeholder="Enter Distribution" disabled="disabled"><?php if ($_POST) { echo $InputDistribution; } else {echo $tampildata['Distribution'];} ?></textarea>
			  </span></td>
            </tr>
            <tr>
              <td>Advertising & Promotion</td>
              <td colspan="2"> 
			  	<label><input type="checkbox" name="Advertising1" disabled="disabled" <?php if (@$tampildata['Advertising_1']==1) { echo 'checked="checked"';} ?>>
				By using a combination of Advertising & Promotion</label> <br>  
                <label><input type="checkbox" name="Advertising2" disabled="disabled" <?php if (@$tampildata['Advertising_2']==1) { echo 'checked="checked"';} ?>>
				Making it a regular item by listing</label><br> 
				<label><input type="checkbox" name="Advertising3" disabled="disabled" <?php if (@$tampildata['Advertising_3']==1) { echo 'checked="checked"';} ?>>
				By doing only Promotion (no Advertising)</label> <br>
			  	<label><input type="checkbox" name="Advertising4" disabled="disabled" <?php if (@$tampildata['Advertising_4']==1) { echo 'checked="checked"';} ?>>
				By avoiding listing fees as much as possible</label><br>
			 	<label><input type="checkbox" name="Advertising5" disabled="disabled" id="Advertising5"  <?php if (@$tampildata['Advertising_5']==1) { echo 'checked="checked" ';} ?> 
				onClick="enable_textAdvertising(this.checked)" onFocus="enable_textAdvertising(this.checked)" >
				Other ( <?php if ($_POST) { echo $AdvertisingOther; } else {echo @$tampildata['Advertising_Other'];} ?> )</label> 
				 
				</td>
            </tr>
			<tr>
              <td>Country planned to sell </td>
              <td colspan="2">
			  	<table>
					<tr>
						<td>
							<label><input type="checkbox" name="ChkMCS" id="ChkMCS" disabled="disabled" 
							<?php if (@$tampildata['MCS_Chk']==1) { echo 'checked="checked"';} ?>  > MCS</label>
							<input name="InputMCS"  class="form-control py-4" id="InputMCS" size="25" maxlength="50"
							type="text" placeholder="Enter MCS" disabled="disabled"
							value="<?php if ($_POST) { echo $InputMCS; } else {echo @$tampildata['MCS'];} ?>"> 
						</td>
						<td>
							<label><input type="checkbox" name="ChkMKC" id="ChkMKC" disabled="disabled"
							<?php if (@$tampildata['MKC_Chk']==1) { echo 'checked="checked"';} ?>  > MKC</label>
							<input name="InputMKC"  class="form-control py-4"id="InputMKC" size="25" maxlength="50" 
							type="text" placeholder="Enter MKC" disabled="disabled" 
							value="<?php if ($_POST) { echo $InputMKC; } else {echo @$tampildata['MKC'];} ?>"> 
						</td>
						
						<td>
							<label><input type="checkbox" name="ChkMCTL" id="ChkMCTL" disabled="disabled"
							<?php if (@$tampildata['MCTL_Chk']==1) { echo 'checked="checked"';} ?> > MCTL</label>
							<input name="InputMCTL"  class="form-control py-4" id="InputMCTL" size="25" maxlength="50" 
							type="text" placeholder="Enter MCTL" disabled="disabled"
							value="<?php if ($_POST) { echo $InputMCTL; } else {echo @$tampildata['MCTL'];} ?>"> 
						</td>
					</tr>
					<tr>
						<td>
							<label><input type="checkbox" name="ChkMTC" id="ChkMTC" disabled="disabled"
							<?php if (@$tampildata['MTC_Chk']==1) { echo 'checked="checked"';} ?> > MTC </label>
							<input name="InputMTC" class="form-control py-4"  id="InputMTC" size="25" maxlength="50" 
							type="text" placeholder="Enter MTC" disabled="disabled"
							value="<?php if ($_POST) { echo $InputMTC; } else {echo @$tampildata['MTC'];} ?>"> 
						</td>
						<td>
							<label><input type="checkbox" name="ChkMMSB" id="ChkMMSB" disabled="disabled"
							<?php if (@$tampildata['MMSB_Chk']==1) { echo 'checked="checked"';} ?> > MMSB</label>
							<input name="InputMMSB" class="form-control py-4" id="InputMMSB" size="25" maxlength="50" 
							type="text" placeholder="Enter MMSB" disabled="disabled" 
							value="<?php if ($_POST) { echo $InputMMSB; } else {echo @$tampildata['MMSB'];} ?>"> 
						</td>
						<td>
							<label><input type="checkbox" name="ChkMVC" id="ChkMVC" disabled="disabled"
							<?php if (@$tampildata['MVC_Chk']==1) { echo 'checked="checked"';} ?> > MVC </label>
							<input name="InputMVC"  class="form-control py-4" id="InputMVC" size="25" maxlength="50" 
							type="text" placeholder="Enter MVC" disabled="disabled"
							value="<?php if ($_POST) { echo $InputMVC; } else {echo @$tampildata['MVC'];} ?>"> 
						</td>
					</tr>
					<tr>
						<td>
							<label><input type="checkbox" name="ChkSMC" id="ChkSMC" disabled="disabled"
							<?php if (@$tampildata['SMC_Chk']==1) { echo 'checked="checked"';} ?>> SMC</label>
							<input name="InputSMC" class="form-control py-4" id="InputSMC" size="25" maxlength="50" 
							type="text" placeholder="Enter SMC" disabled="disabled"
							value="<?php if ($_POST) { echo $InputSMC; } else {echo @$tampildata['SMC'];} ?>"> 
						</td>
						<td>
							<label><input type="checkbox" name="ChkMPC" id="ChkMPC" disabled="disabled"
							<?php if (@$tampildata['MPC_Chk']==1) { echo 'checked="checked"';} ?> > MPC </label>
							<input name="InputMPC" class="form-control py-4" id="InputMPC" size="25" maxlength="50" 
							type="text" placeholder="Enter MPC" disabled="disabled"
							value="<?php if ($_POST) { echo $InputMPC; } else {echo @$tampildata['MPC'];} ?>"> 
						</td>
						<td>
							 
						</td>
					</tr>
				</table>
			  　</td>
            </tr>

            <tr>
              <td>Remarks / Reason(s) for change/revision</td>
              <td colspan="2"><textarea cols="4"  id="InputOthers"  name="InputOthers"  class="form-control py-4" 
			placeholder="Enter Remarks / Reason(s) for change/revision" 
			disabled="disabled"><?php if ($_POST) { echo $InputOthers; } else {echo $tampildata['Others'];} ?></textarea></td>
            </tr>
			<tr>
              <td colspan="3"><table name="nprfOutlineofSchedule" id="nprfOutlineofSchedule"  width="100%" border="1" class="table table-striped table-bordered table-hover" >
				  <tr>
					<td colspan="11" align="left">Outline of Schedule</td>
				  </tr>
				  <tr valign="bottom" align="center" bgcolor="#999999">
					<th width="1%">No</th>
					<th width="20%">Outline of Schedule</th>
					<th width="5%">Date</th>
				  </tr>
					 <?php
					$exe = mysqli_query($con,"SELECT ID_No,Keterangan,Bulan,Tahun,Index_No 
					FROM tb_nprf_outlineofschedule Where Request_No = '".$tampildata['Request_No']."'   ");
					$no = 1;
					if (mysqli_num_rows($exe) !=0 ) { 
					while(@$rowNPRFOutlineofschedule =mysqli_fetch_array($exe)){
					?>
				  <tr>
					<td><?php echo $no; ?></td>
					<td><?php echo $rowNPRFOutlineofschedule['Keterangan']; ?></td>
					<td><?php echo $rowNPRFOutlineofschedule['Bulan']." ".$rowNPRFOutlineofschedule['Tahun']; ?></td>
				  </tr>
				  <?php $no++;}} else { echo "<td colspan='3' align='center'>Tidak ada data</td>";}?>
				  </table></td>
            </tr>
            <tr>
              <td>Remark</td>
              <td colspan="2"><div class="form-group"> <textarea cols="4"  name="inputRemark"  class="form-control py-4" 
			placeholder="Enter Remark" disabled="disabled"><?php if ($_POST) { echo $inputRemark; } else {echo @$tampildata['Remark'];} ?></textarea></div>
			  </td>
            </tr>		
			<tr>
              <td>MCJ File</td>
			  <td colspan="2">
		  
			  <?php if (!empty($tampildata['Mcj'])){?>
			  	<img height="20" width="20" src=../img/pdf.png  title="Preview Pdf <?php echo $tampildata['Mcj'];?>"
				onClick="popupwindow('../config/open-pdf.php?folder=<?php echo $uploadDirFileMcj; ?>&pdfname=mcj&kd=<?php echo $tampildata['Request_No']; ?>&page=nprf','Preview Pdf','700','1000');">
			   <?php echo $tampildata['Mcj']; }  ?>
			  </td>
            </tr>
			<tr>
              <td>Master Schedule</td>
              <td colspan="2">
			 
			  <?php if (!empty($tampildata['Master_Schedule'])){?>
			  	<img height="20" width="20" src=../img/pdf.png  title="Preview Pdf <?php echo $tampildata['Master_Schedule'];?>"
				onClick="popupwindow('../config/open-pdf.php?folder=<?php echo $uploadDirFileMaster_Schedule; ?>&pdfname=Master_Schedule&kd=<?php echo $tampildata['Request_No']; ?>&page=nprf','Preview Pdf','700','1000');">
			  <?php echo $Master_Schedule['Master_Schedule']; }  ?>
			  </td>
            </tr>
          </table>
			<a class="btn btn-primary" href="../dist/index.php?button=<?php echo $_GET['menu']; ?>"
			 title="Back Status Request">Back</a> 
		</form>
		</div>
      </div>
	 </div>
    </main> 
    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="../vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="../vendor/datatables-responsive/dataTables.responsive.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../js/sb-admin-2.js"></script>
	
	    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
    </script>
	</body>
</html>
<script>
$(document).ready(function(){
 $('#SelectSentTo').click(function(){
  get_detaildata();
 });
});
$(document).ready(function(){
 $('#SelectSentTo').focus(function(){
  get_detaildata();
 });
});
 function get_detaildata(){
  var a = $('#SelectSentTo').val();

  $.ajax({
   type: 'POST',
   url: "nprf/nprf-load-address-to.php",
   
   data: { data1: a, },
   success: function(info) {
	$("#nprfaddressto").html(info);  
	}
  });
  return false;
 }
</script>