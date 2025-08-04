<?php					
 for($i=0;$i<count(@$_POST['tempfileid']);$i++){
 	$index			= $i+1;
	$temp			= @$_POST['tempfileid'][$i];
	$inputComment	= @$_POST['inputComment'][$i];
	if(trim($inputComment)!=''){
		mysqli_query($con,"Insert INTO tb_cfm_file_comment (Request_No,ID_No_CFM_File,Komentar,StatusWorkFlow,
		Index_No,CreatedBy,CreatedDate,CreatedHostName) 
		values ('$inputAutoRequestNo','$temp','$inputComment','$StatusInbox',
		'$index','$username','$createddate','$ip : $hostname')");
		echo 'Berhasil Kenyimpan Komentar<br/>'; //pesan berhasil
	}
}
?>