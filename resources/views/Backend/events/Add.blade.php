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

<form id="validation2" action="{{route('saveEvent')}}" class="form-horizontal" enctype="multipart/form-data" method="post">
    {{csrf_field()}}
    <div class="modal-body clearfix"  style="max-height: 600px; overflow-y: auto;">
       
        <div class="form-group">
            <label for="title" class="col-sm-3 control-label">Title<span class="requiredAsterisk">*</span></label>
            <div class="col-sm-9">
                <input type="text" name="title" class="validate[required] form-control" >
            </div>
        </div>
      
        <div class="form-group">
            <label for="title" class="col-sm-3 control-label">Start Date<span class="requiredAsterisk">*</span></label>
            <div class="col-sm-9">
                <input type="text" name="start_date" class="validate[required] form-control datepicker" id="start_date">
            </div>
        </div>
        <div class="form-group">
            <label for="title" class="col-sm-3 control-label">End Date<span class="requiredAsterisk">*</span></label>
            <div class="col-sm-9">
                <input type="text" name="end_date" class="validate[required] form-control datepicker" id="end_date" >
            </div>
        </div>

        <div class="form-group">
            <label for="title" class="col-sm-3 control-label"> Location<span class="requiredAsterisk">*</span></label>
            <div class="col-sm-9">
                <input type="text" name="location" class="validate[required] form-control" >
            </div>
        </div>

       
        <div class="form-group">
            <label for="title" class="col-sm-3 control-label">Image</label>
            <div class="col-sm-9">
                <small>Mix File size 2MB</small>, <small >File accept Only (jpeg,jpg png,gif,svg)</small>
                <input type="file" name="image" id="image"  class="validate[required]] form-control" >
            </div>
        </div>

        <div class="form-group">
            <label for="title" class="col-sm-3 control-label"> Description</label>
            <div class="col-sm-9">
                <textarea  name="description" class="form-control summernote" rows="5" ></textarea>
            </div>
        </div>

        <div class="form-group">
            <label for="title" class="col-sm-3 control-label">Meta Title<span class="requiredAsterisk">*</span></label>
            <div class="col-sm-9">
                <input type="text" name="meta_title" class="validate[required] form-control" value="" >
            </div>
        </div>

        <div class="form-group">
            <label for="title" class="col-sm-3 control-label">Meta Keyword<span class="requiredAsterisk">*</span></label>
            <div class="col-sm-9">
                <input type="text" name="meta_keyword" class="validate[required] form-control" >
            </div>
        </div>
        <div class="form-group">
            <label for="title" class="col-sm-3 control-label">Meta Description</label>
            <div class="col-sm-9">
                <textarea  name="meta_description" class="form-control" rows="5" ></textarea>
            </div>
        </div>
       
        <div class="form-group">
            <label for="title" class="col-sm-3 control-label">Canonical <span class="requiredAsterisk">*</span></label>
            <div class="col-sm-9">
                <input type="text" name="canonical" class="validate[required] form-control" >
            </div>
        </div>

    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal"><span class="fa fa-close"></span> Close</button>
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

    $(document).ready(function() {
   
     
        $('.summernote').summernote({
            tabsize: 2,
            height: 200
        });

        $('.datepicker').datepicker({
        autoclose: true,
        // format: "yyyy-mm-dd",
        format: "mm-dd-yyyy"
      
    })



    $("#start_date").datepicker({
            autoclose: true,
            format: "yyyy-mm-dd"
        }).on('changeDate', function (selected) {
            var minDate = new Date(selected.date.valueOf());
            $('#end_date').datepicker('setStartDate', minDate);
            setdate();
        });

        $("#end_date").datepicker({
            autoclose: true,
            format: "yyyy-mm-dd"
        }).on('changeDate', function (selected) {
            var maxDate = new Date(selected.date.valueOf());
            $('#fromDate').datepicker('setEndDate', maxDate);
        });

    });

   
</script>
<script type="text/javascript">
jQuery("#validation2").validationEngine({promptPosition: 'inline'});




</script>

@endpush


