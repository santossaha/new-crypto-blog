@extends('Backend.Profile.header')

@section('profileContent')
<div class="box profile-tab">
    <div class="nav-tabs-custom">

        @include('Backend.Profile.tab')

        <div class="tab-content">
            <form id="validation" class="form-horizontal dashed-row white-field" action="{{route('saveSocialLink')}}" method="post">
                {{csrf_field()}}
                <div class="box-body">

                    @if (count($errors) > 0)
                        <div class="alert alert-error alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif

                    <div class="form-group">
                        <label class="col-sm-2">Facebook</label>
                        <div class="col-sm-10">
                            <input type="text" name="facebook" class="validate[custom[url]] form-control" value="@if(isset($SocialLinks->facebook)){{$SocialLinks->facebook}}@endif" placeholder="https://facebook.com">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2">Google Plus</label>
                        <div class="col-sm-10">
                            <input type="text" name="google_plus" class="validate[custom[url]] form-control" value="@if(isset($SocialLinks->google_plus)){{$SocialLinks->google_plus}}@endif" placeholder="https://plus.google.com">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2">Twitter</label>
                        <div class="col-sm-10">
                            <input type="text" name="twitter" class="validate[custom[url]] form-control" value="@if(isset($SocialLinks->twitter)){{$SocialLinks->twitter}}@endif" placeholder="https://twitter.com">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2">Linkedin</label>
                        <div class="col-sm-10">
                            <input type="text" name="linkedin" class="validate[custom[url]] form-control" value="@if(isset($SocialLinks->linkedin)){{$SocialLinks->linkedin}}@endif" placeholder="https://linkedin.com">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2">Youtube</label>
                        <div class="col-sm-10">
                            <input type="text" name="youtube" class="validate[custom[url]] form-control" value="@if(isset($SocialLinks->youtube)){{$SocialLinks->youtube}}@endif" placeholder="https://youtube.com">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2">Instagram</label>
                        <div class="col-sm-10">
                            <input type="text" name="instagram" class="validate[custom[url]] form-control" value="@if(isset($SocialLinks->instagram)){{$SocialLinks->instagram}}@endif" placeholder="https://instagram.com">
                        </div>
                    </div>
                </div>

                @permission('update-social-link')
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-check-circle"></i> Save</button>
                </div>
                @endpermission

            </form>

        </div>
    </div>


</div>
@endsection