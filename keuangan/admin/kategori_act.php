<?php 
include '../koneksi.php';
$kategori  = $_POST['kategori'];
$jenis = $_POST['jenis'];

mysqli_query($koneksi, "insert into kategori values (NULL,'$kategori',$jenis)");
header("location:kategori.php");