<script src="<?= base_url('assets/plugins/select2/select2.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables/datatable.js') ?>"></script>
<script src="<?= base_url('assets/plugins/toastr/toastr.min.js') ?>"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$('.select2').select2();
$(document).ready(function() {
    $('#table_data').DataTable();

    list_data();
});

$(document).on('click', '#btn-tambah', function() {
    $('#myForm')[0].reset();
    $("#btn-update").hide()
    $("#btn-insert").show()
    $("#judul_data").text('Tambah Data');
    $("#modol").modal('show');
})

$(document).on('click', '.btn-edit', function() {
    $('#myForm')[0].reset();
    $("#btn-update").show()
    $("#btn-insert").hide()
    $("#judul_data").text('Edit Data');
    $("#modol").modal('show');

    var id = $(this).attr('data-id')

    $.ajax({
        type: "GET",
        url: '<?= base_url('masters/dokter/get_data/') ?>' + id,
        dataType: "json",
        beforeSend: function() {
            $('#loadingModal').show()
        },
        success: function(res) {
            if (res.status == 200) {
                $("#nama_dokter").val(res.data.nama_dokter)
                $("#sip").val(res.data.sip)
                $("#id").val(res.data.id)

            } else {
                toastr.error('Data yang dipilih error')
            }
        },
        complete: function() {
            $('#loadingModal').hide()
        }
    });
})

$(document).on('click', '#btn-insert', function() {
    var param = $("#myForm").serialize();
    var nama_dokter = $('#nama_dokter').val()
    if (nama_dokter == '' || nama_dokter == null) {
        toastr.error('Nama wajib diisi')
        return false
    }

    $.ajax({
        type: "POST",
        url: '<?= base_url('masters/dokter/insert_data') ?>',
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
            list_data();
            $('#loadingModal').hide()
        }
    });

})

$(document).on('click', '#btn-update', function() {
    var param = $("#myForm").serialize();
    var nama_dokter = $('#nama_dokter').val()
    var id = $('#id').val()
    if (nama_dokter == '' || nama_dokter == null) {
        toastr.error('Nama wajib diisi')
        return false
    }

    $.ajax({
        type: "POST",
        url: '<?= base_url('masters/dokter/update_data') ?>',
        data: param + '&id=' + id,
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
            list_data();
            $('#loadingModal').hide()
        }
    });

})

$(document).on('click', '.btn-hapus', function() {
    var id = $(this).attr('data-id')
    Swal.fire({
        title: 'Yakin hapus data?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "GET",
                url: '<?= base_url('masters/dokter/delete_data/') ?>' + id,
                dataType: "json",
                success: function(res) {
                    if (res.status == 200) {
                        Swal.fire(
                            'Berhasil!',
                            'Data berhasil terhapus',
                            'success'
                        )
                    } else {
                        toastr.error(res.message)
                    }
                },
                complete: function() {
                    list_data();
                }
            });

        }
    })
})

function list_data() {
    $("#table_data").DataTable().destroy();
    $("#table_data").DataTable({
        order: [
            [0, 'asc']
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
            url: "<?= base_url('masters/dokter/list_data'); ?>",
        },
        dataType: "JSON",
        processing: true,
        columns: [{
                render: function(data, type, row) {
                    return '<strong>' + row.nama_dokter + '</strong>'
                }
            },
            {
                data: 'sip'
            },
            {
                render: function(data, type, row) {
                    return "<button type='button' class='btn-edit btn btn-primary btn-sm' data-id='" +
                        row.id +
                        "'>Edit</button><button type='button' class='btn-hapus btn btn-danger btn-sm' data-id='" +
                        row.id + "'>Delete</button>";
                },
            },
        ],
        columnDefs: [{
            targets: 1,
            className: "text-center",
        }]
    });
}
</script>