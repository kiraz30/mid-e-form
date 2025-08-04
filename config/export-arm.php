
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
		a.MPR_Code,a.Project_Name,a.Subject, a.Type_Finish_Goods,a.Type_Materials,a.Type_WorkProcess,
		a.Type_Fu_Fee,a.Type_Vendor,a.Type_Customer,a.Segment_Price,a.Segment_Data_Informasi,
		a.Segment_Ukuran,a.Segment_Others,a.Segment_Over_Receipt,a.Content,a.Remark,
		a.Remark,a.Status_add_resource,a.CreatedBy,c.`Name`,d.DivisionName , DATE_FORMAT(a.CreatedDate,'%d-%m-%Y') as Created_Date 
		from tb_packdev_add_resource a  
		LEFT JOIN tb_mpr b ON a.MPR_Code=b.Request_No
		INNER JOIN Tb_user c ON a.CreatedBy=c.UserDomain
		INNER JOIN tb_division d ON c.KDDivision=d.KDDivision

		WHERE a.Request_No = '".@$_GET['id']."'");
		$tampildata=mysqli_fetch_array($exe);
 
?>
 

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Report ARM <?php  echo $id;?>





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
<body <?php if ($page=="privew-arm" && $tampildata['Status_add_resource']!='Complete'){ echo 'background="../img/watermark.png"';}?> >


