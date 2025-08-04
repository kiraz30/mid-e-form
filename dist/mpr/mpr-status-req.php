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
	document.mpr.SelectTypeRequest.focus();
	document.mpr.selectReq.focus();
	
	}
</script>

<script type="text/javascript">
	function angka(evt){
		var charCode = (evt.which) ? evt.which : event.keyCode
		if ((charCode < 48 || charCode > 57)&&charCode>32)  {
			return false;
		}
		return true;
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
	
<script src="../../vendor/jquery/jquery-latest.js" type="text/javascript"></script>
	</head>
	<body onload='setFocus();' > 
	<main> 
    <div class="container-fluid"> 
      <h3 class="mt-4">New Master Product Request (MPR)</h3>
	    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="../dist/index.php?button=dashboard">Dashboard</a></li>
		<li class="breadcrumb-item"><a href="../dist/index.php?button=status-req">Status Request</a></li>
        <li class="breadcrumb-item active">New Master Product Request (MPR)</li>
      </ol>
 	<div class="card mb-4">
	    <div class="card-header"> </div>

        <div class="card-body"> 
			
        <?php
		include "mpr-autonumber.php";
      	$exe =mysqli_query($con,"SELECT ID_No,Request_No,Project_Name,Type_Request,FNIM_Code,Type,Brand,Bisnis,Category,
		Series,Segmentation,CustomerCode,Royalty,KeteranganProduct,NoBarcodeExisting,CustomerCodeFormula,RoyaltyFormula,
		NamaProductSingkat,KelompokStok,Flex,SAP,Status_MPR,Remark,RemarkafterComplete FROM tb_mpr where Request_No = '".@$_GET['id']."' ");
        $tampildata=mysqli_fetch_array(@$exe);
			//________________________________________________________________________________UPDATE READ INBOX
		mysqli_query($con,"UPDATE tb_inbox SET ReadInbox='1' Where (NameApproval= '$username' Or OnBehalf='$username') 
		And Request_No='".@$_GET['id']."' And ReadInbox='0'");
		//________________________________________________________________________________NEXT APPROVE
		$exeWFP = mysqli_query($con,"SELECT WorkFlowMenu,Index_No,NameApproval,OnBehalf,StatusWorkFlow FROM tb_workflownprf 
		WHERE (NameApproval='$username' or OnBehalf ='$username') And Request_No = '".@$_GET['id']."' AND StatusWorkFlow IS null");
        $tampildataWFR=mysqli_fetch_array($exeWFP);
		$NextStep_Index= $tampildataWFR['Index_No']+1;
		//________________________________________________________________________________WORK FLOW Back PROCESS
		$exeWFBP = mysqli_query($con,"SELECT WorkFlowMenu,Index_No,NameApproval,OnBehalf,StatusWorkFlow FROM tb_workflownprf 
		WHERE (NameApproval='$username' or OnBehalf ='$username') And Request_No = '".@$_GET['id']."' AND StatusWorkFlow IS null");
        $tampildataWFBR=mysqli_fetch_array($exeWFBP);
		$BackStep_Index= $tampildataWFBR['Index_No']-1;
		
		//________________________________________________________________________________StatusMPR disabled
		$exeWFMPR = mysqli_query($con,"SELECT a.WorkFlowProcess,a.WorkFlowMenu,a.LevelProcess,b.NameApproval,b.OnBehalf, 
		a.Revise, b.Index_No,a.Index_No AS Index_Process FROM tb_workflowprocess a  INNER JOIN tb_workflowapproval b 
		ON  a.WorkFlowProcess =b.UserDomain AND a.WorkFlowMenu=b.WorkFlowMenu 
		INNER JOIN tb_workflownprf c ON  a.WorkFlowProcess =c.CreatedBy AND a.WorkFlowMenu=c.WorkFlowMenu AND a.WorkFlowMenu='MPR'
		WHERE (c.NameApproval='$username' or c.OnBehalf ='$username') And c.Request_No = '".@$_GET['id']."' AND c.StatusWorkFlow IS null 
		GROUP BY a.WorkFlowProcess,a.WorkFlowMenu,a.LevelProcess,b.NameApproval,b.OnBehalf, 
		a.Revise, b.Index_No,a.Index_No  ,c.StatusWorkFlow ");
        $tampildataWFMPR=mysqli_fetch_array($exeWFMPR);
		//________________________________________________________________________________
	
	  	?>
	<form name="mpr" id="mpr" action="" method="post"  enctype="multipart/form-data"  >
    <?php 
	//Begin CRUD----------------------------------------------------------------------
	$file	 						= "../file/";
	if($_POST){
		$ip=$_SERVER['REMOTE_ADDR'];
		$hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);
		date_default_timezone_set("Asia/Jakarta");
		$createddate=date("Y-m-d H:i:s");
    	$tempFormatNoRequest  	= $_POST['tempFormatNoRequest'];
		$inputAutoRequestNo		= $_POST['inputAutoRequestNo'];
		$inputProjectName 	 	= @$_POST['inputProjectName']; 
		$SelectTypeRequest	 	= @$_POST['SelectTypeRequest'];
		$selectReq			 	= @$_POST['selectReq'];
		$InputType				= @$_POST['InputType'];
		$InputBrand				= @$_POST['InputBrand'];
		$InputBisnis		 	= @$_POST['InputBisnis'];
		$InputCategory		 	= @$_POST['InputCategory'];
		$InputSeries			= @$_POST['InputSeries']; 
		$InputSegmentation		= @$_POST['InputSegmentation'];
		$selectCustomerCode	 	= @$_POST['selectCustomerCode'];
		$InputRoyalty		 	= @$_POST['InputRoyalty'];
		$InputKeteranganProduct	= @$_POST['InputKeteranganProduct'];
		$InputBarcodeExisting	= @$_POST['InputBarcodeExisting'];
		$selectCustomerCodeFormula= @$_POST['selectCustomerCodeFormula'];
		$InputRoyaltyFormula 	= @$_POST['InputRoyaltyFormula'];
		$inputNamaProductSingkat= @$_POST['inputNamaProductSingkat'];
		$inputKelompokStok	 	= @$_POST['inputKelompokStok'];
		$inputRemark			= @$_POST['inputRemark'];
		$inputRemarkApp			= @$_POST['inputRemarkApp'];

		
}		
		?>			
          <table width="100%" border="0" class="table table-striped" id="dataTables-example" >
            <tr>
              <td width="1%"><span class="form-group">I.</span></td>
              <td width="15%"><span class="form-group"> Request No</span></td>
              <td colspan="3"><span class="form-group">
				<input name="tempFormatNoRequest" type="hidden" value="<?php echo $tampildata['Request_No']; ?>">
                <input class="form-control py-4"  name="inputAutoRequestNo" id="inputAutoRequestNo"  maxlength="50" type="text"  
			  placeholder="Auto Request No" readonly="readonly" value="<?php if ($button=="add-mpr") {echo $NomorReq;} else {echo $tampildata['Request_No'];} ?>" />
              </span> </td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td><span class="form-group">Thema Name *</span></td>
              <td width="25%"><div class="form-group d-flex align-items-center justify-content-between mt-0 mb-1">
                <input class="form-control"  id="inputProjectName" name="inputProjectName" 
			  maxlength="50" type="text" placeholder="Enter Project Name"
			  value="<?php if ($_POST) { echo $inputProjectName; } else {echo $tampildata['Project_Name'];} ?>" 
			   <?php MPRDisable($tampildataWFMPR['Index_No'],$tampildataWFMPR['Index_Process'],'1'); ?>/>
                &nbsp;<button type="button" style="padding:2px 4px 4px 4px" 
			   class="btn btn-primary" title="Search Project Name"  
					name="btnsearch" 
					onClick="popupwindow('mpr/project-name-popup.php?id=mpr','Search Project Name','600','700');" 
					<?php MPRDisable($tampildataWFMPR['Index_No'],$tampildataWFMPR['Index_Process'],'1'); ?>/>
					<span class="glyphicon glyphicon-search" ></span> </button>
				</div>			  </td>
			  <td width="15%">&nbsp;</td>
			  <td width="30%"><input type="text" class="form-control" name="selectReq" id="selectReq" 
				  placeholder="FNIM Code"  onChange="get_detaildata()" onFocus="get_detaildata()"  
				  value="<?php if ($_POST) { echo $selectReq; } else {echo $tampildata['FNIM_Code'];} ?>"
				  readonly="readonly" >		      </td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td><span class="form-group">Category 2 [Type] * </span></td>
              <td><input class="form-control"  id="InputType" name="InputType" 
				  maxlength="50" type="text" placeholder="Enter Type"
				  value="<?php if ($_POST) { echo $InputType; } else {echo $tampildata['Type'];} ?>" 
				  <?php MPRDisable($tampildataWFMPR['Index_No'],$tampildataWFMPR['Index_Process'],'1'); ?>/>			  </td>
	          <td><span class="form-group">Category 4 [Market] *</span></td>
	          <td><select class="form-control" id="SelectTypeRequest" name="SelectTypeRequest" 
			  <?php MPRDisable($tampildataWFMPR['Index_No'],$tampildataWFMPR['Index_Process'],'1'); ?>>
			  	<option value="-">Select Market </option>
				<option value="Domestic" <?php if ($_POST) {echo $SelectTypeRequest;} elseif (@$tampildata['Type_Request']=='Domestic') 
				{echo "Selected"; }?>>Domestic</option>
				<option value="Export" <?php if (@$tampildata['Type_Request']=='Export') {echo "Selected";} ?>>Export</option>
				</select>			  </td>
			</tr>
            <tr>
              <td>&nbsp;</td>
              <td><span class="form-group">Category 6 [Brand] *</span></td>
              <td><input class="form-control"  id="InputBrand" name="InputBrand" 
			  	maxlength="50" type="text" placeholder="Enter Brand"
			 	value="<?php if ($_POST) { echo $InputBrand; } else {echo $tampildata['Brand'];} ?>" 
			   <?php MPRDisable($tampildataWFMPR['Index_No'],$tampildataWFMPR['Index_Process'],'1'); ?>/> </td>
	          <td width="15%"><span class="form-group">Category 7 [Bisnis]
              *</span>			  </td>
	          <td><input type="text" class="form-control" name="InputBisnis" id="InputBisnis" 
				placeholder="Enter Bisnis" 
				value="<?php if ($_POST) { echo $InputBisnis; } else {echo $tampildata['Bisnis'];} ?>" 
			   <?php MPRDisable($tampildataWFMPR['Index_No'],$tampildataWFMPR['Index_Process'],'1'); ?>  >			   </td>
			</tr>
            <tr>
              <td>&nbsp;</td>
              <td><span class="form-group">Category 8 [Category] *</span></td>
              <td><input class="form-control"  id="InputCategory" name="InputCategory" 
			  	maxlength="50" type="text" placeholder="Enter Category"
			  	value="<?php if ($_POST) { echo $InputCategory; } else {echo $tampildata['Category'];} ?>" 
				<?php MPRDisable($tampildataWFMPR['Index_No'],$tampildataWFMPR['Index_Process'],'1'); ?>/>			  </td>
	          <td width="15%"><span class="form-group">Category 9 [Series] *</span></td>
	          <td>
            	<input type="text" class="form-control" name="InputSeries" id="InputSeries" 
				placeholder="Enter Series"
				value="<?php if ($_POST) { echo $InputSeries; } else {echo $tampildata['Series'];} ?>" 
			    <?php MPRDisable($tampildataWFMPR['Index_No'],$tampildataWFMPR['Index_Process'],'1'); ?>>			   </td>
			</tr>
			<tr>
              <td>&nbsp;</td>
              <td><span class="form-group">Category 10 [Segmentation] *</span></td>
              <td><input type="text" class="form-control" name="InputSegmentation" id="InputSegmentation" 
				placeholder="Enter Segmentation"
				value="<?php if ($_POST) { echo $InputSegmentation; } else {echo $tampildata['Segmentation'];} ?>" 
			   <?php MPRDisable($tampildataWFMPR['Index_No'],$tampildataWFMPR['Index_Process'],'1'); ?>>			   </td>
              
              <td width="15%">&nbsp;</td>
	          <td>&nbsp;</td>
			</tr>
            <tr>
              <td>&nbsp;</td>
              <td><span class="form-group">Royalty Merk</span></td>
              <td colspan="2"><select class="form-control" id="selectCustomerCode" name="selectCustomerCode" 
			  <?php MPRDisable($tampildataWFMPR['Index_No'],$tampildataWFMPR['Index_Process'],'3'); ?>>
				<option value="-" >Select Royalty Merk</option>
				<?php
					include "../config/connect_sql.php";
					$query = "select Description from fdTradingPartne where TPType like 'ROYALTY%'";
					$exe = odbc_exec($myConnFlex,$query. " Order By Description Asc " );
					while($b = odbc_fetch_array($exe)){
						if($tampildata['CustomerCode'] == $b['Description']){
							$cek = 'Selected';
						}elseif($selectCustomerCode == $b['Description']){
							$cek = 'Selected';
						}else{
							$cek = '';
						}
						echo"<option value='".$b['Description']."' $cek>".$b['Description']."</option>";
					}
				?>
				</select> 
	          <td>
				<div class="form-group d-flex align-items-center justify-content-between mt-0 mb-1">
            	<input type="text" class="form-control" name="InputRoyalty" id="InputRoyalty" 
				placeholder="Enter %" maxlength="3" style="text-align:right;"
				onKeyPress="return angka(event)" 
				value="<?php if ($_POST) { echo $InputRoyalty; } else {echo $tampildata['Royalty'];} ?>"
				<?php MPRDisable($tampildataWFMPR['Index_No'],$tampildataWFMPR['Index_Process'],'3'); ?>> &nbsp;%</div>			  </td>
			</tr>
            <tr>
			  <td>&nbsp;</td>
              <td>Keterangan Product</td>
              <td colspan="3"><span class="form-group"> 
				<textarea rows="2" class="form-control py-2"  id="InputKeteranganProduct" name="InputKeteranganProduct" maxlength="100"
				placeholder="Enter Keterangan Product"
				<?php MPRDisable($tampildataWFMPR['Index_No'],$tampildataWFMPR['Index_Process'],'1'); ?>
				><?php if ($_POST) { echo $InputKeteranganProduct; } 
				else{echo $tampildata['KeteranganProduct'];} ?></textarea></span>				</td>
            </tr>
            <tr>
			<td width="1%">II.</td>
              <td colspan="4">
			  	<table name="fnimdetail" id="fnimdetail"  width="100%" border="1" class="table table-striped table-bordered table-hover" >
		  <tr>
					<td colspan="12" align="left"><strong>MPR Detail</strong></td>
				  </tr>
				  <tr valign="bottom" align="center" bgcolor="#999999">
					<th width="1%">No</th>
					<th width="20%">Product Name</th>
					<th width="2%">Netto</th>
					<th width="2%">Price</th>
					<th width="2%">Isi</th>
					<th width="6%">Secondary Packaging</th>
					<th width="2%">DZ/CT</th>
					<th width="2%">CT/CT</th>
					<th width="4%">UNIT</th>
					<th width="10%">Barcode Existing</th>
					<th width="5%">Code Product</th>
					<th width="10%">No. Barcode</th>
				  </tr>
					<?php
					$exe = mysqli_query($con,"SELECT a.ID_No,a.ID_NoFNIMDetail,b.Product_Name,b.Net,a.Price,a.Isi,a.UOM1,
					a.DZ_CT,a.CT_CT,a.UOM,a.Barcode_Existing,a.Code_Product,a.BARCODE,a.Index_No 
					FROM tb_mpr_detail a Inner Join tb_FNIM_detail b ON a.ID_NoFNIMDetail=b.ID_No 
					Where a.Request_No = '".$tampildata['Request_No']."'");
					if (mysqli_num_rows($exe) !=0 ) {
					$no = 1;
					while(@$rowMPRDetail =mysqli_fetch_array($exe)){
					?>
				  <tr id="<?php echo $rowMPRDetail['ID_No']; ?>">
					<td style="padding:15px 5px 5px 5px;"> <?php echo $no ; ?></td>
					<td style="padding:15px 5px 5px 5px;">
						<input type="hidden" name="tempID_No[]" id="tempID_No[]" value="<?php echo $rowMPRDetail['ID_No']; ?>">
						<?php echo $rowMPRDetail['Product_Name']; ?> </td>
					<td style="padding:15px 5px 5px 5px;"><?php echo $rowMPRDetail['Net']; ?> </td>
					<td style="padding:15px 5px 5px 5px;"><?php echo $rowMPRDetail['Price']; ?> </td>
					<td style="padding:15px 5px 5px 5px; text-align:right;"><?php echo $rowMPRDetail['Isi']; ?></td>
					<td style="padding:15px 5px 5px 5px;"><?php echo $rowMPRDetail['UOM1']; ?></td>
					<td style="padding:15px 5px 5px 5px; text-align:right;"> <?php echo $rowMPRDetail['DZ_CT']; ?> </td>
					<td style="padding:15px 5px 5px 5px; text-align:right;"> <?php echo $rowMPRDetail['CT_CT']; ?> </td>
					<td style="padding:15px 5px 5px 5px; "> <?php echo $rowMPRDetail['UOM']; ?> </td>
					<td style="padding:15px 5px 5px 5px; "> <?php echo $rowMPRDetail['Barcode_Existing']; ?> </td>
					<td style="padding:15px 5px 5px 5px;"><?php echo $rowMPRDetail['Code_Product']; ?></td>
					<td style="padding:15px 5px 5px 5px;"><?php echo $rowMPRDetail['BARCODE']; ?></td>
				  </tr>
				  <?php $no++;}} else { echo '				  <tr>
					<td colspan="12" align="center">Tidak ada data yang ditampilkan</td>
				  </tr>';}  ?>

				  </table>			
				 </td>
            </tr>
		    <tr>
              <td>III.</td>
              <td><span class="form-group">Royalty Formula</span></td>
              <td colspan="2"><select class="form-control" id="selectCustomerCodeFormula" name="selectCustomerCodeFormula" 
			  		<?php MPRDisable($tampildataWFMPR['Index_No'],$tampildataWFMPR['Index_Process'],'4'); ?>>

						<option value="-" >Select Royalty Formula</option>
						<?php
								include "../config/connect_sql.php";
								$query = "select Description from fdTradingPartne where TPType like 'ROYALTY%'";
								$exe = odbc_exec($myConnFlex,$query. " Order By Description Asc " );
								while($b = odbc_fetch_array($exe)){
									if($tampildata['CustomerCodeFormula'] == $b['Description']){
										$cek = 'Selected';
									}elseif($selectCustomerCode == $b['Description']){
										$cek = 'Selected';
									}else{
										$cek = '';
									}
									echo"<option value='".$b['Description']."' $cek>".$b['Description']."</option>";
								}
							?>
					  </select> 
	          <td>
				<div class="form-group d-flex align-items-center justify-content-between mt-0 mb-1">
            	<input type="text" class="form-control" name="InputRoyaltyFormula" id="InputRoyaltyFormula" 
				placeholder="Enter %" maxlength="3" style="text-align:right;"
				onKeyPress="return angka(event)"<?php MPRDisable($tampildataWFMPR['Index_No'],$tampildataWFMPR['Index_Process'],'4'); ?>
				value="<?php if ($_POST) { echo $InputRoyaltyFormula; } else {echo $tampildata['RoyaltyFormula'];} ?>"> &nbsp;%				</div>			  </td>
			</tr>
            <tr>
			  <td>IV.</td>
              <td colspan="4">
				<table name="fnimdetail" id="fnimdetail"  width="100%" border="1" class="table table-striped table-bordered table-hover" >
		  		  <tr>
					<td colspan="5" align="left"><strong>MPR Detail</strong></td>
				  </tr>
				  <tr valign="bottom" align="center" bgcolor="#999999">
					<th width="1%">No</th>
					<th width="20%">Product Name</th>
					<th width="2%">Netto</th>
					<th width="20%">Nama Produk Singkat</th>
					<th width="20%">Kelompok Stok</th>
				  </tr>
					<?php
					$exe = mysqli_query($con,"SELECT a.ID_No,a.ID_NoFNIMDetail,b.Product_Name,b.Net,a.Nama_Produk_Singkat,a.Kelompok_Stok 
					FROM tb_mpr_detail a Inner Join tb_FNIM_detail b ON a.ID_NoFNIMDetail=b.ID_No 
					Where a.Request_No = '".$tampildata['Request_No']."'");
					if (mysqli_num_rows($exe) !=0 ) {
					$no = 1;
					while(@$rowMPRDetail =mysqli_fetch_array($exe)){
					?>
				  <tr id="<?php echo $rowMPRDetail['ID_No']; ?>">
					<td style="padding:15px 5px 5px 5px;"> <?php echo $no ; ?></td>
					<td style="padding:15px 5px 5px 5px;">
						<input type="hidden" name="tempID_No[]" id="tempID_No[]" value="<?php echo $rowMPRDetail['ID_No']; ?>">
						<?php echo $rowMPRDetail['Product_Name']; ?> </td>
					<td style="padding:15px 5px 5px 5px;"><?php echo $rowMPRDetail['Net']; ?> </td>
					<td style="padding:15px 5px 5px 5px;"><?php echo $rowMPRDetail['Nama_Produk_Singkat']; ?> </td>
					<td style="padding:15px 5px 5px 5px;"><?php echo $rowMPRDetail['Kelompok_Stok']; ?></td>
				  </tr>
				  <?php $no++;}} else { echo '				  <tr>
					<td colspan="5" align="center">Tidak ada data yang ditampilkan</td>
				  </tr>';}  ?>
				  </table>			

			  </td>
            </tr>
            <tr>
			  <td></td>
              <td>Input Product Flex & SAP</td>
              <td colspan="3">
			  <label><input type="checkbox" name="Flex"  disabled
			  <?php if ($tampildata['Flex']==1) { echo 'checked="checked"';} ?>>
				1) Flexprocess</label> <br> 
                <label><input type="checkbox" name="SAP" disabled
				<?php if ($tampildata['SAP']==1) { echo 'checked="checked"';} ?>>
				2) SAP</label></td>
            </tr>
			<tr>
			<td>&nbsp;</td>
              <td colspan="4">
			  <table name="Attach" id="Attach"  width="100%" border="1" class="table table-striped table-bordered table-hover" >
			   
				  <tr>
					<td colspan="10" align="left"><strong>Attachment File (.pdf)</strong></td>
				  </tr>
				  <tr valign="bottom" align="center" bgcolor="#999999" >
					<th width="1%">No</th>
					<th width="35%">File</th>
					<th>Name</th>
				  </tr>
			 
			 	  <?php if ($button=="add-mpr") { ?> 
				  <tr>
					<td style="padding:15px 10px 5px 5px;">
					<input type="checkbox" name="chkdetail[]" id="chkdetail[]">
					<input type="hidden" name="TempFile[]" id="TempFile[]"></td>
					<td><input type="file" name="InputFile[]" id="InputFile[]" class="form-control"
						style="padding:2px 2px 2px 2px" OnChange="return validasiFile()" accept="application/pdf"></td>
					<td><input type="text" name="InputNameFile[]" id="InputNameFile[]" class="form-control" readonly="readonly"></td>
				  </tr>
					 <?php
					 } else {
					$exe = mysqli_query($con,"SELECT ID_No,File,Name,Index_No 
					FROM tb_fnim_file Where Request_No = '".$tampildata['Request_No']."'   ");
					$no = 1;
					while(@$rowmprFile =mysqli_fetch_array($exe)){
					?>
				  <tr id="<?php echo $rowMPRDetail['ID_No']; ?>">
					<td style="padding:15px 10px 5px 5px;"><?php echo $no;?></td>
					<td style="padding:10px 5px 5px 5px;">
					<?php if (!empty($rowmprFile['File'])){?>
			  	<img height="20" width="20" src=../img/pdf.png  title="Open File <?php echo $rowmprFile['File'];?>"
				onClick="popupwindow('../config/open-pdf.php?pdfname=<?php echo $rowmprFile['File'];?>&page=filempr','Preview Pdf','700','1000');">
			  	<?php }  ?>				</td>
					<td><input type="text" name="InputNameFile[]" id="InputNameFile[]" class="form-control"
						 value="<?php echo $rowmprFile['Name'];?>"  readonly="readonly"></td>
				  </tr>
				  <?php $no++;}} ?>
				  </table>			  </td>
			</tr>
			 <tr>
              <td>&nbsp;</td>
              <td>Remark *</td>
              <td colspan="3"><div class="form-group"> <textarea cols="4" id="inputRemark" name="inputRemark"  
			  class="form-control py-4" placeholder="Enter Remark" maxlength="100" readonly="readonly"><?php if ($_POST) { echo $inputRemark; } else {echo $tampildata['Remark'];} ?></textarea></div></td>
            </tr>            
		    </fieldset>
          </table>
		  <a class="btn btn-primary" href="../dist/index.php?button=status-req" title="Back status request">Back</a> 
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
        $('#mprdetail').DataTable({
            responsive: true
        });
    });
    </script>

		<!-- js untuk jquery -->
	<script src="../../js/jquery-1.11.2.min.js"></script>
	<!-- js untuk bootstrap -->
	<script src="../../js/bootstrap.js"></script>
	<!-- js untuk bootstrap datetimepicker -->
	<script src="../../js/bootstrap-select.min.js"></script>


 
 
	</body>
</html>
