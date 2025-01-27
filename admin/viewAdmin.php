<?php
include '../koneksi.php';

$hasil_query = $koneksi->query("SELECT * FROM admin");

$baris = 1;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Admin</title>
</head>
<body>
    <h1>Daftar Admin</h1>
    <a href="addCRUD.php">Tambah Admin</a>
    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Nama</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($data_admin = $hasil_query->fetch_assoc()): ?>
            <tr>
                <td><?= $baris++ ?></td> 
                <td><?= $data_admin['username'] ?></td>
                <td><?= $data_admin['nama'] ?></td>
                <td>
                    <a href="editAdmin.php?id=<?= $data_admin['id'] ?>">Edit</a>
                    <a href="deleteAdmin.php?id=<?= $data_admin['id'] ?>" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
