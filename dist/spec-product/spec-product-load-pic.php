
 <?php
//memasukkan koneksi database
include "../../config/connect.php";

$inputPICProdev = $_POST['inputPICProdev'];
$inputBisnis = $_POST['inputBisnis'];
if ($inputBisnis =="GF"){
    $inputBisnis="2018GPRDV5";
}elseif ($inputBisnis =="GM"){
    $inputBisnis="20GPRDV1301";
}elseif ($inputBisnis =="LC"){
    $inputBisnis="20LCPRDV001";
}
if($inputBisnis!=''){
	$exe = mysqli_query($con,"SELECT a.UserDomain,b.Name,c.KDDivision,c.DivisionName FROM tb_workflowapproval a
    INNER JOIN tb_user b ON a.UserDomain=b.UserDomain
    INNER JOIN tb_division c ON b.KDDivision=c.KDDivision
    WHERE WorkFlowMenu='SP' AND LevelApproval='Requestor'
    AND c.KDDivision ='$inputBisnis'");
	while(@$row =mysqli_fetch_array($exe)){
        echo "<option value='" . $row['UserDomain'] . "'>" . $row['Name'] . "</option>";
    }
}
?>