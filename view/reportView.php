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
<!-- Page Title
============================================= -->
<section id="page-title">
    <div class="container clearfix">
        <h1>Reporte</h1>
        <span>Sus Datos Importantes en Gráficos Interactivos</span>
    </div>
</section><!-- #page-title end -->

<!-- Content
============================================= -->
<section id="content">
    <div class="content-wrap">
        <div class="container clearfix">
            <div class="table-responsive">
                <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>

                    </thead>
                    <tfoot>

                    </tfoot>
                    <tbody>

                    </tbody>
                </table>
            </div>
            <select id="form-report" class="selectpicker form-control" data-live-search="true">
                <option value="null" data-tokens>Seleccione un Reporte</option>
                <option value="usuariosActivos" data-tokens>Usuarios Activos</option>
                <option value="us" data-tokens>2</option>
                <option value="us" data-tokens>3</option>
            </select>
            </br>
            </br>
            </br>
            <div class="col_half" style="width: 100%;" >
                <canvas id="chart-area"/>
            </div>
        </div>
    </div>
</section><!-- #content end -->

<script>
    $(document).ready(function () {
        $('#datatable').DataTable();
    });
</script>

<script src="public/js/validation/report.js" type="text/javascript"></script>

<!-- End Content
============================================= -->    
<?php
include_once 'public/footer.php';
