  <?php 
	include "../../config/connect.php";
	$mprcode	 	=  @$_POST['data1'];
	?>
<html>
<head> </head>

<body> 	
<table name="AttachMPR" id="AttachMPR" class="table table-striped table-bordered table-sm" >
 	<tr>
		<th colspan="3" align="left"><strong>Lampiran</strong></th>
	</tr>
	<tr valign="bottom" align="center" bgcolor="#999999" >
		<th width="1%">No</th>
		<th width="35%">File</th>
		<th>Name</th>
	</tr>
  <?php 
	if(empty($mprcode)) { ?>
  <tr>
    <td colspan="3" align="center">Tidak ada data yang ditampilkan</td>
  </tr>
  <?php
	} else {
		$exe = mysqli_query($con,"SELECT ID_No,File,Name,Index_No 
		FROM tb_fnim_file Where Request_No = '".$mprcode."' ");
		$no = 1;
		if (mysqli_num_rows($exe) !=0 ) {
		while(@$RowMPRFile =mysqli_fetch_array($exe)){
	?>
		<tr id="<?php echo $RowMPRFile['ID_No']; ?>">
			<td style="padding:15px 10px 5px 5px;"><?php echo $no;?></td>
			<td style="padding:10px 5px 5px 5px;"><?php if (!empty($RowMPRFile['File'])){?>
			  	<img height="20" width="20" src="../img/pdf.png"  title="Open File <?php echo $RowMPRFile['File'];?>"
				onClick="popupwindow('../config/open-pdf.php?pdfname=<?php echo $RowMPRFile['File'];?>&page=filempr','Preview Pdf','700','1000');">
			  	<?php }  ?>				
			</td>
			<td><input type="text" name="InputNameFile[]" id="InputNameFile[]" class="form-control"
				value="<?php echo $RowMPRFile['Name'];?>"  readonly="readonly">
			</td>
		</tr>
  <?php $no++;}} else {echo  '<tr>
  <td colspan="7" align="center">Tidak ada data yang ditampilkan</td>
  </tr>';}} ?>
</table>
<body>
<html>
	
 

