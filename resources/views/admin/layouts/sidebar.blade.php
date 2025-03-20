<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="{{ route('admin.dashboard') }}" class="logo">
                <img src="{{ asset('backend/assets/img/kaiadmin/logo_light.png') }}" alt="Peace MFB Logo"
                    class="navbar-brand" style="height: 40px" />
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
        <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                <li id="dashboard" class="nav-item mb-3">
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li id="pwdchange" class="nav-item mb-3">
                    <a href="{{ route('admin.changePassword') }}">
                        <i class="fas fa-lock"></i>
                        <p>Change Password</p>
                    </a>
                </li>

                @if (app('Menu')->allowAccess(Auth::user()->role_id, 1) == true)
                    <li id="settings" class="nav-item mb-3">
                        <a data-bs-toggle="collapse" href="#platform" class="collapsed" aria-expanded="false">
                            <i class="fas fa-cog"></i>
                            <p>Platform Settings</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="platform" style="">
                            <ul class="nav nav-collapse">

                                <li id="features">
                                    <a href="{{ route('admin.platformFeatures') }}">
                                        <span class="sub-item">Platform Features</span>
                                    </a>
                                </li>

                                <li id="roles">
                                    <a href="{{ route('admin.manageRoles') }}">
                                        <span class="sub-item">Roles & Permissions</span>
                                    </a>
                                </li>

                                <li id="acctype">
                                    <a href="{{ route('admin.accountTypes') }}">
                                        <span class="sub-item">Account Types</span>
                                    </a>
                                </li>
                                {{-- <li id="acctype">
                                <a href="{{ route('admin.accountTypes') }}">
                                    <span class="sub-item">KYC Configuration</span>
                                </a>
                            </li> --}}
                                <li id="trfee">
                                    <a href="{{ route('admin.transferFees') }}">
                                        <span class="sub-item">Transfer Fees</span>
                                    </a>
                                </li>
                                <li id="wdrfee">
                                    <a href="{{ route('admin.withdrawalFees') }}">
                                        <span class="sub-item">Withdrawal Fees</span>
                                    </a>
                                </li>
                                <li id="utfee">
                                    <a href="{{ route('admin.utilityFees') }}">
                                        <span class="sub-item">Utility Fees</span>
                                    </a>
                                </li>


                            </ul>
                        </div>
                    </li>
                @endif

                @if (app('Menu')->allowAccess(Auth::user()->role_id, 2) == true)
                    <li id="admins" class="nav-item mb-3">
                        <a href="{{ route('admin.administrators') }}">
                            <i class="fas fa-user-shield"></i>
                            <p>Manage Administrators</p>
                        </a>
                    </li>
                @endif

                @if (app('Menu')->allowAccess(Auth::user()->role_id, 3) == true)
                    <li id="customers" class="nav-item mb-3">
                        <a href="{{ route('admin.customers') }}">
                            <i class="fas fa-users"></i>
                            <p>Manage Customers</p>
                        </a>
                    </li>
                @endif

                @if (app('Menu')->allowAccess(Auth::user()->role_id, 4) == true)
                    <li id="businesses" class="nav-item mb-3">
                        <a href="{{ route('admin.businesses') }}">
                            <i class="far fa-building"></i>
                            <p>Manage Businesses</p>
                        </a>
                    </li>
                @endif

                @if (app('Menu')->allowAccess(Auth::user()->role_id, 5) == true)
                    <li id="terminals" class="nav-item mb-3">
                        <a href="{{ route('admin.terminals') }}">
                            <i class="fas fa-recycle"></i>
                            <p>Manage POS Terminals</p>
                        </a>
                    </li>
                @endif

                @if (app('Menu')->allowAccess(Auth::user()->role_id, 6) == true)
                    <li id="withdrawals" class="nav-item mb-3">
                        <a href="{{ route('admin.posWithdrawals') }}">
                            <i class="fas fa-credit-card"></i>
                            <p>Withdrawal Transactions</p>
                        </a>
                    </li>
                @endif

                @if (app('Menu')->allowAccess(Auth::user()->role_id, 7) == true)
                    <li id="transfers" class="nav-item mb-3">
                        <a data-bs-toggle="collapse" href="#transferTrxs" class="collapsed" aria-expanded="false">
                            <i class="fas fa-exchange-alt"></i>
                            <p>Transfer Transactions</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="transferTrxs" style="">
                            <ul class="nav nav-collapse">

                                <li id="inward">
                                    <a href="{{ route('admin.transferTransactions', ['inward']) }}">
                                        <span class="sub-item">Inward Transfers</span>
                                    </a>
                                </li>
                                <li id="outward">
                                    <a href="{{ route('admin.transferTransactions', ['outward']) }}">
                                        <span class="sub-item">Outward Transfers</span>
                                    </a>
                                </li>


                            </ul>
                        </div>
                    </li>
                @endif

                @if (app('Menu')->allowAccess(Auth::user()->role_id, 8) == true)
                    <li id="utilities" class="nav-item mb-3">
                        <a data-bs-toggle="collapse" href="#utilityTrxs" class="collapsed" aria-expanded="false">
                            <i class="far fa-lightbulb"></i>
                            <p>Utility Transactions</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="utilityTrxs" style="">
                            <ul class="nav nav-collapse">

                                <li id="airtime">
                                    <a href="{{ route('admin.utilityTransactions', ['Airtime']) }}">
                                        <span class="sub-item">Airtime Purchase</span>
                                    </a>
                                </li>
                                <li id="data">
                                    <a href="{{ route('admin.utilityTransactions', ['Data']) }}">
                                        <span class="sub-item">Data Subscriptions</span>
                                    </a>
                                </li>
                                <li id="tv">
                                    <a href="{{ route('admin.utilityTransactions', ['Tv']) }}">
                                        <span class="sub-item">TV Subscriptions</span>
                                    </a>
                                </li>
                                <li id="power">
                                    <a href="{{ route('admin.utilityTransactions', ['Power']) }}">
                                        <span class="sub-item">Electricity Purchase</span>
                                    </a>
                                </li>


                            </ul>
                        </div>
                    </li>
                @endif

                @if (app('Menu')->allowAccess(Auth::user()->role_id, 9) == true)
                    <li id="disputes" class="nav-item mb-3">
                        <a href="{{ route('admin.customerDisputes') }}">
                            <i class="fas fa-diagnoses"></i>
                            <p>Customer Disputes</p>
                        </a>
                    </li>
                @endif

                @if (app('Menu')->allowAccess(Auth::user()->role_id, 10) == true)
                    <li id="tickets" class="nav-item mb-3">
                        <a href="{{ route('admin.customerTickets') }}">
                            <i class="fas fa-chalkboard-teacher"></i>
                            <p>Support Tickets</p>
                        </a>
                    </li>
                @endif

                @if (app('Menu')->allowAccess(Auth::user()->role_id, 11) == true)
                    <li id="reports" class="nav-item mb-3">
                        <a href="{{ route('admin.reports') }}">
                            <i class="fas fa-clipboard-list"></i>
                            <p>Reports</p>
                        </a>
                    </li>
                @endif

                <li id="logout" class="nav-item">
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>
