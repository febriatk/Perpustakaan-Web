<?php
session_start();
//------------------------------::::::::::::::::::::------------------------------\\
// Dibuat oleh FA Team di PT. Pacifica Raya Technology \\
//------------------------------::::::::::::::::::::------------------------------\\
include "../../../../config/koneksi.php";

    if ($_POST['judul_buku'] == NULL) {
        $_SESSION['gagal'] = "Pemesanan buku gagal, Kamu belum memilih buku yang akan dipinjam !";
        header("location: " . $_SERVER['HTTP_REFERER']);
    } else {

        include "pemberitahuan.php";

        $nama_lengkap = $_POST['nama_lengkap'];
        $judul_buku = $_POST['judul_buku'];
        $tanggal_pemesanan = $_POST['tanggal_pemesanan'];

            $sql = "INSERT INTO pemesanan_buku(nama_lengkap,judul_buku,tanggal_pemesanan)
            VALUES('" . $nama_lengkap . "','" . $judul_buku . "','" . $tanggal_pemesanan . "')";
            $sql .= mysqli_query($koneksi, $sql);

            // Send notif to admin
            InsertPemberitahuanPemesanan();
            //

            if ($sql) {
                $_SESSION['berhasil'] = "Pemesanan buku berhasil !";
                header("location: " . $_SERVER['HTTP_REFERER']);
            } else {
                $_SESSION['gagal'] = "Terjadi masalah dalam pengiriman data pemesanan !";
                header("location: " . $_SERVER['HTTP_REFERER']);
            }
    }

function UpdateDataPemesanan()
{
    include "../../../../config/koneksi.php";

    $nama_lama = $_SESSION['nama_lengkap'];
    $nama_lengkap = $_POST['Nama_lengkap'];

    // Mencari nama dalam database berdasarkan session nama lengkap
    $query1 = mysqli_query($koneksi, "SELECT * FROM anggota WHERE nama_lengkap = '$nama_lama'");
    $row = mysqli_fetch_assoc($query1);

    // membuat variable dari hasil query1
    $nama_lama = $row['nama_lengkap'];

    // Fungsi update nama anggota pada table pemesanan
    $query = "UPDATE pemesanan_buku SET nama_lengkap = '$nama_lengkap'";
    $query .= "WHERE nama_lengkap = '$nama_lama'";

    $sql = mysqli_query($koneksi, $query);
}
