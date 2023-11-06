<?php
// Koneksi ke database

$koneksi = mysqli_connect("localhost:3308", "root", "", "wad_aqila");

// Cek koneksi
if (!$koneksi) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}

// Ambil data dari form
$nama_barang = $_POST['nama_barang'];
$harga = $_POST['harga'];
$stok = $_POST['stok'];

// Query untuk menyimpan data ke database
$query = "INSERT INTO barang (nama_barang, harga, stok) VALUES ('$nama_barang', $harga, $stok)";

if (mysqli_query($koneksi, $query)) {
    echo "Data berhasil disimpan";
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
}

// Tutup koneksi
mysqli_close($koneksi);
?>
