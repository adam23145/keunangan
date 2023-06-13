<?php 
include '../koneksi.php';
$id  = $_POST['id_barang'];
$nama_barang = $_POST['nama_barang'];
$jenis_operasional = $_POST['jenis_operasional'];

mysqli_query($koneksi, "update barang_operasional set nama_barang='$nama_barang', jenis_operasional='$jenis_operasional ' where id_barang='$id'") or die(mysqli_error($koneksi));
header("location:barang_operasional.php");