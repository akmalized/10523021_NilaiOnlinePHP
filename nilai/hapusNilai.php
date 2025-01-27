<?php
include '../koneksi.php';

$id = $_GET['id'];

$query = "DELETE FROM nilai WHERE id = '$id'";

if ($koneksi->query($query)) {
    header("Location: viewNilai.php"); 
} else {
    echo "Error: " . $query . "<br>" . $koneksi->error; 
}
?>
