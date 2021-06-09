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
            <!-- <a href="<?php echo base_url('pangkalan/tambah_pangkalan') ?>"><button type="button" class="btn  btn-outline-primary btn-sm"><i class="fa fa-plus"></i> <?php echo $title ?></button></a> -->
          </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="datatables" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Nama pangkalan</th>
                  <th>Nama Pemilik</th>
                  <th>Username</th>
                  <th>Alamat pangkalan</th>
                  <th>Desa</th>
                  <th>No Telp Pangkalan</th>
                  <th>Penangung Jawab</th>
                </tr>
                </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    foreach ($data1 as $dt) :
                    ?>
                      <tr>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo $dt['nama_pangkalan']; ?></td>
                        <td><?php echo $dt['nama_pemilik']; ?></td>
                        <td><?php echo $dt['username']; ?></td>
                        <td><?php echo $dt['alamat_pangkalan']; ?></td>
                        <td><?php echo $dt['desa']; ?></td>
                        <td><?php echo $dt['no_telp_pangkalan']; ?></td>
                        <td><?php echo $dt['penangung_jawab'];?></td>
                       <td style="text-align: center;">
                          <!-- <a href="<?php echo base_url('pangkalan/edit_pangkalan/' . encrypt_url($key->id_pangkalan)) ?>">
                            <button title="Edit Data" class="btn  btn-outline-success btn-sm">
                           <i class="fa fa-edit"></i>
                         </button>
                         </a> -->
                   <!--      <br>
                      |
                       <br> -->
                        <!-- <a id="btn-hapus" onclick="konfirmasi('Apakah anda yakin menghapus data ini ?',<?php echo $key->id_pangkalan ?>);" data-href="<?php echo base_url('pangkalan/hapus_pangkalan?id=') ?>">
                        <button title="Hapus Data" class="btn  btn-outline-danger btn-sm">
                          <i class="fa fa-trash"></i>
                        </button>
                        </a> -->

                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                <tfoot>
                <tr>
                  <th>No</th>
                  <th>Nama pangkalan</th>
                  <th>Pemilik</th>
                  <th>Username</th>
                  <th>Alamat pangkalan</th>
                  <th>Desa</th>
                  <th>No Telp Pangkalan</th>
                  <th>Penangung Jawab</th>

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
  