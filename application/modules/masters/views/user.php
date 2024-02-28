 <!-- Content -->
 <div class="main-content container-xxl flex-grow-1 container-p-y">
     <div class="col-md-12">
         <div class="card mb-4">
             <div class="card-header">
                 <div class="row">
                     <div class="col-md-6">
                         <h5>Data Master User</h5>
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
                                 <th>Username</th>
                                 <th>Nama</th>
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
                     <form id="myForm">
                         <div class="mb-3">
                             <label for="username" class="form-label">Username</label>
                             <input type="text" class="form-control" id="username" name="username"
                                 placeholder="username" />
                         </div>
                         <div class="mb-3">
                             <label for="password" class="form-label">Nama</label>
                             <input class="form-control" type="text" id="nama" name="nama" placeholder="Nama" />
                         </div>
                         <div class="mb-3">
                             <label for="password" class="form-label">Kode Dokter</label>
                             <input class="form-control" type="text" id="kode_dokter" name="kode_dokter"
                                 placeholder="Kode dokter" />
                         </div>
                         <div class="mb-3" id="ganti" style="display: none;">
                             <input class="form-check-input" type="checkbox" value="" id="ganti_pass">
                             <label class="form-check-label" for="ganti_pass">
                                 Ganti Password
                             </label>
                         </div>
                         <div class="mb-3" id="display_pass">
                             <label for="password" class="form-label">Password</label>
                             <input class="form-control" type="password" id="password" name="password"
                                 placeholder="Password" />
                         </div>
                         <div class="mb-3" id="display_repass">
                             <label for="password" class="form-label">Re-Password</label>
                             <input class="form-control" type="password" id="re_password" placeholder="Re-Password" />
                         </div>
                     </form>
                 </div>
                 <div class="modal-footer">
                     <input type="hidden" id="id">
                     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                     <button type="button" class="btn rounded-pill btn-info" id="btn-insert">Register</button>
                     <button type="button" class="btn rounded-pill btn-info" id="btn-update">Update</button>
                 </div>
             </div>
         </div>
     </div>
 </div>
 </div>