
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Search Packaging Material</title>
		
        <link href="../../css/styles.css" rel="stylesheet" />
		<link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	
		<!-- MetisMenu CSS -->
		<link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
	
		<!-- Custom CSS -->
		<link href="../../css/sb-admin-2.css" rel="stylesheet">
	
		<!-- Custom Fonts -->
		<link href="../../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
		
		<link href="../../vendor/datatables/css/dataTables.bootstrap4.min.css" rel="stylesheet">
        <!--script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script-->
		 
    </head>
	<script language="JavaScript">
	function setFocus(){
	document.mpr.Search.focus();
	document.mpr.Search.select();
	}
	function changeparent(doc1,doc2){
        var input1=doc1;
		var input2=doc2;
		window.opener.document.getElementById('inputResourceCode').value=input1;
		window.opener.document.getElementById('inputPMName').value=input2;
	    window.opener.close();
    }
</script>
		
	<body onload='setFocus();' > 
	<main> 
    <div class="container-fluid"><h3 class="mt-4">Search Packaging Material</h3>

   <div class="card mb-4">
    <form name="mpr" id="mpr" action="" method="post"    >

   <?php
   include "../../config/connect_sql.php";
   	if($_POST){
    	$Search  	= @$_POST['Search'];
	}
	?>
   	<div class="card-header">
	<div class="form-group d-flex align-items-center justify-content-between mt-0 mb-1">
	<input class="form-control"  id="Search" name="Search"  
	maxlength="50" type="text" placeholder="Enter Search" value="<?php if ($_POST) {echo $Search;} ?>" /> 
	&nbsp; <button type="submit" style="padding:4px 4px 4px 4px;text-transform:uppercase"
			   class="btn btn-primary" title="Search"  
					name="submit" id="submit"><span class="glyphicon glyphicon-search" ></span> </button></div></div>
         <div class="card-body"> 
          <div class="table-responsive">
		  <table width="100%" class="table table-striped table-bordered table-hover" id=" " >
              <thead>
                <tr>
				  <th width="1%">No</th> 
				  <th width="10%">Packaging Material </th> 
				  <th width="20%">Packaging Material  Name</th>
				  <th width="10%">Apply</th>
                </tr>
              </thead>
			  <?php
			  	$query = "select top 2000 I_ITEM_CD,I_FULL_NAME from MD_PROD_ResourceMaster
				  where (I_ITEM_CD Like 'C%' Or I_ITEM_CD Like 'M%' Or  I_ITEM_CD Like 'P%' Or I_ITEM_CD Like 'S%')
				  and Specif <>'999999' and CatCodesCode1 <> 'FINISHED GOODS' ";
	 			if(@$Search=="")	{
					$query =$query;
				 }else{
					$query =$query. " And I_ITEM_CD like '%".$Search."%' or I_FULL_NAME  like '%".$Search."%' ";
			}
			$exe = sqlsrv_query ($myConnFlex,$query.  " Order By I_ITEM_CD Asc");	
			$no =1;
			while(@$row =sqlsrv_fetch_array ($exe)){

		
			?>
		 	<tbody>
			  <tr> 
				<td><?php echo $no;?></td>
				<td><?php echo $row['I_ITEM_CD'];?></td>
				<td><?php echo $row['I_FULL_NAME'];?></td>
				<td align="center">
					<button type="button" style="padding:2px 4px 2px 2px" class="btn btn-outline btn-default"
				onClick="javascript:changeparent('<?php echo $row['I_ITEM_CD']; ?>','<?php echo $row['I_FULL_NAME']; ?>');javascript:window.close();">
					<span class="fa fa-check" title="Apply Vendor">
					</span></button>
				</td>
				</td>
			  </tr>
			  
			   <?php   $no++;  }   ?>
			  
              </tbody>
            </table>
			

		</div>
        </div>

 		</form>
      </div>
	  
	 </div>
    </main> 
	</body>
	
    <script src="../../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="../../vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="../../vendor/datatables-responsive/dataTables.responsive.js"></script>
    <script>
    $(document).ready(function() {
        $('#dataTables').DataTable({
            responsive: true
        });
    });
    </script>
	<script type="text/javascript">
$(document).ready(function(){
   $('#Search').live('blur',function(){
      $('#mpr').submit();
   });
});​
</script>
<script type="text/javascript">
 $("a[id^=show_]").click(function(event) {
    $("#extra_" + $(this).attr('id').substr(5)).slideToggle("slow");
    event.preventDefault();
})
</script>

    </body>
</html>
