@extends('Frontend.layouts.frontendlayouts')

 @section('content')



		
		<div class="pbmit-title-bar-wrapper" style="background-image: url({{url('/')}}/assets/frontendtheme/images/title-bg.jpg);">
            <div class="container">
				<div class="pbmit-title-bar-content">
					<div class="pbmit-title-bar-content-inner">
						<div class="pbmit-tbar">
							<div class="pbmit-tbar-inner container">
								<h1 class="pbmit-tbar-title"> About Us</h1>
							</div>
						</div>
						<div class="pbmit-breadcrumb">
							<div class="pbmit-breadcrumb-inner">
								<span><a title="" href="index.php" class="home"><i class="fa fa-home"></i></a></span>
								<span class="sep">  →  </span>
								<span><span class="post-root post post-post current-item"> About Us</span></span>
							</div>
						</div>
					</div>
				</div>
            </div>
        </div>


        <!-- Page Content -->
		<div class="page-content demo-one">

			<section class="section-md">
				<div class="container">
					<div class="row">
						<div class="col-md-12 col-lg-6">
							<div class="about-one-left">
								<div class="about-img-one">
									<img src="{{url('/')}}/assets/frontendtheme/images/about-us-upper-image.jpg" class="img-fluid" alt="">
								</div>
								<div class="about-img-two">
									<img src="{{url('/')}}/assets/frontendtheme/images/about-us-lower-image.jpg" class="img-fluid" alt="">
								</div>
								<div class="about-one-iconbox">
									<div class="about-one-icon">
										<i class="pbmit-liviza-business-icon pbmit-liviza-business-icon-student"></i>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-12 col-lg-6">
							<div class="about-one-right">
								<div class="pbmit-heading-subheading">
									<h4 class="pbmit-subtitle">About Agency</h4>
									<h2 class="pbmit-title">Providing Expert Assistance With Immigration</h2>
								</div>
								
								<p>Immigration Hub Services &amp; More LLC has been in this industry for more than a decade helping immigrants with their documents, form filling and translation so they can successfully immigrate and start a new journey of their life. Whether you are looking for a citizenship, or you want to immigrate for a job, we have the expertise in hand, to navigate you through all the complexities and make your immigration experience pleasant. Our core expertise is to help you arrange all the documents and then help you fill those accurately, finally sending them to the USCIS. We also have professionals who can provide you assistance with the transitions as well.</p>


								<!-- <ul class="list-group list-group-borderless">
									<li class="list-group-item">
										<i class="pbmit-liviza-business-icon pbmit-liviza-business-icon-check"></i> Talk to one of our best consultant today
									</li>
									<li class="list-group-item">
										<i class="pbmit-liviza-business-icon pbmit-liviza-business-icon-check"></i> Our experts are able to find new growth
									</li>
									<li class="list-group-item">
										<i class="pbmit-liviza-business-icon pbmit-liviza-business-icon-check"></i> Find more information our website
									</li>
								</ul> -->
								
							</div>
						</div>
					</div>
				</div>
			</section>


			<!-- Counter Start --> 
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
								<img src="{{url('/')}}/assets/frontendtheme/images/homepage-2/map-01.png" class="img-fluid" alt="">
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>



        <!-- Page Content End -->
  
  
        @endsection