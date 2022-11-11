
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>Dastone </title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta content="" name="description" />
        <meta content="" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="/assets/images/favicon.ico">

        <!-- App css -->
        <link href="/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="/assets/css/app.min.css" rel="stylesheet" type="text/css" />

    </head>

    <body class="account-body accountbg">

        <!-- Log In page -->
        <div class="container">
            <div class="row vh-100 d-flex justify-content-center">
                <div class="col-12 align-self-center">
                    <div class="row">
                        <div class="col-lg-5 mx-auto">
                            <div class="card">
                                <div class="card-body p-0 auth-header-box">
                                    <div class="text-center p-3">
                                        <a href="/" class="logo logo-admin">
                                            <img src="/assets/images/logo-sm-dark.png" height="50" alt="logo" class="auth-logo">
                                        </a>
                                        <h4 class="mt-3 mb-1 fw-semibold text-white font-18">로그인</h4>
                                        <p class="text-muted  mb-0">사용자 인증이 필요합니다.</p>
                                    </div>
                                </div>
                                <div class="card-body p-0">
                                    <ul class="nav-border nav nav-pills" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active fw-semibold" data-bs-toggle="tab" href="#LogIn_Tab" role="tab">로그인</a>
                                        </li>
                                    </ul>
                                     <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div class="tab-pane active p-3" id="LogIn_Tab" role="tabpanel">
                                            <div class="form-horizontal auth-form">
                                                     <div class="form-group mb-2">
                                                            <label class="form-label" for="user_id">사용자 아이디</label>
                                                            <div class="input-group">
                                                                <input type="text" class="form-control" id="user_id" placeholder="사용자 아이디">
                                                            </div>
                                                        </div><!--end form-group-->

                                                        <div class="form-group mb-2">
                                                            <label class="form-label" for="user_password">사용자 비밀번호</label>
                                                            <div class="input-group">
                                                                <input type="password" class="form-control" id="user_password" placeholder="사용자 비밀번호">
                                                            </div>
                                                        </div><!--end form-group-->

                                                        <div class="form-group row">
                                                            <div class="col-sm text-end">
                                                                <a class="text-muted font-13"><i class="dripicons-lock"></i>비밀번호 모를시 문의 바랍니다.</a>
                                                            </div><!--end col-->
                                                        </div><!--end form-group-->

                                                        <div class="form-group mb-0 row">
                                                            <div class="col-12">
                                                                <button class="btn btn-primary w-100 waves-effect waves-light" type="button" id="auth_login">로그인 <i class="fas fa-sign-in-alt ms-1"></i></button>
                                                            </div><!--end col-->
                                                        </div> <!--end form-group-->
                                                    </div><!--end form-->
                                        </div>
                                    </div>
                                </div><!--end card-body-->
                                <div class="card-body bg-light-alt text-center">
                                    <span class="text-muted d-none d-sm-inline-block">Dastone © <script>
                                        document.write(new Date().getFullYear())
                                    </script></span>
                                </div>
                            </div><!--end card-->
                        </div><!--end col-->
                    </div><!--end row-->
                </div><!--end col-->
            </div><!--end row-->
        </div><!--end container-->
        <!-- End Log In page -->




        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/feather.min.js"></script>
        <script src="assets/js/simplebar.min.js"></script>
        <script src="assets/c_js/login.js"></script>

        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>
    </body>

</html>
