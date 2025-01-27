<?php
include '../koneksi.php';

$nim = $_GET['nim'];
$query = "DELETE FROM mahasiswa WHERE nim = '$nim'";
if ($koneksi->query($query)) {
    header("Location: viewMahasiswa.php");
} else {
    echo "Error: " . $query . "<br>" . $koneksi->error;
}
?>
