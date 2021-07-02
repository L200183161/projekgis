<?php
session_start();
include("../koneksi.php");
$editid = $_GET['id'];
if (!isset($_SESSION['admin'])) {
    echo "<script>window.location='../login.php?pesan=dilarang'</script>";
} else {
    // cek apakah tombol daftar sudah diklik atau blum?
    if (isset($_POST['ganti'])) {
        // ambil data dari formulir
        $editid = $_GET['id'];
        $lat_long = mysqli_escape_string($koneksi, $_POST['lat_long']);
        $nama_tempat = mysqli_escape_string($koneksi, $_POST['nama_tempat']);
        $kategori = mysqli_escape_string($koneksi, $_POST['kategori']);
        $jam_operasional = mysqli_escape_string($koneksi, $_POST['jam_operasional']);
        $kontak = mysqli_escape_string($koneksi, $_POST['kontak']);

        // cek apakah user telah melakukan pemesanan atau belum
        $query = mysqli_query($koneksi, "SELECT id FROM lokasi WHERE id='$editid'");
        $row = mysqli_num_rows($query);
        if ($row == 0) {
            echo "<script>window.location='./daftar.php?pesan=beli#pemesanan';</script>";
        } else {
            // buat query PEMESANAN
            $sql = "UPDATE lokasi SET lat_long='$lat_long', nama_tempat='$nama_tempat', kategori='$kategori', kontak='$kontak' WHERE id='$editid'";
            $query = mysqli_query($koneksi, $sql);
            if ($query) {
                // kalau berhasil alihkan ke halaman pemesanan
                echo "<script>window.location='./daftar.php?pesan=editsukses#pemesanan';</script>";
            } else {
                echo "<script>window.location='./daftar.php?pesan=editgagal#pemesanan';</script>";
            }
        }
    } else {
        echo mysqli_error($koneksi);
        // echo "<script>window.location='./';</script>";
    }
?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title>lokasi - Location Edit <?php echo $editid; ?> </title>
        <!-- Favicon-->
        <link rel="icon" href="../assets/images/hospital.svg" type="image/x-icon">

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
        <link href="../assets/iconfont/material-icons.css" rel="stylesheet" type="text/css">

        <!-- Bootstrap Core Css -->
        <link href="../assets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

        <!-- Bootstrap Select Css -->
        <link href="../assets/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet">

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

        <!-- leaflet css  -->
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
        <!-- leaflet js  -->
        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>

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
                    <a class="navbar-brand" href="./">Admin - lokasi</a>
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
                            <b style="text-transform: uppercase;"><?php echo htmlentities($_SESSION['admin']['username']); ?></b>
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
                                <i class="material-icons">assignment</i>
                                <span>Location Lists</span>
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
                    <h2>Edit <?php echo htmlentities($editid) ?></h2>
                </div>
                <!-- Widgets -->
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header bg-blue">
                                <h2>
                                    Edit the location that you want here
                                </h2>
                            </div>
                        </div>
                    </div>
                    <?php
                    $query = mysqli_query($koneksi, "SELECT * FROM lokasi WHERE id='$editid'");
                    $row = mysqli_num_rows($query);
                    if ($row > 0) {
                        $data = mysqli_fetch_array($query);
                    ?>
                        <div class="content container-fluid">
                            <div id="message" class="row clearfix">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <form action="" method="POST">
                                        <div class="card">
                                            <div class="header">
                                                <h2>Message</h2>
                                                <small>Edit your message in here</small>
                                            </div>
                                            <div class="body">
                                                <!-- <h2 class="card-inside-title">Message</h2> -->
                                                <div class="row clearfix">
                                                    <div class="col-sm-12">
                                                        <!-- <div class="form-group">
                                                            <label hidden for="id" class="col-sm-2 control-label">Name</label>
                                                            <div class="col-sm-10">
                                                                <div class="form-line">
                                                                    <input hidden type="text" class="form-control" id="id" name="id" placeholder="id" value="<?= $data['id'] ?>" required>
                                                                </div>
                                                            </div>
                                                        </div> -->
                                                        <div class="form-group">
                                                            <label for="nama_tempat" class="col-sm-2 control-label">Nama Tempat</label>
                                                            <div class="col-sm-10">
                                                                <div class="form-line">
                                                                    <input type="text" class="form-control" id="nama_tempat" name="nama_tempat" placeholder="Nama Tempate" value="<?php echo htmlentities($data['nama_tempat']) ?>" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="lat_long" class="col-sm-2 control-label">Latitude Longitudinal Tempat</label>
                                                            <div class="col-sm-10">
                                                                <div class="form-line">
                                                                    <input type="text" class="form-control" id="lat_long" name="lat_long" placeholder="Latitude and Longitudinal" value="<?php echo htmlentities($data['lat_long']) ?>" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="lat_long" class="col-sm-2 control-label">Map</label>
                                                            <div class="col-sm-10">
                                                                <div class="body">
                                                                    <div id="mapid" class="gmap"></div>
                                                                    <a target=> </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="Kategori" class="col-sm-2 control-label">Kategori Tempat</label>
                                                            <div class="col-sm-10">
                                                                <select name="kategori" id="kategori" class="form-control show-tick">
                                                                    <option value="<?php echo $data['kategori']; ?>"><?php echo $data['kategori']; ?> ( kategori sebelumnya )</option>
                                                                    <option value="Rumah Sakit">Rumah Sakit</option>
                                                                    <option value="Klinik">Klinik</option>
                                                                    <option value="Puskesmas">Puskesmas</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="kontak" class="col-sm-2 control-label">No Telepon</label>
                                                            <div class="col-sm-10">
                                                                <div class="form-line">
                                                                    <input type="text" class="form-control" id="kontak" name="kontak" value="<?php echo htmlentities($data['kontak']) ?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="jam_operasional" class="col-sm-2 control-label">Jam Operasional</label>
                                                            <div class="col-sm-10">
                                                                <div class="form-line">
                                                                    <input class="form-control" id="jam_operasional" name="jam_operasional" value="<?php echo htmlentities($data['jam_operasional']) ?>" </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row clearfix">
                                                        <div class="col-sm-offset-10 col-sm-10">
                                                            <button type="submit" name="ganti" class="btn btn-primary waves-effect">
                                                                <i class="material-icons">send</i>
                                                                <span> Edit the details </span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </section>
    <?php
                    }
    ?>
    <script>
        var mymap = L.map('mapid').setView([-7.504765474573392, 110.74061967973947], 13);
        mymap.locate({
            setView: true,
        });
        L.accessToken = 'pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXFhYTA2bTMyeW44ZG0ybXBkMHkifQ.gUGbDOPUN1v1fTs5SeOR4A';
        //setting maps menggunakan api mapbox bukan google maps, daftar dan dapatkan token      

        L.tileLayer(
            'https://api.mapbox.com/styles/v1/mapbox/streets-v11/tiles/256/{z}/{x}/{y}?access_token=' + L.accessToken, {
                // 'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibmFiaWxjaGVuIiwiYSI6ImNrOWZzeXh5bzA1eTQzZGxpZTQ0cjIxZ2UifQ.1YMI-9pZhxALpQ_7x2MxHw', {
                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                maxZoom: 20,
                id: 'mapbox/streets-v11', //menggunakan peta model streets-v11 kalian bisa melihat jenis-jenis peta lainnnya di web resmi mapbox
                tileSize: 512,
                zoomOffset: -1,
            }).addTo(mymap);

        // buat variabel berisi fugnsi L.popup 
        var popup = L.popup();

        // buat fungsi popup saat map diklik
        function onMapClick(e) {
            popup
                .setLatLng(e.latlng)
                .setContent("Koordinat Baru adalah" + e.latlng.lat + ',' + e.latlng.lng
                    .toString()
                ) //set isi konten yang ingin ditampilkan, kali ini kita akan menampilkan latitude dan longitude
                .openOn(mymap);

            document.getElementById('lat_long').value = e.latlng.lat + ',' + e.latlng.lng //value pada form latitde, longitude akan berganti secara otomatis
        }
        mymap.on('click', onMapClick); //jalankan fungsi
        <?php
        $mysqli = mysqli_connect('localhost', 'root', '', 'gis_latihan');   //koneksi ke database
        $tampil = mysqli_query($mysqli, "select * from lokasi WHERE id='$editid'"); //ambil data dari tabel lokasi
        // $linkmaps = $_SESSION[];
        while ($hasil = mysqli_fetch_array($tampil)) { ?> //melooping data menggunakan while
            // var customPopup = "<center><b style='color:yellow'> Nama Tempat :" +
            <?php
            // echo json_encode($hasil['nama_tempat']); 
            ?>
            // + "</b><br>Jl. Rowo Bening, Perum. Tiga Putri Tahap III<div class='text-center'><a href='https://facebook.com/idet.ambun' target='_blank' class='facebook' style='color:#fff;'><i class='fa fa-facebook'></i></a> <a href='https://twitter.com/detriamelia' target='_blank' class='twitter' style='color:#fff;'><i class='fa fa-twitter'></i></a> <a href='https://www.instagram.com/detriamelia/' target='_blank' class='instagram' style='color:#fff;'><i class='fa fa-instagram'></i></a> <a href='https://web.telegram.org/#/im?p=u687504930_6230769115732589639' class='telegram' style='color:#fff;'><i class='fa fa-whatsapp'></i></a></div></center>";

            var myIcon = L.icon({
                iconUrl: '../assets/images/hospital (1).svg',
                iconSize: [40, 40], // size of the icon
            });

            //menggunakan fungsi L.marker(lat, long) untuk menampilkan latitude dan longitude
            //menggunakan fungsi str_replace() untuk menghilankan karakter yang tidak dibutuhkan
            L.marker([<?php echo $hasil['lat_long']; ?>], {
                icon: myIcon
            }).addTo(mymap)
            //data ditampilkan di dalam bindPopup( data ) dan dapat dikustomisasi dengan html
            // .bindPopup(customPopup, customOptions);
        <?php } ?>
    </script>
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
    </body>

    </html>
<?php
}
?>