<?php
session_start();
include "../../../../config/koneksi.php";

$id_pembayaran = $_GET['id_pembayaran'];
$status = $_GET['status'];

$sql1 = "UPDATE pembayaran SET status = '$status' WHERE id_pembayaran = $id_pembayaran";
    $sql1 .= mysqli_query($koneksi, $sql1);

if ($sql1) {
    header("Location: konfirmasi_pembayaran.php");
} else {
    echo "Gagal Konfirmasi Pembayaran";
}