    <div class="topbar">
            <!-- Navbar -->
            <nav class="navbar-custom">
                <ul class="list-unstyled topbar-nav float-end mb-0">
                    <li class="dropdown">
                        <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-bs-toggle="dropdown"
                            href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <span class="ms-1 nav-user-name sm text-primary" style="margin-right: 2%"><?= session('user_name') ?></span><small class="text-muted">(<?= session('ck_id') ?>)</small>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="#"><i data-feather="user"
                                    class="align-self-center icon-xs icon-dual me-1"></i> 내정보</a>
                            <div class="dropdown-divider mb-0"></div>
                            <a class="dropdown-item" href="/logout"><i data-feather="power"
                                    class="align-self-center icon-xs icon-dual me-1"></i> 로그아웃</a>
                        </div>
                    </li>
                </ul>
                <!--end topbar-nav-->

                <ul class="list-unstyled topbar-nav mb-0">
                    <li>
                        <button class="nav-link button-menu-mobile">
                            <i data-feather="menu" class="align-self-center topbar-icon"></i>
                        </button>
                    </li>
                </ul>
            </nav>
            <!-- end navbar-->
        </div>
        {{-- 가맹점 에게만 뜨도록 --}}
        {{-- <div class="card-body">
            <div class="alert alert-light mb-0" role="alert">
                <h4 class="alert-heading font-18">입금 계좌 안내</h4>
                <p>금일 입금 계좌는 : <span>1515111</span> 입니다.</p>
            </div>
        </div> --}}


