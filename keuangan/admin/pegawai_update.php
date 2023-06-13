<?php 
include '../koneksi.php';
$id  = $_POST['id_jabatan'];
$nama_jabatan  = $_POST['nama_jabatan'];
$gaji = $_POST['gaji'];

mysqli_query($koneksi, "update jabatan set nama_jabatan='$nama_jabatan',gaji='$gaji' where id_jabatan='$id'") or die(mysqli_error($koneksi));
header("location:divisi.php");