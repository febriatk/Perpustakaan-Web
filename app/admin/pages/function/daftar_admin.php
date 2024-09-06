<?php
session_start();
include "../../../../config/koneksi.php";
include "Pesan.php";

if ($_GET['act'] == "tambah") {
    $id_anggota = "-";
    $nama = $_POST['namaLengkap'];
    $email = $_POST['email'];
    $password = $_POST['kataSandi'];
    $role = $_POST['role'];

    $query = "INSERT INTO akun (id_anggota, nama, email, password, role)
        VALUES('$id_anggota', '$nama', '$email', '$password', '$role')";
    $sql = mysqli_query($koneksi, $query);

    if ($sql) {
        $_SESSION['berhasil'] = "Administrator berhasil ditambahkan !";
        header("location: " . $_SERVER['HTTP_REFERER']);
    } else {
        $_SESSION['gagal'] = "Administrator gagal ditambahkan !";
        header("location: " . $_SERVER['HTTP_REFERER']);
    }
} elseif ($_GET['act'] == "hapus") {
    $id_admin = $_GET['id'];

    $query = mysqli_query($koneksi, "DELETE FROM akun WHERE id_akun = $id_admin");

    if ($query) {
        $_SESSION['berhasil'] = "Data Administrator berhasil dihapus !";
        header("location: " . $_SERVER['HTTP_REFERER']);
    } else {
        $_SESSION['gagal'] = "Data Administrator gagal dihapus !";
        header("location: " . $_SERVER['HTTP_REFERER']);
    }
}
