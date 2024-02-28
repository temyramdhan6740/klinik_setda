<script src="<?= base_url('assets/plugins/select2/select2.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables/datatable.js') ?>"></script>
<script>
var icd = []
$('.select2').select2();
$(document).ready(function() {
    $('#table_antrian').DataTable();
    $('#table_subject').DataTable();


    list_antrian()

    $('#tambahAntrian').click(function() {
        $("#modal-tambah-antrian").modal('show');
    })

    $('#cari_subject').click(function() {
        var his = $('#his').val();

        $.ajax({
            type: "POST",
            url: '<?= base_url('coba/coba/get_encounter_subject') ?>',
            data: {
                his: his
            },
            beforeSend: function() {
                $('#table_subject tbody').empty;
            },
            dataType: "json",
            success: function(res) {
                console.log(res.length)
                var table = $('#table_subject ').DataTable();
                table.clear().draw();

                for (let i = 0; i < res.length; i++) {
                    var org_temp = res[i].resource.identifier[0].system;
                    var org = org_temp.split('/');
                    table.row.add([
                        org[4],
                        res[i].resource.id,
                        res[i].resource.participant[0].individual.display,
                        '<input type="button" class="btn btn-sm btn-success btn_detail" data-encounter_id="' +
                        res[i].resource.id + '" value="Detail">'
                    ]).draw(false);
                }


            }
        });
    })

    $('#cari_rm_lama').click(function() {
        var nik = $('#nik').val();

        $.ajax({
            type: "POST",
            url: '<?= base_url('coba/coba/get_pasien_fire') ?>',
            data: {
                nik: nik
            },
            dataType: "json",
            success: function(res) {
                // if (res.status == 200) {
                //     $('#nama_lama').val(res.data.nama_pasien)
                //     $('pekerjaan_lama').val(res.data.pekerjaan)
                //     $('#bagian_lama').val(res.data.biro)
                //     $('#alamat_lama').val(res.data.alamat)
                //     $('#no_rm_lama').val(res.data.no_rm)
                // }
                $('#his').val(res.entry[0].resource.id)

            }
        });
    })

    $('#btn-simpan').click(function() {
        var his = $('#his').val();
        var dokter = $('#dokter').val();
        var dokter_name = $('#dokter').select2('data')[0].text;
        var lokasi = $('#lokasi').val();
        var lokasi_name = $('#lokasi').select2('data')[0].text;
        var arrived = $('#arrived').val();
        var inprogress = $('#inprogress').val();
        var finished = $('#finished').val();

        var param = {
            his: his,
            dokter: dokter,
            lokasi: lokasi,
            dokter_name: dokter_name,
            lokasi_name: lokasi_name,
            arrived: arrived,
            inprogress: inprogress,
            finished: finished
        }
        // console.log(param)

        $.ajax({
            type: "POST",
            url: '<?= base_url('coba/coba/post_encounter') ?>',
            data: param,
            dataType: "json",
            success: function(res) {
                if (res.status == 200) {
                    toastr.success(res.message)
                    toastr.success('Encounter ID:' + res.encounter_id)
                    $('#encounter_id').val(res.encounter_id)
                } else {
                    toastr.error(res.message)
                }

            }
        });
    })

    $('#btn-update-encounter').click(function() {
        var dokter = $('#dokter').val();
        var dokter_name = $('#dokter').select2('data')[0].text;
        var lokasi = $('#lokasi').val();
        var lokasi_name = $('#lokasi').select2('data')[0].text;
        var arrived = $('#arrived').val();
        var inprogress = $('#inprogress').val();
        var finished = $('#finished').val();
        var condition_id = $('#condition_id').val();
        var condition_name = $('#diag').val();
        var encounter_id = $('#encounter_id').val();

        var param = {
            dokter: dokter,
            lokasi: lokasi,
            dokter_name: dokter_name,
            lokasi_name: lokasi_name,
            arrived: arrived,
            inprogress: inprogress,
            finished: finished,
            condition_id: condition_id,
            condition_name: condition_name,
            encounter_id: encounter_id
        }
        console.log(param)

        $.ajax({
            type: "POST",
            url: '<?= base_url('coba/coba/put_encounter') ?>',
            data: param,
            dataType: "json",
            success: function(res) {
                console.log(res)
                // if (res.status == 200) {
                //     toastr.success(res.message)
                //     toastr.success('Encounter ID:' + res.encounter_id)
                //     $('#encounter_id').val(res.encounter_id)
                // } else {
                //     toastr.error(res.message)
                // }

            }
        });
    })


    $('#btn-simpan-diagnosa').click(function() {
        var icd = $('#icd').val();
        var diag = $('#diag').val();
        var encounter_id = $('#encounter_id').val();

        var param = {
            diag: diag,
            icd: icd,
            encounter_id: encounter_id
        }
        // console.log(param)

        $.ajax({
            type: "POST",
            url: '<?= base_url('coba/coba/post_condition') ?>',
            data: param,
            dataType: "json",
            success: function(res) {
                if (res.status == 200) {
                    toastr.success(res.message)
                    toastr.success('Condtion ID:' + res.condition_id)
                    $('#condition_id').val(res.condition_id)
                } else {
                    toastr.error(res.message)
                }

            }
        });
    })

    $(document).on('click', '.btn_detail', function() {

        var encounter_id = $(this).attr('data-encounter_id')

        $.ajax({
            type: "POST",
            url: '<?= base_url('coba/coba/get_condition') ?>',
            data: {
                encounter_id: encounter_id
            },
            dataType: "json",
            success: function(res) {

                // for (let i = 0; i < res.length; i++) {
                //     var org_temp = res[i].resource.identifier[0].system;
                //     var org = org_temp.split('/');
                //     table.row.add([
                //         org[4],
                //         res[i].resource.id,
                //         res[i].resource.participant[0].individual.display,
                //         '<input type="button" class="btn btn-sm btn-success btn_detail" data-encounter_id="' +
                //         res[i].resource.id + '" value="Detail">'
                //     ]).draw(false);
                // }
                var hasil = '[' + res[0].resource.code.coding[0].code + '] ' + res[0]
                    .resource.code.coding[0].display;

                var condition_id = res[0].resource.id;

                $('#condition').val(hasil)
                $('#condition_id').val(condition_id)


                $("#modal-detail").modal('show');


            }
        });
    })

    $('#cari_diag1').select2({
        "scrollX": true,
        minimumInputLength: 3,
        allowClear: true,
        tags: false,
        multiple: false,
        tokenSeparators: [','],
        placeholder: 'isikan nama diagnosa / icd minimal 3 huruf',
        ajax: {
            dataType: 'json',
            url: '<?= base_url('Coba/coba/get_list_diagnosa') ?>',
            delay: 800,
            type: "POST",
            data: function(params) {
                return {
                    search: params.term
                }
            },
            processResults: function(data, page) {
                return {
                    results: data
                };

            },
        }
    })

    $('#cari_diag1').on('select2:select select2:unselect', function(e) {
        var data = $("#cari_diag1").select2('data');
        $("#icd").val(data.id)
        data.forEach(function(item) {
            // diag.push(item.text);
            // icd.push(item.id);
            $("#diag").val(item.text)
            $("#icd").val(item.id)
        })
        // console.log(icd)
        // $('#diag1').val(diag.join(', '));
        // var diag1 = $('#diag1').val();
        // var diag2 = $('#diag2').val();
        // if (diag2.toLowerCase() == 'null') {
        //     diag2 = '';
        // }
        // if (diag1.toLowerCase() == 'null') {
        //     diag1 = '';
        // }
        // $('#a').val(diag1 + ', ' + diag2);
        // $('#icd1').val(icd.join(', '));
    });

    $('#btn-tambah-antrian').click(function() {
        var tab = $('.nav-tabs .active').val()

        switch (tab) {
            case 'pasien_lama':
                var no_rm = $('#no_rm_lama').val();
                var dokter = $('#dokter_antrian').val();
                var poli = $('#poli_antrian').val();
                var bpjs = $('#peserta_bpjs_antrian').val();
                var anamnesa = $('#anamnesa').val();

                var param = {
                    no_rm: no_rm,
                    dokter: dokter,
                    poli: poli,
                    bpjs: bpjs,
                    anamnesa: anamnesa
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
            case 'pasien_baru':
                var dokter = $('#dokter_antrian').val()
                var poli = $('#poli_antrian').val()
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

                var param = {
                    dokter: dokter,
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
});
</script>