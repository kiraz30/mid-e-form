<?php
	include "../../config/conn.php";
	include "../../config/connect.php";
	include "../../config/connect_sql.php";

		$query="SELECT a.Request_No,a.LAST_TRACK,a.MPR_Code,a.Project_Name,
		b.ID_No,b.Code,b.Name,b.NPWP,b.Alamat,b.No_Telp,b.No_Fax,b.PIC,b.Email,
		b.Term_Of_Payment,b.Nama_Bank,b.Rek_Bank,b.Divisi_Department,b.DESCR,
		b.Remark,a.LAST_TRACK FROM  tb_prod_add_resource a 
		INNER JOIN tb_prod_add_resource_detail_c_v b
		ON a.Request_No=b.Request_No WHERE a.Request_No ='".@$_POST['AutoRequestNo']."' 
		And b.ID_No = '".@$_POST['getDetail']."' ";
	$exe =mysqli_query($con,$query);
    $tampildata=mysqli_fetch_array($exe);
	if (@$tampildata['LAST_TRACK']<>"1" & @$tampildata['LAST_TRACK']<>""  & @$tampildata['LAST_TRACK']<>"3")
		  {$disabled="disabled";} else{$disabled="";}
	if (@$_POST['getDetail']<>"")
		  {$required="required";} else{$required="";}
