<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Simpan SJP</title>
        <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="../assets/css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="../assets/datepicker/css/datepicker.css">
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
            <div class="col-md-6">
                <h4 class="text-center">Simpan SJP</h4>

                <form id="simpanSJP" action="SimpanSJP.php" method="POST">

                    <div class="form-group input-append">
                        <label for="tanggalpelayanan">Tanggal Pelayanan : </label>
                        <input required="required" aria-required="true" type="text" name="tanggalpelayanan" id="tanggalpelayanan" class="datepicker form-control" data-date-format="yyyy-mm-dd"> 
                    </div>

                    <div class="form-group">
                        <label for="jenispelayanan">Jenis Pelayanan : </label>
                        <select required="required" aria-required="true" class="form-control" id="jenispelayanan" name="jenispelayanan">
                            <option disabled>Please select</option>
                            <option value="1">1 : RJTP</option>
                            <option value="2">2 : RITP</option>
                            <option value="3">3 : RJTL</option>
                            <option value="4">4 : RITL</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="nokainhealth">Nomor Kartu Inhealth : </label>
                        <input required="required" aria-required="true" type="text" class="form-control" id="nokainhealth" name="nokainhealth" >
                    </div>

                    <div class="form-group">
                        <label for="nomormedicalreport">Nomor Medical Report : </label>
                        <input required="required" aria-required="true" type="text" class="form-control" id="nomormedicalreport" name="nomormedicalreport" >
                    </div>

                    <div class="form-group">
                        <label for="nomorasalrujukan">Nomor Asal Rujukan : </label>
                        <input required="required" aria-required="true" type="text" class="form-control" id="nomorasalrujukan" name="nomorasalrujukan" >
                    </div>

                    <div class="form-group">
                        <label for="kodeproviderasalrujukan">Kode Provider Asal Rujukan : </label>
                        <input required="required" aria-required="true" type="text" class="form-control" id="kodeproviderasalrujukan" name="kodeproviderasalrujukan" >
                    </div>

                    <div class="form-group input-append">
                        <label for="tanggalasalrujukan">Tanggal Asal Rujukan : </label>
                        <input required="required" aria-required="true" type="text" name="tanggalasalrujukan" id="tanggalasalrujukan" class="datepicker form-control" data-date-format="yyyy-mm-dd" > 
                    </div>

                    <div class="form-group">
                        <label for="kodediagnosautama">Kode Diagnosa Utama : </label>
                        <input required="required" aria-required="true" type="text" class="form-control" id="kodediagnosautama" name="kodediagnosautama" >
                    </div>

                    <div class="form-group">
                        <label for="poli">Poli : </label>
                        <input required="required" aria-required="true" type="text" class="form-control" id="poli"  name="poli" >
                    </div>

                    <div class="form-group">
                        <label for="informasitambahan">Informasi Tambahan : </label>
                        <textarea required="required" aria-required="true" class="form-control" rows="3" id="informasitambahan" name="informasitambahan" ></textarea>
                    </div> 

                    <div class="form-group">
                        <label for="kodediagnosatambahan">Kode Diagnosa Tambahan : </label>
                        <input required="required" aria-required="true" type="text" class="form-control" id="kodediagnosatambahan" name="kodediagnosatambahan" >
                    </div>          

                    <div class="form-group">
                        <label for="kecelakaankerja">Kecelakaan Kerja : </label>
                        <select required="required" aria-required="true" class="form-control" id="kecelakaankerja" >
                            <option disabled>Please select</option>
                            <option value="0">0 : Biasa</option>
                            <option value="1">1 : Kecelakaan Kerja</option>
                            <option value="2">2 : Kecelakaan Lalu Lintas</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="kelasrawat">Kelas Rawat: </label>
                        <input required="required" aria-required="true" type="text" class="form-control" id="kelasrawat" name="kelasrawat" >
                    </div>

                    <div class="form-group">
                        <label for="kodejenpelruangrawat">Kode Jenis Pelayanan Ruang Rawat: </label>
                        <input required="required" aria-required="true" type="text" class="form-control" id="kodejenpelruangrawat" name="kodejenpelruangrawat" >
                    </div>

                    <button type="reset" class="btn btn-danger" id="clearForm">Clear Form</button>
                    <button type="submit" class="btn btn-success pull-right" id="submit" name="submit">Simpan SJP</button>
                </form>
            </div>
            <div id="hasilSJP" class="col-md-6 text-center">
                <h4>Result</h4>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ERROR CODE</th>
                                <th>ERROR DESC</th>
                                <th>NOSJP</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>

        <script src="../assets/js/bootstrap.min.js"></script>
        <script>
            $(document).ready(function () {
                $(function () {
                    $('.datepicker').datepicker();
                });

                $("#submit").click(function (e) {

                    var isValid = $("#simpanSJP").valid();

                    if (!isValid) {
                        alert('Masih ada kolom yg kosong, silahkan isi lebih dulu');
                    } else {
                        e.preventDefault();
                        var tanggalpelayanan = $('#tanggalpelayanan').val();
                        var jenispelayanan = $('#jenispelayanan').val();
                        var nokainhealth = $('#nokainhealth').val();
                        var nomormedicalreport = $('#nomormedicalreport').val();
                        var nomorasalrujukan = $('#nomorasalrujukan').val();
                        var kodeproviderasalrujukan = $('#kodeproviderasalrujukan').val();
                        var tanggalasalrujukan = $('#tanggalasalrujukan').val();
                        var kodediagnosautama = $('#kodediagnosautama').val();
                        var poli = $('#poli').val();
                        var informasitambahan = $('#informasitambahan').val();
                        var kodediagnosatambahan = $('#kodediagnosatambahan').val();
                        var kecelakaankerja = $('#kecelakaankerja').val();
                        var kelasrawat = $('#kelasrawat').val();
                        var kodejenpelruangrawat = $('#kodejenpelruangrawat').val();

//                    var date1 = new Date(tanggalpelayanan).toISOString().slice(0,10);
//                    var date2 = new Date(tanggalasalrujukan).toISOString().slice(0,10);

                        $.ajax({
                            dataType: 'text',
                            type: 'POST',
                            cache: false,
                            url: '../SimpanSJP.php',
                            data: {
                                tanggalpelayanan: tanggalpelayanan,
                                jenispelayanan: jenispelayanan,
                                nokainhealth: nokainhealth,
                                nomormedicalreport: nomormedicalreport,
                                nomorasalrujukan: nomorasalrujukan,
                                kodeproviderasalrujukan: kodeproviderasalrujukan,
                                tanggalasalrujukan: tanggalasalrujukan,
                                kodediagnosautama: kodediagnosautama,
                                poli: poli,
                                informasitambahan: informasitambahan,
                                kodediagnosatambahan: kodediagnosatambahan,
                                kecelakaankerja: kecelakaankerja,
                                kelasrawat: kelasrawat,
                                kodejenpelruangrawat: kodejenpelruangrawat
                            }, success: function (data) {
//                            alert(data);
                                $('tbody').html(data);
                            }
                        }).done(function (data) {
                             $('html, body').animate({ scrollTop: 0 }, 0);
                        });
                    }
                });

                $('#clearFrom').click(function () {
                    $("#simpanSJP")[0].reset();
                });
            }
            );
        </script>
    </body>
</html>