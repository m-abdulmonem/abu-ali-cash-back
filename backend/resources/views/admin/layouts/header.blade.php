<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>MA Admin | {{ $title }}</title>
    <link rel="icon" href="{{ admin_assets("img/MAAdminLogo.png") }}" type="image/x-icon">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ admin_assets("/css/all.min.css") }}">
    @stack("css")
    <!-- Theme style -->
    <link rel="stylesheet" href=" {{  admin_assets("/css/adminlte.min.css")  }} ">
    <link rel="stylesheet" href=" {{  admin_assets("/css/app.css")  }} ">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
            </li>
        </ul>
        <!-- SEARCH FORM -->
        <form class="form-inline ml-3"  action="{{ admin_url("search/all") }}">
            <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" name="keyword" placeholder="{{ trans("home.search") }}" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-navbar" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </form>
        <ul class="navbar-nav ml-auto">
            <!-- Notifications Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-bell"></i>
                    <span class="badge badge-warning navbar-badge">15</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-header">15 {{ trans("home.notifications") }}</span>
                    <div class="dropdown-divider"></div>
                    <h3 class="text-center">{{ trans("home.coming_soon") }}</h3>
{{--                    <a href="#" class="dropdown-item">--}}
{{--                        <i class="fas fa-envelope mr-2"></i> 4 new messages--}}
{{--                        <span class="float-right text-muted text-sm">3 mins</span>--}}
{{--                    </a>--}}
{{--                    <div class="dropdown-divider"></div>--}}
{{--                    <a href="#" class="dropdown-item">--}}
{{--                        <i class="fas fa-users mr-2"></i> 8 friend requests--}}
{{--                        <span class="float-right text-muted text-sm">12 hours</span>--}}
{{--                    </a>--}}
{{--                    <div class="dropdown-divider"></div>--}}
{{--                    <a href="#" class="dropdown-item">--}}
{{--                        <i class="fas fa-file mr-2"></i> 3 new reports--}}
{{--                        <span class="float-right text-muted text-sm">2 days</span>--}}
{{--                    </a>--}}
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer">{{ trans("home.see all notifications") }}</a>
                </div>
            </li>
        </ul>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link"  href="{{ url("/") }}" target="_blank"><i class="fas fa-eye"></i> {{  trans("home.visit") }}</a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="{{ admin_url() }}" class="brand-link">
            <img src="{{ admin_assets("img/MAAdminLogo.png") }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-light">MA Admin</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{ image(profile("picture"),true) }}" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a class="d-block">{{ profile("name") }}</a>
                    <a href="{{ admin_url("profile/edit") }}" class="d-block"><b>@</b>{{ profile("username") }}</a>
                    <a href="{{ admin_url("logout") }}" title="logout" class="logout"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit()">
                        <i class="fa fa-sign-out-alt"></i></a>
                    <form action="{{ route("logout") }}" id="logout-form" method="POST" class="d-none">@csrf</form>
                </div>
            </div>

            @include("admin.layouts.navbar")

        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
