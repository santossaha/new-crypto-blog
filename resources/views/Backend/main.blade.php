<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{Config('app.name')}}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{url('assets/backend/plugin/bootstrap/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{url('assets/backend/plugin/font-awesome/css/font-awesome.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{url('assets/backend/plugin/Ionicons/css/ionicons.min.css')}}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{url('assets/backend/plugin/select2/dist/css/select2.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{url('assets/backend/css/AdminLTE.min.css')}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{url('assets/backend/plugin/iCheck/square/blue.css')}}">
    <!-- Datepicker -->
    <link rel="stylesheet" href="{{url('assets/backend/plugin/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
    <!-- Validation -->
    <link rel="stylesheet" href="{{url('assets/backend/plugin/validation/validationEngine.jquery.css')}}">
    <!-- Toaster-->
    <link rel="stylesheet" href="{{url('assets/backend/plugin/toastr/toastr.min.css')}}">
    <!-- Crop Image While Upload-->
    <link rel="stylesheet" href="{{url('assets/backend/plugin/Croppie/croppie.css')}}">
    <!-- Custom Skin -->
    <link rel="stylesheet" href="{{url('assets/backend/css/skins/custom.css')}}">
    <!-- Summernote Text Editor -->
    <link rel="stylesheet" href="{{url('assets/backend/plugin/summernote/summernote.css')}}">
    <!-- Datatables -->
    <link rel="stylesheet" href="{{url('assets/backend/plugin/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
    {{--<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">--}}
    <!-- magnific-popup -->
    <link rel="stylesheet" href="{{url('assets/backend/plugin/magnific/magnific-popup.css')}}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{url('assets/backend/css/custom.css')}}">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Google Font -->
    <link rel="stylesheet" href="{{url('assets/backend/font/style.css')}}">

    <script type="text/javascript">
        var settings = {
            BaseURL:'{{route('baseURL')}}',
            logOutURL: '{{route('logout')}}',
            lockedURL: '{{route('locked')}}',
            idleCheckURL: '{{route('checkIdle')}}',

            LoaderGif: '{{url('assets/backend/img/loader.gif')}}'
        }
    </script>
    <style>
        .datepicker{ z-index:99999 !important; }

        /* Premium Theme Colors */
        .skin-blue .main-header .navbar {
            background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
        }

        .skin-blue .main-header .logo {
            background: #2c3e50;
        }

        .skin-blue .main-header .logo:hover {
            background: #34495e;
        }

        .skin-blue .main-sidebar {
            background: linear-gradient(180deg, #2c3e50 0%, #34495e 100%);
        }

        .skin-blue .sidebar-menu > li:hover > a,
        .skin-blue .sidebar-menu > li.active > a {
            background: #3498db;
            color: #ffffff;
        }

        .skin-blue .sidebar-menu > li > a {
            border-left: 3px solid transparent;
        }

        .skin-blue .sidebar-menu > li:hover > a,
        .skin-blue .sidebar-menu > li.active > a {
            border-left-color: #3498db;
        }

        .skin-blue .sidebar-menu > li > .treeview-menu {
            background: #34495e;
        }

        .skin-blue .sidebar-menu > li > .treeview-menu > li > a {
            color: #ecf0f1;
        }

        .skin-blue .sidebar-menu > li > .treeview-menu > li:hover > a {
            background: #3498db;
            color: #ffffff;
        }

        .skin-blue .user-panel > .info {
            color: #ecf0f1;
        }

        .skin-blue .user-panel > .info > a {
            color: #ecf0f1;
        }

        .skin-blue .sidebar-menu > li.header {
            color: #ecf0f1;
            background: #2c3e50;
        }
    </style>
</head>
<body class="hold-transition fixed skin-blue sidebar-mini  @if(AppSetting::SidebarMenuCollapse()) sidebar-collapse @endif">
<!-- Site wrapper -->
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="{{route('dashboard')}}" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><img src="{{AppSetting::getLogo()}}"></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg">
                <img src="{{AppSetting::getLogo()}}">
            </span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>


            <div class="navbar-custom-menu">

                <ul class="nav navbar-nav">
                    <!-- Messages: style can be found in dropdown.less-->
                    <li class="dropdown messages-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-envelope-o"></i>
                            <span class="label label-success">4</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">You have 4 messages</li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu">
                                    <li><!-- start message -->
                                        <a href="#">
                                            <div class="pull-left">
                                                <img src="{{Auth::user()->profile_photo['path']}}" class="img-circle" alt="{{Auth::user()->name}}">
                                            </div>
                                            <h4>
                                                Support Team
                                                <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                            </h4>
                                            <p>Why not buy a new awesome theme?</p>
                                        </a>
                                    </li>
                                    <!-- end message -->
                                </ul>
                            </li>
                            <li class="footer"><a href="#">See All Messages</a></li>
                        </ul>
                    </li>
                    <!-- Notifications: style can be found in dropdown.less -->
                    <li class="dropdown notifications-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bell-o"></i>
                            <span class="label label-warning">10</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">You have 10 notifications</li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu">
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-users text-aqua"></i> 5 new members joined today
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="footer"><a href="#">View all</a></li>
                        </ul>
                    </li>
                    <!-- Tasks: style can be found in dropdown.less -->
                    <li class="dropdown tasks-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-flag-o"></i>
                            <span class="label label-danger">9</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">You have 9 tasks</li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu">
                                    <li><!-- Task item -->
                                        <a href="#">
                                            <h3>
                                                Design some buttons
                                                <small class="pull-right">20%</small>
                                            </h3>
                                            <div class="progress xs">
                                                <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar"
                                                     aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                    <span class="sr-only">20% Complete</span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <!-- end task item -->
                                </ul>
                            </li>
                            <li class="footer">
                                <a href="#">View all tasks</a>
                            </li>
                        </ul>
                    </li>
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="{{Auth::user()->profile_photo['path']}}" class="user-image profileImage" alt="{{Auth::user()->name}}">
                            <span class="hidden-xs">{{Auth::user()->name}}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="{{Auth::user()->profile_photo['path']}}" class="img-circle profileImage" alt="{{Auth::user()->name}}">
                                <p>
                                    {{Auth::user()->name}}
                                    <small>
                                        @php
                                            $roles = [];
                                         @endphp
                                        @foreach(Auth::user()->roles as $role)
                                            @php
                                                $roles[] = $role->display_name;
                                            @endphp
                                        @endforeach
                                        {{implode(', ',$roles)}}
                                    </small>
                                </p>
                            </li>

                            <!-- Menu Body -->
                            <li class="user-body">
                                <div class="row">
                                    <div class="col-xs-4 text-center">

                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="{{route('generalProfile')}}">My Profile</a>
                                    </div>
                                    <div class="col-xs-4 text-center">

                                    </div>
                                </div>
                                <!-- /.row -->
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="{{route('locked')}}" class="btn btn-default btn-flat">Locked</a>
                                </div>
                                <div class="pull-right">
                                    <a href="{{route('logout')}}" class="btn btn-default btn-flat">Sign out</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- =============================================== -->

    <!-- Left side column. contains the sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{Auth::user()->profile_photo['path']}}" class="img-circle profileImage" alt="{{Auth::user()->name}}">
                </div>
                <div class="pull-left info">
                    <p>{{Auth::user()->name}}</p>
                    <small>
                        @php
                            $roles = [];
                        @endphp
                        @foreach(Auth::user()->roles as $role)
                            @php
                                $roles[] = $role->display_name;
                            @endphp
                        @endforeach
                        {{implode(', ',$roles)}}
                    </small>
                </div>
            </div>

            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu" data-widget="tree">

                <li>
                    <a href="{{route('dashboard')}}">
                        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                    </a>
                </li>

                @permission('view-user')
                <li>
                    <a href="{{route('allUsers')}}">
                        <i class="fa fa-users"></i> <span>Users</span>
                    </a>
                </li>
                @endpermission


                <li>
                    <a href="{{route('allBanner')}}">
                        <i class="fa fa-newspaper-o"></i> <span>Sliders</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('allAddsImage')}}">
                        <i class="fa fa-image"></i> <span>Ads Image</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('allAbout')}}">
                        <i class="fa fa-newspaper-o"></i> <span>About Us</span>
                    </a>
                </li>

                <li class="treeview" style="height: auto;">
                    <a href="">
                        <i class="fa fa-caret-square-o-right"></i> <span>Blog</span>
                        <span class="pull-right-container">
                     <i class="fa fa-angle-left pull-right"></i>
                       </span>
                    </a>
                    <ul class="treeview-menu" style="display: none;">
                        <li><a href="{{route('allBlogCat')}}"><i class="fa fa-circle-o"></i>Category</a></li>
                        <li><a href="{{route('allBlog')}}"><i class="fa fa-circle-o"></i>Blog</a></li>
                    </ul>
                </li>


                <li class="treeview" style="height: auto;">
                    <a href="">
                        <i class="fa fa-caret-square-o-right"></i> <span>News</span>
                        <span class="pull-right-container">
                     <i class="fa fa-angle-left pull-right"></i>
                       </span>
                    </a>
                    <ul class="treeview-menu" style="display: none;">
                        <li><a href="{{route('allNewsCat')}}"><i class="fa fa-circle-o"></i>Category</a></li>
                        <li><a href="{{route('allNews')}}"><i class="fa fa-circle-o"></i>News</a></li>
                    </ul>
                </li>

                @permission('view-user')

                {{-- <li class="treeview" style="height: auto;">
                    <a href="">
                        <i class="fa fa-caret-square-o-right"></i> <span>Events</span>
                        <span class="pull-right-container">
                     <i class="fa fa-angle-left pull-right"></i>
                       </span>
                    </a>
                    <ul class="treeview-menu" style="display: none;">
                        <li><a href="{{route('allEventsCat')}}"><i class="fa fa-circle-o"></i>Category</a></li>
                        <li><a href="{{route('allEvent')}}"><i class="fa fa-circle-o"></i>Events</a></li>
                    </ul>
                </li> --}}

                <li>
                    <a href="{{route('allEvent')}}">
                        <i class="fa fa-newspaper-o"></i> <span>Events</span>
                    </a>
                </li>
                @endpermission



                <li>
                    <a href="{{route('allairdrops')}}">
                        <i class="fa fa-cogs"></i> <span>Airdrops</span>
                    </a>
                </li>


                <li>
                    <a href="{{route('allContact')}}">
                        <i class="fa fa-cogs"></i> <span>Contact Us</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('generalSetting')}}">
                        <i class="fa fa-cogs"></i> <span>Settings</span>
                    </a>
                </li>

            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- =============================================== -->

    <!-- Content Wrapper. Contains page content -->
    @yield('content')
    <!-- /.content-wrapper -->

    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 1.0
        </div>
        <strong>Copyright &copy; 2024-{{date('Y')}} <a href="techranjancrypto.com" target="_blank">Tech Ranjan</a>.</strong> All rights
        reserved.
    </footer>
