<?php 
include '../koneksi.php';
$id  = $_GET['id'];

mysqli_query($koneksi, "delete from jabatan where id_jabatan='$id'");
header("location:jabatan.php");