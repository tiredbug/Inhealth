<?php

include './sqlsrv.php';

$credential = getKey();
extract($credential);

$tglmasuk = date('Y-m-d');
$tglkeluar = date('Y-m-d');
$nosjp = $_POST['nosjp'];
$id = $_POST['id'];

$data = array( 
	"token" => $token,
	"kodeprovider" => $kodeprovider,
	"tglmasuk" => $tglmasuk,
	"tglkeluar"=> $tglkeluar,
	"nosjp" => $nosjp,
	"id" => $id
);

$data_string = json_encode($data);

$ch = curl_init('https://dummy.inhealth.co.id/pelkesws2/api/UpdateTanggalPulang');

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