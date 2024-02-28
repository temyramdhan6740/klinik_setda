 <!-- Content -->
 <div class="main-content container-xxl flex-grow-1 container-p-y">
     <div class="col-md-12">
         <div class="card mb-4">
             <div class="card-header">
                 <div class="row">
                     <div class="col-md-6">
                         <h5>Data Master Dokter</h5>
                     </div>
                     <div class="col-md-6" style="text-align: right;">
                         <button type="button" class="btn rounded-pill btn-primary pull-right" id="btn-tambah">
                             <i class="bx bx-user-plus me-1"></i>
                             Tambah Data
                         </button>
                     </div>
                 </div>
             </div>
             <div class="card-body">
                 <div class="table-responsive text-nowrap">
                     <table class="table table-striped" id="table_data">
                         <thead>
                             <tr>
                                 <th>Nama Dokter</th>
                                 <th>SIP</th>
                                 <th>Aksi</th>
                             </tr>
                         </thead>
                         <tbody>
                         </tbody>
                     </table>
                 </div>
             </div>
         </div>
     </div>
 </div>
 <!-- / Content -->

 <!-- Modal -->
 <div class="modal fade" id="modol" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
     <div class="modal-dialog modal-lg">
         <div class="modal-content">
             <div class="card">
                 <div class="overlayLoading" style="display: none;" id="loadingModal">
                     <div class="spinner-border" role="status" aria-hidden="true">
                         <span class="visually-hidden">Loading...</span>
                     </div>
                 </div>
                 <div class="modal-header">
                     <h5 class="modal-title" id="judul_data"></h5>
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                 </div>
                 <div class="modal-body">
                     <div class="nav-align-top mb-4">
                         <form id="myForm">
                             <div class="mb-3 row">
                                 <label for="html5-text-input" class="col-md-2 col-form-label">Nama Dokter</label>
                                 <div class="col-md-10">
                                     <input class="form-control" type="text" id="nama_dokter" name="nama_dokter" />
                                 </div>
                             </div>
                             <div class="mb-3 row">
                                 <label for="html5-search-input" class="col-md-2 col-form-label">SIP</label>
                                 <div class="col-md-10">
                                     <input class="form-control" type="text" id="sip" name="sip" />
                                 </div>
                             </div>
                         </form>
                     </div>
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                     <input type="hidden" id="id" />
                     <button type="button" class="btn btn-primary" id="btn-insert"
                         style="display: none;">Tambah</button>
                     <button type="button" class="btn btn-primary" id="btn-update" style="display: none;">Edit</button>
                 </div>
             </div>
         </div>
     </div>
 </div>
 </div>