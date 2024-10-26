<form id="validation2" action="{{route('updateCat',['id'=>$records->id])}}" class="form-horizontal" method="post">
    {{csrf_field()}}
    <div class="modal-body clearfix">

        
        <div class="form-group">
            <label for="title" class="col-sm-3 control-label">Category Type<span class="requiredAsterisk">*</span></label>
            <div class="col-sm-9">
                <select type="text" name="type" class="validate[required] form-control select2" id="type">
                    <option value="">Select One</option>
                        <option value="blog" @if ($records->type == 'blog') {{'selected'}}
                            
                        @endif>Blog</option>
                        <option value="event" @if ($records->type == 'event') {{'selected'}}
                            
                            @endif>Event</option>

                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="title" class="col-sm-3 control-label">Name<span class="requiredAsterisk">*</span></label>
            <div class="col-sm-9">
                <input type="text" name="name" class="validate[required] form-control" value="{{$records->name}}" >
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal"><span class="fa fa-close"></span> Close</button>
            <button type="submit" class="btn btn-primary btn-flat"><span class="fa fa-check-circle"></span> Save</button>
    </div>
</form>

<script type="text/javascript">
    jQuery("#validation2").validationEngine({promptPosition: 'inline'});
    $('.select2').select2();

</script>

