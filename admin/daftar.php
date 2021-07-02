<?php
session_start();
include("../koneksi.php");
if (!isset($_SESSION['admin'])) {
    echo "<script>window.location='../login.php?pesan=dilarang'</script>";
} else {
?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title>WebGIS Test PCR Location - Location View</title>
        <!-- Favicon-->
        <link rel="icon" href="../assets/images/hospital.svg" type="image/x-icon">

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
        <link href="../assets/iconfont/material-icons.css" rel="stylesheet" type="text/css">

        <!-- Bootstrap Core Css -->
        <link href="../assets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

        <!-- Waves Effect Css -->
        <link href="../assets/plugins/node-waves/waves.css" rel="stylesheet" />

        <!-- Animation Css -->
        <link href="../assets/plugins/animate-css/animate.css" rel="stylesheet" />

        <!-- JQuery DataTable Css -->
        <link href="../assets/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

        <!-- Morris Chart Css-->
        <link href="../assets/plugins/morrisjs/morris.css" rel="stylesheet" />

        <!-- Custom Css -->
        <link href="../assets/css/style.css" rel="stylesheet">

        <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
        <link href="../assets/css/themes/theme-blue.css" rel="stylesheet" />

        <!-- CSS manual -->
        <link href="../manual.css" rel="stylesheet">

        <!-- Sweetalert2 -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
    </head>

    <body class="theme-blue">
        <!-- Page Loader -->
        <div class="page-loader-wrapper">
            <div class="loader">
                <div class="preloader">
                    <div class="spinner-layer pl-red">
                        <div class="circle-clipper left">
                            <div class="circle"></div>
                        </div>
                        <div class="circle-clipper right">
                            <div class="circle"></div>
                        </div>
                    </div>
                </div>
                <p>Wait for a moment.. ...</p>
            </div>
        </div>
        <!-- #END# Page Loader -->
        <!-- Overlay For Sidebars -->
        <div class="overlay"></div>
        <!-- #END# Overlay For Sidebars -->

        <!-- Top Bar -->
        <nav class="navbar">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                    <a href="javascript:void(0);" class="bars"></a>
                    <a class="navbar-brand" href="./">Admin - WebGIS Test PCR Location</a>
                </div>
                <div class="collapse navbar-collapse" id="navbar-collapse">
                </div>
            </div>
        </nav>
        <!-- #Top Bar -->
        <section>
            <!-- Left Sidebar -->
            <aside id="leftsidebar" class="sidebar">
                <!-- User Info -->
                <div class="user-info">
                    <div class="image">
                        <img src="../assets/images/programmer.png" width="60" height="60" alt="User" />
                    </div>
                    <div class="info-container">
                        <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <b style="text-transform: uppercase;"><?php echo $_SESSION['admin']['username']; ?></b>
                        </div>
                        <div class="btn-group user-helper-dropdown">
                            <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                            <ul class="dropdown-menu pull-right">
                                <li role="separator" class="divider"></li>
                                <li><a href="../logout.php"><i class="material-icons">power_settings_new</i>Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- #User Info -->
                <!-- Menu -->
                <div class="menu">
                    <ul class="list">
                        <li class="header">MAIN NAVIGATION</li>
                        <li>
                            <a href="./">
                                <i class="material-icons">home</i>
                                <span>Home</span>
                            </a>
                        </li>
                        <li class="active">
                            <a href="daftar.php">
                                <i class="material-icons">location_on</i>
                                <span>Location lists</span>
                            </a>
                        </li>
                        <li>
                            <a href="./user.php">
                                <i class="material-icons">people</i>
                                <span>User List</span>
                            </a>
                        </li>

                        <li class="header">ACCOUNT</li>

                        <li>
                            <a href="../logout.php">
                                <i class="material-icons col-red">power_settings_new</i>
                                <span>Logout</span>
                            </a>
                        </li>

                    </ul>
                </div>
                <!-- #Menu -->
                <!-- Footer -->
                <div class="legal">
                    <div class="copyright">
                        <p>&copy; Donny Rizal &middot; <a href="#">Privacy</a> &middot; <a href="#notice">Terms</a></p>
                    </div>
                </div>
                <!-- #Footer -->
            </aside>
            <!-- #END# Left Sidebar -->
            <!-- Right Sidebar -->

            <!-- #END# Right Sidebar -->
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="block-header">
                    <h2>DASHBOARD</h2>
                </div>

                <!-- Widgets -->
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header bg-blue">
                                <h2>
                                    List of Location<small>The page that is dedicated to admin only 👌</small>
                                </h2>
                            </div>
                            <div class="body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover dataTable js-exportable">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Tempat</th>
                                                <th>Latitude dan Longitude</th>
                                                <th>Kategori</th>
                                                <th>Kontak</th>
                                                <th>Jam Operasional</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 0;
                                            $namasaya = $_SESSION['admin']['username'];
                                            $sql = "SELECT * FROM lokasi";
                                            $query = mysqli_query($koneksi, $sql);

                                            while ($result = mysqli_fetch_array($query)) {
                                                // $newdate = date("l d-m-Y", strtotime($result['date'])); //Convert to d/m/Y
                                                echo "<tr>";
                                                echo "<td style='text-align: center !important;'>" . ++$i . "</td>";
                                                echo "<td>" . htmlentities($result['nama_tempat']) . "</td>";
                                                echo "<td>" . htmlentities($result['lat_long']) . "</td>";
                                                echo "<td>" . htmlentities($result['kategori']) . "</td>";
                                                echo "<td>" . htmlentities($result['kontak']) . "</td>";
                                                echo "<td>" . htmlentities($result['jam_operasional']) . "</td>";
                                                // echo "<td>" . htmlentities($result['message']) . "</td>";
                                                // echo "<td>" . htmlentities($newdate) . "</td>";
                                                // echo "<td><a class='btn btn-outline-danger' href='javascript:void(0)' id='unlink' data-id='" . $id . "'>Delete</a><td>";
                                                echo '<td><a type="button" class="btn btn-primary btn-outline-danger" href="edit.php?id=' . htmlentities($result["id"]) . '">Edit</a>
                                                <a type="button" class="btn btn-outline-danger" href="delete.php?id=' . htmlentities($result["id"]) . '">Delete</a></td>';
                                                echo "</tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- #END# Exportable Table -->
            </div>
        </section>

        <!-- Jquery Core Js -->
        <script src="../assets/plugins/jquery/jquery.min.js"></script>

        <!-- Bootstrap Core Js -->
        <script src="../assets/plugins/bootstrap/js/bootstrap.js"></script>

        <!-- Select Plugin Js -->
        <script src="../assets/plugins/bootstrap-select/js/bootstrap-select.js"></script>

        <!-- Slimscroll Plugin Js -->
        <script src="../assets/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

        <!-- Waves Effect Plugin Js -->
        <script src="../assets/plugins/node-waves/waves.js"></script>

        <!-- Jquery DataTable Plugin Js -->
        <script src="../assets/plugins/jquery-datatable/jquery.dataTables.js"></script>
        <script src="../assets/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
        <script src="../assets/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
        <script src="../assets/plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
        <script src="../assets/plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
        <script src="../assets/plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
        <script src="../assets/plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
        <script src="../assets/plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
        <script src="../assets/plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>

        <!-- Custom Js -->
        <script src="../assets/js/admin.js"></script>
        <script src="../assets/js/pages/tables/jquery-datatable.js"></script>

        <!-- Demo Js -->
        <script src="../assets/js/demo.js"></script>

        <!-- Sweetalert2 -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
        <!-- <script>
            $('#unlink').on("click", function() {
                swal({
                    title: "Delete your Chat?",
                    text: "Are you sure you wanna go ahead?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Yepp",
                    cancelButtonText: "Noooooo",
                    closeOnConfirm: false,
                    closeOnCancel: false,
                }).then((result) => {
                    if (result.value) {
                        windows.location.href = "delete.php?username=" + $(this).data('id');
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted',
                            'Success'
                        )
                    } else if (
                        result.dismiss === swal.DismissReason.cancel
                    ) {

                    }
                })
            });
        </script> -->
    </body>

    </html>
<?php
    if (isset($_GET['pesan'])) {
        if ($_GET['pesan'] == "editsukses") {
            echo "<script type='text/javascript'>
                swal({
                title: 'Your Data has been successfully edited',
                type: 'success',
                confirmButtonText: 'OK',
                confirmButtonColor: '#4caf50',
                reverseButtons: true,
                focusConfirm: true,
                  });
                </script>";
        } else if ($_GET['pesan'] == "sukses") {
            echo "<script type='text/javascript'>
                swal({
                title: 'Yyyayyyy!',
                type: 'success',
                confirmButtonText: 'OK',
                confirmButtonColor: '#4caf50',
                reverseButtons: true,
                focusConfirm: true,
                  });
                </script>";
        } else if ($_GET['pesan'] == "editgagal") {
            echo "<script type='text/javascript'>
                swal({
                title: 'Failed to edit, something is wrong!',
                type: 'error',
                confirmButtonText: 'OK',
                confirmButtonColor: '#4caf50',
                reverseButtons: true,
                focusConfirm: true,
                  });
                </script>";
        } else if ($_GET['pesan'] == "gagal") {
            echo "<script type='text/javascript'>
                swal({
                title: 'Failed to input the location!',
                type: 'error',
                confirmButtonText: 'OK',
                confirmButtonColor: '#4caf50',
                reverseButtons: true,
                focusConfirm: true,
                  });
                </script>";
        } else if ($_GET['pesan'] == "error") {
            echo "<script type='text/javascript'>
                swal({
                title: 'Please try again once more.!',
                type: 'info',
                confirmButtonText: 'OK',
                confirmButtonColor: '#4caf50',
                reverseButtons: true,
                focusConfirm: true,
                  });
                </script>";
        } else if ($_GET['pesan'] == "beli") {
            echo "<script type='text/javascript'>
                swal({
                title: 'Make sure you make a message first!',
                type: 'warning',
                confirmButtonText: 'OK',
                confirmButtonColor: '#4caf50',
                reverseButtons: true,
                focusConfirm: true,
                  });
                </script>";
        } else if ($_GET['pesan'] == "edit") {
            echo "<script type='text/javascript'>
                swal({
                title: 'You already have the location before! If there's something wrong Edit here',
                type: 'warning',
                confirmButtonText: 'OK',
                confirmButtonColor: '#4caf50',
                reverseButtons: true,
                focusConfirm: true,
                  });
                </script>";
        } else if ($_GET['pesan'] == "deletesukses") {
            echo
            "<script type='text/javascript'>
                swal({
                title: 'Data is deleted!',
                type: 'success',
                confirmButtonText: 'OK',
                confirmButtonColor: '#4caf50',
                reverseButtons: true,
                focusConfirm: true,
                  });
                  $(document).ready(function(){
                      $('select:not(.swal2-select)').formSelect();
                    });
            </script>";
        } else if ($_GET['pesan'] == "deletegagal") {
            echo "<script type='text/javascript'>
                swal({
                title: 'Data can't be deleted',
                type: 'error',
                confirmButtonText: 'OK',
                confirmButtonColor: '#4caf50',
                reverseButtons: true,
                focusConfirm: true,
                  });
                $(document).ready(function(){
                    $('select:not(.swal2-select)').formSelect();
                });
        </script>";
        }
    }
}
?>