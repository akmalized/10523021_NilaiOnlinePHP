<?php
include '../koneksi.php';
session_start();

$matkul_result = $koneksi->query("SELECT * FROM mata_kuliah");

if (isset($_POST['nip']) && isset($_POST['nama']) && isset($_POST['kode_matkul']) && isset($_POST['password'])) {
    $nip = $_POST['nip'];
    $nama = $_POST['nama'];
    $kode_matkul = $_POST['kode_matkul'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $query = "INSERT INTO dosen (nip, nama, kode_matkul, password) VALUES ('$nip', '$nama', '$kode_matkul', '$password')";
    if ($koneksi->query($query)) {
        header("Location: viewDosen.php");
    } else {
        echo "Error: " . $query . "<br>" . $koneksi->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Dosen</title>
    <link rel="shortcut icon" type="image/x-icon" href="images/logoicon.ico" />
    <link href="https://fonts.googleapis.com/css?family=Droid+Sans:regular,bold" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Kreon:light,regular" rel="stylesheet" type="text/css" />
    
</head>

<style>
    body {
        font-family: 'Droid Sans', sans-serif;
        background: #f0f4f8;
        margin: 0;
        padding: 0;
        color: #333;
    }

    header {
        background: #1976d2;
        color: white;
        padding: 25px 0;
        text-align: center;
        font-size: 28px;
        font-weight: bold;
        box-shadow: 0px 3px 10px rgba(0, 0, 0, 0.2);
    }

    header .title {
        font-size: 24px;
    }

    #container {
        max-width: 700px;
        margin: 50px auto;
        background: white;
        padding: 40px;
        border-radius: 15px;
        box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    h1 {
        color: #1976d2;
        font-size: 32px;
        margin-bottom: 20px;
    }

    form {
        text-align: left;
    }

    label {
        font-size: 18px;
        color: #1976d2;
        font-weight: bold;
        display: block;
        margin-bottom: 8px;
    }

    input[type="text"],
    input[type="password"],
    select {
        width: 100%;
        padding: 14px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 8px;
        margin-bottom: 20px;
        outline: none;
        transition: border-color 0.3s;
    }

    input:focus,
    select:focus {
        border-color: #1976d2;
    }

    button {
        width: 100%;
        padding: 15px;
        font-size: 20px;
        color: white;
        background: #1976d2;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: background 0.3s ease, transform 0.2s ease;
    }

    button:hover {
        background: #0d47a1;
        transform: scale(1.05);
    }

    .menus {
        list-style: none;
        padding: 0;
        text-align: center;
    }

    .menus li {
        display: inline;
        margin: 0 15px;
    }

    .menus a {
        font-size: 18px;
        padding: 12px 25px;
        background: #1976d2;
        color: white;
        border-radius: 8px;
        text-decoration: none;
        transition: background 0.3s ease, transform 0.2s ease;
    }

    .menus a:hover {
        background:rgb(251, 255, 0);
        transform: scale(1.05);
    }

    footer {
        text-align: center;
        padding: 20px;
        background: #0d47a1;
        color: white;
        font-size: 16px;
        border-radius: 0 0 10px 10px;
        margin-top: 50px;
    }
</style>


<body>
    <header>
        <section class="logo"><a href="#"><img src="../images/logo.png" /></a></section>
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
                        <?php if ($_SESSION['user_role'] === 'admin'): ?>
                            <li><a href="../admin/index.php">Home</a></li>
                            <li><a href="../mata_kuliah/viewMataKuliah.php">Mata Kuliah</a></li>
                            <li><a href="../dosen/viewDosen.php">Dosen</a></li>
                        <?php endif; ?>

                        <?php if ($_SESSION['user_role'] === 'dosen'): ?>
                            <li><a href="../mahasiswa/viewMahasiswa.php">Mahasiswa</a></li>
                            <li><a href="../nilai/viewNilai.php">Nilai</a></li>
                        <?php endif; ?>

                        <?php if ($_SESSION['user_role'] === 'mahasiswa'): ?>
                            <li><a href="../nilai/viewNilai.php">Nilai</a></li>
                        <?php endif; ?>

                        <li><a href="../logout.php">Logout</a></li> <!-- Logout link -->
                    </ul>
                </section>
                <br /><br />
                <h1>Tambah Dosen</h1>
                <form method="POST" action="">
                    <label>NIP:</label><br>
                    <input type="text" name="nip" required><br>

                    <label>Nama:</label><br>
                    <input type="text" name="nama" required><br>

                    <label>Kode Mata Kuliah:</label><br>
                    <select name="kode_matkul" required>
                        <option value="">-- Pilih Mata Kuliah --</option>
                        <?php while ($row = $matkul_result->fetch_assoc()): ?>
                            <option value="<?= $row['kode_matkul'] ?>"><?= $row['kode_matkul'] . ' - ' . $row['nama_matkul'] ?></option>
                        <?php endwhile; ?>
                    </select><br>

                    <label>Password:</label><br>
                    <input type="password" name="password" required><br><br>

                    <button type="submit">Simpan</button>
                </form>
            </center>
        </div>
        <section class="clr"></section>
    </section>

    <footer>
        <font color=#000> Copyright &copy; 2025 - Universitas Komputer Indonesia  <br />
            Developed By <a href="#" target="_new">Akmal</a> </font>
    </footer>
</body>

</html>