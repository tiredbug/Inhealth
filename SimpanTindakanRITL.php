<?php

include './sqlsrv.php';

$credential = getKey();
extract($credential);

$tanggalpelayanan = date('Y-m-d');
$tglmasukrawat = date('Y-m-d');
$jenispelayanan = $_POST['jenispelayanan'];
$nosjp = $_POST['nosjp'];
$idakomodasi = $_POST['idakomodasi'];
$kodetindakan = $_POST['kodetindakan'];
$poli = $_POST['poli'];
$kodedokter = $_POST['kodedokter'];
$biayaaju = json_encode($_POST['biayaaju'], JSON_NUMERIC_CHECK);

$data1 = array( 
	"token" => $token,
	"kodeprovider" => $kodeprovider,
	"tanggalpelayanan" => $tanggalpelayanan,
	"jenispelayanan"=> $jenispelayanan,
	"nosjp" => $nosjp,
	"poli" => $poli,
	"idakomodasi" => $idakomodasi,
	"tglmasukrawat" => $tglmasukrawat,
	"kodetindakan" => $kodetindakan,
	"kodedokter" => $kodedokter	
);

$data2 = array(
	"biayaaju" => $biayaaju
);

$json1 = json_encode($data1);
$json2 = json_encode($data2, JSON_NUMERIC_CHECK);

$data_string = json_encode(array_merge(json_decode($json1, true), json_decode($json2, true)));

$ch = curl_init('https://dummy.inhealth.co.id/pelkesws2/api/SimpanTindakanRITL');

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