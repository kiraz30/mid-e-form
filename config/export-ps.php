
<?php  
session_start(); //kuncinya ada disini, tulis diawal script sebelum menulis yang lain

if($_SESSION["usernameeform"]=="" ) //untuk mencegah apabila halaman diakses tanpa login (session kosong), maka otomatis di redirect ke form 
{
	ob_start();
	header("location:../dist/login.php");
	ob_end_flush();
}
date_default_timezone_set("Asia/Jakarta");
$createddate=date("Y-m-d H:i:s");
$page		=@$_GET["form"];
$id			=@$_GET["id"];
include "connect.php";  
$exe =mysqli_query($con,"SELECT a.Request_No,a.Index_Document,a.Last_Request_No,a.Status_Last_Document,
a.ARM_Code,a.MPR_Code,a.Project_Name,a.Finish_Good_Code,a.Finish_Good_Name,a.Keterangan_Produk,
a.Warna_Jenis,a.Netto,a.Isi,a.DZ_CT,a.Market,a.Barcode,a.CreatedBy,DATE(a.CreatedDate) as CreatedDate,
a.Status_Spec,a.Remark,DATE(a.UpdatedDate) as UpdatedDate
FROM  tb_packdev_spec a LEFT JOIN tb_packdev_add_resource b ON a.ARM_Code=b.Request_No
WHERE a.Request_No = '".@$_GET['id']."'");
$tampildata=mysqli_fetch_array($exe);
 
?>
 
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Report PS <?php  echo $id;?>
	</title>

	<style>
 
		.demo-table {
			border-collapse: collapse;
			font-size: 12px;
			
		}
		.demo-table th, 
		.demo-table td {

			
		}

		/* Table Header */
		.demo-table thead th {
			color: #FFFFFF;
			border-color: #6ea1cc;
			text-transform: uppercase;
		}
		
		/* Table Body */
		.demo-table tbody td {
			color: #353535;
		}
		.signature table {
				text-align: right;
				border: 1px solid;
				bottom: 1;
				right: 1;
				border-collapse: collapse;
				font-size: 9px;
				line-height: 16px;
				page-break-inside:avoid;
			}

	</style>

<style type="text/css">
@media print {
thead {
    display: table-header-group;
}
tfoot {
    display: table-footer-group;
}
}
@media screen {
thead {
    display: block;
}
tfoot {
    display: block;
}
}
</style>
</head>
<body <?php if ($page=="privew-ps" && $tampildata['Status_Spec']!='Complete'){ echo 'background="../img/watermark.png"';}?> >


<?php
if ($page=="ps"){?>
<script>
window.print();
</script>
<?php } ?>
<?php
if ($page=="ps"|| $page=="privew-ps"){
	if ($page=="privew-fnim" && $tampildata['Status_Spec']!='Complete'){ echo '<h1>Preview Report</h1>';}?> 
	<table  class="demo-table responsive" border="0" width="1024" align="center">
	<thead>
		<tr>
		  <td  style="width:100px;"><img src="../img/Logo.png"  width="100px" height="60"></td>
		  <td valign="middle" width="85%" ><h1>Packing Material Produk Baru</h1></td>
		  <td valign="middle" width="15%" > FR/PKG/PD-0001</td>
	  	</tr>
		  <tr>
		  <td colspan="3" height="1" valign="middle" width="100%" ><hr SIZE=1></td>
	  	</tr>  
	</thead>
	<tbody>
		<tr>
       	  <td colspan="3">
			<table cellpadding="0" cellspacing="0" border="0" width="100%" >
	            <tr>
                	<td width="15%" style="text-align:left; height:2px;" >
						<label>Nama Produk</label>
					</td>
					<td style="width:10px;" >:</td>
					<td style="width:850px;"><label><?php echo $tampildata['Finish_Good_Name']; ?></label>
					</td>

					<td  style="text-align:left; height:2px;" >
						<label>P/BD</label>
					</td>
					<td style="width:10px;" >:</td>
					<td style="width:200px;"><label><?php echo $tampildata['Isi']; ?></label>
					</td>
					<td width="13%" style="text-align:left; height:5px;" >
						<label>Barcode</label>
					</td>
					<td style="width:10px;" >:</td>
					<td style="width:200px;"><label><?php echo $tampildata['Barcode']; ?></label>
					</td>
                </tr>
				<tr>
                	<td  style="text-align:left; height:5px;" >
						<label>Keterangan Produk</label>
					</td>
					<td style="width:10px;" >:</td>
					<td style="width:600px;"><label><?php echo $tampildata['Keterangan_Produk']; ?></label>
					</td>

					<td  style="text-align:left; height:5px;" >
						<label>Dz/CB</label>
					</td>
					<td style="width:10px;" >:</td>
					<td style="width:230px;"><label><?php echo $tampildata['DZ_CT']; ?></label>
					</td>
					<td  style="text-align:left; height:5px;" >
						<label>Kode Barang</label>
					</td>
					<td style="width:10px;" >:</td>
					<td style="width:300px;"><label><label><?php echo $tampildata['Finish_Good_Code']; ?></label>
					</td>
                </tr>
				<tr>
                	<td  style="text-align:left; height:5px;" >
						<label>Netto</label>
					</td>
					<td style="width:10px;" >:</td>
					<td style="width:600px;"><label><?php echo $tampildata['Netto']; ?></label>
					</td>

					<td  style="text-align:left; height:5px;" >
						<label>Tujuan</label>
					</td>
					<td style="width:10px;" >:</td>
					<td style="width:300px;"><label><?php echo $tampildata['Market']; ?></label>
					</td>
					<td></td>
					<td style="width:10px;" ></td>
					<td style="width:300px;"></td>
                </tr>
				<tr>
                	<td  style="text-align:left; height:5px;" >
						<label>Wana/Jenis</label>
					</td>
					<td style="width:10px;" >:</td>
					<td style="width:600px;"><label><?php echo $tampildata['Warna_Jenis']; ?></label>
					</td>
					<td></td>
					<td style="width:10px;" ></td>
					<td style="width:300px;"></td>
					<td></td>
					<td style="width:10px;" ></td>
					<td style="width:300px;"></td>
                </tr>
				<tr>
				  	<td colspan="12"><table cellpadding="0" cellspacing="0" border="0" width="100%" >
                      <tr style='font-size:12px;text-align:center;' bgcolor="#999999">
                        <td width="20" rowspan="2" style="padding:2px 2px 2px 2px;">Kode PM</td>
						<td width="80" colspan="2" style="padding:2px 2px 2px 2px;">Batch Size</td>
                        <td width="60" rowspan="2" style="padding:2px 2px 2px 2px;">Ukuran (mm)</td>
                        <td width="50" rowspan="2" style="padding:2px 2px 2px 2px;">Bahan</td>
                        <td width="80" rowspan="2" style="padding:2px 2px 2px 2px;">Cetak</td>
                        <td width="10" rowspan="2" style="padding:2px 2px 2px 2px;">Weight</td>
                        <td width="20" rowspan="2" style="padding:2px 2px 2px 2px;">UP</td>
                        <td width="40" rowspan="2" style="padding:2px 2px 2px 2px;">Min Lot</td>
                        <td width="40" rowspan="2" style="padding:2px 2px 2px 2px;">Lot Qty</td>
						<td width="40" rowspan="2" style="padding:2px 2px 2px 2px;">Delivery</td>
						<td width="100" rowspan="2" style="padding:2px 2px 2px 2px;">Supplier</td>
						<td width="30" rowspan="2" style="padding:2px 2px 2px 2px;">Status</td>
						
                      </tr>
					  <tr style='font-size:12px;' bgcolor="#999999">
						<td width="40" style="padding:2px 2px 2px 2px;">Upper</td>
						<td width="40" style="padding:2px 2px 2px 2px;">Lower</td>
                      </tr>
					  	<?php
					  	$exe = mysqli_query( $con,"SELECT b.ID_No,b.Packaging_Material,b.Packaging_Material_Name,
						  b.Batch_Size_Lower,b.Batch_Size_Upper,b.Ukuran,b.Bahan,b.Cetak,b.Weight,b.Satuan_Weight,d.Std_UP,
						  b.Vendor_Code,b.Vendor_Name,b.Status
						  FROM tb_packdev_spec a INNER JOIN tb_packdev_spec_detail b ON a.Request_No =b.Request_No
						  LEFT JOIN tb_packdev_add_resource c ON a.ARM_Code=c.Request_No AND a.MPR_Code=c.MPR_Code
						  LEFT JOIN tb_packdev_add_resource_detail d ON b.ID_No_Resource_Detail=d.ID_No
						  Where a.Request_No ='".$tampildata['Request_No']."' ");
						  if (mysqli_num_rows($exe) !=0 ) {
							$no = 1;
							while(@$rowPSDetail =mysqli_fetch_array($exe)){
						?>
						
						<tr style="font-size:12px; text-align:left; height:10px; padding:0px 1px 0px 1px;">
							<td style="padding:0px 1px 0px 1px;"><?php echo $rowPSDetail['Packaging_Material']; ?></td>
							<td style="padding:0px 1px 0px 1px;"><?php echo $rowPSDetail['Batch_Size_Lower']; ?></td>
							<td style="padding:0px 1px 0px 1px;"><?php echo $rowPSDetail['Batch_Size_Upper']; ?></td>
							<td style="padding:0px 1px 0px 1px;"><?php echo $rowPSDetail['Ukuran']; ?></td>
							<td style="padding:0px 1px 0px 1px;"><?php echo $rowPSDetail['Bahan']; ?></td>
							<td style="padding:0px 1px 0px 1px;"><?php echo $rowPSDetail['Cetak']; ?></td>
							<td style="padding:0px 1px 0px 1px;"><?php echo $rowPSDetail['Weight']." ".$rowPSDetail['Satuan_Weight']; ?></td>
							<td style="padding:0px 1px 0px 1px;text-align:right;"><!--?php echo $rowPSDetail['Std_UP']; ?--></td>
							<td style="padding:0px 1px 0px 1px;"></td>
							<td style="padding:0px 1px 0px 1px;"></td>
							<td style="padding:0px 1px 0px 1px;"></td>
							<td style="padding:0px 1px 0px 1px;"><?php echo $rowPSDetail['Vendor_Name']; ?></td>
							<td style="padding:0px 1px 0px 1px;"><?php echo $rowPSDetail['Status']; ?></td>	
						</tr>
						<tr style="font-size:12px; text-align:left; height:2px; padding:0px 1px 0px 1px;">
							<td style="padding:0px 1px 0px 1px;" colspan="13"><?php echo $rowPSDetail['Packaging_Material_Name']; ?><hr></td>
						</tr>
						<?php $no++;}}else {echo "<tr style='height:20px; padding:0px 1px 0px 1px;'><td colspan='13'></td><tr>";} ?>
                    	</table>
					</td>
				  </tr>
			 
				 <tr>
				 	<td width="410" colspan="12" align="right">
						<table cellpadding="0" cellspacing="0" border="1" width="100%" >
							<tr >
								<td width="410" valign="top" height="50" style="padding:0px 1px 0px 1px;">Note : <br> <?php echo $tampildata['Remark']; ?>   </td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
 				  	<td colspan="12" align="right" height="10" >Dibuat oleh Packaging Development Dept pada Tanggal :  <?php 
					if(is_null($tampildata['UpdatedDate'])) {echo $tampildata['CreatedDate'];} else{echo $tampildata['UpdatedDate'];} ?> </td>
				 </tr>
			    <tr>
					<td width="410" colspan="12" align="right" height="10">
					 
					<table cellpadding="0" cellspacing="0" border="1" width="50%" >
                      <tr style='font-size:14px;'>
                        <td style="text-align:center; width:100px; height:20px;" >Diterima</td>
                        <td  colspan="2" style="text-align:center; width:200px; height:20px;" > Disetujui</td>
						<td style="text-align:center; width:130px; height:20px; ">Dibuat </td>
                      </tr>
					  <tr style='font-size:14px;'>
					    <td style="text-align:center; width:130px; height:20px; ">Dept. Produksi / Purchasing / QC</td>
                        <td style="text-align:center; width:100px; height:20px;" > Asst / Manager / General / EO</td>
						<td style="text-align:center; width:100px; height:20px;" > Chief / Section Leader</td>
						<td style="text-align:center; width:100px; height:20px;" >Petugas</td>
                        
						
						
                      </tr>
                      <tr style='font-size:14px;'>
					  	<td style="text-align:center; width:100px;">
							<!--?php echo ShowttdARM(@$tampildata['Request_No'],'ps','Step 4','4');?-->
						</td>
						<td valign="top" style="text-align:center; width:100px;">
							<?php echo ShowTtdNamaTglByPosisiDivisiPS(@$tampildata['Request_No'],'ps','52804,04,51721,52907');?>
						</td>
					  	<td valign="top" style="text-align:center; width:100px;">			
							<?php echo ShowTtdNamaTglByPosisiDivisiPS(@$tampildata['Request_No'],'ps','01,02,03');?>
						</td>
                        <td valign="top" valign="center" align="center" style=" width:20px; height:80px;">
							<?php ShowTtdNamaTglByPosisiRequestor($tampildata['Request_No'],"ps",'01,02,03,04,52804',"1") ; ?>
						</td>
                        
		              </tr>
                
                  
                </table>
 	 		</td>
		</tr>
		
	</table>
</tbody>
</table>

<?php
};
 ?>
</body>
</html>
 