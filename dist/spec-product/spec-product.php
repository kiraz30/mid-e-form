	<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Static Navigation - SB Admin</title>
        <link href="../css/styles.css" rel="stylesheet" />
		<!-- Bootstrap Core CSS -->
		<link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	
		<!-- MetisMenu CSS -->
		<link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
	
		<!-- Custom CSS -->
		<link href="../css/sb-admin-2.css" rel="stylesheet">
	
		<!-- Custom Fonts -->
		<link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    </head>
	<script type="text/javascript">
		function popupwindow(url, title, h, w) {
		  var left = (screen.width/2)-(w/2);
		  var top = (screen.height/2)-(h/2);
		  return window.open(url, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
		  return false;
		} 
	</script>
<main> 
    <div class="container-fluid"> 
		<h3 class="mt-4">Specification Products</h3>
	    <ol class="breadcrumb mb-4">
			<li class="breadcrumb-item"><a href="../dist/index.php?button=dashboard">Dashboard</a></li>
			<li class="breadcrumb-item active">Specification Products</li>
		</ol>
		<div class="card mb-4">
			<div class="card-header"><a class="btn btn-primary" href="../dist/index.php?button=add-spec-product"> Add Specification Product</a></div>

			<div class="card-body"> 
				<div class="table-responsive"> 
					<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
						<thead>
							<tr bgcolor="#999999">
								<th width="1%">No</th> 
								<th width="12%">Request No</th> 
								<th>Product Code</th>
								<th>Product Name</th>
								<th>Netto</th>
								<th>Bisnis</th>
								<th width="8%">Type Request</th>
								<th height>Created By</th>
								<th height>Created Date</th>
								<th height="10">Status</th>
								<th width="10%">Action</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>No</th> 
								<th>Request No</th>
								<th>Product Code</th>
								<th>Product Name</th>
								<th>Netto</th>
								<th>Bisnis</th>
								<th>Type Request</th>
								<th height>Created By</th>
								<th height>Created Date</th>
								<th height="10">Status</th>
								<th>Action</th>
							</tr>
						</tfoot>
						<tbody>
						<?php
							$query="SELECT a.ID_No,a.Index_Document,a.Request_No,a.Last_Request_No,a.Status_Last_Document,
							a.MPR_Code,
							a.Brand,a.Bisnis,b.NamaBisnis,a.Code_Product,a.BARCODE,a.Product_Name,a.Isi_Net,a.Netto,
							DATE_FORMAT(a.Launching, '%m') Bulan,DATE_FORMAT(a.Launching, '%Y') Tahun,
							a.Description AS Description_SP,a.Notifikasi_BPOM,a.Product_Image,
							a.SizeOfProduct,a.SizeOfProduct_P,a.SizeOfProduct_L,a.SizeOfProduct_T,a.SizeOfProduct_Satuan,
							a.InnerPack_P,a.InnerPack_L,a.InnerPack_T,a.InnerPack_Satuan,
							a.SizeOfCartton_IS_P,a.SizeOfCartton_IS_L,a.SizeOfCartton_IS_T,a.SizeOfCartton_IS_Satuan,
							a.SizeOfCartton_OS_P,a.SizeOfCartton_OS_L,a.SizeOfCartton_OS_T,a.SizeOfCartton_OS_Satuan,
							a.DznCtn,a.DznCtn_Keterangan,a.WeighOfContenCtn,Status_Spec,a.CreatedBy,a.CreatedDate
							FROM tb_spec_product a INNER JOIN tb_bisnis b ON a.Bisnis=b.KDBisnis ";
							if ($level!="ADMINISTRATOR"){
							$query= $query. "  Where a.CreatedBy ='$username'";}


							$exe = mysqli_query($con,$query. " Order By a.CreatedDate Desc");
							$no = 1;
							while(@$row =mysqli_fetch_array($exe)){
								if (@$row['Status_Spec']<>"Draft")
								{$disabled="disabled";		
								} else{$disabled="";}
							?>
							<tr> 
								<td><?php echo $no;?></td>
								<td><?php echo $row['Request_No'];?></td>
								<td><?php echo $row['Code_Product'];?></td>
								<td><?php echo $row['Product_Name'];?></td>
								<td><?php echo $row['Isi_Net']." ". $row['Netto'];?></td>
								<td><?php echo $row['NamaBisnis'];?></td>
								<td></td>
								<td><?php echo $row['CreatedBy'];?></td>
								<td><?php echo $row['CreatedDate'];?></td>
								<td><?php echo $row['Status_Spec'];?></td>

								<td align="center">
									<button style="padding:2px 4px 2px 2px;margin:1px 1px 1px 1px;" class="btn btn-outline btn-default">
		 							<?php if ($row['Status_Spec']=="Revise"){
									echo '<a href="../dist/index.php?button=revise-spec-product&id='.$row['Request_No'].'">';
									}else{
									echo '<a href="../dist/index.php?button=spec-product-edit&id='.$row['Request_No'].'">';
									}?>
									<span class="fa fa-edit" title="Edit Packaging Spesification"></span></a></button>	
								 
				<button style="padding:2px 4px 2px 2px;margin:1px 1px 1px 1px;" class="btn btn-outline btn-default">
				<a href="#"><span onClick="popupwindow('../dist/page.php?form=workflow&id=<?php echo $row['Request_No'];?>&pg=sp','arm','400','1000');" 
				class="fa fa-user" title="Preview Work Flow" ></span></a></button>	
				
				<!--button style="padding:2px 4px 2px 2px;margin:1px 1px 1px 1px;" class="btn btn-outline btn-default">
				<a href="#"><span onClick="popupwindow('../dist/page.php?form=privew-spec-product&id=<?php echo $row['Request_No'];?>','Preview Report','1000','1000',left= '1000',top= '1000',screenX= '1000',screenY= '1000');"
				class="fa fa-file" title="Preview Report"></span> </a>  </button-->

				
				<?php if ($row['Status_Spec']=="Complete" & $row['Status_Last_Document']=="1"){ ?>
				 	<button style="padding:2px 4px 2px 2px ;margin:1px 1px 1px 1px;" class="btn btn-outline btn-default">
					<a href="../dist/index.php?button=add-revise-spec-product&id=<?php echo $row['Request_No'];?>">
					<span class="glyphicon glyphicon-duplicate" title="Revise Packaging Spesification"></span></a></button>	
				 
				<?php }?>
		
				 <a href="../config/delete-exe.php?pg=del-spec-product&id=<?php echo $row['Request_No'];?>">
				 <button  type="button"  style="padding:2px 4px 2px 2px;margin:1px 1px 1px 1px;" 
				 class="btn btn-danger glyphicon glyphicon-trash" onClick="return checkDelete();" 
				 <?php echo $disabled; ?>></button>				
				</a>
								</td>
							</tr>
							<?php $no++;} ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</main> 
    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="../vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="../vendor/datatables-responsive/dataTables.responsive.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../js/sb-admin-2.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
    </script>
	<script language="JavaScript" type="text/javascript">
	function checkDelete(){
		return confirm('Are you sure you want to delete this Request?');
	}
	</script>
    </body>
</html>
