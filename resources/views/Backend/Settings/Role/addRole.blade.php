@section('Setting')
<div class="col-md-3">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title full-width-chart"><span>Roles</span>

                <a title="Add role" data-act="ajax-modal" data-title="Add role" data-append-id="AjaxModelContent" data-action-url="{{route('role-form')}}" class="btn btn-default hover-primary btn-sm"><i class="fa fa-plus-circle"></i> Add Role</a> </h3>
        </div>

        <div class="box-body">

            <div class="table-responsive">
                <table class="table table-striped">
                    <tbody>
                    <tr>
                        <td><a href=""><b>Call of Duty IV</b></a></td>
                        <td class="text-right">
                            <a href="#edit" class="btn btn-default hover-primary btn-xs"><i class="fa fa-pencil"></i> </a>
                            <a href="#delete" class="btn btn-default hover-danger btn-xs"><i class="fa fa-times fa-fw"></i> </a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

<div class="col-md-7">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">User Roles</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form class="form-horizontal">
            <div class="box-body">

                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Group Name</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
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
                        <input type="checkbox" name="permissions[]" id="accessControl" checked>
                    </div>
                </div>


                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <i class="fa fa-key"></i> <b>General Settings</b>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-12 col-sm-offset-1 col-md-offset-1 col-lg-offset-1">
                        <div class="checkbox icheck"><label> <input name="permissions[]" class="permissions" type="checkbox" value="update-general"> Update General </label></div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <i class="fa fa-key"></i> <b>Role</b>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-12 col-sm-offset-1 col-md-offset-1 col-lg-offset-1">
                        <div class="checkbox icheck"><label> <input name="permissions[]" class="permissions" type="checkbox" value="add-role"> Add Role </label></div>
                        <div class="checkbox icheck"><label> <input name="permissions[]" class="permissions" type="checkbox" value="update-role"> Update Role </label></div>
                        <div class="checkbox icheck"><label> <input name="permissions[]" class="permissions" type="checkbox" value="delete-role"> Delete Role </label></div>
                    </div>
                </div>

            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-primary btn-flat">Sign in</button>
            </div>
            <!-- /.box-footer -->
        </form>
    </div>
</div>
@endsection