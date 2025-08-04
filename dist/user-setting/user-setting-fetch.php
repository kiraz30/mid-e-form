  <?php  
 //fetch.php  
	include '../config/connect.php';

 if(isset($_POST["employee_id"]))  
 {  
      $query = "SELECT a.UserDomain,a.Name,a.Email,b.DivisionName,c.PositionName FROM tb_user a Inner Join tb_Division b 
				ON a.KDDivision=b.KDDivision Inner Join tb_Position c On a.KDPosition=c.KDPosition WHERE UserDomain = '".$_POST["employee_id"]."'";  
      $result = mysqli_query($con,$conn,$query);  
      $row = mysqli_fetch_array($result);  
      echo json_encode($row);  
 }  
 ?>
 