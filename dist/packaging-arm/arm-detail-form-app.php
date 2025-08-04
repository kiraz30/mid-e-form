<?php 

	include "../../config/conn.php";
	include "../../config/connect.php";
	include "../../config/connect_sql.php";
	$Approve_No		= @$_POST['data3'];
	$indexProcess	= @$_POST['data4'];
	$indexNo		= @$_POST['data5'];
	$Divisi			= @$_POST['data6'];
 	$query="SELECT a.Request_No,a.Status_add_resource,a.MPR_Code,a.Project_Name,
	b.ID_No,b.FinishGoodCode,b.FinishGoodName,b.Material_Name,b.MCJ_Code,
	b.Order_UM,b.Minimum_Order_Qty,b.Miltiple_Order_Qty,b.CountryOrigin,
	b.Vendor_Name_Recommendation,b.Currency,b.Std_UP,b.Vendor_Code,b.Vendor_Name,
	b.PO_Lead_Time,b.Safety_Stock_Ratio,b.Cate_of_Day,b.Buyer_Planner,
	b.Resource_Code,b.SAP_Code,b.Remark,a.Status_add_resource FROM  tb_packdev_add_resource a 
	INNER JOIN tb_packdev_add_resource_detail b
	ON a.Request_No=b.Request_No WHERE a.Request_No ='".@$_POST['AutoRequestNo']."' 
	And b.ID_No = '".@$_POST['getDetail']."' ";
	$exe =mysqli_query($con,$query);
    $tampildata=mysqli_fetch_array($exe);
	if (@$tampildata['Status_add_resource']<>"Draft" & @$tampildata['Status_add_resource']<>"")
		  {$disabled="disabled";} else{$disabled="";}
	if (@$_POST['getDetail']<>"")
		  {$required="required";} else{$required="";}
