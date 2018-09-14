<?php

include './sqlsrv.php';

$credential = getKey();
extract($credential);

$nosjp = $_POST['nosjp'];
$noresep = $_POST['noresep'];
$kodeobat = $_POST['kodeobat'];
$alasan = $_POST['alasan'];

$data = array( 
	"token" => $token,
	"kodeprovider" => $kodeprovider,
	"nosjp" => $nosjp,
	"noresep" => $noresep,
	"kodeobat" => $kodeobat,
	"alasan" => $alasan,
	"user" => $username
);

$data_string = json_encode($data);

$ch = curl_init('https://dummy.inhealth.co.id/pelkesws2/api/HapusObatByKodeObatInh');

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