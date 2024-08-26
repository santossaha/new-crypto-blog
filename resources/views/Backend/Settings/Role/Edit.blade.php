<form id="validation2" action="{{route('updateRole',['id'=>$ID])}}" class="form-horizontal" method="post">
    {{csrf_field()}}
    <div class="modal-body clearfix">


        <div class="form-group">
            <label for="title" class="col-sm-3 control-label">Role Name<span class="requiredAsterisk">*</span></label>
            <div class="col-sm-9">
                <input type="text" name="role_name" class="validate[required] form-control" id="RoleName" value="{{$Role->name}}">
            </div>
        </div>

        <div class="form-group">
            <label for="RoleName" class="col-sm-3 control-label">Display Name<span class="requiredAsterisk">*</span></label>
            <div class="col-sm-9">
                <input type="text" name="display_name" class="validate[required] form-control" value="{{$Role->display_name}}">
            </div>
        </div>

        <div class="form-group">
            <label for="RoleName" class="col-sm-3 control-label">Description<span class="requiredAsterisk">*</span></label>
            <div class="col-sm-9">
                <textarea name="description" class="validate[required] form-control">{{$Role->description}}</textarea>
            </div>
        </div>


        <div class="row">
            <div class="col-sm-8 col-md-4 col-lg-4">
                <div class="form-headline">Permissions</div>
            </div>
        </div>
        <div class="form-group">
            <label for="accessControl" class="col-sm-4 control-label">Access Backend Panel</label>
            <div class="col-sm-8">
                <input type="checkbox" name="allow_backend" id="accessControl2" value="1" @if($alllowBackend) checked @endif>
                <a href="javascript:void(0);" title="Access Backend Panel" data-placement="top" data-toggle="popover" data-content="Allow role to access this backend panel">
                    <i class="fa fa-question-circle"></i>
                </a>
            </div>
        </div>

        <div class="form-group">
            <label for="accessControl" class="col-sm-4 control-label">Select All Permission</label>
            <div class="col-sm-8">
                <input type="checkbox" name="select_all" id="allSelect2">
            </div>
        </div>

       <div class="modalScroll">
        @foreach($permissions as $permissionGroup=>$permission)
            <div class="form-group">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <i class="fa fa-key"></i> <b>{{$permissionGroup}}</b>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-12 col-sm-offset-1 col-md-offset-1 col-lg-offset-1">

                    <ul class="permissionLabel">
                        @foreach($permissions[$permissionGroup] as $per)
                            <li class="PerList">
                                <label><input name="permissions[]" class="permissions2" type="checkbox" value="{{$per['id']}}" @if($per['count'] > 0) checked @endif> {{ucwords($per['display_name'])}} </label> &nbsp;
                                <a href="javascript:void(0);" title="{{ucwords($per['display_name'])}}" data-placement="top" data-toggle="popover" data-content="{{$per['description']}}">
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

    <div class="modal-footer">
        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal"><span class="fa fa-close"></span> Close</button>
        @permission('update-role')
        <button type="submit" class="btn btn-primary btn-flat"><span class="fa fa-check-circle"></span> Save</button>
        @endpermission
    </div>
</form>

<script type="text/javascript">
    $('.modal-body').slimScroll({
        height: '300px'
    });

    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' /* optional */
        });
    });
    jQuery("#validation2").validationEngine({promptPosition: 'inline'});

    $('#accessControl2').on('ifChecked', function(event){
        $('.permissions2').iCheck('enable');
    });
    $('#accessControl2').on('ifUnchecked', function(event){
        $('.permissions2').iCheck('disable');
    });
    $('#allSelect2').on('ifChecked', function(event){
        $('.permissions2').iCheck('check');
    });
    $('#allSelect2').on('ifUnchecked', function(event){
        $('.permissions2').iCheck('uncheck');
    });
    $('[data-toggle="popover"]').popover({
        trigger: 'focus'
    });

    if ($("#accessControl2").is(':checked')){
        $('.permissions2').iCheck('enable');
    }else{
        $('.permissions2').iCheck('disable');
    }
</script>
