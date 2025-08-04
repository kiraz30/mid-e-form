
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
			a.FNIM_Code,a.ID_No_FNIMDetail,d.Request_No AS MPR_Code,b.Launching_Date, e.Code_Product,c.Product_Name,
			b.Type_Request,c.Status_Product, f.Country,a.Remark,a.Status_CFM,
			a.CreatedBy,date(a.CreatedDate) as Created_Date FROM tb_cfm a 
			INNER JOIN tb_fnim b ON a.FNIM_Code =b.Request_No
			INNER JOIN tb_fnim_detail c ON b.Request_No =c.Request_No And a.ID_No_FNIMDetail =c.ID_No
			LEFT JOIN tb_mpr d ON b.Request_No=d.FNIM_Code
			LEFT JOIN tb_mpr_detail e ON d.Request_No=e.Request_No AND e.ID_NoFNIMDetail= c.ID_No
			LEFT JOIN tb_fnim_country f ON a.ID_No_FNIM_Country=f.ID_No	 
			WHERE a.Request_No = '".@$_GET['id']."' 
			GROUP BY a.ID_No,a.Index_Document,a.Request_No,a.Last_Request_No,a.Status_Last_Document,
			a.FNIM_Code,a.ID_No_FNIMDetail,  MPR_Code, e.Code_Product,c.Product_Name,
			b.Type_Request,c.Status_Product, f.Country,a.Remark,a.Status_CFM,
			a.CreatedBy,Created_Date  ");
			$tampildata=mysqli_fetch_array($exe);
			$typeReq=$tampildata['Type_Request'];
 			$isinetto="";
			$exeNetto = mysqli_query($con,"SELECT  Request_No,  ID_No, Isi_Net, Netto,  Index_No 
			FROM tb_fnim_detail_netto   WHERE Request_No = '".$tampildata['FNIM_Code']."' And
			ID_No_FnimDetail='".$tampildata['ID_No_FNIMDetail']."'  Order By ID_No Asc");
			while(@$rowFNIMDetailNetto =mysqli_fetch_array($exeNetto)){ 
				$isinetto=$isinetto.@$rowFNIMDetailNetto['Isi_Net']." ".@$rowFNIMDetailNetto['Netto'].", ";
			} 
?>
 

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Report CFM <?php  echo $id;?>





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
<body <?php if ($page=="privew-cfm" && $tampildata['Status_CFM']!='Complete'){ echo 'background="../img/watermark.png"';}?> >


<?php
if ($page=="cfm"){?>
<script>
window.print();
</script>
<?php } ?>
<?php
if ($page=="cfm"|| $page=="privew-cfm"){
	$Attachment_Image	 			= "../img/Attachment_Image/";
	if ($page=="privew-fnim" && $tampildata['Status_CFM']!='Complete'){ echo '<h1>Preview Report</h1>';}?> 
 
	<table  class="demo-table responsive" border="1" width="1024" align="center">
	<thead>
		<tr>
		  <td rowspan="4" style="width:100px;"><img src="../img/Logo.png"  width="100px n" height="80"></td>
		  <td rowspan="4"  align="center" valign="middle" style="width:700px;"><h2>CHECKLIST FINAL MANUSCRIPT</h2></td>
		  <td align="left" style="width:230px;">NO : FR/GPD/GPD1-0006</td>
	  	</tr>
		<tr>
		  <td align="left" >Tgl Berlaku : 01/09/2018</td>
	  	</tr>
		<tr>
		  <td align="left" >No Rev : </td>
	  	</tr>
		<tr>
       	  <td align="left" >Hal : </td>
        </tr>
		</thead>
		<tbody>
		<tr>
       	  <td colspan="3" style="padding:2px 2px 2px 2px;"><br>
		   		<table  width="100%">
					<tr style="border-bottom: 1px dotted  black;">
					  <td width="10%" align="left">Nama Product</td>
					  <td width="1%" align="left">: </td>
					  <td width="50%" align="left"><?php echo $tampildata['Product_Name'] ; ?> </td>
					  <td width="10%" align="left">Netto</td>
					  <td width="1%" align="left">: </td>
					  <td width="20%" align="left"><?php echo substr($isinetto,0,-2); ?> </td>
				 	</tr>
					<tr style="border-bottom: 1px dotted  black;">
					  <td width="10%" align="left">Tujuan Negara</td>
					  <td width="1%" align="left">: </td>
					  <td width="50%" align="left"><?php echo $tampildata['Country'] ; ?> </td>
				 	</tr>
					<tr style="border-bottom: 1px dotted  black;">
					  <td width="10%" align="left">Waktu Launching</td>
					  <td width="1%" align="left">: </td>
					  <td width="50%" align="left"><?php echo $tampildata['Launching_Date'] ; ?> </td>
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

				<br>
				1. Kemasan Primer<br>
				<?php
					$exe = mysqli_query($con,"SELECT File,Kemasan,Posisi,Index_No 
					FROM tb_cfm_file Where Request_No = '".$tampildata['Request_No']."' And Kemasan='Primer'  Order By Index_No Asc  ");
					$no = 1;
					while(@$rowCFMFile =mysqli_fetch_array($exe)){
					
					echo "<br>".$no.". ". $rowCFMFile['Posisi']."<br><br>".
					"<img  width='500' src='../img/Attachment_Image/".$rowCFMFile['File']."'><br>";}?>
				<br>
				2. Kemasan Sekunder<br>
				<?php
					$exe = mysqli_query($con,"SELECT File,Kemasan,Posisi,Index_No 
					FROM tb_cfm_file Where Request_No = '".$tampildata['Request_No']."' And Kemasan='Sekunder'  Order By Index_No Asc  ");
					$no = 1;
					while(@$rowCFMFile =mysqli_fetch_array($exe)){
					
					echo "<br>".$no.". ". $rowCFMFile['Posisi']."<br><br>".
					"<img  width='500' src='../img/Attachment_Image/".$rowCFMFile['File']."'><br>";}?>
					</td>
				  </tr>
				  <tr>
				    <td colspan="3"><table cellpadding="0" cellspacing="0" border="1" width="1024" >
                      <tr style='font-size:14px;'>
                        <td colspan="3" style="text-align:center; width:400px; height:20px;" >PRODUCT
                          DEVELOPMENT</td>
                        <td colspan="2" style="text-align:center; width:300px; height:20px;" >REGISTRATION</td>
                        <td style="text-align:center; width:150px; height:20px; ">SAFETY
                          ACCESSOR</td>
                        <td style="text-align:center; width:150px; height:20px; ">PRODEV</td>
                      </tr>
                      <tr style='font-size:14px;'>
                        <td align="center" style="height:20px;">Prepared by</td>
                        <td colspan="2" align="center" style="height:20px;">Checked
                          by</td>
                        <td colspan="2" align="center">Checked by</td>
                        <td align="center">Approved by</td>
                        <td align="center">Acknowledge by</td>
                      </tr>
                      <tr style='font-size:14px;'>
                        <td align="center" style="width:100px; height:20px;">PIC</td>
                        <td align="center" style="width:100px; height:20px;">CHIEF/SL</td>
                        <td align="center" style="width:100px; height:20px;">ASMG/MG/GM/EO</td>
                        <td align="center" style="width:100px; height:20px;">PIC</td>
                        <td align="center" style="width:100px; height:20px;">MG/GM</td>
                        <td align="center" style="width:100px; height:20px;">MG/GM</td>
                        <td align="center" style="width:100px; height:20px;">DIRECTOR</td>
                      </tr>
                      <tr style='font-size:14px;'>
                        <td style="text-align:center; width:20px; height:120px;"><?php 
						ShowTtdNamaTglByPosisiRequestor($tampildata['Request_No'],"CFM","'01','02','03'","1") ; ?></td>
                        <td valign="center" align="center" style=" width:20px; height:120px;"><?php 
						ShowTtdNamaTglByPosisiRequestor($tampildata['Request_No'],"CFM","'01','02','03'","2") ; ?></td>
                        <td valign="center" align="center" style=" width:20px; height:120px;">
						<?php ShowTtdNamaTglByPosisiRequestorStep1($tampildata['Request_No'],"CFM",'04,52804,51721,52907');?>
						</td>
                        <td style="text-align:center;"><?php ShowTtdNamaTglByPosisiDivisiFNIMDataControl($tampildata['Request_No'],"CFM","'01','02','03','SPC1'","'21FMR2'");?></td>
                        <td style="text-align:center;"><?php ShowTtdNamaTglByPosisiDivisiFNIMDataControl($tampildata['Request_No'],"CFM","'04','51721'","'21FMR2'");?></td>
                        <td align="center"><span style="text-align:center;">
                          <?php ShowTtdNamaTglByPosisiDivisiFNIMDataControl($tampildata['Request_No'],"CFM","'04','51721','BOD0009'","'BOD8'");?>
                        </span></td>
                        <td align="center"><span style=" width:20px; height:120px;">
                          <?php ShowTtdNamaTglByPosisi($tampildata['Request_No'],"CFM",'46599,51721,52907');?>
                        </span></td>
                        <!--tr style='font-size:10px;'>
                        <td align="center" style="padding:2px 2px 2px 2px; height:20px;">
						
						<?php ShowTtdNamaTglByPosisi($tampildata['Request_No'],"CFM",'46599');?>
						</td>
                        <td align="center" style="padding:2px 2px 2px 2px; height:20px;"><?php echo Shownamettd('Name',$tampildata['Request_No'],'CFM','3');?></td>
                        <td align="center"  style="padding:2px 2px 2px 2px; height:20px;"><?php echo Shownamettd('Name',$tampildata['Request_No'],'CFM','2');?></td>
                        <td align="center" style="padding:2px 2px 2px 2px; height:20px;"><?php echo Shownamettd('Name',$tampildata['Request_No'],'CFM','1');?></td>
                      </tr>
                      <tr style='font-size:10px;'>
                        <td align="center" style="padding:2px 2px 2px 2px; height:20px;"><?php echo Shownamettd('DATE_FORMAT(ApproveDate, "%d-%m-%Y")',$tampildata['Request_No'],'CFM','4');?></td>
                        <td align="center" style="padding:2px 2px 2px 2px; height:20px;"><?php echo Shownamettd('DATE_FORMAT(ApproveDate, "%d-%m-%Y")',$tampildata['Request_No'],'CFM','3');?></td>
                        <td align="center"  style="padding:2px 2px 2px 2px; height:20px;"><?php echo Shownamettd('DATE_FORMAT(ApproveDate, "%d-%m-%Y")',$tampildata['Request_No'],'CFM','2');?></td>
                        <td align="center" style="padding:2px 2px 2px 2px; height:20px;"><?php echo Shownamettd('DATE_FORMAT(ApproveDate, "%d-%m-%Y")',$tampildata['Request_No'],'CFM','1');?></td>
                      </tr-->
                      </table></td>
				  </tr>
	 
	 
	<tbody>
</table>
<?php
};
 ?>

</body>
</html>
 