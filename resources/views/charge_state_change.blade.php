
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
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- DataTables -->
        <link href="/plugins/datatables/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />

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
                                        <h4 class="page-title">충전 승인/거절</h4>
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="javascript:void(0);">다스톤</a></li>
                                            <li class="breadcrumb-item"><a href="javascript:void(0);">거래 관리</a></li>
                                            <li class="breadcrumb-item active">충전 승인/거절</li>
                                        </ol>
                                    </div><!--end col-->
                                </div><!--end row-->
                            </div><!--end page-title-box-->
                        </div><!--end col-->
                    </div><!--end row-->
                    <!-- end page title end breadcrumb -->
                    <div class="row">
                        <div class="col-lg-12 col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title"><?php if(!empty($_GET['start_date'])){ echo $_GET['start_date']; }else { echo date('Y-m-d'); } ?> ~ <?php if(!empty($_GET['end_date'])){ echo $_GET['end_date']; }else { echo date('Y-m-d'); } ?> 일 충전 신청 내역</h4>
                                    <form action="" method="get">
                                        <div class="row text-center">
                                            <div class="col-sm-3 mt-2">
                                                <input class="form-control" type="date" name="start_date" value="<?php if(!empty($_GET['start_date'])){ echo $_GET['start_date']; }else { echo date('Y-m-d'); } ?>" id="example-date-input">
                                            </div>
                                            <div class="col-sm-3 mt-2">
                                                <input class="form-control" type="date" name="end_date" value="<?php if(!empty($_GET['end_date'])){ echo $_GET['end_date']; }else { echo date('Y-m-d'); } ?>" id="example-date-input">
                                            </div>
                                            <div class="col-sm-1 mt-2">
                                                <button type="submit" class="btn btn-outline-success">검색</button>
                                            </div>
                                        </div>
                                     </form>
                                </div><!--end card-header-->

                                <div class="card-body table-responsive">

                                    <div class="">
                                        <table id="datatable2" class="table dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                            <tr>
                                                <th class="">거래번호</th>
                                                <th class="">거래 타겟</th>
                                                <th class="">거래 금액</th>
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
                                                <td><a class="text-primary">#{{$row->id}}</a></td>
                                                <td>{{$row->company_name}}</td>
                                                <td>{{number_format($row->amount)}} 원</td>
                                                <td>{{$row->date_ymd}}</td>
                                                <td>{{$row->date_time}}</td>
                                                @if($row->trxtype == "CS")
                                                <td class="text-info">충전신청</td>
                                                @elseif ($row->trxtype == "SS")
                                                <td class="text-danger">출금신청</td>
                                                @endif
                                                <td><a href="/state_change?id={{$row->id}}&mode=0" class="btn btn-outline-success ml-2">승인</a> <a href="/state_change?id={{$row->id}}&mode=1" class="btn btn-outline-danger">거절</a>
                                            </td>
                                            </tr>
                                            @endforeach
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!--end row-->

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

        <!-- Required datatable js -->
        <script src="/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="/plugins/datatables/dataTables.bootstrap5.min.js"></script>
        <!-- Responsive examples -->
        <script src="/plugins/datatables/dataTables.responsive.min.js"></script>
        <script src="/plugins/datatables/responsive.bootstrap4.min.js"></script>
        <script src="/assets/pages/jquery.datatable.init.js"></script>

        <!-- App js -->
        <script src="/assets/js/app.js"></script>

    </body>

</html>
