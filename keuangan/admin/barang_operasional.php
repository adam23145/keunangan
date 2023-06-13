<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
    Data Operasional
      <small>Data Operasional</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Data Operasional</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <section class="col-lg-12">
        <div class="box box-info">

          <div class="box-header">
            <h3 class="box-title">Data Operasional</h3>
            <div class="btn-group pull-right">            

              <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#exampleModal">
                <i class="fa fa-plus"></i> &nbsp Tambah Data Operasional
              </button>
            </div>
          </div>
          <div class="box-body">

            <!-- Modal -->
            <form action="barang_operasional_act.php" method="post">
              <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Tambah Barang</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">

                      <div class="form-group">
                        <label>Nama Data Operasional</label>
                        <input type="text" name="nama_barang" required="required" class="form-control" placeholder="Nama Barang ..">
                      </div>
                      <div class="form-group" style="width:100%">
                      <label>Jenis Data Operasional</label>
                      <select name="jenis_operasional" class="form-control">
                         <option value="">-- Pilih --</option>
                        <?php
                                      // Query the database using a prepared statement
                         $stmt = $koneksi->prepare("SELECT id_jenis_operasional, nama_jenis FROM jenis_operasional");
                          $stmt->execute();
                             $result = $stmt->get_result();
                            // Loop through the result set and populate the drop-down list
                              while ($row = $result->fetch_assoc()) {
                              echo '<option value="' . $row['id_jenis_operasional'] . '">' . $row['nama_jenis'] . '</option>';
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
                    <th>NAMA DATA OPERASIONAL</th>
                    <th>JENIS DATA OPERASIONAL</th>
                    <th width="20%">OPSI</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  include '../koneksi.php';
                  $no=1;
                  $data = mysqli_query($koneksi,"SELECT *
                  FROM barang_operasional
                  JOIN jenis_operasional ON barang_operasional.jenis_operasional = jenis_operasional.id_jenis_operasional
                  ORDER BY jenis_operasional");
                  while($d = mysqli_fetch_array($data)){
                    ?>
                    <tr>
                      <td><?php echo $no++; ?></td>
                      <td><?php echo $d['nama_barang']; ?></td>
                      <td><?php echo $d['nama_jenis']; ?></td>
                      <td> <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit_barang_<?php echo $d['id_barang'] ?>">
                            <i class="fa fa-cog"></i>
                          </button>

                          <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus_barang_<?php echo $d['id_barang'] ?>">
                            <i class="fa fa-trash"></i>
                          </button>

                        <form action="barang_operasional_update.php" method="post">
                          <div class="modal fade" id="edit_barang_<?php echo $d['id_barang'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Edit Barang</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">

                                  <div class="form-group" style="width:100%">
                                    <label>Nama DATA OPERASIONAL</label>
                                    <input type="hidden" name="id_barang" required="required" class="form-control" placeholder="Nama Barang .." value="<?php echo $d['id_barang']; ?>">
                                    <input type="text" name="nama_barang" required="required" class="form-control" placeholder="Nama Barang .." value="<?php echo $d['nama_barang']; ?>" style="width:100%">
                                  </div>
                                  <div class="form-group" style="width:100%">
                                    <label>Jenis DATA OPERASIONAL</label>
                                    <select name="jenis_operasional" class="form-control">
                                      <option value="">-- Pilih --</option>
                                      <?php
                                      // Query the database using a prepared statement
                                      $stmt = $koneksi->prepare("SELECT id_jenis_operasional, nama_jenis FROM jenis_operasional");
                                      $stmt->execute();
                                      $result = $stmt->get_result();

                                      // Loop through the result set and populate the drop-down list
                                      while ($row = $result->fetch_assoc()) {
                                        echo '<option value="' . $row['id_jenis_operasional'] . '">' . $row['nama_jenis'] . '</option>';
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
                        <div class="modal fade" id="hapus_barang_<?php echo $d['id_barang'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                <a href="divisi_hapus.php?id=<?php echo $d['id_barang'] ?>" class="btn btn-primary">Hapus</a>
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