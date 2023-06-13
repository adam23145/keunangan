<?php 
include '../koneksi.php';
$id  = $_GET['id'];




mysqli_query($koneksi, "DELETE transaksi, detail_transaksi_gaji
                       FROM transaksi
                       JOIN detail_transaksi_gaji ON detail_transaksi = id_detail_transaksi_gaji
                       WHERE transaksi_id = '$id'");
header("location:bibitan.php");