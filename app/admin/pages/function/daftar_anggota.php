<?php
session_start();
include "../../../../config/koneksi.php";

if ($_GET['aksi'] == "tambah") {
    $kode_anggota = $_POST['kodeAnggota'];
    $nama_lengkap = $_POST['namaLengkap'];
    $email = $_POST['mail'];
    $password = $_POST['password'];
    $no_telepon = $_POST['telp'];
    $alamat = $_POST['alamat'];
    $role = "Anggota";
    $tanggal_daftar = date('d-m-Y');

    $sql = "INSERT INTO anggota(id_anggota, kode_anggota, nama_lengkap, email, password, no_telepon, alamat, tanggal_daftar)
        VALUES(null, '$kode_anggota', '$nama_lengkap', '$email', '$password', '$no_telepon', '$alamat', '$tanggal_daftar')";
    $sql .= mysqli_query($koneksi, $sql);

    $id_anggota = mysqli_insert_id($koneksi);
    $sql1 = "INSERT INTO akun(id_anggota, nama, email, password, role)
    VALUES('$id_anggota', '$nama_lengkap', '$email', '$password', '$role')";
    $sql1 .= mysqli_query($koneksi, $sql1);

    if ($sql) {
        $_SESSION['berhasil'] = "Anggota berhasil ditambahkan !";
        header("location: " . $_SERVER['HTTP_REFERER']);
    } else {
        $_SESSION['gagal'] = "Anggota gagal ditambahkan !";
        header("location: " . $_SERVER['HTTP_REFERER']);
    }
} else if ($_GET['aksi'] == "hapus") {
    $id_anggota = $_GET['id_anggota'];

    $sql = mysqli_query($koneksi, "DELETE FROM anggota WHERE id_anggota = '$id_anggota'");

    if ($sql) {
        $_SESSION['berhasil'] = "Anggota berhasil di hapus !";
        header("location: " . $_SERVER['HTTP_REFERER']);
    } else {
        $_SESSION['gagal'] = "Anggota gagal di hapus !";
        header("location: " . $_SERVER['HTTP_REFERER']);
    }

    $sql1 = mysqli_query($koneksi, "DELETE FROM akun WHERE id_anggota = '$id_anggota'");

    if ($sql) {
        $_SESSION['berhasil'] = "Anggota berhasil di hapus !";
        header("location: " . $_SERVER['HTTP_REFERER']);
    } else {
        $_SESSION['gagal'] = "Anggota gagal di hapus !";
        header("location: " . $_SERVER['HTTP_REFERER']);
    }
}