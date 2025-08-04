<script type="text/javascript">
	function popupwindow(url, title, h, w) {
	var left = (screen.width/2)-(w/2);
	var top = (screen.height/2)-(h/2);
	return window.open(url, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
		  return false;
		} 
		
	function changeparent(){
	window.opener.location.reload();
    window.close();
	}
</script>
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
 
<style>
body{
  padding:20px 20px;
}

.results tr[visible='false'],
.no-result{
  display:none;
}

.results tr[visible='true']{
  display:table-row;
}

.counter{
  padding:8px; 
  color:#ccc;
}
</style>
	<main> 
    <div class="container-fluid"> 
		<h3 class="mt-4">Specification Products Report</h3>
	    <ol class="breadcrumb mb-4">
			<li class="breadcrumb-item"><a href="../dist/index.php?button=dashboard">Dashboard</a></li>
			<li class="breadcrumb-item active">Specification Products</li>
		</ol>
    <div class="card mb-4">
   		<div class="card-body"> 
			
			<table width="100%" border="0" >
				<tr>
					<td width="1%"><span class="form-group"></span></td>
					<td width="20%"><span class="form-group">Prodcut Code</span></td>
					<td colspan="2"><span class="form-group">
						<input class="form-control py-4"  name="inputProductCode" id="inputProductCode" 
						maxlength="10" type="text" placeholder="Enter Prodcut Code"  value="" />
					</span>
					</td>
					<td width="30%"><span class="form-group"></span></td>
				</tr>
				<tr>
					<td width="1%"><span class="form-group"></span></td>
					<td width="20%"><span class="form-group">Prodcut Name</span></td>
					<td colspan="2"><span class="form-group">
						<input class="form-control py-4"  name="inputProductName" id="inputProductName" 
						maxlength="10" type="text" placeholder="Enter Prodcut Name"  value="" />
					</span>
					</td>
					<td width="30%"><span class="form-group"></span></td>
				</tr>
				<tr>
					<td width="1%"><span class="form-group"></span></td>
					<td width="20%"><span class="form-group">Bisnis</span></td>
					<td colspan="2"><span class="form-group">
					<select class="form-control" id="InputBisnis" name="InputBisnis" <?php echo $disabled; ?>>
						<option value="-" >Select Bisnis</option>
						<?php
							$exe = mysqli_query($con,"SELECT KDBisnis,NamaBisnis from tb_bisnis Where Status='1' " );
							while(@$row =mysqli_fetch_array($exe)){
								if($InputBisnis == $row['KDBisnis']){
									$cek = 'Selected';
								}else{
									$cek = '';
								}
								echo"<option value='".$row['KDBisnis']."' $cek>".$row['NamaBisnis']."</option>";
							}
						?>
					</select>
					</span>
					</td>
					<td width="30%"><span class="form-group"></td>
				</tr>
				<tr>
					<td width="1%"><span class="form-group"></span></td>
					<td width="20%"><span class="form-group">Status</span></td>
					<td colspan="2"><span class="form-group">
						<select class="form-control" id="SelectStatus" name="SelectStatus"  >
							<option value="-">Select Status </option>
							<option value="New">New</option>
							<option value="Renewal">Renewal</option>
							<option value="Refine">Refine</option>
							<option value="Others">Others</option>
						</select>
					</span>
					</td>

					<td width="30%"><span class="form-group"></span></td>
				</tr>

			</table>
		  <br>					
          <div class="table-responsive"> 
			<div class="form-group pull-left">
			<button type="submit" name="Search" id="Search" value="Search"
				class="btn btn-primary">Search </button>			
			  <button type="button" id="Export" name="Export" value="Export" class="btn btn-primary">
			  <i class="fa fa-file-excel"></i> Export</button>
			</div>
			<div class="form-group pull-right">
				<input type="text" class="search form-control" placeholder="What you looking for?">
			</div>
			<span class="counter pull-right"></span>
			<table class="table table-hover table-bordered results" id="myTable">
			 <thead>
				<tr valign="bottom" align="center" bgcolor="#999999">
					<th colspan="7">Specification Product
						</a>
					</th>
				</tr>
				<tr valign="bottom" align="center" bgcolor="#999999">
				<th width="1%">No</th>
				<th width="13%">Request No</th>
				<th width="7%">Code Product</th>
				<th width="9%">Barcode</th>
				<th width="30%">Product Name</th>
				<th width="1%">Action</th>
			</tr>
			</thead>
		 
			<tbody>
			<tr>
				<td colspan="6" align="center">Tidak ada data yang ditampilkan</td>
			</tr>
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
 
    </body>
</html>


<!-- Modal start here -->
<div class="modal fade" id="show" role="dialog">
		<div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><b>Specification Product Detail</b></h4>
                </div>
                <div class="modal-body">
                    <div class="modal-data"></div>
                </div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
            </div>
      </div>
	  
</div>


<!-- Ini merupakan script yang terpenting -->
<script type="text/javascript">
    $(document).ready(function(){
        $('#show').on('show.bs.modal', function (e) {
            var getDetail = $(e.relatedTarget).data('id');
			 
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url: "spec-product/spec-product-detail-report.php",
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getDetail='+ getDetail,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>
  


<script>
$(document).ready(function(){
	get_detaildata();
 $('#Search').click(function(){
  get_detaildata();
 });
});
 function get_detaildata(){
  var inputProductCode = $('#inputProductCode').val();
  var a = $('#inputProductName').val();
  var b = $('#InputBisnis').val();
  var c = $('#SelectStatus').val();

  $.ajax({
   type: 'POST',
   url: "spec-product/load-spec-product-report.php",
   
   data: { inputProductCode: inputProductCode,data1: a, data2: b,data3: c},
   
   success: function(info) {
	$("#myTable").html(info);  }
  });

  return false;
 }
</script>

 
 <script>  
 $(document).ready(function(){  
      $('#Export').click(function(){  
		  var inputProductCode = $('#inputProductCode').val();
	  	  var a = $('#inputProductName').val();
		  var b = $('#InputBisnis').val();
          var c = $('#SelectStatus').val();
 
           var excel_data = $('#myTable').html();  
           var page = "../config/export-excel.php?pg=spec-product-report&productname=" + a + "&bisnis=" + b + "&status=" + c;  
           window.location = page;  
      });  
 });  
 </script>  
 
<script>
$(document).ready(function() {
  $(".search").keyup(function () {
    var searchTerm = $(".search").val();
    var listItem = $('.results tbody').children('tr');
    var searchSplit = searchTerm.replace(/ /g, "'):containsi('")
    
  $.extend($.expr[':'], {'containsi': function(elem, i, match, array){
        return (elem.textContent || elem.innerText || '').toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
    }
  });
    
  $(".results tbody tr").not(":containsi('" + searchSplit + "')").each(function(e){
    $(this).attr('visible','false');
  });

  $(".results tbody tr:containsi('" + searchSplit + "')").each(function(e){
    $(this).attr('visible','true');
  });

  var jobCount = $('.results tbody tr[visible="true"]').length;
    $('.counter').text(jobCount + ' item');

  if(jobCount == '0') {$('.no-result').show();}
    else {$('.no-result').hide();}
		  });
});
</script>