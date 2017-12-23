<?php
include_once 'public/headerAdmin.php';
?>

<!-- Page Title
    ============================================= -->
<section id="page-title">

    <div class="container clearfix">
        <h1>Reactivar Usuario</h1>
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
                        <form id="form" class="nobottommargin">
                            <div class="white-section">
                                <label for="form-student">Estudiantes:</label>
                                <select id="form-student" class="selectpicker form-control" data-live-search="true">
                                    <option value="-1" data-tokens="">Seleccione un Estudiante</option>
                                    <?php foreach ($vars as $var) { ?>
                                        <option value="<?php echo $var["identification"] . ';' . $var["tipo"]; ?>" data-tokens="">
                                            <?php echo $var["identification"] . " | " . $var["name"] . " " . $var["first_lastname"] . " " . $var["second_lastname"] . " | " . (($var["tipo"] === 'S') ? 'Estudiante' : (($var["tipo"] === 'T') ? 'Profesor' : 'Administrador')); ?></option>
                                    <?php }
                                    ?>
                                </select>
                            </div>
                            <div class="acc_content clearfix"></div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <h5 style="text-align: center;">Informaci&oacute;n del Estudiante</h5>
                                    <colgroup>
                                        <col class="col-xs-3">
                                        <col class="col-xs-8">
                                    </colgroup>
                                    <tbody>
                                        <tr>
                                            <td>Identificaci&oacute;n</td>
                                            <td id="form-id-table"></td>
                                        </tr>
                                        <tr>
                                            <td>Nombre</td>
                                            <td id="form-name-table"></td>
                                        </tr>
                                        <tr>
                                            <td>Apellidos</td>
                                            <td id="form-lastName-table"></td>
                                        </tr>
                                        <tr>
                                            <td>Tel&eacute;fonos</td>
                                            <td id="form-phones-table"></td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td id="form-email-table"></td>
                                        </tr>
                                        <tr>
                                            <td>Rango</td>
                                            <td id="form-rango"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <a id="form-submit" data-toggle="modal" class="button button-3d button-black nomargin" data-target="#myModal" id="next" data-target="" style="display: none; text-align: center;">Reactivar</a>
                            <input type="hidden" id="warning" data-notify-type="warning" data-notify-msg="<i class='icon-warning-sign'></i> El Estudiante no se pudo activar!" data-notify-position="bottom-full-width"/>
                            <input type="hidden" id="success" data-notify-type="success" data-notify-msg="<i class='icon-ok-sign'></i> Operacion Exitosa!" data-notify-position="bottom-full-width"/>
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
                                    <h4 style="text-align: center;">¿Realmente desea reactivar este Estudiante?</h4>
                                    <p>Consejos:
                                    <li>Verificar bien, si es el estudiante que realmente desea reactivar</li>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                    <input type="button" class="btn btn-primary" button-black nomargin id="form-submity" value="Reactivar"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section><!-- #content end -->
<script>
    $("#form-student").change(function () {
        if ($("#form-student").val() !== "-1") {
            var value = $("#form-student").val();
            var values = value.split(";");
            var parameters = {
                "id": values[0],
                "tipo": values[1]
            };
            $.post("?controller=Student&action=selectDeleteStudent", parameters, function (data) {
                if (data.identification) {
                    document.getElementById("form-id-table").innerHTML = data.identification;
                    document.getElementById("form-name-table").innerHTML = data.name;
                    document.getElementById("form-lastName-table").innerHTML = data.first_lastname + " " + data.second_lastname;
                    document.getElementById("form-phones-table").innerHTML = data.phoneOne + ", " + data.phoneTwo;
                    document.getElementById("form-email-table").innerHTML = data.email;
                    document.getElementById("form-rango").innerHTML = data.tipo;
                    document.getElementById("form-submit").style.display = "block";
                    SEMICOLON.widget.notifications($("#success"));
                } else {
                    SEMICOLON.widget.notifications($("#warning"));
                }
            }, "json");
        } else {
            document.getElementById("form-submit").style.display = "none";
        }
    });</script>

<script>

    function Redirect() {
        window.location = "?controller=Student&action=reactivateStudent";
    }

    $("#form-submity").click(function () {
        var value = $("#form-student").val();
        var values = value.split(";");
        var parameters = {
            "id": values[0],
            "tipo": values[1]
        };
        $.post("?controller=Student&action=reactivateStudent", parameters, function (data) {
            if (data.result === "1") {
                SEMICOLON.widget.notifications($("#success"));
                setTimeout('Redirect()', 1000);
            } else {
                SEMICOLON.widget.notifications($("#warning"));
            }
            ;
        }, "json");
    }
    );
</script>

<!-- End Content
    ============================================= -->    
<?php
include_once 'public/footer.php';


