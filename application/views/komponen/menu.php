  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?=base_url()?>assets/dist/img/photo1.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>SILPG </p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENU</li>       
        <li>
          <a href="<?=site_url('dashboard')?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>

        <li>
          <a href="<?=site_url('Petugas')?>">
            <i class="fa fa-user-md"></i> <span>Petugas</span>
          </a>
        </li>


        <li>
          <a href="<?=site_url('masyarakat')?>">
            <i class="fa fa-users "></i> <span>Masyarakat</span>
          </a>
        </li>

        <li>  
          <a href="<?=site_url('pemilik')?>">
            <i class="fa fa-user "></i> <span>Pemilik</span>
          </a>
        </li>

        <li>
          <a href="<?=site_url('pembelian')?>">
            <i class="fa fa-money "></i> <span>Pembelian</span>
          </a>
        </li>
        
        <li>
          <a href="<?=site_url('pangkalan')?>">
            <i class="fa fa-home "></i> <span>Pangkalan</span>
          </a>
        </li>

        <li>
          <a href="<?=site_url('Akun')?>">
            <i class="fa fa-street-view "></i> <span>Akun</span>
          </a>
        </li>
        </li>
        </ul>
    </section>
    <!-- /.sidebar -->
  </aside>