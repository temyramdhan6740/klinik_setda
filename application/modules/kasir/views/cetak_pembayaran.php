<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- <link rel="stylesheet" href="<?= base_url('assets/sneat/assets/vendor/css/core.css'); ?>" class="template-customizer-core-css" /> -->
	<title>Cetak Pembayaran</title>
	<style>
		@media print {
			@page {
				size: A5;
				margin: 4mm;
			}

			body {
				font-family: sans-serif;
				width: 148mm;
				height: 210mm;
				margin: 0;
				padding: 0;
			}
		}

		body {
			font-family: sans-serif;
		}

		.text-sm {
			font-size: 10px;
		}

		.text-center {
			text-align: center;
		}

		.text-left {
			text-align: center;
		}

		.text-right {
			text-align: right;
		}

		.float-left {
			float: left;
		}

		.float-right {
			float: right;
		}

		.fw-bold {
			font-weight: bold;
		}

		div.separator {
			border-top: 1px solid #000;
			margin: 0.2vh 0 0.2vh 0;
		}

		section.identity tr td {
			vertical-align: top;
		}

		section.content thead,
		section.content tbody {
			text-align: justify;
		}

		section.content tbody tr td:nth-child(2),
		section.content tbody tr td:nth-child(3) {
			text-align: right;
		}

		section.content tfoot tr td:nth-child(2),
		section.content tfoot tr td:nth-child(3) {
			text-align: right;
		}

		.monospace {
			font-family: monospace !important;
		}
	</style>
</head>

