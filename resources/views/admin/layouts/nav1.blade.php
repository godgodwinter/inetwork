{{-- //mainblade --}}
@extends('admin.layouts.templateadmin')

@section('nav_head')
<nav class="navbar header-navbar pcoded-header">
    <div class="navbar-wrapper">
        <div class="navbar-logo">
            <a class="mobile-menu" id="mobile-collapse" href="#!">
                <i class="feather icon-menu"></i>
            </a>
            <a href="{{ url('/')}}/dashboard">
                <img class="img-fluid" src="{{ asset("admin-style/") }}/files/assets/images/logo.png"
                    alt="Theme-Logo" />
            </a>
            <a class="mobile-options">
                <i class="feather icon-more-horizontal"></i>
            </a>
        </div>
        <div class="navbar-container container-fluid">
            <ul class="nav-left">
                <li>
                    <a href="#!" onclick="javascript:toggleFullScreen()">
                        <i class="feather icon-maximize full-screen"></i>
                    </a>
                </li>
            </ul>
            <ul class="nav-right">
                <li class="user-profile header-notification">
                    <div class="dropdown-primary dropdown">
                        <div class="dropdown-toggle" data-toggle="dropdown">
                            <img src="{{ asset("admin-style/") }}/files/assets/images/avatar-4.jpg"
                                class="img-radius" alt="User-Profile-Image">
                            <span>{{ __('Manage Account') }}</span>
                            <i class="feather icon-chevron-down"></i>
                        </div>
                        <ul class="show-notification profile-notification dropdown-menu"
                            data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">

                            <li>
                                <a href="{{ route('profile.show') }}">
                                    <i class="feather icon-user"></i>
                                    {{ __('Profile') }}
                                </a>
                            </li>
                            <li>
                                 <!-- Authentication -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();"><i class="feather icon-log-out"></i>
                    {{ __('Logout') }}
                    </a>
            </form>

                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
@endsection

@section('menu')
<!-- jquerymin-->
<nav class="pcoded-navbar">
    <div class="pcoded-inner-navbar main-menu">
        <div class="pcoded-navigatio-lavel">Menu</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="">
                <a href="{{ url('/')}}/dashboard">
                    <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                    <span class="pcoded-mtext">Dashboard</span>
                </a>

            </li>

            <li class="">
                <a href="{{url('/')}}/admin/paket">
                    <span class="pcoded-micon"><i class="feather icon-monitor"></i></span>
                    <span class="pcoded-mtext">Paket</span>
                </a>
            </li>
            <li class="">
                <a href="{{url('/')}}/admin/pelanggan">
                    <span class="pcoded-micon"><i class="feather icon-users"></i></span>
                    <span class="pcoded-mtext">Pelanggan</span>
                </a>
            </li>
            <li class="">
                <a href="{{url('/')}}/admin/tagihan">
                    <span class="pcoded-micon"><i class="feather icon-codepen"></i></span>
                    <span class="pcoded-mtext">Tagihan
                </a>
            </li>
            <li class="">
                <a href="{{url('/')}}/admin/inventaris">
                    <span class="pcoded-micon"><i class="feather icon-briefcase"></i></span>
                    <span class="pcoded-mtext">Inventaris</span>
                </a>
            </li>
            <li class="">
                <a href="{{url('/')}}/admin/letakserver">
                    <span class="pcoded-micon"><i class="feather icon-cloud"></i></span>
                    <span class="pcoded-mtext">Letak Server</span>
                </a>
            </li>
            <li class="">
                <a href="{{url('/')}}/admin/pendapatan">
                    <span class="pcoded-micon"><i class="feather icon-log-in"></i></span>
                    <span class="pcoded-mtext">Pemasukan
                </a>
            </li>
            <li class="">
                <a href="{{url('/')}}/admin/pengeluaran">
                    <span class="pcoded-micon"><i class="feather icon-log-out"></i></span>
                    <span class="pcoded-mtext">Pengeluaran
                </a>
            </li>
            <li class="">
                <a href="{{url('/')}}/admin/rekap">
                    <span class="pcoded-micon"><i class="feather icon-printer"></i></span>
                    <span class="pcoded-mtext">Rekap
                </a>
            </li>
        </ul>
        <div class="pcoded-navigatio-lavel">Developer</div>

        <ul class="pcoded-item pcoded-left-item">
            <li class="">
            <a href="{{url('/')}}/admin/importspecial">
                <span class="pcoded-micon"><i class="feather icon-users"></i></span>
                <span class="pcoded-mtext">Import Special</span>
            </a>
        </li>
            <li class="">
                <a href="{{ url('/')}}/task">
                    <span class="pcoded-micon"><i class="feather icon-watch"></i></span>
                    <span class="pcoded-mtext">Task</span>
                </a>

        </li>
        </ul>

    </div>
</nav>

@endsection
