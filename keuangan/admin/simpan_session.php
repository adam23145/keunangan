<?php
// Mulai session PHP
session_start();

// Ambil nilai baru untuk data session dari permintaan POST
$nilai_baru = $_POST['nama_divisi'];

// Ubah nilai data session 'nama_divisi' dengan nilai baru yang diterima
$_SESSION['nama_divisi'] = $nilai_baru;

// Berikan respons dengan status 200 (OK)
http_response_code(200);
?>