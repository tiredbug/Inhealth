<?php

include './sqlsrv.php';

$credential = getKey();
extract($credential);

$noka = $_POST['noka_inhealth'];
$tanggal = date('Y-m-d');
$jnsPel =$_POST['jenispelayanan'];
$poli = $_POST['poli'];

$data = array( 
	"token" => $token,
	"kodeprovider" => $kodeprovider,
	"nokainhealth" => $noka,
	"tglpelayanan" => $tanggal,
	"jenispelayanan"=> $jnsPel,
	"poli" => $poli
);

$data_string = json_encode($data);

$ch = curl_init('https://dummy.inhealth.co.id/pelkesws2/api/EligibilitasPeserta');

curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	'Content-Type: application/json',
	'Content-Length: ' . strlen($data_string))
);

$result = curl_exec($ch);

// print_r($data_string);

$hasil = json_decode($result, true);

echo "<br> NOKAINHEALTH : ";
echo "$hasil[NOKAPST]";
echo "<br> Nomer Kartu peserta : ";
echo "$hasil[NOKAPST]";
echo "<br> Nama Peserta";
echo "$hasil[NMPST]";
echo "<br> Tanggal Lahir";
echo "$hasil[TGLLAHIR]";
echo "<br> Kode Produk";
echo "$hasil[KODEPRODUK]";
echo "<br> Nama Produk";
echo "$hasil[NAMAPRODUK]";
echo "<br> Kode Kelas Rawat";
echo "$hasil[KODEKELASRAWAT]";
echo "<br> Nama Kelas Rawat";
echo "$hasil[NAMAKELASRAWAT]";
echo "<br> Badan Usaha";
echo "$hasil[NAMABADANUSAHA]";
echo "<br> Dokter Keluarga";
echo "$hasil[KODEPROVIDER] - N$hasil[NAMAPROVIDER]";
echo "<br> Nomer Kartu BPJS";
echo "$hasil[NOKAPSTBPJS]";
echo "<br> Nama Peserta BPJS";
echo "$hasil[NMPSTBPJS]";
echo "<br> Faskes BPJS";
echo "$hasil[KODEPROVIDERBPJS] - $hasil[NAMAPROVIDERBPJS]";

?>