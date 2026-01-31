@extends('Backend.main')
@section('content')
    <style>
        .switch {
            display: inline-block;
            height: 34px;
            position: relative;
            width: 60px;
        }

        .switch input {
            display: none;
        }

        .slider {
            background-color: #ccc;
            bottom: 0;
            cursor: pointer;
            left: 0;
            position: absolute;
            right: 0;
            top: 0;
            transition: .4s;
        }

        .slider:before {
            background-color: #fff;
            bottom: 4px;
            content: "";
            height: 26px;
            left: 4px;
            position: absolute;
            transition: .4s;
            width: 26px;
        }

        input:checked+.slider {
            background-color: #66bb6a;
        }

        input:checked+.slider:before {
            transform: translateX(26px);
        }

        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }
    </style>
    <div class="content-wrapper">

        <!-- Main content -->
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

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">All Drops</h3>
                    <div class="box-tools">
                        <a href="{{ route('addAirdrop') }}" class="btn btn-primary btn-flat" data-title="Add Airdrop">
                            <i class="fa fa-plus-circle"></i> Add
                        </a>
                    </div>

                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="Datatable" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Platform</th>
                                <th>Airdrop Status</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Status</th>

                                <th style="width: 80px; text-align: center;"><i class="fa fa-bars"></i> </th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Platform</th>
                                <th>Airdrop Status</th>
                                <th>Start Date</th>
                                 <th>End Date</th>
                                <th>Status</th>
                                <th style="width: 80px; text-align: center;"><i class="fa fa-bars"></i> </th>
                            </tr>
                        </tfoot>
                    </table>
                </div>

            </div>

        </section>
        <!-- /.content -->
    </div>
@endsection


@push('script')
    <script type="text/javascript">
        $('#Datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('dtableAirdrops') }}',
            columns: [{
                    data: 'image',
                    name: 'image'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'platform',
                    name: 'platform'
                },
                {
                    data: 'airdrop_status',
                    name: 'airdrop_status'
                },
                {
                    data: 'start_date',
                    name: 'start_date'
                },
                {
                    data: 'end_date',
                    name: 'end_date'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ],
            "order": [
                [1, 'asc']
            ],
            "pageLength": {{ AppSetting::getRowsPerPage() }},

        });


        function change_status_action(item_id) {
            var statusUrl = "{{ route('statusAirdrop', ['id' => 0]) }}".replace('0', item_id);
            $.ajax({
                url: statusUrl,
                data: {
                    '_token': "{{ csrf_token() }}"
                },
                type: "get",
                success: function(response) {
                    if (response.success) {
                        toastr.success(response.message || 'Status updated successfully');
                        $('#Datatable').DataTable().ajax.reload();
                    } else {
                        toastr.error(response.message || 'Status not updated');
                    }
                },
                error: function(xhr, status, error) {
                    toastr.error('An error occurred while updating status');
                }
            });
        }
    </script>
@endpush
