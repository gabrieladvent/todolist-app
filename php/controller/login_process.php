<?php
// Memulai sesi
session_start();

// Masukkan file config.php untuk koneksi database
include('../database/config.php');

// Cek apakah tombol login ditekan
if (isset($_POST['username'], $_POST['password'])) {
    // Ambil data dari form login
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Mempersiapkan query
    $prepare_query = 'SELECT * FROM users WHERE username=$1';
    pg_prepare($dbconn, "select_user", $prepare_query);

    // Menjalankan query dengan data
    $result = pg_execute($dbconn, "select_user", array($username));

    // Periksa apakah query berhasil dijalankan dan hasilnya lebih dari 0 baris
    if ($result && pg_num_rows($result) > 0) {
        // Pengguna ditemukan, verifikasi password
        $user = pg_fetch_assoc($result);
        if (password_verify($password, $user['password'])) {
            // Password cocok, sesi login ditetapkan
            $_SESSION['loggedin'] = true;
            $_SESSION['user_id'] = $user['id']; // Menyimpan user_id ke dalam sesi
            // Redirect ke halaman todolist.php
            header('Location: ../view/todolist.php');
            exit;
        } else {
            echo "Password tidak cocok.";
        }
    } else {
        echo "Pengguna tidak ditemukan.";
    }
}

// Menutup koneksi
pg_close($dbconn);

// Jika kredensial tidak sesuai atau tidak ditemukan, arahkan kembali ke halaman login
header('Location: ../view/login.php');
exit;
