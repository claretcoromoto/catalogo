<?php
error_reporting(0);
require_once "includes/sesion.class.php";
$sesion = new sesion();
$email = $sesion->get('email');
$idAuto1 = $sesion->get("id_usr");
$rol = $sesion->get('id_rol_usr');
$rif = $sesion->get('rif');
if (!isset($email)) {
    header('location: login.php');
}
if (!$rol == 2) {
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


    include 'Sidebar/formSiderBarMenuAutor1.php';
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
    <title>Sancionar clientes</title>
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
        $sideBarAdmin = new formSiderBarMenuAutor1();
        $sideBarAdmin->formSider();
        ?>
        <!-- Sidebar starts -->
        <div class="mainbar" align="center">
            <div class="span12" >
                <div class="box-body" >


                    <div class="page-title" align="left">
                        <h4>Sancionar clientes</h4>
                        <p>Importadora Xian, C.A.</p>
                        <hr/>
                    </div>
                    <div class="span9">

                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th auto >RIF</th>
                                    <th auto >Razón social</th>
                                    <th auto>Email</th>
                                    <th auto >Estatus</th>
                                    <th auto >Motivo de sanción </th>
                                    <th auto >Operación</th>
                                </tr>
                            </thead>
                            <tbody> 
                                <?php
                                $sql = "SELECT tblsit_usr.razon_social_cliente AS tblsit_usr_razon_social_cliente,
                tblsit_usr.ci_rif_cliente AS tblsit_usr_ci_rif_cliente,
                tblsit_usr.tx_direccion AS tblsit_usr_tx_direccion,
                tblsit_usr.nb_persona_contacto AS tblsit_usr_nb_persona_contacto,
                tblsit_usr.tx_telf_contacto AS tblsit_usr_tx_telf_contacto,
                tblsit_usr.tx_login AS tblsit_usr_tx_login,
                tblsit_ciudad.nb_ciudad AS tblsit_ciudad_nb_ciudad,
                tblsit_municipio.nb_municipio AS tblsit_municipio_nb_municipio,
                tblsit_estado.nb_estado AS tblsit_estado_nb_estado,
                tblsit_usr.in_status_cliente AS tblsit_usr_in_estatus_cliente
                FROM tblsit_ciudad tblsit_ciudad 
                INNER JOIN tblsit_usr tblsit_usr ON tblsit_ciudad.id_ciudad = tblsit_usr.id_ciudad
                INNER JOIN tblsit_municipio tblsit_municipio 
                ON tblsit_ciudad.id_municipio = tblsit_municipio.id_municipio
                INNER JOIN tblsit_estado tblsit_estado ON tblsit_municipio.id_estado = tblsit_estado.id_estado
                 WHERE tblsit_usr.id_rol_usr = 4  AND id_usr_autor_clte=$idAuto1";
                                $result = @pg_query($sql);
                                if ($numrow = pg_num_rows($result) > 0) {
                                    while ($row = pg_fetch_array($result)) {
                                        ?>


                                        <!-- Primer formulario-->
                                        <tr> 
                                            <td id="e"> <?php echo $row['tblsit_usr_ci_rif_cliente'] ?></td>
                                            <td id="edit"><?php echo $row['tblsit_usr_razon_social_cliente'] ?></td> 
                                            <td id="edit"><?php echo $row['tblsit_usr_tx_login'] ?></td> 
                                                      
                                             <?php if ($row['tblsit_usr_in_estatus_cliente'] == 2) { ?>
                                                <td id="edit"><span class="label label-warning">Pendiente</span>
                                                    <input  name="rif" type="hidden" id="rif" value="<?php echo $row['tblsit_usr_ci_rif_cliente'] ?>">
                                                    <input  name="estatus" type="hidden" id="estatus" value="Pendiente">
                                                <?php } elseif ($row['tblsit_usr_in_estatus_cliente'] == -2) { ?>
                                                <td id="edit"><span class="label label-info">Reactivado</span><br>
                                                    <input  name="estatus" type="hidden" id="estatus" value="Reactivado">
                                                    <input  name="rif" type="hidden" id="rif" value="<?php echo $row['tblsit_usr_ci_rif_cliente'] ?>">
                                                </td> 
                                            <?php }                                
                                                elseif ($row['tblsit_usr_in_estatus_cliente'] == -1) { ?>
                                                <td id="edit"><span class="label label-reverse">Eliminado</span><br>
                                                    <input  name="estatus" type="hidden" id="estatus" value="Eliminado">
                                                    <input  name="rif" type="hidden" id="rif" value="<?php echo $row['tblsit_usr_ci_rif_cliente'] ?>">
                                                </td> 
                                            <?php } 
                                                 elseif ($row['tblsit_usr_in_estatus_cliente'] == 1) { ?>
                                                <td id="edit"><span class="label label-success">Aprobado</span><br>
                                                    <input  name="estatus" type="hidden" id="estatus" value="Aprobado">
                                                    <input  name="rif" type="hidden" id="rif" value="<?php echo $row['tblsit_usr_ci_rif_cliente'] ?>">
                                                </td> 
                                            <?php }
                                                elseif ($row['tblsit_usr_in_estatus_cliente'] == 0) { ?>
                                                <td id="edit"><span class="label label-reverse">Sancionado</span><br>
                                                    <input  name="estatus" type="hidden" id="estatus" value="Sancionado">
                                                    <input  name="rif" type="hidden" id="rif" value="<?php echo $row['tblsit_usr_ci_rif_cliente'] ?>">
                                                </td> 
                                            <?php } ?>
                                            <?php
                                            $sqlAnul = "SELECT * FROM tblxian_motivo_anul WHERE in_activo=1 AND in_tipo=1  ORDER BY nb_motivo_anul ASC";
                                            $resultAnul = @pg_query($sqlAnul);
                                            $anul = '';
                                            while ($rowA = pg_fetch_array($resultAnul)) {
                                                $anul .=" <option value=" . $rowA['id_motivo_anul'] . "> " . $rowA['nb_motivo_anul'] . "</option>";
                                            }
                                            ?>

                                    <form class="form-horizontal"   method="post" action="includes/ActualizarSancionaCliente.php" >
                                        <td id="nbc">
                                            <input  name="rif" type="hidden" id="rif" value="<?php echo $row['tblsit_usr_ci_rif_cliente'] ?>">
                                            <select    name="id_motivo" id="id_motivo"  required>
                                                <?php echo $anul ?>
                                            </select> 
                                        </td> 
                                        <td><button title="Procesar" class="btn btn-mini btn-success"><i class="icon-ok"></i></button>
                                            <button type="reset"  title="Limpiar" class="btn btn-mini btn-danger"><i class="icon-repeat"></i></button>
                                        </td>
                                    </form>
                                    </tr>
                                    </tbody>
                                <?php } ?> 
                            </table> 
                        <?php } else { ?>


                            <div class="form-horizontal" aligncenter >                                        <br><br>
                                <center >

                                    <center class="hero-unit" >      <p > <h4> No hay solicitudes pendientes</h4>   </p>   </center></center>
                            </div>
                        <?php } ?>
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
