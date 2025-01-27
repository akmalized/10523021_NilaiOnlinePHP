<?php

include '../koneksi.php';

if (isset($_GET['nip']) && !empty($_GET['nip'])) {
    $nip = $_GET['nip'];
    $query = "DELETE FROM dosen WHERE nip = '$nip'";
    if ($koneksi->query($query)) {
        header("Location: viewDosen.php");
    } else {
        echo "Error: " . $query . "<br>" . $koneksi->error;
    }
} else {
    echo "NIP tidak valid!";
}
