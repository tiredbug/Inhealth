<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Cari SJP</title>
        <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="../assets/css/bootstrap-theme.min.css">
        <script src="../assets/js/jquery-3.3.1.min.js"></script>
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
                <h4 class="text-center">Cari SJP</h4>

                <form id="infosjp" action="" method="POST">

                    <div class="form-group">
                        <label for="nosjp">Nomor SJP : </label>
                        <input type="text" class="form-control" id="nosjp" name="nosjp" required>
                    </div>

                    <button type="submit" class="btn btn-success pull-right" id="submit" name="submit">Info SJP</button>
                </form>
            </div>
            <div class="col-md-6 text-center">
                <h4>Info SJP</h4>

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
                $("#submit").click(function (e) {
                    e.preventDefault();

                    var nosjp = $("#nosjp").val();

                    $.ajax({
                        dataType: 'json',
                        type: 'POST',
                        url: '../InfoSJP.php',
                        data: {
                            nosjp: nosjp
                        },
                        success: function (data) {
//                            alert(data);
                            $('tbody').html(data);
                        }
                    });
                });
            });
        </script>
    </body>
</html>