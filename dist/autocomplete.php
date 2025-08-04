

 <?php
include "../config/connect.php";
include "../config/conn.php";

$term = $_GET['search'];
      
   $query = mysqli_query($con,"Select UserDomain FROM tb_user  WHERE UserDomain like '%h%'");
   
    if (mysqli_num_rows($query) > 0) {
     while ($user = mysqli_fetch_array($query)) {
      $res[] = $user['UserDomain'];
     }
    } else {
      $res = array();
    }
    //return json res
    echo json_encode($res);
}
?>