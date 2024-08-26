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


            <div class="col-md-3">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title full-width-chart"><span>Roles</span></h3>
                    </div>

                    <div class="box-body">

                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tbody>
                                    @if(empty(count($AllRoles)))
                                        <tr><td colspan="2" align="center">No Role Found</td></tr>
                                    @endif

                                    @foreach($AllRoles as $allRole)
                                    <tr>
                                        <td><a href="javascript:void(0);" data-act="ajax-modal" data-title="View Role" data-append-id="AjaxModelContent" data-action-url="{{route("editRole",['id'=>$allRole->id])}}"><b>{{$allRole->name}}</b></a></td>
                                        <td class="text-right">
                                            @permission('view-role')
                                            <a data-toggle="tooltip" title="View Role" data-act="ajax-modal" data-title="View Role" data-append-id="AjaxModelContent" data-action-url="{{route("editRole",['id'=>$allRole->id])}}" class="btn btn-default hover-primary btn-xs btn-flat"><i class="fa fa-pencil"></i> </a>
                                            @endpermission

                                            @if($allRole->id > 2)
                                            @permission('delete-role')
                                                <a href="{{route("deleteRole",['id'=>$allRole->id])}}" data-toggle="tooltip" title="Delete" data-confirm="Are you sure to delete the role <span class='label label-primary'>{{$allRole->name}}</span>" class="btn btn-default hover-danger btn-xs btn-flat"><i class="fa fa-times fa-fw"></i> </a>
                                            @endpermission
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>


            <div class="col-md-7 @if(!Entrust::can('add-role')) permissionDenied @endif">

                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add User Roles</h3>
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

                    <form id="validation" class="form-horizontal dashed-row" action="{{route('saveRole')}}" method="post">
                        {{csrf_field()}}
                        <div class="box-body">
                            <div class="form-group">
                                <label for="RoleName" class="col-sm-2 control-label">Role Name<span class="requiredAsterisk">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" name="role_name" class="validate[required] form-control" id="RoleName" value="{{old('role_name')}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="RoleName" class="col-sm-2 control-label">Display Name<span class="requiredAsterisk">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" name="display_name" class="validate[required] form-control" value="{{old('display_name')}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="RoleName" class="col-sm-2 control-label">Description<span class="requiredAsterisk">*</span></label>
                                <div class="col-sm-10">
                                    <textarea name="description" class="validate[required] form-control">{{old('description')}}</textarea>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-8 col-md-4 col-lg-4">
                                    <div class="form-headline">Permissions</div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="accessControl" class="col-sm-3 control-label">Access Backend Panel</label>
                                <div class="col-sm-8">
                                    <input type="checkbox" name="permissions[]" id="accessControl" value="1" checked>
                                    <a href="javascript:void(0);" title="Access Backend Panel" data-placement="top" data-toggle="popover" data-content="Allow role to access this backend panel">
                                        <i class="fa fa-question-circle"></i>
                                    </a>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="accessControl" class="col-sm-3 control-label">Select All Permission</label>
                                <div class="col-sm-8">
                                    <input type="checkbox" name="select_all" id="allSelect">
                                </div>
                            </div>

                           <div id="Scroller">
                                @foreach($permissions as $permissionGroup=>$permission)
                                    <div class="form-group">
                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <i class="fa fa-key"></i> <b>{{$permissionGroup}}</b>
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg-12 col-sm-offset-1 col-md-offset-1 col-lg-offset-1">

                                            <ul class="permissionLabel">
                                                @foreach($permissions[$permissionGroup] as $per)
                                                <li class="PerList">
                                                    <label><input name="permissions[]" class="permissions" type="checkbox" value="{{$per->id}}"> {{ucwords($per->display_name)}} </label> &nbsp;
                                                    <a href="javascript:void(0);" title="{{ucwords($per->display_name)}}" data-placement="top" data-toggle="popover" data-content="{{$per->description}}">
                                                        <i class="fa fa-question-circle"></i>
                                                    </a>
                                                </li>
                                                @endforeach
                                                <li class="clearfix"></li>
                                            </ul>
                                        </div>
                                    </div>
                                @endforeach
                           </div>

                        </div>
                        @permission('add-role')
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
    $('#Scroller').slimScroll({
        height: '300px'
    });

    $('#accessControl').on('ifChecked', function(event){
        $('.permissions').iCheck('enable');
    });
    $('#accessControl').on('ifUnchecked', function(event){
        $('.permissions').iCheck('disable');
    });
    $('#allSelect').on('ifChecked', function(event){
        $('.permissions').iCheck('check');
    });
    $('#allSelect').on('ifUnchecked', function(event){
        $('.permissions').iCheck('uncheck');
    });
    $('[data-toggle="popover"]').popover({
        trigger: 'focus'
    });

    if ($("#accessControl").is(':checked')){
        $('.permissions').iCheck('enable');
    }else{
        $('.permissions').iCheck('disable');
    }
</script>
@endpush
