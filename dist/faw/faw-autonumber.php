<?php 
//FAW AUTO NUMBER________________________________________________________________________________
$queryFAW = "SELECT Request_No FROM tb_format_req_no WHERE WorkFlowMenu='FAW'";
$hasilFAW = mysqli_query($con,$queryFAW);
$dataFAW  = mysqli_fetch_array($hasilFAW);
$bulan = date('m');
$tahun = date ('Y');
// membaca kode  terbesar dari penomoran yang ada didatabase berdasarkan tanggal
$query = "SELECT IfNULL(Max(ID_No)+1,1) as MaxID FROM tb_faw WHERE month(CreatedDate)='$bulan' And  Year(CreatedDate)='$tahun'";
$hasil = mysqli_query($con,$query);
$data  = mysqli_fetch_array($hasil);
$noUrut= $data['MaxID'];
if ($noUrut <= 9){
	$NomorReq = $dataFAW['Request_No']."-".$tahun."-".$bulan."-000".$noUrut;}
elseif ($noUrut <= 99){
	$NomorReq = $dataFAW['Request_No']."-".$tahun."-".$bulan."-00".$noUrut;}
elseif ($noUrut <= 999){
	$NomorReq = $dataFAW['Request_No']."-".$tahun."-".$bulan."-0".$noUrut;}
elseif ($noUrut <= 9999){
	$NomorReq = $dataFAW['Request_No']."-".$tahun."-".$bulan."-".$noUrut;}
		//________________________________________________________________________________FAW
?>