
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Search Checklist Final Manuscript CFM</title>
		
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
	function changeparent(doc1,doc11,doc12,doc2,doc3,doc4,doc5,doc6,doc7){
        var input1=doc1;
		var input11=doc11;
		var input12=doc12;
		var input2=doc2;
		var input3=doc3;
		var input4=doc4;
		var input5=doc5;
		var input6=doc6;
		var input7=doc7;
		window.opener.document.getElementById('InputCFMCode').value=input1;
		window.opener.document.getElementById('InputMPRCode').value=input11;
		window.opener.document.getElementById('InputFNIMCode').value=input12;
		window.opener.document.getElementById('inputProductCode').value=input2;
		window.opener.document.getElementById('inputProductName').value=input3;
		window.opener.document.getElementById('inputNetto').value=input4;
		window.opener.document.getElementById('inputRequestType').value=input5;
		window.opener.document.getElementById('inputCountry').value=input6;
		window.opener.document.getElementById('InputStatus').value=input7;
	    window.opener.close();
		window.opener.document.getElementById('InputCFMCode').focus();
    }
</script>
	
	
	<body onload='setFocus();' > 
	<main> 
    <div class="container-fluid"><h3 class="mt-4">Search Checklist Final Manuscript CFM</h3>

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
				  <th width="14%">Request No</th> 
				  <th width="10%">Product Code</th>
				  <th width="20%">Product Name</th>
				  <th width="10%">Netto</th>
				  <th width="10%">Request Type</th>
				  <th width="10%">Country</th>
				  <th width="10%">Status </th>
				  <th width="1%">Apply</th>
                </tr>
              </thead>
			  <?php
			include "../../config/connect.php";
			$query="SELECT a.ID_No,a.Index_Document,a.Request_No,a.Last_Request_No,a.Status_Last_Document,
			a.FNIM_Code,a.ID_No_FNIMDetail,d.Request_No AS MPR_Code, e.Code_Product,c.Product_Name,
			b.Type_Request,c.Status_Product, f.Country,a.Remark,a.Status_CFM,
			a.CreatedBy,date(a.CreatedDate) as Created_Date FROM tb_cfm a 
			INNER JOIN tb_fnim b ON a.FNIM_Code =b.Request_No
			INNER JOIN tb_fnim_detail c ON b.Request_No =c.Request_No And a.ID_No_FNIMDetail =c.ID_No
			LEFT JOIN tb_mpr d ON b.Request_No=d.FNIM_Code
			LEFT JOIN tb_mpr_detail e ON d.Request_No=e.Request_No AND e.ID_NoFNIMDetail= c.ID_No
			LEFT JOIN tb_fnim_country f ON a.ID_No_FNIM_Country=f.ID_No  
			WHERE a.Status_CFM='Complete' ";
			if(@$Search=="")	{
				$query =$query; }
			else{
				$query .= " And (a.Request_No like '%$Search%'  or 
				b.Type_Request like '%$Search%')";
			}
			$exe = mysqli_query($con,$query." Order By a.ID_No Desc");
			$no = 1;
			if (mysqli_num_rows($exe) !=0 ) {
			while(@$row =mysqli_fetch_array($exe)){
			?>
		 
			  <tr> 
				<td><?php echo $no;?></td>
				<td><?php echo $row['Request_No'];?></td>
				<td><?php  if (@$row['Code_Product']=='') {echo "XXXXXX";} else {echo @$row['Code_Product'];}?></td>
				<td><?php echo $row['Product_Name'];?></td>
				<td><?php 
				
					$isinetto="";
					$exeNetto = mysqli_query($con,"SELECT  Request_No,  ID_No, Isi_Net, Netto,  Index_No 
					FROM tb_fnim_detail_netto   WHERE Request_No = '".@$row['FNIM_Code']."' And
					ID_No_FnimDetail='".@$row['ID_No_FNIMDetail']."'  Order By ID_No Asc");
					while(@$rowFNIMDetailNetto =mysqli_fetch_array($exeNetto)){ 
						$isinetto=$isinetto.@$rowFNIMDetailNetto['Isi_Net']." ".@$rowFNIMDetailNetto['Netto'].", ";
					} 
						echo substr($isinetto,0,-2);  ?>
				</td>
				<td><?php echo $row['Type_Request'];?></td>
				<td><?php echo $row['Country'];?></td>
				<td><?php echo $row['Status_Product'];?></td>
				<td><button type="button" style="padding:2px 2px 2px 2px" 
				onClick="javascript:changeparent('<?php echo $row['Request_No']; ?>','<?php echo $row['MPR_Code']; ?>','<?php echo $row['FNIM_Code']; ?>','<?php  if (@$row['Code_Product']=='') {echo "XXXXXX";} else {echo @$row['Code_Product'];}?>','<?php echo $row['Product_Name'];?>','<?php echo substr($isinetto,0,-2);?>','<?php echo $row['Type_Request'];?>','<?php echo $row['Country'];?>','<?php echo $row['Status_Product'];?>');javascript:window.close();">
					<span class="fa fa-check" title="Apply FAW">
					</span></button>
				</td>
			  </tr>	  
			  
			   <?php   $no++; }}  else {  ?>
			  <tr> 
				<td colspan="9">No data available in table</td>
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

    </body>
</html>
