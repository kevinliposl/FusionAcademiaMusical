/* global SEMICOLON */

function val() {
    args = {
        "id": $("#form-id").val().trim(),
        "email": $("#form-email").val().trim(),
        "name": $("#form-name").val().trim(),
        "firstLastName": $("#form-firstLastName").val().trim(),
        "secondLastName": $("#form-secondLastName").val().trim()
    };

    if (!/\w+@\w+\.+[a-z]/.test(args['email'])) {
        SEMICOLON.widget.notifications($("#failed-email"));
        return false;

    } else if (isNaN(args['id']) || args['id'].length < 9) {
        SEMICOLON.widget.notifications($("#failed-id"));
        return false;

    } else if (args['name'].length < 4) {
        SEMICOLON.widget.notifications($("#failed-name"));
        return false;

    } else if (args['firstLastName'].length < 4) {
        SEMICOLON.widget.notifications($("#failed-firstLastName"));
        return false;

    } else if (args['secondLastName'].length < 4) {
        SEMICOLON.widget.notifications($("#failed-secondLastName"));
        return false;
    }
    $('#showModal').click();
    return false;
}

$("#form-submity").click(function () {
    $("#form-submity").attr('disabled', 'disabled');
    $("#form-close").attr('disabled', 'disabled');

    SEMICOLON.widget.notifications($("#wait"));

    $.ajax({
        data: args,
        type: "POST",
        dataType: "json",
        url: "?controller=Admin&action=insert",
        beforeSend: function () {
            $("#form-submity").attr('disabled', 'disabled');
            $("#form-close").attr('disabled', 'disabled');
            SEMICOLON.widget.notifications($("#wait"));
        }
    }).done(function (data) {
        if (data.result === "1") {
            SEMICOLON.widget.notifications($("#success"));
            setTimeout("location.href='?controller=Admin&action=insert';", 1500);
        } else if (data.result === "0") {
            SEMICOLON.widget.notifications($("#warning"));
            $("#form-submity").removeAttr('disabled');
            $("#form-close").removeAttr('disabled');
        } else {
            SEMICOLON.widget.notifications($("#alert"));
            alert(data.err);
            setTimeout("location.href='?controller=Admin&action=insert';", 2000);
        }
    }).fail(function () {
        $("#form-submity").removeAttr('disabled');
        $("#form-close").removeAttr('disabled');
        SEMICOLON.widget.notifications($('#warning'));
    });
});