
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>Dastone - Admin</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta content="" name="description" />
        <meta content="" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- App css -->
        <link href="/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="/assets/css/metisMenu.min.css" rel="stylesheet" type="text/css" />
        <link href="/plugins/daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css" />
        <link href="/assets/css/app.min.css" rel="stylesheet" type="text/css" />

    </head>

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
                                        <h4 class="page-title">텔레그램 알림 설정</h4>
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item active">텔레그램 알림 설정</li>
                                        </ol>
                                    </div><!--end col-->
                                </div><!--end row-->
                            </div><!--end page-title-box-->
                        </div><!--end col-->
                    </div><!--end row-->
                    <!-- end page title end breadcrumb -->

                     <div class="row">
                    <div class="col-lg">
                        <div class="card">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h4 class="card-title">텔레그램 등록</h4>
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
                                                    @csrf
                                                <div data-repeater-item="">
                                                    <div class="form-group row d-flex align-items-end">

                                                        <div class="col-sm-3">
                                                            <label class="form-label">아래의 내용을 그대로 복사히셔서 붙여넣으세요.</label>
                                                            <input type="text" value="/set {{$ck_id}}"disabled
                                                                class="form-control">
                                                        </div>
                                                        <!--end col-->
                                                    </div>
                                                            <div class="col-sm-3">
                                                            <label class="form-label">텔레그램 링크</label>
                                                            <a style="color:blue" href="https://t.me/Dastone_bot" target="_blank">바로가기</a>
                                                        </div>
                                                    <!--end row-->
                                                </div>
                                                <!--end /div-->
                                            </div>
                                            <!--end repet-list-->
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

                </div><!-- container -->

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

        <!-- App js -->
        <script src="/assets/js/app.js"></script>

        <!-- Charge js -->
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>

    </body>

</html>
