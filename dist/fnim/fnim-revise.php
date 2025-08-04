	<?php $Send		= @$_POST['Send']; ?>
	<?php $Save		= @$_POST['Save']; 

	
	
	?>
<script language="JavaScript">
	
	/* Removes the clear button from date inputs */
input[type="date"]::-webkit-clear-button {
    display: none;
}

	/* Removes the spin button */
	input[type="date"]::-webkit-inner-spin-button { 
		display: none;
	}
	
	/* Always display the drop down caret */
	input[type="date"]::-webkit-calendar-picker-indicator {
		color: #2c3e50;
	}
	
	/* A few custom styles for date inputs */
	input[type="date"] {
		appearance: none;
		-webkit-appearance: none;
		color: #95a5a6;
		font-family: "Helvetica", arial, sans-serif;
		font-size: 18px;
		border:1px solid #ecf0f1;
		background:#ecf0f1;
		padding:5px;
		display: inline-block !important;
		visibility: visible !important;
	}
	
	input[type="date"], focus {
		color: #95a5a6;
		box-shadow: none;
		-webkit-box-shadow: none;
		-moz-box-shadow: none;
	}
	</script>
	<script language="JavaScript">
	function setFocus(){
	document.fnim.SelectTypeRequest.focus();
	document.fnim.InputNprfCode.focus();	
	
	}
  function DisplayShowHideExport()
  {
  if (document.fnim.SelectTypeRequest.value == "Export")
  {document.getElementById("country").style.visibility = 'visible';}

  else
  {document.getElementById("country").style.visibility = 'hidden';} 
  }
</script>

<script type="text/javascript">
		function addRowCountry(tableID) {
			var table = document.getElementById(tableID);

			var rowCount = table.rows.length;
			var row = table.insertRow(rowCount);

			var cell1 = row.insertCell(0);
			var element1 = document.createElement("input");
			element1.type ="checkbox";
			element1.name="chk[]";
			element1.id="chk[]";
			cell1.appendChild(element1);
			var cell2 = row.insertCell(1);
			var array = [<?php
			$div = mysqli_query($con,"SELECT Country FROM tb_trading_partner Where Status<>0 ");
			while($b = mysqli_fetch_array($div)){
			echo  "\"$b[Country]\",";}	?>];
		
			var selectCountry = document.createElement('select');
			selectCountry.setAttribute('class',"form-control");
			selectCountry.setAttribute('title',"Select Country");
			selectCountry.setAttribute('name',"selectCountry[]");
			selectCountry.setAttribute('id',"selectCountry[]");
			cell2.appendChild(selectCountry);
			
			for (var i = 0; i < array.length; i++) {
				var option = document.createElement("option");
				option.value = array[i];
				option.text = array[i];
				selectCountry.appendChild(option);
			}
			
		}

		function deleteRowCountry(tableID) {
			try {
			var table = document.getElementById(tableID);
			var rowCount = table.rows.length;

			for(var i=0; i<rowCount; i++) {
				var row = table.rows[i];
				var chk = row.cells[0].childNodes[0];
				if(null != chk && true == chk.checked) {
					table.deleteRow(i);
					rowCount--;
					i--;
				}
			}
			}catch(e) {
				alert(e);
			}
		}


</script>

<script type="text/javascript">
function hanyaAngka(evt){
	var charCode = (evt.which) ? evt.which : event.keyCode
	if ((charCode < 48 || charCode > 57)&&charCode>32){
		return false;
	}
	return true;
	}
function angka(e) {
  if (!/^[0-9-,-.]+$/.test(e.value)) {
    e.value = e.value.substring(0,e.value.length-100);
  }
}


