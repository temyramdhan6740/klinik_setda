<script src="<?= base_url('assets/plugins/select2/select2.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables/datatable.js') ?>"></script>
<script src="<?= base_url('assets/plugins/flatpickr/dist/flatpickr.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/flatpickr/dist/l10n/id.js') ?>"></script>
<script src="<?= base_url('assets/plugins/moment/moment.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/daterangepicker/daterangepicker.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables-buttons/js/buttons.html5.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables-buttons/js/buttons.print.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables-buttons/js/buttons.colVis.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/jszip/jszip.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/pdfmake/pdfmake.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/pdfmake/vfs_fonts.js') ?>"></script>
<script src="<?= base_url('assets/plugins/jquery.inputmask/dist/jquery.inputmask.min.js') ?>"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
	moment.locale('id');
	var baseURL = "<?= base_url() ?>";
	var rawTindakanDB = [];
	var rawResepDB = [];

	$('[datetime-picker]').daterangepicker({
		"showDropdowns": true,
		ranges: {
			'Today': [moment(), moment()],
			'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
			'Last 7 Days': [moment().subtract(6, 'days'), moment()],
			'Last 30 Days': [moment().subtract(29, 'days'), moment()],
			'This Month': [moment().startOf('month'), moment().endOf('month')],
			'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf(
				'month')]
		},
		"alwaysShowCalendars": true,

		"opens": "center",
		"buttonClasses": "btn btn-md",
		"locale": {
			"format": "YYYY-MM-DD",
		},
	}, function(start, end, label) {

	});
	$(":input").inputmask();

	var tableListDataPasien = $("#table-list-data-pasien").DataTable({
		retrieve: false,
		language: {
			zeroRecords: "Tidak ada data yang ditemukan",
			infoEmpty: ""
		}
	});
	var tableListAntrian = $("#table-list-antrian").DataTable({
		retrieve: false,
		// drawCallback: function(settings) {
		// 	const api = this.api();
		// 	const rows = api.rows({
		// 		page: 'current'
		// 	}).nodes();
		// 	let last = null;

		// 	api.column(6, {
		// 		page: 'current'
		// 	}).data().each(function(group, i) {
		// 		if (last !== group) {
		// 			$(rows).eq(i).before('<tr class="group"><td class="bg-primary text-white fw-bold" colspan="8">' + group + '</td></tr>');
		// 			last = group;
		// 		}
		// 	});
		// },
		language: {
			zeroRecords: "Tidak ada data yang ditemukan",
			infoEmpty: ""
		}
	});
	var tableListTindakanCheckout = $("#table-list-tindakan-checkout").DataTable({
		retrieve: false,
		paging: false,
		ordering: false,
		info: false,
		language: {
			zeroRecords: "Tidak ada data yang ditemukan",
			infoEmpty: ""
		}
	});
	var tableListTindakanKeranjang = $("#table-list-tindakan-keranjang").DataTable({
		retrieve: false,
		ordering: true,
		// paging: false,
		language: {
			zeroRecords: "Tidak ada data yang ditemukan",
			infoEmpty: ""
		}
	});
	var tableListResep = $("#table-list-resep").DataTable({
		retrieve: false,
		paging: false,
		ordering: false,
		info: false,
		language: {
			zeroRecords: "Tidak ada data yang ditemukan",
			infoEmpty: ""
		}
	})
	var tableListResepKeranjang = $("#table-list-resep-keranjang").DataTable({
		retrieve: false,
		ordering: true,
		// paging: false,
		language: {
			zeroRecords: "Tidak ada data yang ditemukan",
			infoEmpty: ""
		}
	});
	var tableListRekap = $("#table-list-rekap").DataTable({
		retrieve: false,
		ordering: true,
		// scrollX: true,
		// scrollY: true,
		// paging: false,
		language: {
			zeroRecords: "Tidak ada data yang ditemukan",
			infoEmpty: ""
		},
		buttons: [
			Export('csv', 'fas fa-file-csv', 'Export CSV',
				'Rekap_' + moment().format('DD-MM-YYYY')),
			Export('excel', 'fas fa-file-excel', 'Export Excel',
				'Rekap_' + moment().format('DD-MM-YYYY')),
			Export('pdf', 'fas fa-file-pdf', 'Export PDF',
				'Rekap_' + moment().format('DD-MM-YYYY')),
			Export('print', 'fas fa-print', 'Print Transaksi',
				'Rekap_' + moment().format('DD-MM-YYYY')),
		]
	});

	// pencarian antrian
	$('[name="searach_list_antrian"]').on('keyup', function() {
		tableListAntrian.search($(this).val()).draw();
	})

	// pencarian tindakan
	$('[name="searach_tindakan"]').on('keyup', function() {
		tableListTindakanCheckout.search($(this).val()).draw();
	})

	// pencarian tindakan keranjang
	$('[name="searach_list_tindakan_keranjang"]').on('keyup', function() {
		tableListTindakanKeranjang.search($(this).val()).draw();
	})

	// pencarian list rekap
	$('[name="searach_list_rekap"]').on('keyup', function() {
		tableListRekap.search($(this).val()).draw();
	})

	// tabel list rekap ketika ditekan
	$('[data-is-rekap]').on('click', function() {
		if ($(this).attr('data-is-rekap') == 'false') {
			$(".content-1 .sub-1").css('display', 'block');
			$(".content-1 .sub-2").css('display', 'block');
			$(".content-2").css('display', 'none');
			return false;
		}
		$(".content-1 .sub-1").css('display', 'none');
		$(".content-1 .sub-2").css('display', 'none');
		$(".content-2").css('display', 'block');
	})

	// tambah tindakan kedalam keranjang tindakan
	$('[name="btn_tambah_tindakan"]').on('click', function(e) {
		$.ajax({
			url: baseURL + 'kasir/api/get_tindakan',
			type: 'POST',
			data: {
				poli: $('[name="poli_antrian"]').val()
			},
			dataType: 'json',
			beforeSend: function() {
				$('[name="btn_tambah_tindakan"]').prop('disabled', true);
			},
			success: function(data) {
				if (data.metaData.code == 200) {
					$("#modal-list-tindakan").modal('show')
					tableListTindakanKeranjang.clear().draw();
					$.each(data.response, function(index, value) {
						tableListTindakanKeranjang.row.add([
							`(${value.poli}) ${value.actname}`,
							formatRupiah(value.fee).split(',')[0],
							`<button type="button" class="btn btn-outline-primary btn-xs m-0 p-0 rounded-0 w-100" onclick="pilihTindakanPerda('${value.actcode}')">Pilih</button>`,
						]).draw(false);
					});
				}
			},
			complete: function() {
				$('[name="btn_tambah_tindakan"]').prop('disabled', false);
			},
			error: function(jqXHR, textStatus, errorThrown) {
				$('[name="btn_tambah_tindakan"]').prop('disabled', false);
				toastr.error("Maaf ada kesalahan teknis.")
				console.log(jqXHR + textStatus + errorThrown);
			}
		})
	})

	// tambah tindakan kedalam keranjang tindakan
	$('[name="btn_tambah_resep"]').on('click', function(e) {
		$("#modal-list-resep").modal('show')
	})

	// cari pasien berdasarkan antrian
	$('#cari-list-antrian').on('click', function() {
		let postData = {};
		$('[data-form="list-antrian"]').each(function() {
			postData[$(this).attr('name')] = $(this).val()
		})

		$.ajax({
			url: baseURL + 'kasir/api/get_list_antrian',
			type: 'POST',
			data: postData,
			dataType: 'json',
			beforeSend: function() {
				$('#cari-list-antrian').prop('disabled', true);
			},
			success: function(data) {
				if (data.metaData.code == 200) {
					tableListAntrian.clear().draw();
					$.each(data.response, function(index, value) {
						tableListAntrian.row.add([
							`<button type="button" class="btn btn-outline-primary btn-xs m-0 p-0 rounded-0 w-100 btn-pilih-tindakan" onclick="getRM('${value.no_struck}')">Pilih</button>`,
							value.no_rm,
							value.nama_pasien,
							value.antrian,
							value.no_ktp,
							value.reg_time,
							// value.nama_dokter,
							value.nama_poli,
						]).draw(false);
					});
					return;
				}
				$('#modal-list-antrian').modal('hide');
				$('#cari-list-antrian').prop('disabled', false);
				toastr.error("Data Tidak Tersedia.");
			},
			complete: function() {
				$('#modal-list-antrian').modal('show');
				$('#cari-list-antrian').prop('disabled', false);
			},
			error: function(jqXHR, textStatus, errorThrown) {
				$('#cari-list-antrian').prop('disabled', false);
				toastr.error("Maaf ada kesalahan teknis.")
				console.log(jqXHR + textStatus + errorThrown);
			}
		})
	})

	// cari pasien berdasarkan no rm
	$('#btn-cari-pasien-filter').on('click', function() {
		$.ajax({
			url: baseURL + 'kasir/api/get_list_antrian',
			type: 'POST',
			data: {
				no_rm: $('[name="cust_code_filter"]').val()
			},
			dataType: 'json',
			beforeSend: function() {
				$('#cari-list-antrian').prop('disabled', true);
			},
			success: function(data) {
				if (data.metaData.code == 200) {
					tableListAntrian.clear().draw();
					$.each(data.response, function(index, value) {
						tableListAntrian.row.add([
							`<button type="button" class="btn btn-outline-primary btn-xs m-0 p-0 rounded-0 w-100 btn-pilih-tindakan" onclick="getRM('${value.no_struck}')">Pilih</button>`,
							value.no_rm,
							value.nama_pasien,
							value.antrian,
							value.no_ktp,
							value.reg_time,
							// value.nama_dokter,
							value.nama_poli,
						]).draw(false);
					});
					return;
				}
				$('#modal-list-antrian').modal('hide');
				$('#cari-list-antrian').prop('disabled', false);
				toastr.error("Data Tidak Tersedia.");
			},
			complete: function() {
				$('#modal-list-antrian').modal('show');
				$('#cari-list-antrian').prop('disabled', false);
			},
			error: function(jqXHR, textStatus, errorThrown) {
				$('#cari-list-antrian').prop('disabled', false);
				toastr.error("Maaf ada kesalahan teknis.")
				console.log(jqXHR + textStatus + errorThrown);
			}
		})
	})

	// cari rekap antrian
	$('#cari-list-rekap').on('click', function() {
		panggilListRekap();
	});

	$('#btn-checkout-pay').on('click', function() {
		$.ajax({
			url: baseURL + 'kasir/api/get_payment',
			type: 'POST',
			data: {
				struck_no: $('[name="struck_no"]').val(),
				tran_type: "Rawat Jalan"
			},
			dataType: 'json',
			async: false,
			beforeSend: function() {
				$(this).prop('disabled', true);
			},
			success: function(data) {
				let response = data.response;
				$(this).prop('disabled', false);
				$('[name="checkout_paid"]').val(Number(response?.amount_paid));
				panggilCheckout()
				$("#modal-checkout-pay").modal('show')
			},
			error: function(jqXHR, textStatus, errorThrown) {
				toastr.error("Maaf ada kesalahan teknis.")
				console.log(jqXHR + textStatus + errorThrown);
			}
		})
	});

	$('[name="checkout_paid"]').on('keyup', function() {
		panggilCheckout()
	});

	$('#btn-confirm-checkout').on('click', function() {
		let jmhTotal = parseFloat($(".biaya-total-seluruh").text().replace(/[Rp.\s]/g, ''));
		let pembulatan = parseFloat($(".pembulatan").text().replace(/[Rp.\s]/g, ''));
		$.ajax({
			url: baseURL + 'kasir/api/confirm_checkout',
			type: 'POST',
			data: {
				struck_no: $('[name="struck_no"]').val(),
				cust_code: $('[name="cust_code"]').val(),
				tran_type: "Rawat Jalan",
				amount_total: jmhTotal,
				amount_total_rounding: pembulatan,
				amount_paid: $('[name="checkout_paid"]').val(),
				amount_change: Math.abs($('[data-amount-change]').attr('data-amount-change')),
				amount_outstanding: Math.abs($('[data-amount-outstanding]').attr('data-amount-outstanding')),
			},
			dataType: 'json',
			beforeSend: function() {
				$('#btn-confirm-checkout').prop('disabled', true);
			},
			success: function(data) {
				if (data.metaData.code != 200) {
					$('#btn-checkout-pay').prop('disabled', true);
					$('#btn-confirm-checkout').prop('disabled', true);
					if (data.metaData.code == 202) {
						toastr.error(data.metaData.message);
						$('#btn-checkout-pay').prop('disabled', false);
						$('#btn-confirm-checkout').prop('disabled', false);
						return;
					}
					toastr.error(data.metaData.message);
					return;
				}
				simpanTindakanPerda();
				$("#modal-checkout-pay").modal('hide');
				$('#btn-confirm-checkout').prop('disabled', false);
				getRM($('[name="struck_no"]').val());
				toastr.success("Checkout berhasil dilakukan");
				if (confirm("Checkout berhasil dilakukan, Apakah anda ingin melakukan cetak pembayaran ?") == true) cetak_pembayaran();
			},
			complete: function() {},
			error: function(jqXHR, textStatus, errorThrown) {
				toastr.error("Maaf ada kesalahan teknis.")
				console.log(jqXHR + textStatus + errorThrown);
			}
		})
	});

	function pilihTindakanPerda(actCode) {
		$.ajax({
			url: baseURL + 'kasir/api/get_tindakan_selected',
			type: 'POST',
			data: {
				actcode: actCode
			},
			dataType: 'json',
			beforeSend: function() {
				$('[name="btn_tambah_tindakan"]').prop('disabled', true);
			},
			success: function(data) {
				if (data.metaData.code == 200) {
					let response = data.response;
					// jika tindakan sudah ada di keranjang
					let checkDtKeranjang = $(`#table-keranjang-tindakan tr[kode-tindakan="${response.actcode}"]`);
					if (checkDtKeranjang.length > 0) {
						// convertIntQty = parseInt(checkDtKeranjang.find('.qty').text().trim());
						// checkDtKeranjang.find('.qty').text(convertIntQty + 1);
						// updateSubtotal_KeranjangTindakan(response.actcode);
						// calculateTotal();
						if (response.actcode == 'TDK0009377' || response.actcode == 'TDK0009378') {
							return;
						}
						toastr.error('Tindakan sudah diisi')
						return;
					}

					rawTindakanDB.push({
						"id": `NONDB/${Math.floor(1000 + Math.random() * 9999)}`,
						"no_rm": $('[name="cust_code"]').val(),
						"no_struck": $('[name="struck_no"]').val(),
						"tindakan_code": response.actcode,
						"tran_date": moment().format('YYYY-MM-DD HH:mm:ss'),
						"created_by": "-",
						"nama_tindakan": response.actname,
						"harga": response.fee,
						"is_paid": "0",
						"subtotal": (response.fee * 1)
					});

					let tableKeranjangTindakan = $('#table-keranjang-tindakan tbody');
					let newRow = `
						<tr kode-tindakan="${response.actcode}" data-from-db="false">
							<td>${response.actname}</td>
							<td class="harga">Rp. ${parseInt(response.fee).toLocaleString('id-ID')}</td>
							<td class="qty" contenteditable="false">1</td>
							<td class="subtotal">Rp. ${(response.fee).toLocaleString('id-ID')}</td>
							<td>
								<div class="p-0 text-center">
									<button type="button" class="btn btn-xs rounded-0 p-0 border-0 text-danger remove-item"><i class="fas fa-trash-alt"></i></button>
								</div>
							</td>
						</tr>
					`;
					tableKeranjangTindakan.append(newRow);

					// Event listener untuk qty
					$('.qty').on('keydown', function(evt) {
						if ($(this).text().length === 3 && event.keyCode != 8) {
							evt.preventDefault();
						}
					});
					$('.qty').on('focusout', function(evt) {
						// Menghapus karakter non-angka dari input
						let sanitizedValue = $(this).text().replace(/\D/g, '');
						$(this).text(sanitizedValue);

						// Memastikan panjang input kosong
						if (sanitizedValue.length == 0) {
							evt.preventDefault();
							$(this).text(1);
						}

						// Memastikan panjang input tidak melebihi 3 karakter
						if (sanitizedValue.length >= 3) {
							evt.preventDefault();
							$(this).text(sanitizedValue.slice(0, 3));
						}

						let text = $(this).text();
						let filteredText = text.replace(/\D/g, '');
						filteredText = filteredText.slice(0, 3);
						$(this).text(filteredText);

						console.log(0);
						console.log(text);
						updateSubtotal_KeranjangTindakan(response.actcode);
						calculateTotal()
					});

					// Event listener untuk tombol hapus
					$('.remove-item').on('click', function() {
						const tindakanCode = $(this).closest('tr').attr('kode-tindakan');
						rawTindakanDB = rawTindakanDB.filter(item => item.tindakan_code !== tindakanCode);
						$(this).closest('tr').remove();
						calculateTotal()
					});

					// Perbarui subtotal untuk item baru
					updateSubtotal_KeranjangTindakan(response.actcode);
					calculateTotal();

					$("#modal-list-tindakan").modal('hide')
					return;
				}
				toastr.error("Data Tidak Ada.")
			},
			complete: function() {
				$('[name="btn_tambah_tindakan"]').prop('disabled', false);
			},
			error: function(jqXHR, textStatus, errorThrown) {
				$('[name="btn_tambah_tindakan"]').prop('disabled', false);
				$("#modal-list-tindakan").modal('hide')
				toastr.error("Maaf ada kesalahan teknis.")
				console.log(jqXHR + textStatus + errorThrown);
			}
		})
	}

	function formatRupiah(angka) {
		let number_string = angka.toString();
		let split = number_string.split('.');
		let sisa = split[0].length % 3;
		let rupiah = split[0].substr(0, sisa);
		let ribuan = split[0].substr(sisa).match(/\d{1,3}/gi);

		if (ribuan) {
			separator = sisa ? '.' : '';
			rupiah += separator + ribuan.join('.');
		}

		rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
		return 'Rp. ' + rupiah;
	}

	function updateSubtotal_KeranjangTindakan(actcode) {
		let row = $(`#table-keranjang-tindakan tr[kode-tindakan="${actcode}"]`);
		let priceText = row.find('.harga').text().trim();
		let price = parseFloat(priceText.replace('Rp. ', '').replace(/\./g, ''));
		let quantityText = row.find('.qty').text().trim();
		let quantity = parseInt(quantityText);
		let subtotal = price * quantity;
		console.log(row);

		row.find('.subtotal').text('Rp. ' + subtotal.toLocaleString('id-ID'));
	}

	function calculateTotal() {

		let total_Tindakan = 0;
		$.each(rawTindakanDB, function(i, v) {
			let subtotal = Number(v.harga);
			total_Tindakan += subtotal;
		});

		// $('#table-keranjang-tindakan tbody tr').each(function() {
		// 	let subtotalText = $(this).find('.subtotal').text().trim().replace('Rp. ', '').replaceAll('.', '');
		// 	let subtotal = parseFloat(subtotalText);
		// 	total_Tindakan += subtotal;
		// });

		let total_Resep = 0;
		$.each(rawResepDB, function(i, v) {
			total_Resep += Number(v.subtotal);
		});

		// $('#table-keranjang-resep tbody tr').each(function() {
		// 	let subtotalText = $(this).find('.subtotal').text().trim().replace('Rp. ', '').replaceAll('.', '');
		// 	let subtotal = parseFloat(subtotalText);
		// 	total_Resep += subtotal;
		// });

		let total_Seluruh = (total_Tindakan + total_Resep);
		let total_Pembulatan = Math.round(total_Seluruh / 1000) * 1000;

		$('.biaya-tindakan').text('Rp. ' + total_Tindakan.toLocaleString('id-ID'));
		$('.biaya-obat').text('Rp. ' + total_Resep.toLocaleString('id-ID'));
		$('.biaya-total-seluruh').text('Rp. ' + total_Seluruh.toLocaleString('id-ID'));
		$('.pembulatan').text('Rp. ' + total_Pembulatan.toLocaleString('id-ID'));
		$('.total-seluruh').text('Rp. ' + total_Pembulatan.toLocaleString('id-ID'));
	}

	function getRM(struk) {
		$.ajax({
			url: baseURL + 'kasir/api/get_rm',
			type: 'POST',
			data: {
				struck_no: struk,
				tran_type: "Rawat Jalan"
			},
			dataType: 'json',
			beforeSend: function() {
				$('.btn-pilih-tindakan').prop('disabled', true);
			},
			success: function(data) {
				if (data.metaData.code != 200) {
					toastr.error(data.metaData.message);
					$('#btn-checkout-pay').prop('disabled', true);
					$('#btn-confirm-checkout').prop('disabled', true);
					$('[name="btn_tambah_tindakan"]').prop('disabled', true);
					return;
				}

				$('#modal-list-antrian').modal('hide');
				$('#btn-checkout-pay').prop('disabled', false);
				$('#btn-cetak-pay').prop('disabled', false);
				$('#btn-confirm-checkout').prop('disabled', false);
				$('[name="btn_tambah_tindakan"]').prop('disabled', false);

				rawTindakanDB.length = 0;
				rawResepDB.length = 0;
				tableListTindakanCheckout.clear().draw();

				let response = data.response;
				let response_RM = response.data_rm;
				let response_Pay = response.data_payment;
				$('[name="cust_code"]').val(response_RM.no_rm);
				$('[name="cust_name"]').val(response_RM.nama_pasien);
				$('[name="struck_no"]').val(response_RM.no_struck);
				$('[name="dokter"]').val(response_RM.nama_dokter);
				$('[name="jenis_layanan"]').val(response_RM.jenis_kunjugan);
				$('[name="poli_antrian"]').val(response_RM.kode_poli);
				panggilTindakanPerda_ByStruk(response_RM.no_struck, response);
				panggilResep_ByStruk(response_RM.no_struck);
				$('.kode-pembayaran').text(response.data_generate_payment);
				// panggilPembayaran(response, response.data_generate_payment);
			},
			complete: function() {},
			error: function(jqXHR, textStatus, errorThrown) {
				toastr.error("Maaf ada kesalahan teknis.")
				console.log(jqXHR + textStatus + errorThrown);
			}
		})
	}

	function panggilTindakanPerda_ByStruk(struckNo, dataRM) {
		$.ajax({
			url: baseURL + 'kasir/api/get_tindakan_perda_by_struk',
			type: 'POST',
			data: {
				struck_no: struckNo
			},
			dataType: 'json',
			async: false,
			beforeSend: function() {
				// $('[name="btn_tambah_tindakan"]').prop('disabled', true);
			},
			success: function(data) {
				if (data.metaData.code != 200) {
					$('#table-keranjang-tindakan tbody').html(null);
					calculateTotal();
					return;
				}

				let response = data.response;
				rawTindakanDB.length = 0;
				$.each(response, function(i, v) {
					rawTindakanDB[i] = v;
					rawTindakanDB[i]['subtotal'] = Number(v.harga) * 1;
				});

				// Tindakan (Sebelum Checkout)
				let filterData_BeforeCheckout = response.filter(function(o) {
					return o.is_paid == '0' || o.is_paid == 0;
				});
				$('#table-keranjang-tindakan tbody').html(null);
				$.each(filterData_BeforeCheckout, function(i, v) {
					let newRow = `
						<tr kode-tindakan="${v.tindakan_code}" id-tindakan="${v.id}" data-from-db="true">
							<td>${v.nama_tindakan}</td>
							<td class="harga">Rp. ${(parseInt(v.harga)).toLocaleString('id-ID')}</td>
							<td class="qty" contenteditable="false">1</td>
							<td class="subtotal">Rp. ${(parseInt(v.harga)).toLocaleString('id-ID')}</td>
							<td>
								<div class="p-0 text-center">
									<button type="button" class="btn btn-xs rounded-0 p-0 border-0 text-danger remove-item-db"><i class="fas fa-trash-alt"></i></button>
								</div>
							</td>
						</tr>
					`;
					$('#table-keranjang-tindakan tbody').append(newRow);
				});

				// Tindakan (Sudah Checkout)
				let filterData_AfterCheckout = response.filter(function(o) {
					return o.is_paid == '1' || o.is_paid == 1;
				});
				tableListTindakanCheckout.clear().draw();
				$.each(filterData_AfterCheckout, function(i, v) {
					tableListTindakanCheckout.row.add([
						v.nama_tindakan,
						"Rp. " + parseInt(v.harga).toLocaleString('id-ID'),
						1,
						"Rp. " + parseInt(v.harga).toLocaleString('id-ID'),
						``,
					]).draw(false);
				});

				calculateTotal();
			}
		})
	}

	function panggilResep_ByStruk(struckNo) {
		$.ajax({
			url: baseURL + 'kasir/api/get_resep_by_struk',
			type: 'POST',
			data: {
				struck_no: struckNo
			},
			dataType: 'json',
			async: false,
			beforeSend: function() {
				// $('[name="btn_tambah_tindakan"]').prop('disabled', true);
			},
			success: function(data) {
				if (data.metaData.code != 200) {
					$('#table-keranjang-resep tbody').html(null);
					calculateTotal();
					return;
				}

				let response = data.response;
				rawResepDB.length = 0;
				$('#table-keranjang-resep tbody').html(null);
				$.each(response, function(i, v) {
					rawResepDB[i] = v;
					rawResepDB[i]['subtotal'] = Number(v.harga) * Number(v.qty);
					let newRow = `
						<tr id-obat="${v.id}" kode-obat="${v.kd_obat}" data-from-db="true">
							<td>${v.nama_obat}</td>
							<td>${v.qty}</td>
							<td class="harga">Rp. ${(v.harga).toLocaleString('id-ID')}</td>
							<td class="subtotal">Rp. ${(v.harga * v.qty).toLocaleString('id-ID')}</td>
							<td>${v.stock}</td>
							<td>${v.barcode}</td>
							<td>${v.signa1}</td>
							<td>${v.signa2}</td>
							<td>${v.status_signa}</td>
						</tr>
					`;
					$('#table-keranjang-resep tbody').append(newRow);
				});
				calculateTotal();
			}
		})
	}

	function panggilPembayaran(data, getPaymentCode) {
		// $('.kode-pembayaran').text(getPaymentCode);
		$.ajax({
			url: baseURL + 'kasir/api/get_resep_by_struk',
			type: 'POST',
			data: {
				struck_no: struckNo
			},
			dataType: 'json',
			async: false,
			beforeSend: function() {
				// $('[name="btn_tambah_tindakan"]').prop('disabled', true);
			},
		})
	}

	function panggilCheckout() {
		let totalSeluruh = parseFloat($(".total-seluruh").text().replace(/[Rp.\s]/g, ''));
		let kalkulasiKembalian = $('[name="checkout_paid"]').val() - totalSeluruh;
		$('[data-amount-change]').text(kalkulasiKembalian.toLocaleString('id-ID')).attr('data-amount-change', kalkulasiKembalian)
		$('[data-amount-outstanding]').text(0).attr('data-amount-outstanding', 0)
		if (kalkulasiKembalian < 0) {
			$('[data-amount-change]').text(0).attr('data-amount-change', 0)
			$('[data-amount-outstanding]').text(Math.abs(kalkulasiKembalian).toLocaleString('id-ID')).attr('data-amount-outstanding', Math.abs(kalkulasiKembalian))
		}
	}

	function getTindakanTable() {
		let data = [];
		let header = ['nama_tindakan', 'price', 'qty', 'act_code'];
		$('#table-keranjang-tindakan').find('tbody tr[data-from-db="false"]').each(function() {
			let rowData = {};
			let fieldMapping = ['nama_tindakan', 'price', 'qty', 'subtotal'];
			rowData['act_code'] = $(this).attr('kode-tindakan');
			$(this).find('td').each(function(cellIndex) {
				if (cellIndex != 4) {
					rowData[fieldMapping[cellIndex]] = $(this).text().trim();
				}
			});
			data.push(rowData);
		});
		return data;
	}

	function getTindakanTable_FromDB() {
		let data = [];
		let header = ['nama_tindakan', 'price', 'qty', 'act_code'];
		$('#table-keranjang-tindakan').find('tbody tr[data-from-db="true"]').each(function() {
			let rowData = {};
			let fieldMapping = ['nama_tindakan', 'price', 'qty', 'subtotal'];
			rowData['act_code'] = $(this).attr('kode-tindakan');
			rowData['id'] = $(this).attr('id-tindakan');
			$(this).find('td').each(function(cellIndex) {
				if (cellIndex != 4) {
					rowData[fieldMapping[cellIndex]] = $(this).text().trim();
				}
			});
			data.push(rowData);
		});
		return data;
	}



	function simpanTindakanPerda() {
		$.ajax({
			url: baseURL + 'kasir/api/simpan_tindakan',
			type: 'POST',
			data: {
				struck_no: $('[name="struck_no"]').val(),
				cust_code: $('[name="cust_code"]').val(),
				data_non_db: JSON.stringify(getTindakanTable()),
				data_db: JSON.stringify(getTindakanTable_FromDB())
			},
			dataType: 'json',
			beforeSend: function() {
				// $('[name="btn_tambah_tindakan"]').prop('disabled', true);
			},
			success: function(data) {
				if (data.metaData.code != 200) {
					toastr.error(data.metaData.message);
					return;
				}
			},
			error: function(jqXHR, textStatus, errorThrown) {
				toastr.error("Maaf ada kesalahan teknis pada simpan tindakan.")
				console.log(jqXHR + textStatus + errorThrown);
			}
		})
	}

	function panggilListRekap() {
		$.ajax({
			url: baseURL + 'kasir/api/get_list_rekap',
			type: 'POST',
			data: {
				tgl_antrian: $('[name="tgl_rekap"]').val(),
				poli: $('[name="poli_rekap"]').val(),
				dokter: $('[name="dokter_rekap"]').val()
			},
			dataType: 'json',
			beforeSend: function() {
				$('#cari-list-rekap').prop('disabled', true);
			},
			success: function(data) {
				if (data.metaData.code != 200) {
					toastr.error(data.metaData.message);
					return;
				}
				let response = data.response;
				tableListRekap.clear().draw();
				$.each(response, function(i, v) {
					tableListRekap.row.add([
						v.no_rm,
						v.nama_pasien,
						v.antrian,
						v.biro,
						v.reg_date + " " + v.reg_time,
						v.nama_dokter,
						v.nama_poli,
						'Rp. ' + parseInt(v.total_biaya).toLocaleString('id-ID'),
						`<button type="button" onclick="panggilDetailRekap('${v.no_struck}')" class="btn btn-outline-primary btn-xs m-0 p-0 rounded-0 w-100" id="btn-detail-rekap">Detail</button>`
					]).draw(false).buttons().container().appendTo('.content-2 .card-footer');
				});

			},
			complete: function() {
				$('#cari-list-rekap').prop('disabled', false);
			},
			error: function(jqXHR, textStatus, errorThrown) {
				toastr.error("Maaf ada kesalahan teknis.")
				console.log(jqXHR + textStatus + errorThrown);
			}
		})
	}

	function panggilDetailRekap(struk) {
		getRM(struk);
		$(".content-1 .sub-1").css('display', 'block');
		$(".content-1 .sub-2").css('display', 'block');
		$(".content-2").css('display', 'none');
		// console.log(struk);
	}

	function Export(formatExpr, iconExpr, titleExpr, formatFileExpr) {
		const exports = {
			extend: formatExpr,
			title: formatFileExpr,
			text: '<i class="' + iconExpr + '" style="font-size: 22px" aria-hidden="true" ></i> <p class="m-0">' +
				titleExpr + '</p>',
			titleAttr: titleExpr,
			"oSelectorOpts": {
				filter: 'applied',
				order: 'current'
			},
			exportOptions: {
				modifier: {
					page: 'all'
				}
			}
		}
		return exports;
	}

	function cetak_pembayaran() {
		let struk = $('[name="struck_no"]').val();
		let width = 559;
		let height = 794;
		const left = (window.screen.width / 2) - (width / 2);
		const top = (window.screen.height / 2) - (height / 2);
		if (struk == '') return;
		window.open(baseURL + 'kasir/cetak_pembayaran/' + struk, '_blank', `location=yes,height=${height},width=${width},scrollbars=yes,status=yes,top=${top},left=${left}`);
	}
</script>
