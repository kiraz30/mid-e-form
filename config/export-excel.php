<?php
session_start();
$username				=$_SESSION["usernameeform"];
$name					=$_SESSION["nameusereform"];
$level					=$_SESSION['leveleform'];
$hostname				=$_SESSION['hostnameeform'];
$division				=$_SESSION['divisioneform'];
$pg 					= @$_GET['pg'];
if ($pg=="" or $username=="")	{
	ob_start();
	header("location:login.php");
	ob_end_flush(); }


$SearchCode 		= @$_GET['SearchCode'];
$SearchName 		= @$_GET['SearchName'];
$productname	 	= @$_GET['productname'];
$bisnis 			= @$_GET['bisnis'];
$status				= @$_GET['status'];
$market				= @$_GET['market'];

			
if ($pg==""){
	ob_start();
	header("location:../dist/index.php");
	ob_end_flush();
	} 
include "conn.php";
include "connect.php";
$ip=$_SERVER['REMOTE_ADDR'];
$hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);
date_default_timezone_set("Asia/Jakarta");
$createddate=date("Y-m-d H:i:s");
$datenow=date("Y-m-d");
// Skrip berikut ini adalah skrip yang bertugas untuk meng-export data tadi ke excell
header("Content-type: application/vnd-ms-excel"); //application/vnd-ms-excel
header("Content-Disposition: attachment; filename=".$pg.".xls");

/*header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename='.$pg.'.xlsx');
header('Cache-Control: max-age=0');

// $writer->save("RCM.xlsx");
$writer->save('test');
			*/

echo "Export : ".$pg."<br>";
echo "Download By : ".$username."<br>";
echo "Download Date : ".$createddate."<br>";
echo "Download HostName : ".$ip." : ".$hostname."<br><br>";

if ($pg=="Master-Item-Ori"){?>
	<table border='1' cellpadding='5'>
		<tr>
		  <th width="1%">No</th>
		  <th>Kode</th> 
          <th>Nama</th>
		  <th>DZ per CT</th>
		  <th>Netto</th>
		  <th>UOM</th>
		  <th>Barcode</th>
		  <th>Launching Date Original </th>
		  <th>Created By</th> 
		  <th>Created Date</th>
		  <th>Created HostName </th> 
		   
    	</tr>
	<?php
		$query = "SELECT Item_Code,Item_Name,Netto,UOM,DZ_per_CT,Barcode,DiscontinueDate,LaunchingDate,
		Created_By,Created_Date,Created_HostName  from tb_master_item_flexprocess ";
		if ($SearchCode<>""){
			if (@$querytemp<>""){
				$querytemp= $querytemp. " And Item_Code like '%$SearchCode%'";}
			else{
				$querytemp= " WHERE Item_Code like '%$SearchCode%'";
			}
		}
		if ($SearchName<>""){
			if (@$querytemp<>""){
				$querytemp= $querytemp. " And Item_Name like '%$SearchName%'";}
			else{
				$querytemp= " WHERE Item_Name like '%$SearchName%'";
			}
		}
		$exe = mysqli_query($con,$query. @$querytemp. " Order By Item_Code Asc");
		$no = 1;
		while(@$row =mysqli_fetch_array($exe)){
			echo '<tr>';
			echo '<td>'.$no.'</td>';
			echo '<td>'.$row['Item_Code'].'</td>';
			echo '<td>'.$row['Item_Name'].'</td>';
			echo '<td>'.$row['DZ_per_CT'].'</td>';
			echo '<td>'.$row['Netto'].'</td>';
			echo '<td>'.$row['UOM'].'</td>';
			echo '<td>'.$row['Barcode'].'</td>';
			echo '<td>'.$row['LaunchingDate'].'</td>';
			echo '<td>'.$row['Created_By'].'</td>';
			echo '<td>'.$row['Created_Date'].'</td>';
			echo '<td>'.$row['Created_HostName'].'</td>';
			echo '</tr>';
			$no++; 
		}}
