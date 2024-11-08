$(document).ready(function () {
    var CurrentURL = window.location.href.split('?')[0];
    $('.select2').select2();
    $('.sidebar-menu').tree();

    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' /* optional */
        });
    });
    jQuery("#validation").validationEngine({promptPosition: 'inline'});
    jQuery("#validation2").validationEngine({promptPosition: 'inline'});
    jQuery(".validation").validationEngine({promptPosition: 'inline'});

    $('[data-toggle="tooltip"]').tooltip();

    $("body").on("click", "a[data-confirm], button[data-confirm]", function (ev) {
        var href = $(this).attr('href');
        if (!$('#dataConfirmModal').length) {
            $('body').append('<div id="dataConfirmModal" class="modal" role="dialog" aria-labelledby="dataConfirmLabel" aria-hidden="true"><div class="modal-dialog" style="width: 50%;"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button><h3 id="dataConfirmLabel">Please Confirm</h3></div><div class="modal-body"></div><div class="modal-footer"><button class="btn btn-flat" data-dismiss="modal" aria-hidden="true"><i class="fa fa-close"></i> Cancel</button><a class="btn btn-primary btn-flat" id="dataConfirmOK"><i class="fa fa-check-circle"></i> OK</a></div></div></div></div>');
        }
        $('#dataConfirmModal').find('.modal-body').html($(this).attr('data-confirm'));
        $('#dataConfirmOK').attr('href', href);
        $('#dataConfirmModal').modal({show:true});
        return false;
    });

    //Header Search bar  select option
    $('.search-panel .dropdown-menu').find('a').click(function(e) {
        e.preventDefault();
        var param = $(this).attr("href").replace("#","");
        var concept = $(this).text();
        $('.search-panel span#search_concept').text(concept);
        $('.input-group #search_param').val(param);
    });

    //Sidebar Menu Active
    $.each($('.sidebar-menu li a'), function(index, value) {
        if($(this).attr('href')==CurrentURL){
            $(this).parent('li').addClass('active');
            $(this).parent().parent('ul').show();
            $(this).parent().parent().parent('li').addClass('menu-open');
        }
    });


    //Setting Sidebar Menu Active
    $.each($('.settingSidebar li a'), function(index, value) {
        if($(this).attr('href')==CurrentURL){
            $(this).parent('li').addClass('active');
        }
    });

    //Setting Profile Tab Active
    $.each($('.profile-tab .nav-tabs li a'), function(index, value) {
        if($(this).attr('href')==CurrentURL){
            $(this).parent('li').addClass('active');
        }
    });

    //Tab Menu Active
    $.each($('.CustomTab .nav-tabs li a'), function(index, value) {
        if($(this).attr('href')==CurrentURL){
            $(this).parent('li').addClass('active');
        }
    });

    $('.datepicker').datepicker({
        autoclose: true,
        format: "yyyy-mm-dd"
    });

    //magnific-popup image
    $('.magnific-image').magnificPopup({type: 'image'});

    //Ajax Load Content
    var FailedFetchHtmlModel = '<div class="modal-body"><div class="callout callout-danger"><p><i class="fa fa-times"></i> Failed to fetch the data</p></div></div><div class="modal-footer"><button type="button" class="btn btn-default" data-dismiss="modal"><span class="fa fa-close"></span> Close</button></div>';
    $("body").on("click", "[data-act=ajax-modal]", function () {
        var url = $(this).attr("data-action-url");
        var title = $(this).attr("data-title");
        var appendID = $(this).attr("data-append-id");

        var loaderHtml = '<div class="modal-body shop text-center"><img src="'+settings.LoaderGif+'"></div>';
        $('#'+appendID).html(loaderHtml);

        $('#AjaxModelTitle').html(title);
        $('#AjaxModel').modal({
            backdrop: 'static'
        });
        $.ajax
        ({
            type: "GET",
            url: url,
            data: '',
            success: function(data)
            {
                $('#'+appendID).html(data);
            },
            error: function() {
                $('#'+appendID).html(FailedFetchHtmlModel);
            }
        });
    });


    //Append State At Select Country
    $(document).on('change', '#Country', function() {
        $('#State').html('<option value=""></option>');
       var CountryID = $('#Country').val();
        $.get( settings.countryWiseStateListURL+"/"+CountryID, function( data ) {
            var GetData = $.parseJSON(data);
            $.each(GetData, function(index, element) {
                $('#State').append('<option value="'+element.id+'">'+element.name+'</option>');
            });
        });
        $('.select2').select2();
    });


});

