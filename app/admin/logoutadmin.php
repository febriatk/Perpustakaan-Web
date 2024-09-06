<?php
session_start();
unset($_SESSION['id_akun']);
unset($_SESSION['nama']);
unset($_SESSION['email']);
unset($_SESSION['status']);

$_SESSION['berhasil_keluar'] = "Anda telah berhasil keluar !!";
header("location: ../../login.php");
