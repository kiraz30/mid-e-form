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
<script type="text/javascript">
	function popupwindow(url, title, h, w) {
	var left = (screen.width/2)-(w/2);
	var top = (screen.height/2)-(h/2);
	return window.open(url, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
		  return false;
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
	
		<!-- Custom Fonts -->
		<link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    </head>
	<body onload='setFocus();' > 
	<main> 
    <div class="container-fluid"> 
      <h3 class="mt-4">New Request CFM</h3>
	    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="../dist/index.php?button=dashboard">Dashboard</a></li>
		<li class="breadcrumb-item"><a href="../dist/index.php?button=status-req">Checklist Final Manuscript (CFM)</a></li>
        <li class="breadcrumb-item active">New Request CFM</li>
      </ol>
 	<div class="card mb-4">
	    <div class="card-header"> </div>

        <div class="card-body"> 
			
        <?php
		include "cfm-autonumber.php";
      	$exe =mysqli_query($con,"SELECT a.ID_No,a.Index_Document,a.Request_No,a.Last_Request_No,a.Status_Last_Document,
			a.FNIM_Code,a.ID_No_FNIMDetail,d.Request_No AS MPR_Code, e.Code_Product,c.Product_Name,
			b.Type_Request,c.Status_Product, f.Country,a.Remark,a.Status_CFM,
			a.CreatedBy,date(a.CreatedDate) as Created_Date FROM tb_cfm a 
			INNER JOIN tb_fnim b ON a.FNIM_Code =b.Request_No
			INNER JOIN tb_fnim_detail c ON a.ID_No_FNIMDetail =c.ID_No
			LEFT JOIN tb_mpr d ON b.Request_No=d.FNIM_Code
			INNER JOIN tb_mpr_detail e ON d.Request_No=e.Request_No AND e.ID_NoFNIMDetail= c.ID_No
			INNER JOIN tb_trading_partner f ON d.Country=f.CustomerCode WHERE a.Request_No = '".@$_GET['id']."' ");
        $tampildata=mysqli_fetch_array($exe);
		$isinetto="";
		$exeNetto = mysqli_query($con,"SELECT  Request_No,  ID_No, Isi_Net, Netto,  Index_No 
		FROM tb_fnim_detail_netto   WHERE Request_No = '".@$tampildata['FNIM_Code']."' And
		tb_fnim_detail_netto='".@$tampildata['ID_No_FNIMDetail']."'  Order By ID_No Asc");
		while(@$rowFNIMDetailNetto =mysqli_fetch_array($exeNetto)){ 
			$isinetto=$isinetto.@$rowFNIMDetailNetto['Isi_Net']." ".@$rowFNIMDetailNetto['Netto'].", ";
		} 
		//echo substr($isinetto,0,-2)
		//________________________________________________________________________________WORK FLOW Back PROCESS
		$exeWFBP = mysqli_query($con,"SELECT WorkFlowMenu,Index_No,NameApproval,OnBehalf,StatusWorkFlow FROM tb_workflownprf 
		WHERE (NameApproval='$username' or OnBehalf ='$username') And Request_No = '".@$_GET['id']."' AND StatusWorkFlow IS null");
        $tampildataWFBR=mysqli_fetch_array($exeWFBP);
		$BackStep_Index= @$tampildataWFBR['Index_No']-1;
		//________________________________________________________________________________
        
	  	?>
	<form name="fnim"  id="fnim" action="" method="post"  enctype="multipart/form-data"  >
    <?php 
	//Begin CRUD----------------------------------------------------------------------
	if($_POST){
		$file	 				= "../file/";
		$ip						= $_SERVER['REMOTE_ADDR'];
		$hostname 				= gethostbyaddr($_SERVER['REMOTE_ADDR']);
		date_default_timezone_set("Asia/Jakarta");
		$createddate			=date("Y-m-d H:i:s");
    	$tempFormatNoRequest  	= $_POST['tempFormatNoRequest'];
		$inputAutoRequestNo		= $_POST['inputAutoRequestNo'];
		$inputLastRequestNo		= @$_POST['inputLastRequestNo'];
		$InputMPRCode			= @$_POST['InputMPRCode'];
		$InputTempMPRCode		= @$_POST['InputTempMPRCode'];
		$inputID_No_MPR_Detail	= @$_POST['inputID_No_MPR_Detail'];
		$inputProductCode 	 	= @$_POST['inputProductCode']; 
		$inputProductName	 	= @$_POST['inputProductName'];
		$inputNetto			 	= @$_POST['inputNetto'];
		$inputCountry			= @$_POST['inputCountry'];
		$InputStatus			= @$_POST['InputStatus'];
		$inputRemark			= @$_POST['inputRemark'];
		$inputWorkflowRemark	= @$_POST['inputWorkflowRemark'];
		$inputProductName		= @$_POST['inputProductName'];}
		//End CRUD----------------------------------------------------------------------
	
		?>
          <table width="100%" border="0" class="table table-striped" id="dataTables-example" >
            <tr>
              <td width="20%"><span class="form-group">Request No</span></td>
              <td colspan="2"><span class="form-group">
				<input name="tempFormatNoRequest" type="hidden" value="<?php echo $tampildata['Request_No']; ?>">
                <input class="form-control py-4"  name="inputAutoRequestNo" id="inputAutoRequestNo"  maxlength="50" type="text"  
			  placeholder="Auto Request No" readonly="readonly" value="<?php if ($button=="add-cfm") {echo $NomorReq;} else {echo $tampildata['Request_No'];} ?>" />
              </span> </td>
            </tr>
            <tr>
              <td><span class="form-group">FNIM Request No *</span></td>
              <td colspan="2"><span class="form-group d-flex align-items-center justify-content-between mt-0 mb-1">
                <input type="text" class="form-control" name="InputFNIMCode" id="InputFNIMCode" 
				placeholder="Master Prodcut Request No" 
				value="<?php if ($_POST) { echo $InputFNIMCode; } else {echo @$tampildata['FNIM_Code'];} ?>" 
				disabled="disabled" >
              </span></td>
            </tr>
            <tr>
              <td>Product Code *</td>
              <td colspan="2"><input class="form-control py-4"  name="inputProductCode" id="inputProductCode"  maxlength="50" type="text"  
			  	placeholder="Enter Product Code" disabled="disabled" 
			  	value="<?php  if ($tampildata['Code_Product']=='') {echo "XXXXXX";} else {echo $tampildata['Code_Product'];}?>" /></td>
		    </tr>
			<tr>
			  <td>Product Name *</td>
              <td colspan="2"><span class="form-group">
                <input class="form-control py-4" name="inputProductName" id="inputProductName" 
				maxlength="50" type="text" placeholder="Enter Product Name"  
				value="<?php if ($_POST) { echo $inputProductName; } else {echo @$tampildata['Product_Name'];} ?>"
				disabled="disabled" >
              </span></td>
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
				<input class="form-control py-4" name="inputCountry" id="inputCountry" 
				maxlength="50" type="text" placeholder="Enter Country"  
				value="<?php if ($_POST) { echo $inputCountry; } else {echo @$tampildata['Country'];} ?>"
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
			   </t
	><tr>
              <td colspan="3"><table name="Attach" id="Attach"  width="100%" border="1" class="table table-striped table-bordered table-hover" >
                <tr>
                  <td colspan="10" align="left"><strong>Attachment File (.pdf)</strong></td>
                </tr>
                <tr valign="bottom" align="center" bgcolor="#999999" >
                  <th width="3%"></th>
                  <th width="15%">Gambar</th>
                  <th width="15%">Kemasan</th>
                  <th width="15%">Posisi</th>
                  <th width="1%">History</th>
                </tr>
                <?php
					$exe = mysqli_query($con,"SELECT ID_No,File,Kemasan,Posisi,Index_No 
					FROM tb_cfm_file Where Request_No = '".$tampildata['Request_No']."'   ");
					$no = 1;
					if (mysqli_num_rows($exe) !=0 ) {
					while(@$rowCFMFile =mysqli_fetch_array($exe)){
					?>
                <tr>
                  <td><?php echo $no;?></td>
                  <td><input type="hidden" name="tempfileid[]" id="tempfileid[]" value="<?php echo $rowCFMFile['ID_No'];?>">
                      <?php if (!empty($rowCFMFile['File'])){?>
                      <img src="../img/Attachment_Image/<?php echo $rowCFMFile['File'];?>"
					   class="img-fluid" width="100" onClick="popupwindow('../config/popup-img.php?id=<?php echo $rowCFMFile['ID_No'];?>&name=<?php echo $rowCFMFile['File'];?>&pg=filecfm','Preview Pdf','700','1000');">
                      <?php  }  ?>
                  </td>
                  <td><?php echo $rowCFMFile['Kemasan'];?></td>
                  <td><?php echo $rowCFMFile['Posisi'];?></td>
                  <<td align="justify"> 
				<button  type="button"  class="btn btn-primary"
		 onClick="popupwindow('../dist/page.php?form=cfm-comment&id=<?php echo $rowCFMFile['ID_No'];?>&pg=cfm-comment','CFM','400','1000');">History</button>	</td>
                </tr>
                <?php $no++;}}else {echo "<tr><td colspan='6' align='center'>Tidak Ada data yang ditampilkan</td></tr>";} ?>
              </table></td>
			</tr>
            <tr>
              <td>Remark *</td>
              <td colspan="2"><div class="form-group"> <textarea cols="4" id="inputRemark" name="inputRemark"  
			  class="form-control py-4" placeholder="Enter Remark" disabled="disabled" 
			  maxlength="100"><?php if ($_POST) { echo $inputRemark; } else {echo $tampildata['Remark'];} ?></textarea></div>			  </td>
			</tr>
          </table>
		<a class="btn btn-primary" href="../dist/index.php?button=status-req" title="Back Status Request">Back</a> 
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
 
	</body>
</html>
