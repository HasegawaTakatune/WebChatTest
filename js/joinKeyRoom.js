$(function () {

    $('#submit').click(function () {
        $.ajax({
            type: "POST",
            url: "../model/dbAction.php",
            dataType: "json",
            data: {
                action: $('#action').val(),
                name: $('#input_name').val(),
                key: $('#input_key').val()
            },

            success: function (data) {
                console.log(data);
                if (data['result']) {
                    $('#submit-sign').submit();
                } else {
                    $('#alert').replaceWith('<div class="alert alert-danger" id="alert" role="alert"> ' + data['message'] + ' </div>');
                }
            },

            error: function (data) {
                $('#alert').replaceWith('<div class="alert alert-danger" id="alert" role="alert">System Error</div>');
                console.log(data);
            }
        })
    });

});