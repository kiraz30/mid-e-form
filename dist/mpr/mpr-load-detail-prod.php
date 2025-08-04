	
<table name="mprdetailprod" id="mprdetailprod"  width="120%" border="1" class="table table-striped table-bordered table-hover" >
		  <tr>
					<td colspan="5" align="left"><strong>MPR Detail</strong></td>
				  </tr>
				  <tr valign="bottom" align="center" bgcolor="#999999">
					<th width="1%">No</th>
					<th width="20%">Product Name</th>
					<th width="2%">Netto</th>
					<th width="20%">Nama Produk Singkat</th>
					<th width="20%">Kelompok_Stok</th>
				  </tr>	 
			 	  <?php 
				  include "../../config/connect.php";

				  $fnimcode	 	= $_POST['data1'];
				  $reqno 		= $_POST['data2'];
				  $indexNo		= @$_POST['data3'];
				  $indexProcess	= @$_POST['data4'];
				   if(empty($fnimcode)) { ?> 
				  <tr>
					<td colspan="5" align="center">Tidak ada data yang ditampilkan</td>
				  </tr>
					<?php
					} else {
					$exe = mysqli_query($con,"SELECT a.ID_No,b.Product_Name,a.Nama_Produk_Singkat,
					a.Kelompok_Stok,a.Index_No 
					FROM tb_mpr_detail a Inner Join tb_FNIM_detail b ON a.ID_NoFNIMDetail=b.ID_No 
					Where a.Request_No = '".$reqno."' And b.Request_No='".$fnimcode."'");
					if (mysqli_num_rows($exe) !=0 ) {
					$no = 1;
					while(@$rowMPRDetail =mysqli_fetch_array($exe)){
					?>
				  <tr id="<?php echo $rowMPRDetail['ID_No']; ?>">
					<td style="padding:15px 5px 5px 5px;"> <?php echo $no ; ?></td>
					<td style="padding:15px 5px 5px 5px;">
						<input type="hidden" name="tempID_NoProd[]" id="tempID_NoProd[]" value="<?php echo $rowMPRDetail['ID_No']; ?>">
						<?php echo $rowMPRDetail['Product_Name']; ?> </td>
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
					<td><input style="padding:2px 2px 2px 2px" type="text" name="Nama_Produk_Singkat[]" id="Nama_Produk_Singkat[]" 
						value="<?php echo $rowMPRDetail['Nama_Produk_Singkat']; ?>" class="form-control" required
						<?php MPRDisable($indexNo,$indexProcess,'5'); 
						if ($indexNo=="1" & $indexProcess=="Step 5"){ echo" required";}?>/></td>

					<td><input type="text" name="Kelompok_Stok[]" id="Kelompok_Stok[]" class="form-control"
						style='padding:2px 2px 2px 2px;' value="<?php echo $rowMPRDetail['Kelompok_Stok']; ?>" 
						<?php MPRDisable($indexNo,$indexProcess,'5'); 
						if ($indexNo=="1" & $indexProcess=="Step 5"){ echo" required";}?>  /></td>
					</tr>
				  <?php $no++;}} else {echo  '<tr>
					<td colspan="5" align="center">Tidak ada data yang ditampilkan</td>
				  </tr>';}} ?>

				  </table>			  
