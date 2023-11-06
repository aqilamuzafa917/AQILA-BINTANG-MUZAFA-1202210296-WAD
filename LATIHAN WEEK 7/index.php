<!DOCTYPE html>
<html>
<head>
    <title>Form Input Barang</title>
</head>
<body>
    <form method="post" action="simpan_barang.php">
        Nama Barang: <input type="text" name="nama_barang"><br>
        Harga: <input type="text" name="harga"><br>
        Stok: <input type="text" name="stok"><br>
        <input type="submit" value="Simpan" onclick="showPopup()">
    </form>
    
    <h1>Lihat Barang</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>Stok</th>
        </tr>
        <?php
        $host = 'localhost:3308';
        $username = 'root';
        $password = '';
        $database = 'wad_aqila';
        
        $koneksi = new mysqli($host, $username, $password, $database);

        if ($koneksi->connect_error) {
            die("Koneksi ke database gagal: " . $koneksi->connect_error);
        }

        $query = "SELECT * FROM barang";
        $result = $koneksi->query($query);

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["nama_barang"] . "</td>";
            echo "<td>" . $row["harga"] . "</td>";
            echo "<td>" . $row["stok"] . "</td>";
            echo "<td><a href='ubah_barang.php?id=" . $row["id"] . "'>Ubah</a> | <a href='hapus_barang.php?id=" . $row["id"] . "'>Hapus</a></td>";
            echo "</tr>";
        }
        $koneksi->close();
        ?>
    </table>
    <script>
        function showPopup() {
            alert("Data berhasil disimpan!");
        }
    </script>
    
</body>
</html>
