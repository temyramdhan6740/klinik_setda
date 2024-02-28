 <!-- Content -->
 <div class="main-content container-xxl flex-grow-1 container-p-y">
     <div class="col-md-12">
         <div class="card mb-4">
             <div class="card-header">
                 <div class="row">
                     <div class="col-md-6">
                         <h5>List Antrian</h5>
                     </div>
                     <div class="col-md-6" style="text-align: right;">
                         <button type="button" class="btn rounded-pill btn-primary pull-right" id="tambahAntrian">
                             <i class="bx bx-user-plus me-1"></i>
                             Tambah Antrian
                         </button>
                     </div>
                 </div>
                 <div class="row">
                     <div class="col-3">
                         <label for="exampleFormControlInput1" class="col-form-label">Tanggal Antrian</label>
                         <input type="date" class="form-control" id="tgl_antrian" value="<?= date('Y-m-d') ?>">
                     </div>
                     <div class="col-3">
                         <label for="exampleFormControlInput1" class="col-form-label">Poli</label>
                         <select class="form-select" id="poli_antrian">
                             <option value="" selected>Semua Poli</option>
                             <option value="001">Poli UMUM </option>
                             <option value="002">Poli GIGI </option>
                         </select>
                     </div>
                     <div class="col-1 mt-3">
                         <label for="exampleFormControlInput1" class="col-form-label"></label>
                         <button type="button" class="form-control btn rounded-pill btn-primary btn-md"
                             id="cari_tgl_antrian">
                             <i class="bx bx-search me-1"></i>
                         </button>
                     </div>
                 </div>
             </div>
             <div class="card-body">
                 <div class="table-responsive text-nowrap">
                     <table class="table table-striped" id="table_antrian">
                         <thead>
                             <tr>
                                 <th>No RM.</th>
                                 <th>Nama</th>
                                 <th>Antrian</th>
                                 <th>Biro</th>
                                 <th>Waktu Registrasi</th>
                                 <th>Dokter</th>
                                 <th>Poli</th>
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
 <div class="modal fade" id="modal-tambah-antrian" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
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
                         <h5 class="modal-title" id="staticBackdropLabel">Tambah Antrian</h5>
                         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                     </div>
                     <div class="modal-body">
                         <form id='myForm'>
                             <div class="nav-align-top mb-4">
                                 <div class="row ml-4 mb-4">
                                     <label for="html5-search-input" class="col-md-3 col-form-label">Tanggal
                                         Antrian</label>
                                     <div class="col-md-4">
                                         <input type="date" class="form-control" value="<?= date("Y-m-d") ?>"
                                             id="reg_date" />
                                     </div>
                                     <div class="col-md-2">
                                         <input type="time" class="form-control" value="<?= date("H:i:s") ?>"
                                             id="reg_time" />
                                     </div>
                                 </div>
                                 <ul class="nav nav-tabs nav-fill" role="tablist">
                                     <li class="nav-item">
                                         <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                                             data-bs-target="#navs-pasien-lama" value="pasien_lama"
                                             aria-controls="navs-pasien-lama" aria-selected="true">
                                             <i class="tf-icons bx bx-user"></i> Pasien Lama
                                         </button>
                                     </li>
                                     <li class="nav-item">
                                         <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                             data-bs-target="#navs-pasien-baru" value="pasien_baru"
                                             aria-controls="navs-pasien-baru" aria-selected="false">
                                             <i class="tf-icons bx bx-user"></i> Pasien Baru
                                         </button>
                                     </li>
                                 </ul>
                                 <div class="tab-content">
                                     <div class="tab-pane fade show active" id="navs-pasien-lama" role="tabpanel">
                                         <!-- pasien lama -->
                                         <div class="mb-3 row">
                                             <label for="html5-text-input" class="col-md-2 col-form-label">No RM</label>
                                             <div class="col-md-6">
                                                 <input class="form-control" type="text" id="no_rm_lama" />
                                             </div>
                                             <div class="col-md-2">
                                                 <button type="button" class="btn rounded-pill btn-primary"
                                                     id="cari_rm_lama">
                                                     <i class="bx bx-search me-1"></i>
                                                 </button>
                                             </div>
                                         </div>
                                         <div class="mb-3 row">
                                             <label for="html5-search-input"
                                                 class="col-md-2 col-form-label">Nama</label>
                                             <div class="col-md-10">
                                                 <input class="form-control" id="nama_lama" readonly />
                                             </div>
                                         </div>
                                         <div class="mb-3 row">
                                             <label for="html5-search-input"
                                                 class="col-md-2 col-form-label">Alamat</label>
                                             <div class="col-md-10">
                                                 <textarea class="form-control" id="alamat_lama" readonly></textarea>
                                             </div>
                                         </div>
                                         <div class="mb-3 row">
                                             <label for="html5-search-input"
                                                 class="col-md-2 col-form-label">Pekerjaan</label>
                                             <div class="col-md-10">
                                                 <input class="form-control" id="pekerjaan_lama" readonly />
                                             </div>
                                         </div>
                                         <div class="mb-3 row">
                                             <label for="html5-search-input" class="col-md-2 col-form-label">Bagian /
                                                 Biro</label>
                                             <div class="col-md-10">
                                                 <input class="form-control" id="bagian_lama" readonly />
                                             </div>
                                         </div>
                                     </div>
                                     <div class="tab-pane fade" id="navs-pasien-baru" role="tabpanel">
                                         <!-- pasien baru -->
                                         <div class="mb-3 row">
                                             <label for="html5-text-input" class="col-md-2 col-form-label">No RM</label>
                                             <div class="col-md-6">
                                                 <input class="form-control" type="text" id="no_rm_baru" />
                                             </div>
                                             <div class="col-md-4">
                                                 <button type="button" class="btn btn-primary"
                                                     id="btn_generate">Generate</button>
                                             </div>
                                         </div>
                                         <div class="mb-3 row">
                                             <label for="html5-search-input" class="col-md-2 col-form-label">No
                                                 KTP</label>
                                             <div class="col-md-10">
                                                 <input class="form-control" type="text" id="ktp_baru" />
                                             </div>
                                         </div>
                                         <div class="mb-3 row">
                                             <label for="html5-search-input" class="col-md-2 col-form-label">No
                                                 BPJS</label>
                                             <div class="col-md-10">
                                                 <input class="form-control" type="text" id="bpjs_baru" />
                                             </div>
                                         </div>
                                         <div class="mb-3 row">
                                             <label for="html5-search-input"
                                                 class="col-md-2 col-form-label">Nama</label>
                                             <div class="col-md-10">
                                                 <input class="form-control" type="text" id="nama_baru" />
                                             </div>
                                         </div>
                                         <div class="mb-3 row">
                                             <label for="html5-search-input" class="col-md-2 col-form-label">Status
                                                 Pegawai</label>
                                             <div class="col-md-10">
                                                 <input class="form-control" type="text" id="status_pegawai_baru" />
                                             </div>
                                         </div>
                                         <div class="mb-3 row">
                                             <label for="html5-search-input" class="col-md-2 col-form-label">Bagian /
                                                 Biro</label>
                                             <div class="col-md-10">
                                                 <input class="form-control" type="text" id="bagian_baru" />
                                             </div>
                                         </div>
                                         <div class="mb-3 row">
                                             <label for="html5-search-input" class="col-md-2 col-form-label">Status
                                                 Menikah</label>
                                             <div class="col-md-10">
                                                 <input class="form-control" type="text" id="status_menikah_baru" />
                                             </div>
                                         </div>
                                         <div class="mb-3 row">
                                             <label for="html5-search-input" class="col-md-2 col-form-label">Tempat
                                                 Lahir</label>
                                             <div class="col-md-10">
                                                 <input class="form-control" type="text" id="tempat_lahir_baru" />
                                             </div>
                                         </div>
                                         <div class="mb-3 row">
                                             <label for="html5-search-input" class="col-md-2 col-form-label">Tanggal
                                                 Lahir</label>
                                             <div class="col-md-10">
                                                 <input class="form-control" type="date" id="tanggal_lahir_baru" />
                                             </div>
                                         </div>
                                         <div class="mb-3 row">
                                             <label for="html5-search-input" class="col-md-2 col-form-label">Jenis
                                                 Kelamin</label>
                                             <div class="col-md-10">
                                                 <select class="form-select" id="jenis_kelamin_baru">
                                                     <option value="" selected>-- Pilih --</option>
                                                     <option value="L">Laki - laki</option>
                                                     <option value="P">Perempuan</option>
                                                 </select>
                                             </div>
                                         </div>
                                         <div class="mb-3 row">
                                             <label for="html5-search-input"
                                                 class="col-md-2 col-form-label">Agama</label>
                                             <div class="col-md-10">
                                                 <input class="form-control" type="text" id="agama_baru" />
                                             </div>
                                         </div>
                                         <div class="mb-3 row">
                                             <label for="html5-search-input"
                                                 class="col-md-2 col-form-label">Pendidikan</label>
                                             <div class="col-md-10">
                                                 <input class="form-control" type="text" id="pendidikan_baru" />
                                             </div>
                                         </div>
                                         <div class="mb-3 row">
                                             <label for="html5-search-input" class="col-md-2 col-form-label">No
                                                 HP</label>
                                             <div class="col-md-10">
                                                 <input class="form-control" type="text" id="hp_baru" />
                                             </div>
                                         </div>
                                         <div class="mb-3 row">
                                             <label for="html5-search-input"
                                                 class="col-md-2 col-form-label">Pekerjaan</label>
                                             <div class="col-md-10">
                                                 <input class="form-control" type="text" id="pekerjaan_baru" />
                                             </div>
                                         </div>
                                         <div class="mb-3 row">
                                             <label for="html5-search-input"
                                                 class="col-md-2 col-form-label">Alamat</label>
                                             <div class="col-md-10">
                                                 <input class="form-control" type="text" id="alamat_baru" />
                                             </div>
                                         </div>
                                         <div class="mb-3 row">
                                             <label for="html5-search-input" class="col-md-2 col-form-label">RT /
                                                 RW</label>
                                             <div class="col-md-10">
                                                 <input class="form-control" type="text" id="rtrw_baru" />
                                             </div>
                                         </div>
                                         <div class="mb-3 row">
                                             <label for="html5-search-input" class="col-md-2 col-form-label">Kota /
                                                 Kabupaten</label>
                                             <div class="col-md-10">
                                                 <input class="form-control" type="text" id="kota_baru" />
                                             </div>
                                         </div>
                                         <div class="mb-3 row">
                                             <label for="html5-search-input"
                                                 class="col-md-2 col-form-label">Kecamatan</label>
                                             <div class="col-md-10">
                                                 <input class="form-control" type="text" id="kecamatan_baru" />
                                             </div>
                                         </div>
                                         <div class="mb-3 row">
                                             <label for="html5-search-input"
                                                 class="col-md-2 col-form-label">Kelurahan</label>
                                             <div class="col-md-10">
                                                 <input class="form-control" type="text" id="kelurahan_baru" />
                                             </div>
                                         </div>
                                     </div>
                                     <div class="row">
                                         <div class="mb-3 row">
                                             <label for="html5-search-input"
                                                 class="col-md-2 col-form-label">Poli</label>
                                             <div class="col-md-10">
                                                 <select class="form-select" id="poli">
                                                     <option value=""> -- Pilih Poli --</option>
                                                     <?php foreach ($poli as $poli) {
                                                            echo "<option value='" . $poli['kode_poli'] . "'>" . $poli['nama_poli'] . " </option>";
                                                        } ?>
                                                 </select>
                                             </div>
                                         </div>
                                         <div class="mb-3 row">
                                             <label for="html5-search-input"
                                                 class="col-md-2 col-form-label">Dokter</label>
                                             <div class="col-md-10">
                                                 <select class="form-select" id="dokter_antrian">
                                                     <option value=""> -- Pilih Dokter --</option>
                                                     <?php foreach ($dokter as $dokter) {
                                                            echo "<option value='" . $dokter['dokter_code'] . "'>" . $dokter['nama_dokter'] . " </option>";
                                                        } ?>
                                                     <option value="lain">Dokter Lain</option>
                                                 </select>
                                             </div>
                                         </div>
                                         <div class="mb-3 row">
                                             <label for="html5-search-input" class="col-md-2 col-form-label">Peserta
                                                 BPJS</label>
                                             <div class="col-md-10">
                                                 <select class="form-select" id="peserta_bpjs_antrian">
                                                     <option value="1">Ya</option>
                                                     <option value="0">Tidak</option>
                                                 </select>
                                             </div>
                                         </div>
                                         <div class="mb-3 row">
                                             <label for="html5-search-input"
                                                 class="col-md-2 col-form-label">Anamnesa(S)</label>
                                             <div class="col-md-10">
                                                 <textarea class="form-control" id="anamnesa" rows="6"></textarea>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </form>
                     </div>
                     <div class="modal-footer">
                         <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                         <button type="button" class="btn btn-primary" id="btn-tambah-antrian">Tambah Antrian</button>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>