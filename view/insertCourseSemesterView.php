<?php
$session = SSession::getInstance();

if (isset($session->permissions)) {
    if ($session->permissions == 'A') {
        include_once 'public/headerAdmin.php';
    } else {
        header('Location:?action=notFound');
    }
} else {
    header('Location:?action=notFound');
}
?>

<section id="page-title">
    <div class="container clearfix">
        <h1>Asignaciones</h1>
    </div>
</section>
<section id="content">
    <div class="content-wrap">
        <div class="container clearfix">
            <div class="accordion-lg divcenter nobottommargin" style="max-width: 550px;">
                <div class="acc_content clearfix">
                    <form id="form" class="nobottommargin">
                        <div class="col_full">
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
                            <input type="hidden" id="failed-form-semester" data-notify-type= "error" data-notify-position="bottom-full-width"/>
                        </div> 

                        <div class="col_full">
                            <label for="form-courses">Cursos:</label>
                            <select id="form-courses" class="selectpicker form-control" data-live-search="true">
                                <option value="-1" data-tokens="">Seleccione un Curso</option>
                            </select>
                            <input type="hidden" id="failed-form-courses" data-notify-type= "error" data-notify-position="bottom-full-width"/>
                        </div>

                        <div class="col_full">
                            <label for="form-professors">Profesores:</label>
                            <select multiple name="form-professors[]" id="form-professors" class="selectpicker form-control" data-live-search="true">
                                <option value="-1" data-tokens="">Seleccione un Profesor</option>
                            </select>
                            <input type="hidden" id="failed-form-professors" data-notify-type= "error" data-notify-position="bottom-full-width"/>
                        </div>

                        <div class="col_full">
                            <a id="form-submit" data-toggle="modal" class="button button-3d button-black nomargin" style="display : block; text-align: center;" data-target="#myModal">Asignar</a>
                            <input type="hidden" id="warning" data-notify-type="warning" data-notify-msg="<i class='icon-warning-sign'></i>La operacion no se pudo realizar, intente de nuevo o m&aacute;s tarde!" data-notify-position="bottom-full-width"/>
                            <input type="hidden" id="success" data-notify-type="success" data-notify-msg="<i class='icon-ok-sign'></i> Operaci&oacute;n exitosa, revise en breve...!" data-notify-position="bottom-full-width"/>
                            <input type="hidden" id="wait" data-notify-type="info" data-notify-msg="<i class=icon-info-sign></i> Espere un momento...!" data-notify-position="bottom-full-width"/>
                        </div>                     
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-body">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">¡Aviso!</h4>
                </div>
                <div class="modal-body">
                    <h4 style="text-align: center;">¿Realmente desea Asignar los Profesores al Curso en el Semestre?</h4>
                    <p>Consejos:
                    <li>Verificar bien si la asignaci&oacute;n esta completa</li></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <input type="button" class="btn btn-primary button-black nomargin" id="form-submity" value="Asignar"/>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="public/js/jquery.min.js" type="text/javascript"></script>
<script src="public/js/Views/insertCourseSemesterView.js" type="text/javascript"></script>


<?php
include_once 'public/footer.php';
?>

<script src="public/js/bs-select.js" type="text/javascript"></script>
<script src="public/js/selectsplitter.js" type="text/javascript"></script>

<script type="text/javascript">
    $('.selectpicker').selectpicker({
        size: 4,
        dropupAuto: false
    });
</script>
