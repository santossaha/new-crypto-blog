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
                            <h3 class="box-title">Add New ICO</h3>
                        </div>

                        <form id="validation2" action="{{route('saveICO')}}" class="form-horizontal" enctype="multipart/form-data" method="post">
                            {{csrf_field()}}
                            <div class="modal-body clearfix" style="max-height: 700px; overflow-y: auto;">

                                <!-- Basic Information Section -->
                                <div class="panel panel-default">
                                    <div class="panel-heading"><strong><i class="fa fa-info-circle"></i> Basic Information</strong></div>
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <label for="name" class="col-sm-3 control-label">ICO Name <span class="requiredAsterisk">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" name="name" class="validate[required] form-control" value="{{ old('name') }}" placeholder="e.g., Automated Meta Finance ($AMFI)">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="launchpad" class="col-sm-3 control-label">Launchpad</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="launchpad" class="form-control" value="{{ old('launchpad') }}" placeholder="e.g., On Website, Binance Launchpad">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="stage" class="col-sm-3 control-label">Stage</label>
                                            <div class="col-sm-9">
                                                <select name="stage" id="stage_select" class="form-control select2-tags" data-placeholder="Select Stage or Type New">
                                                    <option value="">Select Stage</option>
                                                    @foreach($stages as $key => $value)
                                                        <option value="{{ $key }}" {{ old('stage') == $key ? 'selected' : '' }}>{{ $value }}</option>
                                                    @endforeach
                                                </select>
                                                <small class="text-muted">You can select from list or type a new stage name</small>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="project_category" class="col-sm-3 control-label">Project Category</label>
                                            <div class="col-sm-9">
                                                <select name="project_category" id="project_category_select" class="form-control select2-tags" data-placeholder="Select Category or Type New">
                                                    <option value="">Select Category</option>
                                                    @foreach($categories as $key => $value)
                                                        <option value="{{ $key }}" {{ old('project_category') == $key ? 'selected' : '' }}>{{ $value }}</option>
                                                    @endforeach
                                                </select>
                                                <small class="text-muted">You can select from list or type a new category name</small>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="ico_status" class="col-sm-3 control-label">ICO Status</label>
                                            <div class="col-sm-9">
                                                <select name="ico_status" class="form-control select2" data-placeholder="Select Status">
                                                    <option value="">Select Status</option>
                                                    @foreach($icoStatuses as $key => $value)
                                                        <option value="{{ $key }}" {{ old('ico_status') == $key ? 'selected' : '' }}>{{ $value }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="image" class="col-sm-3 control-label">ICO Image/Logo</label>
                                            <div class="col-sm-9">
                                                <small>Max File size (2MB)</small>, <small>File accept Only (jpeg,jpg,png,gif,svg)</small>
                                                <input type="file" name="image" id="image" class="form-control">
                                                <img src="" alt="" id="imagePreview" style="max-width: 150px; margin-top: 10px; display: none;">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Token Details Section -->
                                <div class="panel panel-default">
                                    <div class="panel-heading"><strong><i class="fa fa-database"></i> Token Details</strong></div>
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <label for="total_supply_qty" class="col-sm-3 control-label">Total Supply Qty</label>
                                            <div class="col-sm-9">
                                                <input type="number" step="0.01" name="total_supply_qty" class="form-control" value="{{ old('total_supply_qty') }}" placeholder="e.g., 777000000.00">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="tokens_for_sale" class="col-sm-3 control-label">Tokens for Sale</label>
                                            <div class="col-sm-9">
                                                <input type="number" step="0.01" name="tokens_for_sale" class="form-control" value="{{ old('tokens_for_sale') }}" placeholder="e.g., 233100000.00">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="supply_percentage" class="col-sm-3 control-label">% of Supply</label>
                                            <div class="col-sm-9">
                                                <input type="number" step="0.01" name="supply_percentage" class="form-control" value="{{ old('supply_percentage') }}" placeholder="e.g., 30.00" min="0" max="100">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="ico_price" class="col-sm-3 control-label">ICO Price</label>
                                            <div class="col-sm-6">
                                                <input type="number" step="0.000001" name="ico_price" class="form-control" value="{{ old('ico_price') }}" placeholder="e.g., 0.03">
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" name="ico_price_currency" class="form-control" value="{{ old('ico_price_currency', 'USDT') }}" placeholder="Currency (USDT)">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="one_usdt_value" class="col-sm-3 control-label">1 USDT = ?</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="one_usdt_value" class="form-control" value="{{ old('one_usdt_value') }}" placeholder="e.g., 33.33 AMFI or TBA">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Sale Details Section -->
                                <div class="panel panel-default">
                                    <div class="panel-heading"><strong><i class="fa fa-money"></i> Sale Details</strong></div>
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <label for="fundraising_goal" class="col-sm-3 control-label">Fundraising Goal</label>
                                            <div class="col-sm-9">
                                                <input type="number" step="0.01" name="fundraising_goal" class="form-control" value="{{ old('fundraising_goal') }}" placeholder="e.g., 6993000">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="soft_cap" class="col-sm-3 control-label">Soft Cap</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="soft_cap" class="form-control" value="{{ old('soft_cap') }}" placeholder="e.g., $500,000 or TBA">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="hard_cap" class="col-sm-3 control-label">Hard Cap</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="hard_cap" class="form-control" value="{{ old('hard_cap') }}" placeholder="e.g., $10,000,000 or TBA">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="personal_cap" class="col-sm-3 control-label">Personal Cap</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="personal_cap" class="form-control" value="{{ old('personal_cap') }}" placeholder="e.g., $10,000 or TBA">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="buy_link" class="col-sm-3 control-label">Buy Link</label>
                                            <div class="col-sm-9">
                                                <input type="url" name="buy_link" class="form-control" value="{{ old('buy_link') }}" placeholder="https://...">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Blockchain Details Section -->
                                <div class="panel panel-default">
                                    <div class="panel-heading"><strong><i class="fa fa-link"></i> Blockchain Details</strong></div>
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <label for="blockchain_network" class="col-sm-3 control-label">Blockchain Network</label>
                                            <div class="col-sm-9">
                                                <select name="blockchain_network" id="blockchain_network_select" class="form-control select2-tags" data-placeholder="Select Network or Type New">
                                                    <option value="">Select Network</option>
                                                    @foreach($networks as $key => $value)
                                                        <option value="{{ $key }}" {{ old('blockchain_network') == $key ? 'selected' : '' }}>{{ $value }}</option>
                                                    @endforeach
                                                </select>
                                                <small class="text-muted">You can select from list or type a new network name</small>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="contract_address" class="col-sm-3 control-label">Contract Address</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="contract_address" class="form-control" value="{{ old('contract_address') }}" placeholder="0x...">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Date Section -->
                                <div class="panel panel-default">
                                    <div class="panel-heading"><strong><i class="fa fa-calendar"></i> ICO Dates</strong></div>
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <label for="start_date" class="col-sm-3 control-label">Start Date</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="start_date" class="form-control datepic" id="start_date" placeholder="DD-MM-YYYY" value="{{ old('start_date') }}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="end_date" class="col-sm-3 control-label">End Date</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="end_date" class="form-control datepic" id="end_date" placeholder="DD-MM-YYYY" value="{{ old('end_date') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Links Section -->
                                <div class="panel panel-default">
                                    <div class="panel-heading"><strong><i class="fa fa-globe"></i> Project Links</strong></div>
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <label for="website_url" class="col-sm-3 control-label">Website URL</label>
                                            <div class="col-sm-9">
                                                <input type="url" name="website_url" class="form-control" value="{{ old('website_url') }}" placeholder="https://...">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="whitepaper_url" class="col-sm-3 control-label">Whitepaper URL</label>
                                            <div class="col-sm-9">
                                                <input type="url" name="whitepaper_url" class="form-control" value="{{ old('whitepaper_url') }}" placeholder="https://...">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Social Media</label>
                                            <div class="col-sm-9">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <label>Twitter</label>
                                                        <input type="url" name="twitter_url" class="form-control" placeholder="https://twitter.com/..." value="{{ old('twitter_url') }}">
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label>Telegram</label>
                                                        <input type="url" name="telegram_url" class="form-control" placeholder="https://t.me/..." value="{{ old('telegram_url') }}">
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label>Discord</label>
                                                        <input type="url" name="discord_url" class="form-control" placeholder="https://discord.gg/..." value="{{ old('discord_url') }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Description Section -->
                                <div class="panel panel-default">
                                    <div class="panel-heading"><strong><i class="fa fa-file-text"></i> Description</strong></div>
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <label for="short_description" class="col-sm-3 control-label">Short Description</label>
                                            <div class="col-sm-9">
                                                <textarea name="short_description" class="form-control" rows="3" placeholder="Brief description of the ICO project">{{ old('short_description') }}</textarea>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="description" class="col-sm-3 control-label">Full Description</label>
                                            <div class="col-sm-9">
                                                <textarea name="description" class="form-control summernote" rows="5">{{ old('description') }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- SEO Section -->
                                <div class="panel panel-default">
                                    <div class="panel-heading"><strong><i class="fa fa-search"></i> SEO Settings</strong></div>
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <label for="meta_title" class="col-sm-3 control-label">Meta Title</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title') }}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="meta_keyword" class="col-sm-3 control-label">Meta Keywords</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="meta_keyword" class="form-control" value="{{ old('meta_keyword') }}" placeholder="keyword1, keyword2, keyword3">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="meta_description" class="col-sm-3 control-label">Meta Description</label>
                                            <div class="col-sm-9">
                                                <textarea name="meta_description" class="form-control" rows="3">{{ old('meta_description') }}</textarea>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="canonical" class="col-sm-3 control-label">Canonical URL</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="canonical" class="form-control" value="{{ old('canonical') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="modal-footer">
                                <a href="{{ route('allICO') }}" class="btn btn-default btn-flat"><span class="fa fa-arrow-left"></span> Back</a>
                                <button type="submit" class="btn btn-primary btn-flat"><span class="fa fa-check-circle"></span> Save ICO</button>
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

    $(document).ready(function() {
        // Initialize regular select2
        $('.select2').select2();

        // Initialize select2 with tags mode for dynamic options
        $('.select2-tags').each(function() {
            var $select = $(this);
            $select.select2({
                tags: true,
                allowClear: true,
                placeholder: $select.data('placeholder') || 'Select or type new',
                minimumResultsForSearch: 0,
                createTag: function (params) {
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
        
        $('.summernote').summernote({
            tabsize: 2,
            height: 200
        });

        // Initialize datepickers
        $("#start_date").datepicker({
            autoclose: true,
            format: "dd-mm-yyyy",
            todayHighlight: true,
            orientation: "bottom auto"
        }).on('changeDate', function(e) {
            var minDate = new Date(e.date.valueOf());
            $('#end_date').datepicker('setStartDate', minDate);
        });

        $("#end_date").datepicker({
            autoclose: true,
            format: "dd-mm-yyyy",
            todayHighlight: true,
            orientation: "bottom auto"
        }).on('changeDate', function(e) {
            var maxDate = new Date(e.date.valueOf());
            $('#start_date').datepicker('setEndDate', maxDate);
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
    });
</script>
@endpush

