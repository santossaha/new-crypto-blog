<form id="validation2" action="#" class="form-horizontal" enctype="multipart/form-data" method="post">
    {{csrf_field()}}
    <div class="modal-body clearfix">

        <div class="form-group">
            <label for="title" class="col-sm-3 control-label">Name</label>
            <div class="col-sm-9">
                <input type="text" name="title" class=" form-control" value="{{$records->name}}" readonly>
            </div>
        </div>
        <div class="form-group">
            <label for="title" class="col-sm-3 control-label">Email</label>
            <div class="col-sm-9">
                <input type="text" name="email" class=" form-control" value="{{$records->email}}" readonly>
            </div>
        </div>
        <div class="form-group">
            <label for="title" class="col-sm-3 control-label">Subject</label>
            <div class="col-sm-9">
                <input type="text" name="subject" class=" form-control" value="{{$records->subject}}" readonly>
            </div>
        </div>
        <div class="form-group">
            <label for="title" class="col-sm-3 control-label">Text</label>
            <div class="col-sm-9">
                <textarea type="text" name="content" class="form-control" rows="3" >{!! $records->text !!}</textarea>
            </div>
        </div>

    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal"><span class="fa fa-close"></span> Close</button>

    </div>
</form>

<script type="text/javascript">
    jQuery("#validation2").validationEngine({promptPosition: 'inline'});
    $('.select2').select2();

</script>

