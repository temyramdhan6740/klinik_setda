<script src="<?= base_url('assets/plugins/select2/select2.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/toastr/toastr.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables/datatable.js') ?>"></script>
<script src="<?= base_url() ?>assets/plugins/signature/pad.js"></script>
<script>
$('.select2').select2();
$(document).ready(function() {
    $('#table_pasien').DataTable();
});

list_antrian()

$('#list_pasien').click(function() {
    var tgl = $('#tgl_pemeriksaan').val()
    var poli = $('#poli').val();

    if (poli == null || poli == '') {
        toastr.error('Poli harus dipilih')
        return false;
    }

    let param = {
        tgl: tgl,
        poli: poli
    }
    $("#table_pasien").DataTable().destroy();
    $("#table_pasien").DataTable({
        order: [
            [2, 'asc']
        ],
        dom: 'Bfrtip',
        // buttons: [
        //     'copy', 'csv', 'excel', 'pdf', 'print'
        // ],
        // searching: false,
        // lengthChange: false,
        // info: false,
        // paging: false,
        ajax: {
            type: "POST",
            url: "<?= base_url('umum/list_pasien'); ?>",
            data: param,
            dataType: "JSON",
        },
        processing: true,
        columns: [{
                data: 'no_rm'
            },
            {
                data: 'nama_pasien'
            },
            {
                data: 'antrian'
            },
            {
                data: 'biro'
            },
            {
                data: 'reg_date'
            },
            {
                data: 'nama_dokter'
            },
            {
                data: 'nama_poli'
            },
            {
                render: function(data, type, row) {
                    return '<button class="btn btn-info btn-sm btn_pilih_pasien" data-no_struck="' +
                        row
                        .no_struck +
                        '" data-dokter_code="' +
                        row
                        .dokter_code +
                        '" data-kode_poli="' +
                        row
                        .kode_poli +
                        '"> Pilih </button>';
                },
            },
        ],
        columnDefs: [{
            targets: [0, 1, 2, 3, 4, 5, 6],
            className: "text-center",
        }]
    });

    $('#modal-list-pasien').modal('show');



})

$('#cari_rm_lama').click(function() {
    var no_rm = $('#no_rm_lama').val();

    $.ajax({
        type: "POST",
        url: '<?= base_url('antrian/get_pasien') ?>',
        data: {
            no_rm: no_rm
        },
        dataType: "json",
        success: function(res) {
            if (res.status == 200) {
                $('#nama_lama').val(res.data.nama_pasien)
                $('pekerjaan_lama').val(res.data.pekerjaan)
                $('#bagian_lama').val(res.data.biro)
                $('#alamat_lama').val(res.data.alamat)
                $('#no_rm_lama').val(res.data.no_rm)
            }
        }
    });
})

$('#btn-tambah-antrian').click(function() {
    var tab = $('.nav-tabs .active').val()
    var poli = $('#poli_antrian').val()
    var dokter = $('#dokter_antrian').val()

    if (poli == '' || poli == null) {
        toastr.error('Silahkan pilih poli terlebih dahulu')
        return false
    }

    if (dokter == '' || dokter == null) {
        toastr.error('Silahkan pilih Dokter terlebih dahulu')
        return false
    }

    switch (tab) {
        case 'pasien_lama':
            var no_rm = $('#no_rm_lama').val();
            var dokter = $('#dokter_antrian').val();
            var poli = $('#poli_antrian').val();
            var bpjs = $('#peserta_bpjs_antrian').val();

            let param = {
                no_rm: no_rm,
                dokter: dokter,
                poli: poli,
                bpjs: bpjs,
                tipe: 'lama'
            }

            $.ajax({
                type: "POST",
                url: '<?= base_url('antrian/insert_antrian') ?>',
                data: param,
                dataType: "json",
                success: function(res) {
                    if (res.status == 200) {
                        toastr.success(res.message)
                    } else {
                        toastr.error(res.message)
                    }
                }
            });
            break;
        default:
            break;
    }
    list_antrian()
})

