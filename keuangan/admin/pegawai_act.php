<?php 
include '../koneksi.php';
$pegawai  = $_POST['pegawai'];
$divisi = $_POST['divisi'];
$jabatan = $_POST['jabatan'];

mysqli_query($koneksi, "insert into pegawai values (NULL,'$pegawai','$divisi','$jabatan')");
header("location:pegawai.php");