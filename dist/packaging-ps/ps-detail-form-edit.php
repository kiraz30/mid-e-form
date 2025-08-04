<?php 

	include "../../config/conn.php";
	include "../../config/connect.php";
	include "../../config/connect_sql.php";
	$Approve_No		= @$_POST['data3'];
	$indexProcess	= @$_POST['data4'];
	$indexNo		= @$_POST['data5'];
	$InputMPRCode	= @$_POST['InputMPRCode'];
	$Divisi			= @$_POST['data6'];
	$tempFinish_Good_Code=@$_POST['tempFinish_Good_Code'];
	$query="SELECT a.Request_No,a.Status_Spec
	FROM  tb_packdev_spec a
	WHERE a.Request_No = '".@$_POST['AutoRequestNo']."' ";
	$exe =mysqli_query($con,$query);
	$tampilHeaderData=mysqli_fetch_array($exe);
	//________________________________________________________________________________Status ps disabled

	if (@$tampilHeaderData['Status_Spec']<>"Draft" & @$tampilHeaderData['Status_Spec']<>""
	& @$tampilHeaderData['Status_Spec']<>"Revise" )
	  {$disabled="disabled";} else{$disabled="";}
	if (@$_POST['getDetail']<>"")
		{$required="required";} else{$required="";}


	$query="SELECT b.ID_No,a.Request_No, a.ARM_Code,a.MPR_Code,a.Finish_Good_Code,a.Status_Spec,
	b.ID_No_Resource_Detail,b.Packaging_Material,b.Packaging_Material_Name,b.SAP_Code,b.Batch_Size_Lower,
	b.Batch_Size_Upper,b.Weight,b.Satuan_Weight,b.Ukuran,b.Bahan,b.Cetak,b.Status,b.Vendor_Code,b.Vendor_Name
	FROM tb_packdev_spec a INNER JOIN tb_packdev_spec_detail b ON a.Request_No =b.Request_No
	LEFT JOIN tb_packdev_add_resource c ON a.ARM_Code=c.Request_No AND a.MPR_Code=c.MPR_Code
	LEFT JOIN tb_packdev_add_resource_detail d ON b.ID_No_Resource_Detail=d.ID_No 
	WHERE a.Request_No ='".@$_POST['AutoRequestNo']."' 
	And b.ID_No = '".@$_POST['getDetail']."' ";
	$exe =mysqli_query($con,$query);
    $tampildata=mysqli_fetch_array($exe);
	
