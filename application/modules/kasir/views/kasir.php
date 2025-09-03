 <!-- Content -->
 <div class="main-content container-xxl flex-grow-1 container-p-y">
 	<div class="row justify-content-start content-1">

 		<!-- CARI DATA PASIEN -->
 		<div class="col-12 my-1">
 			<div class="card mb-2">
 				<div class="card-header bg-primary rounded-top p-3 py-2">
 					<h6 class="text-white mb-0">Cari Data Pasien</h6>
 				</div>
 				<div class="card-body p-3">

 					<div class="row">

 						<div class="col-lg-12 col-xl-12">
 							<div class="demo-inline-spacing mt-3">
 								<div class="list-group list-group-horizontal-md text-md-center" role="tablist">
 									<a class="list-group-item list-group-item-action p-1 active" id="tab-list-antrian" data-is-rekap="false" data-bs-toggle="list" href="#tab-antrian" aria-selected="true" role="tab">Berdasarkan Antrian</a>
 									<a class="list-group-item list-group-item-action p-1" id="tab-list-rm" data-is-rekap="false" data-bs-toggle="list" href="#tab-rm" aria-selected="false" role="tab" tabindex="-1">Berdasarkan No RM</a>
 									<a class="list-group-item list-group-item-action p-1" id="tab-list-rekap" data-is-rekap="true" data-bs-toggle="list" href="#tab-rekap" aria-selected="false" role="tab" tabindex="-1">List Rekap</a>
 								</div>
 								<div class="tab-content p-0 mt-0">
 									<div class="tab-pane fade active show" id="tab-antrian" role="tabpanel" aria-labelledby="tab-list-antrian">
 										<div class="row">
 											<div class="col">
 												<label for="exampleFormControlInput1" class="col-form-label">Tanggal Antrian</label>
 												<input type="date" data-form="list-antrian" class="form-control form-control-sm" name="tgl_antrian" value="<?= date('Y-m-d') ?>">
 											</div>
 											<div class="col">
 												<label for="exampleFormControlInput1" class="col-form-label">Poli</label>
 												<select data-form="list-antrian" class="form-select form-select-sm" name="poli_antrian">
 													<option value="" selected="">Semua Poli</option>
 													<option value="001">POLI UMUM </option>
 													<option value="002">POLI GIGI </option>
 												</select>
 											</div>
 											<div class="col">
 												<label for="exampleFormControlInput1" class="col-form-label">Dokter</label>
 												<select data-form="list-antrian" class="form-select form-select-sm" name="dokter_antrian">
 													<?php foreach ($dropdown_dokter as $select) { ?>
 														<option value="<?= $select->dokter_code ?>"><?= $select->nama_dokter ?></option>
 													<?php } ?>
 												</select>
 											</div>
 											<div class="col-md-1">
 												<label for="exampleFormControlInput1" class="col-form-label"></label>
 												<button type="button" class="form-control btn rounded-pill btn-primary btn-md" id="cari-list-antrian">
 													<i class="bx bx-search me-1"></i>
 												</button>
 											</div>
 										</div>
 									</div>
 									<div class="tab-pane fade" id="tab-rm" role="tabpanel" aria-labelledby="tab-list-rm">
 										<div class="row align-items-center">
 											<div class="col-12">
 												<div class="input-group">
 													<label class="input-group-text text-xs" for="norm">No. RM</label>
 													<input type="text" class="form-control form-control-sm" name="cust_code_filter" placeholder="Ketik No. RM / Nama pasien disini (minimal 3 huruf)" aria-describedby="btn_cari_pasien" data-inputmask="'mask': '99-99-99'">
 													<button type="button" class="btn btn-outline-primary btn-sm" id="btn-cari-pasien-filter"><i class="fas fa-search"></i></button>
 												</div>
 											</div>
 										</div>
 									</div>
 									<div class="tab-pane fade" id="tab-rekap" role="tabpanel" aria-labelledby="tab-list-rekap">
 										<div class="row">
 											<div class="col-12">
 												<div class="row">
 													<div class="col">
 														<label for="exampleFormControlInput1" class="col-form-label">Tanggal Antrian</label>
 														<input datetime-picker="true" type="text" data-form="list-rekap" class="form-control form-control-sm" name="tgl_rekap" value="<?= date('Y-m-d') ?>">
 													</div>
 													<div class="col">
 														<label for="exampleFormControlInput1" class="col-form-label">Poli</label>
 														<select data-form="list-rekap" class="form-select form-select-sm" name="poli_rekap">
 															<option value="" selected="">Semua Poli</option>
 															<option value="001">POLI UMUM </option>
 															<option value="002">POLI GIGI </option>
 														</select>
 													</div>
 													<div class="col">
 														<label for="exampleFormControlInput1" class="col-form-label">Dokter</label>
 														<select data-form="list-rekap" class="form-select form-select-sm" name="dokter_rekap">
 															<?php foreach ($dropdown_dokter as $select) { ?>
 																<option value="<?= $select->dokter_code ?>"><?= $select->nama_dokter ?></option>
 															<?php } ?>
 														</select>
 													</div>
 													<div class="col-md-1">
 														<label for="exampleFormControlInput1" class="col-form-label"></label>
 														<button type="button" class="form-control btn rounded-pill btn-primary btn-md" id="cari-list-rekap">
 															<i class="bx bx-search me-1"></i>
 														</button>
 													</div>
 												</div>
 											</div>
 										</div>
 									</div>
 								</div>
 							</div>
 							<hr>
 						</div>

 						<div class="col-lg-6 col-xl-4">
 							<div class="row align-items-center">
 								<label class="col-md-4 col-form-label text-xs fw-bold" for="norm">Nama</label>
 								<div class="col">
 									<input type="hidden" name="cust_code" />
 									<input type="text" class="form-control form-control-sm" name="cust_name" placeholder="Nama Pasien" readonly />
 								</div>
 							</div>
 						</div>
 						<div class="col-lg-6 col-xl-4">
 							<div class="row align-items-center">
 								<label class="col-md-4 col-form-label text-xs fw-bold" for="norm">Jenis Layanan</label>
 								<div class="col">
 									<input type="text" class="form-control form-control-sm" name="jenis_layanan" placeholder="Jenis Layanan" readonly />
 								</div>
 							</div>
 						</div>
 						<div class="col-lg-6 col-xl-4">
 							<div class="row align-items-center">
 								<label class="col-md-4 col-form-label text-xs fw-bold" for="norm">No Struk</label>
 								<div class="col">
 									<input type="text" class="form-control form-control-sm" name="struck_no" placeholder="No Struk" readonly />
 								</div>
 							</div>
 						</div>
 						<div class="col-lg-6 col-xl-4">
 							<div class="row align-items-center">
 								<label class="col-md-4 col-form-label text-xs fw-bold" for="norm">Dokter</label>
 								<div class="col">
 									<input type="text" class="form-control form-control-sm" name="dokter" placeholder="Dokter" readonly />
 								</div>
 							</div>
 						</div>
 						<div class="col-lg-6 col-xl-4">
 							<div class="row align-items-center">
 								<label class="col-md-4 col-form-label text-xs fw-bold" for="norm">Penanggung</label>
 								<div class="col">
 									<input type="text" class="form-control form-control-sm" name="penanggung" placeholder="Penanggung" readonly />
 								</div>
 							</div>
 						</div>
 						<div class="col-lg-6 col-xl-4">
 							<div class="row align-items-center">
 								<label class="col-md-4 col-form-label text-xs fw-bold" for="norm">Jenis Pembayaran</label>
 								<div class="col">
 									<input type="text" class="form-control form-control-sm" name="jenis_pembayaran" placeholder="Jenis Pembayaran" readonly />
 								</div>
 							</div>
 						</div>
 					</div>

 				</div>
 			</div>
 		</div>
 		<!-- END CARI DATA PASIEN -->

 		<!-- SISI KIRI -->
 		<div class="col-lg-8 sub-1">
 			<div class="row">

 				<!-- CARI TINDAKAN -->
 				<div class="col-12 col-md-12 my-1">
 					<div class="card mb-2">
 						<div class="card-header bg-primary rounded-top p-3 py-2">
 							<h6 class="text-white mb-0">Tindakan</h6>
 						</div>
 						<div class="card-body p-3">

 							<div class="row mb-2">
 								<div class="col-12">
 									<h6 class="form-label fw-bold">Tindakan (Keranjang)</h6>
 									<button type="button" class="btn btn-info btn-sm w-100 rounded-0 mb-2" name="btn_tambah_tindakan" disabled><i class="fas fa-plus"></i> Tambah Tindakan</button>
 									<table class="table table-sm table-striped table-bordered border border-top" id="table-keranjang-tindakan">
 										<thead>
 											<tr>
 												<th width="250">Nama Tindakan</th>
 												<th width="150">Harga</th>
 												<th>Qty</th>
 												<th width="150">Subtotal</th>
 												<th></th>
 											</tr>
 										</thead>
 										<tbody></tbody>
 									</table>
 									<hr>
 								</div>
 							</div>

 							<div class="row">
 								<div class="col-12">
 									<h6 class="form-label fw-bold">Tindakan (Sudah Checkout)</h6>
 									<div class="input-group input-group-merge mb-2">
 										<span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>
 										<input type="search" name="searach_tindakan" placeholder="Search..." class="form-control form-control-sm">
 									</div>
 								</div>
 								<div class="col-12">
 									<table class="table table-sm table-striped table-bordered border border-top" id="table-list-tindakan-checkout">
 										<thead>
 											<tr>
 												<th width="250">Nama Tindakan</th>
 												<th width="150">Harga</th>
 												<th>Qty</th>
 												<th width="150">Subtotal</th>
 												<th></th>
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
 				<!-- END CARI TINDAKAN -->

 				<!-- CARI RESEP -->
 				<div class="col-12 col-md-12 my-1">
 					<div class="card mb-2">
 						<div class="card-header bg-primary rounded-top p-3 py-2">
 							<h6 class="text-white mb-0">Resep</h6>
 						</div>
 						<div class="card-body p-3">

 							<div class="row mb-2">
 								<div class="col-12">
 									<h6 class="form-label fw-bold">Resep (Keranjang)</h6>
 									<!-- <button type="button" class="btn btn-info btn-sm w-100 rounded-0 mb-2" name="btn_tambah_resep"><i class="fas fa-plus"></i> Tambah Resep</button> -->
 									<div class="overflow-scroll">
 										<table class="table table-sm table-striped table-bordered border border-top" id="table-keranjang-resep">
 											<thead>
 												<tr>
 													<th>Nama Item</th>
 													<th>Qty</th>
 													<th>Harga</th>
 													<th>Subtotal</th>
 													<th>Stock</th>
 													<th>Barcode</th>
 													<th>Signa1</th>
 													<th>Signa2</th>
 													<th>Status Signa</th>
 													<!-- <th></th> -->
 												</tr>
 											</thead>
 											<tbody></tbody>
 										</table>
 									</div>
 									<hr>
 								</div>
 							</div>

 							<div class="row">
 								<div class="col-12">
 									<h6 class="form-label fw-bold">Resep (Sudah Checkout)</h6>
 									<div class="input-group input-group-merge mb-2">
 										<span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>
 										<input type="search" name="searach_resep" placeholder="Search..." class="form-control form-control-sm">
 									</div>
 								</div>
 								<div class="col-12">
 									<table class="table table-sm table-striped table-bordered border border-top" id="table-list-resep">
 										<thead>
 											<tr>
 												<th>Nama Item</th>
 												<th>Qty</th>
 												<th>Harga</th>
 												<th>Subtotal</th>
 												<th>Stock</th>
 												<th>Barcode</th>
 												<th>Signa1</th>
 												<th>Signa2</th>
 												<th>Status Signa</th>
 												<th></th>
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
 				<!-- END CARI RESEP -->

 			</div>
 		</div>

 		<!-- SISI KANAN -->
 		<div class="col-lg-4 sub-2">
 			<div class="row">

 				<!-- TOTAL PEMBAYARAN (KERANJANG) -->
 				<div class="col-md-12 my-1">
 					<div class="card total-pembayaran-keranjang text-sm mb-2" style="background: #CFFFD0;">
 						<div class="card-header bg-primary rounded-top p-3 py-2">
 							<h6 class="text-white fw-bold mb-0">Total Pembayaran</h6>
 							<i class="text-white text-xs">(Keranjang)</i>
 						</div>
 						<div class="card-body px-0 py-1">

 							<div class="row justify-content-start m-0 px-2">
 								<div class="col-12 col-md-5">Total Seluruh</div>
 								<div class="col monospace biaya-total-seluruh">Rp. 0</div>
 							</div>

 						</div>
 						<div class="card-body px-0 py-1" style="background: #BCE8BD">

 							<div class="row justify-content-start m-0 px-2">
 								<div class="col-12 col-md-5">Pembulatan</div>
 								<div class="col monospace pembulatan">Rp. 0</div>
 							</div>

 						</div>
 						<div class="card-footer p-0">

 							<div class="row m-0 py-2 justify-content-start text-center fw-bold fs-4" style="background: #FFE78B;">
 								<div class="col-12 col-md-6">Total</div>
 								<div class="col-12 col-md-6 monospace total-seluruh">Rp. 0</div>
 							</div>

 						</div>
 					</div>
 				</div>
 				<!-- END TOTAL PEMBAYARAN (KERANJANG) -->

 				<!-- BTN CHECKOUT -->
 				<div class="col-md-12 my-1">
 					<button type="button" class="btn btn-danger btn-sm w-100" id="btn-checkout-pay" disabled>
 						<i class="fas fa-money-bill-wave px-2"></i>
 						<span>Checkout Pembayaran</span>
 					</button>
 				</div>
 				<!-- END BTN CHECKOUT -->

 				<!-- BTN CETAK PEMBAYARAN -->
 				<div class="col-md-12 my-1">
 					<button type="button" class="btn btn-secondary btn-sm w-100" id="btn-cetak-pay" disabled>
 						<i class="fas fa-money-bill-wave px-2"></i>
 						<span>Cetak Pembayaran</span>
 					</button>
 				</div>
 				<!-- END BTN CETAK PEMBAYARAN -->

 				<!-- TOTAL PEMBAYARAN (SUDAH CHECKOUT) -->
 				<div class="col-md-12 my-1">
 					<div class="card total-pembayaran text-sm mb-2" style="background: #CFFFD0;">
 						<div class="card-header bg-primary rounded-top p-3 py-2">
 							<h6 class="text-white fw-bold mb-0">Total Pembayaran</h6>
 							<i class="text-white text-xs">(Sudah Checkout)</i>
 						</div>
 						<div class="card-body px-0 py-1">

 							<div class="row justify-content-start m-0 px-2">
 								<div class="col-12 col-md-5 pr-2">Kode Pembayaran</div>
 								<div class="col monospace fw-bold kode-pembayaran">P/RJ/YY/MM/XXXX</div>
 							</div>

 						</div>
 						<div class="card-body px-0 py-1" style="background: #BCE8BD">

 							<div class="row justify-content-start m-0 px-2">
 								<div class="col-12 col-md-5 pr-2">Biaya Tindakan</div>
 								<div class="col monospace biaya-tindakan">Rp. 0</div>
 							</div>

 						</div>
 						<div class="card-body px-0 py-1">

 							<div class="row justify-content-start m-0 px-2">
 								<div class="col-12 col-md-5">Biaya Obat</div>
 								<div class="col monospace biaya-obat">Rp. 0</div>
 							</div>

 						</div>
 						<div class="card-body px-0 py-1" style="background: #BCE8BD">

 							<div class="row justify-content-start m-0 px-2">
 								<div class="col-12 col-md-5">Biaya Administrasi</div>
 								<div class="col monospace biaya-adm">Rp. 0</div>
 							</div>

 						</div>
 						<div class="card-body px-0 py-1">

 							<div class="row justify-content-start m-0 px-2">
 								<div class="col-12 col-md-5">Total Seluruh</div>
 								<div class="col monospace biaya-total-seluruh">Rp. 0</div>
 							</div>

 						</div>
 						<div class="card-body px-0 py-1" style="background: #BCE8BD">

 							<div class="row justify-content-start m-0 px-2">
 								<div class="col-12 col-md-5">Pembulatan</div>
 								<div class="col monospace pembulatan">Rp. 0</div>
 							</div>

 						</div>
 						<div class="card-footer p-0">

 							<div class="row m-0 py-2 justify-content-start text-center fw-bold fs-4" style="background: #FFE78B;">
 								<div class="col-12 col-md-6">Total</div>
 								<div class="col-12 col-md-6 monospace total-seluruh">Rp. 0</div>
 							</div>

 						</div>
 					</div>
 				</div>
 				<!-- END TOTAL PEMBAYARAN (SUDAH CHECKOUT) -->

 				<!-- CARI Alkes dan Item Terpakai -->
 				<div class="col-md-6 my-1 d-none">
 					<div class="card mb-2">
 						<div class="card-header bg-primary rounded-top p-3 py-2">
 							<h6 class="text-white mb-0">Alkes dan Item Terpakai</h6>
 						</div>
 						<div class="card-body p-3">

 							<div class="row"></div>

 						</div>
 					</div>
 				</div>
 				<!-- END CARI Alkes dan Item Terpakai -->

 			</div>
 		</div>

 	</div>
 	<div class="row justify-content-start content-2" style="display: none">
 		<div class="col-12">
 			<div class="card list-rekap-box text-sm mb-2">
 				<div class="card-header bg-primary rounded-top p-3 py-2">
 					<h6 class="text-white mb-0">List Rekap</h6>
 				</div>
 				<div class="card-body p-3">
 					<div class="input-group input-group-merge mb-2">
 						<span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>
 						<input type="search" name="searach_list_rekap" placeholder="Search..." class="form-control form-control-sm">
 					</div>
 					<div style="overflow-x: scroll;">
 						<table class="table table-sm table-striped table-bordered border border-top w-100" id="table-list-rekap">
 							<thead>
 								<tr>
 									<th>No RM</th>
 									<th>Nama</th>
 									<th>Antrian</th>
 									<th>Biro</th>
 									<th>Waktu Registrasi</th>
 									<th>Dokter</th>
 									<th>Poli</th>
 									<th>Total Biaya</th>
 									<th></th>
 								</tr>
 							</thead>
 							<tbody></tbody>
 						</table>
 					</div>
 					<div class="row m-0 mt-2 py-2 justify-content-start text-center fw-bold fs-6 total-seluruh-biaya" style="background: #FFE78B;">
 						<div class="col-12 col-md-6">Total Seluruh Biaya</div>
 						<div class="col-12 col-md-6">Rp. 0</div>
 					</div>
 				</div>
 				<div class="card-footer p-0"></div>
 			</div>
 		</div>
 	</div>
 </div>
 <!-- / Content -->

 <!-- Modal List Pasien -->
 <div class="modal fade" id="modal-list-data-pasien" role="dialog" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
 	<div class="modal-dialog modal-xl" role="document">
 		<div class="modal-content">
 			<div class="modal-header bg-primary rounded-top p-3 py-2">
 				<h6 class="text-white mb-0">List Data Pasien</h6>
 				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
 			</div>
 			<div class="modal-body">
 				<div class="row">
 					<div class="col-12">
 						<table class="table table-sm table-striped table-bordered border border-top" id="table-list-data-pasien">
 							<thead>
 								<tr>
 									<th></th>
 									<th>No.RM</th>
 									<th>Nama Pasien</th>
 									<th>Jenis Kelamin</th>
 									<th>Waktu Input</th>
 									<th>Kode Transaksi</th>
 									<th>Tindakan</th>
 									<th>Biaya</th>
 								</tr>
 							</thead>
 							<tbody>
 								<?php for ($i = 0; $i < 10; $i++) { ?>
 									<tr>
 										<td><button type="button" class="btn btn-outline-primary btn-xs m-0 rounded-0 w-100">Pilih</button></td>
 										<td>00123456</td>
 										<td>X</td>
 										<td>X</td>
 										<td>X</td>
 										<td>X</td>
 										<td>X</td>
 										<td>X</td>
 									</tr>
 								<?php } ?>
 							</tbody>
 						</table>
 					</div>
 				</div>
 			</div>
 		</div>
 	</div>
 </div>
 <!-- End Modal List Pasien -->

 <!-- Modal List Tindakan -->
 <div class="modal fade" id="modal-list-tindakan" role="dialog" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
 	<div class="modal-dialog modal-xl" role="document">
 		<div class="modal-content">
 			<div class="modal-header bg-primary rounded-top p-3 py-2">
 				<h6 class="text-white mb-0">List Tindakan</h6>
 				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
 			</div>
 			<div class="modal-body">
 				<div class="row">
 					<div class="col-12">
 						<div class="input-group input-group-merge mb-2">
 							<span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>
 							<input type="search" name="searach_list_tindakan_keranjang" placeholder="Search..." class="form-control form-control-sm">
 						</div>
 					</div>
 					<div class="col-12">
 						<table class="table table-sm table-striped table-bordered border border-top" id="table-list-tindakan-keranjang">
 							<thead>
 								<tr>
 									<th width="300">Nama Tindakan</th>
 									<!-- <th>Diskon (%)</th> -->
 									<th>Harga</th>
 									<th></th>
 								</tr>
 							</thead>
 							<tbody></tbody>
 						</table>
 					</div>
 				</div>
 			</div>
 		</div>
 	</div>
 </div>
 <!-- End Modal List Tindakan -->

 <!-- Modal List Resep -->
 <div class="modal fade" id="modal-list-resep" role="dialog" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
 	<div class="modal-dialog modal-xl" role="document">
 		<div class="modal-content">
 			<div class="modal-header bg-primary rounded-top p-3 py-2">
 				<h6 class="text-white mb-0">List Resep</h6>
 				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
 			</div>
 			<div class="modal-body">
 				<div class="row">
 					<div class="col-12">
 						<div class="row">
 							<div class="col-md-10 mb-2">
 								<h6 class="form-label fw-bold">Nama Obat</h6>
 								<select name="nama_obat" class="form-select form-select-sm"></select>
 							</div>
 							<div class="col-md-2 mb-2">
 								<h6 class="form-label fw-bold">Stok</h6>
 								<input type="text" placeholder="0" class="form-control form-control-sm" name="stok" readonly />
 							</div>
 							<div class="col-md mb-2">
 								<h6 class="form-label fw-bold">Signa 1 & 2</h6>
 								<div class="input-group">
 									<input type="text" placeholder="Signa 1" class="form-control form-control-sm" name="signa1" />
 									<input type="text" placeholder="Signa 2" class="form-control form-control-sm" name="signa2" />
 								</div>
 							</div>
 							<div class="col-md mb-2">
 								<h6 class="form-label fw-bold">Status Signa</h6>
 								<input type="text" placeholder="0" class="form-control form-control-sm" name="status_signa" />
 							</div>
 							<div class="col-md mb-2">
 								<h6 class="form-label fw-bold">Qty</h6>
 								<input type="number" placeholder="0" class="form-control form-control-sm" name="qty" />
 							</div>
 						</div>
 					</div>
 				</div>
 			</div>
 		</div>
 	</div>
 </div>
 <!-- End Modal List Resep -->

 <!-- Modal List Tindakan -->
 <div class="modal fade" id="modal-list-antrian" role="dialog" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
 	<div class="modal-dialog modal-xl" role="document">
 		<div class="modal-content">
 			<div class="modal-header bg-primary rounded-top p-3 py-2">
 				<h6 class="text-white mb-0">List Antrian</h6>
 				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
 			</div>
 			<div class="modal-body">
 				<div class="row">
 					<div class="col-12">
 						<div class="input-group input-group-merge mb-2">
 							<span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>
 							<input type="search" name="searach_list_antrian" placeholder="Search..." class="form-control form-control-sm">
 						</div>
 					</div>
 					<div class="col-12">
 						<table class="table table-sm table-striped table-bordered border border-top" id="table-list-antrian">
 							<thead>
 								<tr>
 									<th></th>
 									<th>No.RM</th>
 									<th width="250">Nama Pasien</th>
 									<th>Antrian</th>
 									<th>NIK</th>
 									<th>Waktu Registrasi</th>
 									<!-- <th>Dokter</th> -->
 									<th>Poli</th>
 								</tr>
 							</thead>
 							<tbody></tbody>
 						</table>
 					</div>
 				</div>
 			</div>
 		</div>
 	</div>
 </div>
 <!-- End Modal List Tindakan -->

 <!-- Modal Checkout Pembayaran -->
 <div class="modal fade" id="modal-checkout-pay" role="dialog" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
 	<div class="modal-dialog modal-md" role="document">
 		<div class="modal-content">
 			<div class="modal-header bg-primary rounded-top p-3 py-2">
 				<h6 class="text-white mb-0">Checkout Pembayaran</h6>
 				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
 			</div>
 			<div class="modal-body">
 				<div class="row">
 					<div class="col-lg-6 col-xl-12 my-1">
 						<div class="row align-items-center">
 							<label class="col-md-4 col-form-label text-xs fw-bold" for="">Jumlah Pembayaran</label>
 							<div class="col">
 								<div class="input-group">
 									<span class="input-group-text text-xs w-25">Rp.</span>
 									<input type="number" class="form-control form-control-sm" name="checkout_paid" placeholder="0" />
 								</div>
 							</div>
 						</div>
 					</div>
 					<div class="col-lg-6 col-xl-12 my-1">
 						<div class="row align-items-center">
 							<label class="col-md-4 col-form-label text-xs fw-bold" for="">Jumlah Kembalian</label>
 							<div class="col">
 								<div class="input-group">
 									<span class="input-group-text text-xs w-25">Rp.</span>
 									<span class="input-group-text text-xs w-75" data-amount-change="0">0</span>
 								</div>
 							</div>
 						</div>
 					</div>
 					<div class="col-lg-6 col-xl-12 my-1">
 						<div class="row align-items-start">
 							<label class="col-md-4 col-form-label text-xs fw-bold" for="">Jumlah Piutang</label>
 							<div class="col">
 								<div class="input-group">
 									<span class="input-group-text text-xs w-25">Rp.</span>
 									<span class="input-group-text text-xs w-75" data-amount-outstanding="0">0</span>
 								</div>
 								<small class="text-muted text-xs">Piutang terjadi ketika jumlah pembayaran tidak melebihi total pembayaran</small>
 							</div>
 						</div>
 					</div>
 				</div>
 			</div>
 			<div class="modal-footer p-1">
 				<button type="button" class="btn btn-danger btn-sm w-100" id="btn-confirm-checkout">
 					<i class="fas fa-money-bill-wave px-2"></i>
 					<span>Konfirmasi Pembayaran</span>
 				</button>
 			</div>
 		</div>
 	</div>
 </div>
 <!-- End Modal Checkout Pembayaran -->

 <!-- Modal Cetak Pembayaran -->
 <div class="modal fade" id="modal-cetak-pay" role="dialog" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
 	<div class="modal-dialog modal-xl" role="document">
 		<div class="modal-content">
 			<div class="modal-body">
 				<div class="row">
 					<div class="col-12 p-1">
 						<div class="p-1 px-0 rounded">
 							<button type="button" class="btn btn-primary text-xs w-100" onclick="cetak_pembayaran()">
 								<i class="fas fa-print px-2"></i>
 								Cetak Seluruh Faktur
 							</button>
 						</div>
 						<hr class="mt-3 mb-2">
 					</div>
 				</div>
 				<div class="row">
 					<div class="col-12">
 						<h6 class="text-center fw-bold" style="font-family: sans-serif !important;">Cetak Setiap Faktur</h6>
 					</div>
 				</div>
 				<div class="row list-faktur">
 					<div class="col-lg-2 p-1">
 						<div class="bg-primary p-1 px-2 rounded text-white shadow-sm">
 							<div class="text-xs fw-bold">P/RJ/XX/XX/XXXXX</div>
 							<div class="text-xs"><?= date('Y-m-d H:i:s') ?></div>
 							<div class="text-xs text-end">xxx</div>
 						</div>
 					</div>
 				</div>
 			</div>
 			<div class="modal-footer p-1">
 				<button type="button" class="btn btn-danger w-100 text-xs" data-bs-dismiss="modal">Tutup</button>
 			</div>
 		</div>
 	</div>
 </div>
 <!-- End Modal Cetak Pembayaran -->
