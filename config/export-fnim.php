
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
      	$exe =mysqli_query($con,"SELECT ID_No,Request_No,MCJ_Proudct,Project_Name,NPRF_Code,Type_Request,
		 date_format(Launching_Date,'%M-%Y') as Launching_Date,For_Notif,Thema_Number,Note,Status_FNIM FROM tb_fnim 
		 where Request_No = '".@$_GET['id']."'  ");
        $tampildata=mysqli_fetch_array($exe);
		$typeReq=$tampildata['Type_Request'];
 
?>
 

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Report FNIM <?php  echo $id;?>





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
<body <?php if ($page=="privew-fnim" && $tampildata['Status_FNIM']!='Complete By MID'){ echo 'background="../img/watermark.png"';}?> >


<?php
if ($page=="fnim"){?>
<script>
window.print();
</script>
<?php } ?>
<?php
if ($page=="fnim"|| $page=="privew-fnim"){
	$uploadDirFileMcj	 			= "../img/Mcj/";
	if ($page=="privew-fnim" && $tampildata['Status_FNIM']!='Complete By MID'){ echo '<h1>Preview Report</h1>';}?> 
	<table  class="demo-table responsive" border="1" width="1024" align="center">
	<thead>
		<tr>
		  <td rowspan="4" style="width:100px;"><img src="../img/Logo.png"  width="100px n" height="80"></td>
		  <td rowspan="4"  align="center" valign="middle" style="width:700px;"><h2>NEW PRODUCT FINAL NAME INTERNAL MEMO</h2></td>
		  <td align="left" style="width:230px;">NO : FR/GPD/GPD1-000</td>
	  	</tr>
		<tr>
		  <td align="left" >Tgl Berlaku : 13/08/2019</td>
	  	</tr>
		<tr>
		  <td align="left" >New Rev : FR/GPD/GPD1-0004R1</td>
	  	</tr>
		<tr>
       	  <td align="left" >Hal : </td>
        </tr>
		</thead>
		<tbody>
		<tr>
       	  <td colspan="3"><br>
			
		   		<table border="0" width="100%">
					<tr>
					  <td width="478" align="left">
					   <table cellpadding="0" cellspacing="0" border="0" width="100%" >
                         
                        <tr style='font-size:14px;'>
                          <td width="82" rowspan="2" valign="top" style="text-align:left; width:40px;" >ATTN :</td>
                          <td colspan="2" style="text-align:left;width:140px; ">
						  	Formula Development Dept.<br>
							Production Control Dept.<br>
							Marketing Strategy Dept.<br>
							International Sales Dept.<br>
						    <br>						  </td>
							<td width="104" valign="top" style="text-align:left; width:50px;" ></td>
                        </tr>      
						<tr style='font-size:14px;'>
						<td width="188" valign="top" style="text-align:left; width:70px; height:20px;" >MCJ Product Development</td>
						<td width="94" valign="top" style="text-align:left; width:50px; height:20px;" ><label>
                <input type="checkbox" name="Purpose1" <?php if ($tampildata['MCJ_Proudct']==0) { echo 'checked="checked"';} ?> 
				disabled="disabled">Prodev 1</label></td>
						<td style="text-align:left; width:50px; height:20px;" valign="top" ><label>
                <input type="checkbox" name="Purpose1" <?php if ($tampildata['MCJ_Proudct']==1) { echo 'checked="checked"';} ?> 
				disabled="disabled">Prodev 2</label></td>
                        </tr>  
                      </table>					 
					  
					 </td>
					 <td width="125" valign="bottom" style='font-size:14px;' > </td>
					 <td width="397" height="24" valign="top" align="right">
					 <table cellpadding="0" cellspacing="0" border="1" width="100%" >
                       <tr style='font-size:14px;'>
                         
                         <td style="text-align:left;height:20px;padding:2px 2px 2px 2px;"> 
						 <strong>Regulation :</strong><br>	<br>																				
						1. 	This form should be issued after decide final formulation.<br>																		
						2.	Should be clear when use space, slash, and capital letter in each text.<br>																						
						3.	This final name sould be written exactly same on the product as official information.<br>																						
						4.	It may use separate form for one product if needed.</td>
                       </tr>
                     </table></td>
				 </tr>
				</table>

				<br>
			
			
			
		   		<table border="0" width="100%" >
                  <tr>
                    <td width="478" align="left"><table cellpadding="0" cellspacing="0" border="1" width="100%" >
                        <tr style='font-size:14px;'>
                          <td  style="text-align:center; width:150px; height:30px;" >
						  <b>Project Name<br>
						  (same as NPRL project name)</td>
                          <td colspan="2" style="text-align:center;width:140px; "><b> <?php echo $tampildata['Project_Name'] ; ?>
                          </td>
                           
                        </tr>
 
                    </table></td>
                    <td width="125" valign="bottom" style='font-size:14px;' ></td>
                    <td width="397" height="24" valign="top" align="right"><table cellpadding="0" cellspacing="0" border="1" width="100%" >
                      <tr style='font-size:14px;'>
                        <td  style="text-align:center; width:150px; height:30px;" ><b>Launching</td>
                        <td colspan="2" style="text-align:center;width:140px; "><b> <?php echo $tampildata['Launching_Date'] ; ?> </td>
                      </tr>
                    </table></td>
                  </tr>
                </table>
				 
				<table border="0" width="100%">
                  <tr>
                    <td width="478" align="left"><table cellpadding="0" cellspacing="0" border="0" width="100%" >
                        <tr style='font-size:14px;'>
                          <td width="148"  style="text-align:left; width:50px; height:30px;" >
						  <label>
						  <input type="checkbox" name="typerequest" 
						  <?php if ($tampildata['Type_Request']=="Domestic") { echo 'checked="checked"';} ?> disabled="disabled"> Domestic  
						  </label>
						  </td>
						  <td width="320"  style="text-align:left; width:150px; height:30px;" >
						  <label>
                             <input type="checkbox" name="typerequest" 
						  <?php if ($tampildata['Type_Request']=="Export") { echo 'checked="checked"';} ?> disabled="disabled"> 
						  Export (  <?php $exe = mysqli_query($con,"Select CONCAT(', ', Country) AS Country FROM tb_fnim_Country  
						  Where Request_No = '".$tampildata['Request_No']."'   "); 
						  while(@$rowFNIMCountry =mysqli_fetch_array($exe)){
						  		echo $rowFNIMCountry['Country'] ;
						  		
						  }
				
						  ?>     )  
						  </label>
						  </td>
                        </tr>
                    </table></td>
                    <td width="125" valign="bottom" style='font-size:14px;' ></td>
                    <td width="397" height="24" valign="top" align="right"></td>
                  </tr>
				  <tr>
				  	<td colspan="3"><table cellpadding="0" cellspacing="0" border="3" width="100%" >
                      <tr style='font-size:14px;' bgcolor="#999999">
                        <td width="20" style="text-align:center; height:40px; adding:2px 2px 2px 2px;">No</td>
                        <td width="200" style="text-align:center;  padding:2px 2px 2px 2px;">Final
                          Product Name (Same as registration name)</td>
                        <td width="7%" style="text-align:center; padding:2px 2px 2px 2px;">Netto</td>
                        <td width="30" style="text-align:center; padding:2px 2px 2px 2px;">Assumed Consumer Price</td>
                        <td width="20" style="text-align:center; padding:2px 2px 2px 2px;">Formula</td>
                        <td width="20" style="text-align:center; padding:2px 2px 2px 2px;">Formula Sample Code</td>
                        <td width="20" style="text-align:center; padding:2px 2px 2px 2px;">Fragrance
                          Code</td>
                        <td width="20" style="text-align:center;  padding:2px 2px 2px 2px;">Package on Store</td>
                        <td width="40" style="text-align:center; padding:2px 2px 2px 2px;">MCJ Item No.</td>
						<td width="80" style="text-align:center;  padding:2px 2px 2px 2px;">Note</td>
                      </tr>
					  <?php
					$exe = mysqli_query($con,"SELECT ID_No,Product_Name,Isi_Net,Netto,NamaCurrency,Assumed_Consumer_Price,Formula,
					Formula_Sample_Code,Fragrance_Code,Package_On_Stone,MCJ_Item_No,Note,Index_No 
					FROM tb_fnim_detail Where Request_No = '".$tampildata['Request_No']."'   ");
					$no = 1;
					while(@$rowFNIMDetail =mysqli_fetch_array($exe)){
					?>
				  <tr style="font-size:14px; text-align:left; height:30px; padding:2px 2px 2px 2px;">
					<td style="padding:2px 2px 2px 2px;"><?php echo $no; ?></td>
					<td style="padding:2px 2px 2px 2px; word-spacing: 5px;"><?php echo $rowFNIMDetail['Product_Name']; ?></td>
					<td style="padding:2px 2px 2px 2px;"><?php 
					$isinetto="";
					$exeNetto = mysqli_query($con,"SELECT ID_No,Isi_Net,Netto,Index_No 
					FROM tb_fnim_detail_netto Where Request_No = '".$tampildata['Request_No']."' And
					ID_No_FnimDetail='".$rowFNIMDetail['ID_No']."'  Order By ID_No Asc");
					while(@$rowFNIMDetailNetto =mysqli_fetch_array($exeNetto)){ 
						$isinetto=$isinetto.$rowFNIMDetailNetto['Isi_Net']." ".$rowFNIMDetailNetto['Netto'].", ";
					} 
					echo substr($isinetto,0,-2);?></td>
					<td style="font-size:14px;text-align:right;  padding:2px 2px 2px 2px;">
					<?php if ($rowFNIMDetail['Assumed_Consumer_Price'] !="0") {echo $rowFNIMDetail['NamaCurrency']." ".formatMoney($rowFNIMDetail['Assumed_Consumer_Price'], 1);}?></td>
					<td  valign="top">					
					<?php ShowTableDetail("tb_fnim_detail_Formula","Formula","Request_No","ID_No_FnimDetail",$tampildata['Request_No'],$rowFNIMDetail['ID_No'],"ID_No"); ?></td>
					<td  valign="top" >
					<?php ShowTableDetail("tb_fnim_detail_Formula_Sample_Code","Formula_Sample_Code","Request_No","ID_No_FnimDetail",$tampildata['Request_No'],$rowFNIMDetail['ID_No'],"ID_No"); ?> 
					</td>
					<td  valign="top" >
					<?php ShowTableDetail("tb_fnim_detail_fragrance_code","Fragrance_Code","Request_No","ID_No_FnimDetail",$tampildata['Request_No'],$rowFNIMDetail['ID_No'],"ID_No"); ?> 
					</td>
					<td  valign="top"  >
					<?php ShowTableDetail("tb_fnim_detail_package_On_Store","Package_On_Store","Request_No","ID_No_FnimDetail",$tampildata['Request_No'],$rowFNIMDetail['ID_No'],"ID_No"); ?> 
</td>
					<td style="padding:2px 2px 2px 2px;"><b><font color="#0000FF"><?php echo $rowFNIMDetail['MCJ_Item_No']; ?></font></b></td>
					<td style="font-size:14px;text-align:left;  padding:2px 2px 2px 2px;"><?php echo $rowFNIMDetail['Note']; ?></td>
				  </tr>
				  <?php $no++;} ?>
                    </table></td>
				  </tr>
				  <tr>
				  <td colspan="3"  style="font-size:14px; text-align:right;   padding:2px 2px 2px 2px;">
				  Date Issued : <?php echo Shownamettd('DATE_FORMAT(ApproveDate, "%d-%m-%Y")',$tampildata['Request_No'],'FNIM','1');?>
				  </td>
				  </tr>
                  <tr>
                    <td width="398" align="left"><table cellpadding="0" cellspacing="0" border="1" width="100%" >
                        <tr style='font-size:14px;'>
                        <td  valign="top" style="text-align:left; width:150px; height:70px;padding:2px 2px 2px 2px;" >
						<label>Note : <br>
                          <?php echo $tampildata['Note']; ?>						  </label>                        </td>
                      </tr>
                    </table></td>
			        <td width="50" align="left">&nbsp;</td>
                    <td width="410" rowspan="2" align="left"><table cellpadding="0" cellspacing="0" border="1" width="100%" >

                      <tr style='font-size:14px;'>
                        <td style="text-align:center; width:100px; height:20px;" >Acknowledged by</td>
                        <td style="text-align:center; width:100px; height:20px;" > Approved By</td>
                        <td style="text-align:center; width:100px; height:20px; ">Checked by</td>
                        <td style="text-align:center; width:100px; height:20px; ">Prepared by</td>
                      </tr>
                      <tr style='font-size:14px;'>
                        <td align="center" style="height:20px;">Director/EO/GM</td>
                        <td align="center">Asst MG/MG</td>
                        <td align="center">Data Control</td>
                        <td align="center">PIC</td>
                      </tr>
                      <tr style='font-size:14px;'>
                        <td valign="center" align="center" style=" width:20px; height:120px;">
						<?php ShowTtdNamaTglByPosisi($tampildata['Request_No'],"FNIM",'46599,51721,52907');?>
						</td>
                        <td style="text-align:center;">
						<?php ShowTtdNamaTglByPosisi($tampildata['Request_No'],"FNIM","04,52804");?></td>
                        <td align="center">
						<?php ShowTtdNamaTglByPosisiDivisiFNIMDataControl($tampildata['Request_No'],"FNIM","'01','02','03'","'O03','21MS3','2018GPRDV2','20LCPRDV001'");?></td>
                        <td align="center">
						<?php 
						ShowTtdNamaTglByPosisiDivisiFNIMDataControl($tampildata['Request_No'],"FNIM","'01','02','03'","'20GPRDV1301','2018GPRDV5','20LCPRDV001','19GPRDV24'"); 
						//ShowTtdNamaTglByPosisiRequestorStep1($tampildata['Request_No'],"FNIM","'01','02','03'"); ?>
						</td>
                      <!--tr style='font-size:10px;'>
                        <td align="center" style="padding:2px 2px 2px 2px; height:20px;">
						
						<?php ShowTtdNamaTglByPosisi($tampildata['Request_No'],"FNIM",'46599');?>
						</td>
                        <td align="center" style="padding:2px 2px 2px 2px; height:20px;"><?php echo Shownamettd('Name',$tampildata['Request_No'],'FNIM','3');?></td>
                        <td align="center"  style="padding:2px 2px 2px 2px; height:20px;"><?php echo Shownamettd('Name',$tampildata['Request_No'],'FNIM','2');?></td>
                        <td align="center" style="padding:2px 2px 2px 2px; height:20px;"><?php echo Shownamettd('Name',$tampildata['Request_No'],'FNIM','1');?></td>
                      </tr>
                      <tr style='font-size:10px;'>
                        <td align="center" style="padding:2px 2px 2px 2px; height:20px;"><?php echo Shownamettd('DATE_FORMAT(ApproveDate, "%d-%m-%Y")',$tampildata['Request_No'],'FNIM','4');?></td>
                        <td align="center" style="padding:2px 2px 2px 2px; height:20px;"><?php echo Shownamettd('DATE_FORMAT(ApproveDate, "%d-%m-%Y")',$tampildata['Request_No'],'FNIM','3');?></td>
                        <td align="center"  style="padding:2px 2px 2px 2px; height:20px;"><?php echo Shownamettd('DATE_FORMAT(ApproveDate, "%d-%m-%Y")',$tampildata['Request_No'],'FNIM','2');?></td>
                        <td align="center" style="padding:2px 2px 2px 2px; height:20px;"><?php echo Shownamettd('DATE_FORMAT(ApproveDate, "%d-%m-%Y")',$tampildata['Request_No'],'FNIM','1');?></td>
                      </tr-->
                    </table></td>
                  </tr>
                  <tr>
                    <td align="left">&nbsp;</td>
                    <td align="left">&nbsp;</td>
                    </tr>
                  <tr>
                    <td align="left">&nbsp;</td>
					
                    <td align="left" colspan="2">
                      <table cellpadding="0" cellspacing="0" border="0" width="100%" >
                      <tr style='font-size:14px;'>
                        <td width="124"  style="text-align:right; width:140px; height:30px;" ><b>&#23481;&#37327;&#20385;&#26684;&#21517;&#31216;&#36899;&#32097;&#26360;NO</td>
                        <td width="138" style="text-align:center;width:120px; ">
						<table cellpadding="0" cellspacing="0" border="1" height="100%" width="90%">
							<tr>
								<td style="text-align:left; width:20px; height:10px; padding:2px 2px 2px 2px;">
								<b><font color="#0000FF"><?php echo $tampildata['Thema_Number']; ?>
								<!--?php caridata1('tb_nprf','Request_No','Thema_Number',$tampildata['NPRF_Code']) ?--></font></b></td>
						    </tr>
						</table>						</td>
                        <td width="70" style="text-align:center;width:10px; "><table cellspacing="0" cellpadding="0">
  <td height="19" width="23">&#21517;</td>
                        </table>                        </td>
                        <td width="70" style="text-align:center;width:50px; ">
						<table cellpadding="0" cellspacing="0" border="1"  >
                          <tr>
                            <td style="text-align:left; width:25px; height:10px;">&nbsp;</td>
                            <td style="text-align:left; width:25px; height:10px;">&nbsp;</td>
                          </tr>
                        </table>
						</td>
                        <td width="70" style="text-align:center;width:20px; "> - </td>
                        <td width="70" style="text-align:center;width:20px; ">
						<table cellpadding="0" cellspacing="0" border="1"  >
                          <tr>
                            <td style="text-align:left; width:30px; height:10px;">&nbsp;</td>
                          </tr>
                        </table></td>
                      </tr>
                    </table></td>
                  </tr>
                </table>
 	 		</td>
		</tr>
	</table>
	<tbody>
</table>
<?php
};
 ?>
</body>
</html>
 