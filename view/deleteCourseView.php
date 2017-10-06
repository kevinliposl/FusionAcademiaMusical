<?php
$session = SSession::getInstance();

if (isset($session->email)) {
    //include_once 'public/headerUser.php';
} else {
    include_once 'public/header.php';
}
?>

<!-- Page Title
============================================= -->
<section id="page-title">

    <div class="container clearfix">
        <h1>Eliminar Curso</h1>
    </div>
</section><!-- #page-title end -->

<!-- Content
============================================= -->
<section id="content">
    <div class="content-wrap">
        <div class="container clearfix">
            <div class="accordion-lg divcenter nobottommargin" style="max-width: 550px;">
                <div class="acctitle">
                    <div class="acc_content clearfix">
                        <form class="nobottommargin">
                            <div class="white-section">
                                <label for="form-id">Cursos:</label>
                                <select id="form-courses" class="selectpicker form-control" data-live-search="true">
                                    <option data-tokens="">Cursos Disponibles</option>
                                    <?php foreach ($vars as $var) { ?>
                                        <option value="<?php echo $var["id"] ?>" data-tokens="">
                                            <?php echo $var["Course"]; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <br>
                            <div class="acc_content clearfix"></div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <h5 style="text-align: center;">Informaci&oacute;n del Curso</h5>
                                    <colgroup>
                                        <col class="col-xs-3">
                                        <col class="col-xs-8">
                                    </colgroup>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <code>Siglas</code>
                                            </td>
                                            <td id="form-initials-table"></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <code>Nombre</code>
                                            </td>
                                            <td id="form-name-table"></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <code>Instrumento</code>
                                            </td>
                                            <td id="form-instrument-table"></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <code>Descripci&oacute;n</code>
                                            </td>
                                            <td id="form-description-table"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="col_full nobottommargin">
                                <input type="button" class="button button-3d button-black nomargin" data-toggle="modal" id="delete" data-target="" onclick="" value="Eliminar"/>
                            </div>
                            
                            <div id="message"></div>
                        </form>
                    </div>
                </div>
                
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-body">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel">¡Aviso!</h4>
                                </div>
                                <div class="modal-body">
                                    <h4 style="text-align: center;">¿Realmente desea eliminar el curso seleccionado?</h4>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                    <input type="button" class="btn btn-primary" button-black nomargin id="deleteButton" value="Confirmar"/>
                                    <input type="hidden" id="warning" value="w"/>
                                    <input type="hidden" id="success" value="s"/>
                                    <input type="hidden" id="failed" value="f"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section><!-- #content end -->

<script>
    $("#form-courses").change(function () {
        if ($("#form-courses").val() !== "-1" && $("#form-courses").val() !== "1") {
            var parameters = {
                "id": $("#form-courses").val()
            };
            $.post("?controller=Course&action=selectCourse", parameters, function (data) {
                document.getElementById("form-initials-table").innerHTML = data.initials;
                document.getElementById("form-name-table").innerHTML = data.name;
                document.getElementById("form-instrument-table").innerHTML = data.instrument;
                document.getElementById("form-description-table").innerHTML = data.description;

                $("#success").attr({
                    "data-notify-type": "success",
                    "data-notify-msg": "<i class=icon-ok-sign></i> Operacion Exitosa!",
                    "data-notify-position": "bottom-full-width"
                });
                SEMICOLON.widget.notifications($("#success"));
            }, "json");
        }else{
                document.getElementById("form-initials-table").innerHTML = "";
                document.getElementById("form-name-table").innerHTML = "";
                document.getElementById("form-instrument-table").innerHTML = "";
                document.getElementById("form-description-table").innerHTML = "";
        }
    });


</script>

<script>
    $("#delete").click(function () {
        $('#delete').attr('data-target', '#myModal');
    });
    
    function Redirect() {
        window.location = "?controller=Course&action=defaultDeleteCourse";
    }
    
    $("#deleteButton").click(function () {

        var parameters = {
            "id": $("#form-courses").val()
        };

        $("#message").html("Processing, please wait...");
        $.post("?controller=Course&action=deleteCourse", parameters, function (data) {
            if (data.result === "1") {
                    $("#success").attr({
                        "data-notify-type": "success",
                        "data-notify-msg": "<i class=icon-ok-sign></i> Operacion Exitosa!<br><br> Se redirigir&aacute; en breve..."
                    });
                    SEMICOLON.widget.notifications($("#success"));
                    setTimeout('Redirect()', 2000);
            } else {
                    $("#warning").attr({
                        "data-notify-type": "warning",
                        "data-notify-msg": "<i class=icon-warning-sign></i> El Administrador ya existe en el Sistema!"
                    });
                    SEMICOLON.widget.notifications($("#warning"));
            }
            ;
        }, "json");
    });
</script>


<!-- End Content
============================================= -->    
<?php
include_once 'public/footer.php';