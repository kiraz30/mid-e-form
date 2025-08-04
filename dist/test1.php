<html>
<?php
?>
<head>
<title>SURUHBELAJAR.BLOGSPOT.COM</title>
<script src="../vendor/jquery/jquery-latest.js" type="text/javascript"></script>
</head>
<body>
<h1>TEST Load Data</h1><br>
<form name="frmrange" method="post">
<label for="siswa" style="font-size:20px">Nama Siswa :</label>
<select name="selectReq" style="font-size:20px" id="selectReq">
 <option value=''>--Pilih--</option>
<?php 
 $q = mysqli_query($con,"select * from tb_fnim order by Request_No");
 while($hasil=mysqli_fetch_array($q)){
  echo "<option value='$hasil[Request_No]'>$hasil[Request_No]</option>";
 }
?>
</select>
 



<table name="tabel_range" id="tabel_range"  width="100%" border="1" class="table table-striped table-bordered table-hover" >
 <tr>
					<td colspan="10" align="left"><strong>FNIM Detail</strong>					
					<button type="button" style="padding:0px 0px 0px 0px" class="btn btn-primary" title="Add FNIM Detail"  
					name="btnCreateFNIM" onClick="addRow('fnimdetail')"><span class="fa fa-plus" title="Preview Work Flow" ></span> </button>
					<button type="button" style="padding:0px 0px 0px 0px" class="btn btn-primary" title="Delete FNIM Detail "  
					id="btnDelete" name="btnDeleteFNIM" onClick="deleteRow('fnimdetail')">
					<span class="glyphicon glyphicon-trash" title="Preview Work Flow" ></span></button>
					</td>
				  </tr>
				  <tr valign="bottom" align="center" bgcolor="#999999">
					<th width="1%"></th>
					<th width="20%">Final Product Name</th>
					<th width="5%">Net</th>
					<th width="7%">Assumed Consumer Price</th>
					<th width="5%">Formula</th>
					<th width="10%">Formula Sample Code</th>
					<th width="10%">Fragrance Code</th>
					<th width="10%">Package On Stone</th>
					<th width="10%">MCJ Item No</th>
					<th width="20%">Note</th>
				  </tr>
			 
			 	  <?php 
				  $id  = @$_POST['selectReq'];
				   if(empty($id)) { ?> 
				  <tr>
					<td><input type="checkbox" name="chkdetail[]" id="chkdetail[]"></td>
					<td><input type="text" name="finalproductname[]" id="finalproductname[]" class="form-control"
						style="padding:2px 2px 2px 2px" onKeyUp="this.value = this.value.toUpperCase()" required></td>
					<td><input type="text" name="InputNet[]" id="InputNet[]" class="form-control"
						style="padding:2px 2px 2px 2px" required></td>
					<td><input type="text" name="InputPrice[]" id="InputPrice[]" class="form-control"
						style="padding:2px 2px 2px 2px;text-align: right;" onKeyPress="return angka(event)"   ></td>
					<td><input type="text" name="InputFormula[]" id="InputFormula[]" class="form-control"
						style="padding:2px 2px 2px 2px" required></td>
					<td><input type="text" name="InputFormulaSampleCode[]" id="InputFormulaSampleCode[]" class="form-control"
						style="padding:2px 2px 2px 2px" required></td>
					<td><input type="text" name="InputFragranceCode[]" id="InputFragranceCode[]" class="form-control"
						style="padding:2px 2px 2px 2px" required></td>
					<td><input type="text" name="InputPackageOnStone[]" id="InputPackageOnStone[]" class="form-control"
						style="padding:2px 2px 2px 2px" required></td>
					<td><input type="text" name="InputMCJItemNo[]" id="InputMCJItemNo[]" class="form-control"
						style="padding:2px 2px 2px 2px" ></td>
					<td><input type="text" name="InputNote[]" id="InputNote[]" class="form-control"
						style="padding:2px 2px 2px 2px" ></td>
				  </tr>
					 <?php
					 } else {
					$exe = mysqli_query($con,"SELECT ID_No,Product_Name,Net,Assumed_Consumer_Price,Formula,
					Formula_Sample_Code,Fragrance_Code,Package_On_Stone,MCJ_Item_No,Note,Index_No 
					FROM tb_fnim_detail Where Request_No = '".$id."'   ");
					$no = 1;
					while(@$rowFNIMDetail =mysqli_fetch_array($exe)){
					?>
				  <tr>
					<td><input type="checkbox" name="chkdetail[]" id="chkdetail[]"></td>
					<td><input type="text" name="finalproductname[]" id="finalproductname[]" class="form-control"
						style="padding:2px 2px 2px 2px" onKeyUp="this.value = this.value.toUpperCase()"
						value="<?php echo $rowFNIMDetail['Product_Name']; ?>" required></td>
					<td><input type="text" name="InputNet[]" id="InputNet[]" class="form-control"
						style="padding:2px 2px 2px 2px" value="<?php echo $rowFNIMDetail['Net']; ?>" required></td>
					<td><input type="text" name="InputPrice[]" id="InputPrice[]" class="form-control"
						style="padding:2px 2px 2px 2px;text-align: right;" onKeyPress="return angka(event)"
						value="<?php echo $rowFNIMDetail['Assumed_Consumer_Price']; ?>"></td>
					<td><input type="text" name="InputFormula[]" id="InputFormula[]" class="form-control"
						style="padding:2px 2px 2px 2px" value="<?php echo $rowFNIMDetail['Formula']; ?>"  required></td>
					<td><input type="text" name="InputFormulaSampleCode[]" id="InputFormulaSampleCode[]" class="form-control"
						style="padding:2px 2px 2px 2px" value="<?php echo $rowFNIMDetail['Formula_Sample_Code']; ?>" required></td>
					<td><input type="text" name="InputFragranceCode[]" id="InputFragranceCode[]" class="form-control"
						style="padding:2px 2px 2px 2px" value="<?php echo $rowFNIMDetail['Fragrance_Code']; ?>" required></td>
					<td><input type="text" name="InputPackageOnStone[]" id="InputPackageOnStone[]" class="form-control"
						style="padding:2px 2px 2px 2px" value="<?php echo $rowFNIMDetail['Package_On_Stone']; ?>" required></td>
					<td><input type="text" name="InputMCJItemNo[]" id="InputMCJItemNo[]" class="form-control"
						style="padding:2px 2px 2px 2px" value="<?php echo $rowFNIMDetail['MCJ_Item_No']; ?>" ></td>
					<td><input type="text" name="InputNote[]" id="InputNote[]" class="form-control"
						style="padding:2px 2px 2px 2px" value="<?php echo $rowFNIMDetail['Note']; ?>" ></td>
				  </tr>
				  <?php $no++;} }?>
				  </table>
				  
</form>

<script>
 $('select[id=selectReq]').change(function(){
  get_siswa();
 });

 function get_siswa(){
  var a = $('#selectReq').val();
  $.ajax({
   type: 'POST',
   url: "test.php",
   data: "selectReq="+a,
   success: function(info) {
    $("#tabel_range").html(info);   }
  });
  return false;
 }

function deleteRow() {
			try {
			var table = document.getElementById('fnimdetail');
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

</body>
</html>