<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Pegawai
      <small>Data Pegawai</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Pegawai</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <section class="col-lg-12">
        <div class="box box-info">

          <div class="box-header">
            <h3 class="box-title">Pegawai</h3>
            <div class="btn-group pull-right">            

              <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#exampleModal">
                <i class="fa fa-plus"></i> &nbsp Tambah Pegawai
              </button>
            </div>
          </div>
          <div class="box-body">

            <!-- Modal -->
            <form action="pegawai_act.php" method="post">
              <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Tambah Kategori</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">

                      <div class="form-group">
                        <label>Nama Pegawai</label>
                        <input type="text" name="pegawai" required="required" class="form-control" placeholder="Nama Pegawai ..">
                      </div>
                      <div class="form-group">
                        <label>Divisi</label>
                        <select name="divisi" class="form-control" required="required">
                          <option value="">-- Pilih --</option>
                          <?php
                          // Query the database using a prepared statement
                          $stmt = $koneksi->prepare("SELECT id_divisi, nama_divisi FROM divisi");
                          $stmt->execute();
                          $result = $stmt->get_result();

                          // Loop through the result set and populate the drop-down list
                          while ($row = $result->fetch_assoc()) {
                            echo '<option value="' . $row['id_divisi'] . '">' . $row['nama_divisi'] . '</option>';
                          }
                          ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Jabatan/Gaji</label>
                        <select name="jabatan" class="form-control" required="required">
                        <option value="">-- Pilih --</option>
                          <?php
                          // Query the database using a prepared statement
                          $stmt = $koneksi->prepare("SELECT id_jabatan, nama_jabatan,gaji FROM jabatan");
                          $stmt->execute();
                          $result = $stmt->get_result();

                          // Loop through the result set and populate the drop-down list
                          while ($row = $result->fetch_assoc()) {
                            echo '<option value="' . $row['id_jabatan'] . '">' . $row['nama_jabatan'] . ' - ' . $row['gaji'] . '</option>';
                          }
                          ?>
                        </select>
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
                    <th>Nama Pegawai</th>
                    <th>Divisi</th>
                    <th>Gaji</th>
                    <th width="10%">OPSI</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  include '../koneksi.php';
                  $no=1;
                  $data = mysqli_query($koneksi,"SELECT * FROM pegawai JOIN divisi ON divisi = id_divisi JOIN jabatan ON jabatan = id_jabatan ORDER BY id_pegawai");
                  while($d = mysqli_fetch_array($data)){
                    ?>
                      <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $d['nama_pegawai']; ?></td>
                        <td><?php echo $d['nama_divisi']; ?></td>
                        <td><?php echo $d['gaji']; ?></td>
                        <td>    
                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit_pegawai_<?php echo $d['id_pegawai'] ?>">
                              <i class="fa fa-cog"></i>
                            </button>
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus_pegawai_<?php echo $d['id_pegawai'] ?>">
                              <i class="fa fa-trash"></i>
                            </button>

                          <form action="pegawai_update.php" method="post">
                            <div class="modal fade" id="edit_pegawai_<?php echo $d['id_pegawai'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit Kategori</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">

                                    <div class="form-group" style="width:100%">
                                      <label>Nama Kategori</label>
                                      <input type="hidden" name="id" required="required" class="form-control" placeholder="Nama Kategori .." value="<?php echo $d['id_pegawai']; ?>">
                                      <input type="text" name="pagawai" required="required" class="form-control" placeholder="Nama Pegawai .." value="<?php echo $d['nama_pegawai']; ?>" style="width:100%">
                                    </div>
                                    <div class="form-group">
                                      <label>Divisi</label>
                                      <select name="divisi" class="form-control">
                                        <option value="">-- Pilih --</option>
                                        <?php
                                        // Query the database using a prepared statement
                                        $stmt = $koneksi->prepare("SELECT id_divisi, nama_divisi FROM divisi");
                                        $stmt->execute();
                                        $result = $stmt->get_result();

                                        // Loop through the result set and populate the drop-down list
                                        while ($row = $result->fetch_assoc()) {
                                          echo '<option value="' . $row['id_divisi'] . '">' . $row['nama_divisi'] . '</option>';
                                        }
                                        ?>
                                      </select>
                                    </div>
                                    <div class="form-group">
                                      <label>Jabatan/Gaji</label>
                                      <select name="jabatan" class="form-control" required="required">
                                      <option value="">-- Pilih --</option>
                                        <?php
                                        // Query the database using a prepared statement
                                        $stmt = $koneksi->prepare("SELECT id_jabatan, nama_jabatan FROM jabatan");
                                        $stmt->execute();
                                        $result = $stmt->get_result();

                                        // Loop through the result set and populate the drop-down list
                                        while ($row = $result->fetch_assoc()) {
                                          echo '<option value="' . $row['id_jabatan'] . '">' . $row['nama_jabatan'] . '</option>';
                                        }
                                        ?>
                                      </select>
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
                          <div class="modal fade" id="hapus_pegawai_<?php echo $d['id_pegawai'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                  <a href="pegawai_hapus.php?id=<?php echo $d['id_pegawai'] ?>" class="btn btn-primary">Hapus</a>
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
<?php include 'footer.php'; ?>