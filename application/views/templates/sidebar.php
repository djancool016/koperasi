
<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar ">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
  <div class="sidebar-brand-icon">
  <img 
    src="<?php echo base_url();?>assets/img/UsmLogo.png" 
    alt=""
    height="40"
    width="36"
    class="logo"/>
    
  </div>
  <div class="sidebar-brand-text ml-2 ">Koperasi USM</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
  <a class="nav-link" href="<?php echo base_url(); ?>dev">
    <i class="fa fa-code"></i>
    <span>Dev Notes</span></a>
</li>
<li class="nav-item active">
  <a class="nav-link" href="<?php echo base_url(); ?>">
    <i class="fa fa-home"></i>
    <span>Dashboard</span></a>
</li>
<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item active">
  <a class="nav-link collapsed" href="<?php echo base_url(); ?>anggota">
    <i class="fa fa-user"></i>
    <span>Anggota</span>
  </a>
</li>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Heading -->
<div class="sidebar-heading mt-3">
    Menu Transaksi
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item active">
  <a class="nav-link collapsed" href="#collapseone" data-toggle="collapse" aria>
    <i class="fa fa-wallet"></i>
    <span>Simpan</span>
  </a>
  <div id="collapseone" class="collapse">
      <div class="bg-white collapse-inner rounded">
          <h6 class="collapse-header">Menu Simpan</h6>
          <a class="collapse-item" href="<?php echo base_url(); ?>simpan">Datar Rekening</a>
          <a class="collapse-item" href="<?php echo base_url(); ?>transimp">Transaksi Simpan</a>
      </div>
  </div>
</li>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item active">
  <a class="nav-link collapsed" href="#collapseTwo" data-toggle="collapse" aria>
    <i class="fa fa-hand-holding-usd"></i>
    <span>Pinjam</span>
  </a>
  <div id="collapseTwo" class="collapse">
      <div class="bg-white collapse-inner rounded">
          <h6 class="collapse-header">Menu Simpan</h6>
          <a class="collapse-item" href="<?php echo base_url(); ?>pinjam">Datar Pinjaman</a>
          <a class="collapse-item" href="<?php echo base_url(); ?>tranangs">Angsuran Pinjaman</a>
      </div>
  </div>
</li>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item active">
  <a class="nav-link collapsed" href="<?php echo base_url(); ?>pengeluaran">
    <i class="fa fa-dollar-sign"></i>
    <span>Pengeluaran</span>
  </a>
</li>

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Heading -->
<div class="sidebar-heading mt-0">
    Menu Pembukuan
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item active">
  <a class="nav-link collapsed" href="#bukukas" data-toggle="collapse" aria>
    <i class="fa fa-hand-holding-usd"></i>
    <span>Buku Kas</span>
  </a>
  <div id="bukukas" class="collapse">
      <div class="bg-white collapse-inner rounded">
          <h6 class="collapse-header">Menu Kas</h6>
          <a class="collapse-item" href="<?php echo base_url(); ?>pinjam">Kas Harian</a>
          <a class="collapse-item" href="<?php echo base_url(); ?>kasmasuk">Kas Masuk</a>
          <a class="collapse-item" href="<?php echo base_url(); ?>tranangs">Kas Keluar</a>
      </div>
  </div>
</li>

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
<button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>



