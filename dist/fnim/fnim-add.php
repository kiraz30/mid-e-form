	<?php $Send		= @$_POST['Send']; ?>
	<?php $Save		= @$_POST['Save']; ?>
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
			price.setAttribute('onkeypress',"return hanyaAngka(event)");
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


</script>

<script type="text/javascript">
	function popupwindow(url, title, h, w) {
	var left = (screen.width/2)-(w/2);
	var top = (screen.height/2)-(h/2);
	return window.open(url, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
		  return false;
		} 
		
	function changeparent(){
	window.opener.location.reload();
    window.close();
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

	<!-- CSS untuk bootstrap -->
	<link rel="stylesheet" href="../../vendor/bootstrap/css/bootstrap.css" type="text/css">
	<!-- CSS untuk bootstrap datetimepicker -->
	<link rel="stylesheet" href="../../vendor/bootstrap/css/bootstrap-select.min.css" type="text/css">  
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	</head>
	<body onload='setFocus();' > 
	<main> 
    <div class="container-fluid"> 
      <h3 class="mt-4"><?php if ($button=="add-fnim" || $button=="add-revise-fnim")
	  {echo "New Request FNIM";} else  {echo "Edit Request FNIM";} ?> </h3>
	    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="../dist/index.php?button=dashboard">Dashboard</a></li>
		<li class="breadcrumb-item"><a href="../dist/index.php?button=fnim">Final Name Internal Memo (FNIM)</a></li>
        <li class="breadcrumb-item active"><?php if ($button=="add-fnim" || $button=="add-revise-fnim") 
		{echo "New Request FNIM";} else  {echo "Edit Request FNIM";} ?> </li>
      </ol>
 	<div class="card mb-4">
	    <div class="card-header"> </div>

        <div class="card-body"> 
			
        <?php
		include "fnim-autonumber.php";
      	$query ="SELECT ID_No,Index_Document,Request_No,Last_Request_No,Status_Last_Document,MCJ_Proudct,Project_Name,NPRF_Code,Type_Request,
		Type_Request_Detail,Launching_Date,DATE_FORMAT(Launching_Date, '%m') Bulan,DATE_FORMAT(Launching_Date, '%Y') Tahun,
		For_Notif,Note,Status_FNIM,Remark,Mcj,Thema_Number,RemarkafterComplete FROM tb_fnim 
		WHERE Request_No = '".@$_GET['id']."' ";
		if ($button=="add-revise-fnim") {$query.=" And Status_Last_Document='1'";}
		else {$query =$query; }
      	$exe =mysqli_query($con,$query);
        $tampildata=mysqli_fetch_array($exe);
		$rev=@$tampildata['Index_Document']+1;
		//________________________________________________________________________________StatusFNIM disabled

		if (@$tampildata['Status_FNIM']<>"Draft" & @$tampildata['Status_FNIM']<>"" & $button<>"add-revise-fnim")
		  {$disabled="disabled";} else{$disabled="";}
		if (@$tampildata['Status_FNIM'] <> "Complete By MID" & $button=="add-revise-fnim")
		  {$disabledmid="disabled";} else{$disabledmid="";}

		//________________________________________________________________________________WORKFLOWFNIM
		$exeReq = mysqli_query($con,"Select NameApproval,OnBehalf,Remark_WorkFlow FROM tb_workflowNPRF 
		WHERE Request_No = '".@$_GET['id']."' And Index_No='1' limit 1");
		$tampildataReq=mysqli_fetch_array($exeReq);
		//________________________________________________________________________________
        
	  	?>
	<form name="fnim" id="fnim" action="" method="post"  enctype="multipart/form-data"  >
    <?php 
	//Begin CRUD----------------------------------------------------------------------
	$datenow						= date("Y-m-d");
	$file	 						= "../file/";
	$uploadDirFileMcj	 			= "../img/Mcj/";
	if($_POST){
		$ip=$_SERVER['REMOTE_ADDR'];
		$hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);
		date_default_timezone_set("Asia/Jakarta");
		$createddate=date("Y-m-d H:i:s");
		$yymmddhMs=date("YmdHis");

    	$tempFormatNoRequest  	= $_POST['tempFormatNoRequest'];
		$inputAutoRequestNo		= $_POST['inputAutoRequestNo'];
		$inputLastRequestNo		= @$_POST['inputLastRequestNo'];
		$MCJProd				= @$_POST['MCJProd'];
		$inputProjectName 	 	= @$_POST['inputProjectName']; 
		$InputNprfCode			= @$_POST['InputNprfCode']; 
		$SelectTypeRequest	 	= @$_POST['SelectTypeRequest'];
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
 
		if($Save=="Save"){
			include "FNIM-autonumber.php";
			$Tanya = mysqli_query($con,"SELECT Request_No FROM tb_fnim WHERE Request_No = '$inputAutoRequestNo' ");
			if (mysqli_num_rows($Tanya) !=0 ) {  
				echo "<div class='form-group has-error'>
				<label class='control-label' for='inputError'>Error Save : Request No already exists in the database *</label></div>";}
			else{
				//membuat Query untuk menyimpan data
				include "FNIM-autonumber.php";
				include "FNIM-save-new.php";
				if ($button=="add-fnim") {
					include "FNIM-save-detail-new.php"; }
				else {
					include "FNIM-save-detail-new-revisi.php"; }
				include "FNIM-save-workflow.php";

				$exeReq = mysqli_query($con,"UPDATE tb_workflowNPRF SET Remark_WorkFlow ='$inputWorkflowRemark' 
				WHERE Request_No ='$inputAutoRequestNo' And Index_No='1' limit 1");
	
				$message = "Data successfully Save to Draft";
				echo "<script type='text/javascript'>alert('$message');</script>";
				echo"<script>  window.location='../dist/index.php?button=fnim'; </script>";
				}
			}
		elseif($Save=="Update"){ 
			//membuat Query untuk update data
			//membuat Query untuk update data
			if ($tampildata['Status_FNIM']=="Complete By MID"){
				include "fnim-save-editmcj.php";	
			}
			else {
				include "fnim-save-edit.php";		
				include "FNIM-save-detail-new.php";
				$exeReq = mysqli_query($con,"UPDATE tb_workflowNPRF SET Remark_WorkFlow ='$inputWorkflowRemark' 
				WHERE Request_No = '".@$_GET['id']."' And Index_No='1' limit 1");
			}
			$message = "Data successfully Update to database";
			echo "<script type='text/javascript'>alert('$message');</script>";
			echo"<script>  window.location='../dist/index.php?button=fnim'; </script>";
		}
		elseif ($Save=="Revise"){
			//Simpan Status Revise NPRF
			mysqli_query($con,"UPDATE tb_fnim Set Status_FNIM='Revise' WHERE Request_No='$inputAutoRequestNo'");
			mysqli_query($con,"Update From tb_workflownprf Set Status_Approval ='0'
			WHERE Request_No='$inputAutoRequestNo'");
			//_________________________________________________________________________________________
			$message = "Data successfully Revise";
			echo "<script type='text/javascript'>alert('$message');</script>";
			echo"<script>  window.location='../dist/index.php?button=revise-fnim&id=$inputAutoRequestNo'; </script>";
			 
		}
		elseif($Save=="Cancel"){ 
			include "fnim-save-edit.php";
			mysqli_query($con,"UPDATE tb_fnim SET Status_FNIM='Cancel' WHERE Request_No='$inputAutoRequestNo'");
			mysqli_query($con,"UPDATE tb_inbox SET Request_Status='Cancel' WHERE Request_No='$inputAutoRequestNo'");
			
			$message = "Data successfully Cancel Request";
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
			else{
				//membuat Query untuk menyimpan data
				//membuat Query untuk menyimpan data
				if ($button=="add-revise-fnim"){
					include "fnim-save-new-revisi.php";
					include "fnim-save-detail-new-revisi.php";}
				else{
					include "FNIM-autonumber.php";
					include "FNIM-save-new.php";
					include "FNIM-save-detail-new.php";
				}
				mysqli_query($con,"UPDATE tb_fnim SET Status_FNIM='Sent' WHERE Request_No='$inputAutoRequestNo'");
				include "FNIM-save-workflow.php";
				
			}
			
			//Update WorkFlow FNIM
			mysqli_query($con,"UPDATE tb_workflowNPRF SET StatusWorkFlow='S',ReadWorkFlow='1',Remark_WorkFlow='$inputWorkflowRemark',
			Approve='$username',ApproveDate='$createddate',Status_Approval='1' WHERE Request_No='$inputAutoRequestNo' And Index_No='1'");
			
			//Send Email Notification for Approval 2-------------------------------------------------
			$exeNext = mysqli_query($con,"Select NameApproval,OnBehalf,WorkFlowMenu FROM tb_workflowNPRF 
			WHERE Request_No='$inputAutoRequestNo' And Index_No='2' ");
        	$tampildataNext=mysqli_fetch_array($exeNext);
			$app1=$tampildataNext['NameApproval'];
			$app2=$tampildataNext['OnBehalf'];
			$remark=$inputWorkflowRemark;
			$id=$inputAutoRequestNo;
			$page="fnim-app";
			$WorkFlowMenu="FNIM";
			$Confirm=="Approve";
			require ("../config/emailapp.php");
			//Simpan Inbox
			mysqli_query($con,"Insert INTO tb_inbox (Request_No,Request_Date,Thema_Name,Request_Type,Request_Status,
			NameApproval,OnBehalf,ReadInbox,Remark,WorkFlowMenu) values ('$inputAutoRequestNo','$createddate','$inputProjectName','$SelectTypeRequest',
			'W','".$tampildataNext['NameApproval']."','".$tampildataNext['OnBehalf']."','0','$inputRemark','FNIM')");
			
			//_________________________________________________________________________________________
			$message = "Data successfully Sent  to Approval";
			echo "<script type='text/javascript'>alert('$message');</script>";
			echo"<script>  window.location='../dist/index.php?button=fnim'; </script>";
		}
	}
		//End CRUD----------------------------------------------------------------------
		?>
          <table width="100%" border="0" class="table table-striped" id="dataTables-example" >
            <tr>
              <td width="20%"><span class="form-group">Request No</span></td>
              <td colspan="2"><span class="form-group">
				<input name="tempFormatNoRequest" type="hidden" value="<?php echo $tampildata['Request_No']; ?>">
                <input class="form-control py-4"  name="inputAutoRequestNo" id="inputAutoRequestNo"  maxlength="50" type="text"  
			  placeholder="Auto Request No" readonly="readonly" 
			  value="<?php if ($button=="add-fnim") {echo $NomorReq;} elseif ($button=="add-revise-fnim") 
			  {echo substr($tampildata['Request_No'],0,17)."-R".$rev;} else {echo @$tampildata['Request_No'];} ?>" />
              </span> </td>
            </tr>
            <tr>
              <td width="20%"><span class="form-group">Last Request No</span></td>
              <td colspan="2"><span class="form-group">
                <input class="form-control py-4"  name="inputLastRequestNo" id="inputLastRequestNo"  maxlength="50" type="text"  
			  placeholder="Auto Request No" readonly="readonly" 
			  value="<?php if (@$tampildata['Status_FNIM']=="Complete By MCJ" & $button=="add-revise-fnim") 
			  {echo @$tampildata['Request_No'];} else {echo @$tampildata['Last_Request_No'];}?>" />
              </span> </td>
            </tr>
            <tr>
              <td>MCJ Product Development *</td>
              <td colspan="2"><span class="form-group">
                <div class="form-group"> <input type="radio" id="MCJProd" name="MCJProd" 
				value="0" <?php echo $disabled; ?>  <?php if (@$tampildata['MCJ_Proudct']=='0') {echo 'checked="checked"';} ?>> Prodev 1  
			  	<input type="radio" id="MCJProd" name="MCJProd" 
				value="1" <?php echo $disabled; ?> <?php if (@$tampildata['MCJ_Proudct']=='1') {echo 'checked="checked"';}?> > Prodev 2</div>
              </span></td>
            </tr>
            <tr>
              <td><span class="form-group">Project Name *</span></td>
              <td width="50%"><div class="form-group d-flex align-items-center justify-content-between mt-0 mb-1">
			  <input class="form-control"  id="inputProjectName" name="inputProjectName" 
			  maxlength="50" type="text" placeholder="Enter Project Name"
			  value="<?php if ($_POST) { echo $inputProjectName; } else {echo @$tampildata['Project_Name'];} ?>" 
			   <?php echo $disabled; ?>/> &nbsp;<button type="button" style="padding:2px 4px 4px 4px" 
			   class="btn btn-primary" title="Search Project Name"  
					name="btnsearch" 
					onClick="popupwindow('fnim/project-name-popup.php?id=fnim','Search Project Name','600','700');" <?php echo $disabled; ?>>
					<span class="glyphicon glyphicon-search" ></span> </button>
				</div>
			  </td>
			  <td>
					<input type="text" class="form-control" name="InputNprfCode" id="InputNprfCode" placeholder="NPRF Code" 
				value="<?php if ($_POST) { echo $InputNprfCode; } else {echo @$tampildata['NPRF_Code'];} ?>" 
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
					name="btnCreate" onClick="addRowCountry('country')" <?php echo $disabled; ?>><span class="fa fa-plus" ></span> </button>
					<button type="button" style="padding:0px 0px 0px 0px" class="btn btn-primary" title="Delete Country "  
					id="btnDelete" name="btnDelete" onClick="deleteRowCountry('country')" <?php echo $disabled; ?>><span class="glyphicon glyphicon-trash" ></span></button></td>
				  </tr>
				  <?php
					$exe = mysqli_query($con,"SELECT ID_No,Country,Index_No 
					FROM tb_fnim_country Where Request_No = '".@$tampildata['Request_No']."'   ");
					$no = 1;
					while(@$rowFNIMCountry =mysqli_fetch_array($exe)){
					?>
					<tr>
					<td><input type="checkbox" name="chkdetail[]" id="chkdetail[]" <?php echo $disabled; ?>></td>
					<td><select class="form-control" id="selectCountry[]" name="selectCountry[]" <?php echo $disabled; ?> >
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
			  <table name="fnimdetail" id="fnimdetail" class="table table-striped table-bordered table-sm" ></table>
			  </td>
            </tr>
			<tr>
              <td>Thema Number</td>
              <td colspan="3"><span class="form-group">
                <input class="form-control py-4" name="inputThemaNumber" id="inputThemaNumber" 
				maxlength="50" type="text" placeholder="Enter Thema Number"  
				value="<?php if ($_POST) { echo $inputThemaNumber; } else {echo @$tampildata['Thema_Number'];} ?>"
				<?php echo $disabled; ?> >
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
				else{echo @$tampildata['For_Notif'];} ?></textarea>
        		</span>
			   </td>
            </tr-->
            <tr>
              <td height="84">Note</td>
              <td colspan="2"><span class="form-group"> 
				<textarea rows="3" class="form-control py-4"  name="inputNote" maxlength="500"
				placeholder="Enter Note" <?php echo $disabled; ?>><?php if ($_POST) { echo $inputNote; } 
				else{echo @$tampildata['Note'];} ?></textarea>
        		</span>
			   </td>
            </tr>
			
			<tr>
              <td colspan="3">
			  <table name="Attach" id="Attach"  width="100%" border="1" class="table table-striped table-bordered table-hover" >
			   
				  <tr>
					<td colspan="10" align="left"><strong>Attachment File (.pdf)</strong>					
					<button type="button" style="padding:0px 0px 0px 0px" class="btn btn-primary" title="Add Attachment File"  
					name="btnCreateFNIM" onClick="addRowfile('Attach')" <?php echo $disabled; ?> ><span class="fa fa-plus" title="Preview Work Flow" ></span> </button>
					<button type="button" style="padding:0px 0px 0px 0px" class="btn btn-primary" title="Delete Attachment File"  
					id="btnDeleteFNIM" name="btnDeleteFNIM"   <?php echo $disabled; ?> >
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
					<td><input type="checkbox" name="chkdetail[]" id="chkdetail[]" value="<?php echo $rowFNIMFile['ID_No'];?>" <?php echo $disabled; ?>>
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
			  maxlength="100"><?php if ($_POST) { echo $inputRemark; } else {echo @$tampildata['Remark'];} ?></textarea></div>
			  </td>
            </tr>
			<?php if (@$tampildata['Status_FNIM']<>"Complete By MID") {?>	
			<tr>
              <td>Workflow Remark *</td>
              <td colspan="2"><div class="form-group"> <textarea cols="4" id="inputWorkflowRemark"  name="inputWorkflowRemark"  
			  class="form-control py-4" placeholder="Enter Workflow Remark" maxlength="100"
				<?php echo $disabled; ?>><?php if ($_POST) { echo $inputWorkflowRemark; } 
				else {echo @$tampildataReq['Remark_WorkFlow'];} ?></textarea></div>
			  </td>
            </tr>
			<?php ;}?>
			<tr>
              <td colspan="3"></td>
            </tr>
			 <?php if (@$tampildata['Status_FNIM']=="Complete By MID" || @$tampildata['Status_FNIM']=="Complete By MCJ" &&
			 ($button=="add-fnim" || $button=="edit-fnim") ) {?>		
			<tr>
              <td>MCJ File</td>
              <td><input class="form" id="FileMcj" name="FileMcj"  type="file" accept="application/pdf" 
			  <?php if (@$tampildata['Status_FNIM']=="Complete By MCJ" || @$tampildata['Status_FNIM']<>"Complete By MID")  {echo $disabled;} ?> 
			  onChange="return validasiFileMsj()"/></td>
			  <td><div id="PdfFileMcj"></div>
			  
			  <?php if (!empty($tampildata['Mcj'])){?>
			  	<img height="20" width="20" src=../img/pdf.png  title="Preview Pdf <?php echo $tampildata['Mcj'];?>"
				onClick="popupwindow('../config/open-pdf.php?folder=<?php echo $uploadDirFileMcj; ?>&pdfname=mcj&kd=<?php echo $tampildata['Request_No']; ?>&page=fnim','Preview Pdf','700','1000');">
			  <?php }  ?>
			  </td>
            </tr>
			<tr>
              <td>Remark after Complete *</td>
              <td colspan="3"><div class="form-group"> <textarea cols="4" id="inputRemarkafterComplete"  name="inputRemarkafterComplete"  
			  class="form-control py-4" placeholder="Enter Remark after Complete" maxlength="100"
			  <?php if ($tampildata['Status_FNIM']=="Complete By MCJ" || $tampildata['Status_FNIM']<>"Complete By MID")  {echo $disabled;} ?>><?php if ($_POST) { echo $inputRemarkafterComplete; } else {echo $tampildata['RemarkafterComplete'];} ?></textarea></div>
			  </td>
            </tr>
			<?php ;}?>
			</fieldset>
          </table>
		  <button type="submit" name="Send" value="Send"  onClick="return checkSendApproval(fnim)" 
		  class="btn btn-primary" 
		  <?php if (@$tampildata['Status_FNIM']<>"Complete By MID")  
		  {echo $disabled;} else {echo "disabled='disabled'";} ?>>Send Approval</button>
		  <?php if (@$tampildata['Status_FNIM']<>"Cancel")  {?>
		  <button type="submit" name="Save" value="<?php if ($button=="add-fnim" || $button=="add-revise-fnim") 
		  {echo"Save";} else {echo"Update";}  ?>"
		  <?php if ($button=="add-fnim" || $button=="add-revise-fnim") 
		   {echo 'onclick="return checkDraft(fnim)"';} else  {echo 'onclick="return checkEdit(fnim)"';} ?>  
		  class="btn btn-primary"
		  <?php if (@$tampildata['Status_FNIM']=="Complete By MCJ" || @$tampildata['Status_FNIM']<>"Complete By MID")  {echo $disabled;} ?>>
		  <?php if (@$tampildata['Status_FNIM']<>"Complete By MID")  {echo "Draft";} else {echo "Update";} ?> </button>
		  <?php ;} ?>
		  <?php if (@$tampildata['Status_FNIM']=="Complete By MID")  {?>
		  <button type="submit" name="Save" value="Revise" onClick="return checkRevise()" 
		  class="btn btn-primary">Revise</button>
	      <?php ;} ?>
		  <?php if (@$tampildata['Status_FNIM']=="Complete By MID"|| @$tampildata['Status_FNIM']=="Revise")  {?>
		  <button type="submit" name="Save" value="Cancel" onClick="return checkCancel(fnim)" 
		  class="btn btn-primary">Cancel Request</button>
	      <?php ;} ?>

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
	
	</script>
		<!-- js untuk jquery -->
	<script src="js/jquery-1.11.2.min.js"></script>
	<!-- js untuk bootstrap -->
	<script src="js/bootstrap.js"></script>
	<!-- js untuk bootstrap datetimepicker -->
	<script src="js/bootstrap-select.min.js"></script>

  
	</script>
	<?php if (@$tampildata['Status_FNIM']=="Complete By MID"){ ?>
	<script language="JavaScript" type="text/javascript">
	function checkEdit(form){
	if (form.inputRemarkafterComplete.value == ""){
    	alert("Remark after Complete No Can not be empty *");
    	form.inputRemarkafterComplete.focus();
    	return (false);  		}
	else if (form.inputRemarkafterComplete.value == ""){
    	alert("Remark after Complete No Can not be empty *");
    	form.inputRemarkafterComplete.focus();
    	return (false);  		}
		return confirm('Are you sure you want to Update Draft this data?');
	}
	function checkCancel(form){
		return confirm('Are you sure you want to Cancel Request this data?');
	}
	function checkRevise(form){
		return confirm('Are you sure you want to Revise Request this data?');
	}
	</script>

	<?php ;} else {?>
	<script language="JavaScript" type="text/javascript">
	function checkDraft(form){
		return confirm('Are you sure you want to Draft this data?');
	}
	function checkEdit(form){
		return confirm('Are you sure you want to Update this data?');
	}
	</script>
	<?php ;}?>
	</body>
</html>

<script>
$(document).ready(function(){
 $('#InputNprfCode').click(function(){
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
	$("#fnimdetail").html(info);  
	}
  });
  return false;
 }
</script>
 
<script>
$(document).ready(function(){
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
	   deleteRowfile('Attach');
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
