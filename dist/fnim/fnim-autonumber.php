<?php 
//FNIM AUTO NUMBER________________________________________________________________________________
$queryFNIM = "SELECT Request_No FROM tb_format_req_no WHERE WorkFlowMenu='FNIM'";
$hasilFNIM = mysqli_query($con,$queryFNIM);
$dataFNIM  = mysqli_fetch_array($hasilFNIM);
$bulan = date('m');
$tahun = date ('Y');
// membaca kode  terbesar dari penomoran yang ada didatabase berdasarkan tanggal
$query = "SELECT IfNULL(Max(ID_No)+1,1) as MaxID FROM tb_fnim WHERE month(CreatedDate)='$bulan' And  Year(CreatedDate)='$tahun'";
$hasil = mysqli_query($con,$query);
$data  = mysqli_fetch_array($hasil);
$noUrut= $data['MaxID'];
if ($noUrut <= 9){
	$NomorReq = $dataFNIM['Request_No']."-".$tahun."-".$bulan."-000".$noUrut;}
elseif ($noUrut <= 99){
	$NomorReq = $dataFNIM['Request_No']."-".$tahun."-".$bulan."-00".$noUrut;}
elseif ($noUrut <= 999){
	$NomorReq = $dataFNIM['Request_No']."-".$tahun."-".$bulan."-0".$noUrut;}
elseif ($noUrut <= 9999){
	$NomorReq = $dataFNIM['Request_No']."-".$tahun."-".$bulan."-".$noUrut;}
		//________________________________________________________________________________FNIM
?>