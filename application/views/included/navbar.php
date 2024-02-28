 <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme" data-bg-class="bg-menu-theme"
     style="touch-action: none; user-select: none; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
     <div class="app-brand demo ">
         <a href="#" class="app-brand-link">
             <span class="app-brand-logo demo text-center">
                 <img src="<?= base_url('assets/img/logo_rekamedis_white.png') ?>" alt="" width="13%">
             </span>
             <span class="app-brand-text demo menu-text fw-bolder ms-2">Sneat</span>
         </a>

         <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
             <i class="bx bx-chevron-left bx-sm align-middle"></i>
         </a>
     </div>

     <div class="menu-inner-shadow"></div>



     <ul class="menu-inner py-1 ps ps--active-y">
         <!-- Antrian -->
         <li class="menu-item active open">
             <a href="javascript:void(0);" class="menu-link menu-toggle">
                 <i class="menu-icon tf-icons bx bx-home-circle"></i>
                 <div data-i18n="Dashboards">Antrian</div>
             </a>
             <ul class="menu-sub">
                 <li class="menu-item" id="menu_list_antrian">
                     <a href="<?= base_url('list_antrian') ?>" class="menu-link">
                         <div data-i18n="Analytics">List Antrian</div>
                     </a>
                 </li>
                 <li class="menu-item">
                     <a href="<?= base_url('umum') ?>" class="menu-link">
                         <div data-i18n="CRM">SOAP POLI UMUM</div>
                     </a>
                 </li>
                 <li class="menu-item">
                     <a href="<?= base_url('gigi') ?>" class="menu-link">
                         <div data-i18n="CRM">SOAP POLI GIGI</div>
                     </a>
                 </li>
             </ul>
         </li>

         <?php if ($_SESSION['role'] == 'admin') { ?>
         <!-- Components -->
         <li class="menu-header small text-uppercase"><span class="menu-header-text">Master menu</span></li>
         <!-- Cards -->
         <li class="menu-item">
             <a href="javascript:void(0);" class="menu-link menu-toggle">
                 <i class="menu-icon tf-icons bx bx-collection"></i>
                 <div data-i18n="Cards">Master Data</div>
             </a>
             <ul class="menu-sub">
                 <li class="menu-item">
                     <a href="<?= base_url('masters/pasien') ?>" class="menu-link">
                         <div data-i18n="Basic">Data Pasien</div>
                     </a>
                 </li>
                 <li class="menu-item">
                     <a href="<?= base_url('masters/dokter') ?>" class="menu-link">
                         <div data-i18n="Advance">Data Dokter</div>
                     </a>
                 </li>
                 <li class="menu-item">
                     <a href="<?= base_url('masters/user') ?>" class="menu-link">
                         <div data-i18n="Statistics">Data User</div>
                     </a>
                 </li>
             </ul>
         </li>

         <?php } ?>

         <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
             <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
         </div>
         <div class="ps__rail-y" style="top: 0px; height: 792px; right: 4px;">
             <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 406px;"></div>
         </div>
     </ul>
 </aside>