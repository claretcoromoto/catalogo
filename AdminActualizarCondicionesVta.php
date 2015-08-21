<?php
error_reporting(0);
require_once "includes/sesion.class.php";
$sesion = new sesion();
$email = $sesion->get('email');
$adminId = $sesion->get("id_usr");
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
    PAGINA FUNCIONAL (Funcional o de visualización)
    FINALIDAD:       Buscar el RIF para luego Registrar clientes
    FECHA:           Noviembre, 2013
    DESARROLLADO:   claretcoromoto@hotmail.ES  victor_rosendo@hotmail.com
    MODIFICADO:          Nombre / Fecha / #Release
    ///********************************************************
    -->
    <!-- visas -->
    <?php
    include 'meta/formMeta.php';
    include 'Sidebar/formSiderBarMenu.php';
    include 'contactbox/formContactBox.php';
    include 'Link/Link.php';
    include 'navbar/NavBarAdmin.php';
    include 'sliderbox/formSliderBox.php';
    include 'sheetstart/formSheetStart.php';
    include 'formularios/formSliderSpan6Ini.php';
    include 'formularios/formSliderSpan6Fin.php';
    include 'formularios/formInicioContent12.php';
    include 'formularios/formConten12Fin.php';
    include 'Sidebar/formSiderBarIndex.php';

    include 'Clearfix/formClearFix.php';
    include 'Footer/formFooter.php';
    include 'Post/formPost.php';

    include 'formularios/formValidarRif.php';
    include 'formularios/formRegistrarClientes.php';
    include 'includes/ConexionPGSQL.php';
    ?>
    <!-- procesos -->


    <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 

    <?php
    $meta = new formMeta();
    $meta->meta();
    ?>
    <title>Solicitudes pendientes del cliente</title>
    <script type="text/javascript" src="js/functions.js"></script>
    <script type="text/javascript">
        var statSend = false;
        function checkSubmit() {
            if (!statSend) {
                statSend = true;
                return true;
            } else {
                alert("El formulario ya se esta enviando...");
                return false;
            }
        }
    </script>
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script language="javascript" type="text/javascript">
        $(document).ready(function() {
            $('button[type="enviar"]').attr('disabled', 'disabled');
            $('input[type="text"]').attr('disabled', 'disabled');


            $('a[name="editar"]').click(function() {
                $('input[type="text"]').removeAttr('disabled');

                $('button[type="enviar"]').removeAttr('disabled');
                $("#edit").attr('disabled', 'disabled');
            });
        });</script>

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
        <!-- Main content starts -->
        <br><br>

        <!-- Sidebar starts -->
        <?php
        $sideBarAdmin = new formSiderBarMenu();
        $sideBarAdmin->formSider();
        ?>   

        <div class="mainbar">


            <div class="span12" >
                <div class="box-body">    
                    <div class="page-title" align="left">
                        <h4>Condiciones de ventas establecidas</h4>
                        <p>Importadora Xian, C.A.</p>
                        <hr/>
                    </div>
                    <div class="span9" >
                        <!-- Buscar Rif y Razón Social<div class="well login-register-table">-->
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th  auto>Fecha inicial</th>
                                    <th auto >Fecha final</th>
                                    <th auto >Responsable</th>
                                    <th auto >Monto mínimo</th>
                                    <th  auto>IVA</th>
                                    <th auto >Operación</th>
                                </tr>
                            </thead> 
                            <?php
                            $sql = "SELECT * FROM  tblxian_cond_vta WHERE in_activo=1";
                            $result = @pg_query($sql);
                            while ($file = pg_fetch_array($result)) {
                                $idu = $file['id_usr'];
                                $sqlu = "SELECT tx_login FROM  tblsit_usr WHERE id_usr=$adminId";
                                $resultu = @pg_query($sqlu);
                                $fileu = pg_fetch_array($resultu);
                                ?>
                                <tbody>   
                                    <!-- Primer formulario-->
                                    <tr> 
                                        <td id="edit"><?php echo $file['fe_ini_vigencia'] ?></td> 
                                        <td id="edit"><?php echo $file['fe_fin_vigencia'] ?></td> 
                                        <td id="edit"><?php echo $fileu['tx_login'] ?></td> 
                                <form class="form-search s-widget"   method="post" action="includes/ActualizarCondVta.php" >
                                    <td id="edit"><input name="monto" type="text"  class="input-small" id="campo" disabled="disabled" value= "<?php echo $file['nu_monto_minimo'] ?>" required> </td>
                                    <td id="edit"><input name="iva" type="text" class="input-mini"id="campo" disabled="disabled" value=" <?php echo $file['iva'] ?>" required>
                                      
                                        <input name="idcond" type="hidden"  value=" <?php echo $file['id_cond_venta'] ?>" required>
                                    </td> 
                                    <td>
                                        <a  class="btn btn-mini btn-reveal" name="editar" href="#"><i class="icon-edit "></i></a>
                                        <button type="enviar"  title="Actualizar" class="btn btn-mini btn-success"><i class="icon-ok "></i></button>
                                        <button class="btn-mini btn-danger" type="reset" class="btn btn-mini btn-danger"><i class="icon-repeat "></i></button>
                                    </td>
                                </form>    
                                </tr> 
                                </tbody> <?php } ?>
                        </table>  
                    </div>
                </div>
            </div>
            <p class="prev-indent-bot">&nbsp;</p>
            <p class="prev-indent-bot">&nbsp;</p>
            <p class="prev-indent-bot">&nbsp;</p>
            <p class="prev-indent-bot">&nbsp;</p>
            <p class="prev-indent-bot">&nbsp;</p>
            <p class="prev-indent-bot">&nbsp;</p>
        </div>
    </div>

    <!--   fin del contenido de la página -->

    <div class="clearfix"></div>
    <!--  footer -->
    <?php
    $footer = new formFooter();
    $footer->footer();
    ?>
    <!-- Foot ends -->


    <?php
    $js = new formClearFix();
    $js->jsPie();
    ?>
    <?php
}
?>
