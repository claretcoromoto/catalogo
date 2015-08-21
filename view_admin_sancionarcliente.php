<?php
include "includes/sesion.class.php";
$sesion = new sesion();
$email = $sesion->get('email');
$idusr = $sesion->get("id_usr");
$rol = $sesion->get('id_rol_usr');
$rif = $sesion->get('rif');
if (!isset($email)) {
    header("Location: login.php");
} if (!$rol == 1) {
    header("Location: login.php");
} else {
    ?>

    <?php
    include 'meta/formMeta.php';
    include 'Link/Link.php';

    include 'Sidebar/formSiderBarMenu.php';
    include 'contactbox/formContactBox.php';

    include 'navbar/NavBarAdmin.php';
   
    include 'Slider/formSliderCatalogo.php';

    include 'Clearfix/formClearFix.php';
    include 'Footer/formFooter.php';

    include 'includes/ConexionPGSQL.php';

    ?>
    <!DOCTYPE html>
    <?php
    $meta = new formMeta();
    $meta->meta();
    ?>
    <title>Sanción del cliente</title>

    <?php
    $links = new link();
    $links->linkeos();
    ?>
    <!--   Fin de HTML Y HEAD-->

    <!-- Navbar starts -->
    <?php
    $navAdmin = new NavBarAdmin();
    $navAdmin->navegador($email);
    ?>

    <!-- Navbar ends -->
    <!-- Main content starts -->
    <div class="content">
        <br>
        <!-- Sidebar starts -->
        <?php
        $sideBarAdmin = new formSiderBarMenu();
        $sideBarAdmin->formSider();
        ?>
        <div class="mainbar">
            <!-- Title starts  id="sometabs"  <div class="mainbar"> -->
            <div class="span12">
                <div class="box-body">
                    <br>  
                    <div class="page-title" align="left">
                        <h4>Sancionar cliente</h4>
                        <p>Importadora Xian, C.A.</p>
                        <hr/>
                        <div class="span12">
                            <?php
                            $sql = "SELECT tblsit_usr.razon_social_cliente AS tblsit_usr_razon_social_cliente, tblsit_usr.ci_rif_cliente AS tblsit_usr_ci_rif_cliente, tblsit_usr.nb_usuario AS tblsit_usr_nb_usuario, tblsit_usr.tx_direccion AS tblsit_usr_tx_direccion, tblsit_usr.nb_persona_contacto AS tblsit_usr_nb_persona_contacto, tblsit_usr.tx_telf_contacto AS tblsit_usr_tx_telf_contacto, tblsit_usr.tx_login AS tblsit_usr_tx_login, tblsit_ciudad.nb_ciudad AS tblsit_ciudad_nb_ciudad, tblsit_municipio.nb_municipio AS tblsit_municipio_nb_municipio, tblsit_estado.nb_estado AS tblsit_estado_nb_estado, tblsit_usr.in_status_cliente AS tblsit_usr_in_estatus_cliente FROM tblsit_ciudad tblsit_ciudad INNER JOIN tblsit_usr tblsit_usr ON tblsit_ciudad.id_ciudad = tblsit_usr.id_ciudad INNER JOIN tblsit_municipio tblsit_municipio ON tblsit_ciudad.id_municipio = tblsit_municipio.id_municipio INNER JOIN tblsit_estado tblsit_estado ON tblsit_municipio.id_estado = tblsit_estado.id_estado WHERE tblsit_usr.id_rol_usr = 4 AND tblsit_usr.in_status_cliente =  1 AND tblsit_usr.ci_rif_cliente='" . $_REQUEST['rifcli'] . "' ";
                            $query = @pg_query($sql);
                            $file = pg_fetch_array($query);
                            $razon = $file['tblsit_usr_razon_social_cliente'];
                            $ema = $file['tblsit_usr_tx_login'];
                            $estatus = $file['tblsit_usr_in_estatus_cliente'];
                        //    $rif=$_REQUEST['rifcli'];
                            ?>
                            <div class="well login-register">
                                <div class="control-group">
                                    <label class="control-label" for="rif">RIF:</label>
                                    <div class="controls">
                                        <input type="text" readonly title="RIF" class="input-large" placeholder="V106128118" name="rif" id="nombre"  
                                               value="<?php echo $_REQUEST['rifcli'] ?>" autofocus />
                                    </div> 
                                </div>   
                                <div class="control-group">

                                    <label class="control-label" for="rif">Razón Social:</label>
                                    <div class="controls">
                                        <input type="text" readonly title="Razón social" class="input-large"  name="empresa" id="empresa"  
                                               value="<?php echo $file['tblsit_usr_razon_social_cliente'] ?>" autofocus />
                                    </div>
                                </div>
                                <!-- Username   -->
                                <div class="control-group">
                                    <label class="control-label" for="email">Usuario:</label>
                                    <div class="controls">
                                        <input type="text" class="input-large" id="email" 
                                               name="email" pattern="[\w-\.]{3,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}" autofocus value="<?php echo $file['tblsit_usr_tx_login'] ?>" autofocus />
                                    </div>   
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="rif">Estatus del cliente:</label>
                                    <div class="controls">   
                                        <?php if ($file['tblsit_usr_in_estatus_cliente'] == 1) { ?>
                                            <input type="text" readonly title="Estatus del cliente" class="input-large" placeholder="Aprobado" name="status" id="status" value="Registrado" autofocus />   
                                        <?php } ?>
                                    </div>
                                </div>
                           
                                <form class="form-horizontal"  method="post" action="controlador/controller_admin.php" >
                                    <!-- RIF -->
                                    <div class="control-group">
                                        <input type = "hidden" name="accion" id = "accion"    value ='6' required/>
                                        <input type="hidden"   name="rifcli" id="rifcli"   value="<?php echo $_REQUEST['rifcli'] ?>" />
                                        <div class="control-group">
                                            <?php
                                            $sql = "SELECT * FROM tblsit_hist_clte WHERE ci_rif_cliente= '$rif' AND id_motivo_anul=3 ORDER BY id_hist_clte ASC ";
                                            $sqlMotivoR = "SELECT * FROM tblxian_motivo_anul WHERE in_tipo=1 AND in_activo=1";
                                            $resultMotivoR = @pg_query($sqlMotivoR);
                                            $comboMotivoReac = '';
                                            while ($row = pg_fetch_array($resultMotivoR)) {
                                                $comboMotivoReac .=" <option value=" . $row['id_motivo_anul'] . "> " . $row['nb_motivo_anul'] . "</option>";
                                            }
                                            ?>
                                            <hr>
                                            <label class="control-label" for=id">Motivo de Anulación:</label>
                                            <div class="controls">
                                                <select name="id">
                                                    <?php echo $comboMotivoReac ?>
                                                </select> 
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Buttons <div class="form-actions">-->
                                    <div class="form-actions">
                                        <!-- Buttons -->
                                        <button class="btn btn-danger" type="submit"  name="submit" class="btn">Sancionar cliente</button>
                                            <a class="btn btn-danger" href="AdminMenuPrincipal.php">Cancelar</a>
                                    </div>
                                </form>  

                                <?php ?>
                            </div>

                        </div>
                    </div><!-- fin de span 14-->
                </div>
            </div><!-- fin de span 14-->
        </div>
    </div><!-- fin de content-->


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