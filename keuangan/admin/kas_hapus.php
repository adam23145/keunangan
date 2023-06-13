<?php 
include '../koneksi.php';
$id  = $_GET['id'];

mysqli_query($koneksi, "delete from transaksi where transaksi_id='$id'");
header("location:kas.php");