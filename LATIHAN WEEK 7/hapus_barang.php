<?php
// Pastikan Anda memasukkan koneksi ke database di sini
$koneksi = mysqli_connect("localhost:3308", "root", "", "wad_aqila");
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Ambil data barang dari database berdasarkan ID
    $query = "SELECT * FROM barang WHERE id = $id";
    $result = mysqli_query($koneksi, $query);
    $barang = mysqli_fetch_assoc($result);

    if (!$barang) {
        echo "Barang tidak ditemukan!";
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm'])) {
        // Tangani perubahan data barang yang dikirim melalui formulir
        // Lakukan validasi data dan hapus data barang dari database
        $query = "DELETE FROM barang WHERE id = $id";
        if (mysqli_query($koneksi, $query)) {
            echo "Data barang berhasil dihapus!";
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Hapus Barang</title>
</head>
<body>
    <h1>Hapus Barang</h1>
    <p>Anda yakin ingin menghapus barang berikut?</p>
    <p>Nama Barang: <?php echo $barang['nama_barang']; ?></p>
    <p>Harga: <?php echo $barang['harga']; ?></p>
    <p>Stok: <?php echo $barang['stok']; ?></p>

    <form method="post">
        <input type="submit" name="confirm" value="Ya, Hapus" onclick="showPopup()">
        <a href="index.php">Batal</a>
    </form>

    <script>
        function showPopup() {
            if (confirm('Anda yakin ingin menghapus barang ini?')) {
                // Lanjutkan penghapusan jika pengguna memilih "OK" dalam dialog konfirmasi
                return true;
            } else {
                // Batalkan penghapusan jika pengguna memilih "Batal" dalam dialog konfirmasi
                return false;
            }
        }
    </script>
</body>
</html>