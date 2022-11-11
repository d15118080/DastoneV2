
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>Dastone - Admin & Dashboard Template</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
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
                            <div class="alert alert-light mt-2 mb-2" role="alert">
                                <h4 class="alert-heading font-18">입금 계좌 안내</h4>
                                <p>금일 입금 계좌는 : <span>{{$data->bank_number}}(은행 : {{$data->bank_name}})</span> 입니다.</p>
                            </div>
                        </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="page-title-box">
                                <div class="row">
                                    <div class="col">
                                        <h4 class="page-title">예치금 충전 신청</h4>
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="javascript:void(0);">다스톤</a></li>
                                            <li class="breadcrumb-item"><a href="javascript:void(0);">거래관리</a></li>
                                            <li class="breadcrumb-item active">예치금 충전 신청</li>
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
                                        <h4 class="card-title">입금자 추가</h4>
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
                                                            <label class="form-label">입금자명</label>
                                                            <input type="text" id="charge_name" value=""
                                                                class="form-control">
                                                        </div>

                                                        <div class="col-sm-3">
                                                         <label class="form-label">입금 금액</label>
                                                            <div class="input-group">
                                                                <input type="text" class="form-control" id="charge_money" placeholder="숫자로만 적어주세요" aria-describedby="basic-money"  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" >
                                                                <span class="input-group-text" id="basic-addon1">원</span>
                                                            </div>
                                                        </div>
                                                        <!--end col-->
                                                        <div class="col-sm-1">
                                                            <button id="charge_add" class="btn btn-outline-info">
                                                                추가
                                                            </button>
                                                        </div>
                                                        <!--end col-->
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

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                         <div class="card-body">
                                <div class="row text-center mb-3">
                                    <div class="col-sm-3"><span
                                            class="border py-2 bg-light d-block mb-2 mb-lg-0">예금주</span></div>
                                    <div class="col-sm-4"><span class="border py-2 bg-light d-block">금액</span>
                                    </div>
                                </div>
                                <div class="money_list">

                                </div>

                            </div>
                            <!--end card-body-->
                            </div><!--end card-body-->
                        </div><!--end col-->
                    </div><!--end row-->
                    <div class="col-lg-12">
                    <button type="button" class="btn btn-outline-primary" id="charge_send">충전 신청</button>
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
        <script src="/assets/c_js/charge.js"></script>

    </body>

</html>
