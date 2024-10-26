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
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="{{url('assets/backend/font/style.css')}}">

    <script type="text/css">
        @media only screen and (max-width: 600px) {
            .lockscreen .col-md-7{
                display: none !important;
            }
            .lockscreen .col-md-5{
                width: 100% !important;
                margin-top: 0% !important;
            }
        }
    </script>

</head>
<body class="hold-transition lockscreen">

<div class="row">
    <div class="col-md-7" @if($data->showImage_Background=='Yes') style="background: url('{{asset('uploads/generalSetting/'.$data->signIn_backgroundImage)}}'); background-size: cover; display: inline; height: 100vh;" @endif>
        <div class="row" style="text-align: center;position: relative;top: 45%;color: #f6f8f9;">
            <h1>Account Locked</h1>
            <h4>Enter your password to unlock again</h4>
        </div>
    </div>
    <div class="col-md-5" style="margin-top: 10%;">
        <div class="lockscreen-wrapper">
            <div class="lockscreen-logo">
                @if($data->showLogo_inSign=='Yes')
                    <a href="{{route('locked')}}">
                        <img src="{{asset('uploads/generalSetting/'.$data->site_logo)}}" style="max-width: 100%;max-height: 100px;">
                    </a>
                @endif
            </div>

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

            <div class="lockscreen-name">{{Session::get('UserName')}}</div>

            <div class="lockscreen-item">

                <div class="lockscreen-image">
                    <img src="{{asset('uploads/profilePhoto/'.Session::get('UserImage'))}}" alt="{{Session::get('UserName')}}">
                </div>
                <form action="@if(isset($_GET['next'])) {{route('lockedOut',['next'=>$_GET['next']])}} @else {{route('lockedOut')}} @endif" method="post" class="lockscreen-credentials">
                    {{csrf_field()}}
                    <div class="input-group">
                        <input type="hidden" name="email" value="{{Session::get('UserEmail')}}">
                        <input type="password" name="password" class="form-control" id="PasswordFld" placeholder="enter password here" autocomplete="off">
                        <div class="input-group-btn">
                            <button type="submit" class="btn"><i class="fa fa-arrow-right text-muted"></i></button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="help-block text-center">
                Enter your password to retrieve your session
            </div>
            <div class="text-center">
                <a href="{{route('lockedLogout')}}" class="btn btn-flat btn-default">Logout</a>
            </div>
            <div class="lockscreen-footer text-center">
                Copyright &copy; 2017-{{date('Y')}} <b><a href="{{route('locked')}}" class="text-black">{{$CompanyDetails->company_name}}</a></b><br>
                All rights reserved
            </div>
        </div>

    </div>
</div>

<!-- jQuery 3 -->
<script src="{{url('assets/backend/plugin/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{url('assets/backend/plugin/bootstrap/bootstrap.min.js')}}"></script>
<script type="text/javascript">
    $('#PasswordFld').focus();
</script>
</body>
</html>
