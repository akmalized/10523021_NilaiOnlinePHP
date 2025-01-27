<?php
session_start();
include 'koneksi.php';

if (isset($_POST['submit'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	$error = '';

	$query = "SELECT * FROM admin WHERE username = '$username'";
	$result = mysqli_query($koneksi, $query);
	if ($user = mysqli_fetch_assoc($result)) {
		if (password_verify($password, $user['password'])) {
			$_SESSION['user_role'] = 'admin';
			header('Location: admin/index.php');
			exit;
		}
	}

	$query = "SELECT * FROM mahasiswa WHERE nim = '$username'";
	$result = mysqli_query($koneksi, $query);
	if ($user = mysqli_fetch_assoc($result)) {
		if (password_verify($password, $user['password'])) {
			$_SESSION['user_role'] = 'mahasiswa';
			header('Location: nilai/viewNilai.php');
			exit;
		}
	}

	$query = "SELECT * FROM dosen WHERE nip = '$username'";
	$result = mysqli_query($koneksi, $query);
	if ($user = mysqli_fetch_assoc($result)) {
		if (password_verify($password, $user['password'])) {
			$_SESSION['user_role'] = 'dosen';
			header('Location: mahasiswa/viewMahasiswa.php');
			exit;
		}
	}

	$error = 'Username atau password salah!';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>.: Sistem Informasi Nilai Online - Universitas Komputer Indonesia :.</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="shortcut icon" type="image/x-icon" href="images/logoicon.ico" />
	<link href="https://fonts.googleapis.com/css?family=Droid+Sans:regular,bold" rel="stylesheet" type="text/css" />
	<link href="https://fonts.googleapis.com/css?family=Kreon:light,regular" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="style-sheet.css" />
</head>

<body>
	<header>
		<section class="logo"><a href="#"><img src="logo.png" /></a></section>
		<section class="title">Sistem Informasi Nilai Online <br /> <span>UNIVERSITAS KOMPUTER INDONESIA</span></section>
		<section class="clr">
			<center>Jl. Dipati Ukur No.112-116, Lebakgede, Kecamatan Coblong, Kota Bandung, Jawa Barat 40132</center>
		</section>
	</header>

	<section id="container">
		<div>
			<center>
				<section id="navigator">
					<ul class="menus">
						<h2>LOGIN PAGE</h2>
					</ul>
				</section>
				<br /><br />
			
				<?php if (!empty($error)): ?>
					<p style="color: red;"><?php echo $error; ?></p>
				<?php endif; ?>
				<form enctype="multipart/form-data" method="post" class="form-login">
					<table>
						<tr>
							<td><input type="text" name="username" placeholder="Username(admin) or NIM, NIP" required /></td>
						</tr>
						<tr>
							<td><input type="password" name="password" placeholder="Password" required /></td>
						</tr>
						<tr>
							<td><input id="submit" name="submit" type="submit" value="Login"></td>
						</tr>
					</table>
				</form>
			</center>
		</div>
		<section class="clr"></section>
	</section>

</body>

</html>