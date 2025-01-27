<?php
include '../koneksi.php';

if (isset($_GET['kode_matkul'])) {
    $kode_matkul = $_GET['kode_matkul'];

    
    $delete_query = "DELETE FROM mata_kuliah WHERE kode_matkul = '$kode_matkul'";
    if ($koneksi->query($delete_query)) {
        header("Location: viewMataKuliah.php");
    } else {
        echo "Error: " . $koneksi->error;
    }
}
?>

<section id="navigator">
            <ul class="menus">
                <?php if ($_SESSION['user_role'] === 'admin'): ?>
                    <li><a href="../admin/index.php">Home</a></li>
                    <li><a href="../mata_kuliah/viewMataKuliah.php">Tambah Mata Kuliah</a></li>
                    <li><a href="../dosen/viewDosen.php">Tambah Dosen</a></li>
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

        <a href="addMataKuliah.php" class="btn">Tambah Mata Kuliah</a>

        <table>
            <thead>
                <tr>
                    <th>Kode Mata Kuliah</th>
                    <th>Nama Mata Kuliah</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT * FROM mata_kuliah";
                $hasil = $koneksi->query($query);
                if ($hasil && $hasil->num_rows > 0) {
                    while ($row = $hasil->fetch_assoc()) {
                ?>
                        <tr>
                            <td><?= htmlspecialchars($row['kode_matkul']) ?></td>
                            <td><?= htmlspecialchars($row['nama_matkul']) ?></td>
                            <td class="action-links">
                                <a href="editMataKuliah.php?kode_matkul=<?= urlencode($row['kode_matkul']) ?>">Edit</a>
                                <a href="deleteMataKuliah.php?kode_matkul=<?= urlencode($row['kode_matkul']) ?>" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                            </td>
                        </tr>
                <?php
                    }
                } else {
                    echo '<tr><td colspan="3">Data tidak ditemukan</td></tr>';
                }
                ?>
            </tbody>
        </table>
    