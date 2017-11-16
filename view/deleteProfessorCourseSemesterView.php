<?php
$session = SSession::getInstance();

if (isset($session->permissions)) {
    if($session->permissions=='A'){
        include_once 'public/headerAdmin.php';
    }else{
        header("Location:?controller=Index&action=notFound");
    }
} else {
    include_once 'public/header.php';
}
?>
?>

<!-- Page Title
============================================= -->
<section id="page-title">

    <div class="container clearfix">
        <h1>Eliminar Asignaciones de Profesores a Cursos en Semestres</h1>
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
                                    <option value="-1" data-tokens="">Seleccione un Semestre</option>
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
                            <input type="hidden" id="failed-form-semester" data-notify-type= "error" data-notify-position="bottom-full-width"/>
                            <br>
                            <div class="white-section">
                                <label for="form-courses">Cursos:</label>
                                <select id="form-courses" class="form-control selectpicker" data-live-search="true">
                                    <option value="-1" data-tokens="">Seleccione un Curso</option>
                                </select>
                                <input type="hidden" id="failed-form-courses" data-notify-type= "error" data-notify-position="bottom-full-width"/>
                            </div>
                            <br>
                            <div class="white-section">
                                <label for="form-professors">Profesores:</label>
                                <select id="form-professors" class="form-control selectpicker" data-live-search="true">
                                    <option value="-1" data-tokens="">Seleccione el profesor</option>
                                </select>
                                <input type="hidden" id="failed-form-professors" data-notify-type= "error" data-notify-position="bottom-full-width"/>
                            </div>
                            <br>
                            <div class="col_full nobottommargin">
                                <a id="form-submit" data-toggle="modal" class="button button-3d button-black nomargin" style="display : block; text-align: center;" data-target="#myModal">Eliminar</a>
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
                    <h4 style="text-align: center;">¿Realmente desea eliminar la asignaci&oacute;n de profesor al curso en un semestre?</h4>
                    <p>Consejos:
                    <li>Verificar bien si la asignaci&oacute;n es la correcta</li></p>
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
    $("#form-semester").change(function () {
        if($("#form-semester").val()==="-1"){
            $("#failed-form-semester").attr("data-notify-msg", "<i class=icon-remove-sign></i> Semestre inválido. Seleccione e intente de nuevo!");
            SEMICOLON.widget.notifications($("#failed-form-semester"));
            return false;
        }else{
            var parameters = {
                "ID_Semester": $("#form-semester").val()
            };
            document.getElementById("form-courses").options.length = 0;
            document.getElementById("form-professors").options.length = 0;
            $('#form-professors').append($("<option></option>").attr("value", "-1").text("Seleccione el profesor"));
            $.post("?controller=CourseSemester&action=selectAllCoursesSemester", parameters, function (data) {
                $('#form-courses').append($("<option></option>").attr("value", "-1").text("Seleccione un Curso"));
                for (var i = 0; i < data.length; i++) {
                    $('#form-courses').append($("<option></option>").attr("value", data[i].initials).text(data[i].name));//AGREGAR OPCIONES
                }
                $("#form-courses").selectpicker("refresh");///REFRESCA SELECT PARA QUE AGARRE AGREGADOS
            }, "json");
        }
    });
    
    //Change Combobox
    $("#form-courses").change(function () {
        if($("#form-semester").val()==="-1"){
            $("#failed-form-semester").attr("data-notify-msg", "<i class=icon-remove-sign></i> Semestre inválido. Seleccione e intente de nuevo!");
            SEMICOLON.widget.notifications($("#failed-form-semester"));
            return false;
        }else if($("#form-courses").val()==="-1"){
            $("#failed-form-courses").attr("data-notify-msg", "<i class=icon-remove-sign></i> Curso inválido. Seleccione e intente de nuevo!");
            SEMICOLON.widget.notifications($("#failed-form-courses"));
            return false;
        }else{
            var parameters = {
                "ID_Semester": $("#form-semester").val(),
                "initials": $("#form-courses").val()
            };
            document.getElementById("form-professors").options.length = 0;
            $.post("?controller=CourseSemester&action=selectAllProfessorsCourseSemester", parameters, function (data) {
                $('#form-professors').append($("<option></option>").attr("value", "-1").text("Seleccione el profesor"));
                for (var i = 0; i < data.length; i++) {
                    $('#form-professors').append($("<option></option>").attr("value", data[i].identification).text(data[i].name));//AGREGAR OPCIONES
                }
                $("#form-professors").selectpicker("refresh");///REFRESCA SELECT PARA QUE AGARRE AGREGADOS
            }, "json");
        }
    });

    //Open Modal
    $("#form-submit").click(function () {
        if($("#form-semester").val()==="-1"){
            $("#failed-form-semester").attr("data-notify-msg", "<i class=icon-remove-sign></i> Semestre inválido. Seleccione e intente de nuevo!");
            SEMICOLON.widget.notifications($("#failed-form-semester"));
            return false;
        }else if($("#form-courses").val()==="-1"){
            $("#failed-form-courses").attr("data-notify-msg", "<i class=icon-remove-sign></i> Curso inválido. Seleccione e intente de nuevo!");
            SEMICOLON.widget.notifications($("#failed-form-courses"));
            return false;
        }else if($("#form-professors").val()==="-1"){
            $("#failed-form-professors").attr("data-notify-msg", "<i class=icon-remove-sign></i> Profesor inválido. Seleccione e intente de nuevo!");
            SEMICOLON.widget.notifications($("#failed-form-professors"));
            return false;
        }else{   
            $('#form-submit').attr('data-target', '#myModal');
        }
    });

    //Delete 
    $("#form-submity").click(function () {     
        var parameters = {
            "ID_Semester": $("#form-semester").val(),
            "initials": $("#form-courses").val(),
            "identification": $("#form-professors").val()
        };
        $.post("?controller=CourseSemester&action=deleteProfessor", parameters, function (data) {
            if (data.result === "1") {
                $("#success").attr({
                    "data-notify-type": "success",
                    "data-notify-msg": "<i class=icon-ok-sign></i> Operacion Exitosa!",
                    "data-notify-position": "bottom-full-width"
                });
                SEMICOLON.widget.notifications($("#success"));
                setTimeout("location.href = '?controller=CourseSemester&action=deleteProfessor';",2000);
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