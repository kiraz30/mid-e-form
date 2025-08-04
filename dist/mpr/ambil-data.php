  <?php 

	include "../../config/connect.php";
if (isset($_POST['Bisnis'])) {
    $Bisnis = $_POST["Bisnis"];

    $sql = "select KDCategory,NamaCategory from tb_category where Bisnis='$Bisnis' Order By NamaCategory Asc ";
    $hasil = mysqli_query($con, $sql);
	echo '<option value="-" >Select Category</option>';
    while ($data = mysqli_fetch_array($hasil)) {
        ?>
		
        <option value="<?php echo  $data['KDCategory']; ?>"><?php echo $data['NamaCategory']; ?></option>
        <?php
    }
}
	
?>
