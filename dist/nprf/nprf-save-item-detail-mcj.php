<?php
//NPRF DETAIL
if (is_array(@$_POST['tempItemDetail'])){
	for($i=0;$i<count(@$_POST['tempItemDetail']);$i++){
		if($_POST['tempItemDetail'][$i]<>"")	{
			$tempItemDetail				=$_POST['tempItemDetail'][$i];
			$InputMCJItemNo				=@$_POST['InputMCJItemNo'][$i];
			$exe=mysqli_query($con,"Select * From tb_nprf_item_detail WHERE Request_No = '$inputAutoRequestNo'
			And ID_No='$tempItemDetail' ");
			if (mysqli_num_rows($exe) !=0 ) {
				mysqli_query($con,"Update tb_nprf_item_detail Set MCJ_Item_No='$InputMCJItemNo'	Where ID_No ='".$tempItemDetail."' ");
			}
		}
	}
}
?>