
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Search Supplier</title>
		
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
	document.fnim.Search.focus();
	document.fnim.Search.select();
	}
	function changeparent(doc1,doc2){
        var input1=doc1;
        var input2=doc2;
		window.opener.document.getElementById('inputSupplierCode').value=input1;
		window.opener.document.getElementById('inputName').value=input2;

        window.close();
    }
</script>
	
	
	<body onload='setFocus();' > 
	<main> 
    <div class="container-fluid">
      <h3 class="mt-4">Search Supplier </h3>

      <div class="card mb-4">
    <form name="fnim" id="fnim" action="" method="post"    >

   <?php
   	if($_POST){
    	$Search  	= @$_POST['Search'];
	}
	?>
   	<div class="card-header">
	<div class="form-group d-flex align-items-center justify-content-between mt-0 mb-1">
	<input class="form-control"  id="Search" name="Search"  
	maxlength="50" type="text" placeholder="Enter Search" value="<?php if ($_POST) {echo $Search;} ?>" /> 
	&nbsp; <button type="submit" style="padding:4px 4px 4px 4px" 
			   class="btn btn-primary" title="Search"  
					name="submit" id="submit"><span class="glyphicon glyphicon-search" ></span> </button></div></div>
         <div class="card-body"> 
          <div class="table-responsive">
<?php
 	 if(!empty($_GET["id"]))
	 {  ?>
		  <table width="100%" class="table table-striped table-bordered table-hover" id=" " >
              <thead>
                <tr>
				  <th width="1%">No</th> 
				  <th>Supplier Code</th> 
				  <th>Supplier Name</th>
                  <th>Address</th>
				  <th>Country</th>
				  <th>Apply</th>
                </tr>
              </thead>
			  <?php
			include "../../config/connect_sql.php";
			$query="SELECT Code,Name,Address,Country FROM Supplier";
			if(@$Search=="")	{
				$query =$query; }
			else{
				$query .= " Where Code like '%$Search%' or Name like '%$Search%' or 
				Address like '%$Search%' or Country like '%$Search%'";
			}
			$exe = odbc_exec($myConn,$query. " Order By Code Asc " );
			$no = 1;
			if (odbc_num_rows($exe) !=0 ) {
			while(@$row =odbc_fetch_array($exe)){
			?>
		 
			  <tr> 
			   
				<td><?php echo $no;?></td>
				<td><?php echo $row['Code'];?></td>
				<td><?php echo $row['Name'];?></td>
				<td><?php echo $row['Address'];?></td>
				<td><?php echo $row['Country'];?></td>
				<td align="center"><button style="padding:2px 2px 2px 2px" 
				onClick="javascript:changeparent('<?php echo $row['Code']; ?>','<?php echo $row['Name']; ?>','<?php echo $row['Name']; ?>');">
					<span class="fa fa-check" title="Apply NPRF">
					</span></button>
				</td>
			  </tr>
		 
			   <?php $no++;} } else {  ?>
			  <tr> 
				<td colspan="6">No data available in table</td>
			  </tr><?php }}?>
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
      $('#fnim').submit();
   });
});​
</script>
    </body>
</html>
