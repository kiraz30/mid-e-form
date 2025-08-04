  <?php 
	include "../../config/connect.php";
	$fawcode	 	= @$_POST['data1'];
	$button			= @$_POST['data2'];
	$exe =mysqli_query($con,"SELECT ID_No,Request_No,Status_FAW FROM tb_faw where Request_No = '".$fawcode."' ");
    $tampildata=mysqli_fetch_array(@$exe);
	//________________________________________________________________________________StatusFAW disabled
	if (@$tampildata['Status_FAW']<>"Draft" & @$tampildata['Status_FAW']<>"Revise" & @$tampildata['Status_FAW']<>"")
		  {$disabled="disabled";} else{$disabled="";}
	?>
<html>
<head> </head>

<body> 	
<table name="cfmfile" id="cfmfile" class="table table-striped table-bordered table-sm" >
  <tr>
    <td colspan="7" align="left"><strong>CHECK antara "ARTWORK" dengan "MANUSCRIPT"</strong></td>
  </tr>
  <tr>
    <td colspan="7" align="left">  <?php 
	
	$exe = mysqli_query($con,"SELECT a.Checklist_Code,a.Question FROM tb_faw_master_check a ");
		while(@$rowFAWMasterCheck =mysqli_fetch_array($exe)){
		echo $rowFAWMasterCheck['Checklist_Code'].". ". $rowFAWMasterCheck['Question']."<br>" ;}
		  ?>
	</td>
  </tr>
  <tr>
					<td colspan="7" align="left"><strong>Checklist Workflow</strong></td>
			  	</tr>
				<tr valign="bottom" align="center" bgcolor="#999999" >
					<th width="5%">Check Point</th>
					<th width="10%">Requestor <br><?php if (@$tampildata['Status_FAW']=="Revise") {
					echo ShowDivisiFAWRevise('DivisionName',@$tampildata['Request_No'],'FAW','Step 1');}
					else {ShowDivisiFAWApprove('DivisionName',@$tampildata['Request_No'],'FAW','Step 1');}?></th>
					<th width="10%"><?php if (@$tampildata['Status_FAW']=="Revise") {
					echo ShowDivisiFAWApprove('DivisionName',@$tampildata['Request_No'],'FAW','Step 2');}
					else {ShowDivisiFAWApprove('DivisionName',@$tampildata['Request_No'],'FAW','Step 2');}?></th>
					<th width="10%"><?php if (@$tampildata['Status_FAW']=="Revise") {
					echo ShowDivisiFAWApprove('DivisionName',@$tampildata['Request_No'],'FAW','Step 3');}
					else {ShowDivisiFAWApprove('DivisionName',@$tampildata['Request_No'],'FAW','Step 3');}?></th>
					<th width="10%"><?php if (@$tampildata['Status_FAW']=="Revise") {
					echo ShowDivisiFAWApprove('DivisionName',@$tampildata['Request_No'],'FAW','Step 4');}
					else {ShowDivisiFAWApprove('DivisionName',@$tampildata['Request_No'],'FAW','Step 4');}?></th>
					<th width="10%"><?php if (@$tampildata['Status_FAW']=="Revise") {
					echo ShowDivisiFAWApprove('DivisionName',@$tampildata['Request_No'],'FAW','Step 5');}
					else {ShowDivisiFAWApprove('DivisionName',@$tampildata['Request_No'],'FAW','Step 5');}?></th>
					<th width="10%"><?php if (@$tampildata['Status_FAW']=="Revise") {
					echo ShowDivisiFAWApprove('DivisionName',@$tampildata['Request_No'],'FAW','Step 6');}
					else {ShowDivisiFAWApprove('DivisionName',@$tampildata['Request_No'],'FAW','Step 6');}?></th>
				</tr>
				<?php 
				$exe = mysqli_query($con,"Select Checklist_Code, Question  FROM tb_faw_master_check  ");
			if (mysqli_num_rows($exe) !=0 ) {
				$no = 1;
				while(@$rowFAWCheck =mysqli_fetch_array($exe)){
		?>
			  <tr >
					<td>
					<?php echo $rowFAWCheck['Checklist_Code']; ?>
					</td>	
 					<td align="center">
					<?php 
					ShowDataChecklistAppFAW("Result",@$rowFAWCheck['Checklist_Code'],@$fawcode,1);
					 ?>
					</td>
					<td  align="center">
					<?php 
					ShowDataChecklistAppFAW("Result",@$rowFAWCheck['Checklist_Code'],@$fawcode,2);
					 ?>
					</td>
					<td  align="center">
					<?php 
					ShowDataChecklistAppFAW("Result",@$rowFAWCheck['Checklist_Code'],@$fawcode,3);
					 ?>
					</td>
					<td align="center">
					<?php 
					ShowDataChecklistAppFAW("Result",@$rowFAWCheck['Checklist_Code'],@$fawcode,4);
					 ?>
					</td>
					<td align="center">
					<?php 
					ShowDataChecklistAppFAW("Result",@$rowFAWCheck['Checklist_Code'],@$fawcode,5);
					 ?>
					</td>
					<td align="center">
					<?php 
					ShowDataChecklistAppFAW("Result",@$rowFAWCheck['Checklist_Code'],@$fawcode,6);
					 ?>
					</td>
				</tr>  <?php $no++;}}?>
  <tr valign="bottom" align="center" bgcolor="#999999" >
	<th width="5%">Check Point <span class="glyphicon glyphicon-info-sign" 
	
	title="Check Point"></span></th>
	<th width="50%" colspan="5">Description</th>
	<th width="5%">Yes / No</th>
  </tr>
  <?php 
	if(empty($fawcode)) { ?>
  <tr>
    <td colspan="7" align="center">Tidak ada data yang ditampilkan</td>
  </tr>
  <?php
	} else {
	$Tanya = mysqli_query($con,"SELECT Request_No FROM tb_faw_check_app 
	Where Request_No = '".$fawcode."'   ");
	if (mysqli_num_rows($Tanya) ==0 ) {
		$exe = mysqli_query($con,"SELECT a.Checklist_Code,a.Question,b.Result,b.Workflow_Index_No FROM tb_faw_master_check a
INNER JOIN  tb_faw_master_check_app b ON  a.Checklist_Code=b.Checklist_Code
 AND b.Workflow_Index_No=1  ");
		$no = 1;
		while(@$rowFAWMasterCheck =mysqli_fetch_array($exe)){

	?>
  <tr id="<?php echo $rowFAWMasterCheck['ID_No']; ?>">
		<td><input type="hidden" name="tempFAWCheck[]" id="tempFAWCheck[]" 
		value="<?php echo $rowFAWMasterCheck['Checklist_Code']; ?>">
		<input type="hidden" name="tempFAWMasterCheck[]" id="tempFAWMasterCheck[]" value="<?php echo $rowFAWMasterCheck['ID_No']; ?>">
		<?php echo $rowFAWMasterCheck['Checklist_Code']; ?>
		</td>	
		<td colspan="5">
		<?php echo $rowFAWMasterCheck['Question']; ?>
		</td>
		<td>
		
		<select class="form-control" name="InputResult[]" 
		<?php if (@$tampildata['Status_FAW']=="Complete"  & $button=="add-revise-faw") 
		  {echo "disabled=' '";}  else {echo $disabled;}  ?> >
			<option value="1" <?php if (@$rowFAWMasterCheck['Result']=='1') {echo "Selected"; }?>>Yes </option>
            <option value="0" <?php if (@$rowFAWMasterCheck['Result']=='0') {echo "Selected";} ?>>No</option>
         </select>
		</td>
 	</tr>
<?php $no++;}
	} else {
	$exe = mysqli_query($con,"SELECT a.Checklist_Code,a.Question,b.Result,b.Workflow_Index_No FROM tb_faw_master_check a
INNER JOIN  tb_faw_check_app b ON  a.Checklist_Code=b.Checklist_Code
 AND b.Workflow_Index_No=1 WHERE b.Request_No = '$fawcode'");
	if (mysqli_num_rows($exe) !=0 ) {
		$no = 1;
		while(@$rowFAWCheck =mysqli_fetch_array($exe)){
?>
  <tr id="<?php echo $rowFAWCheck['ID_No']; ?>">
		<td><input type="hidden" name="tempFAWCheck[]" id="tempFAWCheck[]" 
		value="<?php echo $rowFAWCheck['Checklist_Code']; ?>">
		<input type="hidden" name="tempFAWMasterCheck[]" id="tempFAWMasterCheck[]" value="<?php echo $rowFAWCheck['ID_No']; ?>">
		<?php echo $rowFAWCheck['Checklist_Code']; ?>
		</td>	
		<td colspan="5"> <?php echo $button;?>
		<?php echo $rowFAWCheck['Question']; ?>
		</td>
		<td>
		 <select class="form-control" name="InputResult[]"
		 <?php if ($button!="add-revise-faw")  
		   {echo $disabled;}  ?> >
			<option value="1" <?php if (@$rowFAWCheck['Result']=='1') {echo "Selected"; }?>>Yes </option>
            <option value="0" <?php if (@$rowFAWCheck['Result']=='0') {echo "Selected";} ?>>No</option>
         </select>
		</td>
 	</tr>  <?php $no++;}} else {echo  '<tr>
  <td colspan="7" align="center">Tidak ada data yang ditampilkan</td>
  </tr>';}}} ?>
</table>
<body>
<html>
	
 

