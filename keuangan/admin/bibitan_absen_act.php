<?php
	include '../koneksi.php';
	
	$hadir = $_POST['hadir'];
	$setengah_hari = $_POST['setengah_hari'];
	$tanpa_keterangan = $_POST['tanpa_keterangan'];

	$sql="SELECT * FROM absen WHERE pegawai='$_POST[id_pegawai_absen]' AND tanggal_input >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)";
	$cek=mysqli_num_rows(mysqli_query($koneksi,$sql));
	if ($cek > 0) {
		echo "<script>alert('Absensi pada Minggu ini telah dilakukan!'); window.location.href='bibitan.php';</script>";
	} else {
		if($hadir + $setengah_hari + $tanpa_keterangan == 6){
			$sql="INSERT INTO `absen` (`id_absen`, `tanggal_input`, `pegawai`, `kehadiran_penuh`, `kehadiran_setengah`, `kehadiran_alpha`)
			VALUES (NULL,'$_POST[tanggal]','$_POST[id_pegawai_absen]','$_POST[hadir]','$_POST[setengah_hari]','$_POST[tanpa_keterangan]')";
			mysqli_query($koneksi,$sql) or die("Gagal Menyimpan");
			header("location:bibitan.php");
		}
		else{
			echo "<script>alert('Absensi salah!'); window.location.href='bibitan.php';</script>";
		}
	}
?>