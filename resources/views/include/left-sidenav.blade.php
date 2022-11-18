    <div class="left-sidenav">
        <!-- LOGO -->
        <div class="brand">
            <a href="/" class="logo">
                <span>
                    <img src="/assets/images/logo-sm.png" alt="logo-small" class="logo-sm">
                </span>
                <span>
                    <img src="/assets/images/logo.png" alt="logo-large" class="logo-lg logo-light">
                    <img src="/assets/images/logo-dark.png" alt="logo-large" class="logo-lg logo-dark">
                </span>
            </a>
        </div>
        <!--end logo-->
        <div class="menu-content h-100" data-simplebar>
            <ul class="metismenu left-sidenav-menu">
                <li class="menu-label mt-0">메뉴</li>
                <li>
                    <a href="/"><i data-feather="home"
                            class="align-self-center menu-icon"></i><span>대시보드</span></a>
                </li>


                <li>
                    <a href="javascript: void(0);"><i data-feather="archive"
                            class="align-self-center menu-icon"></i><span>거래관리</span><span class="menu-arrow"><i
                                class="mdi mdi-chevron-right"></i></span></a>
                    <ul class="nav-second-level" aria-expanded="false">
                        {{-- 가맹점만 --}}
                        @if(session('state')==2)
                          <li class="nav-item"><a class="nav-link" href="/charge"><i
                                    class="ti-control-record"></i>예치금 충전 신청</a></li>
                        @endif
                        {{-- 공통 --}}
                        <li class="nav-item"><a class="nav-link" href="/history"><i
                                    class="ti-control-record"></i>거래 내역</a></li>
                        {{-- 관리자 --}}
                        @if(session('state')==0)
                        <li class="nav-item"><a class="nav-link" href="/management"><i
                                    class="ti-control-record"></i>충전 승인/거절</a></li>
                        <li class="nav-item"><a class="nav-link" href="/bank_edit"><i
                                    class="ti-control-record"></i>계래 계좌 수정/등록</a></li>
                        @endif
                        <li class="nav-item"><a class="nav-link" href="/remittance"><i
                                    class="ti-control-record"></i>예치금 출금 신청</a></li>

                    </ul>
                </li>
                @if(session('state')==0)
                  <li>
                    <a href="javascript: void(0);"><i data-feather="users"
                            class="align-self-center menu-icon"></i><span>지사 관리</span><span
                            class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li class="nav-item"><a class="nav-link" href="/branch_add"><i
                                    class="ti-control-record"></i>지사 추가</a></li>
                        <li class="nav-item"><a class="nav-link" href="/branchs"><i
                                    class="ti-control-record"></i>지사 리스트</a></li>
                    </ul>
                </li>
                @endif

                @if(session('state')==1 || session('state')==0)
                <li>
                    <a href="javascript: void(0);"><i data-feather="user"
                            class="align-self-center menu-icon"></i><span>가맹점 관리</span><span
                            class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                    <ul class="nav-second-level" aria-expanded="false">
                        @if(session('state')==0)
                        <li class="nav-item"><a class="nav-link" href="/franchisees_add"><i
                                    class="ti-control-record"></i>가맹점 추가</a></li>
                        @endif
                        <li class="nav-item"><a class="nav-link" href="/franchisees"><i
                                    class="ti-control-record"></i>가맹점 리스트</a></li>
                    </ul>
                </li>
                @endif
                 <li>
                    <a href="/telegram_set"><i data-feather="bell"
                            class="align-self-center menu-icon"></i><span>텔레그램 알림 설정</span></a>
                </li>
            </ul>

            <div class="update-msg text-center">
                <h5 class="mt-3">문의</h5>
                <p class="mb-3">텔레그램</p>
            </div>
        </div>
    </div>
