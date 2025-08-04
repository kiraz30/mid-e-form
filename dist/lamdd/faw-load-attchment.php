  <?php 
	include "../../config/connect.php";
	$fawcode	 	=  @$_POST['data1'];

	$exe =mysqli_query($con,"SELECT ID_No,Request_No,Status_FAW FROM tb_faw where Request_No = '".$fawcode."' ");
    $tampildata=mysqli_fetch_array(@$exe);
	//________________________________________________________________________________StatusFAW disabled
	if (@$tampildata['Status_FAW']<>"Draft" & @$tampildata['Status_FAW']<>"Revise" &
	 @$tampildata['Status_FAW']<>"" & @$tampildata['Status_FAW']<>"Complete" ) 
	{$disabled="disabled";} else{$disabled="";}
	?>
<html>
<head> </head>

<body> 	
<table name="cfmfile" id="cfmfile" class="table table-striped table-bordered table-sm" >
  <tr>
    <td colspan="7" align="left"><strong>Attachment File FAW</strong></td>
  </tr>
  <tr valign="bottom" align="center" bgcolor="#999999" >
	<th width="1%">No</th>
	<th width="20%">FAW File</th>
	<th width="20%">Kemasan</th>
	<th width="20%">Posisi</th>
  </tr>
  <?php 		
	$exe = mysqli_query($con,"SELECT  ID_No, ID_No_CFM_File,`File` , Kemasan, Posisi, Index_No 
	FROM tb_faw_file  Where  Request_No = '".$fawcode."'");
	if (mysqli_num_rows($exe) !=0 ) {
		$no = 1;
		while(@$rowFAWDetail =mysqli_fetch_array($exe)){
?>
	<tr id="<?php echo $rowFAWDetail['ID_No']; ?>">
		<td> 
			<input type="hidden" name="tempItemDetail[]" id="tempItemDetail[]" value="<?php echo $rowFAWDetail['ID_No']; ?>">
			<input type="hidden" name="tempfilelama[]" id="tempfilelama[]" value="<?php echo $rowFAWDetail['File'];?>"> 
			<?php echo $no; ?>
		</td>
		<td> 
		<?php if (!empty($rowFAWDetail['File'])){?>
			<img height="40" width="40" src="../img/Attachment_Image/<?php echo $rowFAWDetail['File'];?>"
			title="Open File <?php echo $rowFAWDetail['File'];?>"
			onClick="popupwindow('../config/popup-img.php?id=<?php echo $rowFAWDetail['ID_No'];?>&name=<?php echo $rowFAWDetail['File'];?>&pg=filefaw','Preview Image','700','1000');"> <?php echo $rowFAWDetail['File'];} ?>
		</td>
		<td>
		<input type="text" class="form-control" name="InputKemasan[]" id="InputKemasan[]" 
		value="<?php echo $rowFAWDetail['Kemasan']; ?>"	readonly="readonly">
		</td>
		<td>
		<input type="text" class="form-control" name="InputPosisi[]" id="InputPosisi[]" 
		value="<?php echo $rowFAWDetail['Posisi']; ?>"	readonly="readonly">
		</td>
 
	</tr>
  <?php $no++;}} else {echo  '<tr>
  <td colspan="7" align="center">Tidak ada data yang ditampilkanl</td>
  </tr>';} ?>
</table>
<body>
<html>
	
 

