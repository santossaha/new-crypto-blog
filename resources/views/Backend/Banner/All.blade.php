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
                display:none;
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
            input:checked + .slider {
                background-color: #66bb6a;
            }
            input:checked + .slider:before {
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
                    <h3 class="box-title">All Banner</h3>

                    <div class="box-tools">
                        <a href="javascript:void(0);" class="btn btn-primary btn-flat" data-act="ajax-modal" data-title="Add Banner" data-append-id="AjaxModelContent" data-action-url="{{route("addBanner")}}">
                            <i class="fa fa-plus-circle"></i> Add
                        </a>
                    </div>

                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table id="Datatable" class="table table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Status</th>

                            <th style="width: 80px; text-align: center;"><i class="fa fa-bars"></i> </th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Title</th>
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
        function myFunction(){
            alert('ok');
        }
        $('#Datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{route('allBannerDatatable')}}',
            columns: [
                {data: 'id', name: 'id', visible : false},
                {data: 'image', name: 'image'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ],
            'columnDefs': [
                {
                    'targets': -2,
                    'defaultContent': '-',
                    'searchable': false,
                    'orderable': false,
                    'width': '10%',
                    'className': 'dt-body-center',
                    'render': function (data, type, full_row, meta){
                        if(full_row.status === "{{ $statuses['active'] }}" || full_row.status === "{{ $statuses['Inactive'] }}"){
                            return '<div style="display: block">' +
                                '<label class="switch"> <input onchange="change_status_action(this.getAttribute(\'data-id\'))" id="checkbox" data-id="' + full_row.id + '" type="checkbox" ' + (full_row.status === "{{ $statuses['active'] }}" ? "checked" : "") + ' /> <div class="slider round"> </div> </label>' +
                                '</div>';
                        } else {
                            return '<div style="display: block">' +
                                '<span>' + full_row.status + '</span>' +
                                '</div>';
                        }
                    }
                },

            ],
            "order": [[0,'desc']],
            "pageLength": {{AppSetting::getRowsPerPage()}},
            "drawCallback": function( settings ) {
                $('.magnific-image').magnificPopup({type: 'image'});
            }
        });


        function change_status_action(item_id){
            $.ajax({
                url: "{{--{{ route('statusBanner', ['id' => '']) }}--}}" + item_id,
                data: {
                    '_token': "{{ csrf_token() }}"
                },
                type: "get",
                success: function (response) {
                    if(response.success){
                        toastr.success('status updated successfully');
                    }else{
                        toastr.error('status not updated');
                    }
                }
            });
        }
    </script>
@endpush

