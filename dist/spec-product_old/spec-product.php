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
   		<div class="card-body"> 
          <div class="table-responsive"> 
			<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
				<thead>
					<tr bgcolor="#999999">
					  <th width="1%">No</th> 
					  <th width="15%">Master Product Request No</th> 
					  <th>Product Code</th>
					  <th>Product Name</th>
					  <th>Netto</th>
					  <th width="8%">Type Request</th>
					  <th height="10">Status</th>
					  <th width="10%">Action</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
					  <th>No</th> 
					  <th>Master Product Request No</th>
					  <th>Product Code</th>
					  <th>Product Name</th>
					  <th>Netto</th>
					  <th>Type Request</th>
					  <th>Bisnis</th>
					  <th>Action</th>
					</tr>
				</tfoot>
				<tbody>
					<?php
				 
					$query="SELECT d.ID_No,a.Request_No,b.ID_No AS ID_NoMPRDetail,c.Request_No AS FNIM_Code,c.ID_No AS ID_NoFNIMDetail,
					DATE_FORMAT(d.Launching, '%m') Bulan,DATE_FORMAT(d.Launching, '%Y') Tahun,
					a.Type_Request,a.Country,a.Type,a.Brand,a.Bisnis,a.Series,a.Category,a.Segmentation,a.CustomerCode,
					a.Royalty,b.Code_Product,b.BARCODE,c.Product_Name,
					d.Description AS Description_SP,d.Notifikasi_BPOM,d.Product_Image,
					d.SizeOfProduct,d.SizeOfProduct_P,d.SizeOfProduct_L,d.SizeOfProduct_T,d.SizeOfProduct_Satuan,
					d.InnerPack_P,d.InnerPack_L,d.InnerPack_T,d.InnerPack_Satuan,
					d.SizeOfCartton_IS_P,d.SizeOfCartton_IS_L,d.SizeOfCartton_IS_T,d.SizeOfCartton_IS_Satuan,
					d.SizeOfCartton_OS_P,d.SizeOfCartton_OS_L,d.SizeOfCartton_OS_T,d.SizeOfCartton_OS_Satuan,
					d.DznCtn,d.DznCtn_Keterangan,d.WeighOfContenCtn
					FROM tb_mpr a INNER JOIN tb_mpr_detail b
					ON a.Request_No=b.Request_No INNER JOIN tb_fnim_detail c on a.FNIM_Code=c.Request_No and  b.ID_NoFNIMDetail=c.ID_No
					LEFT JOIN tb_spec_product d on a.Request_No=d.MPR_Code AND b.ID_No=d.ID_NoMPRDetail
					WHERE a.Status_MPR='Complete' Order By a.CreatedDate Desc";
					$exe = mysqli_query($con,$query);
					$no = 1;
					while(@$row =mysqli_fetch_array($exe)){
					?>
					<tr> 
					<td><?php echo $no;?></td>
					<td><?php echo $row['Request_No'];?></td>
					<td><?php echo $row['Code_Product'];?></td>
					<td><?php echo $row['Product_Name'];?></td>
					<td><?php 
						$isinetto="";
						$exeNetto = mysqli_query($con,"SELECT ID_No,Isi_Net,Netto,Index_No 
						FROM tb_fnim_detail_netto Where Request_No = '".$row['FNIM_Code']."' And
						ID_No_FnimDetail='".$row['ID_NoFNIMDetail']."'  Order By ID_No Asc");
						while(@$rowFNIMDetailNetto =mysqli_fetch_array($exeNetto)){ 
							$isinetto=$isinetto.$rowFNIMDetailNetto['Isi_Net']." ".$rowFNIMDetailNetto['Netto'].", ";
						} 
						echo substr($isinetto,0,-2);  ?></td>
					<td><?php echo $row['Type_Request'];?></td>
					<td><?php echo $row['Category'];?></td>

					<td align="center"><button style="padding:0px 0px 0px 0px">
						<a href="../dist/index.php?button=edit-spec-product&id=<?php echo $row['ID_NoMPRDetail'];?>"> 
						<span class="fa fa-edit" title="Edit Spec Product"></span></a></button>	
								
				 
				
				<button style="padding:0px 0px 0px 0px">
				<a href="#"><span onClick="popupwindow('../dist/page.php?form=privew-spec-product&id=<?php echo $row['Request_No'];?>','Preview Report','1000','1000',left= '1000',top= '1000',screenX= '1000',screenY= '1000');"
				class="fa fa-file" title="Preview Report"></span> </a>  </button>
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
