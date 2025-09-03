<link href="<?= base_url('assets/plugins/select2/select2.min.css') ?>" rel="stylesheet">
<link href="<?= base_url('assets/plugins/tagify/dist/tagify.css') ?>" rel="stylesheet">
<link href="<?= base_url('assets/plugins/datatables/datatable.css') ?>" rel="stylesheet">
<link href="<?= base_url('assets/plugins/datatables/datatable.css') ?>" rel="stylesheet">
<link href="<?= base_url('assets/plugins/flatpickr/dist/flatpickr.min.css') ?>" rel="stylesheet">
<link href="<?= base_url('assets/plugins/flatpickr/dist/themes/airbnb.css') ?>" rel="stylesheet">
<link href="<?= base_url() ?>assets/plugins/daterangepicker/daterangepicker.css" rel="stylesheet">

<style>
	table {
		font-size: 13px !important;
	}

	label[for='html5-search-input'] {
		font-size: 13px;
	}

	.select2-container {
		width: auto !important;
	}

	span.select2-selection.select2-selection--single {
		font-size: 1.694915254237288vh;
		border-color: #dee2e6;
	}

	li.select2-results__option {
		font-size: 1.694915254237288vh;
		padding-top: 2px;
		padding-bottom: 2px;
	}

	.select2-selection {
		-webkit-box-shadow: 0;
		box-shadow: 0;
		background-color: #fff;
		border: 0;
		border-radius: 0;
		color: #555555;
		font-size: 13;
		outline: 0;
		min-height: 38px;
		text-align: left;
	}

	.select2-selection__rendered {
		margin: 0;
	}

	.select2-selection__arrow {
		margin: 0;
	}

	.text-sm {
		font-size: 0.85rem !important;
	}

	.text-xs {
		font-size: 0.75rem !important;
	}

	.text-xxs {
		font-size: 0.65rem !important;
	}

	.table tr td {
		padding: 1px !important;
		padding-left: 8px !important;
		padding-right: 8px !important;
		font-family: "Source Sans Pro", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
	}

	.table tr th {
		padding-left: 8px !important;
		padding-right: 8px !important;
		text-transform: capitalize;
		font-family: "Source Sans Pro", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
	}

	/* Table Tindakan */

	#table-list-tindakan-checkout tbody tr td:last-child {
		padding: 0 !important;
	}

	#table-list-tindakan-checkout_filter {
		display: none !important;
	}

	#table-list-tindakan-keranjang_filter {
		display: none !important;
	}

	#table-list-tindakan-keranjang_length {
		display: none !important;
	}

	#table-list-data-pasien tbody tr td:nth-child(1) {
		padding: 0 !important;
	}

	.dataTables_filter {
		margin-bottom: 1em !important;
	}

	/* End Table Tindakan */

	/* Table Resep */

	#table-list-resep tbody tr td:last-child {
		padding: 0 !important;
	}

	#table-list-resep_filter {
		display: none !important;
	}

	#table-list-resep-keranjang_filter {
		display: none !important;
	}

	#table-list-rekap_filter {
		display: none !important;
	}

	#table-list-rekap_length {
		display: none !important;
	}

	#table-list-rekap td {
		white-space: nowrap;
	}

	#table-list-resep-keranjang_length {
		display: none !important;
	}

	#table-keranjang-resep tbody tr td {
		/* padding: 0 !important; */
		white-space: nowrap;
	}

	/* End Table Resep */

	#table-list-data-pasien tbody tr td:nth-child(1) {
		padding: 0 !important;
	}

	.dataTables_filter {
		margin-bottom: 1em !important;
	}

	#table-list-antrian_filter {
		display: none !important;
	}

	#table-list-antrian_length {
		display: none !important;
	}

	.total-pembayaran .card-body div {
		font-family: "Source Sans Pro", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
	}

	.total-pembayaran-keranjang .card-body div {
		font-family: "Source Sans Pro", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
	}

	.buttons-html5 {
		font-size: 12px;
		padding-top: 5px;
		padding-bottom: 5px;
		border-radius: 0 !important;
		border: 1px solid;
		background: #007bff linear-gradient(180deg, rgba(52, 162, 78, 1), rgba(52, 137, 78, 1)) repeat-x !important;
	}

	.buttons-print {
		font-size: 12px;
		padding-top: 5px;
		padding-bottom: 5px;
		border-radius: 0 !important;
		border: 1px solid;
		background: #007bff linear-gradient(180deg, rgba(52, 162, 78, 1), rgba(52, 137, 78, 1)) repeat-x !important;
	}

	.content-2 .card-footer .dt-buttons {
		width: 100%;
	}

	.tagify--select {
		width: 100% !important;
	}

	.tagify__input {
		padding: 0;
		font-size: 0.75rem;
		color: #697a8d;
	}

	.tagify__tag {
		padding: 0 !important;
		color: #697a8d;
	}

	.tagify__tag-text {
		padding: 0;
		font-size: 0.75rem;
		color: #697a8d;
	}

	.monospace {
		font-family: monospace !important;
	}
</style>
