  <?php 
	include "../../config/connect.php";
	$nprfcode	 	=  @$_POST['data1'];
	$reqno 			=  @$_POST['data2'];

	$exe =mysqli_query($con,"SELECT ID_No,Request_No,Status_FNIM FROM tb_FNIM where Request_No = '".$reqno."' ");
    $tampildata=mysqli_fetch_array(@$exe);
	//________________________________________________________________________________StatusMPR disabled
	if (@$tampildata['Status_FNIM']<>"Draft" & @$tampildata['Status_FNIM']<>"Revise" &
	 @$tampildata['Status_FNIM']<>"" & @$tampildata['Status_FNIM']<>"Complete" ) 
	{$disabled="disabled";} else{$disabled="";}
	?>
<html>
<head> </head>

<body> 	
<table name="fnimdetail1" id="fnimdetail1" class="table table-striped table-bordered table-sm" >
  <tr>
    <td colspan="12" align="left"><strong>FNIM Detail</strong></td>
  </tr>
  <tr valign="bottom" align="center" bgcolor="#999999">
	<th width="1%"></th>
	<th width="15%">Product Name</th>
	<th width="7%">Status</th>
	<th width="12%">Netto</th>
	<th width="7%">Assumed Consumer Price</th>
	<th width="10%">Formula</th>
	<th width="10%">Formula Sample Code</th>
	<th width="10%">Fragrance Code</th>
	<th width="10%">Package On Store</th>
	<th width="10%">MCJ Item No</th>
	<th width="20%">Note</th>
  </tr>
  <?php 

	if(empty($nprfcode)) { ?>
  <tr>
    <td colspan="11" align="center">Tidak ada data yang ditampilkan</td>
  </tr>
  <?php
	} else {
	$Tanya = mysqli_query($con,"SELECT a.Request_No FROM tb_fnim a Inner Join tb_fnim_detail b ON a.Request_No=b.Request_No 
	WHERE a.Request_No = '".$reqno."' And a.NPRF_Code = '".$nprfcode."'   ");
	if (mysqli_num_rows($Tanya) ==0 ) {
		$exe = mysqli_query($con,"SELECT ID_No,MCJ_Item_No,New_Product,Status_Product,NamaCurrency,Price,HPJ,
		Target_COGS,COGS,Sales_3Mth,Sales_1yr,Index_No FROM tb_nprf_item_detail  Where Request_No = '".$nprfcode."'");
		$no = 1;
		while(@$rowNPRFDetail =mysqli_fetch_array($exe)){
	?>
  <tr id="<?php echo $rowNPRFDetail['ID_No']; ?>">
					<td><input type="hidden" name="tempItemDetail[]" id="tempItemDetail[]"
						value="<?php echo $rowNPRFDetail['ID_No']; ?>">
						<button type="button" style="padding:0px 0px 0px 0px" class="btn btn-primary" 
						id="deleteDetail[]" name="deleteDetail[]" onclick = "deleteRow(this)">
						<span class="glyphicon glyphicon-trash" title="Delete FNIM Detail" >
						</span></button>
					</td>
					<td><textarea name="finalproductname[]" id="finalproductname[]" class="form-control"
						style="padding:2px 2px 2px 2px;"<?php echo $disabled; ?> 
						required><?php echo $rowNPRFDetail['New_Product']; ?></textarea>
					</td>
					<td>
						<select style="padding:2px 2px 2px 2px"
						class="form-control"  id="InputStatusProduct[]" name="InputStatusProduct[]"
						 required <?php echo $disabled; ?>>
						<option value="New" <?php if (@$rowNPRFDetail['Status_Product']=='New') {echo "Selected"; }?>>New </option>
            			<option value="Renewal" <?php if (@$rowNPRFDetail['Status_Product']=='Renewal') {echo "Selected";} ?>>Renewal</option>
              			</select>
					</td>
					<td  style="padding:2px 2px 2px 2px"><table name="<?php echo "fnimnetto".$rowNPRFDetail['ID_No']; ?>" 
					 id="<?php echo "fnimnetto".$rowNPRFDetail['ID_No']; ?>"  
					 width="100%" border="1" class="table table-striped table-bordered table-hover">
				  	 <tr>
						<td colspan="3" align="left" style="padding:2px 2px 2px 2px">
							<button type="button" style="padding:0px 0px 0px 0px" class="btn btn-primary"    
							name="btnCreateNetto" 
							onClick="addRowNetto('<?php echo "fnimnetto".$rowNPRFDetail['ID_No']; ?>','<?php echo $rowNPRFDetail['ID_No']; ?>')" 
							<?php echo $disabled; ?>>
							<span class="fa fa-plus" title="Add Netto" ></span> </button>
							<button type="button" style="padding:0px 0px 0px 0px" class="btn btn-primary"   
							id="btnDeleteNetto" name="btnDeleteNetto" 
							onClick="deleteRowNetto('<?php echo "fnimnetto".$rowNPRFDetail['ID_No']; ?>')" <?php echo $disabled; ?>>
							<span class="glyphicon glyphicon-trash" title="Delete Netto" ></span></button>
						</td>
				  	</tr>
					<?php
					$exenetto = mysqli_query($con,"SELECT ID_No,ID_No_ItemDetail,Isi_Net,Netto,Index_No 
					FROM tb_nprf_item_detail_netto Where Request_No = '".$nprfcode."' And
					ID_No_ItemDetail='".$rowNPRFDetail['ID_No']."'  ");
					while(@$rowNPRFDetailNetto =mysqli_fetch_array($exenetto)){
					?>
				  	<tr>
						<td width="1%" style="padding:7px 2px 2px 2px"><input type="checkbox" 
							name="chkNetto<?php echo $rowNPRFDetailNetto['ID_No_ItemDetail']; ?>[]" 
							id="chkNetto<?php echo $rowNPRFDetailNetto['ID_No_ItemDetail']; ?>[]"  <?php echo $disabled; ?> >
							<input type="hidden" name="tempNetto<?php echo $rowNPRFDetailNetto['ID_No_ItemDetail']; ?>[]" 
							id="tempNetto<?php echo $rowNPRFDetailNetto['ID_No_ItemDetail']; ?>[]"
							value="<?php echo $rowNPRFDetailNetto['ID_No_ItemDetail']; ?>" >
						</td>
						<td width="50%" style="padding:4px 2px 2px 2px">
							<input type="text" name="InputNettoDetail<?php echo $rowNPRFDetailNetto['ID_No_ItemDetail']; ?>[]" 
							id="InputNettoDetail<?php echo $rowNPRFDetailNetto['ID_No_ItemDetail']; ?>[]" class="form-control"
							style="padding:2px 2px 2px 2px;text-align:right;" value="<?php echo $rowNPRFDetailNetto['Isi_Net']; ?>" 
							onkeyup="return angka(this);" <?php echo $disabled; ?> required>
						</td>
						<td width="41%" style="padding:4px 2px 2px 2px">
						<select style="padding:2px 2px 2px 2px" 
						name="SelectNettoDetail<?php echo $rowNPRFDetailNetto['ID_No_ItemDetail']; ?>[]" 
						id="SelectNettoDetail<?php echo $rowNPRFDetailNetto['ID_No_ItemDetail']; ?>[]" <?php echo $disabled; ?> class="form-control">
						 <?php
							$div = mysqli_query($con,"SELECT Netto FROM tb_netto");
							while($b = mysqli_fetch_array($div)){
								if(@$rowNPRFDetailNetto['Netto'] == $b['Netto']){
									$cek = 'Selected';	}
								else{
									$cek = '';	}
							echo"<option value='".$b['Netto']."' $cek>".$b['Netto']."</option> ";}?>
						  </select>
						</td>
				  	</tr>
				  	<?php $no++;} ?>
				  	</table>
					</td>
					<td>
					<select style="padding:2px 2px 2px 2px" name="selectMataUang[]" 
						id="selectMataUang[]" <?php echo $disabled; ?> class="form-control">
						<option value="">Currency</option>
						 <?php
							$div = mysqli_query($con,"SELECT NamaCurrency FROM tb_currency Where Status='1'");
							while($b = mysqli_fetch_array($div)){
								if(@$rowNPRFDetail['NamaCurrency'] == $b['NamaCurrency']){
									$cek = 'Selected';	}
								elseif($selectMataUang == $b['NamaCurrency']){
									$cek = 'Selected';	}
								else{
									$cek = '';	}
							echo"<option value='".$b['NamaCurrency']."' $cek>".$b['NamaCurrency']."</option> ";}
						?>
						</select>
					<input type="text" name="InputPrice[]" id="InputPrice[]" class="form-control"
						style="padding:2px 2px 2px 2px;text-align:right;" onKeyUp="return angka(this);" 
						title="Enter Assumed Consumer Price 1.000,25" <?php echo $disabled; ?>
						value="<?php if ($rowNPRFDetail['Price']==0) {echo "";} else { echo number_format(@$rowNPRFDetail['Price'], 2, ",", ".");} ?>" >
						</td>
					<td  style="padding:8px 2px 2px 2px"><table nme="<?php echo "fnimformula".$rowNPRFDetail['ID_No']; ?>" 
					 id="<?php echo "fnimformula".$rowNPRFDetail['ID_No']; ?>"  
					 width="100%" border="1" class="table table-striped table-bordered table-hover">
				  	 <tr>
						<td colspan="2" align="left" style="padding:2px 2px 2px 2px">
							<button type="button" style="padding:0px 0px 0px 0px" class="btn btn-primary"    
							name="btnCreateFormula" 
							onClick="addRowFormula('<?php echo "fnimformula".$rowNPRFDetail['ID_No']; ?>','<?php echo $rowNPRFDetail['ID_No']; ?>')" 
							<?php echo $disabled; ?>>
							<span class="fa fa-plus" title="Add Formula" ></span> </button>
							<button type="button" style="padding:0px 0px 0px 0px" class="btn btn-primary"   
							id="btnDeleteFormula" name="btnDeleteFormula" 
							onClick="deleteRowFormula('<?php echo"fnimformula".$rowNPRFDetail['ID_No']; ?>')" <?php echo $disabled; ?>>
							<span class="glyphicon glyphicon-trash" title="Delete Formula" ></span></button>
						</td>
				  	</tr>
					</table>
					</td>
					<td><table name="<?php echo "fnimformulasamplecode".$rowNPRFDetail['ID_No']; ?>" 
					 id="<?php echo "fnimformulasamplecode".$rowNPRFDetail['ID_No']; ?>"  
					 width="100%" border="1" class="table table-striped table-bordered table-hover">
				  	 <tr>
						<td colspan="2" align="left" style="padding:2px 2px 2px 2px">
							<button type="button" style="padding:0px 0px 0px 0px" class="btn btn-primary"    
							name="btnCreateFormulaSampleCode" 
							onClick="addRowFormulaSampleCode('<?php echo "fnimformulasamplecode".$rowNPRFDetail['ID_No']; ?>','<?php echo $rowNPRFDetail['ID_No']; ?>')" 
							<?php echo $disabled; ?>>
							<span class="fa fa-plus" title="Add Formula Sample Code" ></span> </button>
							<button type="button" style="padding:0px 0px 0px 0px" class="btn btn-primary"   
							id="btnDeleteFormulaSampleCode" name="btnDeleteFormulaSampleCode" 
							onClick="deleteRowFormulaSampleCode('<?php echo"fnimformulasamplecode".$rowNPRFDetail['ID_No']; ?>')" <?php echo $disabled; ?>>
							<span class="glyphicon glyphicon-trash" title="Delete Formula Sample Code" ></span></button>
						</td>
				  	</tr>
					</table></td>
					<td><table name="<?php echo "fnimfragrancecode".$rowNPRFDetail['ID_No']; ?>" 
					 id="<?php echo "fnimfragrancecode".$rowNPRFDetail['ID_No']; ?>"  
					 width="100%" border="1" class="table table-striped table-bordered table-hover">
				  	 <tr>
						<td colspan="2" align="left" style="padding:2px 2px 2px 2px">
							<button type="button" style="padding:0px 0px 0px 0px" class="btn btn-primary"    
							name="btnCreateFragranceCode" 
							onClick="addRowFragranceCode('<?php echo "fnimfragrancecode".$rowNPRFDetail['ID_No']; ?>','<?php echo $rowNPRFDetail['ID_No']; ?>')" 
							<?php echo $disabled; ?>>
							<span class="fa fa-plus" title="Add Fragrance Code"></span> </button>
							<button type="button" style="padding:0px 0px 0px 0px" class="btn btn-primary"   
							id="btnDeleteFragranceCode" name="btnDeleteFragranceCode" 
							onClick="deleteRowFragranceCode('<?php echo"fnimfragrancecode".$rowNPRFDetail['ID_No']; ?>')" <?php echo $disabled; ?>>
							<span class="glyphicon glyphicon-trash" title="Delete Fragrance Code"></span></button>
						</td>
				  	</tr>
					</table></td>
					<td><table name="<?php echo "fnimdpackageonstore".$rowNPRFDetail['ID_No']; ?>" 
					 id="<?php echo "fnimdpackageonstore".$rowNPRFDetail['ID_No']; ?>"  
					 width="100%" border="1" class="table table-striped table-bordered table-hover">
				  	 <tr>
						<td colspan="2" align="left" style="padding:2px 2px 2px 2px">
							<button type="button" style="padding:0px 0px 0px 0px" class="btn btn-primary"    
							name="btnCreatePackageOnStore" 
							onClick="addRowPackageOnStore('<?php echo "fnimdpackageonstore".$rowNPRFDetail['ID_No']; ?>','<?php echo $rowNPRFDetail['ID_No']; ?>')" 
							<?php echo $disabled; ?>>
							<span class="fa fa-plus" title="Add Package On Store"></span> </button>
							<button type="button" style="padding:0px 0px 0px 0px" class="btn btn-primary"   
							id="btnDeletePackageOnStore" name="btnDeletePackageOnStore" 
							onClick="deleteRowPackageOnStore('<?php echo"fnimdpackageonstore".$rowNPRFDetail['ID_No']; ?>')" <?php echo $disabled; ?>>
							<span class="glyphicon glyphicon-trash" title="Delete Package On Store"></span></button>
						</td>
				  	</tr>
					</table>
					</td>
					<td><input type="text" name="InputMCJItemNo[]" id="InputMCJItemNo[]" class="form-control"
						style="padding:2px 2px 2px 2px" value="<?php echo $rowNPRFDetail['MCJ_Item_No']; ?>"	
						readonly="readonly" required></td>
					<td><input type="text" name="InputNote[]" id="InputNote[]" class="form-control"
						style="padding:2px 2px 2px 2px" <?php echo $disabled; ?>></td>
				  </tr>
  <?php $no++;}
	} else {
	$exe = mysqli_query($con,"SELECT ID_No,Product_Name,Status_Product,Isi_Net,Netto,NamaCurrency,Assumed_Consumer_Price,Formula,
					Formula_Sample_Code,Fragrance_Code,Package_On_Stone,MCJ_Item_No,Note,Index_No 
					FROM tb_fnim_detail Where Request_No = '".$reqno."'");
					if (mysqli_num_rows($exe) !=0 ) {
					$no = 1;
					while(@$rowFNIMDetail =mysqli_fetch_array($exe)){
					?>
				  <tr id="<?php echo $rowFNIMDetail['ID_No']; ?>">
					<td>
						<input type="hidden" name="tempItemDetail[]" id="tempItemDetail[]"
						value="<?php echo $rowFNIMDetail['ID_No']; ?>">
						<button type="button" style="padding:0px 0px 0px 0px" class="btn btn-primary" 
						id="deleteDetail[]" name="deleteDetail[]" onclick = "deleteRow(this)" <?php echo $disabled; ?>>
						<span class="glyphicon glyphicon-trash" title="Delete FNIM Detail" >
						</span></button>
					</td>
					<td><textarea name="finalproductname[]" id="finalproductname[]" class="form-control"
						style="padding:2px 2px 2px 2px;" <?php echo $disabled; ?> 
						required><?php echo $rowFNIMDetail['Product_Name']; ?></textarea>
					</td>
					<td>
						<select style="padding:2px 2px 2px 2px"
						class="form-control"  id="InputStatusProduct[]" name="InputStatusProduct[]"
						 required <?php echo $disabled; ?>>
						<option value="New" <?php if (@$rowFNIMDetail['Status_Product']=='New') {echo "Selected"; }?>>New </option>
            			<option value="Renewal" <?php if (@$rowFNIMDetail['Status_Product']=='Renewal') {echo "Selected";} ?>>Renewal</option>
              			</select>
					</td>
					<td  style="padding:8px 2px 2px 2px"><table name="<?php echo "fnimnetto".$rowFNIMDetail['ID_No']; ?>" 
					 id="<?php echo "fnimnetto".$rowFNIMDetail['ID_No']; ?>"  
					 width="100%" border="1" class="table table-striped table-bordered table-hover">
				  	 <tr>
						<td colspan="3" align="left" style="padding:2px 2px 2px 2px">
							<button type="button" style="padding:0px 0px 0px 0px" class="btn btn-primary"    
							name="btnCreateNetto" 
							onClick="addRowNetto('<?php echo "fnimnetto".$rowFNIMDetail['ID_No']; ?>','<?php echo $rowFNIMDetail['ID_No']; ?>')" 
							<?php echo $disabled; ?>>
							<span class="fa fa-plus" title="Add Netto" ></span></button>
							<button type="button" style="padding:0px 0px 0px 0px" class="btn btn-primary"   
							id="btnDeleteNetto" name="btnDeleteNetto" 
							onClick="deleteRowNetto('<?php echo "fnimnetto".$rowFNIMDetail['ID_No']; ?>')" <?php echo $disabled; ?>>
							<span class="glyphicon glyphicon-trash" title="Delete Netto" ></span></button>
						</td>
				  	</tr>
					<?php
					$exenetto = mysqli_query($con,"SELECT ID_No,ID_No_FnimDetail,Isi_Net,Netto 
					FROM tb_fnim_detail_netto Where Request_No = '".$reqno."' And
					ID_No_FnimDetail='".$rowFNIMDetail['ID_No']."'  ");
					while(@$rowFNIMDetailNetto =mysqli_fetch_array($exenetto)){
					?>
				  	<tr>
						<td width="1%" style="padding:7px 2px 2px 2px"><input type="checkbox" 
							name="chkNetto<?php echo $rowFNIMDetailNetto['ID_No_FnimDetail']; ?>[]" 
							id="chkNetto<?php echo $rowFNIMDetailNetto['ID_No_FnimDetail']; ?>[]">
							<input type="hidden" name="tempNetto<?php echo $rowFNIMDetailNetto['ID_No_FnimDetail']; ?>[]" 
							id="tempNetto<?php echo $rowFNIMDetailNetto['ID_No_FnimDetail']; ?>[]"
							value="<?php echo $rowFNIMDetailNetto['ID_No_FnimDetail']; ?>" >
						</td>
						<td width="50%" style="padding:4px 2px 2px 2px">
							<input type="text" name="InputNettoDetail<?php echo $rowFNIMDetailNetto['ID_No_FnimDetail']; ?>[]" 
							id="InputNettoDetail<?php echo $rowFNIMDetailNetto['ID_No_FnimDetail']; ?>[]" class="form-control"
							style="padding:2px 2px 2px 2px;text-align:right;" value="<?php echo $rowFNIMDetailNetto['Isi_Net']; ?>" 
							onkeyup="return angka(this);" <?php echo $disabled; ?> required>
						</td>
						<td width="41%" style="padding:4px 2px 2px 2px">
						<select style="padding:2px 2px 2px 2px" 
						name="SelectNettoDetail<?php echo $rowFNIMDetailNetto['ID_No_FnimDetail']; ?>[]" 
						id="SelectNettoDetail<?php echo $rowFNIMDetailNetto['ID_No_FnimDetail']; ?>[]" <?php echo $disabled; ?> class="form-control">
						 <?php
							$div = mysqli_query($con,"SELECT Netto FROM tb_netto");
							while($b = mysqli_fetch_array($div)){
								if(@$rowFNIMDetailNetto['Netto'] == $b['Netto']){
									$cek = 'Selected';	}
								else{
									$cek = '';	}
							echo"<option value='".$b['Netto']."' $cek>".$b['Netto']."</option> ";}?>
						  </select>
						</td>
				  	</tr>
				  	<?php $no++;} ?>
				  	</table>
					</td>

					<td>
						<select style="padding:2px 2px 2px 2px" name="selectMataUang[]" 
						id="selectMataUang[]" <?php echo $disabled; ?> class="form-control">
						<option value="">Currency</option>
						 <?php
							$div = mysqli_query($con,"SELECT NamaCurrency FROM tb_currency Where Status='1'");
							while($b = mysqli_fetch_array($div)){
								if(@$rowFNIMDetail['NamaCurrency'] == $b['NamaCurrency']){
									$cek = 'Selected';	}
								elseif($selectMataUang == $b['NamaCurrency']){
									$cek = 'Selected';	}
								else{
									$cek = '';	}
							echo"<option value='".$b['NamaCurrency']."' $cek>".$b['NamaCurrency']."</option> ";}
						?>
						</select>
					<input type="text" name="InputPrice[]" id="InputPrice[]" class="form-control"
						style="padding:2px 2px 2px 2px;text-align: right;" onKeyUp="return angka(this);" 
						title="Enter Assumed Consumer Price 1.000,25"
						value="<?php if ($rowFNIMDetail['Assumed_Consumer_Price']==0) {echo "";} 
						else { echo number_format(@$rowFNIMDetail['Assumed_Consumer_Price'], 2, ",", ".");} ?>" <?php echo $disabled; ?>></td>
					<td  style="padding:8px 2px 2px 2px"><table nme="<?php echo "fnimformula".$rowFNIMDetail['ID_No']; ?>" 
					 id="<?php echo "fnimformula".$rowFNIMDetail['ID_No']; ?>"  
					 width="100%" border="1" class="table table-striped table-bordered table-hover">
				  	 <tr>
						<td colspan="2" align="left" style="padding:2px 2px 2px 2px">
							<button type="button" style="padding:0px 0px 0px 0px" class="btn btn-primary"    
							name="btnCreateFormula" 
							onClick="addRowFormula('<?php echo "fnimformula".$rowFNIMDetail['ID_No']; ?>','<?php echo $rowFNIMDetail['ID_No']; ?>')" 
							<?php echo $disabled; ?>>
							<span class="fa fa-plus" title="Add Formula" ></span> </button>
							<button type="button" style="padding:0px 0px 0px 0px" class="btn btn-primary"   
							id="btnDeleteFormula" name="btnDeleteFormula" 
							onClick="deleteRowFormula('<?php echo"fnimformula".$rowFNIMDetail['ID_No']; ?>')" <?php echo $disabled; ?>>
							<span class="glyphicon glyphicon-trash" title="Delete Formula" ></span></button>
						</td>
				  	</tr>
					<?php
					$exeFormula = mysqli_query($con,"SELECT ID_No,ID_No_FnimDetail,Formula 
					FROM tb_fnim_detail_formula Where Request_No = '".$reqno."' And ID_No_FnimDetail='".$rowFNIMDetail['ID_No']."'  ");
					while(@$rowFNIMDetailexeFormula =mysqli_fetch_array($exeFormula)){
					?>
				  	<tr>
						<td width="1%" style="padding:7px 2px 2px 2px"><input type="checkbox" 
							name="chkFormula<?php echo $rowFNIMDetailexeFormula['ID_No_FnimDetail']; ?>[]" 
							id="chkFormula<?php echo $rowFNIMDetailexeFormula['ID_No_FnimDetail']; ?>[]">
							<input type="hidden" name="tempFormula<?php echo $rowFNIMDetailexeFormula['ID_No_FnimDetail']; ?>[]" 
							id="tempFormula<?php echo $rowFNIMDetailexeFormula['ID_No_FnimDetail']; ?>[]"
							value="<?php echo $rowFNIMDetailexeFormula['ID_No_FnimDetail']; ?>" >
							
						</td>
						<td width="50%" style="padding:4px 2px 2px 2px">
							<textarea name="InputFormula<?php echo $rowFNIMDetailexeFormula['ID_No_FnimDetail']; ?>[]" 
							id="InputFormula<?php echo $rowFNIMDetailexeFormula['ID_No_FnimDetail']; ?>[]" class="form-control"
							style="padding:2px 2px 2px 2px;"<?php echo $disabled; ?> 
							cols="50"required><?php echo $rowFNIMDetailexeFormula['Formula']; ?></textarea>
						</td>
				  	</tr>
				  	<?php $no++;} ?>
				  	</table>
					</td>
					<td  style="padding:8px 2px 2px 2px"><table name="<?php echo "fnimformulasamplecode".$rowFNIMDetail['ID_No']; ?>" 
					 id="<?php echo "fnimformulasamplecode".$rowFNIMDetail['ID_No']; ?>"  
					 width="100%" border="1" class="table table-striped table-bordered table-hover">
				  	 <tr>
						<td colspan="2" align="left" style="padding:2px 2px 2px 2px">
							<button type="button" style="padding:0px 0px 0px 0px" class="btn btn-primary"    
							name="btnCreateFormulaSampleCode" 
							onClick="addRowFormulaSampleCode('<?php echo "fnimformulasamplecode".$rowFNIMDetail['ID_No']; ?>','<?php echo $rowFNIMDetail['ID_No']; ?>')" 
							<?php echo $disabled; ?>>
							<span class="fa fa-plus" title="Add Formula Sample Code" ></span> </button>
							<button type="button" style="padding:0px 0px 0px 0px" class="btn btn-primary"   
							id="btnDeleteFormulaSampleCode" name="btnDeleteFormulaSampleCode" 
							onClick="deleteRowFormulaSampleCode('<?php echo"fnimformulasamplecode".$rowFNIMDetail['ID_No']; ?>')" <?php echo $disabled; ?>>
							<span class="glyphicon glyphicon-trash" title="Delete Formula Sample Code" ></span></button>
						</td>
				  	</tr>
					<?php
					$exeFormulaSampleCode = mysqli_query($con,"SELECT ID_No,ID_No_FnimDetail,Formula_Sample_Code,Index_No 
					FROM tb_fnim_detail_formula_sample_code Where Request_No = '".$reqno."' And
					ID_No_FnimDetail='".$rowFNIMDetail['ID_No']."'  ");
					while(@$rowFNIMDetailFormulaSampleCode=mysqli_fetch_array($exeFormulaSampleCode)){
					?>
				  	<tr>
						<td width="1%" style="padding:7px 2px 2px 2px"><input type="checkbox" 
							name="chkFormulaSampleCode<?php echo $rowFNIMDetailFormulaSampleCode['ID_No_FnimDetail']; ?>[]" 
							id="chkFormulaSampleCode<?php echo $rowFNIMDetailFormulaSampleCode['ID_No_FnimDetail']; ?>[]">
							<input type="hidden" name="tempFormulaSampleCode<?php echo $rowFNIMDetailFormulaSampleCode['ID_No_FnimDetail']; ?>[]" 
							id="tempFormulaSampleCode<?php echo $rowFNIMDetailFormulaSampleCode['ID_No_FnimDetail']; ?>[]"
							value="<?php echo $rowFNIMDetailFormulaSampleCode['ID_No_FnimDetail']; ?>" >
						</td>
						<td width="50%" style="padding:4px 2px 2px 2px">
							<textarea 
							name="InputFormulaSampleCode<?php echo $rowFNIMDetailFormulaSampleCode['ID_No_FnimDetail']; ?>[]" 
							id="InputFormulaSampleCode<?php echo $rowFNIMDetailFormulaSampleCode['ID_No_FnimDetail']; ?>[]" 
							class="form-control" style="padding:2px 2px 2px 2px;"<?php echo $disabled; ?>
							cols="50" required><?php echo $rowFNIMDetailFormulaSampleCode['Formula_Sample_Code']; ?></textarea>
						</td>
				  	</tr>
				  	<?php $no++;} ?>
				  	</table>
					</td>
					<td  style="padding:8px 2px 2px 2px"><table name="<?php echo "fnimfragrancecode".$rowFNIMDetail['ID_No']; ?>" 
					 id="<?php echo "fnimfragrancecode".$rowFNIMDetail['ID_No']; ?>"  
					 width="100%" border="1" class="table table-striped table-bordered table-hover">
				  	 <tr>
						<td colspan="2" align="left" style="padding:2px 2px 2px 2px">
							<button type="button" style="padding:0px 0px 0px 0px" class="btn btn-primary"    
							name="btnCreateFragranceCode" 
							onClick="addRowFragranceCode('<?php echo "fnimfragrancecode".$rowFNIMDetail['ID_No']; ?>','<?php echo $rowFNIMDetail['ID_No']; ?>')" 
							<?php echo $disabled; ?>>
							<span class="fa fa-plus" title="Add Fragrance Code"></span> </button>
							<button type="button" style="padding:0px 0px 0px 0px" class="btn btn-primary"   
							id="btnDeleteFragranceCode" name="btnDeleteFragranceCode" 
							onClick="deleteRowFragranceCode('<?php echo"fnimfragrancecode".$rowFNIMDetail['ID_No']; ?>')" <?php echo $disabled; ?>>
							<span class="glyphicon glyphicon-trash" title="Delete Fragrance Code"></span></button>
						</td>
				  	</tr>
					<?php
					$exenetto = mysqli_query($con,"SELECT ID_No,ID_No_FnimDetail,Fragrance_Code,Index_No 
					FROM tb_fnim_detail_fragrance_code Where Request_No = '".$reqno."' And
					ID_No_FnimDetail='".$rowFNIMDetail['ID_No']."'  ");
					while(@$rowFNIMDetailFragranceCode=mysqli_fetch_array($exenetto)){
					?>
				  	<tr>
						<td width="1%" style="padding:7px 2px 2px 2px"><input type="checkbox" 
							name="chkFragranceCode<?php echo $rowFNIMDetailFragranceCode['ID_No_FnimDetail']; ?>[]" 
							id="chkFragranceCode<?php echo $rowFNIMDetailFragranceCode['ID_No_FnimDetail']; ?>[]">
							<input type="hidden" name="tempFragranceCode<?php echo $rowFNIMDetailFragranceCode['ID_No_FnimDetail']; ?>[]" 
							id="tempFragranceCode<?php echo $rowFNIMDetailFragranceCode['ID_No_FnimDetail']; ?>[]"
							value="<?php echo $rowFNIMDetailFragranceCode['ID_No_FnimDetail']; ?>" >
						</td>
						<td width="50%" style="padding:4px 2px 2px 2px">
							<textarea name="InputFragranceCode<?php echo $rowFNIMDetailFragranceCode['ID_No_FnimDetail']; ?>[]" 
							id="InputFragranceCode<?php echo $rowFNIMDetailFragranceCode['ID_No_FnimDetail']; ?>[]" 
							class="form-control" style="padding:2px 2px 2px 2px;"<?php echo $disabled; ?>
							cols="50" required><?php echo $rowFNIMDetailFragranceCode['Fragrance_Code']; ?></textarea>
						</td>
				  	</tr>
				  	<?php $no++;} ?>
				  	</table>
					</td>
					<td  style="padding:8px 2px 2px 2px"><table name="<?php echo "fnimdpackageonstore".$rowFNIMDetail['ID_No']; ?>" 
					 id="<?php echo "fnimdpackageonstore".$rowFNIMDetail['ID_No']; ?>"  
					 width="100%" border="1" class="table table-striped table-bordered table-hover">
				  	 <tr>
						<td colspan="2" align="left" style="padding:2px 2px 2px 2px">
							<button type="button" style="padding:0px 0px 0px 0px" class="btn btn-primary"    
							name="btnCreatePackageOnStore" 
							onClick="addRowPackageOnStore('<?php echo "fnimdpackageonstore".$rowFNIMDetail['ID_No']; ?>','<?php echo $rowFNIMDetail['ID_No']; ?>')" 
							<?php echo $disabled; ?>>
							<span class="fa fa-plus" title="Add Package On Store"></span> </button>
							<button type="button" style="padding:0px 0px 0px 0px" class="btn btn-primary"   
							id="btnDeletePackageOnStore" name="btnDeletePackageOnStore" 
							onClick="deleteRowPackageOnStore('<?php echo"fnimdpackageonstore".$rowFNIMDetail['ID_No']; ?>')" <?php echo $disabled; ?>>
							<span class="glyphicon glyphicon-trash" title="Delete Package On Store"></span></button>
						</td>
				  	</tr>
					<?php
					$exePackageOnStore= mysqli_query($con,"SELECT ID_No,ID_No_FnimDetail,Package_On_Store 
					FROM tb_fnim_detail_package_On_Store Where Request_No = '".$reqno."' And
					ID_No_FnimDetail='".$rowFNIMDetail['ID_No']."'  ");
					while(@$rowFNIMDetailPackageOnStore=mysqli_fetch_array($exePackageOnStore)){
					?>
				  	<tr>
						<td width="1%" style="padding:7px 2px 2px 2px"><input type="checkbox" 
							name="chkPackageOnStore<?php echo $rowFNIMDetailPackageOnStore['ID_No_FnimDetail']; ?>[]" 
							id="chkPackageOnStore<?php echo $rowFNIMDetailPackageOnStore['ID_No_FnimDetail']; ?>[]">
							<input type="hidden" name="tempPackageOnStore<?php echo $rowFNIMDetailPackageOnStore['ID_No_FnimDetail']; ?>[]" 
							id="tempPackageOnStore<?php echo $rowFNIMDetailPackageOnStore['ID_No_FnimDetail']; ?>[]"
							value="<?php echo $rowFNIMDetailPackageOnStore['ID_No_FnimDetail']; ?>" >
						</td>
						<td width="50%" style="padding:4px 2px 2px 2px">
							<textarea name="InputPackageOnStore<?php echo $rowFNIMDetailPackageOnStore['ID_No_FnimDetail']; ?>[]" 
							id="InputPackageOnStore<?php echo $rowFNIMDetailPackageOnStore['ID_No_FnimDetail']; ?>[]" 
							class="form-control" style="padding:2px 2px 2px 2px;"<?php echo $disabled; ?>
							cols="50" required><?php echo $rowFNIMDetailPackageOnStore['Package_On_Store']; ?></textarea>
						</td>
				  	</tr>
				  	<?php $no++;} ?>
				  	</table>
					</td>
					<td><input type="text" name="InputMCJItemNo[]" id="InputMCJItemNo[]" class="form-control"
						style="padding:2px 2px 2px 2px" value="<?php echo $rowFNIMDetail['MCJ_Item_No']; ?>" readonly="readonly"></td>
					<td><textarea name="InputNote[]" cols="50" class="form-control" id="InputNote[]" 
					style="padding:2px 2px 2px 2px;"<?php echo $disabled; ?>><?php echo $rowFNIMDetail['Note']; ?></textarea></td>
				  </tr>
  <?php $no++;}} else {echo  '<tr>
  <td colspan="13" align="center">Tidak ada data yang ditampilkan</td>
  </tr>';}}} ?>
</table>
<body> 
<html>
	
 

<script type="text/javascript">
		function addRowNetto(tableID,IDNo) {
			var table = document.getElementById(tableID);

			var rowCount = table.rows.length;
			var row = table.insertRow(rowCount);

			var cell1 = row.insertCell(0);
			var checkbox = document.createElement("input");
			checkbox.type ="checkbox";
			checkbox.name="chkNetto"+IDNo.toString()+"[]";
			checkbox.id="chkNetto"+IDNo.toString()+"[]";
			cell1.appendChild(checkbox);
			var cell2 = row.insertCell(1);
			var tempNetto = document.createElement("input");
			tempNetto.type ="hidden";
			tempNetto.name="tempNetto"+IDNo.toString()+"[]";
			tempNetto.id="tempNetto"+IDNo.toString()+"[]";
			cell2.appendChild(tempNetto);
			
			var InputIsiNetto = document.createElement('input');
			InputIsiNetto.setAttribute('class',"form-control");
			InputIsiNetto.setAttribute('style',"padding:2px 2px 2px 2px;text-align:right;width:35px");
			InputIsiNetto.setAttribute('title',"Input Isi Netto");
			InputIsiNetto.setAttribute('name',"InputNettoDetail"+IDNo.toString()+"[]");
			InputIsiNetto.setAttribute('id',"InputNettoDetail"+IDNo.toString()+"[]");
			cell2.appendChild(InputIsiNetto);
			
			var array = [<?php
			$div = mysqli_query($con,"SELECT Netto FROM tb_netto Group By Netto ");
			while($b = mysqli_fetch_array($div)){
			echo  "\"$b[Netto]\",";}	?>];
			
			var cell3 = row.insertCell(2);
			var selectNetto = document.createElement('select');
			selectNetto.setAttribute('class',"form-control");
			selectNetto.setAttribute('style',"padding:2px 2px 2px 2px;");
			selectNetto.setAttribute('title',"Select Netto");
			selectNetto.setAttribute('name',"SelectNettoDetail"+IDNo.toString()+"[]");
			selectNetto.setAttribute('id',"SelectNettoDetail"+IDNo.toString()+"[]");
			cell3.appendChild(selectNetto);
			
			
			for (var i = 0; i < array.length; i++) {
				var option = document.createElement("option");
				option.value = array[i];
				option.text = array[i];
				selectNetto.appendChild(option);
			}
		}

		function deleteRowNetto(tableID) {
			try {
			var table = document.getElementById(tableID);
			var rowCount = table.rows.length;

			for(var i=0; i<rowCount; i++) {
				var row = table.rows[i];
				var chk = row.cells[0].childNodes[0];
				if(null != chk && true == chk.checked) {
					table.deleteRow(i);
					rowCount--;
					i--;
				}
			}
			}catch(e) {
				alert(e);
			}
		}
</script>

<script type="text/javascript">
		function addRowFormula(tableID,IDNo) {
			var table = document.getElementById(tableID);

			var rowCount = table.rows.length;
			var row = table.insertRow(rowCount);

			var cell1 = row.insertCell(0);
			var chkFormula = document.createElement("input");
			chkFormula.type ="checkbox";
			chkFormula.name="chkFormula"+IDNo.toString()+"[]";
			chkFormula.id="chkFormula"+IDNo.toString()+"[]";
			cell1.appendChild(chkFormula);
			var cell2 = row.insertCell(1);
			var tempFormula = document.createElement("input");
			tempFormula.type ="hidden";
			tempFormula.name="tempFormula"+IDNo.toString()+"[]";
			tempFormula.id="tempFormula"+IDNo.toString()+"[]";
			cell2.appendChild(tempFormula);
			
			var InputFormula = document.createElement('textarea');
			InputFormula.setAttribute('class',"form-control");
			InputFormula.setAttribute('style',"padding:2px 2px 2px 2px;");
			InputFormula.setAttribute('title',"Input Formula");
			InputFormula.setAttribute('name',"InputFormula"+IDNo.toString()+"[]");
			InputFormula.setAttribute('id',"InputFormula"+IDNo.toString()+"[]");
			cell2.appendChild(InputFormula);
		}

		function deleteRowFormula(tableID) {
			try {
			var table = document.getElementById(tableID);
			var rowCount = table.rows.length;

			for(var i=0; i<rowCount; i++) {
				var row = table.rows[i];
				var chk = row.cells[0].childNodes[0];
				if(null != chk && true == chk.checked) {
					table.deleteRow(i);
					rowCount--;
					i--;
				}
			}
			}catch(e) {
				alert(e);
			}
		}

</script>
<script type="text/javascript">
		function addRowFormulaSampleCode(tableID,IDNo) {
			var table = document.getElementById(tableID);

			var rowCount = table.rows.length;
			var row = table.insertRow(rowCount);

			var cell1 = row.insertCell(0);
			var chkFormulaSampleCode = document.createElement("input");
			chkFormulaSampleCode.type ="checkbox";
			chkFormulaSampleCode.name="chkFormulaSampleCode"+IDNo.toString()+"[]";
			chkFormulaSampleCode.id="chkFormulaSampleCode"+IDNo.toString()+"[]";
			cell1.appendChild(chkFormulaSampleCode);
			
			var cell2 = row.insertCell(1);
			var tempFormulaSampleCode = document.createElement("input");
			tempFormulaSampleCode.type ="hidden";
			tempFormulaSampleCode.name="tempFormulaSampleCode"+IDNo.toString()+"[]";
			tempFormulaSampleCode.id="tempFormulaSampleCode"+IDNo.toString()+"[]";
			cell2.appendChild(tempFormulaSampleCode);
			
			var InputFormulaSampleCode = document.createElement('textarea');
			InputFormulaSampleCode.setAttribute('class',"form-control");
			InputFormulaSampleCode.setAttribute('style',"padding:2px 2px 2px 2px;");
			InputFormulaSampleCode.setAttribute('title',"Input Formula Sample Code");
			InputFormulaSampleCode.setAttribute('name',"InputFormulaSampleCode"+IDNo.toString()+"[]");
			InputFormulaSampleCode.setAttribute('id',"InputFormulaSampleCode"+IDNo.toString()+"[]");
			cell2.appendChild(InputFormulaSampleCode);
		}

		function deleteRowFormulaSampleCode(tableID) {
			try {
			var table = document.getElementById(tableID);
			var rowCount = table.rows.length;

			for(var i=0; i<rowCount; i++) {
				var row = table.rows[i];
				var chk = row.cells[0].childNodes[0];
				if(null != chk && true == chk.checked) {
					table.deleteRow(i);
					rowCount--;
					i--;
				}
			}
			}catch(e) {
				alert(e);
			}
		}
</script>
<script type="text/javascript">
		function addRowFragranceCode(tableID,IDNo) {
			var table = document.getElementById(tableID);

			var rowCount = table.rows.length;
			var row = table.insertRow(rowCount);

			var cell1 = row.insertCell(0);
			var chkFragranceCode = document.createElement("input");
			chkFragranceCode.type ="checkbox";
			chkFragranceCode.name="chkFragranceCode"+IDNo.toString()+"[]";
			chkFragranceCode.id="chkFragranceCode"+IDNo.toString()+"[]";
			cell1.appendChild(chkFragranceCode);
			
			var cell2 = row.insertCell(1);
			var tempFragranceCode = document.createElement("input");
			tempFragranceCode.type ="hidden";
			tempFragranceCode.name="tempFragranceCode"+IDNo.toString()+"[]";
			tempFragranceCode.id="tempFragranceCode"+IDNo.toString()+"[]";
			cell2.appendChild(tempFragranceCode);
			
			var InputFragranceCode = document.createElement('textarea');
			InputFragranceCode.setAttribute('class',"form-control");
			InputFragranceCode.setAttribute('style',"padding:2px 2px 2px 2px;");
			InputFragranceCode.setAttribute('title',"Input Fragrance Code");
			InputFragranceCode.setAttribute('name',"InputFragranceCode"+IDNo.toString()+"[]");
			InputFragranceCode.setAttribute('id',"InputFragranceCode"+IDNo.toString()+"[]");
			cell2.appendChild(InputFragranceCode);
		}

		function deleteRowFragranceCode(tableID) {
			try {
			var table = document.getElementById(tableID);
			var rowCount = table.rows.length;

			for(var i=0; i<rowCount; i++) {
				var row = table.rows[i];
				var chk = row.cells[0].childNodes[0];
				if(null != chk && true == chk.checked) {
					table.deleteRow(i);
					rowCount--;
					i--;
				}
			}
			}catch(e) {
				alert(e);
			}
		}
</script>
<script type="text/javascript">
		function addRowPackageOnStore(tableID,IDNo) {
			var table = document.getElementById(tableID);

			var rowCount = table.rows.length;
			var row = table.insertRow(rowCount);

			var cell1 = row.insertCell(0);
			var chkPackageOnStore = document.createElement("input");
			chkPackageOnStore.type ="checkbox";
			chkPackageOnStore.name="chkPackageOnStore"+IDNo.toString()+"[]";
			chkPackageOnStore.id="chkPackageOnStore"+IDNo.toString()+"[]";
			cell1.appendChild(chkPackageOnStore);
			
			var cell2 = row.insertCell(1);
			var tempPackageOnStore = document.createElement("input");
			tempPackageOnStore.type ="hidden";
			tempPackageOnStore.name="tempPackageOnStore"+IDNo.toString()+"[]";
			tempPackageOnStore.id="tempPackageOnStore"+IDNo.toString()+"[]";
			cell2.appendChild(tempPackageOnStore);
			
			var InputPackageOnStore = document.createElement('textarea');
			InputPackageOnStore.setAttribute('class',"form-control");
			InputPackageOnStore.setAttribute('style',"padding:2px 2px 2px 2px;");
			InputPackageOnStore.setAttribute('title',"Input Package On Store");
			InputPackageOnStore.setAttribute('name',"InputPackageOnStore"+IDNo.toString()+"[]");
			InputPackageOnStore.setAttribute('id',"InputPackageOnStore"+IDNo.toString()+"[]");
			cell2.appendChild(InputPackageOnStore);
		}

		function deleteRowPackageOnStore(tableID) {
			try {
			var table = document.getElementById(tableID);
			var rowCount = table.rows.length;

			for(var i=0; i<rowCount; i++) {
				var row = table.rows[i];
				var chk = row.cells[0].childNodes[0];
				if(null != chk && true == chk.checked) {
					table.deleteRow(i);
					rowCount--;
					i--;
				}
			}
			}catch(e) {
				alert(e);
			}
		}
</script>
<script> function deleteRow(row){
	var d = row.parentNode.parentNode.rowIndex;
	var r = confirm("Are you sure you want to delete this?");
	if (r == true) {
		document.getElementById('fnimdetail1').deleteRow(d);
		}
   }
</script>
<!--script>
function deleteRowFnimDetail(tableID) {
			try {
			var table = document.getElementById(tableID);
			var rowCount = table.rows.length;

			for(var i=0; i<rowCount; i++) {
				var row = table.rows[i];
				var chk = row.cells[0].childNodes[0];
				if(null != chk && true == chk.checked) {
					table.deleteRow(i);
					rowCount--;
					i--;
				}
			}
			}catch(e) {
				alert(e);
			}
		}

</script>
<script>
$(document).ready(function(){
 //Delete Technical Document_______________________________________________________
 $('#btn-delete').click(function(){
  var r = confirm("Press a button!");
	if (r == true) {
   var DelFNIM = [];
   
   $(':checkbox:checked').each(function(x){
    DelFNIM[x] = $(this).val();
   });
   if(DelFNIM.length === 0) //tell you if the array is empty
   {
    alert("Please Select atleast one checkbox");
   }
   else
   {
    $.ajax({
     url:'../config/delete.php',
     method:'POST',
     data:{DelFNIM:DelFNIM},
     success:function()
     {
      for(var x=0; x<DelFNIM.length; x++)
      {
       $('tr#'+DelFNIM[x]+'').css('background-color', '#ccc');
       $('tr#'+DelFNIM[x]+'').fadeOut('slow');
	   deleteRowFnimDetail('fnimdetail');
      }
     }
    });
   }
  }
  else
  {
   return false;
  }
 });
 //___________________________________________________________

});
</script-->
 
 