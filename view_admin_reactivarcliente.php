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


    include 'navbar/NavBarAdmin.php';
    include 'sliderbox/formSliderBox.php';
    include 'sheetstart/formSheetStart.php';
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
    <title>Anulación del cliente</title>

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
                        <h4>Reactivar cliente</h4>
                        <p>Importadora Xian, C.A.</p>
                        <hr/>
                        <div class="span14">
                            <?php
                            $sql = "SELECT tblsit_usr.razon_social_cliente AS tblsit_usr_razon_social_cliente,
 tblsit_usr.ci_rif_cliente AS tblsit_usr_ci_rif_cliente,
  tblsit_usr.nb_usuario AS tblsit_usr_nb_usuario, 
  tblsit_usr.tx_direccion AS tblsit_usr_tx_direccion,
   tblsit_usr.nb_persona_contacto AS tblsit_usr_nb_persona_contacto,
    tblsit_usr.tx_telf_contacto AS tblsit_usr_tx_telf_contacto, 
    tblsit_usr.tx_login AS tblsit_usr_tx_login,
      tblsit_usr.in_status_cliente AS tblsit_usr_in_estatus_cliente
        FROM tblsit_usr tblsit_usr
         WHERE tblsit_usr.id_rol_usr = 4
         AND (tblsit_usr.in_status_cliente = -1 OR tblsit_usr.in_status_cliente =0)
          AND tblsit_usr.ci_rif_cliente='" . $_REQUEST['rifcli'] . "'";
                            $query = @pg_query($sql);
                            $file = pg_fetch_array($query);
                            $razon = $file['tblsit_usr_razon_social_cliente'];
                            $ema = $file['tblsit_usr_tx_login'];
                            $estatus = $file['tblsit_usr_in_estatus_cliente'];
                            $rif = $_REQUEST['rifcli'];
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
                                        <input type="text" class="input-large" id="email" readonly 
                                               name="email" pattern="[\w-\.]{3,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}" autofocus value="<?php echo $file['tblsit_usr_tx_login'] ?>" autofocus />
                                    </div>   
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="rif">Estatus del cliente:</label>
                                    <div class="controls">   
                                        <?php if ($file['tblsit_usr_in_estatus_cliente'] == -1) { ?>
                                            <input type="text" readonly title="Estatus del cliente" class="input-large" placeholder="Aprobado" name="status" id="status" value="Eliminado" autofocus />   
                                        <?php } else if ($file['tblsit_usr_in_estatus_cliente'] == 0) { ?>
                                            <input type="text" readonly title="Estatus del cliente" class="input-large" placeholder="Aprobado" name="status" id="status" value="Sancionado" autofocus />   
                                        <?php } ?>

                                    </div>
                                </div>
                                <?php
                                $sql = "SELECT id_motivo_anul, ci_rif_cliente FROM tblsit_hist_clte  WHERE ci_rif_cliente='$rif' AND (in_status_cliente= -1 OR in_status_cliente= 0)  ORDER BY id_hist_clte ASC";
                                $result = @pg_query($sql);
                                $file = pg_fetch_array($result);


                                $sqlMotivo = "SELECT id_motivo_anul, nb_motivo_anul FROM tblxian_motivo_anul WHERE id_motivo_anul= $file[id_motivo_anul] ORDER BY id_motivo_anul ASC";
                                $resultMotivo = @pg_query($sqlMotivo);
                                $rowMotivo = pg_fetch_array($resultMotivo);
                                $nbMotivo = $rowMotivo ['nb_motivo_anul'];
                                ?>
                                <div class="control-group">
                                    <label class="control-label" for="rif">Motivo de anulación:</label>
                                    <div class="controls">
                                        <input type="text" readonly title="motivo" class="input-large"  name="motivo" id="empresa" value="<?php echo $nbMotivo ?>" autofocus />
                                    </div>
                                </div>
                                <form class="form-horizontal"  method="post" action="controlador/controller_admin.php" >
                                    <!-- RIF -->
                                    <div class="control-group">
                                        <input type = "hidden" name="accion" id = "action"    value ='5' required/>
                                        <input type="hidden"   name="rif" id="rifcli"   value="<?php echo $_REQUEST['rifcli'] ?>" />

                                    </div>
                                    <!-- Buttons <div class="form-actions">-->
                                    <div class="form-actions">
                                        <!-- Buttons -->
                                        <button class="btn btn-danger" type="submit"  name="submit" class="btn">Reactivar cliente</button>
                                        <!-- <button class="btn btn-danger" type="reset" class="btn">Limpiar</button>  -->
                                        <a class="btn btn-danger" href="AdminMenuPrincipal.php">Cancelar</a>

                                    </div>
                                </form>  


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