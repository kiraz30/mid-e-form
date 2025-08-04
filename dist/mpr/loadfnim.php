  <?php 
	include "../../config/connect.php";
	$fnimcode	 	= @$_POST['data1'];
	$reqno 			= @$_POST['data2'];
	$reqstatus		= @$_POST['data3'];

	$exe =mysqli_query($con,"SELECT ID_No,Request_No,Status_MPR FROM tb_mpr where Request_No = '".$reqno."' ");
    $tampildata=mysqli_fetch_array(@$exe);
	//________________________________________________________________________________StatusMPR disabled
	if (@$tampildata['Status_MPR']<>"Draft" & @$tampildata['Status_MPR']<>"Revise" &
	 @$tampildata['Status_MPR']<>"" & @$tampildata['Status_MPR']=="Complete" ) 
	{$disabled="disabled";} else{$disabled="";}
	?>
<script>
function deleteRowMPR(row){
	var IndexRow = row.parentNode.parentNode.rowIndex;
	var DelMPR = row.parentNode.parentNode.id;
	var Deltitle = row.parentNode.parentNode.title;
	var r = confirm("Are you sure you want to delete this "+ Deltitle + " ?");
	if (r == true) {
        $.ajax({
			
            type:"POST",
			data:"DelMPR="+DelMPR,
		 	url:'../config/delete.php',
            success:function(data){
			document.getElementById('fnimdetail').deleteRow(IndexRow);
            }
		});
		}
   }
	
</script>

