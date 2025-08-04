	<?php $Send		= @$_POST['Send']; ?>
	<?php $Save		= @$_POST['Save']; ?>
<?php include "lamdd-javascrift.php"; ?>

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
	document.lamdd.InputTempFNIMCode.focus();	
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
			var AddImage ="AddImage"+rowCount;
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
			var InputKeterangan = document.createElement('textarea');
			InputKeterangan.setAttribute('class',"form-control");
			InputKeterangan.setAttribute('style',"padding:2px 2px 2px 2px");
			InputKeterangan.setAttribute('title',"Input Final Product Name");
			InputKeterangan.setAttribute('name',"inputKeterangan[]");
			InputKeterangan.setAttribute('id',"inputKeterangan[]");
			InputKeterangan.setAttribute('onkeyup',"this.value = this.value.toUpperCase()");
			InputKeterangan.setAttribute('required',"required[]");
			cell5.appendChild(InputKeterangan);
			
 			var cell6 = row.insertCell(5);
			var div = document.createElement('myDiv');
        	div.innerHTML ='<div id="ImgProfile[]"></div>';
        	cell6.appendChild(div);
	 
			
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
	
	 
	</head>
	<body onload='setFocus();' > 
	<main> 
    <div class="container-fluid"> 
      <h3 class="mt-4"><?php if ($button=="add-lamdd" || $button=="add-revise-lamdd")
	  {echo "New Lampiran DD";} else  {echo "Edit Lampiran DD";} ?> </h3>
	    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="../dist/index.php?button=dashboard">Dashboard</a></li>
		<li class="breadcrumb-item"><a href="../dist/index.php?button=lamdd">Lampiran DD</a></li>
        <li class="breadcrumb-item active"><?php if ($button=="add-lamdd" || $button=="add-revise-lamdd") 
		{echo "New Request Lampiran DD";} else  {echo "Edit Request Lampiran DD";} ?> </li>
      </ol>
 	<div class="card mb-4">
	    <div class="card-header"> </div>

        <div class="card-body"> 
			
        <?php
		include "lamdd-autonumber.php";
			
		$query="SELECT a.ID_No,a.Index_Document,a.Request_No,a.Last_Request_No,a.Status_Last_Document,
			a.FNIM_Code,a.ID_No_FNIMDetail,h.Request_No AS FAW_Code,d.Request_No AS MPR_Code,
			 e.Code_Product,c.Product_Name,
			b.Type_Request,c.Status_Product,a.ID_No_FNIM_Country,f.Country,a.Remark,a.Status_LAMDD,
			a.CreatedBy,date(a.CreatedDate) as Created_Date FROM tb_lamdd a 
			INNER JOIN tb_fnim b ON a.FNIM_Code =b.Request_No
			INNER JOIN tb_fnim_detail c ON a.ID_No_FNIMDetail =c.ID_No
			LEFT JOIN tb_mpr d ON b.Request_No=d.FNIM_Code
			LEFT JOIN tb_mpr_detail e ON d.Request_No=e.Request_No AND e.ID_NoFNIMDetail= c.ID_No
			LEFT JOIN tb_fnim_country f ON a.ID_No_FNIM_Country=f.ID_No
			LEFT JOIN tb_cfm g ON g.FNIM_Code= a.Request_No AND g.ID_No_FNIMDetail=b.ID_No
			LEFT JOIN tb_faw h ON h.CFM_Code= g.Request_No
			WHERE a.Request_No = '".@$_GET['id']."' ";
		if ($button=="add-revise-lamdd") {$query.=" And a.Status_Last_Document='1'";}
		else {$query =$query; }
      	$exe =mysqli_query($con,$query. " GROUP BY a.ID_No ");
        $tampildata=mysqli_fetch_array($exe);
		$rev=@$tampildata['Index_Document']+1;

		$isinetto="";
		$exeNetto = mysqli_query($con,"SELECT  Request_No,  ID_No, Isi_Net, Netto,  Index_No 
		FROM tb_fnim_detail_netto   WHERE Request_No = '".@$tampildata['FNIM_Code']."' And
		ID_No_FnimDetail='".@$tampildata['ID_No_FNIMDetail']."'  Order By ID_No Asc");
		while(@$rowFNIMDetailNetto =mysqli_fetch_array($exeNetto)){ 
			$isinetto=$isinetto.@$rowFNIMDetailNetto['Isi_Net']." ".@$rowFNIMDetailNetto['Netto'].", ";
		} 
		//echo substr($isinetto,0,-2); 
		//________________________________________________________________________________StatusCFM disabled

		if (@$tampildata['Status_LAMDD']<>"Draft" & @$tampildata['Status_LAMDD']<>"" & $button<>"add-revise-lamdd")
		  {$disabled="disabled";} else{$disabled="";}
		if (@$tampildata['Status_LAMDD'] <> "Complete By MID" & $button=="add-revise-lamdd")
		  {$disabledmid="disabled";} else{$disabledmid="";}

		//________________________________________________________________________________WORKFLOWFNIM
		$exeReq = mysqli_query($con,"Select NameApproval,OnBehalf,Remark_WorkFlow FROM tb_workflowNPRF 
		WHERE Request_No = '".@$_GET['id']."' And Index_No='1' limit 1");
		$tampildataReq=mysqli_fetch_array($exeReq);
		//________________________________________________________________________________
        
	  	?>
	<form name="lamdd" id="lamdd" action="" method="post"  enctype="multipart/form-data"  >
    <?php 
	//Begin CRUD----------------------------------------------------------------------
	$datenow					= date("Y-m-d");
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
		$InputFAWCode			= @$_POST['InputFAWCode'];
		$InputFNIMCode			= @$_POST['InputFNIMCode'];
		$InputTempFNIMCode		= @$_POST['InputTempFNIMCode'];
		$inputID_No_FNIM_Detail = @$_POST['inputID_No_FNIM_Detail'];
		$inputID_No_FNIM_Country= @$_POST['inputID_No_FNIM_Country'];
		$inputProductCode 	 	= @$_POST['inputProductCode']; 
		$inputProductName	 	= @$_POST['inputProductName'];
		$inputNetto			 	= @$_POST['inputNetto'];
		$inputRequestType		= @$_POST['inputRequestType'];
		$inputCountry			= @$_POST['inputCountry'];
		$InputStatus			= @$_POST['InputStatus'];
		$inputRemark			= @$_POST['inputRemark'];
		$inputProductName		= @$_POST['inputProductName'];

		if($Save=="Save"){
			include "lamdd-autonumber.php";
			$Tanya = mysqli_query($con,"SELECT Request_No FROM tb_lamdd WHERE Request_No = '@$inputAutoRequestNo' ");
			if (mysqli_num_rows($Tanya) !=0 ) {  
				echo "<div class='form-group has-error'>
				<label class='control-label' for='inputError'>Error Save : Request No already exists in the database *</label></div>";}
			else{
				//membuat Query untuk menyimpan data
				include "lamdd-autonumber.php";
				if ($button=="add-lamdd") {
					include "lamdd-save-new.php";
					include "lamdd-save-file-new.php"; 
				}else {
					include "lamdd-save-new-revisi.php";
					include "lamdd-save-file-new-revisi.php"; 
				}
					
				$message = "Data successfully Save to Draft";
				echo "<script type='text/javascript'>alert('$message');</script>";
				echo"<script>  window.location='../dist/index.php?button=lamdd'; </script>";
				}
			}
		elseif($Save=="Update"){ 
			//membuat Query untuk update data
			include "lamdd-save-edit.php";		
			include "lamdd-save-file-new.php";
			$message = "Data successfully Update to database";
			echo "<script type='text/javascript'>alert('$message');</script>";
			echo"<script>  window.location='../dist/index.php?button=lamdd'; </script>";
		}
		elseif($Save=="Cancel"){ 
			include "lamdd-save-edit.php";
			mysqli_query($con,"UPDATE tb_lamdd SET Status_LAMDD='Cancel' WHERE Request_No='$inputAutoRequestNo'");
			
			$message = "Data successfully Cancel Request";
			echo "<script type='text/javascript'>alert('$message');</script>";
			echo"<script>  window.location='../dist/index.php?button=lamdd'; </script>";
		}
		 
	}
		//End CRUD----------------------------------------------------------------------
		?>
          <table width="100%" border="0" class="table table-striped" id="dataTables-example" >
            <tr>
              <td width="20%"><span class="form-group">Request No *</span></td>
              <td colspan="2"><span class="form-group">
				<input name="tempFormatNoRequest" type="hidden" value="<?php echo $tampildata['Request_No']; ?>">
                <input class="form-control py-4"  name="inputAutoRequestNo" id="inputAutoRequestNo"  maxlength="50" type="text"  
			  placeholder="Auto Request No" readonly="readonly" 
			  value="<?php if ($button=="add-lamdd") {echo $NomorReq;} elseif ($button=="add-revise-lamdd") 
			  {echo substr($tampildata['Request_No'],0,17)."-R".$rev;} else {echo @$tampildata['Request_No'];} ?>" />
              </span> </td>
            </tr>
            <tr>
              <td width="20%"><span class="form-group">Last Request No *</span></td>
              <td colspan="2"><span class="form-group">
                <input class="form-control py-4"  name="inputLastRequestNo" id="inputLastRequestNo"  maxlength="50" type="text"  
			  placeholder="Auto Request No" readonly="readonly" 
			  value="<?php if (@$tampildata['Status_LAMDD']=="Complete" & $button=="add-revise-lamdd") 
			  {echo @$tampildata['Request_No'];} else {echo @$tampildata['Last_Request_No'];}?>" />
              </span> </td>
            </tr>
 
            <tr>
              <td><span class="form-group">FNIM Request No *</span></td>
              <td width="50%"><div class="form-group d-flex align-items-center justify-content-between mt-0 mb-1">
				<input type="hidden" name="InputFAWCode" id="InputFAWCode"  
				value="<?php if ($_POST) { echo $InputFAWCode; } else {echo @$tampildata['FAW_Code'];} ?>" >
			  	<input type="hidden" name="InputFNIMCode" id="InputFNIMCode"  
				value="<?php if ($_POST) { echo $InputFNIMCode; } else {echo @$tampildata['FNIM_Code'];} ?>" >
				
				<input type="text" class="form-control" name="InputTempFNIMCode" id="InputTempFNIMCode" 
				placeholder="Master Prodcut Request No" 
				value="<?php if ($_POST) { echo $InputTempFNIMCode; } else {echo @$tampildata['FNIM_Code'];} ?>" 
				readonly="readonly" onChange="setFocus(),get_detaildata()" onFocus="setFocus(),get_detaildata()"> &nbsp;<button type="button" style="padding:2px 4px 4px 4px" 
			   class="btn btn-primary" title="Search Project Name"  
					name="btnsearch" 
					onClick="popupwindow('lamdd/project-name-popup.php?id=lamdd','Search Project Name','600','900');" <?php echo $disabled; ?>>
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
			  </table>
			  <table name="Attachlamdd" id="Attachlamdd"  width="100%" border="1" class="table table-striped table-bordered table-hover" >
			   
				  <tr>
					<td colspan="10" align="left"><strong>Attachment File (.jpg|.JPG|.jpeg|.JPEG|.png|.gif)</strong>					
					<button type="button" style="padding:0px 0px 0px 0px" class="btn btn-primary" title="Add Attachment File"  
					name="btnCreateCFM" onClick="addRowfile('Attachlamdd')" <?php echo $disabled; ?> ><span class="fa fa-plus" title="Preview Work Flow" ></span> </button>
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
					<th width="40%">Keterangan</th>
					<th width="1%">Gambar</th>
				  </tr>
 					 <?php
 					$exe = mysqli_query($con,"SELECT ID_No,File,Kemasan,Posisi,Keterangan, Index_No 
					FROM tb_lamdd_file Where Request_No = '".@$tampildata['Request_No']."'   ");
					$no = 1;
					while(@$RowLAMDDFile =mysqli_fetch_array($exe)){
					?>
				  <tr id="<?php echo $RowLAMDDFile['ID_No'];?>">
					<td><input type="checkbox" name="chkdetail[]" id="chkdetail[]" value="<?php echo $RowLAMDDFile['ID_No'];?>" <?php echo $disabled; ?>>
					<input type="hidden" name="tempfileid[]" id="tempfileid[]" value="<?php echo $RowLAMDDFile['ID_No'];?>">
					<input type="hidden" name="tempfilelama[]" id="tempfilelama[]" value="<?php echo $RowLAMDDFile['File'];?>"></td>
					<td>
						<input type="file" name="inputFile[]" id="inputFile[]" class="form-control"
						style="padding:2px 2px 2px 2px" OnChange="return validasiFileFoto()" <?php echo $disabled; ?> >
					
				   </td>
 
				   <td>
				   <select style="padding:2px 2px 2px 2px" class="form-control" id="InputKemasan[]" name="InputKemasan[]" 
				   <?php echo $disabled; ?>  required>
						<option value="Primer" <?php if ($RowLAMDDFile['Kemasan']=='Primer') {echo "Selected"; }?>>Primer</option>
						<option value="Sekunder" <?php if ($RowLAMDDFile['Kemasan']=='Sekunder') {echo "Selected"; }?>>Sekunder</option>
					</select>
					</td>
					<td>
					<select style="padding:2px 2px 2px 2px" class="form-control" id="InputPosisi[]" name="InputPosisi[]" 
					<?php echo $disabled; ?>  required>
						  <option value="Front" <?php if ($RowLAMDDFile['Posisi']=='Front') {echo "Selected"; }?>>Front</option>
						  <option value="Back" <?php if ($RowLAMDDFile['Posisi']=='Back') {echo "Selected"; }?>>Back</option>
						  <option value="Side" <?php if ($RowLAMDDFile['Posisi']=='Side') {echo "Selected"; }?>>Side</option>
						</select>
					</td>
					<td>
						<textarea name="inputKeterangan[]" id="inputKeterangan[]" class="form-control"
						style="padding:2px 2px 2px 2px" <?php echo $disabled; ?> ><?php echo $RowLAMDDFile['Keterangan']; ?></textarea>
					
					</td>
					<td align="justify"> 
					<?php if (!empty($RowLAMDDFile['File'])){?>
					 
			  		<img height="40" width="40" src="../img/Attachment_Image/<?php echo $RowLAMDDFile['File'];?>"  title="Open File <?php echo $RowLAMDDFile['File'];?>"
					onClick="popupwindow('../config/popup-img.php?id=<?php echo $RowLAMDDFile['ID_No'];?>&name=<?php echo $RowLAMDDFile['File'];?>&pg=filelamdd','Preview Pdf','700','1000');">
			  	<?php echo $RowLAMDDFile['File'];} ?>
					</td>
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
			 
			<tr>
              <td colspan="3"></td>
            </tr>
	
          </table>
		   
		  <?php if (@$tampildata['Status_LAMDD']<>"Cancel")  {?>
		  <button type="submit" name="Save" value="<?php if ($button=="add-lamdd" || $button=="add-revise-lamdd") 
		  {echo"Save";} else {echo"Update";}  ?>"
		  <?php if ($button=="add-lamdd" || $button=="add-revise-lamdd") 
		   {echo 'onclick="return checkDraft(lamdd)"';} else {echo 'onclick="return checkEdit(lamdd)"';} ?>  
		  class="btn btn-primary"
		  <?php if (@$tampildata['Status_LAMDD']!="Complete" || (@$tampildata['Status_LAMDD']=="Complete"  & $button=="add-revise-lamdd") )  
		  {echo $disabled;} else {echo "disabled='disabled'";} ?>>Save</button>
		  <?php ;} ?>

		  <?php if (@$tampildata['Status_LAMDD']=="Complete" & $button!="add-revise-lamdd" || @$tampildata['Status_LAMDD']=="Revise" & $button!="add-revise-lamdd")  {?>
		  <button type="submit" name="Save" value="Cancel" onClick="return checkCancel(lamdd)" 
		  class="btn btn-primary">Cancel Request</button>
	      <?php ;} ?>

		  <a class="btn btn-primary" href="../dist/index.php?button=lamdd" title="Back Format No Request">Back</a> 
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
        $('#lamdddetail').DataTable({
            responsive: true
        });
    });
    </script>

	 
		<!-- js untuk jquery -->
	<script src="js/jquery-1.11.2.min.js"></script>
	<!-- js untuk bootstrap -->
	<script src="js/bootstrap.js"></script>
	<!-- js untuk bootstrap datetimepicker -->
	<script src="js/bootstrap-select.min.js"></script>

  
	</script>
 	<script language="JavaScript" type="text/javascript">

	function checkCancel(form){
		return confirm('Are you sure you want to Cancel Request this data?');
	}
	function checkRevise(form){
		return confirm('Are you sure you want to Revise Request this data?');
	}
	</script>

 	<script language="JavaScript" type="text/javascript">
	function checkDraft(form){
		var rowAttach = document.getElementById('Attach').rows.length; 
	if (form.inputAutoRequestNo.value == ""){
    	alert("Request No Can not be empty *");
    	return (false);  		}
	else if (form.InputFNIMCode.value == ""){
    	alert("FNIM Request No Can not be empty *");
    	form.InputFNIMCode.focus();
    	return (false);  		}
	else if(form.inputProductCode.value==""){
		alert("Product Code Can not be empty!");
		form.inputProductCode.focus();
    	return (false);  		}
	else if(rowAttach <=2  ) {
		alert('Attachment File masih kosong');
		return (false);  		}
	else if (form.inputRemark.value == ""){
    	alert("Remark Can not be empty *");
    	form.inputRemark.focus();
    	return (false);  		}
		return confirm('Are you sure you want to Draft this data?');
	}
	function checkEdit(form){
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
	else if(rowAttach <=2  ) {
		alert('Attachment File masih kosong');
		return (false);  		}
	else if (form.inputRemark.value == ""){
    	alert("Remark Can not be empty *");
    	form.inputRemark.focus();
    	return (false);  		}
		return confirm('Are you sure you want to Update this data?');
	}
	</script>
 	</body>
</html>

  
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
	   deleteRowfile('Attachlamdd');
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

<script>
$(document).ready(function(){
 $('#InputFAWCode').click(function(){
  get_detaildata();
 });
});
 function get_detaildata(){
  var a = $('#InputFAWCode').val();

  $.ajax({
   type: 'POST',
   url: "lamdd/faw-load-attchment.php",
   
   data: { data1: a},
   success: function(info) {
	$("#Attach").html(info);  
	}
  });
  return false;
 }
</script>
