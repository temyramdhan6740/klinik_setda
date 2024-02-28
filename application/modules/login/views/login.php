<!-- Content -->

<div class="authentication-inner row m-0">
    <!-- /Left Text -->
    <div class="d-none d-lg-flex col-lg-7 col-xl-8 align-items-center p-5 rounded-left"
        style="background: rgba(114, 179, 134, 1);">
        <div class="w-100 d-flex justify-content-center" style="background: rgba(100, 157, 117, 1);">
            <img src="<?= base_url('assets/img/logo_login.png') ?>" class="img-fluid" alt="Login image" width="500"
                data-app-dark-img="assets/img/logo_login.png" data-app-light-img="assets/img/logo_login.png">
        </div>
    </div>
    <!-- /Left Text -->

    <!-- Login -->
    <div class="d-flex col-12 col-lg-5 col-xl-4 align-items-center authentication-bg p-sm-5 p-4 rounded-right">
        <div class="w-px-400 mx-auto">
            <!-- Logo -->
            <div class="app-brand mb-5">
                <a href="#" class="app-brand-link gap-2">
                    <span class="app-brand-logo demo">
                        <img src="<?= base_url('assets/img/logo_rekamedis.png') ?>" class="img-fluid" alt="Login image"
                            width="350" data-app-dark-img="assets/img/logo_rekamedis.png"
                            data-app-light-img="assets/img/logo_rekamedis.png">
                    </span>

                </a>
            </div>
            <!-- /Logo -->

            <form name="formLogin" class="mb-3" action="#" id="formLogin">
                <div class="mb-3">
                    <label for="username" class="form-label">username</label>
                    <input type="text" id="username" class="form-control" name="username" placeholder="username"
                        aria-describedby="username" />
                </div>
                <div class="mb-3 form-password-toggle">
                    <div class="d-flex justify-content-between">
                        <label class="form-label" for="password">Password</label>
                    </div>
                    <div class="input-group input-group-merge">
                        <input type="password" id="password" class="form-control" name="password"
                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                            aria-describedby="password" />
                        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                    </div>
                </div>
                <div class="mb-3">
                    <button class="btn btn-primary d-grid w-100" type="button" id="btnLogin">Login</button>
                </div>
            </form>
            <!-- <p class="text-center">
                <a href="auth-register-cover.html">
                    <span>Forgot Password?</span>
                </a>
            </p> -->
        </div>
    </div>
    <!-- /Login -->
</div>


<!-- / Content -->