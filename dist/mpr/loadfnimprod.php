<table name="fnimdetail" id="fnimdetail"  width="120%" border="1"  class="table table-striped table-bordered table-sm" >
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
	include "../../config/connect.php";
    $fnimcode	 	= $_POST['data1'];
	$reqno 			= $_POST['data2'];
	$reqstatus		= $_POST['data3'];

	if(empty($fnimcode)) { ?>
  <tr>
    <td colspan="5" align="center">Tidak ada data yang ditampilkan</td>
  </tr>
  <?php
	} else {
	$Tanya = mysqli_query($con,"SELECT a.Request_No FROM tb_mpr a Inner Join tb_mpr_detail b ON a.Request_No=b.Request_No 
	WHERE a.Request_No = '".$reqno."' And a.FNIM_Code = '".$fnimcode."'   ");

	if (mysqli_num_rows($Tanya) ==0 ) {
	$exe = mysqli_query($con,"SELECT ID_No,Product_Name,Status_Product,Isi_Net,Netto,Index_No 
	FROM tb_fnim_detail Where Request_No = '".$fnimcode."' And ApplyMPR='0'   ");
	$no = 1;
	while(@$rowFNIMDetail =mysqli_fetch_array($exe)){
?>
  <tr>
    <td style="padding:15px 5px 5px 5px;"><?php echo $no; ?></td>
    <td style="padding:15px 5px 5px 5px;"><input type="hidden" name="tempID_NoProd[]" id="tempID_NoProd[]" 
	value="<?php echo $rowFNIMDetail['ID_No']; ?>" /><?php echo $rowFNIMDetail['Product_Name']; ?> </td>
	<td style="padding:15px 5px 5px 5px;">				
		<?php 
		$isinetto="";
		$exeNetto = mysqli_query($con,"SELECT ID_No,Isi_Net,Netto,Index_No 
		FROM tb_fnim_detail_netto Where Request_No = '".$fnimcode."' And
		ID_No_FnimDetail='".$rowFNIMDetail['ID_No']."'  Order By ID_No Asc");
		while(@$rowFNIMDetailNetto =mysqli_fetch_array($exeNetto)){ 
			$isinetto=$isinetto.$rowFNIMDetailNetto['Isi_Net']." ".$rowFNIMDetailNetto['Netto'].", ";
		} 
		echo substr($isinetto,0,-2);  ?>
	</td>
    <td><input style="padding:2px 2px 2px 2px" type="text" name="Nama_Produk_Singkat[]" id="Nama_Produk_Singkat[]"
	 class="form-control" readonly="readonly" /></td>
	<td><input type="text" name="Kelompok_Stok[]" id="Kelompok_Stok[]" class="form-control"
		style="padding:2px 2px 2px 2px;]" readonly="readonly" /></td>
  </tr>
  <?php $no++;}
		} else {
		$exe = mysqli_query($con,"SELECT a.ID_No,a.ID_NoFNIMDetail,b.Product_Name,
		a.Nama_Produk_Singkat,a.Kelompok_Stok FROM tb_mpr_detail a Inner Join tb_FNIM_detail b 
		ON a.ID_NoFNIMDetail=b.ID_No Where a.Request_No = '".$reqno."' And b.Request_No='".$fnimcode."'");
		if (mysqli_num_rows($exe) !=0 ) {
			$no = 1;
			while(@$rowMPRDetail =mysqli_fetch_array($exe)){
		?>
  <tr id="<?php echo $rowMPRDetail['ID_No']; ?>">
    <td style="padding:15px 5px 5px 5px;"><?php echo $no; ?></td>
    <td style="padding:15px 5px 5px 5px;"><input type="hidden" name="tempID_NoProd[]" id="tempID_NoProd[]" 
		value="<?php echo $rowMPRDetail['ID_No']; ?>" /><?php echo $rowMPRDetail['Product_Name']; ?> </td>
    <td style="padding:15px 5px 5px 5px;"><?php 
		$isinetto="";
		$exeNetto = mysqli_query($con,"SELECT ID_No,Isi_Net,Netto,Index_No 
		FROM tb_fnim_detail_netto Where Request_No = '".$fnimcode."' And
		ID_No_FnimDetail='".$rowMPRDetail['ID_NoFNIMDetail']."'  Order By ID_No Asc");
		while(@$rowFNIMDetailNetto =mysqli_fetch_array($exeNetto)){ 
			$isinetto=$isinetto.$rowFNIMDetailNetto['Isi_Net']." ".$rowFNIMDetailNetto['Netto'].", ";
		} 
		echo substr($isinetto,0,-2);  ?>
	</td>
	<td><input style="padding:2px 2px 2px 2px" type="text" name="Nama_Produk_Singkat[]" id="Nama_Produk_Singkat[]" 
		value="<?php echo $rowMPRDetail['Nama_Produk_Singkat']; ?>" class="form-control" readonly="readonly"  /></td>

    <td><input type="text" name="Kelompok_Stok[]" id="Kelompok_Stok[]" class="form-control"
		style='padding:2px 2px 2px 2px;' value="<?php echo $rowMPRDetail['Kelompok_Stok']; ?>" readonly="readonly"  /></td>
  </tr>
  <?php $no++;}} else {
  echo  '<tr>
		<td colspan="5" align="center">Tidak ada data yang ditampilkan</td> </tr>';}}} ?>
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

 