<body>
	<!-- header -->
	<section class="header">
		<table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
			<tr>
				<th width="50"><img src="<?= base_url('assets/img/logo_jabarprov.png') ?>" width="80%" height="auto" alt="Logo Jabar" /></th>
				<th class="text-sm" style="text-align: left; line-height: 0.8rem;">
					<div>RUMAH SAKIT UMUM DAERAH AL-IHSAN</div>
					<div style="font-weight: normal">Jl. Kiastamanggala - Baleendah 40381</div>
					<div style="font-weight: normal">Bandung, Jawa Barat - Telp. (022) 5940872</div>
				</th>
				<th class="text-sm">
					<div style="text-align: center; width: 100%;">
						<div>No Medrek</div>
						<div class="monospace" style="border: 1px solid; padding: 0.2rem"><?= @$data_rm->no_rm ?></div>
					</div>
				</th>
			</tr>
		</table>
		<!-- kop surat content -->
		<div style="width: 100%;">
			<div style="border-top: 2px solid; margin: 0"></div>
			<div style="border-top: 1px solid; margin-top: 1px"></div>
		</div>
		<!-- title content -->
		<div style="width: 100%; border: 1px solid; margin-top: 1vh">
			<h5 style="margin: 1vh 0 1vh 0; text-transform: uppercase; text-align: center;">Resume Pembayaran Pasien</h5>
		</div>
	</section>

	<div class="separator"></div>

	<!-- identity content -->
	<section class="identity">
		<div style="display: flex">
			<!-- left content -->
			<div style="width: 50%;">
				<table class="text-sm" border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
					<tr>
						<td width="80">Nama Pasien</td>
						<td>:</td>
						<td><?= @$data_rm->nama_pasien ?></td>
					</tr>
					<tr>
						<td>Dokter</td>
						<td>:</td>
						<td><?= @$data_rm->nama_dokter ?></td>
					</tr>
					<tr>
						<td>Alamat</td>
						<td>:</td>
						<td><?= @$data_rm->alamat ?></td>
					</tr>
				</table>
			</div>
			<!-- right content -->
			<div style="width: 50%;">
				<table class="text-sm" border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
					<tr>
						<td>Biro</td>
						<td>:</td>
						<td><?= @$data_rm->biro ?></td>
					</tr>
					<tr>
						<td>No. Struk</td>
						<td>:</td>
						<td><?= @$data_rm->no_struck ?></td>
					</tr>
					<tr>
						<td>Poli</td>
						<td>:</td>
						<td><?= @$data_rm->nama_poli ?></td>
					</tr>
				</table>
			</div>
		</div>
	</section>

	<!-- content -->
	<section class="content">
		<div class="separator"></div>
		<div style="width: 100%;">
			<table class="text-sm" border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
				<thead>
					<tr>
						<th>PEMERIKSAAN RAWAT JALAN</th>
						<th width="40" style="text-align: right">Qty</th>
						<th width="85"></th>
					</tr>
				</thead>
				<tbody class="monospace">
					<?php foreach ($data_tindakan['data'] as $dTindakan) { ?>
						<tr style="color: <?= (@$dTindakan->is_paid == 0) ? 'red' : 'black' ?>;">
							<td><?= @$dTindakan->nama_tindakan ?></td>
							<td>1</td>
							<td><span class="float-left" style="padding-left: 1rem;">Rp.</span> <?= @$dTindakan->harga ?></td>
						</tr>
					<?php } ?>
					<tr>
						<td colspan="3">
							<div class="separator"></div>
						</td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td><span class="float-left" style="padding-left: 1rem;">Rp.</span> <?= @number_format($data_tindakan['total'], 0, ",", ".") ?></td>
					</tr>
					<tr>
						<td colspan="3">
							<div class="separator"></div>
						</td>
					</tr>
				</tbody>
				<thead>
					<tr>
						<th>RESEP</th>
						<th></th>
						<th></th>
					</tr>
				</thead>
				<tbody class="monospace">
					<?php foreach ($data_resep['data'] as $dtResep) { ?>
						<tr>
							<td><?= @$dtResep->nama_resep ?></td>
							<td><?= @$dtResep->qty ?></td>
							<td><span class="float-left" style="padding-left: 1rem;">Rp.</span> <?= @$dtResep->subtotal ?></td>
						</tr>
					<?php } ?>
					<tr>
						<td colspan="3">
							<div class="separator"></div>
						</td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td><span class="float-left" style="padding-left: 1rem;">Rp.</span> <?= @number_format($data_resep['total'], 0, ",", ".") ?></td>
					</tr>
				</tbody>
			</table>
		</div>
	</section>

	<!-- footer -->
	<section class="footer">
		<div class="separator"></div>
		<div style="display: flex;">
			<div style="width: 50%;">
				<table class="text-sm" border="0" cellspacing="0" cellpadding="0" style="width: 100%; text-align: left;">
					<tfoot>
						<tr>
							<th width="140">Status Pasien</th>
							<td>:</td>
							<td>BPJS NON PBI</td>
						</tr>
						<tr>
							<th width="140">Jenis Pembayaran</th>
							<td>:</td>
							<td>TUNAI</td>
						</tr>
					</tfoot>
				</table>
			</div>
			<div style="width: 50%;">
				<table class="text-sm" border="0" cellspacing="0" cellpadding="0" style="width: 100%; text-align: right;">
					<tbody>
						<tr>
							<th style="text-align: left" width="150">Total (Sebelum Checkout)</th>
							<td>:</td>
							<td width="85" class="monospace"><span class="float-left" style="padding-left: 1rem;">Rp.</span> <?= @number_format($data_tindakan['total_sebelum_checkout'], 0, ",", ".") ?></td>
						</tr>
						<tr>
							<th style="text-align: left" width="150">Jumlah Pembayaran</th>
							<td>:</td>
							<td width="85" class="monospace"><span class="float-left" style="padding-left: 1rem;">Rp.</span> <?= @number_format($data_pembayaran->amount_paid, 0, ",", ".") ?></td>
						</tr>
						<tr>
							<th style="text-align: left" width="150">Total Piutang</th>
							<td>:</td>
							<td width="85" class="monospace"><span class="float-left" style="padding-left: 1rem;">Rp.</span> <?= @number_format($data_pembayaran->amount_outstanding, 0, ",", ".") ?></td>
						</tr>
						<tr>
							<th style="text-align: left" width="150">Total Kembalian</th>
							<td>:</td>
							<td width="85" class="monospace"><span class="float-left" style="padding-left: 1rem;">Rp.</span> <?= @number_format($data_pembayaran->amount_change, 0, ",", ".") ?></td>
						</tr>
						<tr>
							<th style="text-align: left" width="150">Biaya Administrasi</th>
							<td>:</td>
							<td width="85" class="monospace"><span class="float-left" style="padding-left: 1rem;">Rp.</span> 0</td>
						</tr>
						<tr>
							<th style="text-align: left" width="150">Total</th>
							<td>:</td>
							<td width="85" class="fw-bold monospace"><span class="float-left" style="padding-left: 1rem;">Rp.</span> <?= @number_format($data_total['total_seluruh'], 0, ",", ".") ?></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div style="display: block; margin-top: 3vh">
			<div style="width: 100%;">
				<table class="text-sm" border="0" cellspacing="0" cellpadding="0" style="width: 100%; text-align: left;">
					<tbody>
						<tr>
							<td width="50%">
								<div style="text-align: center;">
									<div class="fw-bold">Petugas</div>
									<div style="margin: 1vh; padding: 5vh; border: 1px dashed"></div>
									<div>(<?= @$this->session->userdata('nama') ?>)</div>
								</div>
							</td>
							<td width="50%">
								<div style="text-align: center;">
									<div class="fw-bold">Pasien/Kel.Pasien</div>
									<div style="margin: 1vh; padding: 5vh; border: 1px dashed"></div>
									<div>(____________________________________)</div>
								</div>
							</td>
						</tr>
					</tbody>
				</table>
				<table class="text-sm" border="0" cellspacing="0" cellpadding="0" style="width: 100%; text-align: left; margin-top: 2vh;">
					<tfoot>
						<tr>
							<td>
								<div style="display: flex">
									<div style="width: 50%; position: relative;">
										<div style="position: absolute; display: flex; left: 0">
											<div class="fw-bold">Pengguna/User</div>
											<div style="padding: 0 1vh 0 1vh">:</div>
											<div><?= @$this->session->userdata('nama') ?></div>
										</div>
									</div>
									<div style="width: 50%; position: relative;">
										<div style="position: absolute; display: flex; right: 0">
											<div class="fw-bold">Tgl Registrasi</div>
											<div style="padding: 0 1vh 0 1vh">:</div>
											<div><?= date('Y-m-d') ?></div>
										</div>
									</div>
								</div>
							</td>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</section>

	<script src="<?= base_url('assets/sneat/assets/vendor/libs/jquery/jquery.js'); ?>"></script>
	<script>
		window.addEventListener('load', function() {
			setTimeout(function() {
				window.print();
			}, 100); // Tambahkan delay 500ms agar browser siap
		});
	</script>

</body>

</html>
