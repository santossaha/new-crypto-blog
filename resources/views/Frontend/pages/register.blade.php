@extends('Frontend.layouts.frontendlayouts')

@section('content')
    <div class="pbmit-title-bar-wrapper"
        style="background-image: url({{ url('/') }}/assets/frontendtheme/images/title-bg.jpg);">
        <div class="container">
            <div class="pbmit-title-bar-content">
                <div class="pbmit-title-bar-content-inner">
                    <div class="pbmit-tbar">
                        <div class="pbmit-tbar-inner container">
                            <h1 class="pbmit-tbar-title">Register</h1>
                        </div>
                    </div>
                    <div class="pbmit-breadcrumb">
                        <div class="pbmit-breadcrumb-inner">
                            <span><a title="" href="" class="home"><i class="fa fa-home"></i></a></span>
                            <span class="sep"> → </span>
                            <span><span class="post-root post post-post current-item"> Register</span></span>
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

                        <div class="col-md-8 mx-auto">
                            <div class="contact-form">
                                <div class="pbmit-heading-subheading">
                                    <h4 class="pbmit-subtitle"></h4>
                                    <h2 class="pbmit-title">Create an account<em></em></h2>

                                    <div id="alert-container" class="mt-3"></div>

                                </div>


                                <form id="myform">

                                    <div class="row">
                                        <div class="col-md-12 col-lg-12">
                                            <input type="text" class="form-control" placeholder="Name" id="name"
                                                name="name" value="">
                                                <p class="text-danger" id="name_err"></p>

                                        </div>
                                        <div class="col-md-12 col-lg-12">
                                            <input type="text" class="form-control" placeholder="Email" id="email"
                                                name="email" value="">
                                                <p class="text-danger" id="email_err"></p>

                                        </div>
                                        <div class="col-md-12 col-lg-12">
                                            <input type="password" class="form-control" placeholder="Password"
                                                id="password" name="password">
                                                <p class="text-danger" id="password_err"></p>

                                        </div>



                                        <div class="col-md-12 col-lg-6">
                                            <button type="submit" name="reg" class="pbmit-btn" id="register_form">
                                                <i
                                                    class="form-btn-loader fa fa-circle-o-notch fa-spin fa-fw margin-bottom d-none"></i>
                                                Submit
                                            </button>
                                        </div>
                                        <div class="col-md-12 col-lg-12 message-status"></div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endsection

    @push('script')
        <script>
            $('#register_form').on('click', function(event) {
                event.preventDefault();
                $('#register_form').html('submitting....')
                // get value by id using jquery
                let name = $('#name').val();
                let email = $('#email').val();
                let password = $('#password').val();

                // send value using ajax 

                $.ajax({
                    type: 'POST',
                    url: '{{ route('save_register') }}',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'name': name,
                        'email': email,
                        'password': password
                    },
                    success: function(data) {
                        if (data.status == 'success') {
                            $('#register_form').html('submit')
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
                            }, 5000);


                        } else {
                          console.log(data.errors);

                          printErrorMsg(data.errors);
                          $('#register_form').html('submit')

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
