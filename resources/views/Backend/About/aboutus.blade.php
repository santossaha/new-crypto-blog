@extends('Backend.main')
@section('content')
    <style>
        .image-preview-wrapper {
            position: relative;
            display: inline-block;
            margin: 10px 0;
            border: 1px solid #ddd;
            padding: 5px;
            border-radius: 4px;
            background-color: #f8f8f8;
        }

        .image-preview-wrapper img {
            display: block;
            max-width: 200px;
            max-height: 200px;
            object-fit: contain;
        }

        .image-preview-wrapper .remove-image {
            position: absolute;
            top: -10px;
            right: -10px;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            padding: 0;
            line-height: 24px;
            text-align: center;
            font-size: 12px;
            z-index: 10;
            box-shadow: 0 0 5px rgba(0,0,0,0.3);
        }
    </style>

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
                            <h3 class="box-title">About Us</h3>
                        </div>

                        <form id="validation2" action="{{ $records ? route('updateAbout', ['id' => $records->id]) : route('saveAbout') }}" class="form-horizontal" enctype="multipart/form-data" method="post">
                            @csrf
                            <div class="modal-body clearfix">

                                <div class="form-group">
                                    <label for="title" class="col-sm-3 control-label">Title<span class="requiredAsterisk">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" name="title" class="validate[required] form-control" value="{{ $records ? $records->title : old('title') }}" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="title" class="col-sm-3 control-label">Content<span class="requiredAsterisk">*</span></label>
                                    <div class="col-sm-9">
                                        <textarea type="text" name="content" class="form-control summernote" rows="10" >{!! $records ? $records->description : old('content') !!}</textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="title" class="col-sm-3 control-label">Image</label>
                                    <div class="col-sm-9">
                                        <small>Max File size 2MB</small>, <small>File accept Only (jpeg,jpg png,gif,svg)</small>
                                        <input type="file" name="image" id="image" class="form-control" accept="image/*">

                                        <!-- Hidden field to track image deletion -->
                                        <input type="hidden" name="delete_image" id="delete_image" value="0">

                                        <!-- Image preview container -->
                                        <div id="image_preview_container" class="mt-3">
                                            @if($records && $records->image)
                                                <div class="image-preview-wrapper">
                                                    <img src="{{ $records->image }}" alt="About Us Image" class="img-thumbnail" style="max-width: 200px; max-height: 200px;">
                                                    <button type="button" class="btn btn-danger btn-sm remove-image" data-type="existing">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary btn-flat"><span class="fa fa-check-circle"></span> {{ $records ? 'Update' : 'Save' }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<script type="text/javascript">
    jQuery("#validation2").validationEngine({promptPosition: 'inline'});

    $(document).ready(function() {
        $('.summernote').summernote({ height: 300 });

        // Toast configuration
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };

        // Show success message if it exists in session
        @if(Session::has('success'))
            toastr.success("{{ Session::get('success') }}");
        @endif

        // Image Preview on Change
        $("#image").on("change", function() {
            const file = this.files[0];
            if (file) {
                if (file.type.match('image.*')) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        // Remove existing preview if any
                        $("#image_preview_container").html(`
                            <div class="image-preview-wrapper">
                                <img src="${e.target.result}" class="img-thumbnail" alt="Uploaded Image Preview">
                                <button type="button" class="btn btn-danger btn-sm remove-image" data-type="new">
                                    <i class="fa fa-times"></i>
                                </button>
                            </div>
                        `);

                        // Reset the delete flag
                        $("#delete_image").val(0);
                    };

                    reader.readAsDataURL(file);
                } else {
                    toastr.error("Please select a valid image file (jpeg, jpg, png, gif, svg)");
                    $(this).val('');
                }
            }
        });

        // Handle removing images - for both existing and newly uploaded
        $(document).on("click", ".remove-image", function() {
            const type = $(this).data('type');

            if (type === 'existing') {
                // Set delete flag for backend to remove the existing image
                $("#delete_image").val(1);
                toastr.info("Image will be removed when you save the form");
            } else {
                // For newly uploaded image
                toastr.info("Image removed from preview");
            }

            // Clear file input
            $("#image").val('');

            // Remove preview
            $(this).closest('.image-preview-wrapper').remove();
        });
    });
</script>
@endpush
