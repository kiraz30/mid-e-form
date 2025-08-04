<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title><?php echo $_GET["pg"];?> <?php echo $_GET["name"];?></title>
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body>
<?php
 include "../config/connect.php";
 if($_GET["pg"]=="filecfm"){
	 if(!empty($_GET["id"]))
	 {  
		$exe = mysqli_query($con,"SELECT a.Kemasan,a.Posisi,a.File FROM tb_cfm_file a WHERE ID_No = '".$_GET["id"]."' ");
		while(@$row =mysqli_fetch_array($exe)){ 
			if (empty($row['File']))
			{
				echo "<img height='100%' width='100%' title='Kemasan [".$row['Kemasan']."] Posisi [".$row['Posisi']."]
				' src='../Sign/empty.png'>";
			} 
			else 
			{ 
				echo "Kemasan : ".$row['Kemasan']." <br>
				Posisi : ".$row['Posisi'];
				 
				echo "<img height='100%' width='100%' title='Kemasan [".$row['Kemasan']."] Posisi [".$row['Posisi']."]'
				 src='../img/Attachment_Image/".$row['File']."'>";
			}
		}
	 }
	 else{ echo "Access to this resource is denied.";}
}elseif($_GET["pg"]=="filefaw"){
	 if(!empty($_GET["id"]))
	 {  
		$exe = mysqli_query($con,"SELECT a.Kemasan,a.Posisi,a.File FROM tb_faw_file a WHERE ID_No = '".$_GET["id"]."' ");
		while(@$row =mysqli_fetch_array($exe)){ 
			if (empty($row['File']))
			{
				echo "<img height='100%' width='100%' title='Kemasan [".$row['Kemasan']."] Posisi [".$row['Posisi']."]
				' src='../Sign/empty.png'>";
			} 
			else 
			{ 
				echo "Kemasan : ".$row['Kemasan']." <br>
				Posisi : ".$row['Posisi'];
				 
				echo "<img height='100%' width='100%' title='Kemasan [".$row['Kemasan']."] Posisi [".$row['Posisi']."]'
				 src='../img/Attachment_Image/".$row['File']."'>";
			}
		}
	 }
	 else{ echo "Access to this resource is denied.";}
}elseif($_GET["pg"]=="filelamdd"){
	 if(!empty($_GET["id"]))
	 {  
		$exe = mysqli_query($con,"SELECT a.Kemasan,a.Posisi,a.File FROM tb_lamdd_file a WHERE ID_No = '".$_GET["id"]."' ");
		while(@$row =mysqli_fetch_array($exe)){ 
			if (empty($row['File']))
			{
				echo "<img height='100%' width='100%' title='Kemasan [".$row['Kemasan']."] Posisi [".$row['Posisi']."]
				' src='../Sign/empty.png'>";
			} 
			else 
			{ 
				echo "Kemasan : ".$row['Kemasan']." <br>
				Posisi : ".$row['Posisi'];
				 
				echo "<img height='100%' width='100%' title='Kemasan [".$row['Kemasan']."] Posisi [".$row['Posisi']."]'
				 src='../img/Attachment_Image/".$row['File']."'>";
			}
		}
	 }
	 else{ echo "Access to this resource is denied.";}
}elseif($_GET["pg"]=="fileSpecProduct"){
	 if(!empty($_GET["id"]))
	 {  
		$exe = mysqli_query($con,"SELECT Product_Image FROM tb_spec_product WHERE ID_No = '".$_GET["id"]."' ");
		while(@$row =mysqli_fetch_array($exe)){ 
			if (empty($row['Product_Image']))
			{
				echo "<img height='100%' width='100%' title='Gambar Spec Product [".$row['Product_Image']."]' src='../Sign/empty.png'>";
			} 
			else 
			{			 
				echo "<img height='100%' width='100%' title='Gambar Spec Product [".$row['Product_Image']."]'
				src='../img/Spec_Product/".$row['Product_Image']."'>";
			}
		}
	 }
	 else{ echo "Access to this resource is denied.";}
}
 ?>
     </body>
</html>