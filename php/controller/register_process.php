<?php
// Memulai sesi
session_start();

// Masukkan file config.php untuk koneksi database
include('../database/config.php');

// Cek apakah form registrasi dikirimkan
if (isset($_POST['username'], $_POST['password'])) {
    // Ambil data dari form registrasi
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Enkripsi password sebelum menyimpannya
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Simpan data ke database
    $query = "INSERT INTO users (username, password) VALUES ('$username', '$hashed_password')";
    $result = pg_query($dbconn, $query);


    if ($result) {
        // Redirect ke halaman login jika registrasi berhasil
        header('Location: ../view/login.php');
        exit;
    } else {
        echo "Registrasi gagal. Silakan coba lagi.";
    }
} else {
    // Jika tidak, arahkan kembali ke halaman registrasi
    header('Location: ../view/register.php');
    exit;
}
