<?php
$session = SSession::getInstance();

if (isset($session->permissions)) {
    if ($session->permissions == 'A') {
        include_once 'public/headerAdmin.php';
    } else {
        header("Location:?controller=Index&action=notFound");
    }
} else {
    include_once 'public/header.php';
}
?>
<section id="page-title">
    <div class="container clearfix">
        <h1>Eliminar Asignaciones de Cursos a Semestres</h1>
    </div>
</section>

<section id="content">
    <div class="content-wrap">
        <div class="container clearfix">
            <div class="accordion-lg divcenter nobottommargin" style="max-width: 550px;">
                <div class="acctitle">
                    <div class="acc_content clearfix">
                        <form id="form" class="nobottommargin" onsubmit="return val();">
                            <div class="white-section">
                                <label for="form-semester">Semestres:</label>
                                <select id="form-semester" class="selectpicker form-control" data-live-search="true">
                                    <option value="-1" data-tokens="">Seleccione un Semestre</option>
                                    <?php
                                    foreach ($vars as $var) {
                                        if (isset($var["ID"])) {
                                            ?>
                                            <option value="<?php echo $var["ID"] ?> " data-tokens="">
                                                <?php
                                                if ($var["semester"] == '1') {
                                                    echo "I semestre" . " " . $var["year"];
                                                } else {
                                                    echo "II semestre" . " " . $var["year"];
                                                }
                                                ?>
                                            </option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                                <input type="hidden" id="failed-form-semester" data-notify-type= "error" data-notify-position="bottom-full-width"  data-notify-msg="<i class='icon-remove-sign'></i> Semestre inválido. Seleccione e intente de nuevo!"/> 
                            </div>
                            <br>
                            <div class="white-section">
                                <label for="form-courses">Cursos:</label>
                                <select id="form-courses" class="form-control selectpicker" data-live-search="true">
                                    <option value="-1" data-tokens="">Seleccione un Curso</option>
                                </select>
                                <input type="hidden" id="failed-form-courses" data-notify-type= "error" data-notify-position="bottom-full-width" data-notify-msg="<i class='icon-remove-sign'></i> Curso inválido. Seleccione e intente de nuevo!"/>
                            </div>
                            <div class="col_full nobottommargin">
                                <input type="submit" value="Eliminar" id="form-submit" class="button button-3d button-black nomargin form-control" style="display: none; text-align: center;"/>
                                <input type="hidden" id="warning" data-notify-type="warning" data-notify-msg="<i class='icon-warning-sign'></i>La operacion no se pudo realizar, intente de nuevo o m&aacute;s tarde!" data-notify-position="bottom-full-width"/>
                                <input type="hidden" id="success" data-notify-type="success" data-notify-msg="<i class='icon-ok-sign'></i> Operaci&oacute;n exitosa, revise en breve...!" data-notify-position="bottom-full-width"/>
                                <input type="hidden" id="wait" data-notify-type="info" data-notify-msg="<i class=icon-info-sign></i> Espere un momento...!" data-notify-position="bottom-full-width"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<a id="showModal" style="display: none;"class="button button-3d button-black nomargin" data-target="#myModal" data-toggle="modal">Modal</a>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-body">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">¡Aviso!</h4>
                </div>
                <div class="modal-body">
                    <h4 style="text-align: center;">¿Realmente desea eliminar este Administrador?</h4>
                    <p>Consejos:
                    <li>Verificar bien, si es el administrador que realmente desea eliminar</li>
                    <li>El administrador puede ser restaurado con servicio t&eacute;cnico</li></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" id="form-close" data-dismiss="modal">Cerrar</button>
                    <input type="button" class="btn btn-primary button-black nomargin" id="form-submity" value="Eliminar"/>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    //Change Combobox
    $("#form-semester").change(function () {
        if ($("#form-semester").val() === "-1") {
            SEMICOLON.widget.notifications($("#failed-form-semester"));
            return false;
        } else {
            var parameters = {
                "ID_Semester": $("#form-semester").val()
            };
            document.getElementById("form-courses").options.length = 0;
            
            SEMICOLON.widget.notifications($("#wait"));
            
            $.post("?controller=CourseSemester&action=selectAllCoursesSemester", parameters, function (data) {
                $('#form-courses').append($("<option></option>").attr("value", "-1").text("Seleccione un Curso"));
                for (var i = 0; i < data.length; i++) {
                    $('#form-courses').append($("<option></option>").attr("value", data[i].initials).text(data[i].name));//AGREGAR OPCIONES
                }
                $("#form-courses").selectpicker("refresh");///REFRESCA SELECT PARA QUE AGARRE AGREGADOS
                $("#form-submit").css("display","block");
            }, "json");
        }
    });

    //Open Modal
    function val() {
        if ($("#form-semester").val() === "-1") {
            SEMICOLON.widget.notifications($("#failed-form-semester"));
            return false;
        } else if ($("#form-courses").val() === "-1") {
            SEMICOLON.widget.notifications($("#failed-form-courses"));
            return false;
        } else {
            $('#showModal').click();
            return false;
        }
    }

    //Delete 
    $("#form-submity").click(function () {
        
        $("#form-submity").attr('disabled', 'disabled');
        $("#form-close").attr('disabled', 'disabled');
        
        SEMICOLON.widget.notifications($("#wait"));
        
        var parameters = {
            "ID_Semester": $("#form-semester").val(),
            "initials": $("#form-courses").val()
        };
        
        $.post("?controller=CourseSemester&action=deleteCourse", parameters, function (data) {
            if (data.result === "1") {
                SEMICOLON.widget.notifications($("#success"));
                setTimeout("location.href = '?controller=CourseSemester&action=deleteCourse';", 1500);
            } else {
                SEMICOLON.widget.notifications($("#warning"));
            }
            $("#form-submity").removeAttr('disabled');
            $("#form-close").removeAttr('disabled');
        }, "json");
    });
</script>


<!-- End Content
============================================= -->    
<?php
include_once 'public/footer.php';