?>	

 
<form  name="arm-edit-detail" id="arm-edit-detail" method="post" >
<table width="100%" border="0" class="table table-striped" id="table table-striped" >
    <tr>
        <td width="25%"><span class="form-group">Code Vendor / Customers  </span></td>
        <td>
			<div class="form-group d-flex align-items-center justify-content-between mt-0 mb-0">
			<span class="form-group">
			<input name="tempAutoRequestNo" id="tempAutoRequestNo" type="hidden" value="<?php echo @$_POST['AutoRequestNo']; ?>">
			<input name="tempID_No" id="tempID_No" type="hidden" value="<?php echo @$_POST['getDetail']; ?>">
            <input class="form-control py-4"  name="inputVendorCustomer" id="inputVendorCustomer"  
			maxlength="50" type="text" placeholder="Input Code"  
		  	value="<?php  echo @$tampildata['Code'];?>"  readonly="readonly"  />
            </span>  
			&nbsp;
			
			<?php 
			if (@$_POST['InputSubject']=="Change"){  ?>
			<span class="form-group">
			<button type="button" 
			class="btn btn-primary" title="Search Tranding Partner for Flexprocess"  name="btnsearch" 
			onClick="popupwindow('production-arm/vendor-master-popup.php?id=prod-arm','Search Vendor','600','900');"
			<?php echo $disabled; ?>><span class="glyphicon glyphicon-search" ></span></button>
			</span>
			&nbsp;
			<span class="form-group">
			<button type="button" 
			class="btn btn-primary" title="Search Tranding Partner for Flexprocess"  name="btnsearch" 
			onClick="get_Del_form();"
			<?php echo $disabled; ?>><span class="glyphicon glyphicon-erase" ></span></button>
			</span>
			<?php } ?>
			
			</div>
		</td>	
		 
    </tr>
    <tr>
        <td ><span class="form-group">Nama Vendor / Customer * </span></td>
        <td colspan="3"><span class="form-group">
    	    <input class="form-control py-4"  
			name="inputNamaVendorCustomer" id="inputNamaVendorCustomer" 
			maxlength="150" type="text" placeholder="Input Nama Vendor / Customer"   
			value="<?php echo @$tampildata['Name']; ?>" <?php echo $disabled; ?> />
            </span>
		</td>
		 
    </tr>
	<tr>
        <td  ><span class="form-group">NPWP *</span></td>
        <td colspan="3"><span class="form-group">
    	    <input class="form-control py-4"  name="inputNPWP" id="inputNPWP" 
			maxlength="150" type="text" placeholder="Input NPWP" 
		  	value="<?php  echo @$tampildata['NPWP']; ?>" <?php echo $disabled; ?> />
            </span>
		</td>
    </tr>
	<tr>
        <td><span class="form-group">Alamat </span></td>
        <td  colspan="3"><span class="form-group">
			<textarea cols="4" id="inputAlamat"  name="inputAlamat"  class="form-control py-4" 
			placeholder="Input Alamat" <?php echo $disabled; ?>><?php echo @$tampildata['Alamat']; ?></textarea>
            </span>
		</td>
		 
    </tr>
	<tr>
		<td ><span class="form-group">No Telp *</span></td>
		<td ><span class="form-group">
			<input class="form-control py-4" name="inputNoTelp" id="inputNoTelp"  
			maxlength="50" type="text" placeholder="No Telp"   
		  	value="<?php echo @$tampildata['No_Telp'];?>" <?php echo $disabled; ?> />
            </span> 
		</td>
        <td><span class="form-group">No Fax</span></td>
        <td><span class="form-group">
			<input class="form-control py-4" name="inputNoFax" id="inputNoFax"  
			maxlength="50" type="text" placeholder="Input No Fax"   
		  	value="<?php echo @$tampildata['No_Fax'];?>" <?php echo $disabled; ?> />
            </span>
		</td>
    </tr>
	<tr>
		<td ><span class="form-group">Email *</span></td>
		<td ><span class="form-group">
			<input class="form-control py-4" name="inputEmail" id="inputEmail"  
			maxlength="50" type="email" placeholder="Input No Fax"   
		  	value="<?php echo @$tampildata['Email'];?>" <?php echo $disabled; ?> />
            </span> 
		</td>
        <td  ><span class="form-group">Term Of Payment *</span></td>
        <td  ><span class="form-group">
    	    <input class="form-control py-4" name="inputTermOfPayment" id="inputTermOfPayment" 
			maxlength="150" type="text" placeholder="Term Of Payment"  
			value="<?php echo @$tampildata['Term_Of_Payment']; ?>" <?php echo $disabled; ?>     />
            </span>
		</td>
		
    </tr>
	<tr>
		<td ><span class="form-group">Nama Bank </span></td>
		<td ><span class="form-group">
			<input class="form-control py-4"
			name="inputNamaBank" id="inputNamaBank"  
			maxlength="50" type="text" placeholder="Input Nama Bank"  
		  	value="<?php  echo @$tampildata['Nama_Bank'];?>" <?php echo $disabled; ?> />
            </span> 
		</td>
		<td ><span class="form-group">No Rekening Bank *</span></td>
		<td ><div class="form-group d-flex align-items-center justify-content-between mt-0 mb-1">
			<input class="form-control py-4"
			name="inputRekBank" id="inputRekBank"  
			maxlength="50" type="text" placeholder="Input No Rekening Bank"  
		  	value="<?php echo @$tampildata['Rek_Bank'];  ?>" <?php echo $disabled; ?> />
			 
			</div> 
		</td>	
 
    </tr>
	<tr>
        <td><span class="form-group">PIC *</span></td>
        <td><span class="form-group">
			<input class="form-control py-4"
			name="inputPIC" id="inputPIC"  
			maxlength="50" type="text" placeholder="Input PIC"  
		  	value="<?php  echo @$tampildata['PIC'];?>" <?php echo $disabled; ?> />
            </span> 
		</td>
		<td><span class="form-group">Divisi/Department Pemohon</span></td>
        <td><span class="form-group">
		<input class="form-control py-4"
			name="inputDivisi" id="inputDivisi"  
			maxlength="50" type="text" placeholder="Input  Divisi/Department"  
		  	value="<?php echo @$tampildata['Divisi_Department'];  ?>" <?php echo $disabled; ?> />
            </span>
		</td>
    </tr>
	 
	<tr>
        <td><span class="form-group">Remark </span></td>
        <td><span class="form-group">
    	    <textarea class="form-control"  name="inputRemark" id="inputRemark" 
			maxlength="200" placeholder="Input Remark" 
			<?php echo $disabled; ?>><?php echo @$tampildata['Remark']; ?></textarea>
            </span>
		</td>
		<td><span class="form-group">PO/FPK Dll</span></td>
        <td><span class="form-group">
    	    <textarea class="form-control"  name="inputDescr" id="inputDescr" 
			maxlength="200" placeholder="Input PO/FPK Dll" 
			<?php echo $disabled; ?>><?php echo @$tampildata['DESCR']; ?></textarea>
            </span>
			 
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
  $('#inputVendorCustomer').val("");
  $('#inputNamaVendorCustomer').val("");
  $('#inputVendorName').val("");
  $('#inputNPWP').val("");
  $('#inputNoTelp').val("");
  $('#inputAlamat').val("");
  $('#inputNoFax').val("");
  $('#inputEmail').val("");
  $('#inputTermOfPayment').val("");
  $('#inputNamaBank').val("");
  $('#inputRekBank').val("");
  $('#inputDivisi').val("");
  $('#inputPIC').val("");
  $('#inputDescr').val("");
  $('#inputRemark').val("");
 }
 function myFunction() {
	if(document.getElementById('inputNamaVendorCustomer').value==""){
        alert("Vendor/Customer Name Can not be empty *");
		document.getElementById('inputNamaVendorCustomer').focus();
        return false;  }
	else if(document.getElementById('inputNPWP').value==""){
        alert("NPWP Can not be empty *");
		document.getElementById('inputNPWP').focus();
        return false;  }
	else if(document.getElementById('inputNoTelp').value==""){
        alert("No Telp Can not be empty *");
		document.getElementById('inputNoTelp').focus();
        return false;  }
	else if(document.getElementById('inputEmail').value==""){
        alert("Email Can not be empty *");
		document.getElementById('inputEmail').focus();
        return false;  }
	else if(document.getElementById('inputTermOfPayment').value==""){
        alert("Term Of Payment Can not be empty *");
		document.getElementById('inputTermOfPayment').focus();
        return false;  }
		let text = "Are you sure you want to Save this?";
		if (confirm(text) == true) {
			get_save_form();
			document.getElementById("myClose").click();
		} 
	}	

