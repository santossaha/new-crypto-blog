@extends('Backend.main')
@section('content')
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
                                <th>Status</th>
                                <th>Airdrop Status</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th style="width: 80px; text-align: center;"><i class="fa fa-bars"></i> </th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Platform</th>
                                <th>Status</th>
                                <th>Airdrop Status</th>
                                <th>Start Date</th>
                                <th>End Date</th>
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
                    data: 'status',
                    name: 'status'
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
    </script>
@endpush
