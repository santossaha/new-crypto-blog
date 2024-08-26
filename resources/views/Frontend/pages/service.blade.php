@extends('Frontend.layouts.frontendlayouts')

@section('content')

		<div class="pbmit-title-bar-wrapper" style="background-image: url({{url('/')}}/assets/frontendtheme/images/title-bg.jpg);">
            <div class="container">
				<div class="pbmit-title-bar-content">
					<div class="pbmit-title-bar-content-inner">
						<div class="pbmit-tbar">
							<div class="pbmit-tbar-inner container">
								<h1 class="pbmit-tbar-title"> Our Services</h1>
							</div>
						</div>
						<div class="pbmit-breadcrumb">
							<div class="pbmit-breadcrumb-inner">
								<span><a title="" href="index.php" class="home"><i class="fa fa-home"></i></a></span>
								<span class="sep">  →  </span>
								<span><span class="post-root post post-post current-item"> Our Services</span></span>
							</div>
						</div>
					</div>
				</div>
            </div>
        </div>


        <!-- Page Content -->
		<div class="page-content pbmit-our-services">  

			<!-- Service -->
            <section class="section-lg pbmit-bg-color-light">
				<div class="container">
					<div class="pbmit-heading-subheading text-center">
						<h4 class="pbmit-subtitle">Immigration Hub Services & More LLC</h4>
						<h2 class="pbmit-title">Immigration - Choose <em> your country!</em></h2>
						<div class="service-content-box">
							<!--<p>We make the visa process faster. Our primary goal has been to provide immigration in all over country and universities. Nam hendrerit elit vel urna fermentum congue.</p>-->
						</div>
					</div>
					<div class="row">

						@if(!empty($services))
							
							@foreach($services as $service)	
						<div class="col-md-6 col-lg-4">
							<article class="pbminfotech-servicebox-style-2">
								<div class="pbminfotech-post-item">
									<span class="pbminfotech-item-thumbnail">
										<span class="pbminfotech-item-thumbnail-inner">
											<img src="{{url('/')}}/assets/frontendtheme/images/service-01.jpg" class="img-fluid" alt="">
										</span>
									</span>		
									<div class="pbminfotech-box-content">
										<div class="pbminfotech-box-content-inner">
											<div class="pbmit-ihbox-icon">
												<i class="pbmit-liviza-business-icon pbmit-liviza-business-icon-passport"></i>			
											</div>
											<div class="pbminfotech-des">
												<h3><a href="visa-details-one.php" tabindex="0">{{$service->name}}</a></h3>
												<h4>$500</h4>
												<div class="pbminfotech-service-content">
													{!!$service->s_description !!}
												</div>
												<div class="pbminfotech-box-link pbminfotech-vc_btn3">
													<a class="pbminfotech-vc_general" href="{{route('service_details',$service->slug)}}" tabindex="0">
														<span>Read More</span>
													</a>
												</div>
											</div>
										</div>
									</div>
								</div>
							</article>
						</div>
