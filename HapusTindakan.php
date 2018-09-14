<?php

include './sqlsrv.php';

$credential = getKey();
extract($credential);

$nosjp = $_POST['nosjp'];
$tgltindakan = date('Y-m-d');
$kodetindakan = $_POST['kodetindakan'];
$notes = $_POST['notes'];

$data = array( 
	"token" => $token,
	"kodeprovider" => $kodeprovider,
	"nosjp" => $nosjp,
	"notes" => $notes,
	"userid" => $username
);

$data_string = json_encode($data);

$ch = curl_init('https://dummy.inhealth.co.id/pelkesws2/api/HapusTindakan');

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