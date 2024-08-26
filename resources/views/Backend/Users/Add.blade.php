<form id="validation2" action="{{route('saveUser')}}" class="form-horizontal" method="post">
    {{csrf_field()}}
    <div class="modal-body clearfix">

        <div class="form-group">
            <label for="title" class="col-sm-3 control-label">Role<span class="requiredAsterisk">*</span></label>
            <div class="col-sm-9">
                <select name="roles[]"  class="validate[required] select2" multiple data-placement="select multiple role">
                    @foreach($Roles as $role)
                        <option value="{{$role->id}}">{{$role->display_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="title" class="col-sm-3 control-label">Name<span class="requiredAsterisk">*</span></label>
            <div class="col-sm-9">
                <input type="text" name="name" class="validate[required] form-control" value="">
            </div>
        </div>

        <div class="form-group">
            <label for="title" class="col-sm-3 control-label">Mobile<span class="requiredAsterisk">*</span></label>
            <div class="col-sm-9">
                <input type="text" name="mobile" class="validate[required, custom[number]] form-control" value="">
            </div>
        </div>

        <div class="form-group">
            <label for="title" class="col-sm-3 control-label">Email<span class="requiredAsterisk">*</span></label>
            <div class="col-sm-9">
                <input type="text" name="email" class="validate[required, custom[email]] form-control" value="">
            </div>
        </div>

        <div class="form-group">
            <label for="title" class="col-sm-3 control-label">Password<span class="requiredAsterisk">*</span></label>
            <div class="col-sm-9">
                <input type="password" name="password" class="validate[required] form-control" id="Password" value="">
            </div>
        </div>

        <div class="form-group">
            <label for="title" class="col-sm-3 control-label">Confirm Password<span class="requiredAsterisk">*</span></label>
            <div class="col-sm-9">
                <input type="password" name="confirm_password" class="validate[required, equals[Password]] form-control" value="">
            </div>
        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal"><span class="fa fa-close"></span> Close</button>
        @permission('add-user')
        <button type="submit" class="btn btn-primary btn-flat"><span class="fa fa-check-circle"></span> Save</button>
        @endpermission
    </div>
</form>

<script type="text/javascript">
    jQuery("#validation2").validationEngine({promptPosition: 'inline'});
    $('.select2').select2();
</script>

