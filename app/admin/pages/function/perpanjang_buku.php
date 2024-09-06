<?php
session_start();
include "../../../../config/koneksi.php";

$id_peminjaman = $_GET['id'];
$tanggal_kembali = $_GET['tanggal_kembali'];
$terlambat = $_GET['terlambat'];

if ($terlambat > 7) {
    $_SESSION['gagal'] = "Buku yang dipinjam tidak dapat diperpanjang karena sudah melewati tanggal kembali";
} else {
    $perpanjang = date('Y-m-d', strtotime($tanggal_kembali . '+7 days'));

    $sql = mysqli_query($koneksi, "UPDATE peminjaman SET tanggal_kembali = '$perpanjang' WHERE id_peminjaman = '$id_peminjaman'");

    if ($sql) {
        $_SESSION['berhasil'] = "Peminjaman Buku Berhasil Diperpanjang";
        header("location: " . $_SERVER['HTTP_REFERER']);
    } else {
        $_SESSION['gagal'] = "Peminjaman Buku Gagal Diperpanjang";
        header("location: " . $_SERVER['HTTP_REFERER']);
    }
    }