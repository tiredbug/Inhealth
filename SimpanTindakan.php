<?php

include './sqlsrv.php';

$credential = getKey();
extract($credential);

$nosjp = $_POST['nosjp'];

$partialData = searchBySJP($nosjp);
extract($partialData);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    searchBySJP($nosjp);
}

foreach ($output as $data) {
    $kodedokter = $data[KDDOKTER];
    $kodetindakan = $data[KODEJENPEL];
    $jenPel = $data[KATEGORI];
    $biayaaju = json_encode($data[BIAYAAJU], JSON_NUMERIC_CHECK);
    $poli = $data[KDPOLI];

    if ($jenPel == "RAWAT JALAN") {
        $kodeJenpel = "3";
    }

    $numData = array(
        "biayaaju" => $biayaaju
    );

    $charData = array(
        "token" => $token,
        "kodeprovider" => $kodeprovider,
        "nosjp" => $nosjp,
        "kodedokter" => "000",
        "poli" => $poli,
        "kodetindakan" => $kodetindakan,
        "jenispelayanan" => $kodeJenpel,
        "tanggalpelayanan" => substr($data[TGLSJP], 0, 10),
        "tglmasukrawat" => substr($data[TGLSJP], 0, 10)
    );

    $data1[] = $charData;
    $data2[] = $numData;


    $json1 = json_encode($data1);
    $json2 = json_encode($data2, JSON_NUMERIC_CHECK);
//    $allData = array_map(function($d1, $d2){
//    return array_merge_recursive($d1, $d2);
//    }, $data1, $data2);
    $data_string = array_map("array_merge_recursive", json_decode($json1, true), json_decode($json2, true));
}

//$mh = curl_multi_init();
for ($i = 0; $i < count($data_string); $i++) {

    $ch[$i] = curl_init('https://dummy.inhealth.co.id/pelkesws2/api/SimpanTindakan');

    curl_setopt($ch[$i], CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch[$i], CURLOPT_POST, 1);
    curl_setopt($ch[$i], CURLOPT_POSTFIELDS, json_encode($data_string[$i]));
    curl_setopt($ch[$i], CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch[$i], CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch[$i], CURLOPT_HTTPHEADER, array(
        'Accept: application/json',
        'Content-Type: application/json',
        'Content-Length: ' . strlen(json_encode($data_string[$i])))
    );


    $result = curl_exec($ch[$i]);
//    
    $hasil = json_decode($result, true);
    print_r($hasil);
}

//try {
//    $result = curl_exec($ch);
//
//    $hasil = json_decode($result);
//
//    print_r($hasil);
//} catch (Exception $e) {
//    die(print_r($e->getMessage()));
//}

function searchBySJP($nosjp) {
    try {
        $odbc = connectODBC();
        extract($odbc);

        if (!$conn) {
            echo odbc_errormsg();
        }

        $query = "SELECT DISTINCT 
                         dbo.HASIL_MAPPING_RJ.NOSJP, dbo.HASIL_MAPPING_RJ.KODEJENPEL, dbo.MASTER_TINDAKAN.NAMAJENPEL, dbo.MASTER_TINDAKAN.KATEGORI, dbo.HASIL_MAPPING_RJ.KDDOKTER, dbo.MASTER_DOKTER.NMDOKTER, 
                         dbo.HASIL_MAPPING_RJ.BIAYAAJU, dbo.SJP.TGLSJP, dbo.SJP.KDPOLI
FROM            dbo.HASIL_MAPPING_RJ INNER JOIN
                         dbo.MASTER_TINDAKAN ON dbo.HASIL_MAPPING_RJ.KODEJENPEL = dbo.MASTER_TINDAKAN.KODEJENPEL LEFT OUTER JOIN
                         dbo.SJP ON dbo.HASIL_MAPPING_RJ.NOSJP = dbo.SJP.NOSJP LEFT OUTER JOIN
                         dbo.MASTER_DOKTER ON dbo.HASIL_MAPPING_RJ.KDDOKTER = dbo.MASTER_DOKTER.KDDOKTER
 WHERE dbo.SJP.NOSJP = '$nosjp'";

        $rs = odbc_exec($conn, $query);

        $output = array();

        while ($myRow = odbc_fetch_array($rs)) {
            $output[] = $myRow;
        }

//        echo($output);

        odbc_close($conn);
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }

    return ['output' => $output];
}

?>