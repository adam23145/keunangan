<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Piutang
      <small>Data Piutang</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <section class="col-lg-12">
        <div class="box box-info">

          <div class="box-header">
            <h3 class="box-title">Catatan Piutang</h3>
            <div class="btn-group pull-right">            

              <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#exampleModal">
                <i class="fa fa-plus"></i> &nbsp Tambah Piutang
              </button>
            </div>
          </div>
          <div class="box-body">

            <!-- Modal -->
            <form action="piutang_act.php" method="post">
              <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title" id="exampleModalLabel">Tambah Piutang</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">

                      <div class="form-group">
                        <label>Tanggal</label>
                        <input autocomplete="off" type="text" name="tanggal" required="required" class="form-control datepicker2">
                      </div>

                      <div class="form-group">
                        <label>Nominal</label>
                        <input type="number" name="nominal" required="required" class="form-control" placeholder="Masukkan Nominal ..">
                      </div>

                      <div class="form-group">
                        <label>Keterangan</label>
                        <textarea name="keterangan" class="form-control" rows="4"></textarea>
                      </div>

                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                      <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                  </div>
                </div>
              </div>
            </form>


            <div class="table-responsive">
              <table class="table table-bordered table-striped" id="table-datatable">
                <thead>
                  <tr>
                    <th width="1%">NO</th>
                    <th width="1%">KODE</th>
                    <th width="10%" class="text-center">TANGGAL</th>
                    <th class="text-center">KETERANGAN</th>
                    <th class="text-center">NOMINAL</th>
                    <th class="text-center">STATUS</th>
                    <th width="10%" class="text-center">OPSI</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  include '../koneksi.php';
                  $no=1;
                  $data = mysqli_query($koneksi,"SELECT * FROM piutang");
                  while($d = mysqli_fetch_array($data)){
                    ?>
                    <tr>
                      <td class="text-center"><?php echo $no++; ?></td>
                      <td>PTG-000<?php echo $d['piutang_id']; ?></td>
                      <td class="text-center"><?php echo date('d-m-Y', strtotime($d['piutang_tanggal'])); ?></td>
                      <td><?php echo $d['piutang_keterangan']; ?></td>
                      <td class="text-center"><?php echo "Rp. ".number_format($d['piutang_nominal'])." ,-"; ?></td>
                      <?php
                      // $dataPiutang = mysqli_query($koneksi,"SELECT * FROM piutang WHERE piutang_id");
                      if($d['piutang_status'] == 0){
                      ?>
                        <td class="text-center"><button class="button button3" id="myButton2" onclick="changeColor()" data-toggle="modal" data-target="#status_piutang_<?php echo $d['piutang_id'] ?>">Belum Lunas</button></td>
                        <style>
                        /* Gaya awal tombol */
                        #myButton2 {
                          background-color: #DB1514; /* warna latar belakang tombol (biru) */
                          color: #fff; /* warna teks pada tombol (putih) */
                          padding: 5px 5px; /* padding tombol */
                          border: none; /* hilangkan border */
                          cursor: pointer; /* tampilkan cursor pointer */
                          font-size: 13px;/* ukuran teks */
                          border-radius: 5px; /* radius sudut tombol */
                          transition: background-color 0.3s ease-in-out; /* animasi perubahan warna latar belakang tombol */
                        }
                        </style>
                        <!-- <script>
                          function changeColor() {
                            document.getElementById('myButton2').style.backgroundColor = '#00A86B'; // Mengganti warna latar belakang tombol menjadi kuning
                            document.getElementById('myButton2').innerHTML="Sudah";
                          }
                        </script> -->
                      <?php
                        
                      }
                      else{
                        ?>
                        <td class="text-center"><button class="button button3" id="myButton" onclick="" >Sudah Lunas</button></td>
                        <style>
                        /* Gaya awal tombol */
                        #myButton {
                          background-color: #00A86B; /* warna latar belakang tombol (biru) */
                          color: #fff; /* warna teks pada tombol (putih) */
                          padding: 5px 5px; /* padding tombol */
                          border: none; /* hilangkan border */
                          cursor: pointer; /* tampilkan cursor pointer */
                          font-size: 13px;/* ukuran teks */
                          border-radius: 5px; /* radius sudut tombol */
                          transition: background-color 0.3s ease-in-out; /* animasi perubahan warna latar belakang tombol */
                        }
                        
                        </style>
                        <?php
                      }
                      ?>
                      
                      
                      <td>    

                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit_piutang_<?php echo $d['piutang_id'] ?>">
                        <i class="fa fa-cog"></i>
                      </button>

                      <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus_piutang_<?php echo $d['piutang_id'] ?>">
                        <i class="fa fa-trash"></i>
                      </button>


                      <form action="piutang_update.php" method="post">
                        <div class="modal fade" id="edit_piutang_<?php echo $d['piutang_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h4 class="modal-title" id="exampleModalLabel">Edit piutang</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">

                                <div class="form-group" style="width:100%;margin-bottom:20px">
                                  <label>Tanggal</label>
                                  <input type="hidden" name="id" value="<?php echo $d['piutang_id'] ?>">
                                  <input type="text" style="width:100%" name="tanggal" required="required" class="form-control datepicker2" value="<?php echo $d['piutang_tanggal'] ?>">
                                </div>

                                <div class="form-group" style="width:100%;margin-bottom:20px">
                                  <label>Nominal</label>
                                  <input type="number" style="width:100%" name="nominal" required="required" class="form-control" placeholder="Masukkan Nominal .." value="<?php echo $d['piutang_nominal'] ?>">
                                </div>

                                <div class="form-group" style="width:100%;margin-bottom:20px">
                                    <label>Jenis</label>
                                    <select name="jenis" style="width:100%" class="form-control" required="required">
                                      <option value="">- Pilih -</option>
                                      <option <?php if($d['piutang_status'] == 1){echo "selected='selected'";} ?> value="1">Sudah Lunas</option>
                                      <option <?php if($d['piutang_status'] == 2){echo "selected='selected'";} ?> value="2">Belum Lunas </option>
                                    </select>
                                  </div>

                                <div class="form-group" style="width:100%">
                                  <label>Keterangan</label>
                                  <textarea name="keterangan" style="width:100%" class="form-control" rows="4"><?php echo $d['piutang_keterangan'] ?></textarea>
                                </div>


                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </form>

                      <!-- modal hapus -->
                      <div class="modal fade" id="hapus_piutang_<?php echo $d['piutang_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                              <a href="piutang_hapus.php?id=<?php echo $d['piutang_id'] ?>" class="btn btn-primary">Hapus</a>
                            </div>
                          </div>
                        </div>
                      </div>

                      <!-- Konfirmasi Piutang-->
                      <div class="modal fade" id="status_piutang_<?php echo $d['piutang_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title" id="exampleModalLabel">Peringatan!</h4>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">

                              <p>Yakin ingin mengubah menjadi Sudah Di Bayar ?</p>

                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                              <a href="piutang_status.php?id=<?php echo $d['piutang_id'] ?>" class="btn btn-primary">Sudah</a>
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

</div>

<?php include 'footer.php'; ?>s