?>	

 
<form  name="ps-edit-detail" id="ps-edit-detail" method="post" >
<table width="100%" border="0" class="table table-striped" id="table table-striped" >
<tr>
        <td width="20%"><span class="form-group">Packaging Material * 
		</span></td>
        <td><div class="form-group d-flex align-items-center justify-content-between mt-0 mb-1">
		<input name="tempAutoRequestNo" id="tempAutoRequestNo" type="hidden" value="<?php echo @$_POST['AutoRequestNo']; ?>">
		<input name="tempID_NoARM" id="tempID_NoARM" type="hidden" value="<?php echo @$tampildata['ID_No_Resource_Detail']; ?>">
		<input name="tempID_No" id="tempID_No" type="hidden" value="<?php echo @$tampildata['ID_No']; ?>">
		<input name="Finish_Good_Code" id="Finish_Good_Code" type="hidden" value="<?php echo @$tempFinish_Good_Code; ?>">
		<input class="form-control py-4"  name="inputPM" id="inputPM"  
		type="text" placeholder="Input Packaging Material"		  
		value="<?php echo @$tampildata['Packaging_Material']; ?>" readonly="readonly" />
		  
		&nbsp;<button type="button" style="padding:2px 4px 4px 4px" 
		class="btn btn-primary" title="Search Project Name"  name="btnsearch" 
		onClick="popupwindow('packaging-ps/pm-popup.php?id=ps','Search Packaging Material ','600','900');">
		<span class="glyphicon glyphicon-search" ></span> </button> 
		</div> 
		</td>	
		<td colspan="3"><span class="form-group">
		   <input class="form-control py-4"  name="inputPMName" id="inputPMName"  
			type="text" placeholder="Input Packaging Material"  
		  	value="<?php echo @$tampildata['Packaging_Material_Name']; ?>" readonly="readonly" />
            </span>  
		</td>	
    </tr>
	<tr>
        <td><span class="form-group">SAP Code</span></td>
        <td colspan="3"  ><span class="form-group">
    	    <input class="form-control py-4"  name="inputSAPCode" id="inputSAPCode" 
			maxlength="150" type="text" placeholder="Input SAP Code" 
		  	value="<?php echo @$tampildata['SAP_Code']; ?>" <?php echo $disabled; ?>  />
            </span>
		</td>
    </tr>
	<tr>
        <td><span class="form-group">Bach Size Lower *</span></td>
        <td><span class="form-group">
    	    <input class="form-control py-4"  name="inputBatchSizeLower" id="inputBatchSizeLower" 
			maxlength="150" type="text" placeholder="Input Bach Size Lower" 
		  	value="<?php echo @$tampildata['Batch_Size_Lower']; ?>" <?php echo $disabled; ?> />
            </span>
		</td>
		<td ><span class="form-group">Bach Size Upper *</span></td>
		<td ><span class="form-group">
			<input class="form-control py-4"

			name="inputBatchSizeUpper" id="inputBatchSizeUpper"  
			maxlength="50" type="text" placeholder="Input Bach Size Upper"  
		  	value="<?php echo @$tampildata['Batch_Size_Upper'];?>" <?php echo $disabled; ?>/>
            </span> 
		</td>
    </tr>
	<tr>
        <td><span class="form-group">Weight </span></td>
		<td><span class="form-group">
			<input class="form-control py-4" name="inputWeigh" id="inputWeigh"  
			maxlength="50" type="text" placeholder="Input Weigh"  
		  	value="<?php echo @$tampildata['Weight']; ?>" <?php echo $disabled; ?> />
            </span> 
		</td>
        <td><span class="form-group">
			<select style="padding:2px 2px 2px 2px" class="form-control" 
			id="selecSatuanWeight" name="selecSatuanWeight" required  <?php echo $disabled; ?> >
			<option value="">Gr / Kg</option>
				<option value="Gr" <?php if (@$tampildata['Satuan_Weight']=='Gr') {echo "Selected"; }?>>Gr</option>
				<option value="Kg" <?php if (@$tampildata['Satuan_Weight']=='Kg') {echo "Selected"; }?>>Kg</option>
				 
    		</select>
			</span>
		</td>
		<td>
		</td>
    </tr>
	<tr>
        <td><span class="form-group">Ukuran *</span></td>
        <td colspan="3"  ><span class="form-group">
    	    <input class="form-control py-4"  name="inputUkuran" id="inputUkuran" 
			maxlength="150" type="text" placeholder="Input Ukuran" 
		  	value="<?php echo @$tampildata['Ukuran']; ?>" <?php echo $disabled; ?>  />
            </span>
		</td>
    </tr>
	<tr>
        <td  ><span class="form-group">Bahan *</span></td>
        <td colspan="3"  ><span class="form-group">
    	    <input class="form-control py-4"  name="inputBahan" id="inputBahan" 
			maxlength="150" type="text" placeholder="Input Bahan"  
		  	value="<?php echo @$tampildata['Bahan']; ?>"  <?php echo $disabled; ?> />
            </span>
		</td>
    </tr> 
	<tr>
        <td><span class="form-group">Cetak *</span></td>
        <td colspan="3"><span class="form-group">
    	    <input class="form-control py-4"  name="inputCetak" id="inputCetak" 
			maxlength="50" type="text" placeholder="Input Cetak" 
		  	value="<?php echo @$tampildata['Cetak']; ?>" <?php echo $disabled; ?>  />
            </span>
		</td>
    </tr>
	<tr>
        <td><span class="form-group">Vendor Code *</span></td>
        <td colspan="3"><span class="form-group">
 			<div class="form-group d-flex align-items-center justify-content-between mt-0 mb-1">
		<select class="form-control" id="inputVendorCode" name="inputVendorCode" 
			onchange="changeValue(this.value)" <?php echo $disabled; ?> >
			<option value="-" >Select Vendor Code</option>
			<?php			
				$query = "SELECT TP,Description from fdTradingPartne WHERE (TP LIKE 'VDT%' or TP LIKE 'VIT%' or TP LIKE 'VST%') Order By Description Asc";
				$jsArray = "var DTing = new Array();\n";  
				$exe = sqlsrv_query ($myConnFlex,$query);	
				while(@$row =sqlsrv_fetch_array ($exe)){
 					if(@$tampildata['Vendor_Code'] == $row['TP']){
						$cek = 'Selected';
					}elseif(@$selectCustomerCode == $row['TP']){
						$cek = 'Selected';
					}else{
						$cek = '';
					}
					echo"<option value='".$row['TP']."' $cek>".$row['TP']."</option>";
					$jsArray .= "DTing['" . $row['TP'] . "'] = {nama:'" . addslashes($row['Description']) ."'};\n";
				}
			?>
		</select> 
		&nbsp;<button type="button" style="padding:2px 4px 4px 4px" 
		class="btn btn-primary" title="Search Vendor Master"  name="btnsearch" 
		onClick="popupwindow('packaging-ps/vendor-master-popup.php?id=ps','Search Vendor Master','600','900');" 
		<?php echo $disabled; ?> >
		<span class="glyphicon glyphicon-search" ></span> </button> 
		</span> 
		</td>
    </tr>
	<tr>
        <td><span class="form-group">Vendor Name *</span></td>
        <td colspan="3"><span class="form-group">
    	    <input class="form-control py-4"  name="inputVendorName" id="inputVendorName" 
			maxlength="50" type="text" placeholder="Input Vendor Name"   
		  	value="<?php echo @$tampildata['Vendor_Name']; ?>" disabled="disabled"  />
            </span>
		</td>
    </tr>
	<tr>
        <td><span class="form-group">Status *</span></td>
        <td colspan="2"><span class="form-group">
			<select style="padding:2px 2px 2px 2px" class="form-control" 
			id="selectStatus" name="selectStatus" required  <?php echo $disabled; ?> >
				<option value="">Select Status</option>
				<option value="Repeat Order" <?php if (@$tampildata['Status']=='Repeat Order') {echo "Selected"; }?>>Repeat Order</option>
				<option value="Proses" <?php if (@$tampildata['Status']=='Proses') {echo "Selected"; }?>>Proses</option>
			</select>
            </span>
		</td>
		<td>
		</td>
    </tr>
	<tr>
        <td colspan="4"> 
		<button type="button" id="edit_form" name="edit_form" value="Save" 
		onclick="myFunction()" class="btn btn-primary" <?php echo $disabled; ?>>Save</button>
	</td>
    </tr>
