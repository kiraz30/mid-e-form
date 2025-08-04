<?php 

	include "../../config/conn.php";
	include "../../config/connect.php";
	$getDetail		= @$_POST['getDetail'];
	$WorkFlowMenu	= @$_POST['WorkFlowMenu'];
	$LevelProcess	= @$_POST['LevelProcess'];
	$username		= @$_POST['username'];
	$AutoRequestNo	= @$_POST['AutoRequestNo'];
	$Index_No		= @$_POST['Index_No'];
	$inputRemarkApp	= @$_POST['inputRemarkApp'];

 	$query="SELECT a.ID_No,a.Request_No,a.WorkFlowMenu,a.LevelProcess,a.NameApproval,
	a.Index_No,a.Fild_Remark,a.Remark FROM tb_comment_approve a 
	
	WHERE a.Request_No ='".@$AutoRequestNo."' And a.Fild_Remark = '".@$getDetail."' 
	And a.Index_No = '".@$Index_No."'";
	$exe =mysqli_query($con,$query);
    $tampildata=mysqli_fetch_array($exe);
	if (@$tampildata['Status_add_resource']<>"Draft" & @$tampildata['Status_add_resource']<>"Revise")
		  {$disabled="disabled";} else{$disabled="";}
	if (@$_POST['getDetail']<>"")
		  {$required="required";} else{$required="";}
?>	

<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example"  border="1">
	<thead>
        <tr>
			<th width="1%">No</th>
			<th width="20%">Remark</th>  
			<th width="12%">Created By</th> 
			<th width="15%"> Created Date</th> 
			<!--th width="5%">Status</th--> 
        </tr>
    </thead>
	<tbody>
		<?php
			$exeComment = mysqli_query($con,"SELECT ID_No,a.Request_No,a.WorkFlowMenu,LevelProcess,NameApproval,
			Index_No,Fild_Remark,Remark,CreatedBy,CreatedDate,CreatedHostName  FROM  tb_comment_approve a 
			WHERE Request_No ='".@$AutoRequestNo."' And Fild_Remark = '".@$getDetail."'  ");
			$no = 1;
			if (mysqli_num_rows($exeComment) !=0 ) {
			while(@$rowComment =mysqli_fetch_array($exeComment)){
			?>
        <tr>
			<th><?php echo  $no;  ?></th>
			<th><?php echo  $rowComment['Remark'];  ?></th>  
			<th><?php echo  $rowComment['CreatedBy'];  ?></th> 
			<th><?php echo  $rowComment['CreatedDate'];  ?></th> 
 
        </tr>
		<?php $no++;}} else {  ?>
			  <tr> 
				<td colspan="4">No data available in table</td>
			  </tr> 
			  <?php } ?>
    </tbody>
</table>
<form  name="arm-edit-detail" id="arm-edit-detail" method="post" >
<table width="100%" border="0" class="table table-striped" id="table table-striped" >
    <tr>
        <td width="30%"><span class="form-group">Remark <?php echo  $getDetail;  ?> * 
		</span></td>
        <td ><span class="form-group">
		<input name="tempAutoRequestNo" id="tempAutoRequestNo" type="hidden" value="<?php echo @$AutoRequestNo; ?>">
		<input name="tempID_No" id="tempID_No" type="hidden" value="<?php echo @$tampildata['ID_No']; ?>">
		<textarea cols="4"  id="inputRemarkApp" name="inputRemarkApp"  class="form-control py-4" 
		placeholder="Enter Remark" ></textarea>
            </span>  
		</td>	
	<tr>
        <td colspan="4"> 
		<button type="button" id="edit_form" name="edit_form" value="Save" 
		onclick="myFunction()" class="btn btn-primary">Save</button>
	</td>
    </tr>
</table>
</form>

<script type="text/javascript">

 function get_Del_form(){
  $('#inputRemarkApp').val("");
  $('#WorkFlowMenu').val("");
  $('#LevelProcess').val("");
  $('#username').val("");
 
 
 }
 function myFunction() {
	if(document.getElementById('inputRemarkApp').value==""){
		alert("Remark Can not be empty *");
		document.getElementById('inputRemarkApp').focus();
        return false;  }
		let text = "Are you sure you want to Save this?";
		if (confirm(text) == true) {
			 
			get_save_form();
			document.getElementById("myClose").click();
		} 
	}	

function get_save_form(){
  var tempID_No 			= $('#tempID_No').val();
  var getDetail 			= '<?php echo @$getDetail; ?>';
  var WorkFlowMenu 			= '<?php echo @$WorkFlowMenu; ?>';
  var LevelProcess 			= '<?php echo @$LevelProcess; ?>';
  var Index_No 				= '<?php echo @$Index_No; ?>';
  var username 				= '<?php echo @$username; ?>';
  var tempAutoRequestNo		= $('#tempAutoRequestNo').val();
  var inputRemarkApp	  	= $('#inputRemarkApp').val();
  $.ajax({
   type: 'POST',
   url: "nprf/nprf-form-comment-save.php",
   
   data: {tempID_No		: tempID_No,
	getDetail			: getDetail,
	tempAutoRequestNo	: tempAutoRequestNo,
	inputRemarkApp 		: inputRemarkApp,
	WorkFlowMenu		: WorkFlowMenu,
	LevelProcess		: LevelProcess,
	username			: username,
	Index_No			: Index_No},
   success: function(info) {
	setFocus();
	}
  });
  return false;
 }
</script> 


 