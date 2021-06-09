
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       <?php echo $title ?>
      </h1>
         <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo base_url('Desa/') ?>">Home</a></li>
            <li class="breadcrumb-item active"><?php echo $title ?></li>
          </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <!-- /.box -->
          <div class="box">
            <div class="box-header">
            <!-- <h3 class="box-title"></h3> -->
            <a href="<?php echo base_url('desa/tambah_desa') ?>"><button type="button" class="btn  btn-outline-primary btn-sm"><i class="fa fa-plus"></i> <?php echo $title ?></button></a>
          </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="datatables" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Desa</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    foreach ($data as $key) :
                    ?>
                      <tr>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo $key->desa ?></td>
                       <td style="text-align: center;">
                          <a href="<?php echo base_url('desa/edit_desa/' . encrypt_url($key->id_desa)) ?>">
                            <button title="Edit Data" class="btn  btn-outline-success btn-sm">
                           <i class="fa fa-edit"></i>
                         </button>
                         </a>
                   <!--      <br>
                      |
                       <br> -->
                        <a id="btn-hapus" onclick="konfirmasi('Apakah anda yakin menghapus data ini ?',<?php echo $key->id_desa ?>);" data-href="<?php echo base_url('desa/hapus_desa?id=') ?>">
                        <button title="Hapus Data" class="btn  btn-outline-danger btn-sm">
                          <i class="fa fa-trash"></i>
                        </button>
                        </a>

                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                <tfoot>
                <tr>
                 <th>No</th>
                  <th>Desa</th>
                  <th>Aksi</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  