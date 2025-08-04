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
	document.cfm.SelectTypeRequest.focus();
	document.cfm.InputFNIMCode.focus();	
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
			filepdf.setAttribute('onChange',"return validasiFileFoto()");
			filepdf.setAttribute('name',"inputFile[]");
			filepdf.setAttribute('id',"inputFile[]");
			cell2.appendChild(filepdf);
			
			var cell3 = row.insertCell(2);
			var array = ["","Primer","Sekunder"];
			var InputKemasan = document.createElement('select');
			InputKemasan.setAttribute('class',"form-control");
			InputKemasan.setAttribute('title',"Select Kemasan");
			InputKemasan.setAttribute('name',"InputKemasan[]");
			InputKemasan.setAttribute('id',"InputKemasan[]");
			cell3.appendChild(InputKemasan);
			
			
			for (var i = 0; i < array.length; i++) {
				var option = document.createElement("option");
				option.value = array[i];
				option.text = array[i];
				InputKemasan.appendChild(option);
			}	
			
			var cell4 = row.insertCell(3);
			var array = ["","Front","Back","Side"];
			var InputPosisi = document.createElement('select');
			InputPosisi.setAttribute('class',"form-control");
			InputPosisi.setAttribute('title',"Select Posisi");
			InputPosisi.setAttribute('name',"InputPosisi[]");
			InputPosisi.setAttribute('id',"InputPosisi[]");
			cell4.appendChild(InputPosisi);
			
			
			for (var i = 0; i < array.length; i++) {
				var option = document.createElement("option");
				option.value = array[i];
				option.text = array[i];
				InputPosisi.appendChild(option);
			}
			
			var cell5 = row.insertCell(4);
			var Gambar = document.getElementById('ImgProfile[]').innertHTML = '<div id="ImgProfile[]"></div>';
			InputPosisi.setAttribute('id',"ImgProfile[]");

			cell5.appendChild(Gambar);
			
	 
			
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

