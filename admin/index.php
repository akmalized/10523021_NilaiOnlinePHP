<?php
session_start(); 

if (!isset($_SESSION['user_role'])) {
	header('Location: ../index.php'); 
	exit;
}


if ($_SESSION['user_role'] === 'mahasiswa') {
	header('Location: ../mahasiswa/nilai.php'); 
	exit;
} elseif ($_SESSION['user_role'] === 'dosen') {
	header('Location: ../dosen/nilai.php'); 
	exit;
} elseif ($_SESSION['user_role'] !== 'admin') {
	header('Location: ../index.php'); 
	exit;
}


?>

<!DOCTYPE html>


<html class="no-js" lang="en">

<head>
	<title>.: Sistem Informasi Nilai Online - Universitas Komputer Indonesia :.</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="shortcut icon" type="image/x-icon" href="../images/logoicon.ico" />
	<link href='http://fonts.googleapis.com/css?family=Droid+Sans:regular,bold' rel='stylesheet' type='text/css' />
	<link href='http://fonts.googleapis.com/css?family=Kreon:light,regular' rel='stylesheet' type='text/css' />
	<link rel="stylesheet" type="text/css" href="../style-sheet.css" />
</head>

<body onLoad="initialize()">
	<header>
		<section class="logo"><a href="#"><img src="../images/logo.png" /></a></section>
		<section class="title">Sistem Informasi Nilai Online <br /> <span>UNIVERSITAS KOMPUTER INDONESIA</span></section>
		<section class="clr">
			<center>Jl. Dipati Ukur No.112-116, Lebakgede, Kecamatan Coblong, Kota Bandung, Jawa Barat 40132</center>
		</section>
	</header>

	<section id="navigator">
		<ul class="menus">
			<?php if ($_SESSION['user_role'] === 'admin'): ?>
				<li><a href="../admin/index.php">Home</a></li>
				<li><a href="../mata_kuliah/viewMataKuliah.php">Mata Kuliah</a></li>
				<li><a href="../dosen/viewDosen.php">Dosen</a></li>
			<?php endif; ?>

			<?php if ($_SESSION['user_role'] === 'dosen'): ?>
				<li><a href="../dosen/nilai.php">Nilai</a></li>
				<li><a href="../dosen/mahasiswa.php">Mahasiswa</a></li>
			<?php endif; ?>

			<?php if ($_SESSION['user_role'] === 'mahasiswa'): ?>
				<li><a href="../mahasiswa/nilai.php">Nilai</a></li>
			<?php endif; ?>

			<li><a href="../logout.php">Logout</a></li> 
		</ul>
	</section>

	<section id="container">
		<br><br><br>
		<?php include("home.php"); ?>
		<br><br><br><br><br><br>
		<section class="clr"></section>
	</section>


	<footer>
        <font color=#000> Copyright &copy; 2025 - Universitas Komputer Indonesia  <br />
            Developed By <a href="#" target="_new">Akmal</a> </font>
    </footer>
</body>

</html>