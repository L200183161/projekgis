<?php
$koneksi = mysqli_connect("localhost", "root", "", "gis_latihan");

// Check connection
if (mysqli_connect_errno()) {
	echo "Database cannot connect : " . mysqli_connect_error();
}
