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
                        <h3 class="box-title full-width-chart"><span>Permissions</span></h3>
                    </div>

                    <div class="box-body">

                        <div class="table-responsive settingPagination">
                            <table class="table table-striped">
                                <tbody>
                                    @if(empty(count($AllPermissions)))
                                        <tr><td colspan="2" align="center">No Permission Found</td></tr>
                                    @endif

                                    @foreach($AllPermissions as $allPermission)
                                    <tr>
                                        <td class="col-md-8"><a href="javascript:void(0);" data-act="ajax-modal" data-title="View Permission" data-append-id="AjaxModelContent" data-action-url="{{route("editPermission",['id'=>$allPermission->id])}}"><b>{{$allPermission->display_name}}</b></a></td>
                                        <td class="col-md-8 text-right">
                                            <a data-toggle="tooltip" title="View Permission" data-act="ajax-modal" data-title="View Permission" data-append-id="AjaxModelContent" data-action-url="{{route("editPermission",['id'=>$allPermission->id])}}" class="btn btn-default hover-primary btn-xs btn-flat"><i class="fa fa-pencil"></i> </a>
                                            @permission('delete-permission')
                                                <a href="{{route("deletePermission",['id'=>$allPermission->id])}}" data-toggle="tooltip" title="Delete" data-confirm="Are you sure to delete the permission <span class='label label-primary'>{{$allPermission->display_name}}</span>" class="btn btn-default hover-danger btn-xs btn-flat"><i class="fa fa-times fa-fw"></i> </a>
                                            @endpermission
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{$AllPermissions->links()}}
                            <p>Showing {{$AllPermissions->firstItem()}} to {{$AllPermissions->lastItem()}} of {{$AllPermissions->total()}} entries</p>
                        </div>

                    </div>
                </div>
            </div>


            <div class="col-md-7 @if(!Entrust::can('add-permission')) permissionDenied @endif">

                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add Permission</h3>
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

                    <form id="validation" class="form-horizontal dashed-row" action="{{route('savePermission')}}" method="post">
                        {{csrf_field()}}
                        <div class="box-body">

                            <div class="form-group">
                                <label for="RoleName" class="col-sm-2 control-label">Group Name<span class="requiredAsterisk">*</span></label>
                                <div class="col-sm-10">
                                    <select class="validate[required] form-control select2" name="group_name" id="GroupName">
                                        @foreach($allPermissionGroups as $group)
                                            <option value="{{$group->group_name}}">{{$group->group_name}}</option>
                                        @endforeach
                                        <option value="0">New Group</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group" id="NewGroupName" style="display: none;">
                                <label for="RoleName" class="col-sm-2 control-label">New Group Name<span class="requiredAsterisk">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" name="new_group_name" class="validate[required] form-control"  value="{{old('new_group_name')}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="RoleName" class="col-sm-2 control-label">Permission Name<span class="requiredAsterisk">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" name="permission_name" class="validate[required] form-control" value="{{old('permission_name')}}">
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
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-check-circle"></i> Save</button>
                        </div>
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
    $(document).on('change', '#GroupName', function() {
        if($(this).val()==0){
            $('#NewGroupName').show();
        }else{
            $('#NewGroupName').hide();
        }
    });
</script>
@endpush