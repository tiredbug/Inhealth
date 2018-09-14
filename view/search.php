<?php

include '../sqlsrv.php';

$nosjp = $_POST['nosjp'];

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    searchBySJP($nosjp);
}

function searchBySJP($nosjp) {
    try {
        $odbc = connectODBC();
        extract($odbc);

        if (!$conn) {
            echo odbc_errormsg();
        }

        $query = "SELECT DISTINCT 
                         dbo.HASIL_MAPPING_RJ.NOSJP, dbo.HASIL_MAPPING_RJ.KODEJENPEL, dbo.MASTER_TINDAKAN.NAMAJENPEL, dbo.MASTER_TINDAKAN.KATEGORI, dbo.HASIL_MAPPING_RJ.KDDOKTER, dbo.MASTER_DOKTER.NMDOKTER, 
                         dbo.HASIL_MAPPING_RJ.BIAYAAJU
                FROM     dbo.HASIL_MAPPING_RJ INNER JOIN
                         dbo.MASTER_TINDAKAN ON dbo.HASIL_MAPPING_RJ.KODEJENPEL = dbo.MASTER_TINDAKAN.KODEJENPEL LEFT OUTER JOIN
                         dbo.MASTER_DOKTER ON dbo.HASIL_MAPPING_RJ.KDDOKTER = dbo.MASTER_DOKTER.KDDOKTER
                WHERE NOSJP = '$nosjp'";

        $rs = odbc_exec($conn, $query);

        $output = '';

        while (odbc_fetch_row($rs)) {
            $nosjp = odbc_result($rs, "NOSJP");
            $kategori = odbc_result($rs, "KATEGORI");
            $kodeJenpel = odbc_result($rs, "KODEJENPEL");
            $namJenpel = odbc_result($rs, "NAMAJENPEL");
            $kodeDokter = odbc_result($rs, "KDDOKTER");
            $namaDokter = odbc_result($rs, "NMDOKTER");
            $biayaAju = odbc_result($rs, "BIAYAAJU");

            $output .= '
            <tr>
             <td>' . $nosjp . '</td>
             <td>' . $kategori . '</td>
             <td>' . $kodeJenpel . '</td>
             <td>' . $namJenpel . '</td>
             <td>' . $kodeDokter . '</td>
             <td>' . $namaDokter . '</td>
             <td>' . $biayaAju . '</td>
            </tr>
            ';
        }

        echo($output);
//        echo "$nosjp";
//        echo "$query";

        odbc_close($conn);
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
    
//    return ['nosjp' => $nosjp, 'kategori' => $kategori, 'kodeJenpel' => $kodeJenpel, 'namaJenpel' => $namJenpel,
//            'kodeDokter' => $kodeDokter, 'namaDokter' => $namaDokter, 'biayaAju' => $biayaAju];
}

?>

