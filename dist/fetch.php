
 <?php
//memasukkan koneksi database
	include '../config/connect.php';

//jika berhasil/ada post['id'], jika tidak ada ya tidak dijalankan
if($_POST['id']){
	//membuat variabel id berisi post['id']
	$id = $_POST['id'];
	//query standart select where id
	// query ke database, query standart ya dengan mysqli
				$exe = mysqli_query($con,"SELECT a.UserDomain,a.Name,a.Email,b.DivisionName,c.PositionName FROM tb_user a Inner Join tb_Division b 
				ON a.KDDivision=b.KDDivision Inner Join tb_Position c On a.KDPosition=c.KDPosition Where UserDomain='$id' ");
				$no = 1;
				while(@$row =mysqli_fetch_array($exe)){
		//menampilkan data dengan table
		echo '
		<p>Berikut ini adalah detail dari data siswa <b>'.$row['UserDomain'].'</b></p>
		<table class="table table-bordered">
			<tr>
				<th>NAMA LENGKAP</th>
				<td>'.$row['Name'].'</td>
			</tr>
			<tr>
				<th>Email</th>
				<td>'.$row['Email'].'</td>
			</tr>
			<tr>
				<th>JURUSAN</th>
				<td>'.$row['DivisionName'].'</td>
			</tr>
		</table>
		';
	}
}
?>