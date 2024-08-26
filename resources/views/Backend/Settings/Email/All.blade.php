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

            <div class="col-md-10 @if(!Entrust::can('view-email-setting')) permissionDenied @endif">

                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Email Setting</h3>
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

                    <form id="validation" class="form-horizontal dashed-row" action="{{route('saveEmailSetting',['id'=>$ID])}}" method="post" autocomplete="off">
                        {{csrf_field()}}
                        <div class="box-body">

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Email sent from address<span class="requiredAsterisk">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" name="sent_email" class="validate[required,custom[email]] form-control" value="{{$data->sent_email}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Email sent from name<span class="requiredAsterisk">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" name="sent_email_name" class="validate[required] form-control" value="{{$data->sent_email_name}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Use SMTP</label>
                                <div class="col-sm-10">
                                    <input type="checkbox" id="UseSMTP" name="use_smtp" class="form-control" value="Yes" @if($data->use_smtp=='Yes') checked @endif>
                                </div>
                            </div>

                            <div id="showSmtp" @if($data->use_smtp=='No') style="display: none; @endif">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">SMTP Host<span class="requiredAsterisk">*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" name="smtp_host" class="validate[required] form-control" value="{{$data->smtp_host}}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">SMTP User<span class="requiredAsterisk">*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" name="smtp_user" class="validate[required] form-control" value="{{$data->smtp_user}}" autocomplete="off">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">SMTP Password<span class="requiredAsterisk">*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" name="smtp_password" class="validate[required] form-control" value="{{$data->smtp_password}}" autocomplete="off">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">SMTP Port<span class="requiredAsterisk">*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" name="smtp_port" class="validate[required] form-control" value="{{$data->smtp_port}}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Security Type<span class="requiredAsterisk">*</span></label>
                                    <div class="col-sm-10">
                                        <select name="security_type" class="select2 validate[required] form-control">
                                            <option value="" @if($data->security_type=='') selected @endif>-</option>
                                            <option value="TLS" @if($data->security_type=='TLS') selected @endif>TLS</option>
                                            <option value="SSL" @if($data->security_type=='SSL') selected @endif>SSL</option>
                                        </select>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-sm-2 control-label">Send a test mail to</label>
                                <div class="col-sm-10">
                                    <input type="text" name="send_test_email" class="validate[custom[email]] form-control" value="" placeholder="Keep it blank if you are not interested to send test mail">
                                </div>
                            </div>

                        </div>
                        @permission('update-email-setting')
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

<script type="text/javascript">
    $('#UseSMTP').on('ifChecked', function(event){
        $('#showSmtp').show();
    });
    $('#UseSMTP').on('ifUnchecked', function(event){
        $('#showSmtp').hide();
    });
</script>

@endpush