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
                                 <th>No RM.</th>
                                 <th>Nama</th>
                                 <th>Jenis Kelamin</th>
                                 <th>Biro</th>
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
                 <div class="card-body">
                     <div class="modal-header">
                         <h5 class="modal-title" id="judul_data"></h5>
                         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                     </div>
                     <div class="modal-body">
                         <div class="nav-align-top mb-4">
                             <form id="myForm">
                                 <div class="mb-3 row">
                                     <label for="html5-text-input" class="col-md-2 col-form-label">No RM</label>
                                     <div class="col-md-6">
                                         <input class="form-control" type="text" id="no_rm" name="no_rm" />
                                     </div>
                                     <div class="col-md-4">
                                         <button type="button" class="btn btn-primary"
                                             id="btn_generate">Generate</button>
                                     </div>
                                 </div>
                                 <div class="mb-3 row">
                                     <label for="html5-search-input" class="col-md-2 col-form-label">No KTP</label>
                                     <div class="col-md-10">
                                         <input class="form-control" type="text" id="no_ktp" name="no_ktp" />
                                     </div>
                                 </div>
                                 <div class="mb-3 row">
                                     <label for="html5-search-input" class="col-md-2 col-form-label">No BPJS</label>
                                     <div class="col-md-10">
                                         <input class="form-control" type="text" id="no_bpjs" name="no_bpjs" />
                                     </div>
                                 </div>
                                 <div class="mb-3 row">
                                     <label for="html5-search-input" class="col-md-2 col-form-label">Nama</label>
                                     <div class="col-md-10">
                                         <input class="form-control" type="text" id="nama_pasien" name="nama_pasien" />
                                     </div>
                                 </div>
                                 <div class="mb-3 row">
                                     <label for="html5-search-input" class="col-md-2 col-form-label">Status
                                         Pegawai</label>
                                     <div class="col-md-10">
                                         <input class="form-control" type="text" id="status" name="status" />
                                     </div>
                                 </div>
                                 <div class="mb-3 row">
                                     <label for="html5-search-input" class="col-md-2 col-form-label">Bagian /
                                         Biro</label>
                                     <div class="col-md-10">
                                         <input class="form-control" type="text" id="biro" name="biro" />
                                     </div>
                                 </div>
                                 <div class="mb-3 row">
                                     <label for="html5-search-input" class="col-md-2 col-form-label">Status
                                         Menikah</label>
                                     <div class="col-md-10">
                                         <input class="form-control" type="text" id="status_menikah"
                                             name="status_menikah" />
                                     </div>
                                 </div>
                                 <div class="mb-3 row">
                                     <label for="html5-search-input" class="col-md-2 col-form-label">Tempat
                                         Lahir</label>
                                     <div class="col-md-10">
                                         <input class="form-control" type="text" id="tempat_lahir"
                                             name="tempat_lahir" />
                                     </div>
                                 </div>
                                 <div class="mb-3 row">
                                     <label for="html5-search-input" class="col-md-2 col-form-label">Tanggal
                                         Lahir</label>
                                     <div class="col-md-10">
                                         <input class="form-control" type="date" id="tanggal_lahir"
                                             name="tanggal_lahir" />
                                     </div>
                                 </div>
                                 <div class="mb-3 row">
                                     <label for="html5-search-input" class="col-md-2 col-form-label">Jenis
                                         Kelamin</label>
                                     <div class="col-md-10">
                                         <select class="form-select" id="jenis_kelamin" name="jenis_kelamin">
                                             <option value="" selected>-- Pilih --</option>
                                             <option value="L">Laki - laki</option>
                                             <option value="P">Perempuan</option>
                                         </select>
                                     </div>
                                 </div>
                                 <div class="mb-3 row">
                                     <label for="html5-search-input" class="col-md-2 col-form-label">Agama</label>
                                     <div class="col-md-10">
                                         <input class="form-control" type="text" id="agama" name="agama" />
                                     </div>
                                 </div>
                                 <div class="mb-3 row">
                                     <label for="html5-search-input" class="col-md-2 col-form-label">Pendidikan</label>
                                     <div class="col-md-10">
                                         <input class="form-control" type="text" id="pendidikan" name="pendidikan" />
                                     </div>
                                 </div>
                                 <div class="mb-3 row">
                                     <label for="html5-search-input" class="col-md-2 col-form-label">No HP</label>
                                     <div class="col-md-10">
                                         <input class="form-control" type="text" id="no_telepon" name="no_telepon" />
                                     </div>
                                 </div>
                                 <div class="mb-3 row">
                                     <label for="html5-search-input" class="col-md-2 col-form-label">Pekerjaan</label>
                                     <div class="col-md-10">
                                         <input class="form-control" type="text" id="pekerjaan" name="pekerjaan" />
                                     </div>
                                 </div>
                                 <div class="mb-3 row">
                                     <label for="html5-search-input" class="col-md-2 col-form-label">Alamat</label>
                                     <div class="col-md-10">
                                         <input class="form-control" type="text" id="alamat" name="alamat" />
                                     </div>
                                 </div>
                                 <div class="mb-3 row">
                                     <label for="html5-search-input" class="col-md-2 col-form-label">RT / RW</label>
                                     <div class="col-md-10">
                                         <input class="form-control" type="text" id="rt_rw" name="rt_rw" />
                                     </div>
                                 </div>
                                 <div class="mb-3 row">
                                     <label for="html5-search-input" class="col-md-2 col-form-label">Kota /
                                         Kabupaten</label>
                                     <div class="col-md-10">
                                         <input class="form-control" type="text" id="kota" name="kota" />
                                     </div>
                                 </div>
                                 <div class="mb-3 row">
                                     <label for="html5-search-input" class="col-md-2 col-form-label">Kecamatan</label>
                                     <div class="col-md-10">
                                         <input class="form-control" type="text" id="kecamatan" name="kecamatan" />
                                     </div>
                                 </div>
                                 <div class="mb-3 row">
                                     <label for="html5-search-input" class="col-md-2 col-form-label">Kelurahan</label>
                                     <div class="col-md-10">
                                         <input class="form-control" type="text" id="kelurahan" name="kelurahan" />
                                     </div>
                                 </div>
                             </form>

                         </div>
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