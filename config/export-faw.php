
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
		a.CFM_Code,b.FNIM_Code, c.Request_No AS MPR_Code,b.ID_No_FNIMDetail,
		a.Matarial_Name,a.Supplier_Name,f.BARCODE,f.Code_Product,d.Product_Name,
		d.Status_Product,c.Type_Request,g.Country,a.Remark,a.Status_FAW,
		a.CreatedBy,date(a.CreatedDate) as Created_Date FROM 					
		tb_faw a INNER JOIN tb_cfm b ON a.CFM_Code =b.Request_No
		INNER JOIN tb_fnim c ON b.FNIM_Code =c.Request_No
		INNER JOIN tb_fnim_detail d ON b.ID_No_FNIMDetail =d.ID_No
		LEFT JOIN tb_mpr e ON c.Request_No=e.FNIM_Code
		LEFT JOIN tb_mpr_detail f ON e.Request_No=f.Request_No AND f.ID_NoFNIMDetail= d.ID_No
		LEFT JOIN tb_fnim_country g ON b.ID_No_FNIM_Country=g.ID_No
		WHERE a.Request_No = '".@$_GET['id']."' GROUP BY a.Request_No ");
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
if ($page=="faw"|| $page=="privew-faw"){
	$Attachment_Image	 			= "../img/Attachment_Image/";
	if ($page=="privew-faw" && $tampildata['Status_FAW']!='Complete'){ echo '<h1>Preview Report</h1>';}?> 
 
	<table  class="demo-table responsive" border="1" width="1024" align="center">
	<thead>
		<tr>
		  <td rowspan="4" style="width:100px;"><img src="../img/Logo.png"  width="100px n" height="80"></td>
		  <td rowspan="4"  align="center" valign="middle" style="width:700px;"><h2>CHECK LIST FINAL ARTWORK</h2></td>
		  <td align="left" style="width:230px;">NO : FR/GPD/GPD1-0007</td>
	  	</tr>
		<tr>
		  <td align="left" >Tgl Berlaku : 19/08/2019</td>
	  	</tr>
		<tr>
		  <td align="left" >No Rev : FR/GPD/GPD1-0007R1 </td>
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
					  <td width="10%" align="left">Netto</td>
					  <td width="1%" align="left">: </td>
					  <td width="20%" align="left"><?php echo substr($isinetto,0,-2); ?> </td>
				 	</tr>
					<tr style="border-bottom: 1px dotted  black;">
					  <td width="10%" align="left">Barcode</td>
					  <td width="1%" align="left">: </td>
					  <td width="50%" align="left"><?php echo $tampildata['BARCODE'] ; ?> </td>
				 	</tr>
					<tr style="border-bottom: 1px dotted  black;">
					  <td width="10%" align="left">Tujuan Negara</td>
					  <td width="1%" align="left">: </td>
					  <td width="50%" align="left"><?php echo $tampildata['Country'] ; ?> </td>
					  <td width="10%" align="left">Tanggal Edar</td>
					  <td width="1%" align="left">: </td>
					  <td width="20%" align="left"><?php echo ""; ?> </td>
				 	</tr>
					<tr style="border-bottom: 1px dotted  black;">
					  <td width="10%" align="left">Nama Material</td>
					  <td width="1%" align="left">: </td>
					  <td width="50%" align="left"><?php echo $tampildata['Matarial_Name'] ; ?> </td>
				 	</tr>
					<tr style="border-bottom: 1px dotted  black;">
					  <td width="10%" align="left">Nama Supplier</td>
					  <td width="1%" align="left">: </td>
					  <td width="50%" align="left"><?php echo $tampildata['Supplier_Name'] ; ?> </td>
					  <td width="10%" align="left">Oleh</td>
					  <td width="1%" align="left">: </td>
					  <td width="20%" align="left"><?php echo ""; ?> </td>
				 	</tr>

					<tr style="border-bottom: 1px dotted  black;">
					  <td width="10%" align="left">Status</td>
					  <td width="1%" align="left">: </td>
					  <td width="50%" align="left">	
					  	<input type="checkbox" onClick="return false;" 
					  	<?php if($tampildata['Status_Product']=="New"){echo "checked='checked'";} ?>> New 
					  	<input type="checkbox" onClick="return false;"
						<?php if($tampildata['Status_Product']=="Renewal"){echo "checked='checked'";} ?>> Renewal 
						<input type="checkbox" onClick="return false;">	Revision( )</td>
				 	</tr>
				</table>
				<br><b>ATTACHMENT FILE ( diisi oleh Product Development Dept.): </b><br>
				
				<br><b>SCHEDULE (diisi oleh Packaging Development Dept.): </b><br>
				<table  width="70%" style='font-size:10px;'>
					<tr style="border-bottom: 1px dotted  black;">
					  <td width="20%" align="left">Memberikan FA (setelah selesai step 2) kepada supplier</td>
					  <td width="1%" align="left">: </td>
					  <td width="29%" align="left">__________/__________/____________ </td>
				 	</tr>
					<tr style="border-bottom: 1px dotted  black;">
					  <td align="left">Packaging Material diterima MID.</td>
					  <td align="left">: </td>
					  <td align="left">__________/__________/____________</td>
				 	</tr>
				</table>
		
				<br><b>PERHATIAN: </b>
				<br>
				<p> a. Mohon diperhatikan setiap point pada saat proses pengecekan.<br>
					b. Tulis ( √ ) jika point sesuai standard, dan ( x ) jika point tidak sesuai standard.<br>
					c. Khusus untuk Divisi Packaging Development, harap melakukan scan Barcode agar sesuai dengan nomor yang tertera.<br>
					d. Jika materi untuk check kurang lengkap / kurang jelas, harus kembali ke P.I.C. ( tidak boleh proses ).<br>
					e. Khusus untuk label alamat 1 warna, check list hanya pada Step 1 dan Step 3. 			
				</p>
				<br><b>CHECK POINT: </b><br>
				<?php 
					$exe = mysqli_query($con,"SELECT a.Checklist_Code,a.Question FROM tb_faw_master_check a ");
					while(@$rowFAWMasterCheck =mysqli_fetch_array($exe)){
					echo $rowFAWMasterCheck['Checklist_Code'].". ". $rowFAWMasterCheck['Question']."<br>" ;}
				?>
				<br><b>STEP 1: CHECK antara "ARTWORK" dengan "MANUSCRIPT" (Sebelum design diberikan Supplier) </b><br>
					<table cellpadding="0" cellspacing="0" border="1" width="100%" style='font-size:11px;'>
					<tr>
						<td align="center" bgcolor="#999999" rowspan="9" width="1%"><b>C<br>H<br>E<br>C<br>K</b></td>
						<?php 
							$exe = mysqli_query($con,"Select Checklist_Code, Question  FROM tb_faw_master_check  ");
							if (mysqli_num_rows($exe) !=0 ) {
							$no = 1;
							while(@$rowFAWCheck =mysqli_fetch_array($exe)){
						?>
						
							<td align="center" width="5%"><?php echo $rowFAWCheck['Checklist_Code']; ?></td>	
							<td align="center" width="5%"><?php 
							ShowDataChecklistAppFAW("Result",@$rowFAWCheck['Checklist_Code'],@$_GET['id'],1);
							?>
							</td>
							<td  align="center" width="5%">
							<?php 
							ShowDataChecklistAppFAW('Result',@$rowFAWCheck['Checklist_Code'],@$_GET['id'],2)

							 ?>
							</td>
							<td  align="center" width="5%">
							<?php 
							ShowDataChecklistAppFAW('Result',@$rowFAWCheck['Checklist_Code'],@$_GET['id'],3)
							
							 ?>
							</td>
							<td align="center" width="5%">
							<?php 
							ShowDataChecklistAppFAW('Result',@$rowFAWCheck['Checklist_Code'],@$_GET['id'],4)
							
							 ?>
							</td>
							<td align="center" width="5%">
							<?php 
							ShowDataChecklistAppFAW('Result',@$rowFAWCheck['Checklist_Code'],@$_GET['id'],5)
							
							 ?>
							</td>
							<td align="center" width="5%">
							<?php 
							ShowDataChecklistAppFAW('Result',@$rowFAWCheck['Checklist_Code'],@$_GET['id'],6)
							
							 ?>
							</td>					
				 
						</tr>  <?php $no++;}}?>
						 
						<tr  style='font-size:11px;'>
							<td colspan="2" rowspan="2" align="center" style="width:100px; height:20px;">DEVISI / SEKSI</td>
							<td rowspan="2" align="center" style="width:100px; height:20px;">
							<?php if (@$tampildata['Status_FAW']=="Revise") {
							echo ShowDivisiFAWRevise('DivisionName',@$tampildata['Request_No'],'FAW','Step 1');}
							else {ShowDivisiFAWApprove('DivisionName',@$tampildata['Request_No'],'FAW','Step 1');}?></td>
							<td rowspan="2" align="center" style="width:100px; height:20px;">
							<?php if (@$tampildata['Status_FAW']=="Revise") {
							echo ShowDivisiFAWApprove('DivisionName',@$tampildata['Request_No'],'FAW','Step 2');}
							else {ShowDivisiFAWApprove('DivisionName',@$tampildata['Request_No'],'FAW','Step 2');}?></td>
							
							
					 
					 
							
							
							
							<td colspan="2" align="center" style="width:100px; height:20px;">Prodev</td>
							<td align="center" style="width:100px; height:20px;">Prodev</td>
							<td rowspan="2" align="center" style="width:100px; height:20px;">Registrasi</td>
							<td align="center" style="width:20px; height:20px;">Mengetahui</td>
							<td align="center" style="width:20px; height:20px;">Diterima</td>
						</tr>
						<tr  style='font-size:11px;'>
							<td align="center" style="width:100px; height:20px;">P.I.C</td>
							<td align="center" style="width:100px; height:20px;">CHIEF/SL</td>
							<td align="center" style="width:100px; height:20px;">Asst MG/MG</td>
							<td align="center"   width="5%">  GM / EO / Director</td>
							<td align="center" width="5%">PIC/DH/GM</td>
						</tr>
						
						<tr  style='font-size:11px;'>
							<td colspan="2" style="text-align:center; width:20px; height:100px;">TANDA-<br>TANGAN </td>
							<td style="text-align:center; width:20px;" ><?php 
						ShowTtdNamaTglByPosisiRequestorFAW($tampildata['Request_No'],"FAW","'01','02','03'","Step 1") ; ?></td>
							<td style="text-align:center; width:20px;"><?php 
						ShowTtdNamaTglByPosisiRequestorFAW($tampildata['Request_No'],"FAW","'01','02','03'","Step 2") ; ?></td>
							<td style="text-align:center; width:20px;"><?php 
						ShowTtdNamaTglByPosisiRequestorFAW($tampildata['Request_No'],"FAW","'01','02','03'","Step 3") ; ?></td>
							<td style="text-align:center; width:20px;"><?php 
						ShowTtdNamaTglByPosisiRequestorFAW($tampildata['Request_No'],"FAW","'01','02','03'","Step 4") ; ?></td>
							<td style="text-align:center; width:20px;"><?php 
						ShowTtdNamaTglByPosisiRequestorFAW($tampildata['Request_No'],"FAW",'04,52804,51721,52907',"Step 5");?></td>
							<td style="text-align:center; width:20px;"><?php 
						ShowTtdNamaTglByPosisiRequestorFAW($tampildata['Request_No'],"FAW",'04,52804,51721,52907',"Step 6");?></td>
							<td style="text-align:center; width:20px; "><?php 
						ShowTtdNamaTglByPosisiRequestorFAW($tampildata['Request_No'],"FAW",'04,52804,51721,52907,46599',"Step 7");?></td>
							<td style="text-align:center; width:20px; "><?php 
						ShowTtdNamaTglByPosisiRequestorFAW($tampildata['Request_No'],"FAW",'01,02,03,04,52804,51721,52907',"Step 7");?></td>
						</tr>
						
						 
				</table>
				<br><b>STEP 2: CHECK antara "ARTWORK / POSITIF FILM" (dari Supplier) dengan "FINAL DESIGN" </b><br>
				DEADLINE :       /       /<br>
				<table cellpadding="0" cellspacing="0" border="1" width="50%" style='font-size:11px;'>
					<tr>
						<td align="center" bgcolor="#999999" rowspan="7" width="1%"><b>C<br>H<br>E<br>C<br>K</b></td>
						<?php 
							$exe = mysqli_query($con,"Select Checklist_Code, Question  FROM tb_faw_master_check 
							Where Checklist_Code !=8 and Checklist_Code !=9 ");
							if (mysqli_num_rows($exe) !=0 ) {
							$no = 1;
							while(@$rowFAWCheck =mysqli_fetch_array($exe)){
						?>
						
							<td align="center" width="3%"><?php echo $rowFAWCheck['Checklist_Code']; ?></td>	
							<td align="center" width="5%"></td>
							<td align="center" width="5%"></td>
							<td align="center" width="5%"></td>
			 
						</tr>  <?php $no++;}}?>
						<tr>
							<td colspan="2" rowspan="2" align="center" style="width:100px; height:20px;">DEVISI / SEKSI</td>
							<td colspan="3" align="center" style="width:100px; height:20px;">Packaging Development Dept.</td>
						</tr>
						<tr>
							<td align="center" style="width:100px; height:20px;">P.I.C</td>
							<td align="center" style="width:100px; height:20px;">US/SH</td>
							<td align="center" style="width:100px; height:20px;">DIV H/GM</td>
						</tr>
						<tr>
							<td colspan="2" style="text-align:center; width:20px; height:60px;">TANDA-<br>TANGAN </td>
							<td style="text-align:center; width:20px;" ></td>
							<td style="text-align:center; width:20px;"></td>
							<td style="text-align:center; width:20px;"></td>
						</tr>
						<tr>
							<td colspan="2" style="text-align:center; width:20px; height:20px;">Nama </td>
							<td style="text-align:center; width:20px;" ></td>
							<td style="text-align:center; width:20px;"></td>
							<td style="text-align:center; width:20px;"></td>
						</tr>
						<tr>
							<td colspan="2" style="text-align:center; width:20px; height:20px;">Tgl </td>
							<td style="text-align:center; width:20px;" ></td>
							<td style="text-align:center; width:20px;"></td>
							<td style="text-align:center; width:20px;"></td>
						</tr>
					</table>
					
					
				<br><b>STEP 3: CHECK antara "PROOF PRINT / CHROMALIN" (dari Supplier) dengan "FINAL ARTWORK" </b><br>
				DEADLINE :       /       /<br>
				<table cellpadding="0" cellspacing="0" border="1" width="50%" style='font-size:11px;'>
					<tr>
						<td align="center" bgcolor="#999999" rowspan="7" width="1%"><b>C<br>H<br>E<br>C<br>K</b></td>
						<?php 
							$exe = mysqli_query($con,"Select Checklist_Code, Question  FROM tb_faw_master_check 
							Where Checklist_Code !=8 and Checklist_Code !=9 ");
							if (mysqli_num_rows($exe) !=0 ) {
							$no = 1;
							while(@$rowFAWCheck =mysqli_fetch_array($exe)){
						?>
							<td align="center" width="3%"  ><?php echo $rowFAWCheck['Checklist_Code']; ?></td>	
							<td align="center" width="5%"></td>
							<td align="center" width="5%"></td>
							<td align="center" width="5%"></td>
			 
						</tr>  <?php $no++;}}?>
						<tr>
							<td colspan="2" rowspan="2" align="center" style="width:100px; height:20px;">DEVISI / SEKSI</td>
							<td colspan="3" align="center" style="width:100px; height:20px;">Packaging Development Dept.</td>
						</tr>
						<tr>
							<td align="center" style="width:100px; height:20px;">P.I.C</td>
							<td align="center" style="width:100px; height:20px;">US/SH</td>
							<td align="center" style="width:100px; height:20px;">DIV H/GM</td>
						</tr>
						<tr>
							<td colspan="2" style="text-align:center; width:20px; height:60px;">TANDA-<br>TANGAN </td>
							<td style="text-align:center; width:20px;" ></td>
							<td style="text-align:center; width:20px;"></td>
							<td style="text-align:center; width:20px;"></td>
						</tr>
						<tr>
							<td colspan="2" style="text-align:center; width:20px; height:20px;">Nama </td>
							<td style="text-align:center; width:20px;" ></td>
							<td style="text-align:center; width:20px;"></td>
							<td style="text-align:center; width:20px;"></td>
						</tr>
						<tr  style='font-size:10px;'>
							<td colspan="2" style="text-align:center; width:20px; height:20px;">Tgl </td>
							<td style="text-align:center; width:20px;" ></td>
							<td style="text-align:center; width:20px;"></td>
							<td style="text-align:center; width:20px;"></td>
						</tr>
					</table>
				<br>
				1. Kemasan Primer<br>
				<?php
					$exe = mysqli_query($con,"SELECT File,Kemasan,Posisi,Index_No 
					FROM tb_faw_file Where Request_No = '".$tampildata['Request_No']."' And Kemasan='Primer'  Order By Index_No Asc  ");
					$no = 1;
					while(@$rowCFMFile =mysqli_fetch_array($exe)){
					
					echo $no.". ". $rowCFMFile['Posisi']."<br><br>".
					"<img  width='500' src='../img/Attachment_Image/".$rowCFMFile['File']."'>";}?>
				<br>
				2. Kemasan Sekunder<br>
				<?php
					$exe = mysqli_query($con,"SELECT File,Kemasan,Posisi,Index_No 
					FROM tb_faw_file Where Request_No = '".$tampildata['Request_No']."' And Kemasan='Sekunder'  Order By Index_No Asc  ");
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
 