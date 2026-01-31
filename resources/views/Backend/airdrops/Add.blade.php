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
                        <h3 class="box-title">Add Airdrop</h3>
                    </div>

                    <form id="validation2" action="{{route('saveAirdrop')}}" class="form-horizontal" enctype="multipart/form-data" method="post">
                        {{csrf_field()}}
                        <div class="modal-body clearfix" style="max-height: 80vh; overflow-y: auto;">

                            <!-- Basic Info -->
                            <h4 class="text-primary">Basic Information</h4>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Name <span class="requiredAsterisk">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" name="name" class="validate[required] form-control" placeholder="e.g. Barin ($BARIN)">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Start Date</label>
                                <div class="col-sm-9">
                                    <input type="text" name="start_date" class="form-control datepicker" placeholder="DD-MM-YYYY">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">End Date</label>
                                <div class="col-sm-9">
                                    <input type="text" name="end_date" class="form-control datepicker" placeholder="DD-MM-YYYY">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Image (Logo) <span class="requiredAsterisk">*</span></label>
                                <div class="col-sm-9">
                                    <small>Max: 2MB (jpeg, jpg, png, gif, svg)</small>
                                    <input type="file" name="image" class="validate[required] form-control">
                                </div>
                            </div>

                            <!-- Platform & Winners -->
                            <h4 class="text-primary">Airdrop Details</h4>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Airdrop Platform</label>
                                <div class="col-sm-9">
                                    <input type="text" name="platform" class="form-control" placeholder="e.g. Zealy, Galxe">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Participate Link</label>
                                <div class="col-sm-9">
                                    <input type="url" name="participate_link" class="form-control" placeholder="https://...">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">No. of Winners</label>
                                <div class="col-sm-9">
                                    <input type="number" name="winner_count" class="form-control" min="0">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Winner Announcement</label>
                                <div class="col-sm-9">
                                    <input type="text" name="winner_announcement_date" class="form-control datepicker" placeholder="DD-MM-YYYY">
                                </div>
                            </div>

                            <!-- Tokenomics -->
                            <h4 class="text-primary">Tokenomics</h4>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Total Token Supply</label>
                                <div class="col-sm-9">
                                    <input type="number" step="any" name="total_supply" class="form-control" placeholder="0.00">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Total Airdrop Qty</label>
                                <div class="col-sm-9">
                                    <input type="number" step="any" name="total_airdrop_qty" class="form-control" placeholder="0.00">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Supply Percentage (%)</label>
                                <div class="col-sm-9">
                                    <input type="number" step="0.01" name="supply_percentage" class="form-control" placeholder="Auto-calculated if left empty">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Airdrop Value (USD)</label>
                                <div class="col-sm-9">
                                    <input type="number" step="0.01" name="airdrop_value" class="form-control" placeholder="0.00">
                                </div>
                            </div>

                            <!-- Categories -->
                            <h4 class="text-primary">Categorization</h4>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Project Category</label>
                                <div class="col-sm-9">
                                    <!-- Using select2 setup from ICO -->
                                    <select name="project_category" class="form-control select2 tags" style="width: 100%;">
                                        <option value="">Select or Type New</option>
                                        @foreach($categories as $cat)
                                            <option value="{{ $cat }}">{{ $cat }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Blockchain Network</label>
                                <div class="col-sm-9">
                                    <select name="blockchain_network" class="form-control select2 tags" style="width: 100%;">
                                        <option value="">Select or Type New</option>
                                        @foreach($networks as $net)
                                            <option value="{{ $net }}">{{ $net }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Descriptions -->
                            <h4 class="text-primary">Descriptions</h4>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">About Airdrop</label>
                                <div class="col-sm-9">
                                    <textarea name="description" class="form-control summernote" rows="5"></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">How To Participate</label>
                                <div class="col-sm-9">
                                    <textarea name="how_to_participate" class="form-control summernote" rows="5"></textarea>
                                </div>
                            </div>

                            <!-- Social Links -->
                            <h4 class="text-primary">Social / Links</h4>

                            @php
                                $socials = [
                                    'website_url' => 'Website URL',
                                    'whitepaper_url' => 'Whitepaper URL',
                                    'twitter_url' => 'Twitter URL',
                                    'telegram_url' => 'Telegram URL',
                                    'discord_url' => 'Discord URL'
                                ];
                            @endphp

                            @foreach($socials as $field => $label)
                            <div class="form-group">
                                <label class="col-sm-3 control-label">{{ $label }}</label>
                                <div class="col-sm-9">
                                    <input type="url" name="{{ $field }}" class="form-control">
                                </div>
                            </div>
                            @endforeach

                            <!-- SEO -->
                            <h4 class="text-primary">SEO / Status</h4>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Meta Title</label>
                                <div class="col-sm-9">
                                    <input type="text" name="meta_title" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Meta Description</label>
                                <div class="col-sm-9">
                                    <textarea name="meta_description" class="form-control" rows="3"></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Status</label>
                                <div class="col-sm-9">
                                    <select name="status" class="form-control">
                                        <option value="Active" selected>Active</option>
                                        <option value="Inactive">Inactive</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Airdrop Status</label>
                                <div class="col-sm-9">
                                    <select name="airdrop_status" class="form-control">
                                        <option value="Upcoming" selected>Upcoming</option>
                                        <option value="Ongoing">Ongoing</option>
                                        <option value="Ended">Ended</option>
                                    </select>
                                </div>
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default btn-flat" onclick="history.back()"><span class="fa fa-close"></span> Cancel</button>
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
</script>
@endpush
