	<?php $Send		= @$_POST['Send']; ?>
	<?php $Save		= @$_POST['Save']; ?>

<script language="JavaScript">
	function setFocus(){
	onload=enable_text(false);
	document.nprf.SelectTypeRequest.focus();
	document.nprf.Prioritypoint3.focus();
	document.nprf.InputOther.focus(); 
	document.nprf.ChkMCS.focus();
	document.nprf.ChkMTC.focus();
	document.nprf.ChkMCTL.focus();
	document.nprf.ChkMKC.focus();
	document.nprf.ChkMMSB.focus();
	document.nprf.ChkMVC.focus();
	document.nprf.ChkSMC.focus();
	document.nprf.ChkMPC.focus();
	}
	function setFocusAdvertising(){
	onload=enable_textAdvertising(false);
 	document.nprf.Advertising5.focus();
	document.nprf.AdvertisingOther.focus(); 
	
	}
	function setFocusSentTo(){
	document.nprf.SelectSentTo.click(); 
	}
	function enable_text(status)
	{
	status=!status;    
		document.nprf.Purpose1.focus();
		document.nprf.Purpose2.focus();
		document.nprf.Purpose3.focus();
		document.nprf.Purpose4.focus();
		document.nprf.Purpose5.focus();
		document.nprf.Prioritypoint1.focus();
		document.nprf.Prioritypoint2.focus();
		document.nprf.Prioritypoint3.focus();
		document.nprf.InputOther.disabled = status;
		document.nprf.InputOther.value= "";
		document.nprf.InputOther.focus();
	}
	function enable_textAdvertising(status)
	{
	status=!status;    
		document.nprf.Advertising1.focus();
		document.nprf.Advertising2.focus();
		document.nprf.Advertising3.focus();
		document.nprf.Advertising4.focus();
		document.nprf.Advertising5.focus();
		document.nprf.AdvertisingOther.disabled = status;
		document.nprf.AdvertisingOther.value= "";
		document.nprf.AdvertisingOther.focus();
	}
	
	function enable_CountryplannedToSellMCS(status)
	{
	status=!status;    
		document.nprf.ChkMCS.focus();
		document.nprf.InputMCS.disabled = status;
		document.nprf.InputMCS.value= "";
		document.nprf.InputMCS.focus();
	}
	function enable_CountryplannedToSellMTC(status)
	{
	status=!status;    
		document.nprf.ChkMTC.focus();
		document.nprf.InputMTC.disabled = status;
		document.nprf.InputMTC.value= "";
		document.nprf.InputMTC.focus();
	}
	
	function enable_CountryplannedToSellMCTL(status)
	{
	status=!status;    
		document.nprf.ChkMCTL.focus();
		document.nprf.InputMCTL.disabled = status;
		document.nprf.InputMCTL.value= "";
		document.nprf.InputMCTL.focus();
	}
	function enable_CountryplannedToSellMKC(status)
	{
	status=!status;    
		document.nprf.ChkMKC.focus();
		document.nprf.InputMKC.disabled = status;
		document.nprf.InputMKC.value= "";
		document.nprf.InputMKC.focus();
	}
	function enable_CountryplannedToSellMMSB(status)
	{
	status=!status;    
		document.nprf.ChkMMSB.focus();
		document.nprf.InputMMSB.disabled = status;
		document.nprf.InputMMSB.value= "";
		document.nprf.InputMMSB.focus();
	}
	function enable_CountryplannedToSellMVC(status)
	{
	status=!status;    
		document.nprf.ChkMVC.focus();
		document.nprf.InputMVC.disabled = status;
		document.nprf.InputMVC.value= "";
		document.nprf.InputMVC.focus();
	}
	function enable_CountryplannedToSellMPC(status)
	{
	status=!status;    
		document.nprf.ChkMPC.focus();
		document.nprf.InputMPC.disabled = status;
		document.nprf.InputMPC.value= "";
		document.nprf.InputMPC.focus();
	}
	function enable_CountryplannedToSellSMC(status)
	{
	status=!status;    
		document.nprf.ChkSMC.focus();
		document.nprf.InputSMC.disabled = status;
		document.nprf.InputSMC.value= "";
		document.nprf.InputSMC.focus();
	}
	function DisplayShowHideExport()
	{
		if (document.nprf.SelectTypeRequest.value == "Export")
			{document.getElementById("country").style.visibility = 'visible';}
		else
			{document.getElementById("country").style.visibility = 'hidden';} 
	}
