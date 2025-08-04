   		<?php 
		    include "../../config/connect.php";
			
		$armid 						= @$_POST['data2'];
		$exe =mysqli_query($con,"SELECT ID_No,Request_No,Status_add_resource FROM tb_packdev_add_resource where Request_No = '".@$armid."' ");
		$tampildata=mysqli_fetch_array(@$exe);
		//________________________________________________________________________________StatusMPR disabled
 		  if (@$tampildata['Status_add_resource']<>"Draft" & @$tampildata['Status_add_resource']<>"Revise" 
		& @$tampildata['Status_add_resource']<>""  )
		  {$disabled="disabled";} else{$disabled="";}
	 
		?>
 
			<table width="100%" class="table table-striped table-bordered table-hover" 
			id="arm-detail" name="arm-detail">
              <thead>
			  <tr bgcolor="#999999">
				  <th colspan="5">
					 
				  
					<button type="button" class='btn btn-primary' data-toggle='modal' <?php echo $disabled; ?> 
					data-target='#add' data-id="">Add</button>
				</th> 
 
                </tr>
                <tr bgcolor="#999999">
				  <th width="1%">No</th> 
				  <th width="10%">Finish Good Code</th> 
				  <th width="20%">Finish Good Code Name  </th> 
				  <th width="20%">Material Name  </th> 
                  <th width="5%">Action</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
				<th>No</th> 
				  <th>Finish Good Code</th> 
				  <th>Finish Good Code Name  </th> 
				  <th>Material Name  </th> 
                  <th>Action</th>
                </tr>
              </tfoot>
              <tbody>
          <?php
		  	$query="SELECT ID_No,Request_No,FinishGoodCode,FinishGoodName,Material_Name
			FROM tb_packdev_add_resource_detail Where Request_No ='$armid' ";
			$exe = mysqli_query($con,$query);
			$no = 1;
			while(@$row =mysqli_fetch_array($exe)){
			?>
			  <tr > 
				<td><?php echo $no;?></td>
				<td><?php echo $row['FinishGoodCode'];?> </td>
				<td><?php echo $row['FinishGoodName'];?> </td>
				<td><?php echo $row['Material_Name'];?> </td>
				<td align="center">
					
				<button type="button" style="padding:2px 4px 2px 2px"  
				class="btn btn-outline btn-default" data-toggle='modal' data-target='#add' 
				data-id="<?php echo $row['ID_No'];?>">
				<span class="glyphicon glyphicon-edit edit_data" title="Edit / View Detail "></span></button>	
				<button type="button" style="padding:2px 4px 2px 2px"  
				class="btn btn-danger btn_del"
				id="<?php echo $row['ID_No']?>" id="<?php echo $row['ID_No'];?>" <?php echo $disabled; ?>  >
				<span class="glyphicon glyphicon-trash delete_form" title="Delete Request"></span>
			</button></td>
	 
				 
			  </tr>
			  <?php $no++;} ?>
              </tbody>
            </table>


<script>
$(document).ready(function(){
 $('.btn_del').on('click', function(){
  var id = $(this).attr('id');
  if(confirm("Are you sure you want to remove this?"+id))
	{
		$.ajax({
		type: "POST",
		url: "../config/delete-exe.php?pg=del-arm-detail&id="+id,
		data:{id: id},
		success: function(info) {
			get_PackagingARMDetail();
		}
  		});
	}
  
 });
}); 
</script>
 
