<form id="validation2" action="{{route('updateState',['id'=>$ID])}}" class="form-horizontal" method="post">
    {{csrf_field()}}
    <div class="modal-body clearfix">

        <div class="form-group">
            <label for="title" class="col-sm-3 control-label">Country<span class="requiredAsterisk">*</span></label>
            <div class="col-sm-9">
                <select name="country_id" class="validate[required] form-control select2" data-placeholder="Select country" id="Country">
                    <option value=""></option>
                    @foreach($countries as $country)
                        <option value="{{$country->id}}">{{$country->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>


        <div class="form-group">
            <label for="title" class="col-sm-3 control-label">Name<span class="requiredAsterisk">*</span></label>
            <div class="col-sm-9">
                <input type="text" name="name" class="validate[required] form-control" value="{{$record->name}}">
            </div>
        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal"><span class="fa fa-close"></span> Close</button>
        @permission('update-state')
        <button type="submit" class="btn btn-primary btn-flat"><span class="fa fa-check-circle"></span> Save</button>
        @endpermission
    </div>
</form>

<script type="text/javascript">
    $('#Country').val('{{$record->country_id}}');
    $('.select2').select2();
    jQuery("#validation2").validationEngine({promptPosition: 'inline'});
</script>

