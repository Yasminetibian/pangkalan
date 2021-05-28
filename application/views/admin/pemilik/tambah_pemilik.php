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
            <form role="form" autocomplete="off" method="POST" action="<?php echo base_url('pemilik/proses_tambah_pemilik') ?>" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Nama Pemilik</label>
                  <input type="text" name="nama_pemilik" class="form-control"  placeholder="Nama Pemilik" required="">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Alamat Pemilik</label>
                  <input type="text" name="alamat_pemilik" class="form-control" id="exampleInputPassword1" placeholder="Alamat Pemilik" required="">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">No Telepon Pemilik</label>
                  <input type="number" name="no_telp_pemilik" class="form-control" id="exampleInputPassword1" placeholder="No Telepon Pemilik" required="">
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