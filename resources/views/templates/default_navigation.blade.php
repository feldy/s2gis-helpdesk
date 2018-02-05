<?php
/**
 * Created by PhpStorm.
 * User: feldy
 * Date: 01/10/2017
 * Time: 01:27
 */
?>
<header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>SS</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>S2GIS</b>HELPDESK</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>
        <div class="navbar-custom-menu navbar-left">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <span class="hidden-xs">
                        <div class="marquee" style="height: 50px; ">
                            <p>PEMBERITAHUAN 1: Lorem Ipsum is simply dummy text of the printing and typesetting industry</p>
                            <p>PEMBERITAHUAN 2: Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book</p>
                        </div>
                    </span>
                </li>
            </ul>
        </div>
    </nav>
</header>

<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('media/images/photo-profile/photo_profile.png') }}" class="img-circle" alt="User Image">
{{--                <img src="{{ asset($pp_url) }}"  class="img-circle" alt="User Image">--}}
            </div>
            <div class="pull-left info">
                <p>Nama Pegawai</p>
                <small>Jabatan</small>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
                <li class="treeview active">
                    <ul class="treeview-menu">
                        <li><a href="{{ route("user.main_issue") }}"><i class="fa fa-circle-o"></i>Issue</a></li>
                    </ul>
                    <ul class="treeview-menu">
                        <li><a href="#"><i class="fa fa-circle-o"></i>Menu 2</a></li>
                    </ul>
                </li>
            <li class="treeview active">
                <a>
                {{--<a href="{{ route('logout') }}">--}}
                    <form action="{{ route('logout') }}" method="post">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-danger"><i class="fa fa-sign-out"></i> Logout</button>
                    </form>
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    @yield('content')
</div>
<!-- /.content-wrapper -->