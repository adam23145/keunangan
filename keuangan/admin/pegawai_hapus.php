<?php 
include '../koneksi.php';
$id  = $_GET['id'];

mysqli_query($koneksi, "delete from pegawai where id_pegawai='$id'");
header("location:pegawai.php");