 <!-- Content -->
 <div class="main-content container-xxl flex-grow-1 container-p-y">
     <div class="col-md-12">
         <div class="card mb-4">
             <div class="overlayLoading" style="display: none;" id="loadingModal">
                 <div class="spinner-border" role="status" aria-hidden="true">
                     <span class="visually-hidden">Loading...</span>
                 </div>
             </div>
             <div class="card-header text-white bg-primary mb-3">
                 <h5 class="card-title text-white">Rekam Medis Rawat Jalan POLI UMUM</h5>
             </div>
             <div class="card-body">
                 <div class="mb-3">
                     <label for="password" class="col-form-label">Tanggal Pemeriksaan</label>
                     <input class="form-control" type="date" id="tgl_pemeriksaan" value="<?php echo date('Y-m-d'); ?>"
                         max="<?php echo date("Y-m-d"); ?> " />
                 </div>
                 <input type="hidden" id="poli" value="001">
                 <div class="mb-3">
                     <button type="button" class="btn rounded-pill btn-primary" id="list_pasien">List pasien</button>
                 </div>

             </div>
         </div>
         <div class="card mb-4">
             <div class="card-body">
                 <div class="mb-3">
                     <div class="row">
                         <div class="col-md-6">
                             <label for="password" class="col-form-label">Nama Pasien</label>
                             <input class="form-control" type="text" id="nama_pasien" readonly />
                         </div>
                         <div class="col-md-6">
                             <label for="password" class="col-form-label">No. RM</label>
                             <input class="form-control" type="text" id="no_rm" readonly />
                             <input type="hidden" id="no_struck">
                             <input type="hidden" id="dokter_code">
                             <input type="hidden" id="kode_poli">
                         </div>
                     </div>
                 </div>
                 <div class="mb-3">
                     <div class="row">
                         <div class="col-md-6">
                             <label for="password" class="col-form-label">Tanggal Lahir</label>
                             <input class="form-control" type="text" id="tgl_Lahir" readonly />
                         </div>
                         <div class="col-md-6">
                             <label for="password" class="col-form-label">Jenis Kelamin</label>
                             <input class="form-control" type="text" id="jk" readonly />
                         </div>
                     </div>
                 </div>
                 <div class="mb-3">
                     <div class="row">
                         <div class="col-md-6">
                             <label for="password" class="col-form-label">Anamnesa (S)</label>
                             <textarea rows="8" class="form-control" id="anamnesa"></textarea>
                         </div>
                         <div class="col-md-6">
                             <label for="password" class="col-form-label">Pemeriksaan Fisik (O)</label>
                             <div class="row">
                                 <div class="form-group col-md-3">
                                     <label for="password" class="col-form-label">TD</label>
                                     <div class="input-group mb-3">
                                         <input type="text" class="form-control" aria-label="Recipient's username"
                                             id="td">
                                         <span class="input-group-text">mmHg</span>
                                     </div>
                                 </div>
                                 <div class=" form-group col-md-3">
                                     <label for="password" class="col-form-label">N</label>
                                     <div class="input-group mb-3">
                                         <input type="text" class="form-control" aria-label="Recipient's username"
                                             id="n">
                                         <span class="input-group-text">x/menit</span>
                                     </div>
                                 </div>
                                 <div class="form-group col-md-3">
                                     <label for="password" class="col-form-label">R</label>
                                     <div class="input-group mb-3">
                                         <input type="text" class="form-control" aria-label="Recipient's username"
                                             id="r">
                                         <span class="input-group-text">x/menit</span>
                                     </div>
                                 </div>
                                 <div class=" form-group col-md-3">
                                     <label for="password" class="col-form-label">S</label>
                                     <div class="input-group mb-3">
                                         <input type="text" class="form-control" aria-label="Recipient's username"
                                             id="s">
                                         <span class="input-group-text">C</span>
                                     </div>
                                 </div>
                                 <div class="mb-3">
                                     <label for="password" class="col-form-label">Pemeriksaan Penunjang (jika
                                         diperlukan):</label>
                                     <textarea class="form-control" id="pemeriksaan_penunjang" rows="3"> </textarea>
                                 </div>
                             </div>
                         </div>

                     </div>
                 </div>
                 <div class="mb-3">
                     <label for="password" class="col-form-label">Diagnosa (A)</label>
                     <textarea id="diagnosa" rows="2" class="form-control"> </textarea>
                 </div>
                 <div class="mb-3">
                     <div class="row">
                         <div class="col-md-6">
                             <label for="password" class="col-form-label text-black">Rencana Layanan Klinis (P)</label>
                             <div class="mb-3">
                                 <div class="form-check">
                                     <input class="form-check-input" type="radio" name="p" id="medikamentosa"
                                         value="medikamentosa">
                                     <label class="form-check-label" for="medikamentosa">
                                         Medikamentosa
                                     </label>
                                 </div>
                                 <div class="form-check">
                                     <input class="form-check-input" type="radio" name="p" id="is_tindakan"
                                         value="tindakan">
                                     <label class="form-check-label" for="is_tindakan">
                                         Tindakan
                                     </label>
                                     <input class="form-control" type="text" name="flexRadioDefault" id="tindakan">
                                 </div>
                                 <div class="form-check">
                                     <input class="form-check-input" type="radio" name="p" id="is_rujuk" value="rujuk">
                                     <label class="form-check-label" for="is_rujuk">
                                         Rujuk
                                     </label>
                                     <input class="form-control" type="text" name="flexRadioDefault" id="rujuk">
                                 </div>
                             </div>
                         </div>
                         <div class="col-md-6">
                             <label for="password" class="col-form-label">Edukasi</label>
                             <div class="mb-3">
                                 <div class="form-check">
                                     <input class="form-check-input" name="edukasi" type="checkbox"
                                         value="Penjelasan penyakit" id="penjelasan_penyakit">
                                     <label class="form-check-label" for="penjelasan_penyakit">
                                         Penjelasan penyakit
                                     </label>
                                 </div>
                                 <div class="form-check">
                                     <input class="form-check-input" name="edukasi" type="checkbox"
                                         value="Hasil Pemeriksaan" id="hasil_pemeriksaan">
                                     <label class="form-check-label" for="hasil_pemeriksaan">
                                         Hasil Pemeriksaan
                                     </label>
                                 </div>
                                 <div class="form-check">
                                     <input class="form-check-input" name="edukasi" type="checkbox"
                                         value="Tindakan Medis" id="tindakan_medis">
                                     <label class="form-check-label" for="tindakan_medis">
                                         Tindakan medis
                                     </label>
                                 </div>
                                 <div class="form-check">
                                     <input class="form-check-input" name="edukasi" type="checkbox" value="Komplikasi"
                                         id="komplikasi">
                                     <label class="form-check-label" for="komplikasi">
                                         Komplikasi
                                     </label>
                                 </div>
                                 <div class="form-check">
                                     <input class="form-check-input" name="edukasi" type="checkbox"
                                         value="Efek samping / risiko pengobatan" id="efek_samping">
                                     <label class="form-check-label" for="efek_samping">
                                         Efek samping / risiko pengobatan
                                     </label>
                                 </div>
                                 <div class="form-check">
                                     <input class="form-check-input" type="checkbox" name="edukasi" value="lain"
                                         id="lain">
                                     <label class="form-check-label" for="lain">
                                         Lain-lain
                                     </label>
                                     <textarea class="form-control" id="lain_lain"></textarea>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="mb-3">
                     <label for="password" class="col-form-label">Pelaksanaan Layanan (E)</label>
                     <textarea id="pelaksanaan_layanan" rows="8" class="form-control"> </textarea>
                 </div>
                 <div class="mb-3">
                     <button type="button" class="btn btn-primary" id="btn-simpan-soap">
                         Simpan
                     </button>
                     <button type="button" class="btn btn-primary btn-block" id="btn-ttd">Tanda
                         Tangan</button>
                     <button type="button" class="btn btn-primary btn-block" id="btn-print">
                         Cetak</button>
                 </div>
             </div>

         </div>
     </div>
 </div>


 <!-- Modal -->
 <div class="modal fade" id="modal-list-pasien" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
     <div class="modal-dialog modal-xl">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="staticBackdropLabel">List Pasien</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
                 <div class="table-responsive text-nowrap">
                     <table class="table table-striped" id="table_pasien">
                         <thead>
                             <tr>
                                 <th>No RM</th>
                                 <th>Nama Pasien</th>
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
             <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
             </div>
         </div>
     </div>
 </div>

 <div class="modal fade" id="modal-ttd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Tanda Tangan</h5>
             </div>
             <div class="modal-body">
                 <center>
                     <div id="signature">
                         <canvas id="signature-pad" class="signature-pad" width="450px" height="200px"></canvas>
                     </div>
                 </center>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-info" id="btn-clear-ttd">Clear</button>
                 <button type="button" class="btn btn-success" data-bs-dismiss="modal" id="btn-save-ttd">Save</button>
                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                     id="btn-cancel-ttd">Close</button>
             </div>
         </div>
     </div>
 </div>


 <!-- / Content -->