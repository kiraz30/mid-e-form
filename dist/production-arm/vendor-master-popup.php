
<?php
session_start();
$username				=$_SESSION["usernameeform"];
$name					=$_SESSION["nameusereform"];
$level					=$_SESSION['leveleform'];
$hostname				=$_SESSION['hostnameeform'];
$divisioncode			=$_SESSION['divisioncodeeform'];
$division				=$_SESSION['divisioneform'];
$position				=$_SESSION['positioneform'];

if($username=="" ) //untuk mencegah apabila halaman diakses tanpa login (session kosong), maka otomatis di redirect ke form login (login.php) 
{
	ob_start();
	header("location:login.php");
	ob_end_flush();
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Search Vendor / Customer</title>
		
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
	function changeparent(doc1,doc2,doc3,doc4,tlp,fax,email,top,norek,pic,divisi){
		window.opener.document.getElementById('inputVendorCustomer').value=doc1;
		window.opener.document.getElementById('inputNamaVendorCustomer').value=doc2;
		window.opener.document.getElementById('inputNPWP').value=doc3;
		window.opener.document.getElementById('inputAlamat').value=doc4;
		window.opener.document.getElementById('inputNoTelp').value=tlp;
		window.opener.document.getElementById('inputNoFax').value=fax;
		window.opener.document.getElementById('inputEmail').value=email;
		window.opener.document.getElementById('inputTermOfPayment').value=top;
		window.opener.document.getElementById('inputRekBank').value=norek;
		window.opener.document.getElementById('inputPIC').value=pic;
		window.opener.document.getElementById('inputDivisi').value=divisi;
	    window.opener.close();
		window.opener.document.getElementById('inputRemark').focus();
    }
</script>
		
	<body onload='setFocus();' > 
	<main> 
    <div class="container-fluid"><h3 class="mt-4">Search Vendor / Customer Master</h3>

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
				  <th width="5%">Vendor / Customer Code</th> 
				  <th width="15%">Vendor / Customer Name</th>
				  <th width="20%">Alamat</th>
				  <th width="10%">NPWP</th>
				  <th width="5%">Apply</th>
                </tr>
				</thead>
				<?php
					$query = "SELECT a.TP,a.Description +' '+ISNULL(a.Description2,'') VendorDescr,e.aonpwp,
					ISNULL(c.FirstName,'')+' '+ISNULL(c.LastName,'')  PIC,
					ISNULL(c.PrimAddrLine1,'')+' '+ISNULL(c.PrimAddrLine2,'')+' '+ISNULL(c.PrimAddrLine3,'') Address,
					ISNULL(c.PrimAddrPhone,'') Phone,
					ISNULL(c.PrimAddrEmail,'') Email,
					ISNULL(c.PrimAddrExt,'') Ext,
					ISNULL(c.PrimAddrFax,'') Fax,
					ISNULL(e.aoAcctCode,'') NoRek,
					ISNULL(f.PayTerms,'') TermOfPayment from fdTradingPartne a
					JOIN fdTPContact b ON a.ObjectID=b.ParentObjectID
					JOIN fdContact c ON b.ContactObjectID=c.ObjectID
					JOIN fdCountry d ON d.ObjectID=c.PrimAddrCntryOID
					LEFT JOIN AOTPSUBTYPE e ON e.ParentObjectID = a.ObjectID
					LEFT JOIN fdInvoiceFromRo f ON f.ObjectID = a.InvFrmRoleObjectID
					WHERE (a.TP LIKE 'VDT%' or a.TP LIKE 'CEX%' or a.TP LIKE 'CDA%'  or a.TP LIKE 'VIT%' or a.TP LIKE 'VST%')  ";
					if(@$Search=="")	{
						$query =$query;
					}else{
						$query =$query. " And a.TP like '%".$Search."%' or a.Description  like '%".$Search."%' 
						or a.Description2  like '%".$Search."%'";
					}
				$exe = sqlsrv_query ($myConnFlex,$query.  " Order By a.Description Asc");	
				while(@$row =sqlsrv_fetch_array ($exe)){
				$no = 0;
				$no =$no+1;
				//if (sqlsrv_num_rows($exe) !=0 ) {
				?>
			  <tr> 
				<td><?php echo $no;?></td>
				<td><?php echo $row['TP'];?></td>
				<td><?php echo $row['VendorDescr'];?></td>
				<td><?php echo $row['Address'];?></td>
				<td><?php echo $row['aonpwp'];?></td>
				<td align="center">
					<button type="button" style="padding:2px 4px 2px 2px" class="btn btn-outline btn-default"
					onClick="javascript:changeparent('<?php echo $row['TP']; ?>',
					'<?php echo $row['VendorDescr']; ?>','<?php echo $row['aonpwp']; ?>',
					'<?php echo $row['Address']; ?>','<?php echo $row['Phone']; ?>','<?php echo $row['Fax']; ?>',
					'<?php echo $row['Email']; ?>','<?php echo $row['TermOfPayment']; ?>',
					'<?php echo $row['NoRek']; ?>','<?php echo $row['PIC']; ?>','<?php echo $division; ?>');javascript:window.close();">
					<span class="fa fa-check" title="Apply Vendor / Customer">
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
