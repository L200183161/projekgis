<?php
error_reporting(E_ALL ^ E_NOTICE);
include "./koneksi.php";
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Dasboard ||| ⚪ LAYANAN PEMERIKSAAN COVID-19 ⚪</title>
    <!-- Favicon-->
    <link rel="icon" href="assets/images//hospital.svg" type="image/x-icon">
    <!-- Icons made by <a href="https://www.flaticon.com/authors/freepik" title="Freepik">Freepik</a> from <a href="https://www.flaticon.com/" title="Flaticon"> www.flaticon.com</a> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Google Fonts -->
    <!-- <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css"> -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- leaflet css  -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
    <!-- leaflet js  -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Aos.js -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <link href="./assets/css/sidebar.css" rel="stylesheet" />

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap');
        /* GLOBAL STYLES
-------------------------------------------------- */
        /* Padding below the footer and lighter body text */

        body {
            font-family: 'Poppins', sans-serif;
            padding-top: 3rem;
            padding-bottom: 3rem;
            color: #5a5a5a;
        }


        /* CUSTOMIZE THE CAROUSEL
-------------------------------------------------- */

        /* Carousel base class */
        .carousel {
            margin-bottom: 4rem;
        }

        /* Since positioning the image, we need to help out the caption */
        .carousel-caption {
            bottom: 3rem;
            z-index: 10;
        }

        /* Declare heights because of positioning of img element */
        .carousel-item {
            height: 32rem;
            background-color: #777;
        }

        .carousel-item>img {
            position: absolute;
            top: 0;
            left: 0;
            min-width: 100%;
            height: 32rem;
        }


        /* MARKETING CONTENT
-------------------------------------------------- */

        /* Center align the text within the three columns below the carousel */
        .marketing .col-lg-4 {
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .marketing h2 {
            font-weight: 400;
        }

        .marketing .col-lg-4 p {
            margin-right: .75rem;
            margin-left: .75rem;
        }


        /* Featurettes
------------------------- */

        .featurette-divider {
            margin: 5rem 0;
            /* Space out the Bootstrap <hr> more */
        }

        /* Thin out the marketing headings */
        .featurette-heading {
            font-weight: 300;
            line-height: 1;
            letter-spacing: -.05rem;
        }


        /* RESPONSIVE CSS
-------------------------------------------------- */

        @media (min-width: 40em) {

            /* Bump up size of carousel content */
            .carousel-caption p {
                margin-bottom: 1.25rem;
                font-size: 1.25rem;
                line-height: 1.4;
            }

            .featurette-heading {
                font-size: 50px;
            }
        }

        @media (min-width: 62em) {
            .featurette-heading {
                margin-top: 7rem;
            }
        }

        .gmap {
            width: 200%;
            height: 500px;
        }
    </style>
</head>

<body>
    <main role="main">
        <section class="jumbotron text-center" style="background-image: url('https://www.indonesia.travel/content/dam/indtravelrevamp/en/destinations/revision-2019/all-revision-destination/floresH.jpg');background-size: cover;">
            <div class="container" data-aos="fade-up" data-aos-duration="3000">
                <h1 class="jumbotron-heading" style="color:white;">lekas sembuh indonesia</h1>
                <p class="lead text-muted" style="color:#f8f9fa!important">WebGIS Pelayanan Test PCR dan Antigen COVID-19</p>

                <!-- Book  Ticket Start Here-->
                <p class="text-center">
                    <a class="btn btn-outline-light" href="login.php"><i class="fa fa-train" aria-hidden="true"></i> Ticket</a>
                    <a class="btn btn-outline-light" id="sidebarToggle"><i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                    <!-- <button class="btn btn-flat" href="login.php" role="button"><a href="login.php"><i class="fa fa-train" aria-hidden="true"></i></button>Book Ticket NOW</a> -->
                </p>
        </section>
        <div class="d-flex" id="wrapper">
            <?php if ($_SESSION['admin']['id']) { ?>
                <!-- Sidebar-->
                <div class="border-end bg-white" id="sidebar-wrapper">
                    <div class="sidebar-heading border-bottom bg-light">Masukkan Data Lokasi COVID-19 Test</div>
                    <form class="sidebar-heading border-bottom bg-light" action="proses.php" method="post">
                        <div class="form-group">
                            <label for="nama_tempat">Nama Tempat</label>
                            <input type="text" class="form-control" id="nama_tempat" name="nama_tempat">
                        </div>
                        <div class="form-group">
                            <label for="latlong">Latitude, Longitude</label>
                            <input type="text" class="form-control" id="latlong" name="latlong">
                        </div>
                        <div class="form-group">
                            <label for="kategori">Kategori Tempat</label>
                            <select class="form-control" name="kategori" id="kategori">
                                <option value="">--Kategori Tempat--</option>
                                <option value="Rumah Sakit">Rumah Sakit</option>
                                <option value="Klinik">Klinik</option>
                                <option value="Puskesmas">Puskesmas</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="kontak">No Telepon</label>
                            <input class="form-control" name="kontak" id="kontak" cols="30" rows="5"></input>
                        </div>
                        <div class="form-group">
                            <label for="jam_operasional">Jam Operasional</label>
                            <input class="form-control" name="jam_operasional" id="jam_operasional" cols="30" rows="5"></input>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-info">Tambah</button>
                        </div>
                    </form>
                </div>
            <?php } ?>
            <!-- Page content wrapper-->
            <div id="page-content-wrapper">
                <!-- Page content-->
                <div class="container-fluid">
                    <div class="container marketing">
                        <div class="row" data-aos="fade" data-aos-duration="2000">
                            <div class="alert alert-danger alert alert-dismissable col-md-10 offset-md-1" role="alert">
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                </button>
                                <p id="notice" class="d-flex mr-3 mb-0 font-weight-bold" class="btn btn-flat" "><b>Informasi Penting</b></p>
                    <div class=" media-body">
                                    Lihat informasi selanjutnya tentang COVID-19
                                    <a class="btn-flat" href="https://www.indonesia.travel/gb/en/coronavirus"> disini</a>
                            </div>
                        </div>
                    </div>

                    <!-- MAPID -->
                    <hr>
                    <div class="container marrketing">
                        <div class="inner-main-body p-2 p-sm-3 collapse forum-content show">
                            <h2>Pelayanan Rapid Test dan Antigen COVID-19</h2>
                            <div class="card mb-2">
                                <div class="card-body p-2 p-sm-3">
                                    <div class="media forum-item body">
                                        <div id="mapid" class="gmap"></div>
                                        <a target=> </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a class="float-right btn btn-flat" href="./login.php"> Insert Your Data <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></a>
                    <br><br>
                    <!-- START THE FEATURETTES -->

                    <hr class="featurette-divider">
                    <?php if ($_SESSION['admin']['id']) { ?>
                        <div class="row featurette" data-aos="fade-left" data-aos-duration="2000">
                            <div class="col-md-7">
                                <h2 class="featurette-heading">Donny Rizal Adhi Pratama</span></h2></a>
                                <h2 class="post-heading">L200183161</span></h2></a>
                                <p class="lead text-justify">I thought it was hard... heck yeah.... 🙃</p>
                            </div>
                            <div class="col-md-5">
                                <img class="featurette-image img-fluid mx-auto" src="./assets/images/foto.png" alt="Gambar">
                            </div>
                        </div>

                        <hr class="featurette-divider">

                        <div class="row featurette" data-aos="fade-right" data-aos-duration="2000">
                            <div class="col-md-7 order-md-2">
                                <h2 class="featurette-heading">Galih Prayoga</span></h2></a>
                                <h2 class="post-heading">L200180006</span></h2></a>
                                <p class="lead text-justify">.......</p>
                            </div>
                            <div class="col-md-5 order-md-1">
                                <img class="featurette-image img-fluid mx-auto" src="https://www.indonesia.travel/content/dam/indtravelrevamp/user-generated-content/ugc-july-2020/gb-en/3.jpg" alt="Gambar">
                            </div>
                        </div>

                        <hr class="featurette-divider">

                        <div class="row featurette" data-aos="fade-left" data-aos-duration="2000">
                            <div class="col-md-7">
                                <h2 class="featurette-heading">Bachtiar Nuhri Kurniawan</span></h2></a>
                                <p class="lead text-justify">L200180031</p>
                                <p class="lead text-justify">.......</p>
                            </div>
                            <div class="col-md-5">
                                <img class="featurette-image img-fluid mx-auto" src="https://www.indonesia.travel/content/dam/indtravelrevamp/user-generated-content/ugc-july-2020/gb-en/6.jpg" alt="Gambar">
                            </div>
                        </div>

                        <hr class="featurette-divider">

                        <div class="row featurette" data-aos="fade-right" data-aos-duration="2000">
                            <div class="col-md-7 order-md-2">
                                <h2 class="featurette-heading">Edi Supriyanto (L200180002)</span></h2></a>
                                <p class="lead text-justify">L200180002</p>
                                <p class="lead text-justify">.......</p>
                            </div>
                            <div class="col-md-5 order-md-1">
                                <img class="featurette-image img-fluid mx-auto" src="https://www.indonesia.travel/content/dam/indtravelrevamp/user-generated-content/ugc-july-2020/gb-en/6.jpg" alt="Gambar">
                            </div>
                        </div>

                        <hr class="featurette-divider">
                        <!-- /END THE FEATURETTES -->

                </div><!-- /.container -->
            <?php } ?>

            <!-- FOOTER -->
            <footer class="container">
                <a class="float-right" href="#"> <i class="fa fa-arrow-circle-up" aria-hidden="true"></i></a>
                <p>&copy; Donny Rizal &middot; <a href="#">Privacy</a> &middot; <a href="#notice">Terms</a></p>
            </footer>
            </div>
        </div>
        </div>
        <!-- Marketing messaging and featurettes
      ================================================== -->
        <!-- Wrap the rest of the page in another container to center all the content. -->


    </main>
    <!-- Pembuatan Koding si Leaflet -->
    <script>
        if ('geolocation' in navigator) {
            console.log('geolocation available');
            navigator.geolocation.watchPosition(position => {
                lat = position.coords.latitude;
                lon = position.coords.longitude;
                latlon = position.coords.latitude + "," + position.coords.longitude;
                console.log(lat, lon);
                // document.getElementById('latitude').textContent = lat;
                // document.getElementById('longitude').textContent = lon;
            });
        } else {
            console.log('geolocation not available');
        }
        // set lokasi latitude dan longitude, lokasinya kota palembang 
        var mymap = L.map('mapid').setView([-7.504765474573392, 110.74061967973947], 13);
        mymap.locate({
            maxZoom: 16,
            enableHighAccuracy: true,
            setView: true
        });
        L.accessToken = 'pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXFhYTA2bTMyeW44ZG0ybXBkMHkifQ.gUGbDOPUN1v1fTs5SeOR4A';
        //setting maps menggunakan api mapbox bukan google maps, daftar dan dapatkan token      

        L.tileLayer(
            'https://api.mapbox.com/styles/v1/mapbox/streets-v11/tiles/256/{z}/{x}/{y}?access_token=' + L.accessToken, {
                // 'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibmFiaWxjaGVuIiwiYSI6ImNrOWZzeXh5bzA1eTQzZGxpZTQ0cjIxZ2UifQ.1YMI-9pZhxALpQ_7x2MxHw', {
                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                minZoom: 8,
                maxZoom: 17,
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
                .setContent("Koordinat " + e.latlng.lat + ',' + e.latlng.lng
                    .toString()
                ) //set isi konten yang ingin ditampilkan, kali ini kita akan menampilkan latitude dan longitude
                .openOn(mymap);

            document.getElementById('latlong').value = e.latlng.lat + ',' + e.latlng.lng //value pada form latitde, longitude akan berganti secara otomatis
        }
        mymap.on('click', onMapClick); //jalankan fungsi
        <?php
        $tampil = mysqli_query($koneksi, "select * from lokasi"); //ambil data dari tabel lokasi
        // $linkmaps = $_SESSION[];
        while ($hasil = mysqli_fetch_array($tampil)) { ?> //melooping data menggunakan while
            // var customPopup = "<center><b style='color:yellow'> Nama Tempat :" +
            <?php
            // echo json_encode($hasil['nama_tempat']); 
            ?>
            // + "</b><br>Jl. Rowo Bening, Perum. Tiga Putri Tahap III<div class='text-center'><a href='https://facebook.com/idet.ambun' target='_blank' class='facebook' style='color:#fff;'><i class='fa fa-facebook'></i></a> <a href='https://twitter.com/detriamelia' target='_blank' class='twitter' style='color:#fff;'><i class='fa fa-twitter'></i></a> <a href='https://www.instagram.com/detriamelia/' target='_blank' class='instagram' style='color:#fff;'><i class='fa fa-instagram'></i></a> <a href='https://web.telegram.org/#/im?p=u687504930_6230769115732589639' class='telegram' style='color:#fff;'><i class='fa fa-whatsapp'></i></a></div></center>";

            var customOptions = {
                'maxWidth': '1000',
                'className': 'custom',
                closeButton: true,
                autoClose: true
            }

            var myIcon = L.icon({
                iconUrl: './assets/images/hospital (1).svg',
                iconSize: [40, 40], // size of the icon
            });

            //menggunakan fungsi L.marker(lat, long) untuk menampilkan latitude dan longitude
            //menggunakan fungsi str_replace() untuk menghilankan karakter yang tidak dibutuhkan
            L.marker([<?php echo $hasil['lat_long']; ?>], {
                    icon: myIcon
                }).addTo(mymap)

                //data ditampilkan di dalam bindPopup( data ) dan dapat dikustomisasi dengan html
                .bindPopup("<?php echo '<div class=\"leaflet-popup-content leaflet-popup-content-wrapper\"><b>' . $hasil['nama_tempat'] . '</b><br>Jam Buka' . $hasil['kategori'] . '<br> Jam Operasional:' . htmlentities($hasil['jam_operasional']) . '<br> <a id=getlink href=https://www.google.com/maps/dir/-6.9070296,112.4196687/' . $hasil['lat_long']; ?> target='_blank'>Petunjuk Arah</a></div>", customOptions)
            // .bindPopup(customPopup, customOptions);
        <?php } ?>

        // placeholders for the L.marker and L.circle representing user's current position and accuracy    
        var current_position, current_accuracy;

        // ICON
        var ikonaru = L.icon({
            iconUrl: './assets/images/train.svg',
            iconSize: [40, 40], // size of the icon
        });

        function onLocationFound(e) {
            // if position defined, then remove the existing position marker and accuracy circle from the map
            if (current_position) {
                mymap.removeLayer(current_position);
                mymap.removeLayer(current_accuracy);
            }

            var radius = e.accuracy / 2;

            current_position = L.marker(e.latlng).addTo(mymap)
                .bindPopup("You are within " + radius + " meters from this point").openPopup();

            current_accuracy = L.circle(e.latlng, radius).addTo(mymap);
        }

        function onLocationError(e) {
            alert(e.message);
        }

        mymap.on('locationfound', onLocationFound);
        mymap.on('locationerror', onLocationError);



        // wrap mymap.locate in a function    
        function locate() {
            mymap.locate({
                maxZoom: 16,
                enableHighAccuracy: true,
                setView: true,
                maxZoom: 16
            });
        }
        addTo(mymap);
        // call locate every 3 seconds... forever
        setInterval(locate, 3000);
    </script>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="https://cdn.jsdelivr.net/npm/holderjs@2.9.7/holder.min.js"></script>
    <!-- Aos.js -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <!-- Core theme JS-->
    <script src="./assets/js/script.js"></script>
    <script>
        AOS.init();
    </script>
</body>

</html>