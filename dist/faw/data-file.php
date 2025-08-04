<?php 

$idpalavras = filter_input(INPUT_POST, 'idpalavras', FILTER_SANITIZE_NUMBER_INT);
$success = false;
if ($idpalavras) {
    include "../config/connect.php";  //connection to database
	$exe =mysqli_query($con,"SELECT ID_No,Request_No,File FROM tb_cfm_file where ID_No = '".$idpalavras."' ");
	while(@$rowFile=mysqli_fetch_array($exe)){	
		if (!empty($rowFile['File'])){
			unlink($file.@$rowFile['File']);
			mysqli_query($con,"Delete From tb_cfm_file WHERE ID_No = '".$idpalavras."' "); 
			$success = true;
		}
	}
}
header('Content-Type: application/json');
echo json_encode(array('success' => $success)); 
?>