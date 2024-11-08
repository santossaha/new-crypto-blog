<form id="validation2" action="{{route('updatePermission',['id'=>$ID])}}" class="form-horizontal" method="post" autocomplete="off">
    {{csrf_field()}}
    <div class="modal-body clearfix">

        <div class="form-group">
            <label for="RoleName" class="col-sm-3 control-label">Group Name<span class="requiredAsterisk">*</span></label>
            <div class="col-sm-9">
                <select class="validate[required] form-control select2" name="group_name" id="GroupName2">
                    @foreach($allPermissionGroups as $group)
                        <option value="{{$group->group_name}}" @if($Permission->group_name==$group->group_name) selected @endif>{{$group->group_name}}</option>
                    @endforeach
                    <option value="0">New Group</option>
                </select>
            </div>
        </div>

        <div class="form-group" id="NewGroupName2" style="display: none;">
            <label for="RoleName" class="col-sm-3 control-label">New Group Name<span class="requiredAsterisk">*</span></label>
            <div class="col-sm-9">
                <input type="text" name="new_group_name" class="validate[required] form-control"  value="{{old('new_group_name')}}">
            </div>
        </div>

        <div class="form-group">
            <label for="RoleName" class="col-sm-3 control-label">Permission Name<span class="requiredAsterisk">*</span></label>
            <div class="col-sm-9">
                <input type="text" name="permission_name" class="validate[required] form-control" value="{{$Permission->name}}">
            </div>
        </div>

        <div class="form-group">
            <label for="RoleName" class="col-sm-3 control-label">Display Name<span class="requiredAsterisk">*</span></label>
            <div class="col-sm-9">
                <input type="text" name="display_name" class="validate[required] form-control" value="{{$Permission->display_name}}">
            </div>
        </div>

        <div class="form-group">
            <label for="RoleName" class="col-sm-3 control-label">Description<span class="requiredAsterisk">*</span></label>
            <div class="col-sm-9">
                <textarea name="description" class="validate[required] form-control">{{$Permission->description}}</textarea>
            </div>
        </div>

    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal"><span class="fa fa-close"></span> Close</button>
        @permission('update-permission')
        <button type="submit" class="btn btn-primary btn-flat"><span class="fa fa-check-circle"></span> Save</button>
        @endpermission
    </div>
</form>

<script type="text/javascript">
    $('.modal-body').slimScroll({
        height: '300px'
    });
    $(document).on('change', '#GroupName2', function() {
        if($(this).val()==0){
            $('#NewGroupName2').show();
        }else{
            $('#NewGroupName2').hide();
        }
    });
    jQuery("#validation2").validationEngine({promptPosition: 'inline'});
    $('.select2').select2();
</script>
