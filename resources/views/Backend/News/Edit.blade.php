@extends('Backend.main')
@section('content')
    <div class="content-wrapper">
        <section class="content">
            @if (count($errors) > 0)
                <div class="alert alert-error alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif
            <div class="row">
                <!-- right column -->
                <div class="col-md-12">
                    <!-- Horizontal Form -->
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title">Update News</h3>
                        </div>







<form id="validation2" action="{{route('updateNews',['id'=>$records->id])}}" class="form-horizontal"  method="post" enctype="multipart/form-data">
    {{csrf_field()}}
    <div class="modal-body clearfix">

        <div class="form-group">
            <label for="title" class="col-sm-3 control-label">Category Name<span class="requiredAsterisk">*</span></label>
            <div class="col-sm-9">
                <select type="text" name="cat_name" class="validate[required] form-control select2" id="cat_name">
                    <option value="">Select One</option>
                    @foreach($getBlogCats as $getBlogCat)
                        <option value="{{$getBlogCat->id}}" @if($records->category_id == $getBlogCat->id) selected @endif>{{$getBlogCat->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="title" class="col-sm-3 control-label">Title<span class="requiredAsterisk">*</span></label>
            <div class="col-sm-9">
                <input type="text" name="title" class="validate[required] form-control" value="{{$records->title}}" >
            </div>
        </div>
        <div class="form-group">
            <label for="title" class="col-sm-3 control-label">Content</label>
            <div class="col-sm-9">
                <textarea type="text" name="content" class="form-control summernote" rows="20" >{!! $records->content !!}</textarea>
            </div>
        </div>

        <div class="form-group">
            <label for="title" class="col-sm-3 control-label">Short Description</label>
            <div class="col-sm-9">
                <textarea type="text" name="short_description" class="form-control summernote" rows="5" >{!! $records->short_description !!}</textarea>
            </div>
        </div>

        <div class="form-group">
            <label for="title" class="col-sm-3 control-label">Image</label>
            <div class="col-sm-9">
                <small>Mix File size 2MB</small>, <small >File accept Only (jpeg,jpg png,gif,svg)</small>
                <input type="file" name="image" id="image"  class="form-control" >
                <img src="{{asset('uploads/generalSetting/'.$records->image)}}" alt="" width="50px">
            </div>
        </div>

        <div class="form-group">
            <label for="title" class="col-sm-3 control-label">Meta Title<span class="requiredAsterisk">*</span></label>
            <div class="col-sm-9">
                <input type="text" name="meta_title" class="validate[required] form-control" value="{{$records->meta_title}}" >
            </div>
        </div>

        <div class="form-group">
            <label for="title" class="col-sm-3 control-label">Meta Keyword<span class="requiredAsterisk">*</span></label>
            <div class="col-sm-9">
                <input type="text" name="meta_keyword" class="validate[required] form-control" value="{{$records->meta_keyword}}">
            </div>
        </div>
        <div class="form-group">
            <label for="title" class="col-sm-3 control-label">Meta Description</label>
            <div class="col-sm-9">
                <textarea  name="meta_description" class="form-control" rows="5" >{{$records->meta_description}}</textarea>
            </div>
        </div>
        <div class="form-group">
            <label for="title" class="col-sm-3 control-label">Author <span class="requiredAsterisk">*</span></label>
            <div class="col-sm-9">
                <input type="text" name="author" class="validate[required] form-control" value="{{$records->meta_keyword}}">
            </div>
        </div>
        <div class="form-group">
            <label for="title" class="col-sm-3 control-label">Canonical <span class="requiredAsterisk">*</span></label>
            <div class="col-sm-9">
                <input type="text" name="canonical" class="validate[required] form-control" value="{{$records->canonical}}">
            </div>
        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal"><span class="fa fa-close"></span> Close</button>
        <button type="submit" class="btn btn-primary btn-flat"><span class="fa fa-check-circle"></span> Save</button>
    </div>
</form>


</div>
</div>
</div>

</section>
</div>

@endsection

@push('script')
    

<script type="text/javascript">
jQuery("#validation2").validationEngine({promptPosition: 'inline'});




</script>











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

@endpush

