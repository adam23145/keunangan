<?php 
include '../koneksi.php';
$nama_jabatan  = $_POST['nama_jabatan'];
$gaji = $_POST['gaji'];
$gaji_no_dot = (float) str_replace('.', '', $gaji);

mysqli_query($koneksi, "insert into jabatan values (NULL,'$nama_jabatan','$gaji_no_dot')");
header("location:jabatan.php");