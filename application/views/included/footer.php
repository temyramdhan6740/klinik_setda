<div class="modal fade" id="modalLogout" tabindex="-1" role="dialog" aria-labelledby="modalLogout" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="modalLogout-title">Logout</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah anda yakin ingin keluar?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Batal
                </button>
                <a href="<?= base_url('login/doOut'); ?>" class="btn btn-primary">Keluar</a>
            </div>
        </div>
    </div>
</div>
<!-- Footer -->
<footer class="content-footer footer bg-footer-theme">
    <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
        <div class="mb-2 mb-md-0">
            © 2022 All Rights Reserved.
            Made with 💦 by
            SIMRS
        </div>

    </div>
</footer>
<!-- / Footer -->

<div class="content-backdrop fade"></div>
</div>
<!-- Content wrapper -->
</div>
<!-- / Layout page -->
</div>

<!-- Overlay -->
<div class="layout-overlay layout-menu-toggle"></div>
</div>
<!-- / Layout wrapper -->
<!-- Drag Target Area To SlideIn Menu On Small Screens -->
<div class="drag-target"></div>
<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->
<script src="<?= base_url('assets/sneat/assets/vendor/libs/jquery/jquery.js'); ?>"></script>
<script src="<?= base_url('assets/sneat/assets/vendor/libs/popper/popper.js'); ?>"></script>
<script src="<?= base_url('assets/sneat/assets/vendor/js/bootstrap.js'); ?>"></script>
<script src="<?= base_url('assets/sneat/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js'); ?>">
</script>

<script src="<?= base_url('assets/sneat/assets/vendor/js/menu.js'); ?>"></script>
<!-- endbuild -->

<!-- Vendors JS -->
<script src="<?= base_url('assets/sneat/assets/vendor/libs/apex-charts/apexcharts.js'); ?>">
</script>

<!-- Main JS -->
<script src="<?= base_url('assets/sneat/assets/js/main.js'); ?>"></script>

<!-- Page JS -->
<script src="<?= base_url('assets/sneat/assets/js/dashboards-analytics.js'); ?>"></script>
<script src="<?= base_url('assets/sneat/assets/js/ui-toasts.js'); ?>"></script>
<!-- TOAST -->
<script src="<?= base_url('assets/plugins/toastr/toastr.min.js') ?>"></script>
<!-- Place this tag in your head or just before your close body tag. -->
<script async defer src="https://buttons.github.io/buttons.js"></script>


<?php ($js != '') ? $this->load->view($js) : ''; ?>
</body>

</html>