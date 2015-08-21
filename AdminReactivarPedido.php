<?php
include "includes/sesion.class.php";
$sesion = new sesion();
$email = $sesion->get('email');
$idusr = $sesion->get("id_usr");
$rol = $sesion->get('id_rol_usr');
$rif = $sesion->get('rif');
if (!isset($email)) {
    header("Location: login.php");
} if (!$rol == 1 ) {
    header("Location: login.php");
} else {
    ?>

    <?php
    include 'meta/formMeta.php';
    include 'Link/Link.php';
    include 'Sidebar/formSiderBarMenu.php';
    include 'contactbox/formContactBox.php';
    include 'navbar/NavBarAdmin.php';
    include 'sliderbox/formSliderBox.php';
    include 'sheetstart/formSheetStart.php';
    include 'Slider/formSliderCatalogo.php';
    include 'Clearfix/formClearFix.php';
    include 'Footer/formFooter.php';
    include 'includes/ConexionPGSQL.php';
    include 'includes/Consultas.php';
    include 'includes/getSetPedido.php';
    include 'includes/Rif.php';
    ?>
    <!DOCTYPE html>
    <?php
    $meta = new formMeta();
    $meta->meta();
    ?>
    <title>Reactivación de pedido</title>

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


    <?php
    ?>
    <!-- Main content starts -->
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
                    <br>  
                    <div class="page-title" align="left">
                        <h4>Reactivar pedido</h4>
                        <p>Importadora Xian, C.A.</p>
                        <hr/>
                    </div> 
                    <div class="span12">
                        <div class="well login-register">
                            <form class="form-horizontal"  method="post" action="includes/buscarIdPedidoReactivar.php" >
                                <fieldset>
                                    <legend  class="btn btn-danger " >Reactivación del pedido</legend>
                                    <div class="control-group">
                                        <label class="control-label" for="id">Id del pedido anulado:</label>
                                        <div class="controls">
                                            <input type="number" min="1"   title="Id del pedido" class="input-mini" name="id_pedido"   id="id_pedido"  required      autofocus />
                                            <button  type="submit" name="enviar" class="btn btn-danger"  >Buscar id anulado</button>
                                            <button  type="reset" class="btn btn-danger">Limpiar</button>
                                        </div>  
                                    </div>
                          </fieldset>
                            </form>
                           

                            <?php
                            if (isset($_REQUEST['ids'])) {
                                $ids = $_REQUEST['ids'];

                                $sql1 = 'select * FROM tblxian_pedido WHERE id_pedido=' . $ids . ' ';
                                $result1 = @pg_query($sql1);
                                $file1 = pg_fetch_array($result1);
                                $idMotivoAnul = $file1['id_motivo_anul'];
                                if (!$idMotivoAnul == '') {
                                    $sql2 = 'SELECT nb_motivo_anul FROM tblxian_motivo_anul WHERE id_motivo_anul=' . $idMotivoAnul . ' ';
                                    $result2 = @pg_query($sql2);
                                    $file2 = pg_fetch_array($result2);

                                    $sql3 = "SELECT * FROM tblxian_motivo_anul WHERE in_tipo=2 OR in_tipo=-1";
                                    $result3 = @pg_query($sql3);
                                    $comboMotivoReac = '';
 
                                    while ($row = pg_fetch_array($result3)) {
                                        $comboMotivoReac .=" <option value=" . $row['id_motivo_anul'] . "> " . $row['nb_motivo_anul'] . "</option>";
                                    }
                                    ?>
                                     <fieldset>
                                        <legend  class="btn btn-danger " >Datos del pedido</legend>
                                        <div class="control-group">
                                            <label class="control-label" for="id">Id del pedido:</label>
                                            <div class="controls">
                                                <input type="text" readonly title="Id del pedido" class="input-mini" name="ids" 
                                                       value="<?php echo $file1['id_pedido'] ?>" autofocus />
                                            </div> 
                                        </div>   
                                        <div class="control-group">

                                            <label class="control-label" for="rif">Motivo de anulación:</label>
                                            <div class="controls">
                                                <input type="text" disabled title="Motivo de anulación" class="input-large"  name="anula" id="anula"  
                                                       value="<?php echo $file2['nb_motivo_anul'] ?>" autofocus />
                                            </div>
                                        </div
                                    </fieldset>
                                    <form class="form-horizontal"  method="post" action="includes/ReactivarPedido.php" >
                                        <!-- RIF -->
                                        <div class="control-group">
                                            <label class="control-label" for="rif">Motivo de reactivación:</label>
                                            <div class="controls">
                                                <select name="id_motivo" ><?php echo $comboMotivoReac ?></select>
                                            </div>
                                             </div>
                                            <div class="control-group">
                                               <input type="hidden" readonly  class="input-large" name="id" id="id"  
                                                       value="<?php echo $file1['id_pedido'] ?>" autofocus />
                                            </div>
                                            <!-- Buttons <div class="form-actions">-->
                                            <div class="form-actions">
                                                <!-- Buttons -->
                                                <button class="btn btn-danger" type="submit"  name="submit" class="btn">Reactivar pedido</button>
                                                <!-- <button class="btn btn-danger" type="reset" class="btn">Limpiar</button>  -->
                                                <a class="btn btn-danger" href="AdminMenuPrincipal.php">Cancelar</a>
                                            </div>
                                    </form>  
                                </div>
                                <?php
                            } else {
                                echo "<script language='JavaScript'> alert('Motivo de anulación  vacio')
                                      location.href = 'AdminReactivarPedido.php' ;
                                      exit();  
                                      </script> ";
                            }
                        }
                        ?>
                    </div>
                </div><!-- fin de span 14-->
            </div>
        </div><!-- fin de span 14-->
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