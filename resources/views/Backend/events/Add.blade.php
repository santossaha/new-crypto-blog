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
                            <h3 class="box-title">Add Event</h3>
                        </div>

                        <form id="validation2" action="{{ route('saveEvent') }}" class="form-horizontal"
                            enctype="multipart/form-data" method="post">
                            {{ csrf_field() }}
                            <div class="modal-body clearfix" style="max-height: 800px; overflow-y: auto;">

                                <div class="form-group">
                                    <label for="title" class="col-sm-3 control-label">Title<span
                                            class="requiredAsterisk">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" name="title" class="validate[required] form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="content" class="col-sm-3 control-label">Content <span
                                        class="requiredAsterisk">*</span></label>
                                    <div class="col-sm-9">
                                        <textarea name="content" class="form-control" rows="5"></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="from_date" class="col-sm-3 control-label">From Date<span
                                            class="requiredAsterisk">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" name="from_date"
                                            class="validate[required] form-control datepic" id="from_date" data-date-format="mm-dd-yyyy">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="to_date" class="col-sm-3 control-label">To Date<span
                                            class="requiredAsterisk">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" name="to_date"
                                            class="validate[required] form-control datepic" id="to_date" data-date-format="mm-dd-yyyy">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="start_time" class="col-sm-3 control-label">Start Time</label>
                                    <div class="col-sm-9">
                                        <input type="time" name="start_time" class="form-control" id="start_time">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="to_time" class="col-sm-3 control-label">To Time</label>
                                    <div class="col-sm-9">
                                        <input type="time" name="to_time" class="form-control" id="to_time">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="location" class="col-sm-3 control-label">Location<span
                                            class="requiredAsterisk">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" name="location" class="validate[required] form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="contact_detail" class="col-sm-3 control-label">Contact Detail</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="contact_detail" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="email" class="col-sm-3 control-label">Email</label>
                                    <div class="col-sm-9">
                                        <input type="email" name="email" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="website_url" class="col-sm-3 control-label">Website URL</label>
                                    <div class="col-sm-9">
                                        <input type="url" name="website_url" class="form-control"
                                            placeholder="https://example.com">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Social Media</label>
                                    <div class="col-sm-9">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label>Facebook</label>
                                                <input type="url" name="facebook" class="form-control"
                                                    placeholder="https://facebook.com/...">
                                            </div>
                                            <div class="col-sm-4">
                                                <label>Instagram</label>
                                                <input type="url" name="instagram" class="form-control"
                                                    placeholder="https://instagram.com/...">
                                            </div>
                                            <div class="col-sm-4">
                                                <label>LinkedIn</label>
                                                <input type="url" name="linkedin" class="form-control"
                                                    placeholder="https://linkedin.com/...">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="image" class="col-sm-3 control-label">Event Image<span
                                            class="requiredAsterisk">*</span></label>
                                    <div class="col-sm-9">
                                        <small>Max File size 2MB</small>, <small>File accept Only (jpeg,jpg
                                            png,gif,svg)</small>
                                        <input type="file" name="image" id="image"
                                            class="validate[required] form-control">
                                        <img id="imagePreview" src="" alt=""
                                            style="max-width: 200px; margin-top: 10px; display: none;">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="description" class="col-sm-3 control-label">Description<span
                                            class="requiredAsterisk"></span></label>
                                    <div class="col-sm-9">
                                        <textarea name="description" class="form-control summernote" rows="5"></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="gallery_images" class="col-sm-3 control-label">Image Gallery</label>
                                    <div class="col-sm-9">
                                        <div id="galleryDropZone"
                                            style="border: 2px dashed #ccc; padding: 20px; text-align: center; background: #f9f9f9; min-height: 150px; cursor: pointer;">
                                            <p>Drag & Drop images here or click to select</p>
                                            <p><small>Multiple images can be uploaded</small></p>
                                            <input type="file" name="gallery_images[]" id="gallery_images" multiple
                                                accept="image/*" style="display: none;">
                                        </div>
                                        <div id="galleryPreview"
                                            style="margin-top: 15px; display: flex; flex-wrap: wrap; gap: 10px;"></div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="title" class="col-sm-3 control-label">Meta Title<span
                                            class="requiredAsterisk">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" name="meta_title" class="validate[required] form-control"
                                            value="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="title" class="col-sm-3 control-label">Meta Keyword<span
                                            class="requiredAsterisk">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" name="meta_keyword"
                                            class="validate[required] form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="title" class="col-sm-3 control-label">Meta Description</label>
                                    <div class="col-sm-9">
                                        <textarea name="meta_description" class="form-control" rows="5"></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="title" class="col-sm-3 control-label">Canonical <span
                                            class="requiredAsterisk">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" name="canonical" class="validate[required] form-control">
                                    </div>
                                </div>

                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-default btn-flat" data-dismiss="modal"><span
                                        class="fa fa-close"></span> Close</button>
                                <button type="submit" class="btn btn-primary btn-flat"><span
                                        class="fa fa-check-circle"></span> Save</button>
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
        $(document).ready(function() {


            $('.summernote').summernote({
                tabsize: 2,
                height: 200
            });

            $('.datepic').datepicker({
                autoclose: true,
                format: "dd-mm-yyyy"
            });

            $("#from_date").datepicker({
                autoclose: true,
                format: "dd-mm-yyyy"
            }).on('changeDate', function(selected) {
                var minDate = new Date(selected.date.valueOf());
                $('#to_date').datepicker('setStartDate', minDate);
            });

            $("#to_date").datepicker({
                autoclose: true,
                format: "dd-mm-yyyy"
            }).on('changeDate', function(selected) {
                var maxDate = new Date(selected.date.valueOf());
                $('#from_date').datepicker('setEndDate', maxDate);
            });

            // Image preview
            $('#image').change(function(e) {
                var file = e.target.files[0];
                if (file) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#imagePreview').attr('src', e.target.result).show();
                    }
                    reader.readAsDataURL(file);
                }
            });

            // Gallery drag and drop
            var galleryDropZone = document.getElementById('galleryDropZone');
            var galleryInput = document.getElementById('gallery_images');
            var galleryPreview = document.getElementById('galleryPreview');
            var galleryFiles = [];

            // Click to select files
            galleryDropZone.addEventListener('click', function() {
                galleryInput.click();
            });

            // Drag and drop events
            galleryDropZone.addEventListener('dragover', function(e) {
                e.preventDefault();
                galleryDropZone.style.borderColor = '#007bff';
                galleryDropZone.style.background = '#e7f3ff';
            });

            galleryDropZone.addEventListener('dragleave', function(e) {
                e.preventDefault();
                galleryDropZone.style.borderColor = '#ccc';
                galleryDropZone.style.background = '#f9f9f9';
            });

            galleryDropZone.addEventListener('drop', function(e) {
                e.preventDefault();
                galleryDropZone.style.borderColor = '#ccc';
                galleryDropZone.style.background = '#f9f9f9';

                var files = e.dataTransfer.files;
                handleGalleryFiles(files);
            });

            galleryInput.addEventListener('change', function(e) {
                var files = e.target.files;
                handleGalleryFiles(files);
            });

            function handleGalleryFiles(files) {
                for (var i = 0; i < files.length; i++) {
                    var file = files[i];
                    if (file.type.startsWith('image/')) {
                        galleryFiles.push(file);
                        previewGalleryImage(file);
                    }
                }
                updateGalleryInput();
            }

            function previewGalleryImage(file) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var div = document.createElement('div');
                    div.style.position = 'relative';
                    div.style.width = '150px';
                    div.style.margin = '5px';

                    var img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.width = '100%';
                    img.style.height = '150px';
                    img.style.objectFit = 'cover';
                    img.style.border = '1px solid #ddd';
                    img.style.borderRadius = '4px';

                    var removeBtn = document.createElement('button');
                    removeBtn.type = 'button';
                    removeBtn.className = 'btn btn-danger btn-xs';
                    removeBtn.style.position = 'absolute';
                    removeBtn.style.top = '5px';
                    removeBtn.style.right = '5px';
                    removeBtn.innerHTML = '<i class="fa fa-times"></i>';
                    removeBtn.onclick = function() {
                        var index = Array.from(galleryPreview.children).indexOf(div);
                        galleryFiles.splice(index, 1);
                        div.remove();
                        updateGalleryInput();
                    };

                    div.appendChild(img);
                    div.appendChild(removeBtn);
                    galleryPreview.appendChild(div);
                };
                reader.readAsDataURL(file);
            }

            function updateGalleryInput() {
                var dt = new DataTransfer();
                galleryFiles.forEach(function(file) {
                    dt.items.add(file);
                });
                galleryInput.files = dt.files;
            }

        });
    </script>
    <script type="text/javascript">
        jQuery("#validation2").validationEngine({
            promptPosition: 'inline'
        });
    </script>
@endpush