</script>
<script type="text/javascript">
		function addRow(tableID) {
			var table = document.getElementById(tableID);

			var rowCount = table.rows.length;
			var row = table.insertRow(rowCount);

			var cell1 = row.insertCell(0);
			var element1 = document.createElement("input");
			element1.type ="checkbox";
			element1.name="chkdetail[]";
			element1.id="chkdetail[]";
			cell1.appendChild(element1);
			var cell2 = row.insertCell(1);
			var finalproductname = document.createElement('input');
			finalproductname.setAttribute('class',"form-control");
			finalproductname.setAttribute('style',"padding:2px 2px 2px 2px");
			finalproductname.setAttribute('title',"Input Final Product Name");
			finalproductname.setAttribute('name',"finalproductname[]");
			finalproductname.setAttribute('id',"finalproductname[]");
			finalproductname.setAttribute('onkeyup',"this.value = this.value.toUpperCase()");
			finalproductname.setAttribute('required',"required[]");
			cell2.appendChild(finalproductname);
			
			var cell3 = row.insertCell(2);
			var netto = document.createElement('input');
			netto.setAttribute('class',"form-control");
			netto.setAttribute('style',"padding:2px 2px 2px 2px");
			netto.setAttribute('title',"Input Netto");
			netto.setAttribute('name',"InputNet[]");
			netto.setAttribute('id',"InputNet[]");
			netto.setAttribute('required',"required[]");
			cell3.appendChild(netto);
			
			var cell4 = row.insertCell(3);
			var price = document.createElement('input');
			price.setAttribute('class',"form-control");
			price.setAttribute('style',"padding:2px 2px 2px 2px;text-align: right;");
			price.setAttribute('title',"Assumed Consumer Price");
			price.setAttribute('name',"InputPrice[]");
			price.setAttribute('id',"InputPrice[]");
			price.setAttribute('onkeypress',"return Angkasaja(event)");
			cell4.appendChild(price);

			var cell5 = row.insertCell(4);
			var formula = document.createElement('input');
			formula.setAttribute('class',"form-control");
			formula.setAttribute('style',"padding:2px 2px 2px 2px");
			formula.setAttribute('title',"Formula");
			formula.setAttribute('name',"InputFormula[]");
			formula.setAttribute('id',"InputFormula[]");
			formula.setAttribute('required',"required[]");
			cell5.appendChild(formula);	
			
			var cell6 = row.insertCell(5);
			var formulasamplecode = document.createElement('input');
			formulasamplecode.setAttribute('class',"form-control");
			formulasamplecode.setAttribute('style',"padding:2px 2px 2px 2px");
			formulasamplecode.setAttribute('title',"Formula Sample Code");
			formulasamplecode.setAttribute('name',"InputFormulaSampleCode[]");
			formulasamplecode.setAttribute('id',"InputFormulaSampleCode[]");
			formulasamplecode.setAttribute('required',"required[]");
			cell6.appendChild(formulasamplecode);	
			
			var cell7 = row.insertCell(6);
			var fragrancecode = document.createElement('input');
			fragrancecode.setAttribute('class',"form-control");
			fragrancecode.setAttribute('style',"padding:2px 2px 2px 2px");
			fragrancecode.setAttribute('title',"Fragrance Code");
			fragrancecode.setAttribute('name',"InputFragranceCode[]");
			fragrancecode.setAttribute('id',"InputFragranceCode[]");
			fragrancecode.setAttribute('required',"required[]");
			cell7.appendChild(fragrancecode);
			
			var cell8 = row.insertCell(7);
			var PackageOnStone = document.createElement('input');
			PackageOnStone.setAttribute('class',"form-control");
			PackageOnStone.setAttribute('style',"padding:2px 2px 2px 2px");
			PackageOnStone.setAttribute('title',"Package On Stone");
			PackageOnStone.setAttribute('name',"InputPackageOnStone[]");
			PackageOnStone.setAttribute('id',"InputPackageOnStone[]");
			PackageOnStone.setAttribute('required',"required[]");
			cell8.appendChild(PackageOnStone);
			
			var cell9 = row.insertCell(8);
			var MCJItemNo = document.createElement('input');
			MCJItemNo.setAttribute('class',"form-control");
			MCJItemNo.setAttribute('style',"padding:2px 2px 2px 2px");
			MCJItemNo.setAttribute('title',"MCJ Item No");
			MCJItemNo.setAttribute('name',"InputMCJItemNo[]");
			MCJItemNo.setAttribute('id',"InputMCJItemNo[]");
			cell9.appendChild(MCJItemNo);		
			
			var cell10 = row.insertCell(9);
			var Note = document.createElement('input');
			Note.setAttribute('class',"form-control");
			Note.setAttribute('style',"padding:2px 2px 2px 2px");
			Note.setAttribute('title',"Note");
			Note.setAttribute('name',"InputNote[]");
			Note.setAttribute('id',"InputNote[]");
			cell10.appendChild(Note);		

		}

		function deleteRow(tableID) {
			try {
			var table = document.getElementById(tableID);
			var rowCount = table.rows.length;

			for(var i=0; i<rowCount; i++) {
				var row = table.rows[i];
				var chk = row.cells[0].childNodes[0];
				if(null != chk && true == chk.checked) {
					table.deleteRow(i);
					rowCount--;
					i--;
				}
			}
			}catch(e) {
				alert(e);
			}
		}
</script>


