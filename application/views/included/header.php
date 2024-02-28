<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="<?= base_url('assets/') ?>" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Klinik SETDA</title>

    <meta name="description" content="" />
    <link rel="shortcut icon" href="<?= base_url('assets/img/SIMRS.png'); ?>" />
    <!-- Fonts -->
    <style>
    @font-face {
        font-family: poppins;
        src: url(<?= base_url('assets/fonts/Poppins-Regular.ttf');
        ?>);

    }
    </style>

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="<?= base_url('assets/sneat/assets/vendor/fonts/boxicons.css'); ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/sneat/assets/vendor/fonts/fontawesome.css'); ?>" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/sneat/assets/vendor/css/core.css'); ?>"
        class="template-customizer-core-css" />
    <link rel="stylesheet" href="<?= base_url('assets/sneat/assets/vendor/css/theme-semi-dark.css'); ?>"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="<?= base_url('assets/sneat/assets/css/demo.css'); ?>" />

    <!-- Vendors CSS -->
    <link rel="stylesheet"
        href="<?= base_url('assets/sneat/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css'); ?>" />

    <link rel="stylesheet" href="<?= base_url('assets/sneat/assets/vendor/libs/apex-charts/apex-charts.css'); ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/plugins/toastr/toastr.css'); ?>">

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="<?= base_url('assets/sneat/assets/vendor/css/pages/page-auth.css'); ?>" />
    <!-- Helpers -->
    <script src="<?= base_url('assets/sneat/assets/vendor/js/helpers.js'); ?>"></script>
    <script src="<?= base_url('assets/sneat/assets/vendor/js/template-customizer.js'); ?>"></script>
    <script src="<?= base_url('assets/sneat/assets/js/config.js'); ?>"></script>

    <?php ($css != '') ? $this->load->view($css) : ''; ?>
    <style>
    * {
        font-family: 'Poppins', sans-serif;
    }

    .overlayLoading {
        height: 100%;
        display: flex;
        position: absolute;
        align-items: center;
        background-color: rgba(0, 0, 0, .5);
        width: 100%;
        z-index: 50;
        justify-content: center;
    }

    .spinner-border {
        color: white;
        width: 3rem;
        height: 3rem;
        border-width: .25rem;
    }
    </style>
</head>

<body>