<?php 
include "../../config/conn.php";
include "../../config/connect.php";
include "../../config/connect_sql.php";
$WorkProcess  		= @$_POST['WorkProcess'];
$Materials			= @$_POST['Materials'];
$Fu_Fee				= @$_POST['Fu_Fee'];
$Type_Vendor  		= @$_POST['Type_Vendor'];
$Type_Customer		= @$_POST['Type_Customer'];
$Request_No			= @$_POST['Request_No'];

if (@$WorkProcess=="1" ) {   ?>
	<table width="100%" class="table table-striped table-bordered table-hover" id="arm-detail" name="arm-detail">
	<thead>
		<tr bgcolor="#999999">
		<th width="1%">No</th> 
		<th width="10%">Finish Good Code</th> 
		<th width="20%">Finish Good Code Name  </th> 
		<th width="20%">Material Code</th> 
		<th width="20%">Material Name</th> 
		<th width="5%">Action <span class="fa fa-exclamation-circle" title="Action untuk melengakapi Additional Resource Master Detail "></span> </th>
		</tr>
	</thead>
	<tbody>
		<?php
		$query="SELECT a.LAST_TRACK,b.ID_No,b.Request_No,b.FinishGoodCode,b.Subject,b.FinishGoodName,
		b.Material_Code,b.Material_Name	FROM tb_prod_add_resource a INNER JOIN tb_prod_add_resource_detail_w_p b 
		ON a.Request_No=b.Request_No Where a.Request_No ='".@$Request_No."' ";
		$exe = mysqli_query($con,$query);
		$no = 1;
		while(@$row =mysqli_fetch_array($exe)){
		?>
		<tr> 
			<td><?php echo $no;?></td>
			<td><?php echo $row['FinishGoodCode'];?> </td>
			<td><?php echo $row['FinishGoodName'];?> </td>
			<td><?php if (@$row['LAST_TRACK']=="7"){
				if (@$row['Material_Code']=="")
				{echo '<font color="red">Mohon Isi data ini</font> '.'<span class="fa fa-exclamation-circle" title="Mohon untuk melengkapi Code material"></span>';}}?>
				<?php echo $row['Material_Code'];?> </td>
			<td><?php if (@$row['LAST_TRACK']=="7"){
				if (@$row['Material_Name']=="")
				{echo '<font color="red">Mohon Isi data ini</font> '.'<span class="fa fa-exclamation-circle" title="Mohon untuk melengkapi Code material"></span>';}}?>
				<?php echo $row['Material_Name'];?> </td>
			<td align="center"><button type="button" style="padding:2px 4px 2px 2px"  
			class="btn btn-primary" data-toggle='modal' data-target='#addWorkProcess' 
			data-id="<?php echo $row['ID_No'];?>" >
			<span class="glyphicon glyphicon-zoom-in edit_data" title="Edit / View Additional Resource Master Detail "></span></button>	
			</td>
		</tr>
		<?php $no++;} ?>
	</tbody>
	</table>
<?php }else if (@$Type_Vendor=="1" || @$Type_Customer=="1" ) {   ?>
	<table width="100%" class="table table-striped table-bordered table-hover" 
		id="arm-detail" name="arm-detail">
		<thead>
			<tr bgcolor="#999999">
			<th width="1%">No</th> 
			<th width="10%">Code Vendor/Customers</th> 
			<th width="20%">Nama Vendor/Customers </th> 
			<th width="20%">NPWP  </th> 
			<th width="20%">Alamat  </th>
			<th width="5%">Action</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$query="SELECT a.ID_No,a.Request_No,a.CODE,a.NAME,a.NPWP,a.Alamat,b.Subject,b.LAST_TRACK
			FROM tb_prod_add_resource_detail_c_v a INNER JOIN tb_prod_add_resource b 
			ON a.Request_No=b.Request_No Where a.Request_No ='".@$Request_No."'";
			$exe = mysqli_query($con,$query);
			$no = 1;
			while(@$row =mysqli_fetch_array($exe)){
			?>
			<tr> 
				<td><?php echo $no;?></td>
				<td><?php echo $row['CODE'];?>
				<?php if (@$row['LAST_TRACK']=="7"){
				if (@$row['CODE']=="")
				{echo '<font color="red">Mohon Isi data ini</font> '.'<span class="fa fa-exclamation-circle" title="Mohon untuk melengkapi Code Vendor atau Nama Vendor"></span>';}}?>  </td>
				<td><?php echo $row['NAME'];?> </td>
				<td><?php echo $row['NPWP'];?> </td>
				<td><?php echo $row['Alamat'];?> </td>
				<td align="center">
				<button type="button" style="padding:2px 4px 2px 2px"  
				class="btn btn-outline btn-default" data-toggle='modal' data-target='#addVC' 
				data-id="<?php echo $row['ID_No'];?>" data-typevendor="<?php echo $Type_Vendor;?>"
				data-typecustomers="<?php echo $Type_Customer;?>"
				data-subject="<?php echo $Subject;?>">
				<span class="glyphicon glyphicon-edit edit_data" title="Edit / View Detail "></span></button>	
				</td>
			</tr>
			<?php $no++;} ?>
		</tbody>
	</table>

	<?php }else if (@$Materials=="1" || @$Fu_Fee=="1" ) {   ?>
	<table width="100%" class="table table-striped table-bordered table-hover" id="arm-detail" name="arm-detail">
	<thead>
		<tr bgcolor="#999999">
		<th width="1%">No</th> 
		<th width="10%">Finish Good Code</th> 
		<th width="20%">Finish Good Code Name  </th> 
		<th width="20%">Material Name  </th> 
		<th width="5%">Action <span class="fa fa-exclamation-circle" title="Action untuk melengakapi Additional Resource Master Detail "></span> </th>
		</tr>
	</thead>
	<tbody>
		<?php
		$query="SELECT ID_No,Request_No,FinishGoodCode,FinishGoodName,Material_Name
		FROM tb_prod_add_resource_detail
		Where Request_No ='".@$Request_No."' ";
		$exe = mysqli_query($con,$query);
		$no = 1;
		while(@$row =mysqli_fetch_array($exe)){
		?>
		<tr> 
			<td><?php echo $no;?></td>
			<td><?php echo $row['FinishGoodCode'];?> </td>
			<td><?php echo $row['FinishGoodName'];?> </td>
			<td><?php echo $row['Material_Name'];?> </td>
			<td align="center"><button type="button" style="padding:2px 4px 2px 2px"  
			class="btn btn-primary" data-toggle='modal' data-target='#add' 
			data-id="<?php echo $row['ID_No'];?>">
			<span class="glyphicon glyphicon-zoom-in edit_data" title="Edit / View Additional Resource Master Detail "></span></button>	
			</td>
		</tr>
		<?php $no++;} ?>
	</tbody>
	</table>
<?php }  ?>