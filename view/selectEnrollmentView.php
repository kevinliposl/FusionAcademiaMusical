<?php
$session = SSession::getInstance();

if (isset($session->permissions)) {
    if ($session->permissions == 'A') {
        include_once 'public/headerAdmin.php';
    } else {
        header("Location:?action=notFound");
    }
} else {
    header("Location:?action=notFound");
}
?>

<section id="page-title">
    <div class="container clearfix">
        <h1>Ver cursos matriculados</h1>
    </div>
</section>

<section id="content">
    <div class="content-wrap">
        <div class="container clearfix">
            <div class="accordion-lg divcenter nobottommargin" style="max-width: 550px;">
                <div class="acc_content clearfix">
                    <form id="form" class="nobottommargin">
                        <div class="white-section">
                            <label for="form-student">Estudiantes:</label>
                            <select id="form-student" class="selectpicker form-control" data-live-search="true">
                                <option data-tokens="">Seleccione un Estudiante</option>
                                <?php
                                foreach ($vars as $var) {
                                    if (isset($var["identification"])) {
                                        ?>
                                        <option value="<?php echo $var["identification"] ?> " data-tokens="">
                                            <?php
                                            echo $var["Name"];
                                            ?>
                                        </option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <br>
                        <div class="acc_content clearfix"></div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="table-course-professor">
                                <h5 style="text-align: center;">Matriculas Activas</h5>
                                <colgroup>
                                    <col class="col-xs-4">
                                    <col class="col-xs-4">
                                    <col class="col-xs-4">
                                </colgroup>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <input type="hidden" id="warning" data-notify-type="warning" data-notify-msg="<i class='icon-warning-sign'></i>La operacion no se pudo realizar, intente de nuevo o m&aacute;s tarde!" data-notify-position="bottom-full-width"/>
                        <input type="hidden" id="success" data-notify-type="success" data-notify-msg="<i class='icon-ok-sign'></i> Operaci&oacute;n exitosa, revise en breve...!" data-notify-position="bottom-full-width"/>
                        <input type="hidden" id="wait" data-notify-type="info" data-notify-msg="<i class=icon-info-sign></i> Espere un momento...!" data-notify-position="bottom-full-width"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="public/js/jquery.min.js" type="text/javascript"></script>
<script src="public/js/Views/selectEnrollmentView.js" type="text/javascript"></script>

<script src="public/js/bs-select.js" type="text/javascript"></script>
<script src="public/js/selectsplitter.js" type="text/javascript"></script>

<script type="text/javascript">
    $('.selectpicker').selectpicker({
        size: 4,
        dropupAuto: false
    });
</script>


<?php
include_once 'public/footer.php';
