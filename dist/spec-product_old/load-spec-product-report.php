  <?php 
	include "../../config/connect.php";
	$productname	 	= @$_POST['data1'];
	$bisnis 			= @$_POST['data2'];
	$status				= @$_POST['data3'];
	$market				= @$_POST['data4'];
	?>


 
<table width="100%" class="table table-striped table-bordered table-hover" id="myTable">
	<thead>
	<tr valign="bottom" align="center" bgcolor="#999999">
		<th colspan="7">Specification Product 
		</th>
	</tr>
	
				
		<tr valign="bottom" align="center" bgcolor="#999999">
			<th width="1%">No</th>
			<th width="13%">Master Product Request No</th>
			<th width="7%">Code Product</th>
			<th width="9%">Barcode</th>
			<th width="30%">Product Name</th>
			<th width="3%">Status Product</th>
			<th width="1%">Action</th>
	</tr>
	</thead>
 
	<tbody>
  <?php 
		$query="SELECT b.ID_No,a.Request_No,a.Project_Name,a.Type_Request,a.Country,
		a.Type,a.Brand,a.Bisnis,a.Series,a.Category,a.Segmentation,a.CustomerCode,a.Royalty,
		a.KeteranganProduct,a.NoBarcodeExisting,a.CustomerCodeFormula,a.RoyaltyFormula,
		a.FNIM_Code,b.Nama_Produk_Singkat,b.Kelompok_Stok,a.Flex,a.SAP,a.Status_MPR,
		c.Product_Name,b.ID_NoFNIMDetail,b.Price,b.ISI,b.UOM1,b.DZ_CT,b.CT_CT,b.UOM,
		b.ID_No AS ID_NoMPRDetail,b.Code_Product,b.BARCODE,c.Status_Product FROM tb_mpr a INNER JOIN tb_mpr_detail b
		ON a.Request_No=b.Request_No INNER JOIN tb_fnim_detail c on b.ID_NoFNIMDetail=c.ID_No
		WHERE a.Status_MPR='Complete' ";
		if ($productname<>""){
			$query= $query. " And c.Product_Name like '%".$productname."%'";}
 		if ($bisnis<>"" & $bisnis <>"-"){
			$query= $query. " And a.Category = '".$bisnis."'";}
		if ($status<>"" & $status<>"-"){
			$query= $query. " And c.Status_Product = '".$status."'";}
		if ($market<>"" & $market<>"-"){
			$query= $query. " And a.Type_Request = '".$market."'";}
		$exe = mysqli_query($con,$query. " Order By a.CreatedDate Desc ");
		if (mysqli_num_rows($exe) !=0 ) {
		$no = 1;
		while(@$row =mysqli_fetch_array($exe)){
	?>
		<tr> 
			<td><?php echo $no;?></td>
			<td><?php echo $row['Request_No'];?></td>
			<td><?php echo $row['Code_Product'];?></td>
			<td><?php echo $row['BARCODE'];?></td>
			<td><?php echo $row['Product_Name'];?></td>
			<td><?php echo $row['Status_Product'];?></td>
			<td align="center">
				<button class='btn btn-primary' data-toggle='modal' data-target='#show' data-id="<?php echo @$row['ID_No']; ?>">
				<i class="fa fa-th-large"></i> Detail</button>
			</td>
				 
			  </tr>
		<?php $no++;}}else { ?>
		<tr>
			<td colspan="7" align="center">Tidak ada data</td>
		</tr>
	<?php }  ?>
	 
	 
	 
</table>