</table>
</form>

<script type="text/javascript">

 function get_Del_form(){
  $('#inputPM').val("");
  $('#inputPMName').val("");
  $('#inputSAPCode').val("");
  $('#Finish_Good_Code').val("");
  $('#inputBatchSizeLower').val("");
  $('#inputBatchSizeUpper').val("");
  $('#inputWeigh').val("");
  $('#selecSatuanWeight').val("");
  $('#inputUkuran').val("");
  $('#inputBahan').val("");
  $('#inputCetak').val("");
  $('#selectStatus').val("");
 }
 function myFunction() {
	if(document.getElementById('inputPM').value==""){
		alert("Packaging Material Can not be empty *");
		document.getElementById('inputPM').focus();
        return false;  }
	else if(document.getElementById('inputPMName').value==""){
        alert("Packaging Material Name Can not be empty *");
		document.getElementById('inputPMName').focus();
        return false;  }
	else if(document.getElementById('inputBatchSizeLower').value==""){
        alert("Batch Size Lower Can not be empty *");
		document.getElementById('inputBatchSizeLower').focus();
        return false;  }
	else if(document.getElementById('inputBatchSizeUpper').value==""){
        alert("Batch Size Upper Can not be empty *");
		document.getElementById('inputBatchSizeUpper').focus();
        return false;  }
 
	else if(document.getElementById('inputUkuran').value==""){
        alert("Ukuran Can not be empty *");
		document.getElementById('inputUkuran').focus();
        return false;  }
	else if(document.getElementById('inputBahan').value==""){
        alert("Bahan Can not be empty *");
		document.getElementById('inputBahan').focus();
        return false;  }
	else if(document.getElementById('selectStatus').value==""){
        alert("Status Can not be empty *");
		document.getElementById('selectStatus').focus();
        return false;  }
		let text = "Are you sure you want to Save this?";
		if (confirm(text) == true) {
			get_save_form();
			document.getElementById("myClose").click();
		} 
	}	