?>	

 
<form  name="arm-edit-detail" id="arm-edit-detail" method="post" >
<table width="100%" border="0" class="table table-striped" id="table table-striped" >
    <tr>
        <td width="20%"><span class="form-group">Finish Good Code * 
		</span></td>
        <td width="30%"><span class="form-group">
		<input name="tempAutoRequestNo" id="tempAutoRequestNo" type="hidden" value="<?php echo @$_POST['AutoRequestNo']; ?>">
		<input name="tempID_No" id="tempID_No" type="hidden" value="<?php echo @$_POST['getDetail']; ?>">
            <input class="form-control py-4"  name="inputFinishGoodCode" id="inputFinishGoodCode"  
			maxlength="50" type="text" placeholder="Input Finish Good Code"  
		  	value="<?php echo @$tampildata['FinishGoodCode'];?>" <?php echo $disabled; ?> />
            </span>  
		</td>	
		<td width="20%"><span class="form-group">Vendor Code * <!--?php   echo $indexNo.$Divisi.$indexProcess;	?--> </span></td>
        <td width="30%">
		<div class="form-group d-flex align-items-center justify-content-between mt-0 mb-1">
		<input class="form-control py-4"  
			name="inputVendorCode" id="inputVendorCode"  maxlength="100" type="text" placeholder="Input Vendor Name"    
		  	value="<?php echo @$tampildata['Vendor_Code']; ?>" <?php echo $disabled; ?> >
		<!--select class="form-control" id="inputVendorCode" name="inputVendorCode" 
			onchange="changeValue(this.value)"
			<?php ARMPurDisable($Approve_No,$indexProcess,'Step 1',$Divisi);  
			if ($indexNo=="1" || $indexNo=="3" || $indexNo=="4"  || $indexNo=="5" & $indexProcess=="Step 1")
			{ echo" required";}else {echo $disabled;}	?> >
			<option value="-" >Select Vendor Code</option>
			<?php			
				$query = "select TP,Description from fdTradingPartne Order By Description Asc";
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
		</select--> 
		&nbsp;<button type="button" style="padding:2px 4px 4px 4px" 
		class="btn btn-primary" title="Search Project Name"  name="btnsearch" 
		onClick="popupwindow('packaging-arm/vendor-master-popup.php?id=arm','Search Project Name','600','900');" 
		<?php ARMPurDisable($Approve_No,$indexProcess,'Step 1',$Divisi);  
			if ($indexNo=="1" || $indexNo=="3" || $indexNo=="4" || $indexNo=="5" & $indexProcess=="Step 1")
			{ echo" required";}else {echo $disabled;}	?> >
		<span class="glyphicon glyphicon-search" ></span> </button> 
		</span> 
		</td>
    </tr>
    <tr>
        <td ><span class="form-group">Finish Good Name * </span></td>
        <td ><span class="form-group">
    	    <input class="form-control py-4"  
			name="inputFinishGoodName" id="inputFinishGoodName" 
			maxlength="150" type="text" placeholder="Input Finish Good Name"   
			value="<?php echo @$tampildata['FinishGoodName']; ?>" <?php echo $disabled; ?> />
            </span>
		</td>
		<td ><span class="form-group">Vendor Name </span></td>
        <td ><span class="form-group">
			<input class="form-control py-4"  
			name="inputVendorName" id="inputVendorName"  maxlength="100" type="text" placeholder="Input Vendor Name"    
		  	value="<?php echo @$tampildata['Vendor_Name']; ?>" <?php echo $disabled; ?>/>
            </div> 
		</td>
    </tr>
	<tr>
        <td  ><span class="form-group">Material Name *</span></td>
        <td ><span class="form-group">
    	    <input class="form-control py-4"  name="inputMaterialName" id="inputMaterialName" 
			maxlength="150" type="text" placeholder="Input Material Name" 
		  	value="<?php  echo @$tampildata['Material_Name']; ?>" <?php echo $disabled; ?> />
            </span>
		</td>
		<td ><span class="form-group">PO Lead Time</span></td>
		<td ><span class="form-group">
			<input class="form-control py-4"
			<?php ARMPurDisable($Approve_No,$indexProcess,'Step 1',$Divisi);  
			if ($indexNo=="1" || $indexNo=="3" || $indexNo=="4" || $indexNo=="5" & $indexProcess=="Step 1")
			{ echo" required";}else {echo $disabled;}	?> 
			name="inputPOLeadTime" id="inputPOLeadTime"  
			maxlength="50" type="text" placeholder="Input PO Lead Time"   
		  	value="<?php echo @$tampildata['PO_Lead_Time'];?>"   />
            </span> 
		</td>
    </tr>
	<tr>
        <td  ><span class="form-group">MCJ Code/ Model/ INC</span></td>
        <td ><span class="form-group">
    	    <input class="form-control py-4"  name="inputMCJ" id="inputMCJ" 
			maxlength="150" type="text" placeholder="Input MCode/Model/INC" 
		  	value="<?php echo @$tampildata['MCJ_Code']; ?>" <?php echo $disabled; ?> />
            </span>
		</td>
		<td ><span class="form-group">Safety Stok Ratio</span></td>
		<td ><span class="form-group">
			<input class="form-control py-4"
			<?php ARMPurDisable($Approve_No,$indexProcess,'Step 1',$Divisi);  
			if ($indexNo=="1" || $indexNo=="3" || $indexNo=="4" || $indexNo=="5" & $indexProcess=="Step 1")
			{ echo" required";}else {echo $disabled;}	?> 
			name="inputSafetyStokRatio" id="inputSafetyStokRatio"  
			maxlength="50" type="text" placeholder="Input Safety Stok Ratio"  
		  	value="<?php echo @$tampildata['Safety_Stock_Ratio'];?>"  />
            </span> 
		</td>
    </tr>
	<tr>
        <td><span class="form-group">Order UM *</span></td>
        <td><span class="form-group">
			<select style="padding:2px 2px 2px 2px" class="form-control" 
			id="selectOrderUM" name="selectOrderUM" required  <?php ARMPurDisable($Approve_No,$indexProcess,'Step 1',$Divisi);  
			if ($indexNo=="1" || $indexNo=="3" || $indexNo=="4" || $indexNo=="5" & $indexProcess=="Step 1")
			{ echo" required";}else {echo $disabled;}	?>  >
			<option value="">Order UM</option>
				<option value="Pcs" <?php if (@$tampildata['Order_UM']=='Pcs') {echo "Selected"; }?>>Pcs</option>
				<option value="Doz" <?php if (@$tampildata['Order_UM']=='Doz') {echo "Selected"; }?>>Doz</option>
				<option value="Set" <?php if (@$tampildata['Order_UM']=='Set') {echo "Selected"; }?>>Set</option>
				<option value="Roll" <?php if (@$tampildata['Order_UM']=='Roll') {echo "Selected"; }?>>Roll</option>
    		</select>
			</span>
		</td>
		<td ><span class="form-group">Cut of Day</span></td>
		<td ><span class="form-group">
			<input class="form-control py-4"
			<?php ARMPurDisable($Approve_No,$indexProcess,'Step 1',$Divisi);  
			if ($indexNo=="1" || $indexNo=="3" || $indexNo=="4" || $indexNo=="5" & $indexProcess=="Step 1")
			{ echo" required";}else {echo $disabled;}	?> 
			name="inputCutofDay" id="inputCutofDay"  
			maxlength="50" type="text" placeholder="Input Cut of Day"  
		  	value="<?php echo @$tampildata['Cate_of_Day']; ?>"  />
            </span> 
		</td>
    </tr>
	<tr>
        <td  ><span class="form-group">Minimum Order Qty *</span></td>
        <td  ><span class="form-group">
    	    <input class="form-control py-4"  name="inputMinimumOrderQty" id="inputMinimumOrderQty" 
			maxlength="150" type="text" placeholder="Input Minimum Order Qty" onKeyUp="return angka(this);"  
		  	value="<?php echo @$tampildata['Minimum_Order_Qty']; ?>" <?php ARMPurDisable($Approve_No,$indexProcess,'Step 1',$Divisi);  
			if ($indexNo=="1" || $indexNo=="3" || $indexNo=="4" || $indexNo=="5" & $indexProcess=="Step 1")
			{ echo" required";}else {echo $disabled;}	?>   />
            </span>
		</td>
		<td ><span class="form-group">Buyer Planner</span></td>
		<td ><span class="form-group">
			<input class="form-control py-4"
			<?php ARMPurDisable($Approve_No,$indexProcess,'Step 1',$Divisi);  
			if ($indexNo=="1" || $indexNo=="3" || $indexNo=="4" || $indexNo=="5" & $indexProcess=="Step 1")
			{ echo" required";}else {echo $disabled;}	?>  
			name="inputBuyerPlanner" id="inputBuyerPlanner"  
			maxlength="50" type="text" placeholder="Input Buyer Planner"  
		  	value="<?php  echo @$tampildata['Buyer_Planner'];?>"   />
            </span> 
		</td>
    </tr>
	<tr>
        <td  ><span class="form-group">Multiple Order Qty *</span></td>
        <td  ><span class="form-group">
    	    <input class="form-control py-4"  name="inputMultipleOrderQty" id="inputMultipleOrderQty" 
			maxlength="150" type="text" placeholder="Input Multiple Order Qty" onKeyUp="return angka(this);" 
		  	value="<?php echo @$tampildata['Miltiple_Order_Qty']; ?>"  <?php ARMPurDisable($Approve_No,$indexProcess,'Step 1',$Divisi);  
			if ($indexNo=="1" || $indexNo=="3" || $indexNo=="4" || $indexNo=="5" & $indexProcess=="Step 1")
			{ echo" required";}else {echo $disabled;}	?>  />
            </span>
		</td>
		<td ><span class="form-group">Resource Code *</span></td>
		<td >
		<div class="form-group d-flex align-items-center justify-content-between mt-0 mb-1">
			<input class="form-control py-4"
			name="inputResourceCode" id="inputResourceCode"  
			maxlength="50" type="text" placeholder="Input Resource Code"  
		  	value="<?php echo @$tampildata['Resource_Code'];  ?>" <?php echo $disabled; ?> />
			  <input name="inputPMName" id="inputPMName" type="hidden"  
		  	value="<?php echo @$tampildata['Packaging_Material_Name']; ?>" readonly="readonly" />		
			&nbsp;<button type="button" style="padding:2px 4px 4px 4px"  <?php  ARMProdDisable($Approve_No,$indexProcess,'Step 1',$Divisi);  
				if ($indexNo=="2" || $indexNo=="5" || $indexNo=="6" || $indexNo=="1" & $indexProcess=="Step 4")
				{ echo" required";}else {echo $disabled;}	?> 
			class="btn btn-primary" title="Search Resource Code"  name="btnsearch" 
			onClick="popupwindow('packaging-arm/pm-popup.php?id=ps','Search Packaging Material ','600','900');">
			<span class="glyphicon glyphicon-search" ></span> </button> 
			</div> 	
		</td>
    </tr>
	<tr>
        <td><span class="form-group">Curency *</span></td>
        <td><span class="form-group">
			<select style="padding:2px 2px 2px 2px" name="selectCurency" 
			id="selectCurency" class="form-control" <?php ARMPurDisable($Approve_No,$indexProcess,'Step 1',$Divisi);  
			if ($indexNo=="1" || $indexNo=="3" || $indexNo=="3" || $indexNo=="4" || $indexNo=="5" & $indexProcess=="Step 1")
			{ echo" required";}else {echo $disabled;}	?> >
				<option value="">Currency</option>
				<?php
				$div = mysqli_query($con,"SELECT NamaCurrency FROM tb_currency  Where Status='1'");
				while($b = mysqli_fetch_array($div)){
					if(@$tampildata['Currency'] == $b['NamaCurrency']){
						$cek = 'Selected';	}
					else{
						$cek = '';	}
					echo"<option value='".$b['NamaCurrency']."' $cek>".$b['NamaCurrency']."</option> ";}
				?>
			</select>
    	    </span>
		</td>
		<td><span class="form-group">SAP Code *</span></td>
        <td><span class="form-group">
		<input class="form-control py-4"
			name="inputSAPCode" id="inputSAPCode"  
			maxlength="50" type="text" placeholder="Input SAP Code"  
		  	value="<?php echo @$tampildata['SAP_Code'];  ?>"
			  <?php  ARMProdDisable($Approve_No,$indexProcess,'Step 1',$Divisi);  
				if ($indexNo=="2" || $indexNo=="5" || $indexNo=="6" || $indexNo=="1" & $indexProcess=="Step 2")
				{ echo" required";}else {echo $disabled;}	?> 
			/>
            </span>
		</td>
		
		
    </tr>
	<tr>
        <td><span class="form-group">Std UP *</span></td>
        <td><span class="form-group">
    	    <input class="form-control py-4"  name="inputStdUP" id="inputStdUP" 
			maxlength="50" type="text" placeholder="Input Std UP" onKeyUp="return angka(this);" 
		  	value="<?php echo @$tampildata['Std_UP']; ?>" <?php ARMPurDisable($Approve_No,$indexProcess,'Step 1',$Divisi);  
			if ($indexNo=="1"  || $indexNo=="3" || $indexNo==""  || $indexNo=="4" || $indexNo=="5" & $indexProcess=="Step 2" || $indexProcess=="Step 1")
			{ echo" required";}else {echo $disabled;}	?>   />
            </span>
		</td>
		<td><span class="form-group">Vendor Name Recommendation</span></td>
        <td><span class="form-group">
    	    <input class="form-control py-4"  name="inputVNRecommendation" id="inputVNRecommendation" 
			maxlength="50" type="text" placeholder="Vendor Name Recommendation" 
		  	value="<?php echo @$tampildata['Vendor_Name_Recommendation']; ?>" <?php echo $disabled; ?>  />
            </span>
		</td>
    </tr>
	<tr>
        <td><span class="form-group">Remark *</span></td>
        <td><span class="form-group">
    	    <textarea class="form-control"  name="inputRemark" id="inputRemark" 
			maxlength="100" type="text"
			placeholder="Input Remark" 
			<?php ARMPurDisable($Approve_No,$indexProcess,'Step 1',$Divisi);  
			if ($indexNo=="1" || $indexNo=="3" || $indexNo=="4" || $indexNo=="5" & $indexProcess=="Step 1")
			{ echo" required";}else {echo $disabled;}	?>><?php echo @$tampildata['Remark']; ?></textarea>
            </span>
		</td>
		<td><span class="form-group">Country Origin</span></td>
        <td><span class="form-group">
    	    <input class="form-control py-4"  name="inputCountryOrigin" id="inputCountryOrigin" 
			maxlength="50" type="text" placeholder="Input Country Origin"
			
		  	value="<?php echo @$tampildata['CountryOrigin']; ?>" <?php echo $disabled; ?>  />
            </span>
		</td>
    </tr>
	<tr>
        <td colspan="4"> 
		<button type="button" id="edit_form" name="edit_form" value="Save" 
		onclick="<?php if ($indexNo=="1" || $indexNo=="4" || $indexNo=="5" & $indexProcess=="Step 1"){
			echo "myFunctionPurchase()";}
			elseif ($indexNo=="2" || $indexNo=="5" || $indexNo=="1" & $indexProcess=="Step 4"){
				echo "myFunctionProd()";}
			else{
		 		echo "myFunction()";} ?>" class="btn btn-primary"
		<?php  
			if ($indexNo=="2" || $indexNo=="1" || $indexNo=="4" || $indexNo=="5" & $indexProcess=="Step 2" || $indexProcess=="Step 4" || $indexProcess=="Step 1")
			{ echo" required";}else {echo $disabled;}	?>  >Save</button>
	</td>
    </tr>
