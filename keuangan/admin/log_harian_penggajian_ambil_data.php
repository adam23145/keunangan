<?php
include '../koneksi.php';
$id = $_POST['id'];
$modul = $_POST['modul'];

if ($modul=='DataPegawai') {
    $sql = mysqli_query($koneksi,"SELECT * FROM pegawai
    JOIN divisi ON divisi = id_divisi
    JOIN jabatan ON jabatan = id_jabatan
    JOIN absen ON pegawai = id_pegawai
    LEFT JOIN hutang ON id_pegawai = hutang.pegawai
    WHERE id_pegawai = '$id'
    ORDER BY id_pegawai")or die(mysqli_error($koneksi));
    $data = mysqli_fetch_array($sql);
    $pegawai = array(
        'nama' => $data['nama_pegawai'],
        'divisi' => $data['nama_divisi'],
        'iddivisi'=>$data['id_divisi'],
        'gaji' => $data['gaji'],
        'hutang' => $data['hutang_nominal'],
        'kehadiran_penuh'=> $data['kehadiran_penuh'],
        'kehadiran_setengah'=> $data['kehadiran_setengah'],
        'kehadiran_alpha'=> $data['kehadiran_alpha'],
    );
    echo json_encode($pegawai);
}
?>