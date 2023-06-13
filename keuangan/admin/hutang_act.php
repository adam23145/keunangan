<?php 
include '../koneksi.php';
$tanggal  = $_POST['tanggal'];
$nominal  = $_POST['nominal'];
$pegawai  = $_POST['id_pegawai'];

mysqli_query($koneksi, "insert into hutang values (NULL,'$tanggal','$pegawai','$nominal')")or die(mysqli_error($koneksi));
header("location:hutang.php");