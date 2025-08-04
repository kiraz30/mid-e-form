
	<?php $Save		= @$_POST['Save']; ?>
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
		document.mpr.selectSizeofProduct.focus();
	}
	function DisplayShowHide(){
		if (document.mpr.selectSizeofProduct.value == "Ø"){
			document.mpr.inputSizeofProduct_P.disabled = true ;
			document.mpr.inputSizeofProduct_P.value =="" ;
			document.mpr.inputSizeofProduct_L.placeholder="Enter D" ;
			document.mpr.inputSizeofProduct_L.focus() ;
			
		}else{
			document.mpr.inputSizeofProduct_P.disabled = false;
			document.mpr.inputSizeofProduct_P.value =="" ;
			document.mpr.inputSizeofProduct_L.placeholder="Enter L" ;
			document.mpr.inputSizeofProduct_P.focus() ;
			
			
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

<!--?php include "mpr-javascrift.php"; ?-->

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
      <h3 class="mt-4">Edit Specification Product</h3>
	    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="../dist/index.php?button=dashboard">Dashboard</a></li>
		<li class="breadcrumb-item"><a href="../dist/index.php?button=spec-product">Specification Product</a></li>
        <li class="breadcrumb-item active">Edit Specification Product </li>
      </ol>
 	<div class="card mb-4">
	    <div class="card-header"> </div>
    <div class="card-body"> 
			
        <?php
		include "../config/connect_sql.php";
      	$exe =mysqli_query($con,"SELECT d.ID_No,a.Request_No,b.ID_No AS ID_NoMPRDetail,c.Request_No AS FNIM_Code,c.ID_No AS ID_NoFNIMDetail,
		DATE_FORMAT(d.Launching, '%m') Bulan,DATE_FORMAT(d.Launching, '%Y') Tahun,
		a.Type_Request,b.Code_Product,b.BARCODE,c.Product_Name,
		d.Description AS Description_SP,d.Notifikasi_BPOM,d.Product_Image,
		d.SizeOfProduct,d.SizeOfProduct_P,d.SizeOfProduct_L,d.SizeOfProduct_T,d.SizeOfProduct_Satuan,
		d.InnerPack_P,d.InnerPack_L,d.InnerPack_T,d.InnerPack_Satuan,
		d.SizeOfCartton_IS_P,d.SizeOfCartton_IS_L,d.SizeOfCartton_IS_T,d.SizeOfCartton_IS_Satuan,
		d.SizeOfCartton_OS_P,d.SizeOfCartton_OS_L,d.SizeOfCartton_OS_T,d.SizeOfCartton_OS_Satuan,
		d.DznCtn,d.DznCtn_Keterangan,d.WeighOfContenCtn
		FROM tb_mpr a INNER JOIN tb_mpr_detail b
		ON a.Request_No=b.Request_No INNER JOIN tb_fnim_detail c on a.FNIM_Code=c.Request_No and  b.ID_NoFNIMDetail=c.ID_No
		LEFT JOIN tb_spec_product d on a.Request_No=d.MPR_Code AND b.ID_No=d.ID_NoMPRDetail
		where b.ID_No = '".@$_GET['id']."' ");
        $tampildata=mysqli_fetch_array(@$exe);
		$statusReqMPR=@$tampildata['Status_MPR'];      
		if ($level=='ADMINISTRATOR') {$readonlyMS=''; $readonlyReg='' ; $readonlyLMF='';$readonlyQC='';$readonlyPCD='';}
		
		else if ($level=='USER') {
			if ($divisioncode=='21MS3')  {$readonlyMS='';} else  {$readonlyMS='readonly="readonly"';} //Marketing Support
			if ($divisioncode=='21FMR2') {$readonlyReg='';} else  {$readonlyReg='readonly="readonly"';} //Registrasi
			if ($divisioncode=='21FC3' || $divisioncode=='21LCM3' || $divisioncode=='21MC4') {$readonlyLMF='';} else  {$readonlyLMF='disabled="disabled"';} //Ladys,Male Female Strategic Advertising
			if ($divisioncode=='QC1100') {$readonlyQC='';} else  {$readonlyQC='readonly="readonly"';} //QC
			if ($divisioncode=='PCD1100' || $divisioncode=='PCD2100') {$readonlyPCD='';} else  {$readonlyPCD='readonly="readonly"';} //Packaging Development Male Female
		}
		?>
	<form name="mpr" id="mpr" action="" method="post"  enctype="multipart/form-data"  >
    <?php 
	//Begin CRUD----------------------------------------------------------------------
	$datenow						= date("Y-m-d");
	$uploadDirFileSpec_Product	= "../img/Spec_Product/";

	if($_POST){
		$ip								=$_SERVER['REMOTE_ADDR'];
		$hostname 						= gethostbyaddr($_SERVER['REMOTE_ADDR']);
		date_default_timezone_set("Asia/Jakarta");
		$createddate					=date("Y-m-d H:i:s");
    	$tempMPR						= $_POST['tempMPR'];
		$tempMPRDetail	 	 			= @$_POST['tempMPRDetail']; 
		$tempMPRFNIM		 			= @$_POST['tempMPRFNIM'];
		$tempFNIMDetail					= @$_POST['tempFNIMDetail'];
		$inputAutoRequestNo				= @$_POST['inputAutoRequestNo'];
		$inputProductCode				= @$_POST['inputProductCode'];
		$inputProductName				= @$_POST['inputProductName'];
		$inputBarcode		 			= @$_POST['inputBarcode'];
		$Selectbulan					= @$_POST['Selectbulan'];
		$SelectTahun					= @$_POST['SelectTahun'];
		$inputProductShortDescription	= @$_POST['inputProductShortDescription'];
		
		$namaFile	  					= @$_FILES['Inputfile']['name'];
		$xFile							= explode('.', $namaFile);
		$ekstensiFile    				= strtolower(end($xFile));
		$ukuranFile						= @$_FILES['Inputfile']['size'];
		$file_tmpFile		 			= @$_FILES['Inputfile']['tmp_name'];			
	

		$inputNotificationBPOM			= @$_POST['inputNotificationBPOM'];
		
		$selectSizeofProduct		 	= @$_POST['selectSizeofProduct'];
		$inputSizeofProduct_P		 	= @$_POST['inputSizeofProduct_P'];
		$inputSizeofProduct_L		 	= @$_POST['inputSizeofProduct_L'];
		$inputSizeofProduct_T		 	= @$_POST['inputSizeofProduct_T'];
		$inputSizeOfProduct_Satuan		= @$_POST['inputSizeOfProduct_Satuan'];
		
		$inputInnerPack_P				= @$_POST['inputInnerPack_P'];
		$inputInnerPack_L				= @$_POST['inputInnerPack_L'];
		$inputInnerPack_T				= @$_POST['inputInnerPack_T'];
		$inputInnerPack_Satuan			= @$_POST['inputInnerPack_Satuan'];
		
		$inputSizeOfCartton_IS_P		= @$_POST['inputSizeOfCartton_IS_P'];
		$inputSizeOfCartton_IS_L		= @$_POST['inputSizeOfCartton_IS_L'];
		$inputSizeOfCartton_IS_T		= @$_POST['inputSizeOfCartton_IS_T'];
		$inputSizeOfCartton_IS_Satuan	= @$_POST['inputSizeOfCartton_IS_Satuan'];
		
		$inputSizeOfCartton_OS_P		= @$_POST['inputSizeOfCartton_OS_P'];
		$inputSizeOfCartton_OS_L		= @$_POST['inputSizeOfCartton_OS_L'];
		$inputSizeOfCartton_OS_T		= @$_POST['inputSizeOfCartton_OS_T'];
		$inputSizeOfCartton_OS_Satuan	= @$_POST['inputSizeOfCartton_OS_Satuan'];
		
		$inpuDsn_Ctn				 	= @$_POST['inpuDsn_Ctn'];
		$inpuDsnCtn_Keterangan			= @$_POST['inpuDsnCtn_Keterangan'];
		$inputWeightofContent		 	= @$_POST['inputWeightofContent'];


		if($Save=="Save"){
			$Tanya = mysqli_query($con,"SELECT * FROM tb_spec_product 
			WHERE MPR_Code = '$inputAutoRequestNo' And ID_NoMPRDetail='$tempMPRDetail' 
			And FNIM_Code='$tempMPRFNIM' And ID_NoFNIMDetail='$tempFNIMDetail'");
			if (mysqli_num_rows($Tanya) ==0 ) {  
				include "spec-product-save.php";
				echo"<script>  window.location='../dist/index.php?button=spec-product'; </script>";
			}else{
				include "spec-product-edit.php";
				echo"<script>  window.location='../dist/index.php?button=spec-product'; </script>";
			}
		}
	}
		//End CRUD----------------------------------------------------------------------
	?>
        <table width="100%" border="0" class="table table-striped" id="dataTables-example" >
            <tr>
				<td width="1%"><span class="form-group">I.</span></td>
				<td width="20%"><span class="form-group">Master Product Request No</span></td>
				<td colspan="3"><span class="form-group">
					<input name="tempMPR" type="hidden" value="<?php echo @$tampildata['Request_No']; ?>">
					<input name="tempMPRDetail" type="hidden" value="<?php echo @$tampildata['ID_NoMPRDetail']; ?>">
					<input name="tempMPRFNIM" type="hidden" value="<?php echo @$tampildata['FNIM_Code']; ?>">
					<input name="tempFNIMDetail" type="hidden" value="<?php echo @$tampildata['ID_NoFNIMDetail']; ?>">
					<input class="form-control py-4"  name="inputAutoRequestNo" id="inputAutoRequestNo"  maxlength="50" type="text"  
					placeholder="Auto Request No" readonly="readonly" value="<?php echo $tampildata['Request_No']; ?>" />
				</span>
				</td>
            </tr>
			<tr>
				<td width="1%"><span class="form-group"></span></td>
				<td><span class="form-group">Product Code</span></td>
				<td colspan="3">
					<span class="form-group"> 
						<input class="form-control py-0"  name="inputProductCode" id="inputProductCode"  
						maxlength="50" type="text" readonly="readonly" value="<?php echo $tampildata['Code_Product']; ?>" />
					</span>
				</td>
            </tr>
			<tr>
				<td width="1%"><span class="form-group"></span></td>
				<td><span class="form-group">Product Name</span></td>
				<td colspan="3">
					<span class="form-group"> 
						<input class="form-control py-4"  name="inputProductName" id="inputProductName" 
						maxlength="50" type="text" readonly="readonly" value="<?php echo $tampildata['Product_Name']; ?>" />
					</span>
				</td>
            </tr>
			<tr>
				<td><span class="form-group"></span></td>
				<td><span class="form-group">Barcode</span></td>
				<td colspan="3">
					<span class="form-group"> 
						<input class="form-control py-4"  name="inputBarcode" id="inputBarcode" 
						maxlength="50" type="text" readonly="readonly" value="<?php echo $tampildata['BARCODE']; ?>" />
					</span>
				</td>
            </tr>
			<tr>
				<td width="1%"><span class="form-group"></span></td>
				<td><span class="form-group">Launching</span></td>
				<td width="">

				<div class="form-group d-flex align-items-center justify-content-between mt-0 mb-0">
				<select name="Selectbulan" id="Selectbulan"  title="Bulan Launching" class="form-control" <?php echo $readonlyMS; ?>>
				<option value="">Bulan</option>
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
				<select name="SelectTahun" id="SelectTahun" title="Tahun Launching" class="form-control"   <?php echo $readonlyMS; ?>>
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
				<td width="1%"><span class="form-group"></span></td>
				<td><span class="form-group">Product Short Description</span></td>
				<td colspan="3"><span class="form-group"> <textarea cols="4" id="inputProductShortDescription" 
					name="inputProductShortDescription"  class="form-control py-4" 
					placeholder="Enter Product Short Description" <?php echo $readonlyMS; ?>
					maxlength="200"><?php if ($_POST) { echo $inputProductShortDescription; } else {echo @$tampildata['Description_SP'];} ?></textarea>
				</div></td>
            </tr>
			<tr>
			  <td colspan="5">&nbsp;</td>
			</tr>
			<tr>
				<td><span class="form-group">II.</span></td>
				<td><span class="form-group">Product Image</span></td>
				<td colspan="3"> <input  type="file" id="Inputfile" name="Inputfile"  <?php echo $readonlyLMF; ?> > 
				<?php if (!empty($tampildata['Product_Image'])){?>
			<img height="40" width="40" src="../img/<?php echo $uploadDirFileSpec_Product."/".$tampildata['Product_Image'];?>"
			title="Open File <?php echo $tampildata['Product_Image'];?>"
			onClick="popupwindow('../config/popup-img.php?id=<?php echo $tampildata['ID_No'];?>&name=<?php echo $tampildata['Product_Image'];?>&pg=fileSpecProduct','Preview Image','700','1000');"> <?php echo $tampildata['Product_Image'];} ?>

				
				</td>
            </tr>
			<tr>
			  <td colspan="5">&nbsp;</td>
			</tr>
			<tr>
				<td width="1%"><span class="form-group">III.</span></td>
				<td><span class="form-group">Notification BPOM</span></td>
				<td colspan="3"><span class="form-group">
					<input class="form-control py-4"  name="inputNotificationBPOM" id="inputNotificationBPOM"  
					maxlength="50" type="text"  <?php echo $readonlyReg; ?>
					placeholder="Notification BPOM" value="<?php echo $tampildata['Notifikasi_BPOM']; ?>" />
					</span>
				</td>
            </tr>
			<tr>
			  <td colspan="5">&nbsp;</td>
			</tr>
			<tr>
				<td width="1%"><span class="form-group">IV.</span></td>
				<td><span class="form-group">Size of Product</span></td>
				<td colspan="3">
					<span class="form-row"> 
						<span class="col-md-8"> 
							<span class="form-group">
								<div class="form-group d-flex align-items-center justify-content-between mt-0 mb-0">
									<select class="form-control" id="selectSizeofProduct" name="selectSizeofProduct"
									<?php echo $readonlyPCD; ?> onChange="DisplayShowHide()" 
										onFocus=" DisplayShowHide()" >
										<option value="" <?php if (@$tampildata['SizeOfProduct']=='')  {echo "Selected"; }?> ></option>
										<option value="Ø"<?php if (@$tampildata['SizeOfProduct']=='Ø') {echo "Selected"; }?> >Ø</option>
									</select> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
									<input class="form-control py-4"  name="inputSizeofProduct_P" id="inputSizeofProduct_P"  
									maxlength="50" type="text" <?php echo $readonlyPCD;?>  onKeyUp="return angka(this);"
									placeholder="Enter P" value="<?php echo $tampildata['SizeOfProduct_P']; ?>" />
									 &nbsp;&nbsp;X&nbsp;&nbsp;  
									<input class="form-control py-4"  name="inputSizeofProduct_L" id="inputSizeofProduct_L"  
									maxlength="50" type="text" <?php echo $readonlyPCD; ?> onKeyUp="return angka(this);"
									placeholder="Enter L" value="<?php echo $tampildata['SizeOfProduct_L']; ?>" />
									&nbsp;&nbsp;X&nbsp;&nbsp; 
									<input class="form-control py-4"  name="inputSizeofProduct_T" id="inputSizeofProduct_T"  
									maxlength="50" type="text"   <?php echo $readonlyPCD; ?> onKeyUp="return angka(this);"
									placeholder="Enter T" value="<?php echo $tampildata['SizeOfProduct_T']; ?>" />
								</div>
							</span>
						</span>	
						<span class="col-md-2"> 
							<span class="form-group"> 
								<select class="form-control" id="inputSizeOfProduct_Satuan"  
								name="inputSizeOfProduct_Satuan" <?php echo $readonlyPCD; ?> >
									<option value="mm" <?php if (@$tampildata['SizeOfProduct_Satuan']=='mm') {echo "Selected"; }?>>mm</option>
									<option value="cm" <?php if (@$tampildata['SizeOfProduct_Satuan']=='cm') {echo "Selected"; }?>>cm</option>
								</select> 			  		 
							</span>				  
						</span>
					</span>		
			  </td>
            </tr>
			<tr>
				<td width="1%"><span class="form-group"></span></td>
				<td width="15%"><span class="form-group">Inner Pack</span></td>
				<td colspan="3">
					<span class="form-row"> 
						<span class="col-md-6"> 
							<span class="form-group">
								<div class="form-group d-flex align-items-center justify-content-between mt-0 mb-0">
									<input class="form-control py-4"  name="inputInnerPack_P" id="inputInnerPack_P"  
									maxlength="50" type="text"  <?php echo $readonlyPCD; ?>  onKeyUp="return angka(this);"
									placeholder="Enter P" value="<?php echo $tampildata['InnerPack_P']; ?>" />
									 &nbsp;&nbsp;X&nbsp;&nbsp;  
									<input class="form-control py-4"  name="inputInnerPack_L" id="inputInnerPack_L"  
									maxlength="50" type="text"   <?php echo $readonlyPCD; ?> onKeyUp="return angka(this);"
									placeholder="Enter L" value="<?php echo $tampildata['InnerPack_L']; ?>" />
									&nbsp;&nbsp;X&nbsp;&nbsp; 
									<input class="form-control py-4"  name="inputInnerPack_T" id="inputInnerPack_T"  
									maxlength="50" type="text"   <?php echo $readonlyPCD; ?> onKeyUp="return angka(this);"
									placeholder="Enter T" value="<?php echo $tampildata['InnerPack_T']; ?>" />
								</div>
							</span>
						</span>	
						<span class="col-md-2"> 
							<span class="form-group"> 
								<select class="form-control" id="inputInnerPack_Satuan" 
								name="inputInnerPack_Satuan"  <?php echo $readonlyPCD; ?>>
									<option value="mm" <?php if (@$tampildata['InnerPack_Satuan']=='mm') {echo "Selected"; }?>>mm</option>
									<option value="cm" <?php if (@$tampildata['InnerPack_Satuan']=='cm') {echo "Selected"; }?>>cm</option>
								</select> 			  		 
							</span>				  
						</span>
					</span>		
			  </td>
            </tr>
			
			<td width="1%"></td>
              <td colspan="4">
			  	Size of Carton			  
			  </td>
            </tr>
            <tr>
				<td width="1%"><span class="form-group"></span></td>
				<td width="15%"><span class="form-group">Inner Pack</span></td>
				<td colspan="3">
					<span class="form-row"> 
						<span class="col-md-6"> 
							<span class="form-group">
								<div class="form-group d-flex align-items-center justify-content-between mt-0 mb-0">
									<input class="form-control py-4"  name="inputSizeOfCartton_IS_P" id="inputSizeOfCartton_IS_P"  
									maxlength="50" type="text"   <?php echo $readonlyPCD; ?> onKeyUp="return angka(this);"
									placeholder="Enter P" value="<?php echo $tampildata['SizeOfCartton_IS_P']; ?>" />
									 &nbsp;&nbsp;X&nbsp;&nbsp;  
									<input class="form-control py-4"  name="inputSizeOfCartton_IS_L" id="inputSizeOfCartton_IS_L"  
									maxlength="50" type="text"   <?php echo $readonlyPCD; ?> onKeyUp="return angka(this);"
									placeholder="Enter L" value="<?php echo $tampildata['SizeOfCartton_IS_L']; ?>" />
									&nbsp;&nbsp;X&nbsp;&nbsp; 
									<input class="form-control py-4"  name="inputSizeOfCartton_IS_T" id="inputSizeOfCartton_IS_T"  
									maxlength="50" type="text"   <?php echo $readonlyPCD; ?> onKeyUp="return angka(this);"
									placeholder="Enter T" value="<?php echo $tampildata['SizeOfCartton_IS_T']; ?>" />
								</div>
							</span>
						</span>	
						<span class="col-md-2"> 
							<span class="form-group"> 
								<select class="form-control" id="inputSizeOfCartton_IS_Satuan" 
								name="inputSizeOfCartton_IS_Satuan"  <?php echo $readonlyPCD; ?>>
									<option value="mm" <?php if (@$tampildata['SizeOfCartton_IS_Satuan']=='mm') {echo "Selected"; }?>>mm</option>
									<option value="cm" <?php if (@$tampildata['SizeOfCartton_IS_Satuan']=='cm') {echo "Selected"; }?>>cm</option>
								</select> 			  		 
							</span>				  
						</span>
					</span>		
			  </td>
            </tr>
			<tr>
				<td width="1%"><span class="form-group"></span></td>
				<td width="15%"><span class="form-group">Outer Size</span></td>
				<td colspan="3">
					<span class="form-row"> 
						<span class="col-md-6"> 
							<span class="form-group">
								<div class="form-group d-flex align-items-center justify-content-between mt-0 mb-0">
									<input class="form-control py-4"  name="inputSizeOfCartton_OS_P" id="inputSizeOfCartton_OS_P"  
									maxlength="50" type="text"  <?php echo $readonlyPCD; ?>  onKeyUp="return angka(this);"
									placeholder="Enter P" value="<?php echo $tampildata['SizeOfCartton_OS_P']; ?>" />
									 &nbsp;&nbsp;X&nbsp;&nbsp;  
									<input class="form-control py-4"  name="inputSizeOfCartton_OS_L" id="inputSizeOfCartton_OS_L"  
									maxlength="50" type="text"   <?php echo $readonlyPCD; ?> onKeyUp="return angka(this);"
									placeholder="Enter L" value="<?php echo $tampildata['SizeOfCartton_OS_L']; ?>" />
									&nbsp;&nbsp;X&nbsp;&nbsp; 
									<input class="form-control py-4"  name="inputSizeOfCartton_OS_T" id="inputSizeOfCartton_OS_T"  
									maxlength="50" type="text"   <?php echo $readonlyPCD; ?> onKeyUp="return angka(this);"
									placeholder="Enter T" value="<?php echo $tampildata['SizeOfCartton_OS_T']; ?>" />
								</div>
							</span>
						</span>	
						<span class="col-md-2"> 
							<span class="form-group"> 
								<select class="form-control" id="inputSizeOfCartton_OS_Satuan" 
								name="inputSizeOfCartton_OS_Satuan"  <?php echo $readonlyPCD; ?> >
									<option value="mm" <?php if (@$tampildata['SizeOfCartton_OS_Satuan']=='mm') {echo "Selected"; }?>>mm</option>
									<option value="cm" <?php if (@$tampildata['SizeOfCartton_OS_Satuan']=='cm') {echo "Selected"; }?>>cm</option>
								</select> 			  		 
							</span>				  
						</span>
					</span>		
			  </td>
            </tr>
			<tr>
				<td width="1%"><span class="form-group"></span></td>
				<td><span class="form-group">Dzn / Ctn</span></td>
				<td colspan="3">
					<span class="form-row"> 
						<span class="col-md-2"> 
							<span class="form-group">
								<div class="form-group d-flex align-items-center justify-content-between mt-0 mb-0">
									<input class="form-control py-4"  name="inpuDsn_Ctn" id="inpuDsn_Ctn"  
									maxlength="50" type="text"   <?php echo $readonlyPCD; ?>
									placeholder="Dzn" value="<?php echo $tampildata['DznCtn']; ?>" />
								</div>
							</span>
						</span>
						&nbsp;&nbsp;Keterangan&nbsp;&nbsp;  
						<span class="col-md-8"> 
							<span class="form-group"> 
								<input class="form-control py-4"  name="inpuDsnCtn_Keterangan" id="inpuDsnCtn_Keterangan"  
									maxlength="50" type="text"  <?php echo $readonlyPCD; ?> 
									placeholder="Keterangan" value="<?php echo $tampildata['DznCtn_Keterangan']; ?>" /> 			  		 
							</span>				  
						</span>
					</span>
				</td>
            </tr>
			
			<tr>
			  <td colspan="5">&nbsp;</td>
			</tr>
			 
            <tr>
			  <td width="1%"><span class="form-group">V.</span></td>
              <td>Weight of Content / Carton </td>
              <td colspan="3"><div class="form-group">
				<input class="form-control py-4"  name="inputWeightofContent" id="inputWeightofContent"  
				maxlength="50" type="text"  <?php echo $readonlyQC; ?> 
				placeholder="Enter Weight of Content / Carton" value="<?php echo $tampildata['WeighOfContenCtn']; ?>" /></div></td>
            </tr>
			 <tr>
			  <td colspan="5">&nbsp;</td>
			</tr>
          </table>
		  
		  <button type="submit" name="Save" value="Save" onclick="return checkEdit(mpr)"
		  class="btn btn-primary">Save </button>

		  <a class="btn btn-primary" href="../dist/index.php?button=spec-product" title="Back Format No Request">Back</a> 
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

	<script language="JavaScript" type="text/javascript">
	function checkEdit(form){
	if (form.inputAutoRequestNo.value == ""){
    	alert("Master Product Request No Can not be empty *");
    	form.inputAutoRequestNo.focus();
    	return (false);  		}
	else if (form.inputProductCode.value == ""){
    	alert("Product Code Can not be empty *");
    	form.inputProductCode.focus();
    	return (false);  		}
	else if (form.inputProductName.value == ""){
    	alert("Product Name Can not be empty *");
    	form.inputProductName.focus();
    	return (false);  		}
		
	else if (form.inputBarcode.value == ""){
    	alert("Barcode Can not be empty *");
    	form.inputBarcode.focus();
    	return (false);  		}
		
		return confirm('Are you sure you want to save data?');
	}
	
	
	
	
	
	</script>
	

		<!-- js untuk jquery -->
	<script src="../../js/jquery-1.11.2.min.js"></script>
	<!-- js untuk bootstrap -->
	<script src="../../js/bootstrap.js"></script>
	<!-- js untuk bootstrap datetimepicker -->
	<script src="../../js/bootstrap-select.min.js"></script>

 
 
	 

	</body>
</html>
