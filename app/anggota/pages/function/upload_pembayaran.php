<?php
session_start();

if (!isset($_SESSION['id_anggota'])) {
    // Redirect ke halaman login jika session kode_anggota tidak ada
    header("location: " . $_SERVER['HTTP_REFERER']);
}

include "../../../../config/koneksi.php";

$id_anggota = $_SESSION['id_anggota'];
$kode_anggota = $_POST['kode_anggota'];

// Direktori tempat menyimpan file bukti pembayaran
$uploadDir = "uploads/";
$uploadFile = $uploadDir . basename($_FILES['bukti_pembayaran']['kode_anggota']);

// Pastikan kode_transaksi unik untuk setiap pembayaran
$kode_unik = uniqid();

// Format nama file yang diupload: kode_transaksi_kode_unik.jpg
$newFileName = $kode_anggota . '_' . $kode_unik . '.jpg';

// Pindahkan file yang diupload ke direktori yang ditentukan
if (move_uploaded_file($_FILES['bukti_pembayaran']['tmp_name'], $uploadDir . $newFileName)) {
    // Simpan informasi pembayaran ke database
    $queryInsert = mysqli_query($koneksi, "INSERT INTO pembayaran (kode_anggota, bukti_pembayaran) VALUES ('$kode_anggota', '$newFileName')");

    if ($queryInsert) {
        echo "Bukti pembayaran berhasil diupload dan disimpan.";
    } else {
        echo "Gagal menyimpan informasi pembayaran ke database.";
    }
} else {
    echo "Gagal mengupload file bukti pembayaran.";
}

mysqli_close($koneksi);
?>
