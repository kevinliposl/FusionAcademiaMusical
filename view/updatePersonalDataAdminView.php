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
        <h1>Datos personales</h1>
        <span>Actualiza la informaci&oacute;n</span>
    </div>
</section>

<section id="content" style="position: relative;">
    <div class="content-wrap">
        <div class="container clearfix">
            <div class="accordion-lg divcenter nobottommargin">
                <div class="acc_content clearfix">
                    <form id="form" class="nobottommargin" onsubmit="return val();">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <colgroup>
                                    <col class="col-xs-4">
                                    <col class="col-xs-8">
                                </colgroup>
                                <tbody>
                                    <tr>
                                        <td>Identificaci&oacute;n</td>
                                        <td>
                                            <a id="form-id" class="bt-editable" href="#" data-type="text" data-pk="1" data-placeholder="Required" data-title="Ingrese la identificación"><?php echo $vars['identification']; ?></a>
                                            <input type="hidden" id="failed-id" data-notify-type= "error" data-notify-position="bottom-full-width" data-notify-msg="<i class=icon-remove-sign></i> Identificación Incorrecta. Verifique e intente de nuevo!"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>
                                            <a id="form-email" href="#" class="bt-editable" data-type="text" data-pk="1" data-placeholder="Required" data-title="Ingrese el email"><?php echo $vars['email']; ?></a>
                                            <input type="hidden" id="failed-email" data-notify-type= "error" data-notify-position="bottom-full-width" data-notify-msg="<i class=icon-remove-sign></i> Email Incorrecto. Verifique e intente de nuevo!"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Nombre</td>
                                        <td>
                                            <a id="form-name" href="#" class="bt-editable" data-type="text" data-pk="1" data-placeholder="Required" data-title="Ingrese el nombre"><?php echo $vars['name']; ?></a>
                                            <input type="hidden" id="failed-name" data-notify-type= "error" data-notify-position="bottom-full-width" data-notify-msg="<i class=icon-remove-sign></i> Nombre Incorrecto. Verifique e intente de nuevo!"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Primer Apellido</td>
                                        <td>
                                            <a id="form-first-lastName" href="#" class="bt-editable" data-type="text" data-pk="1" data-placeholder="Required" data-title="Ingrese el Primer Apellido"> <?php echo $vars['first_lastname']; ?></a>
                                            <input type="hidden" id="failed-first-lastName" data-notify-type= "error" data-notify-position="bottom-full-width" data-notify-msg="<i class=icon-remove-sign></i> Primer Apellido Incorrecto. Verifique e intente de nuevo!"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Segundo Apellido</td>
                                        <td>
                                            <a id="form-second-lastName" href="#" class="bt-editable" data-type="text" data-pk="1" data-placeholder="Required" data-title="Ingrese el Segundo Apellido"><?php echo $vars['second_lastname']; ?></a>
                                            <input type="hidden" id="failed-second-lastName" data-notify-type= "error" data-notify-position="bottom-full-width" data-notify-msg="<i class=icon-remove-sign></i> Segundo Apellido Incorrecto. Verifique e intente de nuevo!"/>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col_full nobottommargin">                      
                            <input type="submit" id="form-submit" value="Actualizar" class="button button-3d button-black nomargin form-control" style="display: block; text-align: center;"/>
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

<!--MODAL -->
<a id="showModal" style="display: none;" class="button button-3d button-black nomargin" data-target="#myModal" data-toggle="modal">Modal</a>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-body">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">¡Aviso!</h4>
                </div>
                <div class="modal-body">
                    <h4 style="text-align: center;">¿Realmente desea actualizar la información de este profesor?</h4>
                    <p>Consejos:</br>
                    <li>Revisar que todos los campos tengan la informaci&oacute;n correcta</li>
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <input type="button" class="btn btn-primary button-black nomargin" id="form-submity" value="Actualizar"/>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="public/js/jquery.min.js" type="text/javascript"></script>
<script src="public/js/Views/updatePersonalDataAdminView.js" type="text/javascript"></script>
<script src="public/js/Views/general.js" type="text/javascript"></script>

<?php
include_once 'public/footer.php';
?>

<script src="public/js/bs-editable.js" type="text/javascript"></script>

