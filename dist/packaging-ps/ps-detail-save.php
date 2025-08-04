<?php
//MPR DETAIL
if (is_array(@$_POST['tempID_No'])){
	for($i=0;$i<count(@$_POST['tempID_No']);$i++){
		if($_POST['tempID_No'][$i]<>"")	{
			$tempID_No					=$_POST['tempID_No'][$i];
			$exe=mysqli_query($con,"Select * From tb_packdev_spec_detail WHERE Request_No = '$inputAutoRequestNo'
			And ID_No='$tempID_No' ");
			if (mysqli_num_rows($exe) ==0 ) {
				mysqli_query($con,"Insert INTO tb_packdev_spec_detail (Request_No,Finish_Good_Code,ID_No_Resource_Detail,
				Index_No,UpdatedBy,UpdatedDate,UpdatedHostName) 
				values ('$inputAutoRequestNo','$tempID_No','$tempID_No',
				'$i+1','$username','$createddate','$ip : $hostname')");
				$message = "2";
					/*echo "<script type='text/javascript'>alert('$message');</script>";*/
			}
		}
	}
}

 

	
?>