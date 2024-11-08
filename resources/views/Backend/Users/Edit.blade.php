<form id="validation2" action="{{route('updateUser',['id'=>$ID])}}" class="form-horizontal" method="post">
    {{csrf_field()}}
    <div class="modal-body clearfix">

        @php
            $user_roles = [];
        @endphp
        @foreach($UserRoles as $UserRole)
            @php
                $user_roles[] = $UserRole->id;
            @endphp
        @endforeach

        <div class="form-group">
            <label for="title" class="col-sm-3 control-label">Role<span class="requiredAsterisk">*</span></label>
            <div class="col-sm-9">
                <select name="roles[]"  class="validate[required] select2" multiple>
                    @foreach($Roles as $role)
                        <option value="{{$role->id}}" @if(in_array($role->id,$user_roles)) selected @endif>{{$role->display_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="title" class="col-sm-3 control-label">Name<span class="requiredAsterisk">*</span></label>
            <div class="col-sm-9">
                <input type="text" name="name" class="validate[required] form-control" value="{{$records->name}}">
            </div>
        </div>

        <div class="form-group">
            <label for="title" class="col-sm-3 control-label">Mobile<span class="requiredAsterisk">*</span></label>
            <div class="col-sm-9">
                <input type="text" name="mobile" class="validate[required, custom[number]] form-control" value="{{$records->mobile}}">
            </div>
        </div>

        <div class="form-group">
            <label for="title" class="col-sm-3 control-label">Email<span class="requiredAsterisk">*</span></label>
            <div class="col-sm-9">
                <input type="text" name="email" class="validate[required, custom[email]] form-control" value="{{$records->email}}">
            </div>
        </div>

    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal"><span class="fa fa-close"></span> Close</button>
        @permission('update-user')
            <button type="submit" class="btn btn-primary btn-flat"><span class="fa fa-check-circle"></span> Save</button>
        @endpermission
    </div>
</form>

<script type="text/javascript">
    jQuery("#validation2").validationEngine({promptPosition: 'inline'});
    $('.select2').select2();
</script>

