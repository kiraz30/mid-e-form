
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>xxxxx</title>

<style>
 table {
    border-collapse: collapse;
    width: 100%;
}
th, td {
    text-align: left;
    padding: 4px;
}
    </style>
</head>
<body>
<table cellpadding="0" cellspacing="0" border="1" style="width:100%; height:100%;">
            <tr>
              <td width="100" rowspan="4"><img src="../img/Logo.png" width="100" height="80"></td>
              <td width="450" rowspan="4" align="center"  valign="middle"><h3>NEW PRODUCT REVIEW FORM DOMESTIC</h3></td>
              <td align="left" style >NO : FR/MKTPD1/GPD1-1001</td>
            </tr>
            <tr>
              <td align="left">Tgl Berlaku : 08/01/2018</td>
            </tr>
            <tr>
              <td align="left">New Rev : </td>
            </tr>
            <tr>
              <td  align="left">Hal :</td>
            </tr>
            <tr>
              <td colspan="3">Sent to : <br>Addressed to :  
			  
			   <table height="100"  border="0" width="90%">
               	<tr>
				 <td width="300" height="24">
					<table cellpadding="0" cellspacing="0" border="0.1" >
						<tr style='font-size:12px;'>
                          <td colspan="3" bgcolor="#CCCCCC" align="center"><strong>PT. Mandom Indonesia Tbk</strong></td>
                        </tr>
						<tr style='font-size:9px;'>
                          <td style="text-align:center; width:90px; height:20px;">Prepared by</td>
				      	  <td style="text-align:center; ">Approved By</td>
						  <td style="text-align:center; ">Approved by</td>
                      </tr>
					  <tr style='font-size:9px;'>
                          <td align="center">PIC/CH/SH</td>
						  <td align="center">CA/MG/GM</td>
						  <td align="center">Prodev Director</td>
                       </tr>
					    <tr style='font-size:9px;'>
                          <td align="center">PIC/CH/SH</td>
						  <td align="center">CA/MG/GM</td>
						  <td align="center">Prodev Director</td>
                       </tr> 
				
						 <tr style='font-size:10px;'>
                          <td style="text-align:center; width:20px; height:80px;">[#RequestSign#]</td>
						   <td>[#RequestSign#]</td>
						   <td>[#RequestSign#]</td>
                   	  </tr>
                   </table>				 </td>
				 <td width="50" style='font-size:8px;'>When issue NPRF,have to Attach MOM(NPM& NSM)</td>
				 <td width="300" valign="top">
					<table cellpadding="0" cellspacing="0" border="0.1" >
						<tr style='font-size:12px;'>
                          <td colspan="4" bgcolor="#CCCCCC" align="center"><strong>For use of MCJ Product Depelovment Department Only</strong></td>
                        </tr>
						<tr style='font-size:9px;'>
                          <td rowspan="3" style="text-align:left; width:50px; height:20px;" >
						  <input type="radio">Registered<br>
                          <input type="radio">Change<br>
                          <input type="radio">Determined<br>
                          <input type="radio">Revised</td>
                          <td style="text-align:center; width:70px; height:20px;">Prepared by</td>
				      	  <td width="30" style="text-align:center;">Reviewer by</td>
						  <td width="30" style="text-align:center;">Approved by</td>
                      </tr>
						 <tr style='font-size:10px;'>
                           <td style="text-align:center;">/</td>
						   <td style="text-align:center;">/</td>
						   <td style="text-align:center;">/</td>
                      </tr>
						 <tr style='font-size:10px;'>
                          <td style="text-align:center; width:20px; height:80px;">[#RequestSign#]</td>
						   <td>[#RequestSign#]</td>
						   <td>[#RequestSign#]</td>
                   	  </tr>
                   </table>				 </td>
                </tr>
              </table>			 </td>
		   </tr>
            <tr>
              <td colspan="3">&nbsp;</td>
            </tr>
        </table>
</body>
</html>
<!-- Memanggil fungsi bawaan HTML2PDF -->
<?php
$content = ob_get_clean();
 include '../html2pdf/html2pdf.class.php';
 try
{
    $html2pdf = new HTML2PDF('P', 'A4', 'en', false, 'UTF-8', array(2, 2, 2, 2));
    $html2pdf->pdf->SetDisplayMode('fullpage');
    $html2pdf->writeHTML($content);
    $html2pdf->Output('laporan_penjualan_keseluruhan.pdf');
}
catch(HTML2PDF_exception $e) {
    echo $e;
    exit;
}
?>