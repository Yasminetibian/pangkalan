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
            <form role="form" autocomplete="off" method="POST" action="<?php echo base_url('pangkalan/proses_tambah_pangkalan') ?>" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Nama pangkalan</label>
                  <input type="text" name="nama_pangkalan" class="form-control"  placeholder="Nama pangkalan" required="">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Alamat pangkalan</label>
                  <input type="text" name="alamat_pangkalan" class="form-control" id="exampleInputPassword1" placeholder="Alamat pangkalan" required="">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">No Telepon pangkalan</label>
                  <input type="number" name="no_telp_pangkalan" class="form-control" id="exampleInputPassword1" placeholder="No Telepon pangkalan" required="">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Penangung Jawab</label>
                  <input type="text" name="penangung_jawab" class="form-control"  placeholder="Penangung Jawab" required="">
                </div>
                <div class="form-group">
                      <label for="alamat">Desa</label>
                      <select name="id_desa" class="form-control" style="width: 100%;">
                        <option selected="selected">--Pilih Desa--</option>
                        <?php foreach ($desa as $key) : ?>
                          <option value="<?php echo $key->id_desa ?>"><?php echo $key->desa ?></option>
                        <?php endforeach; ?>
                      </select>
                </div>
                <div class="form-group">
                      <label for="alamat">Username</label>
                      <select name="id_akun" class="form-control" style="width: 100%;">
                        <option selected="selected">--Pilih Username--</option>
                        <?php foreach ($akun as $key) : ?>
                          <option value="<?php echo $key->id_akun ?>"><?php echo $key->username ?></option>
                        <?php endforeach; ?>
                      </select>
                </div>
                <div class="form-group">
                      <label for="alamat">Pemilik</label>
                      <select name="id_pemilik" class="form-control" style="width: 100%;">
                        <option selected="selected">--Pilih Pemilik--</option>
                        <?php foreach ($pemilik as $key) : ?>
                          <option value="<?php echo $key->id_pemilik ?>"><?php echo $key->nama_pemilik ?></option>
                        <?php endforeach; ?>
                      </select>
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