<?php
// mengaktifkan session pada php
session_start();
if (!isset($_SESSION['admin']) or empty($_SESSION['user'])) {
	// menghubungkan php dengan koneksi database
	include 'koneksi.php';

	// menangkap data yang dikirim dari form login
	$username = htmlspecialchars(mysqli_escape_string($koneksi, $_POST['username']));
	$password = htmlentities(mysqli_escape_string($koneksi, $_POST['password']));


	// menyeleksi data user dengan username dan password yang sesuai
	$login = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$username' and password='$password'");
	// menghitung jumlah data yang ditemukan
	$cek = mysqli_num_rows($login);

	// cek apakah username dan password di temukan pada database
	if ($cek > 0) {

		$data = mysqli_fetch_assoc($login);

		// cek jika user login sebagai admin
		if ($data['id'] == "1") {
			$_SESSION['admin'] = array(
				'id' => $data['id'],
				'username' => $data['username'],
				'password' => $data['password']
			);
			echo "<script>window.location='admin/';</script>";
			// buat session login dan username
			// $_SESSION['username'] = $username;
			// $_SESSION['level'] = "admin";
			// alihkan ke halaman dashboard admin
			// header("location:admin/admin.php");

			// cek jika user login sebagai user
		} else {
			// alihkan ke halaman login kembali
			echo "window.location='./login.php?pesan=gagal';</script>";
		}
	} else {
		echo "<script>window.location='./login.php?pesan=gagal';</script>";
	}
} else {
	if (isset($_SESSION['admin'])) {
		echo "<script>window.location='admin/';</script>";
	}
}
