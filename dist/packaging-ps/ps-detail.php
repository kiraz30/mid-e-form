   		<?php 
		    include "../../config/connect.php";
			
		$armid						= @$_POST['data1'];
		$mprid 						= @$_POST['data2'];
		$reqno 						= @$_POST['data3'];
		$FinishGoodCode				= @$_POST['data4'];
		$exe =mysqli_query($con,"SELECT ID_No,Request_No,Status_Spec FROM tb_packdev_spec where Request_No = '".@$reqno."' ");
		$tampildata=mysqli_fetch_array(@$exe);
		//________________________________________________________________________________StatusMPR disabled
 		  if (@$tampildata['Status_Spec']<>"Draft" & @$tampildata['Status_Spec']<>"Revise" 
		& @$tampildata['Status_Spec']<>""  )
		  {$disabled="disabled";} else{$disabled="";}
	 
		?>
 
			<table width="100%" class="table table-striped table-bordered table-hover" 
			id="ps-detail" name="ps-detail">
              <thead>
			  <th colspan="5">
					 
				  
					 <button type="button" class='btn btn-primary' data-toggle='modal' <?php echo $disabled; ?> 
					 data-target='#add' data-id="">Add</button>
				 </th>
			  <tr bgcolor="#999999">
				  <th width="1%">No <!--?php echo $reqno ; ?--></th> 
				  <th width="10%">Packaging Material</th> 
				  <th width="20%">Packaging Material Name</th> 
				  <th width="20%">Status  </th> 
                  <th width="5%">Action</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
				  <th>No</th> 
				  <th>Packaging Material</th> 
				  <th>Packaging Material Name  </th> 
				  <th>Status </th> 
                  <th>Action</th>
                </tr>
              </tfoot>
              <tbody>
          	<?php
				$query="SELECT b.ID_No,b.Packaging_Material,b.Packaging_Material_Name,
				b.Vendor_Code,b.Vendor_Name,b.Status 
				FROM tb_packdev_spec a INNER JOIN tb_packdev_spec_detail b ON a.Request_No =b.Request_No
				Where a.Request_No ='$reqno' ";
				$exe = mysqli_query($con,$query);
				if (mysqli_num_rows($exe) !=0 ) {
				$no = 1;
				while(@$rowPS =mysqli_fetch_array($exe)){
			 
				?>
				<tr> 
					<td><?php echo $no;?></td>
					<td><input type="hidden" name="tempID_No[]" id="tempID_No[]" 
						value="<?php echo $rowPS['ID_No']; ?>">
						<?php echo $rowPS['Packaging_Material'];?> </td>
					<td><?php echo $rowPS['Packaging_Material_Name'];?> </td>
					<td><?php echo $rowPS['Status'];?> </td>
					<td align="center">
						
					<button type="button" style="padding:2px 4px 2px 2px"  
					class="btn btn-outline btn-default" data-toggle='modal' data-target='#add' 
					data-id="<?php echo $rowPS['ID_No'];?>">
					<span class="glyphicon glyphicon-edit edit_data" title="Edit / View Detail "></span></button>	
					<button type="button" style="padding:2px 4px 2px 2px"  
					class="btn btn-danger btn_del"
					id="<?php echo $rowPS['ID_No']?>" name="<?php echo $rowPS['Packaging_Material'];?>" <?php echo $disabled; ?>  >
					<span class="glyphicon glyphicon-trash delete_form" title="Delete Request"></span>
					</button>
					</td>
		
					
				</tr>
				<?php $no++;}}
			   ?>
              </tbody>
            </table>
			<script>
$(document).ready(function(){
 $('.btn_del').on('click', function(){
  var id = $(this).attr('id');
  var name = $(this).attr('name');
  if(confirm("Are you sure you want to remove this?"+name))
	{
		$.ajax({
		type: "POST",
		url: "../config/delete-exe.php?pg=del-ps-detail&id="+id,
		data:{id: id},
		success: function(info) {
			get_PackagingPSDetail();
		}
  		});
	}
  
 });
}); 
</script>

 
 
