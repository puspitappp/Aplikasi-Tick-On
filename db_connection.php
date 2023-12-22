<?php
// db_connection.php

// Parameter Koneksi Database
$host = "localhost";
$username = "root";
$password = "";
$database = "puspita_db";

// Membuat Koneksi Database
$koneksi = mysqli_connect($host, $username, $password, $database);

// Periksa Koneksi
if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>
