<!DOCTYPE html>
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
			selectList.setAttribute('title',"Select Level");
			selectList.setAttribute('name',"selectlevelapp[]");
			selectList.setAttribute('id',"selectlevelapp[]");
			selectList.setAttribute('value',"Select Level");
			selectList.setAttribute('readonly','readonly');
			cell2.appendChild(selectList) 
				
			var cell3 = row.insertCell(2);
			var array = [<?php
			$div = mysqli_query($con,"SELECT UserDomain FROM tb_user Where StatusUser<>0 ");
			while($b = mysqli_fetch_array($div)){
			echo  "\"$b[UserDomain]\",";}	?>];
		
			var selectListDomain = document.createElement('select');
			selectListDomain.setAttribute('class',"form-control");
			selectListDomain.setAttribute('title',"Select User Domain");
			selectListDomain.setAttribute('name',"SelectUserDomain[]");
			selectListDomain.setAttribute('id',"SelectUserDomain[]");
			cell3.appendChild(selectListDomain);
				
			for (var i = 0; i < array.length; i++) {
				var option = document.createElement("option");
				option.value = array[i];
				option.text = array[i];
				selectListDomain.appendChild(option);
			}

			var cell4 = row.insertCell(3);
			var array = [<?php
			$div = mysqli_query($con,"SELECT UserDomain FROM tb_user Where StatusUser<>0 ");
			while($b = mysqli_fetch_array($div)){
			echo  "\"$b[UserDomain]\",";}	?>];
		
			var selectListDomainONBehalf = document.createElement('select');
			selectListDomainONBehalf.setAttribute('class',"form-control");
			selectListDomainONBehalf.setAttribute('title',"Select User Domain");
			selectListDomainONBehalf.setAttribute('name',"SelectUserDomainONBehalf[]");
			selectListDomainONBehalf.setAttribute('id',"SelectUserDomainONBehalf[]");
			cell4.appendChild(selectListDomainONBehalf);
				
			for (var i = 0; i < array.length; i++) {
				var option = document.createElement("option");
				option.value = array[i];
				option.text = array[i];
				selectListDomainONBehalf.appendChild(option);
			}

			
			var cell5 = row.insertCell(4);
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
      <h3 class="mt-4"><?php if ($button=="add-work-flow") {echo "Add Work Flow";} else  {echo "Edit Work Flow";} ?> </h3>
	    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="../dist/index.php?button=dashboard">Dashboard</a></li>
		<li class="breadcrumb-item"><a href="../dist/index.php?button=work-flow">Work Flow</a></li>
        <li class="breadcrumb-item active"><?php if ($button=="add-work-flow") {echo "Add Work Flow";} else  {echo "Edit Work Flow";} ?> </li>
      </ol>
 	<div class="card mb-4">
	    <div class="card-header"> </div>
        <div class="card-body" >
        <?php
      	$exe =mysqli_query($con,"SELECT ID_No,UserDomain,WorkFlowMenu,Keterangan,Status FROM tb_workflow where ID_No = '".@$_GET['id']."' ");
        $tampildataWF=mysqli_fetch_array($exe)
	  	?>
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
		$Inputlevelapp		= @$_POST['Inputlevelapp'];
		$SelectWorkFlowMenu = $_POST['SelectWorkFlowMenu']; 
		$inputDescrioption 	= $_POST['inputDescrioption'];
		$StatusWorkFlow 	= $_POST['StatusWorkFlow'];
		
		if($SelectRequestor=="" || $SelectRequestor=="-"){  
			echo "<div class='form-group has-error'>
			<label class='control-label' for='inputError'>Requestor Can not be empty *</label></div>"; }
		elseif($SelectWorkFlowMenu=="" || $SelectWorkFlowMenu=="-"){  
			echo "<div class='form-group has-error'>
			<label class='control-label' for='inputError'>Work Flow Menu Can not be empty *</label></div>"; }
		elseif($StatusWorkFlow=="" || $StatusWorkFlow=="-"){  
			echo "<div class='form-group has-error'>
			<label class='control-label' for='inputError'>Status Work Flow Menu Can not be empty *</label></div>"; }
		elseif($button=="add-work-flow"){ 
			$Tanya = mysqli_query($con,"SELECT UserDomain,WorkFlowMenu FROM tb_workflow 
			WHERE UserDomain = '$SelectRequestor' And WorkFlowMenu='$SelectWorkFlowMenu' ");
			if (mysqli_num_rows($Tanya) !=0 ) {  
				echo "<div class='form-group has-error'>
				<label class='control-label' for='inputError'>Error Save : Requestor is exists in the database *</label></div>";}
			else{
				//membuat Query untuk menyimpan data
				mysqli_query($con,"Insert INTO tb_workflow (UserDomain,WorkFlowMenu,Keterangan,Status,CreatedBy,CreatedDate,CreatedHostName) values 
				('$SelectRequestor','$SelectWorkFlowMenu','$inputDescrioption','$StatusWorkFlow','$username','$createddate','$ip : $hostname')");
				//SIMPAN WORK FLOW APPROVAL
				mysqli_query($con,"Insert INTO tb_workflowapproval (UserDomain,WorkFlowMenu,LevelApproval,NameApproval,Index_No) 
				values ('$SelectRequestor','$SelectWorkFlowMenu','$Inputlevelapp','$SelectRequestor','1')");
				if (is_array(@$_POST['selectlevelapp'])){
					for($i=0;$i<count(@$_POST['selectlevelapp']);$i++)	
					{
						if($_POST['SelectUserDomain'][$b]<>"-")	
						{
							$idlevelapp					=$_POST['idlevelapp'][$i];
							$selectlevelapp				=$_POST['selectlevelapp'][$i];
							$SelectUserDomain			=$_POST['SelectUserDomain'][$i];
							$SelectUserDomainONBehalf	=$_POST['SelectUserDomainONBehalf'][$i];
							$IndexNo					=$_POST['IndexNo'][$i];			
							mysqli_query($con,"Insert INTO tb_workflowapproval (UserDomain,WorkFlowMenu,LevelApproval,NameApproval,OnBehalf,Index_No) 
							values ('$SelectRequestor','$SelectWorkFlowMenu','$selectlevelapp','$SelectUserDomain','$SelectUserDomainONBehalf','$IndexNo')");
						}
					}	
				}
				$message = "Data successfully save to database";
				echo "<script type='text/javascript'>alert('$message');</script>";
				echo"<script>  window.location='../dist/index.php?button=work-flow'; </script>";
			}
		}
		elseif($button=="edit-work-flow"){ 
			//membuat Query untuk update data
			mysqli_query($con,"update tb_workflow set UserDomain='$SelectRequestor',WorkFlowMenu='$SelectWorkFlowMenu',
			Keterangan='$inputDescrioption',Status='$StatusWorkFlow',UpdatedBy='$username',UpdatedDate='$createddate',
			UpdatedHostName='$ip : $hostname' WHERE UserDomain='$tempRequestor'");
			//SIMPAN WORK FLOW APPROVAL
			mysqli_query($con,"Delete From tb_workflowapproval WHERE UserDomain = '$SelectRequestor' 
			And WorkFlowMenu = '$SelectWorkFlowMenu' And LevelApproval<>'Requestor'");
			if (is_array(@$_POST['selectlevelapp'])){
				for($b=0;$b<count(@$_POST['selectlevelapp']);$b++)	
				{
					if($_POST['SelectUserDomain'][$b]<>"-")	
					{
						$idlevelapp					=$_POST['idlevelapp'][$b];
						$selectlevelapp				=$_POST['selectlevelapp'][$b];
						$SelectUserDomain			=$_POST['SelectUserDomain'][$b];
						$SelectUserDomainONBehalf	=$_POST['SelectUserDomainONBehalf'][$b];
						$IndexNo					=$_POST['IndexNo'][$b];			
						mysqli_query($con,"Insert INTO tb_workflowapproval (UserDomain,WorkFlowMenu,LevelApproval,NameApproval,OnBehalf,Index_No) 
						values ('$SelectRequestor','$SelectWorkFlowMenu','$selectlevelapp','$SelectUserDomain','$SelectUserDomainONBehalf','$IndexNo')");
					}
				}				
			}
			$message = "Data successfully Update to database";
			echo "<script type='text/javascript'>alert('$message');</script>";
			/*echo"<script>  window.location='../dist/index.php?button=work-flow'; </script>";*/
			}
		}
		//End CRUD----------------------------------------------------------------------
		?>
 
        <div class="form-row"> 
			
          <div class="col-md-4"> 
            <div class="form-group"> 
              <label class="small mb-1" for="inputFirstName">Requestor *</label>
              <input name="tempRequestor" type="hidden" value="<?php echo $tampildataWF['UserDomain']; ?>">
              <?php if ($button=="edit-work-flow"){?>
              <input name="SelectRequestor" class="form-control" type="text" value="<?php echo $tampildataWF['UserDomain']; ?>" readonly="readonly">
              <?php }else{?>
              <select class="form-control" id="SelectRequestor" name="SelectRequestor" onChange="changeValue(this.value)">
                <option value="-" >Select Requestor</option>
                <?php
						$div = mysqli_query($con,"SELECT UserDomain FROM tb_user Where UserDomain<>'-' ");
						$jsRequestor = "var DTing = new Array();\n";  
						while($b = mysqli_fetch_array($div)){
							if($tampildataWF['UserDomain'] == $b['UserDomain']){
								$cek = 'Selected';
							}elseif($SelectRequestor == $b['UserDomain']){
								$cek = 'Selected';
							}else{
								$cek = '';
							}
							echo"<option value='".$b['UserDomain']."' $cek>".$b['UserDomain']."</option>";
							$jsRequestor .= "DTing['" . $b['UserDomain'] . "'] = {nama:'" . addslashes($b['UserDomain']) ."'};\n"; 
						}
					?>
              </select>
              <?php }?>
            </div>
          </div>
			
			
          <div class="col-md-2"> </div>
          <div class="col-md-4"> 
            <div class="form-group"> 
              <label class="small mb-1" for="inputLastName">Work Flow Menu *</label>
              <?php if ($button=="edit-work-flow"){?>
              <input name="SelectWorkFlowMenu" class="form-control" type="text" 
				value="<?php echo $tampildataWF['WorkFlowMenu']; ?>" readonly="readonly">
              <?php }else{?>
              <select class="form-control" id="SelectWorkFlowMenu" name="SelectWorkFlowMenu" >
                <option value="-" >Select Work Flow Menu</option>
                <?php
						$div = mysqli_query($con,"SELECT WorkFlowMenu FROM tb_workflowmenu ");
						while($b = mysqli_fetch_array($div)){
							if($tampildataWF['WorkFlowMenu'] == $b['WorkFlowMenu']){
								$cek = 'Selected';
							}elseif($SelectWorkFlowMenu == $b['WorkFlowMenu']){
								$cek = 'Selected';
							}else{
								$cek = '';
							}
							echo"<option value='".$b['WorkFlowMenu']."' $cek>".$b['WorkFlowMenu']."</option>";
						}
					?>
              </select>
              <?php }?>
            </div>
          </div>
        </div>

        <div class="form-row"> 
			
          <div class="col-md-4"> 
            <div class="form-group"> 
              <label class="small mb-1" for="inputDescrioption">Descrioption</label>
              <textarea cols="4"  name="inputDescrioption" maxlength="100" class="form-control py-4" 
			placeholder="Enter Descrioption"><?php if($_POST){ echo $inputDescrioption;}else{echo $tampildataWF['Keterangan'];} ?> </textarea>
            </div>
          </div>

          <div class="col-md-2"> </div>	  

          <div class="col-md-3"> 
            <div class="form-group"> 
              <label class="small mb-1" for="inputLastName">Work Flow Status *</label>
              <select class="form-control" name="StatusWorkFlow" >
                <option value="1" <?php if (@$tampildataWF['Status']=='1') {echo "Selected"; }?>>Active 
                </option>
                <option value="0" <?php if (@$tampildataWF['Status']=='0') {echo "Selected";} ?>>Non 
                Active</option>
              </select>
            </div>
          </div>
        </div>
			  
		<table id="dataTable" border="1" class="table table-striped table-bordered table-hover">
				<tr>
				  <th colspan="5">
					<button type="button" class="btn btn-primary" title="Add Level Approval"  name="btnCreate" onClick="addRow('dataTable')">Add </button>
					<button type="button" class="btn btn-primary" title="Delete Level Approval "  id="btnDelete" name="btnDelete" onClick="deleteRow('dataTable')">Del</button>
				  </th>
				</tr>
                <tr>
				  <th width="2%"></th>
				  <th width="15%">Level Approval * 
				  
				  </th> 
                  <th width="30%">Approval *</th>
				  <th width="30%">On Behalf *</th>
				  <th>Index No</th>
                </tr>
                <tr>
				  <td width="1%"><input type="hidden" id="idlevelapp" name="idlevelapp" value="<?php echo $tampildataWF['UserDomain']; ?>"></td>
				  <td><input class="form-control py-4" id="Inputlevelapp" name="Inputlevelapp" type="text"
				  	  value="Requestor" readonly="readonly"></td> 
                  <td><input class="form-control py-4" id="InputUserDomain" name="InputUserDomain" type="text"
				  	  value="<?php  if($_POST) {echo $InputUserDomain;} else {echo $tampildataWF['UserDomain'];} ?>" disabled></td>
				  <td><input class="form-control py-4" id="InputUserDomainONBehalf" name="InputUserDomainONBehalf" type="text"
				  	  value="" readonly="readonly"></td>
				  <td><input class="form-control py-4" id="InputIndexNo" name="InputIndexNo" type="text"
				  	  value="1" readonly="readonly"></td>
                </tr>
				<?php
				$exe = mysqli_query($con,"SELECT ID_No,UserDomain,WorkFlowMenu,LevelApproval,NameApproval,OnBehalf,Index_No,Status 
				FROM tb_workflowapproval Where UserDomain = '".$tampildataWF['UserDomain']."' And WorkFlowMenu = '".$tampildataWF['WorkFlowMenu']."' And LevelApproval<>'Requestor'  ");
				$no = 1;
				while(@$rowWFA =mysqli_fetch_array($exe)){
				?>
				<tr> 
					<td><input id="chk[]" name="chk[]" type="checkbox">
					<input type="hidden" id="idlevelapp[]" name="idlevelapp[]" value="<?php echo $tampildataWF['UserDomain']; ?>">
					<td><input class="form-control py-4" id="selectlevelapp[]" name="selectlevelapp[]" type="text"
				  	  value="<?php echo $rowWFA['LevelApproval'];?>" readonly="readonly"> </td>
					<td><select class="form-control" id="SelectUserDomain[]" name="SelectUserDomain[]" onChange="changeValue(this.value)" >
						<option value="-" >Select Approval</option>
						<?php
							$div = mysqli_query($con,"SELECT UserDomain FROM tb_user Where UserDomain<>'-'");
							while($b = mysqli_fetch_array($div)){
								if($rowWFA['NameApproval'] == $b['UserDomain']){
									$cek = 'Selected';
								}elseif($SelectUserDomain == $b['UserDomain']){
									$cek = 'Selected';
								}else{
									$cek = '';
								}
								echo"<option value='".$b['UserDomain']."' $cek>".$b['UserDomain']."</option>";
							}
						?>
					</select></td>
					<td><select class="form-control" id="SelectUserDomainONBehalf[]" name="SelectUserDomainONBehalf[]" onChange="changeValue(this.value)" >
						<option value="-" >Select On Behalf </option>
						<?php
							$div = mysqli_query($con,"SELECT UserDomain FROM tb_user Where UserDomain<>'-'");
							while($b = mysqli_fetch_array($div)){
								if($rowWFA['OnBehalf'] == $b['UserDomain']){
									$cek = 'Selected';
								}elseif($SelectUserDomainONBehalf == $b['UserDomain']){
									$cek = 'Selected';
								}else{
									$cek = '';
								}
								echo"<option value='".$b['UserDomain']."' $cek>".$b['UserDomain']."</option>";
							}
						?>
					</select></td>
					<td><input class="form-control py-4" id="IndexNo[]" name="IndexNo[]" type="text"
				  	  value="<?php echo $rowWFA['Index_No'];?>" readonly="readonly"> </td>
				 </tr>
				 <?php $no++;} ?>
            </table>
			<button type="submit" class="btn btn-primary">Save</button>		
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
    </body>
</html>
