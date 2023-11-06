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
} else {
    echo "ID barang tidak valid!";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Tangani perubahan data barang yang dikirim melalui formulir
    $nama_barang = $_POST['nama_barang'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    // Lakukan validasi data dan perbarui data barang di database
    $query = "UPDATE barang SET nama_barang = '$nama_barang', harga = $harga, stok = $stok WHERE id = $id";
    if (mysqli_query($koneksi, $query)) {
        echo "Data barang berhasil diperbarui!";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ubah Barang</title>
</head>
<body>
    <h1>Ubah Barang</h1>
    <form method="post">
        Nama Barang: <input type="text" name="nama_barang" value="<?php echo $barang['nama_barang']; ?>"><br>
        Harga: <input type="text" name="harga" value="<?php echo $barang['harga']; ?>"><br>
        Stok: <input type="text" name="stok" value="<?php echo $barang['stok']; ?>"><br>
        <input type="submit" value="Simpan">
    </form>
</body>
</html>