<table name="fnimdetail" id="fnimdetail"  width="160%" border="1"  class="table table-striped table-bordered table-sm" >
  <tr>
    <td colspan="13" align="left"><strong>MPR Detail</strong></td>
  </tr>
  <tr valign="bottom" align="center" bgcolor="#999999">
    <th width="1%"></th>
    <th width="10%">Product Name</th>
	<th width="3%">Status Product</th>
    <th width="2%">Netto</th>
    <th width="5%">Price</th>
    <th width="3%">Isi</th>
	<th width="6%">Secondary Packing</th>
    <th width="2%">DZ/CT</th>
    <th width="2%">CT/CT</th>
	<th width="4%">Unit</th>
	<th width="10%">Barcode Existing</th>
    <th width="5%">Code Product</th>
    <th width="10%">No. Barcode</th>
  </tr>
  <?php 

	if(empty($fnimcode)) { ?>
  <tr>
    <td colspan="13" align="center">Tidak ada data yang ditampilkan</td>
  </tr>
  <?php
	} else {
	$Tanya = mysqli_query($con,"SELECT a.Request_No FROM tb_mpr a Inner Join tb_mpr_detail b ON a.Request_No=b.Request_No 
	WHERE a.Request_No = '".$reqno."' And a.FNIM_Code = '".$fnimcode."'   ");
	if (mysqli_num_rows($Tanya) ==0 ) {
		$exe = mysqli_query($con,"SELECT ID_No,Product_Name,Status_Product,Assumed_Consumer_Price,Index_No 
		FROM tb_fnim_detail  Where Request_No = '".$fnimcode."' And ApplyMPR='0'   ");
		$no = 1;
		while(@$rowFNIDMetail =mysqli_fetch_array($exe)){
	?>
  <tr id="<?php echo $rowFNIDMetail['ID_No']; ?>">
    <td style="padding:15px 5px 5px 5px;">						
		<button type="button" style="padding:0px 0px 0px 0px" class="btn btn-primary" 
		id="deleteDetail[]" name="deleteDetail[]" onclick = "deleteRowMPR(this)">
		<span class="glyphicon glyphicon-trash" title="Delete MPR Detail" >
		</span></button></td>
    <td style="padding:15px 5px 5px 5px;"><input type="hidden" name="tempID_No[]" id="tempID_No[]" 
	value="<?php echo $rowFNIDMetail['ID_No']; ?>" /><?php echo $rowFNIDMetail['Product_Name']; ?> </td>
	<td style="padding:15px 5px 5px 5px;"><?php echo $rowFNIDMetail['Status_Product']; ?></td>
    <td style="padding:15px 5px 5px 5px;">				
		<?php 
		$isinetto="";
		$exeNetto = mysqli_query($con,"SELECT ID_No,Isi_Net,Netto,Index_No 
		FROM tb_fnim_detail_netto Where Request_No = '".$fnimcode."' And
		ID_No_FnimDetail='".$rowFNIDMetail['ID_No']."'  Order By ID_No Asc");
		while(@$rowFNIMDetailNetto =mysqli_fetch_array($exeNetto)){ 
			$isinetto=$isinetto.@$rowFNIMDetailNetto['Isi_Net']." ".@$rowFNIMDetailNetto['Netto'].", ";
		} 
		echo substr($isinetto,0,-2);  ?>
	</td>
    <td><input style="padding:2px 2px 2px 2px;text-align: right;" type="text" name="Price[]" id="Price[]" 
	class="form-control" value="<?php echo $rowFNIDMetail['Assumed_Consumer_Price']; ?>" /></td>
	<td><input type="text" name="Isi[]" id="Isi[]" class="form-control"
		style="padding:2px 2px 2px 2px;text-align:right;" onkeypress="return angka(event)" /></td>
    <td><select style="padding:2px 2px 2px 2px" class="form-control" id="UOM1[]" name="UOM1[]" required>
	<option value=""></option>
      <option value="DOZEN BOX">DOZEN</option>
      <option value="SHRINK FILM">SHRINK</option>
      <option value="HANGER DISPLAY">HANGER</option>
	  <option value="PCS">PCS</option>
	  <option value="SET">SET</option>
    </select>
    </td>
    <td><input type="text" name="DZ_CT[]" id="DZ_CT[]" class="form-control"
		style="padding:2px 2px 2px 2px;text-align: right;" onkeypress="return angka(event)" /></td>
    <td><input type="text" name="CT_CT[]" id="CT_CT[]" class="form-control"
		style="padding:2px 2px 2px 2px;text-align: right;" onkeypress="return angka(event)" />
    </td>
    <td><select style="padding:2px 2px 2px 2px" class="form-control" id="UOM[]" name="UOM[]" required>
	<option value=""></option>
      <option value="Doz">Doz</option>
	  <option value="Pcs">Pcs</option>
	  <option value="Set">Set</option>
    </select>
    </td>
	<td><input type="text" name="Barcode_Existing[]" id="Barcode_Existing[]" class="form-control"
		style="padding:2px 2px 2px 2px"  /></td>
    <td><input type="text" name="Code_Product[]" id="Code_Product[]" class="form-control"
		style="padding:2px 2px 2px 2px"   <?php if ($reqstatus<>"Export") { echo 'readonly="readonly"';}?> /></td>
    <td><input type="text" name="BARCODE[]" id="BARCODE[]" class="form-control"
		style="padding:2px 2px 2px 2px" <?php if ($reqstatus<>"Export") { echo 'readonly="readonly"';}?> /></td>
  </tr>
  <?php $no++;}
	} else {
	$exe = mysqli_query($con,"SELECT a.ID_No,a.ID_NoFNIMDetail,b.Product_Name,b.Status_Product,a.Price,a.Isi,a.UOM1,
	a.DZ_CT,a.CT_CT,a.UOM,a.Barcode_Existing,a.Code_Product,a.BARCODE,a.Index_No 
	FROM tb_mpr_detail a Inner Join tb_FNIM_detail b ON a.ID_NoFNIMDetail=b.ID_No 
	Where a.Request_No = '".$reqno."' And b.Request_No='".$fnimcode."' ");
	if (mysqli_num_rows($exe) !=0 ) {
	$no = 1;
	while(@$rowMPRDetail =mysqli_fetch_array($exe)){
	?>
  <tr id="<?php echo $rowMPRDetail['ID_No']; ?>" title="<?php echo $rowMPRDetail['Product_Name']; ?>">
    <td style="padding:15px 5px 5px 5px;"><button type="button" style="padding:0px 0px 0px 0px" class="btn btn-primary" 
		id="deleteDetail[]" name="deleteDetail[]" onclick = "deleteRowMPR(this)">
		<span class="glyphicon glyphicon-trash" title="Delete MPR Detail" >
		</span></button>
	</td>
    <td style="padding:15px 5px 5px 5px;"><input type="hidden" name="tempID_No[]" id="tempID_No[]" value="<?php echo $rowMPRDetail['ID_No']; ?>" />
        <?php echo $rowMPRDetail['Product_Name']; ?> </td>
	<td style="padding:15px 5px 5px 5px;"><?php echo $rowMPRDetail['Status_Product']; ?></td>
    <td style="padding:15px 5px 5px 5px;">
	<?php 
		$isinetto="";
		$exeNetto = mysqli_query($con,"SELECT ID_No,Isi_Net,Netto,Index_No 
		FROM tb_fnim_detail_netto Where Request_No = '".$fnimcode."' And
		ID_No_FnimDetail='".$rowMPRDetail['ID_NoFNIMDetail']."'  Order By ID_No Asc");
		while(@$rowFNIMDetailNetto =mysqli_fetch_array($exeNetto)){ 
			$isinetto=$isinetto.$rowFNIMDetailNetto['Isi_Net']." ".$rowFNIMDetailNetto['Netto'].", ";
		} 
		echo substr($isinetto,0,-2);  ?>
	</td>
	<td><input style="padding:2px 2px 2px 2px;text-align: right;" type="text" name="Price[]" id="Price[]" 
		value="<?php echo $rowMPRDetail['Price']; ?>" class="form-control" <?php echo $disabled; ?> /></td>

    <td><input type="text" name="Isi[]" id="Isi[]" class="form-control"
		style="padding:2px 2px 2px 2px;text-align:right;" onkeypress="return angka(event)"
		value="<?php echo $rowMPRDetail['Isi']; ?>" <?php echo $disabled; ?> /></td>
    <td><select style="padding:2px 2px 2px 2px" class="form-control" id="UOM1[]" name="UOM1[]" required <?php echo $disabled; ?>>
      <option value="DOZEN BOX" <?php if (@$rowMPRDetail['UOM1']=='DOZEN BOX') {echo "Selected"; }?>>DOZEN</option>
      <option value="SHRINK FILM" <?php if (@$rowMPRDetail['UOM1']=='SHRINK FILM') {echo "Selected";} ?>>SHRTNK</option>
      <option value="HANGER DISPLAY" <?php if (@$rowMPRDetail['UOM1']=='HANGER DISPLAY') {echo "Selected";} ?>>HANGER</option>
	  <option value="PCS" <?php if (@$rowMPRDetail['UOM1']=='PCS') {echo "Selected";} ?>>PCS</option>
	  <option value="SET" <?php if (@$rowMPRDetail['UOM1']=='SET') {echo "Selected";} ?>>SET</option>
    </select></td>
    <td><input type="text" name="DZ_CT[]" id="DZ_CT[]" class="form-control"
		style="padding:2px 2px 2px 2px; text-align: right;" onkeypress="return angka(event)"
		value="<?php echo $rowMPRDetail['DZ_CT']; ?>" required <?php echo $disabled; ?>/></td>
    <td><input type="text" name="CT_CT[]" id="CT_CT[]" class="form-control"
		style="padding:2px 2px 2px 2px; text-align: right;" onkeypress="return angka(event)"
		value="<?php echo $rowMPRDetail['CT_CT']; ?>" required <?php echo $disabled; ?>/></td>
    <td><select style="padding:2px 2px 2px 2px" class="form-control" id="UOM[]" name="UOM[]" required <?php echo $disabled; ?>>
	  <option value="Pcs" <?php if (@$rowMPRDetail['UOM']=='Pcs') {echo "Selected"; }?>>Pcs</option>
      <option value="Doz" <?php if (@$rowMPRDetail['UOM']=='Doz') {echo "Selected"; }?>>Doz</option>
	  <option value="Set" <?php if (@$rowMPRDetail['UOM']=='Set') {echo "Selected"; }?>>Set</option>
    </select>
    </td>
	<td><input type="text" name="Barcode_Existing[]" id="Barcode_Existing[]" class="form-control"
		style="padding:2px 2px 2px 2px" value="<?php echo $rowMPRDetail['Barcode_Existing']; ?>" <?php echo $disabled; ?> /></td>
    <td><input type="text" name="Code_Product[]" id="Code_Product[]" class="form-control"
		style="padding:2px 2px 2px 2px" value="<?php echo $rowMPRDetail['Code_Product']; ?>" 
		<?php if ($reqstatus<>"Export") { echo 'readonly="readonly"';}?> <?php echo $disabled; ?> /></td>
    <td><input type="text" name="BARCODE[]" id="BARCODE[]" class="form-control"
		style="padding:2px 2px 2px 2px" value="<?php echo $rowMPRDetail['BARCODE']; ?>"
		<?php if ($reqstatus<>"Export") { echo 'readonly="readonly"';}?> <?php echo $disabled; ?>/></td>
  </tr>
  <?php $no++;}} else {echo  '<tr>
  <td colspan="12" align="center">Tidak ada data yang ditampilkan</td>
  </tr>';}}} ?>
</table>
 
