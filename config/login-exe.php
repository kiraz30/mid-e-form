<?php
session_start(); //kuncinya ada disini, tulis diawal script sebelum menulis yang lain
include "connect.php";/* Ambil variabel */
$username = @$_GET['username'];
/* Validasi */
$error = 0;
if( empty( $username )) 	{
	echo '<script language="javascript">
	alert("Username Domain or Password Domain is Empty...");
	window.location="../dist/login.php";
	</script>';
	exit();
	$error++;
	}
else{

	$query = mysqli_query($con,"SELECT a.UserDomain,a.Name,a.Email,b.KDDivision,b.DivisionName,a.KDPosition,c.PositionName,a.StatusUser,a.`Level` FROM tb_user a Inner Join tb_Division b 
	ON a.KDDivision=b.KDDivision Inner Join tb_Position c On a.KDPosition=c.KDPosition WHERE a.UserDomain ='".$_GET['username']."'")
	or die(mysqli_error($con));
	if (mysqli_num_rows($query) !=0 ) { 
		while(@$tampildata =mysqli_fetch_array($query))
		{
			$_SESSION['usernameeform'] = $tampildata['UserDomain'];
			$_SESSION['nameusereform'] = $tampildata['Name'];
			$_SESSION['hostnameeform'] = gethostbyaddr($_SERVER['REMOTE_ADDR'])." ".$_SERVER['REMOTE_ADDR'];
			$_SESSION['divisioncodeeform'] = $tampildata['KDDivision'];
			$_SESSION['divisioneform'] = $tampildata['DivisionName'];
			$_SESSION['positioneform'] = $tampildata['KDPosition'];
			$_SESSION['leveleform'] = $tampildata['Level'];
		}
		header( 'Location:../dist/index.php?button=dashboard');
		exit();
	}
	else {
		echo '<script language="javascript">
			alert("Username Domain can`t Register for E-Form, call Administrar...");
			window.location="../dist/login.php";
			</script>';
		}

}
?>