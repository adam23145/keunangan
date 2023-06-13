<?php 
include '../koneksi.php';
$nama_divisi  = $_POST['nama_divisi'];

mysqli_query($koneksi, "insert into divisi values (NULL,'$nama_divisi')");
header("location:divisi.php");