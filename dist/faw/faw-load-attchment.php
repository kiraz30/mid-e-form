  <?php 
	include "../../config/connect.php";
	$cfmcode	 	=  @$_POST['data1'];
	$reqno 			=  @$_POST['data2'];

	$exe =mysqli_query($con,"SELECT ID_No,Request_No,Status_FAW FROM tb_faw where Request_No = '".$reqno."' ");
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
    <td colspan="7" align="left"><strong>Attachment File FAW (.jpg|.JPG|.jpeg|.JPEG|.png|.gif)</strong></td>
  </tr>
  <tr valign="bottom" align="center" bgcolor="#999999" >
	<th width="1%">No</th>
	<th width="20%">CFM File</th>
	<th width="20%">Kemasan</th>
	<th width="20%">Posisi</th>
	<th width="20%">FAW File</th>
	<th width="1%">Komentar</th>
  </tr>
  <?php 
	if(empty($cfmcode)) { ?>
  <tr>
    <td colspan="7" align="center">Tidak ada data yang ditampilkan</td>
  </tr>
  <?php
	} else {
	$Tanya = mysqli_query($con,"SELECT a.Request_No FROM tb_faw a Inner Join tb_faw_file b ON a.Request_No=b.Request_No 
	WHERE a.Request_No = '".$reqno."' And a.CFM_Code = '".$cfmcode."'   ");
	if (mysqli_num_rows($Tanya) ==0 ) {
		$exe = mysqli_query($con,"SELECT ID_No,File,Kemasan,Posisi,Index_No 
		FROM tb_cfm_file Where Request_No  = '".$cfmcode."'");
		$no = 1;
		while(@$rowCFMFile =mysqli_fetch_array($exe)){
	?>
  <tr id="<?php echo $rowCFMFile['ID_No']; ?>">
		<td><?php echo $no; ?></td>
		<td><input type="hidden" name="tempItemDetail[]" id="tempItemDetail[]">
		<input type="hidden" name="tempCFMDetail[]" id="tempCFMDetail[]" value="<?php echo $rowCFMFile['ID_No']; ?>">
			<?php if (!empty($rowCFMFile['File'])){?>
			<img height="40" width="40" src="../img/Attachment_Image/<?php echo $rowCFMFile['File'];?>"
			title="Open File <?php echo $rowCFMFile['File'];?>"
			onClick="popupwindow('../config/popup-img.php?id=<?php echo $rowCFMFile['ID_No'];?>&name=<?php echo $rowCFMFile['File'];?>&pg=filecfm','Preview Pdf','700','1000');">
			<?php echo $rowCFMFile['File'];} ?>
		</td>	
		<td>
		<input type="text" class="form-control" name="InputKemasan[]" id="InputKemasan[]" 
		value="<?php echo $rowCFMFile['Kemasan']; ?>"	readonly="readonly">
		</td>
		<td>
		<input type="text" class="form-control" name="InputPosisi[]" id="InputPosisi[]" 
		value="<?php echo $rowCFMFile['Posisi']; ?>"	readonly="readonly">
		</td>
		
		<td><input type="file" name="inputFile[]" id="inputFile[]" class="form-control"
			style="padding:2px 2px 2px 2px" OnChange="return validasiFileFoto()" <?php echo $disabled; ?> required>
		</td>
		<td align="justify"><button  type="button"  class="btn btn-primary"
		 onClick="popupwindow('../dist/page.php?form=cfm-comment&id=<?php echo $rowCFMFile['ID_No'];?>	&pg=cfm-comment','CFM','400','1000');">History</button>	</td>
	</tr>
<?php $no++;}
	} else {
	$exe = mysqli_query($con,"SELECT a.ID_No,a.ID_No_CFM_File,b.`File` AS FileCFM ,a.`File` ,a.Kemasan,a.Posisi,a.Index_No 
	FROM tb_faw_file a INNER JOIN tb_cfm_file b ON a.ID_No_CFM_File =b.ID_No Where a.Request_No = '".$reqno."'");
	if (mysqli_num_rows($exe) !=0 ) {
		$no = 1;
		while(@$rowFAWDetail =mysqli_fetch_array($exe)){
?>
	<tr id="<?php echo $rowFAWDetail['ID_No']; ?>">
		<td><input type="hidden" name="tempCFMDetail[]" id="tempCFMDetail[]" value="<?php echo $rowFAWDetail['ID_No_CFM_File']; ?>">
			<input type="hidden" name="tempItemDetail[]" id="tempItemDetail[]" value="<?php echo $rowFAWDetail['ID_No']; ?>">
			<input type="hidden" name="tempfilelama[]" id="tempfilelama[]" value="<?php echo $rowFAWDetail['File'];?>"> 
			<?php echo $no; ?>
		</td>
		<td><?php if (!empty($rowFAWDetail['FileCFM'])){?>
			<img height="40" width="40" src="../img/Attachment_Image/<?php echo $rowFAWDetail['FileCFM'];?>" 
			title="Open File <?php echo $rowFAWDetail['FileCFM'];?>"
			onClick="popupwindow('../config/popup-img.php?id=<?php echo $rowFAWDetail['ID_No_CFM_File'];?>&name=<?php echo $rowFAWDetail['FileCFM'];?>&pg=filecfm','Preview Pdf','700','1000');"> <?php echo $rowFAWDetail['FileCFM'];} ?>
		</td>
		<td>
		<input type="text" class="form-control" name="InputKemasan[]" id="InputKemasan[]" 
		value="<?php echo $rowFAWDetail['Kemasan']; ?>"	readonly="readonly">
		</td>
		<td>
		<input type="text" class="form-control" name="InputPosisi[]" id="InputPosisi[]" 
		value="<?php echo $rowFAWDetail['Posisi']; ?>"	readonly="readonly">
		</td>
		<td><input type="file" name="inputFile[]" id="inputFile[]" class="form-control"
		style="padding:2px 2px 2px 2px" OnChange="return validasiFileFoto()" <?php echo $disabled; ?>>
		<?php if (!empty($rowFAWDetail['File'])){?>
			<img height="40" width="40" src="../img/Attachment_Image/<?php echo $rowFAWDetail['File'];?>"
			title="Open File <?php echo $rowFAWDetail['File'];?>"
			onClick="popupwindow('../config/popup-img.php?id=<?php echo $rowFAWDetail['ID_No'];?>&name=<?php echo $rowFAWDetail['File'];?>&pg=filefaw','Preview Image','700','1000');"> <?php echo $rowFAWDetail['File'];} ?>
		</td>
		<td align="justify"> 
				<button  type="button"  class="btn btn-primary"
		 onClick="popupwindow('../dist/page.php?form=faw-comment&id=<?php echo $rowCFMFile['ID_No'];?>&pg=cfm-comment','CFM','400','1000');">History</button>	</td>
	</tr>
  <?php $no++;}} else {echo  '<tr>
  <td colspan="7" align="center">Tidak ada data yang ditampilkan</td>
  </tr>';}}} ?>
</table>
<body>
<html>
	
 

