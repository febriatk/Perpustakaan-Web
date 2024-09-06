<?php
session_start();
include "../../../../config/koneksi.php";

if ($_GET['act'] == "kembali") {
    $id_peminjaman = $_GET['id'];

    $borrowing_data_query = mysqli_query($koneksi, "SELECT * FROM peminjaman WHERE id_peminjaman = $id_peminjaman");
    $borrowing_data = mysqli_fetch_assoc($borrowing_data_query);

    $sql = mysqli_query($koneksi, "UPDATE peminjaman SET status = 'kembali' WHERE id_peminjaman = $id_peminjaman");
if ($sql) {
    $_SESSION['returned_data'] = $borrowing_data;
    
    $_SESSION['berhasil'] = "Buku telah dikembalikan!";
    header("location: " . $_SERVER['HTTP_REFERER']);
}
}