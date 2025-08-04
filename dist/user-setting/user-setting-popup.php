<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title><?php echo $_GET["pg"];?> <?php echo $_GET["id"];?></title>
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body>
<?php
 include "../../config/connect.php";
 if($_GET["pg"]=="user-setting"){
	 if(!empty($_GET["id"]))
	 {  
		$exe = mysqli_query($con,"SELECT SignIN FROM tb_user WHERE UserDomain = '".$_GET["id"]."' ");
		while(@$row =mysqli_fetch_array($exe)){ 
			if (empty($row['SignIN']))
			{
				echo "<img height='100%' width='100%' title='Signature' src='../Sign/empty.png'>";
			} 
			else 
			{ 
				echo "<img height='100%' width='100%' title='Signature' src='../Sign/".$row['SignIN']."'>";
			}
		}
	 }
	 else{ echo "Access to this resource is denied.";}
}
 elseif($_GET["pg"]=="dashboard-image"){
 	 if(!empty($_GET["id"]))
	 {  
		$exe = mysqli_query($con,"SELECT Image FROM tb_dashboard_image WHERE KDDashboardImage = '".$_GET["id"]."' ");
		while(@$row =mysqli_fetch_array($exe)){ 
			if (empty($row['Image']))
			{
				echo "<img height='100%' width='150%' title='Signature' src='../../img/empty.png'>";
			} 
			else 
			{ 
				echo "<img height='100%' width='150%' title='Signature' src='../../img/".$row['Image']."'>";
			}
		}
	 }
	 else{ echo "Access to this resource is denied.ss";}
	 }
 ?>
     </body>
</html>