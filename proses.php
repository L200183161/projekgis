

<?php
//koneksi
$connect = mysqli_connect('localhost', 'root', '', 'gis_latihan');


//set variabel
$lat_long       = $_POST['latlong'];
$nama_tempat    = $_POST['nama_tempat'];
$kategori       = $_POST['kategori'];
$jam_operasional     = $_POST['jam_operasional'];
$kontak     = $_POST['kontak'];


//input data
$insert = mysqli_query($connect, "insert into lokasi set lat_long='$lat_long', nama_tempat='$nama_tempat', kategori='$kategori', jam_operasional='$jam_operasional',kontak='$kontak' ");

//kembali
header("Location: index.php");

?>