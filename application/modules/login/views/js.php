<script src="<?= base_url('assets/plugins/select2/select2.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/toastr/toastr.min.js') ?>"></script>
<script>
$('.select2').select2();

$('#formLogin').keypress(function(e) {
    var key = e.which;
    if (key == 13) // the enter key code
    {
        $("#btnLogin").trigger("click");
    }
})

$('#btnLogin').click(function() {
    var username = $('#username').val();
    var password = $('#password').val();
    if (username == '' || username == null) {
        toastr.error('Username wajib diisi');
        return false;
    }

    if (password == '' || password == null) {
        toastr.error('Password wajib diisi');
        return false;
    }

    var url = '<?= base_url('login/doLogin') ?>';
    $.ajax({
        url: url,
        type: 'POST',
        data: {
            username: username,
            password: password
        },
        dataType: 'json',
        success: function(data) {
            if (data.status == '200') {
                window.location.href = '<?= base_url('list_antrian') ?>';
            } else {
                toastr.error(data.message)
            }
            console.log(data.message)
        }
    });
});


$(document).on('click', '#btn-ganti', function() {
    var password_lama = $('#password_lama').val();
    var password_baru = $('#password_baru').val();
    var re_password_baru = $('#re_password_baru').val();

    if (password_baru != re_password_baru) {
        toastr.error('Password tidak sama');
        return false;
    }

    $.ajax({
        type: "POST",
        url: '<?= base_url('login/GantiPassword/update'); ?>',
        data: {
            password_baru: password_baru,
            password_lama: password_lama
        },
        dataType: "json",
        success: function(res) {
            if (res.status == 200) {
                toastr.success(res.message);

            } else {
                toastr.error(res.message);
            }
        }
    });
});
</script>