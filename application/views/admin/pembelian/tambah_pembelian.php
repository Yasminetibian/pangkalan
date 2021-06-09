  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       <?php echo $title ?>
      </h1>
         <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo base_url('Dashboard/') ?>">Home</a></li>
            <li class="breadcrumb-item active"><?php echo $title ?></li>
          </ol>
    </section>

    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo $title ?></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" autocomplete="off" method="POST" action="<?php echo base_url('pembelian/proses_tambah_pembelian') ?>" enctype="multipart/form-data">
              <div class="box-body">
               <div class="form-group">
                  <label for="id">ID</label>
                  <input type="" name="id" class="form-control" id="id" placeholder="" required=""> <br>
                  <input type="button" value="Cek" style="" class="btn btn-primary" 
                  onclick="isi_otomatis()">
                  
                  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.3/jquery.mis.js" type="text/javascript"></script>

                  <script type="text/javascript">
                    function isi_otomatis() {
                      var id = document.getElementById('id').value;
                      //var id = document;
                        
                        $.ajax({
                          type  :'POST',
                          url:'<?php echo base_url('Welcome/ambil_data1')?>',
                          data:"id="+id,
                        }).success(function(data){
                          obj=data;
                          $('#id').val(obj.id);
                          $('#no_kk').val(obj.no_kk);
                          $('#nama_kepala').val(obj.nama_kepala);
                       });
                    }

                  </script>
                </div>
                <div class="form-group">
                  <label for="id">Nomor Kartu Keluarga</label>
                  <input type="number" name="no_kk" class="form-control" id="no_kk" placeholder="Nomor Kartu Keluarga" required="" readonly=" ">
                </div>
                <div class="form-group">
                  <label for="id">Nama Kepala Keluarga</label>
                  <input type="text" name="nama_kepala" class="form-control" id="nama_kepala" placeholder="Nama Kepala Keluarga " required="" readonly=" ">
                </div>
              <div class="form-group">
                      <label for="alamat">Nama Pangkalan</label>
                      <select name="id_pangkalan" class="form-control" style="width: 100%;">
                        <option selected="selected">--Pilih Pangkalan--</option>
                        <?php foreach ($pangkalan as $key) : ?>
                          <option value="<?php echo $key->id_pangkalan ?>"><?php echo $key->nama_pangkalan ?></option>
                        <?php endforeach; ?>
                      </select>
                </div>
                <div class="form-group">
                  <label for="id">Tanggal pembelian</label>
                  <input type="date" name="tgl_pembelian" class="form-control" id="tgl_pembelian" placeholder="Tanggal pembelian" required="">
                </div>
                <div class="form-group">
                  <label for="id">Jumlah Tabung</label>
                  <input type="number" name="jum_tabung" class="form-control" id="jum_tabung" placeholder="Jumlah Tabung" required="">
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
          <!-- /.box -->
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>