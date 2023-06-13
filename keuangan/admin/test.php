<?php
require '../koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="GET" action="">
        <p>
            <label>Jenis Transaksi</label>
            <select id="id_transaksiJenis" style="width: 200px" name="id_transaksiJenis" class="form-control" onchange="tampil_data_dropdowntertentu()" autocomplete="off">
            <option value="">--PILIH--</option>
            <?php
                $list = $this->db->query("SELECT * FROM transaksi_jenis ORDER BY id ASC");
                foreach($list->result() as $t){
                ?>
                  <option value="<?php echo $t->id ?>"><?php echo $t->nama_transaksi ?></option>
                  <?php } ?>
            </select>
           </td></tr>
            
            <tr><td>Kota</td><td>
              <select id="id_kota" style="width: 200px" name="id_kota" class="form-control" autocomplete="off">
            <option value="">--PILIH--</option>
            </select>
           </td></tr>
           <script type="text/javascript">
            function tampil_data_dropdowntertentu(){
            var id_provinsi = $("#id_provinsi").val();
            $.ajax({
             url:"<?php echo base_url() ?>index.php/saldo_awal/filter_data_todropdon",
                data:"id_provinsi="+id_provinsi,
                success: function(html)
                {            
              $('#id_kota').html(html);
                }
        });

    }
</script>
        </p>
    </form>
</body>
</html>