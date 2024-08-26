<form id="validation2" action="{{route('saveCountry')}}" class="form-horizontal" method="post">
    {{csrf_field()}}
    <div class="modal-body clearfix">
        <div class="form-group">
            <label for="title" class="col-sm-3 control-label">Name<span class="requiredAsterisk">*</span></label>
            <div class="col-sm-9">
                <input type="text" name="name" class="validate[required] form-control" value="">
            </div>
        </div>

        <div class="form-group">
            <label for="RoleName" class="col-sm-3 control-label">Country Code<span class="requiredAsterisk">*</span></label>
            <div class="col-sm-9">
                <input type="text" name="country_code" class="validate[required,custom[onlyNumberSp]] form-control" value="">
            </div>
        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal"><span class="fa fa-close"></span> Close</button>
        @permission('add-country')
        <button type="submit" class="btn btn-primary btn-flat"><span class="fa fa-check-circle"></span> Save</button>
        @endpermission
    </div>
</form>

<script type="text/javascript">
    jQuery("#validation2").validationEngine({promptPosition: 'inline'});
</script>

