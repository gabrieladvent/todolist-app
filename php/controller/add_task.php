<?php
session_start();
include('../database/config.php');

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Jika tidak, arahkan kembali ke halaman login
    header('Location: ../view/login.php');
    exit;
}

// Ambil user_id dari sesi login
$user_id = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $task = $_POST['task'];

    // Simpan tugas ke dalam database bersama dengan user_id pengguna yang saat ini login
    $query = "INSERT INTO ToDoList (task, user_id) VALUES ('$task', '$user_id')";
    $result = $koneksi->query($query);

    if ($result) {
        // Redirect kembali ke halaman todolist.php setelah menambahkan task
        header('Location: ../view/todolist.php');
        exit;
    } else {
        echo "Gagal menambahkan task. Silakan coba lagi.";
    }
}
