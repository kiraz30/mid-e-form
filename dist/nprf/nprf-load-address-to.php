  <?php 
	include "../../config/connect.php";
	$nprfsentto	 	=  @$_POST['data1'];
?>
<html>
<head> </head>

<body> 	
<table name="nprfaddressto" id="nprfaddressto" class="table table-striped table-bordered table-sm" >
  <?php 

   if(!empty($nprfsentto)) { ?>
  <tr>
    <td colspan="12" align="left"><strong>Address To</strong></td>
  </tr>
  <tr valign="bottom" align="center" bgcolor="#999999">
	<th width="15%">Address To</th>
	<th width="7%">Email</th>
  </tr>

  <!--tr>
    <td colspan="2" align="center">Tidak ada data yang ditampilkan</td>
  </tr-->
  <?php
	$exe = mysqli_query($con,"SELECT SentTo,AddressTo,Email FROM tb_ms_address_to 
	Where SentTo= '".$nprfsentto."' ");
	while(@$row =mysqli_fetch_array($exe)){
	?>
  <tr>
	<td><?php echo $row['AddressTo']; ?></td>
	<td><?php echo $row['Email']; ?></td>
  </tr>
  <?php }} ?>
</table>
<body> 
<html>
	
 

