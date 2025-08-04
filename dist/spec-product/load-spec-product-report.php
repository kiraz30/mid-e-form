  <?php 
	include "../../config/connect.php";
	$inputProductCode	= @$_POST['inputProductCode'];
	$productname	 	= @$_POST['data1'];
	$bisnis 			= @$_POST['data2'];
	$status				= @$_POST['data3'];
	?>


 
<table width="100%" class="table table-striped table-bordered table-hover" id="myTable">
	<thead>
	<tr valign="bottom" align="center" bgcolor="#999999">
		<th colspan="11">Specification Product 
		</th>
	</tr>
	
				
	<tr valign="bottom" align="center" bgcolor="#999999">
		<th rowspan="2" width="1%">No</th>
		<th rowspan="2" width="13%">Request No</th>
		<th rowspan="2" width="7%">Code Product</th>
		<th rowspan="2" width="9%">Barcode</th>
		<th rowspan="2" width="30%">Product Name</th>
		<th colspan="4" width="7%">Status Product</th>
		<th rowspan="2" width="1%">Action</th>
	</tr>
	<tr valign="bottom" align="center" bgcolor="#999999">
		<th width="1%">New</th>
		<th width="1%">Renewal</th>
		<th width="1%">Refine</th>
		<th width="1%">Others</th>
 
	</tr>
	</thead>
 
	<tbody>
  <?php 
		$query="SELECT a.ID_No,a.Index_Document,a.Request_No,a.Last_Request_No,a.Status_Last_Document,
		a.MPR_Code,a.ProjectStatus1,a.ProjectStatus2,a.ProjectStatus3,a.ProjectStatus4,
		a.Brand,a.Bisnis,b.NamaBisnis,a.Code_Product,a.BARCODE,a.Product_Name,a.Isi_Net,a.Netto,
		DATE_FORMAT(a.Launching, '%m') Bulan,DATE_FORMAT(a.Launching, '%Y') Tahun,
		a.Description AS Description_SP,a.Notifikasi_BPOM,a.Product_Image,
		a.SizeOfProduct,a.SizeOfProduct_P,a.SizeOfProduct_L,a.SizeOfProduct_T,a.SizeOfProduct_Satuan,
		a.InnerPack_P,a.InnerPack_L,a.InnerPack_T,a.InnerPack_Satuan,
		a.SizeOfCartton_IS_P,a.SizeOfCartton_IS_L,a.SizeOfCartton_IS_T,a.SizeOfCartton_IS_Satuan,
		a.SizeOfCartton_OS_P,a.SizeOfCartton_OS_L,a.SizeOfCartton_OS_T,a.SizeOfCartton_OS_Satuan,
		a.DznCtn,a.DznCtn_Keterangan,a.WeighOfContenCtn,Status_Spec,a.CreatedBy,a.CreatedDate
		FROM tb_spec_product a INNER JOIN tb_bisnis b ON a.Bisnis=b.KDBisnis
		WHERE a.Status_Spec='Complete' ";
		if ($inputProductCode<>""){
			$query= $query. " And a.Code_Product like '%".$inputProductCode."%'";}
		if ($productname<>""){
			$query= $query. " And a.Product_Name like '%".$productname."%'";}
 		if ($bisnis<>"" & $bisnis <>"-"){
			$query= $query. " And a.Bisnis = '".$bisnis."'";}
		if ($status=="New" ){
			$query= $query. " And a.ProjectStatus1 = '1'";}
		if ($status=="Renewal" ){
			$query= $query. " And a.ProjectStatus2 = '1'";}
		if ($status=="Refine" ){
			$query= $query. " And a.ProjectStatus3 = '1'";}
		if ($status=="Others" ){
			$query= $query. " And a.ProjectStatus4 = '1'";}

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
			<td><?php if ($row['ProjectStatus1']=="1")
				{echo '<i class="glyphicon glyphicon-check">';}
				else {echo '<i class="glyphicon glyphicon-unchecked">';}?> </i></td>
			<td><?php if ($row['ProjectStatus2']=="1")
				{echo '<i class="glyphicon glyphicon-check">';}
				else {echo '<i class="glyphicon glyphicon-unchecked">';}?> </i></td>
			<td><?php if ($row['ProjectStatus3']=="1")
				{echo '<i class="glyphicon glyphicon-check">';}
				else {echo '<i class="glyphicon glyphicon-unchecked">';}?> </i></td>
			<td><?php if ($row['ProjectStatus4']=="1")
				{echo '<i class="glyphicon glyphicon-check">';}
				else {echo '<i class="glyphicon glyphicon-unchecked">';}?> </i></td>

			<td align="center">
				<button class='btn btn-primary' data-toggle='modal' data-target='#show' data-id="<?php echo @$row['Request_No']; ?>">
				<i class="fa fa-th-large"></i> Detail</button>
			</td>
				 
			  </tr>
		<?php $no++;}}else { ?>
		<tr>
			<td colspan="7" align="center">Tidak ada data</td>
		</tr>
	<?php }  ?>
	 
	 
	 
</table>

