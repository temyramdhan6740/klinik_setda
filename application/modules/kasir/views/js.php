<script src="<?= base_url('assets/plugins/select2/select2.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables/datatable.js') ?>"></script>
<script src="<?= base_url('assets/plugins/flatpickr/dist/flatpickr.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/flatpickr/dist/l10n/id.js') ?>"></script>
<script src="<?= base_url('assets/plugins/moment/moment.min.js') ?>"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
	moment.locale('id');
	var baseURL = "<?= base_url() ?>";

	var tableListDataPasien = $("#table-list-data-pasien").DataTable({
		retrieve: false,
		language: {
			zeroRecords: "Tidak ada data yang ditemukan",
			infoEmpty: ""
		}
	});
	var tableListTindakan = $("#table-list-tindakan").DataTable({
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

	// pencarian tindakan
	$('[name="searach_tindakan"]').on('keyup', function() {
		tableListTindakan.search($(this).val()).draw();
	})

	// pencarian tindakan keranjang
	$('[name="searach_list_tindakan_keranjang"]').on('keyup', function() {
		tableListTindakanKeranjang.search($(this).val()).draw();
	})

	// tambah tindakan kedalam keranjang tindakan
	$('[name="btn_tambah_tindakan"]').on('click', function(e) {
		$.ajax({
			url: baseURL + 'kasir/get_tindakan',
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
							`<button type="button" class="btn btn-outline-primary btn-xs m-0 p-0 rounded-0 w-100" onclick="pilihTindakan('${value.actcode}')">Pilih</button>`,
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

	dragElement(document.querySelector('#tindakan-keranjang'));

	function pilihTindakan(actCode) {
		$.ajax({
			url: baseURL + 'kasir/get_tindakan_selected',
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
					let tableKeranjangTindakan = $('#table-keranjang-tindakan tbody');
					let newRow = `
						<tr>
							<td>${response.actname}</td>
							<td class="harga">Rp. ${parseInt(response.fee).toLocaleString()}</td>
							<td>
								<div class="qty text-center" contenteditable="true">1</div>
							</td>
							<td class="subtotal">Rp. ${parseInt(response.fee).toLocaleString()}</td>
							<td></td>
							<td>
								<div class="d-flex p-1">
									<button type="button" class="btn btn-xs rounded-0 p-0 border-0 text-danger remove-item"><i class="fas fa-trash-alt"></i></button>
								</div>
							</td>
						</tr>
					`;
					tableKeranjangTindakan.append(newRow);

					// Event listener untuk qty
					$('.qty').on('input', function() {
						let text = $(this).text();
						let filteredText = text.replace(/\D/g, '');
						filteredText = filteredText.slice(0, 3);
						$(this).text(filteredText);

						console.log(0);
						updateSubtotal($(newRow));
						calculateTotal()
					});

					// Event listener untuk tombol hapus
					$('.remove-item').on('click', function() {
						$(this).closest('tr').remove();
						calculateTotal()
					});

					// Perbarui subtotal untuk item baru
					updateSubtotal($(newRow));
					calculateTotal();

					return;
				}
				toastr.error("Data Tidak Ada.")
			},
			complete: function() {
				$('[name="btn_tambah_tindakan"]').prop('disabled', false);
				$("#modal-list-tindakan").modal('hide')
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

	function updateSubtotal(row) {
		let priceText = row.find('.harga').text().trim();
		let price = parseFloat(priceText.replace('Rp. ', '').replace(',', ''));
		let quantityText = row.find('.qty').text().trim();
		let quantity = parseInt(quantityText);
		let subtotal = price * quantity;

		row.find('.subtotal').text('Rp. ' + subtotal.toLocaleString());
	}

	function calculateTotal() {
		let total_Tindakan = 0;
		$('#table-keranjang-tindakan tbody tr').each(function() {
			let subtotalText = $(this).find('.subtotal').text().trim();
			let subtotal = parseFloat(subtotalText.replace('Rp. ', '').replace(',', ''));
			total_Tindakan += subtotal;
		});

		$('.biaya-tindakan').text('Rp. ' + total_Tindakan.toLocaleString());
		$('.pembulatan').text('Rp. ' + Math.round(total_Tindakan).toLocaleString());
	}

	function dragElement(elmnt) {
		var pos1 = 0,
			pos2 = 0,
			pos3 = 0,
			pos4 = 0;
		if (document.querySelector(elmnt.id + "header")) {
			/* if present, the header is where you move the DIV from:*/
			document.querySelector(elmnt.id + "header").onmousedown = dragMouseDown;
		} else {
			/* otherwise, move the DIV from anywhere inside the DIV:*/
			elmnt.onmousedown = dragMouseDown;
		}

		function dragMouseDown(e) {
			e = e || window.event;
			e.preventDefault();
			// get the mouse cursor position at startup:
			pos3 = e.clientX;
			pos4 = e.clientY;
			document.onmouseup = closeDragElement;
			// call a function whenever the cursor moves:
			document.onmousemove = elementDrag;
		}

		function elementDrag(e) {
			e = e || window.event;
			e.preventDefault();
			// calculate the new cursor position:
			pos1 = pos3 - e.clientX;
			pos2 = pos4 - e.clientY;
			pos3 = e.clientX;
			pos4 = e.clientY;

			// Check if the new position is within .content-wrapper boundaries
			const contentWrapper = document.querySelector('.content-wrapper');
			const elmntRect = elmnt.getBoundingClientRect();
			const wrapperRect = contentWrapper.getBoundingClientRect();

			const newTop = elmnt.offsetTop - pos2;
			const newLeft = elmnt.offsetLeft - pos1;

			// Check if new position is within boundaries
			if (
				newTop >= wrapperRect.top &&
				newTop + elmntRect.height <= wrapperRect.bottom &&
				newLeft >= wrapperRect.left &&
				newLeft + elmntRect.width <= wrapperRect.right
			) {
				// set the element's new position:
				elmnt.style.top = newTop + "px";
				elmnt.style.left = newLeft + "px";
			}
		}

		function closeDragElement() {
			/* stop moving when mouse button is released:*/
			document.onmouseup = null;
			document.onmousemove = null;
		}
	}
</script>