function get_save_form(){
  var tempID_No 			= $('#tempID_No').val();
  var tempAutoRequestNo		= $('#tempAutoRequestNo').val();
  var inputVendorCustomer  	= $('#inputVendorCustomer').val();
  var inputNamaVendorCustomer	= $('#inputNamaVendorCustomer').val();
  var inputNPWP	  			= $('#inputNPWP').val();
  var inputNoTelp			= $('#inputNoTelp').val();
  var inputAlamat			= $('#inputAlamat').val();
  var inputNoFax  			= $('#inputNoFax').val();
  var inputEmail			= $('#inputEmail').val();
  var inputTermOfPayment	= $('#inputTermOfPayment').val();
  var inputNamaBank			= $('#inputNamaBank').val();
  var inputRekBank			= $('#inputRekBank').val();
  var inputDivisi			= $('#inputDivisi').val();
  var inputPIC				= $('#inputPIC').val();
  var inputDescr			= $('#inputDescr').val();
  var inputRemark			= $('#inputRemark').val();
   $.ajax({
   type: 'POST',
   url: "production-arm/arm-detail-form-save-new.php?type=cust-vend",
   
   data: {  tempID_No: tempID_No,
	tempAutoRequestNo: tempAutoRequestNo,
	inputVendorCustomer : inputVendorCustomer,
	inputNamaVendorCustomer : inputNamaVendorCustomer,
	inputNPWP			: inputNPWP,
	inputAlamat			: inputAlamat,
	inputNoFax			: inputNoFax,
	inputEmail			: inputEmail,
	inputTermOfPayment	: inputTermOfPayment,
	inputNamaBank		: inputNamaBank,
	inputRekBank		: inputRekBank,
	inputDivisi			: inputDivisi,
	inputPIC			: inputPIC,
	inputDescr			: inputDescr,
	inputRemark			: inputRemark,   
   },
   success: function(info) {
	get_ProductionARMDetail();
	}
  });
  return false;
 }
</script>
 