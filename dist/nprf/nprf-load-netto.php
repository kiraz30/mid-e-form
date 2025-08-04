  <?php 
	include "../../config/connect.php";
	$fnimcode	 	= $_POST['data1'];
	$reqno 			= $_POST['data2'];
	$reqstatus		= @$_POST['data3'];

	$exe =mysqli_query($con,"SELECT ID_No,Request_No,Status_MPR FROM tb_mpr where Request_No = '".$reqno."' ");
    $tampildata=mysqli_fetch_array(@$exe);
	//________________________________________________________________________________StatusMPR disabled
	if ($tampildata['Status_MPR']<>"Draft" & $tampildata['Status_MPR']<>"Revise" &
	 $tampildata['Status_MPR']<>"" & $tampildata['Status_MPR']<>"Complete" ) 
	{$disabled="disabled";} else{$disabled="";}
	?>
<table name="fnimdetail" id="fnimdetail"  width="160%" border="1"  class="table table-striped table-bordered table-sm" >
  <tr>
    <td colspan="13" align="left"><strong>MPR Detail</strong>
        <button type="button" style="padding:0px 0px 0px 0px" class="btn btn-primary" title="Delete MPR Detail "  
					id="btnDeleteMPR" name="btnDeleteMPR" <?php echo $disabled; ?> >
					<span class="glyphicon glyphicon-trash" title="Preview Work Flow" ></span></button></td>
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
		$exe = mysqli_query($con,"SELECT ID_No,Product_Name,Status_Product,Isi_Net,Netto,Assumed_Consumer_Price,Index_No 
		FROM tb_fnim_detail  Where Request_No = '".$fnimcode."' And ApplyMPR='0'   ");
		$no = 1;
		while(@$rowFNIMetail =mysqli_fetch_array($exe)){
	?>
  <tr>
    <td style="padding:15px 5px 5px 5px;"><input type="checkbox" name="chkdetail[]" id="chkdetail[]" /></td>
    <td style="padding:15px 5px 5px 5px;"><input type="hidden" name="tempID_No[]" id="tempID_No[]" 
	value="<?php echo $rowFNIMetail['ID_No']; ?>" /><?php echo $rowFNIMetail['Product_Name']; ?> </td>
	<td style="padding:15px 5px 5px 5px;"><?php echo $rowFNIMetail['Status_Product']; ?></td>
    <td style="padding:15px 5px 5px 5px;"><?php echo $rowFNIMetail['Isi_Net']." ".$rowFNIMetail['Netto']; ?></td>
    <td><input style="padding:2px 2px 2px 2px;text-align: right;" type="text" name="Price[]" id="Price[]" 
	class="form-control" value="<?php echo $rowFNIMetail['Assumed_Consumer_Price']; ?>" /></td>
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
	$exe = mysqli_query($con,"SELECT a.ID_No,a.ID_NoFNIMDetail,b.Product_Name,b.Status_Product,b.Isi_Net,b.Netto,a.Price,a.Isi,a.UOM1,
	a.DZ_CT,a.CT_CT,a.UOM,a.Barcode_Existing,a.Code_Product,a.BARCODE,a.Index_No 
	FROM tb_mpr_detail a Inner Join tb_FNIM_detail b ON a.ID_NoFNIMDetail=b.ID_No 
	Where a.Request_No = '".$reqno."'");
	if (mysqli_num_rows($exe) !=0 ) {
	$no = 1;
	while(@$rowMPRDetail =mysqli_fetch_array($exe)){
	?>
  <tr id="<?php echo $rowMPRDetail['ID_No']; ?>">
    <td style="padding:15px 5px 5px 5px;"><input type="checkbox" name="chkdetail[]" id="chkdetail[]" value="<?php echo $rowMPRDetail['ID_No']; ?>" /></td>
    <td style="padding:15px 5px 5px 5px;"><input type="hidden" name="tempID_No[]" id="tempID_No[]" value="<?php echo $rowMPRDetail['ID_No']; ?>" />
        <?php echo $rowMPRDetail['Product_Name']; ?> </td>
	<td style="padding:15px 5px 5px 5px;"><?php echo $rowMPRDetail['Status_Product']; ?></td>
    <td style="padding:15px 5px 5px 5px;"><?php echo $rowMPRDetail['Isi_Net']." ".$rowMPRDetail['Netto']; ?></td>
	<td><input style="padding:2px 2px 2px 2px;text-align: right;" type="text" name="Price[]" id="Price[]" 
		value="<?php echo $rowMPRDetail['Price']; ?>" class="form-control" <?php echo $disabled; ?> /></td>

    <td><input type="text" name="Isi[]" id="Isi[]" class="form-control"
		style="padding:2px 2px 2px 2px;text-align:right;" onkeypress="return angka(event)"
		value="<?php echo $rowMPRDetail['Isi_Net']; ?>" <?php echo $disabled; ?> /></td>
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
<script>
function deleteRow() {
			try {
			var table = document.getElementById('fnimdetail');
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

 
<script>
$(document).ready(function(){
 $('#btnDeleteMPR').click(function(){
  
  if(confirm("Are you sure you want to delete this?"))
  {
   var DelMPR = [];
   
   $(':checkbox:checked').each(function(i){
    DelMPR[i] = $(this).val();
   });
   if(DelMPR.length === 0) //tell you if the array is empty
   {
    alert("Please Select atleast one checkbox");
   }
   else
   {
    $.ajax({
     url:'../config/delete.php',
     method:'POST',
     data:{DelMPR:DelMPR},
     success:function()
     {
      for(var i=0; i<DelMPR.length; i++)
      {
       $('tr#'+DelMPR[i]+'').css('background-color', '#ccc');
       $('tr#'+DelMPR[i]+'').fadeOut('slow');
	   deleteRow();
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
