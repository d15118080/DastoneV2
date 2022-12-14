<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="utf-8" />
    <title>Dastone</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- jvectormap -->
    <link href="plugins/jvectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet">

    <!-- App css -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/metisMenu.min.css" rel="stylesheet" type="text/css" />
    <link href="plugins/daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />

</head>

<body class="">
    <!-- Left Sidenav -->
    <div class="left-sidenav">
        <!-- LOGO -->
        <div class="brand">
            <a href="/" class="logo">
                <span>
                    <img src="assets/images/logo-sm.png" alt="logo-small" class="logo-sm">
                </span>
                <span>
                    <img src="assets/images/logo.png" alt="logo-large" class="logo-lg logo-light">
                    <img src="assets/images/logo-dark.png" alt="logo-large" class="logo-lg logo-dark">
                </span>
            </a>
        </div>
        <!--end logo-->
        @include('include.left-sidenav')
    </div>
    <!-- end left-sidenav-->


    <div class="page-wrapper">
        <!-- Top Bar Start -->
        @include('include.topbar')
        <!-- Top Bar End -->

        <!-- Page Content-->
        <div class="page-content">
            <div class="container-fluid">
                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="row">
                                <div class="col">
                                    <h4 class="page-title">?????? ????????? ?????? ??????</h4>
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="javascript:void(0);">?????????</a></li>
                                        <li class="breadcrumb-item"><a href="javascript:void(0);">????????????</a></li>
                                        <li class="breadcrumb-item active">????????? ?????? ??????</li>
                                    </ol>

                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </div>
                        <!--end page-title-box-->
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->
                <!-- end page title end breadcrumb -->


                <div class="row">
                    <div class="col-lg">
                        <div class="card">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h4 class="card-title">???????????? </h4><span class="text-danger">?????? ????????? :<?php echo number_format($money); ?></span>
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->
                            </div>
                            <!--end card-header-->
                            <div class="card-body">
                                <div class="form-horizontal well">
                                    <fieldset>
                                        <div class="repeater-default">
                                            <div data-repeater-list="car">
                                                <div data-repeater-item="">
                                                    <div class="form-group row d-flex align-items-end">

                                                        <div class="col-sm-3">
                                                            <label class="form-label">????????????</label>
                                                            <select id="bank_code" class="form-select">
                                                                <option value="002">?????? ??????</option>
                                                                <option value="003">????????????</option>
                                                                <option value="004">????????????</option>
                                                                <option value="007">???????????????</option>
                                                                <option value="011">????????????</option>
                                                                <option value="012">???????????????</option>
                                                                <option value="020,">????????????</option>
                                                                <option value="023">SC??????</option>
                                                                <option value="027">??????????????????</option>
                                                                <option value="031">????????????</option>
                                                                <option value="032">????????????</option>
                                                                <option value="034">????????????</option>
                                                                <option value="035">????????????</option>
                                                                <option value="037">????????????</option>
                                                                <option value="039">????????????</option>
                                                                <option value="045">????????????????????????</option>
                                                                <option value="048">??????</option>
                                                                <option value="088">????????????</option>
                                                                <option value="050">????????????</option>
                                                                <option value="071">?????????</option>
                                                                <option value="081">????????????</option>
                                                                <option value="089">????????????</option>
                                                                <option value="090">???????????????</option>
                                                                <option value="092">????????????</option>
                                                            </select>
                                                        </div>
                                                        <!--end col-->

                                                        <div class="col-sm-3">
                                                            <label class="form-label">????????????</label>
                                                            <input type="text" id="bank_number" value=""
                                                                class="form-control">
                                                        </div>

                                                        <div class="col-sm-2">
                                                            <label class="form-label">?????? ??????</label>
                                                            <input type="nunmber" id="money" value=""
                                                                class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                                        </div>
                                                        <!--end col-->
                                                        <div class="col-sm-1">
                                                            <button id="bank_check" class="btn btn-outline-info">
                                                                ????????????
                                                            </button>
                                                        </div>
                                                        <!--end col-->
                                                    </div>
                                                    <!--end row-->
                                                </div>
                                                <!--end /div-->
                                            </div>
                                            <!--end repet-list-->
                                            <div class="form-group mb-0 row">
                                                <div class="col-sm-12">
                                                    {{-- <span data-repeater-create="" class="btn btn-outline-secondary">
                                                        <span class="fas fa-plus"></span> ??????
                                                    </span> --}}
                                                </div>
                                                <!--end col-->
                                            </div>
                                            <!--end row-->
                                        </div>
                                        <!--end repeter-->
                                    </fieldset>
                                    <!--end fieldset-->
                                </div>
                                <!--end form-->
                            </div>
                            <!--end card-body-->
                        </div>

                        <!--end card-->
                    </div>
                    <!--end col-->
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h4 class="card-title">?????? ??????</h4>
                                        <p class="text-muted mb-0">?????? ????????? ????????? ?????????????????? ???????????????.</p>
                                        <span class="text-danger">?????? ????????? :<?php echo number_format($money); ?></span>
                                    </div>
                                    <!--end col-->
                                    <div class="col-auto">
                                        <div class="dropdown">
                                            <button type="button" id="remittance_send" class="btn btn-outline-primary">
                                                ?????? ??????
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end card-header-->
                            <div class="card-body">
                                <div class="row text-center mb-3">
                                    <div class="col-sm-3"><span
                                            class="border py-2 bg-light d-block mb-2 mb-lg-0">?????????</span></div>
                                    <div class="col-sm-4"><span
                                            class="border py-2 bg-light d-block mb-2 mb-lg-0">????????????</span></div>
                                    <div class="col-sm-4"><span class="border py-2 bg-light d-block">??????</span>
                                    </div>
                                </div>
                                <div class="money_list">


                                </div>

                            </div>
                            <!--end card-body-->
                        </div>
                        <!--end card-->
                    </div> <!-- end col -->
                </div>
                <!--end row-->


            </div><!-- container -->
            <!--end footer-->
            @include('include.footer')
        </div>
        <!-- end page content -->
    </div>
    <!-- end page-wrapper -->




    <!-- jQuery  -->
    <script src="/assets/js/jquery.min.js"></script>
    <script src="/assets/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/metismenu.min.js"></script>
    <script src="/assets/js/waves.js"></script>
    <script src="/assets/js/feather.min.js"></script>
    <script src="/assets/js/simplebar.min.js"></script>
    <script src="/assets/js/moment.js"></script>
    <script src="/plugins/daterangepicker/daterangepicker.js"></script>

    <script src="/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="/plugins/jvectormap/jquery-jvectormap-us-aea-en.js"></script>
    <script src="/assets/pages/jquery.analytics_dashboard.init.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>
    <script type="module" src="/assets/c_js/remittance.js"></script>
    <script src="/assets/pages/jquery.form-repeater.js"></script>
    <script src="/plugins/repeater/jquery.repeater.min.js"></script>
    <!-- App js -->
    <script src="/assets/js/app.js"></script>
</body>

</html>
