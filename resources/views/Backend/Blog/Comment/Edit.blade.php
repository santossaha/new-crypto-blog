<form id="validation2" action="#" class="form-horizontal">
    {{csrf_field()}}
    <div class="modal-body clearfix">
        <div class="form-group">
            <label for="title" class="col-sm-3 control-label">Name</label>
            <div class="col-sm-9">
                <input type="text" name="name" class="form-control" value="{{$records->name}}" readonly>
            </div>
        </div>
        <div class="form-group">
            <label for="title" class="col-sm-3 control-label">Email</label>
            <div class="col-sm-9">
                <input type="text" name="name" class="form-control" value="{{$records->email}}" readonly>
            </div>
        </div>
        <div class="form-group">
            <label for="title" class="col-sm-3 control-label">Name</label>
            <div class="col-sm-9">
                <input type="text" name="name" class="form-control" value="{{$records->number}}" readonly>
            </div>
        </div>
        <div class="form-group">
            <label for="title" class="col-sm-3 control-label">Website</label>
            <div class="col-sm-9">
                <input type="text" name="name" class="form-control" value="{{$records->website}}" readonly>
            </div>
        </div>
        <div class="form-group">
            <label for="title" class="col-sm-3 control-label">Comments</label>
            <div class="col-sm-9">
                <textarea type="text" name="name" class="form-control" readonly>{{$records->comment}}</textarea>
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

