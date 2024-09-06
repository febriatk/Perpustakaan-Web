<?php
session_start();
include "../../../../config/koneksi.php";

if ($_GET['aksi'] == "tambah") {
    $kode_anggota = $_POST['kode_anggota'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $judul_buku = $_POST['judul_buku'];
    $tanggal_pinjam = $_POST['tanggal_pinjam'];
    $batas_pinjam = date('Y-m-d', strtotime($tanggal_pinjam . '+21 days'));
    $tanggal_kembali = $_POST['tanggal_kembali'];
    $denda = $_POST['denda'];

    $sql1 = "INSERT INTO peminjaman(id_peminjaman, kode_anggota, nama_lengkap, judul_buku, tanggal_pinjam, batas_pinjam, tanggal_kembali, denda, status)
        VALUES(null, '$kode_anggota', '$nama_lengkap', '$judul_buku', '$tanggal_pinjam', '$batas_pinjam', '$tanggal_kembali', '$denda', 'Pinjam')";
    $sql1 .= mysqli_query($koneksi, $sql1);

    if($sql1) {
        $_SESSION['berhasil'] = "Data peminjaman berhasil ditambahkan";
        header("location: " . $_SERVER['HTTP_REFERER']);
    } else {
        $_SESSION['gagal'] = "Data peminjaman gagal ditambahkan";
        header("location: " . $_SERVER['HTTP_REFERER']);
    }
} else if ($_GET['aksi'] == "hapus") {
    $id_peminjaman = $_GET['id'];

    $sql1 = mysqli_query($koneksi, "DELETE FROM peminjaman WHERE id_peminjaman = $id_peminjaman");

    if ($sql1) {
        $_SESSION['berhasil'] = "Data berhasil di hapus !";
        header("location: " . $_SERVER['HTTP_REFERER']);
    } else {
        $_SESSION['gagal'] = "Data gagal di hapus !";
        header("location: " . $_SERVER['HTTP_REFERER']);
    }
}