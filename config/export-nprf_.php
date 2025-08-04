
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
<title>Report <?php if ($page=="privew-nprf"|| $page=="nprf"){ echo 'NPRF '. $id;}?></title>

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

<style>
div {
  width:1000; 
  border: 0px;
}

div.a {
  word-wrap: normal;
}

div.b {
  word-wrap: break-word;
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
<style>
 
    body {
		transform: scale(1);
        height: 842px;
        width: 595px;
        /* to centre page on screen*/
        margin-left: 1px;
        margin-right: 1px;
    }
    </style>

</head>
<body <?php if ($page=="privew-nprf"){ echo 'background="../img/watermark.png"';}?>>
<?php
if ($page=="nprf"){?>
<script>
window.print();
</script>
<?php } 
if ($page=="nprf"|| $page=="privew-nprf"){
		include "connect.php";
      	$exe =mysqli_query($con,"SELECT ID_No,Request_No,Thema_Number,Thema_Name,Type_Request,SentTo,Purpose_1,Purpose_2,Purpose_3,
		Purpose_4,Purpose_5,Priority_Point_EmphasisOnPrice,Priority_Point_HighQuality,Priority_Point_Other,Priority_Point_OtherEtc,
		date_format(Launching_Date,'%M-%Y') as Launching_Date,Objective_Aim,Goal_Indicator,Market_Situasion,
		T_Consumer_M,T_Consumer_F,T_Age_GroupStart,T_Age_GroupEnd,T_Sosial_Economic_Class,Status_NPRF,
		Proposed_Concept,Request_for_Content,Request_for_Design,Distribution,Competitor,Distribution,Others,
		Outline_of_Schedule,Remark FROM tb_nprf where Request_No = '".@$_GET['id']."'  ");
        $tampildata=mysqli_fetch_array($exe);
		$typeReq=$tampildata['Type_Request'];
		if($tampildata['Type_Request']=="Domestic" || $tampildata['Type_Request']=="Export")	{
			$NoIso="FR/GPD/GPD1-0001";
			$tglIso="29/03/2021";}
		else{
			$NoIso="";
			$tglIso="";}
	  	?>
		
	<?php if ($page=="privew-nprf" && $tampildata['Status_NPRF']!='Complete By MID'){ echo '<h1>Preview Report</h1>';}?> 
	<table  class="demo-table responsive" border="1" width="900" align="center" style=' padding:0px 0px 0px 0px;'>
	 <thead>
		<tr>
		  <td rowspan="4" style="width:200px;"><img src="../img/Logo.png"  width="140px" height="80"></td>
		  <td rowspan="4" align="center" valign="middle" style="width:900px;"><h2>NEW PRODUCT REVIEW FORM</h2></td>
		  <td align="left" style="width:300px;">NO : <?php  echo $NoIso; ?></td>
	  	</tr>
		<tr>
		  <td align="left" >Tgl Berlaku :  <?php  echo $tglIso; ?></td>
	  	</tr>
		<tr>
		  <td align="left" >New Rev : FR/GPD/GPD1-0001R1</td>
	  	</tr>
		<tr>
       	  <td align="left" >Hal : <!--?php  echo 1; ?--></td>
        </tr>
		</thead>
		<tbody>
	
		<tr style='font-size:14px;'>
		  <td colspan="3">Sent to : <?php caridata1('tb_ms_sent_to','No_ID','SentTo',$tampildata['SentTo'])?><br>
	      Addressed to : <?php $addressto="";
		  				$exe = mysqli_query($con,"Select AddressTo FROM tb_ms_address_to  
						  Where SentTo = '".$tampildata['SentTo']."'   "); 
						  while(@$rowAddress =mysqli_fetch_array($exe)){ 
							$addressto=$addressto.$rowAddress['AddressTo'].", ";
						} 
						echo substr($addressto,0,-2);  ?>
					<br> </td>
		  </tr>
		<tr>
		  <td colspan="3"><table cellpadding="0" cellspacing="0" border="1" >
			
            <tr style='font-size:12px;'>
              <td colspan="7" ><table border="0" width="100%" >
                <tr>
                  <td width="40%" align="left"><table cellpadding="0" cellspacing="0" border="1" width="100%" >
                      <tr style='font-size:14px;'>
                        <td colspan="5" bgcolor="#CCCCCC" align="left"><strong>*Applicant company : </strong></td>
                      </tr>
                      <tr style='font-size:12px;'>
                        <td style="text-align:center; width:120px; height:20px;" >*
                          Prepared by</td>
                         
                        <td colspan="3">Approved
                          By</td>
                        <td  style="text-align:center; width:120px; height:20px;">Approved
                          by</td>
                      </tr>
                      <tr style='font-size:14px;'>
                        <td align="center" style="height:20px;">Date</td>
                        <td style="text-align:center; width:120px; height:20px;">Date</td>
                        <td style="text-align:center; width:120px; height:20px;">Date</td>
                        <td style="text-align:center; width:120px; height:20px;">Date</td>
                        <td style="text-align:center; width:120px; height:20px;">Date</td>
                      </tr>
                      <tr style='font-size:11px;'>
                        <td style="text-align:center; width:20px; height:80px;">
						<?php ShowTtdNamaTglByPosisi($tampildata['Request_No'],"NPRF","'01','02','03'");?>						</td>
                        <td align="center">&nbsp;</td>
                        <td align="center">&nbsp;</td>
                        <td align="center">
						<?php ShowTtdNamaTglByPosisi($tampildata['Request_No'],"NPRF","04,51721,52907");?>						</td>
                        <td align="center">
						<?php ShowTtdNamaTglByPosisi($tampildata['Request_No'],"NPRF",'46599');?>						</td>
                        <!--tr style='font-size:10px;'>
                          <td align="left" style="padding:2px 2px 2px 2px; height:20px;"></td>
                          <td align="left"  style="padding:2px 2px 2px 2px; height:20px;"></td>
                          <td align="left" style="padding:2px 2px 2px 2px; height:20px;"></td>
                        </tr-->
                   </table></td>
                  <td width="5%" style='font-size:8px;' valign="top" ><img src="../img/next.png" height="100px" width="20px" align="right"></td>
                  <td width="40%" height="24" valign="top" align="right">
				  <table cellpadding="0" cellspacing="0" border="1" width="100%" >
                      <tr style='font-size:14px;'>
                        <td colspan="4" bgcolor="#CCCCCC" align="center"><strong>For
                            use of MCJ Product Depelovment Department Only</strong></td>
                      </tr>
                      <tr style='font-size:14px;'>
                        <td rowspan="3" style="width:90px; height:20px;"><input type="radio" disabled="disabled">
                          Registered<br>
                          <input type="radio" disabled="disabled">
                          Change<br>
                          <input type="radio" disabled="disabled">
                          Determined<br>
                          <input type="radio" disabled="disabled">
                          Revised</td>
                        <td style="text-align:center; width:90px; height:20px;">Prepared
                          by</td>
                        <td style="text-align:center; width:90px; height:20px;">Reviewer by</td>
                        <td style="text-align:center; width:90px; height:20px;">Approved by</td>
                      </tr>
                      <tr style='font-size:12px;'>
                        <td style="text-align:center;">/</td>
                        <td style="text-align:center;">/</td>
                        <td style="text-align:center;">/</td>
                      </tr>
                      <tr style='font-size:10px;'>
                        <td style="text-align:center; width:20px; height:80px;"></td>
                        <td style="text-align:center; width:20px; height:80px;"></td>
                        <td style="text-align:center; width:20px; height:80px;"></td>
                      </tr>
                  </table></td>
                </tr>
				
              </table>
			  The items with *asterisk marks must be entered at the time of request. Other items may be entered later.			  </td>
            </tr>
            <tr style='font-size:14px;'>
              <td width="249" background="../img/bg.jpg" style="text-align:right;height:20px;padding:0px 2px 0px 0px;"  >
			  <img src="../img/bg.jpg"  width="160px" height="10">Theme No, / Item No. </td>
              <td colspan="6" style="text-align:left;margin-left:3px; padding:2px 2px 2px 2px;"><?php echo $tampildata['Thema_Number']; ?> </td>
            </tr>
			<tr style='font-size:14px;'>
              <td style="text-align:right; height:20px; padding:0px 2px 0px 0px;" >Theme
                Name/Item Name </td>
              <td colspan="6" style="text-align:left;margin-left:3px; padding:0px 2px 0px 0px;">
			  <?php echo '<b><div style = "margin-left: 3px; font-size:12;">'.$tampildata["Thema_Name"].'</div>'; ?>  </td>
            </tr>
            <tr style='font-size:14px;'>
              <td rowspan="2" style="text-align:right;height:20px; padding:0px 2px 0px 0px;">Purpose </td>
              <td colspan="4" rowspan="2" align="left"><label>
                <input type="checkbox" name="Purpose1" <?php if ($tampildata['Purpose_1']==1) { echo 'checked="checked"';} ?> disabled="disabled">
1) Creation of new market by new proposal</label>
                <br>
                <label>
                <input type="checkbox" name="Purpose2" <?php if ($tampildata['Purpose_2']==1) { echo 'checked="checked"';} ?> disabled="disabled">
2) Category entry into growing market or giant market</label>
                <br>
                <label>
                <input type="checkbox" name="Purpose3" <?php if ($tampildata['Purpose_3']==1) { echo 'checked="checked"';} ?> disabled="disabled">
3) Line extension for the existing product group</label>
                <br>
                <label>
                <input type="checkbox" name="Purpose4" <?php if ($tampildata['Purpose_4']==1) { echo 'checked="checked"';} ?> disabled="disabled">
4) Cost reduction of the existing products (production site transfer)</label>
                <br>
                <label>
                <input type="checkbox" name="Purpose5" <?php if ($tampildata['Purpose_5']==1) { echo 'checked="checked"';} ?> disabled="disabled">
