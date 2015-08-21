<?php
error_reporting(0);
require_once "includes/sesion.class.php";
$sesion = new sesion();
$email = $sesion->get('email');
$idusr = $sesion->get("id_usr");
$rol = $sesion->get('id_rol_usr');
$rif = $sesion->get('rif');
if (!isset($email)) {
    header('location: login.php');
}
if (!$rol == 1) {
    header("Location: login.php");
} else {
    ?>
    <!--  
    ///********************************************************
    PAGINA FUNCIONAL (Funcional y  visualización)
    FINALIDAD:       Buscar el RIF para luego reactivar el cliente
    FECHA:           Noviembre, 2013
    DESARROLLADO:   claretcoromoto@hotmail.ES  victor_rosendo@hotmail.com
    MODIFICADO:          Nombre / Fecha / #Release
    ///********************************************************
    -->
    <!-- visas -->
    <?php
    include 'meta/formMeta.php';
    include 'Sidebar/formSiderBarMenu.php';

    include 'Link/Link.php';
    include 'navbar/NavBarAdmin.php';

    include 'Sidebar/formSiderBarIndex.php';

    include 'Clearfix/formClearFix.php';
    include 'Footer/formFooter.php';
    ?>
    <!-- procesos -->


    <!DOCTYPE html>

    <?php
    $meta = new formMeta();
    $meta->meta();
    ?>
    <title>Buscar RIF del cliente</title>

    <link rel='stylesheet' href='lib/jquery-ui.min.css' />
    <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).on('ready', function () {

            $('#reactivar').on('click', function (event) {

                var accion = $('#accion').val();
                var rifcli = $('#rifcli').val();
                if (rifcli == 0)
                {
                    $('#rifcli').focus();
                    $('#focu').fadeIn('fast');
                }
                else
                {
                    var formData = $("#form1 input").serialize();
                    $.ajax({
                        type: 'POST',
                        url: 'controlador/controller_admin.php',
                        data: formData,
                        beforeSend: function (formData) {
                            $('#focu').fadeOut('fast');
                            $("#resultado").html('<img src="img/loader.gif" />').show('slow');
                            $('#reactivar').fadeOut('fast');
                            $('#reset').fadeOut('fast');
                            $('#a').fadeOut('fast');
                            setTimeout(function () {
                            }, 5000);
                        },
                        success: function (data) {
                            if (data === '') {
                                setTimeout(function () {

                                    
                                    $('#reactivar').fadeIn('fast');
                                    $('#reset').fadeIn('fast');
                                    $('#a').fadeIn('fast');
                                    $("#resultado").html('<img src="img/loader.gif" />').hide('slow');
                                    $('.alert-info').fadeIn('slow');
                                }, 8000);
                                
                                setTimeout(function () {
                                      window.location.reload();
                               }, 13000);
                                exit();
                            }
                            if (data === '0') {

                                setTimeout(function () {

                                    $('.info_sancionado').fadeIn('slow');
                                    $('#reactivar').fadeIn('fast');
                                    $('#reset').fadeIn('fast');
                                    $('#a').fadeIn('fast');
                                    $("#resultado").html('<img src="img/loader.gif" />').hide('slow');
                                }, 10000);
                                setTimeout(function () {
                                      window.location.reload();
                               }, 13000);
                                exit();
                            }
                            if (data === '1') {

                                setTimeout(function () {

                                    
                                    $('#reactivar').fadeIn('fast');
                                    $('#reset').fadeIn('fast');
                                    $('#a').fadeIn('fast');
                                    $("#resultado").html('<img src="img/loader.gif" />').hide('slow');
                                   $('.info_aprobado').fadeIn('slow');
                                }, 8000);
                                setTimeout(function () {
                                      window.location.reload();
                               }, 13000);
                                exit();
                            }
                            if (data === '-2') {

                                setTimeout(function () {

                                    $('.info_reactivado').fadeIn('slow');
                                    $('#reactivar').fadeIn('fast');
                                    $('#reset').fadeIn('fast');
                                    $('#a').fadeIn('fast');
                                    $("#resultado").html('<img src="img/loader.gif" />').hide('slow');
                                }, 10000);
                                 setTimeout(function () {
                                      window.location.reload();
                               }, 13000);
                                exit();
                            }
                            if (data === '2') {

                                setTimeout(function () {

                                    $('.info_pendiente').fadeIn('slow');
                                    $('#reactivar').fadeIn('fast');
                                    $('#reset').fadeIn('fast');
                                    $('#a').fadeIn('fast');
                                    $("#resultado").html('<img src="img/loader.gif" />').hide('slow');
                                }, 10000);
                                setTimeout(function () {
                                      window.location.reload();
                               }, 13000);
                                exit();
                            } else
                            {
                                $('.alert-success').fadeIn('slow');
                                setTimeout(function () {
                                    window.location = "view_admin_reactivarcliente.php?rifcli="+rifcli;
                                }, 5000);
                            }
                        },
                        error: function (xhr, desc, err) {
                            console.log(xhr);
                            console.log("Details: " + desc + "\nError:" + err);
                        },
                        fail: function (data) {
                            console.log(data);
                            $('#fail').html("Ha fallado la aplicación").css("border", "3px solid green");
                        }
                    }).done(function (data, jqXHR) {
                        console.log(data);
                        console.log(jqXHR.responseText);
                    }).fail(function (jqXHR, status, errorThrown) {
                        console.log(errorThrown);
                        console.log(jqXHR.responseText);
                        console.log(jqXHR.status);

                    });

                }
                event.preventDefault();
            });






            $('#reset').on('click', function (event) {
                event.preventDefault();
                setTimeout(function () {
                    $('.alert-info').fadeOut('fast');
                }, 4000);

            });

        });</script>


    <!-- Fin códigos de validación del formulario -->
    <?php
    $links = new link();
    $links->linkeos();
    ?>

    <!-- Navbar starts -->

    <?php
    $navegadornav = new NavBarAdmin();
    $navegadornav->navegador($email);
    ?>
    <!-- Navbar ends -->

    <div class="content">
        <br><br>

        <!-- Sidebar starts -->
        <?php
        $sideBarAdmin = new formSiderBarMenu();
        $sideBarAdmin->formSider();
        ?>   
        <div class="mainbar">
            <!-- Title starts  id="sometabs"  <div class="mainbar"> -->
            <div class="span14">
                <div class="box-body">

                    <div class="page-title" align="left">
                        <h4>Reactivación de cliente</h4>
                        <p>Importadora Xian, C.A.</p>
                        <hr/>
                    </div>

                    <div class="span14">
                        <div align="center" class="info_sancionado" style="display: none"> 
                            El cliente ha sido sancionado previamente.
                        </div>
                        <div align="center" class="info_eliminado" style="display: none"> 
                            El cliente ha sido anulado previamente.
                        </div>
                        <div align="center" class="info_reactivado" style="display: none"> 
                            El cliente está reactivado.
                        </div>
                        <div align="center" class="info_pendiente" style="display: none"> 
                            El cliente está pendiente.
                        </div>
                        <div align="center" class="info_aprobado" style="display: none"> 
                            El cliente está pendiente.
                        </div>
                        <div class="well login-register">

                            <h6>Buscar RIF en el sistema</h6>
                            <hr />
                            <form id="form1">
                                <!-- RIF -->
                                <div class="control-group">
                                    <label class="control-label" for="rif">RIF:</label>
                                    <div class="controls">
                                        <input type = "hidden" id = "accion" name="accion"   value ="1" required/>
                                        <input type="text" class="input-medium" class="mayuscula" pattern="(^([VEJPG]{1})([0-9]{9}$)" title="Por favor, introduzca el RIF"  placeholder="V106128118" name="rifcli" id="rifcli"  required autofocus />
                                        <span id="resultado"></span> 
                                    </div>
                                </div>   
                                <button  id="reactivar" class="btn btn-danger" >Buscar para reactivar</button>
                                <button id="reset" type="reset" class="btn btn-danger">Limpiar</button>
                                <a id="a" class="btn btn-danger" href="AdminMenuPrincipal.php">Cancelar</a>
                            </form>
                            <div id='focu'style="display: none" align="center">Por favor, inserte el RIF</div>

                            <div class="alert-success" style="display: none" align="center">
                                El cliente está eliminado o sancionado, espere mientras se redirecciona!
                            </div>
                            <div class="alert-info" style="display: none"> 
                                El cliente no está registrado o está reactivado.
                            </div>

                            <div id="error"><h2></h2></div> 
                            <div id="fail"></div>



                        </div>







                        <div class="span4">




                        </div>





                    </div>  <!-- fin del span 14  -->

                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <!--  footer -->
    <?php
    $footer = new formFooter();
    $footer->footer();
    ?>
    <!-- Foot ends</body>
    </html> -->


    <?php
    $js = new formClearFix();
    $js->jsPie();
    ?>
<?php } ?>