</script>
<script type="text/javascript">
		function addRowCountry(tableID) {
			var table = document.getElementById(tableID);

			var rowCount = table.rows.length;
			var row = table.insertRow(rowCount);

			var cell1 = row.insertCell(0);
			var element1 = document.createElement("input");
			element1.type ="checkbox";
			element1.name="chk[]";
			element1.id="chk[]";
			cell1.appendChild(element1);
			var cell2 = row.insertCell(1);
			var array = [<?php
			$div = mysqli_query($con,"SELECT Country FROM tb_trading_partner Where Status<>0 ");
			while($b = mysqli_fetch_array($div)){
			echo  "\"$b[Country]\",";}	?>];
		
			var selectCountry = document.createElement('select');
			selectCountry.setAttribute('class',"form-control");
			selectCountry.setAttribute('title',"Select Country");
			selectCountry.setAttribute('name',"selectCountry[]");
			selectCountry.setAttribute('id',"selectCountry[]");
			cell2.appendChild(selectCountry);
			
			for (var i = 0; i < array.length; i++) {
				var option = document.createElement("option");
				option.value = array[i];
				option.text = array[i];
				selectCountry.appendChild(option);
			}
			
		}

		function deleteRowCountry(tableID) {
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
		function addRow(tableID) {
			var table = document.getElementById(tableID);

			var rowCount = table.rows.length
			
			var addtblnetto ="nprfnetto"+rowCount;
			var row = table.insertRow(rowCount);
	
			var cell1 = row.insertCell(0);
			var element1 = document.createElement("input");
			element1.type ="checkbox";
			element1.name="chkdetail[]";
			element1.id="chkdetail[]";
			cell1.appendChild(element1);
			var tempItemDetail = document.createElement("input");
			tempItemDetail.type ="hidden";
			tempItemDetail.name="tempItemDetail[]";
			tempItemDetail.id="tempItemDetail[]";
			tempItemDetail.value=rowCount;
			cell1.appendChild(tempItemDetail);
			
			var cell2 = row.insertCell(1);
			var MCJItemNo = document.createElement('input');
			MCJItemNo.setAttribute('class',"form-control");
			MCJItemNo.setAttribute('style',"padding:2px 2px 2px 2px");
			MCJItemNo.setAttribute('title',"Input MCJ Item No");
			MCJItemNo.setAttribute('name',"InputMCJItemNo[]");
			MCJItemNo.setAttribute('id',"InputMCJItemNo[]");
			MCJItemNo.setAttribute('ReadOnly',"ReadOnly");
			cell2.appendChild(MCJItemNo);
			
			var cell3 = row.insertCell(2);	
			var finalproductname = document.createElement('textarea');
			finalproductname.setAttribute('class',"form-control");
			finalproductname.setAttribute('style',"padding:2px 2px 2px 2px");
			finalproductname.setAttribute('title',"Input Final Product Name");
			finalproductname.setAttribute('name',"InputNewProduct[]");
			finalproductname.setAttribute('id',"InputNewProduct[]");
			finalproductname.setAttribute('onkeyup',"this.value = this.value.toUpperCase()");
			finalproductname.setAttribute('required',"required[]");
			cell3.appendChild(finalproductname);
			
			var cell4 = row.insertCell(3);
			var array = ["New","Renewal"];
			var InputStatusProduct = document.createElement('select');
			InputStatusProduct.setAttribute('class',"form-control");
			InputStatusProduct.setAttribute('title',"Select Product");
			InputStatusProduct.setAttribute('name',"InputStatusProduct[]");
			InputStatusProduct.setAttribute('id',"InputStatusProduct[]");
			cell4.appendChild(InputStatusProduct);
			
			
			for (var i = 0; i < array.length; i++) {
				var option = document.createElement("option");
				option.value = array[i];
				option.text = array[i];
				InputStatusProduct.appendChild(option);
			}
			
			var cell5 = row.insertCell(4);
			var table = document.createElement('table');
			table.className=addtblnetto; //nprfnetto4
			table.id=addtblnetto; //nprfnetto4
			table.width="100%";
			table.class="table table-striped table-bordered table-hover";
        	table.innerHTML ="<tr><td colspan='3' style='padding:2px 2px 2px 2px'><button type='button' style='padding:0px 0px 0px 0px' class='btn btn-primary' name='btnCreateNetto' onClick=addRowNetto('"+addtblnetto.toString()+"','"+rowCount.toString()+"')><span class='fa fa-plus' title='Add Netto' ></span> </button> <button type='button' style='padding:0px 0px 0px 0px' class='btn btn-primary' id='btnDeleteNetto' name='btnDeleteNetto' onClick=deleteRowNetto('"+addtblnetto.toString()+"','"+rowCount.toString()+"')><span class='glyphicon glyphicon-trash' title='Delete Netto' ></span></button></td></tr>";
        	cell5.appendChild(table);
		

 
			var cell6 = row.insertCell(5);
			var array = [<?php
			$div = mysqli_query($con,"SELECT NamaCurrency FROM tb_currency WHERE Status='1' Group By NamaCurrency  ");
			while($b = mysqli_fetch_array($div)){
			echo  "\"$b[NamaCurrency]\",";}	?>];
		
			var selectMataUang = document.createElement('select');
			selectMataUang.setAttribute('class',"form-control");
			selectMataUang.setAttribute('style',"padding:2px 2px 2px 2px;text-align: right;");
			selectMataUang.setAttribute('title',"Select Mata Uang");
			selectMataUang.setAttribute('name',"selectMataUang[]");
			selectMataUang.setAttribute('id',"selectMataUang[]");
			cell6.appendChild(selectMataUang);
			
			var option = document.createElement("option");
				option.value = '';
				option.text = 'Currency';
				selectMataUang.appendChild(option);
				
			for (var i = 0; i < array.length; i++) {
				var option = document.createElement("option");
				option.value = array[i];
				option.text = array[i];
				selectMataUang.appendChild(option);
			}
			var price = document.createElement('input');
			price.setAttribute('class',"form-control");
			price.setAttribute('style',"padding:2px 2px 2px 2px;text-align: right;");
			price.setAttribute('title',"Input Price Exemple 1.000,25");
			price.setAttribute('name',"InputPrice[]");
			price.setAttribute('id',"InputPrice[]");
			price.setAttribute('onkeyup',"return angka(this);");

			cell6.appendChild(price);

			var cell7 = row.insertCell(6);
			var array = [<?php
			$div = mysqli_query($con,"SELECT NamaCurrency FROM tb_currency WHERE Status='1' Group By NamaCurrency  ");
			while($b = mysqli_fetch_array($div)){
			echo  "\"$b[NamaCurrency]\",";}	?>];
		
			var selectMataUangHPJ = document.createElement('select');
			selectMataUangHPJ.setAttribute('class',"form-control");
			selectMataUangHPJ.setAttribute('style',"padding:2px 2px 2px 2px;text-align: right;");
			selectMataUangHPJ.setAttribute('title',"Select Mata Uang HPJ");
			selectMataUangHPJ.setAttribute('name',"selectMataUangHPJ[]");
			selectMataUangHPJ.setAttribute('id',"selectMataUangHPJ[]");
			cell7.appendChild(selectMataUangHPJ);
			
			var option = document.createElement("option");
				option.value = '';
				option.text = 'Currency';
				selectMataUangHPJ.appendChild(option);
				
			for (var i = 0; i < array.length; i++) {
				var option = document.createElement("option");
				option.value = array[i];
				option.text = array[i];
				selectMataUangHPJ.appendChild(option);
			}
			var InputHPJ = document.createElement('input');
			InputHPJ.setAttribute('class',"form-control");
			InputHPJ.setAttribute('style',"padding:2px 2px 2px 2px;text-align: right;");
			InputHPJ.setAttribute('title',"Input HPJ Exemple 1.000,25");
			InputHPJ.setAttribute('name',"InputHPJ[]");
			InputHPJ.setAttribute('id',"InputHPJ[]");
			InputHPJ.setAttribute('onkeyup',"return angka(this);");

			cell7.appendChild(InputHPJ);	
			
			var cell8 = row.insertCell(7);
			var array = [<?php
			$div = mysqli_query($con,"SELECT NamaCurrency FROM tb_currency WHERE Status='1' Group By NamaCurrency  ");
			while($b = mysqli_fetch_array($div)){
			echo  "\"$b[NamaCurrency]\",";}	?>];
		
			var selectMataUangC_FPrice = document.createElement('select');
			selectMataUangC_FPrice.setAttribute('class',"form-control");
			selectMataUangC_FPrice.setAttribute('style',"padding:2px 2px 2px 2px;text-align: right;");
			selectMataUangC_FPrice.setAttribute('title',"Select Mata Uang HPJ");
			selectMataUangC_FPrice.setAttribute('name',"selectMataUangC_FPrice[]");
			selectMataUangC_FPrice.setAttribute('id',"selectMataUangC_FPrice[]");
			cell8.appendChild(selectMataUangC_FPrice);
			
			var option = document.createElement("option");
				option.value = '';
				option.text = 'Currency';
				selectMataUangC_FPrice.appendChild(option);
				
			for (var i = 0; i < array.length; i++) {
				var option = document.createElement("option");
				option.value = array[i];
				option.text = array[i];
				selectMataUangC_FPrice.appendChild(option);
			}
			var C_FPrice = document.createElement('input');
			C_FPrice.setAttribute('class',"form-control");
			C_FPrice.setAttribute('style',"padding:2px 2px 2px 2px;text-align: right;");
			C_FPrice.setAttribute('title',"Input C&F Price (EXPORT) 1.000,25");
			C_FPrice.setAttribute('name',"InputC_FPrice[]");
			C_FPrice.setAttribute('id',"InputC_FPrice[]");
			C_FPrice.setAttribute('onkeyup',"return angka(this);");
			cell8.appendChild(C_FPrice);	
			
			var cell9 = row.insertCell(8);
			var array = [<?php
			$div = mysqli_query($con,"SELECT NamaCurrency FROM tb_currency WHERE Status='1' Group By NamaCurrency  ");
			while($b = mysqli_fetch_array($div)){
			echo  "\"$b[NamaCurrency]\",";}	?>];
		
			var selectMataUangTargetCOGS = document.createElement('select');
			selectMataUangTargetCOGS.setAttribute('class',"form-control");
			selectMataUangTargetCOGS.setAttribute('style',"padding:2px 2px 2px 2px;text-align: right;");
			selectMataUangTargetCOGS.setAttribute('title',"Select Mata Uang");
			selectMataUangTargetCOGS.setAttribute('name',"selectMataUangTargetCOGS[]");
			selectMataUangTargetCOGS.setAttribute('id',"selectMataUangTargetCOGS[]");
			cell9.appendChild(selectMataUangTargetCOGS);
			
			var option = document.createElement("option");
				option.value = '';
				option.text = 'Currency';
				selectMataUangTargetCOGS.appendChild(option);
			
			for (var i = 0; i < array.length; i++) {
				var option = document.createElement("option");
				option.value = array[i];
				option.text = array[i];
				selectMataUangTargetCOGS.appendChild(option);
			}
			
			var formulasamplecode = document.createElement('input');
			formulasamplecode.setAttribute('class',"form-control");
			formulasamplecode.setAttribute('style',"padding:2px 2px 2px 2px;text-align: right;");
			formulasamplecode.setAttribute('title',"Input COG PRICE Exemple 1.000,25");
			formulasamplecode.setAttribute('name',"InputTargetCOGS[]");
			formulasamplecode.setAttribute('id',"InputTargetCOGS[]");
			formulasamplecode.setAttribute('onkeyup',"return angka(this);");
			cell9.appendChild(formulasamplecode);	
			
		
			var cell10 = row.insertCell(9);
			var PackageOnStone = document.createElement('input');
			PackageOnStone.setAttribute('class',"form-control");
			PackageOnStone.setAttribute('style',"padding:2px 2px 2px 2px;text-align: right;");
			PackageOnStone.setAttribute('title',"Input COGS Exemple 1.000,25");
			PackageOnStone.setAttribute('name',"InputCOGS[]");
			PackageOnStone.setAttribute('id',"InputCOGS[]");
			PackageOnStone.setAttribute('onkeyup',"return angka(this);");
			cell10.appendChild(PackageOnStone);
			
			
			 
			
			var cell11 = row.insertCell(10);
			var array = ['Dzn','Pcs'];
		
			var InputSales3Mth = document.createElement('select');
			InputSales3Mth.setAttribute('class',"form-control");
			 
			InputSales3Mth.setAttribute('title',"Select Initial Introduction");
			InputSales3Mth.setAttribute('name',"InputSales3Mth[]");
			InputSales3Mth.setAttribute('id',"InputSales3Mth[]");
			cell11.appendChild(InputSales3Mth);
			
			
			for (var i = 0; i < array.length; i++) {
				var option = document.createElement("option");
				option.value = array[i];
				option.text = array[i];
				InputSales3Mth.appendChild(option);
			}
			var InputIntroduction = document.createElement('input');
			InputIntroduction.setAttribute('class',"form-control");
			InputIntroduction.setAttribute('style',"padding:2px 2px 2px 2px;text-align: right;");
			InputIntroduction.setAttribute('title',"Input Initial Introduction Exemple 1.000,25");
			InputIntroduction.setAttribute('name',"InputIntroduction[]");
			InputIntroduction.setAttribute('id',"InputIntroduction[]");
			InputIntroduction.setAttribute('onkeyup',"return angka(this);");
			cell11.appendChild(InputIntroduction);		
			
			var cell12 = row.insertCell(11);
			var array = ['Dzn','Pcs'];
		
			var selectSatuanSales1Yr = document.createElement('select');
			selectSatuanSales1Yr.setAttribute('class',"form-control");
			selectSatuanSales1Yr.setAttribute('title',"Select Satuan");
			selectSatuanSales1Yr.setAttribute('name',"selectSatuanSales1Yr[]");
			selectSatuanSales1Yr.setAttribute('id',"selectSatuanSales1Yr[]");
			cell12.appendChild(selectSatuanSales1Yr);
			
			
			for (var i = 0; i < array.length; i++) {
				var option = document.createElement("option");
				option.value = array[i];
				option.text = array[i];
				selectSatuanSales1Yr.appendChild(option);
			}
			
			var InputSales1Yr = document.createElement('input');
			InputSales1Yr.setAttribute('class',"form-control");
			InputSales1Yr.setAttribute('style',"padding:2px 2px 2px 2px;text-align: right;");
			InputSales1Yr.setAttribute('title',"Input Sales 1Yr Exemple 1.000,25");
			InputSales1Yr.setAttribute('name',"InputSales1Yr[]");
			InputSales1Yr.setAttribute('id',"InputSales1Yr[]");
			InputSales1Yr.setAttribute('onkeyup',"return angka(this);");
			cell12.appendChild(InputSales1Yr);		

		}

		function deleteRow(tableID) {
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
		function addRowCompetitor (tableID) {
			var table = document.getElementById(tableID);

			var rowCount = table.rows.length;
			var row = table.insertRow(rowCount);

			var cell1 = row.insertCell(0);
			var element1 = document.createElement("input");
			element1.type ="checkbox";
			element1.name="chkdetailCompetitor[]";
			element1.id="chkdetailCompetitor[]";
			cell1.appendChild(element1);

			var tempCompetitor = document.createElement("input");
			tempCompetitor.type ="hidden";
			tempCompetitor.name="tempCompetitor[]";
			tempCompetitor.id="tempCompetitor[]";
			cell1.appendChild(tempCompetitor);
			
			var cell2 = row.insertCell(1);
			var InputNewProductCompetitor = document.createElement('input');
			InputNewProductCompetitor.setAttribute('class',"form-control");
			InputNewProductCompetitor.setAttribute('style',"padding:2px 2px 2px 2px");
			InputNewProductCompetitor.setAttribute('title',"Input Product Name");
			InputNewProductCompetitor.setAttribute('name',"InputNewProductCompetitor[]");
			InputNewProductCompetitor.setAttribute('id',"InputNewProductCompetitor[]");
			cell2.appendChild(InputNewProductCompetitor);
			
			var cell3 = row.insertCell(2);
			var InputNetCompetitor = document.createElement('input');
			InputNetCompetitor.setAttribute('class',"form-control");
			InputNetCompetitor.setAttribute('style',"padding:2px 2px 2px 2px");
			InputNetCompetitor.setAttribute('title',"Isi Contoh [123]");
			InputNetCompetitor.setAttribute('name',"InputNetCompetitor[]");
			InputNetCompetitor.setAttribute('id',"InputNetCompetitor[]");
			InputNetCompetitor.setAttribute('required',"required[]");
			cell3.appendChild(InputNetCompetitor);

			var array = [<?php
			$div = mysqli_query($con,"SELECT Netto FROM tb_netto Group By Netto ");
			while($b = mysqli_fetch_array($div)){
			echo  "\"$b[Netto]\",";}	?>];
		
			var SelectNettoCompetitor = document.createElement('select');
			SelectNettoCompetitor.setAttribute('class',"form-control");
			SelectNettoCompetitor.setAttribute('style',"padding:2px 2px 2px 2px");
			SelectNettoCompetitor.setAttribute('title',"Select Netto");
			SelectNettoCompetitor.setAttribute('name',"SelectNettoCompetitor[]");
			SelectNettoCompetitor.setAttribute('id',"SelectNettoCompetitor[]");
			cell3.appendChild(SelectNettoCompetitor);
			
			for (var i = 0; i <= array.length; i++) {
				var option = document.createElement("option");
				option.value = array[i];
				option.text = array[i];
				SelectNettoCompetitor.appendChild(option);
			}

			var cell4 = row.insertCell(3);
			var array = [<?php
			$div = mysqli_query($con,"SELECT NamaCurrency FROM tb_currency  WHERE Status='1' Group By NamaCurrency ");
			while($b = mysqli_fetch_array($div)){
			echo  "\"$b[NamaCurrency]\",";}	?>];
		
			var selectMataUangCompetitor = document.createElement('select');
			selectMataUangCompetitor.setAttribute('class',"form-control");
			selectMataUangCompetitor.setAttribute('style',"padding:2px 2px 2px 2px;text-align: right;");
			selectMataUangCompetitor.setAttribute('title',"Select Mata Uang Competitor");
			selectMataUangCompetitor.setAttribute('name',"selectMataUangCompetitor[]");	
			selectMataUangCompetitor.setAttribute('id',"selectMataUangCompetitor[]");
			cell4.appendChild(selectMataUangCompetitor);
			
				option.value = '';
				option.text = 'Currency';
				selectMataUangCompetitor.appendChild(option);
			for (var i = 0; i <= array.length; i++) {
				var option = document.createElement("option");
				option.value = array[i];
				option.text = array[i];
				selectMataUangCompetitor.appendChild(option);
			}
			var InputPriceCompetitor = document.createElement('input');
			InputPriceCompetitor.setAttribute('class',"form-control");
			InputPriceCompetitor.setAttribute('style',"padding:2px 2px 2px 2px;text-align: right;");
			InputPriceCompetitor.setAttribute('type',"text");
			InputPriceCompetitor.setAttribute('title',"Input Price Competitor Exemple 1.000,25");
			InputPriceCompetitor.setAttribute('name',"InputPriceCompetitor[]");
			InputPriceCompetitor.setAttribute('id',"InputPriceCompetitor[]");
			InputPriceCompetitor.setAttribute('onkeyup',"return angka(this);");
			cell4.appendChild(InputPriceCompetitor);	
			
			var cell5 = row.insertCell(4);
 			
			var InputReasonCompetitor = document.createElement('input');
			InputReasonCompetitor.setAttribute('class',"form-control");
			InputReasonCompetitor.setAttribute('style',"padding:2px 2px 2px 2px");
			InputReasonCompetitor.setAttribute('type',"text");
			InputReasonCompetitor.setAttribute('title',"Input Reason");
			InputReasonCompetitor.setAttribute('name',"InputReasonCompetitor[]");
			InputReasonCompetitor.setAttribute('id',"InputReasonCompetitor[]");
			cell5.appendChild(InputReasonCompetitor);	
		}

		function deleteRowCompetitor(tableID) {
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
		function addRowOutlineofSchedule (tableID) {
			var table = document.getElementById(tableID);

			var rowCount = table.rows.length;
			var row = table.insertRow(rowCount);

			var cell1 = row.insertCell(0);
			var element1 = document.createElement("input");
			element1.type ="checkbox";
			element1.name="chkdetailOutlineofSchedule[]";
			element1.id="chkdetailOutlineofSchedule[]";
			cell1.appendChild(element1);

			var tempOutlineofSchedule = document.createElement("input");
			tempOutlineofSchedule.type ="hidden";
			tempOutlineofSchedule.name="tempOutlineofSchedule[]";
			tempOutlineofSchedule.id="tempOutlineofSchedule[]";
			cell1.appendChild(tempOutlineofSchedule);
			
			var cell2 = row.insertCell(1);
			var InputOutlineofSchedule = document.createElement('input');
			InputOutlineofSchedule.setAttribute('class',"form-control");
			InputOutlineofSchedule.setAttribute('style',"padding:2px 2px 2px 2px");
			InputOutlineofSchedule.setAttribute('title',"Input Outline of Schedule");
			InputOutlineofSchedule.setAttribute('name',"InputOutlineofSchedule[]");
			InputOutlineofSchedule.setAttribute('id',"InputOutlineofSchedule[]");
			cell2.appendChild(InputOutlineofSchedule);
			
			var cell3 = row.insertCell(2);
			var array = [<?php
			$div = mysqli_query($con,"SELECT Bulan,Ket FROM tb_bulan ");
			while($b = mysqli_fetch_array($div)){
			echo  "\"$b[Ket]\",";}	?>];
		
			var SelectBulanSchedule = document.createElement('select');
			SelectBulanSchedule.setAttribute('class',"form-control");
			SelectBulanSchedule.setAttribute('style',"padding:2px 2px 2px 2px");
			SelectBulanSchedule.setAttribute('title',"Select Netto");
			SelectBulanSchedule.setAttribute('name',"SelectbulanSchedule[]");
			SelectBulanSchedule.setAttribute('id',"SelectbulanSchedule[]");
			cell3.appendChild(SelectBulanSchedule);
			
			for (var i = 0; i < array.length; i++) {
				var option = document.createElement("option");
				option.value = array[i];
				option.text = array[i];
				SelectBulanSchedule.appendChild(option);
			}

			var arraytahun = [<?php
			
			$mulai= date('Y');
			for($i = $mulai;$i<$mulai + 5;$i++){
			echo  "\"$i\",";}	?>];
		
			var SelectTahunSchedule = document.createElement('select');
			SelectTahunSchedule.setAttribute('class',"form-control");
			SelectTahunSchedule.setAttribute('style',"padding:2px 2px 2px 2px");
			SelectTahunSchedule.setAttribute('title',"Select Netto");
			SelectTahunSchedule.setAttribute('name',"SelectTahunSchedule[]");
			SelectTahunSchedule.setAttribute('id',"SelectTahunSchedule[]");
			cell3.appendChild(SelectTahunSchedule);
			
			for (var i = 0; i < arraytahun.length; i++) {
				var option = document.createElement("option");
				option.value = arraytahun[i];
				option.text = arraytahun[i];
				SelectTahunSchedule.appendChild(option);
			}		
		}

		function deleteRowOutlineofSchedule(tableID) {
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
	function hanyaAngka(evt){
		var charCode = (evt.which) ? evt.which : event.keyCode
		if ((charCode < 48 || charCode > 57)&&charCode>32){
			return false;
		}
		return true;
	}
	
function angka(e) {
  if (!/^[0-9-,-.]+$/.test(e.value)) {
    e.value = e.value.substring(0,e.value.length-100);
  }
}

 

</script>

<?php include "nprf-javascrift.php"; ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Static Navigation - E-Form</title>
        <link href="../css/styles.css" rel="stylesheet" />
		<!-- Bootstrap Core CSS -->
		<link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<script type="text/javascript" src="../ckeditor/ckeditor.js"></script>

	
		<!-- MetisMenu CSS -->
		<link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
	
		<!-- Custom CSS -->
		<link href="../css/sb-admin-2.css" rel="stylesheet">
	
		<!-- Custom Fonts -->
		<link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    </head>
	<script type="text/javascript">
		function popupwindow(url, title, h, w) {
		  var left = (screen.width/2)-(w/2);
		  var top = (screen.height/2)-(h/2);
		  return window.open(url, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, 	copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
		  return false;
		} 
	</script>
	<body onload='setFocus();setFocusSentTo();setFocusAdvertising();' > 
	<main> 
    <div class="container-fluid"> 
      <h3 class="mt-4"><?php if ($button=="add-nprf" || $button=="add-revise-nprf") 
	  	{echo "New Request NPRF";} else  {echo "Edit Request NPRF";} ?> </h3>
	    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="../dist/index.php?button=dashboard">Dashboard</a></li>
		<li class="breadcrumb-item"><a href="../dist/index.php?button=nprf">New Product Review Form D/E (NPRF)</a></li>
        <li class="breadcrumb-item active"><?php if ($button=="add-nprf" || $button=="add-revise-nprf") 
		{echo "New Request NPRF";} else  {echo "Edit Request NPRF";} ?> </li>
      </ol>
 	<div class="card mb-4">
	    <div class="card-header"> </div>

        <div class="card-body"> 
			
        <?php
		include "nprf-autonumber.php";
		$query ="SELECT ID_No,Index_Document,Request_No,Last_Request_No,Thema_Number,Thema_Name,Type_Request,SentTo,
		Purpose_1,Purpose_2,Purpose_3,Purpose_4,Purpose_5,Priority_Point_EmphasisOnPrice,Priority_Point_HighQuality,
		Priority_Point_Other,Priority_Point_OtherEtc,Launching_Date,DATE_FORMAT(Launching_Date, '%m') Bulan,
		DATE_FORMAT(Launching_Date, '%Y') Tahun,Objective_Aim,Goal_Indicator,Market_Situasion,T_Consumer_M,T_Consumer_F,T_Age_GroupStart,
		T_Age_GroupEnd,T_Sosial_Economic_Class,Status_NPRF,Proposed_Concept,Request_for_Content,Request_for_Design,
		Competitor,Distribution,TargetWants,Advertising_1,Advertising_2,Advertising_3,Advertising_4,Advertising_5,Advertising_Other,
		MCS_Chk,MCS,MKC_Chk,MKC,MCTL_Chk,MCTL,MTC_Chk,MTC,MMSB_Chk,MMSB,MVC_Chk,MVC,SMC_Chk,SMC,MPC_Chk,MPC,
		Others,Outline_of_Schedule,Remark,Mcj,Master_Schedule,RemarkafterComplete FROM tb_nprf where Request_No = '".@$_GET['id']."' " ; 	
		if ($button=="add-revise-nprf") {$query.=" And Status_Last_Document='1'";}
		else {$query =$query; }
      	$exe =mysqli_query($con,$query);
        $tampildata=mysqli_fetch_array($exe);
		$Request_No=@$tampildata['Request_No']."-R";
		$rev=@$tampildata['Index_Document']+1;
				//________________________________________________________________________________UPDATE READ INBOX
		mysqli_query($con,"UPDATE tb_inbox SET ReadInbox='1' Where (NameApproval= '$username' Or OnBehalf='$username') 
		And Request_No='".@$_GET['id']."' And ReadInbox='0'");
		
		//________________________________________________________________________________StatusNPRF disabled	 
		if (@$tampildata['Status_NPRF']<>"Draft" & @$tampildata['Status_NPRF']<>"" & $button<>"add-revise-nprf")
		  {$disabled="disabled";} else{$disabled="";}
		if (@$tampildata['Status_NPRF'] <> "Complete By MID" 
			|| $button=="add-revise-nprf" & @$tampildata['Status_NPRF'] <> "Complete By MCJ"  )
		  {$disabledmid="disabled";} else{$disabledmid="";}

		  //________________________________________________________________________________WORKFLOWNPRF
		$exeReq = mysqli_query($con,"Select NameApproval,OnBehalf,Remark_WorkFlow FROM tb_workflownprf 
		WHERE Request_No = '".@$_GET['id']."' And Index_No='1' Order By ID_No Desc  limit 1 ");
		$tampildataReq=mysqli_fetch_array($exeReq);
		//________________________________________________________________________________
        
	  	?>
	<form name="nprf" action="" method="post"  enctype="multipart/form-data"  >
    <?php 
	//Begin CRUD----------------------------------------------------------------------
	$datenow=date("Y-m-d");
	$uploadDirFileMcj	 			= "../img/Mcj/";
	$uploadDirFileMaster_Schedule	= "../img/Master_Schedule/";
	
	if($_POST){
		$ip=$_SERVER['REMOTE_ADDR'];
		$hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);
		date_default_timezone_set("Asia/Jakarta");
		$createddate=date("Y-m-d H:i:s");
		$yymmddhMs=date("YmdHis");
    	$tempFormatNoRequest  	= $_POST['tempFormatNoRequest'];
		$inputAutoRequestNo		= $_POST['inputAutoRequestNo'];
		$inputLastRequestNo		= @$_POST['inputLastRequestNo'];
		$inputThemaNumber	 	= @$_POST['inputThemaNumber']; 
		$inputThemaName 	 	= @$_POST['inputThemaName']; 
		$SelectTypeRequest	 	= @$_POST['SelectTypeRequest'];
		$SelectSentTo			= @$_POST['SelectSentTo'];
		if (!@$_POST['Purpose1']){$valPurpose1=0;} else {$valPurpose1=1;}
		if (!@$_POST['Purpose2']){$valPurpose2=0;} else {$valPurpose2=1;}
		if (!@$_POST['Purpose3']){$valPurpose3=0;} else {$valPurpose3=1;}
		if (!@$_POST['Purpose4']){$valPurpose4=0;} else {$valPurpose4=1;}
		if (!@$_POST['Purpose5']){$valPurpose5=0;} else {$valPurpose5=1;}
		
		if (!@$_POST['Prioritypoint1']){$valPrioritypoint1=0;} else {$valPrioritypoint1=1;}
		if (!@$_POST['Prioritypoint2']){$valPrioritypoint2=0;} else {$valPrioritypoint2=1;}
		if (!@$_POST['Prioritypoint3']){$valPrioritypoint3=0;} else {$valPrioritypoint3=1;}
		if (!@$_POST['Consumer1']){$valConsumer1=0;} else {$valConsumer1=1;}
		if (!@$_POST['Consumer2']){$valConsumer2=0;} else {$valConsumer2=1;}
		
		if (!@$_POST['Advertising1']){$valAdvertising1=0;} else {$valAdvertising1=1;}
		if (!@$_POST['Advertising2']){$valAdvertising2=0;} else {$valAdvertising2=1;}
		if (!@$_POST['Advertising3']){$valAdvertising3=0;} else {$valAdvertising3=1;}
		if (!@$_POST['Advertising4']){$valAdvertising4=0;} else {$valAdvertising4=1;}
		if (!@$_POST['Advertising5']){$valAdvertising5=0;} else {$valAdvertising5=1;}
		$InputOther						= @$_POST['InputOther'];
		$InputMCS						= @$_POST['InputMCS'];
		$InputMKC						= @$_POST['InputMKC'];
		$InputMCTL						= @$_POST['InputMCTL'];
		$InputMTC						= @$_POST['InputMTC'];
		$InputMMSB						= @$_POST['InputMMSB'];
		$InputMVC						= @$_POST['InputMVC'];
		$InputSMC						= @$_POST['InputSMC'];
		$InputMPC						= @$_POST['InputMPC'];
		if (!@$_POST['ChkMCS']){$valMCS=0;} else {$valMCS=1;}
		if (!@$_POST['ChkMKC']){$valMKC=0;} else {$valMKC=1;}
		if (!@$_POST['ChkMCTL']){$valMCTL=0;} else {$valMCTL=1;}
		if (!@$_POST['ChkMTC']){$valMTC=0;} else {$valMTC=1;}
		if (!@$_POST['ChkMMSB']){$valMMSB=0;} else {$valMMSB=1;}
		if (!@$_POST['ChkMVC']){$valMVC=0;} else {$valMVC=1;}
		if (!@$_POST['ChkSMC']){$valSMC=0;} else {$valSMC=1;}
		if (!@$_POST['ChkMPC']){$valMPC=0;} else {$valMPC=1;}
		
		$AdvertisingOther				= @$_POST['AdvertisingOther'];
		$inputObjectiveAim				= @$_POST['inputObjectiveAim'];
		$inputGoalIndicator				= @$_POST['inputGoalIndicator'];
		$inputMarketSituation			= @$_POST['inputMarketSituation'];
		$InputAgeGroupStart				= @$_POST['InputAgeGroupStart'];
		$InputAgeGroupEnd				= @$_POST['InputAgeGroupEnd'];
		$InputOthers					= @$_POST['InputOthers'];
		$InputSocialEconomic			= @$_POST['InputSocialEconomic'];
		$inputRemark					= @$_POST['inputRemark'];
		$inputWorkflowRemark			= @$_POST['inputWorkflowRemark'];
		$Selectbulan					= @$_POST['Selectbulan'];
		$SelectTahun					= @$_POST['SelectTahun'];
		$inputRemarkafterComplete		= @$_POST['inputRemarkafterComplete'];
		$inputProposedconcept			= @$_POST['inputProposedconcept'];
		$inputRequest_for_Content 		= @$_POST['inputRequest_for_Content'];
		$inputRequest_for_Design 		= @$_POST['inputRequest_for_Design'];
		$InputDistribution		 		= @$_POST['InputDistribution'];
		$InputTargetWants				= @$_POST['InputTargetWants'];

		$namaFileMcj  					= @$_FILES['FileMcj']['name'];
		$xFileMcj						= explode('.', $namaFileMcj);
		$ekstensiFileMcj    			= strtolower(end($xFileMcj));
		$ukuranFileMcj					= @$_FILES['FileMcj']['size'];
		$file_tmpFileMcj	 			= @$_FILES['FileMcj']['tmp_name'];			
		$ImagelamaFileMcj				= @$tampildata['Mcj'];
	
		$namaFileMaster_Schedule		= @$_FILES['FileMaster_Schedule']['name'];
		$xFileMaster_Schedule			= explode('.', $namaFileMaster_Schedule);
		$ekstensiFileMaster_Schedule 	= strtolower(end($xFileMaster_Schedule));
		$ukuranFileMaster_Schedule		= @$_FILES['FileMaster_Schedule']['size'];
		$file_tmpFileMaster_Schedule	= @$_FILES['FileMaster_Schedule']['tmp_name'];			
		$ImagelamaFileMaster_Schedule	= @$tampildata['Master_Schedule'];				
		if($Save=="Save"){
			include "nprf-autonumber.php";
			$Tanya = mysqli_query($con,"SELECT Request_No FROM tb_nprf WHERE Request_No = '$inputAutoRequestNo' ");
			if (mysqli_num_rows($Tanya) !=0 ) {  
				echo "<div class='form-group has-error'>
				<label class='control-label' for='inputError'>Error Save : Request No already exists in the database *</label></div>";}
			else{
				//membuat Query untuk menyimpan data
				
				if ($button=="add-nprf")
				{
					include "nprf-autonumber.php";
					include "nprf-save-new.php";
					include "nprf-save-item-detail.php";
				}
				else{
					include "nprf-save-new-revisi.php";
					include "nprf-save-item-detail-revisi.php";


				}
				include "nprf-save-workflow.php";

				$exeReq = mysqli_query($con,"UPDATE tb_workflownprf SET Remark_WorkFlow ='$inputWorkflowRemark' 
				WHERE Request_No ='$inputAutoRequestNo' And Index_No='1' Order By ID_No Desc limit 1");
	
				$message = "Data successfully Save to Draft";
				echo "<script type='text/javascript'>alert('$message');</script>";
				echo"<script>  window.location='../dist/index.php?button=nprf'; </script>";
				}
		}
		elseif($Save=="Update"){ 
			//membuat Query untuk update data
			if ($tampildata['Status_NPRF']=="Complete By MID"){
				include "nprf-save-editmcj.php";
				include "nprf-save-item-detail-mcj.php";
				
			}
			else {
				include "nprf-save-edit.php";
				include "nprf-save-item-detail.php";
				$exeReq = mysqli_query($con,"UPDATE tb_workflowNPRF SET Remark_WorkFlow ='$inputWorkflowRemark' 
				WHERE Request_No = '".@$_GET['id']."' And Index_No='1' Order By ID_No Desc limit 1");
			}
			
			$message = "Data successfully Update to database";
			echo "<script type='text/javascript'>alert('$message');</script>";
			echo"<script>  window.location='../dist/index.php?button=nprf'; </script>";
			}
		elseif($Save=="Cancel"){ 
			include "nprf-save-edit.php";
			mysqli_query($con,"UPDATE tb_nprf SET Status_NPRF='Cancel' WHERE Request_No='$inputAutoRequestNo'");
			mysqli_query($con,"UPDATE tb_inbox SET Request_Status='Cancel' WHERE Request_No='$inputAutoRequestNo'");
			
			$message = "Data successfully Cancel Request";
			echo "<script type='text/javascript'>alert('$message');</script>";
			echo"<script>  window.location='../dist/index.php?button=nprf'; </script>";
			}
			
			
		elseif ($Save=="Revise"){
			//Simpan Status Revise NPRF
			mysqli_query($con,"UPDATE tb_nprf Set Status_NPRF='Revise' WHERE Request_No='$tempFormatNoRequest'");
			//_________________________________________________________________________________________
			$message = "Data successfully Revise";
			echo "<script type='text/javascript'>alert('$message');</script>";
			echo"<script>  window.location='../dist/index.php?button=revise-nprf&id=$tempFormatNoRequest'; </script>";
			 
		}	
		elseif($Send=="Send"){ 
			include "nprf-autonumber.php";
			$Tanya = mysqli_query($con,"SELECT Request_No FROM tb_nprf WHERE Request_No = '$inputAutoRequestNo' ");
			if (mysqli_num_rows($Tanya) !=0 ) {
				//Update Sent NPRF
				include "nprf-save-edit.php";
				include "nprf-save-item-detail.php";

				mysqli_query($con,"UPDATE tb_nprf SET Thema_Number='$inputThemaNumber',Status_NPRF='Sent',
				UpdatedBy='$username',UpdatedDate='$createddate',UpdatedHostName='$ip : $hostname' 
				WHERE Request_No='$inputAutoRequestNo'");
			}
			else{
				//membuat Query untuk menyimpan data
				if ($button=="add-revise-nprf"){
					include "nprf-save-new-revisi.php";
					include "nprf-save-item-detail-revisi.php";
					}
				else{
					include "nprf-autonumber.php";
					include "nprf-save-new.php";
					include "nprf-save-item-detail.php";}
				mysqli_query($con,"UPDATE tb_nprf SET Status_NPRF='Sent' WHERE Request_No='$inputAutoRequestNo'");
				include "nprf-save-workflow.php";
			}
			
			//Update WorkFlow NPRF
			mysqli_query($con,"UPDATE tb_workflownprf SET StatusWorkFlow='S',ReadWorkFlow='1',Remark_WorkFlow='$inputWorkflowRemark',
			Approve='$username',ApproveDate='$createddate',Status_Approval='1' WHERE Request_No='$inputAutoRequestNo' And Index_No='1'");
			
			//Send Email Notification for Approval 2-------------------------------------------------
			$exeNext = mysqli_query($con,"Select NameApproval,OnBehalf FROM tb_workflownprf 
			WHERE Request_No='$inputAutoRequestNo' And Index_No='2' ");
        	$tampildataNext=mysqli_fetch_array($exeNext);
			$app1=$tampildataNext['NameApproval'];
			$app2=$tampildataNext['OnBehalf'];
			$remark=$inputWorkflowRemark;
			$id=$inputAutoRequestNo;
			$WorkFlowMenu="NPRF";

			$Confirm=="Approve";
			require ("../config/emailapp.php");
			
			//Simpan Inbox
			mysqli_query($con,"Insert INTO tb_inbox (Request_No,Request_Date,Thema_Name,Request_Type,Request_Status,
			NameApproval,OnBehalf,ReadInbox,Remark,WorkFlowMenu) values ('$inputAutoRequestNo','$createddate','$inputThemaName','$SelectTypeRequest',
			'W','".$tampildataNext['NameApproval']."','".$tampildataNext['OnBehalf']."','0','$inputWorkflowRemark','NPRF')");
			
			//_________________________________________________________________________________________
			$message = "Data successfully Sent  to Approval";
			echo "<script type='text/javascript'>alert('$message');</script>";
			echo"<script>  window.location='../dist/index.php?button=nprf'; </script>"; 
		}
	}
		//End CRUD----------------------------------------------------------------------
		?>
          <table width="100%" border="0" class="table table-striped" id="dataTables-example" >
            <tr>
              <td width="25%"><span class="form-group">Request No</span></td>
              <td colspan="2"><span class="form-group">
				<input name="tempFormatNoRequest" type="hidden" value="<?php echo $tampildata['Request_No']; ?>">
                <input class="form-control py-4"  name="inputAutoRequestNo" id="inputAutoRequestNo"  maxlength="50" type="text"  
			  placeholder="Auto Request No" readonly="readonly"
			  value="<?php if ($button=="add-nprf") {echo $NomorReq;} elseif ($button=="add-revise-nprf") 
			  {echo substr($tampildata['Request_No'],0,17)."-R".$rev;} else {echo $tampildata['Request_No'];} ?>" />
              </span> </td>
            </tr>
			<tr>
              <td width="25%"><span class="form-group">Last Request No</span></td>
              <td colspan="2"><span class="form-group">
                <input class="form-control py-4"  name="inputLastRequestNo" id="inputLastRequestNo"  maxlength="50" type="text"  
			  placeholder="Last Request No" readonly="readonly" 
			  value="<?php if (@$tampildata['Status_NPRF']=="Complete By MCJ" & $button=="add-revise-nprf") 
			  {echo $tampildata['Request_No'];} else {echo @$tampildata['Last_Request_No'];}?>"/>
              </span> </td>
            </tr>
			<?php if (@$tampildata['Status_NPRF']=="Complete By MID" || @$tampildata['Status_NPRF']=="Complete By MCJ") {?>	
            <tr>
              <td>Thema Number</td>
              <td colspan="2"><span class="form-group">
                <input class="form-control py-4" name="inputThemaNumber"  maxlength="100" type="text" placeholder="Enter Thema Number"  
				value="<?php if ($_POST) { echo $inputThemaNumber; } else {echo $tampildata['Thema_Number'];} ?>"
				<?php echo $disabledmid; ?> />
              </span></td>
            </tr>
			<?php } ?>
            <tr>
              <td><span class="form-group">Thema Name *</span></td>
              <td colspan="2"><span class="form-group">
                <input class="form-control py-4" name="inputThemaName"  maxlength="200" type="text" placeholder="Enter Thema Name"
			   value="<?php if ($_POST) { echo $inputThemaName; } else {echo @$tampildata['Thema_Name'];} ?>" 
			   <?php echo $disabled; ?>/>
              </span></td>
            </tr>
            <tr>
              <td>Request Type *</td>
              <td colspan="2"><select class="form-control" id="SelectTypeRequest" name="SelectTypeRequest"
			  onfocus="DisplayShowHideExport()" onChange="DisplayShowHideExport()" <?php echo $disabled; ?>>
			  <option value="-">Select Request Type </option>
				<option value="Domestic" <?php if ($_POST) {echo $SelectTypeRequest;} elseif (@$tampildata['Type_Request']=='Domestic') {echo "Selected"; }?>>Domestic</option>
            	<option value="Export" <?php if (@$tampildata['Type_Request']=='Export') {echo "Selected";} ?>>Export</option>
              </select>
			  <table name="country" id="country" style="visibility: hidden;" width="100%" border="0">
				  <tr>
					<td colspan="2">Export To 				
					<button type="button" style="padding:0px 0px 0px 0px" class="btn btn-primary" title="Add Country"  
					name="btnCreate" onClick="addRowCountry('country')" <?php echo $disabled; ?>><span class="fa fa-plus" ></span> </button>
					<button type="button" style="padding:0px 0px 0px 0px" class="btn btn-primary" title="Delete Country "  
					id="btnDelete" name="btnDelete" onClick="deleteRowCountry('country')" <?php echo $disabled; ?>><span class="glyphicon glyphicon-trash" ></span></button></td>
				  </tr>
				  <?php
					$exe = mysqli_query($con,"SELECT ID_No,Country,Index_No 
					FROM tb_nprf_country Where Request_No = '".@$tampildata['Request_No']."'   ");
					$no = 1;
					while(@$rowNPRFCountry =mysqli_fetch_array($exe)){
					?>
					<tr>
					<td><input type="checkbox" name="chkdetail[]" id="chkdetail[]" <?php echo $disabled; ?>></td>
					<td><select class="form-control" id="selectCountry[]" name="selectCountry[]" <?php echo $disabled; ?> >
						<option value="-" >Select Country</option>
						<?php
								$div = mysqli_query($con,"SELECT Country FROM tb_trading_partner Where Status<>0 ");
								while($b = mysqli_fetch_array($div)){
									if($rowNPRFCountry['Country'] == $b['Country']){
										$cek = 'Selected';
									}elseif($selectCountry == $b['Country']){
										$cek = 'Selected';
									}else{
										$cek = '';
									}
									echo"<option value='".$b['Country']."' $cek>".$b['Country']."</option>";
								}
							?>
					  </select>
					</td>
					</tr>
					<?php $no++;} ?>
				  </table>
			  </td>
            </tr>
			<tr>
              <td>Sent To *
				<?php if (@$tampildata['Status_NPRF']=="Complete By MCJ"){?>
					<button type="button" style="padding:2px 4px 2px 2px"  
					class="btn btn-outline btn-default" data-toggle='modal' data-target='#add' 
					data-id="Sent To"><span class="glyphicon glyphicon-tag edit_data" title="Remark Sent To "></span></button>
				<?php } ?>	
				</td>
              <td colspan="2"><select class="form-control" id="SelectSentTo" name="SelectSentTo" <?php echo $disabled; ?>
			  onChange="setFocusSentTo(),get_detaildata()" onFocus="setFocusSentTo(),get_detaildata()">
			  <option value="">Select Sent To </option>
				<?php
					$div = mysqli_query($con,"SELECT No_ID,SentTo FROM tb_ms_sent_to  Where Status=1  ");
					while($b = mysqli_fetch_array($div)){
						if($tampildata['SentTo'] == $b['No_ID']){
							$cek = 'Selected';
						}elseif($inputSentTo == $b['No_ID']){
							$cek = 'Selected';
						}else{
							$cek = '';
						}
						echo"<option value='".$b['No_ID']."' $cek>".$b['SentTo']."</option>";
					}
				?>
              </select> 
			  <table name="nprfaddressto" id="nprfaddressto" class="table table-striped table-bordered table-sm" ></table> </td>
            </tr>
			 
            <tr>
              <td height="80" rowspan="2">Purpose *
			  <?php if (@$tampildata['Status_NPRF']=="Complete By MCJ"){?>
				<button type="button" style="padding:2px 4px 2px 2px"  
				class="btn btn-outline btn-default" data-toggle='modal' data-target='#add' 
				data-id="Purpose"><span class="glyphicon glyphicon-tag edit_data" title="Remark Purpose "></span></button>
				<?php } ?>
			  </td>
              <td rowspan="2" >
                <label><input type="checkbox" name="Purpose1" <?php echo $disabled; ?> <?php if (@$tampildata['Purpose_1']==1) { echo 'checked="checked"';} ?>>
				1) Creation of new market by new proposal</label> <br>
                <label><input type="checkbox" name="Purpose2" <?php echo $disabled; ?> <?php if (@$tampildata['Purpose_2']==1) { echo 'checked="checked"';} ?>>
				2) Category entry into growing market or giant market</label><br> 
              	<label><input type="checkbox" name="Purpose3" <?php echo $disabled; ?> <?php if (@$tampildata['Purpose_3']==1) { echo 'checked="checked"';} ?>>
				3) Line extension for the existing product group</label> <br>
			  	<label><input type="checkbox" name="Purpose4" <?php echo $disabled; ?> <?php if (@$tampildata['Purpose_4']==1) { echo 'checked="checked"';} ?>>
				4) Cost reduction of the existing products (production site transfer)</label><br>
			 	<label> <input type="checkbox" name="Purpose5" <?php echo $disabled; ?> <?php if (@$tampildata['Purpose_5']==1) { echo 'checked="checked"';} ?>>
				5) Renewal of existing Products to improve quality</label> <br></td>
              <td width="257" class="alert-light"><div align="center" class="alert-primary">Priority point *</div></td>
            </tr>
            <tr>
              <td height="70">
			  	<label><input type="checkbox" name="Prioritypoint1" <?php echo $disabled; ?> <?php if (@$tampildata['Priority_Point_EmphasisOnPrice']==1) { echo 'checked="checked"';} ?>>
				1) Emphasis on price </label> <br>
			  	<label> <input type="checkbox" name="Prioritypoint2" <?php echo $disabled; ?> <?php if (@$tampildata['Priority_Point_HighQuality']==1) { echo 'checked="checked"';} ?>>
				2) High quality </label> <br>
			  	<label> <input type="checkbox" name="Prioritypoint3" <?php echo $disabled; ?> id="Prioritypoint3"  <?php if (@$tampildata['Priority_Point_Other']==1) { echo 'checked="checked" ';} ?> 
				onClick="enable_text(this.checked)" onFocus="enable_text(this.checked)" >
				3) Other </label> 
				<input name="InputOther"  id="InputOther" size="30" maxlength="50" type="text" placeholder="Enter Other" 
				<?php echo $disabled; ?> value="<?php if ($_POST) { echo $InputOther; } else {echo $tampildata['Priority_Point_OtherEtc'];} ?>" /></td>
            </tr>        
            <tr>
              <td>Launching Date / Shipment Date (for Export Product) *
			  	<?php if (@$tampildata['Status_NPRF']=="Complete By MCJ"){?>
					<button type="button" style="padding:2px 4px 2px 2px"  
					class="btn btn-outline btn-default" data-toggle='modal' data-target='#add' 
					data-id="Launching Date / Shipment Date (for Export Product)">
					<span class="glyphicon glyphicon-tag edit_data" title="Remark Launching Date / Shipment Date (for Export Product) "></span></button>
				<?php } ?>
			  </td>
              <td>

				<div class="form-group d-flex align-items-center justify-content-between mt-0 mb-2">
				<select name="Selectbulan" id="Selectbulan"  title="Bulan" class="form-control" <?php echo $disabled; ?>>
				<option value="">Bulan</option>
				<?php
					$div = mysqli_query($con,"SELECT Bulan,Ket FROM tb_bulan");
					while($b = mysqli_fetch_array($div)){
						if(@$tampildata['Bulan'] == $b['Bulan']){
							$cek = 'Selected';	}
						elseif($Selectbulan == $b['Bulan']){
							$cek = 'Selected';	}
						else{
							$cek = '';	}
					echo"<option value='".$b['Bulan']."' $cek>".$b['Ket']."</option> ";}
				?></select>				
				<select name="SelectTahun" id="SelectTahun" title="Tahun" class="form-control"   <?php echo $disabled; ?>>
					<option value="">Tahun</option>
					<?php 
					$mulai= date('Y');
					for($i = $mulai;$i<$mulai + 5;$i++){?>
					<option value="<?php echo $i; ?>" <?php if (@$tampildata['Tahun']==$i) 
					{echo "Selected";} ?>><?php echo $i; ?></option><?php }	?>
				</select></div> </td>
				<td>Example : Januari 2020</td>
            </tr>
			<tr>
              <td>Objective / Aim *
			  	<?php if (@$tampildata['Status_NPRF']=="Complete By MCJ"){?>
					<button type="button" style="padding:2px 4px 2px 2px"  
					class="btn btn-outline btn-default" data-toggle='modal' data-target='#add' 
					data-id="Objective / Aim">
					<span class="glyphicon glyphicon-tag edit_data" title="Remark Objective / Aim"></span></button>
				<?php } ?>
			  </td>
              <td colspan="2"><textarea class="ckeditor"  id="inputObjectiveAim"  name="inputObjectiveAim" 
				placeholder="Enter Objective / Aim" <?php echo $disabled; ?> ><?php if ($_POST) { echo $inputObjectiveAim; } 
				elseif (@$tampildata['Status_NPRF'] =="" ){caridata2('tb_templete','Isi_Templete','ID_No','1','Status','1');  } else { echo @$tampildata['Objective_Aim'];} ?></textarea></td>
            </tr>
			<tr>
              <td>Goal indicator / When & How to measure 
			  	<?php if (@$tampildata['Status_NPRF']=="Complete By MCJ"){?>
					<button type="button" style="padding:2px 4px 2px 2px"  
					class="btn btn-outline btn-default" data-toggle='modal' data-target='#add' 
					data-id="Goal indicator / When & How to measure">
					<span class="glyphicon glyphicon-tag edit_data" title="Remark Goal indicator / When & How to measure"></span></button>
				<?php } ?>
			  </td>
              <td colspan="2"><textarea  class="ckeditor"  id="inputGoalIndicator"  name="inputGoalIndicator"  
				placeholder="Enter Goal indicator / When & How to measure" 
				<?php echo $disabled; ?> ><?php if ($_POST) { echo $inputGoalIndicator; } 
				elseif (@$tampildata['Status_NPRF'] ==""){caridata2('tb_templete','Isi_Templete','ID_No','2','Status','1');  }else { echo @$tampildata['Goal_Indicator'];}  ?></textarea></td>
            </tr>
            <tr>
              <td height="84">Background
			  	<?php if (@$tampildata['Status_NPRF']=="Complete By MCJ"){?>
				<button type="button" style="padding:2px 4px 2px 2px"  
				class="btn btn-outline btn-default" data-toggle='modal' data-target='#add' 
				data-id="Background">
				<span class="glyphicon glyphicon-tag edit_data" title="Remark Background"></span></button>
				<?php } ?>
			  </td>
              <td colspan="2"><span class="form-group">
                <textarea class="ckeditor" id="inputMarketSituation" name="inputMarketSituation" 
				placeholder="Enter Market Situasion"
				<?php echo $disabled; ?>><?php if ($_POST) { echo $inputMarketSituation; } 
				elseif (@$tampildata['Status_NPRF'] ==""){caridata2('tb_templete','Isi_Templete','ID_No','3','Status','1');  }else { echo @$tampildata['Market_Situasion'];}  ?></textarea>
              </span></td>
            </tr>
            <tr>
              <td rowspan="4" >Target *
			  	<?php if (@$tampildata['Status_NPRF']=="Complete By MCJ"){?>
					<button type="button" style="padding:2px 4px 2px 2px"  
					class="btn btn-outline btn-default" data-toggle='modal' data-target='#add' 
					data-id="Target">
					<span class="glyphicon glyphicon-tag edit_data" title="Remark Target"></span></button>
				<?php } ?>
			  </td>
              <td height="50" colspan="2"> 
				<span class="form-row"> 
				  <span class="col-md-3"> 
					<span class="form-group"> 
					  <label class="small mb-1" for="inputFirstName">Consumer *</label><br>
						<label><input type="checkbox" name="Consumer1" <?php echo $disabled; ?> <?php if (@$tampildata['T_Consumer_M']==1) { echo 'checked="checked"';} ?>></label>
						 Male</label><br>
						<label><input type="checkbox" name="Consumer2" <?php echo $disabled; ?> <?php if (@$tampildata['T_Consumer_F']==1) { echo 'checked="checked"';} ?>></label>
						 Female</label>
					</span>
					</span>
				  <span class="col-md-2.5"> 
					<span class="form-group"> 
					  <label class="small mb-1" for="inputFirstName">Age Group *</label>  
					  <div class="form-group d-flex align-items-center justify-content-between mt-0 mb-2">
					  <select style="padding:2px 2px 2px 2px"class="form-control" 
					  name="InputAgeGroupStart" id="InputAgeGroupStart" title="Age Group Start" 
					   <?php echo $disabled; ?>>
						<option value="">Start</option>
						<?php for ($i=0; $i<=99 ; $i++) {?>
						<option value="<?php echo $i; ?>" <?php if (@$tampildata['T_Age_GroupStart']==$i) 
						{echo "Selected";} ?>><?php echo $i; ?></option><?php }	?>
					  </select> - 
					  <select style="padding:2px 2px 2px 2px" class="form-control" 
					  name="InputAgeGroupEnd" id="InputAgeGroupEnd"  title="Age Group End" 
					  <?php echo $disabled; ?>>
						<option value="">End</option>
						<?php for ($i=0; $i<=99 ; $i++) {?>
						<option value="<?php echo $i; ?>" <?php if (@$tampildata['T_Age_GroupEnd']==$i) 
						{echo "Selected";} ?>><?php echo $i; ?></option><?php }	?>
					  </select>
					  </div>
					</span>				  </span>
				  <span class="col-md-3"> 
					<span class="form-group"> 
					  <label class="small mb-1" for="inputFirstName">Social Economic </label>  
					  <input class="form-control py-4" name="InputSocialEconomic"  maxlength="50" type="text" 
			  			placeholder="Enter Social Economic" title="10-20"<?php echo $disabled; ?>  value="<?php if ($_POST) { echo $InputSocialEconomic; } else {echo @$tampildata['T_Sosial_Economic_Class'];} ?>" />
				</span>	</span>				</span>	</td>
            </tr>
			<tr>
              <td colspan="2"><label class="small mb-1" for="inputFirstName">Target Wants </label>  
        				<textarea name="InputTargetWants" cols="1" maxlength="100"   class="form-control py-2" id="InputTargetWants" 
						placeholder="Enter Target Wants " <?php echo $disabled; ?>
						><?php if ($_POST) { echo $InputTargetWants; } else {echo @$tampildata['TargetWants'];} ?></textarea></td>
            </tr>
            <tr>
              <td colspan="2"><label class="small mb-1" for="inputFirstName">Distribution </label>  
        				<textarea cols="1" maxlength="100"  class="form-control py-2" id="InputDistribution" name="InputDistribution" 
						placeholder="Enter Distribution" <?php echo $disabled; ?>
						><?php if ($_POST) { echo $InputDistribution; } else {echo @$tampildata['Distribution'];} ?></textarea></td>
            </tr>
            <tr>
            <td colspan="2">            

			  <table name="nprfCompetitor" id="nprfCompetitor"  width="100%" border="1" class="table table-striped table-bordered table-hover" >
			   
				  <tr>
					<td colspan="11" align="left">Competitive or reference product(s)
<button type="button" style="padding:0px 0px 0px 0px" class="btn btn-primary" title="Add Competitor"  
					name="btnCreateCompetitor" onClick="addRowCompetitor('nprfCompetitor')" <?php echo $disabled; ?>>
					<span class="fa fa-plus" title="Add Competitor" ></span> </button>
					<button type="button" style="padding:0px 0px 0px 0px" class="btn btn-primary" title="Delete Competitor "  
					id="btnDeleteCompetitor" name="btnDeleteCompetitor" onClick="deleteRowCompetitor('nprfCompetitor')" <?php echo $disabled; ?>>
					<span class="glyphicon glyphicon-trash" title="Delete Competitor" ></span></button>					</td>
				  </tr>
				  <tr valign="bottom" align="center" bgcolor="#999999">
					<th width="1%"></th>
					<th width="20%">Product Name</th>
					<th width="5%">Volume</th>
					<th width="5%">Retail Price</th>
					<th width="20%">Reason (s) Why a competitive product sells well</th>
				  </tr>
					 <?php
					$exe = mysqli_query($con,"SELECT ID_No,New_Product,Isi_Net,Netto,NamaCurrency,Price,
					Reason,Index_No FROM tb_nprf_competitor Where Request_No = '".@$tampildata['Request_No']."'   ");
					$no = 1;
					while(@$rowNPRFCompetitor =mysqli_fetch_array($exe)){
					?>
				  <tr>
					<td><input type="checkbox" name="chkdetail[]" id="chkdetail[]">
				    <input type="hidden" name="tempCompetitor[]" id="tempCompetitor[]"
					value="<?php echo $rowNPRFCompetitor['ID_No']; ?>" ></td>
					<td>
						<textarea cols="4" id="InputNewProductCompetitor[]"  name="InputNewProductCompetitor[]"  
			  class="form-control py-4" placeholder="Enter Product Competitor" 
				<?php echo $disabled; ?>><?php echo $rowNPRFCompetitor['New_Product']; ?></textarea>						</td>
					<td> 
					  <input type="text" name="InputNetCompetitor[]" id="InputNetCompetitor[]" class="form-control"
						style="padding:2px 2px 2px 2px" required value="<?php echo $rowNPRFCompetitor['Isi_Net']; ?>" <?php echo $disabled; ?>>
					<select style="padding:2px 2px 2px 2px" name="SelectNettoCompetitor[]" id="SelectNettoCompetitor[]" 
					 <?php echo $disabled; ?> class="form-control">
					 <?php
						$div = mysqli_query($con,"SELECT Netto,Ket FROM tb_netto");
						while($b = mysqli_fetch_array($div)){
							if(@$rowNPRFCompetitor['Netto'] == $b['Netto']){
								$cek = 'Selected';	}
							elseif($Selectbulan == $b['Netto']){
								$cek = 'Selected';	}
							else{
								$cek = '';	}
						echo"<option value='".$b['Netto']."' $cek>".$b['Netto']."</option> ";}
					?>
				      </select>					  </td>
					<td>
						<select style="padding:2px 2px 2px 2px" name="selectMataUangCompetitor[]" 
						id="selectMataUangCompetitor[]" <?php echo $disabled; ?> class="form-control">
						<option value="">Currency</option>
						 <?php
							$div = mysqli_query($con,"SELECT NamaCurrency FROM tb_currency WHERE Status='1'");
							while($b = mysqli_fetch_array($div)){
								if(@$rowNPRFCompetitor['NamaCurrency'] == $b['NamaCurrency']){
									$cek = 'Selected';	}
								elseif($Selectbulan == $b['NamaCurrency']){
									$cek = 'Selected';	}
								else{
									$cek = '';	}
							echo"<option value='".$b['NamaCurrency']."' $cek>".$b['NamaCurrency']."</option> ";}
						?>
						</select>
						<input type="text" name="InputPriceCompetitor[]" id="InputPriceCompetitor[]" class="form-control"
						style="padding:2px 2px 2px 2px;text-align: right;"onKeyUp="return angka(this);"
						value="<?php echo number_format($rowNPRFCompetitor['Price'], 2, ",", "."); ?>" <?php echo $disabled; ?>></div></td>
					<td>
						<textarea cols="1" id="InputReasonCompetitor[]"  name="InputReasonCompetitor[]"
						style="padding:2px 2px 2px 2px;text-align: left;"onKeyUp="return angka(this);"						
						class="form-control py-1" placeholder="Enter Product Competitor" 
						<?php echo $disabled; ?>><?php echo $rowNPRFCompetitor['Reason']; ?></textarea>
					</td>
				  </tr>
				  <?php $no++;} ?>
			  </table></td>
            </tr>
            <tr>
              <td>Concept plan *
			  	<?php if (@$tampildata['Status_NPRF']=="Complete By MCJ"){?>
					<button type="button" style="padding:2px 4px 2px 2px"  
					class="btn btn-outline btn-default" data-toggle='modal' data-target='#add' 
					data-id="Concept plan">
					<span class="glyphicon glyphicon-tag edit_data" title="Remark Concept plan"></span></button>
				<?php } ?>
			  </td>
              <td colspan="2">			  
			  <span class="form-group"> 
				<textarea class="ckeditor" id="inputProposedconcept" name="inputProposedconcept" placeholder="Enter Proposed Concept" 
				<?php echo $disabled; ?>><?php if ($_POST) { echo $inputProposedconcept; } 
				elseif (@$tampildata['Status_NPRF'] ==""){caridata2('tb_templete','Isi_Templete','ID_No','4','Status','1');  }else { echo @$tampildata['Proposed_Concept'];}  ?></textarea>
        		</span>			   
				</td>
            </tr>
            <tr>
              <td >Request for Content, Production Base, Etc. *
			  	<?php if (@$tampildata['Status_NPRF']=="Complete By MCJ"){?>
					<button type="button" style="padding:2px 4px 2px 2px"  
					class="btn btn-outline btn-default" data-toggle='modal' data-target='#add' 
					data-id="Request for content, production base, etc">
					<span class="glyphicon glyphicon-tag edit_data" title="Request for content, production base, etc"></span></button>
				<?php } ?>
			  </td>
              <td colspan="2"><span class="form-group">
                <textarea class="ckeditor" id="inputRequest_for_Content" name="inputRequest_for_Content" 
				placeholder="Enter Proposed Concept" <?php echo $disabled; ?>><?php if ($_POST) { echo $inputRequest_for_Content; } 
				elseif (@$tampildata['Status_NPRF'] ==""){caridata2('tb_templete','Isi_Templete','ID_No','5','Status','1');  } else { echo @$tampildata['Request_for_Content'];} ?></textarea>
              </span></td>
            </tr>
            <tr>
              <td>Request for Design, Container, Etc. *
			  	<?php if (@$tampildata['Status_NPRF']=="Complete By MCJ"){?>
					<button type="button" style="padding:2px 4px 2px 2px"  
					class="btn btn-outline btn-default" data-toggle='modal' data-target='#add' 
					data-id="Request for design, container, etc.">
					<span class="glyphicon glyphicon-tag edit_data" title="Request for design, container, etc."></span></button>
				<?php } ?>
			  </td>
              <td colspan="2">
                <span class="form-group">
                <textarea class="ckeditor" id="inputRequest_for_Design" name="inputRequest_for_Design" 
				placeholder="Enter Proposed Concept" <?php echo $disabled; ?>><?php if ($_POST) { echo $inputRequest_for_Design; } 
				elseif (@$tampildata['Status_NPRF'] ==""){caridata2('tb_templete','Isi_Templete','ID_No','6','Status','1');} else { echo @$tampildata['Request_for_Design'];} ?></textarea>
              </span></td>
            </tr>
            <tr>
              <td colspan="3" style="padding:2px 2px 2px 2px"><table name="nprfitemdetail" id="nprfitemdetail"  width="100%" border="1" class="table table-striped table-bordered table-hover" >
			   
				  <tr>
					<td colspan="12" align="left">Proposed item(s)
<button type="button" style="padding:0px 0px 0px 0px" class="btn btn-primary" title="Add Item Detail"  
					name="btnCreateFNIM" onClick="addRow('nprfitemdetail')" <?php echo $disabled; ?>>
					<span class="fa fa-plus" title="Add Item Detail" ></span> </button>
					<button type="button" style="padding:0px 0px 0px 0px" class="btn btn-primary" title="Delete Item Detail "  
					id="btnDeleteItemDetail" name="btnDeleteItemDetail" onClick="deleteRow('nprfitemdetail')" <?php echo $disabled; ?>>
					<span class="glyphicon glyphicon-trash" title="Delete Item Detail" ></span></button>					</td>
				  </tr>
				  <tr valign="bottom" align="center" bgcolor="#999999">
					<th width="1%"></th>
					<th width="10%">Item No. (Product Development Department)</th>
					<th width="20%">*Item name (tentative name)</th>
					<th width="7%">Status</th>
					<th width="12%">*Volume</th>
					<th width="10%">Suggested Retail Price(HET)</th>
					<th width="5%">HPJ (Domestic)</th>
					<th width="5%">Requested C&F/CIF/FOB/ Price (EXPORT)</th>
					<th width="8%">COG PRICE</th>
					<th width="5%">COGS(%)</th>
					<th width="8%">Initial Introduction</th>
					<th width="8%">Annual Sales</th>
				  </tr>
				  <?php
					$exe = mysqli_query($con,"SELECT ID_No,MCJ_Item_No,New_Product,Status_Product,NamaCurrency,
					Price,NamaCurrencyHPJ,HPJ,NamaCurrencyC_FPrice,C_FPrice,NamaCurrencyTargetCOGS,Target_COGS,COGS,Sales_3Mth,Introduction,Satuan_Sales1Yr,Sales_1yr,Index_No 
					FROM tb_nprf_Item_detail Where Request_No = '".@$tampildata['Request_No']."'   ");
					$no = 1;
					while(@$rowNPRFDetail =mysqli_fetch_array($exe)){
					?>
				  <tr>
					<td><input type="checkbox" name="chkdetail[]" id="chkdetail[]">
					<input type="hidden" name="tempItemDetail[]" id="tempItemDetail[]"
					value="<?php echo $rowNPRFDetail['ID_No']; ?>" ></td>
					<td style="padding:8px 2px 2px 2px"><input type="text" name="InputMCJItemNo[]" id="InputMCJItemNo[]" class="form-control"
						style="padding:2px 2px 2px 2px" value="<?php echo $rowNPRFDetail['MCJ_Item_No']; ?>" 
						 <?php if (@$tampildata['Status_NPRF']<>"Complete By MID") 
						 {echo "readonly='readonly'";} ?>></td>
					<td style="padding:8px 2px 2px 2px">
					<textarea cols="4" id="InputNewProduct[]"  name="InputNewProduct[]"  
			  class="form-control py-4" placeholder="Enter Product Competitor" 
				<?php echo $disabled; ?>><?php echo $rowNPRFDetail['New_Product']; ?></textarea></td>
					<td style="padding:8px 2px 2px 2px">
						<select style="padding:2px 2px 2px 2px"
						class="form-control"  id="InputStatusProduct[]" name="InputStatusProduct[]"
						 required <?php echo $disabled; ?>>
						<option value="New" <?php if (@$rowNPRFDetail['Status_Product']=='New') {echo "Selected"; }?>>New </option>
            			<option value="Renewal" <?php if (@$rowNPRFDetail['Status_Product']=='Renewal') {echo "Selected";} ?>>Renewal</option>
              			</select>					</td>
					<td style="padding:8px 2px 2px 2px">
					 <table name="<?php echo "nprfnetto".$rowNPRFDetail['ID_No']; ?>" 
					 id="<?php echo "nprfnetto".$rowNPRFDetail['ID_No']; ?>"  
					 width="100%" border="1" class="table table-striped table-bordered table-hover">
				  	 <tr>
						<td colspan="3" align="left" style="padding:2px 2px 2px 2px">
							<button type="button" style="padding:0px 0px 0px 0px" class="btn btn-primary"    
							name="btnCreateNetto"
							onClick="addRowNetto('<?php echo "nprfnetto".$rowNPRFDetail['ID_No']; ?>','<?php echo $rowNPRFDetail['ID_No']; ?>')" 
							<?php echo $disabled; ?>>
							<span class="fa fa-plus" title="Add Netto" ></span> </button>
							<button type="button" style="padding:0px 0px 0px 0px" class="btn btn-primary"   
							id="btnDeleteNetto" name="btnDeleteNetto" 
							onClick="deleteRowNetto('<?php echo "nprfnetto".$rowNPRFDetail['ID_No']; ?>')" <?php echo $disabled; ?>>
							<span class="glyphicon glyphicon-trash" title="Delete Netto" ></span></button>						</td>
				  	</tr>
					<?php
					$exenetto = mysqli_query($con,"SELECT ID_No,ID_No_ItemDetail,Isi_Net,Netto,Index_No 
					FROM tb_nprf_item_detail_netto Where Request_No = '".$tampildata['Request_No']."' And
					ID_No_ItemDetail='".$rowNPRFDetail['ID_No']."'  ");
					while(@$rowNPRFDetailNetto =mysqli_fetch_array($exenetto)){
					?>
				  	<tr>
						<td width="1%" style="padding:7px 2px 2px 2px"><input type="checkbox" 
							name="chkNetto<?php echo $rowNPRFDetailNetto['ID_No_ItemDetail']; ?>[]" 
							id="chkNetto<?php echo $rowNPRFDetailNetto['ID_No_ItemDetail']; ?>[]">
							<input type="hidden" name="tempNetto<?php echo $rowNPRFDetailNetto['ID_No_ItemDetail']; ?>[]" 
							id="tempNetto<?php echo $rowNPRFDetailNetto['ID_No_ItemDetail']; ?>[]"
							value="<?php echo $rowNPRFDetailNetto['ID_No_ItemDetail']; ?>" >						</td>
						<td width="50%" style="padding:4px 2px 2px 2px">
							<input type="text" name="InputNettoDetail<?php echo $rowNPRFDetailNetto['ID_No_ItemDetail']; ?>[]" 
							id="InputNettoDetail<?php echo $rowNPRFDetailNetto['ID_No_ItemDetail']; ?>[]" class="form-control"
							style="padding:2px 2px 2px 2px;text-align:right;" value="<?php echo $rowNPRFDetailNetto['Isi_Net']; ?>" 
							onkeyup="return angka(this);" <?php echo $disabled; ?> required>						</td>
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
						  </select>						</td>
				  	</tr>
				  	<?php $no++;} ?>
				  	</table>					</td>
					<td style="padding:8px 2px 2px 2px">
						<select style="padding:2px 2px 2px 2px" name="selectMataUang[]" 
						id="selectMataUang[]" <?php echo $disabled; ?> class="form-control">
						<option value="">Currency</option>
						 <?php
							$div = mysqli_query($con,"SELECT NamaCurrency FROM tb_currency  Where Status='1'");
							while($b = mysqli_fetch_array($div)){
								if(@$rowNPRFDetail['NamaCurrency'] == $b['NamaCurrency']){
									$cek = 'Selected';	}
								elseif($Selectbulan == $b['NamaCurrency']){
									$cek = 'Selected';	}
								else{
									$cek = '';	}
							echo"<option value='".$b['NamaCurrency']."' $cek>".$b['NamaCurrency']."</option> ";}
						?>
						</select>
						<input type="text" name="InputPrice[]" id="InputPrice[]" class="form-control"
						style="padding:2px 2px 2px 2px;text-align:right;" onKeyUp="return angka(this);"
						
						title="Enter Price Exemple 1.000,25"
						
						value="<?php if ($rowNPRFDetail['Price']==0) {echo "";} else { echo number_format(@$rowNPRFDetail['Price'], 2, ",", ".");} ?>"  
						<?php echo $disabled; ?>></td>
					<td style="padding:8px 2px 2px 2px">
						<select style="padding:2px 2px 2px 2px" name="selectMataUangHPJ[]" 
						id="selectMataUangHPJ[]" <?php echo $disabled; ?> class="form-control">
						<option value="">Currency</option>
						 <?php
							$div = mysqli_query($con,"SELECT NamaCurrency FROM tb_currency  Where Status='1'");
							while($b = mysqli_fetch_array($div)){
								if(@$rowNPRFDetail['NamaCurrencyHPJ'] == $b['NamaCurrency']){
									$cek = 'Selected';	}
								elseif($Selectbulan == $b['NamaCurrency']){
									$cek = 'Selected';	}
								else{
									$cek = '';	}
							echo"<option value='".$b['NamaCurrency']."' $cek>".$b['NamaCurrency']."</option> ";}
						?>
						</select>
						<input type="text" name="InputHPJ[]" id="InputHPJ[]" class="form-control"
						style="padding:2px 2px 2px 2px;text-align:right;" onKeyUp="return angka(this);" 
						title="Enter HPJ Exemple 1.000,25"
						value="<?php if ($rowNPRFDetail['HPJ']==0) {echo "";} else { echo number_format(@$rowNPRFDetail['HPJ'], 2, ",", ".");} ?>"  
						<?php echo $disabled; ?>></td>
					<td style="padding:8px 2px 2px 2px">
						<select style="padding:2px 2px 2px 2px" name="selectMataUangC_FPrice[]" 
						id="selectMataUangC_FPrice[]" <?php echo $disabled; ?> class="form-control">
						<option value="">Currency</option>
						 <?php
							$div = mysqli_query($con,"SELECT NamaCurrency FROM tb_currency  Where Status='1'");
							while($b = mysqli_fetch_array($div)){
								if(@$rowNPRFDetail['NamaCurrencyC_FPrice'] == $b['NamaCurrency']){
									$cek = 'Selected';	}
								elseif($Selectbulan == $b['NamaCurrency']){
									$cek = 'Selected';	}
								else{
									$cek = '';	}
							echo"<option value='".$b['NamaCurrency']."' $cek>".$b['NamaCurrency']."</option> ";}
						?>
						</select>
						<input type="text" name="InputC_FPrice[]" id="InputC_FPrice[]" class="form-control"
						style="padding:2px 2px 2px 2px;text-align:right;" onKeyUp="return angka(this);" 
						title="Enter Requested C&F/CIF/FOB/ Price 1.000,25"
						value="<?php if ($rowNPRFDetail['C_FPrice']==0) {echo "";} else { echo number_format(@$rowNPRFDetail['C_FPrice'], 2, ",", ".");} ?>"  
						<?php echo $disabled; ?>></td>
					<td style="padding:8px 2px 2px 2px;">
						<select style="padding:2px 2px 2px 2px" name="selectMataUangTargetCOGS[]" 
							id="selectMataUangTargetCOGS[]" <?php echo $disabled; ?> class="form-control">
							<option value="">Currency</option>
							 <?php
							$div = mysqli_query($con,"SELECT NamaCurrency FROM tb_currency  Where Status='1'" );
							while($b = mysqli_fetch_array($div)){
								if(@$rowNPRFDetail['NamaCurrencyTargetCOGS'] == $b['NamaCurrency']){
									$cek = 'Selected';	}
								elseif($Selectbulan == $b['NamaCurrency']){
									$cek = 'Selected';	}
								else{
									$cek = '';	}
							echo"<option value='".$b['NamaCurrency']."' $cek>".$b['NamaCurrency']."</option> ";}
						?>
						</select>
						<input type="text" name="InputTargetCOGS[]" id="InputTargetCOGS[]" class="form-control"
						style="padding:2px 2px 2px 2px;text-align:right;" onKeyUp="return angka(this);" 
						title="Enter Target COGS Exemple 1.000,25"
						value="<?php if ($rowNPRFDetail['Target_COGS']==0) {echo "";} else { echo number_format(@$rowNPRFDetail['Target_COGS'], 2, ",", ".");} ?>"
						<?php echo $disabled; ?>></td>
					<td style="padding:8px 2px 2px 2px;">
						<input type="text" name="InputCOGS[]" id="InputCOGS[]" class="form-control"
						style="padding:2px 2px 2px 2px;text-align:right;" onKeyUp="return angka(this);"
						title="Enter COGS Exemple 1.000,25"
						value="<?php if ($rowNPRFDetail['COGS']==0) {echo "";} else { echo number_format(@$rowNPRFDetail['COGS'], 2, ",", ".");} ?>"
						<?php echo $disabled; ?>></td>
					<td style="padding:8px 2px 2px 2px;">				
						<select style="padding:2px 2px 2px 2px" class="form-control" id="InputSales3Mth[]" name="InputSales3Mth[]" required <?php echo $disabled; ?>>
							<option value="Dzn" <?php if (@$rowNPRFDetail['Sales_3Mth']=='Dzn') {echo "Selected"; }?>>Dzn</option>
							<option value="Pcs" <?php if (@$rowNPRFDetail['Sales_3Mth']=='Pcs') {echo "Selected";} ?>>Pcs </option>
 						</select>
						<input type="text" name="InputIntroduction[]" id="InputIntroduction[]" class="form-control"
						style="padding:2px 2px 2px 2px;text-align:right;" onKeyUp="return angka(this);"
						title="Enter InputIntroduction Exemple 1.000,25"
						value="<?php if ($rowNPRFDetail['Introduction']==0) {echo "";} else { echo number_format(@$rowNPRFDetail['Introduction'], 2, ",", ".");} ?>"
						<?php echo $disabled; ?>>
					</td>
					<td style="padding:8px 2px 2px 2px;">
						<select style="padding:2px 2px 2px 2px" class="form-control" id="selectSatuanSales1Yr[]" name="selectSatuanSales1Yr[]" required <?php echo $disabled; ?>>
							<option value="Dzn" <?php if (@$rowNPRFDetail['Satuan_Sales1Yr']=='Dzn') {echo "Selected"; }?>>Dzn</option>
							<option value="Pcs" <?php if (@$rowNPRFDetail['Satuan_Sales1Yr']=='Pcs') {echo "Selected";} ?>>Pcs </option>
 						</select>
						<input type="text" name="InputSales1Yr[]" id="InputSales1Yr[]" class="form-control"
						style="padding:2px 2px 2px 2px;text-align:right;"onkeyup="return angka(this);"
						title="Enter Sales (1 Yrs)(pcs) Exemple 1.000,25"
						value="<?php if ($rowNPRFDetail['Sales_1yr']==0) {echo "";} else { echo number_format(@$rowNPRFDetail['Sales_1yr'], 2, ",", ".");} ?>"
						<?php echo $disabled; ?>>
					</td>
				  </tr>
				  <?php $no++;} ?>
				  </table>			  </td>
            </tr>

            <tr>
              <td>Advertising & Promotion</td>
              <td colspan="2"> 
			  	<label><input type="checkbox" name="Advertising1" <?php echo $disabled; ?> <?php if (@$tampildata['Advertising_1']==1) { echo 'checked="checked"';} ?>>
				By using a combination of Advertising & Promotion</label> <br>  
                <label><input type="checkbox" name="Advertising2" <?php echo $disabled; ?> <?php if (@$tampildata['Advertising_2']==1) { echo 'checked="checked"';} ?>>
				Making it a regular item by listing</label><br> 
				<label><input type="checkbox" name="Advertising3" <?php echo $disabled; ?> <?php if (@$tampildata['Advertising_3']==1) { echo 'checked="checked"';} ?>>
				By doing only Promotion (no Advertising)</label> <br>

 
			  	<label><input type="checkbox" name="Advertising4" <?php echo $disabled; ?> <?php if (@$tampildata['Advertising_4']==1) { echo 'checked="checked"';} ?>>
				By avoiding listing fees as much as possible</label><br>
			 	<label> <input type="checkbox" name="Advertising5" <?php echo $disabled; ?> id="Advertising5"  <?php if (@$tampildata['Advertising_5']==1) { echo 'checked="checked" ';} ?> 
				onClick="enable_textAdvertising(this.checked)" onFocus="enable_textAdvertising(this.checked)" >
				Other </label> 
				<input name="AdvertisingOther"  id="AdvertisingOther" size="30" maxlength="50" type="text" placeholder="Enter Other" 
				<?php echo $disabled; ?> value="<?php if ($_POST) { echo $AdvertisingOther; } else {echo @$tampildata['Advertising_Other'];} ?>">
				</td>
            </tr>
			<tr>
              <td>Country planned to sell </td>
              <td colspan="2">
			  	<table>
					<tr>
						<td>
							<label><input type="checkbox" name="ChkMCS" id="ChkMCS" <?php echo $disabled; ?>
							<?php if (@$tampildata['MCS_Chk']==1) { echo 'checked="checked"';} ?>
							onClick="enable_CountryplannedToSellMCS(this.checked)" > MCS</label>
							<input name="InputMCS"  class="form-control py-4" id="InputMCS" size="25" maxlength="50"
							type="text" placeholder="Enter MCS" <?php echo $disabled; ?> 
							value="<?php if ($_POST) { echo $InputMCS; } else {echo @$tampildata['MCS'];} ?>"> 
						</td>
						<td>
							<label><input type="checkbox" name="ChkMKC" id="ChkMKC" <?php echo $disabled; ?>
							<?php if (@$tampildata['MKC_Chk']==1) { echo 'checked="checked"';} ?> 
							onClick="enable_CountryplannedToSellMKC(this.checked)" > MKC</label>
							<input name="InputMKC"  class="form-control py-4"id="InputMKC" size="25" maxlength="50" 
							type="text" placeholder="Enter MKC" <?php echo $disabled; ?> 
							value="<?php if ($_POST) { echo $InputMKC; } else {echo @$tampildata['MKC'];} ?>"> 
						</td>
						
						<td>
							<label><input type="checkbox" name="ChkMCTL" id="ChkMCTL" <?php echo $disabled; ?>
							<?php if (@$tampildata['MCTL_Chk']==1) { echo 'checked="checked"';} ?>
							onClick="enable_CountryplannedToSellMCTL(this.checked)" > MCTL</label>
							<input name="InputMCTL"  class="form-control py-4" id="InputMCTL" size="25" maxlength="50" 
							type="text" placeholder="Enter MCTL" <?php echo $disabled; ?> 
							value="<?php if ($_POST) { echo $InputMCTL; } else {echo @$tampildata['MCTL'];} ?>"> 
						</td>
					</tr>
					<tr>
						<td>
							<label><input type="checkbox" name="ChkMTC" id="ChkMTC" <?php echo $disabled; ?>
							<?php if (@$tampildata['MTC_Chk']==1) { echo 'checked="checked"';} ?>
							onClick="enable_CountryplannedToSellMTC(this.checked)" > MTC </label>
							<input name="InputMTC" class="form-control py-4"  id="InputMTC" size="25" maxlength="50" 
							type="text" placeholder="Enter MTC" <?php echo $disabled; ?> 
							value="<?php if ($_POST) { echo $InputMTC; } else {echo @$tampildata['MTC'];} ?>"> 
						</td>
						<td>
							<label><input type="checkbox" name="ChkMMSB" id="ChkMMSB" <?php echo $disabled; ?>
							<?php if (@$tampildata['MMSB_Chk']==1) { echo 'checked="checked"';} ?>
							onClick="enable_CountryplannedToSellMMSB(this.checked)" > MMSB</label>
							<input name="InputMMSB" class="form-control py-4" id="InputMMSB" size="25" maxlength="50" 
							type="text" placeholder="Enter MMSB" <?php echo $disabled; ?> 
							value="<?php if ($_POST) { echo $InputMMSB; } else {echo @$tampildata['MMSB'];} ?>"> 
						</td>
						<td>
							<label><input type="checkbox" name="ChkMVC" id="ChkMVC" <?php echo $disabled; ?>
							<?php if (@$tampildata['MVC_Chk']==1) { echo 'checked="checked"';} ?>
							onClick="enable_CountryplannedToSellMVC(this.checked)" > MVC </label>
							<input name="InputMVC"  class="form-control py-4" id="InputMVC" size="25" maxlength="50" 
							type="text" placeholder="Enter MVC" <?php echo $disabled; ?> 
							value="<?php if ($_POST) { echo $InputMVC; } else {echo @$tampildata['MVC'];} ?>"> 
						</td>
					</tr>
					<tr>
						<td>
							<label><input type="checkbox" name="ChkSMC" id="ChkSMC" <?php echo $disabled; ?>
							<?php if (@$tampildata['SMC_Chk']==1) { echo 'checked="checked"';} ?>
							onClick="enable_CountryplannedToSellSMC(this.checked)" > SMC</label>
							<input name="InputSMC" class="form-control py-4" id="InputSMC" size="25" maxlength="50" 
							type="text" placeholder="Enter SMC" <?php echo $disabled; ?> 
							value="<?php if ($_POST) { echo $InputSMC; } else {echo @$tampildata['SMC'];} ?>"> 
						</td>
						<td>
							<label><input type="checkbox" name="ChkMPC" id="ChkMPC" <?php echo $disabled; ?>
							<?php if (@$tampildata['MPC_Chk']==1) { echo 'checked="checked"';} ?>
							onClick="enable_CountryplannedToSellMPC(this.checked)" > MPC </label>
							<input name="InputMPC" class="form-control py-4" id="InputMPC" size="25" maxlength="50" 
							type="text" placeholder="Enter MPC" <?php echo $disabled; ?> 
							value="<?php if ($_POST) { echo $InputMPC; } else {echo @$tampildata['MPC'];} ?>"> 
						</td>
						<td>
							 
						</td>
					</tr>
				</table>
			  　</td>
            </tr>
			<tr>
              <td>Remarks / Reason(s) for change/revision</td>
              <td colspan="2"><span class="form-group"> 
        <textarea cols="2" class="form-control py-2" id="InputOthers" name="InputOthers" 
				placeholder="Enter Remarks / Reason(s) for change/revision" 
				<?php echo $disabled; ?>><?php if ($_POST) { echo $InputOthers; } else {echo @$tampildata['Others'];} ?></textarea>
			  </span></td>
            </tr>
			 <tr>
			    <td colspan="3">
				 <table name="nprfCompetitor" id="nprfOutlineofSchedule"  width="100%" border="1" class="table table-striped table-bordered table-hover" >
				  <tr>
					<td colspan="11" align="left">Outline of Schedule
					<button type="button" style="padding:0px 0px 0px 0px" class="btn btn-primary" title="Add Outline of Schedule"  
					name="btnCreateOutlineofSchedule" onClick="addRowOutlineofSchedule('nprfOutlineofSchedule')" <?php echo $disabled; ?>>
					<span class="fa fa-plus" title="Add Outline of Schedule" ></span> </button>
					<button type="button" style="padding:0px 0px 0px 0px" class="btn btn-primary" title="Delete Outline of Schedule "  
					id="btnOutlineofSchedule" name="btnOutlineofSchedule" onClick="deleteRowCompetitor('nprfOutlineofSchedule')" <?php echo $disabled; ?>>
					<span class="glyphicon glyphicon-trash" title="Delete Outline of Schedule" ></span></button>					</td>
				  </tr>
				  <tr valign="bottom" align="center" bgcolor="#999999">
					<th width="1%"></th>
					<th width="20%">Outline of Schedule</th>
					<th width="5%">Date</th>
				  </tr>
 
					 <?php
					$exe = mysqli_query($con,"SELECT ID_No,Keterangan,Bulan,Tahun,Index_No 
					FROM tb_nprf_outlineofschedule Where Request_No = '".@$tampildata['Request_No']."'   ");
					$no = 1;
					while(@$rowNPRFOutlineofschedule =mysqli_fetch_array($exe)){
					?>
				  <tr>
					<td><input type="checkbox" name="chkdetail[]" id="chkdetail[]">
					<input type="hidden" name="tempOutlineofSchedule[]" id="tempOutlineofSchedule[]"
					value="<?php echo $rowNPRFOutlineofschedule['ID_No']; ?>" ></td>
					<td><input type="text" name="InputOutlineofSchedule[]" id="InputOutlineofSchedule[]" class="form-control"
						style="padding:2px 2px 2px 2px" onKeyUp="this.value = this.value.toUpperCase()"
						value="<?php echo $rowNPRFOutlineofschedule['Keterangan']; ?>" required <?php echo $disabled; ?>></td>
					<td>
					<div class="form-group d-flex align-items-center justify-content-between mt-0 mb-2">
						<select name="SelectbulanSchedule[]" id="SelectbulanSchedule[]" class="form-control" <?php echo $disabled; ?>>
						<?php
							$div = mysqli_query($con,"SELECT Ket FROM tb_bulan");
							while($b = mysqli_fetch_array($div)){
								if(@$rowNPRFOutlineofschedule['Bulan'] == $b['Ket']){
									$cek = 'Selected';	}
								else{
									$cek = '';	}
							echo"<option value='".$b['Ket']."' $cek>".$b['Ket']."</option> ";}
						?></select>				
						<select name="SelectTahunSchedule[]" id="SelectTahunSchedule[]" title="Tahun" class="form-control" <?php echo $disabled; ?>>
							<option value="">Tahun</option>
							<?php 
							$mulai= date('Y');
							for($i = $mulai;$i<$mulai + 5;$i++){?>
							<option value="<?php echo $i; ?>" <?php if (@$rowNPRFOutlineofschedule['Tahun']==$i) 
							{echo "Selected";} ?>><?php echo $i; ?></option><?php }	?>
						</select></div>					</td>
				  </tr>
				  <?php $no++;} ?>
				  </table>			  
				</td>
            </tr>
            <tr>
              <td>Remark *</td>
              <td colspan="2"><div class="form-group"> <textarea cols="4" id="inputRemark" name="inputRemark"  class="form-control py-4" 
				placeholder="Enter Remark" <?php echo $disabled; ?>><?php if ($_POST) { echo $inputRemark; } else {echo @$tampildata['Remark'];} ?></textarea></div>			  </td>
            </tr>
			<?php if (@$tampildata['Status_NPRF']<>"Complete By MID") {?>	
			<tr>
              <td>Workflow Remark *</td>
              <td colspan="2"><div class="form-group"> <textarea cols="4" id="inputWorkflowRemark"  name="inputWorkflowRemark"  
			  class="form-control py-4" placeholder="Workflow Remark" 
				<?php echo $disabled; ?>><?php echo @$tampildataReq['Remark_WorkFlow']; ?></textarea></div>			  </td>
            </tr>
			<?php ;}?>
			<tr>
              <td colspan="3"></td>
            </tr>
			 <?php if (@$tampildata['Status_NPRF']=="Complete By MID" || (@$tampildata['Status_NPRF']=="Complete By MCJ"
			 && $button=="add-nprf") || (@$tampildata['Status_NPRF']=="Complete By MCJ" && $button=="edit-nprf")) {?>		
			<tr>
              <td>MCJ File *</td>
              <td><input class="form" id="FileMcj" name="FileMcj"  type="file" accept="application/pdf"
			   <?php if (@$tampildata['Status_NPRF']=="Complete By MCJ" || $tampildata['Status_NPRF']<>"Complete By MID")  {echo $disabled;} ?> onChange="return validasiFileMsj()"/></td>
			  <td><div id="PdfFileMcj"></div>
			 
			  <?php if (!empty($tampildata['Mcj'])){?>
			  	<img height="20" width="20" src=../img/pdf.png  title="Preview Pdf <?php echo $tampildata['Mcj'];?>"
				onClick="popupwindow('../config/open-pdf.php?folder=<?php echo $uploadDirFileMcj; ?>&pdfname=mcj&kd=<?php echo $tampildata['Request_No']; ?>&page=nprf','Preview Pdf','700','1000');">
			  <?php }  ?>			  </td>
            </tr>
			<tr>
              <td>Master Schedule</td>
              <td><input class="form" id="FileMaster_Schedule" name="FileMaster_Schedule"  type="file" accept="application/pdf" 
			  <?php if (@$tampildata['Status_NPRF']=="Complete By MCJ" || $tampildata['Status_NPRF']<>"Complete By MID")  {echo $disabled;} ?> onChange="return validasiFileMaster_Schedule()"/></td>
			  <td><div id="PdfFileMaster_Schedule"></div>
			 
			  <?php if (!empty($tampildata['Master_Schedule'])){?>
			  	<img height="20" width="20" src=../img/pdf.png  title="Preview Pdf <?php echo $tampildata['Master_Schedule'];?>"
				onClick="popupwindow('../config/open-pdf.php?folder=<?php echo $uploadDirFileMaster_Schedule; ?>&pdfname=Master_Schedule&kd=<?php echo $tampildata['Request_No']; ?>&page=nprf','Preview Pdf','700','1000');">
			  <?php }  ?>			  </td>
            </tr>
			<tr>
              <td>Remark after Complete *</td>
              <td colspan="2"><div class="form-group"> <textarea cols="4" id="inputRemarkafterComplete"  name="inputRemarkafterComplete"  class="form-control py-4" 
				placeholder="Enter Remark after Complete"
				<?php if (@$tampildata['Status_NPRF']=="Complete By MCJ" || $tampildata['Status_NPRF']<>"Complete By MID")  {echo $disabled;} ?> ><?php if ($_POST) { echo $inputRemarkafterComplete; } else {echo $tampildata['RemarkafterComplete'];} ?></textarea></div>			  </td>
            </tr>
			<?php ;}?>
			</fieldset>
          </table>
		  <button type="submit" name="Send" value="Send"  onClick="return checkSendApproval(nprf)" 
		  class="btn btn-primary" 
		  <?php if (@$tampildata['Status_NPRF']<>"Complete By MID")  
		  {echo $disabled;} else {echo "disabled='disabled'";} ?>>Send Approval</button>
		  <?php if (@$tampildata['Status_NPRF']<>"Cancel")  {?>
		  <button type="submit" name="Save" value="<?php if ($button=="add-nprf" || $button=="add-revise-nprf") {echo"Save";} else {echo"Update";}  ?>"
		  <?php if ($button=="add-nprf") {echo 'onclick="return checkDraft()"';} else  {echo 'onclick="return checkEdit(nprf)"';} ?>  
		  class="btn btn-primary" 
		  <?php if (@$tampildata['Status_NPRF']=="Complete By MCJ" || @$tampildata['Status_NPRF']<>"Complete By MID")  {echo $disabled;} ?>>
		  <?php if (@$tampildata['Status_NPRF']<>"Complete By MID")  {echo "Draft";} else {echo "Update";} ?> </button>
		  <?php ;} ?>
		  <?php if (@$tampildata['Status_NPRF']=="Complete By MID")  {?>
		  <button type="submit" name="Save" value="Revise" onClick="return checkRevise()" 
		  class="btn btn-primary">Revise</button>
	      <?php ;} ?>
		  <?php if (@$tampildata['Status_NPRF']=="Complete By MID"|| @$tampildata['Status_NPRF']=="Revise")  {?>
		  <button type="submit" name="Save" value="Cancel" onClick="return checkCancel()" 
		  class="btn btn-primary">Cancel Request</button>
	      <?php ;} ?>
		  
		  <a class="btn btn-primary" href="../dist/index.php?button=nprf" title="Back Format No Request">Back</a> 
	  </form>
	  </div>
      </div>
	 </div>
    </main> 
    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="../vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="../vendor/datatables-responsive/dataTables.responsive.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../js/sb-admin-2.js"></script>
	
	    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
	$("#datepicker").datepicker( {
   format: 'MM yyyy',
                viewMode: "months",
                minViewMode: "months",
                autoClose: true
	});

    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
    </script>
	<script language="JavaScript" type="text/javascript">
	function checkSendApproval(form){
  
  	var ObjectiveAim = CKEDITOR.instances.inputObjectiveAim.getData().replace(/<[^>]*>/gi, '').length;
    var Proposedconcept = CKEDITOR.instances.inputProposedconcept.getData().replace(/<[^>]*>/gi, '').length; 
	var Request_for_Content = CKEDITOR.instances.inputRequest_for_Content.getData().replace(/<[^>]*>/gi, '').length; 
	var Request_for_Design	 = CKEDITOR.instances.inputRequest_for_Design.getData().replace(/<[^>]*>/gi, '').length;
	var rowProposedItem = document.getElementById('nprfitemdetail').rows.length; 

	if (form.inputAutoRequestNo.value == ""){
    	alert("Request No masih kosong!");
    	form.inputAutoRequestNo.focus();
    	return (false);  		}
	else if (form.inputThemaName.value == ""){
    	alert("Thema Name masih kosong!" );
    	form.inputThemaName.focus();
    	return (false);  		}
	else if (form.SelectTypeRequest.value == "-"){
    	alert("Request Type masih kosong!");
    	form.SelectTypeRequest.focus();
    	return (false);  		}
	else if (form.SelectSentTo.value == ""){
    	alert("Sent To masih kosong!");
    	form.SelectSentTo.focus();
    	return (false);  		}
	else if(form.Purpose1.checked==false && form.Purpose2.checked==false && form.Purpose3.checked==false && form.Purpose4.checked==false && form.Purpose5.checked==false){
		alert('silahkan pilih salah satu Purpose');
		return (false);  		}
	else if(form.Prioritypoint1.checked==false && form.Prioritypoint2.checked==false && form.Prioritypoint3.checked==false){
		alert('silahkan pilih salah satu Priority point');
		form.Prioritypoint1.focus();
    	return (false);  		}
	else if(form.Selectbulan.value==""||form.Selectbulan.value=="-"){
		alert("Bulan Launching Date masih kosong!");
		form.Selectbulan.focus();
    	return (false);  		}
	else if(form.SelectTahun.value==""||form.SelectTahun.value=="-"){
		alert("Tahun Launching Date masih kosong!");
		form.SelectTahun.focus();
    	return (false);  		}
		
	else if(!ObjectiveAim) {
        alert('Objective / Aim masih kosong');
		return (false);  		}
		
	else if(form.inputMarketSituation.value==""){
		alert('Market Situation masih kosong');
		form.inputMarketSituation.focus();
    	return (false);  		}
	else if(form.Selectbulan.value==""||form.Selectbulan.value=="-"){
		alert("Bulan Launching Date masih kosong!");
		form.Selectbulan.focus();
    	return (false);  		}
	else if(form.SelectTahun.value==""||form.SelectTahun.value=="-"){
		alert("Tahun Launching Date masih kosong!");
		form.SelectTahun.focus();
    	return (false);  		}
	else if(form.Consumer1.checked==false && form.Consumer2.checked==false){
		alert('please choose one of Consumer');
		form.Consumer1.focus();
    	return (false);  		}
	else if(form.InputAgeGroupStart.value ==""){
		alert("Age Group Start masih kosong!");
		form.InputAgeGroupStart.focus();
    	return (false);  		}
	else if(form.InputAgeGroupEnd.value ==""){
		alert("Age Group End masih kosong!");
		form.InputAgeGroupEnd.focus();
    	return (false);  		}
	else if(form.InputAgeGroupStart.value!="" && form.InputAgeGroupEnd.value!=""){
		 if(parseFloat(form.InputAgeGroupStart.value) > parseFloat(form.InputAgeGroupEnd.value)){
		 alert("Age Group Start tidak boleh Besar dari  Age Group End !");
			form.InputAgeGroupStart.focus();
			return (false);  	}	
		 else if( !Proposedconcept ) {
			alert('Concept plan masih kosong');
			return (false);  		}
		else if( !Request_for_Content ) {
			alert('Request for Content, Production Base, Etc masih kosong');
			return (false);  		}
		else if( !Request_for_Design ) {
			alert('Request for Design, Container, Etc. masih kosong');
			return (false);  		}			
		else if(rowProposedItem <=2  ) {
			alert('Proposed Item Item masih kosong');
			return (false);  		}			
					
		else if (form.inputRemark.value == ""){
			alert("Remark masih kosong!");
			form.inputRemark.focus();
			return (false);  		}
		else if (form.inputWorkflowRemark.value == ""){
			alert("Work flow Remark masih kosong!");
			form.inputWorkflowRemark.focus();
			return (false);  		}
			return confirm('Are you sure you want to Send Approval?'); }
			
	 else if( !Proposedconcept ) {
		alert('Concept plan masih kosong!');
		return (false);  		}
	else if( !Request_for_Content ) {
		alert('Request for Content, Production Base, Etc masih kosong!');
		return (false);  		}
	else if( !Request_for_Design ) {
		alert('Request for Design, Container, Etc. masih kosong');
		return (false);  		}
	else if(rowProposedItem <=2 ) {
		alert('Proposed Item Item masih kosong');
		return (false);  		}
	else if (form.inputRemark.value == ""){
    	alert("Remark masih kosong!");
    	form.inputRemark.focus();
    	return (false);  		}
	else if (form.inputWorkflowRemark.value == ""){
    	alert("Work flow Remark masih kosong!");
    	form.inputWorkflowRemark.focus();
    	return (false);  		}
		return confirm('Are you sure you want to Send Approval?');
	}
	
	
	function checkDraft(){
		return confirm('Are you sure you want to Save Draft this data?');
	}	
	function checkCancel(){
		return confirm('Are you sure you want to Cancel Request this data?');
	}
	function checkRevise(form){
		return confirm('Are you sure you want to Revise Request this data?');
	}
	</script>
	<?php if (@$tampildata['Status_NPRF']=="Complete By MID"){ ?>
	<script language="JavaScript" type="text/javascript">
	function checkEdit(form){
	if (form.inputThemaNumber.value == ""){
    	alert("Thema Number Can not be empty *");
    	form.inputThemaNumber.focus();
    	return (false);  		}
	else if (form.FileMcj.value == ""){
    	alert("MCJ File Can not be empty *");
    	form.FileMcj.focus();
    	return (false);  		}
	else if (form.inputRemarkafterComplete.value == ""){
    	alert("Remark after Complete No Can not be empty *");
    	form.inputRemarkafterComplete.focus();
    	return (false);  		}
		return confirm('Are you sure you want to Update Draft this data?');
	}
	</script>

	<?php ;} else {?>
	<script language="JavaScript" type="text/javascript">
	function checkEdit(form){
		return confirm('Are you sure you want to Update this data?');
	}
	function checCancel(form){
		return confirm('Are you sure you want to Cancel Request this data?');
	}

	</script>
	<?php ;}?>
	</body>
</html>
<!-- Modal start here -->
<div class="modal fade" id="add" role="dialog">
	   <div class="modal-dialog modal-lg">
		   <div class="modal-content">
			   <div class="modal-header">
				   <button type="button" class="close" data-dismiss="modal">&times;</button>
				   <h4 class="modal-title"><b>Remark Hisoty <?php echo @$_GET['id']; ?></b></h4>
			   </div>
			   <div class="modal-body">
				   <div class="modal-data"></div>
				  
			   </div>
			   
			   <div class="modal-footer">
				   <button type="button" class="btn btn-default" 
				   data-dismiss="modal" id="myClose" >Close</button>
			   </div>
		   </div>
	 </div>
	 
</div>

 
<script>
 CKEDITOR.replace( 'inputObjectiveAim', {
  height: 300,  filebrowserUploadUrl: "../ckeditor/upload.php"

 });
 CKEDITOR.replace( 'inputGoalIndicator', {
  height: 300,  filebrowserUploadUrl: "../ckeditor/upload.php"

 });
 CKEDITOR.replace( 'inputMarketSituation', {
  height: 300,  filebrowserUploadUrl: "../ckeditor/upload.php"

 });
 
  CKEDITOR.replace( 'inputProposedconcept', {
  height: 300,  filebrowserUploadUrl: "../ckeditor/upload.php"

 });
 
   CKEDITOR.replace( 'inputRequest_for_Content', {
  height: 300,  filebrowserUploadUrl: "../ckeditor/upload.php"

 });
 
    CKEDITOR.replace( 'inputRequest_for_Design', {
  height: 300,  filebrowserUploadUrl: "../ckeditor/upload.php"

 }); 
</script>
<script>
$(document).ready(function(){
	$('#add').on('show.bs.modal', function (e) {
		   	
		var getDetail ='';
	   var getDetail = $(e.relatedTarget).data('id')
	   var AutoRequestNo = $('#inputAutoRequestNo').val();
				   /* fungsi AJAX untuk melakukan fetch data */
	   $.ajax({
		   type :'post',
		   url: "nprf/nprf-form-comment-history.php",
		   /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
		   data: { getDetail: getDetail,AutoRequestNo: AutoRequestNo},
		   /* memanggil fungsi getDetail dan mengirimkannya */
		   success : function(data){	
			   $('.modal-data').html(data);
			   /* menampilkan data dalam bentuk dokumen HTML */
			}
		});
	});

	$('#SelectSentTo').click(function(){
  		get_detaildata();
 	});
});
 
 function get_detaildata(){
  var a = $('#SelectSentTo').val();

  $.ajax({
   type: 'POST',
   url: "nprf/nprf-load-address-to.php",
   
   data: { data1: a, },
   success: function(info) {
	$("#nprfaddressto").html(info);  
	}
  });
  return false;
 }
</script>

