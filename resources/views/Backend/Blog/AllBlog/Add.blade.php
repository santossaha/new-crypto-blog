<form id="validation2" action="{{route('saveBlog')}}" class="form-horizontal" enctype="multipart/form-data" method="post">
    {{csrf_field()}}
    <div class="modal-body clearfix">
        <div class="form-group">
            <label for="title" class="col-sm-3 control-label">Category Name<span class="requiredAsterisk">*</span></label>
            <div class="col-sm-9">
                <select type="text" name="cat_name" class="validate[required] form-control select2" id="cat_name">
                    <option value="">Select One</option>
                    @foreach($getBlogCats as $getBlogCat)
                        <option value="{{$getBlogCat->id}}">{{$getBlogCat->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="title" class="col-sm-3 control-label">Title<span class="requiredAsterisk">*</span></label>
            <div class="col-sm-9">
                <input type="text" name="title" class="validate[required] form-control" >
            </div>
        </div>
        <div class="form-group">
            <label for="title" class="col-sm-3 control-label">Description</label>
            <div class="col-sm-9">
                <textarea type="text" name="content" class="form-control summernote" rows="20" ></textarea>
            </div>
        </div>

        <div class="form-group">
            <label for="title" class="col-sm-3 control-label">Short Description</label>
            <div class="col-sm-9">
                <textarea type="text" name="content" class="form-control summernote" rows="20" ></textarea>
            </div>
        </div>
        <div class="form-group">
            <label for="title" class="col-sm-3 control-label">Image</label>
            <div class="col-sm-9">
                <small>Mix File size 2MB</small>, <small >File accept Only (jpeg,jpg png,gif,svg)</small>
                <input type="file" name="image" id="image"  class="validate[required]] form-control" >
            </div>
        </div>

        <div class="form-group">
            <label for="title" class="col-sm-3 control-label">Meta Title<span class="requiredAsterisk">*</span></label>
            <div class="col-sm-9">
                <input type="text" name="meta_title" class="validate[required] form-control" >
            </div>
        </div>

        <div class="form-group">
            <label for="title" class="col-sm-3 control-label">Meta Keyword<span class="requiredAsterisk">*</span></label>
            <div class="col-sm-9">
                <input type="text" name="meta_keyword" class="validate[required] form-control" >
            </div>
        </div>


        <div class="form-group">
            <label for="title" class="col-sm-3 control-label">Meta Description</label>
            <div class="col-sm-9">
                <textarea type="text" name="content" class="form-control" rows="5" ></textarea>
            </div>
        </div>

    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal"><span class="fa fa-close"></span> Close</button>
        <button type="submit" class="btn btn-primary btn-flat"><span class="fa fa-check-circle"></span> Save</button>
    </div>
</form>

<script type="text/javascript">
    $(document).ready(function() {
        $('.summernote').summernote({
            tabsize: 2,
            height: 200
        });

    });
</script>

<script type="text/javascript">
    jQuery("#validation2").validationEngine({promptPosition: 'inline'});
    $('.select2').select2();

</script>

