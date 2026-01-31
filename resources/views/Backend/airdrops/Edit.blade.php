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
                <div class="col-md-12">
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title">Edit Airdrop</h3>
                        </div>

                        <form id="validation2" action="{{ route('updateAirdrop', ['id' => $records->id]) }}"
                            class="form-horizontal" enctype="multipart/form-data" method="post">
                            {{ csrf_field() }}
                            <div class="modal-body clearfix" style="max-height: 80vh; overflow-y: auto;">

                                <!-- Basic Information Section -->
                                <div class="panel panel-default">
                                    <div class="panel-heading"><strong><i class="fa fa-info-circle"></i> Basic
                                            Information</strong></div>
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Name <span
                                                    class="requiredAsterisk">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" name="name" class="validate[required] form-control"
                                                    value="{{ $records->name }}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Start Date</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="start_date" class="form-control datepicker"
                                                    value="{{ old('start_date', $records->start_date->format('d-m-Y')) }}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">End Date</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="end_date" class="form-control datepicker"
                                                    value="{{ old('end_date', $records->end_date->format('d-m-Y')) }}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Image (Logo)</label>
                                            <div class="col-sm-9">
                                                <small>Max File size (2MB)</small>, <small>File accept Only
                                                    (jpeg,jpg,png,gif,svg)</small>
                                                <input type="file" name="image" id="image" class="form-control">
                                                <small class="text-muted">Leave empty to keep current image</small>
                                                @if ($records->image)
                                                    <img src="{{ getFullPath('airdrop', $records->image) }}"
                                                        alt="{{ $records->name }}" id="imagePreview"
                                                        style="max-width: 150px; margin-top: 10px;">
                                                @else
                                                    <img src="" alt="" id="imagePreview"
                                                        style="max-width: 150px; margin-top: 10px; display: none;">
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Airdrop Details Section -->
                                <div class="panel panel-default">
                                    <div class="panel-heading"><strong><i class="fa fa-gift"></i> Airdrop Details</strong>
                                    </div>
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Airdrop Platform</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="platform" class="form-control"
                                                    value="{{ $records->platform }}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Participate Link</label>
                                            <div class="col-sm-9">
                                                <input type="url" name="participate_link" class="form-control"
                                                    value="{{ $records->participate_link }}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">No. of Winners</label>
                                            <div class="col-sm-9">
                                                <input type="number" name="winner_count" class="form-control"
                                                    min="0" value="{{ $records->winner_count }}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Winner Announcement</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="winner_announcement_date"
                                                    class="form-control datepicker"
                                                    value="{{ old('winner_announcement_date', $records->winner_announcement_date->format('d-m-Y')) }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Tokenomics Section -->
                                <div class="panel panel-default">
                                    <div class="panel-heading"><strong><i class="fa fa-database"></i> Tokenomics</strong>
                                    </div>
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Total Token Supply</label>
                                            <div class="col-sm-9">
                                                <input type="number" step="any" name="total_supply"
                                                    class="form-control" value="{{ $records->total_supply }}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Total Airdrop Qty</label>
                                            <div class="col-sm-9">
                                                <input type="number" step="any" name="total_airdrop_qty"
                                                    class="form-control" value="{{ $records->total_airdrop_qty }}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Supply Percentage (%)</label>
                                            <div class="col-sm-9">
                                                <input type="number" step="0.01" name="supply_percentage"
                                                    class="form-control" value="{{ $records->supply_percentage }}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Airdrop Value (USD)</label>
                                            <div class="col-sm-9">
                                                <input type="number" step="0.01" name="airdrop_value"
                                                    class="form-control" value="{{ $records->airdrop_value }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Categorization Section -->
                                <div class="panel panel-default">
                                    <div class="panel-heading"><strong><i class="fa fa-tags"></i> Categorization</strong>
                                    </div>
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Project Category</label>
                                            <div class="col-sm-9">
                                                <select name="project_category" class="form-control select2 select2-tags"
                                                    style="width: 100%;">
                                                    <option value="">Select or Type New</option>
                                                    @foreach ($categories as $key => $cat)
                                                        <option value="{{ $key }}"
                                                            {{ $records->project_category == $key ? 'selected' : '' }}>
                                                            {{ $cat }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Blockchain Network</label>
                                            <div class="col-sm-9">
                                                <select name="blockchain_network" class="form-control select2 select2-tags"
                                                    style="width: 100%;">
                                                    <option value="">Select or Type New</option>
                                                    @foreach ($networks as $key => $net)
                                                        <option value="{{ $key }}"
                                                            {{ $records->blockchain_network == $key ? 'selected' : '' }}>
                                                            {{ $net }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Descriptions Section -->
                                <div class="panel panel-default">
                                    <div class="panel-heading"><strong><i class="fa fa-file-text"></i>
                                            Descriptions</strong>
                                    </div>
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">About Airdrop</label>
                                            <div class="col-sm-9">
                                                <textarea name="description" class="form-control summernote" rows="5">{!! $records->description !!}</textarea>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">How To Participate</label>
                                            <div class="col-sm-9">
                                                <textarea name="how_to_participate" class="form-control summernote" rows="5">{!! $records->how_to_participate !!}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Social Links Section -->
                                <div class="panel panel-default">
                                    <div class="panel-heading"><strong><i class="fa fa-globe"></i> Social / Links</strong>
                                    </div>
                                    <div class="panel-body">
                                        @php
                                            $socials = [
                                                'website_url' => 'Website URL',
                                                'whitepaper_url' => 'Whitepaper URL',
                                                'twitter_url' => 'Twitter URL',
                                                'telegram_url' => 'Telegram URL',
                                                'discord_url' => 'Discord URL',
                                            ];
                                        @endphp

                                        @foreach ($socials as $field => $label)
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">{{ $label }}</label>
                                                <div class="col-sm-9">
                                                    <input type="url" name="{{ $field }}"
                                                        class="form-control" value="{{ $records->$field }}">
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- SEO Section -->
                                <div class="panel panel-default">
                                    <div class="panel-heading"><strong><i class="fa fa-search"></i> SEO / Status</strong>
                                    </div>
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Meta Title</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="meta_title" class="form-control"
                                                    value="{{ $records->meta_title }}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Meta Description</label>
                                            <div class="col-sm-9">
                                                <textarea name="meta_description" class="form-control" rows="3">{{ $records->meta_description }}</textarea>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Status</label>
                                            <div class="col-sm-9">
                                                <select name="status" class="form-control select2">
                                                    <option value="Active"
                                                        {{ $records->status == 'Active' ? 'selected' : '' }}>
                                                        Active</option>
                                                    <option value="Inactive"
                                                        {{ $records->status == 'Inactive' ? 'selected' : '' }}>Inactive
                                                    </option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Airdrop Status</label>
                                            <div class="col-sm-9">
                                                <select name="airdrop_status" class="form-control select2">
                                                    <option value="Upcoming"
                                                        {{ $records->airdrop_status == 'Upcoming' ? 'selected' : '' }}>
                                                        Upcoming
                                                    </option>
                                                    <option value="Ongoing"
                                                        {{ $records->airdrop_status == 'Ongoing' ? 'selected' : '' }}>
                                                        ongoing
                                                    </option>
                                                    <option value="Ended"
                                                        {{ $records->airdrop_status == 'Ended' ? 'selected' : '' }}>Ended
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-default btn-flat" onclick="history.back()"><span
                                        class="fa fa-close"></span> Cancel</button>
                                <button type="submit" class="btn btn-primary btn-flat"><span
                                        class="fa fa-check-circle"></span> Update</button>
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
        jQuery("#validation2").validationEngine({
            promptPosition: 'inline'
        });

        $('.datepicker').datepicker({
            autoclose: true,
            format: "dd-mm-yyyy"
        });

        $('.summernote').summernote({
            tabsize: 2,
            height: 200
        });

        $('.select2').select2();

        // Allow users to type new tags if not in list
        $('.tags').select2({
            tags: true
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


        $(document).ready(function() {
            $('.select2').select2();

            // Initialize select2 with tags mode for dynamic options
            // Initialize regular select2
            $('.select2-tags').each(function() {
                var $select = $(this);
                $select.select2({
                    tags: true,
                    allowClear: true,
                    placeholder: $select.data('placeholder') || 'Select or type new',
                    minimumResultsForSearch: 0,
                    createTag: function(params) {
                        var term = $.trim(params.term);
                        if (term === '') {
                            return null;
                        }
                        // Check if option already exists
                        var exists = false;
                        $select.find('option').each(function() {
                            if ($(this).text().toLowerCase() === term.toLowerCase() ||
                                $(this).val().toLowerCase() === term.toLowerCase()) {
                                exists = true;
                                return false;
                            }
                        });
                        if (exists) {
                            return null;
                        }
                        return {
                            id: term,
                            text: term,
                            newTag: true
                        };
                    }
                });
            });
        });
    </script>
@endpush
