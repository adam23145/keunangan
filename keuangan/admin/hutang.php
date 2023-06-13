<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Hutang
      <small>Data Hutang</small>
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
            <h3 class="box-title">Catatan Hutang</h3>
            <div class="btn-group pull-right">            

              <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#exampleModal">
                <i class="fa fa-plus"></i> &nbsp Tambah Hutang
              </button>
            </div>
          </div>
          <div class="box-body">

            <!-- Modal -->
            <form action="hutang_act.php" method="post">
              <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title" id="exampleModalLabel">Tambah Hutang</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">

                      <div class="form-group">
                        <label>Tanggal</label>
                        <input autocomplete="off" type="text" name="tanggal" required="required" class="form-control datepicker2">
                      </div>
                      <div class="form-group" style="width:100%;margin-bottom:20px">
                                    <label>Nama Pegawai</label>
                                    <select name="id_pegawai" style="width:100%" class="form-control" required="required">
                                      <option value="">- Pilih -</option>
                                      <?php 
                                      $kategori = mysqli_query($koneksi,"SELECT * FROM pegawai JOIN divisi ON pegawai.divisi = id_divisi");
                                      while($k = mysqli_fetch_array($kategori)){
                                        ?>
                                        <option value="<?php echo $k['id_pegawai']; ?>"><?php echo $k['nama_pegawai']; ?>-<?php echo $k['nama_divisi']; ?></option>
                                        <?php 
                                      }
                                      ?>
                                    </select>
                                  </div>
                      <div class="form-group">
                        <label>Nominal</label>
                        <input type="number" name="nominal" required="required" class="form-control" placeholder="Masukkan Nominal ..">
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
                    <th class="text-center">Nama Pegawai</th>
                    <th class="text-center">NOMINAL</th>
                    <th width="10%" class="text-center">OPSI</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  include '../koneksi.php';
                  $no=1;
                  $data = mysqli_query($koneksi,"SELECT * FROM hutang JOIN pegawai ON pegawai = id_pegawai");
                  while($d = mysqli_fetch_array($data)){
                    ?>
                    <tr>
                      <td class="text-center"><?php echo $no++; ?></td>
                      <td>HTG-000<?php echo $d['hutang_id']; ?></td>
                      <td class="text-center"><?php echo date('d-m-Y', strtotime($d['hutang_tanggal'])); ?></td>
                      <td><?php echo $d['nama_pegawai']; ?></td>
                      <td class="text-center"><?php echo "Rp. ".number_format($d['hutang_nominal'])." ,-"; ?></td>
                      <td class="text-center">
                      <!-- <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit_hutang_<?php echo $d['hutang_id'] ?>">
                        <i class="fa fa-cog"></i>
                      </button> -->

                      <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus_hutang_<?php echo $d['hutang_id'] ?>">
                        <i class="fa fa-trash"></i>
                      </button>
                      </td>
                       


                      <form action="hutang_update.php" method="post">
                        <div class="modal fade" id="edit_hutang_<?php echo $d['hutang_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h4 class="modal-title" id="exampleModalLabel">Edit hutang</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <div class="form-group" style="width:100%;margin-bottom:20px">
                                  <label>Nama Pegawai</label>
                                  <input type="text" style="width:100%" name="nominal" required="required" class="form-control" value="<?php echo $d['nama_pegawai'] ?>" readonly>
                                </div>
                                <div class="form-group" style="width:100%;margin-bottom:20px">
                                  <label>Tanggal</label>
                                  <input type="hidden" name="id" value="<?php echo $d['hutang_id'] ?>">
                                  <input type="text" style="width:100%" name="tanggal" required="required" class="form-control datepicker2" value="<?php echo $d['hutang_tanggal'] ?>">
                                </div>

                                <div class="form-group" style="width:100%;margin-bottom:20px">
                                  <label>Nominal</label>
                                  <input type="number" style="width:100%" name="nominal" required="required" class="form-control" placeholder="Masukkan Nominal .." value="<?php echo $d['hutang_nominal'] ?>">
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
                      <div class="modal fade" id="hapus_hutang_<?php echo $d['hutang_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                              <a href="hutang_hapus.php?id=<?php echo $d['hutang_id'] ?>" class="btn btn-primary">Hapus</a>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- Konfirmasi Hutang-->
                      <div class="modal fade" id="status_hutang_<?php echo $d['hutang_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                              <a href="hutang_status.php?id=<?php echo $d['hutang_id'] ?>" class="btn btn-primary">Sudah</a>
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