@extends('Backend.Profile.header')

@section('profileContent')
<div class="box profile-tab">
    <div class="nav-tabs-custom">

        @include('Backend.Profile.tab')

        <div class="tab-content">
            <form id="validation" class="form-horizontal dashed-row" action="{{route('saveAccountSettingProfile')}}" method="post" enctype="multipart/form-data">
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
                        <label class="col-sm-2">Old Password<span class="requiredAsterisk">*</span></label>
                        <div class="col-sm-10">
                            <input type="password" name="old_password" class="validate[required] form-control" value="" placeholder="type old password">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2">New Password<span class="requiredAsterisk">*</span></label>
                        <div class="col-sm-10">
                            <input type="password" name="new_password" class="validate[required] form-control" id="Password" value="" placeholder="type new password">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2">Confirm Password<span class="requiredAsterisk">*</span></label>
                        <div class="col-sm-10">
                            <input type="password" name="confirm_password" class="validate[required,equals[Password]] form-control" value="" placeholder="retype new password">
                        </div>
                    </div>
                </div>

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-check-circle"></i> Save</button>
                </div>

            </form>

        </div>
    </div>


</div>
@endsection