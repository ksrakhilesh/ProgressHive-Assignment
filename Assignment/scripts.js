(function($) {
    $('#clear').click(function(){
        $('#successful').addClass("Validator");
        $('#failed').addClass("Validator");
    });
    /* attach a submit handler to the form */
    $("#myForm").submit(function(event) {
        /* stop form from submitting normally */
        event.preventDefault();
        /* get the action attribute from the <form action=""> element */
        var $form = $( this ),
        url = $form.attr( 'action' );
        /* Send the data using post with element id name and name2*/
        var posting = $.post( url, { email: $('#email').val()} );
        /* Alerts the results */
        posting.done(function(data) {
            var success = $('#successful');
            var fail = $('#failed');
            if(data === "false" || data === "empty" || data === "invalid"){
                fail.removeClass("Validator");
                if(!(success.hasClass("Validator"))){
                    success.addClass("Validator");
                }
            }else if(data === "true"){
             success.removeClass("Validator");
             if(!(fail.hasClass("Validator"))){
                 fail.addClass("Validator");
             }
         }else {
            console.log(data);
        }
    });
    });
})(jQuery);
(function ($) {
    function doAjax(){
        var $form = $(this),
        url = $form.attr( 'action' );
        var email = $('#email1').val();
        $.ajax({
            type: "POST",
            url: url,
            data: {email: email},
            success: function(data) {
                if(data === "empty"){
                    $('#email1').parent().removeClass("has-success").removeClass("has-error").removeClass("has-warning");
                    $('#ajaxLabel').html('').removeClass('label-success').removeClass('label-danger');
                }
                if(data === "notValid"){
                    $('#email1').parent().removeClass("has-success").removeClass("has-error").addClass("has-warning");
                    $('#ajaxLabel').html('').removeClass('label-success').removeClass('label-danger');
                }else if(data === "true"){
                    $('#ajaxLabel').html('Valid Email Id').addClass('label-success').removeClass('label-danger');
                    $('#email1').parent().removeClass("has-warning").removeClass("has-error").addClass("has-success");
                }else if(data === "false"){
                    $('#email1').parent().removeClass("has-warning").removeClass("has-success").addClass("has-error");
                    $('#ajaxLabel').html('Email Id does not exist').addClass('label-danger').removeClass('label-success');
                }else{
                    console.log('.');
                }
            }
        });
    }
    $("#ajaxForm").keyup(function(event) {
        /* stop form from submitting normally */
        event.preventDefault();
        /* get the action attribute from the <form action=""> element */
        doAjax();

    });
})(jQuery);


