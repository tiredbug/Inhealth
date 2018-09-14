<?php

include './sqlsrv.php';

$credential = getKey();
extract($credential);

$tglmasuk = date('Y-m-d');
$nosjp = $_POST['nosjp'];
$kelasrawat = $_POST['kelasrawat'];
$kodejenispelayanan = $_POST['kodejenispelayanan'];
$byharirawat = json_encode($_POST['byharirawat'], JSON_NUMERIC_CHECK);

$data1 = array( 
	"token" => $token,
	"kodeprovider" => $kodeprovider,
	"tglmasuk" => $tglmasuk,
	"nosjp" => $nosjp,
	"kelasrawat" => $kelasrawat,
	"kodejenispelayanan" => $kodejenispelayanan
);

$data2 = array(
	"byharirawat" => $byharirawat
);

$json1 = json_encode($data1);
$json2 = json_encode($data2, JSON_NUMERIC_CHECK);


$data_string = json_encode(array_merge(json_decode($json1, true), json_decode($json2, true)));

$ch = curl_init('https://dummy.inhealth.co.id/pelkesws2/api/SimpanRuangRawat');

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
	
	// echo $data_string;
	print_r($hasil);
} catch (Exception $e) {
	die(print_r($e->getMessage()));
}

?>