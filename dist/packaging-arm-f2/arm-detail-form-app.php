<?php 

	include "../../config/conn.php";
	include "../../config/connect.php";
	include "../../config/connect_sql.php";
	$Approve_No		= @$_POST['data3'];
	$indexProcess	= @$_POST['data4'];
	$indexNo		= @$_POST['data5'];
	$Divisi			= @$_POST['data6'];
 	$query="SELECT a.Request_No,a.Status_add_resource,a.MPR_Code,a.Project_Name,
	 b.ID_No,b.FinishGoodCode,b.FinishGoodName,b.Material_Code,b.Material_Name,b.Material_Name_Request, 
	 b.Remark,a.Status_add_resource FROM  tb_packdev_add_resource_f2 a 
	 INNER JOIN tb_packdev_add_resource_f2_detail b
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
        <td width="30%"><span class="form-group">Finish Good Code * 
		</span></td>
        <td width="30%"><span class="form-group">
		<input name="tempAutoRequestNo" id="tempAutoRequestNo" type="hidden" value="<?php echo @$_POST['AutoRequestNo']; ?>">
		<input name="tempID_No" id="tempID_No" type="hidden" value="<?php echo @$_POST['getDetail']; ?>">
            <input class="form-control py-4"  name="inputFinishGoodCode" id="inputFinishGoodCode"  
			maxlength="50" type="text" placeholder="Input Finish Good Code"  
		  	value="<?php echo @$tampildata['FinishGoodCode'];?>" <?php echo $disabled; ?> />
            </span>  
		</td>	
		<td width="20%"></td>
        <td width="30%"></td>
    </tr>
    <tr>
        <td ><span class="form-group">Finish Good Name * </span></td>
        <td colspan="3"><span class="form-group">
    	    <input class="form-control py-4"  
			name="inputFinishGoodName" id="inputFinishGoodName" 
			maxlength="150" type="text" placeholder="Input Finish Good Name"   
			value="<?php echo @$tampildata['FinishGoodName']; ?>" <?php echo $disabled; ?> />
            </span>
		</td>
		 
    </tr>
	<tr>
		<td><span class="form-group">Material Code</span></td>
        <td colspan="2">
			<div class="form-group d-flex align-items-center justify-content-between mt-0 mb-1"> 
				<input class="form-control py-4"  
				name="inputMaterialCode" id="inputMaterialCode" maxlength="150" type="text" placeholder="Input Material Code"   
				value="<?php echo @$tampildata['Material_Code']; ?>" readonly="readonly" />
				&nbsp;<button type="button" style="padding:2px 4px 4px 4px" class="btn btn-primary" title="Search Search Material"  
				name="btnsearch"
				onClick="popupwindow('packaging-arm-f2/pm-popup.php?id=armf2','Search Material','600','900');"
				<?php ARMProdDisable($Approve_No,$indexProcess,'Step 1',$Divisi);  
				if ($indexNo=="1" || $indexNo=="4" || $indexNo=="5" & $indexProcess=="Step 1")
				{ echo" required";}else {echo $disabled;}	?>>
				<span class="glyphicon glyphicon-search" ></span></button>

			</div>  
		</td>	
        <td></td>
    </tr>
    <tr>
		<td><span class="form-group">Material Name</span></td>
        <td colspan="3" >
			<span class="form-group">
				<input class="form-control py-4"  name="inputMaterialName" id="inputMaterialName" 
				maxlength="150" type="text" placeholder="Input Material Name" 
				value="<?php  echo @$tampildata['Material_Name']; ?>" readonly="readonly" />
			</span>  
		</td>	
        <td></td>
    </tr> 
	<tr>
        <td><span class="form-group">Material Name Request *</span></td>
        <td colspan="3"><span class="form-group">
    	    <input class="form-control py-4"  name="inputMaterialNameRequest" id="inputMaterialNameRequest" 
			maxlength="150" type="text" placeholder="Input Material Name Request" 
		  	value="<?php  echo @$tampildata['Material_Name_Request']; ?>" <?php echo $disabled; ?> />
            </span>
		</td>
    </tr>
	<tr>
        <td><span class="form-group">Remark *</span></td>
        <td colspan="3"><span class="form-group">
    	    <textarea class="form-control"  name="inputRemark" id="inputRemark" 
			maxlength="100" type="text"
			placeholder="Input Remark" <?php echo $disabled; ?>><?php echo @$tampildata['Remark']; ?></textarea>
            </span>
		</td>
		 
    </tr>
	<tr>
        <td colspan="4"> 
		<button type="button" id="edit_form" name="edit_form" value="Save" 
		onclick="<?php if ($indexNo=="1" || $indexNo=="4" & $indexProcess=="Step 1"){
			echo "myFunctionProd()";}
			else{
		 		echo "myFunction()";} ?>" class="btn btn-primary"
		<?php  
			if ($indexNo=="2" || $indexNo=="1" || $indexNo=="4" || $indexNo=="5" & $indexProcess=="Step 4" || $indexProcess=="Step 1")
			{ echo" required";}else {echo $disabled;}	?>  >Save</button>
	</td>
    </tr>
