<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Invoice</title>
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

  <link rel="stylesheet" href="{{url('assets/backend/css/print.css')}}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="{{url('assets/backend/font/style.css')}}">
</head>
<body size="A4" class="testReport" onload="window.print();">
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
          <img src="{{AppSetting::getLogo()}}" width="200">
      </div>
      <!-- /.col -->
    </div>


    <div class="no-padding">
      <div class="col-xs-12 text-center comdiv">
          <div class="companyAddress">
            <b>{{$companyDetails->company_name}}</b> &nbsp;  &nbsp;
            <i class="fa fa-map-marker"></i> {{$companyDetails->address}}, {{$companyDetails->city}}, {{$companyDetails->state}}, {{$companyDetails->country}}
            <br>
            &nbsp;  &nbsp; <i class="fa fa-phone"></i> {{$companyDetails->phone}}
            &nbsp;  &nbsp; <i class="fa fa-envelope"></i> {{$companyDetails->email}}
            &nbsp;  &nbsp; <i class="fa fa-globe"></i> {{$companyDetails->website}}
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-xs-5"></div>
      <div class="col-xs-2 text-center subject">REPORT</div>
      <div class="col-xs-5"></div>
    </div>

    <div class="row">
        <div class="col-xs-9">
          <div class="col-xs-12">
            <div class="col-xs-3"><b>NAME :</b></div>
            <div class="col-xs-9">TAPAS KARMAKAR (24Y/M)</div>
          </div>

          <div class="col-xs-12">
            <div class="col-xs-3"><b>REF BY :</b></div>
            <div class="col-xs-9">DR. BISWANATH BONDHAPADHAY</div>
          </div>

          <div class="col-xs-12">
            <div class="col-xs-3"><b>PATIENT ID :</b></div>
            <div class="col-xs-9">2514789</div>
          </div>

          <div class="col-xs-12">
            <div class="col-xs-3"><b>ORDER ID :</b></div>
            <div class="col-xs-9">64654</div>
          </div>

        </div>

        <div class="col-xs-3">
          <div class="row"><b>SAMPLE COLLECTED AT :</b></div>
          <div class="row">JN Das Path, Kabiguru 3rd, City Center, Durgapur, Pashim Burdwan, 722203, India </div>
        </div>
    </div>

  <br>
  <br>

    <!-- Table row -->
    <div class="row">
      <div class="col-xs-12 table-responsive">
        <table class="table table-striped">
          <thead>
          <tr>
            <th>SL</th>
            <th>TEST NAME</th>
            <th>TECHNOLOGY</th>
            <th>VALUE</th>
            <th>UNIT</th>
            <th>REFERENCE RANGE</th>
          </tr>
          </thead>
          <tbody>

          <tr class="high">
            <td>1</td>
            <td>TOTAL RBC</td>
            <td>I.C.N.M</td>
            <td>5.61</td>
            <td>x10 6/u</td>
            <td>Male: 4.5-5.5, Female : 3.9-4.8</td>
          </tr>

          <tr class="low">
            <td>2</td>
            <td>TOTAL RBC</td>
            <td>I.C.N.M</td>
            <td>5.61</td>
            <td>x10 6/u</td>
            <td>Male: 4.5-5.5, Female : 3.9-4.8</td>
          </tr>

          <tr>
            <td>3</td>
            <td>TOTAL RBC</td>
            <td>I.C.N.M</td>
            <td>5.61</td>
            <td>x10 6/u</td>
            <td>Male: 4.5-5.5, Female : 3.9-4.8</td>
          </tr>


          <tr class="bottom">
            <td>4</td>
            <td>TOTAL RBC</td>
            <td>I.C.N.M</td>
            <td>5.61</td>
            <td>x10 6/u</td>
            <td>Male: 4.5-5.5, Female : 3.9-4.8</td>
          </tr>
          <tr>
            <td colspan="5">Note will shows here</td>
          </tr>

          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row footer">
      <div class="col-xs-6">
        <div class="row">
          <div class="col-xs-6"><b>SAMPLE COLLECTED ON :</b></div>
          <div class="col-xs-6">2 DEC 2016 8:10 PM</div>
        </div>
        <div class="row">
          <div class="col-xs-6"><b>SAMPLE RECEIVED ON :</b></div>
          <div class="col-xs-6">2 DEC 2016 8:10 PM</div>
        </div>
        <div class="row">
          <div class="col-xs-6"><b>SAMPLE RELEASED ON :</b></div>
          <div class="col-xs-6">2 DEC 2016 8:10 PM</div>
        </div>
      </div>

      <div class="col-xs-6">
        <div class="col-xs-6">
          <div class="col-xs-12"><img src="https://i.ytimg.com/vi/PJIBlJQBW3Q/hqdefault.jpg" class="signature"> </div>
          <div class="col-xs-12">Dr Tapas Karmakar</div>
        </div>
        <div class="col-xs-6">
          <div class="col-xs-12"><img src="https://allaboutcloud.info/wp-content/uploads/2017/08/signature.png" class="signature"></div>
          <div class="col-xs-12">Dr Tapas Karmakar</div>
        </div>
      </div>
    </div>

  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
</body>
</html>
