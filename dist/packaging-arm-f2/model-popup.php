
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Search FNIM</title>
		
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
		window.opener.document.getElementById('inputModelCode').value=input1;
		window.opener.document.getElementById('inputModelName').value=input2;
	    window.opener.close();
    }
</script>
	
	
	<body onload='setFocus();' > 
	<main> 
    <div class="container-fluid"><h3 class="mt-4">Search Model</h3>

   <div class="card mb-4">
    <form name="mpr" id="mpr" action="" method="post"    >

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
			<table width="100%" class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
				<th width="1%">No</th> 
				<th width="10%">Model Code</th> 
				<th width="20%">Description</th>
				<th width="1%">Apply</th>
				</tr>
			</thead>
			<tbody>
			<?php
			include "../../config/conn.php";

			// // Inisialisasi pencarian
			// $Search = isset($_GET['Search']) ? $_GET['Search'] : "";

			// Query dasar
			$query = "SELECT code AS ModelCode, descr AS ModelDesc, createdate FROM tb_ms_model msm";

			// Tambahkan filter jika ada
			if (@$Search == "") {
				$query = $query;
			} else {
				$query .= " WHERE msm.code LIKE '%$Search%' OR msm.descr LIKE '%$Search%'";
			}

			// Tambahkan urutan
			$query .= " ORDER BY msm.createdate DESC";

			// Eksekusi query
			$exe = mysqli_query($con, $query);

			// Periksa hasil
			if (mysqli_num_rows($exe) > 0) {
				$no = 1;
				while ($row = mysqli_fetch_assoc($exe)) {
			?>
				<tr> 
				<td><?php echo $no; ?></td>
				<td><?php echo htmlspecialchars($row['ModelCode']); ?></td>
				<td><?php echo htmlspecialchars($row['ModelDesc']); ?></td>
				<td align="center">
					<button type="button" style="padding:2px 4px 2px 2px" class="btn btn-outline btn-default"
					onClick="javascript:changeparent('<?php echo addslashes($row['ModelCode']); ?>','<?php echo addslashes($row['ModelDesc']); ?>');window.close();">
					<span class="fa fa-check" title="Apply MPR"></span>
					</button>
				</td>
				</tr>
				<?php
						$no++;
					}
				} else {
				?>
					<tr> 
					<td colspan="4">No data available in table</td>
					</tr>
				<?php
				}
				?>
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
   

    </body>
</html>
