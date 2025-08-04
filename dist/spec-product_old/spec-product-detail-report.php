<?php
	$datenow					= date("Y-m-d");
	$uploadDirFileSpec_Product	= "../img/Spec_Product/";
	$id 						= @$_POST['getDetail'];
	include "../../config/connect.php";
	$exe =mysqli_query($con,"SELECT d.ID_No,a.Request_No,b.ID_No AS ID_NoMPRDetail,c.Request_No AS FNIM_Code,c.ID_No AS ID_NoFNIMDetail,
	DATE_FORMAT(d.Launching, '%m') Bulan, DATE_FORMAT(d.Launching, '%Y') Tahun,
	a.Type_Request,b.Code_Product,b.BARCODE,c.Product_Name,
	d.Description AS Description_SP,d.Notifikasi_BPOM,d.Product_Image,
	d.SizeOfProduct,d.SizeOfProduct_P,d.SizeOfProduct_L,d.SizeOfProduct_T,d.SizeOfProduct_Satuan,
	d.InnerPack_P,d.InnerPack_L,d.InnerPack_T,d.InnerPack_Satuan,
	d.SizeOfCartton_IS_P,d.SizeOfCartton_IS_L,d.SizeOfCartton_IS_T,d.SizeOfCartton_IS_Satuan,
	d.SizeOfCartton_OS_P,d.SizeOfCartton_OS_L,d.SizeOfCartton_OS_T,d.SizeOfCartton_OS_Satuan,
	d.DznCtn,d.DznCtn_Keterangan,d.WeighOfContenCtn
	FROM tb_mpr a INNER JOIN tb_mpr_detail b ON a.Request_No=b.Request_No INNER JOIN tb_fnim_detail c 
	on a.FNIM_Code=c.Request_No and  b.ID_NoFNIMDetail=c.ID_No
	LEFT JOIN tb_spec_product d on a.Request_No=d.MPR_Code AND b.ID_No=d.ID_NoMPRDetail WHERE b.ID_No = '$id' ");
	$tampildata=mysqli_fetch_array(@$exe);
?>
<table width="100%" border="0" class="table table-striped" id="dataTables-example" >
	<tr>
		<td width="1%"><span class="form-group">I. </span></td>
		<td width="20%"><span class="form-group">Master Product Request No</span></td>
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
		<td><span class="form-group">Product Code</span></td>
		<td colspan="3">
			<span class="form-group"> 
				<input class="form-control py-0"  name="inputProductCode" id="inputProductCode"  
				maxlength="50" type="text" readonly="readonly" value="<?php echo $tampildata['Code_Product']; ?>" />
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
		<td><span class="form-group">Barcode</span></td>
		<td colspan="3">
			<span class="form-group"> 
				<input class="form-control py-4"  name="inputBarcode" id="inputBarcode" 
				maxlength="50" type="text" readonly="readonly" value="<?php echo $tampildata['BARCODE']; ?>" />
			</span>
		</td>
	</tr>
	<tr>
		<td width="1%"><span class="form-group"></span></td>
		<td><span class="form-group">Launching</span></td>
		<td width="">
			<div class="form-group d-flex align-items-center justify-content-between mt-0 mb-0">
				<select name="Selectbulan" id="Selectbulan"  title="Bulan Launching" class="form-control" disabled="disabled">
					<option value="">Bulan</option>
					<?php
					$div = mysqli_query($con,"SELECT Bulan,Ket FROM tb_bulan");
					while($b = mysqli_fetch_array($div)){
						if(@$tampildata['Bulan'] == $b['Bulan']){
							$cek = 'Selected';	}
						else{
							$cek = '';	}
					echo"<option value='".$b['Bulan']."' $cek>".$b['Ket']."</option> ";}
					?>
				</select>				
				<select name="SelectTahun" id="SelectTahun" title="Tahun Launching" class="form-control"   disabled="disabled">
					<option value="">Tahun</option>
					<?php 
					$mulai= date('Y');
					for($i = $mulai;$i<$mulai + 5;$i++){?>
					<option value="<?php echo $i; ?>" <?php if (@$tampildata['Tahun']==$i) 
					{echo "Selected";} ?>><?php echo $i; ?></option><?php }	?>
				</select>
			</div>
		</td>
		<td>Example : Januari 2020</td>
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
		<td colspan="5">&nbsp;</td>
	</tr>
	<tr>
		<td><span class="form-group">II.</span></td>
		<td><span class="form-group">Product Image</span></td>
		<td colspan="3"> <?php if (!empty($tampildata['Product_Image'])){?>
			<img height="40" width="40" src="../img/<?php echo $uploadDirFileSpec_Product."/".$tampildata['Product_Image'];?>"
			title="Open File <?php echo $tampildata['Product_Image'];?>"
			onClick="popupwindow('../config/popup-img.php?id=<?php echo $tampildata['ID_No'];?>&name=<?php echo $tampildata['Product_Image'];?>&pg=fileSpecProduct','Preview Image','700','1000');"> <?php echo $tampildata['Product_Image'];} ?> </td>
    </tr>
	<tr>
		<td colspan="5">&nbsp;</td>
	</tr>
	<tr>
		<td width="1%"><span class="form-group">III.</span></td>
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
		<td colspan="5">&nbsp;</td>
	</tr>
	<tr>
		<td width="1%"><span class="form-group">IV.</span></td>
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
		<td width="15%"><span class="form-group">Inner Pack</span></td>
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
				<span class="col-md-8"> 
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
		<td colspan="5">&nbsp;</td>
	</tr>
	<tr>
		<td width="1%"><span class="form-group">V.</span></td>
		<td>Weight of Content / Carton </td>
		<td colspan="3"><div class="form-group">
			<input class="form-control py-4"  name="inputWeightofContent" id="inputWeightofContent"  
			maxlength="50" type="text"  disabled="disabled" 
			placeholder="Enter Weight of Content / Carton" value="<?php echo $tampildata['WeighOfContenCtn']; ?>" /></div></td>
	</tr>
	<tr>
		<td colspan="5">&nbsp;</td>
	</tr>
</table>
		  
		  