</table>
</form>

<script type="text/javascript">

 function get_Del_form(){
  $('#inputFinishGoodCode').val("");
  $('#inputFinishGoodName').val("");
  $('#inputVendorCode').val("");
  $('#inputVendorName').val("");
  $('#inputMaterialName').val("");
  $('#inputPOLeadTime').val("");
  $('#inputMCJ').val("");
  $('#inputSafetyStokRatio').val("");
  $('#selectOrderUM').val("");
  $('#inputCutofDay').val("");
  $('#inputMinimumOrderQty').val("");
  $('#inputBuyerPlanner').val("");
  $('#inputMultipleOrderQty').val("");
  $('#inputResourceCode').val("");
  $('#selectCurency').val("");
  $('#inputStdUP').val("");
  $('#inputCountryOrigin').val("");
  $('#inputVNRecommendation').val("");
  $('#inputRemark').val("");
 }
 function myFunction() {
	if(document.getElementById('inputFinishGoodCode').value==""){
		document.getElementById('inputFinishGoodCode').focus();
        return false;  }
	else if(document.getElementById('inputFinishGoodName').value==""){
        alert("Finish Good Name Can not be empty *");
		document.getElementById('inputFinishGoodName').focus();
        return false;  }
	else if(document.getElementById('inputMaterialName').value==""){
        alert("Material Name Can not be empty *");
		document.getElementById('inputMaterialName').focus();
        return false;  }
	else if(document.getElementById('selectOrderUM').value==""){
        alert("Order UM Can not be empty *");
		document.getElementById('selectOrderUM').focus();
        return false;  }
	else if(document.getElementById('inputMinimumOrderQty').value==""){
        alert("Minimum Order Qty Can not be empty *");
		document.getElementById('inputMinimumOrderQty').focus();
        return false;  }
	else if(document.getElementById('inputMultipleOrderQty').value==""){
        alert("Multiple Order Qty Can not be empty *");
		document.getElementById('inputMultipleOrderQty').focus();
        return false;  }
	else if(document.getElementById('selectCurency').value==""){
        alert("Curency Can not be empty *");
		document.getElementById('selectCurency').focus();
        return false;  }
	else if(document.getElementById('inputStdUP').value==""){
        alert("Std UP Can not be empty *");
		document.getElementById('inputStdUP').focus();
        return false;  }
		let text = "Are you sure you want to Save this?";
		if (confirm(text) == true) {
			get_save_form();
			document.getElementById("myClose").click();
		} 
	}	

	function myFunctionPurchase() {
	if(document.getElementById('inputFinishGoodCode').value==""){
		document.getElementById('inputFinishGoodCode').focus();
        return false;  }
	else if(document.getElementById('inputFinishGoodName').value==""){
        alert("Finish Good Name Can not be empty *");
		document.getElementById('inputFinishGoodName').focus();
        return false;  }
	else if(document.getElementById('inputMaterialName').value==""){
        alert("Material Name Can not be empty *");
		document.getElementById('inputMaterialName').focus();
        return false;  }

	else if(document.getElementById('selectOrderUM').value==""){
        alert("Order UM Can not be empty *");
		document.getElementById('selectOrderUM').focus();
        return false;  }
	else if(document.getElementById('inputMinimumOrderQty').value==""){
        alert("Minimum Order Qty Can not be empty *");
		document.getElementById('inputMinimumOrderQty').focus();
        return false;  }
	else if(document.getElementById('inputMultipleOrderQty').value==""){
        alert("Multiple Order Qty Can not be empty *");
		document.getElementById('inputMultipleOrderQty').focus();
        return false;  }
	else if(document.getElementById('selectCurency').value==""){
        alert("Curency Can not be empty *");
		document.getElementById('selectCurency').focus();
        return false;  }
	else if(document.getElementById('inputStdUP').value==""){
        alert("Std UP Can not be empty *");
		document.getElementById('inputStdUP').focus();
        return false;  }
	else if(document.getElementById('inputVendorCode').value==""){
        alert("Vendor Code Can not be empty *");
	    return false;  } 
	else if(document.getElementById('inputVendorName').value==""){
        alert("Vendor Name Can not be empty *");
        return false;  } 
 		let text = "Are you sure you want to Save this?";
		if (confirm(text) == true) {
			get_save_form();
			document.getElementById("myClose").click();
		} 
	}	

	function myFunctionProd() {
	if(document.getElementById('inputFinishGoodCode').value==""){
		document.getElementById('inputFinishGoodCode').focus();
        return false;  }
	else if(document.getElementById('inputFinishGoodName').value==""){
        alert("Finish Good Name Can not be empty *");
		document.getElementById('inputFinishGoodName').focus();
        return false;  }
	else if(document.getElementById('inputMaterialName').value==""){
        alert("Material Name Can not be empty *");
		document.getElementById('inputMaterialName').focus();
        return false;  }

	else if(document.getElementById('selectOrderUM').value==""){
        alert("Order UM Can not be empty *");
		document.getElementById('selectOrderUM').focus();
        return false;  }
	else if(document.getElementById('inputMinimumOrderQty').value==""){
        alert("Minimum Order Qty Can not be empty *");
		document.getElementById('inputMinimumOrderQty').focus();
        return false;  }
	else if(document.getElementById('inputMultipleOrderQty').value==""){
        alert("Multiple Order Qty Can not be empty *");
		document.getElementById('inputMultipleOrderQty').focus();
        return false;  }
	else if(document.getElementById('selectCurency').value==""){
        alert("Curency Can not be empty *");
		document.getElementById('selectCurency').focus();
        return false;  }
	else if(document.getElementById('inputStdUP').value==""){
        alert("Std UP Can not be empty *");
		document.getElementById('inputStdUP').focus();
        return false;  }
	else if(document.getElementById('inputVendorCode').value==""){
        alert("Vendor Code Can not be empty *");
		document.getElementById('inputVendorCode').focus();
        return false;  } 
	else if(document.getElementById('inputVendorName').value==""){
        alert("Vendor Name Can not be empty *");
        return false;  } 
	else if(document.getElementById('inputResourceCode').value==""){
        alert("Resource Code Can not be empty *");
		document.getElementById('inputResourceCode').focus();
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
  var inputFinishGoodCode  	= $('#inputFinishGoodCode').val();
  var inputFinishGoodName	= $('#inputFinishGoodName').val();
  var inputVendorCode	  	= $('#inputVendorCode').val();
  var inputVendorName		= $('#inputVendorName').val();
  var inputMaterialName	  	= $('#inputMaterialName').val();
  var inputPOLeadTime		= $('#inputPOLeadTime').val();
  var inputMCJ			  	= $('#inputMCJ').val();
  var inputSafetyStokRatio	= $('#inputSafetyStokRatio').val();
  var selectOrderUM  		= $('#selectOrderUM').val();
  var inputCutofDay			= $('#inputCutofDay').val();
  var inputMinimumOrderQty	= $('#inputMinimumOrderQty').val();
  var inputBuyerPlanner		= $('#inputBuyerPlanner').val();
  var inputMultipleOrderQty	= $('#inputMultipleOrderQty').val();
  var inputResourceCode		= $('#inputResourceCode').val();
  var inputSAPCode			= $('#inputSAPCode').val();
  var selectCurency			= $('#selectCurency').val();
  var inputStdUP			= $('#inputStdUP').val();
  var inputCountryOrigin	= $('#inputCountryOrigin').val();
  var inputVNRecommendation	= $('#inputVNRecommendation').val();
  var inputRemark			= $('#inputRemark').val();
   $.ajax({
   type: 'POST',
   url: "packaging-arm/arm-detail-form-save-new.php",
   
   data: {  tempID_No: tempID_No,
	tempAutoRequestNo: tempAutoRequestNo,
	inputFinishGoodCode : inputFinishGoodCode,
	inputFinishGoodName : inputFinishGoodName,
	inputSAPCode		: inputSAPCode,
	inputVendorCode		: inputVendorCode,
	inputVendorName		: inputVendorName,
	inputMaterialName	: inputMaterialName,
	inputMCJ			: inputMCJ,
	inputSafetyStokRatio: inputSafetyStokRatio,
	selectOrderUM		: selectOrderUM,
	inputCutofDay		: inputCutofDay,
	inputMinimumOrderQty: inputMinimumOrderQty,
	inputBuyerPlanner	: inputBuyerPlanner,
	inputMultipleOrderQty: inputMultipleOrderQty,
	inputResourceCode	: inputResourceCode,
	selectCurency		: selectCurency,
	inputStdUP			: inputStdUP,
	inputCountryOrigin	: inputCountryOrigin,
  	inputVNRecommendation:inputVNRecommendation,
	inputRemark			: inputRemark,   
   },
   success: function(info) {
	setFocus();
	}
  });
  return false;
 }
</script>

<script type="text/javascript">    
    <?php echo $jsArray; ?>  
    function changeValue(inputVendorCode){  
    document.getElementById('inputVendorName').value = DTing[inputVendorCode].nama;   
    };  
</script> 