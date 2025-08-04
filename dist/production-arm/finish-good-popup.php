
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
		window.opener.document.getElementById('inputFinishGoodCode').value=input1;
		window.opener.document.getElementById('inputFinishGoodName').value=input2;
	    window.opener.close();
    }
</script>
	
	
	<body onload='setFocus();' > 
	<main> 
    <div class="container-fluid"><h3 class="mt-4">Search Finish Goods</h3>

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
		  <table width="100%" class="table table-striped table-bordered table-hover" id=" " >
              <thead>
                <tr>
				  <th width="1%">No</th> 
				  <th width="10%">Finish Good Code</th> 
				  <th width="20%">Finish Good Name</th>
				  <th width="1%">Apply</th>
                </tr>
              </thead>
			  <?php
			include "../../config/connect_sql.php";
			
			$query="SELECT 
			T0.PrimUM as UOM, 
			T0.ResourceUK as ProductCode, 
			T2.aofname as ProductDesc, 
			T2.aonettw Netto
			FROM fdBasResc T0
			INNER JOIN AOSTOCKSTATUS T1 ON T1.ParentObjectID = T0.ObjectID AND T1.ParentClassID = 10153
			INNER JOIN AORESOURCEINFO T2 ON T2.ParentObjectID = T0.ObjectID AND T2.ParentClassID = 10153
			LEFT JOIN AORESCADDONINFO T12 ON T12.ParentObjectID = T0.ObjectID AND T12.ParentClassID = 10153
			LEFT JOIN bcconvfactor X ON X.UMCnvFctrRescOID=T0.ObjectID AND X.UMCnvFctrFromToUM ='CTN_DZ'
			LEFT JOIN bcconvfactor Y ON Y.UMCnvFctrRescOID=T0.ObjectID AND Y.UMCnvFctrFromToUM ='CTN_PCS'
			WHERE T0.ResourceUKInstType = 0
			AND T1.aoiact = 0
			AND T0.Specif <> '999999'
			AND T0.CatCodesCode1 = 'FINISHED GOODS' ";
			if(@$Search=="")	{
				$query =$query; }
			else{
				$query .= " And (T0.ResourceUK like '%$Search%' or T2.aofname  like '%$Search%')";
			}

			$exe = sqlsrv_query($myConnFlex,$query." Order by T0.DateCreated desc"  );
			$row_count = sqlsrv_num_rows($exe);
			if ($row_count == false){

			while(@$row = sqlsrv_fetch_array($exe)){			 
			$no = 1;
		 
			?>
		 
			  <tr> 
				<td><?php echo $no;?></td>
				<td><?php echo $row['ProductCode'];?></td>
				<td><?php echo $row['ProductDesc'];?></td>
				<td align="center">
					<button type="button" style="padding:2px 4px 2px 2px" class="btn btn-outline btn-default"
				onClick="javascript:changeparent('<?php echo $row['ProductCode']; ?>','<?php echo $row['ProductDesc']; ?>');javascript:window.close();">
					<span class="fa fa-check" title="Apply MPR">
					</span></button>
				</td>
				</td>
			  </tr>
			  
			  <?php $no++;} } else {  ?>
			  <tr> 
				<td colspan="6">No data available in table</td>
			  </tr><?php }?>
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
