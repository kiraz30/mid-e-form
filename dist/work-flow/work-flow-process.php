l<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Static Navigation - SB Admin</title>
        <link href="../css/styles.css" rel="stylesheet" />
		<!-- Bootstrap Core CSS -->
		<link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	
		<!-- MetisMenu CSS -->
		<link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
	
		<!-- Custom CSS -->
		<link href="../css/sb-admin-2.css" rel="stylesheet">
	
		<!-- Custom Fonts -->
		<link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
		
<script src="../../vendor/jquery/jquery-latest.js" type="text/javascript"></script>

        <?php
		$exeWF =mysqli_query($con,"SELECT a.ID_No,a.UserDomain,a.WorkFlowMenu,c.DivisionName FROM tb_workflow a INNER JOIN tb_user b ON a.UserDomain=b.UserDomain
		INNER JOIN tb_division c ON b.KDDivision= c.KDDivision where a.ID_No = '".@$_GET['id']."' ");
        $tampildataWF=mysqli_fetch_array($exeWF)
	  	?>
	

<script type="text/javascript">
		function addRow(tableID) {
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
			var element2 = document.createElement("input");
			element2.type="hidden";
			element2.name = "idlevelapp[]";
			cell2.appendChild(element2);
		
			var selectList = document.createElement("input");
			selectList.setAttribute('class',"form-control py-4");
			selectList.setAttribute('title',"Select Step Process");
			selectList.setAttribute('name',"SelectLevelProcess[]");
			selectList.setAttribute('id',"SelectLevelProcess[]");
			selectList.setAttribute('value',"Step" );
			selectList.setAttribute('readonly','readonly');

			cell2.appendChild(selectList) 
				
			var cell3 = row.insertCell(2);
			var array = [<?php
			$div = mysqli_query($con,"SELECT UserDomain FROM tb_workflowapproval Where WorkFlowMenu='".$tampildataWF['WorkFlowMenu']."' Group BY UserDomain Order By UserDomain Asc");
			while($b = mysqli_fetch_array($div)){
			echo  "\"$b[UserDomain]\",";}	?>];
		
			var selectListDomain = document.createElement('select');
			selectListDomain.setAttribute('class',"form-control");
			selectListDomain.setAttribute('title',"Step Work Flow Process");
			selectListDomain.setAttribute('name',"SelectWorkFlowProcess[]");
			selectListDomain.setAttribute('id',"SelectWorkFlowProcess[]");
			cell3.appendChild(selectListDomain);
				
			for (var i = 0; i < array.length; i++) {
				var option = document.createElement("option");
				option.value = array[i];
				option.text = array[i];
				selectListDomain.appendChild(option);
			}
 
 
			var cell3 = row.insertCell(3);
			var array = [<?php
			$div = mysqli_query($con,"SELECT UserDomain FROM tb_workflowapproval Where WorkFlowMenu='".$tampildataWF['WorkFlowMenu']."' Group BY UserDomain Order By UserDomain Asc");
			while($b = mysqli_fetch_array($div)){
			echo  "\"$b[UserDomain]\",";}	?>];
			var SelectOnBehalf = document.createElement('select');
			SelectOnBehalf.setAttribute('class',"form-control");
			SelectOnBehalf.setAttribute('title',"Step OnBehalf  Process");
			SelectOnBehalf.setAttribute('name',"SelectWorkFlowONBehalfProcess[]");
			SelectOnBehalf.setAttribute('id',"SelectWorkFlowONBehalfProcess[]");
			cell3.appendChild(SelectOnBehalf);
				
			for (var i = 0; i < array.length; i++) {
				var option = document.createElement("option");
				option.value = array[i];
				option.text = array[i];
				SelectOnBehalf.appendChild(option);
			}
 
 
			var cell4= row.insertCell(4);
			var array = [<?php
			$div = mysqli_query($con,"SELECT UserDomain FROM tb_workflowapproval Where WorkFlowMenu='".$tampildataWF['WorkFlowMenu']."' Group BY UserDomain Order By UserDomain Asc");
			while($b = mysqli_fetch_array($div)){
			echo  "\"$b[UserDomain]\",";}	?>];
		
			var selectListDomainRevise = document.createElement('select');
			selectListDomainRevise.setAttribute('class',"form-control");
			selectListDomainRevise.setAttribute('title',"Step Work Flow Revise");
			selectListDomainRevise.setAttribute('name',"SelectWorkFlowRevise[]");
			selectListDomainRevise.setAttribute('id',"SelectWorkFlowRevise[]");
			cell4.appendChild(selectListDomainRevise);
				
			for (var i = 0; i < array.length; i++) {
				var option = document.createElement("option");
				option.value = array[i];
				option.text = array[i];
				selectListDomainRevise.appendChild(option);
			}


			var cell5 = row.insertCell(5);
			var element3 = document.createElement("input");
			element3.setAttribute('class',"form-control py-4");
			element3.setAttribute('title',"Index No");
			element3.setAttribute('name',"IndexNo[]");
			element3.setAttribute('id',"IndexNo[]");
			element3.setAttribute('value',rowCount-1);
			element3.setAttribute('readonly','readonly');
			cell5.appendChild(element3);
			
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

		
		
    </head>
	<main > 
    <div class="container-fluid"> 
      <h3 class="mt-4">Workwlow Process </h3>
	    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="../dist/index.php?button=dashboard">Dashboard</a></li>
		<li class="breadcrumb-item"><a href="../dist/index.php?button=work-flow">Work Flow</a></li>
        <li class="breadcrumb-item active">Workflow Process </li>
      </ol>
 	<div class="card mb-4">
	    <div class="card-header"> </div>
        <div class="card-body" >

        <form action="" method="post" id="frm-workflow" name="frm-workflow">
          <?php 
		//Begin CRUD----------------------------------------------------------------------
		if($_POST){
		$ip					=$_SERVER['REMOTE_ADDR'];
		$hostname 			= gethostbyaddr($_SERVER['REMOTE_ADDR']);
		date_default_timezone_set("Asia/Jakarta");
		$createddate		= date("Y-m-d H:i:s");
		$tempRequestor  	= $_POST['tempRequestor'];
    	$SelectRequestor  	= $_POST['SelectRequestor'];
		$InputUserDomain	= @$_POST['InputUserDomain'];
		$InputUserDomainONBehalf= @$_POST['InputUserDomainONBehalf'];
		$InputRevise		= @$_POST['InputRevise'];
		$InputLevelProcess	= @$_POST['InputLevelProcess'];
		$SelectWorkFlowMenu = $_POST['SelectWorkFlowMenu']; 
		
		$Submit				= @$_POST['Submit'];  
		if($SelectRequestor=="" || $SelectRequestor=="-"){  
			echo "<div class='form-group has-error'>
			<label class='control-label' for='inputError'>Requestor Can not be empty *</label></div>"; }
		elseif($SelectWorkFlowMenu=="" || $SelectWorkFlowMenu=="-"){  
			echo "<div class='form-group has-error'>
			<label class='control-label' for='inputError'>Work Flow Menu Can not be empty *</label></div>"; }

		elseif($Submit=="Save"){ 
			//membuat Query untuk update data
			//SIMPAN WORK FLOW APPROVAL
			mysqli_query($con,"Delete From tb_workflowprocess WHERE UserDomain = '".$tampildataWF['UserDomain']."' And WorkFlowMenu = '".$tampildataWF['WorkFlowMenu']."' ");
			
			mysqli_query($con,"Insert INTO tb_workflowprocess (UserDomain,WorkFlowMenu,LevelProcess,WorkFlowProcess,
			Revise,Index_No,CreatedBy,CreatedDate,CreatedHostName) values('$SelectRequestor','$SelectWorkFlowMenu','$InputLevelProcess','$SelectRequestor',
			'$SelectRequestor','1','$username','$createddate','$ip : $hostname')");
			if (is_array(@$_POST['SelectLevelProcess'])){
				for($b=0;$b<count(@$_POST['SelectLevelProcess']);$b++)	
				{
					if($_POST['SelectWorkFlowProcess'][$b]<>"-")	
					{
						$idlevelapp					=$_POST['idlevelapp'][$b];
						$SelectLevelProcess			="Step ";
						$SelectWorkFlowProcess		=$_POST['SelectWorkFlowProcess'][$b];
						$SelectWorkFlowONBehalfProcess=$_POST['SelectWorkFlowONBehalfProcess'][$b];
						$SelectWorkFlowRevise		=$_POST['SelectWorkFlowRevise'][$b];
						$IndexNo					=$b+2;			
						mysqli_query($con,"Insert INTO tb_workflowprocess(UserDomain,WorkFlowMenu,LevelProcess,WorkFlowProcess,
						OnBehalfProcess,Revise,Index_No,CreatedBy,CreatedDate,CreatedHostName) 
						values('$SelectRequestor','$SelectWorkFlowMenu','$SelectLevelProcess$IndexNo','$SelectWorkFlowProcess',
						'$SelectWorkFlowONBehalfProcess','$SelectWorkFlowRevise','$IndexNo','$username','$createddate','$ip : $hostname')");
					}
				}
			}				
			$message = "Data successfully Save to database";
			echo "<script type='text/javascript'>alert('$message');</script>";
			echo"<script>  window.location='../dist/index.php?button=work-flow'; </script>";
			}
		}
		//End CRUD----------------------------------------------------------------------
		?>
 
        <div class="form-row"> 
			
          <div class="col-md-3"> 
            <div class="form-group"> 
              <label class="small mb-1" for="inputFirstName">Requestor *</label>
              <input name="tempRequestor" type="hidden" value="<?php echo $tampildataWF['UserDomain']; ?>">
              <input name="SelectRequestor" class="form-control" type="text" value="<?php if ($_POST) {echo $SelectRequestor;} else {echo $tampildataWF['UserDomain'];} ?>" readonly="readonly">
            </div>
          </div>
			
         <div class="col-md-3"> 
            <div class="form-group"> 
              <label class="small mb-1" for="inputLastName">Divison</label>
                 <input name="SelectWorkFlowMenu" class="form-control" type="text" 
				value="<?php echo $tampildataWF['DivisionName']; ?>" readonly="readonly" >
            </div>
          </div>
		  
   		  <div class="col-md-3">  
            <div class="form-group"> 
              <label class="small mb-1" for="inputLastName">Work Flow Menu *</label>
                 <input name="SelectWorkFlowMenu" class="form-control" type="text" 
				value="<?php echo $tampildataWF['WorkFlowMenu']; ?>" readonly="readonly">
            </div>
          </div>
        </div>
			  
		<table id="dataTable" border="1" class="table table-striped table-bordered table-hover">
				<tr>
				  <th colspan="6">
					<button type="button" class="btn btn-primary" title="Add Level Approval"  name="btnCreate" onClick="addRow('dataTable')">Add </button>
					<button type="button" class="btn btn-primary" title="Delete Level Approval "  id="btnDelete" name="btnDelete" onClick="deleteRow('dataTable')">Del</button>
				  </th>
				</tr>
                <tr>
				  <th width="2%"></th>
				  <th width="15%">Step</th> 
                  <th width="30%">Workflow Process</th>
				  <th width="30%">On Behalf Process</th>
				  <th width="30%">Revise</th>
				  <th>Index No</th>
                </tr>
                <tr>
					<td width="1%"><input type="hidden" id="idlevelapp" name="idlevelapp" value="<?php echo $tampildataWF['UserDomain']; ?>"></td>
					<td><input class="form-control py-4" id="InputLevelProcess" name="InputLevelProcess" type="text"
						value="Requestor" readonly="readonly"></td> 
					<td><input class="form-control py-4" id="InputUserDomain" name="InputUserDomain" type="text"
						value="<?php if($_POST) {echo $InputRevise;} else {echo $tampildataWF['UserDomain'];} ?>" readonly="readonly"></td>
					<td><input class="form-control py-4" id="InputUserDomainONBehalf" name="InputUserDomainONBehalf" type="text"
						value="" readonly="readonly"></td>
					<td><input class="form-control py-4" id="InputIndexNo" name="InputIndexNo" type="text"
						value="<?php if($_POST) {echo $InputUserDomain;} else {echo $tampildataWF['UserDomain'];} ?>" readonly="readonly"></td>
					<td><input class="form-control py-4" id="InputIndexNo" name="InputIndexNo" type="text"
						value="1" readonly="readonly"></td>
                </tr>
				<?php
				$exe = mysqli_query($con,"SELECT ID_No,UserDomain,WorkFlowMenu,LevelProcess,WorkFlowProcess,OnBehalfProcess,Revise,Index_No,Status 
				FROM tb_workflowprocess Where UserDomain = '".$tampildataWF['UserDomain']."' And WorkFlowMenu = '".$tampildataWF['WorkFlowMenu']."'
				And LevelProcess<>'Requestor' ");
				$no = 1;
				while(@$rowWFA =mysqli_fetch_array($exe)){
				?>
				<tr> 
					<td><input id="chk[]" name="chk[]" type="checkbox">
					<input type="hidden" id="idlevelapp[]" name="idlevelapp[]" value="<?php echo $tampildataWF['UserDomain']; ?>">
					<td><input class="form-control py-4" id="SelectLevelProcess[]" name="SelectLevelProcess[]" type="text"
				  	  value="<?php echo $rowWFA['LevelProcess'];?>" readonly="readonly"> </td>
					<td><input class="form-control py-4" id="SelectWorkFlowProcess[]" name="SelectWorkFlowProcess[]" type="text"
				  	  value="<?php echo $rowWFA['WorkFlowProcess'];?>" readonly="readonly"></td>
					<td><input class="form-control py-4" id="SelectWorkFlowONBehalfProcess[]" name="SelectWorkFlowONBehalfProcess[]" type="text"
				  	  value="<?php echo $rowWFA['OnBehalfProcess'];?>" readonly="readonly"></td>
					  <td><input class="form-control py-4" id="SelectWorkFlowRevise[]" name="SelectWorkFlowRevise[]" type="text"
				  	  value="<?php echo $rowWFA['Revise'];?>" readonly="readonly"></td>
					<td><input class="form-control py-4" id="IndexNo[]" name="IndexNo[]" type="text"
				  	  value="<?php echo $rowWFA['Index_No'];?>" readonly="readonly"> </td>
				 </tr>
				 <?php $no++;} ?>
            </table>
			<input type="submit" Name="Submit" onClick="return checkSave()" class="btn btn-primary" value="Save">
			<a class="btn btn-primary" href="../dist/index.php?button=work-flow">Back</a> 
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
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
    </script>
	
	<script type="text/javascript">    
    <?php echo $jsRequestor; ?>  
    function changeValue(SelectRequestor){  
    document.getElementById('InputUserDomain').value = DTing[SelectRequestor].nama;   
    };  
	</script>
	<script language="JavaScript" type="text/javascript">
		function checkSave(){
			return confirm('Are you sure you want to Save this data?');
		}
	</script>
    </body>
</html>
