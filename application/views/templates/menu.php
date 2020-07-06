<ul class="sidebar-menu">
     <?php
     if($this->user->cekadministrator()):
     ?>
     <li class="nav-item dropdown <?php echo ($active == 'dashboard'?'active':''); ?>">
          <a href="<?php echo base_url('dashboard');?>" class="nav-link"><i class="fas fa-desktop"></i><span>Beranda</span></a>
     </li>
     <li class="menu-header">Master Data</li>
     <li class="<?php echo ($active == 'karyawan'?'active':''); ?>">
          <a class="nav-link" href="<?php echo base_url('karyawan');?>">
               <i class="fas fa-user-tie"></i> <span>Karyawan</span>
          </a>
     </li>
     <?php endif;?>
     <li class="menu-header">Transaksi</li>
     <li class="<?php echo ($active == 'tugas'?'active':''); ?>">
          <a class="nav-link" href="<?php echo base_url('tugas'); ?>">
               <i class="fas fa-clipboard-list"></i> <span>Tugas</span>
          </a>
     </li>
</ul>