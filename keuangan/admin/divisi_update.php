<?php 
include '../koneksi.php';
$id  = $_POST['id_divisi'];
$nama_divisi = $_POST['nama_divisi'];

mysqli_query($koneksi, "update divisi set nama_divisi='$nama_divisi' where id_divisi='$id'") or die(mysqli_error($koneksi));
header("location:divisi.php");