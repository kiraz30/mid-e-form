<?php
			
mysqli_query($con,"Delete From tb_faw_check_app WHERE Request_No = '$inputAutoRequestNo' 
And Workflow_Index_No='".$Curent_Index."'");
if (is_array(@$_POST['tempFAWCheck'])){
	for($j=0;$j<count(@$_POST['tempFAWCheck']);$j++){
			$tempFAWCheck				=@$_POST['tempFAWCheck'][$j];
			$index						= $j+1;
			$InputResult				=@$_POST['InputResult'][$j];
			
			mysqli_query($con,"Insert INTO tb_faw_check_app (Request_No,Checklist_Code,Result,Workflow_Index_No,Index_No) 
			values ('$inputAutoRequestNo','$tempFAWCheck','$InputResult','".$Curent_Index."','".$index."')");
			echo 'Berhasil list faw '.$InputResult.' LIST<br/>'; //pesan berhasil
	}
}	
?>