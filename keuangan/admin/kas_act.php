<?php
    include '../koneksi.php';

    $transaksi_tanggal = date('Y-m-d');
    $penerima = NULL;
    $transaksi_jenis = 'Pemasukan';
    $transaksi_kategori = '6';
    $transaksi_nominal = $_POST['hasil_penjualan'];
    $transaksi_nominal2 = (float) str_replace('.', '', $transaksi_nominal);

    if($transaksi_nominal2 != 0 || $transaksi_nominal2 != ""){
        $sql = "INSERT INTO transaksi (transaksi_id, transaksi_tanggal, transaksi_jenis, transaksi_kategori, transaksi_nominal,detail_transaksi)
            VALUES (NULL, '$_POST[tanggal]', '$transaksi_jenis', '$transaksi_kategori', '$transaksi_nominal2','kas')";
        mysqli_query($koneksi, $sql) or die("Gagal Menyimpan");
        header("location:kas.php");
    }else{
        echo "<script>alert('Kas Kosong.'); window.location.href='kas.php';</script>";
    }

?>