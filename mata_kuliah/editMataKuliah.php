<?php
session_start();

if (!isset($_SESSION['user_role'])) {
    header('Location: ../index.php');
    exit;
}

// Redirect berdasarkan role
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

include '../koneksi.php';

if (isset($_GET['kode_matkul'])) {
    $kode_matkul = $_GET['kode_matkul'];

    $result = $koneksi->query("SELECT * FROM mata_kuliah WHERE kode_matkul = '$kode_matkul'");
    $row = $result->fetch_assoc();

    if (isset($_POST['nama_matkul'])) {
        $nama_matkul = $_POST['nama_matkul'];

        $update_query = "UPDATE mata_kuliah SET nama_matkul = '$nama_matkul' WHERE kode_matkul = '$kode_matkul'";
        if ($koneksi->query($update_query)) {
            header("Location: viewMataKuliah.php");
        } else {
            echo "Error: " . $koneksi->error;
        }
    }
}
?>

<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit MataKuliah</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="shortcut icon" type="image/x-icon" href="../images/logoicon.ico" />
    <link href="https://fonts.googleapis.com/css?family=Droid+Sans:regular,bold" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Kreon:light,regular" rel="stylesheet" type="text/css" />
  
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
        margin: 30px auto;
        background: white;
        padding: 40px;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }

    h1 {
        color: #1976d2;
        font-size: 34px;
        text-align: center;
        margin-bottom: 30px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    table th,
    table td {
        padding: 20px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    table th {
        background: #1976d2;
        color: white;
        font-size: 22px;
        font-weight: bold;
    }

    table tr:nth-child(even) {
        background: #f2f2f2;
    }

    table tr:hover {
        background: #bbdefb;
    }

    input[type="text"] {
        width: 100%;
        padding: 15px;
        font-size: 18px;
        border: 1px solid #ddd;
        border-radius: 5px;
        box-sizing: border-box;
    }

    .btn {
        display: inline-block;
        padding: 15px 30px;
        background: #1976d2;
        color: white;
        font-size: 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background 0.3s, transform 0.3s;
    }

    .btn:hover {
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

</head>

<body>
    <!-- Header Section -->
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
                        <!-- Admin Menu -->
                        <?php if ($_SESSION['user_role'] === 'admin'): ?>
                            <li><a href="../admin/index.php">Home</a></li>
                            <li><a href="../mata_kuliah/viewMataKuliah.php">Mata Kuliah</a></li>
                            <li><a href="../dosen/viewDosen.php">Dosen</a></li>
                        <?php endif; ?>

                        <!-- Dosen Menu -->
                        <?php if ($_SESSION['user_role'] === 'dosen'): ?>
                            <li><a href="../dosen/nilai.php">Nilai</a></li>
                            <li><a href="../dosen/mahasiswa.php">Mahasiswa</a></li>
                        <?php endif; ?>

                        <!-- Mahasiswa Menu -->
                        <?php if ($_SESSION['user_role'] === 'mahasiswa'): ?>
                            <li><a href="../mahasiswa/nilai.php">Nilai</a></li>
                        <?php endif; ?>

                        <li><a href="../logout.php">Logout</a></li>
                    </ul>
                </section>

                <h1>Edit Mata Kuliah</h1>
                <form method="POST" action="">
                    <table class="table">
                        <tr>
                            <th>Kode Mata Kuliah:</th>
                            <td><input type="text" name="kode_matkul" value="<?= htmlspecialchars($row['kode_matkul']) ?>" readonly></td>
                        </tr>
                        <tr>
                            <th>Nama Mata Kuliah:</th>
                            <td><input type="text" name="nama_matkul" value="<?= htmlspecialchars($row['nama_matkul']) ?>" required></td>
                        </tr>
                        <tr>
                            <td colspan="2"><button type="submit" class="btn">Update</button></td>
                        </tr>
                    </table>
                </form>
            </center>
        </div>
    </section>

    <footer>
        <font color=#000> Copyright &copy; 2025 - Universitas Komputer Indonesia  <br />
            Developed By <a href="#" target="_new">Akmal</a> </font>
    </footer>
</body>

</html>