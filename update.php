<!-- update.php -->
<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $jenis_tiket = $_POST['jenis_tiket'];
    $harga_tiket = $_POST['harga_tiket'];
    $jumlah_tiket = $_POST['jumlah_tiket'];
    $total_harga = $_POST['total_harga'];

    // Update data in the database
    $sql_update = "UPDATE tiket_konser SET nama='$nama', tanggal_lahir='$tanggal_lahir', jenis_tiket='$jenis_tiket', harga_tiket=$harga_tiket, jumlah_tiket=$jumlah_tiket, total_harga=$total_harga WHERE id=$id";

    if (mysqli_query($koneksi, $sql_update)) {
        // Redirect to index.php after successful update
        header("Location: index.php");
        exit;
    } else {
        echo "Error: " . $sql_update . "<br>" . mysqli_error($koneksi);
    }
}
?>
