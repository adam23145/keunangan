<?php
	include '../koneksi.php';
	

	$sql="SELECT * FROM detail_transaksi_gaji WHERE pegawai='$_POST[id_pegawai_gaji]' AND transaksi_tanggal >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)";
	$cek=mysqli_num_rows(mysqli_query($koneksi,$sql));
	if ($cek > 0) {
		echo "<script>alert('Penginputan pada Minggu ini telah dilakukan!'); window.location.href='log_harian.php';</script>";
	} else {
		$query = "SELECT id_detail_transaksi_gaji FROM detail_transaksi_gaji ORDER BY id_detail_transaksi_gaji DESC LIMIT 1";
		$result = mysqli_query($koneksi, $query);

		if (mysqli_num_rows($result) > 0) {
			$row = mysqli_fetch_assoc($result);
			$lastID = $row['id_detail_transaksi_gaji'];

			// Mendapatkan angka dari ID terakhir
			$lastNumber = intval(substr($lastID, 2));

			// Menambahkan 1 ke angka terakhir
			$newNumber = $lastNumber + 1;

			// Menghasilkan ID baru dengan memperhatikan digit
			$newID = 'GJ' . sprintf("%03d", $newNumber);
			if($_POST['gaji_bersih'] == 0 ||$_POST['gaji_bersih'] == ""){
				echo "<script>alert('Penggajian Kosong!'); window.location.href='log_harian.php';</script>";
			}else{
				
				// $sql = "INSERT INTO transaksi (transaksi_id, transaksi_tanggal, transaksi_jenis, transaksi_kategori, transaksi_nominal, detail_transaksi)
				// VALUES (NULL, CURDATE(), 'Pengeluaran', '$_POST[id_divisi]', '$_POST[gaji_bersih]', '$newID')";

				// mysqli_query($koneksi, $sql) or die("Gagal Menyimpan transaksi");

				// $sql_gaji_transaksi = "INSERT INTO detail_transaksi_gaji (id_detail_transaksi_gaji, transaksi_tanggal, pegawai) 
				// 		VALUES ('$newID', CURDATE(), '$_POST[id_pegawai_gaji]')";

				// mysqli_query($koneksi, $sql_gaji_transaksi) or die("Gagal Menyimpan barang");
				// Perintah SQL untuk operasi pertama
					$sql = "INSERT INTO transaksi (transaksi_id, transaksi_tanggal, transaksi_jenis, transaksi_kategori, transaksi_nominal, detail_transaksi)
					VALUES (NULL, '$_POST[tanggal]', 'Pengeluaran', ?, ?, ?)";

					$stmt = mysqli_prepare($koneksi, $sql);
					mysqli_stmt_bind_param($stmt, 'sss', $_POST['id_divisi'], $_POST['gaji_bersih'], $newID);
					mysqli_stmt_execute($stmt);

					// Perintah SQL untuk operasi kedua
					$sql_gaji_transaksi = "INSERT INTO detail_transaksi_gaji (id_detail_transaksi_gaji, transaksi_tanggal, pegawai) 
								VALUES (?, '$_POST[tanggal]', ?)";

					$stmt_gaji_transaksi = mysqli_prepare($koneksi, $sql_gaji_transaksi);
					mysqli_stmt_bind_param($stmt_gaji_transaksi, 'ss', $newID, $_POST['id_pegawai_gaji']);
					mysqli_stmt_execute($stmt_gaji_transaksi);

					if (mysqli_stmt_affected_rows($stmt_gaji_transaksi) === 1 && mysqli_stmt_affected_rows($stmt) === 1) {
						echo "<script>alert('Penggajian berhasil di inputkan!'); window.location.href='log_harian.php';</script>";
					} else {
						echo "<script>alert('Gagal menyimpan data gaji.'); window.location.href='log_harian.php';</script>";
					}

				// 
			}
		} else {
			// Jika tidak ada data di database, ID baru akan menjadi GJ001
			$newID = 'GJ001';
			if($_POST['gaji_bersih'] == 0 ||$_POST['gaji_bersih'] == ""){
				echo "<script>alert('Penggajian Kosong!'); window.location.href='log_harian.php';</script>";
			}else{
					$sql = "INSERT INTO transaksi (transaksi_id, transaksi_tanggal, transaksi_jenis, transaksi_kategori, transaksi_nominal, detail_transaksi)
					VALUES (NULL, '$_POST[tanggal]', 'Pengeluaran', ?, ?, ?)";

					$stmt = mysqli_prepare($koneksi, $sql);
					mysqli_stmt_bind_param($stmt, 'sss', $_POST['id_divisi'], $_POST['gaji_bersih'], $newID);
					mysqli_stmt_execute($stmt);

					// Perintah SQL untuk operasi kedua
					$sql_gaji_transaksi = "INSERT INTO detail_transaksi_gaji (id_detail_transaksi_gaji, transaksi_tanggal, pegawai) 
								VALUES (?, '$_POST[tanggal]', ?)";

					$stmt_gaji_transaksi = mysqli_prepare($koneksi, $sql_gaji_transaksi);
					mysqli_stmt_bind_param($stmt_gaji_transaksi, 'ss', $newID, $_POST['id_pegawai_gaji']);
					mysqli_stmt_execute($stmt_gaji_transaksi);

					if (mysqli_stmt_affected_rows($stmt_gaji_transaksi) === 1 && mysqli_stmt_affected_rows($stmt) === 1) {
						echo "<script>alert('Penggajian berhasil di inputkan!'); window.location.href='log_harian.php';</script>";
					} else {
						echo "<script>alert('Gagal menyimpan data gaji.'); window.location.href='log_harian.php';</script>";
					}
				// $sql = "INSERT INTO transaksi (transaksi_id, transaksi_tanggal, transaksi_jenis, transaksi_kategori, transaksi_nominal, detail_transaksi)
				// VALUES (NULL, CURDATE(), 'Pengeluaran', '$_POST[id_divisi]', '$_POST[gaji_bersih]', '$newID')";

				// mysqli_query($koneksi, $sql) or die("Gagal Menyimpan transaksi");

				// $sql_gaji_transaksi = "INSERT INTO detail_transaksi_gaji (id_detail_transaksi_gaji, transaksi_tanggal, pegawai) 
				// 		VALUES ('$newID', CURDATE(), '$_POST[id_pegawai_gaji]')";

				// mysqli_query($koneksi, $sql_gaji_transaksi) or die("Gagal Menyimpan barang");

				// echo "<script>alert('Penggajian berhasil di inputkan!'); window.location.href='log_harian.php';</script>";
			}
		}

		
	}
?>