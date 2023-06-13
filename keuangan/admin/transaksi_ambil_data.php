<?php
include '../koneksi.php';
$id = $_POST['id'];
$modul = $_POST['modul'];

if ($modul=='JenisTransaksi') {
    $sql = mysqli_query($koneksi,"SELECT * FROM kategori where transaksi_jenis='$id' order by kategori ASC")or die(mysqli_error($koneksi));
    $kategori='<option>---Pilih---</option>';
    while ($dt = mysqli_fetch_array($sql)) {
        $kategori.='<option value="'.$dt['kategori_id'].'">'.$dt['kategori'].'</option>';
    }
}

    echo $kategori;
?>