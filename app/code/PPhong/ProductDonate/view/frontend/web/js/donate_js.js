define(["jquery", "domReady!","donate_js"], function($,dom,donate_js){

    $(document).on('click', '#donate-btn', function(e){
        var ajxurl = $('#donateForm').attr('action');
        var formdata = new FormData(jQuery('#donateForm')[0]);
        $.ajax({
            url: ajxurl,
            type: "POST",
            cache: false,
            contentType: false,
            processData: false,
            data: formdata,
            showLoader: true,
            success: function(data){
                location.reload();
                //alert("Save");
            }
        });
        e.preventDefault();
    });

})