<?php

include './sqlsrv.php';

$credential = getKey();
extract($credential);

$nokainhealth = $_POST['nokainhealth'];
$tanggalSJP = date('Y-m-d');
$poli = $_POST['poli'];
$tkp = $_POST['tkp'];

$data = array( 
	"token" => $token,
	"kodeprovider" => $kodeprovider,
	"nokainhealth" => $nokainhealth,
	"tanggalsjp " => $tanggalSJP,
	"poli" => $poli,
	"tkp" => $tkp
);

$data_string = json_encode($data);

$ch = curl_init('https://app.inhealth.co.id/pelkesws2/api/CekSJP');

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