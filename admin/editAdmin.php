<?php
include '../koneksi.php';

// Ambil data admin berdasarkan ID
$id = $_GET['id'];
$result = $koneksi->query("SELECT * FROM admin WHERE id = $id");
$data = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $nama = $_POST['nama'];

    // Cek apakah password diubah
    if (!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $query = "UPDATE admin SET username = '$username', password = '$password', nama = '$nama' WHERE id = $id";
    } else {
        $query = "UPDATE admin SET username = '$username', nama = '$nama' WHERE id = $id";
    }

    if ($koneksi->query($query)) {
        header("Location: viewAdmin.php");
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
    <title>Edit Admin</title>
</head>
<body>
    <h1>Edit Admin</h1>
    <form method="POST" action="">
        <label>Username:</label><br>
        <input type="text" name="username" value="<?= $data['username'] ?>" required><br>
        <label>Password (Kosongkan jika tidak diubah):</label><br>
        <input type="password" name="password"><br>
        <label>Nama:</label><br>
        <input type="text" name="nama" value="<?= $data['nama'] ?>" required><br><br>
        <button type="submit">Update</button>
    </form>
</body>
</html>
