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
    <!-- Theme style -->
    <link rel="stylesheet" href="{{url('assets/backend/css/AdminLTE.min.css')}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{url('assets/backend/plugin/iCheck/square/blue.css')}}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="{{url('assets/backend/font/style.css')}}">
</head>
<body class="hold-transition login-page" @if($data->showImage_Background=='Yes') style="background: url('{{asset('uploads/generalSetting/'.$data->signIn_backgroundImage)}}'); background-size: cover;" @endif>
<div class="login-box">
    <div class="login-logo">
        @if($data->showLogo_inSign=='Yes')
            <a href="{{route('login')}}">
                <img src="{{asset('uploads/generalSetting/'.$data->site_logo)}}">
            </a>
        @endif
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

            @if (Session::has('success'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
            @endif
            @if (Session::has('info'))
                <div class="alert alert-info">{{ Session::get('info') }}</div>
            @endif
            @if (Session::has('warning'))
                <div class="alert alert-warning">{{ Session::get('warning') }}</div>
            @endif
            @if (Session::has('error'))
                <div class="alert alert-danger">{{ Session::get('error') }}</div>
            @endif

        <form action="{{route('saveResetPassword',['id'=>$ID])}}" method="post" autocomplete="off">
            {{csrf_field()}}
            <div class="form-group has-feedback">
                <input type="password" name="new_password" class="form-control" placeholder="New Password">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback">
                <input type="password" name="retype_new_password" class="form-control" placeholder="Retype New Password">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="row">
                <!-- /.col -->
                <div class="col-xs-6 pull-right">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Save</button>
                </div>
                <!-- /.col -->
            </div>
        </form>
        <a href="{{route('login')}}"><i class="fa fa-arrow-left"></i> Back to login</a><br>
    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="{{url('assets/backend/plugin/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{url('assets/backend/plugin/bootstrap/bootstrap.min.js')}}"></script>
<!-- iCheck -->
<script src="{{url('assets/backend/plugin/iCheck/icheck.min.js')}}"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' /* optional */
        });
    });
</script>
</body>
</html>
