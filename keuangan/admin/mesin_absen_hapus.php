<?php 
include '../koneksi.php';
$id  = $_GET['id'];




mysqli_query($koneksi, "delete from absen where id_absen='$id'");
header("location:mesin.php");