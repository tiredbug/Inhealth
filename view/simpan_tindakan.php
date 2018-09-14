<?php
include '../sqlsrv.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Simpan Tindakan</title>
        <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="../assets/css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="../assets/datepicker/css/datepicker.css">
        <!--<link rel="stylesheet" href="../assets/css/jquery.dataTables.min.css">-->
        <script src="../assets/js/jquery-3.3.1.min.js"></script>
        <script src="../assets/datepicker/js/bootstrap-datepicker.js"></script>
        <script src="../assets/js/jquery.validate.min.js"></script>
    </head>
    <body>

        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Mandiri Inhealth</a>
                </div>
            </div><!-- /.container-fluid -->
        </nav>

        <div class="container" style="margin-bottom: 1em;">
            <div class="col-md text-center">
                <h4>Data Tindakan</h4>

                <form id="searchSJP" method="POST">
                    <input type="text" id="nosjp" name="nosjp"/>
                    <button type="submit" class="btn btn-success" id="submit" name="submit">Cari SJP</button>
                </form>

                <div id="resultSearch"></div>

                <div class="table-responsive" style="margin-top: 3em">
                    <table id="tableDataTindakan" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>NOSJP</th>
                                <th>KATEGORI</th>
                                <th>KODE JENIS PELAYANAN</th>
                                <th>NAMA JENIS PELAYANAN</th>
                                <th>KODE DOKTER</th>
                                <th>NAMA DOKTER</th>
                                <th>TARIF</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            loadDataTindakan();
                            ?>
                        </tbody>
                    </table>

                    <button type="submit" class="btn btn-success pull-right" id="save" name="save">Simpan Tindakan</button>
                </div>
            </div>
        </div>

        <script src="../assets/js/bootstrap.min.js"></script>
        <!--<script src="../assets/js/jquery.dataTables.min.js"></script>-->

        <script>
            $(document).ready(function () {

                $("#save").attr('disabled', 'disabled');

                $("#submit").click(function (e) {
                    e.preventDefault();
//                    console.log(nosjp);

                    var nosjp = $("#nosjp").val();

                    if (nosjp === '') {
                        alert('Silahkan Masukkan Nomor SJP!');
                    } else {
                        $("#save").removeAttr('disabled');

                        $.ajax({
                            dataType: 'HTML',
                            type: 'POST',
                            url: 'search.php?nosjp=' + nosjp,
                            data: {
                                nosjp: nosjp
                            },
                            success: function (data) {
//                            console.log(data); 
                                $('tbody').html(data);
                            }
                        });
                    }
                });

                $("#save").click(function (e) {
                    e.preventDefault();
                    
                    var nosjp = $("#nosjp").val();
                    
                    $.ajax({
                        dataType: 'HTML',
                        type: 'POST',
                        url: '../SimpanTindakan.php?nosjp=' + nosjp,
                        data: {
                            nosjp: nosjp
                        },
                        success: function (data) {
//                            console.log(data); 
                            $('tbody').html(data);
                        }
                    });
                });
            });
        </script>
    </body>
</html>


