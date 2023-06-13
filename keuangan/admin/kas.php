<?php include 'header.php'; 

?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
    <?php 
    $_SESSION["operasional"] = 'Kas';
    $_SESSION["id_jenis_operasional"] = '3';
    ?>
      <h1><?php echo $_SESSION['operasional'];?></h1>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active"><?php echo $_SESSION['operasional'];?></li>
    </ol>
  </section>
  <section class="container-fluid" style="margin-top:10px;margin-left:10px">
          <div class="row">
            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-inverse" data-sortable-id="form-validation-1">
                        <div class="panel-heading">
                            
                            <h4 class="panel-title"><?php echo $_SESSION['operasional'];?></h4>
                        </div>
                        <div class="panel-body panel-form">
                            <form class="form-horizontal form-bordered" data-parsley-validate="true" name="data_pengguna" action="kas_act.php" method="POST">
                                <div class="form-group">
                                  <label class="control-label col-md-4 col-sm-4">Tanggal</label>
                                  <div class="col-md-6 col-sm-6">
                                    <input autocomplete="off" type="text" name="tanggal" required="required" class="form-control datepicker2" value="<?php echo date('Y/m/d'); ?>" readonly>
                                  </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 col-sm-4">Hasil Penjualan</label>
                                    <div class="col-md-6 col-sm-6">
                                        <input class="form-control" type="text" name="hasil_penjualan" id="hasil_penjualan" data-parsley-required="true"/>
                                    </div>
                                </div>
                                                                
                                <div class="form-group">
                                    <label class="control-label col-md-4 col-sm-4"></label>
                                    <div class="col-md-6 col-sm-6">
                                        <button type="submit" class="btn btn-primary btn-sm">Submit</button> <button type="resset" class="btn btn-danger btn-sm">Resset</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                </div>
               </div>
            </div>
  </section>

  <section class="content">
    <div class="row">
      <section class="col-lg-12">
        <div class="box box-info">

          <div class="box-header">
            <h3 class="box-title"><?php echo $_SESSION['operasional'];?></h3>
            <div class="btn-group pull-right">            

            </div><hr>
            <?php 
                if(isset($_GET['alert'])){
                  if($_GET['alert']=='gagal'){
                    ?>
                    <div class="alert alert-warning alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      <h4><i class="icon fa fa-warning"></i> Peringatan !</h4>
                      Ekstensi Tidak Diperbolehkan
                    </div>								
                    <?php
                  }elseif($_GET['alert']=="berhasil"){
                    ?>
                    <div class="alert alert-success alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      <h4><i class="icon fa fa-check"></i> Success</h4>
                      Berhasil Disimpan
                    </div> 								
                    <?php
                  }elseif($_GET['alert']=="berhasilupdate"){
                    ?>
                    <div class="alert alert-success alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      <h4><i class="icon fa fa-check"></i> Success</h4>
                      Berhasil Update
                    </div> 								
                    <?php
                  }
                }
                ?>
          </div>
          <div class="box-body">

            <div class="table-responsive">
              <table class="table table-bordered table-striped" id="table-datatable">
                <thead>
                  <tr>
                    <th width="1%" rowspan="2">NO</th>
                    <th width="10%" rowspan="2" class="text-center">TANGGAL</th>
                    <th rowspan="2" class="text-center">Jenis Transaksi</th>
                    <th rowspan="2" class="text-center">Jumlah Pendapatan</th>
                    <th rowspan="2" width="15%" class="text-center">OPSI</th>
                  </tr>
                </thead>

                <tbody>
                  <?php 
                  include '../koneksi.php';
                  $id_divisi = $_SESSION["id_jenis_operasional"];
                  $no=1;
                  $data = mysqli_query($koneksi,"SELECT * 
                  FROM transaksi JOIN kategori ON transaksi_kategori = kategori_id WHERE kategori_id = 6");
                  while($d = mysqli_fetch_array($data)){
                    $tanggal = $d['transaksi_tanggal'];
                    ?>
                    <tr>
                      <td class="text-center"><?php echo $no++; ?></td>
                      <td class="text-center"><?php echo date('d-m-Y', strtotime($d['transaksi_tanggal'])); ?></td>
                      <td class="text-center"><?php echo $d['kategori']; ?></td>
                      <td class="text-center"><?php echo $d['transaksi_nominal']; ?></td>
                      </td>
                      <td class="text-center">    

                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus_transaksi_<?php echo $d['transaksi_id'] ?>">
                          <i class="fa fa-trash"></i>
                        </button>
                        

                        <!-- modal hapus -->
                        <div class="modal fade" id="hapus_transaksi_<?php echo $d['transaksi_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h4 class="modal-title" id="exampleModalLabel">Peringatan!</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">

                                <p>Yakin ingin menghapus data ini ?</p>

                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                <a href="kas_hapus.php?id=<?php echo $d['transaksi_id'] ?>" class="btn btn-primary">Hapus</a>
                              </div>
                            </div>
                          </div>
                        </div>

                      </td>
                    </tr>
                    <?php 
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>

        </div>
      </section>
    </div>
  </section>
                                               
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script>
                          // Fungsi untuk menghitung harga total
                            function hitungHargaTotal() {
                                var jumlahBarang = parseFloat(document.getElementById('jumlah_barang').value);
                                var hargaBarang = parseFloat(document.getElementById('harga_barang').value);
                                var hargaTotal = jumlahBarang * hargaBarang;

                                if (!isNaN(hargaTotal)) {
                                    document.getElementById('harga_total').value = hargaTotal;
                                }
                            }

                            // Memanggil fungsi hitungHargaTotal saat nilai input berubah
                            document.getElementById('jumlah_barang').addEventListener('input', hitungHargaTotal);
                            document.getElementById('harga_barang').addEventListener('input', hitungHargaTotal);
                          $(document).ready(function(){
                            $('#id_pegawai_gaji').on('change',function(){
                              var id_pegawai_gaji = $(this).val();
                              $.ajax({
                                url:'mesin_penggajian_ambil_data.php',
                                type:"POST",
                                data:{
                                  modul:'DataPegawai',
                                  id:id_pegawai_gaji
                                },
                                success:function(response){
                                  var data = JSON.parse(response);
                                  $("#nama_pegawai_gaji").val(data.nama);
                                  $("#nama_divisi").val(data.divisi);
                                  $("#id_divisi").val(data.iddivisi);
                                  $("#gaji_pokok").val(data.gaji);
                                  $("#kehadiran_penuh").val(data.kehadiran_penuh);
                                  $("#setengah_hari").val(data.kehadiran_setengah);
                                  $("#kehadiran_alpha").val(data.kehadiran_alpha);
                                  $("#bonus").val(0);
                                  var gaji = data.gaji;
                                  var kehadiran_penuh = data.kehadiran_penuh;
                                  var kehadiran_setengah = data.kehadiran_setengah;
                                  var kehadiran_alpha = data.kehadiran_alpha;
                                  var hutang = $("#hutang").val();
                                  var bonus = $("#bonus").val();
                                  var gajiBersih = (gaji * kehadiran_penuh * 1) + (gaji * kehadiran_setengah * 0.65) + (gaji * kehadiran_alpha * 0); // calculate the net salary without bonus
                                  $("#gaji_bersih").val(gajiBersih);
                                  $("#gaji_bersih2").val(gajiBersih);
                                },
                                error:function(){
                                  alert("Gagal Mengambil Data");
                                }
                              });
                            });
                            
                            $("#add_bonus").on("click", function(){
                              var bonus = parseFloat($("#bonus").val());
                              var gajiBersih = parseFloat($("#gaji_bersih2").val());
                              if (!isNaN(bonus) && !isNaN(gajiBersih)) {
                                $("#gaji_bersih").val(gajiBersih + bonus); // update the net salary with bonus
                              }
                            });
                          });
                      </script>
                      <script type="text/javascript">
                          $('#hasil_penjualan').on('keyup',function(){
                              var angka = $(this).val();
                      
                              var hasilAngka = formatRibuan(angka);
                      
                              $(this).val(hasilAngka);
                          });
                      
                          function formatRibuan(angka){
                          var number_string = angka.replace(/[^\d]/g, '').toString(),
                          split           = number_string.split('.'),
                          sisa            = split[0].length % 3,
                          angka_hasil     = split[0].substr(0, sisa),
                          ribuan          = split[0].substr(sisa).match(/\d{3}/gi);

                          // tambahkan titik jika yang di input sudah menjadi angka ribuan
                          if(ribuan){
                              separator = sisa ? '.' : '';
                              angka_hasil += separator + ribuan.join('.');
                          }

                          angka_hasil = split[1] != undefined ? angka_hasil + ',' + split[1] : angka_hasil;
                          return angka_hasil;
                          }
                        </script>     
</div>
<?php include 'footer.php'; ?>