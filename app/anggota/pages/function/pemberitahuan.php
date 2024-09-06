<?php
session_start();
//------------------------------::::::::::::::::::::------------------------------\\
// Dibuat oleh FA Team di PT. Pacifica Raya Technology \\
//------------------------------::::::::::::::::::::------------------------------\\
function InsertPemberitahuanPemesanan()
{
    include "../../../../config/koneksi.php";

    $nama_lengkap = $_POST['nama_lengkap'];
    $notif = addslashes("<i class='fa fa-exchange'></i> #" . $nama_lengkap . " Telah memesan Buku");
    $level = "Admin";
    $status = "Belum dibaca";

    $sql = "INSERT INTO pemberitahuan(isi_pemberitahuan,level_akun,status) 
                VALUES('" . $notif . "','" . $level . "','" . $status . "')";
    $sql .= mysqli_query($koneksi, $sql);
}