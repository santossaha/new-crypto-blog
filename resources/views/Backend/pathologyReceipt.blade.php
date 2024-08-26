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
<body size="MoneyReceipt" class="moneyReceipt" onload="//window.print();">
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">

    <div class="row header">
      <div class="col-xs-3">
          <img src="{{AppSetting::getLogo()}}" style="max-width: 100%">
      </div>

      <div class="col-xs-9 text-center">
          <b>{{$companyDetails->company_name}}</b> &nbsp;  &nbsp;
          <i class="fa fa-map-marker"></i> {{$companyDetails->address}}, {{$companyDetails->city}}, {{$companyDetails->state}}, {{$companyDetails->country}}
          <br>
          &nbsp;  &nbsp; <i class="fa fa-phone"></i> {{$companyDetails->phone}}
          &nbsp;  &nbsp; <i class="fa fa-envelope"></i> {{$companyDetails->email}}
          &nbsp;  &nbsp; <i class="fa fa-globe"></i> {{$companyDetails->website}}
      </div>
    </div>

    <div class="row">
      <div class="col-xs-4"></div>
      <div class="col-xs-4 text-center subject">RECEIPT</div>
      <div class="col-xs-4"></div>
    </div>

    <div class="row patientDetails">
        <div class="col-xs-4">
          <p><b>NAME :</b> TAPAS KARMAKAR</p>
          <p><b>Age :</b> 24</p>
          <p><b>Sex :</b> M</p>
          <p><b>PATIENT ID :</b> 2514789</p>
          <p><b>ORDER ID :</b> 64654</p>

          <br>

          <p><b>Date :</b> 25 Nov 2018</p>
          <p><b>Expected Delivery Date :</b> 25 Nov 2018</p>

          <br>

          <p><b>Payment Mode :</b> Cheque</p>
          <p><b>Payment Notes :</b> Cheque No. 215487</p>
          <p><b>Bank Name :</b> HDFC Bank (Durgapur)</p>
        </div>

        <div class="col-xs-4">

          <!--
          <div class="row">
            <p class="test-heading text-center">Tests</p>
          </div>

          <div class="clearfix"></div>

          <div class="row">
          <ul class="list">
            <li>sxaasasdsd : Rs.250</li>
            <li>sxaasasdsd cvsaccsacs cascscsacsac casccsacac cascascsac : Rs.250</li>
            <li>sxaasasdsd : Rs.250</li>
            <li>sxaasasdsd : Rs.250</li>
          </ul>
          </div>
          -->



          <div class="row">
              <table class="table table-striped">
                <tbody>
                  <tr>
                    <td colspan="2" class="text-center bold"> Test Lists</td>
                  </tr>
                  <tr>
                    <td>TOTAL RBC</td>
                    <td class="text-right">Rs. 250</td>
                  </tr>
                  <tr>
                    <td>TOTAL RBC</td>
                    <td class="text-right">Rs. 250</td>
                  </tr>
                  <tr>
                    <td>TOTAL RBC</td>
                    <td class="text-right">Rs. 250</td>
                  </tr>
                  <tr>
                    <td>TOTAL RBC</td>
                    <td class="text-right">Rs. 250</td>
                  </tr>
                  <tr>
                    <td>TOTAL RBC</td>
                    <td class="text-right">Rs. 250</td>
                  </tr>


                </tbody>
              </table>

          </div>


        </div>

      <div class="col-xs-4">
          <div class="row">
          <table class="table table-striped">
            <tbody>

            <tr>
              <td colspan="2" class="text-center bold"> Package Lists</td>
            </tr>
            <tr>
              <td>LIPID PROFILE</td>
              <td class="text-right">Rs. 950</td>
            </tr>
            <tr>
              <td>LIPID PROFILE</td>
              <td class="text-right">Rs. 950</td>
            </tr>
            <tr>
              <td>LIPID PROFILE</td>
              <td class="text-right">Rs. 950</td>
            </tr>
            <tr>
              <td>LIPID PROFILE</td>
              <td class="text-right">Rs. 950</td>
            </tr>
            <tr>
              <td>LIPID PROFILE</td>
              <td class="text-right">Rs. 950</td>
            </tr>
            <tr>
              <td>LIPID PROFILE</td>
              <td class="text-right">Rs. 950</td>
            </tr>


            <tr class="bold">
              <td>Total Amount</td>
              <td class="text-right">Rs. 950</td>
            </tr>
            <tr class="bold">
              <td>Paid</td>
              <td class="text-right">Rs.450</td>
            </tr>
            <tr class="bold">
              <td>Due</td>
              <td class="text-right">Rs.500</td>
            </tr>
            </tbody>
          </table>
          </div>
      </div>

    </div>
  <br>
  <br>



    <div class="row">
      <div class="col-xs-12 text-right authSign">
        Authorised Signatory
      </div>
    </div>


  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
</body>
</html>
