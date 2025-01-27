<?php
include '../koneksi.php';

$id = $_GET['id'];
$query = "DELETE FROM admin WHERE id = $id";

if ($koneksi->query($query)) {
    header("Location: viewAdmin.php");
} else {
    echo "Error: " . $query . "<br>" . $koneksi->error;
}
?>
