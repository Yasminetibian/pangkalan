
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
            
            <!-- /.box-header -->
            <div class="box-body">
              <table id="datatables" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>ID Kartu Pengenal</th>
                  <th>Nama Kepala Keluarga</th>
                  <th>No KK</th>                   
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
                        <td><?php echo $key->id_barcode ?></td>
                        <td><?php echo $key->nama_kepala ?></td>
                        <td><?php echo $key->no_kk ?></td> 
                                         
                       <td style="text-align: center;">
                          <a href="<?php echo base_url('masyarakat/detail_masyarakat/' . encrypt_url($key->no_kk)) ?>">
                            <button title="Detail Data" class="btn  btn-outline-success btn-sm">
                           <i class="fa fa-eye"></i>
                         </button>
                         </a>

                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                <tfoot>
                <tr>
                 <th>No</th>
                 <th>ID Kartu Pengenal</th>
                  <th>Nama Kepala Keluarga</th>
                  <th>No KK</th>                  
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
