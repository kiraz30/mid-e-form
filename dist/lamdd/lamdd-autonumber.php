<?php 
//LAMDD AUTO NUMBER________________________________________________________________________________
$queryLAMDD = "SELECT Request_No FROM tb_format_req_no WHERE WorkFlowMenu='LAMDD'";
$hasilLAMDD = mysqli_query($con,$queryLAMDD);
$dataLAMDD  = mysqli_fetch_array($hasilLAMDD);
$bulan = date('m');
$tahun = date ('Y');
// membaca kode  terbesar dari penomoran yang ada didatabase berdasarkan tanggal
$query = "SELECT IfNULL(Max(ID_No)+1,1) as MaxID FROM tb_lamdd WHERE month(CreatedDate)='$bulan' And  Year(CreatedDate)='$tahun'";
$hasil = mysqli_query($con,$query);
$data  = mysqli_fetch_array($hasil);
$noUrut= $data['MaxID'];
if ($noUrut <= 9){
	$NomorReq = $dataLAMDD['Request_No']."-".$tahun."-".$bulan."-000".$noUrut;}
elseif ($noUrut <= 99){
	$NomorReq = $dataLAMDD['Request_No']."-".$tahun."-".$bulan."-00".$noUrut;}
elseif ($noUrut <= 999){
	$NomorReq = $dataLAMDD['Request_No']."-".$tahun."-".$bulan."-0".$noUrut;}
elseif ($noUrut <= 9999){
	$NomorReq = $dataLAMDD['Request_No']."-".$tahun."-".$bulan."-".$noUrut;}
		//________________________________________________________________________________LAMDD
?>