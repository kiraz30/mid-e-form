<style>
footer {
  font-size: 9px;
  color: #f00;
  text-align: center;
}

@page {
  size: letter;
  margin: 11mm 17mm 17mm 17mm;
}

@media print {
  footer {
    position: fixed;
    bottom: 0;
  }

  .content-block, p {
    page-break-inside: avoid;
  }

  html, body {
    width: 210mm;
    height: 297mm;
  }
}
</style>

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




 if ($page=="nprf"|| $page=="privew-nprf"){
		include "connect.php";
      	$exe =mysqli_query($con,"SELECT ID_No,Request_No,Thema_Number,Thema_Name,Type_Request,SentTo,Purpose_1,Purpose_2,Purpose_3,
		Purpose_4,Purpose_5,Priority_Point_EmphasisOnPrice,Priority_Point_HighQuality,Priority_Point_Other,Priority_Point_OtherEtc,
		date_format(Launching_Date,'%M-%Y') as Launching_Date,Objective_Aim,Goal_Indicator,Market_Situasion,
		T_Consumer_M,T_Consumer_F,T_Age_GroupStart,T_Age_GroupEnd,T_Sosial_Economic_Class,Status_NPRF,
		Proposed_Concept,Request_for_Content,Request_for_Design,Distribution,Competitor,Distribution,TargetWants,Others,
		Advertising_1,Advertising_2,Advertising_3,Advertising_4,Advertising_5,Advertising_Other,
		MCS_Chk,MCS,MKC_Chk,MKC,MCTL_Chk,MCTL,MTC_Chk,MTC,MMSB_Chk,MMSB,MVC_Chk,MVC,SMC_Chk,SMC,MPC_Chk,MPC,
		Outline_of_Schedule,Remark FROM tb_nprf where Request_No = '".@$_GET['id']."'  ");
        $tampildata=mysqli_fetch_array($exe);
		$typeReq=$tampildata['Type_Request'];
		if($tampildata['Type_Request']=="Domestic" || $tampildata['Type_Request']=="Export")	{
			$NoIso="FR/GPD/GPD1-0001";
			$tglIso="29/03/2021";}
		else{
			$NoIso="";
			$tglIso="";}}
	  	?>
		
	<?php if ($page=="privew-nprf" && $tampildata['Status_NPRF']!='Complete By MID'){ echo '<h1>Preview Report</h1>';}
	else { echo '<font color="#FFFFFF">E-Form</font> ';}?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<font color="#FFFFFF"></font>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Report NPRF <?php  echo @$_GET['id']; ?> </title>

<style>

  @media screen {
    div#footer_wrapper {
      display: none;
    }
  }

  @media print {
    tfoot { visibility: hidden; }

    div#footer_wrapper {
      margin: 0px 0px 0px 0px;
      position: fixed;
      bottom: 0;
    }

    div#footer_content {
      font-weight: bold;
    }
  }

</style>
<style>
div {
  width:820; 
  border: 0px;
}

div.a {
  word-wrap: normal;
}

div.b {
  word-wrap: break-word;
}
</style>
</head>

<body>

<div id="footer_wrapper">
  <div id="footer_content">
   
  </div>
</div>


<TABLE  cellpadding="0" cellspacing="0" border="1" style="margin:0px 0px 0px 0px;" width="100%" >

<THEAD>
 		<tr>
		  <TH width="15%" rowspan="4"><img src="../img/Logo.png"  width="100px" height="80"></TH>
		  <TH width="50%" rowspan="4" align="center" valign="middle" ><h3>NEW PRODUCT REVIEW FORM</h3></TH>
		  <TH width="35%" align="left"> NO : FR/LC/LPL-0001</TH>
	  	</tr>
		<tr>
		  <TH align="left" > Tgl Berlaku : 07/06/2021</TH>
	  	</tr>
		<tr>
		  <TH align="left" > No Rev :</TH>
	  	</tr>
		<tr>
       	  <TH align="left" > Hal : <!--?php  echo 1; ?--></TH>
        </tr>
  
