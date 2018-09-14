<?php

include './sqlsrv.php';

$credential = getKey();
extract($credential);

$tanggalresep = date('Y-m-d');
$tanggalobat = date('Y-m-d');
$nosjp = $_POST['nosjp'];
$noresep = $_POST['noresep'];
$tipeobat = $_POST['tipeobat'];
$jenisracikan = $_POST['jenisracikan'];
$kodeobatrs = $_POST['kodeobatrs'];
$namaobat = $_POST['namaobat'];
$kodedokter = $_POST['kodedokter'];
$jumlahobat = json_encode($_POST['jumlahobat'], JSON_NUMERIC_CHECK);
$signa1 = json_encode($_POST['signa1'], JSON_NUMERIC_CHECK);
$signa2 = json_encode($_POST['signa2'], JSON_NUMERIC_CHECK);
$jumlahhari = json_encode($_POST['jumlahhari'], JSON_NUMERIC_CHECK);
$hdasar = json_encode($_POST['hdasar'], JSON_NUMERIC_CHECK);

$data1 = array( 
	"token" => $token,
	"kodeprovider" => $kodeprovider,
	"tanggalpelayanan" => $tanggalpelayanan,
	"nosjp"=> $nosjp,
	"noresep" => $noresep,
	"tipeobat" => $tipeobat,
	"jenisracikan" => $jenisracikan,
	"kodeobatrs" => $kodeobatrs,
	"namaobat" => $namaobat,
	"kodedokter" => $kodedokter,
	"username" => $username
);

$data2 = array(
	"jumlahobat" => $jumlahobat,
	"signa1" => $signa1,
	"signa2" => $signa2,
	"jumlahhari" => $jumlahhari,
	"hdasar" => $hdasar
);

$json1 = json_encode($data1);
$json2 = json_encode($data2, JSON_NUMERIC_CHECK);


$data_string = json_encode(array_merge(json_decode($json1, true), json_decode($json2, true)));

$ch = curl_init('https://dummy.inhealth.co.id/pelkesws2/api/SimpanObat');

curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);	
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	'Accept: application/json',
	'Content-Type: application/json',
	'Content-Length: ' . strlen($data_string))
);

try {
	$result = curl_exec($ch);

	$hasil = json_decode($result, true);
	$info = curl_getinfo($ch);
	
	print_r($hasil);
} catch (Exception $e) {
	die(print_r($e->getMessage()));
}

?>