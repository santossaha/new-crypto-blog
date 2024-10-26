<form id="validation2" action="{{route('saveAddsImage')}}" class="form-horizontal" method="post" enctype="multipart/form-data">
    {{csrf_field()}}
    <div class="modal-body clearfix">




        <div class="form-group">
            <label for="title" class="col-sm-3 control-label">Image<span class="requiredAsterisk">*</span></label>
            <div class="col-sm-9">
                <input type="file" name="image" id="image"  class="validate[required] form-control">
                <img width="80px" height="80px" id="blah">

            </div>
        </div>


        <div class="form-group">
            <label for="title" class="col-sm-3 control-label">Expire Date<span class="requiredAsterisk">*</span></label>
            <div class="col-sm-9">
                <input type="date" name="expire_date" id="expire_date"  class="validate[required] form-control">
            

            </div>
        </div>

    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal"><span class="fa fa-close"></span> Close</button>
        <button type="submit" class="btn btn-primary btn-flat"><span class="fa fa-check-circle"></span> Save</button>

    </div>
</form>

<script type="text/javascript">
    jQuery("#validation2").validationEngine({promptPosition: 'inline'});

    $('#select2').select2();

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#image").change(function(){
        readURL(this);
    });
</script>


