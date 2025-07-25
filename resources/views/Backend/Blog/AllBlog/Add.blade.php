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
                            <h3 class="box-title">Add Blog</h3>
                        </div>


<form id="validation2" action="{{route('saveBlog')}}" class="form-horizontal" enctype="multipart/form-data" method="post">
    {{csrf_field()}}
    <div class="modal-body clearfix"  style="max-height: 600px; overflow-y: auto;">
        <div class="form-group">
            <label for="title" class="col-sm-3 control-label">Category Name<span class="requiredAsterisk">*</span></label>
            <div class="col-sm-9">
                <select type="text" name="cat_name" class="validate[required] form-control select2" id="cat_name">
                    <option value="">Select One</option>
                    @foreach($getBlogCats as $getBlogCat)
                        <option value="{{$getBlogCat->id}}" {{ old('cat_name') == $getBlogCat->id ? 'selected' : '' }}>{{$getBlogCat->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="title" class="col-sm-3 control-label">Title<span class="requiredAsterisk">*</span></label>
            <div class="col-sm-9">
                <input type="text" name="title" class="validate[required] form-control" value="{{ old('title') }}" >
            </div>
        </div>
        <div class="form-group">
            <label for="title" class="col-sm-3 control-label">Description</label>
            <div class="col-sm-9">
                <textarea type="text" name="description" class="form-control summernote" rows="20" >{{ old('description') }}</textarea>
            </div>
        </div>

        <div class="form-group">
            <label for="title" class="col-sm-3 control-label">Short Description</label>
            <div class="col-sm-9">
                <textarea type="text" name="short_description" class="form-control summernote" rows="5" >{{ old('short_description') }}</textarea>
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
                <input type="text" name="meta_title" class="validate[required] form-control" value="{{ old('meta_title') }}" >
            </div>
        </div>

        <div class="form-group">
            <label for="title" class="col-sm-3 control-label">Meta Keyword<span class="requiredAsterisk">*</span></label>
            <div class="col-sm-9">
                <input type="text" name="meta_keyword" class="validate[required] form-control" value="{{ old('meta_keyword') }}" >
            </div>
        </div>
        <div class="form-group">
            <label for="title" class="col-sm-3 control-label">Meta Description</label>
            <div class="col-sm-9">
                <textarea  name="meta_description" class="form-control" rows="5" >{{ old('meta_description') }}</textarea>
            </div>
        </div>

        <div class="form-group">
            <label for="title" class="col-sm-3 control-label">Canonical <span class="requiredAsterisk">*</span></label>
            <div class="col-sm-9">
                <input type="text" name="canonical" class="validate[required] form-control" value="{{ old('canonical') }}" >
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