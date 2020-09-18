@extends('layouts.app')
@section('content')

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="index3.html" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contact</a>
                </li>
            </ul>

            <!-- SEARCH FORM -->
            <form class="form-inline ml-3">
                <div class="input-group input-group-sm">
                    <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-navbar" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">


                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button"><i class="fas fa-th-large"></i></a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link">
                <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">AdminLTE 3</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">Alexander Pierce</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <!-- <li class="nav-item has-treeview menu-open">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Users
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="#" class="nav-link ">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Users</p>
                                    </a>
                                </li>
                            </ul>
                        </li> -->
                        @if(!Auth::user()->parent_id)
                        <li class="nav-item">
                            <a href="{{route('client.dashboard.users')}}" class="nav-link">
                                <i class="nav-icon fas fa-user"></i>
                                <p>
                                    User
                                </p>
                            </a>
                        </li>
                        @endif
                        <li class="nav-item">
                            <a href="{{route('client.dashboard.venues')}}" class="nav-link">
                                <i class="nav-icon fas fa-file"></i>
                                <p>
                                    Veneu
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('client.dashboard.menuitems')}}" class="nav-link">
                                <i class="nav-icon fas fa-file"></i>
                                <p>
                                    Menu
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('client.dashboard.menupackage')}}" class="nav-link">
                                <i class="nav-icon fas fa-file"></i>
                                <p>
                                    Menu Packages
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('client.dashboard.editprofile')}}" class="nav-link">
                                <i class="nav-icon fas fa-cog"></i>
                                <p>
                                    Profile
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Add Venues</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Starter Page</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-body register-card-body">

                            <form action="{{route('client.dashboard.addvenue.store')}}" method="post">
                                @csrf
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" required name="venue_name" placeholder="Venue name">
                                </div>

                                <div class="input-group mb-3">
                                    <select name='venue_type' class="form-control required ">
                                        @foreach(config('venues') as $key=>$venueType)
                                        <option value={{$key}}>{{$venueType}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="input-group mb-3">
                                    <input type="Text" class="form-control" required name="min_guests" placeholder="Minimun Guests">
                                </div>

                                <div class="input-group mb-3">
                                    <input type="Text" class="form-control" required name="max_guests" placeholder="Maximum Guests">

                                </div>
                                <label for="">Select Time</label>
                                <div class="input-group mb-3">
                                    @foreach(config('times') as $key=>$times)
                                    <div class="icheck-primary d-inline mr-3">
                                        <input type="checkbox" name="available_time[]" value="{{$key}}" id="{{$times['time']}}">
                                        <label for="{{$times['time']}}">
                                            {{$times['time']}}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                                <label for="">Select Day</label>
                                <div class="input-group mb-3">
                                    @foreach(config('days') as $key => $days)
                                    <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success mr-3">
                                        <input type="checkbox" name="days[]" value="{{json_encode($days)}}" class="custom-control-input" id="{{$days['name']}}">
                                        <label class="custom-control-label" for="{{$days['name']}}">{{$days['name']}}</label>

                                        <!-- <option value="{{json_encode($days)}}">
                                            
                                        </option> -->
                                    </div>
                                    @endforeach
                                </div>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" required name="max_occupied_time" placeholder="Maximum Occupation Time">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-clock"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-8">
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-4">
                                        <button type="submit" class="btn btn-primary btn-block">Register</button>
                                    </div>
                                    <!-- /.col -->
                                </div>
                            </form>

                            <!-- <div class="social-auth-links text-center">
                <p>- OR -</p>
                <a href="#" class="btn btn-block btn-primary">
                    <i class="fab fa-facebook mr-2"></i>
                    Sign up using Facebook
                </a>
                <a href="#" class="btn btn-block btn-danger">
                    <i class="fab fa-google-plus mr-2"></i>
                    Sign up using Google+
                </a>
            </div> -->

                        </div>
                        <!-- /.form-box -->
                    </div><!-- /.card -->
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
    </div>
    @endsection