<?php
session_start();
include '../koneksi.php';

$hasil_query = $koneksi->query("SELECT nilai.id, nilai.nilai_tugas, nilai.nilai_uts, nilai.nilai_uas, nilai.nilai_akhir, mahasiswa.nama AS mahasiswa, dosen.nama AS dosen, mata_kuliah.nama_matkul 
                                FROM nilai 
                                JOIN mahasiswa ON nilai.nim = mahasiswa.nim
                                JOIN dosen ON nilai.nip = dosen.nip
                                JOIN mata_kuliah ON nilai.kode_matkul = mata_kuliah.kode_matkul");

$baris = 1;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Nilai</title>
    <link rel="shortcut icon" type="image/x-icon" href="images/logoicon.ico" />
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
                            <li><a href="../mahasiswa/viewMahasiswa.php">Mahasiswa</a></li>
                            <li><a href="../nilai/viewNilai.php">Nilai</a></li>
                        <?php endif; ?>

                     
                        <?php if ($_SESSION['user_role'] === 'mahasiswa'): ?>
                            <li><a href="../nilai/viewNilai.php">Nilai</a></li>
                        <?php endif; ?>

                        <li><a href="../logout.php">Logout</a></li>
                    </ul>
                </section>
                <br /><br />
               
                <h1>Daftar Nilai</h1>
                <br><br>

                <?php if ($_SESSION['user_role'] !== 'mahasiswa'): ?>
                    <a href="addNilai.php">Tambah Nilai</a>
                    <br>
                    <br>
                <?php endif; ?>

                <table border="1" cellpadding="10" class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nilai Tugas</th>
                            <th>Nilai UTS</th>
                            <th>Nilai UAS</th>
                            <th>Nilai Akhir</th>
                            <th>Nama Mahasiswa</th>
                            <th>Nama Dosen</th>
                            <th>Nama Mata Kuliah</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($data_nilai = $hasil_query->fetch_assoc()): ?>
                            <tr>
                                <td><?= $baris++ ?></td>
                                <td><?= $data_nilai['nilai_tugas'] ?></td>
                                <td><?= $data_nilai['nilai_uts'] ?></td>
                                <td><?= $data_nilai['nilai_uas'] ?></td>
                                <td><?= $data_nilai['nilai_akhir'] ?></td>
                                <td><?= $data_nilai['mahasiswa'] ?></td>
                                <td><?= $data_nilai['dosen'] ?></td>
                                <td><?= $data_nilai['nama_matkul'] ?></td>
                                <td>
                                    <?php if ($_SESSION['user_role'] !== 'mahasiswa' && 'admin'): ?>
                                        <a href="editNilai.php?id=<?= $data_nilai['id'] ?>">Edit</a>
                                        <a href="hapusNilai.php?id=<?= $data_nilai['id'] ?>" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                                    <?php else: ?>
                                        
                                        Tidak ada aksi
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                <br>
                <br>
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