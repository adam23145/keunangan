<?php 
include '../koneksi.php';
$id  = $_GET['id'];

mysqli_query($koneksi, "update piutang set piutang_status = 1 where piutang_id='$id'") or die(mysqli_error($koneksi));
header("location:piutang.php");