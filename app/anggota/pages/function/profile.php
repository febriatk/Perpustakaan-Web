<?php
session_start();
//------------------------------::::::::::::::::::::------------------------------\\
// Dibuat oleh FA Team di PT. Pacifica Raya Technology \\
//------------------------------::::::::::::::::::::------------------------------\\
include "../../../../config/koneksi.php";
include "pesan.php";

if ($_GET['aksi'] = "edit") {
    $id_anggota = $_POST['id_anggota'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $no_telepon = $_POST['no_telepon'];
    $alamat = $_POST['alamat'];

        UpdateDataPesan();

        $query = "UPDATE anggota SET nama_lengkap = '$nama_lengkap', email = '$email', password = '$password', no_telepon = '$no_telepon', alamat = '$alamat'";
        $query .= "WHERE id_anggota = $id_anggota";
        $sql = mysqli_query($koneksi, $query);

        //$id_anggota = $koneksi->insert_id;
        //$sql1 = "UPDATE akun SET id_anggota = '$id_anggota', nama_lengkap = '$nama_lengkap', email = '$email', password = '$password'";
        //$sql1 .= mysqli_query($koneksi, $sql1);

        if ($sql) {
            $_SESSION['berhasil'] = "Update profil berhasil !";
            header("location: " . $_SERVER['HTTP_REFERER']);
        } else {
            $_SESSION['gagal'] = "Update profil gagal !";
            header("location: " . $_SERVER['HTTP_REFERER']);
        }
    }

