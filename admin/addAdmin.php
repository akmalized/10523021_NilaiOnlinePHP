<?php
include '../koneksi.php';

if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['nama'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password
    $nama = $_POST['nama'];

    $query = "INSERT INTO admin (username, password, nama) VALUES ('$username', '$password', '$nama')";
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
    <title>Tambah Admin</title>
</head>
<body>
    <h1>Tambah Admin</h1>
    <form method="POST" action="">
        <label>Username:</label><br>
        <input type="text" name="username" required><br>
        <label>Password:</label><br>
        <input type="password" name="password" required><br>
        <label>Nama:</label><br>
        <input type="text" name="nama" required><br><br>
        <button type="submit">Simpan</button>
    </form>
</body>
</html>
