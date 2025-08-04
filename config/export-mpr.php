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
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Report MPR <?php echo $id;?></title>
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
<body <?php if ($page=="privew-mpr"){ echo 'background="../img/watermark.png"';}?> readonly="readonly">
<?php
if ($page=="mpr"){?>
<script>
window.print();
</script>
<?php } ?>
<?php
if ($page=="mpr"|| $page=="privew-mpr"){
		$uploadDirFileMcj	 			= "../img/Mcj/";
		include "connect.php";
      	$exe =mysqli_query($con,"SELECT a.ID_No,a.Request_No,a.Project_Name,a.FNIM_Code,a.Type_Request,a.Type,a.Brand,a.Bisnis,a.Category,
		a.Segmentation,a.CustomerCode,a.Royalty,a.KeteranganProduct,a.NoBarcodeExisting,a.CustomerCodeFormula,a.RoyaltyFormula,
		a.Flex,a.SAP,a.Status_MPR,b.Code_Product,b.BARCODE FROM tb_mpr a INNER JOIN tb_mpr_detail b
		ON a.Request_No=b.Request_No where a.Request_No = '".$id."' ");
        $tampildata=mysqli_fetch_array($exe);
		$typeReq=@$tampildata['Type_Request'];
		if($typeReq=="Domestic")	{
			$NoIso="FR/GPD/GPD1-0008";
			$tglIso="24/08/2018";}
		elseif($typeReq=="Export"){
			$NoIso="FR/GPD/GM1-2001";
			$tglIso="23/11/2017";}
		else{
			$NoIso="";
			$tglIso="";}
	/*if ($page=="privew-mpr") { echo '<h1>Preview Report</h1>';} */?> 
	<table  class="demo-table responsive" border="1" width="1024" align="center">
	<thead>
		<tr style='font-size:11px; height:15px;'>
		  <td rowspan="4" style="width:100px;"><img src="../img/Logo.png"  width="100px n" height="70"></td>
		  <td rowspan="4"  align="center" valign="middle" style="width:700px;">
		  <h2>MASTER PRODUCT <?php  echo strtoupper($typeReq);?></h2></td>
		  <td align="left" style="width:230px;">
		  NO : <?php  echo strtoupper($NoIso);?></td>
	  	</tr>
		<tr style='font-size:11px; height:15px;'>
		  <td align="left" style='padding:2px 2px 2px 2px;'>Tgl Berlaku : <?php  echo strtoupper($tglIso);?></td>
	  	</tr>
		<tr style='font-size:11px; height:15px;'>
		  <td align="left" style='padding:2px 2px 2px 2px;'>New Rev : </td>
	  	</tr>
		<tr style='font-size:11px; height:15px;'>
       	  <td align="left" style='padding:2px 2px 2px 2px;'>Hal : 1 dari 1</td>
        </tr>
		</thead>
		<tbody>
		<?php $exe =mysqli_query($con,"SELECT a.ID_No,a.Request_No,a.Project_Name,a.Type_Request,a.Country,
		a.Type,a.Brand,a.Bisnis,a.Series,a.Category,a.Segmentation,a.CustomerCode,a.Royalty,a.KeteranganProduct,
		a.NoBarcodeExisting,a.CustomerCodeFormula,a.RoyaltyFormula,a.FNIM_Code,
		b.Nama_Produk_Singkat,b.Kelompok_Stok,a.Flex,a.SAP,a.Status_MPR,c.Product_Name,b.ID_NoFNIMDetail,
		b.Price,b.ISI,b.UOM1,b.DZ_CT,b.CT_CT,b.UOM,b.Code_Product,b.BARCODE FROM tb_mpr a INNER JOIN tb_mpr_detail b
		ON a.Request_No=b.Request_No INNER JOIN tb_fnim_detail c on b.ID_NoFNIMDetail=c.ID_No where a.Request_No = '".$id."' 
		And c.Request_No = '".@$tampildata['FNIM_Code']."'");
        
		while(@$tampildataDetail =mysqli_fetch_array($exe)){
					?>
		<tr>
       	  <td colspan="3"><table border="0" width="100%">
            <tr style='font-size:11px; height:15px;padding:2px 2px 2px 2px;"'>
              <td width="2%" align="left">I.</td>
              <td width="20%" align="left">NAMA PRODUK [RESMI]</td>
              <td align="left" colspan="8"><table cellpadding="0" cellspacing="0" class="demo-table responsive"  border="1" width="100%">
                  <tr style='font-size:11px;'>
                    <td valign="top" style='text-align:left;height:15px;padding:2px 2px 2px 2px;'><label><?php echo strtoupper($tampildataDetail['Product_Name']);?></label></td>
                  </tr>
              </table></td>
            </tr>
            <tr style='font-size:11px; height:15px;padding:2px 2px 2px 2px;'>
              <td align="left">&nbsp;</td>
              <td align="left">NETTO</td>
              <td width="14%" align="left"><table cellpadding="0" cellspacing="0" class="demo-table responsive" border="1" width="80%">
                  <tr style='font-size:11px;'>
                    <td  valign="top" style='text-align:left;height:15px;padding:2px 2px 2px 2px;'>
					<label> 
					<?php 
					$isinetto="";
					$exeNetto = mysqli_query($con,"SELECT ID_No,Isi_Net,Netto,Index_No 
					FROM tb_fnim_detail_netto Where Request_No = '".$tampildataDetail['FNIM_Code']."' And
					ID_No_FnimDetail='".$tampildataDetail['ID_NoFNIMDetail']."'  Order By ID_No Asc");
					while(@$rowFNIMDetailNetto =mysqli_fetch_array($exeNetto)){ 
						$isinetto=$isinetto.$rowFNIMDetailNetto['Isi_Net']." ".$rowFNIMDetailNetto['Netto'].", ";
					} 
					echo substr($isinetto,0,-2);  ?></label>                    
					</td>
                  </tr>
              </table></td>
              <td width="3%" align="left">&nbsp;</td>
              <td colspan="5"align="left">&nbsp;</td>
              <td width="27%"align="left">UNIT PRICE </td>
            </tr>
            <tr style='font-size:11px; height:15px;padding:2px 2px 2px 2px;"'>
              <td align="left">&nbsp;</td>
              <td align="left">ISI</td>
              <td align="left"><table cellpadding="0" cellspacing="0" border="1" class="demo-table responsive" width="80%">
                  <tr style='font-size:11px;'>
                    <td  valign="top" style='text-align:right;height:15px;padding:2px 2px 2px 2px;'>
					<label><?php echo strtoupper($tampildataDetail['ISI']);?></label></td>
                  </tr>
              </table></td>
              <td align="left">PCS</td>
              <td colspan="5" align="left">[ <?php echo strtoupper($tampildataDetail['UOM1']);?> ]</td>
              <td align="left">
			  <table cellpadding="0" cellspacing="0" border="1" class="demo-table responsive" width="50%">
                <tr style='font-size:11px;'>
                  <td  valign="top" style="text-align:left; with:20px; height:15px;padding:2px 2px 2px 2px;"> 
                    <?php caridata1('tb_trading_partner a Inner Join tb_currency b ON a.KDCurrency=b.KDCurrency','CustomerCode','NamaCurrency',$tampildataDetail['Country']) ?></td>
                  <td valign="top" style="text-align:right;height:15px;padding:2px 2px 2px 2px;"><label>
                  <?php echo $tampildataDetail['Price'] ;?></label></td>
                </tr>
              </table>
              </td>
            </tr>
            <tr style='font-size:11px; height:15px;padding:2px 2px 2px 2px;"'>
              <td align="left">&nbsp;</td>
              <td align="left">DZ/CT</td>
              <td align="left"><table cellpadding="0" cellspacing="0" border="1" width="80%" class="demo-table responsive">
                  <tr style='font-size:11px;'>
                    <td valign="top" style="text-align:right;height:15px;padding:2px 2px 2px 2px;"><label><?php echo strtoupper($tampildataDetail['DZ_CT']);?></label></td>
                  </tr>
              </table></td>
              <td align="left">DOZ</td>
              <td colspan="5" align="left">[ <?php $jum=(12*$tampildataDetail['DZ_CT'])/$tampildataDetail['ISI']; echo $jum; ?> 
			  <?php echo strtoupper($tampildataDetail['UOM1'])." x ".$tampildataDetail['ISI']." PCS";?>
                ]</td>
              <td align="left">UNIT</td>
            </tr>
            <tr style='font-size:11px; height:15px;padding:2px 2px 2px 2px;"'>
              <td align="left">&nbsp;</td>
              <td align="left">CT/CT</td>
              <td align="left"><table cellpadding="0" cellspacing="0" border="1" width="80%" class="demo-table responsive">
                  <tr style='font-size:11px;'>
                    <td  valign="top" style="text-align:right;height:15px;padding:2px 2px 2px 2px;" >
					<label><?php if ($tampildataDetail['CT_CT']==0) { echo "";} else {echo $tampildataDetail['CT_CT'];}?></label></td>
                  </tr>
              </table></td>
              <td align="left">CT</td>
              <td colspan="5" align="left">&nbsp;</td>
              <td align="left"><table cellpadding="0" cellspacing="0" border="1" width="30%" class="demo-table responsive">
                <tr style='font-size:11px;'>
                  <td valign="top" style="height:15px;padding:2px 2px 2px 2px;"><label>
                    <?php echo  $tampildataDetail['UOM'] ;?></label></td>
                </tr>
              </table></td>
            </tr>
            <tr style='font-size:11px; height:15px;padding:2px 2px 2px 2px;"'>
              <td align="left">&nbsp;</td>
              <td align="left">CATEGORY 2[TYPE]</td>
              <td align="left" colspan="2"><table cellpadding="0" cellspacing="0" border="1" width="100%" class="demo-table responsive">
                  <tr style='font-size:11px;'>
                    <td valign="top" style="text-align:left;height:15px;padding:2px 2px 2px 2px;">
					<label><?php echo strtoupper($tampildataDetail['Type']);?></label></td>
                  </tr>
              </table></td>
              <td width="39%" colspan="5" align="left">&nbsp;</td>
              <td align="left">TERMS</td>
            </tr>
            <tr style='font-size:11px; height:15px;padding:2px 2px 2px 2px;"'>
              <td align="left">&nbsp;</td>
              <td align="left">CATEGORY 4 [MARKET]</td>
              <td align="left" colspan="2"><table cellpadding="0" cellspacing="0" border="1" width="100%" class="demo-table responsive">
                  <tr style='font-size:11px;'>
                    <td valign="top" style="text-align:left;height:15px;padding:2px 2px 2px 2px;">
					<label><?php echo strtoupper($tampildataDetail['Type_Request']);?>   
					<?php if ($tampildataDetail['Type_Request']=="Export"){echo " - ";}?>                 
					<?php caridata1('tb_trading_partner','CustomerCode','Country',$tampildataDetail['Country']) ?></label></td>
                  </tr>
              </table></td>
              <td colspan="5" align="left">&nbsp;</td>
              <td align="left"><table cellpadding="0" cellspacing="0" border="1" width="30%" class="demo-table responsive">
                <tr style='font-size:11px;'>
                  <td  valign="top" style="text-align:left;height:15px;padding:2px 2px 2px 2px;" ><label></label>
                    <?php  caridata1('tb_trading_partner','CustomerCode','FOB_CF_CIF',$tampildataDetail['Country']) ?></td>
                </tr>
              </table></td>
            </tr>
            <tr style='font-size:11px; height:15px;padding:2px 2px 2px 2px;"'>
              <td align="left">&nbsp;</td>
              <td align="left">CATEGORY 6 [BRAND]</td>
              <td align="left" colspan="2"><table cellpadding="0" cellspacing="0" border="1" width="100%" class="demo-table responsive">
                  <tr style='font-size:11px;'>
                    <td valign="top" style="text-align:left;height:15px;padding:2px 2px 2px 2px;">
					<label><?php echo strtoupper($tampildataDetail['Brand']);?></label></td>
                  </tr>
              </table></td>
              <td colspan="5" align="left">&nbsp;</td>
              <td align="left">&nbsp;</td>
            </tr>
            <tr style='font-size:11px; height:15px;padding:2px 2px 2px 2px;"'>
              <td align="left">&nbsp;</td>
              <td align="left">CATEGORY 7 [BISNTS]</td>
              <td align="left" colspan="2"><table cellpadding="0" cellspacing="0" border="1" width="100%" class="demo-table responsive">
                  <tr style='font-size:11px;'>
                    <td valign="top" style="text-align:left;height:15px;padding:2px 2px 2px 2px;" >
					<label><?php echo strtoupper($tampildataDetail['Bisnis']);?></label></td>
                  </tr>
              </table></td>
              <td colspan="5" align="left">&nbsp;</td>
              <td align="left">Keterangan :</td>
            </tr>
            <tr style='font-size:11px; height:15px;padding:2px 2px 2px 2px;"'>
              <td align="left">&nbsp;</td>
              <td align="left">CATEGORY 8 [SERIES]</td>
              <td align="left" colspan="2"><table cellpadding="0" cellspacing="0" border="1" width="100%" class="demo-table responsive">
                  <tr style='font-size:11px;'>
                    <td valign="top"style="text-align:left;height:15px;padding:2px 2px 2px 2px;">
					<label><?php echo strtoupper($tampildataDetail['Series']);?></label></td>
                  </tr>
              </table></td>
              <td colspan="5" align="left">&nbsp;</td>
              <td align="left"><input type="checkbox" name="SAP" onClick="return false;"
				<?php if ($tampildata['SAP']==1) { echo 'checked="checked"';} ?>>
				SAP <input type="checkbox" name="Flex"    onclick="return false;"
			  <?php if ($tampildata['Flex']==1) { echo 'checked="checked"';} ?>>
				Flexprocess </td>
            </tr>
            <tr style='font-size:11px; height:15px;padding:2px 2px 2px 2px;"'>
              <td align="left">&nbsp;</td>
              <td align="left">CATEGORY 9 [CATEGORY]</td>
              <td align="left" colspan="2"><table cellpadding="0" cellspacing="0" border="1" width="100%" class="demo-table responsive">
                  <tr style='font-size:11px;'>
                    <td valign="top" style="text-align:left;height:15px;padding:2px 2px 2px 2px;">
					<label><?php echo strtoupper($tampildataDetail['Category']);?></label></td>
                  </tr>
              </table></td>
              <td colspan="5" align="left">&nbsp;</td>
              <td align="left">&nbsp;</td>
            </tr>
            <tr style='font-size:11px; height:15px;padding:2px 2px 2px 2px;"'>
              <td align="left">&nbsp;</td>
              <td align="left">CATEGORY 1O [SEGMENTATION]</td>
              <td align="left" colspan="2"><table cellpadding="0" cellspacing="0" border="1" width="100%" class="demo-table responsive">
                  <tr style='font-size:11px;'>
                    <td valign="top" style="text-align:left;height:15px;padding:2px 2px 2px 2px;"><label>
					<?php echo strtoupper($tampildataDetail['Segmentation']);?></label></td>
                  </tr>
              </table></td>
              <td colspan="5" align="left">&nbsp;</td>
              <td align="left">&nbsp;</td>
            </tr>
            <tr style='font-size:11px; height:15px;padding:2px 2px 2px 2px;"'>
              <td align="left">&nbsp;</td>
              <td align="left">ROYALTY MERK</td>
              <td align="left" colspan="7"><table cellpadding="0" cellspacing="0" border="1" width="100%" class="demo-table responsive">
                  <tr style='font-size:11px;'>
                    <td valign="top" style="text-align:left;height:15px;padding:2px 2px 2px 2px;">
					<label><?php echo strtoupper($tampildataDetail['CustomerCode']);?></label></td>
                  </tr>
              </table></td>
              <td align="left"><table cellpadding="0" cellspacing="0" border="1" width="20%" class="demo-table responsive">
                  <tr style='font-size:11px;'>
                    <td  valign="top" style="text-align:right;height:15px;padding:2px 2px 2px 2px;">
					<label><?php echo  $tampildataDetail['Royalty']." %" ;?></label></td>
                  </tr>
              </table></td>
            </tr>
            <tr style='font-size:11px; height:15px;padding:2px 2px 2px 2px;"'>
              <td align="left">&nbsp;</td>
              <td align="left">KETERANGAN PRODUK</td>
              <td align="left" colspan="8"><table cellpadding="0" cellspacing="0" border="1" width="100%" class="demo-table responsive">
                  <tr style='font-size:11px;'>
                    <td valign="top" style="text-align:left;height:15px;padding:2px 2px 2px 2px;">
					<label><?php echo strtoupper($tampildataDetail['KeteranganProduct']);?></label></td>
                  </tr>
              </table></td>
            </tr>
            <tr style='font-size:11px; height:15px;padding:2px 2px 2px 2px;"'>
              <td align="left">&nbsp;</td>
              <td align="left">NO. BARCODE EXISTING</td>
              <td align="left" colspan="2"><table cellpadding="0" cellspacing="0" border="1" width="100%" class="demo-table responsive">
                  <tr style='font-size:11px;'>
                    <td valign="top" style="text-align:left;height:15px;padding:2px 2px 2px 2px;">
					<label><?php echo strtoupper($tampildataDetail['NoBarcodeExisting']);?></label></td>
                  </tr>
              </table></td>
              <td colspan="5" align="left">&nbsp;</td>
              <td align="left">&nbsp;</td>
            </tr>
            <tr style='font-size:11px; height:1px;padding:2px 2px 2px 2px;"'>
              <td align="left" colspan="10"><hr></td>
            </tr>
            <tr style='font-size:11px; height:15px;padding:2px 2px 2px 2px;"'>
              <td align="left">II.</td>
              <td align="left">KODE PRODUK</td>
              <td align="left" colspan="2"><table cellpadding="0" cellspacing="0" border="1" width="100%" class="demo-table responsive">
                  <tr style='font-size:11px;'>
                    <td valign="top" style="text-align:left;height:15px;padding:2px 2px 2px 2px;">
					<label><?php echo strtoupper($tampildataDetail['Code_Product']);?></label></td>
                  </tr>
              </table></td>
              <td colspan="5" align="left">&nbsp;</td>
              <td align="left">&nbsp;</td>
            </tr>
            <tr style='font-size:11px; height:15px;padding:2px 2px 2px 2px;"'>
              <td align="left">&nbsp;</td>
              <td align="left">NO. BARCODE APP</td>
              <td align="left" colspan="2"><table cellpadding="0" cellspacing="0" border="1" width="100%" class="demo-table responsive"> 
                  <tr style='font-size:11px;'>
                    <td valign="top" style="text-align:left;height:15px;padding:2px 2px 2px 2px;">
					<label><?php echo strtoupper($tampildataDetail['BARCODE']);?></label></td>
                  </tr>
              </table></td>
              <td colspan="5" align="left">&nbsp;</td>
              <td align="left">&nbsp;</td>
            </tr>
            <tr style='font-size:11px; height:1px;padding:2px 2px 2px 2px;"'>
              <td align="left" colspan="10"><hr></td>
            </tr>
			<tr style='font-size:11px; height:15px;padding:2px 2px 2px 2px;"'>
              <td align="left">III.</td>
              <td align="left">ROYALTY FORMUULA</td>
              <td align="left" colspan="7"><table cellpadding="0" cellspacing="0" border="1" width="100%" class="demo-table responsive">
                  <tr style='font-size:11px;'>
                    <td valign="top" style="text-align:left;height:15px;padding:2px 2px 2px 2px;">
					<label><?php echo strtoupper($tampildataDetail['CustomerCodeFormula']);?></label></td>
                  </tr>
              </table></td>
              <td align="left"><table cellpadding="0" cellspacing="0" border="1" width="20%" class="demo-table responsive">
                  <tr style='font-size:11px;'>
                    <td  valign="top" style="text-align:right;height:15px;padding:2px 2px 2px 2px;">
					<label><?php echo  $tampildataDetail['RoyaltyFormula']." %" ;?></label></td>
                  </tr>
              </table></td>
            </tr>

            <tr style='font-size:11px; height:1px;padding:2px 2px 2px 2px;"'>
              <td align="left" colspan="10"><hr></td>
            </tr>
            <tr style='font-size:11px; height:15px;padding:2px 2px 2px 2px;"'>
              <td align="left">IV.</td>
              <td align="left">NAMA PRODUK [SINGKAT]</td>
              <td align="left" colspan="8"><table cellpadding="0" cellspacing="0" border="1" width="100%" class="demo-table responsive" >
                  <tr style='font-size:11px;'>
                    <td valign="top" style="text-align:left;height:15px;padding:2px 2px 2px 2px;">
					<label><?php echo strtoupper($tampildataDetail['Nama_Produk_Singkat']);?></label></td>
                  </tr>
              </table></td>
            </tr>
            <tr style='font-size:11px; height:15px;padding:2px 2px 2px 2px;"'>
              <td align="left">&nbsp;</td>
              <td align="left">KELOMPOK STOCK</td>
              <td align="left" colspan="8"><table cellpadding="0" cellspacing="0" border="1" width="100%" class="demo-table responsive"  >
                  <tr style='font-size:11px;'>
                    <td valign="top" style="text-align:left;height:15px;padding:2px 2px 2px 2px;">
					<label><?php echo strtoupper($tampildataDetail['Kelompok_Stok']);?></label></td>
                  </tr>
              </table></td>
            </tr>
          </table>
		   
	<?php }; ?>
</tbody>
<tfoot>
<tr><td colspan="10" valign="top" width="100%"><table width="100%"><tr style='font-size:11px; height:15px;padding:2px 2px 2px 2px;"'>
			 <td colspan="2"><table cellpadding="0" cellspacing="0" border="1" width="100%">
                <tr style='font-size:10px;'>
                  <td align="center" style="height:15px;width:190px;">
				  I. <?php echo Shownamettd('DivisionName',@$tampildata['Request_No'],'MPR','1');?></td>
                  <td align="center" style="height:15px;width:190px;">
				  ( <?php echo ShowtglDevMPR('Keterangan',@$tampildata['Request_No'],'MPR','Step 2');?> )</td>
                </tr>
                <tr style='font-size:10px;'>
                  <td valign="center" align="center" style=" height:65px;">
				  <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
				  <?php echo Showttd('SignIn',@$tampildata['Request_No'],'MPR','1');?><?php echo Showttd('SignIn',@$tampildata['Request_No'],'MPR','2');?></div> </td>
                  <td style="text-align:center;">
				  <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
				  <?php echo Showttd('SignIn',@$tampildata['Request_No'],'MPR','3');?>
				  <?php echo Showttd('SignIn',@$tampildata['Request_No'],'MPR','4');?></div></td>
                <tr style='font-size:10px;'>
                  <td align="Left" style="padding:2px 2px 2px 2px; height:15px;">
				  Tgl : <?php echo ShowtglDevMPR('DATE_FORMAT(ApproveDate, "%d-%m-%Y")',@$tampildata['Request_No'],'MPR','Requestor');?></td>
                  <td align="Left" style="padding:2px 2px 2px 2px; height:15px;">
				  Tgl : <?php echo ShowtglDevMPR('DATE_FORMAT(ApproveDate, "%d-%m-%Y")',@$tampildata['Request_No'],'MPR','Step 2');?></td>
                </tr>
              </table></td>
              <td align="left"><img src="../img/NextBW.png" height="65" width="20"></td>
			  <td align="left"><table cellpadding="0" cellspacing="0" border="1" width="100%">
                <tr style='font-size:10px;'>
                  <td align="center" style="height:15px;width:100px;">
				  II. <?php echo ShowtglDevMPR('Keterangan',@$tampildata['Request_No'],'MPR','Step 3');?></td>
                </tr>
                <tr style='font-size:10px;'>
                  <td valign="center" align="center" style=" width:30px; height:65px;">
				  <?php echo Showttd('SignIn',@$tampildata['Request_No'],'MPR','5');?></td>
                <tr style='font-size:10px;'>
                  <td align="Left" style="padding:2px 2px 2px 2px; height:15px;">
				  Tgl : <?php echo ShowtglDevMPR('DATE_FORMAT(ApproveDate, "%d-%m-%Y")',@$tampildata['Request_No'],'MPR','Step 3');?></td>
                </tr>
              </table></td>
			  <td align="left"><img src="../img/NextBW.png" height="65" width="20"></td>
			  <td align="left" ><table cellpadding="0" cellspacing="0" border="1" width="100%">
                <tr style='font-size:10px;'>
                  <td align="center" style="height:15px;width:190px;">III. <?php echo ShowtglDevMPR('Keterangan',@$tampildata['Request_No'],'MPR','Step 4');?> </td>
                </tr>
                <tr style='font-size:10px;'>
                  <td valign="center" align="center" style=" width:30px; height:65px;">
				  <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
				  <?php echo Showttdmpr('SignIn',@$tampildata['Request_No'],'MPR','Step 4','2');?>
				  <?php echo Showttdmpr('SignIn',@$tampildata['Request_No'],'MPR','Step 4','3');?></div></td>
                <tr style='font-size:10px;'>
                  <td align="left" style="padding:2px 2px 2px 2px; height:15px;">
				  Tgl : <?php echo ShowtglDevMPR('DATE_FORMAT(ApproveDate, "%d-%m-%Y")',@$tampildata['Request_No'],'MPR','Step 4');?></td>
                </tr>
              </table></td>
			  <td  align="left"><img src="../img/NextBW.png" height="65" width="20"></td>
			  <td align="left" ><table cellpadding="0" cellspacing="0" border="1" width="100%">
                <tr style='font-size:10px;'>
                  <td align="center" style="height:15px;width:100px;">IV. <?php echo ShowtglDevMPR('Keterangan',@$tampildata['Request_No'],'MPR','Step 5');?> </td>
                </tr>
                <tr style='font-size:10px;'>
                  <td valign="center" align="center" style=" width:30px; height:65px;">
				  <?php echo Showttdmpr('SignIn',@$tampildata['Request_No'],'MPR','Step 5','2');?></td>
                <tr style='font-size:10px;'>
                  <td align="left" style="padding:2px 2px 2px 2px; height:15px;">
				  Tgl : <?php echo ShowtglDevMPR('DATE_FORMAT(ApproveDate, "%d-%m-%Y")',@$tampildata['Request_No'],'MPR','Step 5');?></td>
                </tr>
              </table></td>
			  <td  align="left"><img src="../img/NextBW.png" height="65" width="20"></td>
			  <td align="left" ><table cellpadding="0" cellspacing="0" border="1" width="100%">
                <tr style='font-size:10px;'>
                  <td align="center" style="height:15px;width:100px;">
				  <?php echo ShowtglDevMPR('Keterangan',@$tampildata['Request_No'],'MPR','Step 6');?> </td>
                </tr>
                <tr style='font-size:10px;'>
                  <td valign="center" align="center" style=" width:30px; height:65px;">
				  <?php echo Showttdmpr('SignIn',@$tampildata['Request_No'],'MPR','Step 6','2');?></td>
                <tr style='font-size:10px;'>
                  <td align="left" style="padding:2px 2px 2px 2px; height:15px;">
				  Tgl : <?php echo ShowtglDevMPR('DATE_FORMAT(ApproveDate, "%d-%m-%Y")',@$tampildata['Request_No'],'MPR','Step 6');?></td>
                </tr>
              </table></td>
		<td align="left"><img src="../img/NextCopy.png" height="70" width="40"></td>
		<td align="left"><table cellpadding="0" cellspacing="0" border="1" width="100%">
          <tr style='font-size:10px;'>
            <td align="left" style="height:15px;width:140px;">Packaging Develop</td>
          </tr>
          <tr style='font-size:10px;'>
            <td align="left" style="height:15px;">Domestic Sales</td>
		  </tr>
		  <tr style='font-size:10px;'>
            <td align="left" style="height:15px;">Sales Planning</td>
		  </tr>
		  <tr style='font-size:10px;'>
            <td align="left" style="height:15px;">Marketing</td>
		  </tr>
		  <tr style='font-size:10px;'>
            <td align="left" style="height:15px;">Pengirman</td>
		  </tr>
		  <tr style='font-size:10px;'>
            <td align="left" style="height:15px;">Accounting</td>
		  </tr>
		  <tr style='font-size:10px;'>
            <td align="left" style="height:15px;">IT</td>
		  </tr>
        </table></td>
            
	<td align="left" valign="top" style="height:15px;width:40px;"></td>
</tr></table></td></tr>
</tfoot>
</table>
	

</table>
<?php }; ?>
</body>
</html>
 