function get_save_form(){
  var tempID_NoARM			= $('#tempID_NoARM').val();
  var tempID_No 			= $('#tempID_No').val();
  var tempAutoRequestNo		= $('#tempAutoRequestNo').val();
  var inputPM				= $('#inputPM').val();
  var inputPMName		  	= $('#inputPMName').val();
  var inputSAPCode			= $('#inputSAPCode').val();
  var Finish_Good_Code		= $('#Finish_Good_Code').val();
  var inputBatchSizeLower  	= $('#inputBatchSizeLower').val();
  var inputBatchSizeUpper	= $('#inputBatchSizeUpper').val();
  var inputWeigh	  		= $('#inputWeigh').val();
  var selecSatuanWeight		= $('#selecSatuanWeight').val();
  var inputUkuran			= $('#inputUkuran').val();
  var inputBahan			= $('#inputBahan').val();
  var inputCetak  			= $('#inputCetak').val();
  var inputVendorCode		= $('#inputVendorCode').val();
  var inputVendorName  		= $('#inputVendorName').val();
  var selectStatus			= $('#selectStatus').val();
 
   $.ajax({
   type: 'POST',
   url: "packaging-ps/ps-detail-form-save-new.php",
   
   data: { tempID_NoARM	: tempID_NoARM,
	tempID_No			: tempID_No,
	tempAutoRequestNo	: tempAutoRequestNo,
	inputPM		 		: inputPM,
	inputPMName 		: inputPMName,
	inputSAPCode		: inputSAPCode,
	Finish_Good_Code 	: Finish_Good_Code,
	inputBatchSizeLower	: inputBatchSizeLower,
	inputBatchSizeUpper	: inputBatchSizeUpper,
	inputWeigh			: inputWeigh,
	selecSatuanWeight	: selecSatuanWeight,
	inputUkuran			: inputUkuran,
	inputBahan			: inputBahan,
	inputCetak			: inputCetak,
	inputVendorCode		: inputVendorCode,
	inputVendorName		: inputVendorName,
	selectStatus		: selectStatus,

   },
   success: function(info) {
 		alert("Data successfully Save to Draft");	
	setFocus();
	}
  });
  return false;
 }
</script>
<script type="text/javascript">    
    <?php echo $jsArray; ?>  
    function changeValue(inputPM){  
    document.getElementById('inputPMName').value = DTing[inputPM].nama;   
    };  
</script> 
<script type="text/javascript">    
    <?php echo $jsArray; ?>  
    function changeValue(inputVendorCode){  
    document.getElementById('inputVendorName').value = DTing[inputVendorCode].nama;   
    };  
</script>