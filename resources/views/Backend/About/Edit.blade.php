<form id="validation2" action="{{route('updateAbout',['id'=>$records->id])}}" class="form-horizontal" enctype="multipart/form-data" method="post">
    {{csrf_field()}}
    <div class="modal-body clearfix">

        <div class="form-group">
            <label for="title" class="col-sm-3 control-label">Title<span class="requiredAsterisk">*</span></label>
            <div class="col-sm-9">
                <input type="text" name="title" class="validate[required] form-control" value="{{$records->title}}" >
            </div>
        </div>
        <div class="form-group">
            <label for="title" class="col-sm-3 control-label">Content</label>
            <div class="col-sm-9">
                <textarea type="text" name="content" class="form-control summernote" rows="10" >{!! $records->description !!}</textarea>
            </div>
        </div>

        <div class="form-group">
            <label for="title" class="col-sm-3 control-label">Image</label>
            <div class="col-sm-9">
                <small>Mix File size 2MB</small>, <small >File accept Only (jpeg,jpg png,gif,svg)</small>
                <input type="file" name="image" id="image"  class="form-control" >
                <img src="{{$records->image}}" alt="" width="50px">
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

    $(document).ready(function() {
        $('.summernote').summernote({ height: 300});
    });
</script>

