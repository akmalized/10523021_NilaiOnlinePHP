<?php
include '../koneksi.php';
session_start();

if (isset($_POST['nilai_tugas']) && isset($_POST['nilai_uts']) && isset($_POST['nilai_uas']) && isset($_POST['nim']) && isset($_POST['nip']) && isset($_POST['kode_matkul'])) {
    $nilai_tugas = $_POST['nilai_tugas'];
    $nilai_uts = $_POST['nilai_uts'];
    $nilai_uas = $_POST['nilai_uas'];
    $nim = $_POST['nim'];
    $nip = $_POST['nip'];
    $kode_matkul = $_POST['kode_matkul'];

    $nilai_akhir = (0.2 * $nilai_tugas) + (0.4 * $nilai_uts) + (0.4 * $nilai_uas);

    $query = "INSERT INTO nilai (nilai_tugas, nilai_uts, nilai_uas, nim, nip, kode_matkul, nilai_akhir) 
              VALUES ('$nilai_tugas', '$nilai_uts', '$nilai_uas', '$nim', '$nip', '$kode_matkul', '$nilai_akhir')";
    if ($koneksi->query($query)) {
        header("Location: viewNilai.php");
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
    <title>Tambah Nilai</title>
    <link rel="shortcut icon" type="image/x-icon" href="images/logoicon.ico" />
    <link href="https://fonts.googleapis.com/css?family=Droid+Sans:regular,bold" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Kreon:light,regular" rel="stylesheet" type="text/css" />
</head>

<style>
    body {
        font-family: 'Droid Sans', sans-serif;
        background: #f5f8fa;
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
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    header .title {
        font-size: 22px;
    }

    #container {
        max-width: 750px;
        margin: 40px auto;
        background: white;
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    h1 {
        color: #1976d2;
        font-size: 30px;
        margin-bottom: 30px;
    }

    form {
        text-align: left;
    }

    table {
        width: 100%;
        margin-bottom: 30px;
        border: 1px solid #ddd;
        border-collapse: collapse;
    }

    td {
        padding: 12px;
    }

    td strong {
        font-size: 18px;
        color: #1976d2;
    }

    input[type="text"],
    select {
        width: 100%;
        padding: 12px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 8px;
        margin-bottom: 15px;
        outline: none;
        transition: border-color 0.3s ease;
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
        background: #0d47a1;
        transform: scale(1.05);
    }

    footer {
        text-align: center;
        padding: 20px;
        background: #0d47a1;
        color: white;
        font-size: 16px;
        border-radius: 0 0 12px 12px;
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

                        <li><a href="../logout.php">Logout</a></li>
                        
                            </ul>
                </section>
                <br /><br />
                <br><br>

                
                <h1>Tambah Nilai</h1>
                <form method="POST" action="">
                    <label>Nilai Tugas:</label><br>
                    <input type="number" step="0.01" name="nilai_tugas" required><br>
                    <label>Nilai UTS:</label><br>
                    <input type="number" step="0.01" name="nilai_uts" required><br>
                    <label>Nilai UAS:</label><br>
                    <input type="number" step="0.01" name="nilai_uas" required><br>
                    <label>NIM:</label><br>
                    <select name="nim" required>
                        <option value="">Pilih NIM</option>
                        <?php
                        $mahasiswa_query = $koneksi->query("SELECT * FROM mahasiswa");
                        while ($data_mahasiswa = $mahasiswa_query->fetch_assoc()) {
                            echo "<option value='" . $data_mahasiswa['nim'] . "'>" . $data_mahasiswa['nim'] . " - " . $data_mahasiswa['nama'] . "</option>";
                        }
                        ?>
                    </select><br>
                    <label>NIP:</label><br>
                    <select name="nip" required>
                        <option value="">Pilih NIP</option>
                        <?php
                        $dosen_query = $koneksi->query("SELECT * FROM dosen");
                        while ($data_dosen = $dosen_query->fetch_assoc()) {
                            echo "<option value='" . $data_dosen['nip'] . "'>" . $data_dosen['nip'] . " - " . $data_dosen['nama'] . "</option>";
                        }
                        ?>
                    </select><br>
                    <label>Kode Mata Kuliah:</label><br>
                    <select name="kode_matkul" required>
                        <option value="">Pilih Mata Kuliah</option>
                        <?php
                        $matkul_query = $koneksi->query("SELECT * FROM mata_kuliah");
                        while ($data_matkul = $matkul_query->fetch_assoc()) {
                            echo "<option value='" . $data_matkul['kode_matkul'] . "'>" . $data_matkul['kode_matkul'] . " - " . $data_matkul['nama_matkul'] . "</option>";
                        }
                        ?>
                    </select><br><br>
                    <button type="submit">Simpan</button>
                </form>
                <br><br>
            </center>
        </div>
    </section>

    <footer>
        <font color="#000"> Copyright &copy; 2018 - Politeknik Pos BANDUNG <br />
            Developed By <a href="#" target="_new">YourName</a> </font>
    </footer>
</body>

</html>