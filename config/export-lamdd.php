
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
      	$exe =mysqli_query($con,"SELECT a.ID_No,a.Index_Document,a.Request_No,a.Last_Request_No,a.Status_Last_Document,
			a.FNIM_Code,a.ID_No_FNIMDetail,d.Request_No AS MPR_Code,h.Request_No AS FAW_Code,e.BARCODE, e.Code_Product,c.Product_Name,
			b.Type_Request,c.Status_Product,a.ID_No_FNIM_Country,f.Country,a.Remark,a.Status_LAMDD,
			a.CreatedBy,date(a.CreatedDate) as Created_Date FROM tb_lamdd a 
			INNER JOIN tb_fnim b ON a.FNIM_Code =b.Request_No
			INNER JOIN tb_fnim_detail c ON a.ID_No_FNIMDetail =c.ID_No
			LEFT JOIN tb_mpr d ON b.Request_No=d.FNIM_Code
			LEFT JOIN tb_mpr_detail e ON d.Request_No=e.Request_No AND e.ID_NoFNIMDetail= c.ID_No
			LEFT JOIN tb_fnim_country f ON a.ID_No_FNIM_Country=f.ID_No
			LEFT JOIN tb_cfm g ON g.FNIM_Code= a.Request_No AND g.ID_No_FNIMDetail=b.ID_No
			LEFT JOIN tb_faw h ON h.CFM_Code= g.Request_No
			 
		WHERE a.Request_No = '".@$_GET['id']."'  ");
        $tampildata=mysqli_fetch_array($exe);
		$typeReq=$tampildata['Type_Request'];
 		$isinetto="";
		$exeNetto = mysqli_query($con,"SELECT  Request_No,  ID_No, Isi_Net, Netto,  Index_No 
		FROM tb_fnim_detail_netto   WHERE Request_No = '".@$tampildata['FNIM_Code']."' And
		ID_No_FnimDetail='".@$tampildata['ID_No_FNIMDetail']."'  Order By ID_No Asc");
		while(@$rowFNIMDetailNetto =mysqli_fetch_array($exeNetto)){ 
			$isinetto=$isinetto.@$rowFNIMDetailNetto['Isi_Net']." ".@$rowFNIMDetailNetto['Netto'].", ";
		} 
?>
 

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Report FAW <?php  echo $id;?>





</title>

<style>
 
		.demo-table {
			border-collapse: collapse;
			font-size: 14px;
			
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
<body <?php if ($page=="privew-faw" && $tampildata['Status_FAW']!='Complete'){ echo 'background="../img/watermark.png"';}?> >


<?php
if ($page=="cfm"){?>
<script>
window.print();
</script>
<?php } ?>
<?php
if ($page=="lamdd"|| $page=="privew-lamdd"){
	$Attachment_Image	 			= "../img/Attachment_Image/";
	if ($page=="privew-faw" && $tampildata['Status_LAMDD']!='Complete'){ echo '<h1>Preview Report</h1>';}?> 
 
	<table  class="demo-table responsive" border="1" width="1024" align="center">
	<thead>
		<tr>
		  <td rowspan="4" style="width:100px;"><img src="../img/Logo.png"  width="100px n" height="80"></td>
		  <td rowspan="4"  align="center" valign="middle" style="width:700px;"><h2>FORMULIR LAMPIRAN DD</h2></td>
		  <td align="left" style="width:230px;">NO : FR/GPD/GPD1-0010</td>
	  	</tr>
		<tr>
		  <td align="left" >Tgl Berlaku : 02/09/2019</td>
	  	</tr>
		<tr>
		  <td align="left" >No Rev : FR/GPD/GPD1-0010R1 </td>
	  	</tr>
		<tr>
       	  <td align="left" >Hal : </td>
        </tr>
		</thead>
		<tbody>
		<tr style='font-size:10px;'>
       	  <td colspan="3" style="padding:2px 2px 2px 2px;">
		   		<table  width="100%">
					<tr style="border-bottom: 1px dotted  black;">
					  <td width="10%" align="left">Nama Produk</td>
					  <td width="1%" align="left">: </td>
					  <td width="50%" align="left"><?php echo $tampildata['Product_Name'] ; ?> </td>
		 
				 	</tr>
					<tr style="border-bottom: 1px dotted  black;">
					  <td width="10%" align="left">Netto</td>
					  <td width="1%" align="left">: </td>
					  <td width="50%" align="left"><?php echo substr($isinetto,0,-2); ?> </td>
				 	</tr>
					<tr style="border-bottom: 1px dotted  black;">
					  <td width="10%" align="left">Barcode</td>
					  <td width="1%" align="left">: </td>
					  <td width="50%" align="left"><?php echo $tampildata['BARCODE'] ; ?> </td>
				 	</tr>
					<tr style="border-bottom: 1px dotted  black;">
					  <td width="10%" align="left">Market</td>
					  <td width="1%" align="left">: </td>
					  <td width="50%" align="left">	
					  	<input type="checkbox" onClick="return false;" 
					  	<?php if($tampildata['Type_Request']=="Domestic"){echo "checked='checked'";} ?>> Domestic 
					  	<input type="checkbox" onClick="return false;"
						<?php if($tampildata['Type_Request']=="Export"){echo "checked='checked'";} ?>> Export ( <?php echo $tampildata['Country'] ; ?> )
						
						</td>
						
				 	</tr>
			 
					<tr style="border-bottom: 1px dotted  black;">
					  <td width="10%" align="left">Status</td>
					  <td width="1%" align="left">: </td>
					  <td width="50%" align="left">	
					  	<input type="checkbox" onClick="return false;" 
					  	<?php if($tampildata['Status_Product']=="New"){echo "checked='checked'";} ?>> New 
					  	<input type="checkbox" onClick="return false;"
						<?php if($tampildata['Status_Product']=="Renewal"){echo "checked='checked'";} ?>> Renewal 
						<input type="checkbox" onClick="return false;">	Revision( )
						</td>
				 	</tr>
				</table>

				
				<br>
				1. Kemasan Primer<br>
				<?php
					$exe = mysqli_query($con,"SELECT File,Kemasan,Posisi,Index_No 
					FROM tb_lamdd_file Where Request_No = '".$tampildata['Request_No']."' And Kemasan='Primer'  Order By Index_No Asc  ");
					$no = 1;
					while(@$rowCFMFile =mysqli_fetch_array($exe)){
					
					echo $no.". ". $rowCFMFile['Posisi']."<br><br>".
					"<img  width='500' src='../img/Attachment_Image/".$rowCFMFile['File']."'>";}?>
				<?php
					$exe = mysqli_query($con,"SELECT File,Kemasan,Posisi,Index_No 
					FROM tb_lamdd_file Where Request_No = '".$tampildata['Request_No']."' And Kemasan='Primer'  Order By Index_No Asc  ");
					$no = 1;
					while(@$rowCFMFile =mysqli_fetch_array($exe)){
					
					echo $no.". ". $rowCFMFile['Posisi']."<br><br>".
					"<img  width='500' src='../img/Attachment_Image/".$rowCFMFile['File']."'>";}?>
				<br>2. Kemasan Sekunder<br>
				<?php
					$exe = mysqli_query($con,"SELECT File,Kemasan,Posisi,Index_No 
					FROM tb_lamdd_file Where Request_No = '".$tampildata['Request_No']."' And Kemasan='Sekunder'  Order By Index_No Asc  ");
					$no = 1;
					while(@$rowCFMFile =mysqli_fetch_array($exe)){
					
					echo $no.". ". $rowCFMFile['Posisi']."<br><br>".
					"<img  width='500' src='../img/Attachment_Image/".$rowCFMFile['File']."'>";}?>
					</td>
				  </tr>
				 
	 
	 
	<tbody>
</table>
<?php
};
 ?>

</body>
</html>
 