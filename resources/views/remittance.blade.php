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
                                    <h4 class="page-title">거래 예치금 출금 신청</h4>
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="javascript:void(0);">다스톤</a></li>
                                        <li class="breadcrumb-item"><a href="javascript:void(0);">거래관리</a></li>
                                        <li class="breadcrumb-item active">예치금 출금 신청</li>
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
                                        <h4 class="card-title">계좌검증 </h4><span class="text-danger">출금 가능액 :<?php echo number_format($money); ?></span>
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
                                                            <label class="form-label">입금은행</label>
                                                            <select id="bank_code" class="form-select">
                                                                <option value="002">산업 은행</option>
                                                                <option value="003">기업은행</option>
                                                                <option value="004">국민은행</option>
                                                                <option value="007">수협중앙화</option>
                                                                <option value="011">농협은행</option>
                                                                <option value="012">지역농축협</option>
                                                                <option value="020,">우리은행</option>
                                                                <option value="023">SC은행</option>
                                                                <option value="027">한국시티은행</option>
                                                                <option value="031">대구은행</option>
                                                                <option value="032">부산은행</option>
                                                                <option value="034">광주은행</option>
                                                                <option value="035">제주은행</option>
                                                                <option value="037">전북은행</option>
                                                                <option value="039">경남은행</option>
                                                                <option value="045">새마을금고연합회</option>
                                                                <option value="048">신협</option>
                                                                <option value="088">신한은행</option>
                                                                <option value="050">저축은행</option>
                                                                <option value="071">우체국</option>
                                                                <option value="081">하나은행</option>
                                                                <option value="089">케이뱅크</option>
                                                                <option value="090">카카오뱅크</option>
                                                                <option value="092">토스뱅크</option>
                                                            </select>
                                                        </div>
                                                        <!--end col-->

                                                        <div class="col-sm-3">
                                                            <label class="form-label">계좌번호</label>
                                                            <input type="text" id="bank_number" value=""
                                                                class="form-control">
                                                        </div>

                                                        <div class="col-sm-2">
                                                            <label class="form-label">송금 금액</label>
                                                            <input type="nunmber" id="money" value=""
                                                                class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                                        </div>
                                                        <!--end col-->
                                                        <div class="col-sm-1">
                                                            <button id="bank_check" class="btn btn-outline-info">
                                                                계좌검증
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
                                                        <span class="fas fa-plus"></span> 추가
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
                                        <h4 class="card-title">송금 대상</h4>
                                        <p class="text-muted mb-0">계좌 검증에 통과시 송금대상자로 이동합니다.</p>
                                        <span class="text-danger">출금 가능액 :<?php echo number_format($money); ?></span>
                                    </div>
                                    <!--end col-->
                                    <div class="col-auto">
                                        <div class="dropdown">
                                            <button type="button" id="remittance_send" class="btn btn-outline-primary">
                                                출금 요청
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end card-header-->
                            <div class="card-body">
                                <div class="row text-center mb-3">
                                    <div class="col-sm-3"><span
                                            class="border py-2 bg-light d-block mb-2 mb-lg-0">예금주</span></div>
                                    <div class="col-sm-4"><span
                                            class="border py-2 bg-light d-block mb-2 mb-lg-0">계좌번호</span></div>
                                    <div class="col-sm-4"><span class="border py-2 bg-light d-block">금액</span>
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
