@extends('Frontend.layouts.frontendlayouts')

@section('content')

		<div class="pbmit-title-bar-wrapper" style="background-image: url({{url('/')}}/assets/frontendtheme/images/title-bg.jpg);">
            <div class="container">
				<div class="pbmit-title-bar-content">
					<div class="pbmit-title-bar-content-inner">
						<div class="pbmit-tbar">
							<div class="pbmit-tbar-inner container">
								<h1 class="pbmit-tbar-title">Log In</h1>
							</div>
						</div>
						<div class="pbmit-breadcrumb">
							<div class="pbmit-breadcrumb-inner">
								<span><a title="" href="index.php" class="home"><i class="fa fa-home"></i></a></span>
								<span class="sep">  →  </span>
								<span><span class="post-root post post-post current-item"> Log In</span></span>
							</div>
						</div>
					</div>
				</div>
            </div>
        </div>

        <!-- Page Content -->
		<div class="page-content demo-one">

       		<section class="pt-4">
				<div class="container">
					<div class="contact-us-section">
						<div class="row"> 
						
							<div class="col-lg-4 col-md-6 mx-auto"> 
								<div class="contact-form">
									<div class="pbmit-heading-subheading">
										<h4 class="pbmit-subtitle"></h4>
										<h2 class="pbmit-title">Log In<em></em></h2>

										<div id="alert-container" class="mt-3"></div>

									</div>
								<form  id="myform">
										<div class="row">
											<div class="col-md-12 col-lg-12">
												<input type="email" class="form-control" placeholder="Email" name="email" id="email">
												<p class="text-danger" id="email_err"></p>

											</div>
											<div class="col-md-12 col-lg-12">
												<input type="password" class="form-control" placeholder="Password" name="password" id="password">
												<p class="text-danger" id="password_err"></p>

											</div>
											<div class="col-md-12 col-lg-6">
												<button type="submit" name="login" id="login_form" class="pbmit-btn">
													<i class="form-btn-loader fa fa-circle-o-notch fa-spin fa-fw margin-bottom d-none"></i>
													Log In
												</button>
											</div>
											<div class="col-md-12 col-lg-12 message-status"></div>
										</div>
									</form>

									<p>Forgot Password? <a href="forgot.php">Click Here</a></p>

								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			@endsection


			@push('script')
			<script>
				$('#login_form').on('click', function(event) {
					event.preventDefault();
					$('#login_form').html('submitting....')
					// get value by id using jquery
					
					let email = $('#email').val();
					let password = $('#password').val();
	
					// send value using ajax 
	
					$.ajax({
						type: 'POST',
						url: '{{ route('check_login') }}',
						data: {
							'_token': '{{ csrf_token() }}',
							'email': email,
							'password': password
						},
						success: function(data) {
							if (data.status == 'success') {
								$('#login_form').html('submit')
								$("#myform")[0].reset();
	
								//message div hide after 3 se
	
								var alertDiv = $(
									'<div class="alert alert-success alert-dismissible fade show" role="alert">' +
									data.msg +
									'<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
									'<span aria-hidden="true">&times;</span>' +
									'</button>' +
									'</div>'
								);
								$('#alert-container').html(alertDiv);
	
								// Hide the alert after 5 seconds
								setTimeout(function() {
									alertDiv.alert('close');
								}, 2000);

								//redirect dashboard
								window.location.href="{{route('user_dashboard')}}";
	
							} else {
							  console.log(data.errors);
	
							  printErrorMsg(data.errors);
							  $('#login_form').html('submit')
	
							}


							if(data.status == 'login_error'){

										//message div hide after 3 se
	
										var alertDiv = $(
									'<div class="alert alert-error alert-dismissible fade show" role="alert">' +
									data.msg +
									'<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
									'<span aria-hidden="true">&times;</span>' +
									'</button>' +
									'</div>'
								);
								$('#alert-container').html(alertDiv);
	
								// Hide the alert after 5 seconds
								setTimeout(function() {
									alertDiv.alert('close');
								}, 5000);


							}
	
						}
	
					})
				})
	
	
				// Error message function
	
				function printErrorMsg(msg){
				 
	
				  $.each(msg, function(key, value){
					  $('#'+key+'_err').text(value);
					  $('#'+key+'_err').css('display','block');
				  })
	
				  $('input').on('keyup',function(){
					
	
					let key = $(this).attr('name');
				   
	
					if($(this).val() == ''){
	
					  $('#'+key+'_err').show();
	
					}else{
	
	
					  $('#'+key+'_err').hide();
	
					}
	
				  })
	
				}
			</script>
		@endpush