 <!-- Sidebar -->
 <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

     <!-- Sidebar - Brand -->
     <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
         <div class="sidebar-brand-icon">
             <i class="fab fa-kickstarter"></i>
         </div>
         <div class="sidebar-brand-text mx-3">Kas Kelas Siswa</div>
     </a>
     <!-- Divider -->
     <hr class="sidebar-divider my-0">

     <!-- Nav Item - Dashboard -->
     <li class="nav-item active">
         <a class="nav-link" href="<?= base_url("/") ?>">
             <i class="fas fa-fw fa-tachometer-alt"></i>
             <span>Dashboard</span></a>
     </li>

     <!-- Divider -->
     <hr class="sidebar-divider">

     <!-- Heading -->
     <div class="sidebar-heading">
         Menu
     </div>
     <!-- nav item pengguna -->
     <?php if ($user['pengguna'] == 1) {?>
     <li class="nav-item">
         <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
             <i class="fas fa-fw fa-user-circle"></i>
             <span>Pengguna</span>
         </a>
         <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
             <div class="bg-white py-2 collapse-inner rounded">
                 <h6 class="collapse-header">Pengguna :</h6>
                 <a class="collapse-item" href="<?= base_url('pengguna/sekretaris') ?>">Data Sekretaris</a>
                 <a class="collapse-item" href="<?= base_url('pengguna/siswa') ?>">Data Siswa</a>
             </div>
         </div>
     </li>
    <?php } if ($user['data_kas'] == 1){?>
     <!-- nav item kas -->
     <li class="nav-item">
         <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
             <i class="fas fa-fw fa-wallet"></i>
             <span>Data Kas</span>
         </a>
         <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
             <div class="bg-white py-2 collapse-inner rounded">
                 <h6 class="collapse-header">Kas Kelas :</h6>
                 <a class="collapse-item" href="<?= base_url('balance/income');?>">Pendapatan Kas</a>
                 <a class="collapse-item" href="<?= base_url('balance/expense');?>">Pengeluaran Kas</a>
                 <a class="collapse-item" href="<?= base_url('balance/type');?>">Jenis Pendapatan Kas</a>
                 <a class="collapse-item" href="<?= base_url('balance/category');?>">Kategori Pengeluaran Kas</a>
             </div>
         </div>
     </li>
    <?php } if ($user['laporan'] == 1){?>
     <!-- nav item Kas -->
     <li class="nav-item">
         <a class="nav-link" href="<?= base_url('balance') ?>">
             <i class="fas fas-fw fa-file-alt"></i>
             <span>Laporan</span></a>
     </li>
    <?php }?>
     <!-- Divider -->

     <li class="nav-item">
         <a class="nav-link" href="<?= base_url('auth/logout') ?>" data-toggle="modal" data-target="#logoutModal">
             <i class="fas fas-fw fa-sign-out-alt"></i>
             <span>Logout</span>
         </a>
     </li>

     <!-- Divider -->
     <hr class="sidebar-divider d-none d-md-block">

     <!-- Sidebar Toggler (Sidebar) -->
     <div class="text-center d-none d-md-inline">
         <button class="rounded-circle border-0" id="sidebarToggle"></button>
     </div>

 </ul>
 <!-- End of Sidebar -->