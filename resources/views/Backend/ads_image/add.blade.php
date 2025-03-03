@extends('Backend.main')
@section('content')

<div class="content-wrapper" style="min-height: 955.875px;">

    <section class="content-header">
      <h1>
        Adds Images
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
                        <h3 class="box-title">View and Update Ads Images</h3>
                    </div>
                    <form id="imageForm" method="POST" action="{{route('saveAddsImage')}}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{$record->id}}">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Start Date</label>
                                        <input type="text" class="form-control datepicker" name="start_date" value="{{$record->start_date}}" id="start_date" placeholder="YYYY-MM-DD">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>End Date</label>
                                        <input type="text" class="form-control datepicker" name="end_date" value="{{$record->end_date}}"  id="end_date" placeholder="YYYY-MM-DD">
                                    </div>
                                </div>
                            </div>

                            <!-- Image Upload Fields -->
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="image">Upload Image (Required)</label>
                                        <input type="file" id="image" class="form-control-file " name="requird_image" accept="image/*" >
                                        <br/>
                                        <div id="image_preview" class="mt-2">
                                            @if($record->requird_image)
                                            <br/>
                                            <img height="120" width="120" src="{{ Storage::url('adds/'.$record->requird_image) }}" alt="Image Preview">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="ads_image">Upload Ads Image (Optional)</label>
                                        <input type="file" id="ads_image" class="form-control-file " name="ads_image" accept="image/*">
                                        <br/>
                                        <div id="ads_image_preview" class="mt-2">
                                            @if($record->ads_image)
                                            <br/>
                                            <img height="120" width="120" src="{{ Storage::url('adds/'.$record->ads_image) }}" alt="Image Preview">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
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
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"> --}}


<script>

jQuery("#imageForm").validationEngine({promptPosition: 'inline'});

$(document).ready(function () {
    // Initialize Start Date Datepicker
    $("#start_date").datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true,
        todayHighlight: true
    }).on("changeDate", function (e) {
        // Set minimum date for End Date picker
        $("#end_date").datepicker("setStartDate", e.date);
    });

    // Initialize End Date Datepicker
    $("#end_date").datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true,
        todayHighlight: true
    });
});

    $(document).ready(function () {
        // Initialize Datepicker
        $('.datepicker').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true,
            todayHighlight: true
        });

        // Image Upload Preview Function
        function previewImage(input, previewDiv) {
        let file = input.files[0];
        let reader = new FileReader();

        if (file && file.type.startsWith("image/")) {
            reader.onload = function (e) {
                $(previewDiv).html(`
                    <div class="position-relative d-inline-block">
                        <img src="${e.target.result}" class="rounded border shadow-sm" style="width: 120px; height: 120px; object-fit: cover;">
                        <button class="btn btn-sm btn-danger close-btn position-absolute" style="top: -10px; right: -10px;">X</button>
                    </div>
                `);
            };
            reader.readAsDataURL(file);
        } else {
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

        // Remove Image from Preview
        // $(document).on("click", ".close-btn", function () {
        //     $(this).closest(".position-relative").remove();
        // });


        //Delete image

        $(document).on("click", ".close-btn", function () {
            const previewDiv = $(this).closest(".position-relative");
             // Remove the preview
            // Clear the associated input field
            if (previewDiv.closest("#image_preview").length ==1) {
                $("#image").val('');
                previewDiv.remove();
            } else if (previewDiv.closest("#ads_image_preview").length) {
                $("#ads_image").val('');
                previewDiv.remove();
            }
        });
        // Form Submit
        // $("#imageForm").submit(function (e) {
        //     e.preventDefault();

        //     let formData = new FormData(this);
        //     $.ajax({
        //         url: "/upload-image",  // Change to your backend route
        //         type: "POST",
        //         data: formData,
        //         contentType: false,
        //         processData: false,
        //         success: function (response) {
        //             alert("Image uploaded successfully!");
        //         },
        //         error: function (error) {
        //             alert("Something went wrong!");
        //         }
        //     });
        // });
    });
    </script>
@endpush

