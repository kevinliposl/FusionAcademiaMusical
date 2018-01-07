$("#form-courses").change(function () {

    if ($("#form-courses").val() !== "-1") {
        var parameters = {
            "initials": $("#form-courses").val()
        };

        SEMICOLON.widget.notifications($("#wait"));

        $.post("?controller=Course&action=select", parameters, function (data) {
            if (data.initials) {
                $("#form-initials-table").html(data.initials);
                $("#form-name-table").html(data.name);
                $("#form-instrument-table").html(data.instrument);
                $("#form-description-table").html(data.description);
                $("#form-submit").css("display", "block");

                SEMICOLON.widget.notifications($("#success"));
            } else {
                $("#form-initials-table").html("");
                $("#form-name-table").html("");
                $("#form-instrument-table").html("");
                $("#form-description-table").html("");
                $("#form-secondLastName-table").html("");
                $("#form-submit").css("display", "none");

                SEMICOLON.widget.notifications($("#warning"));
            }
        }, "json");
    } else {
        $("#form-initials-table").html("");
        $("#form-name-table").html("");
        $("#form-instrument-table").html("");
        $("#form-description-table").html("");
        $("#form-secondLastName-table").html("");
        $("#form-submit").attr("display", "none");
    }
});

function val() {

    args = {
        "initials": $("#form-initials-table").text().trim(),
        "name": $("#form-name-table").text().trim(),
        "description": $("#form-description-table").text().trim(),
        "instrument": $("#form-instrument-table").text().trim()
    };

    if ($("#form-courses").val() === "-1") {
        SEMICOLON.widget.notifications($("#failed-form-courses"));
        return false;

    } else if (!isNaN(args['name']) || args['name'].length < 4 || args['name'].length > 50) {
        SEMICOLON.widget.notifications($("#failed-name"));
        return false;

    } else if (!isNaN(args['description']) || args['description'].length < 4 || args['description'].length > 100) {
        SEMICOLON.widget.notifications($("#failed-description"));
        return false;

    } else if (!isNaN(args['instrument']) || args['instrument'].length < 2 || args['instrument'].length > 100) {
        SEMICOLON.widget.notifications($("#failed-instrument"));
        return false;
    }
    $('#showModal').click();
    return false;
}

$("#form-submity").click(function () {

    $("#form-submity").attr('disabled', 'disabled');
    $("#form-close").attr('disabled', 'disabled');

    SEMICOLON.widget.notifications($("#wait"));

    $.post("?controller=Course&action=update", args, function (data) {
        if (data.result === "1") {
            SEMICOLON.widget.notifications($("#success"));
            setTimeout("location.href = '?controller=Course&action=update';", 1500);
        } else {
            SEMICOLON.widget.notifications($("#warning"));
            $("#form-submity").removeAttr('disabled');
            $("#form-close").removeAttr('disabled');
        }
    }, "json");
});