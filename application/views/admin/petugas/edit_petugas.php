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
            <form role="form" autocomplete="off" method="POST" action="<?php echo base_url('petugas/proses_edit_petugas') ?>" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Nama Petugas</label>
                  <input type="text" value="<?php echo $data->nama_petugas ?>" name="nama_petugas" class="form-control"  placeholder="Nama Petugas" required="">
                  <input type="hidden" value="<?php echo $data->id_petugas ?>" name="id_petugas" class="form-control" required="">
                  <input type="hidden" value="<?php echo $data->id_akun ?>" name="id_akun" class="form-control" required="">
                </div>
                 <div class="form-group">
                  <label for="exampleInputEmail1">Username</label>
                  <input type="text" value="<?php echo $data->username ?>" name="username" class="form-control"  placeholder="Username" required="">
                </div>
                 <div class="form-group">
                  <label for="exampleInputEmail1">Password</label>
                  <input type="text" value="<?php echo $data->password ?>" name="password" class="form-control"  placeholder="Password" required="">
                </div>
                <div class="form-group">
                      <label>Desa</label>
                      <select name="id_desa" class="form-control" style="width: 100%;">
                        <option selected="selected">--Pilih Desa--</option>
                        <?php foreach ($desa as $key) : ?>
                          <option value="<?php echo $key->id_desa ?>"><?php echo $key->desa ?></option>
                        <?php endforeach; ?>
                      </select>
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