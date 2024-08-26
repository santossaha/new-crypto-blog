<!doctype html>

<html class="no-js" lang="en">
<head>

      <meta charset="utf-8">

      <meta http-equiv="x-ua-compatible" content="ie=edge">

      <title>Immigration Hub Services</title>

      <meta name="robots" content="noindex, follow">

      <meta name="description" content="">

      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

      <!-- Favicon -->

      <!-- <link rel="shortcut icon" type="image/x-icon" href="{{url('/')}}/assets/frontendtheme/images/favicon.png"> -->

      <!-- CSS

         ============================================ -->

      <!-- Bootstrap CSS -->

      <link rel="stylesheet" href="{{url('/')}}/assets/frontendtheme/css/bootstrap.min.css">

      <!-- Fontawesome -->

      <link rel="stylesheet" href="{{url('/')}}/assets/frontendtheme/css/fontawesome.css">

      <!-- Flaticon -->

      <link rel="stylesheet" href="{{url('/')}}/assets/frontendtheme/css/flaticon.css">

      <!-- Base Icons -->

      <link rel="stylesheet" href="{{url('/')}}/assets/frontendtheme/css/pbminfotech-base-icons.css"> 

      <!-- Swiper -->

      <link rel="stylesheet" href="{{url('/')}}/assets/frontendtheme/css/swiper.min.css">

      <!-- Magnific -->

      <link rel="stylesheet" href="{{url('/')}}/assets/frontendtheme/css/magnific-popup.css"> 

      <!-- Shortcode CSS -->

      <link rel="stylesheet" href="{{url('/')}}/assets/frontendtheme/css/shortcode.css">

      <!-- Base CSS -->

      <link rel="stylesheet" href="{{url('/')}}/assets/frontendtheme/css/base.css">

      <!-- Style CSS -->

      <link rel="stylesheet" href="{{url('/')}}/assets/frontendtheme/css/style.css">

      <!-- Responsive CSS -->

      <link rel="stylesheet" href="{{url('/')}}/assets/frontendtheme/css/responsive.css"> 

      <!-- REVOLUTION STYLE SHEETS -->

      <link rel="stylesheet" type="text/css" href="{{url('/')}}/assets/frontendtheme/css/rs6.css">

   </head>