$(document).on('click', '.btn_pilih_pasien', function() {
    // clear_val();
    var no_struck = $(this).attr('data-no_struck')
    $('#no_struck').val(no_struck)
    $.ajax({
        type: "GET",
        url: '<?= base_url('umum/get_pasien_by_struck') ?>' + '/' + no_struck,
        dataType: "JSON",
        success: function(res) {
            console.log(res);
            if (res.status == 200) {
                $('#nama_pasien').val(res.data.nama_pasien)
                $('#no_rm').val(res.data.no_rm)
                $('#tgl_Lahir').val(res.data.tanggal_lahir)
                $('#jk').val(res.data.jenis_kelamin)
                $('#dokter_code').val(res.data.dokter_code)
                $('#modal-list-pasien').modal('hide');
            } else {
                toastr.error('Data soap tidak ditemukan')
            }
        }
    });

    $.ajax({
        type: "GET",
        url: '<?= base_url('umum/get_soap') ?>' + '/' + no_struck,
        dataType: "JSON",
        success: function(res) {
            console.log(res);
            if (res.status == 200) {
                $.each(res.data.edukasi, function(key, value) {
                    $('input:checkbox[name="edukasi"][value="' + value + '"]')
                        .attr('checked', 'checked');
                });
                $('#anamnesa').val(res.data.anamnesa)
                $('#td').val(res.data.td)
                $('#n').val(res.data.n)
                $('#r').val(res.data.r)
                $('#s').val(res.data.s)
                $('#pemeriksaan_penunjang').val(res.data.pemeriksaan_penunjang)
                $('#diagnosa').val(res.data.diagnosa)
                $('#tindakan').val(res.data.tindakan)
                $('#rujuk').val(res.data.rujuk)
                $('#lain_lain').val(res.data.lain_lain)
                $("input[name=p][value=" + res.data.layanan_klinis + "]").prop('checked', true);
                $('#pelaksanaan_layanan').val(res.data.pelaksanaan_layanan)
            }
        }
    });

})

function list_antrian() {
    $("#table_antrian").DataTable().destroy();
    $("#table_antrian").DataTable({
        order: [
            [2, 'asc']
        ],
        dom: 'Bfrtip',
        // buttons: [
        //     'copy', 'csv', 'excel', 'pdf', 'print'
        // ],
        // searching: false,
        // lengthChange: false,
        // info: false,
        // paging: false,
        ajax: {
            type: "GET",
            url: "<?= base_url('antrian/get_list_antrian'); ?>",
        },
        dataType: "JSON",
        processing: true,
        columns: [{
                data: 'no_rm'
            },
            {
                data: 'nama_pasien'
            },
            {
                data: 'antrian'
            },
            {
                data: 'biro'
            },
            {
                data: 'reg_date'
            },
            {
                data: 'nama_dokter'
            },
            {
                data: 'nama_poli'
            },
            {
                render: function(data, type, row) {
                    return "<button class='btn btn-danger btn-sm'> Batalkan </button>";
                },
            },
        ],
        columnDefs: [{
            targets: 1,
            className: "text-center",
        }]
    });
}

$('#btn-ttd').click(function() {
    $('#modal-ttd').modal('show');
})


