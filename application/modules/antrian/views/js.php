<script src="<?= base_url('assets/plugins/select2/select2.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables/datatable.js') ?>"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$('.select2').select2();
$(document).ready(function() {
    $('#table_antrian').DataTable();
});

var tgl_antrian = $('#tgl_antrian').val()
var poli_antrian = $('#poli_antrian').val()
list_antrian(tgl_antrian, poli_antrian)

$('#tambahAntrian').click(function() {
    $("#modal-tambah-antrian").modal('show');
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
        beforeSend: function() {
            $('#loadingModal').show()
            $('#myForm')[0].reset();
        },
        success: function(res) {
            if (res.status == 200) {
                $('#nama_lama').val(res.data.nama_pasien)
                $('pekerjaan_lama').val(res.data.pekerjaan)
                $('#bagian_lama').val(res.data.biro)
                $('#alamat_lama').val(res.data.alamat)
                $('#no_rm_lama').val(res.data.no_rm)
            }
        },
        complete: function() {
            $('#loadingModal').hide()
        }
    });
})

$('#btn-tambah-antrian').click(function() {
    var tab = $('.nav-tabs .active').val()
    var tgl_antrian = $('#tgl_antrian').val()
    var poli_antrian = $('#poli_antrian').val()

    switch (tab) {
        case 'pasien_lama':
            var no_rm = $('#no_rm_lama').val();
            var dokter = $('#dokter_antrian').val();
            var poli = $('#poli').val();
            var bpjs = $('#peserta_bpjs_antrian').val();
            var anamnesa = $('#anamnesa').val();
            var reg_date = $('#reg_date').val();
            var reg_time = $('#reg_time').val();

            if (poli == '' || poli == null) {
                toastr.error('Poli tidak boleh kosong')
                return false
            }

            var param = {
                no_rm: no_rm,
                reg_date: reg_date,
                reg_time: reg_time,
                dokter: dokter,
                poli: poli,
                bpjs: bpjs,
                anamnesa: anamnesa
            }

            console.log(param)

            $.ajax({
                type: "POST",
                url: '<?= base_url('antrian/insert_antrian') ?>',
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
                    list_antrian(tgl_antrian, poli_antrian)
                    $('#loadingModal').hide()
                }
            });
            break;
        case 'pasien_baru':
            var no_rm = $('#no_rm_baru').val()
            var reg_date = $('#reg_date').val()
            var reg_time = $('#reg_time').val()
            var dokter = $('#dokter_antrian').val()
            var poli = $('#poli').val()
            var bpjs = $('#peserta_bpjs_antrian').val()
            var anamnesa = $('#anamnesa').val()
            var ktp = $('#ktp_baru').val()
            var bpjs = $('#bpjs_baru').val()
            var nama = $('#nama_baru').val()
            var status_pegawai = $('#status_pegawai_baru').val()
            var tempat_lahir = $('#tempat_lahir_baru').val()
            var tanggal_lahir = $('#tanggal_lahir_baru').val()
            var jenis_kelamin = $('#jenis_kelamin_baru').val()
            var hp = $('#hp_baru').val()
            var pekerjaan = $('#pekerjaan_baru').val()
            var alamat = $('#alamat_baru').val()
            var rtrw = $('#rtrw_baru').val()
            var kota = $('#kota_baru').val()
            var kecamatan = $('#kecamatan_baru').val()
            var kelurahan = $('#kelurahan_baru').val()
            var pendidikan = $('#pendidikan_baru').val()
            var agama = $('#agama').val()
            var status_menikah = $('#status_menikah_baru').val()
            var bagian = $('#bagian_baru').val()

            if (no_rm == '' || no_rm == null) {
                toastr.error('No RM tidak boleh kosong')
                return false
            }

            if (poli == '' || poli == null) {
                toastr.error('Poli tidak boleh kosong')
                return false
            }

            var param = {
                no_rm: no_rm,
                dokter: dokter,
                reg_date: reg_date,
                reg_time: reg_time,
                poli: poli,
                bpjs: bpjs,
                anamnesa: anamnesa,
                status: status_pegawai,
                nama_pasien: nama,
                tempat_lahir: tempat_lahir,
                tanggal_lahir: tanggal_lahir,
                pendidikan: pendidikan,
                agama: agama,
                status_menikah: status_menikah,
                pekerjaan: pekerjaan,
                biro: bagian,
                jenis_kelamin: jenis_kelamin,
                alamat: alamat,
                rt_rw: rtrw,
                kelurahan: kelurahan,
                kecamatan: kecamatan,
                kota: kota,
                no_telepon: hp,
                no_ktp: ktp,
                no_bpjs: bpjs
            }

            $.ajax({
                type: "POST",
                url: '<?= base_url('antrian/insert_antrian_pasien_baru') ?>',
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
                    list_antrian(tgl_antrian, poli_antrian)
                    $('#loadingModal').hide()
                }
            });
            break;
        default:
            break;
    }

    list_antrian(tgl_antrian, poli_antrian)
})


$(document).on('click', '#cari_tgl_antrian', function() {
    var tgl_antrian = $('#tgl_antrian').val()
    var poli_antrian = $('#poli_antrian').val()
    list_antrian(tgl_antrian, poli_antrian)
})

$(document).on('click', '#btn_generate', function() {
    $.ajax({
        type: "GET",
        url: '<?= base_url('antrian/generate_custcode') ?>',
        dataType: "json",
        success: function(res) {
            if (res.status == 200) {
                $('#no_rm_baru').val(res.data)
            } else {
                toastr.error(res.message)
            }
        }
    });

})

function list_antrian(tgl_antrian, poli_antrian) {
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
            type: "POST",
            data: {
                tgl_antrian: tgl_antrian,
                poli_antrian: poli_antrian
            },
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
                data: 'reg_time'
            },
            {
                data: 'nama_dokter'
            },
            {
                data: 'nama_poli'
            },
            {
                render: function(data, type, row) {
                    return "<button class='btn btn-danger btn-sm btn_batal' data-id='" + row.id +
                        "'> Batalkan </button>";
                },
            },
        ],
        columnDefs: [{
            targets: 1,
            className: "text-center",
        }]
    });
}


$(document).on('click', '.btn_batal', function() {
    var id = $(this).attr('data-id')
    var tgl_antrian = $('#tgl_antrian').val()
    var poli_antrian = $('#poli_antrian').val()
    Swal.fire({
        title: 'Yakin untuk membatalkan antrian?',
        text: "",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "GET",
                url: '<?= base_url('antrian/batal/') ?>' + id,
                dataType: "json",
                success: function(res) {
                    if (res.status == 200) {
                        Swal.fire(
                            'Berhasil!',
                            'Antrian Berhasil Dibatalkan',
                            'success'
                        )
                    } else {
                        toastr.error(res.message)
                    }
                },
                complete: function() {
                    list_antrian(tgl_antrian, poli_antrian)
                }
            });

        }
    })
})
</script>