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
                     <label for="html5-text-input" class="col-md-2 col-form-label">HIS Pasien</label>
                     <div class="col-md-6">
                         <input class="form-control" type="text" id="his" />
                     </div>
                     <div class="col-md-2">
                         <button type="button" class="btn rounded-pill btn-primary" id="cari_subject">
                             <i class="bx bx-search me-1"></i>
                         </button>
                     </div>
                 </div>
                 <table class="table table-striped" id="table_subject">
                     <thead>
                         <tr>
                             <th>Organisasi ID</th>
                             <th>Encounter ID</th>
                             <th>Nama Doktor</th>
                             <th>Diagnosa</th>
                         </tr>
                     </thead>
                     <tbody>

                     </tbody>
                 </table>



             </div>
         </div>
     </div>
 </div>
 <!-- / Content -->
 <div class="modal fade" id="modal-detail" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
     <div class="modal-dialog modal-lg">
         <div class="modal-content">
             <div class="modal-header">
                 <input type="text" id="condition_id" class="form-control" readonly>
             </div>
             <div class="modal-body">
                 <div class="mb-3 row">
                     <label for="html5-search-input" class="col-md-2 col-form-label">Diagnosa</label>
                     <div class="col-md-10">
                         <textarea class="form-control" rows="5" id="condition"></textarea>
                     </div>
                 </div>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

             </div>
         </div>
     </div>
 </div>