<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="utf-8" />
    <title>Dastone</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="" name="description" />
    <meta content="" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="/assets/images/favicon.ico">

    <!-- Plugins css -->
    <link href="/plugins/select2/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="/plugins/huebee/huebee.min.css" rel="stylesheet" type="text/css" />
    <link href="/plugins/timepicker/bootstrap-material-datetimepicker.css" rel="stylesheet">
    <link href="/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />

    <!-- App css -->
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/metisMenu.min.css" rel="stylesheet" type="text/css" />
    <link href="/plugins/daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/app.min.css" rel="stylesheet" type="text/css" />

</head>
    <?php
    if($mode == 0){
        $mode_name = "가맹점";
    }elseif ($mode == 1) {
        $mode_name = "지사";
    }
    ?>
<body>
    <!-- Left Sidenav -->
    @include('include.left-sidenav')
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
                                    <h4 class="page-title">{{$mode_name}} 추가</h4>
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="javascript:void(0);">다스톤</a></li>
                                        <li class="breadcrumb-item"><a href="javascript:void(0);">{{$mode_name}} 관리</a></li>
                                        <li class="breadcrumb-item active">{{$mode_name}} 추가</li>
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
                                <h4 class="card-title">{{$mode_name}} 추가</h4>
                                <p class="text-muted mb-0">값 입력시 제대로 한번씩 확인해주세요.</p>
                            </div>
                            <!--end card-header-->
                            <div class="card-body bootstrap-select-1">
                                <div class="row">
                                    <div class="col-md">
                                        @if($mode == 1)
                                        <label class="mb-3">연결할 지사</label>
                                        <select class="select2 form-control mb-3 custom-select"
                                            style="width: 100%; height:36px;">
                                            <option>Select</option>
                                            <option value="AK">Alaska</option>
                                            <option value="HI">Hawaii</option>
                                        </select>
                                        @endif
                                        <div class="mt-3">
                                            <label class="mb-2">{{$mode_name}} 이름</label>
                                            <input type="text" class="form-control" id="franchisee_name" />
                                        </div>
                                        <div class="mt-3">
                                            <label class="mb-2">{{$mode_name}} 아이디</label>
                                            <input type="text" class="form-control" maxlength="25" id="user_id" />
                                        </div>
                                        <div class="mt-3">
                                            <label class="mb-2">{{$mode_name}} 비밀번호</label>
                                            <input type="password" class="form-control" id="user_password" />
                                        </div>
                                        <div class="mt-3">
                                            <div class="form-group">
                                                <label class="mb-3">{{$mode_name}} 수수료</label>
                                                <p class="text-muted mb-3 font-13">
                                                    0.10 은 0.1% 입니다.
                                                </p>
                                                <input id="demo1" type="text" value="0" name="commission">
                                            </div>
                                        </div>
                                        <div style="text-align: right;"><button  type="button" class="btn btn-outline-success ml-2">생성</button></div>

                                    </div><!-- end col -->
                                </div><!-- end row -->
                            </div><!-- end card-body -->
                        </div> <!-- end card -->
                    </div> <!-- end col -->
                </div> <!-- end row -->

            </div><!-- container -->

            @include('include.footer')
            <!--end footer-->
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

    <!-- Plugins js -->

    <script src="/plugins/select2/select2.min.js"></script>
    <script src="/plugins/huebee/huebee.pkgd.min.js"></script>
    <script src="/plugins/timepicker/bootstrap-material-datetimepicker.js"></script>
    <script src="/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
    <script src="/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js"></script>

    <script src="/assets/pages/jquery.forms-advanced.js"></script>

    <!-- App js -->
    <script src="/assets/js/app.js"></script>

</body>

</html>
