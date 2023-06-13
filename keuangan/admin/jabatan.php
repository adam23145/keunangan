<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
    Jabatan
      <small>Data Jabatan</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Jabatan</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <section class="col-lg-12">
        <div class="box box-info">

          <div class="box-header">
            <h3 class="box-title">Jabatan</h3>
            <div class="btn-group pull-right">            

              <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#exampleModal">
                <i class="fa fa-plus"></i> &nbsp Tambah Jabatan
              </button>
            </div>
          </div>
          <div class="box-body">

            <!-- Modal -->
            <form action="jabatan_act.php" method="post">
              <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Tambah Jabatan</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="form-group">
                        <label>Jabatan</label>
                        <input type="text" name="nama_jabatan" required="required" class="form-control" placeholder="Nama Jabatan ..">
                      </div>
                      <div class="form-group">
                        <label>Gaji</label>
                        <input type="text" name="gaji" required="required" class="form-control" placeholder="Gaji .." id="gaji">
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
                    <th>NAMA JABATAN</th>
                    <th>GAJI</th>
                    <th>OPSI</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  include '../koneksi.php';
                  $no=1;
                  $data = mysqli_query($koneksi,"SELECT * FROM jabatan");
                  while($d = mysqli_fetch_array($data)){
                    ?>
                    <tr>
                      <td><?php echo $no++; ?></td>
                      <td><?php echo $d['nama_jabatan']; ?></td>
                      <td><?php echo $d['gaji']; ?></td>
                      <td>
                          <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit_jabatan_<?php echo $d['id_jabatan'] ?>">
                            <i class="fa fa-cog"></i>
                          </button>

                          <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus_jabatan_<?php echo $d['id_jabatan'] ?>">
                            <i class="fa fa-trash"></i>
                          </button></td>

                        <form action="jabatan_update.php" method="post">
                          <div class="modal fade" id="edit_jabatan_<?php echo $d['id_jabatan'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Edit Jabatan</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <div class="form-group">
                                    <label>Jabatan</label>
                                    <input type="hidden" name="id" required="required" class="form-control" placeholder="id Kategori .." value="<?php echo $d['id_jabatan']; ?>">
                                    <input type="text" name="nama_jabatan" required="required" class="form-control" placeholder="Nama Kategori .." value="<?php echo $d['nama_jabatan']; ?>" style="width:100%">
                                  </div>
                                  <div class="form-group">
                                    <label>Gaji</label>
                                    <input type="text" name="gaji" required="required" class="form-control" placeholder="Gaji .." id="gaji" value="<?php echo $d['gaji']; ?>">
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
                        <div class="modal fade" id="hapus_jabatan_<?php echo $d['id_jabatan'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Peringatan!</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">

                                <p>Yakin ingin menghapus data ini ?</p>

                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                <a href="jabatan_hapus.php?id=<?php echo $d['id_jabatan'] ?>" class="btn btn-primary">Hapus</a>
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
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <script type="text/javascript">
    $('#gaji').on('keyup',function(){
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