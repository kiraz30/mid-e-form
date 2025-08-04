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
		<link href="../dist/css/sb-admin-2.css" rel="stylesheet">
	
		<!-- Custom Fonts -->
		<link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
		
    </head>
    <body class="sb-nav-fixed">
	<main> 
    <div class="container-fluid"> 
      <h3 class="mt-4">Dashboard</h3>
      <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="index.php?button=dashboard">Dashboard</a></li>
        <li class="breadcrumb-item active">Help</li>
      </ol>
	  
	  
      <div class="card mb-4">
      <?php if (@$_GET['menu']=="K2") { ?>
	    <embed src="../help/resourcesp.pdf" width = "100%" height = "500px">
      <?php }elseif (@$_GET['menu']=="nprf") { ?>
      <embed src="../img/help/E-FORM NPRF.pdf" width = "100%" height = "500px">
      <?php }elseif (@$_GET['menu']=="fnim") { ?>
      <embed src="../img/help/E-FORM FNIM.pdf" width = "100%" height = "500px">
      <?php }  ?>
      </div>
    </div>
    </main> 
    </body>
</html>
