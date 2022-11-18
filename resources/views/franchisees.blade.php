
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
                                        <h4 class="page-title">가맹점 리스트</h4>
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="javascript:void(0);">다스톤</a></li>
                                            <li class="breadcrumb-item"><a href="javascript:void(0);">가맹점 관리</a></li>
                                            <li class="breadcrumb-item active">가맹점 리스트</li>
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
                                    <h4 class="card-title">가맹점 리스트</h4>
                                </div><!--end card-header-->

                                <div class="card-body table-responsive">

                                    <div class="">
                                        <table id="datatable2" class="table dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                            <tr>
                                                <th class="">PK</th>
                                                <th class="">연결 지사</th>
                                                <th class="">가맹점 이름</th>
                                                <th class="">가맹점 수수료</th>
                                                <th class="">생성 날짜</th>
                                                <th class="">거래 상태</th>
                                                @if(session('state') == 0)
                                                <th class="">거래 상태 수정</th>
                                                <th class="">가맹점 수정</th>
                                                @endif

                                            </tr>
                                            </thead>

                                            <tbody>
                                            @if($Data !=null)
                                            @foreach ($Data as $row )
                                             <tr>
                                                <td><a class="text-primary">#{{$row->ck_id}}</a></td>
                                                <td>{{$row->pk_name}}</td>
                                                <td>{{$row->user_name}}<small class="text-muted">({{$row->user_id}})</small></td>
                                                <td><?php echo $row->user_margin *100 ?>% </td>
                                                <td>{{$row->user_reg_date}}</td>
                                                @if($row->state == 10)
                                                <td class="text-danger">차단</td>
                                                @else
                                                <td class="text-info">정상</td>
                                                @endif
                                                {{-- text-info 정상 / text-danger 충전 text-danger 차단   --}}
                                                 @if(session('state') == 0)
                                                 @if($row->state == 10)
                                                <td><a href="/user_state_change?id={{$row->id}}&mode=0&s=2" class="btn btn-outline-success ml-2">정상 으로 변경</a> </td>
                                                @else
                                                <td><a href="/user_state_change?id={{$row->id}}&mode=1&s=2" class="btn btn-outline-danger">차단 으로 변경</a></td>
                                                @endif
                                                <td><a href="/user_edit?ck_id={{$row->ck_id}}" class="btn btn-outline-info ml-2">수정</a> </td>
                                                @endif
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
