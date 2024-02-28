<!DOCTYPE html>
<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default"
    data-assets-path="<?= base_url('assets/') ?>" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>KLINIK SETDA | RSUD AL IHSAN</title>

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

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="<?= base_url('assets/sneat/assets/vendor/css/pages/page-auth.css'); ?>" />
    <!-- Helpers -->
    <script src="<?= base_url('assets/sneat/assets/vendor/js/helpers.js '); ?>"></script>
    <script src="<?= base_url('assets/sneat/assets/js/config.js'); ?>"></script>
    <?php ($css != '') ? $this->load->view($css) : ''; ?>
</head>

<body>