function alert(Msg='',Title='Alert'){
    if (!$('#alertModal').length) {
        $('body').append('<div id="alertModal" class="modal" role="dialog" aria-labelledby="dataConfirmLabel" aria-hidden="true"><div class="modal-dialog" style="width: 50%;"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button><h3 id="dataConfirmLabel"></h3></div><div class="modal-body"></div><div class="modal-footer"><button class="btn btn-primary btn-flat" data-dismiss="modal" aria-hidden="true"><i class="fa fa-check-circle"></i> OK</button></div></div></div></div>');
    }
    $('#alertModal').find('#dataConfirmLabel').html(Title);
    $('#alertModal').find('.modal-body').html(Msg);
    $('#alertModal').modal({show:true});
    return false;
}


//toaster popup message
toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": false,
    "progressBar": true,
    "positionClass": "toast-bottom-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
};



//Browser idle session logout
(function ($) {
    var session = {
            //Logout Settings
            inactiveTimeout: 900000,     //15 Min            inactivity  (ms) The time until we display a warning message
            warningTimeout: 120000,      //2 Min            (ms) The time until we log them out
            minWarning: 5000,           //(ms) If they come back to page (on mobile), The minumum amount, before we just log them out
            warningStart: null,         //Date time the warning was started
            warningTimer: null,         //Timer running every second to countdown to logout
            logout: function () {       //Logout function once warningTimeout has expired
                window.location = settings.lockedURL+'?next='+window.location.href;
                //$("#mdlLoggedOut").modal("show");
            },
            //Keepalive Settings
            keepaliveTimer: null,
            keepaliveUrl: settings.idleCheckURL,
            keepaliveInterval: 5000,     //(ms) the interval to call said url
            keepAlive: function () {
                $.ajax({ url: session.keepaliveUrl });
            }
        };
    $(document).on("idle.idleTimer", function (event, elem, obj) {
        //Get time when user was last active
        var  diff = (+new Date()) - obj.lastActive - obj.timeout,
            warning = (+new Date()) - diff;

        //On mobile js is paused, so see if this was triggered while we were sleeping
        if (diff >= session.warningTimeout || warning <= session.minWarning) {
            $("#mdlLoggedOut").modal("show");
        } else {
            //Show dialog, and note the time
            $('#sessionSecondsRemaining').html(Math.round((session.warningTimeout - diff) / 1000));
            $("#myModal").modal("show");
            session.warningStart = (+new Date()) - diff;

            //Update counter downer every second
            session.warningTimer = setInterval(function () {
                var remaining = Math.round((session.warningTimeout / 1000) - (((+new Date()) - session.warningStart) / 1000));
                if (remaining >= 0) {
                    $('#sessionSecondsRemaining').html(remaining);
                } else {
                    session.logout();
                }
            }, 1000)
        }
    });

    // create a timer to keep server session alive, independent of idle timer
    session.keepaliveTimer = setInterval(function () {
        session.keepAlive();
    }, session.keepaliveInterval);

    //User clicked ok to extend session
    $("#extendSession").click(function () {
        clearTimeout(session.warningTimer);
    });
    //User clicked logout
    $("#logoutSession").click(function () {
        session.logout();
    });

    //Set up the timer, if inactive for 10 seconds log them out
    $(document).idleTimer(session.inactiveTimeout);
})(jQuery);


/* Use this script to generate multiple upload box. you can check from add doctor panel
   ------------------------------------------------------------------------------------
$(".imgAdd").click(function(){
    $(this).closest(".row").find('.imgAdd').before('<div class="col-sm-4 imgUp"><div class="imagePreview"></div><label class="btn btn-default btn-sm btn-flat">Upload<input type="file" class="uploadFile img" value="" style="width:0px;height:0px;overflow:hidden;"></label><i class="fa fa-times del"></i></div>');
});
*/
$(document).on("click", "i.del" , function() {
    $(this).parent().remove();
});
$(function() {
    $(document).on("change",".uploadFile", function()
    {
        var uploadFile = $(this);
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support

        if (/^image/.test( files[0].type)){ // only image file
            var reader = new FileReader(); // instance of the FileReader
            reader.readAsDataURL(files[0]); // read the local file

            reader.onloadend = function(){ // set image data as background of div
                //alert(uploadFile.closest(".upimage").find('.imagePreview').length);
                uploadFile.closest(".imgUp").find('.imagePreview').css("background-image", "url("+this.result+")");
            }
        }

    });
});