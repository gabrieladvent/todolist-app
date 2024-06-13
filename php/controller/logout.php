<?php
// Memulai sesi
session_start();

// Menghapus semua variabel sesi
$_SESSION = array();

// Menghancurkan sesi
session_destroy();

// Mengarahkan kembali ke halaman login
header('Location: ../view/login.php');
exit;