</THEAD>

<TBODY>
<TR>
	<td colspan="4">
		Sent to : <?php caridata1('tb_ms_sent_to','No_ID','SentTo',$tampildata['SentTo'])?><br>
	 	Addressed to : <?php $addressto="";
		$exe = mysqli_query($con,"Select AddressTo FROM tb_ms_address_to  
		Where SentTo = '".$tampildata['SentTo']."'   "); 
		while(@$rowAddress =mysqli_fetch_array($exe)){ 
			$addressto=$addressto.$rowAddress['AddressTo'].", ";
		} 
		echo substr($addressto,0,-2);  ?>
	</td>  
	
</TR>
<TR>
	<td colspan="4">
	<table>
		<tr>
			<td>
				<table cellpadding="0" cellspacing="0" border="1" width="100%" >
				  <tr style='font-size:14px;'>
					<td colspan="5" bgcolor="#CCCCCC" style="text-align:center; width:120px; height:20px;"><strong>Applicant company: </strong></td>
				  </tr>
				  <tr style='font-size:12px;'>
					<td style="text-align:center; width:120px; height:20px;" >Prepared
					  by</td>
					<td style="text-align:center; width:120px; height:20px;"colspan="3" >Approved By</td>
					<td style="text-align:center; width:120px; height:20px;">Approved by</td>
				  </tr>
				  <tr style='font-size:11px;'>
					<td style="text-align:left; height:20px;">Date : <!--?php Shownamettd("DATE_FORMAT(ApproveDate, '%d-%m-%Y')",$tampildata['Request_No'],"NPRF",'1');?--></td>
					<td style="text-align:left; width:90px; height:20px;">Date : 
					<!--?php ShowTglByPosisiDivisi($tampildata['Request_No'],"NPRF","02,03");?--></td>
					<td style="text-align:left; width:90px; height:20px;">Date : 
					<!--?php ShowTglByPosisiDivisi($tampildata['Request_No'],"NPRF","04,52804");?--></td>
					<td style="text-align:left; width:90px; height:20px;">Date : 
					<!--?php ShowTglByPosisiDivisi($tampildata['Request_No'],"NPRF","51721,52907");?--></td>
					<td style="text-align:left; width:90px; height:20px;">Date : 
					<!--?php ShowTglByPosisiDivisi($tampildata['Request_No'],"NPRF",'46599');?--></td>
				  </tr>
				  <tr style='font-size:11px;'>
					<td style="text-align:center; width:20px; height:80px;">
					
					<?php ShowTtdNamaTglByPosisiRequestor($tampildata['Request_No'],"NPRF","'01','02','03'",'1');?>
					
 					</td>
					<td align="center"><?php ShowTtdNamaTglByPosisiDivisiNPRF($tampildata['Request_No'],"NPRF","01,02,03");?></td>
					<td align="center"><?php ShowTtdNamaTglByPosisiDivisiNPRF($tampildata['Request_No'],"NPRF","04,52804");?></td>
					<td align="center"><?php ShowTtdNamaTglByPosisiDivisiNPRF($tampildata['Request_No'],"NPRF","51721,52907");?></td>
					<td align="center"><?php ShowTtdNamaTglByPosisiDivisiNPRF($tampildata['Request_No'],"NPRF",'46599');?>
					</td>
				   </tr>
				</table>
			</td>
			<td valign="top"><img src="../img/next.png" height="100px" width="20px" align="right">
			</td>
			<td valign="top">
				<table cellpadding="0" cellspacing="0" border="1" width="100%" >
				  <tr style='font-size:14px;'>
					<td colspan="4" bgcolor="#CCCCCC" align="center"><strong>For
						use of MCJ Product Depelovment Department Only</strong></td>
				  </tr>
				  <tr style='font-size:14px;'>
					<td rowspan="3" style="width:140px; height:20px;"><input type="radio" disabled="disabled">
					  Registered<br>
					  <input type="radio" disabled="disabled">
					  Change<br>
					  <input type="radio" disabled="disabled">
					  Determined<br>
					  <input type="radio" disabled="disabled">
					  Revised</td>
					<td style="text-align:center; width:90px; height:20px;">Prepared
					  by</td>
					<td style="text-align:center; width:90px; height:20px;">Reviewer
					  by</td>
					<td style="text-align:center; width:90px; height:20px;">Approved
					  by</td>
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
				</table>
			</td>
		</tr>
	
	</table>
	The items with *asterisk marks must be entered at the time of request. Other items may be entered later.
	</td>  
	
</TR>
<TR>
	<td colspan="4">
 		<table border="1" cellpadding="0" cellspacing="0" width="100%" style="margin:0px 0px 0px 0px;">
			<THEAD>
			<tr>
				<th width="140"> </th>
				<th> </th>
			</tr>
			</THEAD>
			<TBODY>
			<tr style='font-size:14px;'>
            	<td  background="../img/bg.jpg" style="text-align:right;height:20px;padding:0px 2px 0px 0px;"  >
			  	Theme No, / Item No. </td>
              	<td  colspan="6" style="text-align:left;margin-left:3px; padding:2px 2px 2px 2px;">
			  	<?php echo $tampildata['Thema_Number']; ?> </td>
           	</tr>
			<tr style='font-size:14px;'>
              <td style="text-align:right; height:20px; padding:0px 2px 0px 0px;" >Theme
                Name / Item Name </td>
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
              <td width="238" colspan="2" align="left">*Priority point</td>
            </tr>
            <tr style='font-size:14px;'>
              <td colspan="2" align="left">
			    <label><input type="checkbox" name="Prioritypoint1" <?php if ($tampildata['Priority_Point_EmphasisOnPrice']==1) { echo 'checked="checked"';} ?> disabled="disabled">
				1) Emphasis on price </label> 
			    <br>
			  	<label> <input type="checkbox" name="Prioritypoint2" <?php if ($tampildata['Priority_Point_HighQuality']==1) { echo 'checked="checked"';} ?> disabled="disabled">
				2) High quality </label> 
			  	<br>
			  	<label> <input type="checkbox" name="Prioritypoint3" id="Prioritypoint3"  <?php if ($tampildata['Priority_Point_Other']==1) { echo 'checked="checked" ';} ?>  disabled="disabled">
			  3) Other ( <?php echo $tampildata['Priority_Point_OtherEtc']; ?> ) </label></td>
            </tr>
            <tr style='font-size:14px;'>
              <td style="text-align:right; height:20px;padding:0px 2px 0px 0px;">Launching Date / Shipment Date (for Export Product)</td>
              <td colspan="6" style="text-align:left;padding:3px 0px 3px 3px;">
			  <?php echo $tampildata["Launching_Date"]; ?>			  </td>
            </tr>
			<tr style='font-size:14px;'>
              <td style="text-align:right; height:20px; padding:0px 2px 0px 0px;">Objective / Aim</td>
              <td colspan="6" style="text-align:left;padding:3px 0px 3px 3px;">
			  
			  <div class="b"><?php  echo $tampildata["Objective_Aim"]; ?></div>			   </td>
            </tr>
			<tr style='font-size:14px;'>
              <td style="text-align:right; height:20px; padding:0px 2px 0px 0px;">Goal indicator / When & How to measure</td>
              <td colspan="6" style=" text-align:left;padding:3px 0px 3px 3px;">
			  
			  <div class="b"><?php  echo $tampildata["Goal_Indicator"]; ?></div>			   </td>
            </tr>
            <tr style='font-size:14px;'>
              <td style="text-align:right; height:20px; padding:0px 2px 0px 0px;">Background</td>
              <td colspan="6" style=" text-align:left;padding:3px 0px 3px 3px;">
			  
			  <div class="b"><?php  echo $tampildata["Market_Situasion"]; ?></div>			   </td>
            </tr>
			<tr style='font-size:14px;'>
              <td rowspan="4" style="text-align:right; height:20px; padding:0px 2px 0px 0px;">Target </td>
              <td rowspan ="2" width="150" style="text-align:left;padding:0px 0px 3px 3px;">Consumer</td>
              <td width="150" style="text-align:left;padding:0px 0px 3px 3px;"><?php if ($tampildata['T_Consumer_M']==1) { echo 'Male';} 
			  elseif ($tampildata['T_Consumer_F']==1) { echo 'Female';} ?></td>
			  <td width="150" style="text-align:left;padding:0px 0px 3px 3px;">Age Group</td>
			  <td width="150" style="text-align:left;padding:0px 0px 3px 3px;"><?php echo $tampildata['T_Age_GroupStart']; 
			  if ($tampildata['T_Age_GroupEnd']!=""){ echo " - " .$tampildata['T_Age_GroupEnd'];} ?></td>
			  <td width="150" align="left">Social Economic Class </td>
			  <td width="150" align="left"><span style="text-align:left;padding:0px 0px 3px 3px;"><?php echo $tampildata['T_Sosial_Economic_Class'];?></span></td>
            </tr>
			
			<tr style='font-size:14px;'>
 			  <td colspan="6" style="text-align:left;padding:3px 3px 3px 3px;">
			  [Target Wants]<br><?php  echo $tampildata['TargetWants']; ?></td>
			</tr>
			<tr style='font-size:14px;'>
 			  <td style="text-align:left;padding:0px 0px 3px 3px;">Distribution</td>
			  <td colspan="6" style="text-align:left;padding:3px 3px 3px 3px;"><?php  echo $tampildata['Distribution']; ?></td>
		    </tr>
			<tr style='font-size:14px;'>
              <td style="text-align:left;padding:0px 0px 3px 3px;">Competitive or reference product(s)</td>
              <td colspan="6" style="text-align:left;padding:3px 3px 3px 3px;"><?php if (cekdata1("tb_nprf_competitor","Request_No",$tampildata['Request_No'])!=0){  ?>
			  <table cellpadding="0" cellspacing="0" border="1" width="100%" >
			  	<THEAD>
                      <tr style='font-size:14px;' bgcolor="#999999">
                        <th width="2%" style="text-align:center; height:40px; adding:2px 2px 2px 2px;">No</th>
                        <th width="20%" style="text-align:center; padding:2px 2px 2px 2px;">Product name</th>
                        <th width="5%" style="text-align:center; padding:2px 2px 2px 2px;">Volume</th>
                        <th width="5%" style="text-align:center; padding:2px 2px 2px 2px;">Retail Price</th>
                        <th width="20%" style="text-align:center; padding:2px 2px 2px 2px;">Reason(s) why a competitive product sells well</th>
                      </tr>
				</THEAD>
					  <?php
					$exe = mysqli_query($con,"SELECT ID_No,New_Product,Isi_Net,Netto,NamaCurrency,Price,Reason,Index_No 
					FROM tb_nprf_competitor Where Request_No = '".$tampildata['Request_No']."'   ");
					$no = 1;
					while(@$rowNPRFCompetitor =mysqli_fetch_array($exe)){
					?>
				<TBODY>
				  <tr style="font-size:14px; text-align:left; height:30px; padding:2px 2px 2px 2px;">
					<td style="padding:2px 2px 2px 2px;"><?php echo $no; ?></td>
					<td style="padding:2px 2px 2px 2px;"><?php echo $rowNPRFCompetitor['New_Product']; ?></td>
					<td style="padding:2px 2px 2px 2px;"><?php echo $rowNPRFCompetitor['Isi_Net'].
					" ".$rowNPRFCompetitor['Netto']; ?> </td>
					<td align="right" style="padding:2px 2px 2px 2px;">
					<?php echo $rowNPRFCompetitor['NamaCurrency']." ". number_format($rowNPRFCompetitor['Price'], 0, ",", "."); ?></td>
					<td style="padding:2px 2px 2px 2px;"><?php echo  @$rowNPRFCompetitor['Reason']; ?></td>
				  </tr>
				 </TBODY>
				  <?php $no++;} ?>
                </table>
				<?php }  ?>		</td>
            </tr>
			
			<tr style='font-size:14px;'>
              <td style="text-align:right; height:20px; padding:0px 2px 0px 0px;">Concept Plan
			  	<font size="1"><br>Function plan
				<br>Differentiation from
				<br>competition
				<br>(STP�USP)			  </font></td>
              <td colspan="6" style="text-align:left;padding:3px 3px 3px 3px;">
			  <?php  echo '<div class="b">'.$tampildata["Proposed_Concept"].'</div>'; ?></td>
            </tr>
            <tr style='font-size:14px;'>
              <td style="text-align:right; height:20px; padding:0px 2px 0px 0px" rowspan="2">Request for design, containers, contents, production base etc.</td>
              <td colspan="6" style="text-align:left;padding:3px 3px 3px 3px;">
			  <?php  echo '<div class="b">'.FormatText("Contents <br>".$tampildata["Request_for_Content"]).'</div>'; ?></td>
            </tr>
            <tr style='font-size:14px;'>
 
              <td colspan="6" style="text-align:left;padding:3px 3px 3px 3px;">
			  <?php  echo '<div class="b">'.FormatText('Containers <br>'.$tampildata["Request_for_Design"]).'</div>'; ?></td>
            </tr>
			
			</tr>
            <tr>
              <td colspan="6" style="text-align:left;padding:3px 3px 3px 3px;">
			  <?php if (cekdata1("tb_nprf_Item_detail","Request_No",$tampildata['Request_No'])!=0){  ?>
			  	<table cellpadding="0" cellspacing="0" border="1" width="100%" >
					<THEAD>
					<tr>
						<th colspan="11" style="text-align:center; height:30px; padding:2px 2px 2px 2px;">Proposed item(s)</th>
					</tr>
					
                	<tr style='font-size:12px;' bgcolor="#999999">
                        <th rowspan="2" width="7%" style="text-align:center;  padding:2px 2px 2px 2px;">
						Item No. (Product Development Department)</th>
                        <th colspan="2" rowspan="2" width="15%" style="text-align:center; padding:2px 2px 2px 2px;">Item name (tentative name)</th>
                        <th rowspan="2" width="5%" style="text-align:center; padding:2px 2px 2px 2px;">Volume</th>
 						<th colspan="5" style="text-align:center; padding:2px 2px 2px 2px;">
						Planned price [local currency/US$]</th>
						<th colspan="2" style="text-align:center; padding:2px 2px 2px 2px;">
						Sales forecast [pcs]</th>
                		<tr style='font-size:12px;' bgcolor="#999999">
							<th width="5%" style="text-align:center; padding:2px 2px 2px 2px;">Suggested Retail Price(HET)</th>
							<th width="5%" style="text-align:center; padding:2px 2px 2px 2px;">HPJ (Domestic)</td>
							<th width="5%" style="text-align:center; padding:2px 2px 2px 2px;">Requested C&F/CIF/FOB/ Price (EXPORT)</th>
							<th width="5%" style="text-align:center; padding:2px 2px 2px 2px;">COG PRICE</td>
							<th width="5%" style="text-align:center; padding:2px 2px 2px 2px;">COGS(%)</th>
							<th width="5%" style="text-align:center; padding:2px 2px 2px 2px;">Initial Introduction
							<font size="1">Function plan Domestic:3 M / Export: First shipment </font></th>
							<td width="5%" style="text-align:center; padding:2px 2px 2px 2px;">Annual Sales</th>
						</tr>
                     </tr>
					 
					  
				  
					 </THEAD>
					 <TBODY>
					  <?php
						$exe = mysqli_query($con,"SELECT ID_No,MCJ_Item_No,New_Product,Isi_Net,Netto,NamaCurrency,Price,NamaCurrencyHPJ,
						HPJ,NamaCurrencyC_FPrice,C_FPrice,NamaCurrencyTargetCOGS,Target_COGS,COGS,Sales_3Mth,Introduction,Satuan_Sales1Yr,Sales_1yr,Index_No 
						FROM tb_nprf_Item_detail Where Request_No = '".$tampildata['Request_No']."' Order By Index_No Asc");
						$no = 1;
						$net = "";
						while(@$rowNPRFDetail =mysqli_fetch_array($exe)){
						?>
				  
				  	<tr style="font-size:14px; text-align:left; height:30px; padding:2px 2px 2px 2px;">
						<td style="padding:2px 2px 2px 2px;"><b><font color="#0000FF">
						<?php echo $rowNPRFDetail['MCJ_Item_No']; ?></font></b></td>
						<td width="1%" style="padding:2px 2px 2px 2px;"><?php echo $no; ?></td>
						<td  width="14%" style="padding:2px 2px 2px 2px;"><?php echo $rowNPRFDetail['New_Product']; ?></td>
						<td style="padding:2px 2px 2px 2px;">
						<?php $isinetto="";
						$exeNetto = mysqli_query($con,"SELECT ID_No,Isi_Net,Netto,Index_No 
						FROM tb_nprf_item_detail_netto Where ID_No_ItemDetail = '".$rowNPRFDetail['ID_No']."' Order By ID_No Asc");
						while(@$rowNPRFDetailNetto =mysqli_fetch_array($exeNetto)){ 
							$isinetto=$isinetto.$rowNPRFDetailNetto['Isi_Net']." ".$rowNPRFDetailNetto['Netto'].", ";
						} 
						echo substr($isinetto,0,-2);  ?>					</td>
						<td style="padding:2px 2px 2px 2px;text-align:right;">
						<?php echo $rowNPRFDetail['NamaCurrency']." ";  ?> <?php if ($rowNPRFDetail['Price']==0) {echo "";} else { echo number_format(@$rowNPRFDetail['Price'], 2, ",", ".");} ?></td>
						<td style="padding:2px 2px 2px 2px;text-align:right;"><?php echo $rowNPRFDetail['NamaCurrencyHPJ']; ?> <?php if ($rowNPRFDetail['HPJ']==0) {echo "";} else { echo number_format(@$rowNPRFDetail['HPJ'], 2, ",", ".");} ?></td>
						<td style="padding:2px 2px 2px 2px;text-align:right;"><?php echo $rowNPRFDetail['NamaCurrencyC_FPrice']; ?> <?php if ($rowNPRFDetail['C_FPrice']==0) {echo "";} else { echo number_format(@$rowNPRFDetail['C_FPrice'], 2, ",", ".");} ?></td>
						<td style="padding:2px 2px 2px 2px;text-align:right;"><?php echo $rowNPRFDetail['NamaCurrencyTargetCOGS']; ?>  <?php if ($rowNPRFDetail['Target_COGS']==0) {echo "";} else { echo number_format(@$rowNPRFDetail['Target_COGS'], 2, ",", ".");} ?></td>
						<td style="padding:2px 2px 2px 2px;text-align:right;"><?php if ($rowNPRFDetail['COGS']==0) {echo "";} else { echo number_format(@$rowNPRFDetail['COGS'], 2, ",", ".");} ?></td>
						<td style="padding:2px 2px 2px 2px;text-align:left;"><?php echo @$rowNPRFDetail['Sales_3Mth']; ?> 
						<?php if ($rowNPRFDetail['Introduction']==0) {echo "";} else { echo number_format(@$rowNPRFDetail['Introduction'], 2, ",", ".");} ?></td>
						<td style="padding:2px 2px 2px 2px;text-align:right;"><?php echo @$rowNPRFDetail['Satuan_Sales1Yr']; ?> 
						<?php if ($rowNPRFDetail['Sales_1yr']==0) {echo "";} else { echo number_format(@$rowNPRFDetail['Sales_1yr'], 2, ",", ".");} ?></td>

				  </tr>
				  </TBODY>
				  <?php $no++;} ?>
                    </table>
				<?php }  ?>				
				</td>
            </tr>
			<tr style='font-size:14px;'>
              <td style="text-align:right;height:20px; padding:0px 2px 0px 0px;">Advertising & Promotion </td>
              <td colspan="6"  align="left">
			  	<label><input type="checkbox" name="Advertising1" disabled="disabled" <?php if (@$tampildata['Advertising_1']==1) { echo 'checked="checked"';} ?>>
				By using a combination of Advertising & Promotion</label> 
				<label><input type="checkbox" name="Advertising3" disabled="disabled" <?php if (@$tampildata['Advertising_3']==1) { echo 'checked="checked"';} ?>>
				By doing only Promotion (no Advertising)</label> <br>
                <label><input type="checkbox" name="Advertising2" disabled="disabled" <?php if (@$tampildata['Advertising_2']==1) { echo 'checked="checked"';} ?>>
				Making it a regular item by listing</label>
				 
              	
			  	<label><input type="checkbox" name="Advertising4" disabled="disabled" <?php if (@$tampildata['Advertising_4']==1) { echo 'checked="checked"';} ?>>
				By avoiding listing fees as much as possible</label>
				 
			 	<label> <input type="checkbox" name="Advertising5" disabled="disabled" id="Advertising5"  <?php if (@$tampildata['Advertising_5']==1) { echo 'checked="checked" ';} ?> >
				Other ( <?php echo $tampildata['Advertising_Other']; ?> ) </label> 
				</td>
  
  			</tr>

			<tr style='font-size:14px;'>
              <td style="text-align:right; height:20px;padding:0px 2px 0px 0px">Remarks / Reason(s) for change/revision</td>
              <td colspan="6" style="text-align:left;padding:3px 3px 3px 3px;"><?php  echo $tampildata['Others']; ?></td>
            </tr>
			<tr style='font-size:14px;'>
              <td rowspan="3" style="text-align:right; height:10px;padding:0px 2px 0px 0px">Country planned to sell </td>
              <td rowspan="3" style="text-align:left;padding:1px 1px 1px 1px;"><input type="checkbox" name="ChkMCS" id="ChkMCS" disabled="disabled" 
							<?php if (@$tampildata['MCS_Chk']==1) { echo 'checked="checked"';} ?> > MCS<br>
							<input type="checkbox" name="ChkMTC" id="ChkMTC" disabled="disabled"
							<?php if (@$tampildata['MTC_Chk']==1) { echo 'checked="checked"';} ?> > MTC<br>
							<label><input type="checkbox" name="ChkSMC" id="ChkSMC" disabled="disabled"
							<?php if (@$tampildata['SMC_Chk']==1) { echo 'checked="checked"';} ?> > SMC</td>
			  <td style="text-align:left;padding:2px 2px 2px 2px;"><?php  echo $tampildata['MCS']; ?></td>
			  <td rowspan="3" style="text-align:left;padding:3px 3px 3px 3px;"><input type="checkbox" name="ChkMKC" id="ChkMKC" disabled="disabled"
							<?php if (@$tampildata['MKC_Chk']==1) { echo 'checked="checked"';} ?> > MKC<br>
							<input type="checkbox" name="ChkMMSB" id="ChkMMSB" disabled="disabled"
							<?php if (@$tampildata['MMSB_Chk']==1) { echo 'checked="checked"';} ?> > MMSB<br>
							<label><input type="checkbox" name="ChkMPC" id="ChkMPC" disabled="disabled"
							<?php if (@$tampildata['MPC_Chk']==1) { echo 'checked="checked"';} ?> > MPC</td>
			  <td style="text-align:left;padding:2px 2px 2px 2px;"><?php  echo $tampildata['MKC']; ?></td>
			  <td rowspan="3" style="text-align:top;padding:3px 3px 3px 3px;"><input type="checkbox" name="ChkMCTL" id="ChkMCTL" disabled="disabled"
							<?php if (@$tampildata['MCTL_Chk']==1) { echo 'checked="checked"';} ?> > MCTL<br>
							<label><input type="checkbox" name="ChkMVC" id="ChkMVC" disabled="disabled"
							<?php if (@$tampildata['MVC_Chk']==1) { echo 'checked="checked"';} ?> > MVC<br><br></td>
			  <td style="text-align:left;padding:2px 2px 2px 2px;"><?php  echo $tampildata['MCTL']; ?></td>
			  
            </tr>
			 
			<tr style='font-size:14px;'>
			
			  <td style="text-align:left;padding:2px 2px 2px 2px;"><?php  echo $tampildata['MTC']; ?></td>
			  <td style="text-align:left;padding:2px 2px 2px 2px;"><?php  echo $tampildata['MMSB']; ?></td>
			  <td style="text-align:left;padding:2px 2px 2px 2px;"><?php  echo $tampildata['MVC']; ?></td>
            </tr>
			<tr style='font-size:14px;'>
			  <td style="text-align:left;padding:2px 2px 2px 2px;"><?php  echo $tampildata['SMC']; ?></td>
			  <td style="text-align:left;padding:2px 2px 2px 2px;"><?php  echo $tampildata['MPC']; ?></td>
			  <td></td>
            </tr>
            <tr style='font-size:14px;'>
            	<td style="text-align:right;  height:20px;padding:0px 2px 0px 0px">Outline of Schedule</td>
              	<td colspan="6" style="text-align:left;padding:3px 3px 3px 3px;">			  
			  	<?php if (cekdata1("tb_nprf_outlineofschedule","Request_No",$tampildata['Request_No'])!=0){  ?>
			  		<table cellpadding="0" cellspacing="0" border="1" width="100%" >
						<THEAD>
						<tr style='font-size:14px;' bgcolor="#999999">
							<th width="4%" style="text-align:center; height:40px; adding:2px 2px 2px 2px;">No</th>
							<th width="15" style="text-align:center; padding:2px 2px 2px 2px;">Outline of Schedule</th>
							<th width="20%" style="text-align:center; padding:2px 2px 2px 2px;">Date</th>
						 </tr>
						 </THEAD>
					  <?php
						$exe = mysqli_query($con,"SELECT ID_No,Keterangan,Bulan,Tahun,Index_No 
						FROM tb_nprf_outlineofschedule Where Request_No = '".$tampildata['Request_No']."'   ");
						$no = 1;
						while(@$rowNPRFOutlineofschedule =mysqli_fetch_array($exe)){
						?>
						<TBODY>
				  		<tr style="font-size:14px; text-align:left; height:30px; padding:2px 2px 2px 2px;">
							<td style="padding:2px 2px 2px 2px;"><?php echo $no; ?></td>
							<td style="padding:2px 2px 2px 2px;"><?php echo $rowNPRFOutlineofschedule['Keterangan']; ?></td>
							<td style="padding:2px 2px 2px 2px;"><?php echo $rowNPRFOutlineofschedule['Bulan'].
							" - ".$rowNPRFOutlineofschedule['Tahun']; ?> </td>
				  		</tr>
						</TBODY>
				  <?php $no++;} ?>
                </table>
				<?php }  ?>				</td>
            </tr>
			
			
			
			</TBODY>
		</table>
 	</td>  
</TR>



</TBODY>

<!--TFOOT id="table_footer">
<TR> <TH ALIGN=LEFT COLSPAN=3>Total</TH> <TH>4923</TH> </TR>
</TFOOT-->

</TABLE>

</body>
</html>