<?php include 'header.php'; 

?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
    <?php 
    $_SESSION["nama_divisi"] = 'Mesin';
    $_SESSION["id_divisi"] = '2';
    ?>
      <h1><?php echo $_SESSION['nama_divisi'];?></h1>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active"><?php echo $_SESSION['nama_divisi'];?></li>
    </ol>
  </section>
  <section class="container-fluid" style="margin-top:10px">
          <div class="row">
                <div class="col-md-5">
                    <div class="panel panel-inverse" data-sortable-id="form-validation-1">
                        <div class="panel-heading">
                            <h4 class="panel-title">Input Absensi</h4>
                        </div>
                        <div class="panel-body panel-form">
                        
                            <form class="form-horizontal form-bordered" data-parsley-validate="true" name="absen" action="mesin_absen_act.php" method="POST">
                                <div class="form-group">
                                  <label class="control-label col-md-4 col-sm-4">Tanggal</label>
                                  <div class="col-md-6 col-sm-6">
                                    <input autocomplete="off" type="text" name="tanggal" required="required" class="form-control datepicker2" value="<?php echo date('Y/m/d'); ?>" readonly>
                                  </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 col-sm-4">ID</label>
                                    <div class="col-md-6 col-sm-6">
                                    <select name="id_pegawai_absen" id="id_pegawaii_absen" data-live-search="true" data-style="btn-white" class="form-control selectpicker" required="required">
                                        <option value="" selected disabled>---- Pilih ID ----</option>
                                        <?php
                                        $id_divisi = $_SESSION["id_divisi"];
                                        $sql = mysqli_query($koneksi,"SELECT * FROM pegawai WHERE divisi ='$id_divisi'") or die(mysqli_error($koneksi));
                                        while ($dt = mysqli_fetch_array($sql)) {
                                            ?>
                                            <option value="<?php echo $dt['id_pegawai'] ?>"><?php echo $dt['id_pegawai'].' - '.$dt['nama_pegawai'] ?></option>
                                        <?php } ?>
                                    </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 col-sm-4" >Nama Pegawai</label>
                                    <div class="col-md-6 col-sm-6">
                                        <input class="form-control" type="text" name="nama_pegawai_absen" id="nama_pegawaii_absen"  data-parsley-required="true" readonly/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 col-sm-4" >Hadir</label>
                                    <div class="col-md-6 col-sm-6">
                                        <input class="form-control" type="number" name="hadir" value="0"   data-parsley-required="true" data-parsley-type="number" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 col-sm-4" >Setengah Hari</label>
                                    <div class="col-md-6 col-sm-6">
                                        <input class="form-control" type="number" name="setengah_hari" value="0" data-parsley-required="true" data-parsley-type="number"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 col-sm-4" >Tanpa Keterangan</label>
                                    <div class="col-md-6 col-sm-6">
                                        <input class="form-control" type="number" name="tanpa_keterangan"  value="0" data-parsley-required="true" data-parsley-type="number"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 col-sm-4"></label>
                                    <div class="col-md-6 col-sm-6">
                                        <button type="submit"  class="btn btn-primary btn-sm">Submit</button> 
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-inverse" data-sortable-id="form-validation-1">
                        <div class="panel-heading">
                            
                            <h4 class="panel-title">Input Gaji</h4>
                        </div>
                        <div class="panel-body panel-form">
                            <form class="form-horizontal form-bordered" data-parsley-validate="true" name="data_pengguna" action="mesin_penggajian_act.php" method="POST">
                                <div class="form-group">
                                  <label class="control-label col-md-4 col-sm-4">Tanggal</label>
                                  <div class="col-md-6 col-sm-6">
                                    <input autocomplete="off" type="text" name="tanggal" required="required" class="form-control datepicker2" value="<?php echo date('Y/m/d'); ?>" readonly>
                                  </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 col-sm-4">ID</label>
                                    <div class="col-md-6 col-sm-6">
                                        <select name="id_pegawai_gaji" id="id_pegawai_gaji" data-live-search="true" data-style="btn-white" class="form-control selectpicker" required="required">
                                             <option value="" selected disabled>---- Pilih ID ----</option>
                                             <?php
                                             $id_divisi = $_SESSION["id_divisi"];
                                             $sql = mysqli_query($koneksi,"SELECT * FROM pegawai WHERE divisi ='$id_divisi' ORDER BY nama_pegawai ASC");
                                             if(mysqli_num_rows($sql) != 0){
                                                 while($data = mysqli_fetch_assoc($sql)){
                                                     echo '<option value='.$data['id_pegawai'].'>'.$data['id_pegawai'].' '.'['.$data['nama_pegawai'].']'.'</option>';
                                                 }
                                             }
                                             ?>
                                         </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 col-sm-4" >Nama Pegawai</label>
                                    <div class="col-md-6 col-sm-6">
                                        <input class="form-control" type="text" name="nama_pegawai_gaji" id="nama_pegawai_gaji"  data-parsley-required="true" readonly/>
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label class="control-label col-md-4 col-sm-4" >divisi</label>
                                    <div class="col-md-6 col-sm-6">
                                        <input class="form-control" type="text" name="nama_divisi" id="nama_divisi" data-parsley-required="true" readonly/>
                                        <input class="form-control" type="hidden" name="id_divisi" id="id_divisi" value="0" data-parsley-required="true" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 col-sm-4" >Gaji Pokok</label>
                                    <div class="col-md-6 col-sm-6">
                                        <div class="form-inline">
                                            <input class="form-control" type="text" name="gaji_pokok" id="gaji_pokok" data-parsley-required="true" readonly/>
                                        </div>
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label class="control-label col-md-4 col-sm-4" >Bonus</label>
                                    <div class="col-md-6 col-sm-6">
                                        <div class="form-inline">
                                            <input class="form-control" type="number" name="bonus" id="bonus" value="0" data-parsley-required="true" />
                                            <button type="button" id="add_bonus" class="btn btn-secondary" data-dismiss="modal">Update</button>
                                        </div>
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label class="control-label col-md-4 col-sm-4" >Hutang</label>
                                    <div class="col-md-6 col-sm-6">
                                        <div class="form-inline">
                                            <input class="form-control" type="text" name="hutang" id="hutang" value="0" data-parsley-required="true" readonly/>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 col-sm-4" >Hadir</label>
                                    <div class="col-md-6 col-sm-6">
                                        <input class="form-control" type="text" name="kehadiran_penuh" value="" id="kehadiran_penuh"  data-parsley-required="true" data-parsley-type="number" readonly/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 col-sm-4" >Setengah Hari</label>
                                    <div class="col-md-6 col-sm-6">
                                        <input class="form-control" type="text" name="setengah_hari" id="setengah_hari" value="0" data-parsley-required="true" data-parsley-type="number" readonly/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 col-sm-4" >Tanpa Keterangan</label>
                                    <div class="col-md-6 col-sm-6">
                                        <input class="form-control" type="text" name="kehadiran_alpha" id="kehadiran_alpha"   value="" data-parsley-required="true" data-parsley-type="number"readonly/>
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label class="control-label col-md-4 col-sm-4" >Gaji Bersih</label>
                                    <div class="col-md-6 col-sm-6">
                                    <div class="form-inline">
                                            <input class="form-control" type="text" name="gaji_bersih" id="gaji_bersih"value="0" data-parsley-required="true" readonly/>
                                            <input class="form-control" type="hidden" name="gaji_bersih2" id="gaji_bersih2" value="0" data-parsley-required="true" >
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 col-sm-4"></label>
                                    <div class="col-md-6 col-sm-6">
                                        <button type="submit" class="btn btn-primary btn-sm">Submit</button>
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
            <h3 class="box-title">Gaji <?php echo $_SESSION['nama_divisi'];?></h3>
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
                    <th rowspan="2" class="text-center">PERIODE GAJI</th>
                    <th rowspan="2" class="text-center">ID PEGAWAI</th>
                    <th rowspan="2" class="text-center">NAMA</th>
                    <th rowspan="2" width="" class="text-center">GAJI BERSIH</th>
                    <th rowspan="2" width="15%" class="text-center">OPSI</th>
                  </tr>
                </thead>

                <tbody>
                  <?php 
                  include '../koneksi.php';
                  $id_divisi = $_SESSION["id_divisi"];
                  $no=1;
                  $data = mysqli_query($koneksi,"SELECT * FROM transaksi JOIN detail_transaksi_gaji ON detail_transaksi_gaji.id_detail_transaksi_gaji = transaksi.detail_transaksi JOIN pegawai ON detail_transaksi_gaji.pegawai = pegawai.id_pegawai JOIN divisi ON pegawai.divisi = divisi.id_divisi WHERE divisi.id_divisi = '$id_divisi' order by transaksi_id desc");
                  if($data){
                  while($d = mysqli_fetch_array($data)){
                    $tanggal = $d['transaksi_tanggal'];
                    ?>
                    <tr>
                      <td class="text-center"><?php echo $no++; ?></td>
                      <td class="text-center"><?php echo date('d-m-Y', strtotime($d['transaksi_tanggal'])); ?></td>
                      <td class="text-center"><?php echo "" . date('d/m/Y', strtotime($tanggal)) . " - " . date('d/m/Y', strtotime($tanggal. ' + 7 days')); ?></td>
                      <td class="text-center"><?php echo $d['id_pegawai']; ?></td>
                      <td class="text-center"><?php echo $d['nama_pegawai']; ?></td>
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
                                <a href="mesin_penggajian_hapus.php?id=<?php echo $d['transaksi_id'] ?>" class="btn btn-primary">Hapus</a>
                              </div>
                            </div>
                          </div>
                        </div>

                      </td>
                    </tr>
                    <?php 
                  }
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
  <section class="content">
    <div class="row">
      <section class="col-lg-12">
        <div class="box box-info">

          <div class="box-header">
            <h3 class="box-title">Absen <?php echo $_SESSION['nama_divisi'];?></h3>
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
                    <th rowspan="2" class="text-center">PERIODE ABSEN</th>
                    <th rowspan="2" class="text-center">ID PEGAWAI</th>
                    <th rowspan="2" class="text-center">NAMA</th>
                    <th rowspan="2" class="text-center">MASUK</th>
                    <th rowspan="2" class="text-center">SETENGAH HARI</th>
                    <th rowspan="2" class="text-center">ALPHA</th>
                    <th rowspan="2" width="15%" class="text-center">OPSI</th>
                  </tr>
                </thead>

                <tbody>
                  <?php 
                  include '../koneksi.php';
                  $id_divisi = $_SESSION["id_divisi"];
                  $no=1;
                  $data = mysqli_query($koneksi,"SELECT * 
                  FROM absen 
                  JOIN pegawai ON absen.pegawai = pegawai.id_pegawai 
                  JOIN divisi ON pegawai.divisi = divisi.id_divisi WHERE divisi.id_divisi = '$id_divisi' order by id_absen desc");
                  if($data){
                  while($d = mysqli_fetch_array($data)){
                    $tanggal = $d['tanggal_input'];
                    ?>
                    <tr>
                      <td class="text-center"><?php echo $no++; ?></td>
                      <td class="text-center"><?php echo date('d-m-Y', strtotime($d['tanggal_input'])); ?></td>
                      <td class="text-center"><?php echo "" . date('d/m/Y', strtotime($tanggal)) . " - " . date('d/m/Y', strtotime($tanggal. ' + 7 days')); ?></td>
                      <td class="text-center"><?php echo $d['id_pegawai']; ?></td>
                      <td class="text-center"><?php echo $d['nama_pegawai']; ?></td>
                      <td class="text-center"><?php echo $d['kehadiran_penuh']; ?></td>
                      <td class="text-center"><?php echo $d['kehadiran_setengah']; ?></td>
                      <td class="text-center"><?php echo $d['kehadiran_alpha']; ?></td>
                      </td>
                      <td class="text-center">    
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus_absen_<?php echo $d['id_absen'] ?>">
                          <i class="fa fa-trash"></i>
                        </button>
                        <!-- modal hapus -->
                        <div class="modal fade" id="hapus_absen_<?php echo $d['id_absen'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                <a href="mesin_absen_hapus.php?id=<?php echo $d['id_absen'] ?>" class="btn btn-primary">Hapus</a>
                              </div>
                            </div>
                          </div>
                        </div>

                      </td>
                    </tr>
                    <?php 
                  }
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
                        $(document).ready(function(){
                            $('#id_pegawaii_absen').on('change',function(){
                                var id_pegawaii_absen = $(this).val();
                                $.ajax({
                                    url:'mesin_absen_ambil_data.php',
                                    type:"POST",
                                    data:{
                                        modul:'NamaPegawai',
                                        id:id_pegawaii_absen
                                    },
                                    success:function(respond){
                                        $("#nama_pegawaii_absen").val(respond);
                                    },
                                    error:function(){
                                        alert("Gagal Mengambil Data");
                                    }
                                })
                            });
                          });
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
                                  $("#hutang").val(data.hutang);
                                  $("#bonus").val(0);
                                  var gaji = data.gaji;
                                  var kehadiran_penuh = data.kehadiran_penuh;
                                  var kehadiran_setengah = data.kehadiran_setengah;
                                  var kehadiran_alpha = data.kehadiran_alpha;
                                  var hutang = $("#hutang").val();
                                  var bonus = $("#bonus").val();
                                  var gajiBersih = (gaji * kehadiran_penuh * 1) + (gaji * kehadiran_setengah * 0.65) + (gaji * kehadiran_alpha * 0) - hutang; // calculate the net salary without bonus
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
</div>
<?php include 'footer.php'; ?>