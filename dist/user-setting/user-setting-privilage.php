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
    </head>
	<main> 
    <div class="container-fluid"> 
      <h3 class="mt-4">User Privilage Setting</h3>
	    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="../dist/index.php?button=dashboard">Dashboard</a></li>
		<li class="breadcrumb-item"><a href="../dist/index.php?button=user-setting">User Setting</a></li>
        <li class="breadcrumb-item active"><?php if ($button=="add-user-setting") {echo "User Privilage Setting";} else  {echo "User  Privilage Setting";} ?> </li>
      </ol>
 	<div class="card mb-4">
	    <div class="card-header">
		<?php
      	$exe =mysqli_query($con,"SELECT UserDomain,Name,Email,KDDivision,KDPosition FROM tb_user where UserDomain = '".@$_GET['id']."' ");
        $tampildata=mysqli_fetch_array($exe)
	  	?>

		 
        </div>
        <div class="card-body">
        
        <form action="" method="post" name="frm-workflow">
          <?php 
		//Begin CRUD----------------------------------------------------------------------
		if($_POST){
		$ip=$_SERVER['REMOTE_ADDR'];
		$hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);
		date_default_timezone_set("Asia/Jakarta");
		$createddate=date("Y-m-d H:i:s");
		if($button=="user-setting-privilage"){ 
			//UPDATE DATA ______________________________________________________
				//DASHBOARD
				if (!@$_POST['ChkDashboard']){$valDashboard=0;} else {$valDashboard=1;}
				mysqli_query($con,"UPDATE Tb_user_privilage SET Status ='$valDashboard' WHERE UserDomain='".@$_GET['id']."'
				And module='dashboard'");

				//MASTER DATA
				if (!@$_POST['ChkUserSetting']){$valUserSetting=0;} else {$valUserSetting=1;}
				mysqli_query($con,"UPDATE Tb_user_privilage SET Status ='$valUserSetting' WHERE UserDomain='".@$_GET['id']."'
				And module='user-setting'");
				if (!@$_POST['ChkDiv']){$valDiv=0;} else {$valDiv=1;}
				mysqli_query($con,"UPDATE Tb_user_privilage SET Status ='$valDiv' WHERE UserDomain='".@$_GET['id']."' 
				And module='division'");
				if (!@$_POST['ChkPos']){$valPos=0;} else {$valPos=1;}
				mysqli_query($con,"UPDATE Tb_user_privilage SET Status ='$valPos' WHERE UserDomain='".@$_GET['id']."' 
				And module='position'");
				if (!@$_POST['ChkWf']){$valWf=0;} else {$valWf=1;}
				mysqli_query($con,"UPDATE Tb_user_privilage SET Status ='$valWf' WHERE UserDomain='".@$_GET['id']."' 
				And module='work-flow'");
				if (!@$_POST['ChkWfm']){$valWfm=0;} else {$valWfm=1;}
				mysqli_query($con,"UPDATE Tb_user_privilage SET Status ='$valWfm' WHERE UserDomain='".@$_GET['id']."' 
				And module='work-flow-menu'");
				if (!@$_POST['ChktTP']){$valTP=0;} else {$valTP=1;}
				mysqli_query($con,"UPDATE Tb_user_privilage SET Status ='$valTP' WHERE UserDomain='".@$_GET['id']."' 
				And module='trading-fartner'");
				if (!@$_POST['ChkCurenncy']){$valCurenncy=0;} else {$valCurenncy=1;}
				mysqli_query($con,"UPDATE Tb_user_privilage SET Status ='$valCurenncy' WHERE UserDomain='".@$_GET['id']."' 
				And module='currency'");
				
				if (!@$_POST['ChkType']){$valType=0;} else {$valType=1;}
				mysqli_query($con,"UPDATE Tb_user_privilage SET Status ='$valType' WHERE UserDomain='".@$_GET['id']."' 
				And module='master-type'");
				if (!@$_POST['ChkBrand']){$valBrand=0;} else {$valBrand=1;}
				mysqli_query($con,"UPDATE Tb_user_privilage SET Status ='$valBrand' WHERE UserDomain='".@$_GET['id']."' 
				And module='master-brand'");
				if (!@$_POST['ChkBisnis']){$valBisnis=0;} else {$valBisnis=1;}
				mysqli_query($con,"UPDATE Tb_user_privilage SET Status ='$valBisnis' WHERE UserDomain='".@$_GET['id']."' 
				And module='master-bisnis'");
				if (!@$_POST['ChkCategory']){$valCategory=0;} else {$valCategory=1;}
				mysqli_query($con,"UPDATE Tb_user_privilage SET Status ='$valCategory' WHERE UserDomain='".@$_GET['id']."' 
				And module='master-kategori'");
				if (!@$_POST['ChkSeries']){$valSeries=0;} else {$valSeries=1;}
				mysqli_query($con,"UPDATE Tb_user_privilage SET Status ='$valSeries' WHERE UserDomain='".@$_GET['id']."' 
				And module='master-series'");
				if (!@$_POST['ChkSegmentation']){$valSegmentation=0;} else {$valSegmentation=1;}
				mysqli_query($con,"UPDATE Tb_user_privilage SET Status ='$valSegmentation' WHERE UserDomain='".@$_GET['id']."' 
				And module='master-segmentation'");
				
				if (!@$_POST['ChkFormatNo']){$valFormatNo=0;} else {$valFormatNo=1;}
				mysqli_query($con,"UPDATE Tb_user_privilage SET Status ='$valFormatNo' WHERE UserDomain='".@$_GET['id']."' 
				And module='format-no-req'");
				if (!@$_POST['ChkTMS']){$valTMS=0;} else {$valTMS=1;}
				mysqli_query($con,"UPDATE Tb_user_privilage SET Status ='$valTMS' WHERE UserDomain='".@$_GET['id']."' 
				And module='market-situation'");	
				if (!@$_POST['ChkDI']){$valDI=0;} else {$valDI=1;}
				mysqli_query($con,"UPDATE Tb_user_privilage SET Status ='$valDI' WHERE UserDomain='".@$_GET['id']."' 
				And module='dashboard-image'");			
				
				//SETTING
				if ($valUserSetting==1 or $valDiv==1 or $valPos==1 or $valWf==1 or $valWfm==1 or $valTP==1){
					mysqli_query($con,"UPDATE Tb_user_privilage SET Status ='1' WHERE UserDomain='".@$_GET['id']."' And module='setting'");}
				else{
					mysqli_query($con,"UPDATE Tb_user_privilage SET Status ='0' WHERE UserDomain='".@$_GET['id']."' And module='setting'");}
				//MASTER DATA
				if ($valUserSetting==1 or $valDiv==1 or $valPos==1 or $valWf==1 or $valWfm==1 or $valTP==1 or $valCurenncy==1 
				or $valType==1 or $valBrand==1 or $valBisnis==1 or $valCategory==1 or $valSeries==1 or $valSegmentation==1
				or $valFormatNo==1 or $valTMS==1 or $valDI==1){
					mysqli_query($con,"UPDATE Tb_user_privilage SET Status ='1' WHERE UserDomain='".@$_GET['id']."' And module='master-data'");}
				else{
					mysqli_query($con,"UPDATE Tb_user_privilage SET Status ='0' WHERE UserDomain='".@$_GET['id']."' And module='master-data'");}

				//TASK MANAGEMENT
				if (!@$_POST['ChkInbox']){$valInbox=0;} else {$valInbox=1;}
				mysqli_query($con,"UPDATE Tb_user_privilage SET Status ='$valInbox' WHERE UserDomain='".@$_GET['id']."' And module='inbox'");
				if (!@$_POST['ChkStatusReq']){$valStatusReq=0;} else {$valStatusReq=1;}
				mysqli_query($con,"UPDATE Tb_user_privilage SET Status ='$valStatusReq' WHERE UserDomain='".@$_GET['id']."' And module='status-req'");
				
				if ($valInbox==1 or $valStatusReq==1){
					mysqli_query($con,"UPDATE Tb_user_privilage SET Status ='1' WHERE UserDomain='".@$_GET['id']."' And module='task-management'");}
				else{
					mysqli_query($con,"UPDATE Tb_user_privilage SET Status ='0' WHERE UserDomain='".@$_GET['id']."' And module='task-management'");}
										
					
				//E-FORM
				if (!@$_POST['ChkNPRF']){$valNPRF=0;} else {$valNPRF=1;}
				mysqli_query($con,"UPDATE Tb_user_privilage SET Status ='$valNPRF' WHERE UserDomain='".@$_GET['id']."'
				And module='nprf'");
				if (!@$_POST['ChkFNIM']){$valFNIM=0;} else {$valFNIM=1;}
				mysqli_query($con,"UPDATE Tb_user_privilage SET Status ='$valFNIM' WHERE UserDomain='".@$_GET['id']."' 
				And module='fnim'");
				if (!@$_POST['ChkIMIS']){$valIMIS=0;} else {$valIMIS=1;}
				mysqli_query($con,"UPDATE Tb_user_privilage SET Status ='$valIMIS' WHERE UserDomain='".@$_GET['id']."' 
				And module='imis'");
				if (!@$_POST['ChkMPR']){$valMPR=0;} else {$valMPR=1;}
				mysqli_query($con,"UPDATE Tb_user_privilage SET Status ='$valMPR' WHERE UserDomain='".@$_GET['id']."' 
				And module='mpr'");
				if (!@$_POST['ChkCFM']){$valCFM=0;} else {$valCFM=1;}
				mysqli_query($con,"UPDATE Tb_user_privilage SET Status ='$valCFM' WHERE UserDomain='".@$_GET['id']."' 
				And module='cfm'");
				if (!@$_POST['ChkFAW']){$valFAW=0;} else {$valFAW=1;}
				mysqli_query($con,"UPDATE Tb_user_privilage SET Status ='$valFAW' WHERE UserDomain='".@$_GET['id']."' 
				And module='faw'");
				if (!@$_POST['ChkLamDD']){$valLamDD=0;} else {$valLamDD=1;}
				mysqli_query($con,"UPDATE Tb_user_privilage SET Status ='$valLamDD' WHERE UserDomain='".@$_GET['id']."' 
				And module='lamdd'");
				if (!@$_POST['ChkSpecProduct']){$valSpecProduct=0;} else {$valSpecProduct=1;}
				mysqli_query($con,"UPDATE Tb_user_privilage SET Status ='$valSpecProduct' WHERE UserDomain='".@$_GET['id']."' 
				And module='spec-product'");
									
				if ($valNPRF==1 or $valFNIM==1 or $valIMIS==1 or $valMPR==1 or $valCFM==1 or $valFAW==1 
					or $valLamDD==1 or $valSpecProduct==1){
					mysqli_query($con,"UPDATE Tb_user_privilage SET Status ='1' WHERE UserDomain='".@$_GET['id']."' And module='e-form'");}
				else{
					mysqli_query($con,"UPDATE Tb_user_privilage SET Status ='0' WHERE UserDomain='".@$_GET['id']."' And module='e-form'");}
				
				//Packaging
				if (!@$_POST['ChkAddisionalMasterResource']){$valAddisionalMasterResource=0;} else {$valAddisionalMasterResource=1;}
				mysqli_query($con,"UPDATE Tb_user_privilage SET Status ='$valAddisionalMasterResource' WHERE UserDomain='".@$_GET['id']."' 
				And module='packaging-arm'");
				if (!@$_POST['ChkAddisionalMasterResourceF2']){$valAddisionalMasterResource=0;} else {$valAddisionalMasterResource=1;}
				mysqli_query($con,"UPDATE Tb_user_privilage SET Status ='$valAddisionalMasterResource' WHERE UserDomain='".@$_GET['id']."' 
				And module='packaging-arm-f2'");

				if (!@$_POST['ChkPackagingSpesification']){$valPackagingSpesification=0;} else {$valPackagingSpesification=1;}
				mysqli_query($con,"UPDATE Tb_user_privilage SET Status ='$valPackagingSpesification' WHERE UserDomain='".@$_GET['id']."' 
				And module='packaging-spesification'");
				if ($valAddisionalMasterResource==0 & $valPackagingSpesification==0 ){$valPackaging=0;} else {$valPackaging=1;}
				mysqli_query($con,"UPDATE Tb_user_privilage SET Status ='$valPackaging' 
				WHERE UserDomain='".@$_GET['id']."' And module='packaging'");

				//Production
				if (!@$_POST['ChkAddisionalMasterResourceProd']){$valAddisionalMasterResourceProd=0;} else {$valAddisionalMasterResourceProd=1;}
				mysqli_query($con,"UPDATE Tb_user_privilage SET Status ='$valAddisionalMasterResourceProd' WHERE UserDomain='".@$_GET['id']."' 
				And module='prod-arm' ");
			 
				if ($valAddisionalMasterResourceProd==0){$valF1=0;} else {$valF1=1;}
				mysqli_query($con,"UPDATE Tb_user_privilage SET Status ='$valF1' 
				WHERE UserDomain='".@$_GET['id']."' And module='f1'");
				
			 


					//K2
				if (!@$_POST['ChkResource']){$valResource=0;} else {$valResource=1;}
				mysqli_query($con,"UPDATE Tb_user_privilage SET Status ='$valResource' WHERE UserDomain='".@$_GET['id']."' 
				And module='resource'");
				
				if (!@$_POST['ChkSupplier']){$valSupplier=0;} else {$valSupplier=1;}
				mysqli_query($con,"UPDATE Tb_user_privilage SET Status ='$valSupplier' WHERE UserDomain='".@$_GET['id']."'
				And module='supplier-register'");
				if (!@$_POST['Chkpo-convertion']){$valPOConvertion=0;} else {$valPOConvertion=1;}
				mysqli_query($con,"UPDATE Tb_user_privilage SET Status ='$valPOConvertion' WHERE UserDomain='".@$_GET['id']."'
				And module='po-convertion'");
				
				//Add ON Flex
				if (!@$_POST['ChkLineOperator']){$valLineOperator=0;} else {$valLineOperator=1;}
				mysqli_query($con,"UPDATE Tb_user_privilage SET Status ='$valLineOperator' WHERE UserDomain='".@$_GET['id']."' 
				And module='line-operator'");
				if (!@$_POST['ChkNoMachineTime']){$valNoMachineTime=0;} else {$valNoMachineTime=1;}
				mysqli_query($con,"UPDATE Tb_user_privilage SET Status ='$valNoMachineTime' WHERE UserDomain='".@$_GET['id']."' 
				And module='no-machine-time'");
				
				if ($valSupplier==1 or $valPOConvertion==1 ){
					mysqli_query($con,"UPDATE Tb_user_privilage SET Status ='1' WHERE UserDomain='".@$_GET['id']."' And module='po-online'");}
				else{
					mysqli_query($con,"UPDATE Tb_user_privilage SET Status ='0' WHERE UserDomain='".@$_GET['id']."' And module='po-online'");}
					
				if ($valResource==1){
					mysqli_query($con,"UPDATE Tb_user_privilage SET Status ='1' WHERE UserDomain='".@$_GET['id']."' And module='k2'");}
				else{
					mysqli_query($con,"UPDATE Tb_user_privilage SET Status ='0' WHERE UserDomain='".@$_GET['id']."' And module='k2'");}
					
				if ($valLineOperator==1 or $valNoMachineTime==1){
					mysqli_query($con,"UPDATE Tb_user_privilage SET Status ='1' WHERE UserDomain='".@$_GET['id']."' And module='addon-flex'");}
				else{
					mysqli_query($con,"UPDATE Tb_user_privilage SET Status ='0' WHERE UserDomain='".@$_GET['id']."' And module='addon-flex'");}
					
				if (!@$_POST['chkReportList']){$valReportList=0;} else {$valReportList=1;}
				mysqli_query($con,"UPDATE Tb_user_privilage SET Status ='$valReportList' WHERE UserDomain='".@$_GET['id']."' 
				And module='report-list'");
			$message = "Data successfully Update to database";
			echo "<script type='text/javascript'>alert('$message');</script>";
			echo"<script>  window.location='../dist/index.php?button=user-setting'; </script>";
		}
	}
		//End CRUD----------------------------------------------------------------------
		?>

	<div class="form-row"> 
			
          
        <div class="col-md-2"> 
          <div class="form-group"> 
            <label class="small mb-1" for="inputFirstName">User Domain</label>
            <input class="form-control py-4" name="inputUserDomain" type="text" 
			  placeholder="Enter User Domain" value="<?php if($_POST){ echo $inputUserDomain;}else{echo $tampildata['UserDomain'];} ?>" disabled />
          </div>
        </div>
			
          
        <div class="col-md-4"> 
          <div class="form-group"> 
            <label class="small mb-1" for="inputLastName">Name</label>
            <input class="form-control py-4" name="inputName" type="text" 
				placeholder="Enter Name" value="<?php if($_POST){ echo $inputName;}else{echo $tampildata['Name'];} ?>" disabled/>
          </div>
        </div>
          
        <div class="col-md-6"> 
          <div class="form-group"> 
            <label class="small mb-1" for="inputLastName">Division</label>
            <select class="form-control" name="InputDivision" disabled>
              <option value="-" >Select Division</option>
              <?php
					$div = mysqli_query($con,"SELECT KDDivision,DivisionName FROM tb_Division ");
					while($b = mysqli_fetch_array($div)){
						if($tampildata['KDDivision'] == $b['KDDivision']){
							$cek = 'Selected';
						}elseif($InputDivision == $b['KDDivision']){
							$cek = 'Selected';
						}else{
							$cek = '';
						}
						echo"<option value='".$b['KDDivision']."' $cek>".$b['DivisionName']."</option>";
					}
				?>
            </select>
          </div>
        </div>
        </div>
		
        <div class="row">
                  
				  
	      <div class="col-sm-12"> 
            <div class="panel panel-success"> 
              <div class="panel-heading"> 
                <h3 class="panel-title"><input type="checkbox" name="ChkDashboard" <?php echo CekPrivilage(@$_GET['id'],'Dashboard'); ?>> Dashboard</h3>
              </div>
            
            </div>
          </div>			  
				  
				  
				    
          <div class="col-sm-4"> 
            <div class="panel panel-success"> 
              <div class="panel-heading"> 
                <h3 class="panel-title">Master Data</h3>
              </div>
              <div class="panel-body"> 
                <input type="checkbox" name="ChkUserSetting" <?php echo CekPrivilage(@$_GET['id'],'user-setting'); ?>>
                Master User Setting <br>
                <input type="checkbox" name="ChkDiv" <?php echo CekPrivilage(@$_GET['id'],'division'); ?> >
                Master Division<br>
                <input type="checkbox" name="ChkPos" <?php echo CekPrivilage(@$_GET['id'],'position'); ?> >
                Master Position<br>
                <input type="checkbox" name="ChkWf" <?php echo CekPrivilage(@$_GET['id'],'work-flow'); ?> >
                Master Work Flow<br>
                <input type="checkbox" name="ChkWfm" <?php echo CekPrivilage(@$_GET['id'],'work-flow-menu'); ?> >
                Master Work Flow Menu<br>
                <input type="checkbox" name="ChktTP" <?php echo CekPrivilage(@$_GET['id'],'trading-partner'); ?> >
                Master Trading Partner<br>
                <input type="checkbox" name="ChkCurenncy" <?php echo CekPrivilage(@$_GET['id'],'currency'); ?> >
                Master Currency<br>
				<input type="checkbox" name="ChkType" <?php echo CekPrivilage(@$_GET['id'],'master-type'); ?> >
                Master Type<br>
				<input type="checkbox" name="ChkBrand" <?php echo CekPrivilage(@$_GET['id'],'master-brand'); ?> >
                Master Brand<br>
				<input type="checkbox" name="ChkBisnis" <?php echo CekPrivilage(@$_GET['id'],'master-bisnis'); ?> >
                Master Bisnis<br>
				<input type="checkbox" name="ChkCategory" <?php echo CekPrivilage(@$_GET['id'],'master-kategori'); ?> >
                Master Category<br>
				<input type="checkbox" name="ChkSeries" <?php echo CekPrivilage(@$_GET['id'],'master-series'); ?> >
                Master Series<br>
				<input type="checkbox" name="ChkSegmentation" <?php echo CekPrivilage(@$_GET['id'],'master-segmentation'); ?> >
                Master Segmentation<br>
				<input type="checkbox" name="ChkFormatNo" <?php echo CekPrivilage(@$_GET['id'],'format-no-req'); ?> >
                Format Request No<br>
				<input type="checkbox" name="ChkTMS" <?php echo CekPrivilage(@$_GET['id'],'market-situation'); ?> >
                Templet Market Situation<br>
				<input type="checkbox" name="ChkDI" <?php echo CekPrivilage(@$_GET['id'],'dashboard-image'); ?> >
                Dashboard Image<br>
              </div>
            </div>
          </div>
                    <!-- /.col-sm-4 -->
                    
          <div class="col-sm-4"> 
            <div class="panel panel-success"> 
              <div class="panel-heading"> 
                <h3 class="panel-title">E-Form</h3>
              </div>
              <div class="panel-body"> 
                <input type="checkbox" name="ChkNPRF" <?php echo CekPrivilage(@$_GET['id'],'nprf'); ?> >
                New Product Review Form D/E (NPRF)<br>
                <input type="checkbox" name="ChkFNIM" <?php echo CekPrivilage(@$_GET['id'],'fnim'); ?> >
                New Product Final Name Internal Memo (FNIM)<br>
                <input type="checkbox" name="ChkIMIS" <?php echo CekPrivilage(@$_GET['id'],'imis'); ?> >
                Internal Memo IS (IMIS)<br>
                <input type="checkbox" name="ChkMPR" <?php echo CekPrivilage(@$_GET['id'],'mpr'); ?> >
                Master Product Request (MPR)<br>
				<input type="checkbox" name="ChkCFM" <?php echo CekPrivilage(@$_GET['id'],'cfm'); ?> >
                Checklist Final Manuscript (CFM)<br>
                <input type="checkbox" name="ChkFAW" <?php echo CekPrivilage(@$_GET['id'],'faw'); ?> >
                Final Art Work (FAW)<br>
                <input type="checkbox" name="ChkLamDD" <?php echo CekPrivilage(@$_GET['id'],'lamdd'); ?> >
                Lampiran DD<br>
				<input type="checkbox" name="ChkSpecProduct" <?php echo CekPrivilage(@$_GET['id'],'spec-product'); ?> >
                Specification Product<br>

              </div>
            </div>
                <!-- /.col-sm-4 -->
			<div class="panel panel-success"> 
              <div class="panel-heading"> 
                <h3 class="panel-title">Packaging</h3>
              </div>
              <div class="panel-body">
				<input type="checkbox" name="ChkAddisionalMasterResource" <?php echo CekPrivilage(@$_GET['id'],'packaging-arm'); ?> >
                Addition Resource Master <br>
				<input type="checkbox" name="ChkAddisionalMasterResourceF2" <?php echo CekPrivilage(@$_GET['id'],'packaging-arm-f2'); ?> >
                Addition Resource Master F2 <br>
				<input type="checkbox" name="ChkPackagingSpesification" <?php echo CekPrivilage(@$_GET['id'],'packaging-spesification'); ?> >
                Packaging Spesification <br>
			  </div>
            </div>

			<div class="panel panel-success"> 
              <div class="panel-heading"> 
                <h3 class="panel-title">Production</h3>
              </div>
              <div class="panel-body">
				<input type="checkbox" name="ChkAddisionalMasterResourceProd" <?php echo CekPrivilage(@$_GET['id'],'prod-arm'); ?> >
                Addition Resource Master Proudction <br>
			  </div>
            </div>

            <div class="panel panel-success"> 
              <div class="panel-heading"> 
                <h3 class="panel-title">K2</h3>
              </div>
              <div class="panel-body">
				<input type="checkbox" name="ChkResource" <?php echo CekPrivilage(@$_GET['id'],'resource'); ?> >
                Resource : Setting Lauching Date SP <br>
				<input type="checkbox" name="ChkSupplier" <?php echo CekPrivilage(@$_GET['id'],'supplier-register'); ?> >
                PO Online : Supplier Register <br>
				<input type="checkbox" name="Chkpo-convertion" <?php echo CekPrivilage(@$_GET['id'],'po-convertion'); ?> >
                PO Online : PO Convertion Status <br>
			  </div>
            </div>
          </div> 

        
          <div class="col-sm-4"> 
            <div class="panel panel-success"> 
              <div class="panel-heading"> 
                <h3 class="panel-title">Task Management</h3>
              </div>
              <div class="panel-body">
			  <input type="checkbox" name="ChkInbox" <?php echo CekPrivilage(@$_GET['id'],'inbox'); ?> >
                Inbox<br>
                <input type="checkbox" name="ChkStatusReq" <?php echo CekPrivilage(@$_GET['id'],'status-req'); ?> >
                Status Request<br>
			  </div>
            </div>
			                <!-- /.col-sm-4 -->
            <div class="panel panel-success"> 
              <div class="panel-heading"> 
                <h3 class="panel-title">Report List</h3>
              </div>
              <div class="panel-body">
				<input type="checkbox" name="chkReportList" <?php echo CekPrivilage(@$_GET['id'],'report-list'); ?> >
                Report List <br>
			  </div>
            </div>
			
			<div class="panel panel-success"> 
              <div class="panel-heading"> 
                <h3 class="panel-title">Add On FlexProcess</h3>
              </div>
              <div class="panel-body">
				<input type="checkbox" name="ChkLineOperator" <?php echo CekPrivilage(@$_GET['id'],'line-operator'); ?> >
                Line Operator <br>
				<input type="checkbox" name="ChkNoMachineTime" <?php echo CekPrivilage(@$_GET['id'],'no-machine-time'); ?> >
                No Machine Time <br>
			  </div>
            </div>
			
          </div>
         </div>

		<button type="submit" class="btn btn-primary">Save</button>		
			<a class="btn btn-primary" href="../dist/index.php?button=user-setting">Back</a> 
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
    </body>
</html>
