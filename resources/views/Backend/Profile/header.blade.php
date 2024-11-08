@extends('Backend.main')

@section('content')
<div class="content-wrapper">

    <section class="content">

        <div class="box box-primary profile-box">
            <div class="box-body well">

                <div class="row">
                    <div class="col-md-2 text-center">
                        <div class="cropImageModel">
                            <img src="{{Auth::user()->profile_photo['path']}}" style="max-width: 125px; max-height: 125px;" width="125" class="gambar img-circle" id="item-img-output" />
                            <a class="pull-right"><i class="fa fa-camera" onclick="performClick('firefile');"></i>
                            <input id="firefile" type="file" class="item-img file center-block" name="file_photo" accept="image/*" style="visibility: hidden;">
                            </a>
                        </div>
                        <h4>{{Auth::user()->name}}</h4>
                    </div>


                    <div class="col-md-1"></div>

                    <div class="col-md-4">
                        <p class="text-muted">
                            @foreach(Auth::user()->roles as $role)
                            <span class="label label-primary">{{$role->display_name}}</span>
                            @endforeach
                        </p>
                        <p class="text-muted">
                            <i class="fa fa-envelope"></i> <b>{{Auth::user()->email}}</b>
                        </p>
                        @if(!empty(Auth::user()->mobile))
                        <p class="text-muted">
                            <i class="fa fa-phone-square"></i> <b>{{Auth::user()->mobile}}</b>
                        </p>
                        @endif



                        <p class="text-muted">
                            @if(isset($SocialLinks->facebook) && !empty($SocialLinks->facebook)) <a href="{{$SocialLinks->facebook}}" class="btn btn-facebook rounded-circle socialLinkkicon" target="_blank"><i class="fa fa-facebook"></i> </a> @endif
                            @if(isset($SocialLinks->google_plus) && !empty($SocialLinks->google_plus)) <a href="{{$SocialLinks->google_plus}}" class="btn btn-google rounded-circle socialLinkkicon"><i class="fa fa-google-plus"></i> </a> @endif
                            @if(isset($SocialLinks->twitter) && !empty($SocialLinks->twitter)) <a href="{{$SocialLinks->twitter}}" class="btn btn-twitter rounded-circle socialLinkkicon"><i class="fa fa-twitter"></i> </a> @endif
                            @if(isset($SocialLinks->linkedin) && !empty($SocialLinks->linkedin)) <a href="{{$SocialLinks->linkedin}}" class="btn btn-linkedin rounded-circle socialLinkkicon"><i class="fa fa-linkedin"></i> </a> @endif
                            @if(isset($SocialLinks->youtube) && !empty($SocialLinks->youtube)) <a href="{{$SocialLinks->youtube}}" class="btn btn-google rounded-circle socialLinkkicon"><i class="fa fa-youtube"></i> </a> @endif
                            @if(isset($SocialLinks->instagram) && !empty($SocialLinks->instagram)) <a href="{{$SocialLinks->instagram}}" class="btn btn-instagram rounded-circle socialLinkkicon"><i class="fa fa-instagram"></i> </a> @endif
                        </p>
                    </div>

                    <div class="col-md-5">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="info-box small">
                                <span class="info-box-icon bg-aqua"><i class="fa fa-envelope-o"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Messages</span>
                                    <span class="info-box-number">1,410</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="info-box small">
                                <span class="info-box-icon bg-green"><i class="fa fa-flag-o"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Bookmarks</span>
                                    <span class="info-box-number">410</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="info-box small">
                                <span class="info-box-icon bg-yellow"><i class="fa fa-files-o"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Uploads</span>
                                    <span class="info-box-number">13,648</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="info-box small">
                                <span class="info-box-icon bg-red"><i class="fa fa-star-o"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Likes</span>
                                    <span class="info-box-number">93,139</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        @yield('profileContent')
    </section>
</div>


@push('script')
<script type="text/javascript">

    function performClick(elemId) {
        var elem = document.getElementById(elemId);
        if(elem && document.createEvent) {
            var evt = document.createEvent("MouseEvents");
            evt.initEvent("click", true, false);
            elem.dispatchEvent(evt);
        }
    }

    // Start upload preview image
    var $uploadCrop,
        tempFilename,
        rawImg,
        imageId;
    function readFile(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('.upload-demo').addClass('ready');
                $('#cropImagePop').modal('show');
                rawImg = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
        }
        else {
            toastr["error"]("Sorry - you're browser doesn't support the FileReader API");
        }
    }

    $uploadCrop = $('#upload-demo').croppie({
        viewport: {
            width: 150,
            height: 200
        },
        enforceBoundary: false,
        enableExif: true
    });
    $('#cropImagePop').on('shown.bs.modal', function(){
        // alert('Shown pop');
        $uploadCrop.croppie('bind', {
            url: rawImg
        }).then(function(){
            console.log('jQuery bind complete');
        });
    });

    $('.item-img').on('change', function () { imageId = $(this).data('id'); tempFilename = $(this).val();
        $('#cancelCropBtn').data('id', imageId); readFile(this); });
    $('#cropImageBtn').on('click', function (ev) {
        $uploadCrop.croppie('result', {
            type: 'base64',
            format: 'jpeg',
            size: {width: 150, height: 200}
        }).then(function (resp) {
            $('#cropImagePop').modal('hide');
            $.ajax({
                type: "POST",
                url: "{{route('changeProfileImage')}}",
                data: {
                    'photo':resp,
                    '_token': '{{csrf_token()}}'
                },
                success: function(data)
                {
                    $('#item-img-output').attr('src', resp);
                    $('.profileImage').attr('src', resp);
                    toastr["success"]("Profile photo has been changed");
                },
                error: function() {
                    toastr["error"]("Failed to change profile photo");
                }
            });
        });
    });
    // End upload preview image
</script>

@endpush

@endsection