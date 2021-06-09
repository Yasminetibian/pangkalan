
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>SI LPG</title>
<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<!-- Bootstrap 3.3.7 -->
<link rel="stylesheet" href="<?=base_url()?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
<!-- Font Awesome -->
<link rel="stylesheet" href="<?=base_url()?>assets/bower_components/font-awesome/css/font-awesome.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="<?=base_url()?>assets/bower_components/Ionicons/css/ionicons.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="<?=base_url()?>assets/dist/css/AdminLTE.min.css">
<!-- iCheck -->
<link rel="stylesheet" href="<?=base_url()?>assets/plugins/iCheck/square/blue.css">


<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<style>
    .swal2-popup {
      font-size: 1.6rem !important;
    }

  </style>

<body class="hold-transition login-page" style="background-color: lightblue; background-image:url(spkraskin/home.jpg);">
<div class="login-box">
    <div class="login-logo">

      
        <!-- <a href="<?=base_url()?>assets/index2.html"><b>Admin</b>LTE</a> -->
    </div>
<!-- /.login-logo -->
<div class="login-box-body">
<!--     <H2 class="login-box-msg"><b>SELAMAT <br><h4>DATANG</h4></b> </H2> -->
   <div class="row" align="center">
        <div class="col-xs-0"></div>
        <h3><a><b>SI PENYERAHAN LPG</b></a></h3>
        <h4><a><b>KECAMATAN KINTAP</b></a></h4>
        <img style="width: 50%;" src="<?php echo base_url() ?>assets/file/Tanah laut.png">
    </div> 
    
   <?= $this->session->flashdata('message'); ?> 

    <form action="<?= base_url('login/proses_login') ?>" method="post">
    <small class=text-danger pl-3"></small>
    <div class="form-group has-feedback">
        <input type="text"  name="username" class="form-control" placeholder="Username" required autofocus>
        
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
    </div>

    <small class=text-danger pl-3"></small>
    <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" placeholder="Password" required>
       <small class="text-danger pl-3"></small>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
    </div>

    <div class="row">
        <div class="col-xs-12"></div>
        <div class="col-xs-12">
            <button type="submit" name="login" id="tombol" class="btn btn-primary btn-block btn-flat"> Login </button>  
        </div>
        <br> 
        </br>
       
     <div class="text-center">
            <a href="<?= base_url('admin/lupa_password'); ?>" class="text-center">Lupa Password</a><br>
          <a href="<?= base_url('login/register'); ?>" class="text-center">Register Member Baru</a>

     </div>

</form>
    

</div>

</div>
<script src="<?php echo base_url() ?>assets/sweet/sweetalert2.all.min.js"></script>
    <script src="<?php echo base_url() ?>assets/sweet/sweetalert2.min.css"></script>

    <script>
        <?php
        $status = $this->session->flashdata('status');
        if ($status) : ?>
            Swal.fire({
                icon: '<?php echo $status['type'] ?>',
                title: 'Status',
                text: '<?php echo $status['message'] ?>',
            })
        <?php endif; ?>
    </script>
</body>
</html>
