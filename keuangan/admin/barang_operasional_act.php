<?php 
include '../koneksi.php';
$nama_barang  = $_POST['nama_barang'];
$jenis_operasional = $_POST['jenis_operasional'];

mysqli_query($koneksi, "insert into barang_operasional values (NULL,'CURDATE()','$nama_barang','$jenis_operasional')");
header("location:barang_operasional.php");