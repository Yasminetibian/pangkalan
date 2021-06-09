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
            <form role="form" autocomplete="off" method="POST" action="<?php echo base_url('masyarakat/proses_edit_masyarakat') ?>" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">No KK</label>
                  <input type="text" value="<?php echo $data->no_kk ?>"name="no_kk_lama" class="form-control"  placeholder="No KK" required="">
                  <input type="hidden" value="<?php echo $data->no_kk ?>"name="no_kk" class="form-control"  placeholder="No KK" required="">
                 
                </div>
                <div class="form-group">
                      <label for="alamat">Desa</label>
                      <select name="id_desa" class="form-control" style="width: 100%;">
                        <option selected="selected">--Pilih Desa--</option>
                        <?php foreach ($desa as $key) : ?>
                          <option value="<?php echo $key->id_desa ?>"<?=$key->id_desa == $key->id_desa ? "selected" : null ?>><?php echo $key->desa ?></option>
                        <?php endforeach; ?>
                      </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Alamat</label>
                  <input type="text" value="<?php echo $data->alamat ?>" name="alamat" class="form-control"  placeholder="Alamat" required="">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">RT</label>
                  <input type="text" name="rt" value="<?php echo $data->rt ?>" class="form-control"  placeholder="RT" required="">
                </div>
           
                <div class="form-group">
                  <label for="exampleInputEmail1">Nama kepala</label>
                  <input type="text" value="<?php echo $data->nama_kepala ?>" name="nama_kepala" class="form-control"  placeholder="Nama Kepala" required="">
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