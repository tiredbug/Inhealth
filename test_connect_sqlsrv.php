<?php

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

    $query = "SELECT * FROM [Inhealth].[dbo].[Credential]";

    $rs = odbc_exec($conn, $query);

    echo "<table><tr>";
    echo "<th>token</th>";
    echo "<th>Kode Provider</th>";
    echo "<th>Username</th></tr>";

    while (odbc_fetch_row($rs)) {
        $token = odbc_result($rs, "token");
        $kodeprovider = odbc_result($rs, "kodeprovider");
        $username = odbc_result($rs, "username");

        echo "<tr><td>$token</td>";
        echo "<tr><td>$kodeprovider</td>";
        echo "<td>$username</td></tr>";
    }

    odbc_close($conn);
    echo "</table>";
} catch (Exception $e) {
    echo odbc_errormsg($conn);
    die(print_r($e->getMessage()));
}