</div>
<!-- ./wrapper -->


<div class="modal fade" id="AjaxModel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times"></i></span>
                </button>
                <h4 class="modal-title" id="AjaxModelTitle">Default Modal</h4>
            </div>
            <div id="AjaxModelContent">
                <div class="modal-body text-center">
                    <img src="{{url('assets/backend/img/loader.gif')}}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-right btn-flat" data-dismiss="modal"><span class="fa fa-close"></span> Close</button>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="cropImagePop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div id="upload-demo" class="center-block"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                <button type="button" id="cropImageBtn" class="btn btn-primary btn-flat">Crop</button>
            </div>
        </div>
    </div>
</div>





<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Session Expiration Warning</h4>
            </div>
            <div class="modal-body">
                <p>You've been inactive for a while. For your security, we'll log you out automatically. Click "Stay Online" to continue your session. </p>
                <p>Your session will expire in <span class="bold" id="sessionSecondsRemaining">120</span> seconds.</p>
            </div>
            <div class="modal-footer">
                <button id="extendSession" type="button" class="btn btn-primary btn-flat" data-dismiss="modal">Stay Online</button>
                <a href="{{route('logout')}}" id="logoutSession" type="button" class="btn btn-default btn-flat" data-dismiss="modal">Logout</a>
            </div>
        </div>
    </div>
