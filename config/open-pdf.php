<?php  
include "connect.php";

session_start(); //kuncinya ada disini, tulis diawal script sebelum menulis yang lain

if($_SESSION["usernameeform"]=="" ) //untuk mencegah apabila halaman diakses tanpa login (session kosong), maka otomatis di redirect ke form 
{
	ob_start();
	header("location:../dist/login.php");
	ob_end_flush();
}

date_default_timezone_set("Asia/Jakarta");
$createddate=date("Y-m-d H:i:s");
$kd					=@$_GET["kd"];
$folder				=@$_GET["folder"];
$page				=@$_GET["page"];
$pdfname			=@$_GET["pdfname"];
$file	 			= "../file/";
 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Open Pdf </title>
</head>

<body>
<?php
// Header content type <br />
if ($page=="nprf"){
	$query = "SELECT Mcj,Master_Schedule FROM tb_nprf WHERE Request_No = '$kd'";
	$result = mysqli_query($con,$query) or die('Error, query failed');
	$tampildata=mysqli_fetch_array($result);
	$mcjfile= $tampildata['Mcj'];
	$Master_Schedulefile= $tampildata['Master_Schedule'];
	header('Content-type: application/pdf'); 
	if ($pdfname=="mcj"){
		header('Content-Disposition: inline; filename="' . $folder.$mcjfile . '"'); 
		header('Content-Transfer-Encoding: binary'); 
		header('Accept-Ranges: bytes'); 
		@readfile($folder.$mcjfile); 
	}
	else{
		header('Content-Disposition: inline; filename="' . $folder.$Master_Schedulefile . '"'); 
		header('Content-Transfer-Encoding: binary'); 
		header('Accept-Ranges: bytes'); 
		@readfile($folder.$Master_Schedulefile); 
	}
	exit;
 }		
if ($page=="fnim"){
	$result = mysqli_query($con, "SELECT Mcj FROM tb_fnim WHERE Request_No = '$kd'") or die('Error, query failed');
	$tampildata=mysqli_fetch_array($result);
	$mcjfile= $tampildata['Mcj'];
	header('Content-type: application/pdf'); 
	if ($pdfname=="mcj"){
		header('Content-Disposition: inline; filename="' . $folder.$mcjfile . '"'); 
		header('Content-Transfer-Encoding: binary'); 
		header('Accept-Ranges: bytes'); 
		@readfile($folder.$mcjfile); 
	}
	exit;
 }
if ($page=="filefnim"){
	$result = mysqli_query($con, "SELECT File FROM tb_fnim_file WHERE ID_No = '$kd'") or die('Error, query failed');
	$tampildata=mysqli_fetch_array($result);
	$pdffile= $tampildata['File'];
	header('Content-type: application/pdf'); 
	header('Content-Disposition: inline; filename="' . $file.$pdffile . '"'); 
	header('Content-Transfer-Encoding: binary'); 
	header('Accept-Ranges: bytes'); 
	@readfile($file.$pdffile); 
	exit;
}
if ($page=="filearm"){
	$result = mysqli_query($con, "SELECT FileLampiran 
	FROM tb_packdev_add_resource_doc_lampiran WHERE No_ID = '$kd'") or die('Error, query failed');
	$tampildata=mysqli_fetch_array($result);
	$pdffile= $tampildata['FileLampiran'];
	header('Content-type: application/pdf'); 
	header('Content-Disposition: inline; filename="' . $file.$pdffile . '"'); 
	header('Content-Transfer-Encoding: binary'); 
	header('Accept-Ranges: bytes'); 
	@readfile($file.$pdffile); 
	exit;
}

if ($page=="filempr" ){

		header('Content-type: application/pdf'); 
		header('Content-Disposition: inline; filename="' . $file.$pdfname . '"'); 
		header('Content-Transfer-Encoding: binary'); 
		header('Accept-Ranges: bytes'); 
		// Read the file 
		@readfile($file.$pdfname); 
 }
 
?></body>
</html>


