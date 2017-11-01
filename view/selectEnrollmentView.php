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
        <h1>Obtener Matriculas</h1>
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
                                <label for="form-initials">Estudiantes Matriculados:</label>
                                <select id="form-courses" class="selectpicker form-control" data-live-search="true">
                                    <option data-tokens="">Seleccione un estudiante</option>
                                    <?php
                                    foreach ($vars as $var) {
                                        if (isset($var["identification"])) {
                                            ?>
                                            <option value="<?php echo $var["identification"] ?> " data-tokens="">
                                                <?php echo $var["Name"]?>
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
                        </form>
                    </div>
                </div>
            </div>
        </div>
</section><!-- #content end -->

<script>

    //Change Combobox
    $("#form-courses").change(function () {
        var parameters = {
            "initials": $("#form-courses").val()
        };

        $.post("?controller=Course&action=select", parameters, function (data) {
            if (data.initials) {
                $("#form-initials-table").html(data.initials);
                $("#form-name-table").html(data.name);
                $("#form-instrument-table").html(data.instrument);
                $("#form-description-table").html(data.description);

                $("#success").attr({
                    "data-notify-type": "success",
                    "data-notify-msg": "<i class=icon-ok-sign></i> Operacion Exitosa!",
                    "data-notify-position": "bottom-full-width"
                });
                SEMICOLON.widget.notifications($("#success"));
            } else {
                $("#form-initials-table").html("");
                $("#form-name-table").html("");
                $("#form-instrument-table").html("");
                $("#form-description-table").html("");
                $("#form-secondLastName-table").html("");

            }
        }, "json");
    });

</script>


<!-- End Content
============================================= -->    
<?php
include_once 'public/footer.php';