<?php include "cfm-javascrift.php"; ?>

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
      <h3 class="mt-4"><?php if ($button=="add-cfm") {echo "New Request CFM";} else  {echo "Revise Request CFM";} ?> </h3>
	    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="../dist/index.php?button=dashboard">Dashboard</a></li>
		<li class="breadcrumb-item"><a href="../dist/index.php?button=cfm">Checklist Final Manuscript (CFM)</a></li>
        <li class="breadcrumb-item active"><?php if ($button=="add-cfm") {echo "New Request CFM";} else  {echo "Revise Request CFM";} ?> </li>
      </ol>
 	<div class="card mb-4">
	    <div class="card-header"> </div>

        <div class="card-body"> 
			
        <?php
		include "cfm-autonumber.php";
      	$exe =mysqli_query($con,"SELECT a.ID_No,a.Index_Document,a.Request_No,a.Last_Request_No,a.Status_Last_Document,
			a.FNIM_Code,a.ID_No_FNIMDetail,d.Request_No AS MPR_Code, e.Code_Product,c.Product_Name,
			b.Type_Request,c.Status_Product,a.ID_No_FNIM_Country,f.Country,a.Remark,a.Status_CFM,
			a.CreatedBy,date(a.CreatedDate) as Created_Date FROM tb_cfm a 
			INNER JOIN tb_fnim b ON a.FNIM_Code =b.Request_No
			INNER JOIN tb_fnim_detail c ON b.Request_No =c.Request_No And a.ID_No_FNIMDetail =c.ID_No
			LEFT JOIN tb_mpr d ON b.Request_No=d.FNIM_Code
			LEFT JOIN tb_mpr_detail e ON d.Request_No=e.Request_No AND e.ID_NoFNIMDetail= c.ID_No
			LEFT JOIN tb_fnim_country f ON a.ID_No_FNIM_Country=f.ID_No  
			WHERE a.Request_No = '".@$_GET['id']."'	And a.Status_CFM='Revise'
			GROUP BY a.ID_No,a.Index_Document,a.Request_No,a.Last_Request_No,a.Status_Last_Document,
			a.FNIM_Code,a.ID_No_FNIMDetail,  MPR_Code, e.Code_Product,c.Product_Name,
			b.Type_Request,c.Status_Product, f.Country,a.Remark,a.Status_CFM,
			a.CreatedBy,Created_Date");
        $tampildata=mysqli_fetch_array($exe);
		$isinetto="";
		$exeNetto = mysqli_query($con,"SELECT  Request_No,ID_No, Isi_Net, Netto,  Index_No 
		FROM tb_fnim_detail_netto   WHERE Request_No = '".@$tampildata['FNIM_Code']."' And
		ID_No_FnimDetail='".@$tampildata['ID_No_FNIMDetail']."'  Order By ID_No Asc");
		while(@$rowFNIMDetailNetto =mysqli_fetch_array($exeNetto)){ 
			$isinetto=$isinetto.@$rowFNIMDetailNetto['Isi_Net']." ".@$rowFNIMDetailNetto['Netto'].", ";
		}  
		//echo substr($isinetto,0,-2); 
		mysqli_query($con,"UPDATE tb_inbox SET ReadInbox='1' Where (NameApproval= '$username' Or OnBehalf='$username') 
		And Request_No='".@$_GET['id']."' And ReadInbox='0'");
		
		//________________________________________________________________________________StatusFNIM disabled
		if (@$tampildata['Status_CFM']<>"Draft" && @$tampildata['Status_CFM']<>"" && @$tampildata['Status_CFM']<>"Revise") {$disabled="disabled";} else{$disabled="";}

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
	
	$Attachment_Image			= "../img/Attachment_Image/";
	if($_POST){
		$ip						=$_SERVER['REMOTE_ADDR'];
		$hostname 				= gethostbyaddr($_SERVER['REMOTE_ADDR']);
		date_default_timezone_set("Asia/Jakarta");
		$createddate			=date("Y-m-d H:i:s");
		$yymmddhMs				=date("YmdHis");

    	$tempFormatNoRequest  	= $_POST['tempFormatNoRequest'];
		$inputAutoRequestNo		= $_POST['inputAutoRequestNo'];
		$inputLastRequestNo		= @$_POST['inputLastRequestNo'];
		$InputFNIMCode			= @$_POST['InputFNIMCode'];
		$InputTempFNIMCode		= @$_POST['InputTempFNIMCode'];
		$inputID_No_FNIM_Detail	= @$_POST['inputID_No_FNIM_Detail'];
		$inputID_No_FNIM_Country= @$_POST['inputID_No_FNIM_Country'];
		$inputProductCode 	 	= @$_POST['inputProductCode']; 
		$inputProductName	 	= @$_POST['inputProductName'];
		$inputNetto			 	= @$_POST['inputNetto'];
		$inputRequestType		= @$_POST['inputRequestType'];
		$inputCountry			= @$_POST['inputCountry'];
		$InputStatus			= @$_POST['InputStatus'];
		$inputRemark			= @$_POST['inputRemark'];
		$inputWorkflowRemark	= @$_POST['inputWorkflowRemark'];
					
		if($Save=="Update"){ 
			//membuat Query untuk update data
			include "cfm-save-edit.php";		
			include "cfm-save-file-new.php";
			
			$message = "Data successfully Update to database";
			echo "<script type='text/javascript'>alert('$message');</script>";
			echo"<script>  window.location='../dist/index.php?button=cfm'; </script>";
		}
		elseif($Save=="Cancel"){ 
			include "cfm-save-edit.php";
			mysqli_query($con,"UPDATE tb_cfm SET Status_CFM='Cancel' WHERE Request_No='$inputAutoRequestNo'");
			mysqli_query($con,"UPDATE tb_inbox SET Request_Status='Cancel' WHERE Request_No='$inputAutoRequestNo'");
			
			$message = "Data successfully Cancel Request";
			echo "<script type='text/javascript'>alert('$message');</script>";
			echo"<script>  window.location='../dist/index.php?button=cfm'; </script>";
			}
		elseif($Send=="Send"){ 
			include "cfm-autonumber.php";
			$Tanya = mysqli_query($con,"SELECT Request_No FROM tb_cfm WHERE Request_No = '$inputAutoRequestNo' ");
			if (mysqli_num_rows($Tanya) !=0 ) {
				//Update Sent CFM
				include "cfm-save-edit.php";
				include "cfm-save-file-new.php";
				mysqli_query($con,"UPDATE tb_cfm SET Status_CFM='Sent',
				UpdatedBy='$username',UpdatedDate='$createddate',UpdatedHostName='$ip : $hostname' 
				WHERE Request_No='$inputAutoRequestNo'");
			}
			//DeleteWorkFlow CFM
			mysqli_query($con,"DELETE From tb_workflownprf WHERE Request_No='$inputAutoRequestNo' And StatusWorkFlow Is Null");
			//Simpan WorkFlow CFM
			$cari =mysqli_query($con,"SELECT a.WorkFlowProcess,a.WorkFlowMenu,a.LevelProcess,b.NameApproval,b.OnBehalf, 
			a.Revise, b.Index_No,a.Index_No AS Index_Process FROM tb_workflowprocess a  INNER JOIN tb_workflowapproval b 
			ON  a.WorkFlowProcess =b.UserDomain AND a.WorkFlowMenu=b.WorkFlowMenu AND a.WorkFlowMenu='CFM' 
			AND a.UserDomain='$tampildata[CreatedBy]' AND a.Index_No >='$tampildataRevise[Step_Revise]' ORDER BY a.ID_No ,b.Index_No");
			$indexno=1;
			while($caridata =mysqli_fetch_array(@$cari)){
				mysqli_query($con,"Insert INTO tb_workflownprf (Request_No,WorkFlowMenu,LevelProcess,NameApproval,OnBehalf,Revise,Step_Revise,Index_No,CreatedBy,CreatedDate,CreatedHostName) 
				values ('$inputAutoRequestNo','$caridata[WorkFlowMenu]','$caridata[LevelProcess]','$caridata[NameApproval]',
				'$caridata[OnBehalf]','$caridata[Revise]','$caridata[Index_Process]','$indexno','$username','$createddate','$ip : $hostname')");
				$indexno++;	
			}
			
			
			//Update WorkFlow CFM
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
			$page="cfm-app";
			$WorkFlowMenu="CFM";
			$Confirm=="Approve";
			require ("../config/emailapp.php");
			if (mysqli_num_rows($exeNext) !=0 ) { 
					if ($tampildataNext['OnBehalf']<>"-" || $tampildataNext['OnBehalf']==""){
						$StatusCFM= "Waitting Approval By " .$tampildataNext['NameApproval']." Or ".$tampildataNext['OnBehalf'];}
					else {
						$StatusCFM= "Waitting Approval By " .$tampildataNext['NameApproval'];}
						$StatusInbox="W";
				}
				else {
					$StatusCFM="Complete";
					$StatusInbox="C";
				}
			//Simpan Inbox
			mysqli_query($con,"UPDATE tb_inbox Set Thema_Name='$inputProductName',Request_Type='$inputRequestType',
			Request_Status='$StatusInbox',ReadInbox='0',UpdatedBy='$username',
			NameApproval='".$tampildataNext['NameApproval']."',OnBehalf='".$tampildataNext['OnBehalf']."',
			Remark='$inputRemark',UpdatedDate='$createddate',UpdatedHostName='$ip : $hostname'  
			WHERE Request_No='$tempFormatNoRequest'");
			//---------------------------------------------------------------------------------------
			
			//UPDATE STATUS NPRF
			mysqli_query($con,"UPDATE tb_cfm Set Status_CFM='$StatusCFM' WHERE Request_No='$tempFormatNoRequest'");
			
			$message = "Data successfully Sent  to Approval";
			echo "<script type='text/javascript'>alert('$message');</script>";
			echo"<script>  window.location='../dist/index.php?button=cfm'; </script>";
		}
	}
		//End CRUD----------------------------------------------------------------------
		
		$exe =mysqli_query($con,"SELECT * FROM tb_cfm where Request_No = '".@$_GET['id']."'
		And Status_CFM='Revise'");
		if (mysqli_num_rows($exe) ==0 ) { 
		echo"<h3>Tidak ada request yang harus di Revise</h3><br><br>";
		echo'<a class="btn btn-primary" href="../dist/index.php?button=cfm" title="Back CFM">Back</a>';}
	
		else {
		
		?>
		
          <table width="100%" border="0" class="table table-striped" id="dataTables-example" >
            <tr>
              <td width="20%"><span class="form-group">Request No *</span></td>
              <td colspan="2"><span class="form-group">
				<input name="tempFormatNoRequest" type="hidden" value="<?php echo $tampildata['Request_No']; ?>">
                <input class="form-control py-4"  name="inputAutoRequestNo" id="inputAutoRequestNo"  maxlength="50" type="text"  
			  placeholder="Auto Request No" readonly="readonly" 
			  value="<?php if ($button=="add-cfm") {echo $NomorReq;} elseif ($button=="add-revise-cfm") 
			  {echo substr($tampildata['Request_No'],0,17)."-R".$rev;} else {echo @$tampildata['Request_No'];} ?>" />
              </span> </td>
            </tr>
            <tr>
              <td width="20%"><span class="form-group">Last Request No *</span></td>
              <td colspan="2"><span class="form-group">
                <input class="form-control py-4"  name="inputLastRequestNo" id="inputLastRequestNo"  maxlength="50" type="text"  
			  placeholder="Auto Request No" readonly="readonly" 
			  value="<?php if (@$tampildata['Status_CFM']=="Complete By MCJ" & $button=="add-revise-cfm") 
			  {echo @$tampildata['Request_No'];} else {echo @$tampildata['Last_Request_No'];}?>" />
              </span> </td>
            </tr>
 
            <tr>
              <td><span class="form-group">FNIM Product Request No *</span></td>
              <td width="50%"><div class="form-group d-flex align-items-center justify-content-between mt-0 mb-1">
			  	<input type="hidden" name="InputFNIMCode" id="InputFNIMCode"  
				value="<?php if ($_POST) { echo $InputFNIMCode; } else {echo @$tampildata['FNIM_Code'];} ?>" 
				onChange="setFocus(),get_detaildata(),DisplayShowHideExport()" 
				onFocus="setFocus(),get_detaildata(),DisplayShowHideExport()" readonly="readonly">
				
				<input type="text" class="form-control" name="InputTempFNIMCode" id="InputTempFNIMCode" 
				placeholder="Master Prodcut Request No" 
				value="<?php if ($_POST) { echo $InputTempFNIMCode; } else {echo @$tampildata['FNIM_Code'];} ?>" 
				disabled="disabled" > &nbsp;<button type="button" style="padding:2px 4px 4px 4px" 
			   class="btn btn-primary" title="Search Project Name"  
					name="btnsearch" 
					onClick="popupwindow('cfm/project-name-popup.php?id=cfm','Search Project Name','600','900');" <?php echo $disabled; ?>>
					<span class="glyphicon glyphicon-search" ></span> </button>
				</div>
			  </td>
	 
            </tr>
            <tr>
              <td>Product Code *</td>
              <td width="20%">
			  	<input class="form-control py-4"  name="inputID_No_FNIM_Detail" id="inputID_No_FNIM_Detail"type="hidden"  
			  	value="<?php echo @$tampildata['ID_No_FNIMDetail'];?>" />
			    <input class="form-control py-4"  name="inputProductCode" id="inputProductCode"  maxlength="50" type="text"  
			  	placeholder="Enter Product Code" disabled="disabled" 
			  	value="<?php  if (@$tampildata['Code_Product']=='') {echo "XXXXXX";} else {echo $tampildata['Code_Product'];}?> " />
              </td>
			  <td width="20%">
			  </td>
			  
            </tr>
 
			<tr>
              <td>Product Name *</td>
              <td colspan="3"><span class="form-group">
                <input class="form-control py-4" name="inputProductName" id="inputProductName" 
				maxlength="50" type="text" placeholder="Enter Product Name"  
				value="<?php if ($_POST) { echo $inputProductName; } else {echo @$tampildata['Product_Name'];} ?>"
				readonly="readonly" >
              </span>
			  </td>
            </tr>

            <tr>
              <td>Netto *</td>
              <td>
				<input class="form-control py-4" name="inputNetto" id="inputNetto" 
				maxlength="50" type="text" placeholder="Enter Netto"  
				value="<?php if ($_POST) { echo $inputNetto; } else {echo substr($isinetto,0,-2);} ?>"
				disabled="disabled" > </td>
            </tr>
 
            <tr>
              <td>Request Type * - Country</td>
              <td colspan="3"> <div class="form-group d-flex align-items-center justify-content-between mt-0 mb-1">
			  <input class="form-control py-4" name="inputRequestType" id="inputRequestType" 
				maxlength="50" type="text" placeholder="Enter Request Type"  
				value="<?php if ($_POST) { echo $inputRequestType; } else {echo @$tampildata['Type_Request'];} ?>"
				readonly="readonly" > -
				<input class="form-control py-4"  name="inputID_No_FNIM_Country" id="inputID_No_FNIM_Country" type="hidden"  
			  	value="<?php echo @$tampildata['ID_No_FNIM_Country'];?>" />
				<input class="form-control py-4" name="inputCountry" id="inputCountry" 
				maxlength="50" type="text" placeholder="Enter Country"  
				value="<?php  if (@$tampildata['Country']=='') {echo "XXXXXX";} else {echo $tampildata['Country'];}?>"
				readonly="readonly" ></div>
			   </td>
            </tr>
            <tr>
              <td>Status *</td>
              <td>
				<input class="form-control py-4" name="InputStatus" id="InputStatus" 
				maxlength="50" type="text" placeholder="Enter Status"  
				value="<?php if ($_POST) { echo $InputStatus; } else {echo @$tampildata['Status_Product'];} ?>"
				disabled="disabled" >
			   </td>
            </tr>
			
			<tr>
              <td colspan="3">
			  <table name="Attach" id="Attach"  width="100%" border="1" class="table table-striped table-bordered table-hover" >
			   
				  <tr>
					<td colspan="10" align="left"><strong>Attachment File (.jpg|.JPG|.jpeg|.JPEG|.png|.gif)</strong>					
					<button type="button" style="padding:0px 0px 0px 0px" class="btn btn-primary" title="Add Attachment File"  
					name="btnCreateCFM" onClick="addRowfile('Attach')" <?php echo $disabled; ?> ><span class="fa fa-plus" title="Preview Work Flow" ></span> </button>
					<button type="button" style="padding:0px 0px 0px 0px" class="btn btn-primary" title="Delete Attachment File"  
					id="btnDeleteCFM" name="btnDeleteCFM"   <?php echo $disabled; ?> >
					<span class="glyphicon glyphicon-trash" title="Preview Work Flow" ></span></button>
					
					</td>
				  </tr>
				  <tr valign="bottom" align="center" bgcolor="#999999" >
					<th width="1%"></th>
					<th width="20%">File</th>
					<th width="20%">Kemasan</th>
					<th width="20%">Posisi</th>
					<th width="1%">Komentar</th>
				  </tr>
 					 <?php
 					$exe = mysqli_query($con,"SELECT ID_No,File,Kemasan,Posisi,Index_No 
					FROM tb_cfm_file Where Request_No = '".@$tampildata['Request_No']."'   ");
					$no = 1;
					while(@$rowCFMFile =mysqli_fetch_array($exe)){
					?>
				  <tr id="<?php echo $rowCFMFile['ID_No'];?>">
					<td><input type="checkbox" name="chkdetail[]" id="chkdetail[]" value="<?php echo $rowCFMFile['ID_No'];?>" <?php echo $disabled; ?>>
					<input type="hidden" name="tempfileid[]" id="tempfileid[]" value="<?php echo $rowCFMFile['ID_No'];?>">
					<input type="hidden" name="tempfilelama[]" id="tempfilelama[]" value="<?php echo $rowCFMFile['File'];?>"></td>
					<td>
					<input type="file" name="inputFile[]" id="inputFile[]" class="form-control"
						style="padding:2px 2px 2px 2px" OnChange="return validasiFileFoto()" <?php echo $disabled; ?> >
					<?php if (!empty($rowCFMFile['File'])){?>
					 
			  		<img height="40" width="40" src="../img/Attachment_Image/<?php echo $rowCFMFile['File'];?>"  title="Open File <?php echo $rowCFMFile['File'];?>"
					onClick="popupwindow('../config/popup-img.php?id=<?php echo $rowCFMFile['ID_No'];?>&name=<?php echo $rowCFMFile['File'];?>&pg=filecfm','Preview Pdf','700','1000');">
			  	<?php echo $rowCFMFile['File'];} ?>
				   </td>
 
				   <td>
				   <select style="padding:2px 2px 2px 2px" class="form-control" id="InputKemasan[]" name="InputKemasan[]" 
				   <?php echo $disabled; ?>  required>
						<option value="Primer" <?php if ($rowCFMFile['Kemasan']=='Primer') {echo "Selected"; }?>>Primer</option>
						<option value="Sekunder" <?php if ($rowCFMFile['Kemasan']=='Sekunder') {echo "Selected"; }?>>Sekunder</option>
					</select>
					</td>
					<td>
					<select style="padding:2px 2px 2px 2px" class="form-control" id="InputPosisi[]" name="InputPosisi[]" 
					<?php echo $disabled; ?>  required>
						  <option value="Front" <?php if ($rowCFMFile['Posisi']=='Front') {echo "Selected"; }?>>Front</option>
						  <option value="Back" <?php if ($rowCFMFile['Posisi']=='Back') {echo "Selected"; }?>>Back</option>
						  <option value="Side" <?php if ($rowCFMFile['Posisi']=='Side') {echo "Selected"; }?>>Side</option>
						</select>
					</td>
 
					<td align="justify"> 
				<button  type="button"  class="btn btn-primary"
		 onClick="popupwindow('../dist/page.php?form=cfm-comment&id=<?php echo $rowCFMFile['ID_No'];?>&pg=cfm-comment','CFM','400','1000');">History</button>	</td>
				  </tr>
				  <?php $no++;} ?>
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
			<?php if (@$tampildata['Status_CFM']<>"Complete By MID") {?>	
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
	
          </table>
		   <button type="submit" name="Send" value="Send" onClick="return checkSendApproval(fnim)" 
		  	class="btn btn-primary" <?php echo $disabled; ?>>Send Approval </button>
		<button type="submit" name="Save" value="Update" onClick="return checkEdit(fnim)"  
		class="btn btn-primary">Save</button>
		 <?php if (@$tampildata['Status_CFM']=="Complete" & $button!="add-revise-cfm" || @$tampildata['Status_CFM']=="Revise" & $button!="add-revise-cfm")  {?>
		  <button type="submit" name="Save" value="Cancel" onClick="return checkCancel(cfm)" 
		  class="btn btn-primary">Cancel Request</button>
	      <?php ;} ?>
		  <a class="btn btn-primary" href="../dist/index.php?button=cfm" title="Back Format No Request">Back</a> 
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
        $('#cfmdetail').DataTable({
            responsive: true
        });
    });
    </script>

	<script language="JavaScript" type="text/javascript">
	function checkSendApproval(form){
 	var rowAttach = document.getElementById('Attach').rows.length; 

	if (form.inputAutoRequestNo.value == ""){
    	alert("Request No Can not be empty *");
    	form.inputAutoRequestNo.focus();
    	return (false);  		}
	else if (form.InputFNIMCode.value == ""){
    	alert("Master Product Request No Can not be empty *");
    	form.InputFNIMCode.focus();
    	return (false);  		}
	else if (form.InputTempFNIMCode.value == ""){
    	alert("Master Prodcut Request No Can not be empty *");
    	form.InputTempFNIMCode.focus();
    	return (false);  		}
	else if(form.inputProductCode.value==""){
		alert("Product Code Can not be empty!");
		form.inputProductCode.focus();
    	return (false);  		}
	else if(form.inputProductName.value==""){
		alert("Product Name Can not be empty!");
		form.inputProductName.focus();
    	return (false);  		}
	else if(form.InputStatus.value==""){
		alert("Status Can not be empty!");
		form.InputStatus.focus();
    	return (false);  		}
	else if(rowAttach <=2  ) {
			alert('Attachment File masih kosong');
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
 
	</body>
</html>

<script language="JavaScript" type="text/javascript">
	function checkDraft(form){
	if (form.inputAutoRequestNo.value == ""){
    	alert("Request No Can not be empty *");
    	return (false);  		}
	else if (form.InputFNIMCode.value == ""){
    	alert("Master Product Request No Can not be empty *");
    	form.InputFNIMCode.focus();
    	return (false);  		}
	else if(form.inputProductCode.value==""){
		alert("Product Code Can not be empty!");
		form.inputProductCode.focus();
    	return (false);  		}

		return confirm('Are you sure you want to Draft this data?');
	}
	function checkEdit(form){
		return confirm('Are you sure you want to Update this data?');
	}
	
	
	function checkCancel(form){
		return confirm('Are you sure you want to Cancel Request this data?');
	}
</script>
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
 $('#btnDeleteCFM').click(function(){
  
  if(confirm("Are you sure you want to delete this?"))
  {
   var DelFileCFM = [];
   
   $(':checkbox:checked').each(function(i){
    DelFileCFM[i] = $(this).val();
   });
   if(DelFileCFM.length === 0) //tell you if the array is empty
   {
    alert("Please Select atleast one checkbox");
   }
   else
   {
    $.ajax({
     url:'../config/delete.php',
     method:'POST',
     data:{DelFileCFM:DelFileCFM},
     success:function()
     {
      for(var i=0; i<DelFileCFM.length; i++)
      {
       $('tr#'+DelFileCFM[i]+'').css('background-color', '#ccc');
       $('tr#'+DelFileCFM[i]+'').fadeOut('slow');
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



<?php ;}?>