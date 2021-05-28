
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

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <!-- /.box -->
          <div class="box">
            <div class="box-header">
            <!-- <h3 class="box-title"></h3> -->
            <a href="<?php echo base_url('masyarakat/tambah_masyarakat') ?>"><button type="button" class="btn  btn-outline-primary btn-sm"><i class="fa fa-plus"></i> <?php echo $title ?></button></a>
          </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="datatables" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Kepala Keluarga</th>
                  <th>Username</th>
                  <th>No KK</th>
                  <th>Alamat</th>
                  <th>Desa</th>
                  <th>Rt</th>                   
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
                        <td><?php echo $key->nama_kepala ?></td>
                        <td><?php echo $key->username ?></td>
                        <td><?php echo $key->no_kk ?></td>
                        <td><?php echo $key->alamat ?></td>
                        <td><?php echo $key->desa ?></td>  
                        <td><?php echo $key->rt ?></td>                   
                       <td style="text-align: center;">
                          <a href="<?php echo base_url('cetak/index/' . encrypt_url($key->no_kk)) ?>">
                            <button title="Cetak" class="btn  btn-outline-success btn-sm">
                           <i class="fa fa-print"></i>
                         </button>
                         </a>
                          <a href="<?php echo base_url('masyarakat/edit_masyarakat/' . encrypt_url($key->no_kk)) ?>">
                            <button title="Edit Data" class="btn  btn-outline-success btn-sm">
                           <i class="fa fa-edit"></i>
                         </button>
                         </a>
                   <!--      <br>
                      |
                       <br> -->
                        <a id="btn-hapus" onclick="konfirmasi('Apakah anda yakin menghapus data ini ?',<?php echo $key->no_kk ?>);" data-href="<?php echo base_url('pemilik/hapus_pemilik?id=') ?>">
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
                  <th>Nama Kepala Keluarga</th>
                  <th>Username</th>
                  <th>No KK</th>
                  <th>Alamat</th>
                  <th>Desa</th>
                  <th>Rt</th>                   
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
