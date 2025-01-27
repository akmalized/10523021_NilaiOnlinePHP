<?php
session_start();
include '../koneksi.php';

$nip = $_GET['nip'];
$query = $koneksi->query("SELECT * FROM dosen WHERE nip = '$nip'");
$data_dosen = $query->fetch_assoc();

$matkul_query = $koneksi->query("SELECT * FROM mata_kuliah");
$matkul_options = [];
while ($matkul = $matkul_query->fetch_assoc()) {
    $matkul_options[] = $matkul;
}

if (isset($_POST['nip']) && isset($_POST['nama']) && isset($_POST['kode_matkul']) && isset($_POST['password'])) {
    $nip = $_POST['nip'];
    $nama = $_POST['nama'];
    $kode_matkul = $_POST['kode_matkul'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $update_query = "UPDATE dosen SET nip = '$nip', nama = '$nama', kode_matkul = '$kode_matkul', password = '$password' WHERE nip = '$nip'";

    if ($koneksi->query($update_query)) {
        header("Location: viewDosen.php");
    } else {
        echo "Error: " . $update_query . "<br>" . $koneksi->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
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

    input[type="text"],
    input[type="password"],
    select {
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


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Dosen</title>
</head>

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
                <h1>Edit Dosen</h1>

                <form method="POST" action="">
                    <label>NIP:</label><br>
                    <input type="text" name="nip" value="<?= htmlspecialchars($data_dosen['nip']) ?>" required><br>

                    <label>Nama:</label><br>
                    <input type="text" name="nama" value="<?= htmlspecialchars($data_dosen['nama']) ?>" required><br>

                    <label>Kode Mata Kuliah:</label><br>
                    <select name="kode_matkul" required>
                        <?php foreach ($matkul_options as $matkul): ?>
                            <option value="<?= $matkul['kode_matkul'] ?>" <?= $matkul['kode_matkul'] == $data_dosen['kode_matkul'] ? 'selected' : '' ?>>
                                <?= $matkul['kode_matkul'] . ' - ' . $matkul['nama_matkul'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select><br>

                    <label>Password:</label><br>
                    <input type="password" name="password" required><br><br>

                    <button type="submit">Update</button>
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