<body>

	<!-- page wrapper -->
	<div class="page-wrapper">



		<!-- Header Main Area -->

		<header class="site-header header-style-1">
			<div class="pre-header">
				<div class="container-fluid">
					<div class="">
						<div class="row align-items-center">
							<div class="col-lg-7">
								<ul class="top-contact">					
									<li>
										<i class="pbmit-base-icon-location-pin"></i>
										<span>Address: </span>1122 N Limestone St, Springfield, OH 45503 
									</li>

									<li>
										<i class="pbmit-base-icon-envelope"></i>										
										<span>Email: </span><a href="mailto:immigrationhubservercies@gmail.com" style="color:white;" class="__cf_email__" >immigrationhubservercies@gmail.com</a>
									</li>
								</ul>
							</div>

							<div class="col-lg-5 pbmit-align-right">
								<div class="top-bar-rightsite">
									<div class="pbmit-social-links-wrapper">
										<ul class="social-icons">
											<li class="pbmit-social-facebook">										
												<a class=" tooltip-top" target="_blank" href="f" data-tooltip="Facebook">
													<i class="pbmit-base-icon-facebook"></i>
												</a>
											</li>

											<li class="pbmit-social-twitter">											
												<a class=" tooltip-top" target="_blank" href="t" data-tooltip="Twitter">
													<i class="pbmit-base-icon-twitter"></i>
												</a>
											</li>

											<li class="pbmit-social-flickr">
												<a class=" tooltip-top" target="_blank" href="i" data-tooltip="Instagram">
													<i class="pbmit-base-icon-instagram"></i>
												</a>
											</li>

											<li class="pbmit-social-linkedin">
												<a class=" tooltip-top" target="_blank" href="l" data-tooltip="LinkedIn">
													<i class="pbmit-base-icon-linkedin"></i>
												</a>
											</li>
										</ul>
									</div>

									<div class="pbmit-header-button">
										<a class="pbmit-btn" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#example25">
											<span>Make a Appointment</span>
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="site-header-menu">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-12">
							<div class="d-flex align-items-center justify-content-between">
								<div class="d-flex justify-content-between align-items-center">
									<div class="site-branding">
										<span class="site-title">
											<a href="{{route('home')}}">												
												<img class="logo-img" src="{{url('/')}}/assets/frontendtheme/images/Immigration_logo.png" alt="">
												<!-- <h1 style="color: white;">LOGO</h1> -->
											</a>
										</span>
									</div>

									<div class="site-navigation">
										<nav class="main-menu navbar-expand-xl navbar-light">
											<div class="navbar-header">
												<!-- Toggle Button --> 

												<button class="navbar-toggler" type="button">
													<i class="pbmit-liviza-icon-bars"></i>
												</button>
											</div>

											<div class="pbmit-mobile-menu-bg"></div>

											<div class="collapse navbar-collapse clearfix show" id="pbmit-menu">
												<div class="pbmit-menu-wrap">
													<ul class="navigation clearfix">
														<li class="">
															<a href="{{route('home')}}">Home</a>	
														</li>

														<li class="">
															<a href="{{route('about')}}">About</a>
														</li>															

														<li class="dropdown">
															<a href="{{route('service')}}">Service</a>
															<!-- <ul>

																<li><a href="visa-details.php">Service Details</a></li>

															</ul> -->
														</li>

														<li class="">
															<a href="{{route('contact_us')}}">Contact</a>
														</li>

					                                    <li class="dropdown">
				    										<a href="{{route('asylum')}}" class="nav-link">
				    											Asylum Questionnaire
				    											<i class="ri-arrow-down-s-line"></i>
				    										</a>
				                                        </li>
                                        
                                                    @if (!Auth::check())
                                                       
                                                 
														<li class="dropdown">
															<a href="#" class="nav-link">
																User
																<i class="ri-arrow-down-s-line"></i>
															</a>
															<ul>
																<li class="nav-item">
																	<a href="{{route('user_login')}}" class="nav-link">Log In</a>
																</li>

																<li class="nav-item">
																	<a href="{{route('user_register')}}" class="nav-link">Register</a>
																</li>					
															</ul>
														</li>
                                          @else
                                          <li class="">
															<a href="{{route('user_dashboard')}}">Dashboard</a>
														</li>
                                          @endif
													</ul>
												</div>
											</div>
										</nav>
									</div>
								</div>

								<div class="pbmit-right-side">
								    <div id="google_translate_element" style="margin-top: 23px; float: left; position: absolute;margin-right: -223px;"></div>
									<div class="pbmit-header-phone">
										<a href="tel:+19374509281">
											<span class="pbmit-header-phone-w-inner"> 
												<i class="pbmit-base-icon-chat-2"></i>								
												<span class="pbmit-phone-title">Have any Questions?</span>								
												<span class="pbmit-phone-number">+19374509281</span>
											</span>
										</a>
									</div>							
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</header>

        @yield('content')





           <!-- Page Content End -->
  
  
        <!-- footer -->
  
        <footer class="footer site-footer">
  
            <!-- <div class="pbmit-footer-widget-area-top">
   
               <div class="container">
   
                  <div class="first-footer-inner">
   
                     <div class="row align-items-center">
   
                        <div class="col-md-6">
   
                           <div class="pbmit-footer-boxes">
   
                              <h3 class="footer-title">Sign up to get Latest Updates</h3>
   
                           </div>
   
                        </div>
   
                        <div class="col-md-6">
   
                           <div class="pbmit-footer-boxes">
   
                              <form>
   
                                 <input type="email" name="email" placeholder="Your email address" required="">
   
                                 <button class="pbmit-btn" type="submit">
   
                                    Subscribe
   
                                 </button>
   
                              </form>  
   
                           </div>
   
                        </div>
   
                     </div>
   
                  </div>
   
               </div>
   
            </div> -->
   
            <div class="pbmit-footer-widget-area">
               <div class="container">
                  <div class="second-footer-inner"> 
                     <div class="row">
                        <div class="col-md-6 col-lg-4">
                           <div class="widget"> 
                              <div class="textwidget">
                                 <p>                                 
                                    <img class="pbmit-footerlogo" src="{{url('/')}}/assets/frontendtheme/images/Immigration_logo.png" alt="">
                                    <!-- <h1 style="color: white;">LOGO</h1> -->
                                 </p>
                                 
                                 <p>Get immigration services handled by experts and find peace of mind, while we handle all the complexities and help you remain compliant with all the regulations.</p>
                              </div>
   
                              <div class="pbmit-social-links-wrapper">
                                 <ul class="social-icons">
                                    <li class="pbmit-social-facebook">                                    
                                       <a class=" tooltip-top"  href="f" data-tooltip="Facebook" rel="noopener">
                                          <i class="pbmit-base-icon-facebook"></i>
                                       </a>
                                    </li>
   
                                    <li class="pbmit-social-twitter">                                    
                                       <a class=" tooltip-top"  href="t" data-tooltip="Twitter" rel="noopener">
                                          <i class="pbmit-base-icon-twitter"></i>
                                       </a>
                                    </li>
   
                                    <li class="pbmit-social-flickr">                              
                                       <a class=" tooltip-top"  href="i" data-tooltip="Instagram" rel="noopener">
                                          <i class="pbmit-base-icon-instagram"></i>
                                       </a>
                                    </li>
   
                                    <li class="pbmit-social-linkedin">                                    
                                       <a class=" tooltip-top"  href="l" data-tooltip="LinkedIn" rel="noopener">
                                          <i class="pbmit-base-icon-linkedin"></i>
                                       </a>
                                    </li>
                                 </ul>
                              </div>
                           </div>
                        </div>
   
                        <div class="col-md-6 col-lg-2">
                           <div class="widget">
                              <h3 class="widget-title">Information</h3>
                              <div class="menu-visa">
                                 <ul>
                                    <li><a href="{{route('home')}}">Home</a></li>
   
                                    <li><a href="{{route('about')}}">About Us</a></li>
   
                                    <li><a href="{{route('contact_us')}}">Contacts Us</a></li>
                                 </ul>
                              </div>
                           </div>
                        </div>
   
                        <div class="col-md-6 col-lg-3">
                           <div class="widget">
                              <h3 class="widget-title">Service</h3>
                              <div class="menu-visa">
                                 <ul>                                 
                                    <li><a href="visa-details-one.php">Document Collection</a></li>
                                 
                                    <li><a href="visa-details-two.php">Fill Up and Preparation</a></li>
                                 
                                    <li><a href="visa-details-three.php">Submission</a></li>
                                 </ul>
                              </div>
                           </div>
                        </div>
   
                        <div class="col-md-6 col-lg-3">
   
                           <div class="widget">
   
                              <h3 class="widget-title">Get in touch</h3>
   
                              <ul class="pbmit_contact_widget_wrapper">
   
                                 <li class="pbmit-contact-address  pbmit-base-icon-location-pin">
   
                                    
                                    <strong>Address</strong><br>1122 N Limestone St, Springfield, OH 45503        
   
                                 </li>
   
                                 <li class="pbmit-contact-phonenumber pbmit-base-icon-mobile">
   
                                    
                                    <strong>Phone</strong><br>+19374509281
                                 </li>
   
                                 <li class="pbmit-contact-envelope pbmit-base-icon-envelope">
   
                                    
                                    <strong>Email Address</strong><br><a href="mailto:immigrationhubservercies@gmail.com" style="color:#9faebe;" >immigrationhubservercies@gmail.com</a>
   
                                 </li>
   
                              </ul> 
   
                           </div>
   
                        </div>
   
                     </div>
   
                  </div>
   
               </div>
   
            </div>
   
            <div class="pbmit-footer-bottom">
   
               <div class="container">
   
                  <div class="pbmit-footer-text-inner">
   
                     <div class="row">
   
                        <div class="col-md-5">
   
                           <div class="pbmit-footer-left">Copyright © 2023 All Rights Reserved.</div>
   
                        </div>      
   
                        <div class="col-md-7">
   
                           <div class="pbmit-footer-right">
   
                              <ul class="footer-nav-menu">
   
                                 <li>Developed By <a href="https://jetwebsolution.com/" target="_blank">JET WEB SOLUTIONS</a></li>               
                              </ul>
   
                           </div>
   
                        </div>   
   
                     </div>
   
                  </div>   
   
               </div>
   
            </div>   
   
         </footer>
   
         <!-- footer End -->
   
      </div>
   
      <!-- page wrapper End -->
   
   
   
      <!-- Search Box Start Here -->
   
      <div class="pbmit-search-overlay">  
   
         <div class="pbmit-icon-close"></div>
   
         <div class="pbmit-search-outer"> 
   
            <div class="pbmit-search-logo">
   
               <img src="{{url('/')}}/assets/frontendtheme/images/logo-white.png" class="img-fluid" alt="">
   
            </div>
   
            <form class="pbmit-site-searchform">
   
               <input type="search" class="form-control field searchform-s" name="s" placeholder="Type Word Then Press Enter">
   
               <button type="submit">
   
                  <i class="pbmit-base-icon-search"></i>
   
               </button>
   
            </form>
   
         </div>
   
      </div>
   
       <!-- Search Box End Here -->
   
   
   
         <!-- JS
   
            ============================================ -->
   
         <!-- jQuery JS -->
   
       
         <script src="{{url('/')}}/assets/frontendtheme/js/jquery.min.js"></script>
   
         <!-- Popper JS -->
   
         <script src="{{url('/')}}/assets/frontendtheme/js/popper.min.js"></script>
   
         <!-- Bootstrap JS -->
   
         <script src="{{url('/')}}/assets/frontendtheme/js/bootstrap.min.js"></script> 
   
         <!-- jquery Waypoints JS -->
   
         <script src="{{url('/')}}/assets/frontendtheme/js/jquery.waypoints.min.js"></script>
   
         <!-- jquery Appear JS -->
   
         <script src="{{url('/')}}/assets/frontendtheme/js/jquery.appear.js"></script>
   
         <!-- Numinate JS -->
   
         <script src="{{url('/')}}/assets/frontendtheme/js/numinate.min.js"></script>
   
         <!-- Swiper JS -->
   
         <script src="{{url('/')}}/assets/frontendtheme/js/swiper.min.js"></script>
   
         <!-- Magnific JS -->
   
         <script src="{{url('/')}}/assets/frontendtheme/js/jquery.magnific-popup.min.js"></script>
   
         <!-- Circle Progress JS -->
   
         <script src="{{url('/')}}/assets/frontendtheme/js/circle-progress.js"></script>  
   
         <!-- Scripts JS -->
   
         <script src="{{url('/')}}/assets/frontendtheme/js/scripts.js"></script>        
   
         <!-- Revolution JS -->
   
         <script src="{{url('/')}}/assets/frontendtheme/js/rslider.js"></script>
   
         <script src="{{url('/')}}/assets/frontendtheme/js/rbtools.min.js"></script>
   
         <script src="{{url('/')}}/assets/frontendtheme/js/rs6.min.js"></script> 

         @stack('script')
   
      </body>
   </html>
   
   
   
   <div class="modal fade" id="example25" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <h1 class="modal-title fs-5" id="exampleModalLabel">Make a Appointment</h1>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
   
            <div class="modal-body">
               <div class="contact-form" style="padding: 0px !important;">
                  <div class="pbmit-heading-subheading">
                     <h4 class="pbmit-subtitle"></h4>
                    <!--  <h2 class="pbmit-title" style="color:white;">Log In<em></em></h2> -->
                  </div>
   
                  <form  method=""  action="">
   
                     <div class="row">
   
                        <div class="col-md-12 col-lg-12">
                           <input type="text" class="form-control" placeholder="Name" name="name" required>
                        </div>
   
                       <div class="col-md-12 col-lg-12">
                           <input type="text" class="form-control" placeholder="Phone No." name="phone" required>
                       </div>
   
                       <div class="col-md-12 col-lg-12">
                           <input type="email" class="form-control" placeholder="Email" name="email" required>
                       </div>
   
                       <div class="col-md-12 col-lg-12">
                           <input type="date" class="form-control" id="txtDate" placeholder="date"  name="appointment_date" required>
                       </div>
   
                       <div class="col-md-12 col-lg-12">
                           <input type="time" class="form-control" placeholder="time"  name="appointment_time" required>
                       </div>
   
                        <div class="col-md-12 col-lg-12">
                           <textarea name="note" class="form-control" placeholder="Short Note" cols="10"></textarea>
                        </div>
   
                        <div class="col-md-6 col-lg-6">
                           <button type="submit" name="appointment" class="pbmit-btn">
                              <i class="form-btn-loader fa fa-circle-o-notch fa-spin fa-fw margin-bottom d-none"></i>
                               Submit
                           </button>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
 