</div>



<!-- jQuery 3 -->
<script src="{{url('assets/backend/plugin/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{url('assets/backend/plugin/bootstrap/bootstrap.min.js')}}"></script>
<!-- Select2 -->
<script src="{{url('assets/backend/plugin/select2/dist/js/select2.full.min.js')}}"></script>
<!-- SlimScroll -->
<script src="{{url('assets/backend/plugin/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{url('assets/backend/plugin/fastclick/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{url('assets/backend/js/adminlte.min.js')}}"></script>
<!-- iCheck -->
<script src="{{url('assets/backend/plugin/iCheck/icheck.min.js')}}"></script>
<!-- Datepicker -->
<script src="{{url('assets/backend/plugin/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<!-- validation -->
<script src="{{url('assets/backend/plugin/validation/jquery.validationEngine-en.js')}}"></script>
<script src="{{url('assets/backend/plugin/validation/jquery.validationEngine.js')}}"></script>
<!--Toaster -->
<script src="{{url('assets/backend/plugin/toastr/toastr.min.js')}}"></script>
<!-- Crop Image While Upload-->
<script src="{{url('assets/backend/plugin/Croppie/croppie.js')}}"></script>
<!--Summernote Text Editor-->
<script src="{{url('assets/backend/plugin/summernote/summernote.js')}}"></script>
<!--magnific-popup -->
<script src="{{url('assets/backend/plugin/magnific/jquery.magnific-popup.js')}}"></script>
<!--Datatables-->
<script src="{{url('assets/backend/plugin/datatables.net-bs/js/jquery.dataTables.min.js')}}"></script>
<script src="{{url('assets/backend/plugin/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{url('assets/backend/plugin/datatables.net-bs/js/datatables.responsive.js')}}"></script>
<!-- Idle Timer-->
<script src="{{url('assets/backend/plugin/idle-timer/idle-timer.min.js')}}"></script>
{{--<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>--}}
<!-- cookies -->
<script src="{{url('assets/backend/plugin/cookies/jquery.cookie.js')}}"></script>

<!-- custom -->
<script src="{{url('assets/backend/js/app.js')}}"></script>

<script>
    $(".permissionDenied").append('<div class="image"></div><img src="{{asset('assets/backend/img/deniedPermission.png')}}">');

    @if (Session::has('success'))
        toastr["success"]("{{ Session::get('success') }}");
    @endif
    @if (Session::has('info'))
        toastr["info"]("{{ Session::get('info') }}");
    @endif
    @if (Session::has('warning'))
        toastr["warning"]("{{ Session::get('warning') }}");
    @endif
    @if (Session::has('error'))
        toastr["error"]("{{ Session::get('error') }}");
    @endif

    $('.modal-body').on('shown.bs.modal', function() {
        alert('sdf');

    // $('.datepicker').datepicker({
    //     autoclose: true,
    //     format: "mm-dd-yyyy"

    // });
});

</script>

@stack('script')
</body>
</html>