<?php
if ($page=="arm"){?>
<script>
window.print();
</script>
</script>
<style>
	body {padding:0px}
.print-area {border:1px solid red;padding:1em;margin:0 0 1em}
</style>
<?php } ?>
<?php
if ($page=="arm"|| $page=="privew-arm"){
	if ($page=="privew-fnim" && $tampildata['Status_add_resource']!='Complete'){ echo '<h1>Preview Report</h1>';}?> 
	<table  class="demo-table responsive" border="0" width="1024" align="center">
	<thead>
		<tr>
		  <td  style="width:100px;"><img src="../img/Logo.png"  width="100px" height="80"></td>
		  <td align="center" valign="middle" width="100%" ><h2><u>FORM ADDITION/CHANGES RESOURCE MASTER</u>	</h2></td>
	  	</tr>
	</thead>
	<tbody>
		<tr>
       	  <td colspan="3"><br>
			<table cellpadding="0" cellspacing="0" border="0" width="100%" >
	            <tr>
                	<td width="20%" style="text-align:left; height:30px;" >
						<label>Date</label>
					</td>
					<td style="width:10px;" >:</td>
					<td style="width:1020px;"><label><?php echo $tampildata['Created_Date']; ?></label>
					</td>
                </tr>
				<tr>
                    <td style="text-align:left; width:50px; height:30px;">
						<label>Person In Change</label></td>
						<td>:</td>
						<td>
						  	<label><?php echo $tampildata['Name']; ?></label>
						</td>
                    </tr>
					<tr>
						<td style="text-align:left; width:50px; height:30px;">
						<label>Department</label></td>
						<td>:</td>
						<td>
							<label><?php echo $tampildata['DivisionName']; ?></label>
					</td>
                    </tr>
					<tr>
						<td style="text-align:left; width:50px; height:30px;">
						<label>Subject</label></td>
						<td>:</td>
						<td>
							<table cellpadding="0" cellspacing="0" border="0"  >
								<tr>
									<td style="text-align:left; 
										width:120px; height:20px;">
										<label><input type="checkbox" name="Additional" <?php if ($tampildata['Subject']=="Additional") { echo 'checked="checked"';} ?> 
										disabled="disabled">Additional</label></td>
									<td style="text-align:left; 
										width:120px; height:20px;">
										<label><input type="checkbox" name="Change" <?php if ($tampildata['Subject']=="Change") { echo 'checked="checked"';} ?> 
										disabled="disabled">Change</label></td>
								</tr>
							</table>
						</td> 
							  
                    </tr>
					<tr>
						<td style="text-align:left; width:50px; height:30px;">
							<label>Type</label></td>
						<td>:</td>
						<td>
							<table cellpadding="0" cellspacing="0" border="0"  >
								<tr>
									<td style="text-align:left; 
										width:120px; height:20px;">
										<label><input type="checkbox" name="ChkType" <?php if ($tampildata['Type_Finish_Goods']=="1") { echo 'checked="checked"';} ?> 
										disabled="disabled">Finish Goods</label></td>
									<td style="text-align:left; 
										width:120px; height:20px;">
										<label><input type="checkbox" name="ChkType" <?php if ($tampildata['Type_Materials']=="1") { echo 'checked="checked"';} ?> 
										disabled="disabled">Materials</label></td>
									<td style="text-align:left; 
										width:120px; height:20px;">
										<label><input type="checkbox" name="ChkType" <?php if ($tampildata['Type_WorkProcess']=="1") { echo 'checked="checked"';} ?> 
										disabled="disabled">WorkProcess</label></td>
									<td style="text-align:left; 
										width:120px; height:20px;">
										<label><input type="checkbox" name="ChkType" <?php if ($tampildata['Type_Fu_Fee']=="1") { echo 'checked="checked"';} ?> 
										disabled="disabled">Fu Fee</label></td>
									<td style="text-align:left; 
										width:120px; height:20px;">
										<label><input type="checkbox" name="ChkType" <?php if ($tampildata['Type_Vendor']=="1") { echo 'checked="checked"';} ?> 
										disabled="disabled">Vendor</label></td>
									<td style="text-align:left; 
										width:120px; height:20px;">
										<label><input type="checkbox" name="ChkType" <?php if ($tampildata['Type_Customer']=="") { echo 'checked="checked"';} ?> 
										disabled="disabled">Customer</label></td>
								</tr>
							</table>						
						</td>
                    </tr>
					<tr>
						<td style="text-align:left; width:50px; height:30px;">
							<label>Segment</label></td>
						<td>:</td>
						<td>
							<table cellpadding="3" cellspacing="0" border="0"  >
								<tr>
									<td style="text-align:left; 
										width:120px; height:20px;">
										<label><input type="checkbox" name="ChkSegment" <?php if ($tampildata['Segment_Price']=="1") { echo 'checked="checked"';} ?> 
									disabled="disabled">Price</label></td>
									<td style="text-align:left; 
										width:120px; height:20px;">
										<label><input type="checkbox" name="ChkSegment" <?php if ($tampildata['Segment_Data_Informasi']=="1") { echo 'checked="checked"';} ?> 
										disabled="disabled">Data Informasi</label></td>
									<td style="text-align:left; 
										width:120px; height:20px;">
										<label><input type="checkbox" name="ChkSegment" <?php if ($tampildata['Segment_Ukuran']=="1") { echo 'checked="checked"';} ?> 
										disabled="disabled">Ukuran</label></td>
									<td style="text-align:left; 
										width:120px; height:20px;">
										<label><input type="checkbox" name="ChkSegment" <?php if ($tampildata['Segment_Others']=="1") { echo 'checked="checked"';} ?> 
										disabled="disabled">Others</label></td>
									<td style="text-align:left; 
										width:150px; height:20px;">
										<label><input type="checkbox" name="ChkSegment" <?php if ($tampildata['Segment_Over_Receipt']=="1") { echo 'checked="checked"';} ?> 
										disabled="disabled">10% Over Receipt</label></td>

								</tr>
							</table>	
						</td>
                    </tr>
					<tr>
						<td valign="top" style="text-align:left; width:50px; height:30px;">
							<label>Content</label></td>
						<td valign="top" >:</td>
						<td>
							<table cellpadding="3" cellspacing="0" border="1"  >
								<tr >
									<td valign="top" style="text-align:left;margin:3px 3px 3px 3px; width:700px; height:50px;">
									<label><?php echo $tampildata['Content']; ?></label></td>
								</tr>
							</table>
						</td>
                    </tr>
					<tr> 
						<td style="text-align:left; width:50px; height:5px;" colspan="3"></td>
                    </tr>
					<tr>
						<td valign="top" style="text-align:left; width:50px; height:30px;">
							<label>Document</label></td>
						<td valign="top" >:</td>
						<td>
							<table cellpadding="3" cellspacing="0" border="1"  >
								<tr>
									<td valign="top" style="text-align:left; width:250px; height:25px;"><label><?php echo $tampildata['MPR_Code']; ?></label> </td>
								</tr>
								<!--tr>
									<td valign="top" style="text-align:left; width:250px; height:25px;">FR/FCT1/PURCH-0008R</td>
								</tr-->
								<?php
								$query="SELECT No_ID, DocLampiran FROM tb_packdev_add_resource_doc_lampiran
								Where Request_No = '".@$_GET['id']."' Order By Index_No ASC ";
								$exe = mysqli_query($con,$query);
								$no = 1;
								while(@$row =mysqli_fetch_array($exe)){
								?>
								<tr>
									<td valign="top" style="text-align:left; width:250px; height:25px;"><?php echo $row['DocLampiran']; ?></td>
								</tr>
								<?php
								}; ?>
							</table>
						</td>
                    </tr>
					<tr> 
						<td style="text-align:left; width:50px; height:5px;" colspan="3"></td>
                    </tr>
					<tr>
						<td valign="top" style="text-align:left; width:50px; height:30px;">
							<label>Note</label></td>
						<td valign="top" >:</td>
						<td>
							<table cellpadding="3" cellspacing="0" border="1"  >
								<tr>
									<td valign="top" style="text-align:left; width:250px; height:25px;"><?php echo $tampildata['Remark']; ?></td>
								</tr>
								<tr>
									<td valign="top" style="text-align:left; width:250px; height:25px;"></td>
								</tr>
								<tr>
									<td valign="top" style="text-align:left; width:250px; height:25px;"></td>
								</tr>
							</table>
						</td>
                    </tr>
					<tr> 
						<td style="text-align:left; width:50px; height:10px;" colspan="3"></td>
                    </tr>
                  	<tr>
                    	<td width="410" colspan="3" align="left">
						<table cellpadding="0" cellspacing="0" border="1" width="80%" >

                      <tr style='font-size:14px;'>
                        <td style="text-align:center; width:100px; height:20px;" >Craeted By</td>
                        <td  colspan="2" style="text-align:center; width:200px; height:20px;" > Approved By</td>
                        <td style="text-align:center; width:100px; height:20px; ">Prepared by</td>
						<td style="text-align:left; width:130px; height:20px; ">Misc. Info</td>
                      </tr>
                      <tr style='font-size:14px;'>
                        <td valign="top" align="center" style=" width:20px; height:120px;">
						<?php 
							ShowTtdNamaTglByPosisiRequestor($tampildata['Request_No'],"arm",'01,02,03,04,52804',"1") ; ?>
						</td>
                        <td valign="top" style="text-align:center; width:100px;">
						<?php echo ShowttdARM(@$tampildata['Request_No'],'arm','Step 2','2');?>
						<?php echo ShowttdARM(@$tampildata['Request_No'],'arm','Step 3','2');?>
						<?php echo ShowttdARM(@$tampildata['Request_No'],'arm','Step 3','3');?>
					
					</td>
                        <td valign="top" style="text-align:center; width:100px;">
						
						<?php echo ShowttdARM(@$tampildata['Request_No'],'arm','Step 4','4');?>
						</td>
                        <td valign="top" align="center">
						<?php echo ShowttdARM(@$tampildata['Request_No'],'arm','Step 1','3');?>
						<?php echo ShowttdARM(@$tampildata['Request_No'],'arm','Step 1','4');?>
						<?php echo ShowttdARM(@$tampildata['Request_No'],'arm','Step 1','5');?>
						<?php echo ShowttdARM(@$tampildata['Request_No'],'arm','Step 2','5');?>
						<?php echo ShowttdARM(@$tampildata['Request_No'],'arm','Step 2','4');?>
						<?php echo ShowttdARM(@$tampildata['Request_No'],'arm','Step 2','6');?>
						<?php echo ShowttdARM(@$tampildata['Request_No'],'arm','Step 4','6');?>
						</td>
						<td align="center"></td>
                    	</table>
					</td>
					<td width="50" align="left">&nbsp;</td>
                  </tr>
                
                  
                </table>
 	 		</td>
		</tr>
	</table>
	
	<tbody>
</table>
<p style='font-size:10px;'>FR/PPIC/KG-2004</p>
<div style="page-break-before:always;">
<table  cellpadding="0" cellspacing="0" border="1" width="100%"  align="center">
	<thead>
		<tr>
			<th rowspan="5" colspan="2" style="width:100px;"><img src="../img/Logo.png"  width="100px" height="80"></th>
			<th rowspan="2" colspan="16" align="center" valign="middle" width="77%" ><h2><u>FORMULIR</u>	</h2></th>
			<th  align="left" colspan="2" valign="middle" width="23%" style='font-size:13px;' > No : FR/PPIC/PURCH-0008 </th>
		</tr>
		<tr>
			<th  align="left" colspan="2" valign="middle" style='font-size:13px;' > Tgl Berlaku : 09/05/22</th>
		</tr>
		<tr>
			<th rowspan="3" colspan="16" align="center" valign="middle" ><h2><u>NEW ITEM (RESOURCE CODE)</u>	</h2></th>
			<th  align="left" colspan="2" valign="middle" style='font-size:13px;'> Tgl Revisi: -</th>
		</tr>
		<tr>
			<th  align="left" colspan="2" valign="middle" style='font-size:13px;' >No Rev : 0</th>
		</tr>
		<tr>
			<th  align="left" colspan="2" valign="middle" style='font-size:13px;' >Hal : 1 dari 1</th>
		</tr>
		<tr>
			<th  align="center" colspan="22" valign="middle" style='font-size:14px;' >New Item</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td colspan="21">
				<table  cellpadding="0" cellspacing="0" border="1" width="100%"  align="center">
					<tr style='font-size:10px;text-align:center;'>
						<th></th> 
						<th>1</th>
						<th>2</th>
						<th>3</th>
						<th>4</th>
						<th>5</th>
						<th>6</th>
						<th>7</th>
						<th>8</th>
						<th>9</th>
						<th>10</th>
						<th>11</th>
						<th>12</th>
						<th>13</th>
						<th>14</th>
						<th>15</th>
						<th>16</th>
						<th>17</th>
						<th>18</th>
						<th>19</th>
						<th>20</th>
					</tr>
					<tr style='font-size:10px;text-align:center;'>
						<th></th>
						<th colspan="13">Filled by Requester</th> 
						<th colspan="5">Filled by Checker</th>
						<th colspan="2">Input</th>
				 
					</tr>
					<tr style='font-size:10px;text-align:center;'>
						<th>No</th><!-- 1-->
						<th>Finish Good Code</th><!-- 1-->
						<th>Material Name</th><!-- 2-->
						<th>MCJ Code/ Model/Inci</th><!-- 3-->
						<th>Order UM</th><!-- 4-->
						<th>Minimum Order Qty (MOQ)</th> <!-- 5-->
						<th>Multiple Order Qty (Packing Size)</th> <!-- 6-->
						<th>Currency</th><!-- 7-->
						<th>STD UP</th><!-- 8-->
						<th>Expiration Validity</th><!-- 9-->
						<th>Status Halal</th><!-- 10-->
						<th>Resource Category</th><!-- 11-->
						<th>Country Origin</th><!-- 12-->
						<th>Vendor Name</th><!-- 13-->
						<th>Vendor Code</th><!-- 14-->
						<th>PO Lead Time (Day)</th><!-- 15-->
						<th>Safety Stock Ratio</th><!-- 16-->
						<th>Cutoff Days</th><!-- 17-->
						<th>Buyer & Planner</th><!-- 18-->
						<th>Resource Code</th><!-- 19-->
						<th>REMAKS</th><!-- 20-->
					</tr>
					<?php
					$query="SELECT ID_No,Request_No,FinishGoodCode,FinishGoodName,Material_Name,
					MCJ_Code,Order_UM,Minimum_Order_Qty,Miltiple_Order_Qty,CountryOrigin,Vendor_Name,Currency,
					Std_UP,Vendor_Code,PO_Lead_Time,Safety_Stock_Ratio,Cate_of_Day,Buyer_Planner,
					Resource_Code,SAP_Code,Remark
					FROM tb_packdev_add_resource_detail Where Request_No = '".@$_GET['id']."' ";
					$exe = mysqli_query($con,$query);
					$no = 1;
					while(@$row =mysqli_fetch_array($exe)){
					?>
					<tr style='font-size:10px;padding:5px 5px 5px 5px;'>
						<td style='padding:2px 2px 2px 2px;width:2%;'><?php echo $no;?></td>
						<td style='padding:2px 2px 2px 2px; width:15%;'><?php echo $row['FinishGoodCode']."<br>".$row['FinishGoodName'];?> </td>
						<td style='padding:2px 2px 2px 2px; width:10%;'><?php echo $row['Material_Name'];?></td>
						<td style='padding:2px 2px 2px 2px; width:5%;'><?php echo $row['MCJ_Code'];?></td>
						<td style='padding:2px 2px 2px 2px; width:5%;'><?php echo $row['Order_UM'];?></td>
						<td style='padding:2px 2px 2px 2px; width:5%; text-align:right;'><?php echo $row['Minimum_Order_Qty'];?></td>
						<td style='padding:2px 2px 2px 2px; width:5%; text-align:right;'><?php echo $row['Miltiple_Order_Qty'];?></td> 
						<td style='padding:2px 2px 2px 2px; width:4%;'><?php echo $row['Currency'];?></td>
						<td style='padding:2px 2px 2px 2px; width:4%;  text-align:right;'><?php echo $row['Std_UP'];?></td>
						<td style='padding:2px 2px 2px 2px; width:7%;'></td>
						<td style='padding:2px 2px 2px 2px; width:7%;'></td>
						<td style='padding:2px 2px 2px 2px; width:7%;'></td>
						<td style='padding:2px 2px 2px 2px; width:7%;'><?php echo $row['CountryOrigin'];?></td>
						<td style='padding:2px 2px 2px 2px; width:10%;'><?php echo $row['Vendor_Name'];?></td>
						
						<td style='padding:2px 2px 2px 2px; width:5%; text-align:right;'><?php echo $row['Vendor_Code'];?></td>
						<td style='padding:2px 2px 2px 2px; width:5%; text-align:right;' ><?php echo $row['PO_Lead_Time'];?></td>
						<td style='padding:2px 2px 2px 2px; width:4%; text-align:right;'><?php echo $row['Safety_Stock_Ratio'];?></td>
						<td style='padding:2px 2px 2px 2px; width:4%; text-align:right;'><?php echo $row['Cate_of_Day'];?></td>
						<td style='padding:2px 2px 2px 2px; width:7%;'><?php echo $row['Buyer_Planner'];?></td>
						<td style='padding:2px 2px 2px 2px; width:5%;'><?php echo $row['Resource_Code'];?></td>
						<td style='padding:2px 2px 2px 2px; width:5%;'><?php echo $row['SAP_Code']." ". $row['Remark'];?></td>
					</tr>
					<?php
					}; ?>
				</table>
			</td>
		</tr>
		 
</tbody> 
</table>

</div>

<?php
};
 ?>
</body>
</html>
 