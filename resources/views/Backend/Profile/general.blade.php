@extends('Backend.Profile.header')

@section('profileContent')
<div class="box profile-tab">
    <div class="nav-tabs-custom">

        @include('Backend.Profile.tab')

        <div class="tab-content">
            <form id="validation" class="form-horizontal dashed-row white-field" action="{{route('saveGeneralProfile')}}" method="post" enctype="multipart/form-data" autocomplete="off">
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
                        <label class="col-sm-2">Full Name<span class="requiredAsterisk">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" name="name" class="validate[required] form-control" value="{{Auth::user()->name}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2">Email<span class="requiredAsterisk">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" name="email" class="validate[required,custom[email]] form-control" value="{{Auth::user()->email}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2">Mobile<span class="requiredAsterisk">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" name="mobile" class="validate[required,custom[number]] form-control" value="{{Auth::user()->mobile}}">
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