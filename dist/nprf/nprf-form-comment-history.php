<?php 

	include "../../config/conn.php";
	include "../../config/connect.php";
	$getDetail		= @$_POST['getDetail'];
	$AutoRequestNo	= @$_POST['AutoRequestNo'];
 ?>

<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example"  border="1">
	<thead>
        <tr>
			<th width="1%">No</th>
			<th width="20%">Remark <?php echo  $getDetail;  ?> </th>  
			<th width="12%">Created By</th> 
			<th width="15%"> Created Date</th> 
			<!--th width="5%">Status</th--> 
        </tr>
    </thead>
	<tbody>
		<?php
			$exeComment = mysqli_query($con,"SELECT ID_No,a.Request_No,a.WorkFlowMenu,LevelProcess,NameApproval,
			Index_No,Fild_Remark,Remark,CreatedBy,CreatedDate,CreatedHostName  FROM  tb_comment_approve a 
			WHERE Request_No ='".@$AutoRequestNo."' And Fild_Remark = '".@$getDetail."' ");
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
 

 