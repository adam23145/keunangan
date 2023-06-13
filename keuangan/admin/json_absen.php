<?php
include '../koneksi.php';
$tampil=mysqli_query($koneksi,"SELECT * FROM pegawai INNER JOIN divisi ON pegawai.divisi = divisi.id_divisi INNER JOIN jabatan ON pegawai.jabatan = jabatan.id_jabatan WHERE pegawai.id_pegawai = '$_POST[id_pegawai]' ORDER BY pegawai.id_pegawai");
$data=mysqli_fetch_array($tampil);

$pegawai['nama_pegawai']=$data['nama_pegawai'];
echo json_encode($pegawai);
?>
