
<table name="fnimdetail" id="fnimdetail"  width="100%" border="1" class="table table-striped table-bordered table-hover" >
		  <tr>
					<td colspan="12" align="left"><strong>MPR Detail</strong></td>
				  </tr>
				  <tr valign="bottom" align="center" bgcolor="#999999">
					<th width="1%">No</th>
					<th width="20%">Product Name</th>
					<th width="20%">Status Product</th>
					<th width="2%">Netto</th>
					<th width="2%">Price</th>
					<th width="2%">Isi</th>
					<th width="6%">Secondary Packaging</th>
					<th width="2%">DZ/CT</th>
					<th width="2%">CT/CT</th>
					<th width="4%">UNIT</th>
					<th width="8%">Barcode Existing</th>
					<th width="8%">Code Product</th>
					<th width="10%">No. Barcode</th>
				  </tr>	 
			 	  <?php 
				  include "../../config/connect.php";

				  $fnimcode	 	= @$_POST['data1'];
				  $reqno 		= @$_POST['data2'];
				  $indexNo		= @$_POST['data3'];
				  $indexProcess	= @$_POST['data4'];
				   if(empty($fnimcode)) { ?> 
				  <tr>
					<td colspan="13" align="center">Tidak ada data yang ditampilkan</td>
				  </tr>
					<?php
					} else {
					$exe = mysqli_query($con,"SELECT a.ID_No,a.ID_NoFNIMDetail,b.Product_Name,
					b.Status_Product,a.Price,a.Isi,a.UOM1,
					a.DZ_CT,a.CT_CT,a.UOM,a.Barcode_Existing,a.Code_Product,a.BARCODE,a.Index_No 
					FROM tb_mpr_detail a Inner Join tb_FNIM_detail b ON a.ID_NoFNIMDetail=b.ID_No 
					Where a.Request_No = '".$reqno."'  And b.Request_No='".$fnimcode."'");
					if (mysqli_num_rows($exe) !=0 ) {
					$no = 1;
					while(@$rowMPRDetail =mysqli_fetch_array($exe)){
					?>
				  <tr id="<?php echo $rowMPRDetail['ID_No']; ?>">
					<td style="padding:15px 5px 5px 5px;"> <?php echo $no ; ?></td>
					<td style="padding:15px 5px 5px 5px;">
						<input type="hidden" name="tempID_No[]" id="tempID_No[]" value="<?php echo $rowMPRDetail['ID_No']; ?>">
						<?php echo $rowMPRDetail['Product_Name']; ?> </td>
					<td style="padding:15px 5px 5px 5px; "><?php echo $rowMPRDetail['Status_Product']; ?></td>
					<td style="padding:15px 5px 5px 5px; ">
					<?php 
					$isinetto="";
					$exeNetto = mysqli_query($con,"SELECT ID_No,Isi_Net,Netto,Index_No 
					FROM tb_fnim_detail_netto Where Request_No = '".$fnimcode."' And
					ID_No_FnimDetail='".$rowMPRDetail['ID_NoFNIMDetail']."'  Order By ID_No Asc");
					while(@$rowFNIMDetailNetto =mysqli_fetch_array($exeNetto)){ 
						$isinetto=$isinetto.$rowFNIMDetailNetto['Isi_Net']." ".$rowFNIMDetailNetto['Netto'].", ";
					} 
					echo substr($isinetto,0,-2);  ?></td>
					<td style="padding:15px 5px 5px 5px; text-align:right;"><?php echo $rowMPRDetail['Price']; ?> </td>
					<td style="padding:15px 5px 5px 5px; text-align:right;"><?php echo $rowMPRDetail['Isi']; ?></td>
					<td style="padding:15px 5px 5px 5px; "><?php echo $rowMPRDetail['UOM1']; ?></td>
					<td style="padding:15px 5px 5px 5px; text-align:right;"> <?php echo $rowMPRDetail['DZ_CT']; ?> </td>
					<td style="padding:15px 5px 5px 5px; text-align:right;"> <?php echo $rowMPRDetail['CT_CT']; ?> </td>
					<td style="padding:15px 5px 5px 5px; text-align:right;"> <?php echo $rowMPRDetail['UOM']; ?> </td>
					<td style="padding:15px 5px 5px 5px; "><?php echo $rowMPRDetail['Barcode_Existing']; ?> </td>
					<td><input type="text" name="Code_Product[]" id="Code_Product[]" class="form-control"
						style="padding:2px 2px 2px 2px" value="<?php echo $rowMPRDetail['Code_Product']; ?>" 
						<?php MPRDisable($indexNo,$indexProcess,'3'); ?>></td>
					<td><input type="text" name="BARCODE[]" id="BARCODE[]" class="form-control"
						style="padding:2px 2px 2px 2px" value="<?php echo $rowMPRDetail['BARCODE']; ?>" 
						<?php MPRDisable($indexNo,$indexProcess,'3'); ?>></td>
				  </tr>
				  <?php $no++;}} else {echo  '<tr>
					<td colspan="13" align="center">Tidak ada data yang ditampilkan</td>
				  </tr>';}} ?>

				  </table>			  
