@extends('Frontend.layouts.frontendlayouts')

@section('content')


<div class="pbmit-title-bar-wrapper" style="background-image: url({{url('/')}}/assets/frontendtheme/images/title-bg.jpg);">
    <div class="container">
        <div class="pbmit-title-bar-content">
            <div class="pbmit-title-bar-content-inner">
                <div class="pbmit-tbar">
                    <div class="pbmit-tbar-inner container">
                        <h1 class="pbmit-tbar-title">{{$details->name}}</h1>
                    </div>
                </div>
                <div class="pbmit-breadcrumb">
                    <div class="pbmit-breadcrumb-inner">
                        <span><a title="" href="index.php" class="home"><i class="fa fa-home"></i></a></span>
                        <span class="sep">  →  </span>
                        <span><a title="" href="{{route('service')}}" class="home"> Services</a></span>								
                        <span class="sep">  →  </span>
                        <span><span class="post-root post post-post current-item">{{$details->name}}</span></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Page Content -->
<div class="page-content demo-one">

    <section class="visa-details-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 service-left-col order-2 order-lg-1">
                    <aside class="service-sidebar">
                        <aside class="widget post-list">
                            <div class="all-post-list">
                                <ul>
                                    @foreach ( $another_service as $service)                          										
                                    <li><a href="{{route('service_details',$service->slug)}}"> {{$service->name}}</a></li>
                                    @endforeach	        
                                </ul>
                            </div>
                        </aside>
                        
                    </aside>
                </div>
                
                <div class="col-lg-9 service-right-col order-1">
                    <div class="pbmit-service-single-content">
                        <div class="pbmit-service-single-img">
                            <img src="{{url('/')}}/uploads/services/{{$details->image}}" class="w-100" alt="">
                        </div>
                        <div class="pbmit-service-description">
                            <h4>{{$details->name}}</h4>
                           {!! $details->description !!}
                            
                            <a href="stripe_form.php?id=1">
                                <button style="background-color: #0067da; color: white; border: 1px; width: 108px;  height: 42px;">Pay Now</button>
                            </a>											
  <button onclick="getReferUrl()"
                                      style="background-color: #0067da; color: white; border: 1px; width: 108px;  height: 42px;">
                                  Refer Now
                              </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

 @endsection 


 <div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">

        <div class="modal-body">
            <div class="form-group">
                <label for="email1">Copy and Share</label>
                <input type="text" class="form-control" id="referUrl" aria-describedby="emailHelp" readonly>
            </div>

        </div>
    </div>
</div>
</div>
 @push('script')

<script>

function getReferUrl() {

  <?php  if(Auth::check()){ ?>  

    $('#formModal').modal('show');
    let reffer_ids = '<?php echo base64_encode( Auth::User()->id) ?>';
    let url = "{{route('service_details')}}"+"/"+"{{$details->slug}}"+"/"+reffer_ids;
    console.log(url);
    $('#referUrl').val(url);

    <?php } else{
        
        \Session::put('service_details',$details->slug);

        ?>
        alert("please login first");

window.location.href = '{{route('user_login')}}';


        <?php }?>
}
</script>

     
 @endpush