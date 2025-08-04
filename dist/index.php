<?php
session_start();
$username				=$_SESSION["usernameeform"];
$name					=$_SESSION["nameusereform"];
$level					=$_SESSION['leveleform'];
$hostname				=$_SESSION['hostnameeform'];
$divisioncode			=$_SESSION['divisioncodeeform'];
$division				=$_SESSION['divisioneform'];
$position				=$_SESSION['positioneform'];

if($username=="" ) //untuk mencegah apabila halaman diakses tanpa login (session kosong), maka otomatis di redirect ke form login (login.php) 
{
	ob_start();
	header("location:login.php");
	ob_end_flush();
}
include "../config/conn.php";
include "../config/connect.php";
date_default_timezone_set("Asia/Jakarta");
$createddate=date("Y-m-d H:i:s");
$button				 	= @$_GET['button'];
$SearchCode 			= @$_POST['SearchCode']; 
$SearchName 		 	= @$_POST['SearchName'];
$inputProductName		= @$_POST['inputProductName'];
$InputBisnis 			= @$_POST['InputBisnis'];
$SelectStatus 			= @$_POST['SelectStatus'];
$SelectMarket 			= @$_POST['SelectMarket'];
$Confirm			 	= @$_POST['Confirm'];
$CariDate			 	= @$_POST['CariDate'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
		<link  href="../img/logoEform.png" rel="shortcut icon" />
		<!-- MetisMenu CSS -->
		<link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
		
        <title>Dashboard - E-FORM</title>
        <link href="../css/styles.css" rel="stylesheet" />
        <!--link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" /-->
		<link href="../vendor/datatables/css/dataTables.bootstrap4.min.css" rel="stylesheet">
        <!--script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script-->
		<script src="../font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
	
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="index.php?button=dashboard">E-FORM</a><button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle"><i class="fas fa-bars"></i></button><!-- Navbar Search-->             
  			<div class="input-group"> </div>
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i>Welcome, <?php echo $username; ?></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <class="dropdown-item" href="#"></a>
						<a class="dropdown-item" href="#"><?php echo $name; ?></a>
						<a class="dropdown-item" href="#"><?php echo $division; ?></a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="../config/logout-exe.php">Logout</a>                   
					</div>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="index.php?button=dashboard"><div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>Dashboard</a>
                            <div class="sb-sidenav-menu-heading">Interface</div>
								<!--Master Data-->
								<?php showprivilage($username,'master-data','<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collmasterdata" 
								aria-expanded="false" aria-controls="collapseLayouts"><div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
								Master Data<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div></a>'); ?><!--/ Master Data-->
								
								<div class="collapse" id="collmasterdata" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
									<nav class="sb-sidenav-menu-nested nav">
									 <!--Setting-->
									 <?php showprivilage($username,'setting','<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseAuth" 
									 aria-expanded="false" aria-controls="pagesCollapseAuth">Setting<div class="sb-sidenav-collapse-arrow">
									 <i class="fas fa-angle-down"></i></div></a>'); ?><!--/ Setting-->
										<div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
											<nav class="sb-sidenav-menu-nested nav">											
											<!--User Setting-->
											<?php showprivilage($username,'user-setting','<a class="nav-link" href="index.php?button=user-setting">User Setting</a>'); ?>
											<!--Work Flow-->
											<?php showprivilage($username,'setting','<a class="nav-link" href="index.php?button=work-flow">Workflow</a>'); ?>
											<!--Work Flow Menu-->
											<?php showprivilage($username,'work-flow-menu','<a class="nav-link" href="index.php?button=work-flow-menu">Workflow Menu</a>'); ?>
											<!--Work Flow Menu-->
											<?php showprivilage($username,'division','<a class="nav-link" href="index.php?button=division">Division</a>'); ?>
											<!--Position-->
											<?php showprivilage($username,'position','<a class="nav-link" href="index.php?button=position">Position</a>'); ?>
											</nav>
										</div>
										<!--Trading Partner-->
										<?php showprivilage($username,'trading-partner','<a class="nav-link" href="index.php?button=trading-partner">Trading Partner</a>'); ?>
										<!--currency-->
										<?php showprivilage($username,'currency','<a class="nav-link" href="index.php?button=currency">Currency</a>'); ?>
										<!--Type-->
										<?php showprivilage($username,'master-type','<a class="nav-link" href="index.php?button=type">Type</a>'); ?>
										<!--Brand-->
										<?php showprivilage($username,'master-brand','<a class="nav-link" href="index.php?button=brand">Brand</a>'); ?>
										<!--Bisnis-->
										<?php showprivilage($username,'master-bisnis','<a class="nav-link" href="index.php?button=bisnis">Bisnis</a>'); ?>
										<!--Category-->
										<?php showprivilage($username,'master-kategori','<a class="nav-link" href="index.php?button=category">Category</a>'); ?>
										<!--Series-->
										<?php showprivilage($username,'master-series','<a class="nav-link" href="index.php?button=series">Series</a>'); ?>
										<!--Segmentation-->
										<?php showprivilage($username,'master-segmentation','<a class="nav-link" href="index.php?button=segmentation">Segmentation</a>'); ?>
										<!--Trading Partner-->
										<?php showprivilage($username,'format-no-req','<a class="nav-link" href="index.php?button=format-no-req">Format Request No</a>'); ?>
										<!--Format Request No-->
										<?php showprivilage($username,'templete','<a class="nav-link" href="index.php?button=templete">Template</a>'); ?>
										<!--templete Master Sent To-->
										<?php showprivilage($username,'templete','<a class="nav-link" href="index.php?button=sent-to">Master Sent To</a>'); ?>
										<!--templete Master Address To-->
										<?php showprivilage($username,'templete','<a class="nav-link" href="index.php?button=address-to">Master Address To</a>'); ?>
										<!--templete Market situation-->
										<?php showprivilage($username,'dashboard-image','<a class="nav-link" href="index.php?button=dashboard-image">Dashboard Image</a>'); ?>
																									
									</nav>
								</div>
							
 
							<?php showprivilage($username,'task-management','<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#colltaskmanagement"
							aria-expanded="false" aria-controls="collapseLayouts"><div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>Task Management
							<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div></a>'); ?>
							
                            <div class="collapse" id="colltaskmanagement" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
									<?php showprivilage($username,'inbox','<a class="nav-link" href="index.php?button=inbox">Inbox</a>'); ?>
									<?php showprivilage($username,'status-req','<a class="nav-link" href="index.php?button=status-req">Status</a>'); ?>
								</nav>
                            </div>
							<?php showprivilage($username,'e-form','<a class="nav-link collapsed" href="#" data-toggle="collapse" 
							data-target="#colle-form" aria-expanded="false" aria-controls="collapseLayouts">
							<div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>E-Form
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div></a>'); ?>
                            <div class="collapse" id="colle-form" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
									<?php showprivilage($username,'nprf','<a class="nav-link" href="index.php?button=nprf">New Product Review Form D/E (NPRF)</a>'); ?>
									<?php showprivilage($username,'fnim','<a class="nav-link" href="index.php?button=fnim">Final Name Internal Memo (FNIM)</a>'); ?>
									<?php showprivilage($username,'imis','<a class="nav-link" href="index.php?button=imis">Internal Memo IS</a>'); ?>
									<?php showprivilage($username,'mpr','<a class="nav-link" href="index.php?button=mpr">Master Product Request</a>'); ?>
									<?php showprivilage($username,'cfm','<a class="nav-link" href="index.php?button=cfm">Checklist Final Manuscript</a>'); ?>
									<?php showprivilage($username,'faw','<a class="nav-link" href="index.php?button=faw">Final Art Work</a>'); ?>
									<?php showprivilage($username,'lamdd','<a class="nav-link" href="index.php?button=lamdd">Lampiran DD</a>'); ?>
									<?php showprivilage($username,'spec-product','<a class="nav-link" href="index.php?button=spec-product">Spec Product</a>'); ?>
								</nav>
                            </div>

							<?php showprivilage($username,'f1','<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collproduction"
							aria-expanded="false" aria-controls="collapseLayouts"><div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>Production
							<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div></a>'); ?>
							
                            <div class="collapse" id="collproduction" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
									<?php showprivilage($username,'prod-arm','<a class="nav-link" href="index.php?button=prod-arm">Additional Resource Master</a>'); ?>
								</nav>
                            </div>
							<?php showprivilage($username,'packaging','<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collpackaging"
							aria-expanded="false" aria-controls="collapseLayouts"><div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>Packaging
							<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div></a>'); ?>
							
                            <div class="collapse" id="collpackaging" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
									<?php showprivilage($username,'packaging-arm','<a class="nav-link" href="index.php?button=arm">Additional Resource Master F1</a>'); ?>
									<?php showprivilage($username,'packaging-arm-f2','<a class="nav-link" href="index.php?button=arm-f2">Additional Resource Master F2</a>'); ?>
									<?php showprivilage($username,'packaging-spesification','<a class="nav-link" href="index.php?button=ps">Packaging Spesification</a>'); ?>
								</nav>
                            </div>						
							<?php showprivilage($username,'k2','<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collk2"
							aria-expanded="false" aria-controls="collapseLayouts"><div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>Master Product
							<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div></a>'); ?>
							
                            <div class="collapse" id="collk2" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
									<?php showprivilage($username,'resource','<a class="nav-link" href="index.php?button=resource">Master Item</a>'); ?>
									<?php showprivilage($username,'resource','<a class="nav-link" href="index.php?button=resource-ori">View Original Master Item</a>'); ?>
								</nav>
                            </div>
							<?php showprivilage($username,'addon-flex','<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#colladdon-flex"
							aria-expanded="false" aria-controls="collapseLayouts"><div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>Add On FlexProcess
							<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div></a>'); ?>
							<div class="collapse" id="colladdon-flex" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
									<?php showprivilage($username,'line-operator','<a class="nav-link" href="index.php?button=line-operator">Line Operator</a>'); ?>
									<?php showprivilage($username,'no-machine-time','<a class="nav-link" href="index.php?button=no-machine-time">No Machine Time</a>'); ?>
								</nav>
                            </div>
							<?php showprivilage($username,'po-online','<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collPOOnline"
							aria-expanded="false" aria-controls="collapseLayouts"><div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>PO Online
							<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div></a>'); ?>
							
                            <div class="collapse" id="collPOOnline" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
									<?php showprivilage($username,'supplier-register','<a class="nav-link" href="index.php?button=supplier-register">Supplier Register</a>'); ?>
									<?php showprivilage($username,'po-convertion','<a class="nav-link" href="index.php?button=po-convertion">PO Convertion Status</a>'); ?>

								</nav>
                            </div>
							<?php showprivilage($username,'report-list','<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collReportList"
							aria-expanded="false" aria-controls="collapseLayouts"><div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>Report List E-Form
							<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div></a>'); ?>
							<div class="collapse" id="collReportList" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
									<?php showprivilage($username,'report-list','<a class="nav-link" href="index.php?button=report-list&workflow=nprf">New Product Review Form D/E (NPRF)</a>'); ?>
									<?php showprivilage($username,'report-list','<a class="nav-link" href="index.php?button=report-list&workflow=fnim">Final Name Internal Memo (FNIM)</a>'); ?>
									<?php showprivilage($username,'report-list','<a class="nav-link" href="index.php?button=report-list&workflow=imis">Internal Memo IS</a>'); ?>
									<?php showprivilage($username,'report-list','<a class="nav-link" href="index.php?button=report-list&workflow=mpr">Master Product Request</a>'); ?>
									<?php showprivilage($username,'report-list','<a class="nav-link" href="index.php?button=report-list&workflow=cfm">Checklist Final Manuscript</a>'); ?>
									<?php showprivilage($username,'report-list','<a class="nav-link" href="index.php?button=report-list&workflow=faw">Final Art Work</a>'); ?>
									<?php showprivilage($username,'report-list','<a class="nav-link" href="index.php?button=report-spec-product">Spec Product</a>'); ?>
								</nav>
                            </div>
							<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collHelp"
							aria-expanded="false" aria-controls="collapseLayouts"><div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>Help
							<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div></a>
							<div class="collapse" id="collHelp" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
									<a class="nav-link" href="index.php?button=help&menu=K2">K2 Launching Date</a>
									<a class="nav-link" href="index.php?button=help&menu=nprf">NPRF</a> 
									<a class="nav-link" href="index.php?button=help&menu=fnim">FNIM</a>								
								</nav>
                            </div>
                           <a class="nav-link collapsed" href="../config/logout-exe.php">
						  <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>Logout</a> 
							
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">   
                                </nav>
                        

                      </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in E-Form as:</div>
                         <?php echo $name; ?> <br>
						<?php echo $division; ?>
                    </div>
                </nav>
            </div>
            
  <div id="layoutSidenav_content"> 
    <!-- Disini mulai -->
    <main> 
    <?php 
	if(isset($_GET['button'])){
		$page = $_GET['button'];
 
		switch ($page) {
			case 'dashboard':
				include "dashboard.php";
				break;
			case 'user-setting':
				include "user-setting/user-setting.php";
				break;
				
			case 'add-user-setting'; case 'edit-user-setting':
				include "user-setting/user-setting-add.php";
				//include "test1.php";
				break;
			case 'user-setting-privilage'; case 'User Setting Privilage':
				include "user-setting/user-setting-privilage.php";
				break;
				
			case 'work-flow':
				include "work-flow/work-flow.php";
				break;
			case 'add-work-flow'; case 'edit-work-flow':
				include "work-flow/work-flow-add.php";
				break;
			case 'work-flow-process':
				include "work-flow/work-flow-process.php";
				break;
						
			case 'work-flow-menu':
				include "work-flow-menu/work-flow-menu.php";
				break;
			case 'add-work-flow-menu' ; case 'edit-work-flow-menu' :
				include "work-flow-menu/work-flow-menu-add.php";
				break;
						
			case 'division':
				include "division/division.php";
				break;
			case 'add-division'; case 'edit-division':
				include "division/division-add.php";
				break;
				
			case 'position':
				include "position/position.php";
				break;
			case 'add-position':
				include "position/position-add.php";
				break;
			case 'edit-position':
				include "position/position-add.php";
				break;

			case 'trading-partner':
				include "trading-partner/trading-partner.php";
				break;
			case 'add-trading-partner':
				include "trading-partner/trading-partner-add.php";
				break;
			case 'edit-trading-partner':
				include "trading-partner/trading-partner-add.php";
				break;
				
			case 'currency':
				include "currency/currency.php";
				break;
			case 'add-currency'; case 'edit-currency':
				include "currency/currency-add.php";
				break;

			case 'format-no-req':
				include "format-no-req/format-no-req.php";
				break;
			case 'add-format-no-req' ; case 'edit-format-no-req' :
				include "format-no-req/format-no-req-add.php";
				break;

			case 'templete':
				include "templete/templete.php";
				break;
			case 'add-templete' ; case 'edit-templete' :
				include "templete/templete-add.php";
				break;
			
			case 'sent-to':
				include "sent-to/sent-to.php";
				break;
			case 'add-sent-to' ;case 'edit-sent-to':
				include "sent-to/sent-to-add.php";
				break;
			case 'address-to':
				include "address-to/address-to.php";
				break;
			case 'add-address-to' ;case 'edit-address-to':
				include "address-to/address-to-add.php";
				break;
				
			case 'type':
				include "type/type.php";
				break;
			case 'add-type' ;case 'edit-type':
				include "type/type-add.php";
				break;
			
			case 'brand':
				include "brand/brand.php";
				break;
			case 'add-brand' ;case 'edit-brand':
				include "brand/brand-add.php";
				break;
						
			case 'bisnis':
				include "bisnis/bisnis.php";
				break;
			case 'add-bisnis' ;case 'edit-bisnis':
				include "bisnis/bisnis-add.php";
				break;

			case 'category':
				include "category/category.php";
				break;
			case 'add-category'; case 'edit-category':
				include "category/category-add.php";
				break;
				
			case 'series':
				include "series/series.php";
				break;
			case 'add-series'; case 'edit-series':
				include "series/series-add.php";
				break;
				
			case 'segmentation':
				include "segmentation/segmentation.php";
				break;
			case 'add-segmentation'; case 'edit-segmentation':
				include "segmentation/segmentation-add.php";
				break;
				
			case 'dashboard-image':
				include "dashboard-image/dashboard-image.php";
				break;
			case 'add-dashboard-image' ; case 'edit-dashboard-image' :
				include "dashboard-image/dashboard-image-add.php";
				break;
							
			case 'nprf':
				include "nprf/nprf.php";
				break;
			case 'add-nprf'; case 'add-revise-nprf'; case 'edit-nprf' :
				include "nprf/nprf-add.php";
				break;
			case 'add-nprf-upload'; case 'add-revise-nprf-upload'; case 'edit-nprf-upload' :
				include "nprf/nprf-add-upload.php";
				break;
			case 'revise-nprf':
				include "nprf/nprf-revise.php";
				break;
			case 'nprf-app':
				include "nprf/nprf-app.php";
				break;
			case 'nprf-status-req';	
				include "nprf/nprf-status-req.php";
				break;
				
			case 'fnim':
				include "fnim/fnim.php";
				break;
			case 'add-fnim'; case 'add-revise-fnim'; case 'edit-fnim' :
				include "fnim/fnim-add.php";
				break;
			case 'revise-fnim':
				include "fnim/fnim-revise.php";
				break;
			case 'fnim-app':
				include "fnim/fnim-app.php";
				break;
			case 'fnim-status-req';	
				include "fnim/fnim-status-req.php";
				break;

			case 'mpr':
				include "mpr/mpr.php";
				break;
			case 'add-mpr'; case 'edit-mpr' :
				include "mpr/mpr-add.php";
				break;
			case 'revise-mpr':
				include "mpr/mpr-revise.php";
				break;
			case 'mpr-app':
				include "mpr/mpr-app.php";
				break;
			case 'mpr-status-req';	
				include "mpr/mpr-status-req.php";
				break;
			
			case 'cfm':
				include "cfm/cfm.php";
				break;
			case 'add-cfm'; case 'add-revise-cfm'; case 'edit-cfm' :
				include "cfm/cfm-add.php";
				break;
			case 'revise-cfm':
				include "cfm/cfm-revise.php";
				break;
			case 'cfm-app':
				include "cfm/cfm-app.php";
				break;
			case 'cfm-status-req';	
				include "cfm/cfm-status-req.php";
				break;
			
			case 'faw':
				include "faw/faw.php";
				break;
			case 'add-faw'; case 'add-revise-faw'; case 'edit-faw' :
				include "faw/faw-add.php";
				break;
			case 'revise-faw':
				include "faw/faw-revise.php";
				break;
			case 'faw-app':
				include "faw/faw-app.php";
				break;
			case 'faw-status-req';	
				include "faw/faw-status-req.php";
				break;

			case 'lamdd':
				include "lamdd/lamdd.php";
				break;
			case 'add-lamdd';  case 'edit-lamdd' :
				include "lamdd/lamdd-add.php";
				break;
			case 'lamdd-status-req';	
				include "lamdd/lamdd-status-req.php";
				break;

			case 'spec-product':
				include "spec-product/spec-product.php";
				break;
			case 'add-spec-product';  case 'spec-product-edit' ; case 'revise-sp';case 'add-revise-spec-product' :
				include "spec-product/spec-product-add.php";
				break;
			case 'sp-app':
				include "spec-product/spec-product-app.php";
				break;
			case 'report-spec-product' :
				include "spec-product/spec-product-report.php";
				break;
			
			case 'prod-arm':
				include "production-arm/arm.php";
				break;
			case 'prod-arm-add' ; case 'prod-arm-edit'; case 'revise-prod-arm'; case 'add-revise-prod-arm' ; case 'add-copy-prod-arm' :
				include "production-arm/arm-add.php";
				break;
			case 'prod-arm-detail-add';
				include "production-arm/arm-detail-add.php";
				break;
			case 'prod-arm-detail-type-work-process';
				include "production-arm/arm-detail-form-type-work-process.php";
				break;
			case 'prod-arm-detail-type-finish-goods';
				include "production-arm/arm-detail-form-type-finish-goods.php";
				break;

			case 'prod-arm-detail-type-cust-vend';
				include "production-arm/arm-detail-form-type-cust-vend.php";
				break;
			case 'prod-arm-app':
				include "production-arm/arm-app.php";
				break;
			case 'prod-arm-status-req';	
				include "production-arm/arm-status-req.php";
				break;
			case 'prod-arm-detail-app';
				include "production-arm/arm-detail-app.php";
				break;

			case 'arm':
				include "packaging-arm/arm.php";
				break;
			case 'arm-add' ; case 'arm-edit'; case 'revise-arm'; case 'add-revise-arm' ; case 'add-copy-arm' :
				include "packaging-arm/arm-add.php";
				break;
			case 'arm-detail-add';
				include "packaging-arm/arm-detail-add.php";
				break;
			case 'arm-app':
				include "packaging-arm/arm-app.php";
				break;
			case 'arm-status-req';	
				include "packaging-arm/arm-status-req.php";
				break;
			case 'arm-detail-app';
				include "packaging-arm/arm-detail-app.php";
				break;
				
			case 'arm-f2':
				include "packaging-arm-f2/arm.php";
				break;
			case 'arm-f2-add' ; case 'arm-f2-edit'; case 'revise-arm-f2'; case 'add-revise-arm-f2'; case 'add-copy-arm-f2' :
				include "packaging-arm-f2/arm-add.php";
				break;
			case 'arm-f2-detail-add';
				include "packaging-arm-f2/arm-detail-add.php";
				break;
			case 'arm-f2-app':
				include "packaging-arm-f2/arm-app.php";
				break;
			case 'arm-f2-status-req';	
				include "packaging-arm-f2/arm-status-req.php";
				break;
			case 'arm-detail-app';
				include "packaging-arm-f2/arm-detail-app.php";
				break;

			case 'ps':
				include "packaging-ps/ps.php";
				break;
			case 'ps-add' ; case 'ps-edit'; case 'revise-ps'; case 'add-revise-ps'  ; case 'add-copy-ps' :
				include "packaging-ps/ps-add.php";
				break;
			case 'ps-detail-add';
				include "packaging-ps/ps-detail-add.php";
				break;
			case 'ps-app':
				include "packaging-ps/ps-app.php";
				break;
			case 'ps-status-req';	
				include "packaging-ps/ps-status-req.php";
				break;

			case 'resource':
				//include "resource/resource.php";
				include "resource/resourceRevisiKoneksi.php";
				break;
			case 'resource-ori':
				include "resource/rpt-resource-ori.php";
				break;
			case 'edit-resource' :
				include "resource/resource-edit.php";
				break;
			case 'line-operator';
				include "flex-manhours/line-operator.php";
				break;
			case 'no-machine-time';
				include "flex-manhours/no-machine-time.php";
				break;
			case 'supplier-register':
				include "supplier-register/supplier-register.php";
				break;
			case 'add-supplier-register'; case 'edit-supplier-register' :
				include "supplier-register/supplier-register-add.php";
				break;

			case 'po-convertion':
				include "po-convertion/po-convertion.php";
				break;
			case 'po-approve':
				include "po-convertion/approve.php";
				break;
								
			case 'inbox':
				include "inbox.php";
				break;	
			case 'status-req':
				include "status-req.php";
				break;	
			case 'complete-req':
				include "complete-req.php";
				break;	
			case 'report-list':
				include "report-list.php";
				break;
			case 'help':
				include "help.php";
				break;	
			case 'test':
				include "test1.php";
				break;	
			default:
				echo "<br><center><h3>Maaf. Halaman tidak di temukan !</h3></center>";
				break;
		}
	}else{
		include "dashboard.php";
	}
 
	 ?>
    </main> <footer class="py-4 bg-light mt-auto"> 
    <div class="container-fluid"> 
      <div class="d-flex align-items-center justify-content-between small"> 
        <div class="text-muted">Copyright &copy; Your Website 2020</div>
        <div> <a href="#">Privacy Policy</a> &middot; <a href="#">IT Team</a> 
        </div>
      </div>
    </div>
    </footer> </div>
        </div>
        <!--script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script-->
		<script src="../js/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
        <!--script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script-->
		<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../js/scripts.js"></script>
      
        <!--script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script-->
		<script src="../js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <!--script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script-->
        <script src="../vendor/bootstrap/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>
		
    </body>
</html>