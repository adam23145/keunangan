<?php 
include '../koneksi.php';
$id  = $_GET['id'];

mysqli_query($koneksi, "DELETE transaksi, detail_barang
                       FROM transaksi
                       JOIN detail_barang ON detail_transaksi = id_detail_barang
                       WHERE transaksi_id = '$id'");
header("location:operasional_mingguan.php");