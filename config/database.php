<?php
$conn = mysqli_connect("localhost", "root", "", "perpustakaan_lengkap");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>