<?php

include './sqlsrv.php';

$credential = getKey();
extract($credential);

//$date1 = substr($_POST['tanggalpelayanan'], 0, 10);
//$date2 = substr($_POST['tanggalasalrujukan'], 0, 10);

$tanggalpelayanan = $_POST['tanggalpelayanan'];
$tanggalasalrujukan = $_POST['tanggalasalrujukan'];
$jenispelayanan = $_POST['jenispelayanan'];
$nokainhealth = $_POST['nokainhealth'];
$nomormedicalreport = $_POST['nomormedicalreport'];
$nomorasalrujukan = $_POST['nomorasalrujukan'];
$kodeproviderasalrujukan = $_POST['kodeproviderasalrujukan'];
$kodediagnosautama = $_POST['kodediagnosautama'];
$poli = $_POST['poli'];
$informasitambahan = $_POST['informasitambahan'];
$kodediagnosatambahan = $_POST['kodediagnosatambahan'];
$kecelakaankerja = $_POST['kecelakaankerja'];
$kelasrawat = $_POST['kelasrawat'];
$kodejenpelruangrawat = $_POST['kodejenpelruangrawat'];

$data = array(
    "token" => $token,
    "kodeprovider" => $kodeprovider,
    "tanggalpelayanan" => $tanggalpelayanan,
    "jenispelayanan" => $jenispelayanan,
    "nokainhealth" => $nokainhealth,
    "nomormedicalreport" => $nomormedicalreport,
    "nomorasalrujukan" => $nomorasalrujukan,
    "kodeproviderasalrujukan" => $kodeproviderasalrujukan,
    "tanggalasalrujukan" => $tanggalasalrujukan,
    "kodediagnosautama" => $kodediagnosautama,
    "poli" => $poli,
    "username" => $username,
    "informasitambahan" => $informasitambahan,
    "kodediagnosatambahan" => $kodediagnosatambahan,
    "kecelakaankerja" => $kecelakaankerja,
    "kelasrawat" => $kelasrawat,
    "kodejenpelruangrawat" => $kodejenpelruangrawat
);

$data_string = json_encode($data);

$ch = curl_init('https://dummy.inhealth.co.id/pelkesws2/api/SimpanSJP');

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

    $output = '';

    $output .= '
  <tr>
   <td>' . $hasil[ERRORCODE] . '</td>
   <td>' . $hasil[ERRORDESC] . '</td>
   <td>' . $hasil[NOSJP] . '</td>
  </tr>
  ';

   // var_dump($hasil[ERRORCODE]);
   // die();

    echo ($output);
    
    if($hasil[ERRORCODE] === '00'){
            try {
            $query = "INSERT INTO [SJP] ([ERRORCODE], [ERRORDESC], [NOSJP]
        , [TGLSJP], [NOMORRUJUKAN], [TGLRUJUKAN], [KDPPKASALRUJUKAN]
        , [NMPPKASALRUJUKAN], [KDPOLI], [NMPOLI], [KDDIAG], [NMDIAG]
        , [NOKAPESERTA], [NAMAPESERTA], [PLAN_], [PLANDESC], [KELAS] 
        , [KELASDESC], [NOMEDICALRECORD], [JENISKELAMIN], [TGLLAHIR] 
        , [KDBU], [NMBU], [IDAKOMODASI], [TIPESJP], [TIPECOB], [NOBPJS]) 
        VALUES ('$hasil[ERRORCODE]', '$hasil[ERRORDESC]', '$hasil[NOSJP]', '$hasil[TGLSJP]',
        '$hasil[NOMORRUJUKAN]', '$hasil[TGLRUJUKAN]',
        '$hasil[KDPPKASALRUJUKAN]', '$hasil[NMPPKASALRUJUKAN]',
        '$hasil[KDPOLI]', '$hasil[NMPOLI]', '$hasil[KDDIAG]', '$hasil[NMDIAG]',
        '$hasil[NOKAPESERTA]', '$hasil[NAMAPESERTA]', '$hasil[PLAN]',
        '$hasil[PLANDESC]', '$hasil[KELAS]', '$hasil[KELASDESC]',
        '$hasil[NOMEDICALRECORD]', '$hasil[JENISKELAMIN]', '$hasil[TGLLAHIR]',
        '$hasil[KDBU]', '$hasil[NMBU]', '$hasil[IDAKOMODASI]', '$hasil[TIPESJP]',
        '$hasil[TIPECOB]', '$hasil[NOBPJS]')";

            $rs = odbc_exec($conn, $query) or die("<p>" . odbc_errormsg());
            odbc_close($conn);
            
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
    

    
} catch (Exception $e) {
    die(print_r($e->getMessage()));
}


?>