<?php
session_start();
include "../../../../config/koneksi.php";

if ($_GET['act'] == "tambah") {
    $judul_buku = $_POST['judul_buku'];
    $penulis_buku = $_POST['penulis_buku'];
    $penerbit_buku = $_POST['penerbit_buku'];
    $bahasa = $_POST['bahasa'];
    $jenis_buku = $_POST['jenis_buku'];
    $isbn = $_POST['isbn'];
    $sinopsis_buku = $_POST['sinopsis_buku'];
    $cover_buku = $_POST['cover_buku'];
    $ketersediaan = $_POST['ketersediaan'];

    $sql1 = "INSERT INTO buku (id_buku, judul_buku, penulis_buku, penerbit_buku, bahasa, jenis_buku, isbn, sinopsis_buku, cover_buku, ketersediaan)
        VALUES(null, '$judul_buku', '$penulis_buku', '$penerbit_buku', '$bahasa', '$jenis_buku', '$isbn', '$sinopsis_buku', '$cover_buku', '$ketersediaan')";
    $sql1 .= mysqli_query($koneksi, $sql1);

    if($sql1) {
        $_SESSION['berhasil'] = "Data buku berhasil ditambahkan";
        header("location: " . $_SERVER['HTTP_REFERER']);
    } else {
        $_SESSION['gagal'] = "Data buku gagal ditambahkan";
        header("location: " . $_SERVER['HTTP_REFERER']);
    }
} else if ($_GET['act'] == "hapus") {
    $id_buku = $_GET['id_buku'];

    $sql1 = mysqli_query($koneksi, "DELETE FROM buku WHERE id_buku = $id_buku");

    if ($sql1) {
        $_SESSION['berhasil'] = "Data berhasil di hapus !";
        header("location: " . $_SERVER['HTTP_REFERER']);
    } else {
        $_SESSION['gagal'] = "Data gagal di hapus !";
        header("location: " . $_SERVER['HTTP_REFERER']);
    }
}