@endforeach
						@endif
					
					</div>
				</div>
			</section>



			<section class="section-lg counter-section-two">
				<div class="container">
					<div class="counter-two-content">
						<div class="row">
							<div class="col-md-12 col-lg-6">
								<div class="counter-two-left-box">
								<div class="pbmit-heading-subheading">
									<h4 class="pbmit-subtitle">OUR COMPANY</h4>
									<h2 class="pbmit-title text-white">Easing Your <em> Immigration Struggles </em></h2>
								</div>
								<p>Since the inception of&nbsp;Immigration Hub Services &amp; More LLC, we have thoudands of clients break the borders and start a new journey, ensuring a seamless immigration process.</p>
							</div>
							</div>
							<div class="col-md-12 col-lg-6">
								<div class="map-img-two">
									<img src="{{url('/')}}/assets/frontendtheme/images/homepage-1/map-01.png" class="img-fluid" alt="">
								</div>
							</div>
						</div>
					</div>
					<div class="counter-two-box">
						<div class="row">
							<div class="col-md-20percent">
								<div class="pbmit-fidbox-style-1">
									<div class="pbmit-fld-contents">
										<div class="pbmit-ihbox-icon">
											<div class="pbmit-sbox-icon-wrapper">
												<i class="pbmit-liviza-business-icon pbmit-liviza-business-icon-worker"></i>
											</div>
										</div>
										<div class="pbmit-fid-inner">
											<span data-appear-animation="animateDigits" data-from="0" data-to="4500" data-interval="5" class="numinate">4500</span>
											<sub>+</sub>		
										</div>
										<h3 class="pbmit-fid-title"><span>Trusted Clients<br></span></h3>
									</div>
									<div class="pbmit-fid-desc">
									   <p> </p>
									</div>
								</div>
							</div>
							<div class="col-md-20percent">
								<div class="pbmit-fidbox-style-1">
									<div class="pbmit-fld-contents">
										<div class="pbmit-ihbox-icon">
											<div class="pbmit-sbox-icon-wrapper">
												<i class="pbmit-liviza-business-icon pbmit-liviza-business-icon-airplane"></i>
											</div>
										</div>
										<div class="pbmit-fid-inner">
											<span data-appear-animation="animateDigits" data-from="0" data-to="150" data-interval="5" class="numinate">150</span>
											<sub>+</sub>		
										</div>
										<h3 class="pbmit-fid-title"><span>Countries<br></span></h3>
									</div>
									<div class="pbmit-fid-desc">
									   <p> </p>
									</div>
								</div>
							</div>
							<div class="col-md-20percent">
								<div class="pbmit-fidbox-style-1">
									<div class="pbmit-fld-contents">
										<div class="pbmit-ihbox-icon">
											<div class="pbmit-sbox-icon-wrapper">
												<i class="pbmit-liviza-business-icon pbmit-liviza-business-icon-white-house"></i>
											</div>
										</div>
										<div class="pbmit-fid-inner">
											<span data-appear-animation="animateDigits" data-from="0" data-to="574" data-interval="5" class="numinate">574</span>
											<sub>+</sub>		
										</div>
										<h3 class="pbmit-fid-title"><span>Universities<br></span></h3>
									</div>
									<div class="pbmit-fid-desc">
									   <p> </p>
									</div>
								</div>
							</div>
							<div class="col-md-20percent">
								<div class="pbmit-fidbox-style-1">
									<div class="pbmit-fld-contents">
										<div class="pbmit-ihbox-icon">
											<div class="pbmit-sbox-icon-wrapper">
												<i class="pbmit-liviza-business-icon pbmit-liviza-business-icon-student"></i>
											</div>
										</div>
										<div class="pbmit-fid-inner">
											<span data-appear-animation="animateDigits" data-from="0" data-to="1564" data-interval="5" class="numinate">1564</span>
											<sub>+</sub>		
										</div>
										<h3 class="pbmit-fid-title"><span>Students<br></span></h3>
									</div>
									<div class="pbmit-fid-desc">
									   <p> </p>
									</div>
								</div>
							</div>
							<div class="col-md-20percent">
								<div class="pbmit-fidbox-style-1">
									<div class="pbmit-fld-contents">
										<div class="pbmit-ihbox-icon">
											<div class="pbmit-sbox-icon-wrapper">
												<i class="pbmit-liviza-business-icon pbmit-liviza-business-icon-list"></i>
											</div>
										</div>
										<div class="pbmit-fid-inner">
											<span data-appear-animation="animateDigits" data-from="0" data-to="1254" data-interval="5" class="numinate">1254</span>
											<sub>+</sub>		
										</div>
										<h3 class="pbmit-fid-title"><span>immigration<br></span></h3>
									</div>
									<div class="pbmit-fid-desc">
									   <p> </p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>

 <!-- Page Content End -->
  
  @endsection
    