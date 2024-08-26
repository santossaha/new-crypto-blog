@extends('Backend.main')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-wrench"></i> App Settings
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">

            @include('Backend.Settings.settingSidebar')

            <div class="col-md-10 @if(!Entrust::can('view-company-setting')) permissionDenied @endif">

                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Company Setting</h3>
                    </div>

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

                    <form id="validation" class="form-horizontal dashed-row" action="{{route('saveCompanySetting',['id'=>$ID])}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="box-body">

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Company Name<span class="requiredAsterisk">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" name="company_name" class="validate[required] form-control" value="{{$data->company_name}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Address<span class="requiredAsterisk">*</span></label>
                                <div class="col-sm-10">
                                    <textarea name="address" class="validate[required] form-control">{{$data->address}}</textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">City<span class="requiredAsterisk">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" name="city" class="validate[required] form-control" value="{{$data->city}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">State<span class="requiredAsterisk">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" name="state" class="validate[required] form-control" value="{{$data->state}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Country<span class="requiredAsterisk">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" name="country" class="validate[required] form-control" value="{{$data->country}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Phone<span class="requiredAsterisk">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" name="phone" class="validate[required, custom[number]] form-control" value="{{$data->phone}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Email<span class="requiredAsterisk">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" name="email" class="validate[required, custom[email]] form-control" value="{{$data->email}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Website<span class="requiredAsterisk">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" name="website" class="validate[required, custom[url]] form-control" value="{{$data->website}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">GST/VAT Number</label>
                                <div class="col-sm-10">
                                    <input type="text" name="gst_vat_number" class="form-control" value="{{$data->gst_vat_number}}">
                                </div>
                            </div>

                        </div>
                        @permission('update-company-setting')
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-check-circle"></i> Save</button>
                        </div>
                        @endpermission
                    </form>
                </div>
            </div>

        </div>

    </section>
    <!-- /.content -->
</div>
@endsection

@push('script')



@endpush