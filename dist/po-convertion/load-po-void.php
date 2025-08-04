<table name="po-void" id="po-void"  width="120%" border="1"  class="table table-striped table-bordered table-sm" >
              <thead>
                <tr>
				  <th width="1%"><script> function toggle(pilih) { 
			checkboxes = document.getElementsByName('chk[]'); 
			for(var i=0, n=checkboxes.length;i<n;i++) { checkboxes[i].checked = pilih.checked; 
			} } </script> <input type="checkbox" onClick="toggle(this)" title="Select All" /></th>
				  <th>PO Number</th> 
                  <th>Rev</th>
				  <th>PO Date</th>
				  <th>Status</th>
				  <th>Curr</th>
				  <th>Total DPP</th>
				  <th>Supplier Code</th> 
				  <th>Supplier</th> 
				  <th>Created Date</th> 
                  <th width="1%">Action</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
				  <th><button name="ApprovePO" id="ApprovePO" type="submit" value="Approve"style="padding:1px 1px 1px 1px;"> 
				  <span class="glyphicon glyphicon-check" title="Update PO Status"></span></button>
				   </th>
				  <th>PO Number</th> 
                  <th>Rev</th>
				  <th>PO Date</th>
				  <th>Status</th>
				  <th>Curr</th>
				  <th>Total DPP</th>
				  <th>Supplier Code</th> 
				  <th>Supplier</th> 
				  <th>Created Date</th> 
                  <th>Action</th>
                </tr>
              </tfoot>
              <tbody>
 <?php
			include "../config/connect_sql.php";
			$query = "SELECT Id,No,Type,VersionNo,TransactionDate,WorkflowStatus,TransactionStatus,
			Currency,SupplierCode,SupplierName,TotalDPP,CreatedAt from POHeader Where TransactionStatus='Void' ";
			if ($SearchCode<>""){
				$query= $query. " And No like '%$SearchCode%'";}
			if ($SearchName<>""){
				$query= $query. " And SupplierCode like '%$SearchName%'";}
			$exe = odbc_exec($myConnPO,$query. " Order By No Asc " );
		
			$no = 1;
			while(@$row =odbc_fetch_array($exe)){
			?>
			  <tr id="<?php echo $row['No']; ?>"> 
				<td><input type="checkbox" name="chk[]" id="chk[]" value="<?php echo $row['No']; ?>"></td>
				<td><?php echo $row['No'];?></td>
				<td><?php echo $row['VersionNo'];?></td>
				<td><?php echo $row['TransactionDate'];?></td>
				<td><?php echo $row['WorkflowStatus']. " - ".$row['TransactionStatus'];?></td>
				<td><?php echo $row['Currency'];?></td>
				<td><?php echo number_format($row['TotalDPP'],2);?></td>
				<td><?php echo $row['SupplierCode'];?></td>
				<td><?php echo $row['SupplierName'];?></td>
				<td><?php echo $row['CreatedAt'];?></td>
				<td align="center"><a href="../dist/index.php?button=po-approve&id=<?php echo $row['No'];?>" 
				onClick=" return checkApprove()">
					<span class="glyphicon glyphicon-check" title="Approve PO No <?php echo $row['No'];?>"> </span>
					
					</a> 
				 </td>
			  </tr>
			  <?php $no++;} ?>

              </tbody>
            </table>
<script>
function deleteRow() {
			try {
			var table = document.getElementById('fnimdetail');
			var rowCount = table.rows.length;

			for(var i=0; i<rowCount; i++) {
				var row = table.rows[i];
				var chk = row.cells[0].childNodes[0];
				if(null != chk && true == chk.checked) {
					table.deleteRow(i);
					rowCount--;
					i--;
				}
			}
			}catch(e) {
				alert(e);
			}
		}
</script>

 
<script>
$(document).ready(function(){
 //Delete Technical Document_______________________________________________________
 $('#btnDeleteMPR').click(function(){
  
  if(confirm("Are you sure you want to delete this?"))
  {
   var DelMPR = [];
   
   $(':checkbox:checked').each(function(i){
    DelMPR[i] = $(this).val();
   });
   if(DelMPR.length === 0) //tell you if the array is empty
   {
    alert("Please Select atleast one checkbox");
   }
   else
   {
    $.ajax({
     url:'../config/delete.php',
     method:'POST',
     data:{DelMPR:DelMPR},
     success:function()
     {
      for(var i=0; i<DelMPR.length; i++)
      {
       $('tr#'+DelMPR[i]+'').css('background-color', '#ccc');
       $('tr#'+DelMPR[i]+'').fadeOut('slow');
	   deleteRow();
      }
     }
    });
   }
  }
  else
  {
   return false;
  }
 });
 //___________________________________________________________

});
</script>