</table>
</form>

<script type="text/javascript">

 function get_Del_form(){
	$('#inputFinishGoodCode').val("");
	$('#inputFinishGoodName').val("");
	$('#inputMaterialCode').val("");
	$('#inputMaterialName').val("");
	$('#inputMaterialNameRequest').val("");
	$('#inputRemark').val("");
 }
 function myFunction() {
	if(document.getElementById('inputFinishGoodCode').value==""){
		alert("Finish Good Code Can not be empty *");
		document.getElementById('inputFinishGoodCode').focus();
        return false;  }
	else if(document.getElementById('inputFinishGoodName').value==""){
        alert("Finish Good Name Can not be empty *");
		document.getElementById('inputFinishGoodName').focus();
        return false;  }
 
	else if(document.getElementById('inputMaterialNameRequest').value==""){
        alert("Material Name Request Can not be empty *");
		document.getElementById('inputMaterialNameRequest').focus();
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
	else if(document.getElementById('inputMaterialNameRequest').value==""){
        alert("Material Name Request Can not be empty *");
		document.getElementById('inputMaterialNameRequest').focus();
        return false;  }
	else if(document.getElementById('inputMaterialCode').value==""){
        alert("Material Code Can not be empty *");
		document.getElementById('inputMaterialCode').focus();
        return false;  }
	else if(document.getElementById('inputMaterialName').value==""){
        alert("Material Name Can not be empty *");
		document.getElementById('inputMaterialName').focus();
        return false;  }

 		let text = "Are you sure you want to Save this?";
		if (confirm(text) == true) {
			get_save_form();
			document.getElementById("myClose").click();
			//get_PackagingARMDetail();
		} 
	}	

	function get_save_form(){
  var tempID_No 			= $('#tempID_No').val();
  var tempAutoRequestNo		= $('#tempAutoRequestNo').val();
  var inputFinishGoodCode  	= $('#inputFinishGoodCode').val();
  var inputFinishGoodName	= $('#inputFinishGoodName').val();
  var inputMaterialCode		= $('#inputMaterialCode').val();
  var inputMaterialName	  	= $('#inputMaterialName').val();
  var inputMaterialNameRequest	= $('#inputMaterialNameRequest').val();

  var inputRemark			= $('#inputRemark').val();
   $.ajax({
   type: 'POST',
   url: "packaging-arm-f2/arm-detail-form-save-new.php",
   
   data: {  tempID_No	: tempID_No,
	tempAutoRequestNo	: tempAutoRequestNo,
	inputFinishGoodCode : inputFinishGoodCode,
	inputFinishGoodName : inputFinishGoodName,
	inputMaterialCode	: inputMaterialCode,
	inputMaterialName	: inputMaterialName,
	inputMaterialNameRequest: inputMaterialNameRequest,
	inputRemark			: inputRemark,   
   },
   success: function(info) {
	setFocus();
	}
  });
  return false;
 }
</script>

 