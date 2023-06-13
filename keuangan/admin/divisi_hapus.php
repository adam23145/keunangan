<?php 
include '../koneksi.php';
$id  = $_GET['id'];

mysqli_query($koneksi, "delete from divisi where id_divisi='$id'");
header("location:divisi.php");