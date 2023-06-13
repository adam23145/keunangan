<?php
    include '../koneksi.php';


    $query = "SELECT id_detail_barang FROM detail_barang ORDER BY id_detail_barang DESC LIMIT 1";
		$result = mysqli_query($koneksi, $query);

		if (mysqli_num_rows($result) > 0) {
			$row = mysqli_fetch_assoc($result);
			$lastID = $row['id_detail_barang'];

			// Mendapatkan angka dari ID terakhir
			$lastNumber = intval(substr($lastID, 2));

			// Menambahkan 1 ke angka terakhir
			$newNumber = $lastNumber + 1;

			// Menghasilkan ID baru dengan memperhatikan digit
			$newID = 'BR' . sprintf("%03d", $newNumber);
			if($_POST['harga_total'] == 0 ||$_POST['harga_total'] == ""){
				echo "<script>alert('Masih Kosong!'); window.location.href='operasional_harian.php';</script>";
			}else{
				$sql = "INSERT INTO transaksi (transaksi_id, transaksi_tanggal, transaksi_jenis, transaksi_kategori, transaksi_nominal, detail_transaksi)
				VALUES (NULL, '$_POST[tanggal]', 'Pengeluaran', '4', '$_POST[harga_total]', '$newID')";

				mysqli_query($koneksi, $sql) or die("Gagal Menyimpan transaksi");

				$sql_barang_transaksi = "INSERT INTO detail_barang (id_detail_barang, transaksi_tanggal, nama_barang,qty,harga_satuan) 
						VALUES ('$newID', '$_POST[tanggal]', '$_POST[id_barang]','$_POST[jumlah_barang]','$_POST[harga_barang]')";

				mysqli_query($koneksi, $sql_barang_transaksi) or die("Gagal Menyimpan barang");

				echo "<script>alert('Penggajian berhasil di inputkan!'); window.location.href='operasional_harian.php';</script>";
			}
			
		} else {
			// Jika tidak ada data di database, ID baru akan menjadi GJ001
			$newID = 'BR001';
			if($_POST['harga_total'] == 0 ||$_POST['harga_total'] == ""){
				echo "<script>alert('Masih Kosong!'); window.location.href='operasional_harian.php';</script>";
			}else{
				$sql = "INSERT INTO transaksi (transaksi_id, transaksi_tanggal, transaksi_jenis, transaksi_kategori, transaksi_nominal, detail_transaksi)
				VALUES (NULL, '$_POST[tanggal]', 'Pengeluaran', '4', '$_POST[harga_total]', '$newID')";

				mysqli_query($koneksi, $sql) or die("Gagal Menyimpan transaksi");

				$sql_barang_transaksi = "INSERT INTO detail_barang (id_detail_barang, transaksi_tanggal, nama_barang,qty,harga_satuan) 
						VALUES ('$newID', '$_POST[tanggal]', '$_POST[id_barang]','$_POST[jumlah_barang]','$_POST[harga_barang]')";

				mysqli_query($koneksi, $sql_barang_transaksi) or die("Gagal Menyimpan barang");

				echo "<script>alert('Penggajian berhasil di inputkan!'); window.location.href='operasional_harian.php';</script>";
			}
		}
    
?>