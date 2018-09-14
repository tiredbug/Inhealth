<?php

function connectODBC() {
    try {
        $server = 'inhealth';
        $dbName = 'Inhealth';
        $username = '';
        $passsword = '';
        $connection_string = "DRIVER={SQL Server Native Client 11.0};SERVER=$server;DATABASE=$dbName";

        $conn = odbc_connect($server, $username, $passsword);

        if (!$conn) {
            echo odbc_errormsg();
        }
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }

    return ['conn' => $conn];
}

function getKey() {

    try {

        $odbc = connectODBC();
        extract($odbc);

        $query = "SELECT TOP (10) [token]
      		,[kodeprovider]
      		,[username]
  			FROM [Inhealth].[dbo].[Credential]";

        $rs = odbc_exec($conn, $query);

        // echo "<table><tr>";
        // echo "<th>token</th>";
        // echo "<th>Kode Provider</th>";
        // echo "<th>Username</th></tr>";

        while (odbc_fetch_row($rs)) {
            $token = odbc_result($rs, "token");
            $kodeprovider = odbc_result($rs, "kodeprovider");
            $username = odbc_result($rs, "username");

            // echo "<tr><td>$token</td>";
            // echo "<tr><td>$kodeprovider</td>";
            //  	echo "<td>$username</td></tr>";
        }

        odbc_close($conn);
        // echo "</table>";
    } catch (Exception $e) {
        die(print_r($e->getMessage()));
    }

    return ['conn' => $conn, 'token' => $token, 'kodeprovider' => $kodeprovider, 'username' => $username];
}


function loadDataTindakan() {
    try {

        $odbc = connectODBC();
        extract($odbc);

        if (!$conn) {
            echo odbc_errormsg();
        }

        $query = "SELECT DISTINCT 
                         dbo.HASIL_MAPPING_RJ.NOSJP, dbo.HASIL_MAPPING_RJ.KODEJENPEL, dbo.MASTER_TINDAKAN.NAMAJENPEL, dbo.MASTER_TINDAKAN.KATEGORI, dbo.HASIL_MAPPING_RJ.KDDOKTER, dbo.MASTER_DOKTER.NMDOKTER, 
                         dbo.HASIL_MAPPING_RJ.BIAYAAJU
FROM            dbo.HASIL_MAPPING_RJ INNER JOIN
                         dbo.MASTER_TINDAKAN ON dbo.HASIL_MAPPING_RJ.KODEJENPEL = dbo.MASTER_TINDAKAN.KODEJENPEL LEFT OUTER JOIN
                         dbo.MASTER_DOKTER ON dbo.HASIL_MAPPING_RJ.KDDOKTER = dbo.MASTER_DOKTER.KDDOKTER";

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

        echo $output;
        odbc_close($conn);
    } catch (Exception $e) {
        die(print_r($e->getMessage()));
    }
}
