<?php
session_start();
include "../../../../config/koneksi.php";

if ($_GET['aksi'] == "edit") {
    $id_pemberitahuan = $_GET['id_pemberitahuan'];
    $status = "Sudah dibaca";

    $query = "UPDATE pemberitahuan SET status = '$status'";
    $query .= "WHERE id_pemberitahuan = '$id_pemberitahuan'";

    $sql = mysqli_query($koneksi, $query);

    if ($sql) {
        header("location: " . $_SERVER['HTTP_REFERER']);
    } else {
        $_SESSION['gagal'] = "Maaf terjadi masalah dalam update status pemberitahuan !";
        header("location: " . $_SERVER['HTTP_REFERER']);
    }
} elseif ($_GET['aksi'] == "badgeNotif") {
    include "pemberitahuan_real_time.php";

    // Badge Notif
    getbadgepemberitahuan();
} else if ($_GET['aksi'] == "headerNotif") {
    include "pemberitahuan_real_time.php";

    // Header Notif
    GetHeaderPemberitahuan();
} else if ($_GET['aksi'] == "isiNotif") {
    include "pemberitahuan_real_time.php";

    // Isi Notif
    GetIsiPemberitahuan();
}
