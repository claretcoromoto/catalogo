<?php error_reporting(0);
require_once "includes/sesion.class.php";
$sesion = new sesion();
$email = $sesion->get('email');
$idAuto2 = $sesion->get("id_usr");
$rol = $sesion->get('id_rol_usr');
$rif = $sesion->get('rif');
if (!isset($email)) {
    header('location: login.php');
}
if (!$rol == 3) {
    header("Location: login.php");
} else {
    ?>

    <!--  
    ///********************************************************
    PAGINA FUNCIONAL (Funcional o de visualización)
    FINALIDAD:       Buscar el RIF para luego anular pedido
    FECHA:           Noviembre, 2013
    DESARROLLADO:   claretcoromoto@hotmail.ES  victor_rosendo@hotmail.com
    MODIFICADO:          Nombre / Fecha / #Release
    ///********************************************************
    -->
    <!-- visas -->
    <?php
    include 'meta/formMeta.php';
    include 'Link/Link.php';


    include 'Sidebar/formSiderBarMenuAutor2.php';
    include 'contactbox/formContactBox.php';

    include 'navbar/NavBarAdmin.php';
    include 'sliderbox/formSliderBox.php';
    include 'sheetstart/formSheetStart.php';


    include 'Clearfix/formClearFix.php';
    include 'Footer/formFooter.php';
    include 'Slider/formSliderCatalogoAdmin.php';

    include 'includes/ConexionPGSQL.php';
    ?>
    <!-- procesos -->


    <!DOCTYPE html>

    <?php
    $meta = new formMeta();
    $meta->meta();
    ?>
    <title>Anulación de pedido</title>
    <script type="text/javascript">
        //<![CDATA[
        function validar(campo) {
            var elcampo = document.getElementById(campo);
            if ((!validarNumero(elcampo.value)) || (elcampo.value == "")) {
                elcampo.value = "";
                elcampo.focus();
                document.getElementById('mensaje').innerHTML = 'Debe ingresar un número entero';
            }
            else {
                document.getElementById('mensaje').innerHTML = '';
    // Aqui pones el resto de las condiciones usando comparadores u operadores aritméticos, ya que estás seguro de que trabajas con números 
            }
        }
        function validarNumero(input) {
            return (!isNaN(input) && parseInt(input) == input);
        }
    </script>
    <?php
    $links = new link();
    $links->linkeos();
    ?>

    <!-- Navbar starts -->

    <!-- Navbar starts -->
    <?php
    $navAdmin = new NavBarAdmin();
    $navAdmin->navegador($email);
    ?>
    <div class="content">
        <br>  <br>  
        <?php
        $sideBarAdmin = new formSiderBarMenuAutor2();
        $sideBarAdmin->formSider();
        ?>
        <!-- Sidebar starts -->
        <div class="mainbar" align="center">

            <div class="box-body" >

                <div class="span12" >
                    <div class="page-title" align="left">
                        <h4>Anulación de pedidos</h4>
                        <p>Importadora Xian, C.A.</p>
                        <hr/>
                    </div>
                    <div class="span4">
                        <?php
                        $sql = "SELECT tblxian_pedido.ci_rif_cliente AS tblxian_pedido_ci_rif_cliente,
                tblsit_usr.razon_social_cliente AS tblsit_usr_razon_social_cliente,
                tblsit_usr.in_status_cliente AS tblsit_usr_in_status_cliente,
                tblxian_tpo_entrega.nb_tpo_entrega AS tblxian_tpo_entrega_nb_tpo_entrega,
                tblxian_status_pedido.nb_status_pedido AS tblxian_status_pedido_nb_status_pedido,
                tblxian_pedido.fe_registro AS tblxian_pedido_fe_registro,
                tblxian_pedido.tx_forma_pago AS tblxian_pedido_tx_forma_pago,
                tblxian_pedido.tx_direccion_entrega AS tblxian_pedido_tx_direccion_entrega,
                tblxian_pedido.id_pedido AS tblxian_pedido_id_pedido,
                tblxian_pedido.id_status_pedido AS tblxian_pedido_id_status_pedido,
                tblxian_pedido.id_usr_autor_vta AS tblxian_pedido_id_usr_autor_vta
                 FROM 
                tblsit_usr tblsit_usr INNER JOIN tblxian_pedido tblxian_pedido 
                ON tblsit_usr.ci_rif_cliente = tblxian_pedido.ci_rif_cliente 
                INNER JOIN tblxian_status_pedido tblxian_status_pedido 
                ON tblxian_pedido.id_status_pedido = tblxian_status_pedido.id_status_pedido 
                INNER JOIN tblxian_tpo_entrega tblxian_tpo_entrega 
                ON tblxian_pedido.id_tpo_entrega = tblxian_tpo_entrega.id_tpo_entrega
                 WHERE 
                tblxian_pedido.id_usr_autor_vta=$idAuto2 
                    AND tblsit_usr.in_status_cliente=1 ";
                        $result = @pg_query($sql);
                        $rowA = pg_fetch_array($result);
                        ?>

                        <div class="well login-register" >
                            <form class="form-horizontal"  onsubmit="return checkSubmit();"  method="post" action="includes/ActualizarAnulacionPedido.php" >
                                <fieldset>
                                    <legend class="btn btn-danger"> Ingrese datos para anular pedido </legend>
                                    <div class="control-group">
                                        <label class="control-label" for="rif">RIF </label>
                                        <div class="controls">
                                            <input class="input-medium" class="mayuscula" maxlength="15" pattern="^([VEG]{1})([0-9]{8})([0-9]{1})$" placeholder="Ejemplo:V106128118" name="rif" type="text" id="rif" required>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="id_pedido">Id pedido: </label>
                                        <div class="controls">
                                            <input class="input-mini"  onkeyup="validar(this.id);" min="1" maxlength="5"name="id_pedido" type="text" id="id_pedido" required>
                                            <div id="mensaje" class="b-orange" align="center"></div>
                                        </div>
                                    </div>
                                    <?php
                                    $sqlAnul = "SELECT * FROM tblxian_motivo_anul WHERE in_tipo=2 ORDER BY nb_motivo_anul ASC";
                                    $resultAnul = @pg_query($sqlAnul);
                                    $anul = '';
                                    while ($rowA = pg_fetch_array($resultAnul)) {
                                        $anul .=" <option value=" . $rowA['id_motivo_anul'] . "> " . $rowA['nb_motivo_anul'] . "</option>";
                                    }
                                    ?>
                                    <div class="control-group">
                                        <label class="control-label" for="id_motivo">Motivo de anulación: </label>
                                        <div class="controls">
                                            <select   class="input-medium"  name="id_motivo" id="id_motivo"  required>
                                                <?php echo $anul ?>
                                            </select>
                                        </div>
                                    </div>
                                </fieldset>

                                <button  class="btn btn-danger" type="submit" name="enviar" class="btn">Anular pedido</button>
                                <button  class="btn btn-danger" type="reset" class="btn">Limpiar</button>
                                  <a class="btn btn-danger" href="AdminPrincipalAutor2.php">Cancelar</a>

                            </form>
                        </div> 
                    </div>  
                </div>
            </div>
        </div>
    </div>
    <br><br><br><br><br>



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
<?php } ?>
