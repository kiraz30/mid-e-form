<?php 

	include "../../config/conn.php";
	include "../../config/connect.php";
	include "../../config/connect_sql.php";
	$Approve_No		= @$_POST['data3'];
	$indexProcess	= @$_POST['data4'];
	$indexNo		= @$_POST['data5'];
	$Divisi			= @$_POST['data6'];
 	$query="SELECT b.ID_No,a.Request_No, a.ARM_Code,a.MPR_Code,a.Finish_Good_Code,a.Status_Spec,
	 b.ID_No_Resource_Detail,b.Packaging_Material,b.Packaging_Material_Name,b.SAP_Code,b.Batch_Size_Lower,
	 b.Batch_Size_Upper,b.Weight,b.Satuan_Weight,b.Ukuran,b.Bahan,b.Cetak,b.Status,
	 b.Vendor_Code,b.Vendor_Name
	 FROM tb_packdev_spec a INNER JOIN tb_packdev_spec_detail b ON a.Request_No =b.Request_No
	 LEFT JOIN tb_packdev_add_resource c ON a.ARM_Code=c.Request_No AND a.MPR_Code=c.MPR_Code
	 LEFT JOIN tb_packdev_add_resource_detail d ON b.ID_No_Resource_Detail=d.ID_No 
	 WHERE a.Request_No ='".@$_POST['AutoRequestNo']."' 
	 And b.ID_No = '".@$_POST['getDetail']."' ";
	$exe =mysqli_query($con,$query);
    $tampildata=mysqli_fetch_array($exe);
	if (@$tampildata['Status_Spec']<>"Draft" & @$tampildata['Status_Spec']<>"")
		  {$disabled="disabled";} else{$disabled="";}
	if (@$_POST['getDetail']<>"")
		  {$required="required";} else{$required="";}
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
		<input class="form-control py-4"  name="inputPM" id="inputPM"  
		type="text" placeholder="Input Packaging Material"		  
		value="<?php echo @$tampildata['Packaging_Material']; ?>" readonly="readonly" />
 
		</td>	
		<td colspan="3"><span class="form-group">
		   <input class="form-control py-4"  name="inputPMName" id="inputPMName"  
			type="text" placeholder="Input Material Code"  
		  	value="<?php echo @$tampildata['Packaging_Material_Name']; ?>" readonly="readonly" />
            </span>  
		</td>	
    </tr>
	<tr>
        <td><span class="form-group">SAP Code *</span></td>
        <td colspan="3"  ><span class="form-group">
    	    <input class="form-control py-4"  name="inputSAPCode" id="inputSAPCode" 
			maxlength="150" type="text" placeholder="Input SAP Code" 
		  	value="<?php echo @$tampildata['SAP_Code']; ?>" readonly="readonly"  />
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
        <td  ><span class="form-group">Ukuran *</span></td>
        <td colspan="3"  ><span class="form-group">
    	    <input class="form-control py-4"  name="DW" id="inputUkuran" 
			maxlength="150" type="text" placeholder="Input Ukuran" onKeyUp="return angka(this);"  
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
			maxlength="50" type="text" placeholder="Input Cetak" onKeyUp="return angka(this);" 
		  	value="<?php echo @$tampildata['Cetak']; ?>" <?php echo $disabled; ?>  />
            </span>
		</td>
    </tr>
	<tr>
        <td><span class="form-group">Vendor Code *</span></td>
        <td colspan="3"><span class="form-group">
    	    <input class="form-control py-4"  name="inputVendorCode" id="inputVendorCode" 
			maxlength="50" type="text" placeholder="Input Vendor Code"  
		  	value="<?php echo @$tampildata['Vendor_Code']; ?>" disabled="disabled"  />
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
	 
</table>
</form>