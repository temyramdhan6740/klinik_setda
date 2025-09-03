<script src="<?= base_url('assets/plugins/select2/select2.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/tagify/dist/tagify.js') ?>"></script>
<script src="<?= base_url('assets/plugins/tagify/dist/tagify.polyfills.min.js') ?>"></script>
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
<script>
	moment.locale('id');
	var baseURL = "<?= base_url() ?>";
	var tableCariPasien = $("#table_cari_pasien").DataTable({
		retrieve: false
		// order: [
		// 	[3, 'desc']
		// ]
	});

	// $("[data-select]").select2({
	// 	theme: "default",
	// 	width: '100%',
	// 	allowClear: true,
	// 	dropdownAutoWidth: true,
	// 	tags: true
	// });

	// var input = document.querySelector('[data-select]'),
	// 	tagify = new Tagify(input, {
	// 		enforceWhitelist: true,
	// 		mode: "select",
	// 		whitelist: ["first option", "second option", "third option"],
	// 		blacklist: ['foo', 'bar'],
	// 	})
	TagDropdown("#sumber_data", 1, ["Pasien", "Keluarga"], "select");
	TagDropdown("#riw_penyakit_keluarga_val", 1, ["Hipertensi", "Jantung", "DM", "Ginjal"], "select");
	TagDropdown("#ketergantungan_terhadap_val", 1, ["Obat-obatan", "Alkohol", "Rokok"], "select");
	TagDropdown("#riwayat_alergi_val", 1, ["Obat", "Makanan"], "select");
	TagDropdown("#status_psikologi_val", 1, ["Cemas", "Takut", "Sedih"], "select");
	TagDropdown("#status_ekonomi", 1, ["Asuransi", "Jaminan", "Biaya Sendiri"], "select");
	TagDropdown("#hambatan_dlm_pembelajaran_val", 1, ["Pendengaran", "Penglihatan", "Kognitif", "Fisik", "Budaya", "Emosi", "Bahasa"], "select");
	TagDropdown("#kebutuhan_edukasi_val", 1, ["Diagnosa dan manajemen penyakit", "Obat-obatan/terapi", "Diet dan nutrisi", "Tindakan keperawatan", "Rehabilitasi", "Manajemen nyeri"], "select");
	TagDropdown("#nyeri_hilang", 1, ["Minum obat", "Istirahat", "Berubah posisi tidur"], "select");

	// Risiko Cedera
	hasilRisikoCedera();
	$("[data-group='risiko_cedera']").on('change', function() {
		hasilRisikoCedera();
	});

	// Skrining Nyeri
	pointSkriningNyeri(0);
	$("input[name='ada_nyeri']").on("change", function() {
		let radioAdaNyeri = $("input[name='ada_nyeri']:checked").val();
		switch (radioAdaNyeri) {
			case '1':
				// $(".box-point-nyeri").slideDown();
				$(".box-point-nyeri .overlayDisabled").cs
				s('display', 'none');
				break;
			default:
				pointSkriningNyeri(0);
				// $(".box-point-nyeri").slideUp();
				$(".box-point-nyeri .overlayDisabled").css('display', 'flex');
				break;
		}
	});

	// DAFTAR MASALAH KEPERAWATAN PRIORITAS
	$("#cb_analisa_masalah_kep").on("change", function() {
		let arr = {};
		let selectedVal = parseInt($(this).val(), 10); // ambil value dulu
		let selectedOpt = $(this).find("option:selected"); // ambil option

		// filter data berdasarkan ID
		let filterTable = jsonMasalahKep('array').filter(function(e) {
			return e.id === selectedVal;
		});

		if (filterTable.length > 0) {
			return false;
		}

		arr.id = selectedVal;
		arr.analisa_masalah_kep = selectedOpt.text();
		arr.intervensi = selectedOpt.data("intervensi") || ""; // lebih rapi pakai .data()

		$("#list_masalah_keperawatan").find("tbody").append(`
    	    <tr data-id='${arr.id}'>
    	        <td>${arr.analisa_masalah_kep}</td>
    	        <td>${arr.intervensi}</td>
    	        <td class="text-center">
    	            <button type="button" class="btn btn-sm btn-danger btn-hapus-masalah-keperawatan">
    	                <i class="fa fa-trash"></i>
    	            </button>
    	        </td>
    	    </tr>
    	`);
	});

	// CARI PASIEN
	$("#btn_cari_pasien").on("click", function() {
		let btn = $(this);
		$("#data_pasien").html('');
		let noRM = $('[name="noRM"]').val();
		if (noRM === '') {
			toastr.error('No RM tidak boleh kosong');
			btn.prop('disabled', false);
			return false;
		}
		$.ajax({
			url: baseURL + 'aswal_keperawatan/cari_pasien',
			type: "POST",
			data: {
				no_rm: noRM
			},
			beforeSend: function() {
				btn.prop('disabled', true);
			},
			dataType: "JSON",
			success: function(resp) {
				btn.prop('disabled', false);
				if (resp.metaData.code === 200) {
					let data = resp.response;
					tableCariPasien.clear().draw();
					$.each(data, function(index, value) {
						tableCariPasien.row.add([
							value.no_struck,
							value.no_rm,
							value.cust_name,
							value.poli_name,
							value.doc_name,
							moment(value.created_date).format('YYYY-MM-DD HH:mm:ss'),
							`<button type='button' class='btn btn-primary btn-xs w-100 rounded-pill' onclick='getRM("${value.no_rm}", "${value.no_struck}")'>Pilih</button>`,
						]).draw(false);
					});
					$("#modal-pasien").modal('show');
					return false;
				}

				tableCariPasien.clear().draw();
				toastr.error(resp.metaData.message);
			},
			complete: function() {
				btn.prop('disabled', false);
			},
			error: function(xhr) {
				toastr.error(xhr.responseText);
				btn.prop('disabled', false);
			}
		});
	});

	// SIMPAN
	$("#simpan").on("click", function() {
		let btn = $(this);
		btn.prop('disabled', true);

		// Ambil semua data form
		let setForm = {};
		setForm = $("#frm").serializeArray().reduce((acc, item) => {
			acc[item.name] = item.value;
			return acc;
		}, {});
		setForm.skrining_nyeri = pointSkriningNyeri(); // ambil data skrining nyeri
		setForm.nyeri_akut = JSON.stringify(
			$('[data-group="nyeri_akut_val"]').map(function() {
				return $(this).val();
			}).get()
		);
		setForm.nyeri_kronis = JSON.stringify(
			$('[data-group="nyeri_kronis_val"]').map(function() {
				return $(this).val();
			}).get()
		);
		setForm.masalah_keperawatan = jsonMasalahKep(); // ambil data masalah keperawatan

		$.ajax({
			url: baseURL + 'aswal_keperawatan/simpan',
			type: "POST",
			data: {
				data: JSON.stringify(setForm) // kirim sebagai JSON
			},
			dataType: "JSON",
			success: function(resp) {
				btn.prop('disabled', false);
				if (resp.metaData.code === 200) {
					toastr.success(resp.message);
					return false;
				}
				toastr.error(resp.message);
			},
			error: function(xhr) {
				toastr.error(xhr.responseText);
				btn.prop('disabled', false);
			}
		});
	});

	function getRM($no_rm, $struk) {
		$.ajax({
			url: baseURL + 'aswal_keperawatan/cari_rm',
			type: "POST",
			data: {
				no_rm: $no_rm,
				struk: $struk
			},
			dataType: "JSON",
			success: function(resp) {
				if (resp.metaData.code === 200) {
					let data_rm = resp.response.data_rm;
					let data_medrec = resp.response.data_medrec;

					let umur = moment().diff(moment(data_rm.tanggal_lahir, 'YYYY-MM-DD'), 'years');

					// DATA PASIEN
					$('[name="struckNo"]').val(data_rm.no_struck);
					$('[name="no_rm"]').val(data_rm.no_rm);
					$('[name="nama_rm"]').val(data_rm.cust_name);
					$('[name="tgl_lahir"]').val(data_rm.tanggal_lahir);
					$('[name="tgl"]').val(data_rm.tanggal_lahir);

					$("#modal-pasien").modal('hide');
					
					return false;
				}
				toastr.error(resp.metaData.message);
			}
		});
	}

	function TagDropdown(selectorElem, tagLength = 1, listArr, setMode) {
		const tagify = new Tagify(document.querySelector(selectorElem), {
			enforceWhitelist: false,
			mode: setMode, // select | mix | input
			whitelist: listArr,
			maxTags: tagLength,
			originalInputValueFormat: valuesArr => valuesArr.map(item => item.value).join('|'),
			dropdown: {
				maxItems: 20,
				classname: "tags-view text-xs",
				enabled: 0,
				closeOnSelect: true
			}
		});
		tagify.on('add', e => {
			const value = e.detail.data.value;
			if (!listArr.includes(value)) {
				listArr.push(value);
				tagify.whitelist.push(value);
			}
		});
	}

	function hasilRisikoCedera() {
		let risiko_cedera = {
			a: $("[name='risiko_cedera_a']:checked").val(),
			b: $("[name='risiko_cedera_b']:checked").val()
		};

		// pastikan nilainya string, ubah ke angka agar lebih aman
		let a = parseInt(risiko_cedera.a, 10);
		let b = parseInt(risiko_cedera.b, 10);

		if (a === 0 && b === 0) {
			$("#hasil_resiko_cedera div").eq(1).text('Tidak Berisiko').css({
				'background-color': 'rgba(52, 137, 78, 1)',
				'color': '#fff'
			});
		} else if (a === 1 && b === 1) {
			$("#hasil_resiko_cedera div").eq(1).text('Risiko Tinggi').css({
				'background-color': '#ff3e1d',
				'color': '#fff'
			});
		} else if ((a === 1 && b === 0) || (a === 0 && b === 1)) {
			$("#hasil_resiko_cedera div").eq(1).text('Risiko Rendah').css({
				'background-color': '#007bff',
				'color': '#fff'
			});
		}
	}

	function pointSkriningNyeri(point = null) {
		if (point === null || point === undefined) {
			return parseInt($("#val_total_point_nyeri").val(), 10) || 0;
		}
		var descSkriningNyeri = [
			"Tidak Nyeri",
			"Nyeri Ringan, sedikit mengganggu aktivitas",
			"Nyeri sedang, gangguan nyata terhadap aktivitas",
			"Nyeri Berat, tidak dapat melakukan aktivitas"
		];
		var arrBgSkrining = ["#121235", "#1b2a69", "#28448d", "#3b62af", "#3277c2", "#3b9ad4", "#f0920d", "#e26f14", "#f34015", "#ae1214", "#3c0c11"];
		// Perubahan background skrining nyeri jika tidak terpilih maka background transparan
		for (let i = 0; i <= point; i++) {
			for (let j = point; j <= 10; j++) {
				// const element = array[j];
				$("#point_nyeri_" + j).css("background", "white");
				$("#point_nyeri_" + j).css("color", "#000");
			}
			$("#point_nyeri_" + i).css("background", arrBgSkrining[i]);
			$("#point_nyeri_" + i).css("color", "#FFF");

			// Hasil Skrining
			if (point == 0) {
				$("input[name='ada_nyeri'][value='0']").prop('checked', true);
				$(".box-point-nyeri .overlayDisabled").css('display', 'flex');
				// $(".emoji-skrining").html("<img src='<?= base_url('assets/img/skrining/icon_0.png') ?>' alt='" + descSkriningNyeri[0] + "' class='p-1 w-100'>");
				$(".desc-skrining").html(descSkriningNyeri[0]);
				// $(".emoji-skrining").css("color", arrBgSkrining[i]);
			} else if (point > 0 && point <= 3) {
				$("input[name='ada_nyeri'][value='1']").prop('checked', true);
				$(".box-point-nyeri .overlayDisabled").css('display', 'none');
				// $(".emoji-skrining").html("<img src='<?= base_url('assets/img/skrining/NyeriRingan.png') ?>' alt='" + descSkriningNyeri[1] + "' class='p-1 w-100'>");
				$(".desc-skrining").html(descSkriningNyeri[1]);
				// $(".emoji-skrining").css("color", arrBgSkrining[i]);
			} else if (point > 3 && point <= 6) {
				$("input[name='ada_nyeri'][value='1']").prop('checked', true);
				$(".box-point-nyeri .overlayDisabled").css('display', 'none');
				// $(".emoji-skrining").html("<img src='<?= base_url('assets/img/skrining/NyeriSedang.png') ?>' alt='" + descSkriningNyeri[2] + "' class='p-1 w-100'>");
				$(".desc-skrining").html(descSkriningNyeri[2]);
				// $(".emoji-skrining").css("color", arrBgSkrining[i]);
			} else {
				$("input[name='ada_nyeri'][value='1']").prop('checked', true);
				$(".box-point-nyeri .overlayDisabled").css('display', 'none');
				// $(".emoji-skrining").html("<img src='<?= base_url('assets/img/skrining/NyeriBerat.png') ?>' alt='" + descSkriningNyeri[3] + "' class='p-1 w-100'>");
				$(".desc-skrining").html(descSkriningNyeri[3]);
				// $(".emoji-skrining").css("color", arrBgSkrining[i]);
			}

			// Emoji Skrining
			if (point >= 0 && point <= 2) {
				$(".emoji-skrining").html("<img src='<?= base_url('assets/img/skrining/icon_0.png') ?>' alt='" + descSkriningNyeri[1] + "' class='w-100'>");
			} else if (point > 2 && point <= 4) {
				$(".emoji-skrining").html("<img src='<?= base_url('assets/img/skrining/icon_2.png') ?>' alt='" + descSkriningNyeri[2] + "' class='w-100'>");
			} else if (point > 4 && point <= 6) {
				$(".emoji-skrining").html("<img src='<?= base_url('assets/img/skrining/icon_4.png') ?>' alt='" + descSkriningNyeri[3] + "' class='w-100'>");
			} else if (point > 6 && point <= 8) {
				$(".emoji-skrining").html("<img src='<?= base_url('assets/img/skrining/icon_6.png') ?>' alt='" + descSkriningNyeri[3] + "' class='w-100'>");
			} else if (point > 8 && point <= 9) {
				$(".emoji-skrining").html("<img src='<?= base_url('assets/img/skrining/icon_8.png') ?>' alt='" + descSkriningNyeri[3] + "' class='w-100'>");
			} else {
				$(".emoji-skrining").html("<img src='<?= base_url('assets/img/skrining/icon_10.png') ?>' alt='" + descSkriningNyeri[0] + "' class='w-100'>");
			}
		}
		// Point nyeri set
		$("#total_point_nyeri").html(point);
		$("#val_total_point_nyeri").val(point);
		$('[name="sn_skala_nyeri"]').val(point);
		$('[name="skala_nyeri"]').val(point);
	}

	function jsonMasalahKep(format = 'string') {
		let arr = [];
		$("#list_masalah_keperawatan").find("tbody tr").each(function() {
			let masalah = $(this).find("td").eq(0).text();
			let intervensi = $(this).find("td").eq(1).text();
			arr.push({
				"id": parseInt($(this).attr("data-id")),
				"masalah": masalah,
				"intervensi": intervensi
			});
		});
		if (format === 'array') {
			return arr;
		}
		return JSON.stringify(arr);
	}
</script>
