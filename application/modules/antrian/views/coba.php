 <!-- Content -->
 <div class="main-content container-xxl flex-grow-1 container-p-y">
     <div class="col-md-12">
         <div class="card mb-4">
             <div class="card-header">
                 <div class="row">
                     <div class="col-md-6">
                         <h5>Coba</h5>
                     </div>
                     <!-- <div class="col-md-6" style="text-align: right;">
                         <button type="button" class="btn rounded-pill btn-primary pull-right" id="tambahAntrian">
                             <i class="bx bx-user-plus me-1"></i>
                             Tambah Antrian
                         </button>
                     </div> -->
                 </div>
             </div>
             <div class="card-body">
                 <!-- pasien lama -->
                 <div class="mb-3 row">
                     <label for="html5-text-input" class="col-md-2 col-form-label">NIK Pasien</label>
                     <div class="col-md-6">
                         <input class="form-control" type="text" id="nik" />
                     </div>
                     <div class="col-md-2">
                         <button type="button" class="btn rounded-pill btn-primary" id="cari_rm_lama">
                             <i class="bx bx-search me-1"></i>
                         </button>
                     </div>
                 </div>
                 <div class="mb-3 row">
                     <label for="html5-search-input" class="col-md-2 col-form-label">Dokter</label>
                     <div class="col-md-10">
                         <select class="form-select" id="dokter">
                             <option value="" selected>-- Pilih --</option>
                             <?php
                                if (isset($dokter)) {
                                    foreach ($dokter as $dokter) {
                                        echo "<option value= '" . $dokter['idhis'] . "' >" . $dokter['nama'] . "</option>";
                                    }
                                }
                                ?>
                         </select>
                     </div>
                 </div>
                 <div class="mb-3 row">
                     <label for="html5-search-input" class="col-md-2 col-form-label">Lokasi</label>
                     <div class="col-md-10">
                         <select class="form-select" id="dokter">
                             <option value="" selected>-- Pilih --</option>
                             <?php
                                if (isset($lokasi)) {
                                    foreach ($lokasi as $lokasi) {
                                        echo "<option value= '" . $lokasi['idhis'] . "' >" . $lokasi['nama'] . "</option>";
                                    }
                                }
                                ?>
                         </select>
                     </div>
                 </div>
                 <div class="mb-3 row">
                     <label for="html5-search-input" class="col-md-2 col-form-label">Arrived</label>
                     <div class="col-md-10">
                         <input class="form-control" type="date" id="arrived" />
                     </div>
                 </div>


             </div>
         </div>
     </div>
 </div>
 <!-- / Content -->