<script type="text/javascript">
		function addRowfile(tableID) {
			var table = document.getElementById(tableID);

			var rowCount = table.rows.length;
			var row = table.insertRow(rowCount);

			var cell1 = row.insertCell(0);
			var element1 = document.createElement("input");
			element1.type ="checkbox";
			element1.name="chk[]";
			element1.id="chk[]";
			cell1.appendChild(element1);
			
			var cell2 = row.insertCell(1);
			var filepdf = document.createElement('input');
			filepdf.setAttribute('class',"form-control");
			filepdf.setAttribute('style',"padding:2px 2px 2px 2px");
			filepdf.setAttribute('title',"Input Attachment");
			filepdf.setAttribute('type',"file");
			filepdf.setAttribute('accept',"application/pdf"); 
			filepdf.setAttribute('name',"InputFile[]");
			filepdf.setAttribute('id',"InputFile[]");
			cell2.appendChild(filepdf);
			
			var cell3 = row.insertCell(2);
		
			var InputName = document.createElement('input');
			InputName.setAttribute('class',"form-control");
			InputName.setAttribute('style',"padding:2px 2px 2px 2px");
			InputName.setAttribute('type',"text");
			InputName.setAttribute('title',"Note");
			InputName.setAttribute('name',"InputNameFile[]");
			InputName.setAttribute('id',"InputNameFile[]");
			cell3.appendChild(InputName);	
		}

		function deleteRowfile(tableID) {
			try {
			var table = document.getElementById(tableID);
			var rowCount = table.rows.length;

			for(var i=0; i<rowCount; i++) {
				var row = table.rows[i];
				var chk = row.cells[0].childNodes[0];
				if(null != chk && true == chk.checked) {
					table.deleteRow(i);
					rowCount--;
					i--;
				}
			}
			}catch(e) {
				alert(e);
			}
		}
	function changeparent(){
	window.opener.location.reload();
    window.close();
	}

	function popupwindow(url, title, h, w) {
	var left = (screen.width/2)-(w/2);
	var top = (screen.height/2)-(h/2);
	return window.open(url, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
		  return false;
		} 
</script>

<?php include "fnim-javascrift.php"; ?>

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
	
		<!-- Custom Fonts -->
		<link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    </head>
	<body onload='setFocus();' > 
	<main> 
    <div class="container-fluid"> 
      <h3 class="mt-4"><?php if ($button=="add-fnim") {echo "New Request FNIM";} else  {echo "Revise Request FNIM";} ?> </h3>
	    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="../dist/index.php?button=dashboard">Dashboard</a></li>
		<li class="breadcrumb-item"><a href="../dist/index.php?button=fnim">Final Name Internal Memo (FNIM)</a></li>
        <li class="breadcrumb-item active"><?php if ($button=="add-fnim") {echo "New Request FNIM";} else  {echo "Revise Request FNIM";} ?> </li>
      </ol>
 	<div class="card mb-4">
	    <div class="card-header"> </div>

        <div class="card-body"> 
			
        <?php
		include "fnim-autonumber.php";
      	$exe =mysqli_query($con,"SELECT ID_No,Request_No,MCJ_Proudct,Project_Name,NPRF_Code,Type_Request,Type_Request_Detail, 
		DATE_FORMAT(Launching_Date, '%m') Bulan,DATE_FORMAT(Launching_Date, '%Y') Tahun,
		For_Notif,Note,Status_FNIM,Thema_Number,Remark,Mcj,RemarkafterComplete,CreatedBy FROM tb_fnim where Request_No = '".@$_GET['id']."'
		And Status_FNIM='Revise' ");
        $tampildata=mysqli_fetch_array($exe);
		mysqli_query($con,"UPDATE tb_inbox SET ReadInbox='1' Where (NameApproval= '$username' Or OnBehalf='$username') 
		And Request_No='".@$_GET['id']."' And ReadInbox='0'");
		//________________________________________________________________________________StatusFNIM disabled
		if ($tampildata['Status_FNIM']<>"Draft" && $tampildata['Status_FNIM']<>"" && $tampildata['Status_FNIM']<>"Revise") {$disabled="disabled";} else{$disabled="";}

		//________________________________________________________________________________FNIM
      	$exeMS = mysqli_query($con,"SELECT ID_No,MarketSituation FROM tb_marketsituation WHERE Status='1' ");
        $tampildataMS=mysqli_fetch_array($exeMS);
		//________________________________________________________________________________
		//________________________________________________________________________________WORKFLOWNPRF
		$exeRevise = mysqli_query($con,"SELECT Step_Revise,Index_No,Revise FROM tb_workflownprf  WHERE Request_No = '".@$_GET['id']."'
		and Revise = '$username' and StatusWorkFlow IS NOT null GROUP BY Step_Revise,Revise LIMIT 1");
		$tampildataRevise=mysqli_fetch_array($exeRevise);
		$NextRevise=$tampildataRevise['Index_No']+1;
		//________________________________________________________________________________
        
	  	?>
	<form name="fnim" action="" method="post"  enctype="multipart/form-data"  >
    <?php 
	//Begin CRUD----------------------------------------------------------------------
	$file	 						= "../file/";
	$uploadDirFileMcj	 			= "../img/Mcj/";
	if($_POST){
		$ip=$_SERVER['REMOTE_ADDR'];
		$hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);
		date_default_timezone_set("Asia/Jakarta");
		$createddate=date("Y-m-d H:i:s");
    	$tempFormatNoRequest  	= $_POST['tempFormatNoRequest'];
		$inputAutoRequestNo		= $_POST['inputAutoRequestNo'];
		$MCJProd				= @$_POST['MCJProd'];
		$inputProjectName 	 	= @$_POST['inputProjectName']; 
		$SelectTypeRequest	 	= @$_POST['SelectTypeRequest'];
		$InputNprfCode			= @$_POST['InputNprfCode']; 
		$txtExport			 	= @$_POST['txtExport'];
		$inputNotification		= @$_POST['inputNotification'];
		$inputNote				= @$_POST['inputNote'];
		$Selectbulan			= @$_POST['Selectbulan'];
		$SelectTahun			= @$_POST['SelectTahun'];
		$inputRemark			= @$_POST['inputRemark'];
		$inputWorkflowRemark	= @$_POST['inputWorkflowRemark'];
		$inputThemaNumber		= @$_POST['inputThemaNumber'];

		$inputRemarkafterComplete= @$_POST['inputRemarkafterComplete'];
		
		$namaFileMcj  					= @$_FILES['FileMcj']['name'];
		$xFileMcj						= explode('.', $namaFileMcj);
		$ekstensiFileMcj    			= strtolower(end($xFileMcj));
		$ukuranFileMcj					= @$_FILES['FileMcj']['size'];
		$file_tmpFileMcj	 			= @$_FILES['FileMcj']['tmp_name'];			
		$ImagelamaFileMcj				= @$tampildata['Mcj'];
					
		if($Save=="Update"){ 
			//membuat Query untuk update data
			include "fnim-save-edit.php";
			include "FNIM-save-detail-new.php";
			
			$message = "Data successfully Update to database";
			echo "<script type='text/javascript'>alert('$message');</script>";
			echo"<script>  window.location='../dist/index.php?button=fnim'; </script>";
		}
		elseif($Send=="Send"){ 
			include "FNIM-autonumber.php";
			$Tanya = mysqli_query($con,"SELECT Request_No FROM tb_fnim WHERE Request_No = '$inputAutoRequestNo' ");
			if (mysqli_num_rows($Tanya) !=0 ) {
				//Update Sent FNIM
				include "FNIM-save-edit.php";
				include "FNIM-save-detail-new.php";
				mysqli_query($con,"UPDATE tb_fnim SET Status_FNIM='Sent',
				UpdatedBy='$username',UpdatedDate='$createddate',UpdatedHostName='$ip : $hostname' 
				WHERE Request_No='$inputAutoRequestNo'");
			}
			//DeleteWorkFlow FNIM
			mysqli_query($con,"DELETE From tb_workflownprf WHERE Request_No='$inputAutoRequestNo' And StatusWorkFlow Is Null");
			//Simpan WorkFlow FNIM
			$cari =mysqli_query($con,"SELECT a.WorkFlowProcess,a.WorkFlowMenu,a.LevelProcess,b.NameApproval,b.OnBehalf, 
			a.Revise, b.Index_No,a.Index_No AS Index_Process FROM tb_workflowprocess a  INNER JOIN tb_workflowapproval b 
			ON  a.WorkFlowProcess =b.UserDomain AND a.WorkFlowMenu=b.WorkFlowMenu AND a.WorkFlowMenu='FNIM' 
			AND a.UserDomain='$tampildata[CreatedBy]' AND a.Index_No >='$tampildataRevise[Step_Revise]' ORDER BY a.ID_No ,b.Index_No");
			$indexno=1;
			while($caridata =mysqli_fetch_array(@$cari)){
				mysqli_query($con,"Insert INTO tb_workflownprf (Request_No,WorkFlowMenu,LevelProcess,NameApproval,OnBehalf,Revise,Step_Revise,Index_No,CreatedBy,CreatedDate,CreatedHostName) 
				values ('$inputAutoRequestNo','$caridata[WorkFlowMenu]','$caridata[LevelProcess]','$caridata[NameApproval]',
				'$caridata[OnBehalf]','$caridata[Revise]','$caridata[Index_Process]','$indexno','$username','$createddate','$ip : $hostname')");
				$indexno++;	
			}
			
			
			//Update WorkFlow NPRF
			mysqli_query($con,"UPDATE tb_workflownprf SET StatusWorkFlow='S',ReadWorkFlow='1',Remark_WorkFlow='$inputWorkflowRemark',
			Approve='$username',ApproveDate='$createddate',Status_Approval='1' WHERE Request_No='$inputAutoRequestNo' And Index_No='$tampildataRevise[Index_No]'");
			
			//Send Email Notification for Approval 2-------------------------------------------------
			$exeNext = mysqli_query($con,"Select NameApproval,OnBehalf FROM tb_workflownprf 
			WHERE Request_No='$inputAutoRequestNo' And Index_No='$NextRevise' ");
        	$tampildataNext=mysqli_fetch_array($exeNext);
			$app1=$tampildataNext['NameApproval'];
			$app2=$tampildataNext['OnBehalf'];
			$remark=$inputWorkflowRemark;
			$id=$inputAutoRequestNo;
			$page="fnim-app";
			$WorkFlowMenu="FNIM";
			$Confirm=="Approve";
			require ("../config/emailapp.php");
			if (mysqli_num_rows($exeNext) !=0 ) { 
					if ($tampildataNext['OnBehalf']<>"-" || $tampildataNext['OnBehalf']==""){
						$StatusFNIM= "Waitting Approval By " .$tampildataNext['NameApproval']." Or ".$tampildataNext['OnBehalf'];}
					else {
						$StatusFNIM= "Waitting Approval By " .$tampildataNext['NameApproval'];}
						$StatusInbox="W";
				}
				else {
					$StatusFNIM="Complete";
					$StatusInbox="C";
				}
			//Simpan Inbox
			mysqli_query($con,"UPDATE tb_inbox Set Thema_Name='$inputProjectName',Request_Type='$SelectTypeRequest',
			Request_Status='$StatusInbox',ReadInbox='0',UpdatedBy='$username',
			NameApproval='".$tampildataNext['NameApproval']."',OnBehalf='".$tampildataNext['OnBehalf']."',
			Remark='$inputRemark',UpdatedDate='$createddate',UpdatedHostName='$ip : $hostname'  
			WHERE Request_No='$tempFormatNoRequest'");
			//---------------------------------------------------------------------------------------
			
			//UPDATE STATUS NPRF
			mysqli_query($con,"UPDATE tb_fnim Set Status_NPRF='$StatusFNIM' WHERE Request_No='$tempFormatNoRequest'");
			
			$message = "Data successfully Sent  to Approval";
			echo "<script type='text/javascript'>alert('$message');</script>";
			echo"<script>  window.location='../dist/index.php?button=fnim'; </script>";
		}
	}
		//End CRUD----------------------------------------------------------------------
		
		$exe =mysqli_query($con,"SELECT * FROM tb_fnim where Request_No = '".@$_GET['id']."'
		And Status_FNIM='Revise'");
		if (mysqli_num_rows($exe) ==0 ) { 
		echo"<h3>Tidak ada request yang harus di Revise</h3><br><br>";
		echo'<a class="btn btn-primary" href="../dist/index.php?button=fnim" title="Back FNIM">Back</a>';}
	
		else {
		
		?>
		
          <table width="100%" border="0" class="table table-striped" id="dataTables-example" >
            <tr>
              <td width="20%"><span class="form-group">Request No</span></td>
              <td colspan="2"><span class="form-group">
				<input name="tempFormatNoRequest" type="hidden" value="<?php echo $tampildata['Request_No']; ?>">
                <input class="form-control py-4"  name="inputAutoRequestNo" id="inputAutoRequestNo"  maxlength="50" type="text"  
			  placeholder="Auto Request No" readonly="readonly" value="<?php if ($button=="add-fnim") {echo $NomorReq;} else {echo $tampildata['Request_No'];} ?>" />
              </span> </td>
            </tr>
            <tr>
              <td>MCJ Product Development *</td>
              <td colspan="2"><span class="form-group">
                <div class="form-group"> <input type="radio" id="MCJProd" name="MCJProd" 
				value="0"  <?php if (@$tampildata['MCJ_Proudct']=='0') {echo 'checked="checked"';} ?>> Prodev 1  
			  	<input type="radio" id="MCJProd" name="MCJProd" 
				value="1" <?php if (@$tampildata['MCJ_Proudct']=='1') {echo 'checked="checked"';}?> > Prodev 2</div>
              </span></td>
            </tr>
            <tr>
              <td><span class="form-group">Project Name *</span></td>
              <td width="50%"><div class="form-group d-flex align-items-center justify-content-between mt-0 mb-1">
			  <input class="form-control"  id="inputProjectName" name="inputProjectName" 
			  maxlength="50" type="text" placeholder="Enter Project Name"
			  value="<?php if ($_POST) { echo $inputProjectName; } else {echo $tampildata['Project_Name'];} ?>" 
			   <?php echo $disabled; ?>/> &nbsp;<button type="button" style="padding:2px 4px 4px 4px" 
			   class="btn btn-primary" title="Search Project Name"  
					name="btnsearch" 
					onClick="popupwindow('fnim/project-name-popup.php?id=fnim','Search Project Name','600','700');" <?php echo $disabled; ?>>
					<span class="glyphicon glyphicon-search" ></span> </button>
				</div>
			  </td>
			  <td>
            	<input type="text" class="form-control" name="InputNprfCode" id="InputNprfCode" placeholder="NPRF Code" 
				value="<?php if ($_POST) { echo $InputNprfCode; } else {echo $tampildata['NPRF_Code'];} ?>" 
				onChange="setFocus(),get_detaildata(),DisplayShowHideExport()" 
				onFocus="setFocus(),get_detaildata(),DisplayShowHideExport()" readonly="readonly">
			  </td>
            </tr>
			<tr>
              <td>Request Type *</td>
              <td width="20%"><select class="form-control" id="SelectTypeRequest" name="SelectTypeRequest" 
			  onfocus="DisplayShowHideExport()" onChange="DisplayShowHideExport()"  <?php echo $disabled; ?>>
			  <option value="-">Select Request Type </option>
				<option value="Domestic" <?php if ($_POST) {echo $SelectTypeRequest;} elseif (@$tampildata['Type_Request']=='Domestic') 
				{echo "Selected"; }?>>Domestic</option>
				<option value="Export" <?php if (@$tampildata['Type_Request']=='Export') {echo "Selected";} ?>>Export</option>
				</select> 
				<table name="country" id="country" style="visibility: hidden;" width="100%" border="0">
				  <tr>
					<td colspan="2">					
					<button type="button" style="padding:0px 0px 0px 0px" class="btn btn-primary" title="Add Country"  
					name="btnCreate" onClick="addRowCountry('country')"><span class="fa fa-plus" title="Preview Work Flow" ></span> </button>
					<button type="button" style="padding:0px 0px 0px 0px" class="btn btn-primary" title="Delete Country "  
					id="btnDelete" name="btnDelete" onClick="deleteRowCountry('country')"><span class="glyphicon glyphicon-trash" title="Preview Work Flow" ></span></button></td>
				  </tr>
				  <?php
					$exe = mysqli_query($con,"SELECT ID_No,Country,Index_No 
					FROM tb_fnim_country Where Request_No = '".$tampildata['Request_No']."'   ");
					$no = 1;
					while(@$rowFNIMCountry =mysqli_fetch_array($exe)){
					?>
					<tr>
					<td><input type="checkbox" name="chkdetail[]" id="chkdetail[]"></td>
					<td><select class="form-control" id="selectCountry[]" name="selectCountry[]" >
						<option value="-" >Select Country</option>
						<?php
								$div = mysqli_query($con,"SELECT Country FROM tb_trading_partner Where Status<>0 ");
								while($b = mysqli_fetch_array($div)){
									if($rowFNIMCountry['Country'] == $b['Country']){
										$cek = 'Selected';
									}elseif($selectCountry == $b['Country']){
										$cek = 'Selected';
									}else{
										$cek = '';
									}
									echo"<option value='".$b['Country']."' $cek>".$b['Country']."</option>";
								}
							?>
					  </select>
					</td>
					</tr>
					<?php $no++;} ?>
				  </table>
              </td>
			  <td width="20%">
			  </td>
            </tr>
            <tr>
              <td colspan="3">
			 	<table name="fnimdetail" id="fnimdetail"  width="100%" border="1" 
			  	class="table table-striped table-bordered table-hover" >
			    </table>
			  </td>
            </tr>
			<tr>
              <td>Thema Number</td>
              <td colspan="3"><span class="form-group">
                <input class="form-control py-4" name="inputThemaNumber" id="inputThemaNumber"
				maxlength="50" type="text" placeholder="Enter Thema Number"  
				value="<?php if ($_POST) { echo $inputThemaNumber; } else {echo $tampildata['Thema_Number'];} ?>"
				<?php echo $disabled; ?>	 />
              </span>
			  </td>
            </tr>
            <tr>
              <td>Launching Date *</td>
              <td>
				<div class="form-group d-flex align-items-center justify-content-between mt-0 mb-2">
				<select name="Selectbulan" id="Selectbulan" class="form-control" <?php echo $disabled; ?>>
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
				<select name="SelectTahun" id="SelectTahun" title="Tahun" class="form-control"   <?php echo $disabled; ?>>
					<option value="">Tahun</option>
					<?php 
					$mulai= date('Y');
					for($i = $mulai;$i<$mulai + 5;$i++){?>
					<option value="<?php echo $i; ?>" <?php if (@$tampildata['Tahun']==$i) 
					{echo "Selected";} ?>><?php echo $i; ?></option><?php }	?>
				</select></div> </td>
				<td>Example : Januari 2020</td>
            </tr>
            <!--tr>
              <td height="84">For Notification</td>
              <td colspan="2"><span class="form-group"> 
				<textarea rows="3" class="form-control py-4" name="inputNotification" maxlength="500"
				placeholder="Enter For Notification" <?php echo $disabled; ?>><?php if ($_POST) { echo $inputNotification; } 
				else{echo $tampildata['For_Notif'];} ?></textarea>
        		</span>
			   </td>
            </tr-->
            <tr>
              <td height="84">Note</td>
              <td colspan="2"><span class="form-group"> 
				<textarea rows="3" class="form-control py-4"  name="inputNote" maxlength="500"
				placeholder="Enter Note" <?php echo $disabled; ?>><?php if ($_POST) { echo $inputNote; } 
				else{echo $tampildata['Note'];} ?></textarea>
        		</span>
			   </td>
            </tr>
			<tr>
              <td colspan="3">
			  <table name="Attach" id="Attach"  width="100%" border="1" class="table table-striped table-bordered table-hover" >
			   
				  <tr>
					<td colspan="10" align="left"><strong>Attachment File (.pdf)</strong>					
					<button type="button" style="padding:0px 0px 0px 0px" class="btn btn-primary" title="Add Attachment File"  
					name="btnCreateFNIM" onClick="addRowfile('Attach')"><span class="fa fa-plus" title="Preview Work Flow" ></span> </button>
					<button type="button" style="padding:0px 0px 0px 0px" class="btn btn-primary" title="Delete Attachment File"  
					id="btnDeleteFNIM" name="btnDeleteFNIM" >
					<span class="glyphicon glyphicon-trash" title="Preview Work Flow" ></span></button>
					
					</td>
				  </tr>
				  <tr valign="bottom" align="center" bgcolor="#999999" >
					<th width="1%"></th>
					<th width="10%">File</th>
					<th width="20%">Name</th>
				  </tr>
			 
			 	  <?php if ($button=="add-fnim") { ?> 
				  <tr>
					<td><input type="checkbox" name="chkdetail[]" id="chkdetail[]"></td>
					<td><input type="file" name="InputFile[]" id="InputFile[]" class="form-control"
						style="padding:2px 2px 2px 2px" OnChange="return validasiFile()" accept="application/pdf"></td>
					<td><input type="text" name="InputNameFile[]" id="InputNameFile[]" class="form-control"
						style="padding:2px 2px 2px 2px" ></td>
				  </tr>
					 <?php
					 } else {
					$exe = mysqli_query($con,"SELECT ID_No,File,Name,Index_No 
					FROM tb_fnim_file Where Request_No = '".$tampildata['Request_No']."'   ");
					$no = 1;
					while(@$rowFNIMFile =mysqli_fetch_array($exe)){
					?>
				  <tr id="<?php echo $rowFNIMFile['ID_No'];?>">
					<td><input type="checkbox" name="chkdetail[]" id="chkdetail[]" value="<?php echo $rowFNIMFile['ID_No'];?>">
					<input type="hidden" name="tempfileid[]" id="tempfileid[]" value="<?php echo $rowFNIMFile['ID_No'];?>">
					<input type="hidden" name="tempfilelama[]" id="tempfilelama[]" value="<?php echo $rowFNIMFile['File'];?>"></td>
					<td>
					<?php if (!empty($rowFNIMFile['File'])){?>
			  		<img height="20" width="20" src=../img/pdf.png  title="Open File <?php echo $rowFNIMFile['File'];?>"
					onClick="popupwindow('../config/open-pdf.php?kd=<?php echo $rowFNIMFile['ID_No'];?>&page=filefnim','Preview Pdf','700','1000');">
			  	<?php echo $rowFNIMFile['File']; }  ?>
				</td>
				<td>
					<input type="hidden" name="tempfilename[]" id="tempfilename[]" value="<?php echo $rowFNIMFile['Name'];?>">
					<input type="text" name="InputNameFile1[]" id="InputNameFile1[]" class="form-control"
						style="padding:2px 2px 2px 2px" value="<?php echo $rowFNIMFile['Name'];?>" <?php echo $disabled; ?> ></td>
				  </tr>
				  <?php $no++;}} ?>
				  </table>
			  </td>
			</tr>
            <tr>
              <td>Remark *</td>
              <td colspan="2"><div class="form-group"> <textarea cols="4" id="inputRemark" name="inputRemark"  
			  class="form-control py-4" placeholder="Enter Remark" <?php echo $disabled; ?> 
			  maxlength="100"><?php if ($_POST) { echo $inputRemark; } else {echo $tampildata['Remark'];} ?></textarea></div>
			  </td>
            </tr>
			<tr>
              <td>Workflow Remark *</td>
              <td colspan="2"><div class="form-group"> <textarea cols="4" id="inputWorkflowRemark"  name="inputWorkflowRemark"  
			  class="form-control py-4" placeholder="Enter Workflow Remark" 
			  maxlength="100"><?php if ($_POST) { echo $inputWorkflowRemark; }  ?></textarea></div>
			  </td>
            </tr>
			</fieldset>
          </table> 
		   <button type="submit" name="Send" value="Send" onClick="return checkSendApproval(fnim)" 
		  	class="btn btn-primary" <?php echo $disabled; ?>>Send Approval </button>
		<button type="submit" name="Save" value="Update" onClick="return checkEdit(fnim)"  
		class="btn btn-primary">Save</button>
		
		  <a class="btn btn-primary" href="../dist/index.php?button=fnim" title="Back Format No Request">Back</a> 
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
        $('#fnimdetail').DataTable({
            responsive: true
        });
    });
    </script>

	<script language="JavaScript" type="text/javascript">
	function checkSendApproval(form){
	
	if (form.inputAutoRequestNo.value == ""){
    	alert("Request No Can not be empty *");
    	form.inputAutoRequestNo.focus();
    	return (false);  		}
	else if (form.MCJProd.value == ""){
    	alert("MCJ Product Development Can not be empty *");
    	form.MCJProd.focus();
    	return (false);  		}
	else if (form.SelectTypeRequest.value == "-"){
    	alert("please choose Request Type!");
    	form.SelectTypeRequest.focus();
    	return (false);  		}
	else if(form.Selectbulan.value==""){
		alert("Launching Date Bulan Can not be empty!");
		form.Selectbulan.focus();
    	return (false);  		}
	else if(form.inputThemaNumber.value==""){
		alert("Thema Number Can not be empty!");
		form.inputThemaNumber.focus();
    	return (false);  		}
	else if(form.SelectTahun.value==""){
		alert("Launching Date Tahun Can not be empty!");
		form.SelectTahun.focus();
    	return (false);  		}
	else if (form.inputRemark.value == ""){
    	alert("Remark Can not be empty *");
    	form.inputRemark.focus();
    	return (false);  		}
	else if (form.inputWorkflowRemark.value == ""){
    	alert("Work flow Remark Can not be empty *");
    	form.inputWorkflowRemark.focus();
    	return (false);  		}
		return confirm('Are you sure you want to Send Approval?');
	}
		 
	function checkEdit(form){
		return confirm('Are you sure you want to Update this data?');
	}
	</script>
 
	</body>
</html>
<script>
function deleteRowFile() {
			try {
			var table = document.getElementById('Attach');
			var rowCount = table.rows.length;

			for(var i=0; i<rowCount; i++) {
				var row = table.rows[i];
				var chk = row.cells[0].childNodes[0];
				if(null != chk && true == chk.checked) {
					table.deleteRow(i);
					rowCount--;
					i--;
				}
			}
			}catch(e) {
				alert(e);
			}
		}
</script>

<script>
$(document).ready(function(){
 $('#InputNprfCode').change(function(){
  get_detaildata();
 });
});
 function get_detaildata(){
  var a = $('#InputNprfCode').val();
  var b = $('#inputAutoRequestNo').val();


  $.ajax({
   type: 'POST',
   url: "fnim/fnim-load-item-detail.php",
   
   data: { data1: a, data2: b},
   success: function(info) {
	$("#fnimdetail").html(info);  }
  });
  return false;
 }
</script>

 
<script>
$(document).ready(function(){
 //Delete Technical Document_______________________________________________________
 $('#btnDeleteFNIM').click(function(){
  
  if(confirm("Are you sure you want to delete this?"))
  {
   var DelFile = [];
   
   $(':checkbox:checked').each(function(i){
    DelFile[i] = $(this).val();
   });
   if(DelFile.length === 0) //tell you if the array is empty
   {
    alert("Please Select atleast one checkbox");
   }
   else
   {
    $.ajax({
     url:'../config/delete.php',
     method:'POST',
     data:{DelFile:DelFile},
     success:function()
     {
      for(var i=0; i<DelFile.length; i++)
      {
       $('tr#'+DelFile[i]+'').css('background-color', '#ccc');
       $('tr#'+DelFile[i]+'').fadeOut('slow');
	   deleteRowFile();
      }
     }
    });
   }
  }
  else
  {
   return false;
  }
 });
 //___________________________________________________________

});
</script>


<?php ;}?>