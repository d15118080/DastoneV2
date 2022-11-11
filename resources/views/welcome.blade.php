<!DOCTYPE html>
<html lang="Ko">

<head>
    <meta charset="utf-8" />
    <title>Dastone</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="" name="description" />
    <meta content="" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- jvectormap -->
    <link href="/plugins/jvectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet">

    <!-- App css -->
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/metisMenu.min.css" rel="stylesheet" type="text/css" />
    <link href="/plugins/daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/app.min.css" rel="stylesheet" type="text/css" />

</head>

<body class="">
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
                                    <h4 class="page-title">대시보드</h4>

                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="javascript:void(0);">다스톤</a></li>
                                        <li class="breadcrumb-item active">대시보드</li>
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


               @if(session('state')==0)
                {{-- 지사 --}}
                <div class="row">
                    <div class="col-lg">
                        <div class="row justify-content-center">
                            <div class="col-md-6 col-lg-2">
                                <div class="card report-card">
                                    <div class="card-body">
                                        <div class="row d-flex justify-content-center">
                                            <div class="col">
                                                <p class="text-dark mb-0 fw-semibold">입점 지사</p>
                                                <h3 class="m-0">{{number_format($user_count)}}개 업체</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end card-body-->
                                </div>
                                <!--end card-->
                            </div>
                            <!--end col-->
                            <div class="col-md-6 col-lg-2">
                                <div class="card report-card">
                                    <div class="card-body">
                                        <div class="row d-flex justify-content-center">
                                            <div class="col">
                                                <p class="text-dark mb-0 fw-semibold">입점 가맹점</p>
                                                <h3 class="m-0">{{number_format($user_count2)}}개 업체</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end card-body-->
                                </div>
                                <!--end card-->
                            </div>
                            <!--end col-->
                            <div class="col-md-6 col-lg-2">
                                <div class="card report-card">
                                    <div class="card-body">
                                        <div class="row d-flex justify-content-center">
                                            <div class="col">
                                                <p class="text-dark mb-0 fw-semibold">금일 충전 금액</p>
                                                <h3 class="m-0">{{number_format($today_C)}} 원</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end card-body-->
                                </div>
                                <!--end card-->
                            </div>
                             <div class="col-md-6 col-lg-2">
                                <div class="card report-card">
                                    <div class="card-body">
                                        <div class="row d-flex justify-content-center">
                                            <div class="col">
                                                <p class="text-dark mb-0 fw-semibold">전일 충전 금액</p>
                                                <h3 class="m-0">{{number_format($beforeDay_C)}} 원</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end card-body-->
                                </div>
                                <!--end card-->
                            </div>
                            <!--end col-->
                            <div class="col-md-6 col-lg-3">
                                <div class="card report-card">
                                    <div class="card-body">
                                        <div class="row d-flex justify-content-center">
                                            <div class="col">
                                                <p class="text-dark mb-0 fw-semibold">현재 잔액</p>
                                                <h3 class="m-0">{{number_format($money)}} 원</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end card-body-->
                                </div>
                                <!--end card-->
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </div>
                    <!--end col-->
                </div>
                @endif
                <!--end row-->

                @if(session('state')==1)
                {{-- 지사 --}}
                <div class="row">
                    <div class="col-lg">
                        <div class="row justify-content-center">
                            <div class="col-md-6 col-lg-3">
                                <div class="card report-card">
                                    <div class="card-body">
                                        <div class="row d-flex justify-content-center">
                                            <div class="col">
                                                <p class="text-dark mb-0 fw-semibold">입점 가맹점</p>
                                                <h3 class="m-0">{{number_format($user_count)}}개 업체</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end card-body-->
                                </div>
                                <!--end card-->
                            </div>
                            <!--end col-->
                            <div class="col-md-6 col-lg-3">
                                <div class="card report-card">
                                    <div class="card-body">
                                        <div class="row d-flex justify-content-center">
                                            <div class="col">
                                                <p class="text-dark mb-0 fw-semibold">금일 충전 금액</p>
                                                <h3 class="m-0">{{number_format($today_C)}}원</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end card-body-->
                                </div>
                                <!--end card-->
                            </div>
                            <!--end col-->
                            <div class="col-md-6 col-lg-3">
                                <div class="card report-card">
                                    <div class="card-body">
                                        <div class="row d-flex justify-content-center">
                                            <div class="col">
                                                <p class="text-dark mb-0 fw-semibold">전일 충전 금액</p>
                                                <h3 class="m-0">{{number_format($beforeDay_C)}} 원</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end card-body-->
                                </div>
                                <!--end card-->
                            </div>
                            <!--end col-->
                            <div class="col-md-6 col-lg-3">
                                <div class="card report-card">
                                    <div class="card-body">
                                        <div class="row d-flex justify-content-center">
                                            <div class="col">
                                                <p class="text-dark mb-0 fw-semibold">현재 잔액</p>
                                                <h3 class="m-0">{{number_format($money)}} 원</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end card-body-->
                                </div>
                                <!--end card-->
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </div>
                    <!--end col-->
                </div>
                @endif
                <!--end row-->

                @if(session('state')==2)
                {{-- 가맹점 --}}
                <div class="row">
                    <div class="col-lg">
                        <div class="row justify-content-center">
                            <div class="col-md-6 col-lg-3">
                                <div class="card report-card">
                                    <div class="card-body">
                                        <div class="row d-flex justify-content-center">
                                            <div class="col">
                                                <p class="text-dark mb-0 fw-semibold">금일 충전 금액</p>
                                                <h3 class="m-0">{{number_format($today_C)}}원</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end card-body-->
                                </div>
                                <!--end card-->
                            </div>
                            <!--end col-->
                            <div class="col-md-6 col-lg-3">
                                <div class="card report-card">
                                    <div class="card-body">
                                        <div class="row d-flex justify-content-center">
                                            <div class="col">
                                                <p class="text-dark mb-0 fw-semibold">금일 출금 금액</p>
                                                <h3 class="m-0">{{number_format($today_S)}} 원</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end card-body-->
                                </div>
                                <!--end card-->
                            </div>
                            <!--end col-->
                            <div class="col-md-6 col-lg-3">
                                <div class="card report-card">
                                    <div class="card-body">
                                        <div class="row d-flex justify-content-center">
                                            <div class="col">
                                                <p class="text-dark mb-0 fw-semibold">전일 충전 금액</p>
                                                <h3 class="m-0">{{number_format($beforeDay_C)}} 원</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end card-body-->
                                </div>
                                <!--end card-->
                            </div>
                            <!--end col-->
                            <div class="col-md-6 col-lg-3">
                                <div class="card report-card">
                                    <div class="card-body">
                                        <div class="row d-flex justify-content-center">
                                            <div class="col">
                                                <p class="text-dark mb-0 fw-semibold">현재 잔액</p>
                                                <h3 class="m-0">{{number_format($money)}} 원</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end card-body-->
                                </div>
                                <!--end card-->
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </div>
                    <!--end col-->
                </div>
                @endif
                <!--end row-->

                <div class="row">
                    <div class="col-lg">
                        <div class="card">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h4 class="card-title">최근 거래내역</h4>
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->
                            </div>
                            <!--end card-header-->
                            <div class="card-body">
                                <div class="table-responsive browser_users">
                                   <table id="datatable2" class="table dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                            <tr>
                                                <th class="">거래번호</th>
                                                <th class="">거래 타겟</th>
                                                <th class="">거래 금액</th>
                                                <th class="">대상자</th>
                                                <th class="">거래 날짜</th>
                                                <th class="">거래 시간</th>
                                                <th class="">거래 구분</th>
                                                <th class="">거래 상태</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if($data != null)
                                            @foreach ($data as $row )
                                             <tr>
                                                <td><a class="text-primary">{{$row->tradeNumber}}</a></td>
                                                <td>{{$row->company_name}}</td>
                                                <td><?php echo number_format($row->amount) ?>원<small class="text-muted"><?php if($row->virtual_account != "A"){ echo "(".number_format($row->balance).")"; }?></small></td>
                                                <td>{{$row->user_name}}</td>
                                                <td>{{$row->date_ymd}}</td>
                                                <td>{{$row->date_time}}</td>
                                                @if ($row->trxtype == "CS" || $row->trxtype == "CO" || $row->trxtype == "CX")
                                                <td class="text-secondary">충전</td>
                                                @elseif($row->trxtype == "SS" ||$row->trxtype == "SO"||$row->trxtype == "SX")
                                                <td class="text-danger">출금</td>
                                                @endif

                                                @if ($row->trxtype == "CS")
                                                <td class="text-secondary">충전신청</td>
                                                @elseif ($row->trxtype == "CO")
                                                <td class="text-info">충전완료</td>
                                                @elseif ($row->trxtype == "CX")
                                                <td class="text-danger">충전반려</td>
                                                @elseif($row->trxtype == "SS")
                                                <td class="text-warning">출금대기</td>
                                                @elseif($row->trxtype == "SO")
                                                <td class="text-success">출금완료</td>
                                                @elseif($row->trxtype == "SX")
                                                <td class="text-danger">출금반려</td>
                                                @endif
                                            </tr>
                                             @endforeach
                                             @else
                                             <tr>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                             </tr>
                                             @endif
                                            </tbody>
                                        </table>
                                    <!--end table-->
                                </div>
                                <!--end /div-->
                            </div>
                            <!--end card-body-->
                        </div>
                        <!--end card-->
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->


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

    <script src="/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="/plugins/jvectormap/jquery-jvectormap-us-aea-en.js"></script>

    <!-- App js -->
    <script src="/assets/js/app.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>
</body>

</html>
