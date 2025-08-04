<?php
if (!empty($_GET["id"])){
	$id=$_GET["id"];
	if(isset($_GET['form'])){
			$page = $_GET['form'];
			switch ($page) {
				case 'tracking':
					require "../config/tracking-popup.php";
					break;
				case 'workflow':
					require "../config/workflow-popup.php";
					break;
				case 'privew-nprf':
					require "../config/export-nprf.php";
					break;
				case 'privew-fnim':
					require "../config/export-fnim.php";
					break;
				case 'privew-mpr':
					require "../config/export-mpr.php";
					break;
				case 'privew-cfm':
					require "../config/export-cfm.php";
					break;
				case 'privew-faw':
					require "../config/export-faw.php";
					break;
				case 'privew-lamdd':
					require "../config/export-lamdd.php";
					break;
				case 'cfm-comment' ; case 'faw-comment':
					require "../config/popup-comment.php";
					break;
				case 'privew-arm' ;
					require "../config/export-arm.php";
					break;
				case 'privew-arm-f2' ;
					require "../config/export-arm-f2.php";
					break;
				case 'privew-ps' ;
					require "../config/export-ps.php";
					break;
				case 'privew-prod-arm' ;
					require "../config/export-arm-f1.php";
					break;
				default:
					echo "<br><center><h3>Maaf. Halaman tidak di temukan !</h3></center>";
					break;
			}
		}
	
}else{
	echo '<script language="javascript">
	alert("Tidak bisa mengakses data ini...");
	window.location="../dist/login.php";
	</script>';
	exit();
	$error++;


}
?>