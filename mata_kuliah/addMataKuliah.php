<?php
session_start();
include '../koneksi.php';

if (isset($_POST['kode_matkul']) && isset($_POST['nama_matkul'])) {
    $kode_matkul = $_POST['kode_matkul'];
    $nama_matkul = $_POST['nama_matkul'];

    $query = "INSERT INTO mata_kuliah (kode_matkul, nama_matkul) VALUES ('$kode_matkul', '$nama_matkul')";
    if ($koneksi->query($query)) {
        header("Location: viewMataKuliah.php");
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
    <title>Tambah Mata Kuliah</title>
    <link rel="shortcut icon" type="image/x-icon" href="images/logoicon.ico" />
    <link href="https://fonts.googleapis.com/css?family=Droid+Sans:regular,bold" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Kreon:light,regular" rel="stylesheet" type="text/css" />
 
</head>

<style>
    body {
        font-family: 'Droid Sans', sans-serif;
        background-color: #f4f7fa;
        margin: 0;
        padding: 0;
        color: #333;
    }

    header {
        background: #1976d2;
        color: white;
        padding: 20px 0;
        text-align: center;
        font-size: 26px;
        font-weight: bold;
        border-bottom: 5px solid #0d47a1;
    }

    #container {
        width: 90%;
        margin: 40px auto;
        background: white;
        padding: 40px;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    h1 {
        color: #1976d2;
        font-size: 34px;
        text-align: center;
        margin-bottom: 30px;
    }

    form {
        max-width: 500px;
        margin: 0 auto;
        padding: 20px;
        background: #e3f2fd;
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    }

    label {
        font-size: 20px;
        color: #1976d2;
        font-weight: bold;
        display: block;
        margin-bottom: 10px;
    }

    input[type="text"] {
        width: 100%;
        padding: 15px;
        font-size: 18px;
        border: 1px solid #ddd;
        border-radius: 5px;
        box-sizing: border-box;
        margin-bottom: 20px;
    }

    button {
        width: 100%;
        padding: 15px;
        background: #1976d2;
        color: white;
        font-size: 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background 0.3s, transform 0.3s;
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
        padding: 12px 30px;
        background: #1976d2;
        color: white;
        border-radius: 5px;
        text-decoration: none;
        transition: background 0.3s, transform 0.3s;
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
        margin-top: 30px;
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

                        <li><a href="../logout.php">Logout</a></li> <
                    </ul>
                </section>
                <br /><br />

                <h1>Tambah Mata Kuliah</h1>
                <br><br>

             
                <form method="POST" action="">
                    <label>Kode Mata Kuliah:</label><br>
                    <input type="text" name="kode_matkul" required><br>
                    <label>Nama Mata Kuliah:</label><br>
                    <input type="text" name="nama_matkul" required><br><br>
                    <button type="submit">Simpan</button>
                </form>
                <br><br>
            </center>
        </div>
    </section>

    <footer>
        <font color=#000> Copyright &copy; 2025 - Universitas Komputer Indonesia  <br />
            Developed By <a href="#" target="_new">Akmal</a> </font>
    </footer>
</body>

</html>
