<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - E-FORM</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="../vendor/datatables/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="../font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
		
        <!-- Bootstrap Core CSS -->
        <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
      
        <!-- MetisMenu CSS -->
        <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
      
        <!-- Custom CSS -->
        <link href="../css/sb-admin-2.css" rel="stylesheet">
      
        <!-- Custom Fonts -->
        <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    </head>
    <body class="sb-nav-fixed">
	<main> 
    <div class="container-fluid"> 
      <h3 class="mt-4">Dashboard</h3>
      <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
      </ol>
	  
 
	  
	  <?php 
		  $exeInbox =mysqli_query($con,"SELECT SUM(Inbox) Inbox FROM (
      SELECT Count(*) Inbox FROM tb_Inbox Where   
		  NameApproval= '$username' Or OnBehalf='$username' And Request_Status='W'
      UNION ALL
			SELECT Count(*) Inbox  FROM tb_prod_add_resource a
			INNER JOIN param_tracking b ON a.LAST_TRACK=b.CODE AND b.KODE_JENIS_PROSES=1
			INNER JOIN tb_user c ON a.CreatedBy=c.UserDomain 
			INNER JOIN param_tracking_access d ON a.LAST_TRACK=d.TRACKING_CODE
			INNER JOIN tb_position e ON d.ROLE_APPLICATION_CODE= e.KDPosition
			WHERE e.KDPosition='$position' AND a.LAST_TRACK !=8 ) A  ");
		  $tampildataInbox=mysqli_fetch_array($exeInbox);
		  if ($_SESSION['leveleform']=="ADMINISTRATOR"){
        $exeStatus =mysqli_query($con,"SELECT Count(*) Status FROM tb_Inbox a 
        Where a.Request_Status In ('CMID','R','W') GROUP BY a.Request_No ");
        $tampildataStatus=mysqli_fetch_array($exeStatus);}
		else{
        $exeStatus =mysqli_query($con,"SELECT Count(*) Status FROM tb_Inbox a Left JOIN tb_workflownprf b
        ON a.Request_No=b.Request_No Where a.Request_Status In ('CMID','R','W') 
		    And (b.NameApproval= '$username' Or b.OnBehalf='$username') GROUP BY a.Request_No ");
        $tampildataStatus=mysqli_fetch_array($exeStatus);
		}
		  $exeStatusComplete =mysqli_query($con,"SELECT Count(*) STATUS_Req  FROM tb_Inbox  
		  WHERE Request_Status In ('C','Cancel') ");
		  //WHERE Request_Status In ('C','Cancel','CMID') ");
		  $tampildataComplete=mysqli_fetch_array($exeStatusComplete);
	  $no = 0;
	  while(@$row =mysqli_fetch_array($exeStatus)){ $no++; }
	  $JmlStatusComplete = 1;
	  while(@$rowStatusComplete =mysqli_fetch_array($exeStatusComplete)){$JmlStatusComplete++; }
	  showprivilage($username,'dashboard','
      <div class="row"> 

        <div class="col-xl-4 col-md-6"> 
          <div class="card bg-success text-white mb-4"> 
            <div class="card-body">Inbox ('.$tampildataInbox['Inbox'].')</div>
            <div class="card-footer d-flex align-items-center justify-content-between"> 
              <a class="small text-white stretched-link" href="index.php?button=inbox">View Details</a> 
              <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-md-6"> 
          <div class="card bg-warning text-white mb-4"> 
            <div class="card-body">Status ('.$no.')</div>
            <div class="card-footer d-flex align-items-center justify-content-between"> 
              <a class="small text-white stretched-link" href="index.php?button=status-req">View Details</a> 
              <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
          </div>
        </div>
		<div class="col-xl-4 col-md-6"> 
          <div class="card bg-primary text-white mb-4"> 
            <div class="card-body">Completed ('.$tampildataComplete['STATUS_Req'].')</div>
            <div class="card-footer d-flex align-items-center justify-content-between"> 
              <a class="small text-white stretched-link" href="index.php?button=complete-req">View Details</a> 
              <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
          </div>
        </div>
      </div>
      '); ?>
      <div class="card mb-4"> <?php
      	$exe =mysqli_query($con,"SELECT Image FROM tb_dashboard_image Where  Status = '1' ");
        $tampildata=mysqli_fetch_array($exe)
	  	?><img src="<?php if (empty($tampildata['Image'])){ echo"";} else { echo "../img/".$tampildata['Image'];} ?>" height="100%" width="100%">
       
      </div>
    </div>
    </main> 
	<!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>
    </body>
</html>