$(document).ready(function() {
    SignaturePad.prototype.removeBlanks = function() {
        var imgWidth = this._ctx.canvas.width;
        var imgHeight = this._ctx.canvas.height;
        var imageData = this._ctx.getImageData(0, 0, imgWidth, imgHeight),
            data = imageData.data,
            getAlpha = function(x, y) {
                return data[(imgWidth * y + x) * 4 + 3]
            },
            scanY = function(fromTop) {
                var offset = fromTop ? 1 : -1;

                // loop through each row
                for (var y = fromTop ? 0 : imgHeight - 1; fromTop ? (y < imgHeight) : (y >
                        -1); y += offset) {

                    // loop through each column
                    for (var x = 0; x < imgWidth; x++) {
                        if (getAlpha(x, y)) {
                            return y;
                        }
                    }
                }
                return null; // all image is white
            },
            scanX = function(fromLeft) {
                var offset = fromLeft ? 1 : -1;

                // loop through each column
                for (var x = fromLeft ? 0 : imgWidth - 1; fromLeft ? (x < imgWidth) : (x >
                        -1); x += offset) {

                    // loop through each row
                    for (var y = 0; y < imgHeight; y++) {
                        if (getAlpha(x, y)) {
                            return x;
                        }
                    }
                }
                return null; // all image is white
            };

        var cropTop = scanY(true),
            cropBottom = scanY(false),
            cropLeft = scanX(true),
            cropRight = scanX(false);

        var relevantData = this._ctx.getImageData(cropLeft, cropTop, cropRight - cropLeft, cropBottom -
            cropTop);
        this._ctx.canvas.width = cropRight - cropLeft;
        this._ctx.canvas.height = cropBottom - cropTop;
        this._ctx.clearRect(0, 0, cropRight - cropLeft, cropBottom - cropTop);
        this._ctx.putImageData(relevantData, 0, 0);
    };
    var canvas = document.getElementById('signature-pad');
    var signaturePad = new SignaturePad(canvas);

    $('#btn-clear-ttd').click(function(e) {
        e.preventDefault();
        signaturePad.clear();
    });
    $('#btn-cancel-ttd').click(function(e) {
        e.preventDefault();
        signaturePad.clear();
    });

    $('#btn-save-ttd').click(function(e) {
        var no_struck = $('#no_struck').val();
        if (signaturePad.isEmpty()) {
            return toastr.error("Tandatangan tidak boleh kosong");
        }
        if (no_struck == null) {
            return toastr.error("Silahkan pilih pasien terlebih dahulu");
        }
        signaturePad.removeBlanks();
        var data = signaturePad.toDataURL('image/png');
        $.ajax({
            type: "POST",
            url: '<?= base_url('umum/save_ttd'); ?>',
            data: {
                ttd: data,
                no_struck: no_struck
            },
            dataType: "json",
            success: function(res) {
                if (res.status == 'success') {
                    toastr.success('Tanda tangan berhasil disimpan');
                } else {
                    toastr.error('Tanda tangan gagal disimpan');
                }
            },
            complete: function() {
                signaturePad.clear();
                canvas.width = 450;
                canvas.height = 200;
            }
        });

    });

    $('#btn-print').click(function(e) {
        var no_struck = $('#no_struck').val();
        window.open("<?= base_url('print_umum/') ?>" + no_struck, 'Cetak SOAP',
            'Cetak SOAP');
    })
})

$('#btn-simpan-soap').click(function() {
    var no_rm = $('#no_rm').val()
    var dokter_code = $('#dokter_code').val()
    var kode_poli = $('#kode_poli').val()
    var no_struck = $('#no_struck').val()
    var anamnesa = $('#anamnesa').val()
    var td = $('#td').val()
    var n = $('#n').val()
    var r = $('#r').val()
    var s = $('#s').val()
    var pemeriksaan_penunjang = $('#pemeriksaan_penunjang').val()
    var diagnosa = $('#diagnosa').val()
    var edukasi = $("input:checkbox[name=edukasi]:checked")
        .map(function() {
            return $(this).val();
        }).get();
    var lain_lain = $('#lain_lain').val()
    var pelaksanaan_layanan = $('#pelaksanaan_layanan').val()
    var layanan_klinis = $('input[name="p"]:checked').val();
    var tindakan = $('#tindakan').val()
    var rujuk = $('#rujuk').val()

    if (no_struck == '' || no_struck == null) {
        toastr.error('Sialhkan pilih pasien kembali')
        return false
    }

    let param = {
        no_rm: no_rm,
        dokter_code: dokter_code,
        kode_poli: kode_poli,
        no_struck: no_struck,
        anamnesa: anamnesa,
        td: td,
        n: n,
        r: r,
        s: s,
        pemeriksaan_penunjang: pemeriksaan_penunjang,
        diagnosa: diagnosa,
        edukasi: edukasi,
        lain_lain: lain_lain,
        pelaksanaan_layanan: pelaksanaan_layanan,
        layanan_klinis: layanan_klinis,
        tindakan: tindakan,
        rujuk: rujuk,
        kode_poli: '001'
    }

    $.ajax({
        type: "POST",
        url: "<?= base_url('umum/insert_soap') ?>",
        data: param,
        dataType: "json",
        beforeSend: function() {
            $('#loadingModal').show()
        },
        success: function(res) {
            if (res.status == 200) {
                toastr.success(res.message)
            } else {
                toastr.error(res.message)
            }
        },
        complete: function() {
            $('#loadingModal').hide()
        }
    });
})
</script>