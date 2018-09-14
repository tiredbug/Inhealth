<?php

include './sqlsrv.php';

$credential = getKey();
extract($credential);

$nosjp = $_POST['nosjp'];
$nomormedicalreport = $_POST['nomormedicalreport'];
$nomorasalrujukan = $_POST['nomorasalrujukan'];
$kodeproviderasalrujukan = $_POST['kodeproviderasalrujukan'];
$tanggalasalrujukan = date('Y-m-d');
$kodediagnosautama = $_POST['kodediagnosautama'];
$poli = $_POST['poli'];
$informasitambahan = $_POST['informasitambahan'];
$kodediagnosatambahan = $_POST['kodediagnosatambahan'];
$kecelakaankerja = json_encode($_POST['kecelakaankerja'], JSON_NUMERIC_CHECK);

$data1 = array( 
	"token" => $token,
	"kodeprovider" => $kodeprovider,
	"nosjp" => $nosjp,
	"nomormedicalreport" => $nomormedicalreport,
	"nomorasalrujukan" => $nomorasalrujukan,
	"kodeproviderasalrujukan" => $kodeproviderasalrujukan,
	"tanggalasalrujukan" => $tanggalasalrujukan,
	"kodediagnosautama" => $kodediagnosautama,
	"poli" => $poli,
	"username" => $username,
	"informasitambahan" => $informasitambahan,
	"kodediagnosatambahan" => $kodediagnosatambahan
);

$data2 = array(
	"kecelakaankerja" => $kecelakaankerja
);

$json1 = json_encode($data1);
$json2 = json_encode($data2, JSON_NUMERIC_CHECK);

$data_string = json_encode(array_merge(json_decode($json1, true), json_decode($json2, true)));

$ch = curl_init('https://dummy.inhealth.co.id/pelkesws2/api/UpdateSJP');

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