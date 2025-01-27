<?php
session_start();
include '../koneksi.php';


if (isset($_GET['nim'])) {
    $nim = $_GET['nim'];

   
    $stmt = $koneksi->prepare("SELECT * FROM mahasiswa WHERE nim = ?");
    $stmt->bind_param("s", $nim);
    $stmt->execute();
    $result = $stmt->get_result();
    $data_mahasiswa = $result->fetch_assoc();

    if (!$data_mahasiswa) {
        echo "Mahasiswa tidak ditemukan!";
        exit;
    }
} else {
    echo "NIM tidak ditemukan!";
    exit;
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $jk = $_POST['jk'];
    $jurusan = $_POST['jurusan'];

   
    $update_stmt = $koneksi->prepare("UPDATE mahasiswa SET nama = ?, jk = ?, jurusan = ? WHERE nim = ?");
    $update_stmt->bind_param("ssss", $nama, $jk, $jurusan, $nim);

    if ($update_stmt->execute()) {
        echo "Data mahasiswa berhasil diupdate!";
        header("Location: viewMahasiswa.php");
        exit;
    } else {
        echo "Gagal memperbarui data mahasiswa!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Mahasiswa</title>
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
        background:rgb(251, 255, 0);
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
        <section class="logo"><a href="#"><img src="../images/logo.png" alt="Logo" /></a></section>
        <section class="title">Sistem Informasi Nilai Online <br /> <span>UNIVERSITAS KOMPUTER INDONESIA</span></section>
    </header>


    <section id="container">
        <h1 style="text-align: center; margin-bottom: 10px;">Edit Mahasiswa</h1>

       
        <section id="navigator">
            <ul class="menus">
               
                <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
                    <li><a href="../admin/index.php">Home</a></li>
                    <li><a href="../mata_kuliah/viewMataKuliah.php">Mata Kuliah</a></li>
                    <li><a href="../dosen/viewDosen.php">Dosen</a></li>
                <?php endif; ?>

                <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'dosen'): ?>
                    <li><a href="../mahasiswa/viewMahasiswa.php">Mahasiswa</a></li>
                    <li><a href="../nilai/viewNilai.php">Nilai</a></li>
                <?php endif; ?>

              
                <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'mahasiswa'): ?>
                    <li><a href="../nilai/nilaiView.php">Nilai</a></li>
                <?php endif; ?>

                <li><a href="../logout.php">Logout</a></li>
            </ul>
        </section>

        <form method="POST" action="editMahasiswa.php">
            <table style="width: 100%; border: 1px solid #ddd; border-collapse: collapse;">
                <tr>
                    <td><strong>NIM</strong></td>
                    <td><input type="text" name="nim" value="<?= htmlspecialchars($data_mahasiswa['nim']) ?>" readonly /></td>
                </tr>
                <tr>
                    <td><strong>Nama</strong></td>
                    <td><input type="text" name="nama" value="<?= htmlspecialchars($data_mahasiswa['nama']) ?>" required /></td>
                </tr>
                <tr>
                    <td><strong>Jenis Kelamin</strong></td>
                    <td>
                        <select name="jk" required>
                            <option value="L" <?= $data_mahasiswa['jk'] == 'L' ? 'selected' : '' ?>>Laki-laki</option>
                            <option value="P" <?= $data_mahasiswa['jk'] == 'P' ? 'selected' : '' ?>>Perempuan</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><strong>Jurusan</strong></td>
                    <td><input type="text" name="jurusan" value="<?= htmlspecialchars($data_mahasiswa['jurusan']) ?>" required /></td>
                </tr>
            </table>
            <br>
            <button type="submit">Simpan Perubahan</button>
        </form>
    </section>

  
    <footer>
        <font color="#000">Copyright &copy; 2018 - Politeknik Pos BANDUNG <br />
            Developed By <a href="#" target="_new">YourName</a> </font>
    </footer>
</body>

</html>