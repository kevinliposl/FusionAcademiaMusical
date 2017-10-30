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
        <h1>Insertar Asignaciones de Cursos a Semestres</h1>
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
                                <label for="form-semester">Semestres:</label>
                                <select id="form-semester" class="selectpicker form-control" data-live-search="true">
                                    <option data-tokens="">Seleccione un Semestre</option>
                                    <?php
                                    foreach ($vars as $var) {
                                        if (isset($var["ID"])) {
                                            ?>
                                            <option value="<?php echo $var["ID"] ?> " data-tokens="">
                                                <?php
                                                        if($var["semester"]=='1'){
                                                            echo "I semestre"." ".$var["year"];
                                                        }else{
                                                            echo "II semestre"." ".$var["year"];
                                                        }
                                                ?>
                                            </option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <br>
                            <div class="white-section">
                                <label for="form-initials">Prueba:</label>
                                <select id="prueba" class="form-control selectpicker" data-live-search="true">
                                    <option value="-1" data-tokens="">Seleccione un Curso</option>
                                </select>
                            </div>
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
                                            <td id="form-initials-table"><?php echo "" ?></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <code>Nombre</code>
                                            </td>
                                            <td id="form-name-table"><?php echo "" ?></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <code>Instrumento</code>
                                            </td>
                                            <td id="form-instrument-table"><?php echo "" ?></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <code>Descripci&oacute;n</code>
                                            </td>
                                            <td id="form-description-table"><?php echo "" ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col_full nobottommargin">
                                <a id="form-submit" data-toggle="modal" class="button button-3d button-black nomargin" style="display : block; text-align: center;" data-target="#myModal">Eliminar</a>
                                <!--<input type="submit" value="Eliminar" class="button button-3d button-black nomargin form-control" style="display: block; text-align: center;"/>-->
                                <input type="hidden" id="warning" value="w"/>
                                <input type="hidden" id="success" value="s"/>
                                <input type="hidden" id="failed" value="f"/>
                            </div>                     
                        </form>
                    </div>
                </div>
            </div>
        </div>
</section><!-- #content end -->

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-body">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">¡Aviso!</h4>
                </div>
                <div class="modal-body">
                    <h4 style="text-align: center;">¿Realmente desea eliminar este Curso?</h4>
                    <p>Consejos:
                    <li>Verificar bien, si es el Curso que realmente desea eliminar</li>
                    <li>El Curso puede ser restaurado con servicio t&eacute;cnico</li></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <input type="button" class="btn btn-primary button-black nomargin" id="form-submity" value="Eliminar"/>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    //Change Combobox
    $("#form-courses").change(function () {
        var parameters = {
            "initials": $("#form-courses").val()
        };

//        $.post("?controller=Course&action=select", parameters, function (data) {
//            if (data.initials) {
//                $("#form-initials-table").html(data.initials);
//                $("#form-name-table").html(data.name);
//                $("#form-instrument-table").html(data.instrument);
//                $("#form-description-table").html(data.description);
//
//                $("#success").attr({
//                    "data-notify-type": "success",
//                    "data-notify-msg": "<i class=icon-ok-sign></i> Operacion Exitosa!",
//                    "data-notify-position": "bottom-full-width"
//                });
//                SEMICOLON.widget.notifications($("#success"));
//            } else {
//                $("#form-initials-table").html("");
//                $("#form-name-table").html("");
//                $("#form-instrument-table").html("");
//                $("#form-description-table").html("");
//                $("#form-secondLastName-table").html("");
//
//            }
//        }, "json");

        $.post("?controller=Course&action=selectAll", parameters, function (data) {
            for (var i = 0; i < data.length; i++) {
                $('#prueba').append($("<option></option>").attr("value", data[i].initials).text(data[i].initials));//AGREGAR OPCIONES
            }
            $("#prueba").selectpicker("refresh");///REFRESCA SELECT PARA QUE AGARRE AGREGADOS
        }, "json");
    });

    //Open Modal
    $("#form-submit").click(function () {
        $('#form-submit').attr('data-target', '#myModal');
    });

    //Delete 
    $("#form-submity").click(function () {
        var parameters = {
            "initials": $("#form-courses").val()
        };
        $.post("?controller=Course&action=delete", parameters, function (data) {
            if (data.result === "1") {
                $("#success").attr({
                    "data-notify-type": "success",
                    "data-notify-msg": "<i class=icon-ok-sign></i> Operacion Exitosa!",
                    "data-notify-position": "bottom-full-width"
                });
                SEMICOLON.widget.notifications($("#success"));
                location.href = "?controller=Course&action=delete";
            } else {
                $("#warning").attr({
                    "data-notify-type": "warning",
                    "data-notify-msg": "<i class=icon-warning-sign></i> Operacion Incompleta, intente de nuevo!",
                    "data-notify-position": "bottom-full-width"
                });
                SEMICOLON.widget.notifications($("#warning"));
            }
        }, "json");
    });

</script>


<!-- End Content
============================================= -->    
<?php
include_once 'public/footer.php';