if ($pg=="spec-product-report"){
	
 
	?>

	<table border='1' cellpadding='5'>
		<tr>
		  <th rowspan="2" width="1%" >No</th>
		  <th rowspan="2">Bisnis</th> 
          <th rowspan="2">Code</th>
		  <th rowspan="2">Barcode</th>
		  <th rowspan="2">Brand Name/Merk</th>
		  <th rowspan="2">Product Name</th>
		  <th rowspan="2">Declared Quantity / Net Content</th>
		  <th rowspan="2">Project Status </th>
		  <th rowspan="2">Remark</th>
		  <th rowspan="2">Launching Years</th> 
		  <th rowspan="2">Product Short Description</th>
		  <th rowspan="2">Product Image (URL)</th>
		  <th rowspan="2">Size of Product </th> 
		  <th rowspan="2">Inner Pack</th> 
		  <th colspan="2">Size of Carton</th> 
		  <th colspan="2">Dzn/Ctn</th>	
		  <th rowspan="2">Weight of Content / Carton</th> 	
		  <th rowspan="2">Notifikasi BPOM</th>
		  <th rowspan="2">Category</th>
		  <th rowspan="2">NPRF</th>
		  <th rowspan="2">FNIM</th>
		  <th rowspan="2">Master Product</th>
		  <th rowspan="2">Lampiran DD</th>
		  <th rowspan="2">Ingredient List</th>
		  <th rowspan="2">BPOM</th>
    	</tr>
		<tr>
			<th>Inner Size</th>
			<th>Outter Size</th>
			<th>Isi (Dzn)</th>
			<th>Keterangan Dzn</th>
		</tr>
		 
	<?php
		$query = "SELECT a.ID_No,a.Index_Document,a.Request_No,a.Last_Request_No,a.Status_Last_Document,
		a.MPR_Code,ProjectStatus1,ProjectStatus2,ProjectStatus3,ProjectStatus4,
		a.Brand,a.Bisnis,b.NamaBisnis,a.Category,a.Code_Product,a.BARCODE,a.Product_Name,a.Isi_Net,a.Netto,
		DATE_FORMAT(a.Launching, '%m') Bulan,if(DATE_FORMAT(a.Launching, '%Y')<>0000,DATE_FORMAT(a.Launching, '%Y'),'') Tahun,
		a.Description AS Description_SP,a.Notifikasi_BPOM,a.Product_Image,
		a.SizeOfProduct,a.SizeOfProduct_P,a.SizeOfProduct_L,a.SizeOfProduct_T,a.SizeOfProduct_Satuan,
		a.InnerPack_P,a.InnerPack_L,a.InnerPack_T,a.InnerPack_Satuan,
		a.SizeOfCartton_IS_P,a.SizeOfCartton_IS_L,a.SizeOfCartton_IS_T,a.SizeOfCartton_IS_Satuan,
		a.SizeOfCartton_OS_P,a.SizeOfCartton_OS_L,a.SizeOfCartton_OS_T,a.SizeOfCartton_OS_Satuan,
		a.DznCtn,a.DznCtn_Keterangan,a.WeighOfContenCtn,a.WeighOfContenCtn_Satuan,Status_Spec,a.Remark,
		a.CreatedBy,a.CreatedDate
		FROM tb_spec_product a INNER JOIN tb_bisnis b ON a.Bisnis=b.KDBisnis
			WHERE a.Status_Spec='Complete'";
		if ($productname<>""){
			$query= $query. " And c.Product_Name like '%".$productname."%'";}
 		if ($bisnis<>"" & $bisnis <>"-"){
			$query= $query. " And a.Bisnis = '".$bisnis."'";}
		if ($status=="New" ){
			$query= $query. " And a.ProjectStatus1 = '1'";}
		if ($status=="Renewal" ){
			$query= $query. " And a.ProjectStatus2 = '1'";}
		if ($status=="Refine" ){
			$query= $query. " And a.ProjectStatus3 = '1'";}
		if ($status=="Others" ){
			$query= $query. " And a.ProjectStatus4 = '1'";}
		$exe = mysqli_query($con,$query. " Order By a.CreatedDate Desc ");
		$no = 1;
		while(@$row =mysqli_fetch_array($exe)){
			echo '<tr>';
			echo '<td>'.$no.'</td>';
			echo '<td>'.$row['Bisnis'].'</td>';
			echo '<td>'.$row['Code_Product'].'</td>';
			echo '<td>'.$row['BARCODE'].'</td>';
			echo '<td>'.$row['Brand'].'</td>';
			echo '<td>'.$row['Product_Name'].'</td>';
			echo '<td>'.$row['Isi_Net']." ".$row['Netto'].'</td>';
			if ($row['ProjectStatus1']=="1"){$Status1="New";}else {$Status1="";}
			if ($row['ProjectStatus2']=="1"){$Status2="Renewal";}else {$Status2="";}
			if ($row['ProjectStatus3']=="1"){$Status3="Refine";}else {$Status3="";}
			if ($row['ProjectStatus4']=="1"){$Status4="Others";}else {$Status4="";}
			echo '<td>'.$Status1 .$Status2 	.$Status3 .$Status4.'</td>';
			echo '<td>'.$row['Remark'].'</td>';
			echo '<td>'.$row['Tahun'].'</td>';
			echo '<td>'.$row['Description_SP'].'</td>';
			echo '<td> </td>';
			if ($row['SizeOfProduct']==""){
				echo '<td>'.$row['SizeOfProduct'].' '.$row['SizeOfProduct_P'].'x'.$row['SizeOfProduct_L'].'x'.$row['SizeOfProduct_T'].' '.$row['SizeOfProduct_Satuan'].'</td>';
			}else {
				echo '<td>'.$row['SizeOfProduct_L'].'x'.$row['SizeOfProduct_T'].' '.$row['SizeOfProduct_Satuan'].'</td>';
			}
			echo '<td>'.$row['InnerPack_P'].'x'.$row['InnerPack_L'].'x'.$row['InnerPack_T'].' '.$row['InnerPack_Satuan'].'</td>';
			echo '<td>'.$row['SizeOfCartton_IS_P'].'x'.$row['SizeOfCartton_IS_L'].'x'.$row['SizeOfCartton_IS_T'].' '.$row['SizeOfCartton_IS_Satuan'].'</td>';
			echo '<td>'.$row['SizeOfCartton_OS_P'].'x'.$row['SizeOfCartton_OS_L'].'x'.$row['SizeOfCartton_OS_T'].' '.$row['SizeOfCartton_OS_Satuan'].'</td>';
			echo '<td>'.$row['DznCtn'].'</td>';
			echo '<td>'.$row['DznCtn_Keterangan'].'</td>';
			echo '<td>'.$row['WeighOfContenCtn']." ".$row['WeighOfContenCtn_Satuan'].'</td>';
			echo '<td>'.$row['Notifikasi_BPOM'].'</td>';
			echo '<td>'.$row['Category'].'</td>';
			echo '<td></td>'; /*$row['NPRF_Code']*/
			echo '<td></td>'; /*$row['FNIM_Code']*/
			echo '<td>'.$row['Request_No'].'</td>';
			echo '<td></td>'; /*$row['LampiranDD']*/
			echo '<td> </td>';
			echo '<td> </td>';
			echo '</tr>';
			$no++; 
		}}
		
	 
		?>
	</table>
