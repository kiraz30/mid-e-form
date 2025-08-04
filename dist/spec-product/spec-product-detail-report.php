<?php
	$datenow					= date("Y-m-d");
	$uploadDirFileSpec_Product	= "../img/Spec_Product/";
	$id 						= @$_POST['getDetail'];
	include "../../config/connect.php";
	$exe =mysqli_query($con,"SELECT a.ID_No,a.Index_Document,a.Request_No,a.Last_Request_No,a.Status_Last_Document,
	a.MPR_Code,
	a.Brand,a.Bisnis,b.NamaBisnis,a.Category,a.Code_Product,a.BARCODE,a.Product_Name,a.Isi_Net,a.Netto,
	DATE_FORMAT(a.Launching, '%m') Bulan,DATE_FORMAT(a.Launching, '%Y') Tahun,
	a.Description AS Description_SP,a.Notifikasi_BPOM,a.Product_Image,
	a.SizeOfProduct,a.SizeOfProduct_P,a.SizeOfProduct_L,a.SizeOfProduct_T,a.SizeOfProduct_Satuan,
	a.InnerPack_P,a.InnerPack_L,a.InnerPack_T,a.InnerPack_Satuan,
	a.SizeOfCartton_IS_P,a.SizeOfCartton_IS_L,a.SizeOfCartton_IS_T,a.SizeOfCartton_IS_Satuan,
	a.SizeOfCartton_OS_P,a.SizeOfCartton_OS_L,a.SizeOfCartton_OS_T,a.SizeOfCartton_OS_Satuan,
	a.DznCtn,a.DznCtn_Keterangan,a.WeighOfContenCtn,a.WeighOfContenCtn_Satuan,Status_Spec,a.Remark,a.CreatedBy,a.CreatedDate
	FROM tb_spec_product a INNER JOIN tb_bisnis b ON a.Bisnis=b.KDBisnis WHERE a.Request_No = '$id' ");
	$tampildata=mysqli_fetch_array(@$exe);
?>
<table width="100%" border="0" class="table table-striped" id="dataTables-example" >
	<tr>
		<td width="10%"><span class="form-group">I. Marketing Support </span></td>
		<td width="20%"><span class="form-group">Request No</span></td>
		<td colspan="3"><span class="form-group">
			<input name="tempMPR" type="hidden" value="<?php echo @$tampildata['Request_No']; ?>">
			<input name="tempMPRDetail" type="hidden" value="<?php echo @$tampildata['ID_NoMPRDetail']; ?>">
			<input name="tempMPRFNIM" type="hidden" value="<?php echo @$tampildata['FNIM_Code']; ?>">
			<input name="tempFNIMDetail" type="hidden" value="<?php echo @$tampildata['ID_NoFNIMDetail']; ?>">
			<input class="form-control py-4"  name="inputAutoRequestNo" id="inputAutoRequestNo"  maxlength="50" type="text"  
			placeholder="Auto Request No" readonly="readonly" value="<?php echo $tampildata['Request_No']; ?>" />
			</span>
		</td>
	</tr>
	<tr>
		<td width="1%"><span class="form-group"></span></td>
        <td><span class="form-group">Last Request No  </span></td>
        <td colspan="3"><span class="form-group">
        	<input class="form-control py-4"  name="inputLastRequestNo" id="inputLastRequestNo"  maxlength="50" type="text"  
			placeholder="Auto Request No"  readonly="readonly" value="<?php echo @$tampildata['Last_Request_No'];?>" />
            </span> </td>
    </tr>
	<tr>
		<td width="1%"><span class="form-group"></span></td>
		<td><span class="form-group">Brand</span></td>
		<td colspan="3">
			<span class="form-group"> 
				<input class="form-control py-0"  name="inputProductCode" id="inputProductCode"  
				maxlength="50" type="text" readonly="readonly" value="<?php echo $tampildata['Brand']; ?>" />
			</span>
		</td>
	</tr>
	<tr>
		<td width="1%"><span class="form-group"></span></td>
		<td><span class="form-group">Product Code</span></td>
		<td colspan="3">
			<span class="form-group"> 
				<input class="form-control py-0"  name="inputProductCode" id="inputProductCode"  
				maxlength="50" type="text" readonly="readonly" value="<?php echo $tampildata['Code_Product']; ?>" />
			</span>
		</td>
	</tr>
	<tr>
		<td><span class="form-group"></span></td>
		<td><span class="form-group">Product Barcode</span></td>
		<td colspan="3">
			<span class="form-group"> 
				<input class="form-control py-4"  name="inputBarcode" id="inputBarcode" 
				maxlength="50" type="text" readonly="readonly" value="<?php echo $tampildata['BARCODE']; ?>" />
			</span>
		</td>
	</tr>
	<tr>
		<td width="1%"><span class="form-group"></span></td>
		<td><span class="form-group">Product Name</span></td>
		<td colspan="3">
			<span class="form-group"> 
				<input class="form-control py-4"  name="inputProductName" id="inputProductName" 
				maxlength="50" type="text" readonly="readonly" value="<?php echo $tampildata['Product_Name']; ?>" />
			</span>
		</td>
	</tr>
	<tr>
		<td><span class="form-group"></span></td>
		<td><span class="form-group">Netto</span></td>
		<td>
			<div class="form-group d-flex align-items-center justify-content-between mt-0 mb-0">
			<input class="form-control py-4"  name="inputIsiNetto" id="inputIsiNetto" 
			maxlength="50" type="text" value="<?php echo @$tampildata['Isi_Net']; ?>" disabled ="disabled" />
			<select class="form-control col-md-2"  id="inpuNet" disabled ="disabled"
			name="inpuNet"  >
				<option value="gr" <?php if (@$tampildata['Netto']=='gr') {echo "Selected"; }?>>gr</option>
				<option value="Kg" <?php if (@$tampildata['Netto']=='Kg') {echo "Selected"; }?>>Kg</option>
				<option value="ml" <?php if (@$tampildata['Netto']=='ml') {echo "Selected"; }?>>ml</option>
				<option value="Liter" <?php if (@$tampildata['Netto']=='Liter') {echo "Selected"; }?>>Liter</option>
			</select> 
			</div>
		</td>
    </tr>
	<tr>
		<td><span class="form-group"></span></td>
		<td><span class="form-group">CATEGORY 7 [BISNIS]</span></td>
		<td colspan="3">
			<span class="form-group"> 
				<input class="form-control py-4"  name="inputBISNIS" id="inputBISNIS" 
				maxlength="50" type="text" readonly="readonly" value="<?php echo $tampildata['NamaBisnis']; ?>" />
			</span>
		</td>
	</tr>
	<tr>
		<td><span class="form-group"></span></td>
		<td><span class="form-group">CATEGORY 9 [CATEGORY]</span></td>
		<td colspan="3">
			<span class="form-group"> 
				<input class="form-control py-4"  name="inputCATEGORY" id="inputCATEGORY" 
				maxlength="50" type="text" readonly="readonly" value="<?php echo $tampildata['Category']; ?>" />
			</span>
		</td>
	</tr>
	<tr>
		<td><span class="form-group"></span></td>
		<td><span class="form-group">Launching Years</span></td>
		<td colspan="3">
			<span class="form-group"> 
				<input class="form-control py-4"  name="inputLaunchingYears" id="inputLaunchingYears" 
				maxlength="50" type="text" readonly="readonly" 
				value="<?php if($tampildata['Tahun']!="0000")  {echo $tampildata['Tahun'];}?>" />
			</span>
		</td>
	</tr> 
	<tr>
		<td rowspan="2" ><span class="form-group"></span>II.Product Development</td>
		<td rowspan="2" ><span class="form-group">Project Status</span></td>
		<td colspan="3">
			<span class="form-group"> 
			<table cellpadding="0" cellspacing="0" border="0"width="100%"  >
				<tr>
					<td style="text-align:left; width:120px; height:20px;">
						<label><input type="checkbox" name="ChkProjectStatus1" id="ChkProjectStatus1" disabled ="disabled"
						<?php if (@$tampildata['ProjectStatus1']=="1") { echo 'checked="checked"';} ?>> New</label></td>
					<td style="text-align:left; width:120px; height:20px;">
						<label><input type="checkbox" name="ChkProjectStatus2" id="ChkProjectStatus2" disabled ="disabled"
						<?php if (@$tampildata['ProjectStatus2']=="1") { echo 'checked="checked"';} ?> > Renewal</label></td>
					<td style="text-align:left; width:120px; height:20px;">
						<label><input type="checkbox" name="ChkProjectStatus3" id="ChkProjectStatus3" disabled ="disabled"
						<?php if (@$tampildata['ProjectStatus3']=="1") { echo 'checked="checked"';} ?>  > Refine</label></td>
					<td style="text-align:left; width:120px; height:20px;">
						<label><input type="checkbox" name="ChkProjectStatus4" id="ChkProjectStatus4" disabled ="disabled"
						<?php if (@$tampildata['ProjectStatus4']=="1") { echo 'checked="checked"';} ?> > Others</label></td>
				</tr>
			</table>
			</span>
		</td>
	</tr>
	<tr>
		<td colspan="2"><textarea cols="4" id="inputProjectStatus" name="inputProjectStatus"  
  			class="form-control py-4" placeholder="Enter Project Status" disabled ="disabled"
  			maxlength="100"><?php echo @$tampildata['ProjectStatus']; ?></textarea>
  		</td>
	</tr>
	<tr>
		<td width="1%"><span class="form-group"></span></td>
		<td><span class="form-group">Product Short Description</span></td>
		<td colspan="3"><span class="form-group"> <textarea cols="4" id="inputProductShortDescription" 
			name="inputProductShortDescription"  class="form-control py-4" 
			placeholder="Enter Product Short Description" disabled="disabled"
			maxlength="200"><?php  echo $tampildata['Description_SP']; ?></textarea>
			</div>
		</td>
	</tr>
	<tr>
		<td width="1%"><span class="form-group">III. Packaging Development</span></td>
		<td><span class="form-group">Size of Product</span></td>
		<td colspan="3">
			<span class="form-row"> 
				<span class="col-md-8"> 
					<span class="form-group">
						<div class="form-group d-flex align-items-center justify-content-between mt-0 mb-0">
							<select class="form-control" id="selectSizeofProduct" name="selectSizeofProduct" disabled="disabled"  >
								<option value="" <?php if (@$tampildata['SizeOfProduct']=='')  {echo "Selected"; }?> ></option>
								<option value="Ø"<?php if (@$tampildata['SizeOfProduct']=='Ø') {echo "Selected"; }?> >Ø</option>
							</select> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
							<input class="form-control py-4"  name="inputSizeofProduct_P" id="inputSizeofProduct_P"  
							maxlength="50" type="text" disabled="disabled"  
							placeholder="Enter P" value="<?php echo $tampildata['SizeOfProduct_P']; ?>" />
							 &nbsp;&nbsp;X&nbsp;&nbsp;  
							<input class="form-control py-4"  name="inputSizeofProduct_L" id="inputSizeofProduct_L"  
							maxlength="50" type="text" disabled="disabled"
							placeholder="Enter L" value="<?php echo $tampildata['SizeOfProduct_L']; ?>" />
							&nbsp;&nbsp;X&nbsp;&nbsp; 
							<input class="form-control py-4"  name="inputSizeofProduct_T" id="inputSizeofProduct_T"  
							maxlength="50" type="text"   disabled="disabled"
							placeholder="Enter T" value="<?php echo $tampildata['SizeOfProduct_T']; ?>" />
						</div>
					</span>
				</span>	
				<span class="col-md-2"> 
					<span class="form-group"> 
						<select class="form-control" id="selectSizeOfProduct_Satuan"  
							name="selectSizeOfProduct_Satuan" disabled="disabled" >
							<option value="mm" <?php if (@$rowMPRDetail['SizeOfProduct_Satuan']=='mm') {echo "Selected"; }?>>mm</option>
							<option value="cm" <?php if (@$rowMPRDetail['SizeOfProduct_Satuan']=='cm') {echo "Selected"; }?>>cm</option>
						</select> 			  		 
					</span>				  
				</span>
			</span>		
		</td>
	</tr>
	<tr>
		<td width="1%"><span class="form-group"></span></td>
		<td width="15%"><span class="form-group">Inner Pack</span></td>
		<td colspan="3">
			<span class="form-row"> 
				<span class="col-md-6"> 
					<span class="form-group">
						<div class="form-group d-flex align-items-center justify-content-between mt-0 mb-0">
							<input class="form-control py-4"  name="inputInnerPack_P" id="inputInnerPack_P"  
							maxlength="50" type="text"  disabled="disabled" 
							placeholder="Enter P" value="<?php echo $tampildata['InnerPack_P']; ?>" />
				        	 &nbsp;&nbsp;X&nbsp;&nbsp;  
							<input class="form-control py-4"  name="inputInnerPack_L" id="inputInnerPack_L"  
							maxlength="50" type="text"   disabled="disabled"
							placeholder="Enter L" value="<?php echo $tampildata['InnerPack_L']; ?>" />
							&nbsp;&nbsp;X&nbsp;&nbsp; 
							<input class="form-control py-4"  name="inputInnerPack_T" id="inputInnerPack_T"  
							maxlength="50" type="text"   disabled="disabled"
							placeholder="Enter T" value="<?php echo $tampildata['InnerPack_T']; ?>" />
						</div>
					</span>
				</span>	
				<span class="col-md-2"> 
					<span class="form-group"> 
						<select class="form-control" id="selectSizeOfProduct_Satuan" 
							name="selectSizeOfProduct_Satuan"  disabled="disabled">
							<option value="mm" <?php if (@$rowMPRDetail['InnerPack_Satuan']=='mm') {echo "Selected"; }?>>mm</option>
							<option value="cm" <?php if (@$rowMPRDetail['InnerPack_Satuan']=='cm') {echo "Selected"; }?>>cm</option>
						</select> 			  		 
					</span>				  
				</span>
			</span>		
		</td>
	</tr>
		<td width="1%"></td>
        <td colspan="4">Size of Carton</td>
	</tr>
    <tr>
		<td width="1%"><span class="form-group"></span></td>
		<td width="15%"><span class="form-group">Inner Size</span></td>
		<td colspan="3">
			<span class="form-row"> 
				<span class="col-md-6"> 
					<span class="form-group">
						<div class="form-group d-flex align-items-center justify-content-between mt-0 mb-0">
							<input class="form-control py-4"  name="inputSizeOfCartton_IS_P" id="inputSizeOfCartton_IS_P"  
							maxlength="50" type="text"   disabled="disabled"
							placeholder="Enter P" value="<?php echo $tampildata['SizeOfCartton_IS_P']; ?>" />
							&nbsp;&nbsp;X&nbsp;&nbsp;  
							<input class="form-control py-4"  name="inputSizeOfCartton_IS_L" id="inputSizeOfCartton_IS_L"  
							maxlength="50" type="text"   disabled="disabled"
							placeholder="Enter L" value="<?php echo $tampildata['SizeOfCartton_IS_L']; ?>" />
							&nbsp;&nbsp;X&nbsp;&nbsp; 
							<input class="form-control py-4"  name="inputSizeOfCartton_IS_T" id="inputSizeOfCartton_IS_T"  
							maxlength="50" type="text"   disabled="disabled"
							placeholder="Enter T" value="<?php echo $tampildata['SizeOfCartton_IS_T']; ?>" />
						</div>
					</span>
				</span>	
				<span class="col-md-2"> 
					<span class="form-group"> 
						<select class="form-control" id="selectSizeOfProduct_Satuan" 
							name="selectSizeOfProduct_Satuan"  disabled="disabled">
							<option value="mm" <?php if (@$rowMPRDetail['SizeOfCartton_IS_Satuan']=='mm') {echo "Selected"; }?>>mm</option>
							<option value="cm" <?php if (@$rowMPRDetail['SizeOfCartton_IS_Satuan']=='cm') {echo "Selected"; }?>>cm</option>
						</select> 			  		 
					</span>				  
				</span>
			</span>		
		</td>
	</tr>
	<tr>
		<td width="1%"><span class="form-group"></span></td>
		<td width="15%"><span class="form-group">Outer Size</span></td>
		<td colspan="3">
			<span class="form-row"> 
				<span class="col-md-6"> 
					<span class="form-group">
						<div class="form-group d-flex align-items-center justify-content-between mt-0 mb-0">
							<input class="form-control py-4"  name="inputSizeOfCartton_OS_P" id="inputSizeOfCartton_OS_P"  
							maxlength="50" type="text"  disabled="disabled" 
							placeholder="Enter P" value="<?php echo $tampildata['SizeOfCartton_OS_P']; ?>" />
							 &nbsp;&nbsp;X&nbsp;&nbsp;  
							<input class="form-control py-4"  name="inputSizeOfCartton_OS_L" id="inputSizeOfCartton_OS_L"  
							maxlength="50" type="text"   disabled="disabled"
							placeholder="Enter L" value="<?php echo $tampildata['SizeOfCartton_OS_L']; ?>" />
							&nbsp;&nbsp;X&nbsp;&nbsp; 
							<input class="form-control py-4"  name="inputSizeOfCartton_OS_T" id="inputSizeOfCartton_OS_T"  
							maxlength="50" type="text"   disabled="disabled"
							placeholder="Enter T" value="<?php echo $tampildata['SizeOfCartton_OS_T']; ?>" />
						</div>
					</span>
				</span>	
				<span class="col-md-2"> 
					<span class="form-group"> 
						<select class="form-control" id="selectSizeOfProduct_Satuan" 
						name="selectSizeOfProduct_Satuan"  disabled="disabled" >
							<option value="mm" <?php if (@$rowMPRDetail['SizeOfCartton_OS_Satuan']=='mm') {echo "Selected"; }?>>mm</option>
							<option value="cm" <?php if (@$rowMPRDetail['SizeOfCartton_OS_Satuan']=='cm') {echo "Selected"; }?>>cm</option>
						</select> 			  		 
					</span>				  
				</span>
			</span>		
		</td>
	</tr>
	<tr>
		<td width="1%"><span class="form-group"></span></td>
		<td><span class="form-group">Dzn / Ctn</span></td>
		<td colspan="3">
			<span class="form-row"> 
				<span class="col-md-2"> 
					<span class="form-group">
						<div class="form-group d-flex align-items-center justify-content-between mt-0 mb-0">
							<input class="form-control py-4"  name="inpuDsn_Ctn" id="inpuDsn_Ctn"  
							maxlength="50" type="text"   disabled="disabled"
							placeholder="Dzn" value="<?php echo $tampildata['DznCtn']; ?>" />
						</div>
					</span>
				</span>
				&nbsp;&nbsp;Keterangan&nbsp;&nbsp;  
				<span class="col-md-7"> 
					<span class="form-group"> 
						<input class="form-control py-4"  name="inpuDsnCtn_Keterangan" id="inpuDsnCtn_Keterangan"  
						maxlength="50" type="text"  disabled="disabled" 
						placeholder="Keterangan" value="<?php echo $tampildata['DznCtn_Keterangan']; ?>" /> 			  		 
					</span>				  
				</span>
			</span>
		</td>
	</tr>		
	<tr>
		<td width="1%"><span class="form-group">IV. Registration</span></td>
		<td><span class="form-group">Notification BPOM</span></td>
		<td colspan="3">
			<span class="form-group">
				<input class="form-control py-4"  name="inputNotificationBPOM" id="inputNotificationBPOM"  
				maxlength="50" type="text"  disabled="disabled"
				placeholder="Notification BPOM" value="<?php echo $tampildata['Notifikasi_BPOM']; ?>" />
			</span>
		</td>
	</tr>
	<tr>
		<td></td>
		<td><span class="form-group">Halal Number</span></td>
		<td colspan="3"><span class="form-group">
			<input class="form-control py-4"  name="inputHalalNumber" id="inputHalalNumber"  
			maxlength="50" type="text"   disabled ="disabled"
			placeholder="Notification BPOM" value="<?php echo @$tampildata['Halal_Number']; ?>" />
			</span>
		</td>
    </tr>
	<tr>
		<td><span class="form-group">V. QC</span></td>
		<td><span class="form-group">Product Image</span></td>
		<td colspan="3"> <?php if (!empty($tampildata['Product_Image'])){?>
			<img height="80" width="100" src="../img/<?php echo $uploadDirFileSpec_Product."/".$tampildata['Product_Image'];?>"
			title="Open File <?php echo $tampildata['Product_Image'];?>"
			onClick="popupwindow('../config/popup-img.php?id=<?php echo $tampildata['ID_No'];?>&name=<?php echo $tampildata['Product_Image'];?>&pg=fileSpecProduct','Preview Image','700','1000');"> <?php echo $tampildata['Product_Image'];} ?> </td>
    </tr>
 

	<tr>
		<td width="1%"><span class="form-group">VI. Advertising</span></td>
		<td>Weight of Content / Carton </td>
		<td colspan="3"><div class="form-group d-flex align-items-center justify-content-between mt-0 mb-0">
			<input class="form-control py-4"  name="inputWeightofContent" id="inputWeightofContent"  
			maxlength="50" type="text"  disabled="disabled" 
			placeholder="Enter Weight of Content / Carton" value="<?php echo $tampildata['WeighOfContenCtn']; ?>" />
			<select class="form-control col-md-2" id="inputWeightofContent_Satuan" 
				name="inputWeightofContent_Satuan"  disabled="disabled" >
				<option value="gr" <?php if (@$tampildata['WeighOfContenCtn_Satuan']=='gr') {echo "Selected"; }?>>gr</option>
			</select> 
			</div>
		</td>
	</tr>
	<tr>
		
        <td>Remark</td>
		<td></td>
              <td colspan="3"><div class="form-group"> <textarea cols="4" id="inputRemark" name="inputRemark"  
			  class="form-control py-4" placeholder="Enter Remark" disabled="disabled" 
			  maxlength="100"><?php echo @$tampildata['Remark']; ?></textarea></div></td>
            </tr>
	</tr>
</table>
		  
		  
