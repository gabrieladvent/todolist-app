<?php
// Informasi koneksi ke database
$host = 'db';
$port = '5432';
$dbname = 'mydatabase';
$user = 'myuser';
$password = 'mypassword';

// Membuat koneksi
$conn_string = "host=$host port=$port dbname=$dbname user=$user password=$password";
$dbconn = pg_connect($conn_string);

// Periksa koneksi
if (!$dbconn) {
    die("Koneksi gagal: " . pg_last_error());
} 
?>
