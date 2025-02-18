<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Login - Claim Warranty</title>
        <link href="<?= base_url('css/styles.css') ?>" rel="stylesheet" />
        <!--<script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>-->
        <link href="<?= base_url('fontawesome-free-6.1.0-web/css/fontawesome.min.css') ?>" rel="stylesheet" type="text/css"/>
        <link href="<?= base_url('fontawesome-free-6.1.0-web/css/brands.min.css') ?>" rel="stylesheet" type="text/css"/>
        <link href="<?= base_url('fontawesome-free-6.1.0-web/css/solid.min.css') ?>" rel="stylesheet" type="text/css"/>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header">
                                        <img src="<?= base_url() ?>/assets/img/ptppa.png"  style="display: block; margin-left: auto;margin-right: auto;" width="160" alt=""/> 
                                        <h3 class="text-center font-weight-light my-4">Login Claim Warranty System</h3>
                                    </div>
                                    <div class="card-body">
                                        <form method="post" action="<?= base_url('claim-warranty/loginproses') ?>">
                                            <label for="inputUsername" class="form-label">Username</label>
                                            <div class="input-group mb-3">
                                                <input class="form-control" id="inputUsername" type="text" name="inputUsername" required="">
                                            </div>
                                            <label for="inputPassword" class="form-label">Password</label>
                                            <div class="input-group mb-3">
                                                <input class="form-control" id="inputPassword" type="password" name="inputPassword" required="" aria-label="Input Password" aria-describedby="basic-addon1">
                                                <span class="input-group-text" id="basic-addon1" onclick="password_login_show_hide();">
                                                    <i class="fas fa-eye" id="show_eye"></i>
                                                    <i class="fas fa-eye-slash d-none" id="hide_eye"></i>
                                                </span>
                                            </div>
                                            <!--                                            <div class="form-check mb-3">
                                                                                            <input class="form-check-input" id="inputRememberPassword" type="checkbox" value="" />
                                                                                            <label class="form-check-label" for="inputRememberPassword">Remember Password</label>
                                                                                        </div>-->
                                            <?= $session->getFlashdata('login_gagal'); ?>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a class="small" href="<?= base_url('claim-warranty') ?>">Kembali ke halaman utama</a>
                                                <button class="btn btn-primary" type="submit">Login</button>
                                            </div>
                                        </form>
                                    </div>
                                    <!--                                    <div class="card-footer text-center py-3">
                                                                            <div class="small"><a href="register.html">Need an account? Sign up!</a></div>
                                                                        </div>-->
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2023</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="<?= base_url('js/scripts.js') ?>"></script>
    </body>
</html>
