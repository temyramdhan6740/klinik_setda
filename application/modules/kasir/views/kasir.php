 <!-- Content -->
 <div class="main-content container-xxl flex-grow-1 container-p-y">
 	<div class="row justify-content-end">

 		<!-- CARI DATA PASIEN -->
 		<div class="col-12 my-1">
 			<div class="card mb-2">
 				<div class="card-header bg-primary rounded-top p-3 py-2">
 					<h6 class="text-white mb-0">Cari Data Pasien</h6>
 				</div>
 				<div class="card-body p-3">

 					<div class="row">
 						<div class="col-lg-12 col-xl-12">
 							<div class="row align-items-center">
 								<div class="col-12">
 									<div class="input-group">
 										<label class="input-group-text text-xs" for="norm">No. RM</label>
 										<input type="text" class="form-control form-control-sm" name="cust_code" placeholder="Ketik No. RM / Nama pasien disini (minimal 3 huruf)" aria-describedby="btn_cari_pasien">
 										<button type="button" class="btn btn-outline-primary btn-sm" id="btn_cari_pasien"><i class="fas fa-search"></i></button>
 									</div>
 								</div>
 							</div>
 							<hr>
 						</div>
 						<div class="col-lg-6 col-xl-6">
 							<div class="row align-items-center">
 								<label class="col-md-3 col-form-label text-xs fw-bold" for="norm">Nama</label>
 								<div class="col-md-9">
 									<input type="text" class="form-control form-control-sm" name="cust_name" placeholder="Nama Pasien" readonly />
 								</div>
 							</div>
 						</div>
 						<div class="col-lg-6 col-xl-6">
 							<div class="row align-items-center">
 								<label class="col-md-3 col-form-label text-xs fw-bold" for="norm">Jenis Layanan</label>
 								<div class="col-md-9">
 									<input type="text" class="form-control form-control-sm" name="jenis_layanan" placeholder="Jenis Layanan" readonly />
 								</div>
 							</div>
 						</div>
 						<div class="col-lg-6 col-xl-6">
 							<div class="row align-items-center">
 								<label class="col-md-3 col-form-label text-xs fw-bold" for="norm">No Struk</label>
 								<div class="col-md-9">
 									<input type="text" class="form-control form-control-sm" name="struck_no" placeholder="No Struk" readonly />
 								</div>
 							</div>
 						</div>
 						<div class="col-lg-6 col-xl-6">
 							<div class="row align-items-center">
 								<label class="col-md-3 col-form-label text-xs fw-bold" for="norm">Dokter</label>
 								<div class="col-md-9">
 									<input type="text" class="form-control form-control-sm" name="dokter" placeholder="Dokter" readonly />
 								</div>
 							</div>
 						</div>
 						<div class="col-lg-6 col-xl-6">
 							<div class="row align-items-center">
 								<label class="col-md-3 col-form-label text-xs fw-bold" for="norm">Penanggung</label>
 								<div class="col-md-9">
 									<input type="text" class="form-control form-control-sm" name="penanggung" placeholder="Penanggung" readonly />
 								</div>
 							</div>
 						</div>
 						<div class="col-lg-6 col-xl-6">
 							<div class="row align-items-center">
 								<label class="col-md-3 col-form-label text-xs fw-bold" for="norm">Jenis Pembayaran</label>
 								<div class="col-md-9">
 									<input type="text" class="form-control form-control-sm" name="jenis_pembayaran" placeholder="Jenis Pembayaran" readonly />
 								</div>
 							</div>
 						</div>
 					</div>

 				</div>
 			</div>
 		</div>
 		<!-- END CARI DATA PASIEN -->

 		<!-- CARI TINDAKAN -->
 		<div class="col-12 col-md-7 my-1">
 			<div class="card mb-2">
 				<div class="card-header bg-primary rounded-top p-3 py-2">
 					<h6 class="text-white mb-0">Tindakan</h6>
 				</div>
 				<div class="card-body p-3">

 					<div class="row mb-2">
 						<div class="col-12">
 							<h6 class="form-label fw-bold">Tindakan (Keranjang)</h6>
 							<button type="button" class="btn btn-info btn-sm w-100 rounded-0 mb-2" name="btn_tambah_tindakan"><i class="fas fa-plus"></i> Tambah Tindakan</button>
 							<table class="table table-sm table-striped table-bordered border border-top" id="table-keranjang-tindakan">
 								<thead>
 									<tr>
 										<th width="250">Nama Tindakan</th>
 										<th width="150">Harga</th>
 										<th>Qty</th>
 										<th width="150">Subtotal</th>
 										<th>Piutang</th>
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
 							<table class="table table-sm table-striped table-bordered border border-top" id="table-list-tindakan">
 								<thead>
 									<tr>
 										<th>Nama Tindakan</th>
 										<!-- <th>Diskon (%)</th> -->
 										<th>Qty</th>
 										<th>Harga (Diskon)</th>
 										<th>Subtotal</th>
 										<th>Piutang</th>
 										<th></th>
 									</tr>
 								</thead>
 								<tbody>
 									<?php for ($i = 0; $i < 10; $i++) { ?>
 										<tr>
 											<td>Test</td>
 											<!-- <td></td> -->
 											<td>12</td>
 											<td>Rp. 2.000 (10%)</td>
 											<td>Rp. 20.000</td>
 											<td></td>
 											<td><button type="button" class="btn btn-outline-danger btn-xs m-0 p-1 rounded-0 w-100"><i class="fas fa-trash-alt"></i></button></td>
 										</tr>
 									<?php } ?>
 								</tbody>
 							</table>
 						</div>
 					</div>

 				</div>
 			</div>
 		</div>
 		<!-- END CARI TINDAKAN -->

 		<!-- TOTAL PEMBAYARAN -->
 		<div class="col-md-5 my-1">
 			<div class="card total-pembayaran text-sm mb-2" style="background: #CFFFD0;">
 				<div class="card-header bg-primary rounded-top p-3 py-2">
 					<h6 class="text-white mb-0">Total Pembayaran</h6>
 				</div>
 				<div class="card-body p-3">

 					<div class="row justify-content-end mb-3">
 						<div class="col-12 col-md-7">
 							<div class="d-flex">
 								<div>Kode Pembayaran</div>
 								<div class="px-3">:</div>
 								<div class="fw-bold">P/RJ/YY/MM/XXXX</div>
 							</div>
 						</div>
 					</div>

 				</div>
 				<div class="card-body px-0 py-1" style="background: #BCE8BD">

 					<div class="row justify-content-start m-0 px-2">
 						<div class="col-12 col-md-5 pr-2">Biaya Tindakan</div>
 						<div class="col biaya-tindakan">Rp. -</div>
 					</div>

 				</div>
 				<div class="card-body px-0 py-1">

 					<div class="row justify-content-start m-0 px-2">
 						<div class="col-12 col-md-5">Biaya Obat</div>
 						<div class="col biaya-obat">Rp. -</div>
 					</div>

 				</div>
 				<div class="card-body px-0 py-1" style="background: #BCE8BD">

 					<div class="row justify-content-start m-0 px-2">
 						<div class="col-12 col-md-5">Biaya Administrasi</div>
 						<div class="col biaya-adm">Rp. -</div>
 					</div>

 				</div>
 				<div class="card-body px-0 py-1">

 					<div class="row justify-content-start m-0 px-2">
 						<div class="col-12 col-md-5">Pembulatan</div>
 						<div class="col pembulatan">Rp. -</div>
 					</div>

 				</div>
 				<div class="card-footer px-0 py-1">

 					<div class="row m-0 py-2 justify-content-start text-center fw-bold fs-4" style="background: #FFE78B;">
 						<div class="col-12 col-md-6">Total</div>
 						<div class="col-12 col-md-6 total-seluruh">Rp. -</div>
 					</div>

 				</div>
 			</div>
 		</div>
 		<!-- END TOTAL PEMBAYARAN -->

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
