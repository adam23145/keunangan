<?php
include '../koneksi.php';
$id = $_POST['id'];
$modul = $_POST['modul'];

if ($modul == 'NamaPegawai') {
    $sql = mysqli_query($koneksi, "SELECT * FROM pegawai WHERE id_pegawai='$id'") or die(mysqli_error($koneksi));
    while ($dt = mysqli_fetch_array($sql)) {
        $pegawai = $dt['nama_pegawai'];
    }
    echo $pegawai;
}
?>