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
    header("Location:login.php");
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
    <title>Administración</title>
    <script type="text/javascript">

        function f_CmbReasignar() {
            document.frm.action = "includes/ReasignarVendedorACliente.php";
            document.frm.submit();
        }

        function f_Cmb1() {
            document.frm.action = "includes/buscarRifVendedorReasignar.php";
            document.submit();
        }
    </script>
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
                        <h4>Reasignar cliente</h4>
                        <p>Importadora Xian, C.A.</p>
                        <hr/>
                        <?php
                        extract($_REQUEST);
                        $sesion->set('rifCliente', $rif);
                        if (isset($rif))
                            $sql = "SELECT tblsit_usr.razon_social_cliente AS tblsit_usr_razon_social_cliente,
                                tblsit_usr.ci_rif_cliente AS tblsit_usr_ci_rif_cliente,
                                tblsit_usr.id_usr_vendedor AS tblsit_usr_id_usr_vendedor,
                                tblsit_usr.nb_usuario AS tblsit_usr_nb_usuario,
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
    WHERE tblsit_usr.id_rol_usr = 4  AND  tblsit_usr.in_status_cliente = 1 AND tblsit_usr.ci_rif_cliente='" . strtoupper($rif) . "' ";
                        $result = @pg_query($sql);
                        $file = pg_fetch_array($result);
                        $idVendedor = $file['tblsit_usr_id_usr_vendedor'];
                        $sql2 = "SELECT * FROM tblsit_usr  WHERE id_usr = $idVendedor AND id_rol_usr = 5   AND in_status_usr = 1 ";
                        $result2 = @pg_query($sql2);
                        $file2 = pg_fetch_array($result2);

                        $rifCliente = $file['tblsit_usr_ci_rif_cliente'];
                        $razonCliente = $file['tblsit_usr_razon_social_cliente'];
                        $nombreCliente = $file['tblsit_usr_nb_usuario'];
                        $emailCliente = $file['tblsit_usr_tx_login'];

                        $rifVendedor = $file2['ci_rif_cliente'];
                        $razonVendedor = $file2['razon_social_cliente'];
                        $nombreVendedor = $file2['nb_usuario'];
                        $emailVendedor = $file2['tx_login'];
                        ?>
                    </div>    <div class="span12">

                        <div class="well login-register">
                            <fieldset>
                                <legend  class="btn btn-danger " >Datos del clientes</legend>
                                <div class="control-group">
                                    <label class="control-label" for="rif">RIF del cliente:</label>
                                    <div class="controls">
                                        <input readonly type="text" title="Por favor, introduzca el rif" class="input-large" placeholder="V106128118" name="rif" id="rif"  value="<?php echo $rifCliente ?>"  />
                                    </div>
                                </div>   
                                <!-- Razón Social-->
                                <div class="control-group">
                                    <label class="control-label" for="name">Razón social:</label>
                                    <div class="controls">
                                        <input readonly type="text"  size="100"class="input-large" id="empresa" name="empresa" value="<?php echo $razonCliente ?>" >

                                    </div>
                                </div> 
                                <!-- Name -->
                                <div class="control-group">
                                    <label class="control-label" for="name">Nombre y apellido:</label>
                                    <div class="controls">
                                        <input readonly type="text" class="input-large" id="nombre" name="nombre" placeholder="Nombre y Apellido" value="<?php echo $nombreCliente ?>" >
                                    </div>
                                </div> 
                                <!-- Nombre del usuario-->
                                <div class="control-group">
                                    <label class="control-label" for="email">Usuario:</label>
                                    <div class="controls">
                                        <input readonly type="text" class="input-large" id="email" placeholder="ejemplo@dominio.com"  
                                               name="email" pattern="[\w-\.]{3,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}" value="<?php echo $emailCliente ?>" >
                                    </div>   
                                </div>  
                            </fieldset>  
                            <fieldset>
                                <legend  class="btn btn-danger " >Datos del vendedor asignado</legend>
                                <div class="control-group">
                                    <label class="control-label" for="rif">RIF del vendedor asignado:</label>
                                    <div class="controls">
                                        <input readonly class="mayuscula" pattern="(^([VEJPG]{1})([0-9]{9}$)" type="text" title="Por favor, introduzca el rif" class="input-large"  value="<?php echo $rifVendedor ?>" >
                                    </div>
                                </div>   
                                <!-- Razón Social-->
                                <div class="control-group">
                                    <label class="control-label" for="name">Razón social:</label>
                                    <div class="controls">
                                        <input readonly type="text"  size="100"class="input-large" value="<?php echo $razonVendedor ?>" >
                                    </div>
                                </div> 
                                <!-- Name -->
                                <div class="control-group">
                                    <label class="control-label" for="name">Nombre y apellido:</label>
                                    <div class="controls">
                                        <input readonly type="text" class="input-large"  value="<?php echo $nombreVendedor ?>" >
                                    </div>
                                </div> 
                                <!-- Nombre del usuario-->
                                <div class="control-group">
                                    <label class="control-label" for="email">Usuario:</label>
                                    <div class="controls">
                                        <input readonly type="text" class="input-large" i placeholder="ejemplo@dominio.com"  
                                               name="email" pattern="[\w-\.]{3,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}" value="<?php echo $emailVendedor ?>" >
                                    </div>   
                                </div>  
                            </fieldset> 

                            <form    name="QForm"    class="form-horizontal" method="post" action="includes/buscarRifVendedorReasignar.php" />
                            <fieldset> 
                                <legend  class="btn btn-danger " >Buscar vendedor para reasignar el cliente</legend> 
                                <?php
                                $sqlv = "SELECT ci_rif_cliente FROM tblsit_usr WHERE id_rol_usr = 5 AND in_status_usr = 1 ";
                                $resultv = @pg_query($sqlv);
                                $comboxrif = '';
                                while ($row = pg_fetch_array($resultv))
                                    $comboxrif .=" <option value=" . $row['ci_rif_cliente'] . "> " . $row['ci_rif_cliente'] . "</option>";
                                ?>
                                <!-- Rif -->
                                <div class="control-group">
                                    <label class="control-label" for="entrega">RIF:</label>
                                    <div class="controls">
                                        <select name="rifi" required>
                                            <?php echo $comboxrif ?>
                                        </select>  <button  type="submit" name="enviar" class="btn btn-danger"  >Buscar vendedor</button>
                                        <button class="btn btn-danger" type="reset" class="btn">Limpiar</button>
                                        <a class="btn btn-danger" href="AdminMenuPrincipal.php">Cancelar</a>
                                    </div>
                            </fieldset>
                            <?php
                            if (isset($_REQUEST['rifVende'])) {
                                $rifVende = $_REQUEST['rifVende'];

                                $sql3 = "SELECT * FROM tblsit_usr  WHERE ci_rif_cliente ='" . $rifVende . "' AND  id_rol_usr = 5   AND in_status_usr = 1 ";
                                $result3 = @pg_query($sql3);
                                $file3 = pg_fetch_array($result3);
                                $rifVende = $file3['ci_rif_cliente'];
                                $razonVende = $file3['razon_social_cliente'];
                                $nombreVende = $file3['nb_usuario'];
                                $emailVende = $file3['tx_login'];
                                $idUsrVendedor = $file3['id_usr'];
                                $enviarRif = $sesion->set('rifCliente', $rif);
                                ?>


                                <fieldset>
                                    <legend  class="btn btn-danger " >Datos del vendedor a reasignar</legend>
                                    <div class="control-group">
                                        <label class="control-label" for="rif">RIF del vendedor asignado:</label>
                                        <div class="controls">
                                            <input readonly class="mayuscula" pattern="(^([VEJPG]{1})([0-9]{9}$)" type="text" title="Por favor, introduzca el rif" class="input-large" placeholder="V106128118" name="rifVende" id="rifVende"  value="<?php echo $rifVende ?>" >
                                        </div>
                                    </div>   
                                    <!-- Razón Social-->
                                    <div class="control-group">
                                        <label class="control-label" for="name">Razón social:</label>
                                        <div class="controls">
                                            <input readonly type="text"  size="100"class="input-large" id="razonVende" name="razonVende" value="<?php echo $razonVende ?>" >
                                        </div>
                                    </div> 
                                    <!-- Name -->
                                    <div class="control-group">
                                        <label class="control-label" for="name">Nombre y apellido:</label>
                                        <div class="controls">
                                            <input readonly type="text" class="input-large" id="nombreVende" name="nombreVende" placeholder="Nombre y Apellido" value="<?php echo $nombreVende ?>" >
                                        </div>
                                    </div> 
                                    <!-- Nombre del usuario-->
                                    <div class="control-group">
                                        <label class="control-label" for="email">Usuario:</label>
                                        <div class="controls">
                                            <input readonly type="text" class="input-large" id="emailVende" placeholder="ejemplo@dominio.com"  
                                                   name="emailVende" pattern="[\w-\.]{3,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}" value="<?php echo $emailVende ?>" >
                                        </div>   
                                    </div>  
                                </fieldset> 
                                </form>   
                                <form    name="QForm"    class="form-horizontal" method="post" action="includes/ReasignarVendedorACliente.php" />
                                <input  type="hidden"  name="idUsrVendedor" id="idUsrVendedor"  value="<?php echo $idUsrVendedor ?>" >
                                <input readonly type="hidden" class="input-large"   name="rifenviar" id="rifenviar" value="<?php echo $rif ?>" >
                                <!-- Buttons -->
                                <button  type="submit" name="enviar" class="btn btn-danger"  >Procesar reasignación</button>
                                <a class="btn btn-danger" href="AdminMenuPrincipal.php">Cancelar</a>

                                </form>
                                <?php
                            }
                            ?>
                            <!-- Buttons -->  

                        </div>
                        <?php ?>
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