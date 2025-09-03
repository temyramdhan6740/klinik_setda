<!-- Modal Cari RM -->
<div class="modal fade" id="modal-pasien" tabindex="-1" aria-modal="true" role="dialog">
	<div class="modal-dialog modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel3">Data pasien</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-12">
						<table class="table table-sm" id="table_cari_pasien">
							<thead>
								<tr>
									<th>No. Struk</th>
									<th>No. RM</th>
									<th>Nama</th>
									<th>Poli</th>
									<th>Dokter</th>
									<th>Tgl Masuk</th>
									<th></th>
								</tr>
							</thead>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Content -->
<div class="main-content container-xxl flex-grow-1 container-p-y">
	<?= form_open('#', ['name' => 'frm', 'id' => 'frm', "onkeydown" => "return (event.target.tagName.toLowerCase() !== 'textarea') ? event.key != 'Enter' : '';"]); ?>
	<div class="row justify-content-start content-1">

		<!-- CARI DATA PASIEN -->
		<div class="col-12 my-1">
			<div class="card mb-3">
				<!-- Overlay -->
				<div class="overlayLoading rounded" style="display: none;">
					<div class="spinner-border text-white" role="status" aria-hidden="true">
						<span class="visually-hidden">Loading...</span>
					</div>
				</div>
				<!-- End Overlay -->
				<div class="card-header bg-primary rounded-top p-3 py-2">
					<h6 class="text-white text-xs mb-0">Cari Data Pasien</h6>
				</div>
				<div class="card-body p-3">

					<div class="row">
						<div class="col-lg-6 col-xl-6">
							<div class="row align-items-center">
								<label class="col-sm-2 col-form-label text-xs" for="norm">No. Struk</label>
								<div class="col-sm-10">
									<input type="text" class="form-control form-control-sm" name="struckNo" placeholder="Nomor Struk" value="" readonly="">
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-xl-6">
							<div class="row align-items-center">
								<label class="col-sm-2 col-form-label text-xs" for="norm">No. RM</label>
								<div class="col-sm-10">
									<div class="input-group">
										<input type="text" class="form-control form-control-sm" name="noRM" placeholder="No. RM" aria-describedby="btn_cari_pasien" maxlength="6">
										<button type="button" class="btn btn-outline-primary btn-sm" id="btn_cari_pasien"><i class="fas fa-search"></i></button>
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
		<!-- END CARI DATA PASIEN -->

		<div class="col-lg-12 col-xl-6">

			<!-- DATA PASIEN -->
			<div class="card mb-3">
				<div class="card-header bg-primary rounded-top p-3 py-2">
					<h6 class="text-white text-xs mb-0">Data Pasien</h6>
				</div>
				<div class="card-body p-3 py-2">
					<form name="frm_data_pasien" method="post">
						<div class="row">
							<div class="col-md-6 col-lg-3">
								<div class="form-group row m-0 mt-2">
									<label class="col-12 text-xs px-0">No RM</label>
									<input type="text" name="no_rm" id="no_rm" class="form-control form-control-sm text-xs" placeholder="No.RM" readonly>
								</div>
							</div>
							<div class="col-md-6 col-lg-3">
								<div class="form-group row m-0 mt-2">
									<label class="col-12 text-xs px-0">Tanggal Lahir</label>
									<input type="date" name="tgl_lahir" id="tgl_lahir" class="form-control form-control-sm text-xs" readonly>
								</div>
							</div>
							<div class="col-md-12 col-lg-6">
								<div class="form-group row m-0 mt-2">
									<label class="col-12 text-xs px-0">Nama</label>
									<input type="text" name="nama_rm" id="nama_rm" class="form-control form-control-sm text-xs" placeholder="Nama" readonly>
								</div>
							</div>
							<div class="col-12">
								<hr>
							</div>
							<div class="col-md-6 col-lg-6">
								<div class="form-group row m-0 mt-2">
									<label class="col-12 text-xs px-0">Tanggal</label>
									<input type="hidden" name="tgl_old" id="tgl_old">
									<input type="date" name="tgl" id="tgl" class="form-control form-control-sm" onchange="perbaruiAsesmen()">
								</div>
							</div>
							<div class="col-md-6 col-lg-6">
								<div class="form-group row m-0 mt-2">
									<label class="col-12 text-xs px-0">Jam</label>
									<input type="time" name="jam" id="jam" class="form-control form-control-sm">
								</div>
							</div>
							<div class="col-md-6 col-lg-6">
								<div class="form-group row m-0 mt-2">
									<label class="col-12 text-xs px-0">Ruangan/Poliklinik</label>
									<input type="text" name="ruang" id="ruang" class="form-control form-control-sm" />
								</div>
							</div>
							<div class="col-md-6 col-lg-6">
								<div class="form-group row m-0 mt-2">
									<label class="col-12 text-xs px-0">Sumber Data</label>
									<input type="hidden" name="sumber_data" id="sumber_data">
									<small class="form-text text-muted text-xxs p-0">Jika opsi tidak tersedia silahkan isi sendiri.</small>
								</div>
							</div>
							<div class="col-lg-12">
								<div class="form-group row m-0 mt-2">
									<label class="col-6 text-xs px-0">Rujukan</label>
									<div class="col-6 py-0" style="text-align-last: right;">
										<input class="mr-2" type="radio" name="rujukan" id="rujukan_ya" value="1">
										<label class="form-check-label text-xs">Ya</label>
										<input class="mx-2" type="radio" name="rujukan" id="rujukan_tidak" value="0" checked="">
										<label class="form-check-label text-xs">Tidak</label>
									</div>
								</div>
								<div class="form-group row m-0 mt-2">
									<div class="col-12 col-xl-12 mb-2 p-0">
										<div class="input-group">
											<span class="input-group-text py-1 text-xxs w-50">RS</span>
											<input name="rs" type="text" class="form-control form-control-sm" placeholder="">
										</div>
									</div>
									<div class="col-12 col-xl-12 mb-2 p-0">
										<div class="input-group">
											<span class="input-group-text py-1 text-xxs w-50">Puskesmas</span>
											<input name="puskesmas" type="text" class="form-control form-control-sm" placeholder="">
										</div>
									</div>
									<div class="col-12 col-xl-12 mb-2 p-0">
										<div class="input-group">
											<span class="input-group-text py-1 text-xxs w-50">Dokter Diagnosa Rujukan</span>
											<input name="doc_diag_rujukan" type="text" class="form-control form-control-sm" placeholder="">
										</div>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>

		</div>

		<div class="col-lg-12 col-xl-6">

			<div class="card mb-3">
				<div class="card-header bg-primary rounded-top p-3 py-2">
					<h6 class="text-white text-xs mb-0">Keluhan Utama</h6>
				</div>
				<div class="card-body p-2">
					<div class="row">
						<div class="col-12">
							<textarea name="keluhan_utama" rows="10" id="keluhan_utama" class="form-control form-control-sm" placeholder="Keluhan Utama"></textarea>
						</div>
					</div>
				</div>
			</div>

			<div class="card mb-3">
				<div class="card-header bg-primary rounded-top p-3 py-2">
					<h6 class="text-white text-xs mb-0">Pemeriksaan Fisik</h6>
				</div>
				<div class="card-body p-3">
					<div class="row">
						<div class="col-6 col-xl-6 mb-2">
							<div class="input-group input-group-merge">
								<span class="input-group-text py-1 text-xxs">BB</span>
								<input name="bb" type="number" class="form-control form-control-sm" placeholder="0">
								<span class="input-group-text py-1 text-xxs">kg</span>
							</div>
						</div>
						<div class="col-6 col-xl-6 mb-2">
							<div class="input-group input-group-merge">
								<span class="input-group-text py-1 text-xxs">TD</span>
								<input name="td" type="text" class="form-control form-control-sm" placeholder="0/0">
								<span class="input-group-text py-1 text-xxs">mmHg</span>
							</div>
						</div>
						<div class="col-6 col-xl-6 mb-2">
							<div class="input-group input-group-merge">
								<span class="input-group-text py-1 text-xxs">Respirasi</span>
								<input name="respirasi" type="number" min="0" max="100" class="form-control form-control-sm" placeholder="0">
								<span class="input-group-text py-1 text-xxs">x/m</span>
							</div>
						</div>
						<div class="col-6 col-xl-6 mb-2">
							<div class="input-group input-group-merge">
								<span class="input-group-text py-1 text-xxs">TB</span>
								<input name="tb" type="number" min="0" max="100" class="form-control form-control-sm" placeholder="0 - 100">
								<span class="input-group-text py-1 text-xxs">cm</span>
							</div>
						</div>
						<div class="col-6 col-xl-6 mb-2">
							<div class="input-group input-group-merge">
								<span class="input-group-text py-1 text-xxs">Nadi (N)</span>
								<input name="nadi" type="number" class="form-control form-control-sm" placeholder="0">
								<span class="input-group-text py-1 text-xxs">x/m</span>
							</div>
						</div>
						<div class="col-6 col-xl-6 mb-2">
							<div class="input-group input-group-merge">
								<span class="input-group-text py-1 text-xxs">Suhu (S)</span>
								<input name="suhu" type="number" class="form-control form-control-sm" placeholder="0">
								<span class="input-group-text py-1 text-xxs">°C</span>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>

		<!-- RIWAYAT -->
		<div class="col-lg-12 col-xl-12">
			<div class="card mb-3">
				<div class="card-header bg-primary rounded-top p-3 py-2">
					<h6 class="text-white text-xs mb-0">Riwayat Asesmen</h6>
				</div>
				<div class="card-body p-3">
					<div class="row">
						<!-- RIWAYAT KESEHATAN -->
						<div class="col-xl-4">
							<div class="mb-4 text-xs">
								<div class="p-1 text-center text-white bg-primary rounded-top" style="width: 40%;">Riwayat Kesehatan</div>
								<div class="w-100 bg-primary" style="padding: 1px;"></div>
							</div>
							<div class="row">
								<!-- RIWAYAT PENYAKIT DAHULU -->
								<div class="col-12 mb-2">
									<div class="row">
										<label class="col text-xs">Riwayat penyakit dahulu</label>
										<div class="col-6 py-0" style="text-align-last: right;">
											<input class="mr-2" type="radio" name="riwayat_penyakit_dahulu" id="riwayat_penyakit_dahulu_ya" value="1">
											<label class="form-check-label text-xs">Ya</label>
											<input class="mx-2" type="radio" name="riwayat_penyakit_dahulu" id="riwayat_penyakit_dahulu_tidak" value="0" checked="">
											<label class="form-check-label text-xs">Tidak</label>
										</div>
									</div>
									<div class="input-group">
										<input type="text" data-group="riwayat_pasien_val" name="riwayat_penyakit_dahulu_val" id="riwayat_penyakit_dahulu_val" class="form-control form-control-sm" placeholder="Penyakit...">
									</div>
								</div>
								<!-- PERNAH DIRAWAT -->
								<div class="col-12 mb-2">
									<div class="row">
										<label class="col text-xs">Pernah dirawat</label>
										<div class="col-6 py-0" style="text-align-last: right;">
											<input class="mr-2" type="radio" name="pernah_dirawat" id="pernah_dirawat_ya" value="1">
											<label class="form-check-label text-xs">Ya</label>
											<input class="mx-2" type="radio" name="pernah_dirawat" id="pernah_dirawat_tidak" value="0" checked="">
											<label class="form-check-label text-xs">Tidak</label>
										</div>
									</div>
									<div class="input-group w-100">
										<div class="input-group-text py-1 text-xxs">Diagnosa</div>
										<input type="text" name="diag_pernah_dirawat" data-group="pernah_dirawat_val" class="form-control form-control-sm" placeholder="Diagnosa...">
									</div>
									<div class="my-2"></div>
									<div class="input-group w-100">
										<div class="input-group-text py-1 text-xxs">Waktu</div>
										<input type="time" name="waktu_pernah_dirawat" data-group="pernah_dirawat_val" class="form-control form-control-sm" placeholder="Waktu...">
									</div>
									<div class="my-2"></div>
									<div class="input-group w-100">
										<div class="input-group-text py-1 text-xxs">Di</div>
										<input type="text" name="di_pernah_dirawat" data-group="pernah_dirawat_val" class="form-control form-control-sm" placeholder="Di...">
									</div>
								</div>
								<!-- PERNAH OPERASI -->
								<div class="col-12 mb-2">
									<div class="row">
										<label class="col text-xs">Pernah operasi</label>
										<div class="col-6 py-0" style="text-align-last: right;">
											<input class="mr-2" type="radio" name="pernah_operasi" id="pernah_operasi_ya" value="1">
											<label class="form-check-label text-xs">Ya</label>
											<input class="mx-2" type="radio" name="pernah_operasi" id="pernah_operasi_tidak" value="0" checked="">
											<label class="form-check-label text-xs">Tidak</label>
										</div>
									</div>
									<div class="input-group">
										<div class="input-group-text py-1 text-xxs">Jenis operasi</div>
										<input type="text" name="diag_pernah_operasi" data-group="pernah_operasi_val" class="form-control form-control-sm" placeholder="Jenis operasi...">
									</div>
									<div class="my-2"></div>
									<div class="input-group w-100">
										<div class="input-group-text py-1 text-xxs">Waktu</div>
										<input type="time" name="waktu_pernah_operasi" data-group="pernah_operasi_val" class="form-control form-control-sm" placeholder="Waktu...">
									</div>
									<div class="my-2"></div>
									<div class="input-group w-100">
										<div class="input-group-text py-1 text-xxs">Di</div>
										<input type="text" name="di_pernah_operasi" data-group="pernah_operasi_val" class="form-control form-control-sm" placeholder="Di...">
									</div>
								</div>
								<!-- MASIH DALAM PENGOBATAN -->
								<div class="col-12 mb-2">
									<div class="row">
										<label class="col text-xs mb-1">Masih dalam pengobatan</label>
									</div>
									<div class="input-group">
										<div class="input-group-text py-1 text-xxs">
											<input class="mx-2" type="radio" name="masih_dalam_pengobatan" id="masih_dalam_pengobatan_tidak" value="0" checked />
											<label class="form-check-label text-xs">Tidak</label>
											<input class="mx-2" type="radio" name="masih_dalam_pengobatan" id="masih_dalam_pengobatan_ya" value="1">
											<label class="form-check-label text-xs">Ya</label>
										</div>
										<input type="text" data-group="masih_dalam_pengobatan_val" name="masih_dalam_pengobatan_val" class="form-control form-control-sm" placeholder="Obat...">
									</div>
								</div>
							</div>
							<!--  -->
						</div>
						<!-- RIWAYAT PENYAKIT KELUARGA -->
						<div class="col-xl-4">
							<div class="mb-4 text-xs">
								<div class="p-1 text-center text-white bg-primary rounded-top" style="width: 50%;">Riwayat Penyakit Keluarga</div>
								<div class="w-100 bg-primary" style="padding: 1px;"></div>
							</div>
							<div class="row">
								<!-- RIWAYAT PENYAKIT KELUARGA -->
								<div class="col-12 mb-2">
									<div class="row">
										<label class="col text-xs">Riwayat penyakit keluarga</label>
										<div class="col" style="text-align-last: right;">
											<input class="mx-2" type="radio" name="riw_penyakit_keluarga" id="riw_penyakit_keluarga_ya" value="1">
											<label class="form-check-label text-xs">Ya</label>
											<input class="mx-2" type="radio" name="riw_penyakit_keluarga" id="riw_penyakit_keluarga_tidak" value="0" checked="">
											<label class="form-check-label text-xs">Tidak</label>
										</div>
									</div>
									<input type="hidden" name="riw_penyakit_keluarga_val" id="riw_penyakit_keluarga_val" placeholder="Obat...">
									<small class="form-text text-muted text-xxs p-0">Jika opsi tidak tersedia silahkan isi sendiri.</small>
								</div>
								<!-- KETERGANTUNGAN TERHADAP -->
								<div class="col-12 mb-2">
									<div class="row">
										<label class="col text-xs">Ketergantungan terhadap</label>
										<div class="col" style="text-align-last: right;">
											<input class="mx-2" type="radio" name="ketergantungan_terhadap" id="ketergantungan_terhadap_ya" value="1">
											<label class="form-check-label text-xs">Ya</label>
											<input class="mx-2" type="radio" name="ketergantungan_terhadap" id="ketergantungan_terhadap_tidak" value="0" checked="">
											<label class="form-check-label text-xs">Tidak</label>
										</div>
									</div>
									<input type="hidden" name="ketergantungan_terhadap_val" id="ketergantungan_terhadap_val" class="form-control form-control-sm" placeholder="Obat...">
									<small class="form-text text-muted text-xxs p-0">Jika opsi tidak tersedia silahkan isi sendiri.</small>
								</div>
								<!-- RIWAYAT PEKERJAAN -->
								<div class="col-12 mb-2">
									<div class="row">
										<label class="col text-xs">Riwayat Pekerjaan</label>
										<div class="col" style="text-align-last: right;">
											<input class="mx-2" type="radio" name="riwayat_pekerjaan" id="riwayat_pekerjaan_ya" value="1">
											<label class="form-check-label text-xs">Ya</label>
											<input class="mx-2" type="radio" name="riwayat_pekerjaan" id="riwayat_pekerjaan_tidak" value="0" checked="">
											<label class="form-check-label text-xs">Tidak</label>
										</div>
									</div>
									<input type="text" name="riwayat_pekerjaan_val" id="riwayat_pekerjaan_val" class="form-control form-control-sm" placeholder="Obat...">
								</div>
								<!-- RIWAYAT ALERGI -->
								<div class="col-12 mb-2">
									<div class="row">
										<label class="col text-xs">Riwayat Alergi</label>
										<div class="col" style="text-align-last: right;">
											<input class="mx-2" type="radio" name="riwayat_alergi" id="riwayat_alergi_ya" value="1">
											<label class="form-check-label text-xs">Ya</label>
											<input class="mx-2" type="radio" name="riwayat_alergi" id="riwayat_alergi_tidak" value="0" checked="">
											<label class="form-check-label text-xs">Tidak</label>
										</div>
									</div>
									<input type="hidden" name="riwayat_alergi_val" id="riwayat_alergi_val" class="form-control form-control-sm" placeholder="Obat...">
									<small class="form-text text-muted text-xxs p-0">Jika opsi tidak tersedia silahkan isi sendiri.</small>
								</div>
								<!--  -->
							</div>
						</div>
						<!-- RIWAYAT PSIKOSOSIAL DAN SPIRITUAL -->
						<div class="col-xl-4">
							<div class="mb-4 text-xs">
								<div class="p-1 text-center text-white bg-primary rounded-top" style="width: 55%;">Riwayat Psikososial & Spiritual</div>
								<div class="w-100 bg-primary" style="padding: 1px;"></div>
							</div>
							<div class="row">

								<!-- STATUS PSIKOLOGI -->
								<div class="col-12 mb-2">
									<div class="row">
										<label class="col text-xs">Status Psikologi</label>
										<div class="col" style="text-align-last: right;">
											<input class="mx-2" type="radio" name="status_psikologi" id="status_psikologi_ya" value="1">
											<label class="form-check-label text-xs">Ya</label>
											<input class="mx-2" type="radio" name="status_psikologi" id="status_psikologi_tidak" value="0" checked="">
											<label class="form-check-label text-xs">Tidak</label>
										</div>
									</div>
									<input type="hidden" name="status_psikologi_val" id="status_psikologi_val" class="form-control form-control-sm" placeholder="Obat...">
									<small class="form-text text-muted text-xxs p-0">Jika opsi tidak tersedia silahkan isi sendiri.</small>
								</div>
								<div class="col-12">
									<hr>
								</div>

								<!-- STATUS SOSIAL -->
								<div class="col-12 mb-2">
									<label class="col-12 p-1 mb-2 text-center text-white text-xs bg-primary rounded">Status Sosial</label>
									<div class="row">

										<label class="col-md-6 text-xs mb-2">Hubungan Pasien Dengan Anggota Keluarga</label>
										<div class="col-md-6" style="text-align-last: right;">
											<input class="mx-2" type="radio" name="hubungan_pasien" id="hubungan_pasien_ya" value="1">
											<label class="form-check-label text-xs">Baik</label>
											<input class="mx-2" type="radio" name="hubungan_pasien" id="hubungan_pasien_tidak" value="0" checked="">
											<label class="form-check-label text-xs">Tidak Baik</label>
										</div>

										<label class="col-md-12 mb-1 text-xs">Kerabat Terdekat Yang Dapat Dihubungi</label>
										<div class="col-md-12 mb-1" style="text-align-last: right;">
											<input type="text" name="kerabat_terdekat" id="kerabat_terdekat" class="form-control form-control-sm" />
										</div>

										<div class="col-12 my-1">
											<div class="input-group w-100">
												<div class="input-group-text py-1 text-xxs">Nama</div>
												<input type="text" class="form-control form-control-sm" name="nama_kerabat" />
											</div>
										</div>
										<div class="col-md-6 my-1">
											<div class="input-group w-100">
												<div class="input-group-text py-1 text-xxs">Hubungan</div>
												<input type="text" class="form-control form-control-sm" name="hubungan_kerabat" />
											</div>
										</div>
										<div class="col-md-6 my-1">
											<div class="input-group w-100">
												<div class="input-group-text py-1 text-xxs">No Telp</div>
												<input type="text" class="form-control form-control-sm text-xxs" name="telp_kerabat" />
											</div>
										</div>

										<div class="col-12 my-1">
											<label class="col text-xs">Status Ekonomi</label>
											<input type="text" name="status_ekonomi" id="status_ekonomi" class="form-control form-control-sm" />
											<small class="form-text text-muted text-xxs p-0">Jika opsi tidak tersedia silahkan isi sendiri.</small>
										</div>

									</div>
								</div>
								<!--  -->

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- KEBUTUHAN KOMUNIKASI DAN EDUKASI -->
		<div class="col-lg-12 col-xl-12">
			<div class="card mb-3">
				<div class="card-header bg-primary rounded-top p-3 py-2">
					<h6 class="text-white text-xs mb-0">Kebutuhan Komunikasi dan Edukasi</h6>
				</div>
				<div class="card-body p-3">
					<div class="row">

						<div class="col-12 mb-2">
							<div class="row">
								<label class="col text-xs">Terdapat hambatan dalam pembelajaran</label>
								<div class="col" style="text-align-last: right;">
									<input class="mx-2" type="radio" name="hambatan_dlm_pembelajaran" id="hambatan_dlm_pembelajaran_ya" value="1">
									<label class="form-check-label text-xs">Ya</label>
									<input class="mx-2" type="radio" name="hambatan_dlm_pembelajaran" id="hambatan_dlm_pembelajaran_tidak" value="0" checked="">
									<label class="form-check-label text-xs">Tidak</label>
								</div>
							</div>
							<input type="text" name="hambatan_dlm_pembelajaran_val" id="hambatan_dlm_pembelajaran_val" class="form-control form-control-sm" />
						</div>

						<div class="col-12 mb-2">
							<div class="row">
								<label class="col text-xs">Dibutuhkan penerjemah</label>
								<div class="col" style="text-align-last: right;">
									<input class="mx-2" type="radio" name="dibutuhkan_penerjemah" id="dibutuhkan_penerjemah_ya" value="1">
									<label class="form-check-label text-xs">Ya</label>
									<input class="mx-2" type="radio" name="dibutuhkan_penerjemah" id="dibutuhkan_penerjemah_tidak" value="0" checked="">
									<label class="form-check-label text-xs">Tidak</label>
								</div>
							</div>
							<input type="text" name="dibutuhkan_penerjemah_val" id="dibutuhkan_penerjemah_val" class="form-control form-control-sm" />
						</div>

						<div class="col-12 mb-2">
							<div class="row">
								<label class="col text-xs">Bahasa Isyarat</label>
								<div class="col" style="text-align-last: right;">
									<input class="mx-2" type="radio" name="bahasa_isyarat" id="bahasa_isyarat_ya" value="1">
									<label class="form-check-label text-xs">Ya</label>
									<input class="mx-2" type="radio" name="bahasa_isyarat" id="bahasa_isyarat_tidak" value="0" checked="">
									<label class="form-check-label text-xs">Tidak</label>
								</div>
							</div>
							<input type="text" name="bahasa_isyarat_val" id="bahasa_isyarat_val" class="form-control form-control-sm" />
						</div>

						<div class="col-12 mb-2">
							<div class="row">
								<label class="col text-xs">Kebutuhan Edukasi</label>
							</div>
							<input type="text" name="kebutuhan_edukasi_val" id="kebutuhan_edukasi_val" class="form-control form-control-sm" />
							<small class="form-text text-muted text-xxs p-0">Jika opsi tidak tersedia silahkan isi sendiri.</small>
						</div>

					</div>
				</div>
			</div>
		</div>

		<!-- RISIKO CEDERA/JATUH -->
		<div class="col-lg-12 col-xl-12">
			<div class="card mb-3">
				<div class="card-header bg-primary rounded-top p-3 py-2">
					<h6 class="text-white text-xs mb-0">Risiko Cedera/Jatuh</h6>
				</div>
				<div class="card-body p-3">
					<div class="row">

						<div class="col-12 mb-2">
							<div class="row">
								<label class="col text-xs">Perhatikan cara berjalan pasien saat akan duduk di kursi. Apakah pasien tampak tidak seimbang (sempoyongan) ?</label>
								<div class="col-12" style="text-align-last: left;">
									<input class="mx-2" data-group="risiko_cedera" type="radio" name="risiko_cedera_a" id="risiko_cedera_a_ya" value="1">
									<label class="form-check-label text-xs">Ya</label>
									<input class="mx-2" data-group="risiko_cedera" type="radio" name="risiko_cedera_a" id="risiko_cedera_a_tidak" value="0" checked="">
									<label class="form-check-label text-xs">Tidak</label>
								</div>
							</div>
						</div>

						<div class="col-12 mb-2">
							<div class="row">
								<label class="col text-xs">Apakah pasien memegang pinggiran kursi atau meja atau benda lain sebagai penopang saat akan duduk ?</label>
								<div class="col-12" style="text-align-last: left;">
									<input class="mx-2" data-group="risiko_cedera" type="radio" name="risiko_cedera_b" id="risiko_cedera_b_ya" value="1">
									<label class="form-check-label text-xs">Ya</label>
									<input class="mx-2" data-group="risiko_cedera" type="radio" name="risiko_cedera_b" id="risiko_cedera_b_tidak" value="0" checked="">
									<label class="form-check-label text-xs">Tidak</label>
								</div>
							</div>
						</div>

					</div>
				</div>
				<div class="card-footer d-flex p-2 align-items-center" id="hasil_resiko_cedera">
					<div class="w-25 text-xs text-center">Hasil</div>
					<div class="w-75 text-xs text-center rounded-pill p-1"></div>
				</div>
			</div>
		</div>

		<!-- STATUS FUNGSIONAL -->
		<div class="col-lg-12 col-xl-12">
			<div class="card mb-3">
				<div class="card-header bg-primary rounded-top p-3 py-2">
					<h6 class="text-white text-xs mb-0">Status Fungsional</h6>
				</div>
				<div class="card-body p-3">
					<div class="row">

						<div class="col-12 mb-2">
							<div class="row">
								<label class="col-md-5 text-xs">Aktivitas dan Mobilisasi</label>
								<div class="col" style="text-align-last: right;">
									<div class="btn-group">
										<input class="btn-check mx-2" data-group="risiko_cedera" type="radio" name="aktivitas_mobilisasi" id="aktivitas_mobilisasi_ya" value="1">
										<label class="btn btn-outline-primary btn-sm text-xxs" for="aktivitas_mobilisasi_ya">Dibantu</label>
										<input class="btn-check mx-2" data-group="risiko_cedera" type="radio" name="aktivitas_mobilisasi" id="aktivitas_mobilisasi_tidak" value="0" checked="">
										<label class="btn btn-outline-primary btn-sm text-xxs" for="aktivitas_mobilisasi_tidak">Tidak Dibantu</label>
									</div>
								</div>
							</div>
						</div>

						<div class="col-12 mb-2">
							<div class="row">
								<label class="col text-xs">Alat bantu jalan</label>
								<div class="col" style="text-align-last: right;">
									<input class="mx-2" type="radio" name="alat_bantu_jalan" id="alat_bantu_jalan_ya" value="1">
									<label class="form-check-label text-xs">Ya</label>
									<input class="mx-2" type="radio" name="alat_bantu_jalan" id="alat_bantu_jalan_tidak" value="0" checked="">
									<label class="form-check-label text-xs">Tidak</label>
								</div>
							</div>
							<input type="text" name="alat_bantu_jalan_val" id="alat_bantu_jalan_val" class="form-control form-control-sm" placeholder="Sebutkan...">
						</div>

					</div>
				</div>
			</div>
		</div>

		<!-- SKALA NYERI -->
		<div class="col-xl-12 my-1">
			<div class="card mb-2">
				<div class="card-header bg-primary rounded-top p-3 py-2">
					<h6 class="text-white mb-0 form-label fw-thinbold">Skala Nyeri</h5>
				</div>
				<div class="card-body p-3">
					<div class="row">

						<div class="col-md-6 col-xl-4 mb-2">
							<div class="form-group row m-0 mt-2">
								<label class="col-12 col-lg-6 text-xs px-0">Ada Nyeri</label>
								<div class="col-12 col-lg-6 px-0" style="text-align-last: right;">
									<div class="btn-group">
										<input class="btn-check" type="radio" name="ada_nyeri" id="ada_nyeri_ya" value="1">
										<label class="btn btn-outline-primary btn-sm text-xs" for="ada_nyeri_ya">Ya</label>
										<input class="btn-check" type="radio" name="ada_nyeri" id="ada_nyeri_tidak" value="0" checked>
										<label class="btn btn-outline-primary btn-sm text-xs" for="ada_nyeri_tidak">Tidak</label>
									</div>
								</div>
							</div>
							<div class="form-group row m-0 mt-2 box-point-nyeri position-relative">
								<div class="overlayDisabled"></div>
								<div class="col-12 p-0 w-100">
									<div class="form-text text-muted text-xs">
										Tentukan point nyeri yang anda inginkan.
									</div>
									<div class="d-flex">
										<?php for ($i = 0; $i <= 10; $i++) { ?>
											<div class="border border-dark fw-thinbold text-center py-1" id="point_nyeri_<?= $i ?>" onclick="pointSkriningNyeri($(this).html())" style="width: 10%; cursor: pointer;"><?= $i ?></div>
										<?php } ?>
									</div>
								</div>
								<div class="col-lg-2">
									<div class="row text-center mt-3">
										<label class="col-lg-12 text-xs px-0">Point Nyeri</label>
										<div class="col-lg-12">
											<label class="text-lg px-0 fw-bold my-2" id="total_point_nyeri">0</label>
											<input type="hidden" name="val_total_point_nyeri" id="val_total_point_nyeri" value="0">
										</div>
									</div>
								</div>
								<div class="col-lg-10">
									<div class="row mt-3">
										<div class="col-lg-2"></div>
										<label class="col-lg-10 text-xs text-center px-0">Hasil Skrining</label>
										<div class="col-lg-2 emoji-skrining">
											<!-- <i class="far fa-smile-beam fa-3x"></i> -->
											<img src="<?= base_url('assets/img/skrining/icon_0.png') ?>" alt="Tidak Nyeri" class="m-2 w-100" />
										</div>
										<div class="col-10 desc-skrining text-dark form-text text-center text-xxs" style="place-self: center;">Tidak Nyeri</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-6 col-xl-8 mb-2">

							<div class="row">
								<label class="col text-xs">Nyeri Akut</label>
								<div class="col-6 py-0" style="text-align-last: right;">
									<input class="mr-2" type="radio" name="nyeri_akut" id="nyeri_akut_ya" value="1">
									<label class="form-check-label text-xs">Ya</label>
									<input class="mx-2" type="radio" name="nyeri_akut" id="nyeri_akut_tidak" value="0" checked="">
									<label class="form-check-label text-xs">Tidak</label>
								</div>
							</div>
							<div class="row">
								<div class="col">
									<div class="input-group">
										<div class="input-group-text py-1 text-xxs">Lokasi</div>
										<input type="text" data-group="nyeri_akut_val" class="form-control form-control-sm" placeholder="Lokasi...">
									</div>
								</div>
								<div class="col">
									<div class="input-group">
										<div class="input-group-text py-1 text-xxs">Frekuensi</div>
										<input type="text" data-group="nyeri_akut_val" class="form-control form-control-sm" placeholder="Frekuensi...">
									</div>
								</div>
								<div class="col">
									<div class="input-group">
										<div class="input-group-text py-1 text-xxs">Durasi</div>
										<input type="text" data-group="nyeri_akut_val" class="form-control form-control-sm" placeholder="Durasi...">
									</div>
								</div>
							</div>

							<div class="my-1"></div>

							<div class="row">
								<label class="col text-xs">Nyeri Kronis</label>
								<div class="col-6 py-0" style="text-align-last: right;">
									<input class="mr-2" type="radio" name="nyeri_kronis" id="nyeri_kronis_ya" value="1">
									<label class="form-check-label text-xs">Ya</label>
									<input class="mx-2" type="radio" name="nyeri_kronis" id="nyeri_kronis_tidak" value="0" checked="">
									<label class="form-check-label text-xs">Tidak</label>
								</div>
							</div>
							<div class="row">
								<div class="col">
									<div class="input-group">
										<div class="input-group-text py-1 text-xxs">Lokasi</div>
										<input type="text" data-group="nyeri_kronis_val" class="form-control form-control-sm" placeholder="Lokasi...">
									</div>
								</div>
								<div class="col">
									<div class="input-group">
										<div class="input-group-text py-1 text-xxs">Frekuensi</div>
										<input type="text" data-group="nyeri_kronis_val" class="form-control form-control-sm" placeholder="Frekuensi...">
									</div>
								</div>
								<div class="col">
									<div class="input-group">
										<div class="input-group-text py-1 text-xxs">Durasi</div>
										<input type="text" data-group="nyeri_kronis_val" class="form-control form-control-sm" placeholder="Durasi...">
									</div>
								</div>
							</div>

							<div class="my-1"></div>

							<div class="row">
								<label class="col-12 text-xs mb-1">Nyeri Hilang</label>
								<div class="col-12">
									<input type="text" id="nyeri_hilang" name="nyeri_hilang" class="form-control form-control-sm" placeholder="">
									<small class="form-text text-muted text-xxs p-0">Jika opsi tidak tersedia silahkan isi sendiri.</small>
								</div>
							</div>

						</div>

					</div>
				</div>
			</div>
		</div>

		<!-- DAFTAR MASALAH KEPERAWTAN PRIORITAS -->
		<div class="col-xl-12 my-1">
			<div class="card mb-2">
				<div class="card-header bg-primary rounded-top p-3 py-2">
					<h6 class="text-white mb-0 form-label fw-thinbold">Daftar Masalah Keperawtan Prioritas</h5>
				</div>
				<div class="card-body p-3">
					<div class="row">
						<div class="col-12">
							<select id="cb_analisa_masalah_kep" class="form-select form-select-sm text-xs mb-2">
								<option value="">-- PILIH ANALISA MASALAH KEPERAWATAN --</option>
								<option data-intervensi="Menganjurkan pasien untuk minum obat teratur" value="0">Bersihkan jalan nafas tidak efektif</option>
								<option data-intervensi="Menganjurkan pasien untuk makan teratur" value="1">Perubahan nutrisi kurang/lebih cairan </option>
								<option data-intervensi="Menganjurkan pasien untuk minum air hangat" value="2">Keseimbangan cairan dan elektrolit</option>
								<option data-intervensi="Menganjurkan pasien untuk minum kurang lebih 8 gelas" value="3">Gangguan komunikasi verbal</option>
								<option data-intervensi="Menganjurkan pasien untuk membatasi minum" value="4">Pola nafas tidak efektif</option>
								<option data-intervensi="Menganjurkan pasien untuk cukup istirahat" value="5">Risiko infeksi/sepsis</option>
								<option data-intervensi="Menganjurkan pasien untuk kontrol teratur setelah obat habis" value="6">Gangguan integritas kulit/jaringan</option>
								<option data-intervensi="Menganjurkan pasien untu membatasi aktivitas" value="7">Gangguan pola tidur</option>
								<option value="8">Nyeri</option>
								<option value="9">Intoleransi aktivitas </option>
								<option value="10">Konstipasi/diare</option>
								<option value="11">Cemas</option>
								<option value="12">Hipertermi/hipotermi</option>
							</select>
						</div>
					</div>
					<table id="list_masalah_keperawatan" class="table table-bordered table-striped table-sm align-items-center mb-0">
						<thead>
							<tr>
								<th class="text-xs text-center w-50">ANALISA MASALAH KEPERAWATAN</th>
								<th class="text-xs text-center w-50">INTERVENSI</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<!-- ACTION -->
		<div class="col-xl-12 my-1">
			<div class="card">
				<div class="card-body p-2">
					<div class="row">
						<div class="col">
							<button type="button" class="btn btn-outline-primary btn-sm w-100 text-xs py-2" id="simpan">Simpan</button>
						</div>
						<div class="col">
							<button type="button" class="btn btn-outline-secondary btn-sm w-100 text-xs py-2" id="cetak">Cetak</button>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
	<?= form_close() ?>
</div>
