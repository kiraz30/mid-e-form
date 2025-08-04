
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
	function changeparent(doc1,doc11,doc2,doc22,doc3,doc4,doc5,doc6,doc7,doc8){
        var input1=doc1;
		var input11=doc11;
        var input2=doc2;
		var input22=doc22;
		var input3=doc3;
		var input4=doc4;
		var input5=doc5;
		var input6=doc6;
		var input7=doc7;
		var input8=doc8;
		window.opener.document.getElementById('InputFNIMCode').value=input11;
		window.opener.document.getElementById('InputTempFNIMCode').value=input1;
		window.opener.document.getElementById('inputID_No_FNIM_Detail').value=input2;
		window.opener.document.getElementById('inputProductCode').value=input22;
		window.opener.document.getElementById('inputProductName').value=input3;
		window.opener.document.getElementById('inputNetto').value=input4;
		window.opener.document.getElementById('inputRequestType').value=input5;
		window.opener.document.getElementById('inputID_No_FNIM_Country').value=input6;
		window.opener.document.getElementById('inputCountry').value=input7;
		window.opener.document.getElementById('InputStatus').value=input8;
	    window.opener.close();
    }
</script>
	
	
	<body onload='setFocus();' > 
	<main> 
    <div class="container-fluid"><h3 class="mt-4">Search FNIM</h3>

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
<?php
 	 if(!empty($_GET["id"]))
	 {  ?>
		  <table width="100%" class="table table-striped table-bordered table-hover" id=" " >
              <thead>
                <tr>
				  <th width="1%">No</th> 
				  <th width="10%">Request No</th> 
				  <th width="20%">Project Name</th>
				  <th width="10%">Type Request</th>
				  <th width="10%">Apply</th>
                </tr>
              </thead>
			  <?php
			include "../../config/connect.php";
			$query="SELECT ID_No,Request_No,Project_Name,Type_Request,Status_FNIM FROM tb_fnim
			Where Status_FNIM='Complete By MCJ' ";
			if(@$Search=="")	{
				$query =$query; }
			else{
				$query .= " And (Request_No like '%$Search%' or Project_Name like '%$Search%' or 
				Type_Request like '%$Search%')";
			}
			$exe = mysqli_query($con,$query." Order By ID_No Desc");
			$no = 1;
			if (mysqli_num_rows($exe) !=0 ) {
			while(@$row =mysqli_fetch_array($exe)){
			?>
		 
			  <tr> 
				<td><?php echo $no;?></td>
				<td><?php echo $row['Request_No'];?></td>
				<td><?php echo $row['Project_Name'];?></td>
				<td><?php echo $row['Type_Request'];?></td>
				<td align="center">
					<a href="#" id="show_<?php echo $row['Request_No'];?>">Show Extra</a>
				</td>
				</td>
			  </tr>
		 	  <tr id="extra_<?php echo $row['Request_No'];?>" style="display: none;">
			  	<td colspan="5" >
				<table>
                <tr>
				  <td>No</td> 
				  <td>Code Product</td> 
				  <td>Product Name</td>
				  <td>Netto</th>
				  <td>Country</td>
				  <td>Apply</td>
                </tr>
				<?php $queryDetail="SELECT b.ID_No,a.Request_No,c.Request_No AS FNIM_Code,b.Product_Name,a.Type_Request,
				d.Code_Product,b.Status_Product,d.Isi,e.ID_No AS ID_No_FNIM_Country,e.Country
			  	FROM tb_fnim a INNER JOIN tb_fnim_detail b
				ON a.Request_No=b.Request_No 
				LEFT JOIN tb_mpr c ON a.Request_No=c.FNIM_Code 
				LEFT JOIN tb_mpr_detail d ON c.Request_No=d.Request_No 
				AND b.ID_No=d.ID_NoFNIMDetail
				LEFT JOIN tb_fnim_country e ON e.Request_No=a.Request_No
				WHERE a.Request_No='".$row['Request_No']."' ";
				
				$exeDetail = mysqli_query($con,$queryDetail." Group By b.ID_No Order By b.ID_No Desc");
				if (mysqli_num_rows($exeDetail) !=0 ) {
				while(@$rowDetail =mysqli_fetch_array($exeDetail)){
				?>
				<tr> 
				<td><?php echo $no;?></td>
				<td><?php  if ($rowDetail['Code_Product']=='') {echo "XXXXXX";} else {echo $rowDetail['Code_Product'];}?></td>
				<td><?php echo $rowDetail['Product_Name'];?></td>
				<td><?php 
					$isinetto="";
					$exeNetto = mysqli_query($con,"SELECT  Request_No,  ID_No, Isi_Net, Netto,  Index_No 
					FROM tb_fnim_detail_netto   WHERE Request_No = '".$rowDetail['Request_No']."' And
					ID_No_FnimDetail='".$rowDetail['ID_No']."'  Order By ID_No Asc");
						while(@$rowFNIMDetailNetto =mysqli_fetch_array($exeNetto)){ 
							$isinetto=$isinetto.@$rowFNIMDetailNetto['Isi_Net']." ".@$rowFNIMDetailNetto['Netto'].", ";
						} 
						echo substr($isinetto,0,-2);  ?>
				</td>
				<td><?php echo $rowDetail['Country'];?></td>
				<td><button type="button" style="padding:2px 2px 2px 2px" 
				onClick="javascript:changeparent('<?php echo $row['Request_No']; ?>','<?php echo $row['Request_No']; ?>','<?php echo $rowDetail['ID_No']; ?>','<?php  if ($rowDetail['Code_Product']=='') {echo "XXXXXX";} else {echo $rowDetail['Code_Product'];}?>','<?php echo $rowDetail['Product_Name'];?>','<?php echo substr($isinetto,0,-2); ?>','<?php echo $rowDetail['Type_Request'];?>','<?php echo $rowDetail['ID_No_FNIM_Country'];?>','<?php echo $rowDetail['Country'];?>','<?php echo $rowDetail['Status_Product'];?>');javascript:window.close();">
					<span class="fa fa-check" title="Apply FNIM">
					</span></button></td>
          		</td>
				</tr><?php }} ?>
				</table>
			  </tr>
			  
			  
			   <?php   $no++; } } else {  ?>
			  <tr> 
				<td colspan="5">No data available in table</td>
			  </tr><?php }} ?>
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
