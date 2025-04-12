@extends('Backend.main')
@section('content')

<style>
    .btn-close-custom {
        position: absolute;
        top: -10px;
        right: -10px;
        border-radius: 50%;
        padding: 0.25rem 0.5rem;
        font-size: 12px;
        line-height: 1;
        z-index: 10;
        min-width: 26px;
        min-height: 26px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 0 3px rgba(0,0,0,0.3);
    }

    .image-preview-container {
        position: relative;
        display: inline-block;
        margin-top: 10px;
        margin-right: 10px;
    }

    .image-preview-container img {
        width: 150px;
        height: 150px;
        object-fit: cover;
        border: 1px solid #ddd;
    }
</style>

<div class="content-wrapper" style="min-height: 955.875px;">

    <section class="content-header">
      <h1>
        Ads Images
        <small>Preview</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Forms</a></li>
        <li class="active">General Elements</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ isset($ad) ? 'Update' : 'Create' }} Ad Images</h3>
                    </div>

                    @if(Session::has('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form id="imageForm" method="POST" action="{{ isset($ad) ? route('updateAddsImage', $ad->id) : route('saveAddsImage') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="box-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Start Date <span class="text-danger">*</span></label>
                                        <input type="text" name="start_date" autocomplete="off" class="form-control datepicker" id="start_date" placeholder="DD-MM-YYYY" value="{{ isset($ad) && $ad->start_date ? \Carbon\Carbon::parse($ad->start_date)->format('d-m-Y') : old('start_date') }}" required>
                                        @error('start_date')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>End Date <span class="text-danger">*</span></label>
                                        <input type="text" name="end_date" autocomplete="off" class="form-control datepicker" id="end_date" placeholder="DD-MM-YYYY" value="{{ isset($ad) && $ad->end_date ? \Carbon\Carbon::parse($ad->end_date)->format('d-m-Y') : old('end_date') }}" required>
                                        @error('end_date')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Image Upload Fields -->
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="image">Main Image <span class="text-danger">{{ isset($ad) ? '' : '*' }}</span></label>
                                        <input type="file" name="image" id="image" class="form-control-file {{ isset($ad) ? '' : 'validate[required]' }}" accept="image/*">
                                        @if(isset($ad) && $ad->image)
                                        <div id="image_preview" class="mt-3">
                                            <div class="image-preview-container">
                                                <img src="{{ $ad->image_url }}" class="img-thumbnail">
                                                <button type="button" class="btn btn-sm btn-danger btn-close-custom" disabled title="Main image cannot be deleted">✕</button>
                                            </div>
                                        </div>
                                        @else
                                        <div id="image_preview" class="mt-2"></div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="ads_image">Ads Image (Optional)</label>
                                        <input type="file" name="ads_image" id="ads_image" class="form-control-file" accept="image/*">
                                        @if(isset($ad) && $ad->ads_image)
                                        <div id="ads_image_preview" class="mt-3">
                                            <div class="image-preview-container">
                                                <img src="{{ $ad->ads_image_url }}" class="img-thumbnail">
                                                <button type="button" class="btn btn-sm btn-danger delete-ads-image btn-close-custom" title="Delete this image">✕</button>
                                            </div>
                                        </div>
                                        <input type="hidden" name="delete_ads_image" id="delete_ads_image" value="0">
                                        @else
                                        <div id="ads_image_preview" class="mt-2"></div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">{{ isset($ad) ? 'Update' : 'Submit' }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection

@push('script')
<!-- jQuery, Bootstrap & Datepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

<script>
jQuery("#imageForm").validationEngine({promptPosition: 'inline'});

$(document).ready(function () {
    // Initialize Start Date Datepicker
    $("#start_date").datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true,
        todayHighlight: true
    }).on("changeDate", function (e) {
        // When start date changes, clear end date and set minimum date
        var selectedDate = new Date(e.date);
        $("#end_date").datepicker('setStartDate', selectedDate);

        // If end date is already selected and is less than start date, clear it
        var endDate = $("#end_date").datepicker('getDate');
        if (endDate && endDate < selectedDate) {
            $("#end_date").val('');
            $("#end_date").datepicker('update');
        }
    });

    // Initialize End Date Datepicker
    $("#end_date").datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true,
        todayHighlight: true
    });

    // If start date already has a value, set the minimum date for end date
    if ($("#start_date").val()) {
        try {
            var startDate = $("#start_date").datepicker('getDate');
            if (startDate) {
                $("#end_date").datepicker('setStartDate', startDate);
            }
        } catch (e) {
            console.error("Error setting start date:", e);
        }
    }

    // Image Upload Preview Function
    function previewImage(input, previewDiv) {
        let file = input.files[0];
        let reader = new FileReader();

        if (file && file.type.startsWith("image/")) {
            reader.onload = function (e) {
                // Different HTML for main image vs ads image
                if (previewDiv === "#image_preview") {
                    $(previewDiv).html(`
                        <div class="image-preview-container">
                            <img src="${e.target.result}" class="img-thumbnail">
                            <button type="button" class="btn btn-sm btn-danger close-btn btn-close-custom" title="Remove selected image">✕</button>
                        </div>
                    `);
                } else {
                    $(previewDiv).html(`
                        <div class="image-preview-container">
                            <img src="${e.target.result}" class="img-thumbnail">
                            <button type="button" class="btn btn-sm btn-danger close-btn btn-close-custom" title="Remove selected image">✕</button>
                        </div>
                    `);
                }
            };
            reader.readAsDataURL(file);
        } else if (file) {
            alert("Only images are allowed!");
            $(input).val(''); // Clear the input if not an image
        }
    }

    // Image Upload Preview on Change
    $("#image").on("change", function () {
        previewImage(this, "#image_preview");
    });

    $("#ads_image").on("change", function () {
        previewImage(this, "#ads_image_preview");
    });

    // Remove Image from Preview (for newly selected images)
    $(document).on("click", ".close-btn", function () {
        const previewDiv = $(this).closest(".image-preview-container");

        // Remove the preview
        if (previewDiv.closest("#image_preview").length) {
            $("#image").val('');
            previewDiv.remove();
        } else if (previewDiv.closest("#ads_image_preview").length) {
            $("#ads_image").val('');
            previewDiv.remove();
        }
    });

    // Delete ads image from database (for existing ads image)
    $(document).on("click", ".delete-ads-image", function() {
        if(confirm("Are you sure you want to delete this ads image?")) {
            $(this).closest(".image-preview-container").remove();
            $("#delete_ads_image").val(1);
        }
    });
});
</script>
@endpush

