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
            <div class="box-body">
            <form role="form" autocomplete="off" method="POST" action="<?php echo base_url('pembelian/proses_edit_pembelian') ?>" enctype="multipart/form-data">
              <div class="form-group">
                      <label for="alamat">Pangkalan</label>
                      <select name="id_pangkalan" class="form-control" style="width: 100%;">
                        <option selected="selected">--Pilih Pangkalan--</option>
                        <?php foreach ($pangkalan as $key) : ?>
                          <option value="<?php echo $key->id_pangkalan ?>"><?php echo $key->nama_pangkalan ?></option>
                        <?php endforeach; ?>
                      </select>
                </div>
                <div class="form-group">
                      <label for="alamat">No KK</label>
                      <select name="no_kk" class="form-control" style="width: 100%;">
                        <option selected="selected">--Pilih No KK--</option>
                        <?php foreach ($masyarakat as $key) : ?>
                          <option value="<?php echo $key->no_kk ?>"><?php echo $key->no_kk ?></option>
                        <?php endforeach; ?>
                      </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Tanggal pembelian</label>
                  <input type="date" value="<?php echo $data->tgl_pembelian ?>" name="tgl_pembelian" class="form-control" id="exampleInputPassword1" placeholder="Tanggal pembelian" required="">

                  <input type="hidden" value="<?php echo $data->id_pembelian ?>" name="id_pembelian" class="form-control" id="exampleInputPassword1" placeholder="" required="">  
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