5) Renewal of existing Products to improve quality</label >
		      <label></label>			    <label></label ></td>
              <td colspan="2" align="left">*Priority point</td>
            </tr>
            <tr style='font-size:14px;'>
              <td colspan="2" align="left">
			    <label><input type="checkbox" name="Prioritypoint1" <?php if ($tampildata['Priority_Point_EmphasisOnPrice']==1) { echo 'checked="checked"';} ?> disabled="disabled">
				1) Emphasis on price </label> 
			    <br>
			  	<label> <input type="checkbox" name="Prioritypoint2" <?php if ($tampildata['Priority_Point_HighQuality']==1) { echo 'checked="checked"';} ?> disabled="disabled">
				2) High quality </label> 
			  	<br>
			  	<label> <input type="checkbox" name="Prioritypoint3" id="Prioritypoint3"  <?php if ($tampildata['Priority_Point_Other']==1) { echo 'checked="checked" ';} ?> 
				onClick="enable_text(this.checked)" onFocus="enable_text(this.checked)" disabled="disabled">
			  3) Other ( <?php echo $tampildata['Priority_Point_OtherEtc']; ?> ) </label></td>
            </tr>
            <tr style='font-size:14px;'>
              <td style="text-align:right; height:20px;padding:0px 2px 0px 0px;">Launcing
                Date </td>
              <td colspan="6" style="text-align:left;padding:3px 0px 3px 3px;">
			  <?php echo $tampildata["Launching_Date"]; ?>			  </td>
            </tr>
			<tr style='font-size:14px;'>
              <td style="text-align:right; height:20px; padding:0px 2px 0px 0px;">Objective / Aim</td>
              <td colspan="6" style="max-width:67%; text-align:left;padding:3px 0px 3px 3px;">
			  
			  <div class="b"><?php  echo $tampildata["Objective_Aim"]; ?></div>			   </td>
            </tr>
			<tr style='font-size:14px;'>
              <td style="text-align:right; height:20px; padding:0px 2px 0px 0px;">Goal indicator / When & How to measure</td>
              <td colspan="6" style="max-width:67%; text-align:left;padding:3px 0px 3px 3px;">
			  
			  <div class="b"><?php  echo $tampildata["Goal_Indicator"]; ?></div>			   </td>
            </tr>
            <tr style='font-size:14px;'>
              <td style="text-align:right; height:20px; padding:0px 2px 0px 0px;">Background</td>
              <td colspan="6" style="max-width:67%; text-align:left;padding:3px 0px 3px 3px;">
			  
			  <div class="b"><?php  echo $tampildata["Market_Situasion"]; ?></div>			   </td>
            </tr>
            <tr style='font-size:14px;'>
              <td rowspan="3" style="text-align:right; height:20px; padding:0px 2px 0px 0px;">Target </td>
              <td width="207" style="text-align:left;padding:0px 0px 3px 3px;">Consumer</td>
              <td width="194" style="text-align:left;padding:0px 0px 3px 3px;"><?php if ($tampildata['T_Consumer_M']==1) { echo 'Male';} 
			  elseif ($tampildata['T_Consumer_F']==1) { echo 'Female';} ?></td>
			  <td width="152" style="text-align:left;padding:0px 0px 3px 3px;">Age Group</td>
			  <td width="194" style="text-align:left;padding:0px 0px 3px 3px;"><?php echo $tampildata['T_Age_GroupStart']; 
			  if ($tampildata['T_Age_GroupEnd']!=""){ echo " - " .$tampildata['T_Age_GroupEnd'];} ?></td>
			  <td width="194" align="left">Social Economic Class </td>
			  <td width="50" align="left"><span style="text-align:left;padding:0px 0px 3px 3px;"><?php echo $tampildata['T_Sosial_Economic_Class'];?></span></td>
            </tr>
			<tr style='font-size:14px;'>
			  <td width="207" style="text-align:left;padding:0px 0px 3px 3px;">Distribution</td>
			  <td colspan="6" style="text-align:left;padding:3px 3px 3px 3px;"><?php  echo $tampildata['Distribution']; ?></td>
		    </tr>
			<tr style='font-size:14px;'>
              <td style="text-align:left;padding:0px 0px 3px 3px;">Competitive or reference product(s)</td>
              <td colspan="6" style="text-align:left;padding:3px 3px 3px 3px;"><?php if (cekdata1("tb_nprf_competitor","Request_No",$tampildata['Request_No'])!=0){  ?>
			  <table cellpadding="0" cellspacing="0" border="1" width="90%" >
                      <tr style='font-size:14px;' bgcolor="#999999">
                        <td width="2%" style="text-align:center; height:40px; adding:2px 2px 2px 2px;">No</td>
                        <td width="20%" style="text-align:center; padding:2px 2px 2px 2px;">Product name</td>
                        <td width="5%" style="text-align:center; padding:2px 2px 2px 2px;">Volume</td>
                        <td width="5%" style="text-align:center; padding:2px 2px 2px 2px;">Retail Price</td>
                        <td width="20%" style="text-align:center; padding:2px 2px 2px 2px;">Reason(s) why a competitive product sells well</td>
                      </tr>
					  <?php
					$exe = mysqli_query($con,"SELECT ID_No,New_Product,Isi_Net,Netto,NamaCurrency,Price,Reason,Index_No 
					FROM tb_nprf_competitor Where Request_No = '".$tampildata['Request_No']."'   ");
					$no = 1;
					while(@$rowNPRFCompetitor =mysqli_fetch_array($exe)){
					?>
				  <tr style="font-size:14px; text-align:left; height:30px; padding:2px 2px 2px 2px;">
					<td style="padding:2px 2px 2px 2px;"><?php echo $no; ?></td>
					<td style="padding:2px 2px 2px 2px;"><?php echo $rowNPRFCompetitor['New_Product']; ?></td>
					<td style="padding:2px 2px 2px 2px;"><?php echo $rowNPRFCompetitor['Isi_Net'].
					" ".$rowNPRFCompetitor['Netto']; ?> </td>
					<td align="right" style="padding:2px 2px 2px 2px;">
					<?php echo $rowNPRFCompetitor['NamaCurrency']." ". number_format($rowNPRFCompetitor['Price'], 0, ",", "."); ?></td>
					<td style="padding:2px 2px 2px 2px;"><?php echo $rowNPRFCompetitor['Reason']; ?></td>
				  </tr>
				  <?php $no++;} ?>
                </table>
				<?php }  ?>		</td>
            </tr>
            <tr style='font-size:14px;'>
              <td style="text-align:right; height:20px; padding:0px 2px 0px 0px;">Concept plan
			  	<br>Function plan
				<br>Differentiation from
				<br>competition
				<br>(STP�USP)			  </td>
              <td colspan="6" style="text-align:left;padding:3px 3px 3px 3px;">
			  <?php  echo '<div class="b">'.$tampildata["Proposed_Concept"].'</div>'; ?></td>
            </tr>
            <tr style='font-size:14px;'>
              <td style="text-align:right; height:20px; padding:0px 2px 0px 0px">Request
              for Content, Production Base, Etc.</td>
              <td colspan="6" style="text-align:left;padding:3px 3px 3px 3px;">
			  <?php  echo '<div class="b">'.FormatText($tampildata["Request_for_Content"]).'</div>'; ?></td>
            </tr>
            <tr style='font-size:14px;'>
              <td style="text-align:right; height:20px;padding:0px 2px 0px 0px">Request
              for Design, Container, Etc.</td>
              <td colspan="6" style="text-align:left;padding:3px 3px 3px 3px;"><?php  echo '<div class="b">'.FormatText($tampildata["Request_for_Design"]).'</div>'; ?></td>
            </tr>
            <tr style='font-size:14px;'>
              <td style="text-align:right; height:20px;padding:0px 2px 0px 0px">Item Detail</td>
              <td colspan="6" style="text-align:left;padding:3px 3px 3px 3px;">
			  <?php if (cekdata1("tb_nprf_Item_detail","Request_No",$tampildata['Request_No'])!=0){  ?>
			  <table cellpadding="0" cellspacing="0" border="1" width="90%" >
                      <tr style='font-size:14px;' bgcolor="#999999">
                        <td width="2%" style="text-align:center; height:40px; adding:2px 2px 2px 2px;">No</td>
                        <td width="7%" style="text-align:center;  padding:2px 2px 2px 2px;">Item No. (Product Development Department).</td>
                        <td width="15%" style="text-align:center; padding:2px 2px 2px 2px;">Item name (tentative name)</td>
                        <td width="5%" style="text-align:center; padding:2px 2px 2px 2px;">Volume</td>
                        <td width="5%" style="text-align:center; padding:2px 2px 2px 2px;">Suggested Retail Price(HET)</td>
                        <td width="5%" style="text-align:center; padding:2px 2px 2px 2px;">HPJ</td>
						<td width="5%" style="text-align:center; padding:2px 2px 2px 2px;">Requested C&F Price(EXPORT)</td>
                        <td width="5%" style="text-align:center; padding:2px 2px 2px 2px;">Target COGS</td>
                        <td width="5%" style="text-align:center;  padding:2px 2px 2px 2px;">COGS(%)</td>
                        <td width="5%" style="text-align:center; padding:2px 2px 2px 2px;">Initial Introduction
						*Domestic:3 M  / Export: First shipment</td>
						<td width="5%" style="text-align:center;  padding:2px 2px 2px 2px;">Annual<br> Sales</td>
                      </tr>
					  <?php
					$exe = mysqli_query($con,"SELECT ID_No,MCJ_Item_No,New_Product,Isi_Net,Netto,NamaCurrency,Price,HPJ,
					C_FPrice,Target_COGS,COGS,Sales_3Mth,Sales_1yr,Index_No 
					FROM tb_nprf_Item_detail Where Request_No = '".$tampildata['Request_No']."' Order By Index_No Asc");
					$no = 1;
					$net = "";
					while(@$rowNPRFDetail =mysqli_fetch_array($exe)){
					?>
				  <tr style="font-size:14px; text-align:left; height:30px; padding:2px 2px 2px 2px;">
					<td style="padding:2px 2px 2px 2px;"><?php echo $no; ?></td>
					<td style="padding:2px 2px 2px 2px;">
					<b><font color="#0000FF"><?php echo $rowNPRFDetail['MCJ_Item_No']; ?></font></b></td>
					<td style="padding:2px 2px 2px 2px;"><?php echo $rowNPRFDetail['New_Product']; ?></td>
					<td style="padding:2px 2px 2px 2px;">
					<?php $isinetto="";
					$exeNetto = mysqli_query($con,"SELECT ID_No,Isi_Net,Netto,Index_No 
					FROM tb_nprf_item_detail_netto Where ID_No_ItemDetail = '".$rowNPRFDetail['ID_No']."' Order By ID_No Asc");
					while(@$rowNPRFDetailNetto =mysqli_fetch_array($exeNetto)){ 
						$isinetto=$isinetto.$rowNPRFDetailNetto['Isi_Net']." ".$rowNPRFDetailNetto['Netto'].", ";
					} 
					echo substr($isinetto,0,-2);  ?>					</td>
					<td style="padding:2px 2px 2px 2px;text-align:right;">
					<?php echo $rowNPRFDetail['NamaCurrency']." ". number_format($rowNPRFDetail['Price'], 0, ",", ".");  ?></td>
					<td style="padding:2px 2px 2px 2px;text-align:right;"><?php echo number_format($rowNPRFDetail['HPJ'], 2, ",", "."); ?></td>
					<td style="padding:2px 2px 2px 2px;text-align:right;"><?php echo number_format($rowNPRFDetail['C_FPrice'], 2, ",", "."); ?></td>
					<td style="padding:2px 2px 2px 2px;text-align:right;"><?php echo number_format($rowNPRFDetail['Target_COGS'], 2, ",", "."); ?></td>
					<td style="padding:2px 2px 2px 2px;text-align:right;"><?php echo number_format($rowNPRFDetail['COGS'], 2, ",", "."); ?> %</td>
					<td style="padding:2px 2px 2px 2px;text-align:right;"><?php echo number_format($rowNPRFDetail['Sales_3Mth'], 2, ",", "."); ?></td>
					<td style="padding:2px 2px 2px 2px;text-align:right;"><?php echo number_format($rowNPRFDetail['Sales_1yr'], 2, ",", "."); ?></td>
				  </tr>
				  <?php $no++;} ?>
                    </table>
				<?php }  ?>				</td>
            </tr>
            
            <tr style='font-size:14px;'>
              <td style="text-align:right; height:20px;padding:0px 2px 0px 0px">Others</td>
              <td colspan="6" style="text-align:left;padding:3px 3px 3px 3px;"><?php  echo $tampildata['Others']; ?></td>
            </tr>
            <tr style='font-size:14px;'>
              <td style="text-align:right;  height:20px;padding:0px 2px 0px 0px">Outline
              of Schedule</td>
              <td colspan="6" style="text-align:left;padding:3px 3px 3px 3px;">			  
			  <?php if (cekdata1("tb_nprf_outlineofschedule","Request_No",$tampildata['Request_No'])!=0){  ?>
			  <table cellpadding="0" cellspacing="0" border="1" width="90%" >
                      <tr style='font-size:14px;' bgcolor="#999999">
                        <td width="4%" style="text-align:center; height:40px; adding:2px 2px 2px 2px;">No</td>
                        <td width="15" style="text-align:center; padding:2px 2px 2px 2px;">Outline of Schedule</td>
                        <td width="20%" style="text-align:center; padding:2px 2px 2px 2px;">Date</td>
                      </tr>
					  <?php
					$exe = mysqli_query($con,"SELECT ID_No,Keterangan,Bulan,Tahun,Index_No 
					FROM tb_nprf_outlineofschedule Where Request_No = '".$tampildata['Request_No']."'   ");
					$no = 1;
					while(@$rowNPRFOutlineofschedule =mysqli_fetch_array($exe)){
					?>
				  <tr style="font-size:14px; text-align:left; height:30px; padding:2px 2px 2px 2px;">
					<td style="padding:2px 2px 2px 2px;"><?php echo $no; ?></td>
					<td style="padding:2px 2px 2px 2px;"><?php echo $rowNPRFOutlineofschedule['Keterangan']; ?></td>
					<td style="padding:2px 2px 2px 2px;"><?php echo $rowNPRFOutlineofschedule['Bulan'].
					" - ".$rowNPRFOutlineofschedule['Tahun']; ?> </td>
				  </tr>
				  <?php $no++;} ?>
                </table>
				<?php }  ?>				</td>
            </tr>
            


          </table></td>
	  </tr>
	  </tbody>
	  <tfoot>
    <tr>
      <td colspan="7"></td>
    </tr>
  </tfoot>
	</table>
<?php
};
 ?>
</body>
</html>

<!-- Memanggil fungsi bawaan HTML2PDF -->
 