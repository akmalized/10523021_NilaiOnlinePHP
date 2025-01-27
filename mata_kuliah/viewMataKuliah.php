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


include '../koneksi.php';
?>

<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="UTF-8">
    <title>.: Sistem Informasi Nilai Online - Universitas Komputer Indonesia :.</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="shortcut icon" type="image/x-icon" href="../images/logoicon.ico" />
    <link href="https://fonts.googleapis.com/css?family=Droid+Sans:regular,bold" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Kreon:light,regular" rel="stylesheet" type="text/css" />
</head>

<style>
    body {
        font-family: 'Droid Sans', sans-serif;
        background-color: #f4f4f9;
        margin: 0;
        padding: 0;
        color: #333;
    }

    header {
        background: #1565c0;
        color: white;
        padding: 20px 0;
        text-align: center;
        font-size: 24px;
        font-weight: bold;
    }

    #container {
        width: 90%;
        margin: 30px auto;
        background: white;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    }

    h1 {
        color: #1565c0;
        font-size: 32px;
        text-align: center;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .table th, 
    .table td {
        padding: 15px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    .table th {
        background-color: #1565c0;
        color: white;
        font-size: 18px;
    }

    .table tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    .table tr:hover {
        background-color: #bbdefb;
    }

    a {
        text-decoration: none;
        color: #1565c0;
        font-weight: bold;
        transition: color 0.3s;
    }

    a:hover {
        color: #0d47a1;
    }

    .btn {
        display: inline-block;
        padding: 12px 25px;
        background: #1565c0;
        color: white;
        font-size: 18px;
        border-radius: 5px;
        text-decoration: none;
        transition: background 0.3s, transform 0.3s;
    }

    .btn:hover {
        background: #0d47a1;
        transform: scale(1.05);
    }

    footer {
        text-align: center;
        padding: 20px;
        background: #0d47a1;
        color: white;
        font-size: 14px;
        border-radius: 0 0 10px 10px;
    }

    .menus {
        list-style: none;
        padding: 0;
        text-align: center;
    }

    .menus li {
        display: inline;
        margin: 0 10px;
    }

    .menus a {
        font-size: 18px;
        padding: 12px 25px;
        background: #1565c0;
        color: white;
        border-radius: 5px;
        transition: background 0.3s, transform 0.3s;
    }

    .menus a:hover {
        background:rgb(251, 255, 0);
        transform: scale(1.05);
    }

    .action-links a {
        margin-right: 10px;
        padding: 10px 20px;
        background: #1565c0;
        color: white;
        border-radius: 5px;
        text-decoration: none;
        font-weight: bold;
    }

    .action-links a:hover {
        background: #0d47a1;
    }

    .button-container {
        text-align: center;
        margin-top: 20px;
    }

    .button-container a {
        display: inline-block;
        margin: 0 15px;
        font-size: 20px;
        padding: 12px 30px;
        background: #1565c0;
        color: white;
        border-radius: 5px;
        text-decoration: none;
        transition: background 0.3s, transform 0.3s;
    }

    .button-container a:hover {
        background: #0d47a1;
        transform: scale(1.1);
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
                            <li><a href="../dosen/nilai.php">Nilai</a></li>
                            <li><a href="../dosen/mahasiswa.php">Mahasiswa</a></li>
                        <?php endif; ?>

                       
                        <?php if ($_SESSION['user_role'] === 'mahasiswa'): ?>
                            <li><a href="../mahasiswa/nilai.php">Nilai</a></li>
                        <?php endif; ?>

                        <li><a href="../logout.php">Logout</a></li>
                    </ul>
                </section>
                <br /><br />
                <h1>Daftar Mata Kuliah</h1>
                <a href="addMataKuliah.php" class="btn">Tambah Mata Kuliah</a>

                <table border="1" cellpadding="10" class="table">
                    <thead>
                        <tr>
                            <th>Kode Mata Kuliah</th>
                            <th>Nama Mata Kuliah</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM mata_kuliah";
                        $hasil = $koneksi->query($query);
                        if ($hasil && $hasil->num_rows > 0) {
                            while ($row = $hasil->fetch_assoc()) {
                        ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['kode_matkul']) ?></td>
                                    <td><?= htmlspecialchars($row['nama_matkul']) ?></td>
                                    <td class="action-links">
                                        <a href="editMataKuliah.php?kode_matkul=<?= urlencode($row['kode_matkul']) ?>">Edit</a> |
                                        <a href="deleteMataKuliah.php?kode_matkul=<?= urlencode($row['kode_matkul']) ?>" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                                    </td>
                                </tr>
                        <?php
                            }
                        } else {
                            echo '<tr><td colspan="3">Data tidak ditemukan</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
                <section class="clr"></section>
            </center>
        </div>

    </section>

   
    <footer>
        <font color=#000> Copyright &copy; 2025 - Universitas Komputer Indonesia  <br />
            Developed By <a href="#" target="_new">Akmal</a> </font>
    </footer>
</body>

</html>